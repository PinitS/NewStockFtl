<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        if (Auth::user()->active == 1) {
            switch (Auth::user()->status) {
                case 0:
                    return redirect()->intended('report/dashBoard');
                case 1:
//                    return redirect()->intended('/manage/users');
                    return redirect()->intended('report/dashBoard');
                default:
                    return redirect('/');
            }
        } else {
            Auth::logout();
            return redirect('/')->with( ['status' => 'The user is not active!!'] );
        }
    }
}
