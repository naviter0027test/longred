<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class DropTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DropTables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'tdd 測試專用 測試結束時會將 memory 所有資料表刪除';

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
        if(env('DB_CONNECTION', '') != 'testing') {
            echo "非測試模式\n";
            return false;
        }
        echo "開始刪除資料表 (Memory Mode)\n";
        Schema::dropIfExists('Admin');
        Schema::dropIfExists('Account');
        Schema::dropIfExists('Record');
        Schema::dropIfExists('Message');
        Schema::dropIfExists('HasRead');
        Schema::dropIfExists('migrations');
        echo "刪除完成\n";
    }
}
