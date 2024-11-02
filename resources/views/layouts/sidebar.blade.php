<! -- Admin -->
@can('admin')
<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-menu"></i>
        </button>
        <div class="sidebar-logo">
            <h1>ISLAMIQ</h1>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="/admin/dashboard" class="sidebar-link">
                <i class="lni lni-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="/admin/user" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>User</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link" id="logoutLink" onclick="confirmLogout(event)">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>

@endcan

<! -- Guru -->
@can('guru')
<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-menu"></i>
        </button>
        <div class="sidebar-logo">
            <h1>ISLAMIQ</h1>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('dashboardguru') }}" class="sidebar-link">
                <i class="lni lni-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('materiguru') }}" class="sidebar-link">
                <i class="bx bxs-book-open"></i>
                <span>Materi</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('latsol') }}" class="sidebar-link">
                <i class="bx bxs-book"></i>
                <span>Latihan Soal</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link" id="logoutLink" onclick="confirmLogout(event)">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

</aside>
@endcan

@can('siswa')
<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-menu"></i>
        </button>
        <div class="sidebar-logo">
            <h1>ISLAMIQ</h1>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('dashboardsiswa') }}" class="sidebar-link">
                <i class="lni lni-dashboard"></i>
                <span>Waktu Shalat</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route ('siswa.materi.index') }}" class="sidebar-link">
                <i class="lni lni-book"></i>
                <span>Materi</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('surah') }}" class="sidebar-link">
                <i class="lni lni-library"></i>
                <span>Al-Qur'an</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('doa') }}" class="sidebar-link">
                <i class="lni lni-ticket-alt"></i>
                <span>Doa - Doa</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route ('siswa.latsol.index') }}" class="sidebar-link">
                <i class="lni lni-pencil-alt"></i>
                <span>Latihan Soal</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link" id="logoutLink" onclick="confirmLogout(event)">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>


</aside>
@endcan

@can('kepsek')
<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-menu"></i>
        </button>
        <div class="sidebar-logo">
            <h1>ISLAMIQ</h1>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('dashboardkepsek') }}" class="sidebar-link">
                <i class="lni lni-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route ('kepsek.materi.index') }}" class="sidebar-link">
                <i class="lni lni-book"></i>
                <span>Materi</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link" id="logoutLink" onclick="confirmLogout(event)">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
@endcan