<!DOCTYPE html>
<html>
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
                        <h1 class="fw-bold fs-4 mb-0">Daftar Surah</h1>
                        <!-- Form Pencarian -->
                        <form action="{{ route('surah') }}" method="GET" id="searchInput" class="input-group" style="max-width: 300px;">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari Surah..." value="{{ request('keyword') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Card Daftar Surat -->
                    <div class="card">
                        <div class="card-body">
                            @if($paginator->isEmpty())
                            <p>Surah tidak ditemukan.</p>
                            @else
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Surah</th>
                                        <th scope="col">Jumlah Ayat</th>
                                        <th scope="col">Tempat Turun</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paginator as $surat)
                                    <tr>
                                        <td>{{ $surat['nomor'] }}</td>
                                        <td>{{ $surat['namaLatin'] }} ({{ $surat['nama'] }})</td>
                                        <td>{{ $surat['jumlahAyat'] }}</td>
                                        <td>{{ $surat['tempatTurun'] }}</td>
                                        <td>
                                            <a href="{{ url('/siswa/surat/'.$surat['nomor']) }}" class="btn btn-primary">Lihat Detail <i class="bi bi-arrow-right"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                            <!-- Pagination Links -->
                            <div class="d-flex justify-content-center">
                                {{ $paginator->links('layouts.paginate') }}
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const keywordInput = document.querySelector('#searchInput input[name="keyword"]');

                                keywordInput.addEventListener('input', function() {
                                    const keyword = keywordInput.value.trim();

                                    // Kirim form pencarian dengan kata kunci yang diisi
                                    const url = "{{ route('surah') }}";
                                    window.location.href = ${url}?keyword=${encodeURIComponent(keyword)};
                                });
                            });
                        </script>
                    </div>
                </div>
        </div>
    </div>
    </main>
    </div>
    @include('layouts.footer')
    @include('layouts.script')
</body>

</html>