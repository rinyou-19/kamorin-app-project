<?php

namespace Tests\Unit;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        // ログインページへのアクセス
        $this->post('/login', ['userName' => "test", 'password' => "test"])->assertStatus(200);
        // ログイン処理(成功時)
        $this->post('/login', ['userName' => "test", 'password' => "test"])->assertExactJson(
            ['result' => true]
        );
        // ログイン処理(失敗①)
        $this->post('/login', ['userName' => "tes", 'password' => "test"])->assertExactJson(
            ['result' => false]
        );
        // ログイン処理(失敗時②)
        $this->post('/login', ['userName' => "test", 'password' => "tes"])->assertExactJson(
            ['result' => false]
        );
    }
}
