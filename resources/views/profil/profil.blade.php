<!DOCTYPE html>
<html>
@include('layouts.header')
<body>
    <div class="wrapper">
        @include('guru.sidebar')
        <div class="main">
            @include('layouts.navbar')
            <main class="content px-3 py-4">
                <div class="container-fluid my-8">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-h3 custom-font" style="margin-top: 10px;">PROFIL</h1>
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
                                                <form action="{{ route('edit', $bks->ni) }}" method="POST">
                                                    <div class="mb-3 col">
                                                        <div class="mb-3 row">
                                                            <label for="ni" class="col-sm-4 col-form-label">NIP</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="ni" name="ni" class="form-control" value="{{ $bks->ni }}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="namaLengkap" class="col-sm-4 col-form-label">Nama Lengkap</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="namaLengkap" name="namaLengkap" class="form-control" value="{{ $bks->namaLengkap }}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="tanggalLahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                                            <div class="col-sm-8">
                                                                <input type="date" id="tanggalLahir" name="tanggalLahir" class="form-control" value="{{ $bks->tanggalLahir }}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="jenisKelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="jenisKelamin" name="jenisKelamin" class="form-control" value="{{ $bks->jenisKelamin }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-center" style="background-color: #FFFFFF; padding: 10px; display: flex; justify-content: center; align-items: center;">
                                                        <a href="{{ route('edit') }}" class="btn" style="color: white; background-color: #79CD7B; border-radius: 10px; margin-left: 180px;">Update Profil</a>
                                                        <a href="{{ route('pass') }}" class="btn" style="color: #1E90FF; background: transparent; margin-left: auto;">Edit Password</a>
                                                    </div>
                                                </form>
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