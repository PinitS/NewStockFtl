<?php

namespace App\Http\Controllers;

use App\Models\GroupParts;
use App\Models\ProductPart;

use Illuminate\Http\Request;

class ProductPartsController extends Controller
{
    public function getProductParts($id)
    {

//        $productParts = ProductPart::with(['locationProduct', 'groupPart'])
//            ->where('location_product_id', $id)->get();
//        return response()->json(['status' => true, 'productParts' => $productParts]);
        $items = ProductPart::where('location_product_id', $id)->get();
        $dataSet = [];
        foreach ($items as $item) {
            $data = [
                'id' => $item->id,
                'group_part' => ($item->groupPart == null ? '-' : $item->groupPart->name),
                'quantity' => $item->quantity,
                'unit' => (($item->groupPart == null ? '-' : ($item->groupPart->unitPart == null ? '-' : $item->groupPart->unitPart->name)))
            ];
            array_push($dataSet, $data);
        }
        return response()->json(['status' => true, 'productParts' => $dataSet]);

    }

    public function getOneProductParts($id)
    {
        return response()->json(['status' => true, 'productParts' => ProductPart::find($id)]);
    }

    public function create(Request $request)
    {
        $ProductParts = ProductPart::all();

        foreach ($ProductParts as $ProductPart) {
            if ($ProductPart->location_product_id == $request->input('product_id') && $ProductPart->group_part_id == $request->input('group_part_id')) {
                return response()->json(['status' => false]);
            }
        }
        $item = new ProductPart;
        $item->location_product_id = $request->input('product_id');
        $item->group_part_id = $request->input('group_part_id');
        $item->quantity = $request->input('quantity');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function update(Request $request, $id)
    {
        $item = ProductPart::find($id);
        $item->quantity = $request->input('quantity');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function delete(Request $request, $id)
    {
        ProductPart::find($id)->delete();
        return response()->json(['status' => true]);
    }
}
