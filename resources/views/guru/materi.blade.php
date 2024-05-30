<!DOCTYPE html>
<html>
@include('layouts.header')
<body>
    <div class="wrapper">
        @include('guru.sidebar')
        <div class="main">
            @include('guru.navbar')
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">Materi Pembelajaran</h3>
                        <div class="mb-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class='bx bx-bookmark-plus'></i> Tambah Materi</button>
                            
                            {{-- <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpload"><i class='bx bx-cloud-upload'></i> Upload</button> --}}
                        </div>
                          <div class="card">
                            <div class="card-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id Materi</th>
                                            <th scope="col">Judul Materi</th>
                                            <th scope="col">File Materi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($materis as $materi)
                                        <tr>
                                            <td>{{ $materi->id_materi }}</td>
                                            <td>{{ $materi->judulMateri }}</td>
                                            <td>{{ $materi->fileMateri }}</td>
                                            <td>
                                                <form action="{{ route('materi.destroy', $materi->id_materi) }}" method="POST">
                                                    <a class="btn btn-warning" href="{{ route('materi.show', $materi->id_materi) }}" style="border-radius: 10px;">
                                                      <i class="fas fa-eye fa-sm"></i> Show
                                                    </a>
                                                    <a class="btn btn-primary" href="{{ route('materi.edit', $materi->id_materi) }}" style="border-radius: 10px;">
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
                                {{-- <div class="d-flex justify-content-center">
                                    {{ $materis->links('guru.paginate') }}
                                </div> --}}
                                
                                <!-- Modal Tambah-->
                        <div class="modal fade modal-lg" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="container-fluid my-8">
                                            
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
                                        
                                                    <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <label>Judul Materi:</label>
                                                                <input type="text" name="judulMateri" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <label>File Materi:</label>
                                                                <input type="file" name="fileMateri" class="form-control">
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

                        <!-- Modal Show-->
                        {{-- @foreach($materis as $materi)
                        <div class="modal fade modal-lg" id="showModal{{$materis->id_materi}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Data User</h5>
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
                                                                    <strong>Nomor Induk :</strong>
                                                                    {{ $user->ni }}
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Password :</strong>
                                                                    {{ $user->password }}
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Role :</strong>
                                                                    {{ $user->role }}
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
                        @endforeach --}}

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