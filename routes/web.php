<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Prediksi;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\Admin\AdminController;

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

    $totalPrediksi = Prediksi::where('user_id', Auth::id())->count();

    $risikoTinggi = Prediksi::where('user_id', Auth::id())
        ->where('hasil', 'Risiko Tinggi')
        ->count();

    $risikoRendah = Prediksi::where('user_id', Auth::id())
        ->where('hasil', 'Risiko Rendah')
        ->count();

    $prediksiTerbaru = Prediksi::where('user_id', Auth::id())
        ->latest()
        ->take(3)
        ->get();

    return view('dashboard', compact(
        'totalPrediksi',
        'risikoTinggi',
        'risikoRendah',
        'prediksiTerbaru'
    ));
})->name('dashboard');

// ================= PREDIKSI =================
Route::get('/prediksi', function () {

    if (!Auth::check()) {
        return redirect('/login');
    }

    return view('predict');

})->name('prediksi');

Route::post('/prediksi', [PrediksiController::class, 'store'])
    ->middleware('auth')
    ->name('prediksi.store');

// ================= RIWAYAT =================
Route::get('/riwayat', function (Request $request) {

    $query = Prediksi::where('user_id', Auth::id());

    if ($request->search) {

        $query->where(function ($q) use ($request) {

            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('tujuan', 'like', '%' . $request->search . '%')
              ->orWhere('status_rumah', 'like', '%' . $request->search . '%');

        });
    }

    $data = $query->latest()->get();

    $totalPrediksi = $data->count();

    $risikoTinggi = $data->where('hasil', 'Risiko Tinggi')->count();

    $risikoRendah = $data->where('hasil', 'Risiko Rendah')->count();

    return view('riwayat', compact(
        'data',
        'totalPrediksi',
        'risikoTinggi',
        'risikoRendah'
    ));

})->middleware('auth')->name('riwayat');

// ================= HASIL =================
Route::get('/hasil/{id}', [HasilController::class, 'show'])
    ->middleware('auth')
    ->name('hasil.show');

Route::get('/hasil/{id}/pdf', [HasilController::class, 'exportPdf'])
    ->middleware('auth')
    ->name('hasil.pdf');

// ================= TENTANG =================
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
        'role'     => 'pengguna',
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

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('dashboard');

});

// ================= LOGOUT =================
Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');

})->name('logout');

// ================= ADMIN =================

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/nasabah', [AdminController::class, 'nasabah'])
        ->name('admin.nasabah');

    Route::delete('/nasabah/{id}', [AdminController::class, 'hapusNasabah'])
        ->name('admin.hapus-nasabah');

    Route::get('/data-prediksi', [AdminController::class, 'dataPrediksi'])
        ->name('admin.data-prediksi');

    Route::get('/performa-model', [AdminController::class, 'performaModel'])
        ->name('admin.performa-model');

});