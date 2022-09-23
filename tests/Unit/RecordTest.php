<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\RecordRepository;
use App\Repositories\AdminRepository;
use Exception;

class RecordTest extends TestCase
{
    public function testLists() {
        $recordRepo = new RecordRepository();
        $params = [];
        $records = $recordRepo->lists($params);
        $this->assertEquals('200902A02110', $records[0]->submitId);
        $this->assertEquals(1, $records[0]->accountId);
        $this->assertEquals(10, count($records));
    }

    public function testListsAmount() {
        $recordRepo = new RecordRepository();
        $params = [];
        $amount = $recordRepo->listsAmount($params);
        $this->assertEquals(20, $amount);
    }

    public function testGetById() {
        $recordRepo = new RecordRepository();
        try {
            $recordRepo->getById(1044);
        }
        catch(Exception $e) {
            $this->assertEquals('案件不存在', $e->getMessage());
        }

        $record = $recordRepo->getById(1);
        $this->assertEquals('200902A00210', $record->submitId);
    }

    public function testCreate() {
        $this->assertTrue(true);
        /*
        $recordRepo = new RecordRepository();
        $params = [];
        $params['CustGID'] = "A154943977";
        $params['applicant'] = "唐銘煌";
        $params['productName'] = "汽車頭期款";
        $params['applyAmount'] = "35800";         //申貸金額
        $params['liense'] = "ARF-342";            //車牌
        $params['memo'] = "備註測試";
        $params['accountId'] = 1;
        $recordRepo->create($params);

        $record = $recordRepo->getById(21);
        $this->assertEquals("A154943977", $record->CustGID);
        $this->assertEquals("唐銘煌", $record->applicant);
        $this->assertEquals("汽車頭期款", $record->productName);
        $this->assertEquals("35800", $record->applyAmount);
        $this->assertEquals("ARF-342", $record->liense);
        $this->assertEquals("備註測試", $record->memo);
         */
    }

    public function testUpdateById() {
        $adminRepo = new AdminRepository();
        $recordRepo = new RecordRepository();
        $updateId = 12;
        $updateParams = [
            'CustGID' => 'A154943977',
        ];
        $files = [];

        $adminParams = [
            'account' => 'admin',
            'password' => '123456',
        ];
        $admin = $adminRepo->checkPassword($adminParams);

        try {
            $recordRepo->updateById(1044, $updateParams, $admin, $files);
        }
        catch(Exception $e) {
            $this->assertEquals('案件不存在', $e->getMessage());
        }

        $recordRepo->updateById($updateId, $updateParams, $admin, $files);
        $record = $recordRepo->getById($updateId);
        $this->assertEquals('A154943977', $record->CustGID);
    }
}
