<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerjakan Soal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Kerjakan Soal</h2>

        <!-- Tampilkan Soal dalam Card -->
        <form action="{{ url('/siswa/latihan/' . $id_tugas . '/submit') }}" method="POST">
            @csrf

            @foreach ($soalList as $soal)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Soal {{ $loop->iteration }}</h5>
                        <p class="card-text">{{ $soal->pertanyaan }}</p>
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

            <div class="text-center">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
