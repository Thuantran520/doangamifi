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


Route::get('/', function () {
    return view('launcher');
})->name('launcher');

Route::get('/launcher', function () {
    return view('launcher');
}) -> name('launcher');



Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');


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