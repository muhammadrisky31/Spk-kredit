<?php

namespace App\Http\Controllers;

use App\Models\Prediksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilController extends Controller
{
    public function show($id)
    {
        if (!auth()->check()) return redirect('/login');

        $prediksi = Prediksi::where('id', $id)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();

        return view('hasil', compact('prediksi'));
    }

    public function exportPdf($id)
    {
        if (!auth()->check()) return redirect('/login');

        $prediksi = Prediksi::where('id', $id)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();

        $pdf = Pdf::loadView('hasil-pdf', compact('prediksi'));

        return $pdf->stream('hasil-prediksi-' . $id . '.pdf');
    }
}