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
            $email = $request->email;

            // トランザクション開始
            DB::beginTransaction();

            // modelクラスのインスタンスを生成
            $user = new User();

            $hashPassowrd = password_hash($password, PASSWORD_BCRYPT);

            // データベースにデータを登録
            $user->create([
                "name" => $userName,
                "password" => $hashPassowrd,
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
