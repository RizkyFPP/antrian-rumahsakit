@extends('layouts.app')

@section('title', 'Cek Antrian - Rumah Sakit')

@section('content')
<section class="flex flex-col items-center justify-center text-center mt-12 px-4">
    <h1 class="text-5xl font-bold mb-4">Cek Antrian</h1>
    <p class="text-gray-300 mb-8 text-lg">
        Masukkan nomor antrian atau nomor BPJS
    </p>

    <input
        type="text"
        placeholder="1234567890"
        class="bg-transparent border border-gray-400 rounded-lg px-6 py-3 w-80 text-center text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all"
    />

    <div class="mt-16">
        <h2 class="text-3xl font-semibold mb-3">Antrian Pasien BPJS Lama</h2>
        <p class="text-[90px] font-bold text-white leading-none">131</p>
    </div>
</section>
@endsection
