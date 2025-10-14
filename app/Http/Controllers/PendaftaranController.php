<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nohp' => 'required|string|max:20',
            'no_bpjs' => 'nullable|string|max:30',
            'jadwal_tanggal' => 'required|date',
            'jadwal_jam' => 'required',
        ]);

        // ✅ Cek apakah nomor BPJS sudah pernah digunakan oleh nama yang berbeda
        if (!empty($request->no_bpjs)) {
            $bpjsTerdaftar = Pendaftaran::where('no_bpjs', $request->no_bpjs)->first();

            if ($bpjsTerdaftar && $bpjsTerdaftar->nama !== $request->nama) {
                return redirect()->back()->with([
                    'error' => "Nomor BPJS <b>{$request->no_bpjs}</b> sudah terdaftar atas nama <b>{$bpjsTerdaftar->nama}</b>. 
                                Pendaftaran dengan nama berbeda tidak diperbolehkan."
                ]);
            }
        }

        // Ambil bulan dan tahun dari tanggal yang dipilih
        $bulan = Carbon::parse($request->jadwal_tanggal)->format('m');
        $tahun = Carbon::parse($request->jadwal_tanggal)->format('Y');

        // Ambil nomor antrian terakhir untuk bulan & tahun tersebut
        $last = Pendaftaran::whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->max('nomor_antrian');

        // Ambil angka terakhir (misal dari BPJS-005 → ambil 5)
        $lastNumber = 0;
        if ($last) {
            $lastNumber = (int) preg_replace('/[^0-9]/', '', $last);
        }

        // Tentukan prefix berdasarkan pasien
        $prefix = $request->no_bpjs ? 'BPJS' : 'UM';

        // Buat nomor antrian baru dengan format PREFIX-XXX
        $nomor_antrian = sprintf('%s-%03d', $prefix, $lastNumber + 1);

        // Simpan data pendaftaran
        Pendaftaran::create([
            'nama' => $request->nama,
            'nohp' => $request->nohp,
            'no_bpjs' => $request->no_bpjs,
            'nomor_antrian' => $nomor_antrian,
            'tanggal' => $request->jadwal_tanggal,
            'jam' => $request->jadwal_jam,
        ]);

        return redirect()->route('daftar-online')
            ->with('success', 'Pendaftaran berhasil! Nomor antrian Anda: ' . $nomor_antrian);
    }

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
        ]);
    }
}
