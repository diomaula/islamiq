<!DOCTYPE html>
<html>
@include('layouts.header')
<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')
            <main class="content px-3 py-4" id="content">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h2 class="fw-bold">Selamat Datang, {{ auth()->user()->ni}}_{{ auth()->user()->namaLengkap }}</h2>
                        <h3 class="fw-bold fs-4 mb-3 mt-3">Dashboard</h3>
                        
                        <div class="container">
                            <form action="{{ route('report.filter') }}" method="GET" class="mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="judulMateri">Pilih Materi</label>
                                        <select name="judulMateri" id="judulMateri" class="form-select">
                                            <option value="">Semua Materi</option>
                                            @foreach($materiList as $materi)
                                                <option value="{{ $materi->judulMateri }}">{{ $materi->judulMateri }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="judulLatsol">Pilih Latihan Soal</label>
                                        <select name="judulLatsol" id="judulLatsol" class="form-select">
                                            <option value="">Semua Latihan Soal</option>
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
                            <div class="card">
                                <div class="card-body">
                                    @if(isset($reportData) && $reportData->count() > 0)
                                        <table class="table table-bordered mt-4">
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
                                                        <td>{{ $data->siswa ? $data->siswa->namaLengkap : '-' }}</td>
                                                        <td>{{ $data->latihansoal->judulMateri ?? '-' }}</td>
                                                        <td>{{ $data->latihansoal->judulLatsol ?? '-' }}</td>
                                                        <td>{{ $data->nilai }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="mt-4">Tidak ada data untuk ditampilkan.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card for Chart -->
                        @if(Auth::user()->role == 'guru')
                        <div class="card mt-5">
                            <div class="card-header">
                                <h4 class="fw-bold">Materi Akses Chart</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="materiAksesChart" width="600" height="200"></canvas>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('layouts.script')

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('materiAksesChart').getContext('2d');

        // Ambil data akses materi dari controller
        fetch("{{ route('chart.akses') }}")
            .then(response => response.json())
            .then(data => {
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching chart data:', error));
    </script>
</body>
</html>
