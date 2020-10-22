<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerSessionController extends Controller
{
    public function getSessionCustomer(Request $request)
    {
        $customer_data = [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
        ];
        $request->session()->forget('customer');

        $request->session()->push('customer', $customer_data);
        return response()->json(['status' => $customer_data]);
    }

    public function removeSessionCustomer(Request $request)
    {
        $request->session()->forget('customer');
        return response()->json(['status' => true]);
    }
    //
}
