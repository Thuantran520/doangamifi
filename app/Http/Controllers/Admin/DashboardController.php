<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }
    public function launcher()
    {
        $python = \App\Models\Python::all();
        return view('admin.launcher', compact('python'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công!');
    }
}
