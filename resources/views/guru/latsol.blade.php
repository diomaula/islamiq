<!DOCTYPE html>
<html>
@include('layouts.header')
<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')
            @if(@session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
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
                                                <th scope="col">No</th>
                                                <th scope="col">Judul Materi</th>
                                                <th scope="col">Judul Soal</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        @foreach($latihanSoal as $index => $latihan)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $latihan->judulMateri }}</td>
                                                <td>{{ $latihan->judulLatsol }}</td>
                                                <td>
                                                    <form action="{{ route('hapusLatsol', $latihan->id_tugas ) }}" method="POST">
                                                        <button type="button" class="btn btn-warning" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#showModal{{$latihan->id_tugas}}">
                                                            <i class="fas fa-eye fa-sm"></i> Show
                                                        </button>
                                                        <a class="btn btn-primary" style="border-radius: 10px;">
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
                                                                        <form id="formSimpan" method="post" action="{{ route('tambahLatsol') }}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-md-12 mb-3">
                                                                                    <div class="mb-3 col">
                                                                                        <div class="form-group">
                                                                                            <label for="judulMateri" class="col-sm-4 col-form-label" style="font-weight: bold;">Materi</label>
                                                                                            <div class="col-sm-12">
                                                                                                <select class="form-control" id="position-option" name="judulMateri">
                                                                                                    @foreach ($materis as $materi)
                                                                                                    <option value="{{ $materi->judulMateri }}" data-id="{{ $materi->id }}">{{ $materi->judulMateri }}</option>
                                                                                                    @endforeach
                                                                                                    required
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="mb-3 col">
                                                                                        <label for="judulLatsol" class="col-sm-4 col-form-label" style="font-weight: bold;">Judul latihan</label>
                                                                                        <div class="col-sm-12">
                                                                                            <input type="text" id="judulLatsol" name="judulLatsol" class="form-control" value="{{ old('judulLatsol') }}" placeholder="Judul latihan soal" required>
                                                                                        </div>
                                                                                        <input type="hidden" name="id_materi" id="id_materi" value="">
                                                                                    </div>
                                                                                    <div class="mb-3 col">
                                                                                        <label for="jumlah_soal" class="col-sm-4 col-form-label" style="font-weight: bold;">Jumlah Soal</label>
                                                                                        <div class="col-sm-12">
                                                                                            <input type="number" id="jumlah_soal" name="jumlah_soal" class="form-control" value="{{ old('jumlah_soal') }}" placeholder="Masukkan jumlah soal" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="container-form-soal">
                                                                                        <script>
                                                                                        // Fungsi untuk menambahkan form soal berdasarkan jumlah yang diinputkan
                                                                                        function tambahFormSoal(jumlahSoal) {
                                                                                            var container = document.getElementById('container-form-soal');
                                                                                            container.innerHTML = ''; // Bersihkan container

                                                                                            // Tambahkan form soal sebanyak jumlah yang diinputkan
                                                                                            for (var i = 1; i <= jumlahSoal; i++) {
                                                                                                var formSoal = `
                                                                                                <div class="mb-3 col">
                                                                                                    <label for="pertanyaan" class="col-sm-4 col-form-label" style="font-weight: bold;">Soal ${i}</label>
                                                                                                    <div class="col-sm-12">
                                                                                                        <textarea style="height: 88px; " type="text" id="pertanyaan" name="pertanyaan[]" class="form-control" value="{{ old('pertanyaan') }}" placeholder="Masukkan pertanyaan" required></textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="mb-3 col">
                                                                                                    <label for="bobot_nilai" class="col-sm-4 col-form-label" style="font-weight: bold;">Nilai Soal</label>
                                                                                                    <div class="col-sm-12">
                                                                                                        <input type="number" id="bobot_nilai" name="bobot_nilai[]" class="form-control" value="{{ old('bobot_nilai') }}" placeholder="Masukkan nilai per soal" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="mb-3 col">
                                                                                                    <label for="pilihanA" class="col-sm-4 col-form-label" style="font-weight: bold;">Pilihan 1</label>
                                                                                                    <div class="col-sm-12">
                                                                                                        <input type="text" id="pilihanA" name="pilihanA[]" class="form-control" value="{{ old('pilihanA') }}" placeholder="Masukkan pilihan 1" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="mb-3 col">
                                                                                                    <label for="pilihanB" class="col-sm-4 col-form-label" style="font-weight: bold;">Pilihan 2</label>
                                                                                                    <div class="col-sm-12">
                                                                                                        <input type="text" id="pilihanB" name="pilihanB[]" class="form-control" value="{{ old('pilihanB') }}" placeholder="Masukkan pilihan 2" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="mb-3 col">
                                                                                                    <label for="pilihanC" class="col-sm-4 col-form-label" style="font-weight: bold;">Pilihan 3</label>
                                                                                                    <div class="col-sm-12">
                                                                                                        <input type="text" id="pilihanC" name="pilihanC[]" class="form-control" value="{{ old('pilihanC') }}" placeholder="Masukkan pilihan 3" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="mb-3 col">
                                                                                                    <label for="pilihanD" class="col-sm-4 col-form-label" style="font-weight: bold;">Pilihan 4</label>
                                                                                                    <div class="col-sm-12">
                                                                                                        <input type="text" id="pilihanD" name="pilihanD[]" class="form-control" value="{{ old('pilihanD') }}" placeholder="Masukkan pilihan 4"required>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="mb-3 col">
                                                                                                    <label for="jawaban" class="col-sm-4 col-form-label" style="font-weight: bold;">Jawaban</label>
                                                                                                    <div class="col-sm-12">
                                                                                                        <select id="jawaban" name="jawaban[]" class="form-control" required>
                                                                                                            <option value="{{ old('jawaban') }}" disabled selected>Pilih Jawaban</option>
                                                                                                            <option value="pilihanA">Pilihan 1</option>
                                                                                                            <option value="pilihanB">Pilihan 2</option>
                                                                                                            <option value="pilihanC">Pilihan 3</option>
                                                                                                            <option value="pilihanD">Pilihan 4</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>`;
                                                                                                container.innerHTML += formSoal;
                                                                                            }
                                                                                        }
                                                                                        // Event listener untuk menangkap perubahan nilai jumlah soal
                                                                                        document.getElementById('jumlah_soal').addEventListener('change', function() {
                                                                                            var jumlahSoal = parseInt(this.value);
                                                                                            tambahFormSoal(jumlahSoal);
                                                                                        });
                                                                                        </script>
                                                                                        <script>
                                                                                            document.getElementById('judulMateri').addEventListener('change', function() {
                                                                                                var selectedOption = this.options[this.selectedIndex];
                                                                                                var materiId = selectedOption.getAttribute('data-id');
                                                                                                document.getElementById('materi_id').value = materiId;
                                                                                            });
                                                                                        </script>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                                @csrf
                                                                                @method('post')
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                                                </div>
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

                            <!-- Modal Show -->
                            @foreach($latihanSoal as $index => $latihan)
                            <div class="modal fade modal-lg" id="showModal{{$latihan->id_tugas}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data Latihan Soal</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid my-8">
                                                <div class="row justify-content-center">
                                                    <div class="container-fluid">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div>
                                                                    ID Tugas: {{ $latihan->id_tugas }}
                                                                </div>
                                                                <div>
                                                                    ID latian: {{ $latihan->id_latihan }}
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Materi :</strong>
                                                                        {{ $latihan->judulMateri }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Judul Latihan :</strong>
                                                                        {{ $latihan->judulLatsol }}
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Pertanyaan :</strong>
                                                                        {{ $latihan->pertanyaan }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Nilai :</strong>
                                                                        {{ $latihan->bobot_nilai }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Pilihan 1 :</strong>
                                                                        {{ $latihan->pilihanA }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Pilihan 2 :</strong>
                                                                        {{ $latihan->pilihanB }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Pilihan 3 :</strong>
                                                                        {{ $latihan->pilihanC }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Pilihan 4 :</strong>
                                                                        {{ $latihan->pilihanD }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Jawaban :</strong>
                                                                        {{ $latihan->jawaban }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.script')
</body>

</html>