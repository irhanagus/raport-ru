<nav class="main-header navbar navbar-expand fixed-top navbar-light bg-white shadow-sm">
    
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-secondary" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link font-weight-bold text-dark">
                SMK RIYADHUL ULUM
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-items-center">

        <!-- Search -->
        <li class="nav-item">
            <a class="nav-link text-secondary" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" 
                               placeholder="Search..." aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar text-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar text-danger" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Fullscreen -->
        <li class="nav-item">
            <a class="nav-link text-secondary" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- User Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
                <img src="{{ asset('AdminLte/dist/img/user.png')}}" 
                     class="img-circle elevation-2" 
                     alt="User Image" 
                     style="width:32px; height:32px; object-fit:cover; margin-right:6px;">
                <span class="d-none d-md-inline text-dark">{{ auth()->user()->name ?? 'User' }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow-lg animated fadeIn">
                <div class="dropdown-item text-center">
                    <img src="{{ asset('AdminLte/dist/img/user.png')}}" 
                         class="img-circle mb-2" 
                         style="width:50px; height:50px; object-fit:cover;">
                    <p class="mb-0 font-weight-bold text-dark">{{ auth()->user()->name ?? 'User' }}</p>
                    <small class="text-muted">Online</small>
                </div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item text-center text-dark">
                    <i class="fas fa-user mr-2"></i> Profil
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout')}}" class="dropdown-item text-center text-danger font-weight-bold">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<style>
/* Navbar custom style */
.navbar-nav .nav-link {
    transition: background 0.3s, color 0.3s;
    border-radius: 6px;
}
.navbar-nav .nav-link:hover {
    background: rgba(0,0,0,0.05);
}
.dropdown-menu {
    border-radius: 10px;
}
@media (max-width: 768px) {
    .navbar-nav .nav-link span {
        display: none; /* nama user sembunyi di HP, hanya avatar */
    }
}
</style>
