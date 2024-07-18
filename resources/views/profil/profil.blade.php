<!DOCTYPE html>
<html>
@include('layouts.header')
<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')
            <main class="content px-3 py-4">
                <div class="container-fluid my-8">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-h3 custom-font" style="margin-top: 5px;">PROFIL</h1>
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li class="active"><i class="fa fa-user"></i></li>
                            </ol>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-7 col-lg-10 my-5">
                            <h5 class="card-title mb-0" style="background-color: #79CD7B; padding: 10px; border-top-left-radius: 10px; border-top-right-radius: 10px; ">
                                Profil
                            </h5>
                            <div class="card profil" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-8 d-flex">
                                            <div class="profile-image-box" style=" margin-left: 20px;">
                                                @if($bks->image)
                                                <div class="profil-img" style="display: flex; width: 128px; height: 128px; margin-top: 40px; border: 1px solid #000000; border-radius: 50%; overflow: hidden;">
                                                    <img src="{{ asset('storage/'. $bks->image) }}" alt="Gambar Profil" class="img-fluid rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                @else
                                                <i class="fas fa-user-circle fa-8x profile-icon" style="line-height: 200px; margin-right: 45px; color: gray;"></i>
                                                @endif
                                            </div>
                                            <div class="col-sm-9">
                                                <form action="{{ route('profil.edit', $bks->ni) }}" method="POST">
                                                    <div class="mb-3 col">
                                                        <div class="mb-3 row">
                                                            <label for="ni" class="col-sm-4 col-form-label">NIP</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="ni" name="ni" class="form-control" value="{{ $bks->ni }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="namaLengkap" class="col-sm-4 col-form-label">Nama Lengkap</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="namaLengkap" name="namaLengkap" class="form-control" value="{{ $bks->namaLengkap }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="tanggalLahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" id="tanggalLahir" name="tanggalLahir" class="form-control" value="{{ $bks->tanggalLahir }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="jenisKelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="jenisKelamin" name="jenisKelamin" class="form-control" value="{{ $bks->jenisKelamin }}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-center" style="background-color: #FFFFFF; padding: 10px; display: flex; justify-content: center; align-items: center;">
                                                        <a href="#" class="btn" style="color: white; background-color: #79CD7B; border-radius: 10px; margin-left: 180px;" data-bs-toggle="modal" data-bs-target="#editModal{{$bks->ni}}">
                                                            <i class="fas fa-edit fa-sm"></i> Update Profil
                                                        </a>
                                                        <a href="#" class="btn" style="color: #1E90FF; background-color: transparent; border-radius: 10px; margin-left: auto;" data-bs-toggle="modal" data-bs-target="#passModal{{$bks->ni}}">
                                                            <i class="fas fa-edit fa-sm"></i> Update Password
                                                        </a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade modal-lg" id="editModal{{$bks->ni}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Profil</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
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
                                                <form id="formSimpan" action="{{ route('update',$bks->ni) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <div class="mb-3 row">
                                                                    <label for="ni" class="col-sm-4 col-form-label">NIP</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" id="ni" name="ni" class="form-control" value="{{ $bks->ni }}" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="mb-3 row">
                                                                    <label for="namaLengkap" class="col-sm-4 col-form-label">Nama Lengkap</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" id="namaLengkap" name="namaLengkap" class="form-control" value="{{ $bks->namaLengkap }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="mb-3 row">
                                                                    <label for="tanggalLahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="date" id="tanggalLahir" name="tanggalLahir" class="form-control" value="{{ $bks->tanggalLahir }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="mb-3 row">
                                                                <label for="jenisKelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                                                <div class="col-sm-8">
                                                                    <select id="jenisKelamin" name="jenisKelamin" class="form-control">
                                                                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                                        <option value="Laki-Laki" @if($bks->jenisKelamin == 'Laki-Laki') selected @endif>Laki-Laki</option>
                                                                        <option value="Perempuan" @if($bks->jenisKelamin == 'Perempuan') selected @endif>Perempuan</option>
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="mb-3 row">
                                                                <label for="image" class="col-sm-4 col-form-label">Photo Profile</label>
                                                                <div class="col-sm-8">
                                                                    <input class="form-control @error('image') is invalid @enderror" type="file" id="image" name="image">
                                                                </div>
                                                            </div> --}}
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


                    <!-- Modal Password -->
                    <div class="modal fade modal-lg" id="passModal{{$bks->ni}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid my-8">
                                        <div class="row justify-content-center">
                                            <div class="container-fluid">
                                                @if (session()->has('error'))
                                                <p class="text-danger">{{ session('error') }}</p>
                                                @endif
                                                <form id="formSimpan" action="{{ route('profil.password',$bks->ni) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="mb-3 row">
                                                        <label for="nip" class="col-sm-4 col-form-label">NIP</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="nip" name="nip" class="form-control" value="{{ $bks->ni }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="passwordLama" class="col-sm-4 col-form-label">Password lama</label>
                                                        <div class="col-sm-8">
                                                            <input type="password" id="passwordLama" name="passwordLama" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="passwordBaru" class="col-sm-4 col-form-label">Password Baru</label>
                                                        <div class="col-sm-8">
                                                            <input type="password" id="passwordBaru" name="passwordBaru" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="repeatPassword" class="col-sm-4 col-form-label">Konfirmasi Password</label required>
                                                        <div class="col-sm-8">
                                                            <input type="password" id="repeatPassword" name="repeatPassword" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" action="{{ route('profil.password') }}">
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
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            @if (session()->has('error'))
                                var modal = new bootstrap.Modal(document.getElementById('passModal{{$bks->ni}}'));
                                modal.show();
                            @endif
                        });
                    </script>

                </div>
            </main>
        </div>
    </div>
    @include('layouts.script')
</body>

</html>