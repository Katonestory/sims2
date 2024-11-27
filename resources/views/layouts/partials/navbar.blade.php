<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ url('home') }}" style="font-size: 1.5rem; letter-spacing: 8px;">SIMS</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        {{-- <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div> --}}
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <!-- Welcome Text -->
        <li class="nav-item">
            <span class="navbar-text me-3">Welcome to SIMS</span>
        </li>

        <!-- Logout Button -->
        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link" style="background: none; border: none; padding: 0; cursor: pointer;">
                    <i class="fas fa-power-off" style="margin-right: 8px;"></i> Logout
                </button>
            </form>
        </li>
    </ul>


</nav>
