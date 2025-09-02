<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $user->makeHidden(['password']);
            return view('dashboard', compact('user'));
        }
        return redirect()->route('login');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if(!$user){
            return redirect()->route('login');
        }
        $request -> validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user->name =$request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->hasFile('avatar')) {
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }
        $user->save();
        return redirect()->back()->with('success', 'Cập nhật thông tin thành công.');
    }
}
