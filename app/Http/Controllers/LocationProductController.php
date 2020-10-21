<?php

namespace App\Http\Controllers;

use App\Models\GroupParts;
use App\Models\Location;
use App\Models\LocationModel;
use App\Models\LocationProduct;
use Illuminate\Http\Request;

class LocationProductController extends Controller
{
    function getProducts(Request $request)
    {
        $dataSet = [
            'group' => GroupParts::all(),
            'model' => LocationModel::all(),
            'product' => LocationProduct::with( 'locationModel')->get(),
        ];
        return response()->json(['status' => true, 'dataSet' => $dataSet]);
    }

    function getOneProduct($id)
    {
        return response()->json(['status' => true, 'product' => LocationProduct::find($id)]);
    }

    function create(Request $request)
    {
        $item = new LocationProduct;
        $item->model_id = $request->input('model_id');
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    function update(Request $request, $id)
    {
        $item = LocationProduct::find($id);
        $item->model_id = $request->input('model_id');
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    function delete($id)
    {
        LocationProduct::find($id)->delete();
        return response()->json(['status' => true]);
    }
}
