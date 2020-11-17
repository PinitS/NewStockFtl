<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Location;
use App\Models\DealerProduct;
use App\Models\DealerProductHistory;
use App\Models\LocationProductDetail;
use App\Models\LocationProductList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealerProductController extends Controller
{
    public function getDealerProductById($id)
    {
        $DealerProduct = DealerProduct::with('locationProduct')->where('dealer_id', $id)->get();
        return response()->json(['status' => true, 'dealerProduct' => $DealerProduct]);
    }

    public function getProductInDealer($id, $dId)
    {
        $product = DealerProduct::with('locationProduct')->where('location_product_id', $id)
            ->where('dealer_id', $dId)
            ->first();
        return response()->json(['status' => true, 'product' => $product]);
    }

    public function getDealerProductHistory($id)
    {
        $history = DealerProductHistory::with('user')->where('dealer_product_id', $id)->get();
        return response()->json(['status' => true, 'history' => $history]);
    }

    public function create(Request $request)
    {
        $checks = DealerProduct::all();
        foreach ($checks as $check) {
            if ($check->location_product_id == $request->input('location_product_id') && $check->dealer_id == $request->input('dealer_id')) {
                return response()->json(['status' => false]);
            }
        }
        $item = new DealerProduct;
        $item->location_product_id = $request->input('location_product_id');
        $item->dealer_id = $request->input('dealer_id');
        $item->quantity = $request->input('quantity');
        if ($item->save()) {
            $item_history = new DealerProductHistory;
            $item_history->dealer_product_id = $item->id;
            $item_history->type = 0;
            $item_history->quantity = $item->quantity;
            $item_history->detail = 'New Part  ' . $request->input('product_name') . ' Quantity ' . $item->quantity;
            $item_history->user_id = Auth::id();
            if ($item_history->save()) {
                return response()->json(['status' => true]);
            } else {
                return response()->json(['status' => false]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }


    private function calQuantity($id)
    {
        $item = DealerProduct::findOrFail($id);
        $quantity = 0;
        foreach ($item->dealerProductHistory as $history) {
            if ($history->type == 0) {
                $quantity += $history->quantity;
            } else {
                $quantity -= $history->quantity;
            }
        }
        $item->quantity = $quantity;
        $item->save();
    }


    public function addQuantity(Request $request, $id)
    {
        $item = DealerProduct::with('locationProduct')->find($id);
        $item_history = new DealerProductHistory;
        $item_history->dealer_product_id = $item->id;
        $item_history->type = 0;
        $item_history->quantity = $request->input('quantity');
        $item_history->detail = 'Imported  ' . $item->locationProduct->name . ' Quantity ' . $request->input('quantity') . '#' . $request->input('description');
        $item_history->user_id = Auth::id();
        $item_history->save();
        $this->calQuantity($item->id);
        return response()->json(['status' => true]);
    }

    public function delete($id)
    {
        $item = DealerProduct::find($id);
        if (count($item->dealerProductHistory) > 0) {
            $item->delete();
            DealerProductHistory::where('dealer_product_id', $id)->delete();
            return response()->json(['status' => true]);
        }
    }

    public function getDropdownSell()
    {
        $dataSet = [
            'customer' => Location::all(),
            'dealer' => Dealer::all(),
        ];
        return response()->json(['status' => true, 'dataSet' => $dataSet]);
    }

    public function getDropdownSellProduct($id)
    {
        $productDealer = DealerProduct::with('locationProduct')->where('dealer_id', $id)->get();
        $dataProduct = [];
        foreach ($productDealer as $product) {
            $localData = [
                'id' => $product->locationProduct ? $product->locationProduct->id : null,
                'name' => $product->locationProduct ? $product->locationProduct->name : null,
                'quantity' => $product->quantity,
            ];
            array_push($dataProduct, $localData);
        }
        return response()->json(['status' => true, 'productDealer' => $dataProduct]);
    }

    public function dealerSold(Request $request)
    {
        $item = DealerProduct::where('location_product_id', $request->input('location_product_id'))
            ->where('dealer_id', $request->input('dealer_id'))
            ->first();
        $customer = Location::find($request->input('customer_id'));

        if ($item->quantity < $request->input('quantity')) {
            return response()->json(['status' => false, 'msg' => 'Quantity to much']);
        } else {
            for ($i = 0; $i < ($request->input('quantity')); $i++) {
                $time = Carbon::now();
                $genCode = str_replace('-', '', $time);
                $genCode = str_replace(' ', '', $genCode);
                $genCode = str_replace(':', '', $genCode);

                $item_list = new LocationProductList;
                $item_list->location_id = $customer->id;
                $item_list->location_product_id = $request->input('location_product_id');
                if ($item_list->save()) {
                    $item_location = new LocationProductDetail;
                    $item_location->location_product_list_id = $item_list->id;
                    $item_location->code = $i . $genCode;
                    $item_location->latitude = $customer->latitude;
                    $item_location->longitude = $customer->longitude;
                    $item_location->dealer_id = $request->input('dealer_id');
                    $item_location->status = 2;
                    $item_location->sku = "#";
                    $item_location->save();
                }
            }

            $item_history = new DealerProductHistory;
            $item_history->dealer_product_id = $item->id;
            $item_history->type = 1;
            $item_history->quantity = $request->input('quantity');
            $item_history->detail = 'Sold  ' . $item->locationProduct->name . ' Quantity ' . $request->input('quantity');
            $item_history->user_id = Auth::id();
            $item_history->save();
            $this->calQuantity($item->id);
            return response()->json(['status' => true, 'item' => $item, 'request' => $request->all()]);
        }
    }

}
