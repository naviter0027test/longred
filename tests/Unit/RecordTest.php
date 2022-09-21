<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\RecordRepository;
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
}
