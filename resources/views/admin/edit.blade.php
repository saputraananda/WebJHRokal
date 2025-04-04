@extends('layout.app')

@section('title')
    <title>Edit Data Penjualan | Jimmy Hantu Foundation</title>
@endsection

@section('content')
    <div class="pagetitle">
        <h1 style="color:#119E45">Edit Data Transaksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.penjualan') }}">Data Penjualan</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Detail Transaksi</a></li>
                <li class="breadcrumb-item active">Edit Transaksi</li>
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <h4 class="subjudul text-dark fw-bold mt-4 mb-4">Form Edit Transaksi Penjualan</h4>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.update', $transaksi->id_transaksi) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                {{-- KIRI --}}
                                <div class="col-md-4">
                                    {{-- Tanggal --}}
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal" class="form-control"
                                            value="{{ old('tanggal', $transaksi->tanggal) }}" required>
                                    </div>

                                    {{-- Nama Marketing --}}
                                    <div class="mb-3">
                                        <label class="form-label">Nama Marketing <span class="text-danger">*</span></label>
                                        <select name="id_marketing" class="form-select" required>
                                            <option disabled>Pilih Marketing</option>
                                            @foreach($marketing as $item)
                                                <option value="{{ $item->id_marketing }}" {{ $transaksi->id_marketing == $item->id_marketing ? 'selected' : '' }}>
                                                    {{ $item->nama_marketing }}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Wilayah --}}
                                    <div class="mb-3">
                                        <label for="id_toko" class="form-label">Wilayah <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="id_toko" required>
                                            <option disabled {{ is_null($transaksi->id_toko ?? null) ? 'selected' : '' }}>
                                                Pilih Toko</option>
                                            @foreach($wilayah as $item)
                                                <option value="{{ $item->id_toko }}"
                                                    @selected($transaksi->id_toko == $item->id_toko)>
                                                    {{ $item->nama_toko }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Varian Roti --}}
                                    <div class="mb-3">
                                        <label class="form-label">Varian Roti <span class="text-danger">*</span></label>
                                        <select name="id_roti" class="form-select" id="id_roti" required>
                                            <option disabled>Pilih Roti</option>
                                            @foreach($roti as $item)
                                                <option value="{{ $item->id_roti }}" data-harga="{{ $item->harga_satuan }}"
                                                    @selected($transaksi->id_roti == $item->id_roti)>
                                                    {{ $item->nama_roti }}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Jumlah Pengambilan --}}
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Pengambilan</label>
                                        <input type="number" name="jumlah_pengambilan" id="jumlah_pengambilan"
                                            class="form-control"
                                            value="{{ old('jumlah_pengambilan', $transaksi->jumlah_pengambilan) }}"
                                            required>
                                    </div>
                                </div>
                                {{-- TENGAH --}}
                                <div class="col-md-4">
                                    {{-- Harga Satuan --}}
                                    <div class="mb-3">
                                        <label class="form-label">Harga Satuan</label>
                                        <input type="text" class="form-control" id="harga_satuan_display"
                                            value="{{ number_format($transaksi->roti->harga_satuan ?? 0, 0, ',', '.') }}"
                                            readonly>
                                        <input type="hidden" name="harga_satuan" id="harga_satuan"
                                            value="{{ $transaksi->roti->harga_satuan ?? 0 }}">
                                    </div>

                                    {{-- Total Harga --}}
                                    <div class="mb-3">
                                        <label class="form-label">Total Harga</label>
                                        <input type="text" class="form-control" id="total_harga_display"
                                            value="{{ number_format($transaksi->total_harga, 0, ',', '.') }}" readonly>
                                        <input type="hidden" name="total_harga" id="total_harga"
                                            value="{{ $transaksi->total_harga }}">
                                    </div>

                                    {{-- Jumlah Retur --}}
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Retur</label>
                                        <input type="number" name="jumlah_retur" id="jumlah_retur" class="form-control"
                                            value="{{ old('jumlah_retur', $transaksi->retur->jumlah_retur ?? 0) }}">
                                    </div>

                                    {{-- Total Retur --}}
                                    <div class="mb-3">
                                        <label class="form-label">Total Retur</label>
                                        <input type="text" class="form-control" id="total_retur_display"
                                            value="{{ number_format($transaksi->total_retur ?? 0, 0, ',', '.') }}" readonly>
                                        <input type="hidden" name="total_retur" id="total_retur"
                                            value="{{ $transaksi->total_retur ?? 0 }}">
                                    </div>

                                    {{-- Total Setoran --}}
                                    <div class="mb-3">
                                        <label class="form-label">Total Setoran</label>
                                        <input type="text" class="form-control" id="total_setoran_display"
                                            value="{{ number_format($transaksi->total_setoran, 0, ',', '.') }}" readonly>
                                        <input type="hidden" name="total_setoran" id="total_setoran"
                                            value="{{ $transaksi->total_setoran }}">
                                    </div>
                                </div>

                                {{-- KANAN --}}
                                <div class="col-md-4">
                                    {{-- Uang Disetor (Input Tambahan) --}}
                                    <div class="mb-3">
                                        <label class="form-label">Uang Disetor (Tambahan)</label>
                                        <input type="number" step="0.01" name="uang_disetor" id="uang_disetor"
                                            class="form-control" value="{{ old('uang_disetor') }}">
                                    </div>

                                    {{-- Sisa Piutang --}}
                                    <div class="mb-3">
                                        <label class="form-label">Sisa Piutang</label>

                                        {{-- Input tampilannya: hanya buat dilihat --}}
                                        <input type="text" class="form-control" id="sisa_piutang_display"
                                            value="{{ formatRupiah($sisaPiutang ?? 0) }}" readonly>

                                        {{-- Input yang dikirim ke server (numeric!) --}}
                                        <input type="hidden" name="sisa_piutang" id="sisa_piutang"
                                            value="{{ $sisaPiutang ?? 0 }}">
                                    </div>


                                    @php
                                        $setoranTerakhir = $transaksi->piutang->setoran->sortByDesc('tanggal_setor')->first();
                                    @endphp

                                    {{-- Tanggal Setor --}}
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Setor</label>
                                        <input type="date" name="tanggal_setor" class="form-control"
                                            value="{{ old('tanggal_setor', $setoranTerakhir->tanggal_setor ?? '') }}"
                                            required>
                                    </div>

                                    <input type="hidden" id="jumlah_setoran_lama" value="{{ $jumlahSetoran }}">


                                    @php
                                        $setoranTerakhir = $transaksi->piutang->setoran->sortByDesc('tanggal_setor')->first();
                                    @endphp

                                    {{-- Penerima Setoran --}}
                                    <div class="mb-3">
                                        <label class="form-label">Penerima Setoran</label>
                                        <select name="id_penerima"
                                            class="form-select @error('id_penerima') is-invalid @enderror" required>
                                            <option disabled {{ empty(old('id_penerima', $setoranTerakhir->id_penerima ?? null)) ? 'selected' : '' }}>
                                                Pilih Penerima
                                            </option>
                                            @foreach($penerima as $item)
                                                <option value="{{ $item->id_marketing }}" @selected(old('id_penerima', $setoranTerakhir->id_penerima ?? null) == $item->id_marketing)>
                                                    {{ $item->nama_marketing }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('id_penerima')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Catatan --}}
                                    <div class="mb-3">
                                        <label class="form-label">Catatan</label>
                                        <input type="text" name="catatan" class="form-control"
                                            value="{{ $transaksi->catatan }}">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ route('admin.penjualan') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const rotiSelect = document.getElementById('id_roti');
        const jumlahPengambilan = document.getElementById('jumlah_pengambilan');
        const jumlahRetur = document.getElementById('jumlah_retur');
        const hargaSatuanInput = document.getElementById('harga_satuan');
        const hargaSatuanDisplay = document.getElementById('harga_satuan_display');
        const uangDisetorInput = document.getElementById('uang_disetor');

        // 👉 NEW: Ambil setoran sebelumnya dari hidden input
        const jumlahSetoranLamaInput = document.getElementById('jumlah_setoran_lama');

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(angka || 0);
        }

        function hitungSemua() {
            const jumlah = parseInt(jumlahPengambilan.value) || 0;
            const retur = parseInt(jumlahRetur.value) || 0;
            const harga = parseFloat(hargaSatuanInput.value) || 0;
            const uangDisetor = parseFloat(uangDisetorInput.value) || 0;
            const jumlahSetoranLama = parseFloat(jumlahSetoranLamaInput?.value) || 0;

            const totalHarga = jumlah * harga;
            const totalRetur = retur * harga;
            const totalSetoran = totalHarga - totalRetur;

            const totalDisetor = uangDisetor + jumlahSetoranLama;
            const sisaPiutang = Math.max(totalSetoran - totalDisetor, 0);

            // Update ke input form
            document.getElementById('total_harga').value = totalHarga;
            document.getElementById('total_harga_display').value = formatRupiah(totalHarga);

            document.getElementById('total_retur').value = totalRetur;
            document.getElementById('total_retur_display').value = formatRupiah(totalRetur);

            document.getElementById('total_setoran').value = totalSetoran;
            document.getElementById('total_setoran_display').value = formatRupiah(totalSetoran);

            document.getElementById('sisa_piutang').value = sisaPiutang;
            document.getElementById('sisa_piutang_display').value = formatRupiah(sisaPiutang);
        }

        rotiSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga') || 0;

            hargaSatuanInput.value = harga;
            hargaSatuanDisplay.value = formatRupiah(harga);
            hitungSemua();
        });

        [jumlahPengambilan, jumlahRetur, uangDisetorInput].forEach(input => {
            input.addEventListener('input', hitungSemua);
        });

        // Saat halaman pertama kali dibuka
        window.addEventListener('DOMContentLoaded', hitungSemua);
    </script>
@endsection