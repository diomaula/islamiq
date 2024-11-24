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
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-7 col-lg-10 my-5">
                            <h5 class="card-title mb-0" style="background-color: #79CD7B; padding: 10px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                Ubah Password
                            </h5>
                            <div class="card profil" style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                <div class="card-body">
                                    <div class="modal-body">
                                        <div class="container-fluid my-8">
                                            <div class="row justify-content-center">
                                                <div class="container-fluid">
                                                    <form id="formSimpan" action="{{ route('profil.password', $bks->ni) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')

                                                        <div class="mb-3 row">
                                                            <label for="nip" class="col-sm-4 col-form-label">NIP</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" id="nip" name="nip" class="form-control" value="{{ $bks->ni }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 row">
                                                            <label for="passwordLama" class="col-sm-4 col-form-label">Password Lama</label>
                                                            <div class="col-sm-8 position-relative">
                                                                <input type="password" id="passwordLama" name="passwordLama" class="form-control" required>
                                                                <span class="position-absolute" style="right: 20px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword('passwordLama')">
                                                                    <i class="fas fa-eye"></i>
                                                                </span>
                                                                @error('passwordLama')
                                                                    <div class="text-danger small">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 row">
                                                            <label for="passwordBaru" class="col-sm-4 col-form-label">Password Baru</label>
                                                            <div class="col-sm-8 position-relative">
                                                                <input type="password" id="passwordBaru" name="passwordBaru" class="form-control" required>
                                                                <span class="position-absolute" style="right: 20px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword('passwordBaru')">
                                                                    <i class="fas fa-eye"></i>
                                                                </span>
                                                                @error('passwordBaru')
                                                                    <div class="text-danger small">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mb-3 row">
                                                            <label for="passwordBaru_confirmation" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                                                            <div class="col-sm-8 position-relative">
                                                                <input type="password" id="passwordBaru_confirmation" name="passwordBaru_confirmation" class="form-control" required>
                                                                <span class="position-absolute" style="right: 20px; top: 50%; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword('passwordBaru_confirmation')">
                                                                    <i class="fas fa-eye"></i>
                                                                </span>
                                                                @error('passwordBaru_confirmation')
                                                                    <div class="text-danger small">{{ $message }}</div>
                                                                @enderror
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
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('layouts.script')

    <!-- SweetAlert Script -->
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#79CD7B'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    <!-- Password Toggle Script -->
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
