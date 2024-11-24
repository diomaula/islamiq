<!DOCTYPE html>
<html>
@include('layouts.header')

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')
            @if ($errors->has('fileMateri'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Format file tidak valid',
                        text: 'Hanya file PDF yang diperbolehkan.',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif

            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{{ session('success') }}',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif

            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">Tambah Materi</h3>
                        <div class="mb-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class='bx bx-bookmark-plus'></i> Tambah Materi</button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Judul Materi</th>
                                            <th scope="col">File Materi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($materis as $materi)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $materi->judulMateri }}</td>
                                            <td>{{ $materi->fileMateri }}</td>
                                            <td class="table-actions">
                                                <form action="{{ route('materi.destroy', $materi->id_materi) }}" method="POST" style="display:inline">
                                                    <button type="button" class="btn btn-warning" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#showModal{{$materi->id_materi}}">
                                                        <i class="fas fa-eye fa-sm"></i> Show
                                                    </button>
                                                    <button type="button" class="btn btn-primary" style="border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#editModal{{$materi->id_materi}}">
                                                        <i class="fas fa-edit fa-sm"></i> Edit
                                                    </button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')" style="border-radius: 10px;">
                                                        <i class="fas fa-trash-alt fa-sm"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination Links -->
                                <div class="d-flex justify-content-center">
                                    {{ $materis->links('layouts.paginate') }}
                                </div>

                            </div>
                        </div>



                        <!-- Modal Tambah-->
                        <div class="modal fade modal-lg" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row justify-content-center">
                                                <div class="container-fluid">
                                                    @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @endif

                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <label for="judulMateri">Judul Materi:</label>
                                                                <input type="text" class="form-control" id="judulMateri" name="judulMateri" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fileMateri">File Materi:</label>
                                                                <input type="file" class="form-control" id="fileMateri" name="fileMateri" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="linkVideo">Link Video (optional):</label>
                                                                <input type="text" class="form-control" id="linkVideo" name="linkVideo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Show-->
                        @foreach($materis as $materi)
                        <div class="modal fade modal-lg" id="showModal{{$materi->id_materi}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Data Materi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid my-8">
                                            <div class="row justify-content-center">
                                                <div class="container-fluid">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Id Materi :</strong>
                                                                    {{ $materi->id_materi }}
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Judul Materi :</strong>
                                                                    {{ $materi->judulMateri }}
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>File Materi :</strong>
                                                                    @if ($materi->fileMateri)
                                                                    <p style="margin-top: 15px;">
                                                                        <embed src="{{ asset('uploads/' . $materi->fileMateri) }}" type="application/pdf" width="100%" height="600px" />
                                                                    </p>
                                                                    @else
                                                                    <p>File Materi tidak tersedia.</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top: 20px;">
                                                                @if ($materi->linkVideo)
                                                                <div class="form-group">
                                                                    <strong>Video Pembelajaran :</strong>
                                                                    <iframe style="border: none; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);" width="100%" height="400px" src="{{ $materi->linkVideo }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                </div>
                                                                @endif
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

                        <!-- Modal Edit -->
                        @foreach($materis as $materi)
                        <div class="modal fade modal-lg" id="editModal{{$materi->id_materi}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Materi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid my-8">
                                            <div class="row justify-content-center">
                                                <div class="container-fluid">
                                                    @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <strong>Whoops!</strong> Ada beberapa masalah dengan inputan Anda.<br><br>
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @endif
                                                    <form id="formEditMateri" action="{{ route('materi.update', $materi->id_materi) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="judulMateri">Judul Materi:</label>
                                                                    <input type="text" class="form-control" id="judulMateri" name="judulMateri" value="{{ $materi->judulMateri }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="fileMateri">File Materi:</label>
                                                                    <input type="file" class="form-control" id="fileMateri" name="fileMateri" value="{{ $materi->fileMateri }}" accept=".pdf,.doc,.docx,.ppt,.pptx">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="linkVideo">Link Video (optional):</label>
                                                                    <input type="text" class="form-control" id="linkVideo" name="linkVideo" value="{{ $materi->linkVideo }}">
                                                                </div>
                                                            </div>
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
                        @endforeach
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('layouts.script')
    @include('layouts.footer')
</body>

</html>