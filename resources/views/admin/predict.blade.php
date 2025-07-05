@extends('layout.app')

@section('title')
    <title>Prediksi Penjualan | Jimmy Hantu Foundation</title>
@endsection

@section('customCss')
    .forecast-card {
    transition: all 0.3s ease-in-out;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .forecast-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
    }

    #filterPrediksi:focus {
    background-color: #ffffff !important;
    color: #212529 !important;
    border-color: #ced4da;
    box-shadow: 0 0 0 0.1rem rgba(0, 123, 255, 0.25);
    }
@endsection

@section('content')
    @if(isset($forecast_5hari) || isset($forecast_5minggu) || isset($forecast_5bulan))
        <div class="mb-4">
            <div class="p-4 rounded text-white" style="background: #119E45">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <h5 class="fw-bold mb-0 text-white" id="judulPrediksi">Prediksi Penjualan Harian</h5>

                    <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                        <span class="text-white d-flex align-items-center">
                            <i class="bi bi-filter me-1"></i> Tampilkan
                        </span>
                        <div class="position-relative">
                            <select id="filterPrediksi"
                                class="form-select form-select-sm border-0 shadow-sm rounded-3 bg-white text-dark fw-semibold"
                                style="min-width: 200px; transition: background-color 0.2s ease;">
                                <option value="5hari">Harian</option>
                                <option value="5minggu">Mingguan</option>
                                <option value="5bulan">Bulanan</option>
                            </select>
                            <!-- Icon dropdown custom -->
                            <i
                                class="bi bi-caret-down-fill position-absolute end-0 top-50 translate-middle-y me-3 text-secondary pointer-events-none"></i>
                        </div>
                    </div>

                </div>


                <div id="containerPrediksi" class="d-flex justify-content-between flex-wrap gap-2">
                    @foreach($forecast_5hari as $item)
                        @php
                            $tanggal = \Carbon\Carbon::parse($item['tanggal']);
                        @endphp
                        <div class="bg-white rounded p-3 text-center flex-fill forecast-card card-5hari" style="min-width: 130px;">
                            <div class="fw-bold text-dark" style="font-size: 24px;">{{ number_format($item['prediksi'], 0) }}</div>
                            <div class="text-muted" style="font-size: 14px;">{{ hariIndo($tanggal) }}</div>
                            <div class="text-dark" style="font-size: 13px;">{{ $tanggal->format('d') }} {{ bulanIndo($tanggal) }}
                                {{ $tanggal->format('Y') }}
                            </div>
                        </div>
                    @endforeach

                    @foreach($forecast_5minggu as $item)
                        @php
                            $tanggal = \Carbon\Carbon::parse($item['tanggal_awal']);
                        @endphp
                        <div class="bg-white rounded p-3 text-center flex-fill forecast-card card-5minggu d-none"
                            style="min-width: 130px;">
                            <div class="fw-bold text-dark" style="font-size: 24px;">
                                {{ number_format((float) $item['total'], 0) }}
                            </div>
                            <div class="text-muted" style="font-size: 14px;">
                                {{ $item['label'] }}
                            </div>
                            <div class="text-dark" style="font-size: 13px;">
                                {{ $tanggal->format('d') }} {{ bulanIndo($tanggal) }} {{ $tanggal->format('Y') }}
                            </div>
                        </div>
                    @endforeach


                    @foreach($forecast_5bulan as $item)
                        @php
                            $tanggal = \Carbon\Carbon::parse($item['tanggal_awal']); // diambil dari controller
                        @endphp
                        <div class="bg-white rounded p-3 text-center flex-fill forecast-card card-5bulan d-none"
                            style="min-width: 130px;">
                            <div class="fw-bold text-dark" style="font-size: 24px;">
                                {{ number_format((float) $item['total'], 0) }}
                            </div>
                            <div class="text-muted" style="font-size: 14px;">Bulan</div>
                            <div class="text-dark" style="font-size: 13px;">
                                {{ $tanggal->translatedFormat('F Y') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <h5 class="mt-3 mb-0" style="font-size: 16px;"><b>Mohon dipahami</b>, prediksi bukan satu-satunya acuan untuk
                    menentukan keputusan penjualan.</h5>
            </div>
        </div>
    @endif

    <!--CHART PEMANTAUAN PENJUALAN & RETUR-->
    <div class="row mt-5">
        <!--Diagram Batang-->
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="fw-bold text-dark mb-3 mt-4 text-center">Grafik Prediksi Penjualan 30 Hari Kedepan</h4>
                    <div id="grafikPrediksi30Hari"></div>
                </div>
            </div>
        </div>
    </div>
    <!--CHART PEMANTAUAN PENJUALAN & RETUR SELESAI-->

    @if(isset($evaluasi) && count($evaluasi))
        <div class="row">
            <!-- Kolom 1 -->
            <div class="col-lg-7 d-flex align-items-stretch">
                <div class="card w-100" style="height: 95%;">
                    <div class="card-body">
                        <h4 class="subjudul fw-bold text-dark mt-4">Evaluasi Tahun Sebelumnya</h4>
                        <p class="mb-3">Rata-rata MAPE (Tingkat Error) <strong>{{ $mape }}%</strong></p>

                        <div class="table-responsive">
                            <table id="tabelEvaluasi" class="table datatable datatable-custom table-bordered theadtransaksi">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Aktual</th>
                                        <th>Prediksi</th>
                                        <th>MAPE (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($evaluasi->values() as $index => $row)
                                        <tr class="text-center">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($row['tanggal'])->format('d-m-Y') }}</td>
                                            <td>{{ $row['aktual'] }}</td>
                                            <td>{{ $row['prediksi'] }}</td>
                                            <td>{{ $row['mape'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom 2 -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="card w-100" style="height: 95%;">
                    <div class="card-body">
                        <h4 class="subjudul fw-bold text-dark mt-4">Apa Itu MAPE?</h4>
                        <p style="text-align: justify;"><strong>MAPE</strong> (Mean Absolute Percentage Error) adalah ukuran
                            yang digunakan untuk
                            mengevaluasi seberapa akurat hasil prediksi terhadap nilai aktual. Nilainya dinyatakan dalam persen,
                            makin kecil nilainya, makin akurat prediksi tersebut.</p>

                        <hr>

                        <h5 class="fw-semibold text-primary mt-3">🧮 Rumus MAPE</h5>
                        <div class="bg-light p-3 rounded shadow-sm text-center mb-3">
                            <code class="d-block fs-6">
                                                        MAPE = (1/n) × Σ (|Aktual - Prediksi| / |Aktual|) × 100%
                                                     </code>
                        </div>

                        <p class="mb-1">Keterangan:</p>
                        <ul class="mb-3">
                            <li><strong>n</strong> = jumlah data</li>
                            <li><strong>Aktual</strong> = nilai sebenarnya</li>
                            <li><strong>Prediksi</strong> = hasil prediksi</li>
                        </ul>

                        <hr>

                        <h5 class="fw-semibold text-primary mt-3">📊 Interpretasi Nilai MAPE</h5>
                        <table class="table table-bordered text-center mt-2 small">
                            <thead class="table-success">
                                <tr>
                                    <th>Kategori</th>
                                    <th>Rentang MAPE</th>
                                    <th>Penilaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><i class="bi bi-emoji-laughing text-success"></i> Sangat Baik</td>
                                    <td>
                                        < 10%</td>
                                    <td>Akurasi sangat tinggi</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-emoji-smile text-primary"></i> Baik</td>
                                    <td>10% - 20%</td>
                                    <td>Akurasi cukup bagus</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-emoji-neutral text-warning"></i> Cukup</td>
                                    <td>20% - 50%</td>
                                    <td>Akurasi sedang</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-emoji-frown text-danger"></i> Buruk</td>
                                    <td>> 50%</td>
                                    <td>Akurasi rendah</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr>

                        <div class="alert alert-info small mt-4" style="text-align: justify;">
                            <strong>Tips:</strong> Meskipun MAPE bisa memberikan gambaran akurasi, selalu pertimbangkan konteks
                            dan data bisnis. Misalnya, prediksi untuk data musiman atau diskrit perlu pendekatan lebih
                            hati-hati.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('customScript')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const select = document.getElementById("filterPrediksi");
            const judul = document.getElementById("judulPrediksi");

            const labelMap = {
                "5hari": "Prediksi Penjualan Harian",
                "5minggu": "Prediksi Penjualan Mingguan",
                "5bulan": "Prediksi Penjualan Bulanan"
            };

            const updateForecastView = () => {
                const value = select.value;

                // Ubah judul
                judul.textContent = labelMap[value] || "Prediksi Penjualan";

                // Sembunyikan semua kartu
                document.querySelectorAll(".forecast-card").forEach(el => el.classList.add("d-none"));

                // Tampilkan kartu sesuai pilihan
                document.querySelectorAll(`.card-${value}`).forEach(el => el.classList.remove("d-none"));
            };

            select.addEventListener("change", updateForecastView);

            // Trigger saat pertama kali halaman dimuat
            updateForecastView();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tanggalLabels = @json($labelTanggal);
            const prediksi = @json($prediksi30Hari);

            const options = {
                chart: {
                    type: 'line',
                    height: 360,
                    toolbar: { show: false },
                    fontFamily: 'Poppins, sans-serif'
                },
                series: [{
                    name: 'Prediksi Penjualan',
                    data: prediksi
                }],
                xaxis: {
                    categories: tanggalLabels,
                    title: {
                        text: 'Tanggal',
                        style: { fontWeight: 600 }
                    },
                    labels: {
                        style: {
                            fontSize: '13px',
                            fontWeight: 500
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Penjualan (pcs)',
                        style: { fontWeight: 600 }
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                markers: {
                    size: 5,
                    colors: ['#00c897'],
                    strokeColors: '#fff',
                    strokeWidth: 2
                },
                tooltip: {
                    x: { format: 'dd MMM yyyy' },
                    y: {
                        formatter: function (val) {
                            return `${val.toLocaleString()} pcs`;
                        }
                    }
                },
                colors: ['#00c897'],
                fill: {
                    type: 'solid',
                    opacity: 0.9
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return Math.round(val).toLocaleString();
                    },
                    style: {
                        fontWeight: 'bold',
                        colors: ['#111']
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    fontWeight: 600
                }
            };

            new ApexCharts(document.querySelector("#grafikPrediksi30Hari"), options).render();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const table = document.querySelector("#tabelEvaluasi");

            if (table) {
                const dataTable = new simpleDatatables.DataTable(table, {
                    perPage: 15,
                    perPageSelect: [15],
                });

                table.dataTable = dataTable;
            }
        });
    </script>
@endsection