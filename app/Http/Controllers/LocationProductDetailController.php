<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\LocationProductDetail;
use Illuminate\Http\Request;

class LocationProductDetailController extends Controller
{
    function getDetails(Request $request)
    {
        $status_op = [
            'Working',
            'maintenance',
            'Setup',
        ];
        $dataSet = [
            'location' => Location::all(),
            'product' => LocationProduct::all(),
            'detail' => LocationProductDetail::with(['location', 'locationProduct'])->get(),
            'option' => $status_op,
        ];
        return response()->json(['status' => true, 'dataSet' => $dataSet]);
    }

    function getOneDetail($id)
    {
        return response()->json(['status' => true, 'product' => LocationProductDetail::find($id)]);
    }

    function create(Request $request)
    {
        $item = new LocationProductDetail;
        $item->location_product_id = $request->input('location_product_id');
        $item->code = $request->input('code');
        $item->location_id = $request->input('location_id');
        $item->latitude = $request->input('latitude');
        $item->longitude = $request->input('longitude');
        $item->status = $request->input('status');
        $item->sku = $request->input('sku');

        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    function update(Request $request, $id)
    {
        $item = LocationProductDetail::find($id);
        $item->location_product_id = $request->input('location_product_id');
        $item->location_id = $request->input('location_id');
        $item->code = $request->input('code');
        $item->latitude = $request->input('latitude');
        $item->longitude = $request->input('longitude');
        $item->sku = $request->input('sku');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    function changeStatus(Request $request, $id)
    {
        $item = LocationProductDetail::find($id);
        $item->status = $request->input('status');

        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    function delete($id)
    {
        LocationProductDetail::find($id)->delete();
        return response()->json(['status' => true]);
    }
    //
}
