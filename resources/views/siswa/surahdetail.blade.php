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
                        <div class=" card-body" style="background-color: #048853; border-radius: 10px;">
                            <h1 class="fw-bold fs-4 mb-3 text-center" style="color: white">{{ $surat['namaLatin'] }} ({{ $surat['arti'] }})</h1>
                        </div>
                    </div>

                    <!-- Deskripsi Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title fw-bold fs-4 mb-3">Deskripsi</h2>
                            <p class="card-text">{!! $surat['deskripsi'] !!}</p>

                            <!-- Audio surah full -->
                            <h2 class="fw-bold fs-4 mb-3">Audio Full Surah</h2>
                            <audio controls style="margin-bottom: 10px;">
                                <source src="{{ $surat['audioFull']['05'] }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>

                    <!-- Ayat Card -->
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title fw-bold fs-4 mb-3">Ayat</h2>
                            <ul>
                                @foreach($surat['ayat'] as $ayat)
                                <li>
                                <li style="position: relative; margin-bottom: 20px;">
                                    <span style="position: absolute; left: -30px; top: 10px; width: 30px; height: 30px; border-radius: 50%; background-color: #048853; color: white; display: flex; align-items: center; justify-content: center;">{{ $ayat['nomorAyat'] }}</span>
                                    <p style="font-size: 40px; direction: rtl; text-align: right;">{{ $ayat['teksArab'] }}</p>
                                </li>
                                <p style="color: grey;">{{ $ayat['teksLatin'] }}</p>
                                <p>Artinya : {{ $ayat['teksIndonesia'] }}</p>
                                @if(isset($ayat['audio']['05']))
                                <audio controls style="margin-bottom: 15px;">
                                    <source src="{{ $ayat['audio']['05'] }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                                @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Bagian tombol surah selanjutnya dan sebelumnya -->
                    <div class="row">
                        <div class="col-md-12 mt-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    @if($surat['suratSebelumnya'])
                                    <a href="{{ url('/siswa/surat/'.$surat['suratSebelumnya']['nomor']) }}" class="btn" style="background-color: #048853; color: white;">Surat Sebelumnya: {{ $surat['suratSebelumnya']['namaLatin'] }}</a>
                                    @endif
                                </div>
                                <div class="ml-auto">
                                    @if($surat['suratSelanjutnya'])
                                    <a href="{{ url('/siswa/surat/'.$surat['suratSelanjutnya']['nomor']) }}" class="btn" style="background-color: #048853; color: white;">Surat Selanjutnya: {{ $surat['suratSelanjutnya']['namaLatin'] }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
        </div>
    </div>
    @include('layouts.script')
    @include('layouts.footer')
</body>

</html>