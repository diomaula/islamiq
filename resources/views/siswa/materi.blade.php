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
                    <h2 class="fw-bold">Selamat Datang, {{ auth()->user()->ni}}_{{ auth()->user()->namaLengkap}}</h2>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="fw-bold fs-4 mb-0">Materi Pembelajaran</h1>
                        <!-- Form Pencarian -->
                        {{-- <form action="" method="GET" class="input-group" style="max-width: 300px;">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari Materi...">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form> --}}

                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:10%">Nomor</th>
                                        <th scope="col" style="width:70%">Judul Materi</th>
                                        <th scope="col" style="width:35%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($materis as $index => $materi)
                                    <tr>
                                        <td>{{ $index + 1 }}</td> <!-- Nomor auto-increment biasa -->
                                        <td>{{ $materi->judulMateri }}</td>
                                        <td class="table-actions">
                                            <a href="{{ route('siswa.materidetail', $materi->id_materi) }}" class="btn btn-primary">Lihat Detail</a>
                                            {{-- <a href="{{ route('siswa.materidetail', $materi->id_materi) }}" class="btn btn-secondary">Soal</a> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>
    @include('layouts.script')
</body>

</html>