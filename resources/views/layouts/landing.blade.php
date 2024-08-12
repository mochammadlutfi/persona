<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Persona Public Speaking</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="/js/plugins/sweetalert2/sweetalert2.min.css">
        <link rel="stylesheet" href="/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
        <link rel="stylesheet" href="/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="/js/plugins/flatpickr/flatpickr.min.css">
    

        @stack('styles')
        <!-- Scripts -->
        @vite(['resources/sass/main.scss', 'resources/js/codebase/app.js', 'resources/js/app.js'])
        <style>
            .content-header{
                height: 5.25rem !important;
            }
        </style>
    </head>
    <body>
        <div id="page-container" class="main-content-boxed side-scroll">

            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="space-x-1">
                        <!-- Logo -->
                        <a class="fw-bold" href="{{ route('home') }}">
                            <img src="/images/logo.png" style="width: 250px;"/>
                        </a>
                        <!-- END Logo -->
                    </div>
                    <!-- END Left Section -->

                    <div class="d-flex">
                        <ul class="nav-main nav-main-horizontal nav-main-hover me-2">
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('about') }}">
                                    <span class="nav-main-link-name">Tentang</span>
                                </a>
                            </li>
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('training.index') }}">
                                    <span class="nav-main-link-name">Program Kelas</span>
                                </a>
                            </li>
                            @if(auth()->guard('web')->check())
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('request.index') }}">
                                    <span class="nav-main-link-name">Program Inhouse</span>
                                </a>
                            </li>
                            @endif
                            <li class="nav-main-item">
                                <a class="nav-main-link" href="{{ route('promo.index') }}">
                                    <span class="nav-main-link-name">Promo</span>
                                </a>
                            </li>
                        </ul>

                        @if (Auth::guard('web')->check())
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block fw-semibold">{{ Auth::guard('web')->user()->nama }}</span>
                                <i class="fa fa-angle-down opacity-50 ms-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0"
                                aria-labelledby="page-header-user-dropdown">
                                <div class="px-2 py-3 bg-body-light rounded-top">
                                    <h5 class="h6 text-center mb-0">
                                        {{ Auth::guard('web')->user()->nama }}
                                    </h5>
                                </div>
                                <div class="p-2">
                                    <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                                        href="{{ route('profil.edit') }}">
                                        <span>Profil</span>
                                        <i class="fa fa-fw fa-user opacity-25"></i>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                                        href="{{ route('user.training') }}">
                                        <span>Kelas Saya</span>
                                        <i class="fa fa-fw fa-user opacity-25"></i>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                                        href="{{ route('user.request') }}">
                                        <span>Pengajuan inhouse</span>
                                        <i class="fa fa-fw fa-user opacity-25"></i>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                                        href="{{ route('profil.password') }}">
                                        <span>Ubah Password</span>
                                        <i class="fa fa-fw fa-envelope-open opacity-25"></i>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                            <span>Keluar</span>
                                            <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="space-x1">
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary">Daftar</a>
                            </div>
                        @endif
                    </div>
                    <!-- END Middle Section -->
                </div>
                <!-- END Header Content -->
            </header>

            <!-- Page Content -->
            <main id="main-container">
                {{ $slot }}
            </main>
            <footer id="page-footer" class="bg-body-light">
                <div class="content py-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="/images/logo.png" class="img-fluid">
                        </div>
                        <div class="col-lg-4">
                            <h4 class="h5 fw-bold mb-2">
                                Head Office
                            </h4>
                            <address class="fs-sm">
                                Pesona Cihanjuang 5, No.16. Jalan Cisasawi, Cihanjuang Kec. Parongpong, Kab. Bandung Barat, Jawa Barat 40559.
                            </address>
                        </div>
                        <div class="col-lg-4">
                            <ul class="fa-ul">
                                <li>
                                    <i class="fa fa-envelope fa-li"></i>
                                    <a href="mailto:info@personapublicspeaking.com" target="_blank">
                                        info@personapublicspeaking.com
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-whatsapp fa-li"></i>
                                    <a href="https://api.whatsapp.com/send/?phone=6282211882728&text&type=phone_number&app_absent=0" target="_blank">
                                        +6282211882728
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-phone fa-li"></i>
                                    <a href="tel:+6281931355285" target="_blank">
                                        +6281931355285
                                    </a>
                                </li>
                                <li>
                                    <i class="fab fa-instagram fa-li"></i>
                                    <a href="https://www.instagram.com/personapublicspeaking/" target="_blank">
                                        @personapublicspeaking
                                    </a>
                                </li>
                                <li>
                                    <i class="fab fa-youtube fa-li"></i>
                                    <a href="https://www.youtube.com/@personapublicspeaking" target="_blank">
                                        @personapublicspeaking
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        
        <script src="/js/jquery.min.js"></script>
        <script src="/js/plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="/js/plugins/flatpickr/flatpickr.min.js"></script>
        <script src="/js/plugins/flatpickr/l10n/id.js"></script>
        <script src="/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
        <script src="/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
        <script src="/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
        <script src="/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
        <script src="/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
        <script src="/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
        <script src="/js/plugins/datatables-buttons/buttons.print.min.js"></script>
        <script src="/js/plugins/datatables-buttons/buttons.html5.min.js"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @stack('scripts')
    </body>
</html>
