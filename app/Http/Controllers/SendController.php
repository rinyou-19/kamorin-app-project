<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendController extends Controller
{
    public function send(Request $request)
    {
        try {
            // パラメータの設定
            // 問合せ内容をメールに登録
            $name = $request->sentName;
            $category = $request->category;
            $email = $request->email;
            $detail = $request->detail;

            // トランザクション開始
            DB::beginTransaction();

            // 問合せデータを登録
            // modelクラスのインスタンスを生成
            $contact = new Contact();

            $contact->create([
                "name" => $name,
                "category" => $category,
                "email" => $email,
                "detail" => $detail,
            ]);
            
            // メール送信
            Mail::send(new SendMail($name, $email, env('MAIL_FROM_ADDRESS')));

            // コミット
            DB::commit();

            return response()->json(['result' => true]);
        } catch (Exception $e) {
            
            
            return response()->json(['result' => false]);
        }
    }
}
