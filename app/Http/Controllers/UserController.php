<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditUser;

class UserController extends Controller
{
    public function index()
    {
        $param = ['user' => Auth::user()->name];
        $item = User::where('name',$param)->first();
        return view('users/name_change', ['item' => $item]);
    }

    public function edit(EditUser $request)
    {
        $user = User::find($request->id);
        $user->name = $request->changename;
        $user->save();
        return redirect()->route('home');
    }
}
