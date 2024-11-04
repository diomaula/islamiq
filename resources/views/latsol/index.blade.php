<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="fw-bold fs-4 mb-0">Latihan Soal</h1>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @if($latihanList->isEmpty())
                                <div class="text-center">
                                    Belum ada latihan soal yang tersedia.
                                </div>
                            @else
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width:20%">Nomor</th>
                                            <th scope="col" style="width:20%">Materi</th>
                                            <th scope="col" style="width:20%">Judul</th>
                                            <th scope="col" style="width:20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latihanList as $index => $latihan)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $latihan->judulMateri }}</td>
                                                <td>{{ $latihan->judulLatsol }}</td>
                                                <td class="table-actions">
                                                    <a href="{{ route('siswa.latsol.show', $latihan->id_tugas) }}" class="btn btn-primary">
                                                        Kerjakan
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="container-fluid mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="fw-bold fs-4 mb-0">Nilai</h1>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @if($nilaiList->isEmpty())
                                <div class="text-center">
                                    Belum ada nilai yang tersedia.
                                </div>
                            @else
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:20%">Nomor</th>
                                        <th scope="col" style="width:20%">Materi</th>
                                        <th scope="col" style="width:20%">Judul</th>
                                        <th scope="col" style="width:20%">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($nilaiList as $index => $latihan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $latihan->judulMateri }}</td>
                                            <td>{{ $latihan->judulLatsol }}</td>
                                            <td>{{ $latihan->nilaiByUser->nilai ?? 'Belum Dikerjakan' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    @include('layouts.footer')
    @include('layouts.script')
</body>
</html>
