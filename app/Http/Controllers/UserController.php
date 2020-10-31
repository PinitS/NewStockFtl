<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UseResetPasswordRequest;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function getUsers()
    {
        $userData = User::where('id' , '!=' , Auth::user()->id)->get();
        return response()->json(['status' => true, 'userData' => $userData]);
    }

    public function getOneUser($id)
    {
        return response()->json(['status' => true, 'userData' => User::find($id)]);
    }

    public function create(UserRequest $request)
    {
        $item = new User;
        $item->name = $request->input('name');
        $item->email = $request->input('email');
        $item->password = bcrypt($request->input('password'));
        $item->status = 0;

        if ($item->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function update(UserRequest $request, $id)
    {
        $item = User::find($id);
        $item->name = $request->input('name');
        $item->email = $request->input('email');
        $item->status = $request->input('status');
        if ($item->save()) {
            return response()->json(['status' => true, 'userData' => User::find($id)]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function resetPassword(UseResetPasswordRequest $request, $id)
    {
        $item = User::find($id);
        $item->password = bcrypt($request->input('password'));
        if ($item->save()) {
            return response()->json(['status' => true, 'userData' => User::find($id)]);
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return response()->json(['status' => true]);
    }


    //
}
