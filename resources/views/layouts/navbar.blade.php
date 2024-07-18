@can('admin')
<nav class="navbar navbar-expand px-4 py-3">
    <form action="#" class="d-none d-sm-inline-block">

    </form>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="#" class="nav-icon pe-md-0">
                    <img src="{{ asset('Assets/adminn.jpg') }}" class="avatar img-fluid" alt="" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                </a>
                <!-- <div class="dropdown-menu dropdown-menu-end rounded">

                </div> -->
            </li>
        </ul>
    </div>
</nav>
@endcan

@can('navbar-access')
<nav class="navbar navbar-expand px-4 py-3">
    <form action="#" class="d-none d-sm-inline-block">

    </form>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">

                <a href="{{ route('viewProfil') }}" class="nav-icon pe-md-0">
                    <img src="{{ asset('Assets/logo.png') }}" class="avatar img-fluid" alt="" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                </a>
                <!-- <div class="dropdown-menu dropdown-menu-end rounded">

                </div> -->
            </li>
        </ul>
    </div>
</nav>
@endcan