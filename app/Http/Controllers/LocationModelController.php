<?php

namespace App\Http\Controllers;

use App\Models\LocationModel;
use Illuminate\Http\Request;

class LocationModelController extends Controller
{
    public function getLocationModels()
    {
        return response()->json(['status' => true, 'locationModel' => LocationModel::all()]);
    }

    public function getOneLocationModel($id)
    {
        return response()->json(['status' => true, 'locationModel' => LocationModel::find($id)]);
    }

    public function create(Request $request)
    {
        $item = new LocationModel;
        $item->name = $request->input('name');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function update(Request $request, $id)
    {
        $item = LocationModel::find($id);
        $item->name = $request->input('name');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function delete($id)
    {
        LocationModel::find($id)->delete();
        return response()->json(['status' => true]);
    }
    //
}
