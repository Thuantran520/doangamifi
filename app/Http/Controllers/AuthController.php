<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Lesson;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegistrationForm() {
        return view('auth.register');
    }

    public function register(\App\Http\Requests\RegisterRequest $request) {
        $data = $request->validated();

        //$verificationCode = Str::random(5);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'username' => $data['username'],
            'phone'    => $data['phone'] ?? null,
            //'email_verification_code' => $verificationCode,
        ]);

        // 3) API: trả token; WEB: đăng nhập + chuyển trang
        if ($request->expectsJson() || $request->is('api/*')) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Đăng ký thành công!',
                'token'   => $token,
                'user'    => $user,
            ], 201);
        }

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
    }


    public function showLoginForm() { return view('auth.login'); }

    public function login(\App\Http\Requests\LoginRequest $request) {
        if ($request->expectsJson() || $request->is('api/*')) {
            $payload = $request->validated();

            $user = User::where('email', $payload['email'])->first();
            if (!$user || !Hash::check($payload['password'], $user->password)) {
               return response()->json(['message' => 'Email hoặc mật khẩu không chính xác.'], 401);
            }

            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json([
                'message' => 'Đăng nhập thành công!',
                'token'   => $token,
                'user'    => $user,
            ]);
        }

        $credentials = $request->validated();
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = request()->user();

            if(($user->role ?? null) === 'admin') {
                return redirect()-> route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
            }
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
        }
        return back()->withErrors(['email' => 'Sai email hoặc mật khẩu']);
        }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
