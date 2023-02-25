<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class updateController extends Controller
{
    public function update(Request $request) {
        try {
            $id = $request->id;

            // トランザクション開始
            DB::beginTransaction();

            $purchase = purchase::where('id', $id)->first();

            // 更新データをセット
            $purchase->race_day = $request->purchaseDate;
            $purchase->race_course = $request->raceCourse;
            $purchase->grade = $request->grade;
            $purchase->race_name = $request->raceName;
            $purchase->dirt_or_turf = $request->course;
            $purchase->distance = $request->distance;
            $purchase->purchase_m = $request->purchase;
            $purchase->return_m = $request->returnMoney;
            $purchase->balance_m = $request->balance;
            $purchase->axis_h = $request->axisHorse;
            $purchase->purchase_method = $request->purchaseMathod;
            $purchase->jockey = $request->jockey;
            $purchase->father = $request->father;
            $purchase->mother_father = $request->motherFather;
            $purchase->condition_course = $request->condition;
            $purchase->save();

            // コミット
            DB::commit();

            return response()->json(['result' => true]);
        } catch (Exception $e) {
            // ロールバック
            DB::rollBack();
            return response()->json(['result' => false]);
        }
    }
}
