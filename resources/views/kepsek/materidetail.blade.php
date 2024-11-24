<!DOCTYPE html>
<html>
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
                            <h1 class="fw-bold fs-4 mb-3 text-center" style="color: white">{{ $materi->judulMateri }}</h1>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    @if ($materi->fileMateri)
                                    <p style="margin-top: 15px;">
                                        <embed src="{{ asset('uploads/' . $materi->fileMateri) }}" type="application/pdf" width="100%" height="500px" style="border-radius: 10px;" />
                                    </p>
                                    @else
                                    <p>File Materi tidak tersedia.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                @if ($materi->linkVideo)
                                <div class="form-group">
                                    <strong>Video Pembelajaran :</strong>
                                    <iframe style="border: none; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);" width="100%" height="500px" src="{{ $materi->linkVideo }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                @endif
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