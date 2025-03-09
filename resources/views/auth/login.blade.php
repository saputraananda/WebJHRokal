<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login | Jimmy Hantu Foundation</title>

    <!-- Favicons -->
    <link href={{ asset('assets/img/jimmy.png') }} rel="icon">
    <link href={{asset('assets/img/jimmy.png')}}rel="apple-touch-icon">


    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    <style>
        /* Efek Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        }

        @keyframes scroll {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-200%);
            }
        }

        .animate-scroll {
            display: flex;
            white-space: nowrap;
            animation: scroll 13s linear infinite;
        }
    </style>
</head>

<body class="bg-[#E6F4EA] flex justify-center items-center min-h-screen px-4">

    <div class="container mx-auto">
        <div class="max-w-4xl mx-auto flex flex-wrap bg-white rounded-2xl shadow-lg overflow-hidden">

            <!-- Kiri: Informasi -->
            <div class="w-full md:w-1/2 p-8 flex flex-col justify-between text-white rounded-l-2xl bg-cover bg-center bg-no-repeat"
                style="background-image: url('/assets/img/Rokal2.jpeg');">
                <div>
                    <h2 class="text-4xl font-black drop-shadow-lg">Selamat Datang</h2>
                    <p class="mt-2 text-white drop-shadow-lg">Website Admin Roti Jimmy Hantu Foundation</p>
                </div>
                <div class="mt-8">
                    <p class="italic text-center text-white font-bold drop-shadow-lg">"Kembalikan Indonesia Menjadi Indonesia"</p>
                </div>
            </div>

            <!-- Kanan: Form Login -->
            <div class="w-full md:w-1/2 p-8 bg-[#F8FDF7] rounded-r-2xl">
                <h3 class="text-3xl font-bold text-[#119E45]">Halaman Login</h3>
                <p class="text-gray-600">silahkan masuk ke akun anda</p>

                @if (session('error'))
                    <div class="mt-4 text-red-600 text-sm bg-red-100 p-3 rounded-lg">{{ session('error') }}</div>
                @endif

                <form action="{{ route('auth.login') }}" method="POST" class="mt-6 space-y-4">
                    @csrf

                    <!-- Username Input -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700">Username</label>
                        <input type="text" name="username"
                            class="w-full px-4 py-3 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-[#119E45]"
                            placeholder="Masukkan Username" required>
                        @error('username')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div x-data="{ showPassword: false }">
                        <label class="text-sm font-semibold text-gray-700">Password</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password"
                                class="w-full px-4 py-3 rounded-lg bg-gray-100 border border-gray-300 focus:ring-2 focus:ring-[#119E45]"
                                placeholder="******" required>
                            <button type="button" class="absolute right-3 top-3 text-gray-600"
                                @click="showPassword = !showPassword">
                                👁️
                            </button>
                        </div>
                        @error('password')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit"
                        class="w-full bg-[#119E45] hover:bg-[#0D7A34] text-white font-semibold py-3 rounded-lg transition-all shadow-md hover:shadow-lg">
                        Masuk
                    </button>
                </form>

                <!-- Footer dengan Logo (Auto-Slide) -->
                <div class="mt-5 overflow-hidden relative w-full">
                    <div class="flex gap-3 animate-scroll">
                        @for ($i = 0; $i < 500; $i++)
                            <img src="{{ asset('assets/img/ZPT.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                            <img src="{{ asset('assets/img/NPK.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                            <img src="{{ asset('assets/img/Trico.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                            <img src="{{ asset('assets/img/Lanang.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                            <img src="{{ asset('assets/img/RapetWangi.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                            <img src="{{ asset('assets/img/NagaLangitan.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                            <img src="{{ asset('assets/img/WijayaKusuma.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                            <img src="{{ asset('assets/img/MutiaraKeraton.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                            <img src="{{ asset('assets/img/SekarWangi.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                        @endfor
                    </div>
                </div>

            </div>


        </div>
    </div>
</body>

</html>