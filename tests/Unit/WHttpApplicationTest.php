<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\AccountRepository;
use App\Repositories\RecordRepository;

class WHttpApplicationTest extends TestCase
{
    public function testCreate() {
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

        /*
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
        $record = $recordRepo->getById(21);
        Storage::disk('uploads')->assertExists($record->CustGIDPicture1);
        Storage::disk('uploads')->delete($record->CustGIDPicture1);
         */
    }

    public function testCancel() {
        $accountRepo = new AccountRepository();
        $params = [
            'account' => 'account1',
            'password' => '123456',
        ];
        $account = $accountRepo->checkPassword($params);
        $this->withSession(['account' => $account]);

        $params = [
            'recordId' => 1041,
        ];
        $response = $this->call('POST', '/application/cancel', $params);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => false,
                     "message" => '案件不存在',
                 ]);

        $params = [
            'recordId' => 18,
        ];
        $response = $this->call('POST', '/application/cancel', $params);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     "message" => 'cancel success',
                 ]);
    }

    public function testUpdate() {
        $accountRepo = new AccountRepository();
        $recordRepo = new RecordRepository();

        $params = [
            'account' => 'account1',
            'password' => '123456',
        ];
        $account = $accountRepo->checkPassword($params);
        $this->withSession(['account' => $account]);

        $updateParams1 = [
        ];
        $response = $this->call('POST', '/application/update', $updateParams1);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => false,
                     "message" => [
                         "recordId" => [
                             "The record id field is required."
                         ],
                     ],
                 ]);

        $updateParams2 = [
            'recordId' => 1044,
        ];
        $response = $this->call('POST', '/application/update', $updateParams2);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => false,
                     "message" => '案件不存在',
                 ]);

        $updateParams3 = [
            'recordId' => 17,
             "CustGIDPicture1" => UploadedFile::fake()->image('img.jpg'),
        ];
        $response = $this->call('POST', '/application/update', $updateParams3);
        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     "message" => 'success',
                 ]);
        $record = $recordRepo->getById(17);
        Storage::disk('uploads')->assertExists($record->CustGIDPicture1);
        Storage::disk('uploads')->delete($record->CustGIDPicture1);
    }
}
