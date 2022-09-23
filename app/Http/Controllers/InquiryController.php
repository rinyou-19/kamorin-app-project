<?php

namespace App\Http\Controllers;


use App\Models\purchase;
use Exception;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function getData(Request $request) {

        try {
            // 検索条件を取得
            $dateFrom = $request->dateFrom === null ? 20000101 : $request->dateFrom;
            $dateTo = $request->dateTo === null ? 21191231 : $request->dateTo;
            $userName = $request->userName;

            $query = purchase::query();
            $data = $query->where("user", "=", $userName)->where("race_day", ">=", $dateFrom)->where("race_day", "<=", $dateTo)->orderBy("race_day")->get();

            return response()->json(['result' => true, 'data' => $data]);
        } catch(Exception $e) {
            return response()->json(['result' => false]);
        }
    }
}
