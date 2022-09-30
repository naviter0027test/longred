<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\AccountRepository;

class WHttpApplicationTest extends TestCase
{
    public function testCreate()
    {
        $accountRepo = new AccountRepository();
        $params = [
            'account' => 'account1',
            'password' => '123456',
        ];
        $account = $accountRepo->checkPassword($params);
        $this->withSession(['account' => $account]);

        $createParams1 = [
        ];
        $response = $this->call('POST', '/application/create', $createParams1);
        //print_r($response->decodeResponseJson());
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => false,
                     "message" => [
                         "applicant" => [
                             "The applicant field is required."
                         ],
                         "CustGID" => [
                             "The cust g i d field is required."
                         ],
                         "CustGIDPicture1" => [
                             "The cust g i d picture1 field is required."
                         ],
                         "CustGIDPicture2" => [
                             "The cust g i d picture2 field is required."
                         ],
                         "applyUploadPath" => [
                             "The apply upload path field is required."
                         ]
                     ]
                 ]);

        $createParams2 = [
            'applicant' => '陳泰生',
            'CustGID' => 'A154943977',
        ];
        $response = $this->call('POST', '/application/create', $createParams2);
        //print_r($response->decodeResponseJson());
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => false,
                     "message" => [
                         "CustGIDPicture1" => [
                             "The cust g i d picture1 field is required."
                         ],
                         "CustGIDPicture2" => [
                             "The cust g i d picture2 field is required."
                         ],
                         "applyUploadPath" => [
                             "The apply upload path field is required."
                         ]
                     ]
                 ]);

        $createParams3 = [
            'applicant' => '陳泰生',
            'CustGID' => 'A154943977',
             "CustGIDPicture1" => UploadedFile::fake()->image('img.jpg'),
             "CustGIDPicture2" => UploadedFile::fake()->image('img.jpg'),
             "applyUploadPath" => UploadedFile::fake()->image('img.jpg'),
        ];
        $response = $this->call('POST', '/application/create', $createParams3);
        //print_r($response->decodeResponseJson());
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     "message" => 'success',
                 ]);
    }
}
