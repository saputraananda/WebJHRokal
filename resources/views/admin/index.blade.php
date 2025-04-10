  @extends('layout.app')

  @section('title')
  <title>Dashboard Utama | Jimmy Hantu Foundation</title>
  @endsection

  @section('customCss')
  .info-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .info-card:hover {
      transform: translateY(-8px); /* Naik dikit */
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); /* Bayangan soft */
      z-index: 1;
  }
  @endsection

@section('content')
  <div class="pagetitle">
    <div class="pagetitle">
      <h1 style="color:#119E45">Dashboard Utama</h1>
      <!-- <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="utama.php">Home</a></li>
          <li class="breadcrumb-item"><a href="">Data Transaksi Penjualan</a></li>
          <li class="breadcrumb-item">Umum</li>
        </ol>
      </nav> -->
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Jumlah Transaksi -->
        <div class="container">
          <div class="row">
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Jumlah Transaksi</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$jumlahTransaksi}}</h6> <!-- Format angka -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Jumlah Pengambilan Roti -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Pengambilan Roti</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $pengambilanRoti }} pcs</h6> <!-- Format angka -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Retur-->

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">
                <div class="card-body">
                  <h5 class="card-title">Jumlah Retur</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-trash-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $jumlahRetur}}</h6> <!-- Format angka -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Setoran-->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card building-card">
                <div class="card-body">
                  <h5 class="card-title">Saldo Setoran</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cash-coin"></i>
                    </div>
                    <div class="ps-3">
                      <h6>Rp {{ number_format($saldo, 0, ',', '.') }}</h6> <!-- Format angka -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Piutang -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card harta-card">
                <div class="card-body">
                  <h5 class="card-title">Piutang</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-postcard-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>Rp {{ number_format($totalPiutang, 0, ',', '.') }}</h6> <!-- Format angka -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Jumlah Pembeli -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card harta2-card">
                <div class="card-body">
                  <h5 class="card-title">Saldo Akhir</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ formatRupiah($totalUangDisetor) }}</h6> <!-- Format angka -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card basic">
              <div class="card-body">
                <h5 class="card-title"><b>Website Pemantauan Penjualan Roti Kalkun Jimmy Hantu Foundation</b></h5>

                <div>
                  <h6><b>1. Pengetahuan Umum</b></h6>
                  <p>Website ini dapat digunakan untuk mengelola data penjualan Roti Kalkun Jimmy Hantu Foundation.</p>


                </div>

                <div class="pt-2">
                  <h6><b>2. Input Data Transaksi</b></h6>
                  <p>Website ini juga memiliki fitur "Tambah Transaksi". Fitur ini memungkinkan admin untuk menginput
                    data
                    penjualan yang masuk setiap hari dan data akan tersimpan di dalam database penjualan.
                    Silahkan kunjungi <a href="{{route('admin.create')}}">Tambah Transaksi </a>.
                  </p>
                </div>

                <div class="pt-2">
                  <h6><b>3. Monitoring</b></h6>
                  <p>Website ini juga memiliki fitur untuk memonitoring penjualan Roti Kalkun, sehingga memudahkan
                    pengguna dalam mengawasi data transaksi secara real-time. Fitur ini dirancang untuk memberikan
                    laporan yang akurat dan membantu perusahaan dalam mengambil keputusan strategis.</p>
                </div>

                <div class="pt-2">
                  <h6><b>4. Prediksi Penjualan</b></h6>
                  <p>Fitur prediksi penjualan hadir untuk membantu perusahaan dalam manajemen stok, mengurangi risiko
                    kelebihan atau kekurangan stok, serta memperkirakan permintaan pasar secara lebih efektif. Dengan
                    fitur ini, perusahaan dapat meningkatkan efisiensi operasional dan pelayanan kepada pelanggan.</p>
                </div>

              </div>
            </div>
          </div>
        </div>
@endsection