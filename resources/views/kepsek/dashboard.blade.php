<!DOCTYPE html>
<html>
@include('layouts.header')
<body>
    <div class="wrapper">
        @include('kepsek.sidebar')
        <div class="main">
            @include('layouts.navbar')
            <main class="content px-3 py-4" id="content">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3">Dashboard</h3>
                        <ul class="box-info">
                            <a href="{{ route('generateUserListPDF', ['role' => 'siswa']) }}">           
                                <li>
                                    <i class='bx bxs-user' ></i>
                                    <span class="text">
                                        <h3>{{$totalSiswa }}</h3>
                                        <p>Total Siswa</p>
                                    </span>
                                </li>
                            </a>
                            <a href="{{ route('generateUserListPDF', ['role' => 'guru']) }}">
                                <li>
                                    <i class='bx bxs-group' ></i>
                                    <span class="text">
                                        <h3>{{ $totalGuru }}</h3>
                                        <p>Total Guru</p>
                                    </span>
                                </li>
                            </a>
                            {{-- <a href="">  
                                <li>
                                    <i class='bx bxs-user-detail' ></i>
                                    <span class="text">
                                        <h3>{{ $totalUsers }}</h3>
                                        <p>Total User</p>
                                    </span>
                                </li>
                            </a> --}}
                        </ul>
                    </div>
                </div>
            </main>
            
        </div>
    </div>
    @include('layouts.script')
</body>

</html>