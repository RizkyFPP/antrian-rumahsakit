<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nohp',
        'no_bpjs',
        'nomor_antrian',
        'tanggal',
        'jam', // ✅ wajib ada
    ];
}
