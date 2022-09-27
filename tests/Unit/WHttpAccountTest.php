<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\AccountRepository;

class WHttpAccountTest extends TestCase
{
    public function testIsLogin() {
        $accountRepo = new AccountRepository();
        $params = [
            'account' => 'account1',
            'password' => '123456',
        ];
        $account = $accountRepo->checkPassword($params);

        $response = $this->get('/account/isLogin');
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => false,
                     'msg' => 'not login',
                 ]);

        $response = $this->withSession(['account' => $account])
            ->get('/account/isLogin');
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'msg' => 'has login',
                 ]);
    }

    public function testLogin() {
        $test1Params = [
            'account' => 'aaaaa',
            'password' => 'bbbbbbb',
        ];
        $response = $this->call('POST', '/account/login', $test1Params);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => false,
                     'msg' => 'login failure',
                 ]);

        $test2Params = [
            'account' => 'account1',
            'password' => '123456',
        ];
        $response = $this->call('POST', '/account/login', $test2Params);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'msg' => 'login success',
                 ]);
    }
}
