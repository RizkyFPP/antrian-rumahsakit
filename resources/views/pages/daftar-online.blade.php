@extends('layouts.app')

@section('title', 'Daftar Online - Rumah Sakit')

@section('content')
<section class="relative flex flex-col md:flex-row justify-between items-center px-6 md:px-20 py-16 bg-[#013114] text-white overflow-hidden flex-grow">
    <div class="absolute inset-0 bg-gradient-to-br from-[#013114] via-[#013114] to-[#013114] opacity-90"></div>

    {{-- Bagian kiri (form pendaftaran) --}}
    <div class="relative z-10 w-full md:w-1/2 max-w-md space-y-6">
        <h1 class="text-4xl md:text-5xl font-extrabold text-green-300 leading-tight">
            Daftar Online
        </h1>
        <p class="text-gray-300 text-base md:text-lg">
            Booking jadwal konsultasi dokter tanpa harus antre di loket. Mudah, cepat, dan aman.
        </p>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                html: `{!! nl2br(e(session('success'))) !!}`, // tampilkan HTML dengan aman
                showConfirmButton: false,
                timer: 3500,
                background: '#012b10',
                color: '#eafff9'
            });
        </script>
        @endif

        {{-- Notifikasi error --}}
        @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: `{!! nl2br(e(session('error'))) !!}`,
                confirmButtonColor: '#d33',
                background: '#012b10',
                color: '#fff'
            });
        </script>
        @endif

        {{-- Form pendaftaran --}}
        <form action="{{ route('daftar-online.store') }}" method="POST"
              id="formDaftar"
              class="space-y-4 bg-[#012b10] p-6 md:p-8 rounded-xl border border-green-800 shadow-xl">
            @csrf

            {{-- Nama Lengkap --}}
            <div>
                <label class="block text-sm font-medium mb-1 text-green-200">Nama Lengkap</label>
                <input 
                    id="nama"
                    name="nama"
                    type="text" 
                    placeholder="Masukkan nama lengkap"
                    class="w-full px-4 py-3 rounded-lg bg-[#013a16] border border-green-700 
                           focus:ring-2 focus:ring-green-500 outline-none text-white 
                           placeholder-gray-400 transition"
                >
            </div>

            {{-- Nomor HP --}}
            <div>
                <label class="block text-sm font-medium mb-1 text-green-200">Nomor HP</label>
                <input 
                    id="nohp"
                    name="nohp"
                    type="text" 
                    placeholder="Masukkan nomor HP"
                    class="w-full px-4 py-3 rounded-lg bg-[#013a16] border border-green-700 
                           focus:ring-2 focus:ring-green-500 outline-none text-white 
                           placeholder-gray-400 transition"
                >
            </div>

            {{-- Nomor BPJS --}}
            <div>
                <label class="block text-sm font-medium mb-1 text-green-200">Nomor BPJS</label>
                <div class="relative">
                    <i class="fa-solid fa-id-card absolute left-4 top-1/2 transform 
                              -translate-y-1/2 text-green-400 z-10"></i>
                    <input 
                        id="no_bpjs"
                        name="no_bpjs"
                        type="text" 
                        placeholder="Masukkan nomor BPJS (jika ada)"
                        class="w-full pl-12 pr-4 py-3 rounded-lg bg-[#013a16] border border-green-700 
                               focus:ring-2 focus:ring-green-500 outline-none text-white 
                               placeholder-gray-400 transition"
                    >
                </div>
                <p class="text-xs text-gray-400 mt-1">Isi jika Anda pengguna BPJS</p>
            </div>

            {{-- Jadwal Konsultasi --}}
            {{-- <div>
                <label class="block text-sm font-medium mb-2 text-green-200">
                    Jadwal Konsultasi
                </label>

                <div class="flex flex-col md:flex-row gap-3"> --}}
                    {{-- Tanggal --}}
                    {{-- <div class="relative w-full md:w-1/2">
                        <i class="fa-solid fa-calendar-days absolute left-4 top-1/2 transform 
                                  -translate-y-1/2 text-green-400 z-10"></i>
                        <input 
                            id="jadwal_tanggal"
                            name="jadwal_tanggal"
                            type="date"
                            class="w-full pl-12 pr-4 py-3 rounded-lg bg-[#013a16] border border-green-700 
                                   text-gray-300 focus:ring-2 focus:ring-green-500 outline-none 
                                   transition duration-200 cursor-pointer [color-scheme:dark]"
                        >
                    </div> --}}

                    {{-- Jam --}}
                    {{-- <div class="relative w-full md:w-1/2">
                        <i class="fa-solid fa-clock absolute left-4 top-1/2 transform 
                                  -translate-y-1/2 text-green-400 z-10"></i>
                        <input 
                            id="jadwal_jam"
                            name="jadwal_jam"
                            type="time"
                            class="w-full pl-12 pr-4 py-3 rounded-lg bg-[#013a16] border border-green-700 
                                   text-gray-300 focus:ring-2 focus:ring-green-500 outline-none 
                                   transition duration-200 cursor-pointer [color-scheme:dark]"
                        >
                    </div>
                </div>
            </div> --}}

            {{-- Tombol Submit --}}
            <button
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg 
                       transition duration-200 shadow-md">
                <i class="fa-solid fa-user-plus mr-2"></i> Daftar Sekarang
            </button>
        </form>
    </div>

    {{-- Bagian kanan (gambar dokter) --}}
    <div class="relative z-10 w-full md:w-1/2 flex justify-center md:justify-start mt-10 md:mt-0">
        <div class="relative">
            <div class="absolute inset-0 bg-[#013114] rounded-full blur-3xl opacity-50"></div>
            <img 
                src="{{ asset('images/doctor.png') }}" 
                alt="Dokter"
                class="relative w-56 sm:w-64 md:w-72 lg:w-80 h-auto object-contain drop-shadow-2xl 
                       -ml-10 md:-ml-14"
                style="filter: brightness(0.95) saturate(1.2);"
            >
        </div>
    </div>
</section>
@endsection
