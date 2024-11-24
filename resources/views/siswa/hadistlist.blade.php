<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/hadist/hadistlist.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="fw-bold fs-4 mb-0">Daftar Hadist</h1>
                        <a href="{{ route('hadist') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <div class="row">
                        @foreach ($hadistList as $hadist)
                        <div class="col-md-4 mb-3"> <!-- Menyesuaikan ukuran kolom -->
                            <a href="{{ route('hadist.detail', ['id' => $id, 'number' => $hadist['number']]) }}" class="card text-decoration-none h-100"> <!-- Kartu dengan tautan -->
                                <div class="card-body">
                                    <h5 class="card-title">Nomor Hadist : {{ $hadist['number'] }}</h5>
                                </div>
                            </a>
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