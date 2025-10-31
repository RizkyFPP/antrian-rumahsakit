<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Antrian; 
use App\Http\Controllers\Controller;

class LoketController extends Controller
{
    /**
     * Terapkan middleware auth ke semua method
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 🏢 Tampilkan halaman loket berdasarkan nomor
     * @param int $loket
     */
    public function index($loket)
    {
        // 🔒 Cek apakah user hanya bisa akses loket miliknya
        if (Auth::user()->loket != $loket) {
            abort(403, 'Akses ditolak! Anda tidak memiliki hak untuk membuka loket ini.');
        }

        // Ambil antrian yang sedang dipanggil (terbaru)
        $antrianAktif = Antrian::where('loket', $loket)
            ->where('status', 'dipanggil')
            ->latest()
            ->first();

        // Ambil daftar antrian menunggu
        $antrianMenunggu = Antrian::where('loket', $loket)
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('loket.index', compact('antrianAktif', 'antrianMenunggu', 'loket'));
    }

    /**
     * ▶️ Panggil antrian berikutnya di loket
     * @param int $loket
     */
    public function next($loket)
    {
        // 🔒 Validasi akses loket
        if (Auth::user()->loket != $loket) {
            abort(403, 'Akses ditolak!');
        }

        // Ubah antrian aktif menjadi selesai
        Antrian::where('loket', $loket)
            ->where('status', 'dipanggil')
            ->update(['status' => 'selesai']);

        // Ambil antrian pertama yang menunggu
        $nextAntrian = Antrian::where('loket', $loket)
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'asc')
            ->first();

        // Jika ada antrian menunggu
        if ($nextAntrian) {
            $nextAntrian->update(['status' => 'dipanggil']);
            return redirect()
                ->route('loket.index', $loket)
                ->with('success', 'Memanggil antrian ' . $nextAntrian->nomor_antrian);
        }

        // Tidak ada antrian
        return redirect()
            ->route('loket.index', $loket)
            ->with('error', 'Tidak ada antrian menunggu.');
    }

    /**
     * ⏭ Lewati antrian aktif di loket
     * @param int $loket
     */
    public function skip($loket)
    {
        // 🔒 Validasi akses loket
        if (Auth::user()->loket != $loket) {
            abort(403, 'Akses ditolak!');
        }

        // Ubah antrian aktif menjadi dilewati
        $antrianAktif = Antrian::where('loket', $loket)
            ->where('status', 'dipanggil')
            ->latest()
            ->first();

        if ($antrianAktif) {
            $antrianAktif->update(['status' => 'dilewati']);
        }

        return redirect()
            ->route('loket.index', $loket)
            ->with('success', 'Antrian telah dilewati.');
    }

    /**
     * 🔊 Panggil ulang antrian tertentu dari daftar menunggu
     * @param int $loket
     * @param int $id
     */
    public function panggil($loket, $id)
    {
        // 🔒 Validasi akses loket
        if (Auth::user()->loket != $loket) {
            abort(403, 'Akses ditolak!');
        }

        // Tutup antrian aktif yang sedang berjalan
        Antrian::where('loket', $loket)
            ->where('status', 'dipanggil')
            ->update(['status' => 'selesai']);

        // Ambil antrian yang akan dipanggil
        $antrian = Antrian::findOrFail($id);

        if ($antrian->status === 'menunggu') {
            $antrian->update(['status' => 'dipanggil']);
        }

        return redirect()
            ->route('loket.index', $loket)
            ->with('success', 'Antrian ' . $antrian->nomor_antrian . ' telah dipanggil.');
    }
}
