<?php

namespace App\Http\Controllers;

use App\Models\GroupParts;
use App\Models\StockBranch;
use App\Models\StockCategory;
use App\Models\StockPart;
use App\Models\StockPartHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartController extends Controller
{
    function getParts(Request $request)
    {
        $branch_id = session()->get('branch')[0]['id'];
        $filter = $request->input('filter_category_id');
        if ($filter == 0) {
            $parts = StockPart::where('stock_branch_id', $branch_id)->get();
        } else {
            $parts = StockPart::where('stock_branch_id', $branch_id)
                ->where('stock_category_id', $filter)
                ->get();
        }
        $partSet = [];
        foreach ($parts as $part) {
            $partData = [
                'id' => $part->id,
                'name' => ($part->groupPart == null ? null : $part->groupPart->name),
                'category' => ($part->category == null ? null : $part->category->name),
                'sku' => $part->sku,
                'branch' => ($part->branch == null ? null : $part->branch->name),
                'quantity' => $part->quantity,
                'unit' => (($part->groupPart == null ? '-' : ($part->groupPart->unitPart == null ? '-' : $part->groupPart->unitPart->name)))
            ];
            array_push($partSet, $partData);
        }
        $dataSet = [
            'group' => GroupParts::all(),
            'categories' => StockCategory::where('stock_branch_id', $branch_id)->get(),
            'parts' => $partSet,
        ];
        return response()->json(['status' => true, 'dataSet' => $dataSet]);
    }

    function getOnePart($id)
    {
        $oneParts = StockPart::find($id);
        $parts = [
            'group_part_id' => $oneParts->group_part_id,
            'stock_category_id' => $oneParts->stock_category_id,
            'sku' => $oneParts->sku,
            'quantity' => $oneParts->quantity,

        ];
        return response()->json(['status' => true, 'part' => $parts]);
    }

    private function calQuantity($stock_part_id)
    {
        $part = StockPart::findOrFail($stock_part_id);
        $quantity = 0;
        foreach ($part->histories as $history) {
            if ($history->type == 0) {
                $quantity += $history->quantity;
            } else {
                $quantity -= $history->quantity;
            }
        }
        $part->quantity = $quantity;
        $part->save();
    }

    function changeQuantity(Request $request, $id)
    {
        $item = StockPart::find($id);
        $item_history = new StockPartHistory();
        $item_history->stock_part_id = $item->id;
        $item_history->type = $request->input('type');
        $item_history->quantity = $request->input('quantity');
        $item_history->detail = ($request->input('type') == 0 ? 'Imported ' : 'Withdraw ') . $item->groupPart->name . ' Quantity ' . $request->input('quantity') . ' #' . $request->input('description');
        $item_history->user_id = Auth::id();
        $item_history->save();

        $this->calQuantity($item->id);
        return response()->json(['status' => true]);
    }

    function create(Request $request)
    {
        $checks = StockPart::all();
        foreach ($checks as $check) {
            if ($check->group_part_id == $request->input('group_id') && $check->stock_branch_id == $request->input('stock_branch_id')) {
                return response()->json(['status' => false]);
            }
        }
        $item = new StockPart;
        $item->group_part_id = $request->input('group_id');
        $item->stock_category_id = $request->input('stock_category_id');
        $item->stock_branch_id = $request->input('stock_branch_id');
        $item->quantity = $request->input('quantity');
        $item->sku = $request->input('sku');
        if ($item->save()) {
            if ($item->quantity > 0) {
                $item_history = new StockPartHistory();
                $item_history->stock_part_id = $item->id;
                $item_history->type = 0;
                $item_history->quantity = $item->quantity;
                $item_history->detail = 'New Part  ' . $item->groupPart->name . ' Quantity ' . $item->quantity;
                $item_history->user_id = Auth::id();
                $item_history->save();
            }
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    function update(Request $request, $id)
    {
        $checks = StockPart::all();
        foreach ($checks as $check) {
            if ($check->id == $id && $check->group_part_id == $request->input('group_id')) {
                break;
            } else if ($check->group_part_id == $request->input('group_id') && $check->stock_branch_id == $request->input('stock_branch_id')) {
                return response()->json(['status' => false]);
            }
        }

        $item = StockPart::find($id);
        $item->group_part_id = $request->input('group_id');
        $item->stock_category_id = $request->input('stock_category_id');
        $item->sku = $request->input('sku');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    function getPartHistory($id)
    {
        $historys = StockPartHistory::where('stock_part_id', $id)->get();
        $historySet = [];
        foreach ($historys as $history) {
            $historyData = [
                'id' => $history->id,
                'part' => ($history->part == null ? null : $history->part->groupPart->name),
                'type' => $history->type,
                'user' => ($history->user == null ? null : $history->user->name),
                'updated_at' => $history->updated_at,
                'quantity' => $history->quantity,
                'unit' => ($history->part == null ? '-' : ($history->part->groupPart == null ? '-' : ($history->part->groupPart->unitPart == null ? '-' : $history->part->groupPart->unitPart->name))),
                'detail' => $history->detail,
            ];
            array_push($historySet, $historyData);
        }
        return response()->json(['status' => true, 'partHistory' => $historySet]);
    }

    function delete($id)
    {
        StockPart::find($id)->delete();
        StockPartHistory::where('stock_part_id', $id)->delete();
        return response()->json(['status' => true]);
    }

    public function getOneInHistory($id)
    {
        $item = StockPartHistory::find($id);
        return response()->json(['status' => true, 'partsHistory' => $item]);
    }

    public function updateOneHistory(Request $request, $id)
    {
        $item = StockPartHistory::find($id);
        $item->quantity = $request->input('quantity');
        $item->detail = "***Edit*** Quantity" . $request->input('quantity');
        $item->save();
        $this->calQuantity($item->stock_part_id);
        return response()->json(['status' => true]);
    }
}
