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

    public function testLogout() {
        $accountRepo = new AccountRepository();
        $params = [
            'account' => 'account1',
            'password' => '123456',
        ];
        $account = $accountRepo->checkPassword($params);
        $response = $this->withSession(['account' => $account])
             ->call('GET', '/account/logout');
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'msg' => 'logout success',
                 ]);

        $response = $this->get('/account/isLogin');
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => false,
                     'msg' => 'not login',
                 ]);
    }

    public function testAppleTokenGet() {
        $accountRepo = new AccountRepository();
        $params = [
            'account' => 'account2',
            'password' => '123456',
        ];
        $account = $accountRepo->checkPassword($params);
        $response = $this->withSession(['account' => $account])
             ->call('GET', '/account/apple-token/get');
        //print_r($response->decodeResponseJson());
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     "msg" => '取得成功',
                     'appleToken' => '',
                 ]);
    }

    public function testAppleTokenSet() {
        $accountRepo = new AccountRepository();
        $params = [
            'account' => 'account2',
            'password' => '123456',
        ];
        $account = $accountRepo->checkPassword($params);

        $paramsSet = [
            'appleToken' => 'qwcideasb',
            'tokenMode' => 1,
        ];
        $response = $this->withSession(['account' => $account])
             ->call('POST', '/account/apple-token/set', $paramsSet);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     "msg" => '設定成功',
                 ]);

        $response = $this->call('GET', '/account/apple-token/get');
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     "msg" => '取得成功',
                     'appleToken' => 'qwcideasb',
                 ]);
    }
}
