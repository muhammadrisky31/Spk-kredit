<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Prediksi;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalNasabah = User::where('role', 'pengguna')->count();

        $totalPrediksi = Prediksi::count();

        $risikoRendah = Prediksi::where('hasil', 'Risiko Rendah')->count();

        $risikoTinggi = Prediksi::where('hasil', 'Risiko Tinggi')->count();

        $pengajuanTerbaru = Prediksi::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalNasabah',
            'totalPrediksi',
            'risikoRendah',
            'risikoTinggi',
            'pengajuanTerbaru'
        ));
    }

    public function nasabah()
    {
        $nasabah = User::where('role', 'pengguna')->get();

        return view('admin.nasabah', compact('nasabah'));
    }
}