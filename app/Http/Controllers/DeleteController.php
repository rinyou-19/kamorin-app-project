<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function delete(Request $request) {
        try {
            $id = $request->id;

            // トランザクション開始
            DB::beginTransaction();

            $purchase = purchase::where('id', $id)->first();

            // 削除実行
            $purchase->delete();

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
