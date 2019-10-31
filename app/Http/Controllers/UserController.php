<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('users/name-change');

    }

    public function edit(Request $request)
    {


        return redirect()->route('home');
    }
}
