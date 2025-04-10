@extends('layout.app')

@section('title')
<title>Prediksi Penjualan | Jimmy Hantu Foundation</title>
@endsection

@section('hide_footer', true)

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">📊 Prediksi Penjualan</h1>

    @if (isset($error))
        <div class="alert alert-danger">
            ⚠️ {{ $error }}
        </div>
    @else
        <div class="card p-4 mb-4 shadow-sm">
            <h3>Total Prediksi Bulan Depan:</h3>
            <p class="fs-4 fw-bold text-success">
                {{ number_format($total_bulan_depan) }}
            </p>

            <h4 class="mt-3">Akurasi Model (MAPE):</h4>
            <p class="fs-5 text-primary">
                {{ $mape }}%
            </p>
        </div>

        <div class="card p-4 shadow-sm">
            <h5 class="mb-3">📅 Prediksi Harian (30 Hari ke Depan)</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hari ke</th>
                            <th>Prediksi Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prediksi as $i => $val)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>Hari ke-{{ $i + 1 }}</td>
                            <td>{{ number_format($val) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
