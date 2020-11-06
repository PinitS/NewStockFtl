<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function getDealers()
    {
        return response()->json(['status' => true, 'dataSet' => 'getDealers']);
    }

    public function getOneDealer($id)
    {
        return response()->json(['status' => true, 'dataSet' => 'getOneDealer']);
    }

    public function update(Request $request)
    {
        return response()->json(['status' => true, 'dataSet' => 'update']);
    }

    public function destroy($id)
    {
        return response()->json(['status' => true, 'dataSet' => 'destroy']);
    }
}
