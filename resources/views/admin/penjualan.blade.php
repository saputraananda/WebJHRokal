@extends('layout.app')

@section('title')
    <title>Data Penjualan | Jimmy Hantu Foundation</title>
@endsection

@section('content')
    <div class="pagetitle">
        <h1 style="color:#119E45">Data Transaksi Roti Kalkun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Penjualan</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="subjudul fw-bold text-dark mt-4">Tabel Penjualan</h4>

                        <!-- Table with responsive and clean layout -->
                        <div class="table-responsive">
                            <table id="tabelTransaksi" class="table table-bordered align-middle datatable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Marketing</th>
                                        <th>Varian</th>
                                        <th>Pengambilan</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($transaksi->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Data masih kosong</td>
                                        </tr>
                                    @else
                                        @foreach($transaksi as $trs)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ \Carbon\Carbon::parse($trs->tanggal)->format('d/m/Y') }}</td>
                                                <td>{{ $trs->marketing->nama_marketing }}</td>
                                                <td>{{ $trs->roti->nama_roti }}</td>
                                                <td>{{ $trs->jumlah_pengambilan }}</td>
                                                <td>
                                                    @if($trs->status === 'Lunas')
                                                        <span class="badge-status badge-lunas">Lunas</span>
                                                    @else
                                                        <span class="badge-status badge-belum"> {{ $trs->status }} </span>
                                                    @endif
                                                </td>

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
                                                                onclick="confirmDelete({{ $trs->id_transaksi }})">
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
                        <!-- End table -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection