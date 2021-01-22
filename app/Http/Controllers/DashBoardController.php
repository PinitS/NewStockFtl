<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\GroupParts;
use App\Models\Location;
use App\Models\LocationProduct;
use App\Models\StockPart;
use App\Models\StockPartHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function getDataHistory($id)
    {
        $historys = StockPartHistory::where('stock_part_id', $id)->get();
        $stockHistory = [];
        $stockQuantity = 0;

        for ($i = 1; $i <= 12; $i++) {
            foreach ($historys as $history) {
                $month = $history->created_at->month;
                if ($month == $i) {
                    if ($history->type == 0) {
                        $stockQuantity += $history->quantity;
                    } else {
                        $stockQuantity -= $history->quantity;
                    }
                }
            }
            array_push($stockHistory, $stockQuantity);
        }
        return response()->json(['status' => true, 'data' => $stockHistory]);
    }

    public function getPartsByBranch($id)
    {
        $parts = StockPart::with('groupPart')->where('stock_branch_id', $id)->get();

        return response()->json(['status' => true, 'parts' => $parts]);
    }

    public function getDashBoard()
    {
        $stockHistoryTimeline = StockPartHistory::with('user')
            ->orderBy('id', 'DESC')
            ->take(6)
            ->get();
        $customersData = Location::get();
        $customerSet = [];

        foreach ($customersData as $customer) {
            $dataCustomer = [
                'name' => $customer->name,
                'contact_name' => $customer->contact_name,
                'phone_number' => $customer->phone_number,
                'cnt' => count($customer->productLists),
            ];
            array_push($customerSet, $dataCustomer);
        }

        $dealersData = Dealer::get();
        $dealerSet = [];
        foreach ($dealersData as $dealer) {
            $dataDealer = [
                'name' => $dealer->name,
                'contact_name' => $dealer->contact_name,
                'phone_number' => $dealer->phone_number,
                'cnt' => count($dealer->locationProductDetail),
            ];
            array_push($dealerSet, $dataDealer);
        }

        $parts = StockPart::get();
        $partSet = [];
        foreach ($parts as $part) {
            $dataParts = [
                'name' => $part->groupPart->name,
                'unit' => ($part->groupPart == null ? '-' : ($part->groupPart->unitPart == null ? '-' : $part->groupPart->unitPart->name)),
                'category' => $part->category->name,
                'quantity' => $part->quantity,
                'branch' => $part->branch->name,
                'sku' => $part->sku,
            ];
            array_push($partSet , $dataParts);

        }
        $products = LocationProduct::get();
        $cntSet = [];
        $productNameSet = [];
        $colorSet = [];
        $color = [
            'rgba(255, 99, 132)',
            'rgba(54, 162, 235)',
            'rgba(255, 206, 86)',
            'rgba(75, 192, 192)',
            'rgba(153, 102, 255)',
        ];
        $indexColor = 0;
        foreach ($products as $product) {
            if (!empty($color[$indexColor])) {
                $local_color = $color[$indexColor];
            } else {
                $indexColor = 0;
                $local_color = $color[0];
            }
            $indexColor++;
            $cntProduct = $product->locationProductLists->count();
            array_push($colorSet, $local_color);
            array_push($cntSet, $cntProduct);
            array_push($productNameSet, $product->name);
        }

        $dataGroup = [];
        $groupParts = GroupParts::get();
        foreach ($groupParts as $part) {
            $quantity = 0;
            $data = [];
            foreach ($part->stockParts as $part) {
                $quantity += $part->quantity;
            }
            $data = [
                'name' => ($part->groupPart == null ? $part->name : $part->groupPart->name),
                'unit' => ($part->groupPart == null ? '-' : ($part->groupPart->unitPart == null ? '-' : $part->groupPart->unitPart->name)),
                'quantity' => $quantity,
            ];
            array_push($dataGroup, $data);
        }

        $dataSet = [
            'dataTimeline' => $stockHistoryTimeline,
            'customer' => $customerSet,
            'dataParts' => $partSet,
            'dataGroup' => $dataGroup,
            'cntProduct' => $cntSet,
            'productNameSet' => $productNameSet,
            'color' => $colorSet,
            'dealer' => $dealerSet,
        ];
        return response()->json(['status' => true, 'dataSet' => $dataSet]);
    }
}
