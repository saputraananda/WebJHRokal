<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login | Jimmy Hantu Foundation</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/jimmy.png') }}" rel="icon">
    <link href="{{ asset('assets/img/jimmy.png') }}" rel="apple-touch-icon">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-[#E6F4EA] flex justify-center items-center min-h-screen px-4">

    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">

        <!-- Bagian kiri: Info -->
        <div class="md:w-1/2 bg-cover bg-center bg-no-repeat text-white p-8 flex flex-col justify-between"
            style="background-image: url('/assets/img/Rokal2.jpeg');">
            <div>
                <h2 class="text-4xl font-extrabold drop-shadow-lg">Selamat Datang</h2>
                <p class="mt-2 drop-shadow">Website Admin Roti Jimmy Hantu Foundation</p>
            </div>
            <p class="italic font-semibold text-center drop-shadow">"Kembalikan Indonesia Menjadi Indonesia"</p>
        </div>

        <!-- Bagian kanan: Login Form dengan Glassmorphism -->
        <div class="md:w-1/2 bg-white/80 backdrop-blur-lg shadow-xl rounded-r-2xl p-8">
            <h3 class="text-3xl font-bold text-[#119E45]">Halaman Login</h3>
            <p class="text-gray-600 mb-4">Silahkan masuk ke akun anda</p>

            <form action="{{ route('auth.login') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Username -->
                <div>
                    <label class="text-sm font-semibold text-gray-700">Username</label>
                    <input type="text" name="username" required placeholder="Masukkan Username"
                        class="w-full bg-gray-100 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#119E45]">
                </div>

                <!-- Password -->
                <div x-data="{ show: false }">
                    <label class="text-sm font-semibold text-gray-700">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="password" required placeholder="••••••"
                            class="w-full bg-gray-100 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#119E45]">
                        <button type="button" @click="show = !show" class="absolute top-3 right-3">
                            👁️
                        </button>
                    </div>
                </div>

                <!-- Tombol Login -->
                <button type="submit"
                    class="w-full bg-[#119E45] hover:bg-[#0D7A34] text-white font-semibold py-3 rounded-lg transition-all shadow hover:shadow-lg">
                    Masuk
                </button>
            </form>

            <!-- Slider Logo -->
            <div class="mt-6 overflow-hidden relative">
                <div class="flex gap-3 animate-marquee">
                    @foreach (range(1, 50) as $item)
                        <img src="{{ asset('assets/img/ZPT.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                        <img src="{{ asset('assets/img/NPK.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                        <img src="{{ asset('assets/img/Trico.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                        <img src="{{ asset('assets/img/Lanang.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                        <img src="{{ asset('assets/img/RapetWangi.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                        <img src="{{ asset('assets/img/NagaLangitan.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                        <img src="{{ asset('assets/img/WijayaKusuma.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                        <img src="{{ asset('assets/img/MutiaraKeraton.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                        <img src="{{ asset('assets/img/SekarWangi.png') }}" alt="Logo" class="h-20 w-20 flex-shrink-0">
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-300%);
            }
        }

        .animate-marquee {
            animation: marquee 20s linear infinite;
        }
    </style>
</body>

</html>