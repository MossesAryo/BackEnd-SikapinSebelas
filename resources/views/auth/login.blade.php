<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKAPIN SEBELAS - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #56A6E8 0%, #56A6E8 100%);
        }

        .floating-shape {
            animation: float 6s ease-in-out infinite;
        }

        .floating-shape:nth-child(2) {
            animation-delay: -2s;
        }

        .floating-shape:nth-child(3) {
            animation-delay: -4s;
        }

        .floating-shape:nth-child(4) {
            animation-delay: -1s;
        }

        .floating-shape:nth-child(5) {
            animation-delay: -3s;
        }

        @keyframes float {
            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-15px) rotate(5deg);
            }
        }

        .phone-3d {
            transform: perspective(1000px) rotateY(-8deg) rotateX(2deg);
            filter: drop-shadow(0 25px 50px rgba(0, 0, 0, 0.3));
        }
    </style>
</head>

<body class="min-h-screen flex font-sans">
    <!-- Left Side -->
    <div class="w-1/2 flex items-center justify-center bg-white">
        <div class="w-full max-w-sm" x-data="{ email: '', password: '', isLoading: false, showPassword: false }">
            <!-- Header -->
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-[#56A6E8]">LOGIN</h1>
                <p class="text-gray-400 text-base">Selamat Datang di Sistem Skoring</p>
            </div>

            <!-- Session Error Message -->
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">NIP</label>
                    <input type="text" name="nip" value="{{ old('nip') }}"
                        class="w-full px-4 py-2 bg-[#EAF4FE] rounded-lg border border-gray-300 focus:outline-none focus:border-[#56A6E8] transition-all"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Password</label>
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" name="password"
                            class="w-full px-4 py-2 bg-[#EAF4FE] rounded-lg border border-gray-300 focus:outline-none focus:border-[#56A6E8] transition-all"
                            required>
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-[#56A6E8]">
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Forgot -->
                <div class="text-right mt-1">
                    <a href="#" class="text-[#56A6E8] text-sm hover:underline">Lupa Password?</a>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full bg-[#56A6E8] hover:bg-[#4d96d5] text-white font-semibold py-2 rounded-lg shadow-sm transition-colors duration-200"
                    :disabled="isLoading" :class="{ 'opacity-50 cursor-not-allowed': isLoading }">
                    LOGIN
                </button>
            </form>
        </div>
    </div>

    <!-- Right Side -->
    <div class="w-1/2 bg-[#56A6E8] flex flex-col p-8 text-white relative">
        <!-- Header Top -->
        <div class="flex items-center mb-10 relative z-10">
            <div class="w-14 h-14 mr-3 bg-[#EAF4FE] rounded-full flex items-center justify-center">
                <img src="{{ asset('img/logo-sekolah.png') }}" alt="Logo" class="w-12 h-12 object-contain">
            </div>
            <h2 class="text-2xl font-bold">SIKAPIN SEBELAS</h2>
        </div>

        <!-- Content Center -->
        <div class="flex flex-col flex-grow items-center justify-center text-center relative z-10">
            <img src="{{ asset('img/logo-hp.png') }}" alt="Mockup HP" class="w-96 mb-0 mt-10" style="transform: translateY(-50px);">
            <div>
                <p class="text-sm opacity-90 leading-relaxed">
                    Mulai dari pencatatan, penilaian, hingga laporan, semuanya ada di satu aplikasi.
                </p>
                <p class="text-sm font-semibold mt-1">
                    Yuk, mulai perjalanan Anda sekarang!
                </p>
            </div>
        </div>

        <!-- Background Shapes -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute w-20 h-20 bg-white/20 rounded-full floating-shape" style="top: 10%; left: 10%;"></div>
            <div class="absolute w-16 h-16 bg-white/20 rounded-full floating-shape" style="top: 30%; right: 15%;"></div>
            <div class="absolute w-12 h-12 bg-white/20 rounded-full floating-shape" style="bottom: 20%; left: 20%;"></div>
            <div class="absolute w-24 h-24 bg-white/20 rounded-full floating-shape" style="bottom: 10%; right: 10%;"></div>
            <div class="absolute w-18 h-18 bg-white/20 rounded-full floating-shape" style="top: 50%; left: 40%;"></div>
        </div>
    </div>
</body>

</html>
