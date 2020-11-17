<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function getDealers()
    {
        $dealers = Dealer::get();
        $dealerSet = [];
        foreach ($dealers as $dealer) {
            $dealerData = [
                'name' => $dealer->name,
                'id' => $dealer->id,
                'contact_name' => $dealer->contact_name,
                'phone_number' => $dealer->phone_number,
                'latitude' => $dealer->latitude,
                'longitude' => $dealer->longitude,
                'address' => $dealer->address,
                'delete_active' => $dealer->delete_active,
            ];
            array_push($dealerSet,$dealerData);
        }
        return response()->json(['status' => true, 'dealers' => $dealerSet]);
    }

    public function getOneDealer($id)
    {
        return response()->json(['status' => true, 'dealer' => Dealer::find($id)]);
    }

    public function create(Request $request)
    {
        $item = new Dealer;
        $item->name = $request->input('name');
        $item->contact_name = $request->input('contact_name');
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
        $item = Dealer::find($id);
        $item->name = $request->input('name');
        $item->contact_name = $request->input('contact_name');
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
        $item = Dealer::find($id);
        if (count($item->locationProductDetail) > 0) {
            return response()->json(['status' => false]);
        } else {
            $item->delete();
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => true, 'dataSet' => 'destroy']);
    }
}
