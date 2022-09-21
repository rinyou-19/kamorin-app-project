<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntryUserController extends Controller
{
    public function entryUser(Request $request)
    {
        try {
            // ユーザー名とパスワードを取得
            $userName = $request->userName;
            $password = $request->password;
            $email = $request->password;

            // トランザクション開始
            DB::beginTransaction();

            // modelクラスのインスタンスを生成
            $user = new User();

            // 暗号化方式
            $method = 'aes-128-cbc';

            // パスワード
            $password = 'password1234';

            // 方式に応じたIV(初期化ベクトル)に必要な長さを取得
            $ivLength = openssl_cipher_iv_length($method);
 
            // IV を自動生成
            $iv = openssl_random_pseudo_bytes($ivLength);

            // OPENSSL_RAW_DATA と OPENSSL_ZERO_PADDING を指定可
            $options = 0;
 
            // 暗号化
            $encrypted = openssl_encrypt($password, $method, $password, $options, $iv);

            // データベースにデータを登録
            $user->create([
                "name" => $userName,
                "password" => $encrypted,
                "email" => $email,
            ]);

            // コミット
            DB::commit();

            return response()->json(['result' => true]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
    }
}
