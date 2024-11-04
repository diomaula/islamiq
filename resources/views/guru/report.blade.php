<!-- resources/views/report/index.blade.php -->

@extends('layouts.header')

@section('content')
<div class="container">
    <h2>Report Nilai</h2>
    <form action="{{ route('report.index') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="judulMateri">Pilih Materi</label>
                <select name="judulMateri" id="judulMateri" class="form-select">
                    <option value="">-- Semua Materi --</option>
                    @foreach($materiList as $materi)
                        <option value="{{ $materi->judulMateri }}">{{ $materi->judulMateri }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="judulLatsol">Pilih Latihan Soal</label>
                <select name="judulLatsol" id="judulLatsol" class="form-select">
                    <option value="">-- Semua Latihan Soal --</option>
                    @foreach($latsolList as $latsol)
                        <option value="{{ $latsol->judulLatsol }}">{{ $latsol->judulLatsol }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
                <a href="{{ route('report.exportPdf', request()->all()) }}" class="btn btn-danger ms-2">Ekspor ke PDF</a>
            </div>
        </div>
    </form>

    <!-- Table for displaying report -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Materi</th>
                <th>Latihan Soal</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->user->namaLengkap }}</td>
                    <td>{{ $data->judulMateri }}</td>
                    <td>{{ $data->judulLatsol }}</td>
                    <td>{{ $data->nilai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
