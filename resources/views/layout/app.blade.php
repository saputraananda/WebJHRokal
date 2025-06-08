@php
    use Illuminate\Support\Facades\Request;
    use Illuminate\Support\Facades\View;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    @yield('title')
    <meta content="" name="description">
    <meta content="" name="keywords">


    <!-- Favicons -->
    <link href="{{ asset('assets/img/jimmy.png') }}" rel="icon">
    <link href="{{ asset('assets/img/jimmy.png') }}" rel="apple-touch-icon">

    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        @yield('customCss')

        /* Chrome, Safari, Edge, Opera */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .otomatis {
            color: rgb(255, 0, 0);
        }

        .copirite {
            margin-top: -20px;
        }

        .puter {
            margin-top: -30px;
        }

        .btn-custom {
            width: 120px;
            /* Set a fixed width or adjust as needed */
            margin-top: 20px;
        }

        .text-danger {
            color: red;
        }

        input:focus,
        textarea:focus,
        select:focus {
            background-color: transparent !important;
            /* Hilangkan warna biru */
            box-shadow: none !important;
            /* Hilangkan efek bayangan */
            outline: none;
            /* Hilangkan outline */
        }

        /* Style untuk tabel */
        .table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            margin: 20px 0;
            font-size: 14px;
            text-align: center;
            /* Pusatkan teks secara horizontal */
        }

        /* Header tabel */
        .table thead th {
            background-color: #119E45;
            /* Hijau */
            color: white;
            padding: 10px;
            text-align: center !important;
            border: 1px solid #ddd;
            vertical-align: middle;
            /* Pusatkan teks secara vertikal */
        }

        /* Sel tabel */
        .table tbody td {
            border: 1px solid #ddd;
            padding: 10px;
            vertical-align: middle;
            /* Pusatkan teks secara vertikal */
            text-align: center;
            /* Pusatkan teks secara horizontal */
        }

        /* Alternating row colors for better readability */
        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        /* Hover effect for table rows */
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .iframe-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* Rasio 16:9 (lebar/tinggi * 100) */
            height: 0;
            overflow: hidden;
        }

        /* Gaya untuk iframe */
        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        @keyframes pulse {
            0% {
                opacity: 0.2;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.03);
            }

            100% {
                opacity: 0.2;
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <!-- Spinner Fullscreen -->
    <div id="loading-spinner" style="
    position: fixed;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.85);
    z-index: 9999;
    top: 0;
    left: 0;
    display: none; /* default disembunyikan */
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
    font-family: 'Poppins', sans-serif;
">
        <img src="{{ asset('assets/img/load.gif') }}" alt="Loading..." style="width: 80px; height: 80px;">

        <h5 style="
        margin-top: 15px;
        font-size: 18px;
        color: #333;
        animation: pulse 1.5s infinite;
    ">
            Sabar yaa!, data prediksi sedang diprosesss...
        </h5>
    </div>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href=" " class="logo d-flex align-items-center">
                <img src="{{asset('assets/img/jimmy.png')}}" alt="">
                <span class="d-none d-lg-block">Jimmy Hantu Foundation</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <!-- <img src={{ asset('assets/img/profil.jpeg') }} alt="Profile" class="rounded-circle"> -->
                        <span class="d-none d-md-block dropdown-toggle ps-2">Admin Rokal</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ $user->username }}</h6>
                            <span>Jimmy Hantu Foundation</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.index') ? '' : 'collapsed' }}"
                    href="{{ route('admin.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard Utama</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.penjualan') ? '' : 'collapsed' }}"
                    href="{{ route('admin.penjualan') }}">
                    <i class="bi bi-receipt-cutoff"></i>
                    <span>Data Penjualan</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.retur') ? '' : 'collapsed' }}"
                    href="{{ route('admin.retur') }}">
                    <i class="bi bi-backspace"></i>
                    <span>Data Retur</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.piutang') ? '' : 'collapsed' }}"
                    href="{{ route('admin.piutang') }}">
                    <i class="bi bi-wallet2"></i>
                    <span>Data Piutang</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.create') ? '' : 'collapsed' }}"
                    href="{{ route('admin.create') }}">
                    <i class="bi bi-file-plus"></i>
                    <span>Tambah Transaksi</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link with-loader {{ Request::routeIs('admin.predict') ? '' : 'collapsed' }}"
                    href="{{ route('admin.predict') }}">
                    <i class="bi bi-bar-chart"></i>
                    <span>Prediksi Penjualan</span>
                </a>
            </li>
        </ul>
    </aside><!-- END SIDEBAR-->

    <main id="main" class="main">
        @yield('content')

        <!-- Copyright -->
        @unless(View::hasSection('hide_footer'))
            <footer>
                <div class="copirite">
                    <div class="text-center text-black p-1">
                        © Jimmy Hantu Foundation |
                        <a class="text-black" href="https://petaniberdasi.com">Saatnya Petani Berdasi</a>
                    </div>
                </div>
            </footer>
        @endunless
        <!-- Copyright -->

    </main>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentPath = window.location.pathname;

            @if(session('success'))
                @if(request()->routeIs('login') || request()->is('login') || request()->routeIs('admin.index'))
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: '{{ session("success") }}',
                        showConfirmButton: false,
                        timer: 6000,
                        timerProgressBar: true
                    });
                @else
                    Swal.fire({
                        title: 'Berhasil!',
                        text: '{{ session("success") }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                @endif
            @endif
        }); // ← ini harus ada
    </script>


    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    <script>
        document.querySelectorAll('input[type=number]').forEach(input => {
            input.addEventListener('wheel', function (e) {
                this.blur();
            });
        });
    </script>

    <script>
        document.querySelectorAll('a.with-loader').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetUrl = this.getAttribute('href');

                const spinner = document.getElementById('loading-spinner');
                if (spinner) {
                    spinner.style.display = 'flex';
                }

                setTimeout(() => {
                    window.location.href = targetUrl;
                }, 300); // biar spinner sempet muncul
            });
        });
    </script>

    @yield('customScript')

</body>

</html>