<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Javascript;

class UserJavascriptController extends Controller
{
    public function index()
    {
        $javascript = Javascript::all();
        return view('users.javascript', compact('javascript'));
    }
}
