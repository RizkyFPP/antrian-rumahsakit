@extends('layouts.app')

@section('content')
    <!-- konten halaman di sini -->
    <section class="flex flex-col md:flex-row items-center justify-between px-16 py-12 space-y-8 md:space-y-0">
        <div class="md:w-1/2 space-y-6">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Cek Antrian<br>RSU Syifa Medika Banjar
            </h1>
            <p class="text-lg text-gray-200">
                Kurangi waktu tunggu dengan sistem antrian digital.
            </p>
            <a href="{{ route('antrian') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                Cek Antrian Sekarang <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    
        <div class="md:w-1/2 flex justify-center">
            <img src="{{ asset('images/dokter.png') }}" alt="Dokter dan Pasien" class="w-80 md:w-96">
        </div>
    </section>
    
    <!-- Info Cards -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-12 pb-12">
        <!-- Card 1 -->
        <div class="bg-white text-green-900 rounded-xl shadow-md p-5 text-center hover:scale-105 transition">
            <i class="fas fa-clipboard-list text-3xl text-blue-600 mb-3"></i>
            <h3 class="font-bold text-lg mb-1">Cek Antrian</h3>
            <p class="text-sm text-gray-600">Pantau nomor antrian secara real-time.</p>
        </div>
    
        <!-- Card 2 -->
        <div class="bg-white text-green-900 rounded-xl shadow-md p-5 text-center hover:scale-105 transition">
            <i class="fas fa-calendar-check text-3xl text-green-600 mb-3"></i>
            <h3 class="font-bold text-lg mb-1">Daftar Online</h3>
            <p class="text-sm text-gray-600">Booking jadwal konsultasi dokter tanpa antre di loket.</p>
        </div>
    
        <!-- Card 3 -->
        <div class="bg-white text-green-900 rounded-xl shadow-md p-5 text-center hover:scale-105 transition">
            <i class="fas fa-user-md text-3xl text-blue-600 mb-3"></i>
            <h3 class="font-bold text-lg mb-1">Info Dokter & Poli</h3>
            <p class="text-sm text-gray-600">Lihat jadwal dokter dan layanan yang tersedia.</p>
        </div>
    </section>
    
    <!-- BPJS Info Section -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6 px-12 pb-16">
        <div class="bg-green-700 rounded-xl shadow-md p-5 text-white hover:scale-105 transition">
            <i class="fas fa-notes-medical text-2xl mb-2"></i>
            <h4 class="font-semibold text-lg mb-1">Antrian BPJS Baru</h4>
            <p class="text-sm">Untuk pasien baru yang belum memiliki nomor BPJS Rumah Sakit.</p>
        </div>
    
        <div class="bg-blue-700 rounded-xl shadow-md p-5 text-white hover:scale-105 transition">
            <i class="fas fa-id-card text-2xl mb-2"></i>
            <h4 class="font-semibold text-lg mb-1">Antrian BPJS Lama</h4>
            <p class="text-sm">Untuk pasien lama yang sudah terdaftar BPJS sebelumnya.</p>
        </div>
    </section>
@endsection
