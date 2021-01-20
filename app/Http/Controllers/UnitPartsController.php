<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitParts;

class UnitPartsController extends Controller
{
    public function getUnits()
    {
        return response()->json(['status' => true, 'units' => UnitParts::all()]);
    }

    public function getOneUnit($id)
    {
        return response()->json(['status' => true, 'unit' => UnitParts::find($id)]);
    }

    public function create(Request $request)
    {
        $checks = UnitParts::all();
        foreach ($checks as $check) {
            if ($check->name == $request->input('name')) {
                return response()->json(['status' => false]);
            }
        }
        $item = new UnitParts;
        $item->name = $request->input('name');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function update(Request $request, $id)
    {
        $item = UnitParts::find($id);
        $item->name = $request->input('name');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function delete($id)
    {
        $item = UnitParts::find($id);
        return response()->json(['status' => false , 'msg' => $item]);
        // if (count($item->stockParts) > 0 || count($item->productParts) > 0) {
        //     return response()->json(['status' => false]);
        // } else {
        //     $item->delete();
        //     return response()->json(['status' => true]);
        // }
    }
}
