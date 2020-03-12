<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use App\Admin;
use App\Repositories\RecordRepository;
use Exception;

class ImportCsvFromFtp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ImportCsvFromFtp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ftp遠端確認使否有匯入的檔案，匯入完成後，再將已匯入檔刪除';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(function_exists('ftp_connect') == false) {
            throw new Exception('FTP extension is not install');
        }

        $admin = Admin::orderBy('id')->first();
        $fileNames = Storage::disk('csvftp')->files('./');
        $recordRepository = new RecordRepository();

        foreach($fileNames as $fileName) {
            $splitArr = preg_split("/\./", $fileName);
            $nameLen = count($splitArr);

            $isAllSuccess = true;
            if($splitArr[$nameLen-1] == 'csv') {
                $content = Storage::disk('csvftp')->get($fileName);
                $resultRow = [];
                $arr = preg_split("/\n/", $content);
                $arrLen = count($arr);
                foreach($arr as $i => $row) {
                    try {
                        $csv = str_getcsv($row, ",");
                        $recordRepository->importRow($csv, $admin);
                        $resultRow[$i] = [
                            'status' => true,
                            'msg' => 'success',
                        ];
                    } catch (Exception $e) {
                        if($arrLen - 1 != $i)
                            $isAllSuccess = false;
                        $resultRow[$i] = [
                            'status' => false,
                            'msg' => $e->getMessage(),
                        ];
                    }
                }

                if($isAllSuccess == false) {
                    $logData = '';
                    foreach($resultRow as $logIdx => $logRow) {
                        $logData .= $logIdx. ":". $logRow['msg']. "\n";
                    }
                    Storage::disk('csvlog')->put(date('Ymd-His'). '.log', $logData);
                    //\Log::info($resultRow);
                } else {
                    //刪除已匯入的檔案
                    Storage::disk('csvftp')->delete($fileName);
                }
            }
        }
    }
}
