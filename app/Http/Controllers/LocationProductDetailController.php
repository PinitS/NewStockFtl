<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\LocationProductDetail;
use App\Models\LocationProductList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            'detail' => Location::with(['productLists', 'productLists.locationProductDetails' ,'productLists.locationProduct.locationModel'  , 'productLists.locationProduct'])->findOrFail(Session::get('customer')[0]['id']),
            'option' => $status_op,
        ];
        return response()->json(['status' => true, 'dataSet' => $dataSet]);
    }

    function getOneDetail($id)
    {
        return response()->json(['status' => true, 'product' => LocationProductDetail::with('locationProductList')->find($id)]);
    }

    function getAllDetail()
    {
        return response()->json(['status' => true, 'product' => LocationProductDetail::all()]);
    }

    function create(Request $request)
    {
        $ssid = session()->get('customer')[0]['id'];
        $customer = Location::find($ssid);

        for ($i = 0; $i < ($request->quantity); $i++) {
            $time = Carbon::now();
            $genCode = str_replace('-', '', $time);
            $genCode = str_replace(' ', '', $genCode);
            $genCode = str_replace(':', '', $genCode);

            $item_list = new LocationProductList;
            $item_list->location_id = $customer->id;
            $item_list->location_product_id = $request->input('location_product_id');

            if ($item_list->save()) {
                $item = new LocationProductDetail;
                $item->location_product_list_id = $item_list->id;
                $item->code = $i.$genCode;
                $item->latitude = $customer->latitude;
                $item->longitude = $customer->longitude;
                $item->status = 2;
                $item->sku = "#";
                $item->save();
            }
        }
        return response()->json(['status' => true]);
    }

    function update(Request $request, $id)
    {
        $item = LocationProductDetail::find($id);
        $item->code = $request->input('code');
        $item->latitude = $request->input('latitude');
        $item->longitude = $request->input('longitude');
        $item->sku = $request->input('sku');
        if ($item->save()) {
            $item_location_list = LocationProductList::find($id);
            $item_location_list->location_id = $request->input('location_id');
            $item_location_list->save();
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
        LocationProductList::find($id)->delete();
        return response()->json(['status' => true]);
    }
    //
}
