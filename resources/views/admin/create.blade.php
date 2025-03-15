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

                                <div class="row mb-3">
                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nama_marketing" class="col-sm-2 col-form-label">Nama Marketing / Pembeli<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_marketing" name="nama_marketing" required>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="jumlah_pengambilan_roti" class="col-sm-2 col-form-label">Jumlah
                                        Pengambilan
                                        Roti<span class="text-danger">
                                            *</span></label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="jumlah_pengambilan_roti" name="jumlah_pengambilan_roti" min="0" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="harga_satuan" class="col-sm-2 col-form-label">Harga Satuan<span
                                            class="text-danger">
                                            *</span></label>
                                    <div class="col-sm-10">
                                    <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" step="0.01" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="total_harga" class="col-sm-2 col-form-label otomatis">
                                        <b>Total Harga</b></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="total_harga_display" readonly>
                                        <input type="hidden" id="total_harga" name="total_harga">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="jumlah_retur" class="col-sm-2 col-form-label">Jumlah Retur<span
                                            class="text-danger">
                                            *</span></label>
                                    <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jumlah_retur" name="jumlah_retur" min="0" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="total_retur" class="col-sm-2 col-form-label otomatis"><b>Total Retur</b></label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="total_retur_display" readonly>
                                    <input type="hidden" id="total_retur" name="total_retur">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="total_setoran" class="col-sm-2 col-form-label otomatis"><b>Total Setoran</b></label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="total_setoran_display" readonly>
                                    <input type="hidden" id="total_setoran" name="total_setoran">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="uang_disetor" class="col-sm-2 col-form-label">Uang Disetor<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                    <input type="number" class="form-control" id="uang_disetor"  name="uang_disetor" step="0.01" min="0">
                                    <small id="formatted_uang_disetor" class="text-muted"></small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="sisa_piutang" class="col-sm-2 col-form-label otomatis"><b>Sisa Piutang </b></label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="sisa_piutang_display" readonly>
                                    <input type="hidden" id="sisa_piutang" name="sisa_piutang">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tanggal_setor" class="col-sm-2 col-form-label">Tanggal Setor <span
                                            class="text-danger">
                                            *</span></label>
                                    <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggal_setor" name="tanggal_setor">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="penerima_setoran" class="col-sm-2 col-form-label">Penerima Setoran
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="penerima_setoran" name="penerima_setoran">
                                    </div>
                                </div>

                                <h6 class="mt-5">
                                    <strong> Ket : <span class="text-danger">* </span>Wajib Diisi dan Yang Berwarna <span class="otomatis">Merah</span> Sudah Terisi Otomatis</strong><br>
                                </h6>

                                <div class="row mb-3">
                                    <div class="col-sm-100 text-center">
                                        <button type="submit" class="btn btn-success btn-custom">Tambahkan</button>
                                        <button type="reset" class="btn btn-warning btn-custom">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        

    <script>
    // Ambil elemen input
    const jumlahInput = document.getElementById('jumlah_pengambilan_roti');
    const hargaInput = document.getElementById('harga_satuan');
    const totalDisplay = document.getElementById('total_harga_display');
    const totalHidden = document.getElementById('total_harga');
    const jumlahRetur = document.getElementById('jumlah_retur');
    const totalReturDisplay = document.getElementById('total_retur_display');
    const totalRetur = document.getElementById('total_retur');
    const totalSetoran = document.getElementById('total_setoran');
    const totalSetoranDisplay = document.getElementById('total_setoran_display');
    const uangDisetor = document.getElementById('uang_disetor');
    const sisaPiutangDisplay = document.getElementById('sisa_piutang_display');
    const sisaPiutang = document.getElementById('sisa_piutang');


    // Fungsi untuk memformat angka menjadi format rupiah
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }

    // Fungsi untuk menghitung total harga
    function hitungTotalHarga() {
        const jumlah = parseFloat(jumlahInput.value) || 0; // Jika kosong, default ke 0
        const harga = parseFloat(hargaInput.value) || 0;   // Jika kosong, default ke 0
        const total = jumlah * harga;                     // Hitung total harga

        totalDisplay.value = formatRupiah(total);         // Tampilkan dalam format rupiah
        totalHidden.value = total.toFixed(2);             // Simpan nilai asli di input hidden

        // Panggil fungsi untuk menghitung setoran
        hitungTotalSetoran();
    }

    // Fungsi untuk menghitung total retur
    function hitungTotalRetur() {
        const jumlah = parseFloat(jumlahRetur.value) || 0; // Jika kosong, default ke 0
        const harga = parseFloat(hargaInput.value) || 0;   // Jika kosong, default ke 0
        const total = jumlah * harga;                     // Hitung total retur

        totalReturDisplay.value = formatRupiah(total);    // Tampilkan dalam format rupiah
        totalRetur.value = total.toFixed(2);              // Simpan nilai asli di input hidden

        // Panggil fungsi untuk menghitung setoran
        hitungTotalSetoran();
    }

    // Fungsi untuk menghitung total setoran
    function hitungTotalSetoran() {
        const totalHarga = parseFloat(totalHidden.value) || 0; // Ambil nilai total harga
        const totalReturNilai = parseFloat(totalRetur.value) || 0; // Ambil nilai total retur
        const total = totalHarga - totalReturNilai;              // Hitung total setoran

        totalSetoranDisplay.value = formatRupiah(total);        // Tampilkan dalam format rupiah
        totalSetoran.value = total.toFixed(2);                  // Simpan nilai asli di input hidden
    }

    // Fungsi untuk menghitung sisa piutang
    function hitungSisaPiutang() {
        const totalSetoranNilai = parseFloat(totalSetoran.value) || 0; // Ambil nilai total setoran
        const uangDisetorNilai = parseFloat(uangDisetor.value) || 0;   // Ambil nilai uang disetor
        const sisa = totalSetoranNilai - uangDisetorNilai;             // Hitung sisa piutang

        sisaPiutangDisplay.value = formatRupiah(sisa);                // Tampilkan dalam format rupiah
        sisaPiutang.value = sisa.toFixed(2);                          // Simpan nilai asli di input hidden
    }

    // Tambahkan event listener untuk menghitung sisa piutang saat uang disetor berubah
    uangDisetor.addEventListener('input', hitungSisaPiutang);

    // Panggil fungsi sisa piutang setiap kali total setoran diperbarui
    function hitungTotalSetoran() {
        const totalHarga = parseFloat(totalHidden.value) || 0; // Ambil nilai total harga
        const totalReturNilai = parseFloat(totalRetur.value) || 0; // Ambil nilai total retur
        const total = totalHarga - totalReturNilai;              // Hitung total setoran

        totalSetoranDisplay.value = formatRupiah(total);        // Tampilkan dalam format rupiah
        totalSetoran.value = total.toFixed(2);                  // Simpan nilai asli di input hidden

        // Panggil hitung sisa piutang
        hitungSisaPiutang();
    }

    // Tambahkan event listener ke input jumlah, harga, dan jumlah retur
    jumlahInput.addEventListener('input', hitungTotalHarga);
    hargaInput.addEventListener('input', hitungTotalHarga);
    jumlahRetur.addEventListener('input', hitungTotalRetur);
</script>
@endsection