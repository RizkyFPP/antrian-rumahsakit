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
        'nomor_antrian', // <-- wajib ada ini
        'tanggal',
        'jam',
        'loket',
    ];

    public function antrian()
    {
        return $this->hasOne(Antrian::class, 'pendaftaran_id');
    }
}