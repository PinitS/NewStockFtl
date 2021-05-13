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

        $sum_cost = $product->sum_cost * $value;

        foreach ($product->productParts as $part) {
            $use_quantity = $part->quantity * $value;
            $use_quantity_unit = $part->quantity;
            $partQuantity = 0;

            if($part->groupPart->stockParts != null){
                foreach ($part->groupPart->stockParts as $stockPart) {
                    $partQuantity += $stockPart->quantity;
                }
            }

            $sum = $use_quantity - $partQuantity;
            $data = [
                'part_name' => $part->groupPart->name,
                'use_quantity_unit' => $use_quantity_unit,
                'use_quantity' => $use_quantity,
                'unit' => ($part->groupPart == null ? '-' :$part->groupPart->name),
                'stock_quantity' => $partQuantity,
                'sum' => $sum > 0 ? $sum : 0,
            ];
            array_push($stockParts, $data);
        }
        return response()->json(['status' => true, 'stockParts' => $stockParts , 'sum_cost' => number_format($sum_cost)]);
    }
}
