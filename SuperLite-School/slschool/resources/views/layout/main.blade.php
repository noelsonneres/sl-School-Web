<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="/assets/js/hyper-config.js"></script>

    <!-- App css -->
    <link href="/assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    {{-- jquery --}}
    {{-- <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/jquery-mask-plugin/jquery.mask.min.js"></script> --}}

</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="index.html" class="logo-light">
                            <span class="logo-lg">
                                <img src="/assets/images/logo.png" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="/assets/images/logo-sm.png" alt="small logo">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="index.html" class="logo-dark">
                            <span class="logo-lg">
                                <img src="/assets/images/logo-dark.png" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="/assets/images/logo-dark-sm.png" alt="small logo">
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>

                    <!-- Topbar Search Form -->
                    <div class="app-search dropdown d-none d-lg-block">
                        <h5 class="text-primary">Sl-School</h5>
                        @if (auth()->check())
                            <h6>{{ auth()->user()->empresas->nome }}</h6>
                            <h6>{{ auth()->user()->empresas->cnpj }}</h6>
                        @endif
                    </div>
                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">
                    <li class="dropdown d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ri-search-line font-22"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                            <form class="p-3">
                                <input type="search" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                            </form>
                        </div>
                    </li>

                    <li class="d-none d-sm-inline-block">
                        <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                            <i class="ri-settings-3-line font-22"></i>
                        </a>
                    </li>

                    <li class="d-none d-sm-inline-block">
                        <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                            title="Theme Mode">
                            <i class="ri-moon-line font-22"></i>
                        </div>
                    </li>


                    <li class="d-none d-md-inline-block">
                        <a class="nav-link" href="" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line font-22"></i>
                        </a>
                    </li>

                    <li class="dropdown">
                        @if (auth()->check())
                            <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src="/img/usuarios/{{auth()->user()->foto}}" alt="user-image" width="32"
                                        class="rounded-circle">
                                </span>
                                <span class="d-lg-flex flex-column gap-1 d-none">
                                    <h5 class="my-0">{{ auth()->user()->name }}</h5>
                                    {{-- <h6 class="my-0 fw-normal">Founder</h6> --}}
                                </span>
                            </a>
                        @endif
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="mdi mdi-account-edit me-1"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="mdi mdi-lifebuoy me-1"></i>
                                <span>Support</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="mdi mdi-lock-outline me-1"></i>
                                <span>Lock Screen</span>
                            </a>

                            <!-- item-->
                            <a href="{{ route('login.logout') }}" class="dropdown-item">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- Brand Logo Light -->
            <a href="index.html" class="logo logo-light">
                <span class="logo-lg">
                    <img src="/assets/images/logo.png" alt="logo">
                </span>
                <span class="logo-sm">
                    <img src="/assets/images/logo-sm.png" alt="small logo">
                </span>
            </a>

            <!-- Brand Logo Dark -->
            <a href="index.html" class="logo logo-dark">
                <span class="logo-lg">
                    <img src="/assets/images/logo-dark.png" alt="dark logo">
                    <h5 class="text-white">Sl-School</h5>
                </span>
                <span class="logo-sm">
                    <img src="/assets/images/logo-dark-sm.png" alt="small logo">
                    <h5 class="text-white">Sl-School</h5>
                </span>
            </a>

            <!-- Sidebar Hover Menu Toggle Button -->
            <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Show Full Sidebar">
                <i class="ri-checkbox-blank-circle-line align-middle"></i>
            </div>

            <!-- Full Sidebar Menu Close Button -->
            <div class="button-close-fullsidebar">
                <i class="ri-close-fill align-middle"></i>
            </div>

            <!-- Sidebar -left -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!-- Leftbar User -->
                <div class="leftbar-user">
                    <a href="pages-profile.html">
                        <img src="/assets/images/users/avatar-1.jpg" alt="user-image" height="42"
                            class="rounded-circle shadow-sm">
                        <span class="leftbar-user-name mt-2">Dominic Keller</span>
                    </a>
                </div>

                <!--- Sidemenu -->
                <ul class="side-nav">

                    {{-- <li class="side-nav-title">Navigation</li> --}}

                    <li class="side-nav-item">
                        <a href="index.html" class="side-nav-link">
                            <i class="ri-home-2-fill"></i>
                            <span> Home </span>
                        </a>
                    </li>

                    {{-- <li class="side-nav-title">Matrículas</li> --}}

                    {{-- MENU MATRÍCULA --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false"
                            aria-controls="sidebarPages" class="side-nav-link">
                            <i class="uil-graduation-hat"></i>
                            <span> Matrículas </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPages">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="pages-faq.html">FAQ</a>
                                </li>
                                <li>
                                    <a href="pages-maintenance.html">Maintenance</a>
                                </li>

                                <li>
                                    <a href="pages-starter.html">Starter Page</a>
                                </li>
                                <li>
                                    <a href="pages-preloader.html">With Preloader</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- CADASTRO BASE --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#cadastroBase" aria-expanded="false"
                            aria-controls="cadastroBase" class="side-nav-link">
                            <i class="uil-folder-plus"></i>
                            <span> Cadastro base </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="cadastroBase">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="/diasAula">Dias de aulas</a>
                                </li>
                                <li>
                                    <a href="/horarioAula">Horário de aulas</a>
                                </li>
                                <li>
                                    <a href="/salasAulas">Sala</a>
                                </li>
                                <li>
                                    <a href="/disciplinas">Disciplinas</a>
                                </li>
                                <li>
                                    <a href="layouts-hover.html" target="_blank">Hover Menu</a>
                                </li>
                                <li>
                                    <a href="layouts-compact.html" target="_blank">Compact</a>
                                </li>
                                <li>
                                    <a href="layouts-icon-view.html" target="_blank">Icon View</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- MENU FINACEIRO --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#financeiro" aria-expanded="false"
                            aria-controls="financeiro" class="side-nav-link">
                            <i class="uil-money-stack"></i>
                            <span> Financeiro </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="financeiro">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="layouts-horizontal.html" target="_blank">Horizontal</a>
                                </li>
                                <li>
                                    <a href="layouts-detached.html" target="_blank">Detached</a>
                                </li>
                                <li>
                                    <a href="layouts-full.html" target="_blank">Full View</a>
                                </li>
                                <li>
                                    <a href="layouts-fullscreen.html" target="_blank">Fullscreen View</a>
                                </li>
                                <li>
                                    <a href="layouts-hover.html" target="_blank">Hover Menu</a>
                                </li>
                                <li>
                                    <a href="layouts-compact.html" target="_blank">Compact</a>
                                </li>
                                <li>
                                    <a href="layouts-icon-view.html" target="_blank">Icon View</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- MENU ADMINSTRATIVO --}}
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#adminstrativo" aria-expanded="false"
                            aria-controls="adminstrativo" class="side-nav-link">
                            <i class="uil-lightbulb-alt"></i>
                            <span> Adminstrativo </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="adminstrativo">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="/users">Usuários</a>
                                </li>
                                <li>
                                    <a href="layouts-detached.html" target="_blank">Detached</a>
                                </li>
                                <li>
                                    <a href="layouts-full.html" target="_blank">Full View</a>
                                </li>
                                <li>
                                    <a href="layouts-fullscreen.html" target="_blank">Fullscreen View</a>
                                </li>
                                <li>
                                    <a href="layouts-hover.html" target="_blank">Hover Menu</a>
                                </li>
                                <li>
                                    <a href="layouts-compact.html" target="_blank">Compact</a>
                                </li>
                                <li>
                                    <a href="layouts-icon-view.html" target="_blank">Icon View</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#extras" aria-expanded="false" aria-controls="extras"
                            class="side-nav-link">
                            <i class="uil-star"></i>
                            <span> Extras </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="extras">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="layouts-horizontal.html" target="_blank">Horizontal</a>
                                </li>
                                <li>
                                    <a href="layouts-detached.html" target="_blank">Detached</a>
                                </li>
                                <li>
                                    <a href="layouts-full.html" target="_blank">Full View</a>
                                </li>
                                <li>
                                    <a href="layouts-fullscreen.html" target="_blank">Fullscreen View</a>
                                </li>
                                <li>
                                    <a href="layouts-hover.html" target="_blank">Hover Menu</a>
                                </li>
                                <li>
                                    <a href="layouts-compact.html" target="_blank">Compact</a>
                                </li>
                                <li>
                                    <a href="layouts-icon-view.html" target="_blank">Icon View</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-title">Relatórios</li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarMultiLevel" aria-expanded="false"
                            aria-controls="sidebarMultiLevel" class="side-nav-link">
                            <i class="uil-folder-plus"></i>
                            <span> Multi Level </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarMultiLevel">
                            <ul class="side-nav-second-level">
                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" href="#sidebarSecondLevel" aria-expanded="false"
                                        aria-controls="sidebarSecondLevel">
                                        <span> Second Level </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarSecondLevel">
                                        <ul class="side-nav-third-level">
                                            <li>
                                                <a href="javascript: void(0);">Item 1</a>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);">Item 2</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" href="#sidebarThirdLevel" aria-expanded="false"
                                        aria-controls="sidebarThirdLevel">
                                        <span> Third Level </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarThirdLevel">
                                        <ul class="side-nav-third-level">
                                            <li>
                                                <a href="javascript: void(0);">Item 1</a>
                                            </li>
                                            <li class="side-nav-item">
                                                <a data-bs-toggle="collapse" href="#sidebarFourthLevel"
                                                    aria-expanded="false" aria-controls="sidebarFourthLevel">
                                                    <span> Item 2 </span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <div class="collapse" id="sidebarFourthLevel">
                                                    <ul class="side-nav-forth-level">
                                                        <li>
                                                            <a href="javascript: void(0);">Item 2.1</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript: void(0);">Item 2.2</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
                <!--- End Sidemenu -->

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    @if ($errors->any())
                        <div class="text text-danger p-4">
                            <h4 class="text text-danger p-3">Não foi possível completar a operação. Consulte os erros abaixo:</h4>
                            <ul class="list-group list-group-flush">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item text text-danger fs-4">* {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                    <!-- end page title -->

                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Hyper - Coderthemes.com
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-md-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
        <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
            <h5 class="text-white m-0">Theme Settings</h5>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0">
            <div data-simplebar class="h-100">
                <div class="card mb-0 p-3">

                    <h5 class="my-3 font-16 fw-bold">Color Scheme</h5>

                    <div class="colorscheme-cardradio">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-bs-theme"
                                        id="layout-color-light" value="light">
                                    <label class="form-check-label p-0 avatar-md w-100" for="layout-color-light">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span
                                                        class="bg-light d-flex h-100 border-end flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column bg-white rounded-2">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color" class="bg-white rounded-2 h-100">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                </span>
                                                <span class="d-flex h-100 flex-column bg-white rounded-2">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-bs-theme"
                                        id="layout-color-dark" value="dark">
                                    <label class="form-check-label p-0 avatar-md w-100 bg-black"
                                        for="layout-color-dark">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary border-opacity-25 border-3 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary border-opacity-25 border-3 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary border-opacity-25 border-3 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary border-opacity-25 border-3 rounded w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light-lighten d-flex p-1 align-items-center border-bottom border-opacity-25 border-primary border-opacity-25">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-primary border-opacity-25 border-3 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                                </span>
                                                <span class="bg-light-lighten d-block p-1"></span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                            </div>
                        </div>
                    </div>

                    <div id="layout-width">
                        <h5 class="my-3 font-16 fw-bold">Layout Mode</h5>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-layout-mode"
                                        id="layout-mode-fluid" value="fluid">
                                    <label class="form-check-label p-0 avatar-md w-100" for="layout-mode-fluid">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span
                                                        class="bg-light d-flex h-100 border-end flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column rounded-2">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                </span>
                                                <span class="bg-light d-block p-1"></span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Fluid</h5>
                            </div>
                            <div class="col-4" id="layout-boxed">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-layout-mode"
                                        id="layout-mode-boxed" value="boxed">
                                    <label class="form-check-label p-0 avatar-md w-100 px-2" for="layout-mode-boxed">
                                        <div id="sidebar-size" class="border-start border-end">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span
                                                        class="bg-light d-flex h-100 border-end flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column rounded-2">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color" class="border-start border-end h-100">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                </span>
                                                <span class="bg-light d-block p-1"></span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Boxed</h5>
                            </div>

                            <div class="col-4" id="layout-detached">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-layout-mode"
                                        id="data-layout-detached" value="detached">
                                    <label class="form-check-label p-0 avatar-md w-100" for="data-layout-detached">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-flex p-1 align-items-center border-bottom ">
                                                <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                            </span>
                                            <span class="d-flex h-100 p-1 px-2">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 flex-column p-1 px-2">
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class="bg-light d-block p-1 mt-auto px-2"></span>
                                        </span>

                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Detached</h5>
                            </div>
                        </div>
                    </div>

                    <h5 class="my-3 font-16 fw-bold">Topbar Color</h5>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar-color"
                                    id="topbar-color-light" value="light">
                                <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-light">
                                    <div id="sidebar-size">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </div>

                                    <div id="topnav-color">
                                        <span class="d-flex h-100 flex-column">
                                            <span
                                                class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                            </span>
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </div>
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                        </div>

                        <div class="col-4" style="--ct-dark-rgb: 64,73,84;">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar-color"
                                    id="topbar-color-dark" value="dark">
                                <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-dark">
                                    <div id="sidebar-size">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                    <span class="d-block p-1 bg-primary-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-dark d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </div>

                                    <div id="topnav-color">
                                        <span class="d-flex h-100 flex-column">
                                            <span
                                                class="bg-dark d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                <span class="d-block p-1 bg-primary-lighten rounded me-1"></span>
                                                <span
                                                    class="d-block border border-primary border-opacity-25 border-3 rounded ms-auto"></span>
                                                <span
                                                    class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                            </span>
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </div>
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar-color"
                                    id="topbar-color-brand" value="brand">
                                <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-brand">
                                    <div id="sidebar-size">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-primary bg-gradient d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </div>

                                    <div id="topnav-color">
                                        <span class="d-flex h-100 flex-column">
                                            <span
                                                class="bg-primary bg-gradient d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                <span class="d-block p-1 bg-light opacity-25 rounded me-1"></span>
                                                <span
                                                    class="d-block border border-3 border opacity-25 rounded ms-auto"></span>
                                                <span
                                                    class="d-block border border-3 border opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border opacity-25 rounded ms-1"></span>
                                            </span>
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </div>
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Brand</h5>
                        </div>
                    </div>

                    <div>
                        <h5 class="my-3 font-16 fw-bold">Menu Color</h5>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-menu-color"
                                        id="leftbar-color-light" value="light">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-color-light">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span
                                                        class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                </span>
                                                <span class="bg-light d-block p-1"></span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                            </div>

                            <div class="col-4" style="--ct-dark-rgb: 64,73,84;">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-menu-color"
                                        id="leftbar-color-dark" value="dark">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-color-dark">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-dark d-flex h-100 flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary rounded border-opacity-25 border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary rounded border-opacity-25 border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary rounded border-opacity-25 border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary rounded border-opacity-25 border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-primary border-opacity-25">
                                                    <span class="d-block p-1 bg-primary-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-secondary rounded border-opacity-25 border-3 ms-auto"></span>
                                                    <span
                                                        class="d-block border border-secondary rounded border-opacity-25 border-3 ms-1"></span>
                                                    <span
                                                        class="d-block border border-secondary rounded border-opacity-25 border-3 ms-1"></span>
                                                    <span
                                                        class="d-block border border-secondary rounded border-opacity-25 border-3 ms-1"></span>
                                                </span>
                                                <span class="bg-dark d-block p-1"></span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                            </div>
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-menu-color"
                                        id="leftbar-color-brand" value="brand">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-color-brand">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span
                                                        class="bg-primary bg-gradient d-flex h-100 flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-light-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border opacity-25 rounded border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border opacity-25 rounded border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border opacity-25 rounded border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border opacity-25 rounded border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                </span>
                                                <span class="bg-primary bg-gradient d-block p-1"></span>
                                            </span>
                                        </div>

                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Brand</h5>
                            </div>
                        </div>
                    </div>

                    <div id="sidebar-size">
                        <h5 class="my-3 font-16 fw-bold">Sidebar Size</h5>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-default" value="default">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-default">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Default</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-compact" value="compact">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-compact">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Compact</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-small" value="condensed">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-small">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end flex-column"
                                                    style="padding: 2px;">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Condensed</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-small-hover" value="sm-hover">
                                    <label class="form-check-label p-0 avatar-md w-100"
                                        for="leftbar-size-small-hover">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end flex-column"
                                                    style="padding: 2px;">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Hover View</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-full" value="full">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-full">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="d-block p-1 bg-dark-lighten mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Full Layout</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-fullscreen" value="fullscreen">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-fullscreen">
                                        <span class="d-flex h-100">
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Fullscreen Layout</h5>
                            </div>
                        </div>
                    </div>

                    <div id="layout-position">
                        <h5 class="my-3 font-16 fw-bold">Layout Position</h5>

                        <div class="btn-group radio" role="group">
                            <input type="radio" class="btn-check" name="data-layout-position"
                                id="layout-position-fixed" value="fixed">
                            <label class="btn btn-soft-primary w-sm" for="layout-position-fixed">Fixed</label>

                            <input type="radio" class="btn-check" name="data-layout-position"
                                id="layout-position-scrollable" value="scrollable">
                            <label class="btn btn-soft-primary w-sm ms-0"
                                for="layout-position-scrollable">Scrollable</label>
                        </div>
                    </div>

                    <div id="sidebar-user">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <label class="font-16 fw-bold m-0" for="sidebaruser-check">Sidebar User Info</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="sidebar-user"
                                    id="sidebaruser-check">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="offcanvas-footer border-top p-3 text-center">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
                </div>
                <div class="col-6">
                    <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/"
                        target="_blank" role="button" class="btn btn-primary w-100">Buy Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="/assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="/assets/js/app.min.js"></script>

</body>

</html>
