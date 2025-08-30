<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegistrationForm() {
        if (Auth::check()) {
            return redirect()->route('launcher');
        }
        return view('auth.register');
    }

    public function register(\App\Http\Requests\RegisterRequest $request) {
        $data = $request->validated();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'phone'    => $data['phone'] ?? null,
        ]);

        event(new Registered($user)); // gửi mail verify

        // API: không login session, trả token + trạng thái
        if ($request->expectsJson() || $request->is('api/*')) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message'          => 'Đăng ký thành công. Kiểm tra email để xác thực.',
                'token'            => $token,
                'user'             => $user,
                'email_verified'   => false,
            ], 201);
        }

        // WEB: đăng nhập rồi đi tới trang yêu cầu xác thực
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('verification.notice')
            ->with('status','Tài khoản tạo thành công. Vui lòng xác thực email.');
    }

    public function showLoginForm() {
        if (Auth::check()) {
            return redirect()->route('launcher');
        }
        return view('auth.login');
    }

    public function login(\App\Http\Requests\LoginRequest $request) {
        // API
        if ($request->expectsJson() || $request->is('api/*')) {
            $payload = $request->validated();
            $user = User::where('email', $payload['email'])->first();

            if (!$user || !Hash::check($payload['password'], $user->password)) {
                return response()->json(['message' => 'Email hoặc mật khẩu không chính xác.'], 401);
            }

            // (Tuỳ chọn) chặn nếu chưa verify
            if (!$user->hasVerifiedEmail()) {
                return response()->json([
                    'message' => 'Email chưa xác thực.',
                    'email_verified' => false
                ], 403);
            }

            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json([
                'message'        => 'Đăng nhập thành công!',
                'token'          => $token,
                'user'           => $user,
                'email_verified' => true,
            ]);
        }

        // WEB
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            // Xóa url.intended (nếu có) để không redirect về trang trước đó
            $request->session()->forget('url.intended');

            // Ghi log cho mục đích debug
            logger()->info('login: cleared url.intended after regenerate', [
                'user_id' => auth()->id(),
                'intended_now' => session('url.intended', null),
            ]);

            $user = $request->user();

            if (!$user->hasVerifiedEmail()) {
                return redirect()->route('verification.notice')
                    ->with('status','Vui lòng xác thực email trước.');
            }

            if (($user->role ?? null) === 'admin') {
                return redirect()->route('admin.launcher')->with('success','Đăng nhập thành công!');
            }

            return redirect()->route('launcher')->with('success','Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Sai email hoặc mật khẩu']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Đăng xuất thành công!');
    }
}
