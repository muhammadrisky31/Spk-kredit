<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediksi extends Model
{
    protected $fillable = [
        'user_id', 'nama', 'umur', 'pendapatan', 'status_rumah',
        'lama_kerja', 'tujuan', 'grade', 'jumlah_pinjaman',
        'suku_bunga', 'status_pinjaman', 'rasio_pinjaman',
        'default_kredit', 'lama_riwayat', 'hasil', 'confidence',
        'riwayat_default',
        // Kolom hasil ML
        'limit_rekomendasi',
        'justifikasi',
        'skor_risiko',
        // Kolom analisis kapasitas
        'pendapatan_bulanan',
        'dsr_saat_ini',
        'sisa_kapasitas_dsr',
        'limit_kemampuan_bayar',
    ];

    protected $casts = [
        'justifikasi' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}