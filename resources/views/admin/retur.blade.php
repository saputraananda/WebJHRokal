@extends('layout.app')

@section('title')
    <title>Data Retur | Jimmy Hantu Foundation</title>
@endsection

@section('content')
    <div class="pagetitle">
        <h1 style="color:#119E45">Data Retur Roti Kalkun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Retur</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="subjudul fw-bold text-dark mt-4">Tabel Retur</h4>

                        <div class="table-responsive">
                            <table id="tabelTransaksi"
                                class="table datatable table-bordered theadtransaksi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Marketing / Pembeli</th>
                                        <th>Retur</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Retur</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($transaksi->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center">Data masih kosong</td>
                                        </tr>
                                    @else
                                        @foreach($transaksi as $trs)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ \Carbon\Carbon::parse($trs->tanggal)->format('d/m/Y') }}</td>
                                                <td>{{ $trs->marketing->nama_marketing }}</td>
                                                <td>{{ $trs->retur->jumlah_retur ?? '-' }}</td>
                                                <td>{{ formatRupiah($trs->roti->harga_satuan ?? 0) }}</td>
                                                <td>{{ formatRupiah($trs->retur->total_retur ?? 0) }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('admin.detail', $trs->id_transaksi) }}"
                                                            class="btn btn-warning btn-sm" title="Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $trs->id_transaksi }}"
                                                            action="{{ route('admin.destroy', $trs->id_transaksi) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" title="Hapus"
                                                                onclick="confirmDelete({{ json_encode($trs->id_transaksi) }})">
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
                        </div> <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection