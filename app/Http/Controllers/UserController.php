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
        $items = DB::select('select * from users where name = :user', $param);
        return view('users/name_change', ['items' => $items]);

    }

    public function edit(Request $request)
    {

        $param = [
            'id' => $request->id,
            'name' => $request->changename,
        ];
        DB::update('update users set name =:name where id = :id', $param);
        return redirect()->route('home');
    }
}
