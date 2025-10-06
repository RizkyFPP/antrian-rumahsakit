<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah Sakit - Antrian Online')</title>

    <!--  Tailwind via Vite -->
    @vite('resources/css/app.css')

    <!--  Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-KNw+JBTjFZqNnoQEGqT2W8cbiKZrP7fDy07n+74ZXqYMY2bQpuoxKPkMWuX8dlvDJzA2pGdWb9bUjZfajW0gYg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>

<body class="antialiased bg-[#013114] text-white flex flex-col min-h-screen">

    <!--  Navbar -->
    <nav class="flex items-center justify-between px-12 py-6">
        <div class="flex items-center space-x-2">
            <i class="fa-solid fa-circle-plus text-3xl text-white-400"></i>
            <span class="font-bold text-lg text-white tracking-wide">RSU Syifa Medika Banjar</span>
        </div>
        <ul class="flex space-x-8">
            <li><a href="{{ route('home') }}" class="hover:text-green-300 transition">Home</a></li>
            <li><a href="{{ route('antrian') }}" class="hover:text-green-300 transition">Cek Antrian</a></li>
            <li><a href="#" class="hover:text-green-300 transition">Daftar Online</a></li>
            <li><a href="#" class="hover:text-green-300 transition">Layanan</a></li>
        </ul>
    </nav>

    <!--  Konten Halaman -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!--  Footer -->
    <footer class="text-center py-8 text-gray-300">
        <div class="flex justify-center items-center gap-8 mb-3 text-sm">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-location-dot"></i>
                <span>Jl. Kesehatan No. 123, Jakarta</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-phone"></i>
                <span>(021) 12845678</span>
            </div>
        </div>

        <div class="flex justify-center gap-6 text-lg mt-2">
            <a href="#" class="hover:text-green-400"><i class="fab fa-facebook"></i></a>
            <a href="#" class="hover:text-green-400"><i class="fab fa-twitter"></i></a>
            <a href="#" class="hover:text-green-400"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

</body>
</html>
