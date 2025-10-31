<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RSU Syifa Medika Banjar</title>

    <!-- TailwindCSS & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top left, #002b1e, #000);
            overflow: hidden;
        }

        /* Animated glowing background orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.6;
            animation: float 12s ease-in-out infinite alternate;
        }
        .orb1 {
            background: #00ffc3;
            width: 350px;
            height: 350px;
            top: -80px;
            left: -100px;
        }
        .orb2 {
            background: #008cff;
            width: 300px;
            height: 300px;
            bottom: -100px;
            right: -80px;
            animation-delay: 4s;
        }
        @keyframes float {
            from { transform: translateY(0px); }
            to { transform: translateY(40px); }
        }

        /* Glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 30px rgba(0, 255, 195, 0.1);
            transition: all 0.3s ease;
        }
        .glass:hover {
            box-shadow: 0 0 40px rgba(0, 255, 195, 0.25);
            transform: scale(1.02);
        }

        .glow-text {
            text-shadow: 0 0 10px #00ffc3, 0 0 20px #00ffc3;
        }

        .input-glow:focus {
            box-shadow: 0 0 10px rgba(0, 255, 195, 0.4);
            border-color: #00ffc3;
        }

        /* Floating animation for logo */
        .float {
            animation: floaty 3.5s ease-in-out infinite;
        }
        @keyframes floaty {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center relative text-white">

    <!-- Background orbs -->
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>

    <div class="glass rounded-3xl p-10 w-[90%] max-w-md text-center relative z-10">
        <!-- Logo & Title -->
        <div class="mb-8">
            <img src="{{ asset('images/dokter.png') }}" alt="Logo RSU Syifa Medika"
                 class="mx-auto w-24 h-24 mb-4 float">
            <h1 class="text-3xl font-bold glow-text">Login Sistem Antrian</h1>
            <p class="text-gray-300 mt-1 text-sm">Selamat datang di RSU Syifa Medika Banjar</p>
        </div>

        <!-- Error Message -->
        @if(session('error'))
            <div class="bg-red-500 text-white py-2 px-4 rounded mb-4">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login.process') }}" class="space-y-6">
            @csrf

            <!-- Username -->
            <div class="text-left">
                <label for="username" class="block text-gray-200 font-semibold mb-1">Username</label>
                <div class="relative">
                    <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                        class="input-glow w-full pl-10 pr-4 py-3 rounded-lg bg-gray-900 bg-opacity-60 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-teal-400 focus:outline-none">
                </div>
                @error('username')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="text-left">
                <label for="password" class="block text-gray-200 font-semibold mb-1">Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    <input id="password" type="password" name="password" required
                        class="input-glow w-full pl-10 pr-10 py-3 rounded-lg bg-gray-900 bg-opacity-60 text-gray-100 border border-gray-700 focus:ring-2 focus:ring-teal-400 focus:outline-none">
                    <i id="togglePassword" class="fas fa-eye absolute right-3 top-3 text-gray-400 cursor-pointer"></i>
                </div>
                @error('password')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-teal-400 to-emerald-500 hover:from-emerald-400 hover:to-teal-500 text-white font-semibold py-3 rounded-lg shadow-lg transition transform hover:scale-[1.03] focus:ring-4 focus:ring-teal-400/40">
                <i class="fas fa-sign-in-alt mr-2"></i>Masuk
            </button>

            <!-- Footer -->
            <p class="text-gray-400 text-sm mt-8">
                © {{ date('Y') }} RSU Syifa Medika Banjar
            </p>
        </form>
    </div>

    <!-- Password toggle -->
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.classList.toggle("fa-eye-slash");
        });
    </script>
</body>
</html>
