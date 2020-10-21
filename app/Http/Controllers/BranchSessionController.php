<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BranchSessionController extends Controller
{
    public function getSessionBranch(Request $request)
    {
        $branch_data = [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
        ];

        $request->session()->forget('branch');
        $request->session()->push('branch', $branch_data);

        return response()->json(['status' => true]);
    }

    public function removeSessionBranch(Request $request)
    {
        $request->session()->forget('branch');
        return response()->json(['status' => true]);
    }
    //
}
