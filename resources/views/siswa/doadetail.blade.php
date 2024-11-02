<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

@include('layouts.header')

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')
            <main class="content px-3 py-4">
                <div class="container-fluid">

                    <div class="card mb-4" style="border-radius: 10px;">
                        <div class="card-body" style="background-color: #048853; border-radius: 10px;">
                            <h1 class="fw-bold fs-4 mb-3 text-center" style="color: white">{{ $doa['nama'] }}</h1>
                        </div>
                    </div>

                    <!-- Doa Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <ul>
                                <li>
                                    <p style="font-size: 40px; direction: rtl; text-align: right;">{{ $doa['ar'] }}</p>
                                    <p style=" color: grey;">{{ $doa['tr'] }}</p>
                                    <h2 class="card-title fw-bold fs-4 mb-3">Artinya : </h2>
                                    <p>{{ $doa['idn'] }}</p>
                                    <h2 class="card-title fw-bold fs-4 mb-3">Tentang Doa : </h2>
                                    <p class="card-text">
                                        {!! nl2br(e($doa['tentang'])) !!}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bagian tombol doa selanjutnya dan sebelumnya -->
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    @if(isset($doa['doaSebelumnya']))
                                    <a href="{{ url('/doa/'.$doa['doaSebelumnya']['id']) }}" class="btn" style="background-color: #048853; color: white;">Doa Sebelumnya: {{ $doa['doaSebelumnya']['nama'] }}</a>
                                    @endif
                                </div>
                                <div class="ml-auto">
                                    @if(isset($doa['doaSelanjutnya']))
                                    <a href="{{ url('/doa/'.$doa['doaSelanjutnya']['id']) }}" class="btn" style="background-color: #048853; color: white;">Doa Selanjutnya: {{ $doa['doaSelanjutnya']['nama'] }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts.footer')
        </div>
    </div>
    @include('layouts.script')
</body>

</html>