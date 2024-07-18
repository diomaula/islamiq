{{-- <aside id="sidebar">
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
        <a href="#" class="sidebar-link" id="logoutLink">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    
    <script>
        document.getElementById('logoutLink').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logoutForm').submit();
        });
    </script>
</aside> --}}