@extends('layout.app')

@section('title')
    <title>Tambah Transaksi Penjualan | Jimmy Hantu Foundation</title>
@endsection

@section('content')
    <div class="pagetitle">
        <h1 style="color:#119E45">Tambah Transaksi Penjualan</h1>
        <!-- <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">Home</li>
                                        <li class="breadcrumb-item">Tambah Wajib Pajak</li>
                                    </ol>
                                </nav> -->
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <h4 class="subjudul"
                            style="color :#000000; font-weight:bold; margin-top: 30px; margin-bottom: 20px;">
                            Form Input Transaksi Penjualan</h4>

                        <!-- General Form Elements -->
                        <form action="{{ route('admin.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                {{-- KIRI --}}
                                <div class="col-md-4">
                                    {{-- Tanggal --}}
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="tanggal" required>
                                    </div>

                                    {{-- Nama Marketing --}}
                                    <div class="mb-3">
                                        <label for="id_marketing" class="form-label">Nama Marketing <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="id_marketing" required>
                                            <option selected disabled>Pilih Marketing</option>
                                            @foreach($marketing as $item)
                                                <option value="{{ $item->id_marketing }}">{{ $item->nama_marketing }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Wilayah --}}
                                    <div class="mb-3">
                                        <label for="id_toko" class="form-label">Wilayah <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="id_toko" required>
                                            <option selected disabled>Pilih Toko</option>
                                            @foreach($wilayah as $item)
                                                <option value="{{ $item->id_toko }}">{{ $item->nama_toko }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Varian Roti --}}
                                    <div class="mb-3">
                                        <label for="id_roti" class="form-label">Varian Roti <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="id_roti" id="id_roti" required>
                                            <option selected disabled>Pilih Roti</option>
                                            @foreach($roti as $item)
                                                <option value="{{ $item->id_roti }}" data-harga="{{ $item->harga_satuan }}">
                                                    {{ $item->nama_roti }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Jumlah Pengambilan --}}
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Pengambilan</label>
                                        <input type="number" class="form-control" name="jumlah_pengambilan"
                                            id="jumlah_pengambilan" required>
                                    </div>

                                    

                                    
                                </div>

                                {{-- TENGAH --}}
                                <div class="col-md-4">
                                    {{-- Harga Satuan --}}
                                    <div class="mb-3">
                                        <label class="form-label">Harga Satuan</label>
                                        <input type="text" class="form-control" id="harga_satuan_display" readonly>
                                        <input type="hidden" name="harga_satuan" id="harga_satuan">
                                    </div>

                                    {{-- Total Harga --}}
                                    <div class="mb-3">
                                        <label class="form-label">Total Harga</label>
                                        <input type="text" class="form-control" id="total_harga_display" readonly>
                                        <input type="hidden" name="total_harga" id="total_harga">
                                    </div>

                                    {{-- Jumlah Retur --}}
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Retur</label>
                                        <input type="number" class="form-control" name="jumlah_retur" id="jumlah_retur"
                                            value="0">
                                    </div>

                                    {{-- Total Retur --}}
                                    <div class="mb-3">
                                        <label class="form-label">Total Retur</label>
                                        <input type="text" class="form-control" id="total_retur_display" readonly>
                                        <input type="hidden" name="total_retur" id="total_retur">
                                    </div>

                                    {{-- Total Setoran --}}
                                    <div class="mb-3">
                                        <label class="form-label">Total Setoran</label>
                                        <input type="text" class="form-control" id="total_setoran_display" readonly>
                                        <input type="hidden" name="total_setoran" id="total_setoran">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    {{-- KANAN --}}
                                    {{-- Uang Disetor --}}
                                    <div class="mb-3">
                                        <label class="form-label">Uang Disetor</label>
                                        <input type="number" step="0.01" class="form-control" name="uang_disetor"
                                            id="uang_disetor">
                                    </div>

                                    {{-- Sisa Piutang --}}
                                    <div class="mb-3">
                                        <label class="form-label">Sisa Piutang</label>
                                        <input type="text" class="form-control" id="sisa_piutang_display" readonly>
                                        <input type="hidden" name="sisa_piutang" id="sisa_piutang">
                                    </div>

                                    {{-- Tanggal Setor --}}
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Setor</label>
                                        <input type="date" class="form-control" name="tanggal_setor">
                                    </div>

                                    {{-- Penerima Setoran --}}
                                    <div class="mb-3">
                                        <label class="form-label">Penerima Setoran</label>
                                        <select class="form-select" name="id_penerima">
                                            <option selected disabled>Pilih Penerima</option>
                                            @foreach($penerima as $item)
                                                <option value="{{ $item->id_marketing }}">{{ $item->nama_marketing }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Catatan Opsional --}}
                                    <div class="mb-3">
                                        <label for="catatan" class="form-label">Catatan</label>
                                        <input type="text" class="form-control" name="catatan" id="catatan"
                                            placeholder="Tambahkan catatan jika perlu...">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
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

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angka);
        }

        function hitungSemua() {
            const jumlah = parseInt(jumlahPengambilan.value) || 0;
            const retur = parseInt(jumlahRetur.value) || 0;
            const harga = parseFloat(hargaSatuanInput.value) || 0;

            const totalHarga = jumlah * harga;
            const totalRetur = retur * harga;
            const totalSetoran = totalHarga - totalRetur;
            const uangDisetor = parseFloat(document.getElementById('uang_disetor').value) || 0;
            const piutang = totalSetoran - uangDisetor;

            document.getElementById('total_harga').value = totalHarga;
            document.getElementById('total_harga_display').value = formatRupiah(totalHarga);
            document.getElementById('total_retur').value = totalRetur;
            document.getElementById('total_retur_display').value = formatRupiah(totalRetur);
            document.getElementById('total_setoran').value = totalSetoran;
            document.getElementById('total_setoran_display').value = formatRupiah(totalSetoran);
            document.getElementById('sisa_piutang').value = piutang > 0 ? piutang : 0;
            document.getElementById('sisa_piutang_display').value = formatRupiah(piutang > 0 ? piutang : 0);
        }

        rotiSelect.addEventListener('change', function () {
            const harga = this.options[this.selectedIndex].getAttribute('data-harga');
            hargaSatuanInput.value = harga;
            hargaSatuanDisplay.value = formatRupiah(harga);
            hitungSemua();
        });

        [jumlahPengambilan, jumlahRetur, document.getElementById('uang_disetor')].forEach(input => {
            input.addEventListener('input', hitungSemua);
        });
    </script>
@endsection