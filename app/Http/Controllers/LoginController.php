<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            // // ユーザー名とパスワードを取得
            $name = $request->userName;
            $password = $request->password;

            // データを取得
            $item = User::where('name', $name)->where('password', $password)->first();

            // データの取得結果を返却する
            if ($item !== null && $item->exists === true) {
                return response()->json(['result' => true]);
            }
            return response()->json(['result' => false]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
    }
}
