<?php

namespace App\Http\Controllers;

use App\Models\StockCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $branch_id = session()->get('branch')[0]['id'];
        return response()->json(['status' => true, 'categories' => StockCategory::where('stock_branch_id', $branch_id)->get()]);
    }

    public function getCategory($id)
    {
        return response()->json(['status' => true, 'category' => StockCategory::find($id)]);
    }

    public function create(Request $request)
    {
        $item = new StockCategory;
        $item->name = $request->input('name');
        $item->stock_branch_id = $request->input('stock_branch_id');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function update(Request $request, $id)
    {
        $item = StockCategory::find($id);
        $item->name = $request->input('name');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function delete($id)
    {
        $item = StockCategory::find($id);
        if (count($item->parts) > 0 ){
            return response()->json(['status' => false]);
        }else{
            $item->delete();
            return response()->json(['status' => true]);
        }

    }


    //
    //
}
