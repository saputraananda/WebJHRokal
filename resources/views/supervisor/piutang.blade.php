@extends('layout.supervisor')

@section('title')
<title>Data Setor | Jimmy Hantu Foundation</title>
@endsection

@section('content')
    <div class="pagetitle">
        <h1 style="color:#119E45">Data Setoran Transaksi</h1>
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
                            Setoran</h4>

                        <!-- Table with stripped rows -->
                        <table id="tabelTransaksi" class="table datatable table-bordered theadtransaksi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Marketing / Pembeli</th>
                                    <th>Total Setoran</th>
                                    <th>Uang Disetor</th>
                                    <th>Sisa Piutang</th>
                                    <th>Tanggal Setor</th>
                                    <th>Penerima</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksi as $trs)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($trs->tanggal)->format('d/m/Y') }}</td>
                                        <td>{{ $trs->nama_marketing }}</td>
                                        <td>{{ formatRupiah($trs->total_setoran)}}</td>
                                        <td>{{ formatRupiah($trs->uang_disetor)}}</td>
                                        <td>{{ formatRupiah($trs->sisa_piutang)}}</td>
                                        <td>{{ \Carbon\Carbon::parse($trs->tanggal_setor)->format('d/m/Y') }}</td>
                                        <td>{{ $trs->penerima_setoran}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection