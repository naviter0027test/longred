<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\AccountRepository;

class WHttpRecordTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGet()
    {
        $accountRepo = new AccountRepository();
        $params = [
            'account' => 'account1',
            'password' => '123456',
        ];
        $account = $accountRepo->checkPassword($params);
        $this->withSession(['account' => $account]);

        $searchParams = [
            'startDate' => date('Y-m-d', strtotime('-3 month')),
        ];
        $response = $this->call('POST', '/account/record', $searchParams);
        $response->assertStatus(200)
                 ->assertJson([
                     'result' => true,
                     'msg' => 'success',
                     'amount' => 19,
                     'nowPage' => 1,
                     'offset' => 10,
                 ]);
    }
}
