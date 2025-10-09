@extends('layouts.app')

@section('title', 'Cek Antrian - Rumah Sakit')

@section('content')
<section class="flex flex-col items-center justify-center text-center mt-24 px-6">

    {{-- Judul Halaman --}}
    <div class="mb-10">
        <h1 class="text-6xl font-extrabold text-green-400 drop-shadow-[0_0_25px_#22c55e] tracking-wide">
            Cek Antrian
        </h1>
        <p class="text-gray-300 mt-3 text-lg">
            Masukkan nomor <span class="text-green-400 font-semibold">Antrian</span> atau <span class="text-green-400 font-semibold">BPJS</span>
        </p>
    </div>

    {{-- Kartu Input --}}
    <div class="bg-[#012b12] border border-green-800 shadow-[0_0_30px_rgba(34,197,94,0.3)] rounded-2xl p-10 w-full max-w-lg relative overflow-hidden">
        {{-- Garis Hias Futuristik --}}
        <div class="absolute inset-0 border-2 border-green-600/30 rounded-2xl animate-pulse"></div>

        <div class="relative mb-8">
            <i class="fa-solid fa-id-card absolute left-5 top-1/2 transform -translate-y-1/2 text-green-400 text-lg"></i>
            <input
                type="text"
                placeholder="Masukkan nomor BPJS atau Antrian..."
                class="w-full bg-[#013a16]/90 border border-green-700 rounded-xl pl-12 pr-4 py-3 
                       text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 
                       focus:ring-green-500 transition-all duration-300"
            >
            <button
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-green-600 hover:bg-green-700 
                       text-white font-semibold px-5 py-2 rounded-lg transition-all duration-300 shadow-md">
                Cek
            </button>
        </div>

        {{-- Garis Pemisah --}}
        <div class="h-[1px] bg-green-700/50 my-6"></div>

        {{-- Hasil Antrian --}}
        <div class="mt-4">
            <h2 class="text-2xl font-semibold text-green-400 mb-3 flex items-center justify-center gap-2">
                <i class="fa-solid fa-hospital-user text-green-400"></i>
                Antrian Pasien BPJS Lama
            </h2>

            <div class="flex items-center justify-center my-6">
                <p class="text-[130px] font-extrabold text-white leading-none tracking-tight drop-shadow-[0_0_20px_#22c55e]">
                    131
                </p>
            </div>

            <p class="text-gray-400 text-sm italic mt-4">
                Terakhir diperbarui: 10 detik yang lalu
            </p>
        </div>
    </div>
</section>
@endsection
