<!DOCTYPE html>
<html lang="en"><!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AdminLTE | Dashboard v2</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous"><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../../dist/css/adminlte.css"><!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
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
            <div class="sidebar-brand"><!--begin::Brand Link--><a href="/dashboard" class="brand-link"><!--begin::Brand Image--><img src="https://www.kemdikbud.go.id/main/addons/shared_addons/themes/november_theme/img/kemdikbud_64x64.png" alt="LLDIKTI Wilayah VII" class="brand-image opacity-75 shadow"><!--end::Brand Image--><!--begin::Brand Text--><span class="brand-text fw-light">LLDIKTI Wilayah VII</span><!--end::Brand Text--></a><!--end::Brand Link--></div><!--end::Sidebar Brand--><!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"><!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <li class="nav-item menu-open"><a href="/dashboard" class="nav-link active"><i class="nav-icon bi bi-speedometer"></i>
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
                                <li class="nav-item"><a href="./widgets/small-box.html" class="nav-link"><i class="nav-icon bi bi-circle"></i>
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
            <div class="app-content-header"><!--begin::Container-->
                <div class="container-fluid"><!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">List Penyelenggara</h3>
                        </div>
                    </div><!--end::Row-->
                </div><!--end::Container-->
            </div><!--end::App Content Header--><!--begin::App Content-->
            <div class="app-content"><!--begin::Container-->
                <div class="container-fluid"><!--begin::Row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="align-middle">
                                                <th class="text-center" style="width: 1px">#</th>
                                                <th class="text-center" style="width: 150px">Nama Badan Penyelenggara</th>
                                                <th class="text-center" style="width: 150px">Data Akta Notaris</th>
                                                <th class="text-center" style="width: 150px">Perguruan Tinggi</th>
                                                <th class="text-center" style="width: 40px">Status BP</th>
                                                <th class="text-center" style="width: 40px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="align-middle">
                                                <td class="text-center">1.</td>
                                                <td class="text-center">YAYASAN KESEJAHTERAAN WARGA KESEHATAN KABUPATEN MOJOKERTO</td>
                                                <td class="text-center">YAYASAN KESEJAHTERAAN WARGA KESEHATAN KABUPATEN MOJOKERTO</td>
                                                <td class="text-center">Politeknik Kesehatan Majapahit</td>
                                                <td class="text-center"><span class="badge text-bg-success">Aktif</span></td>
                                                <td class="text-center">Aksi</td>
                                            </tr>
                                            <tr class="align-middle">
                                                <td class="text-center">2.</td>
                                                <td class="text-center">YAYASAN PENDIDIKAN WONOKROMO SURABAYA</td>
                                                <td class="text-center">YAYASAN PENDIDIKAN WONOKROMO SURABAYA</td>
                                                <td class="text-center">IKIP Widya Darma</td>
                                                <td class="text-center"><span class="badge text-bg-danger">Tidak Aktif</span></td>
                                                <td class="text-center">Aksi</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!-- /.card-body -->
                                <br>
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-end">
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main><!--end::App Main--><!--begin::Footer-->
        <footer class="app-footer"><!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Anything you want</div><!--end::To the end--><!--begin::Copyright--><strong>
                Copyright &copy; 2014-2023&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer><!--end::Footer-->
    </div><!--end::App Wrapper--><!--begin::Script--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script><!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script><!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script><!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../../dist/js/adminlte.js"></script><!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script><!--end::OverlayScrollbars Configure--><!-- OPTIONAL SCRIPTS --><!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <script>
        // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
        // IT'S ALL JUST JUNK FOR DEMO
        // ++++++++++++++++++++++++++++++++++++++++++

        /* apexcharts
         * -------
         * Here we will create a few charts using apexcharts
         */

        //-----------------------
        // - MONTHLY SALES CHART -
        //-----------------------

        const sales_chart_options = {
            series: [{
                    name: "Digital Goods",
                    data: [28, 48, 40, 19, 86, 27, 90],
                },
                {
                    name: "Electronics",
                    data: [65, 59, 80, 81, 56, 55, 40],
                },
            ],
            chart: {
                height: 180,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ["#0d6efd", "#20c997"],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
            },
            xaxis: {
                type: "datetime",
                categories: [
                    "2023-01-01",
                    "2023-02-01",
                    "2023-03-01",
                    "2023-04-01",
                    "2023-05-01",
                    "2023-06-01",
                    "2023-07-01",
                ],
            },
            tooltip: {
                x: {
                    format: "MMMM yyyy",
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector("#sales-chart"),
            sales_chart_options,
        );
        sales_chart.render();

        //---------------------------
        // - END MONTHLY SALES CHART -
        //---------------------------

        function createSparklineChart(selector, data) {
            const options = {
                series: [{
                    data
                }],
                chart: {
                    type: "line",
                    width: 150,
                    height: 30,
                    sparkline: {
                        enabled: true,
                    },
                },
                colors: ["var(--bs-primary)"],
                stroke: {
                    width: 2,
                },
                tooltip: {
                    fixed: {
                        enabled: false,
                    },
                    x: {
                        show: false,
                    },
                    y: {
                        title: {
                            formatter: function(seriesName) {
                                return "";
                            },
                        },
                    },
                    marker: {
                        show: false,
                    },
                },
            };

            const chart = new ApexCharts(document.querySelector(selector), options);
            chart.render();
        }

        const table_sparkline_1_data = [
            25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54,
        ];
        const table_sparkline_2_data = [
            12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 44,
        ];
        const table_sparkline_3_data = [
            15, 46, 21, 59, 33, 15, 34, 42, 56, 19, 64,
        ];
        const table_sparkline_4_data = [
            30, 56, 31, 69, 43, 35, 24, 32, 46, 29, 64,
        ];
        const table_sparkline_5_data = [
            20, 76, 51, 79, 53, 35, 54, 22, 36, 49, 64,
        ];
        const table_sparkline_6_data = [
            5, 36, 11, 69, 23, 15, 14, 42, 26, 19, 44,
        ];
        const table_sparkline_7_data = [
            12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 74,
        ];

        createSparklineChart("#table-sparkline-1", table_sparkline_1_data);
        createSparklineChart("#table-sparkline-2", table_sparkline_2_data);
        createSparklineChart("#table-sparkline-3", table_sparkline_3_data);
        createSparklineChart("#table-sparkline-4", table_sparkline_4_data);
        createSparklineChart("#table-sparkline-5", table_sparkline_5_data);
        createSparklineChart("#table-sparkline-6", table_sparkline_6_data);
        createSparklineChart("#table-sparkline-7", table_sparkline_7_data);

        //-------------
        // - PIE CHART -
        //-------------

        const pie_chart_options = {
            series: [700, 500, 400, 600, 300, 100],
            chart: {
                type: "donut",
            },
            labels: ["Chrome", "Edge", "FireFox", "Safari", "Opera", "IE"],
            dataLabels: {
                enabled: false,
            },
            colors: [
                "#0d6efd",
                "#20c997",
                "#ffc107",
                "#d63384",
                "#6f42c1",
                "#adb5bd",
            ],
        };

        const pie_chart = new ApexCharts(
            document.querySelector("#pie-chart"),
            pie_chart_options,
        );
        pie_chart.render();

        //-----------------
        // - END PIE CHART -
        //-----------------
    </script><!--end::Script-->
</body><!--end::Body-->

</html>