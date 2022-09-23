<?php

namespace App\Http\Controllers;

use App\Mail\TwoFactorAuthPassword;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TwoFactorAuthController extends Controller
{
    public function sendPassword(Request $request) {

        try {
            $userName = $request->userName;
            // ランダムのパスワード
            $random_password = '';

            // 6桁のランダムの文字列を生成
            for($i = 0 ; $i < 6 ; $i++) {
                $random_password .= strval(rand(0, 9));
            }

            $user = User::where('name', $userName)->first();
            // ランダムの文字列と有効期限をセット
            $user->tfa_token = $random_password;
            // 有効期限を3分に設定
            $user->tfa_expiration = now()->addMinutes(3);
            $user->save();

            // メール送信
            Mail::send(new TwoFactorAuthPassword($random_password, $user->email, $user->name));
            return true;
        } catch(Exception $e) {
            return false;
        }
    }

    public function auth(Request $request) {

        try {
            $userName = $request->userName;
            $user = User::where('name', $userName)->first();
            $expiration = new Carbon($user->tfa_expiration);

            if ($user->tfa_token == $request->password && $expiration > now()) {
                $user->tfa_token = null;
                $user->tfa_expiration = null;
                $user->save();

                return response()->json(['result' => true]);
            }

            return response()->json(['result' => false]);
        } catch(Exception $e) {
            return response()->json(['result' => false]);
        }
    }
}
