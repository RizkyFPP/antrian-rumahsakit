@extends('layouts.antrian-layout')

@section('content')
<section class="max-w-7xl mx-auto px-6 py-16">
    <div class="grid md:grid-cols-2 gap-12 items-center">
        <!-- Text Section -->
        <div>
            <h1 class="text-4xl font-bold text-gray-900 leading-tight mb-4">
                Cek Antrian
            </h1>
            <p class="text-gray-600 mb-6">
                Masukkan nomor antrian rumah sakit yang telah Anda terima untuk cek nomor antrian saat ini secara real-time.
            </p>

            <form class="space-y-4">
                <div>
                    <label for="nomor" class="block text-gray-700 mb-1">Nomor Antrian</label>
                    <input type="text" id="nomor" name="nomor"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan Nomor Antrian">
                </div>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
                    Cek Antrian
                </button>
            </form>
        </div>

        <!-- Illustration -->
        <div class="flex justify-center">
            <img src="{{ asset('images/dokter.png') }}" alt="Dokter" class="w-4/5 max-w-sm">
        </div>
    </div>
</section>
@endsection
