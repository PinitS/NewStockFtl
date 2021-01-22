<?php

namespace App\Http\Controllers;

use App\Models\ProductPart;
use App\Models\LocationProduct;

;

use Illuminate\Http\Request;

class CalProductsController extends Controller
{
    public function getCalProducts()
    {
        $items = LocationProduct::all();
        $dataSet = [];
        foreach ($items as $item) {
            $data = [
                'id' => $item->id,
                'name' => $item->name,
            ];
            array_push($dataSet, $data);
        }
        return response()->json(['status' => true, 'locationProduct' => $dataSet]);
    }

    public function getCalProductParts($id, $value)
    {
        $product = LocationProduct::findOrFail($id);

        $stockParts = [];
        foreach ($product->productParts as $part) {
            $use_quantity = $part->quantity * $value;
            $use_quantity_unit = $part->quantity;
            $part = $part->groupPart;
            $partQuantity = 0;
            foreach ($part->stockParts as $stockPart) {
                $partQuantity += $stockPart->quantity;
            }
            $sum = $use_quantity - $partQuantity;
            $data = [
                'part_name' => $part->name,
                'use_quantity_unit' => $use_quantity_unit,
                'use_quantity' => $use_quantity,
                'unit' => ($stockPart->groupPart->unitPart == null ? '-' : $stockPart->groupPart->unitPart->name),
                'stock_quantity' => $partQuantity,
                'sum' => $sum > 0 ? $sum : 0,
            ];
            array_push($stockParts, $data);
        }
        return response()->json(['status' => true, 'stockParts' => $stockParts]);
    }
}
