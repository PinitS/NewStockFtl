<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockBranch;

class BranchController extends Controller
{
    public function getBranches()
    {
        return response()->json(['status' => true, 'branch' => StockBranch::all()]);
    }

    public function getBranch($id)
    {
        return response()->json(['status' => true, 'branch' => StockBranch::find($id)]);
    }

    public function create(Request $request)
    {
        $item = new StockBranch;
        $item->name = $request->input('name');
        $item->phone_number->input('phone_number');
        $item->latitude->input('latitude');
        $item->longitude->input('longitude');
//        18.816235, 98.982101

        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function update(Request $request, $id)
    {
        $item = StockBranch::find($id);
        $item->name = $request->input('name');
        $item->phone_number->input('phone_number');
        $item->latitude->input('latitude');
        $item->longitude->input('longitude');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function delete($id)
    {
        StockBranch::find($id)->delete();
        return response()->json(['status' => true]);
    }
}
