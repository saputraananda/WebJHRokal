@extends('layout.app')

@section('title')
    <title>Dashboard | Jimmy Hantu Foundation</title>
@endsection

@section('customCss')
    /* === ICON CIRCLE === */
    .icon-shape {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    margin-top: 15px;
    }

    .icon-shape:hover {
    transform: scale(1.08);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    }

    /* === CARD MODERN STYLE === */
    .card-info {
    border: none;
    border-left: 4px solid #119E45;
    background: #fff;
    border-radius: 10px;
    padding: 16px 20px;
    transition: all 0.3s ease-in-out;
    }

    .card-info:hover {
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    transform: translateY(-3px);
    }

    /* === TEXT STYLING === */
    .card-info .card-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #555;
    line-height: 1.1;
    margin-top: 20px;
    }

    .card-info h5 {
    font-size: 1.6rem;
    font-weight: 700;
    color: #222;
    margin-top: 5px !important;
    line-height: 1.2;
    }

    /* === TIMELINE LIST === */
    .timeline-list li {
    position: relative;
    padding-left: 20px;
    margin-bottom: 12px;
    font-size: 0.95rem;
    color: #444;
    }

    .timeline-list li::before {
    content: '●';
    position: absolute;
    left: 0;
    top: 2px;
    color: #119E45;
    font-size: 14px;
    }

    .variant-card {
    transition: all 0.3s ease-in-out;
    background: #ffffff;
    border: 1px solid #f0f0f0;
    border-radius: 12px;
    padding: 20px 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .variant-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    background: #f8fdf8;
    }

    .variant-icon {
    font-size: 2.5rem;
    transition: transform 0.3s ease;
    }

    .variant-card:hover .variant-icon {
    transform: scale(1.2);
    }

@endsection

