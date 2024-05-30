<!DOCTYPE html>
<html>
@include('layouts.header')
<body>
    <div class="wrapper">
        @include('guru.sidebar')
        <div class="main">
            @include('layouts.navbar')
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">Latihan Soal</h3>
                        <div class="mb-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class='bx bx-book-add'></i> Tambah Soal</button>
                            
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
                                                <th scope="col">Id Latihan</th>
                                                <th scope="col">Judul Materi</th>
                                                <th scope="col">Soal</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        @foreach($latihanSoal as $latihan)
                                            <tr>
                                                <td>{{ $latihan->id_latihan }}</td>
                                                <td>{{ $latihan->judulMateri }}</td>
                                                <td>{{ $latihan->isiLatihanSoal }}</td>
                                                <td>
                                                    <form action="{{ route('hapusLatsol', $latihan->id_latihan) }}" method="POST">
                                                        <a class="btn btn-warning" href="{{ route('showLatsol', ['id_latihan' => $latihan->id_latihan]) }}" style="border-radius: 10px;">
                                                            <i class="fas fa-eye fa-sm"></i> Show
                                                        </a>
                                                        <a class="btn btn-primary" href="{{ route('editLatsol', ['id_latihan' => $latihan->id_latihan]) }}" style="border-radius: 10px;">
                                                            <i class="fas fa-edit fa-sm"></i> Edit
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" style="border-radius: 10px;">
                                                            <i class="fas fa-trash-alt fa-sm"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                        
                                        @endforeach
                                    </table>

                                    <!-- Modal Tambah-->
                                    <div class="modal fade modal-lg" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Soal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
            
                                            
                                            <div class="modal-body">
                                                <div class="row justify-content-center">
                                                    <div class="container-fluid my-8">
                                                        
                                                        <div class="container-fluid my-8">
                                                            <div class="row justify-content-center">
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
                                                                            <form id="formSimpan" method="post" action="{{ route('tambahLatsol') }}">
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-3">
                                                                                        <div class="mb-3 col">
                                                                                            <div class="form-group">
                                                                                                <label for="judulMateri" class="col-sm-4 col-form-label" style="font-weight: bold;">Materi</label>
                                                                                                <div class="col-sm-12">
                                                                                                    <select class="form-control" id="position-option" name="judulMateri">
                                                                                                        @foreach ($bks as $bk)
                                                                                                        <option value="{{ $bk->judulMateri }}">{{ $bk->judulMateri }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="mb-3 col">
                                                                                            <label for="isiLatihanSoal" class="col-sm-4 col-form-label" style="font-weight: bold;">Soal</label>
                                                                                            <div class="col-sm-12">
                                                                                                <textarea style="height: 88px; " type="text" id="isiLatihanSoal" name="isiLatihanSoal" class="form-control" value="{{ old('isiLatihanSoal') }}" placeholder="Masukkan pertanyaan"></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="mb-3 col">
                                                                                            <label for="nilai" class="col-sm-4 col-form-label" style="font-weight: bold;">Nilai Soal</label>
                                                                                            <div class="col-sm-12">
                                                                                                <input type="numeric" id="nilai" name="nilai" class="form-control" value="{{ old('nilai') }}" placeholder="Masukkan nilai per soal">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="mb-3 col">
                                                                                            <label for="pilihan1" class="col-sm-4 col-form-label" style="font-weight: bold;">Pilihan 1</label>
                                                                                            <div class="col-sm-12">
                                                                                                <input type="text" id="pilihan1" name="pilihan1" class="form-control" value="{{ old('pilihan1') }}" placeholder="Masukkan pilihan 1">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="mb-3 col">
                                                                                            <label for="pilihan2" class="col-sm-4 col-form-label" style="font-weight: bold;">Pilihan 2</label>
                                                                                            <div class="col-sm-12">
                                                                                                <input type="text" id="pilihan2" name="pilihan2" class="form-control" value="{{ old('pilihan2') }}" placeholder="Masukkan pilihan 2">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="mb-3 col">
                                                                                            <label for="pilihan3" class="col-sm-4 col-form-label" style="font-weight: bold;">Pilihan 3</label>
                                                                                            <div class="col-sm-12">
                                                                                                <input type="text" id="pilihan3" name="pilihan3" class="form-control" value="{{ old('pilihan3') }}" placeholder="Masukkan pilihan 3">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="mb-3 col">
                                                                                            <label for="pilihan4" class="col-sm-4 col-form-label" style="font-weight: bold;">Pilihan 4</label>
                                                                                            <div class="col-sm-12">
                                                                                                <input type="text" id="pilihan4" name="pilihan4" class="form-control" value="{{ old('pilihan4') }}" placeholder="Masukkan pilihan 4">
                                                                                            </div>
                                                                                        </div>
                                                        
                                                                                        <div class="mb-3 col">
                                                                                            <label for="jawaban" class="col-sm-4 col-form-label" style="font-weight: bold;">Jawaban</label>
                                                                                            <div class="col-sm-12">
                                                                                                <select id="jawaban" name="jawaban" class="form-control" required>
                                                                                                    <option value="{{ old('jawaban') }}" disabled selected>Pilih Jawaban</option>
                                                                                                    <option value="pilihan1">Pilihan 1</option>
                                                                                                    <option value="pilihan2">Pilihan 2</option>
                                                                                                    <option value="pilihan3">Pilihan 3</option>
                                                                                                    <option value="pilihan4">Pilihan 4</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                    @csrf
                                                                                    @method('post')
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