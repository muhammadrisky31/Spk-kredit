<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Prediksi;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalNasabah     = User::where('role', 'pengguna')->count();
        $totalPrediksi    = Prediksi::count();
        $risikoRendah     = Prediksi::where('hasil', 'Risiko Rendah')->count();
        $risikoTinggi     = Prediksi::where('hasil', 'Risiko Tinggi')->count();
        $pengajuanTerbaru = Prediksi::with('user')->latest()->take(5)->get();

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
        $nasabah = User::where('role', 'pengguna')->latest()->get();
        return view('admin.nasabah', compact('nasabah'));
    }

    public function hapusNasabah($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Nasabah berhasil dihapus');
    }

    public function dataPrediksi()
    {
        $prediksi = Prediksi::with('user')->latest()->get();
        return view('admin.data-prediksi', compact('prediksi'));
    }

    public function performaModel()
    {
        $totalPrediksi = Prediksi::count();
        $risikoRendah  = Prediksi::where('hasil', 'Risiko Rendah')->count();
        $risikoTinggi  = Prediksi::where('hasil', 'Risiko Tinggi')->count();
        $avgConfidence = round(Prediksi::avg('confidence') ?? 0, 2);
        $avgLimit      = round(Prediksi::avg('limit_rekomendasi') ?? 0, 2);
        $avgSkorRisiko = round(Prediksi::avg('skor_risiko') ?? 0, 2);
        $persenRendah  = $totalPrediksi > 0 ? round($risikoRendah / $totalPrediksi * 100, 1) : 0;
        $persenTinggi  = $totalPrediksi > 0 ? round($risikoTinggi / $totalPrediksi * 100, 1) : 0;

        return view('admin.performa-model', compact(
            'totalPrediksi',
            'risikoRendah',
            'risikoTinggi',
            'avgConfidence',
            'avgLimit',
            'avgSkorRisiko',
            'persenRendah',
            'persenTinggi'
        ));
    }
}