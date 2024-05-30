<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- FONTS GOOGLE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto&display=swap" rel="stylesheet">
    
    <!-- MY STYLE -->
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <!-- LOGO TITLE BAR -->
    <link rel="icon" href="{{ asset('assets/islamiq.png') }}" type="image/x-icon">

    <title>Welcome to ISLAMIQ</title>
  </head>

  <body>
    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-trasparent position-fixed w-100">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="{{ asset('Assets/islamiq.png') }}" alt="" width="30" height="30" class="d-inline-block align-text-top me-3">ISLAMIQ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse navbar-nav mx-auto" id="navbarNav">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item mx-2">
                {{-- <a class="nav-link active" href="#">Branda</a> --}}
              </li>
              <li class="nav-item mx-2">
                {{-- <a class="nav-link" href="#">Layanan</a> --}}
              </li>
              <li class="nav-item mx-2">
                {{-- <a class="nav-link" href="#">Fitur</a> --}}
              </li>
              <li class="nav-item mx-2">
                {{-- <a class="nav-link" href="#">Kontak</a> --}}
              </li>
            </ul>

            <div>
              <button id="loginButton" class="button-secondary">Masuk</button>
            </div>

          </div>
        </div>
      </nav>

      <!-- HERO SECTION -->
      <section id="hero">
        <div class="container h-100">
          <div class="row h-100">
            <div class="col-md-6 hero-tagline my-auto">
              <h1>Welcome to IslamiQ </h1>
                <p>Kamu bisa menikmati layanan aplikasi IslamiQ untuk mendukung 
                  proses pembelajaran Pendidikan Agama Islam di Sekolah Dasar. 
                  Jelajahi semua fitur yang ada seperti upload materi dan latihan soal, 
                  serta melihat report hasil pembelajaran siswa untuk mengukur tingkat kepahaman siswa. 
                  Yuk coba aplikasi IslamiQ sekarang!</p>

                  <button class="button-lg-primary">Informasi Lainnya</button>
                  <a href="#">
                    <img src="Assets/Right Arrow lg.png" alt="">
                  </a>
            </div>
          </div>

          <img src="assets/undraw.png" alt="" class="position-absolute end-0 bottom-0 img-hero">
          <img src="assets/accsent2.png" alt="" class="position-absolute end-0 bottom-0 accsent-img">
          <img src="assets/Accsent 1.png" alt="" class=" accsent-img h-100 position-absolute top-0 start-0">
        </div>
      </section>

      <script>
        document.getElementById('loginButton').addEventListener('click', function() {
            window.location.href = "{{ route('login') }}";
        });
        </script>
        
    </body>
</head>