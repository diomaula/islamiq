<!DOCTYPE html>
<html>
@include('layouts.header')

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')

            @if ($errors->any())
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal menambahkan data!',
                        text: '@foreach ($errors->all() as $error){{ $error }}@endforeach',
                    });
                </script>
            @endif

            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                    });
                </script>
            @endif


            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">User</h3>
                        <div class="mb-3">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                                    class='bx bx-user-plus'></i> Tambah User</button>

                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpload"><i
                                    class='bx bx-cloud-upload'></i> Upload</button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">Nomor Induk</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr class="text-center">
                                                <td>{{ $user->ni }}</td>
                                                <td>{{ $user->namaLengkap }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td class="table-actions">
                                                    <form action="{{ route('user.destroy', $user->ni) }}" method="POST"
                                                        style="display:inline">
                                                        <a href="#" class="btn btn-warning"
                                                            style="border-radius: 10px;" data-bs-toggle="modal"
                                                            data-bs-target="#showModal{{ $user->ni }}">
                                                            <i class="fas fa-eye fa-sm"></i> Show
                                                        </a>
                                                        <a href="#" class="btn btn-primary"
                                                            style="border-radius: 10px;" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $user->ni }}">
                                                            <i class="fas fa-edit fa-sm"></i> Edit
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus?')"
                                                            style="border-radius: 10px;">
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
                                    {{ $users->links('layouts.paginate') }}
                                </div>

                            </div>
                        </div>

                        <!-- Modal Tambah-->
                        <div class="modal fade modal-lg" id="modalTambah" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('user.store') }}" method="POST">
                                        <div class="modal-body">
                                            <div class="row justify-content-center">
                                                <div class="container-fluid">


                                                    {{-- @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <strong>Whoops!</strong> There were some problems with your
                                                            input.<br><br>
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif --}}


                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <label for="ni">Nomor Induk:</label>
                                                                <input type="number" class="form-control"
                                                                    id="ni" name="ni" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="namaLengkap">Nama:</label>
                                                                <input type="text" class="form-control"
                                                                    id="namaLengkap" name="namaLengkap" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password">Password:</label>
                                                                <input type="text" class="form-control"
                                                                    id="password" name="password" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="role">Role:</label>
                                                                <select id="role" name="role"
                                                                    class="form-control" required>
                                                                    <option value="{{ old('role') }}" disabled
                                                                        selected>Pilih Role</option>
                                                                    <option value="guru">Guru</option>
                                                                    <option value="siswa">Siswa</option>
                                                                    <option value="kepsek">Kepsek</option>
                                                                </select>
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

                        <!-- Modal Upload-->
                        <div class="modal fade" id="modalUpload" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="/users-upload" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <p><strong>Format file harus berupa Excel (.xlsx atau .xls)</strong></p>
                                                <input class="form-control" type="file" name="file" id="file" required>
                                            </div>
                                            <div class="mt-3">
                                                <p><strong>Contoh format:</strong> Header tidak perlu dihapus!</p>
                                                <a href="{{ asset('files/contoh_file.xlsx') }}" download>download format</a>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Show-->
                        @foreach ($users as $user)
                            <div class="modal fade modal-lg" id="showModal{{ $user->ni }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Data User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
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
                                                                        <strong>Nama :</strong>
                                                                        {{ $user->namaLengkap }}
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
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Modal Edit -->
                        @foreach ($users as $user)
                            <div class="modal fade modal-lg" id="editModal{{ $user->ni }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid my-8">
                                                <div class="row justify-content-center">
                                                    <div class="container-fluid">
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <strong>Whoops!</strong> There were some problems with
                                                                your input.<br><br>
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <form id="formSimpan"
                                                            action="{{ route('user.update', $user->ni) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="ni">Nomor Induk:</label>
                                                                        <input type="number" class="form-control"
                                                                            id="ni" name="ni"
                                                                            value="{{ $user->ni }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="password">Password:</label>
                                                                        <input type="password" class="form-control"
                                                                            id="password" name="password"
                                                                            value="{{ $user->password }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="role">Role:</label>
                                                                        <select class="form-control" id="role"
                                                                            name="role" required>
                                                                            <option value="guru"
                                                                                {{ $user->role == 'guru' ? 'selected' : '' }}>
                                                                                Guru</option>
                                                                            <option value="siswa"
                                                                                {{ $user->role == 'siswa' ? 'selected' : '' }}>
                                                                                Siswa</option>
                                                                            <option value="kepsek"
                                                                                {{ $user->role == 'kepsek' ? 'selected' : '' }}>
                                                                                Kepsek</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-success">Simpan</button>
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
            @include('layouts.footer')
        </div>
    </div>
    @include('layouts.script')
</body>

</html>
