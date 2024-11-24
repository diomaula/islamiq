<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/hadist/hadistdetail.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="fw-bold fs-4 mb-0">Detail Hadist</h1>
                        <a href="{{ route('hadist.list', ['id' => $id]) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    {{-- Check if the hadith data exists --}}
                    @if(isset($hadist['contents']))
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3>{{ $hadist['name'] }} - Nomor Hadist : {{ $hadist['contents']['number'] }}</h3>
                        </div>
                        <div class="card-body">
                            <p class="arab-text">{{ $hadist['contents']['arab'] }}</p>

                            <h5>Terjemahan :</h5>
                            <p class="translation-text">{{ $hadist['contents']['id'] }}</p>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-danger">
                        Data hadist tidak ditemukan atau gagal diambil dari API.
                    </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
    @include('layouts.script')
    @include('layouts.footer')
</body>

</html>