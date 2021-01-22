<?php

namespace App\Http\Controllers;

use App\Models\GroupParts;
use App\Models\Location;
use App\Models\ProductPart;
use App\Models\StockPart;
use Illuminate\Http\Request;

class GroupPartsController extends Controller
{
    public function getGroups()
    {
        $items = GroupParts::all();
        $dataSet = [];
        foreach ($items as $item) {
            $data = [
                'id' => $item->id,
                'name' => $item->name,
                'unit' => ($item->unitPart == null ? '-' : $item->unitPart->name),
                'delete_active' => $item->delete_active,
            ];
            array_push($dataSet, $data);
        }
        return response()->json(['status' => true, 'groups' => $dataSet]);
    }

    public function getOneGroup($id)
    {
        $item = GroupParts::find($id);
        $dataSet = [
            'id' => $item->id,
            'name' => $item->name,
            'unit_id' => $item->unit_parts_id,
            'unit' => ($item->unitPart == null ? '-' : $item->unitPart->name),
        ];
        return response()->json(['status' => true, 'group' => $dataSet]);
    }

    public function create(Request $request)
    {
        $checks = GroupParts::all();
        foreach ($checks as $check) {
            if ($check->name == $request->input('name')) {
                return response()->json(['status' => false]);
            }
        }
        $item = new GroupParts;
        $item->name = $request->input('name');
        $item->unit_parts_id = $request->input('unit');

        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function update(Request $request, $id)
    {
        $item = GroupParts::find($id);
        $item->name = $request->input('name');
        $item->unit_parts_id = $request->input('unit');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function delete($id)
    {
        $item = GroupParts::find($id);
        if (count($item->stockParts) > 0 || count($item->productParts) > 0) {
            return response()->json(['status' => false]);
        } else {
            $item->delete();
            return response()->json(['status' => true]);
        }
    }
    //
}
