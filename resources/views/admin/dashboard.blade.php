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
                        <h2 class="fw-bold">Selamat Datang, {{ auth()->user()->role }}</h2>
                        <h3 class="fw-bold fs-4 mb-3 mt-3">Admin Dashboard</h3>
                        <ul class="box-info">
                            <a href="{{ route('generateUserListPDF', ['role' => 'siswa']) }}" target="_blank">
                                <li class="siswa">
                                    <i class='bx bxs-user'></i>
                                    <span class="text">
                                        <h3>{{ $totalSiswa }}</h3>
                                        <p>Total Siswa</p>
                                    </span>
                                </li>
                            </a>
                            <a href="{{ route('generateUserListPDF', ['role' => 'guru']) }}" target="_blank">
                                <li class="guru">
                                    <i class='bx bxs-group'></i>
                                    <span class="text">
                                        <h3>{{ $totalGuru }}</h3>
                                        <p>Total Guru</p>
                                    </span>
                                </li>
                            </a>
                            <a href="{{ route('cetak-users', ['showRole' => 'true']) }}" target="_blank">
                                <li class="user">
                                    <i class='bx bxs-user-detail'></i>
                                    <span class="text">
                                        <h3>{{ $totalUsers }}</h3>
                                        <p>Total User</p>
                                    </span>
                                </li>
                            </a>
                        </ul>
                        
                        <!-- Card for Chart -->
                        {{-- <div class="card mt-5">
                            <div class="card-header">
                                <h4 class="fw-bold">Materi Akses Chart</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="materiAksesChart" width="400" height="200"></canvas>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </main>
            {{-- @include('layouts.footer') --}}
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
                    type: 'bar', // Tipe chart bisa diubah ke 'line', 'pie', dsb.
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
