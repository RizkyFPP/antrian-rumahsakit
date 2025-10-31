<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Antrian;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    /**
     * ========================================================
     * 1️⃣ SIMPAN DATA PENDAFTARAN BARU & BUAT NOMOR ANTRIAN OTOMATIS
     * ========================================================
     */
    public function store(Request $request)
    {
        // ✅ Validasi input
        $request->validate([
            'nama'            => 'required|string|max:100',
            'nohp'            => 'required|string|max:20',
            'no_bpjs'         => 'nullable|string|max:30',
            'jadwal_tanggal'  => 'nullable|date',
            'jadwal_jam'      => 'nullable|string',
        ]);

        /**
         * =========================
         * 1️⃣ Tentukan Loket Tujuan
         * =========================
         * - Pasien tanpa BPJS → Loket 3 (Umum)
         * - Pasien BPJS lama  → Loket 1
         * - Pasien BPJS baru  → Loket 2
         */
        if (empty($request->no_bpjs)) {
            $loket = 3;
        } else {
            $bpjsLama = Pendaftaran::where('no_bpjs', $request->no_bpjs)->exists();
            $loket = $bpjsLama ? 1 : 2;
        }

        /**
         * =========================
         * 2️⃣ Buat Nomor Antrian Unik
         * =========================
         */
        $prefix = $loket == 3 ? 'UM' : 'BPJS';

        $lastAntrian = Antrian::where('loket', $loket)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastAntrian) {
            $lastNumber = (int) preg_replace('/[^0-9]/', '', $lastAntrian->nomor_antrian);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        do {
            $nomor_antrian = sprintf('%s-%03d', $prefix, $nextNumber);
            $exists = Antrian::where('nomor_antrian', $nomor_antrian)->exists();
            $nextNumber++;
        } while ($exists);

        /**
         * =========================
         * 3️⃣ Simpan ke tabel Pendaftaran
         * =========================
         */
        $pendaftaran = Pendaftaran::create([
            'nama'           => $request->nama,
            'nohp'           => $request->nohp,
            'no_bpjs'        => $request->no_bpjs,
            'nomor_antrian'  => $nomor_antrian,
            'tanggal'        => $request->jadwal_tanggal,
            'jam'            => $request->jadwal_jam,
            'loket'          => $loket,
        ]);

        /**
         * =========================
         * 4️⃣ Simpan juga ke tabel Antrian
         * =========================
         */
        Antrian::create([
            'pendaftaran_id' => $pendaftaran->id,
            'nomor_antrian'  => $nomor_antrian,
            'loket'          => $loket,
            'status'         => 'menunggu',
        ]);

        /**
         * =========================
         * 5️⃣ Redirect dengan notifikasi sukses
         * =========================
         */
        return redirect()->route('daftar-online')->with(
            'success',
            "Pendaftaran berhasil! Nomor antrian Anda {$nomor_antrian}."
        );
    }

    /**
     * ========================================================
     * 2️⃣ CEK STATUS ANTRIAN BERDASARKAN NOMOR HP / BPJS / ANTRIAN
     * ========================================================
     */
    public function cekAntrian(Request $request)
    {
        $nomor = $request->get('nomor');

        $data = Pendaftaran::where('nohp', $nomor)
            ->orWhere('nomor_antrian', $nomor)
            ->orWhere('no_bpjs', $nomor)
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->first();

        if (!$data) {
            return view('antrian')->with('error', 'Nomor tidak ditemukan.');
        }

        return view('antrian', [
            'tipe_pasien'   => $data->no_bpjs ? 'BPJS' : 'Umum',
            'nomor_antrian' => $data->nomor_antrian,
            'nama'          => $data->nama,
            'tanggal'       => $data->tanggal,
            'no_bpjs'       => $data->no_bpjs,
            'loket'         => $data->loket,
        ]);
    }
}
