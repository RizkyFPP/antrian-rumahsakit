<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah Sakit - Antrian Online')</title>

    {{-- Tailwind via Vite --}}
    @vite('resources/css/app.css')

    {{-- Font Awesome --}}
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-KNw+JBTjFZqNnoQEGqT2W8cbiKZrP7fDy07n+74ZXqYMY2bQpuoxKPkMWuX8dlvDJzA2pGdWb9bUjZfajW0gYg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    {{-- Flatpickr CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">

    {{-- SweetAlert2 & Animate.css --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>

<body class="antialiased bg-[#013114] text-white flex flex-col min-h-screen">

    {{-- Navbar --}}
    <nav class="flex items-center justify-between px-6 md:px-12 py-6 flex-wrap">
        <div class="flex items-center space-x-2 mb-4 md:mb-0">
            <i class="fa-solid fa-circle-plus text-3xl text-white-400"></i>
            <span class="font-bold text-lg md:text-xl text-white tracking-wide">RSU Syifa Medika Banjar</span>
        </div>

        {{-- Tombol toggle menu untuk mobile --}}
        <button id="menu-btn" class="md:hidden text-white text-2xl focus:outline-none">
            <i class="fa-solid fa-bars"></i>
        </button>

        {{-- Menu --}}
        <ul id="menu" class="hidden md:flex flex-col md:flex-row w-full md:w-auto space-y-4 md:space-y-0 md:space-x-8 text-center md:text-left">
            <li><a href="{{ route('home') }}" class="hover:text-green-300 transition">Home</a></li>
            <li><a href="{{ route('cek.antrian') }}" class="hover:text-green-300 transition">Cek Antrian</a></li>
            <li><a href="{{ route('daftar-online') }}" class="hover:text-green-300 transition">Daftar Online</a></li>
            {{-- <li><a href="#" class="hover:text-green-300 transition">Layanan</a></li> --}}
        </ul>
    </nav>

    {{-- Konten Halaman --}}
    <main class="flex-1 px-4 sm:px-6 lg:px-12 py-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="text-center text-sm md:text-base py-4 bg-[#013114] mt-auto font-poppins tracking-wide">
        <div class="font-semibold text-lg md:text-xl text-white drop-shadow-[0_0_6px_rgba(255,255,255,0.8)]">
          💡 SISTEM ANTRIAN RSU Syifa Medika Banjar
        </div>
        <div class="text-gray-300 text-xs md:text-sm mt-1">
          © {{ date('Y') }}
        </div>
      </footer>    

    {{-- Flatpickr JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="module">
        flatpickr("#jadwal_konsultasi", {
            dateFormat: "d F Y",
            minDate: "today",
            locale: { firstDayOfWeek: 1 },
            disableMobile: true,
            theme: "dark",
        });

        // Toggle menu mobile
        const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');
        menuBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menu.classList.toggle('flex');
        });
    </script>

    {{-- SweetAlert2 Alert --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Pendaftaran Berhasil 🎉',
                html: '<b>{{ session('success') }}</b><br><br>Silakan datang sesuai jadwal konsultasi Anda.',
                icon: 'success',
                confirmButtonText: 'Oke',
                confirmButtonColor: '#16a34a',
                background: '#f0fdf4',
                color: '#065f46',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        </script>
    @endif

</body>
</html>
