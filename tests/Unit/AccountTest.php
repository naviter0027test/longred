<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\AccountRepository;
use Exception;

class AccountTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCheckPassword() {
        $accountRepo = new AccountRepository();
        $test1Params = [
            'account' => 'aaaaa',
            'password' => 'bbbbbbb',
        ];
        $test1Result = $accountRepo->checkPassword($test1Params);
        $this->assertFalse($test1Result);

        $test2Params = [
            'account' => 'account1',
            'password' => '123456',
        ];
        $test2Result = $accountRepo->checkPassword($test2Params);
        $this->assertEquals(1, $test2Result->id);
        $this->assertEquals(1, $test2Result->active);
        $this->assertEquals('name1', $test2Result->name);
        $this->assertEquals('12345671', $test2Result->phone);
        $this->assertEquals('name1@test.com.tw', $test2Result->email);
    }

    public function testLists() {
        $accountRepo = new AccountRepository();
        $params = [];
        $accounts = $accountRepo->lists($params);
        $this->assertEquals(10, count($accounts));
        $this->assertEquals('account20', $accounts[0]->account);
        $this->assertEquals('area20', $accounts[0]->area);
        $this->assertEquals('account19', $accounts[1]->account);
        $this->assertEquals('area19', $accounts[1]->area);

        $params = [
            'keyword' => 'name2',
        ];
        $accounts = $accountRepo->lists($params);
        $this->assertEquals(2, count($accounts));
        $this->assertEquals('account20', $accounts[0]->account);
        $this->assertEquals('area20', $accounts[0]->area);
        $this->assertEquals('account2', $accounts[1]->account);
        $this->assertEquals('area2', $accounts[1]->area);
    }

    public function testListsAmount() {
        $accountRepo = new AccountRepository();
        $params = [];
        $amount1 = $accountRepo->listsAmount($params);
        $this->assertEquals(20, $amount1);

        $params = [
            'keyword' => 'name20',
        ];
        $amount2 = $accountRepo->listsAmount($params);
        $this->assertEquals(1, $amount2);

        $params = [
            'keyword' => 'name22',
        ];
        $amount2 = $accountRepo->listsAmount($params);
        $this->assertEquals(0, $amount2);
    }

    public function testGetById() {
        $accountRepo = new AccountRepository();

        $account1 = $accountRepo->getById(1);
        $this->assertEquals('account1', $account1->account);
        $this->assertEquals('name1@test.com.tw', $account1->email);

        try{
            $account2 = $accountRepo->getById(501);
        }
        catch(Exception $e) {
            $this->assertEquals('帳號不存在', $e->getMessage());
        }
    }

    public function testCreate() {
        $accountRepo = new AccountRepository();
        $params = [
            'account' => 'account101',
            'password' => '123456',
            'name' => '葉忠明',
            'phone' => '0912341234',
            'area' => '台北市XX路二段XXX號',
            'active' => 1,
        ];
        $accountRepo->create($params);
        $account1 = $accountRepo->getById(21);
        $this->assertEquals(21, $account1->id);
        $this->assertEquals('account101', $account1->account);
        $this->assertEquals('葉忠明', $account1->name);
        $this->assertEquals('台北市XX路二段XXX號', $account1->area);

        $params = [
            'account' => 'account10',
        ];
        try {
            $accountRepo->create($params);
        }
        catch(Exception $e) {
            $this->assertEquals('帳號重複', $e->getMessage());
        }
    }
}
