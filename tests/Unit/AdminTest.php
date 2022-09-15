<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\AdminRepository;
use Exception;

class AdminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckPassword() {
        $adminRepo = new AdminRepository();
        $test1Params = [
            'account' => 'aaaaa',
            'password' => 'bbbbbbb',
        ];
        $test1Result = $adminRepo->checkPassword($test1Params);
        $this->assertFalse($test1Result);

        $test2Params = [
            'account' => 'admin',
            'password' => '123456',
        ];
        $test2Result = $adminRepo->checkPassword($test2Params);
        $this->assertEquals(1, $test2Result->id);
        $this->assertEquals(1, $test2Result->active);
        $this->assertEquals('管理者', $test2Result->name);
        $this->assertEquals('0912342134', $test2Result->phone);
        $this->assertEquals('adm123@test.com.tw', $test2Result->email);

    }

    public function testUpdatePassword() {
        $adminRepo = new AdminRepository();

        $test1Params = [
            'account' => 'admin',
            'passwordOld' => '22222',
            'password' => '12345678',
        ];
        try {
            $adminRepo->updatePassword($test1Params);
        }
        catch(Exception $e) {
            $this->assertEquals('舊密碼輸入錯誤', $e->getMessage());
        }

        $test2Params = [
            'account' => 'admin',
            'passwordOld' => '123456',
            'password' => '12345678',
        ];
        try {
            $adminRepo->updatePassword($test2Params);
        }
        catch(Exception $e) {
            $this->assertEquals('updatePassword error', $e->getMessage());
        }
        $this->assertTrue(true);

        $test3Params = [
            'account' => 'admin',
            'passwordOld' => '12345678',
            'password' => '123456',
        ];
        try {
            $adminRepo->updatePassword($test3Params);
        }
        catch(Exception $e) {
            $this->assertEquals('updatePassword error', $e->getMessage());
        }
        $this->assertTrue(true);
    }
}
