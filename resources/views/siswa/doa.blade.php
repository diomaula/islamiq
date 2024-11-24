<!DOCTYPE html>
<html>
@include('layouts.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main">
            @include('layouts.navbar')
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="fw-bold fs-4 mb-0">Daftar Doa</h1>

                        <!-- Form Pencarian -->
                        <form action="{{ route('doa') }}" method="GET" id="searchInput" class="input-group"
                            style="max-width: 300px;">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari Doa..."
                                value="{{ request('keyword') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Card Daftar Doa -->
                    <div class="card mb-4">
                        <div class="card-body">
                            @if ($paginator->isEmpty())
                                <p>Doa tidak ditemukan.</p>
                            @else
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Doa</th>
                                            <th scope="col" style="width:15%">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paginator as $index => $doa)
                                            <tr>
                                                <!-- Menggunakan $startNumber + $loop->index untuk penomoran yang berkelanjutan -->
                                                <td>{{ $startNumber + $loop->index }}</td>
                                                <td>{{ $doa['nama'] }}</td>
                                                <td>
                                                    <a href="{{ route('doa.detail', $doa['id']) }}"
                                                        class="btn btn-primary">Lihat Detail <i
                                                            class="bi bi-arrow-right"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            @endif

                            <!-- Pagination Links -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $paginator->links('layouts.paginate') }}
                            </div>
                        </div>
                    </div>

                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const keywordInput = document.querySelector('#searchInput input[name="keyword"]');

                        keywordInput.addEventListener('input', function() {
                            const keyword = keywordInput.value.trim();
                            if (keyword.length > 0) {
                                window.location.href = {{ route('doa') }} ? keyword = $ {
                                    encodeURIComponent(keyword)
                                };
                            } else {
                                window.location.href = {{ route('doa') }};
                            }
                        });
                    });
                </script>
            </main>
            </div>
        </div>
            @include('layouts.script')
            @include('layouts.footer')
</body>

</html>
