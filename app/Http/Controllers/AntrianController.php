<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class AntrianController extends Controller
{
    public function cekAntrian(Request $request)
    {
        $nomor = trim($request->input('nomor'));

        if (!$nomor) {
            return view('pages.antrian');
        }

        // Deteksi apakah input berupa nomor BPJS
        $is_bpjs = preg_match('/^\d{10,13}$/', $nomor);

        if ($is_bpjs) {
            // Ambil data terbaru berdasarkan nomor BPJS
            $pasien = Pendaftaran::where('no_bpjs', $nomor)
                        ->orderBy('created_at', 'desc')
                        ->first();
        } else {
            // Ambil data berdasarkan nomor antrian
            $pasien = Pendaftaran::where('nomor_antrian', $nomor)->first();
        }

        if (!$pasien) {
            return view('pages.antrian', [
                'error' => 'Nomor BPJS atau Nomor Antrian tidak ditemukan.'
            ]);
        }

        $jumlahPendaftaran = Pendaftaran::where('no_bpjs', $pasien->no_bpjs)->count();
        $tipe_pasien = $jumlahPendaftaran > 1 ? 'lama' : 'baru';

        return view('pages.antrian', [
            'tipe_pasien'   => $tipe_pasien,
            'nama'          => $pasien->nama ?? 'Tidak diketahui',
            'nomor_antrian' => $pasien->nomor_antrian,
            'no_bpjs'       => $pasien->no_bpjs,
            'tanggal'       => $pasien->tanggal ?? now(),
            'jam'           => $pasien->jam ?? '-',
        ]);
    }
}
