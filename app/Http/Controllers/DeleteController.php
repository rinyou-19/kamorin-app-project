<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use Exception;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete(Request $request) {
        try {
            $id = $request->id;

            $purchase = purchase::where('id', $id)->first();

            // 削除実行
            $purchase->delete();

            return response()->json(['result' => true]);
        } catch (Exception $e) {
            return response()->json(['result' => false]);
        }
    }
}
