<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyseController extends Controller
{
    public function summary(Request $request)
    {

        try {
            // 検索条件を取得
            $monthFrom = $request->monthFrom === null ? 200001 : $request->monthFrom;
            $monthTo = $request->monthTo === null ? 219912 : $request->monthTo;

            // SQLを直接実行する
            $summarys = DB::select('select sum(purchase_m) as total_purchase,
                                           sum(return_m) as total_return,
                                           sum(balance_m) as total_balance,
                                           substring(race_day, 1, 6) as purchase_month
                                    from purchases
                                    where substring(race_day, 1, 6) between ? and ?
                                    group by substring(race_day, 1, 6)
                                    order by purchase_month', [$monthFrom, $monthTo]);


            return response()->json(['result' => true, 'data' => $summarys]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
    }
}
