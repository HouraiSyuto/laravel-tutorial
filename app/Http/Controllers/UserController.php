<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $param = ['user' => Auth::user()->name];
        $items = DB::select('select name from users where name = :user', $param);
        return view('users/name-change', ['items' => $items]);

    }

    public function edit(Request $request)
    {


        return redirect()->route('home');
    }
}
