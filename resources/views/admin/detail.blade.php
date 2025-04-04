@extends('layout.app')

@section('title')
    <title>Data Penjualan | Jimmy Hantu Foundation</title>
@endsection

@section('content')
    <div class="pagetitle">
        <h1 style="color:#119E45">Data Transaksi Roti Kalkun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.penjualan') }}">Data Penjualan</a></li>
                <li class="breadcrumb-item"><a href="#">Detail Transaksi</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section my-4">
        <div class="row">
            <div class="col-lg-12">

                {{-- Info Umum --}}
                <div id="infoCard" class="card">
                    <div class="card-body">
                        <h4 class="subjudul fw-bold text-dark mb-4 mt-4">Informasi Umum</h4>
                        <div class="row">
                            {{-- Kolom 1 --}}
                            <div class="col-md-3">
                                <p class="card-text"><strong>Nomor Transaksi: </strong>{{ $transaksi->id_transaksi }}</p>
                                <p class="card-text"><strong>Nama Marketing:
                                    </strong>{{ $transaksi->marketing->nama_marketing }}</p>
                            </div>

                            {{-- Kolom 2 --}}
                            <div class="col-md-3">
                                <p class="card-text"><strong>Wilayah:
                                    </strong>{{ $transaksi->wilayah->nama_toko ?? '-' }}</p>
                                <p class="card-text"><strong>Jenis Roti: </strong>{{ $transaksi->roti->nama_roti }}</p>
                            </div>

                            {{-- Kolom 3 --}}
                            <div class="col-md-3">
                                <p class="card-text"><strong>Data Masuk: </strong>{{ $transaksi->created_at }} WIB</p>
                                <p class="card-text"><strong>Update Terakhir: </strong>{{ $transaksi->updated_at }} WIB</p>
                            </div>

                            {{-- Kolom 4: Penerima Setoran --}}
                            <div class="col-md-3">
                                @php
                                    $penerima = null;
                                    if ($transaksi->piutang && $transaksi->piutang->setoran && $transaksi->piutang->setoran->isNotEmpty()) {
                                        $penerima = $transaksi->piutang->setoran->last()->penerima->nama_marketing ?? '-';
                                    }
                                @endphp

                                @if($penerima)
                                    <p class="card-text">
                                        <strong>Penerima Setoran: </strong>{{ $penerima }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Detail Transaksi --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="subjudul fw-bold text-dark mb-4 mt-4">Detail Transaksi</h4>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Varian Roti</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Pengambilan</th>
                                        <th>Total</th>
                                        <th>Jumlah Retur</th>
                                        <th>Total Retur</th>
                                        <th>Yang Harus Disetor</th>
                                        <th>Yang Sudah Disetor</th>
                                        <th>Sisa Setoran</th>
                                        <th>% Dibayar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $jumlahSetoran = $transaksi->piutang && $transaksi->piutang->setoran
                                            ? $transaksi->piutang->setoran->sum('jumlah_setor')
                                            : 0;

                                        $sisaSetoran = $transaksi->total_setoran - $jumlahSetoran;
                                        $persenSetor = $transaksi->total_setoran > 0
                                            ? round(($jumlahSetoran / $transaksi->total_setoran) * 100)
                                            : 0;
                                    @endphp

                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y') }}</td>
                                        <td>{{ $transaksi->roti->nama_roti }}</td>
                                        <td>{{ formatRupiah($transaksi->roti->harga_satuan) }}</td>
                                        <td>{{ $transaksi->jumlah_pengambilan }}</td>
                                        <td>{{ formatRupiah($transaksi->total_harga) }}</td>
                                        <td>{{ $transaksi->retur->jumlah_retur ?? '-' }}</td>
                                        <td>{{ formatRupiah($transaksi->total_retur) }}</td>
                                        <td>{{ formatRupiah($transaksi->total_setoran) }}</td>
                                        <td>{{ formatRupiah($jumlahSetoran) }}</td>
                                        <td>
                                            @if($sisaSetoran > 0)
                                                <span class="text-danger">{{ formatRupiah(max($sisaSetoran, 0)) }}</span>
                                            @else
                                                <span class="text-success">{{ formatRupiah(0) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info text-dark">{{ $persenSetor }}%</span>
                                        </td>
                                        <td>
                                            @if($transaksi->status === 'Lunas')
                                                <span class="badge-status badge-lunas">Lunas</span>
                                            @else
                                                <span class="badge-status badge-belum">{{ $transaksi->status }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.edit', $transaksi->id_transaksi) }}"
                                                class="btn btn-sm btn-outline-primary" title="Edit Transaksi">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection