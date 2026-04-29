<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('AdminLte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>Raport - RU</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-header">Data Umum</li>
            <li class="nav-item">
                <a href="{{ route('data-sekolah') }}" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                    Data Sekolah
                    <span class="right badge badge-danger">2</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('data-student')}}" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                    Data Siswa
                    <span class="right badge badge-danger">20</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('data-user')}}" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                    Data Pengguna
                    <span class="right badge badge-danger">20</span>
                    </p>
                </a>
            </li>
            <li class="nav-header">Kurikulum</li>
            <li class="nav-item">
                <a href="{{ route('data-learning') }}" class="nav-link">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                    TP + Semester
                    <span class="badge badge-info right">2</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                    Data Kelas
                    <span class="badge badge-info right">12</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                    Data Mata Pelajaran
                    <span class="badge badge-info right">12</span>
                    </p>
                </a>
            </li>
            <li class="nav-header">Wali Kelas</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                    Input Data
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">6</span>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kelas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Absensi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ekstrakulikuler</p>
                    </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>P 5</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                    Hasil
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Raport</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>P 5</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-header">Guru Mapel</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                    Input Data
                    <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/forms/advanced.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Lingkup Materi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/forms/editors.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Capaian Pembelanjaran</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                    Hasil
                    </p>
                </a>
            </li>
            <li class="nav-header">Menu Tambahan</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                    Hasil
                    </p>
                </a>
            </li>
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>