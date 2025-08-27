<?php

namespace App\Http\Controllers;

use App\Models\Python;

class UserPythonController extends Controller
{
    public function index()
    {
        $python = Python::all();
        return view('users.python', compact('python'));
    }
}
