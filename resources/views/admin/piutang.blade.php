@extends('layout.app')

@section('title')
    <title>Data Piutang | Jimmy Hantu Foundation</title>
@endsection

@section('content')
    <div class="pagetitle">
        <h1 style="color:#119E45">Data Piutang Roti Kalkun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Piutang</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="subjudul fw-bold text-dark mt-4">Tabel Piutang</h4>
                    
                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table id="tabelTransaksi" class="table datatable table-bordered theadtransaksi">
                            <thead>
                                <tr>
                                    <th>Nomor Transaksi</th>
                                    <th>Nama Marketing</th>
                                    <th>Total Piutang</th>
                                    <th>Uang Disetor</th>
                                    <th>Tanggal Setor</th>
                                    <th>Sisa Piutang</th>
                                    <th>Penerima</th>
                                    <th>Aksi</th>
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
                                            <td>{{ $trs->id_transaksi }}</td>
                                            <td>{{ $trs->marketing->nama_marketing ?? '-' }}</td>
                                            <td>{{ formatRupiah($trs->piutang->total_piutang ?? 0) }}</td>
                                            <td>{{ formatRupiah(optional($trs->piutang->setoran)->sum('jumlah_setor') ?? 0) }}</td>
                                            <td>{{ \Carbon\Carbon::parse(optional($trs->piutang->setoran)->last()->tanggal_setor ?? now())->format('d/m/Y') }}</td>
                                            <td>{{ formatRupiah($trs->piutang->saldo_piutang ?? 0) }}</td>
                                            @php
                                                $penerimaSetoran = '-';
                                                if (
                                                    $trs->piutang &&
                                                    $trs->piutang->setoran &&
                                                    $trs->piutang->setoran instanceof \Illuminate\Support\Collection &&
                                                    $trs->piutang->setoran->isNotEmpty()
                                                ) {
                                                    $penerimaSetoran = $trs->piutang->setoran->last()->penerima->nama_marketing ?? '-';
                                                }
                                            @endphp
                                            <td>{{ $penerimaSetoran }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('admin.detail', $trs->id_transaksi) }}" class="btn btn-warning btn-sm" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $trs->id_transaksi }}" action="{{ route('admin.destroy', $trs->id_transaksi) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" title="Hapus" onclick="confirmDelete({{ $trs->id_transaksi }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection