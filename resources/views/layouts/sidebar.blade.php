<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="d-flex justify-content-lg-center p-4">
            <!-- Logo -->
            <div>
                <img src="/images/logo.png" width="140px">
            </div>
            <!-- END Logo -->
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/beranda') ? ' active' : '' }}" href="{{ route('admin.beranda') }}">
                            <i class="nav-main-link-icon fa fa-house-user"></i>
                            <span class="nav-main-link-name">Beranda</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/peserta') ? ' active' : '' }}" href="{{ route('admin.user.index') }}">
                            <i class="nav-main-link-icon fa fa-users"></i>
                            <span class="nav-main-link-name">Peserta</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/training') ? ' active' : '' }}" href="{{ route('admin.training.index') }}">
                            <i class="nav-main-link-icon fa fa-book"></i>
                            <span class="nav-main-link-name">Training</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/request') ? ' active' : '' }}" href="{{ route('admin.request.index') }}">
                            <i class="nav-main-link-icon fa fa-envelope"></i>
                            <span class="nav-main-link-name">Request Kelas</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/pendaftaran') ? ' active' : '' }}" href="{{ route('admin.payment.index') }}">
                            <i class="nav-main-link-icon fa fa-wallet"></i>
                            <span class="nav-main-link-name">Pendaftaran</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/program') ? ' active' : '' }}" href="{{ route('admin.program.index') }}">
                            <i class="nav-main-link-icon fa fa-archive"></i>
                            <span class="nav-main-link-name">Program</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/promo') ? ' active' : '' }}" href="{{ route('admin.promo.index') }}">
                            <i class="nav-main-link-icon fa fa-percent"></i>
                            <span class="nav-main-link-name">Promo</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/trainer') ? ' active' : '' }}" href="{{ route('admin.trainer.index') }}">
                            <i class="nav-main-link-icon fa fa-user-tie"></i>
                            <span class="nav-main-link-name">Trainer</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('admin/laporan') ? ' active' : '' }}" href="{{ route('admin.laporan.index') }}">
                            <i class="nav-main-link-icon fa fa-print"></i>
                            <span class="nav-main-link-name">Laporan</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </div>
    <!-- Sidebar Content -->
</nav>