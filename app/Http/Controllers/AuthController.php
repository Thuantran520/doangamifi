<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegistrationForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'username' => 'required|string|max:100|unique:users,username',
            'phone' => 'nullable|string|max:15',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
<<<<<<< HEAD
            'phone' => $data['phone'] ?? null,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Đăng ký thành công!',
            'token' => $token,
            'user' => $user
        ], 201);

        // Thong bao trung
        if (User::where('email', $data['email'])->exists()) {
            return response()->json([
                'message' => 'Email đã tồn tại.'
            ], 409); // 409 Conflict
        }
        elseif (User::where('username', $data['username'])->exists()) {
            return response()->json([
                'message' => 'Username đã tồn tại.'
            ], 409); // 409 Conflict
        }

        Auth::login($user);
        return redirect('/dashboard');
    
=======
            'phone' => $data['phone'],
        ]);

        Auth::login($user);
        return redirect('/dashboard');
>>>>>>> origin/main
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

<<<<<<< HEAD
        $user = User::where('email', $request->email)->first();
         if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email hoặc mật khẩu không chính xác.'
            ], 401); // 401 Unauthorized
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Đăng nhập thành công!',
            'token' => $token,
            'user' => $user
        ]);
    }


=======
        return back()->withErrors(['email' => 'Sai email hoặc mật khẩu']);
    }

>>>>>>> origin/main
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
