<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\LessonController;

Route::get('/', function () {
    return view('launcher');
}) -> name('launcher');

Route::get('/launcher', function () {
    return view('launcher');
}) -> name('launcher');

// ĐÚNG (tên rõ ràng, Laravel khuyên dùng)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// TEST
Route::get('/test-insert', function () {
    $u = \App\Models\User::create([
        'name' => 'Demo',
        'email' => 'demo'.mt_rand(1000,9999).'@gmail.com',
        'password' => bcrypt('123456'),
        'username' => 'demo'.mt_rand(1000,9999),
        'phone' => null,
    ]);
    return $u;
});

// routes/web.php (tạm test)
Route::get('/whoami', fn() => response()->json([
  'id'   => auth()->id(),
  'user' => auth()->user()?->only(['id','email','role']),
]));


// Cho admin
Route::prefix('admin')->middleware(['auth', 'can:admin'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

// Cho hoc sinh

Route::middleware('auth')->group(function (){
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

// Đăng xuất
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/user/update', [UserDashboardController::class, 'update'])->name('user.update');

Route::get('/lessons', [LessonController::class, 'index'])->name('lesson');