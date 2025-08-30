<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserPythonController;
use App\Http\Controllers\Admin\PythonController as AdminPythonController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\QuizPythonController; 
use App\Http\Controllers\Admin\QuizPythonController as AdminQuizPythonController;
use App\Http\Controllers\Admin\CppController as AdminCppController;
use App\Http\Controllers\UserCppController;
use App\Http\Controllers\Admin\JavascriptController as AdminJavascriptController;
use App\Http\Controllers\UserJavascriptController;
use App\Http\Controllers\QuizCppController;
use App\Http\Controllers\QuizJavascriptController;
use App\Http\Controllers\Admin\QuizCppController as AdminQuizCppController;
use App\Http\Controllers\Admin\QuizJavascriptController as AdminQuizJavascriptController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;


Route::get('/', function () {
    return view('launcher');
})->name('launcher');



// Đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login.form');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');

// Đăng ký
Route::get('/register', [AuthController::class, 'showRegistrationForm'])
    ->middleware('guest')
    ->name('register.form');
Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest')
    ->name('register');


//Route::post('/verify-email', [AuthController::class, 'verifyEmail'])->name('verify.email');

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
    Route::get('/launcher', [AdminDashboardController::class, 'launcher'])->name('admin.launcher');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/lesson', function () {
        return view('admin.lesson', [
            'python' => \App\Models\Python::all(),
            'cpp' => \App\Models\Cpp::all(),
            'javascript' => \App\Models\Javascript::all()
        ]);
    })->name('admin.lesson');
    Route::resource('python', AdminPythonController::class, ['as' => 'admin']);
    Route::resource('cpp', AdminCppController::class, ['as' => 'admin']);
    Route::post('cpp/upload', [AdminCppController::class, 'upload'])->name('admin.cpp.upload');
    Route::resource('users', AdminUserController::class, ['as' => 'admin']);
    Route::resource('quizpython', AdminQuizPythonController::class, ['as' => 'admin']);
    Route::post('quizpython/upload', [AdminQuizPythonController::class, 'upload'])->name('admin.quizpython.upload');
    Route::post('python/upload', [AdminPythonController::class, 'upload'])->name('admin.python.upload');
    Route::resource('javascript', AdminJavascriptController::class, ['as' => 'admin']);
    Route::post('javascript/upload', [AdminJavascriptController::class, 'upload'])->name('admin.javascript.upload');
    Route::resource('quizcpp', AdminQuizCppController::class, ['as' => 'admin']);
    Route::post('quizcpp/upload', [AdminQuizCppController::class, 'upload'])->name('admin.quizcpp.upload');

    Route::resource('quizjavascript', AdminQuizJavascriptController::class, ['as' => 'admin']);
    Route::post('quizjavascript/upload', [AdminQuizJavascriptController::class, 'upload'])->name('admin.quizjavascript.upload');
});



// Cho hoc sinh

Route::middleware('auth')->group(function (){
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/lesson', function () {
        return view('lesson');
    })->name('lesson');
    Route::get('/python', [UserPythonController::class, 'index'])->name('python');
    Route::get('/cpp', [UserCppController::class, 'index'])->name('cpp');
    Route::resource('quizpython', QuizPythonController::class);
    Route::resource('quizcpp', QuizCppController::class);
    Route::resource('quizjavascript', QuizJavascriptController::class);
    Route::get('/javascript', [UserJavascriptController::class, 'index'])->name('javascript');
});


// Đăng xuất
Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/user/update', [UserDashboardController::class, 'update'])->name('user.update');
Route::post('/quizpython/submit', [QuizPythonController::class, 'submit'])->name('quizpython.submit');
Route::get('/quizpython/create', [QuizPythonController::class, 'create'])->name('quizpython.create');
Route::get('/practice', function () {
    return view('practice');
})->name('practice');
Route::post('/quizcpp/submit', [QuizCppController::class, 'submit'])->name('quizcpp.submit');
Route::get('/quizcpp/create', [QuizCppController::class, 'create'])->name('quizcpp.create');
Route::post('/quizjavascript/submit', [QuizJavascriptController::class, 'submit'])->name('quizjavascript.submit');
Route::get('/quizjavascript/create', [QuizJavascriptController::class, 'create'])->name('quizjavascript.create');


Route::get('/choose-quiz', function () {
    return view('Quizchoicetopic');
})->name('choose.quiz');

Route::get('/choose-quiz-admin', function () {
    return view('admin.quizchoiceedit');
})->name('admin.choose.quiz');


/* --- Email verification routes --- */
Route::get('/email/verify', fn() => view('verification.notice'))
  ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('launcher')->with('status','Email đã xác thực!');
})->middleware(['auth','signed','throttle:6,1'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    if ($request->user()->hasVerifiedEmail()) {
        return back()->with('status','Email đã xác thực.');
    }
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status','Đã gửi lại email xác thực.');
})->middleware(['auth','throttle:3,5'])->name('verification.send');


// Password Reset Routes...

// Hiển thị form nhập email
Route::get('/forgot-password', function () {
    return view('auth.password.email');
})->middleware('guest')->name('password.request');

// Xử lý gửi email reset
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink($request->only('email'));
    return $status == Password::RESET_LINK_SENT
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.email');

// Hiển thị form đổi mật khẩu (từ link email)
Route::get('/reset-password/{token}', function ($token, Request $request) {
    $email = $request->query('email');
    return view('auth.password.reset', ['token' => $token, 'email' => $email]);
})->middleware('guest')->name('password.reset');

// Xử lý đổi mật khẩu
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill(['password' => Hash::make($password)])->save();
        }
    );
    return $status == Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::middleware('auth')->get('/attempts', function () {
    $attempts = \App\Models\QuizAttempt::where('user_id', auth()->id())
        ->orderByDesc('created_at')
        ->paginate(20);
    return view('attempts.index', compact('attempts'));
})->name('attempts.index');


// Route để kiểm tra trạng thái xác thực email
Route::get('/email/verification-status', function () {
    if (auth()->user() && auth()->user()->hasVerifiedEmail()) {
        return response()->json(['verified' => true]);
    }
    return response()->json(['verified' => false]);
})->middleware('auth')->name('verification.status');