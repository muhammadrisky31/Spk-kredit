<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prediksi;

class PrediksiController extends Controller
{
    public function index()
    {
        if (!auth()->check()) return redirect('/login');
        return view('predict');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_nasabah'      => 'required|string|max:100',
            'umur'              => 'required|numeric|min:17|max:100',
            'pendapatan'        => 'required|numeric|min:1',
            'kepemilikan_rumah' => 'required',
            'lama_kerja'        => 'required|numeric|min:0',
            'tujuan_pinjaman'   => 'required',
            'grade_pinjaman'    => 'required',
            'jumlah_pinjaman'   => 'required|numeric|min:0',
            'suku_bunga'        => 'required|numeric|min:0|max:100',
            'persen_pinjaman'   => 'required|numeric|min:0',
            'default_kredit'    => 'required',
            'lama_kredit'       => 'required|numeric|min:0',
        ]);

        $rasio         = (float) $request->persen_pinjaman;
        $pernahDefault = $request->default_kredit === 'Y';

        // ============================================================
        // PREDIKSI DENGAN RANDOM FOREST (Python)
        // ============================================================
        $input = json_encode([
            'person_age'                 => (int)   $request->umur,
            'person_income'              => (float) $request->pendapatan,
            'person_home_ownership'      =>          $request->kepemilikan_rumah,
            'person_emp_length'          => (float) $request->lama_kerja,
            'loan_intent'                =>          $request->tujuan_pinjaman,
            'loan_grade'                 =>          $request->grade_pinjaman,
            'loan_amnt'                  => (float) $request->jumlah_pinjaman,
            'loan_int_rate'              => (float) $request->suku_bunga,
            'loan_percent_income'        => (float) $rasio,
            'cb_person_default_on_file'  => $pernahDefault ? 'Y' : 'N',
            'cb_person_cred_hist_length' => (int)   $request->lama_kredit,
        ]);

        $pythonPath = 'python';
        $scriptPath = base_path('ml/predict.py');

        // Simpan input ke file sementara (solusi Windows)
        $tmpFile = base_path('ml/tmp_input.json');
        file_put_contents($tmpFile, $input);

        $command = $pythonPath . ' ' . escapeshellarg($scriptPath) . ' --file ' . escapeshellarg($tmpFile) . ' 2>&1';
        $output  = shell_exec($command);

        // Hapus file sementara
        @unlink($tmpFile);

        // Fallback kalau Python gagal
        if (!$output) {
            return back()->with('error', 'Prediksi gagal, coba lagi.')->withInput();
        }

        $prediksiML = json_decode($output, true);

        // Cek apakah output Python valid
        if (!isset($prediksiML['loan_status'])) {
            return back()->with('error', 'Output model tidak valid: ' . $output)->withInput();
        }

        $hasil      = $prediksiML['loan_status'] === 1 ? 'Risiko Tinggi' : 'Risiko Rendah';
        $confidence = $prediksiML['loan_status'] === 1
            ? $prediksiML['probabilitas']['berisiko']
            : $prediksiML['probabilitas']['aman'];
        // ============================================================

        // Simpan ke database
        $prediksi = Prediksi::create([
            'user_id'         => auth()->id(),
            'nama'            => $request->nama_nasabah, // ← nama nasabah dari form
            'umur'            => $request->umur,
            'pendapatan'      => $request->pendapatan,
            'status_rumah'    => $request->kepemilikan_rumah,
            'lama_kerja'      => $request->lama_kerja,
            'tujuan'          => $request->tujuan_pinjaman,
            'grade'           => 'Grade ' . $request->grade_pinjaman,
            'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'suku_bunga'      => $request->suku_bunga,
            'rasio_pinjaman'  => $rasio,
            'default_kredit'  => $pernahDefault ? 1 : 0,
            'lama_riwayat'    => $request->lama_kredit,
            'hasil'           => $hasil,
            'confidence'      => $confidence,
            'riwayat_default' => $pernahDefault ? 'Pernah Default' : 'Tidak Pernah Default',
        ]);

        return redirect()->route('hasil.show', $prediksi->id);
    }
}