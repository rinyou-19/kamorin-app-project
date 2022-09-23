<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use Exception;
use Illuminate\Http\Request;

class updateController extends Controller
{
    public function update(Request $request) {
        try {
            $id = $request->id;

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

            return response()->json(['result' => true]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
    }
}
