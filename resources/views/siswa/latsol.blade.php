<!DOCTYPE html>
<html>
@include('layouts.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Tambahkan link untuk SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
    @include('layouts.navbar')
    <div class="wrapper">
        <div class="container mt-3">
            <div class="card mb-4" style="border-radius: 10px;">
                <div class="card-body" style="background-color: #048853; border-radius: 10px;">
                    <h1 class="fw-bold fs-4 mb-3 text-center" style="color: white">{{ $latihanSoal->judulLatsol }}</h1>
                </div>
            </div>

            <form id="quizForm" action="{{ url('/siswa/latihan/' . $id_tugas . '/submit') }}" method="POST">
                @csrf

                @foreach ($soalList as $soal)
                    <div class="card mb-3">
                        <div class="card-body" style="background-color: #e4e4e4; border-radius: 10px;">
                            <h5 class="card-title">{{ $loop->iteration }}. {{ $soal->pertanyaan }}</h5>
                            <div>
                                <input type="radio" name="soal_{{ $soal->id }}" value="A" id="q{{ $soal->id }}a">
                                <label for="q{{ $soal->id }}a">{{ $soal->pilihanA }}</label><br>

                                <input type="radio" name="soal_{{ $soal->id }}" value="B" id="q{{ $soal->id }}b">
                                <label for="q{{ $soal->id }}b">{{ $soal->pilihanB }}</label><br>

                                <input type="radio" name="soal_{{ $soal->id }}" value="C" id="q{{ $soal->id }}c">
                                <label for="q{{ $soal->id }}c">{{ $soal->pilihanC }}</label><br>

                                <input type="radio" name="soal_{{ $soal->id }}" value="D" id="q{{ $soal->id }}d">
                                <label for="q{{ $soal->id }}d">{{ $soal->pilihanD }}</label><br>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="text-end mb-5">
                    <button type="button" id="submitBtn" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('submitBtn').addEventListener('click', function() {
            const form = document.getElementById('quizForm');
            let allAnswered = true;

            const soalIds = [
                @foreach ($soalList as $soal)
                    {{ $soal->id }},
                @endforeach
            ];

            soalIds.forEach((id) => {
                const options = document.querySelectorAll(`input[name="soal_${id}"]`);
                const answered = Array.from(options).some(option => option.checked);

                if (!answered) {
                    allAnswered = false;
                }
            });

            if (!allAnswered) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Jawaban Belum Lengkap',
                    text: 'Harap menjawab semua pertanyaan sebelum mengirim.',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak dapat mengubah jawaban setelah submit!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, submit!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
</body>
</html>
