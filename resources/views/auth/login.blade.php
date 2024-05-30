<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Islamiq | Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Modak&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body style="background-color: #f0f0f0;"> <!-- Warna abu-abu -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-10 col-md-6 col-lg-5">

                <div class="text-center mt-3 custom-font">
                    <h1 class="mb-3 text-center" style="font-family: 'Modak', cursive; font-size: 60px">IslamiQ</h1>
                </div>

                <div class="card">
                    <div class="card-body">
                        @if (session()->has('error'))
                        <p class="text-danger">{{ session('error') }}</p>
                        @endif

                        <form action="{{ route('login.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="ni" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Induk') }}</label>

                                <div class="col-md-12">
                                    <input id="ni" type="text" class="form-control @error('ni') is-invalid @enderror" name="ni" value="{{ old('ni') }}" required autocomplete="ni" autofocus>

                                    @error('ni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>