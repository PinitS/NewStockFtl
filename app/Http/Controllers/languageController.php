<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class languageController extends Controller
{
    public function setLocale($locale)
    {
        Session::put('locale', $locale);
        return response()->json(['status' => true,]);
    }
    //
}
