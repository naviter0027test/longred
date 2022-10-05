<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\AccountRepository;

class WHttpMessageTest extends TestCase
{
    public function testLists()
    {
        $accountRepo = new AccountRepository();
        $params = [
            'account' => 'account1',
            'password' => '123456',
        ];
        $account = $accountRepo->checkPassword($params);

        $paramsSearch = [
            'accountId' => 1,
        ];
        $response = $this->withSession(['account' => $account])
            ->call('GET', '/account/message', []);
        //print_r($response->decodeResponseJson());
        $response->assertStatus(200)
            ->assertJson([
                'result' => true,
                'msg' => 'success',
                'amount' => 30,
            ]);
    }
}
