<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getLocations()
    {
        return response()->json(['status' => true, 'location' => Location::all()]);
    }

    public function getOneLocation($id)
    {
        return response()->json(['status' => true, 'location' => Location::find($id)]);
    }

    public function create(Request $request)
    {
        $item = new Location;
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

    public function update(Request $request, $id)
    {
        $item = Location::find($id);
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
        Location::find($id)->delete();
        return response()->json(['status' => true]);
    }
    //
}
