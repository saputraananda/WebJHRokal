@extends('layout.supervisor')

@section('title')
<title>Data Retur | Jimmy Hantu Foundation</title>
@endsection

@section('content')
    <div class="pagetitle">
        <h1 style="color:#119E45">Data Retur Penjualan</h1>
        <!-- <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="utama.php">Home</a></li>
          <li class="breadcrumb-item"><a href="">Data Transaksi Penjualan</a></li>
          <li class="breadcrumb-item">Umum</li>
        </ol>
      </nav> -->
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h4 class="subjudul"
                            style="color :#000000; font-weight:bold; margin-top: 30px; margin-bottom: 20px;"> Tabel
                            Retur</h4>

                        <!-- Table with stripped rows -->
                        <table id="tabelTransaksi" class="table datatable table-bordered theadtransaksi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Marketing / Pembeli</th>
                                    <th>Jumlah Pengambilan</th>
                                    <th>Harga Satuan</th>
                                    <th>Jumlah Retur</th>
                                    <th>Total Retur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($transaksi->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">Data masih kosong</td>
                                    </tr>
                                @else
                                    @foreach($transaksi as $trs)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($trs->tanggal)->format('d/m/Y') }}</td>
                                            <td>{{ $trs->nama_marketing }}</td>
                                            <td>{{ $trs->jumlah_pengambilan_roti }}</td>
                                            <td>{{ formatRupiah($trs->harga_satuan) }}</td>
                                            <td>{{ $trs->jumlah_retur }}</td>
                                            <td>{{ formatRupiah($trs->total_retur)}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->


                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection