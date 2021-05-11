<?php

namespace App\Http\Controllers;

use App\Models\GroupParts;
use App\Models\Location;
use App\Models\LocationModel;
use App\Models\LocationProduct;
use App\Models\ProductPart;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class LocationProductController extends Controller
{
    function getProducts(Request $request)
    {
        $dataSet = [
            'group' => GroupParts::all(),
            'model' => LocationModel::all(),
            'product' => LocationProduct::with('locationModel')->get(),
        ];
        return response()->json(['status' => true, 'dataSet' => $dataSet]);
    }

    function getOneProduct($id)
    {
        return response()->json(['status' => true, 'product' => LocationProduct::find($id)]);
    }

    function create(Request $request)
    {

        $file = $request->file('img_path');
        if($file != 'undefined'){
            $filename = $file->hashName('uploads/');
            $file->move('uploads', $filename);
            $img = Image::make($filename);
            $img->resize(640, 480, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
        }else{
            $filename = null;
        }
        $path = $filename;


        $item = new LocationProduct;
        $item->location_model_id = $request->input('model_id');
        $item->img_path = $path;
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->description = $request->input('description');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    function update(Request $request, $id)
    {
        $item = LocationProduct::find($id);
        $file = $request->file('img_path');

        if($file != 'undefined'){
            File::delete($item->img_path);
            $filename = $file->hashName('uploads/');
            $file->move('uploads', $filename);
            $img = Image::make($filename);
            $img->resize(640, 480, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
        }else{
            $filename = $item->img_path;
        }
        $path = $filename;
        $item->location_model_id = $request->input('model_id');
        $item->name = $request->input('name');
        $item->img_path = $path;
        $item->price = $request->input('price');
        $item->description = $request->input('description');
        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    function delete($id)
    {
        $item = LocationProduct::find($id);
        File::delete($item->img_path);
        if (count($item->locationProductLists) > 0) {
            return response()->json(['status' => false]);
        } else {
            $item->delete();
            ProductPart::where('location_product_id', $id)->delete();
            return response()->json(['status' => true]);
        }
    }
}
