<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealerSessionController extends Controller
{
    public function getSessionDealer(Request $request)
    {
        $branch_data = [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
        ];

        $request->session()->forget('dealer');
        $request->session()->push('dealer', $branch_data);

        return response()->json(['status' => true]);
    }

    public function removeSessionDealer(Request $request)
    {
        $request->session()->forget('dealer');
        return response()->json(['status' => true]);
    }
    //
}
