<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// ================= LANDING =================
Route::get('/', function () {
    return view('landing');
});

// ================= HALAMAN UTAMA =================
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return view('dashboard');
})->name('dashboard');

Route::get('/prediksi', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return view('predict');
})->name('prediksi');

Route::get('/riwayat', function (Request $request) {
    $data = collect([]); // sementara kosong
    $totalPrediksi = 0;
    $risikoTinggi  = 0;
    $risikoRendah  = 0;

    return view('riwayat', compact('data','totalPrediksi','risikoTinggi','risikoRendah'));
})->middleware('auth')->name('riwayat');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// ================= REGISTER =================
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);
    return redirect('/login');
});

// ================= LOGIN =================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->with('error', 'Email tidak ditemukan');
    }

    if (!Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Password salah');
    }

    Auth::login($user);
    $request->session()->regenerate();

    return redirect('/dashboard');
});

// ================= LOGOUT =================
Route::get('/logout', function () {
    Auth::logout();
    session()->flush();
    return redirect('/login');
});

// ================= USERS =================
Route::get('/users', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    $users = User::all();
    return view('users', compact('users'));
});