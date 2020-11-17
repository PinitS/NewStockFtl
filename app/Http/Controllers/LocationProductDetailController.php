<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\LocationProductDetail;
use App\Models\LocationProductList;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

        $data = [];

        $lists = LocationProductList::where('location_id', Session::get('customer')[0]['id'])->get();
        foreach ($lists as $list) {
            foreach ($list->locationProductDetails as $detail) {
                $local_data = [
                    'id' => $detail->id,
                    'code' => $detail->code,
                    'product_name' => $detail->locationProductList ? ($detail->locationProductList->locationProduct ? $detail->locationProductList->locationProduct->name : null) : null,
                    'model_name' => $detail->locationProductList ? ($detail->locationProductList->locationProduct ? ($detail->locationProductList->locationProduct->locationModel ? $detail->locationProductList->locationProduct->locationModel->name : null) : null) : null,
                    'latitude' => $detail->latitude,
                    'longitude' => $detail->longitude,
                    'status' => $detail->status,
                    'dealer_name' => $detail->dealer ? $detail->dealer->name : null,
                    'sku' => $detail->sku
                ];
                array_push($data, $local_data);
            }
        }


        $dataSet = [
            'detail' => $data,

//            'detail' => Location::with(['productLists', 'productLists.locationProductDetails', 'productLists.locationProduct.locationModel', 'productLists.locationProduct', 'productLists.locationProductDetails.dealer'])->findOrFail(Session::get('customer')[0]['id']),
            'option' => $status_op,
        ];
        return response()->json(['status' => true, 'dataSet' => $dataSet]);

    }

    function getDropdown()
    {
        $dataSet = [
            'location' => Location::all(),
            'product' => LocationProduct::all(),
        ];
        return response()->json(['status' => true, 'dataSet' => $dataSet]);
    }

    function getOneDetail($id)
    {
        return response()->json(['status' => true, 'product' => LocationProductDetail::with('locationProductList')->find($id)]);
    }

    function getFilter()
    {
        $status_op = [
            'Working',
            'maintenance',
            'Setup',
        ];
        $dataSet = [
            'customer' => Location::all(),
            'product' => LocationProduct::all(),
            'status' => $status_op,
        ];
        return response()->json(['status' => true, 'dataSet' => $dataSet]);
    }

    function getAllDetail(Request $request)
    {
        $customer_id = (int)$request->input('customer_id');
        $product_id = (int)$request->input('product_id');
        $status_id = $request->input('status_id');

        $has_query = false;

        if ($customer_id != '' && $customer_id != 0) {
            $product_lists = LocationProductList::where('location_id', $customer_id);
            $has_query = true;
        }

        if ($product_id != '' && $product_id != 0) {
            if ($has_query) {
                $product_lists = $product_lists->where('location_product_id', $product_id);
            } else {
                $product_lists = LocationProductList::where('location_product_id', $product_id);
            }
            $has_query = true;
        }

        if ($status_id != '' && $status_id != 10) {
            $status_id = (int)$status_id;
            if ($has_query) {
                $product_lists = $product_lists->whereHas('locationProductDetails', function (Builder $query) use ($status_id) {
                    $query->where('status', $status_id);
                });

            } else {
                $product_lists = LocationProductList::whereHas('locationProductDetails', function (Builder $query) use ($status_id) {
                    $query->where('status', $status_id);
                });
            }
            $has_query = true;
        }
        if (!$has_query) {
            $product_lists = LocationProductList::with(['locationProductDetails', 'location', 'locationProduct'])->get();
        } else {
            $product_lists = $product_lists->with(['locationProductDetails', 'location', 'locationProduct'])->get();
        }

        $listSet = [];

        foreach ($product_lists as $list) {
            foreach ($list->locationProductDetails as $detail) {
                $listData = [
                    'serial' => $detail->code,
                    'customer' => $list->location->name,
                    'phone_number' => $list->phone_number,
                    'product' => $list->locationProduct->name,
                    'latitude' => $list->location->latitude,
                    'longitude' => $list->location->longitude,
                    'status' => $detail->status,
                ];
                array_push($listSet, $listData);
            }
        }

        return response()->json(['status' => true, 'product' => $listSet]);
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
                $item->code = $i . $genCode;
                $item->latitude = $customer->latitude;
                $item->longitude = $customer->longitude;
                $item->dealer_id = $request->input('dealers_id');
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
