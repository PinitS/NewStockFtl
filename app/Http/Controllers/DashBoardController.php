<?php

namespace App\Http\Controllers;

use App\Models\StockPart;
use App\Models\StockPartHistory;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function getDataHistory($id)
    {
        $historys = StockPartHistory::where('stock_part_id', $id)->get();
        $stockHistory = [];
        $stockQuantity = 0;

        for ($i = 1; $i <= 12; $i++) {
            foreach ($historys as $history) {
                $month = $history->created_at->month;
                if ($month == $i) {
                    if ($history->type == 0) {
                        $stockQuantity += $history->quantity;
                    } else {
                        $stockQuantity -= $history->quantity;
                    }
                }
            }
            array_push($stockHistory, $stockQuantity);
        }
        return response()->json(['status' => true, 'data' => $stockHistory]);
    }

    public function getPartsByBranch($id)
    {
        $parts = StockPart::where('stock_branch_id' , $id)->get();
        return response()->json(['status' => true, 'parts' => $parts]);
    }

    public function getTimeline()
    {
        $stockHistoryTimeline = StockPartHistory::with('user')
            ->orderBy('id' , 'DESC')
            ->take(10)
            ->get();
        return response()->json(['status' => true, 'dataTimeline' => $stockHistoryTimeline]);
    }
}
