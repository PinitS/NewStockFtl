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
        return response()->json(['status' => true, 'groups' => GroupParts::all()]);
    }

    public function getOneGroup($id)
    {
        return response()->json(['status' => true, 'group' => GroupParts::find($id)]);
    }

    public function update(Request $request, $id)
    {
        $item = GroupParts::find($id);
        $item->name = $request->input('name');
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
