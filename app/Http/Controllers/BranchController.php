<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockBranch;
use App\Http\Requests\BranchRequest;


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

    public function create(BranchRequest $request)
    {
        $item = new StockBranch;
        $item->name = $request->input('name');
        $item->phone_number = $request->input('phone_number');
        $item->latitude = $request->input('latitude');
        $item->longitude = $request->input('longitude');
        $item->address = $request->input('address');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function update(BranchRequest $request, $id)
    {
        $item = StockBranch::find($id);
        $item->name = $request->input('name');
        $item->phone_number = $request->input('phone_number');
        $item->latitude = $request->input('latitude');
        $item->longitude = $request->input('longitude');
        $item->address = $request->input('address');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function delete($id)
    {
        $item = StockBranch::find($id);
        if (count($item->parts) > 0 || count($item->categories) > 0){
            return response()->json(['status' => false]);
        }else{
            $item->delete();
            return response()->json(['status' => true]);
        }
    }
}
