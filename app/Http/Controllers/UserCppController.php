<?php

namespace App\Http\Controllers;

use App\Models\Cpp;

class UserCppController extends Controller
{
    public function index()
    {
        $cpp = Cpp::all();
        return view('users.cpp', compact('cpp'));
    }
}
