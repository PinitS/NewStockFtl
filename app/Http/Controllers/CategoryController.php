<?php

namespace App\Http\Controllers;

use App\Models\StockCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        return response()->json(['status' => true, 'categories' => StockCategory::all()]);
    }

    public function getCategory($id)
    {
        return response()->json(['status' => true, 'category' => StockCategory::find($id)]);
    }

    public function create(Request $request)
    {
        $item = new StockCategory;
        $item->name = $request->input('name');
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
        StockCategory::find($id)->delete();
        return response()->json(['status' => true]);
    }


    //
    //
}