@section('content')
    <div class="pagetitle mb-4">
        <h1 class="fw-bold text-success">Dashboard Utama</h1>
    </div>

    <section class="section dashboard">
        <div class="row g-4">
            @php
                $stats = [
                    [
                        'title' => 'Total Transaksi',
                        'value' => number_format($jumlahTransaksi),
                        'icon' => 'bi-receipt-cutoff',
                        'color' => 'primary',
                    ],
                    [
                        'title' => 'Pengambilan Roti',
                        'value' => number_format($pengambilanRoti) . ' pcs',
                        'icon' => 'bi-box-fill',
                        'color' => 'info',
                    ],
                    [
                        'title' => 'Retur Roti',
                        'value' => number_format($jumlahRetur),
                        'icon' => 'bi-trash-fill',
                        'color' => 'danger',
                    ],
                    [
                        'title' => 'Saldo Setoran',
                        'value' => 'Rp ' . number_format($saldo, 0, ',', '.'),
                        'icon' => 'bi-cash-coin',
                        'color' => 'success',
                    ],
                    [
                        'title' => 'Total Piutang',
                        'value' => 'Rp ' . number_format($totalPiutang, 0, ',', '.'),
                        'icon' => 'bi-postcard-fill',
                        'color' => 'warning',
                    ],
                    [
                        'title' => 'Saldo Akhir',
                        'value' => formatRupiah($totalUangDisetor),
                        'icon' => 'bi-wallet2',
                        'color' => 'secondary',
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="col-md-6 col-xl-4">
                    <div class="card card-info shadow-sm h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-shape bg-gradient bg-{{ $stat['color'] }} text-white me-3">
                                <i class="bi {{ $stat['icon'] }} fs-4"></i>
                            </div>
                            <div>
                                <div class="card-title">{{ $stat['title'] }}</div>
                                <h5 class="mb-0">{{ $stat['value'] }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!--CHART PEMANTAUAN PENJUALAN & RETUR-->
        <div class="row mt-5">
            <!--Diagram Batang-->
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold text-dark mb-3 mt-4 text-center">Pemantauan Penjualan & Retur</h4>
                        <div id="penjualanReturChart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--CHART PEMANTAUAN PENJUALAN & RETUR SELESAI-->


        <!--CHART PEMANTAUAN MARKETING-->
        <div class="row mt-2">
            <!--Diagram Batang-->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold text-dark mb-0 mt-4 text-center">Pemantauan Marketing</h4>
                        <h5 class="fw-small text-dark mb-3 text-center">Pengambilan Roti</h5>
                        <div id="ChartTopPenjualanMarketing"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold text-dark mb-0 mt-4 text-center">Pemantauan Marketing</h4>
                        <h5 class="fw-small text-dark mb-3 text-center">Retur Roti</h5>
                        <div id="ChartTopReturMarketing"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--CHART PEMANTAUAN MARKETING SELESAI-->



        <!-- CARD VARIAN ROTI -->
        <div class="row mt-2">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold text-dark mb-4 text-center mt-4">🍞 Varian Roti Kalkun 🍞</h4>

                        <div class="row g-4 text-center">
                            @php
                                $variants = [
                                    ['label' => 'Coklat', 'icon' => '🍫', 'total' => $coklat],
                                    ['label' => 'Keju', 'icon' => '🧀', 'total' => $keju],
                                    ['label' => 'Coklat Keju', 'icon' => '🍫🧀', 'total' => $coklatKeju],
                                    ['label' => 'Abon', 'icon' => '🥓', 'total' => $abon],
                                ];
                            @endphp

                            @foreach ($variants as $variant)
                                <div class="col-6 col-md-3">
                                    <div
                                        class="variant-card h-100 d-flex flex-column justify-content-center align-items-center">
                                        <div class="variant-icon mb-2">{{ $variant['icon'] }}</div>
                                        <div class="text-muted small">{{ $variant['label'] }}</div>
                                        <div class="fw-bold text-success mt-1" style="font-size: 1.2rem;">
                                            {{ number_format($variant['total']) }} pcs
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD VARIAN ROTI SELESAI-->


        <!--TENTANG WEBSITE-->
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold text-dark mb-3 mt-4">📘 Tentang Website</h4>
                        <p class="text-muted mb-4">Website ini digunakan untuk memantau dan mengelola penjualan <strong>Roti
                                Kalkun Jimmy Hantu Foundation</strong> secara real-time.</p>

                        <ul class="timeline-list list-unstyled">
                            <li><strong>Pengetahuan Umum:</strong> Platform pemantauan penjualan dan manajemen transaksi.
                            </li>
                            <li><strong>Input Data Transaksi:</strong> Gunakan fitur <a href="{{ route('admin.create') }}"
                                    class="text-decoration-underline">Tambah Transaksi</a> untuk mencatat penjualan harian.
                            </li>
                            <li><strong>Monitoring Real-Time:</strong> Cek dan awasi data penjualan kapan saja melalui
                                dashboard.</li>
                            <li><strong>Prediksi Penjualan:</strong> Lihat proyeksi stok dan penjualan melalui fitur
                                prediksi berbasis AI yang akurat.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customScript')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const bulanLabel = @json($labelBulanan ?? []);
            const penjualan = @json($penjualanBulanan ?? []);
            const retur = @json($returBulanan ?? []);

            const options = {
                chart: {
                    height: 360,
                    type: 'line',
                    fontFamily: 'Poppins, sans-serif',
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '40%',
                        borderRadius: 6
                    }
                },
                stroke: {
                    width: [0, 0, 3, 3],
                    curve: 'smooth',
                    colors: ['#00c897', '#ff4d4f', '#1e88e5', '#e91e63']
                },
                markers: {
                    size: 4,
                    colors: ['#1e88e5', '#e91e63'],
                    strokeWidth: 2,
                    strokeColors: '#fff',
                    hover: { size: 6 }
                },
                dataLabels: {
                    enabled: true,
                    enabledOnSeries: [0, 1], // hanya label di bar, bukan line
                    offsetY: -10,
                    style: {
                        fontSize: '13px',
                        fontWeight: 600,
                        colors: ['#111']
                    },
                    background: {
                        enabled: true,
                        foreColor: '#fff',
                        padding: 6,
                        borderRadius: 4,
                        borderColor: '#ddd',
                        borderWidth: 1,
                        opacity: 0.9,
                        dropShadow: {
                            enabled: true,
                            top: 1,
                            left: 1,
                            blur: 2,
                            color: '#000',
                            opacity: 0.1
                        }
                    },
                    formatter: function (val) {
                        return new Intl.NumberFormat().format(val);
                    }
                },
                series: [
                    {
                        name: 'Penjualan',
                        type: 'column',
                        data: penjualan
                    },
                    {
                        name: 'Retur',
                        type: 'column',
                        data: retur
                    },
                    {
                        name: 'Tren Penjualan',
                        type: 'line',
                        data: penjualan
                    },
                    {
                        name: 'Tren Retur',
                        type: 'line',
                        data: retur
                    }
                ],
                xaxis: {
                    title:{
                        text:'Bulan',
                        style: {
                            fontSize: '14px',
                            fontWeight: 600
                        }
                    },
                    categories: bulanLabel,
                    labels: {
                        style: {
                            fontSize: '13px',
                            fontWeight: 500,
                            colors: '#333'
                        }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah (pcs)',
                        style: {
                            fontSize: '14px',
                            fontWeight: 600
                        }
                    }
                },
                colors: ['#00c897', '#ff4d4f', '#1e88e5', '#e91e63'],
                fill: {
                    opacity: [0.9, 0.9, 1, 1]
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    fontWeight: 600,
                    fontSize: '14px',
                    markers: {
                        radius: 12
                    }
                },
                tooltip: {
                    shared: true,
                    custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                        const bulan = w.globals.categoryLabels[dataPointIndex];

                        const penjualan = series[0][dataPointIndex];
                        const retur = series[1][dataPointIndex];

                        return `
                                    <div class="apex-tooltip-custom px-2 py-1">
                                        <strong>${bulan}</strong>
                                        <div class="mt-1">
                                            <span style="color:#00c897; font-weight: 500;">●</span> Penjualan: <strong>${penjualan.toLocaleString()} pcs</strong><br>
                                            <span style="color:#ff4d4f; font-weight: 500;">●</span> Retur: <strong>${retur.toLocaleString()} pcs</strong>
                                        </div>
                                    </div>
                                `;
                    }
                }

            };

            new ApexCharts(document.querySelector("#penjualanReturChart"), options).render();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const chartBaseOptions = {
                chart: {
                    type: 'bar',
                    height: 350,
                    fontFamily: 'Poppins, sans-serif',
                    toolbar: { show: true },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 700,
                        animateGradually: { enabled: true, delay: 150 },
                        dynamicAnimation: { enabled: true, speed: 350 }
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 2,
                        columnWidth: '40%',
                        distributed: false,
                        dataLabels: {
                            position: 'top'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    offsetY: -17,
                    style: {
                        fontSize: '12px',
                        fontWeight: 600,
                        colors: ['#333']
                    },
                    formatter: val => new Intl.NumberFormat().format(val)
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                tooltip: {
                    theme: 'light',
                    style: {
                        fontSize: '13px'
                    },
                    y: {
                        formatter: val => `${new Intl.NumberFormat().format(val)} pcs`
                    }
                },
                xaxis: {
                    title:{
                        text:'Nama Marketing',
                        style: {
                            fontSize: '14px',
                            fontWeight: 600
                        }
                    },
                    labels: {
                        style: {
                            fontSize: '11px',
                            fontWeight: 500,
                            colors: '#666'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah (pcs)',
                        style: {
                            fontSize: '14px',
                            fontWeight: 600
                        }
                    }
                },
                fill: {
                    type: 'solid',
                    opacity: 0.9
                },
                grid: {
                    borderColor: '#e0e0e0',
                    strokeDashArray: 4
                },
                legend: {
                    show: false
                }
            };

            // Chart 1: Top 5 Penjualan
            new ApexCharts(document.querySelector("#ChartTopPenjualanMarketing"), {
                ...chartBaseOptions,
                series: [{
                    name: 'Penjualan',
                    data: @json($jumlahPenjualanMarketing)
                }],
                xaxis: {
                    ...chartBaseOptions.xaxis,
                    categories: @json($labelPenjualanMarketing)
                },
                colors: ['#00c897']
            }).render();

            // Chart 2: Top 5 Retur
            new ApexCharts(document.querySelector("#ChartTopReturMarketing"), {
                ...chartBaseOptions,
                series: [{
                    name: 'Retur',
                    data: @json($jumlahReturMarketing)
                }],
                xaxis: {
                    ...chartBaseOptions.xaxis,
                    categories: @json($labelReturMarketing)
                },
                colors: ['#ff4d4f']
            }).render();
        });
    </script>
@endsection