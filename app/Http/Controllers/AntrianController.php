<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use Illuminate\Support\Facades\Cache;

class AntrianController extends Controller
{
    /**
     * ===============================
     * SIMPAN DATA ANTRIAN BARU
     * ===============================
     */
    public function store(Request $request)
    {
        $loket = $request->loket; // 1 = UMUM, 2 = BPJS
        $prefix = $loket == 1 ? 'UMUM' : 'BPJS';

        // Ambil nomor antrian terakhir untuk loket terkait
        $lastAntrian = Antrian::where('loket', $loket)
            ->orderBy('id', 'desc')
            ->first();

        $lastNumber = 0;
        if ($lastAntrian) {
            // contoh: BPJS-005 → ambil 5
            $lastNumber = (int) str_replace($prefix . '-', '', $lastAntrian->nomor_antrian);
        }

        // Nomor berikutnya
        $nextNumber = $lastNumber + 1;

        // Format nomor baru
        $nomorAntrian = $prefix . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Simpan data baru
        Antrian::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'nomor_antrian'  => $nomorAntrian,
            'loket'          => $loket,
            'status'         => 'menunggu',
        ]);

        return redirect()->back()->with('success', 'Nomor antrian berhasil dibuat: ' . $nomorAntrian);
    }

    /**
     * ===============================
     * HALAMAN UNTUK PETUGAS LOKET
     * ===============================
     */
    public function index()
    {
        $antrianAktif = Antrian::where('status', 'dipanggil')
            ->latest('updated_at')
            ->first();

        $antrianMenunggu = Antrian::where('status', 'menunggu')
            ->orderBy('id', 'asc')
            ->take(6)
            ->get();

        return view('pages.loket', compact('antrianAktif', 'antrianMenunggu'));
    }

    /**
     * ===============================
     * PANGGIL ANTRIAN BERIKUTNYA
     * ===============================
     */
    public function panggil($id)
    {
        // Selesaikan yang sedang aktif
        Antrian::where('status', 'dipanggil')->update(['status' => 'selesai']);

        // Ubah status menjadi dipanggil
        $antrian = Antrian::findOrFail($id);
        $antrian->update(['status' => 'dipanggil']);

        // Simpan ke cache untuk layar pengunjung
        Cache::put('nomor_dipanggil', $antrian->nomor_antrian, now()->addMinutes(10));
        Cache::put('loket_dipanggil', $antrian->loket, now()->addMinutes(10));

        return redirect()->back()->with('success', 'Nomor ' . $antrian->nomor_antrian . ' sedang dipanggil.');
    }

    /**
     * ===============================
     * HALAMAN DISPLAY UNTUK PENGUNJUNG
     * ===============================
     */
    public function display()
    {
        // Antrian yang sedang dipanggil (terbaru)
        $antrianAktif = Antrian::where('status', 'dipanggil')
            ->orderBy('updated_at', 'desc')
            ->first();

        // Semua antrian yang masih menunggu (urut paling lama dulu)
        $antrianMenunggu = Antrian::where('status', 'menunggu')
            ->orderBy('created_at', 'asc')
            ->get();

        // Kirim ke view 'pages.pengunjung' atau sesuai nama file blade-mu
        return view('pages.pengunjung', compact('antrianAktif', 'antrianMenunggu'));
    }



    public function cekAntrian(Request $request)
    {
        $nomor = $request->input('nomor');

        // Jika belum ada input, tampilkan halaman form saja
        if (!$nomor) {
            return view('pages.antrian');
        }

        // Cari berdasarkan nomor antrian (BPJS-001, UMUM-002, dll)
        // ATAU berdasarkan nomor BPJS pasien
        $antrian = Antrian::where('nomor_antrian', 'LIKE', "%$nomor%")
            ->orWhereHas('pendaftaran', function ($query) use ($nomor) {
                $query->where('no_bpjs', 'LIKE', "%$nomor%");
            })
            ->first();

        // Jika tidak ditemukan
        if (!$antrian) {
            return view('pages.antrian', [
                'error' => 'Data antrian tidak ditemukan.'
            ]);
        }

        // Ambil data pasien dari tabel pendaftaran
        $pasien = \DB::table('pendaftarans')
            ->where('id', $antrian->pendaftaran_id)
            ->first();

        // Jika data pasien tidak ditemukan
        if (!$pasien) {
            return view('pages.antrian', [
                'error' => 'Data pasien tidak ditemukan pada tabel pendaftaran.'
            ]);
        }

        // Ambil nomor antrian dan ubah ke huruf besar
        $nomorAntrian = strtoupper($antrian->nomor_antrian);
        $tipe_pasien = 'Tidak diketahui';

        // Tentukan tipe pasien
        if (str_contains($nomorAntrian, 'UMU') || str_contains($nomorAntrian, 'UMM')) {
            // Jika ada kata UMU/UMUM/UMM → pasien UMUM
            $tipe_pasien = 'UMUM';
        } elseif (str_contains($nomorAntrian, 'BPJS')) {
            // Jika ada kata BPJS → pasien BPJS
            $tipe_pasien = 'BPJS';
        } else {
            // Jika tidak ada kata kunci, cek berdasarkan data BPJS
            if (!empty($pasien->no_bpjs)) {
                $tipe_pasien = 'BPJS';
            } else {
                $tipe_pasien = 'UMUM';
            }
        }

        $nama = $pasien->nama ?? 'Tidak diketahui';

        return view('pages.antrian', [
            'nomor_antrian' => $antrian->nomor_antrian,
            'tipe_pasien' => $tipe_pasien,
            'nama' => $nama
        ]);
    }

}