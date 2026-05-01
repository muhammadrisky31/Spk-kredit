<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_Kredit extends Model
{
    use HasFactory;

    protected $table = 'data_kredit';

    protected $primaryKey = 'id';

    public $timestamps = true; // pakai created_at & updated_at

    protected $fillable = [
        'nama',
        'umur',
        'pendapatan',
        'status_rumah',
        'tujuan',
        'hasil'
    ];

    // OPTIONAL: format otomatis (biar rapi di view)
    protected $casts = [
        'umur' => 'integer',
        'pendapatan' => 'integer',
    ];
}