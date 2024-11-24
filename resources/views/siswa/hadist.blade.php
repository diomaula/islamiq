<!DOCTYPE html>
<html>

<head>
    @include('layouts.header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/cari.css') }}">
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

                        <!-- Form Pencarian -->
                        <form action="{{ route('hadist') }}" method="GET" id="searchInput" class="input-group"
                            style="max-width: 300px;">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari Hadist..."
                                value="{{ request('keyword') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Card Daftar Doa -->
                    <div class="card mb-4">
                        <div class="card-body">
                            @if($paginator->isEmpty())
                            <p>Doa tidak ditemukan.</p>
                            @else
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Hadist</th>
                                        <th scope="col" style="width:18%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($paginator as $hadist)
                                    <tr>
                                        <td>{{ $hadist['name'] ?? 'Tidak ada nama' }}</td>
                                        <td>
                                            <a href="{{ route('hadist.list', ['id' => $hadist['id']]) }}" class="btn btn-primary">Lihat Daftar Hadist</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada data hadist tersedia.</td>
                                    </tr>
                                    @endforelse
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
                                window.location.href = {
                                    {
                                        route('hadist')
                                    }
                                } ? keyword = $ {
                                    encodeURIComponent(keyword)
                                };
                            } else {
                                window.location.href = {
                                    {
                                        route('hadist')
                                    }
                                };
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