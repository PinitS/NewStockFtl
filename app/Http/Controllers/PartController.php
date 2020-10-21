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
            $Parts = StockPart::with(['category', 'branch'])->where('stock_branch_id', $branch_id)->get();
        } else {
            $Parts = StockPart::with(['category', 'branch'])
                ->where('stock_branch_id', $branch_id)
                ->where('stock_category_id', $filter)
                ->get();
        }
        $dataSet = [
            'group' => GroupParts::all(),
            'categories' => StockCategory::where('stock_branch_id', $branch_id)->get(),
            'parts' => $Parts,
        ];
        return response()->json(['status' => true, 'dataSet' => $dataSet]);
    }

    function getOnePart($id)
    {
        return response()->json(['status' => true, 'part' => StockPart::find($id)]);
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
        $item_history->detail = ($request->input('type') == 0 ? 'Imported ' : 'Withdraw ') . $item->name . ' Quantity ' . $request->input('quantity') . ' #' . $request->input('description');
        $item_history->user_id = Auth::id();
        $item_history->save();

        $this->calQuantity($item->id);
        return response()->json(['status' => true]);
    }

    function create(Request $request)
    {
        $checks = StockPart::all();
        foreach ($checks as $check)
        {
            if($check->name == $request->input('name') && $check->stock_branch_id == $request->input('stock_branch_id'))
            {
                return response()->json(['status' => false]);
            }
        }
        if ($request->input('group_id') == 0) {
            $item_group = new GroupParts;
            $item_group->name = $request->input('name');
            $item_group->save();
            $group_id = $item_group->id;
        } else {
            $group_id = $request->input('group_id');
        }
        $item = new StockPart;
        $item->name = $request->input('name');
        $item->group_part_id = $group_id;
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
                $item_history->detail = 'New Part  ' . $item->name . ' Quantity ' . $item->quantity;
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
        if ($request->input('group_id') == 0) {
            $item_group = new GroupParts;
            $item_group->name = $request->input('name');
            $item_group->save();
            $group_id = $item_group->id;
        } else {
            $group_id = $request->input('group_id');
        }

        $item = StockPart::find($id);
        $item->name = $request->input('name');
        $item->group_part_id = $group_id;
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
        $partHistory = StockPartHistory::with(['part', 'user'])
            ->where('stock_part_id', $id)->get();
        return response()->json(['status' => true, 'partHistory' => $partHistory]);
    }

    function delete($id)
    {
        StockPart::find($id)->delete();
        StockPartHistory::where('stock_part_id', $id)->delete();
        return response()->json(['status' => true]);
    }
}
