<!DOCTYPE html>
<html lang="en"><!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>LLDIKTI Wilayah VII</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    @vite(['resources/css/adminlte.css', 'resources/js/adminlte.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"><!--begin::App Wrapper-->
    <div class="app-wrapper"><!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"><!--begin::Container-->
            <div class="container-fluid"><!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a href="/dashboard" class="nav-link">Home</a></li>
                </ul><!--end::Start Navbar Links--><!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"><!--begin::Navbar Search-->
                    <li class="nav-item dropdown user-menu"><a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="user-image rounded-circle shadow" alt="User Image"><span class="d-none d-md-inline"><?php echo Auth::user()->name ?></span></a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"><!--begin::User Image-->
                            <li class="user-header text-bg-primary"><img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    <?php echo Auth::user()->name ?>
                                    <small>Member since Nov. 2023</small>
                                </p>
                            <li class="user-footer"><a href="#" class="btn btn-default btn-flat">Profile</a><a href="/logout" class="btn btn-default btn-flat float-end">Sign out</a></li><!--end::Menu Footer-->
                        </ul>
                    </li><!--end::User Menu Dropdown-->
                </ul><!--end::End Navbar Links-->
            </div><!--end::Container-->
        </nav><!--end::Header--><!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"><!--begin::Sidebar Brand-->
            <div class="sidebar-brand"><!--begin::Brand Link--><a href="/test" class="brand-link"><!--begin::Brand Image--><img src="https://www.kemdikbud.go.id/main/addons/shared_addons/themes/november_theme/img/kemdikbud_64x64.png" alt="LLDIKTI Wilayah VII" class="brand-image opacity-75 shadow"><!--end::Brand Image--><!--begin::Brand Text--><span class="brand-text fw-light">LLDIKTI Wilayah VII</span><!--end::Brand Text--></a><!--end::Brand Link--></div><!--end::Sidebar Brand--><!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"><!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-open"><a href="/test" class="nav-link active"><i class="nav-icon bi bi-speedometer"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon bi bi-box-seam-fill"></i>
                                <p>
                                    Badan Penyelenggara
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="/listbp" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>Daftar Badan Penyelenggara</p>
                                    </a></li>
                                <li class="nav-item"><a href="./widgets/info-box.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>-nama-</p>
                                    </a></li>
                                <li class="nav-item"><a href="./widgets/cards.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>-nama-</p>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon bi bi-clipboard-fill"></i>
                                <p>
                                    Perguruan Tinggi
                                    </span><i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="./layout/unfixed-sidebar.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>Perguruan Tinggi Aktif</p>
                                    </a></li>
                                <li class="nav-item"><a href="./layout/unfixed-sidebar.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>Daftar Pemimpin</p>
                                    </a></li>
                                <li class="nav-item"><a href="./layout/fixed-sidebar.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>Perguruan Tinggi Bermasalah</p>
                                    </a></li>
                                <li class="nav-item"><a href="./layout/fixed-complete.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>Perguruan Tinggi Tutup</p>
                                    </a></li>
                                <li class="nav-item"><a href="./layout/sidebar-mini.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>Rekap Data</p>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon bi bi-tree-fill"></i>
                                <p>
                                    Pengaturan
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                    <li class="nav-item"><a href="./UI/general.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>Periode Penerimaan</p>
                                    </a></li>
                                    <li class="nav-item"><a href="./UI/timeline.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>List Dokumen</p>
                                    </a></li>
                                    <li class="nav-item"><a href="./UI/timeline.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>Program Beasiswa</p>
                                    </a></li>
                                    <li class="nav-item"><a href="./UI/timeline.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>Daftar User</p>
                                    </a></li>
                                    <li class="nav-item"><a href="./UI/timeline.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
                                        <p>Tentang Sistem</p>
                                    </a></li>
                            </ul>
                        </li>
                    </ul><!--end::Sidebar Menu-->
                </nav>
            </div><!--end::Sidebar Wrapper-->
        </aside><!--end::Sidebar--><!--begin::App Main-->
        <main class="app-main"><!--begin::App Content Header-->
            <h1>ADD SOMETHING HERE</h1>
        </main><!--end::App Main--><!--begin::Footer-->
        <footer class="app-footer"><!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">TEXT HERE</div><!--end::To the end--><!--begin::Copyright--><strong>
                Copyright &copy; 2023&nbsp;
                <a href="/dashboard" class="text-decoration-none">LLDIKTI Wilayah VII</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer><!--end::Footer-->
    </div><!--end::App Wrapper--><!--begin::Script--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script><!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script><!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
</body><!--end::Body-->

</html>