@extends('layouts.app')

@section('title', 'Cek Antrian - Rumah Sakit')

@section('content')
<section class="flex flex-col items-center justify-center text-center mt-24 px-6">
    <div class="mb-10">
        <h1 class="text-6xl font-extrabold text-green-400 drop-shadow-[0_0_25px_#22c55e] tracking-wide">
            Cek Antrian
        </h1>
        <p class="text-gray-300 mt-3 text-lg">
            Masukkan nomor <span class="text-green-400 font-semibold">Antrian</span> atau 
            <span class="text-green-400 font-semibold">BPJS</span>
        </p>
    </div>

    <form method="GET" action="{{ route('cek.antrian') }}" class="bg-[#012b12] border border-green-800 
        shadow-[0_0_30px_rgba(34,197,94,0.3)] rounded-2xl p-10 w-full max-w-lg relative overflow-hidden">
        
        <div class="relative mb-8">
            <i class="fa-solid fa-id-card absolute left-5 top-1/2 transform -translate-y-1/2 text-green-400 text-lg"></i>
            <input
                type="text"
                name="nomor"
                placeholder="Masukkan nomor BPJS atau Antrian..."
                class="w-full bg-[#013a16]/90 border border-green-700 rounded-xl pl-12 pr-4 py-3 
                       text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 
                       focus:ring-green-500 transition-all duration-300"
            >
            <button
                type="submit"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-green-600 hover:bg-green-700 
                       text-white font-semibold px-5 py-2 rounded-lg transition-all duration-300 shadow-md">
                Cek
            </button>
        </div>

        {{-- Jika ada error --}}
        @if(isset($error))
            <div class="bg-red-600 text-white p-3 rounded-lg shadow-md mb-3">
                {{ $error }}
            </div>
        @endif

        {{-- Jika hasil ditemukan --}}
        @if(isset($tipe_pasien))
            <div class="mt-6 text-center">
                @if($tipe_pasien === 'lama')
                    <h2 class="text-2xl font-semibold text-green-400 mb-3">
                        <i class="fa-solid fa-hospital-user text-green-400"></i>
                        Pasien BPJS Lama
                    </h2>
                @else
                    <h2 class="text-2xl font-semibold text-blue-400 mb-3">
                        <i class="fa-solid fa-user-plus text-blue-400"></i>
                        Pasien BPJS Baru
                    </h2>
                @endif

                <p class="text-gray-300 mb-2">Nama: <span class="font-semibold">{{ $nama }}</span></p>

                <div class="flex items-center justify-center my-6">
                    <p class="text-[80px] font-extrabold text-white leading-none tracking-tight drop-shadow-[0_0_20px_#22c55e]">
                        {{ $nomor_antrian }}
                    </p>
                </div>
            </div>
        @endif
    </form>
</section>
@endsection
