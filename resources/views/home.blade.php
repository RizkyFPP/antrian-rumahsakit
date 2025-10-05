@extends('layouts.app')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-12">
    <div class="grid md:grid-cols-2 gap-10 items-center">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 leading-snug">
                Mudah & Cepat,<br>
                Cek Antrian Rumah Sakit Secara Online
            </h1>
            <p class="mt-4 text-gray-600">Kurangi waktu tunggu dengan sistem antrian digital.</p>
            <a href="#"
               class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow">
               Cek Antrian Sekarang →
            </a>
        </div>

        <div>
            <img src="{{ asset('images/dokter.png') }}" alt="Dokter" class="w-full max-w-md mx-auto">
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6 mt-16">
        <div class="p-6 bg-white shadow rounded-lg">
            <div class="text-blue-600 text-3xl mb-4">📋</div>
            <h3 class="font-semibold text-lg">Cek Antrian</h3>
            <p class="text-gray-600 mt-2">Pantau nomor antrian secara real-time</p>
        </div>
        <div class="p-6 bg-white shadow rounded-lg">
            <div class="text-green-600 text-3xl mb-4">📅</div>
            <h3 class="font-semibold text-lg">Daftar Online</h3>
            <p class="text-gray-600 mt-2">Booking jadwal konsultasi tanpa harus antre di loket</p>
        </div>
        <div class="p-6 bg-white shadow rounded-lg">
            <div class="text-indigo-600 text-3xl mb-4">👩‍⚕️</div>
            <h3 class="font-semibold text-lg">Info Dokter & Poli</h3>
            <p class="text-gray-600 mt-2">Lihat jadwal dokter & layanan yang tersedia</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6 mt-12 text-center">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-2xl font-bold text-gray-900">{{ number_format($data['totalPasien']) }}</h3>
            <p class="text-gray-600">Pasien Hari Ini</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-2xl font-bold text-gray-900">{{ $data['poliAktif'] }}</h3>
            <p class="text-gray-600">Poli Aktif</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-2xl font-bold text-gray-900">{{ $data['dokter'] }}</h3>
            <p class="text-gray-600">Dokter Bertugas</p>
        </div>
    </div>
</section>
@endsection
