<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        switch (Auth::user()->status) {
            case 0:
                return redirect()->intended('report/dashBoard');
            case 1:
                return redirect()->intended('/manage/users');
            default:
                return redirect('/');
        }
    }
}
