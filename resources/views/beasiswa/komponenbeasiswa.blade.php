<!DOCTYPE html>
<html lang="en"><!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Komponen Beasiswa | LLDIKTI Wilayah VII</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
        integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    @vite(['resources/css/adminlte.css', 'resources/js/adminlte.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous">
     <!-- DataTables -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables-responsive@2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables-buttons@2.0.2/css/buttons.bootstrap4.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.css">

</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"><!--begin::App Wrapper-->
    <div class="app-wrapper"><!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"><!--begin::Container-->
            <div class="container-fluid"><!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i
                                class="bi bi-list"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a href="/home" class="nav-link">home</a></li>
                </ul><!--end::Start Navbar Links--><!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"><!--begin::Navbar Search-->
                    <li class="nav-item dropdown user-menu"><a href="#" class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"><img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                class="user-image rounded-circle shadow" alt="User Image"><span
                                class="d-none d-md-inline"><?php echo Auth::user()->name; ?></span></a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"><!--begin::User Image-->
                            <li class="user-header text-bg-primary"><img
                                    src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                    class="rounded-circle shadow" alt="User Image">
                                <p>
                                    <?php echo Auth::user()->name; ?>
                                    <small>Member since Nov. 2023</small>
                                </p>
                            <li class="user-footer"><a href="#" class="btn btn-default btn-flat">Profile</a><a
                                    href="/logout" class="btn btn-default btn-flat float-end">Sign out</a></li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li><!--end::User Menu Dropdown-->
                </ul><!--end::End Navbar Links-->
            </div><!--end::Container-->
        </nav><!--end::Header--><!--begin::Sidebar-->
        @if (Auth::user()->role !== 'admin') 
            @include('asideuser')
        @else
            @include('aside')
        @endif
        <main class="app-main"><!--begin::App Content Header-->
            <div class="app-content"><!--begin::Container-->
                <div class="container-fluid"><!--begin::Row-->
                <br>
                    <div class="card card-info card-outline mb-4"><!--begin::Header-->
                        <div class="card-header">
                            <h5 class="mb-0">Komponen Beasiswa</h5>
                        </div>
                        <div class="card-header">
                            <h3 class="mb-0" style="color: green;">{{ $dataB->jenis_beasiswa }}</h3>
                        </div>
                        <form action="{{ route('storekomponenbeasiswa') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_beasiswa" value="{{ $dataB->id_beasiswa }}">
                            <input type="hidden" name="status" value="{{ $data->status ?? 1 }}">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="nm_komponen" class="form-label">Keterangan Beasiswa</label>
                                        <textarea name="nm_komponen" class="form-control" id="nm_komponen" required></textarea>
                                        <div class="invalid-feedback">
                                            Harap masukkan Keterangan
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="jenis_beasiswa" class="form-label">Kuota Awal</label>
                                        <input type="text" name="pagu_awal" class="form-control" id="pagu_awal" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Beasiswa
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-info" type="submit">Simpan</button>
                                <a class="btn btn-secondary" href="/programbeasiswa">Kembali</a>
                            </div>
                        </form>
                        <hr>
                        <div class="card-body">
                            <div class="card mb-6">
                                <table id="table1" class="table table-bordered table-striped">
                                <div class="card-header">
                                    <h5 class="text-center" style=>Data Komponen Beasiswa</h5>
                                </div>
                                    <thead>
                                        <tr class="align-middle">
                                            <th class="text-center" style="width: 5%">No</th>
                                            <th class="text-center" style="width: 35%">Nama Komponen</th>
                                            <th class="text-center" style="width: 25%">Pagu Awal</th>
                                            <th class="text-center" style="width: 15%">Status</th>
                                            <th class="text-center" style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($dataTable)
                                        @foreach ($dataTable as $index => $list) 
                                        <tr class="align-middle">
                                            <td class="text-center">{{ $index+1 }}</td>
                                            <td class="text-left">{{ $list->nm_komponen }}</td>
                                            <td class="text-left">{{ $list->pagu_awal }}</td>
                                            <td class="text-center">
                                                @if ($list->status == 1)
                                                    <span class="badge text-bg-success">Aktif</span>
                                                @elseif ($list->status == 0)
                                                    <span class="badge text-bg-danger"> Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group mb-2" role="group" aria-label="Button group with nested dropdown">
                                                    <div class="btn-group" role="group"><button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Pilih
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item modal-trigger" href="{{ route('komponenbeasiswaedit', $list->id)}}">Edit</a></li>
                                                            <li><a class="dropdown-item delete-confirm" href="{{ route('komponenbeasiswadelete', $list->id)}}" id="delete">Hapus</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach 
                                    @else
                                        <!-- Handle jika $aktaData kosong -->
                                    @endif
                                    </tbody>
                                </table>
                            </div><!-- /.card-body -->
                        </div>
                        </div>
                    </div><!--end::Form Validation-->
                    
                </div>
            </div>
        </main><!--end::App Main--><!--begin::Footer-->
        @include('footer')

        
        <div id="modal"></div>

    </div><!--end::App Wrapper--><!--begin::Script--><!--begin::Third Party Plugin(OverlayScrollbars)-->

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script><!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>

        <!-- Toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.js"></script>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Menggunakan Bootstrap dari CDN -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-V4HRGC27m1G21IWXJwy6p1V9KLb8FSVZj5EoFDDZn0I2zjzK1lqag5RD5I2fF5+K" crossorigin="anonymous"></script>

        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

        <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>


        <script>
            $(function() {
            // Code to handle toastr based on session message
            @if(Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch(type) {
                    case 'success':
                        toastr.success("{{ Session::get('message') }}");
                        break;
                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                    default:
                        toastr.info("{{ Session::get('message') }}");
                }
            @endif

            // Fungsi untuk menampilkan SweetAlert dan konfirmasi penghapusan
            $('.delete-confirm').click(function(e) {
                e.preventDefault();
                let url = $(this).attr('href');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda tidak dapat mengembalikan data yang sudah dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
        </script>
        
        <script>
            $(document).ready(function () {
                $("#table1").DataTable({
                    "pageLength": 10,
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'semua']],
                    "lengthChange": true,
                    "searching": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                });
            });
        </script>

<script>
        function loadModalContent(url) {
            $('#modal').load(url, function() {
                $('#modal-default').modal('show');
                $('#close, .btn-danger').click(function() {
                $("#modal-default").hide();
            });
            });
        }

        $(document).ready(function() {
            console.log("Listener terpasang!");
            $('.modal-trigger').click(function(e) {
                e.preventDefault();
                console.log("Tombol ditekan!");
                let url = $(this).attr('href');
                loadModalContent(url);
            });
        });
    </script>
</body>
</html>