<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function entry(Request $request)
    {
        try {
            // 登録情報を取得
            $purchaseDate = $request->purchaseDate;
            $grade = $request->grade;
            $raceCourse = $request->raceCourse;
            $raceName = $request->raceName;
            $course = $request->course;
            $distance = $request->distance;
            $purchase_m = $request->purchase;
            $returnMoney = $request->returnMoney;
            $balance = $request->balance;
            $axisHorse = $request->axisHorse;
            $jockey = $request->jockey;
            $purchaseMathod = $request->purchaseMathod;
            $father = $request->father;
            $motherFather = $request->motherFather;
            $condition = $request->condition;
            $userName = $request->userName;

            // トランザクション開始
            DB::beginTransaction();

            // modelクラスのインスタンスを生成
            $purchase = new purchase();

            // データベースにデータを登録
            $purchase->create([
                "race_day" => $purchaseDate,
                "race_course" => $raceCourse,
                "grade" => $grade,
                "race_name" => $raceName,
                "dirt_or_turf" => $course,
                "distance" => $distance,
                "purchase_m" => $purchase_m,
                "return_m" => $returnMoney,
                "balance_m" => $balance,
                "axis_h" => $axisHorse,
                "purchase_method" => $purchaseMathod,
                "jockey" => $jockey,
                "father" => $father,
                "mother_father" => $motherFather,
                "condition_course" => $condition,
                "user" => $userName,
            ]);

            // コミット
            DB::commit();

            return response()->json(['result' => true]);
        } catch (Exception $e) {
            // ロールバック
            DB::rollBack();
            return response()->json(['result' => false, 'message' => $e]);
        }
    }
}
