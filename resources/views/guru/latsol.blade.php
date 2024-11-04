<!DOCTYPE html>
<html>
@include('layouts.header')

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')
            @if (@session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">Latihan Soal</h3>
                        <div class="mb-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                                    class='bx bx-book-add'></i> Tambah</button>

                            {{-- <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpload"><i class='bx bx-cloud-upload'></i> Upload</button> --}}
                        </div>
                        <div class="row justify-content-center">
                            <div class="container-fluid">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Judul Materi</th>
                                                    <th scope="col">Judul Soal</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                        
                                            <tbody>
                                                @foreach ($latihanSoal as $index => $latihan)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $latihan->judulMateri }}</td>
                                                        <td>{{ $latihan->judulLatsol }}</td>
                                                        <td>
                                                            <a href="{{ route('latsol.manage', $latihan->id_tugas) }}" class="btn btn-primary" style="border-radius: 10px;">
                                                                Manage
                                                            </a>
                                                            
                                                            <form action="{{ route('latsol.delete', $latihan->id_latihan) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger" style="border-radius: 10px;" onclick="return confirm('Apakah Anda yakin ingin menghapus latihan soal ini?')">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        

                                        <!-- Pagination Links -->

                                    </div>
                                </div>
                                <!-- Modal Tambah-->
                                <div class="modal fade modal-lg" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Soal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <strong>Maaf!</strong> Terdapat kesalahan dengan inputan Anda.<br><br>
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <form id="formSimpan" method="post" action="{{ route('tambahLatsol') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="judulMateri" class="form-label" style="font-weight: bold;">Materi</label>
                                                            <select class="form-control" id="judulMateri" name="judulMateri" required>
                                                                @foreach ($materis as $materi)
                                                                    <option value="{{ $materi->judulMateri }}" data-id="{{ $materi->id }}">
                                                                        {{ $materi->judulMateri }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="judulLatsol" class="form-label" style="font-weight: bold;">Judul Latihan</label>
                                                            <input type="text" id="judulLatsol" name="judulLatsol" class="form-control" 
                                                                   value="{{ old('judulLatsol') }}" placeholder="Judul latihan soal" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                </div>
            </main>
        </div>
    </div>
    </div>
    </div>
    @include('layouts.script')
</body>

</html>
