<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\AccountRepository;

class WHttpAccountTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
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
}
