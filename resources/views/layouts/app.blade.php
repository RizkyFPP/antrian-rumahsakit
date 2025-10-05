<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Sakit - Antrian Online</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-hospital text-blue-600 text-2xl"></i>
                    <span class="font-bold text-lg">RUMAH SAKIT</span>
                </div>
            </div>
            <nav class="space-x-6">
                <a href="#" class="hover:text-blue-600">Home</a>
                <a href="#" class="hover:text-blue-600">Cek Antrian</a>
                <a href="#" class="hover:text-blue-600">Daftar Online</a>
                <a href="#" class="hover:text-blue-600">Layanan</a>
                <a href="#" class="hover:text-blue-600">Kontak</a>
            </nav>
        </div>
    </header>

    <main>
        <!-- Section Homepage -->
        <section class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <!-- Text -->
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

                <!-- Illustration -->
                <div>
                    <img src="{{ asset('images/dokter.png') }}" alt="Dokter" class="w-full max-w-md mx-auto">
                </div>
            </div>

            <!-- Features -->
            <div class="grid md:grid-cols-3 gap-6 mt-16">
                <div class="p-6 bg-white shadow rounded-lg text-center">
                    <div class="text-blue-600 text-3xl mb-4">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <h3 class="font-semibold text-lg">Cek Antrian</h3>
                    <p class="text-gray-600 mt-2">Pantau nomor antrian secara real-time</p>
                </div>
                <div class="p-6 bg-white shadow rounded-lg text-center">
                    <div class="text-green-600 text-3xl mb-4">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h3 class="font-semibold text-lg">Daftar Online</h3>
                    <p class="text-gray-600 mt-2">Booking jadwal konsultasi tanpa harus antre di loket</p>
                </div>
                <div class="p-6 bg-white shadow rounded-lg text-center">
                    <div class="text-indigo-600 text-3xl mb-4">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <h3 class="font-semibold text-lg">Info Dokter & Poli</h3>
                    <p class="text-gray-600 mt-2">Lihat jadwal dokter & layanan yang tersedia</p>
                </div>
            </div>

            <!-- Stats -->
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
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 mt-12">
        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
            <p>Jl. Kesehatan No. 123, Jakarta</p>
            <p>(021) 12845678</p>
            <div class="flex space-x-4 mt-2 md:mt-0 text-lg">
                <a href="#" class="hover:text-blue-600"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-pink-600"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-blue-400"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
