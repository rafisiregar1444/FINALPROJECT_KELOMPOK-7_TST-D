<!DOCTYPE html>
<html lang="en"><!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Mahasiswa Baru | LLDIKTI Wilayah VII</title><!--begin::Primary Meta Tags-->
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-..."
    crossorigin="anonymous">

</head>
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
                            <h5 class="mb-0">Buat User Mahasiswa Baru</h5>
                        </div>
                        <form action="{{ route('storeuser') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_pass" value="1">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="kode_pt" class="form-label">Kode Perguruan Tinggi Mahasiswa</label>
                                            <select class="form-select" id="kode_pt" name="kode_pt"required>
                                                    <option selected disabled value="">--Pilih--</option>
                                                @foreach($allUser as $item)
                                                    <option value="{{ $item->kode_pt}}">
                                                        <b>{{ $item->kode_pt }}</b> ({{ $item->nama_pt }}) 
                                                    </option>
                                                @endforeach
                                            </select>
                                        <div class="invalid-feedback">
                                            Harap masukkan Kode PT.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_pt" class="form-label">Nama Mahasiswa</label>
                                        <input type="text" name="nama_pt" class="form-control" id="nama_pt" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama PT.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="username" class="form-label">Nomor Induk Mahasiswa</label>
                                        <input type="text" name="username" class="form-control" id="username" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Username.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="type" class="form-label">Jenis User</label>
                                        <select class="form-select" name="type" id="type" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="5"disabled>Pejabat Struktural</option>
                                            <option value="1"disabled>Admin LLDIKTI</option>
                                            <option value="3"disabled>Operator LLDIKTI</option>
                                            <option value="2"disabled>Admin Perguruan Tinggi</option>
                                            <option value="4">Mahasiswa</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Jenis .
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status_user" class="form-label">Status</label>
                                        <select class="form-select" name="status_user" id="status_user" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Status.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password Baru</label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control" id="password" required>
                                            <button type="button" id="togglePassword" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                        </div>
                                        <div class="invalid-feedback">
                                            Harap masukkan Password.
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-select" name="role" id="role" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="admin" disabled>Admin</option>
                                            <option value="user" disabled>User</option>
                                            <option value="mahasiswa">Mahasiswa</option>
                                        </select>                                       
                                        <div class="invalid-feedback">
                                            Harap masukkan Role.
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-info" type="submit">Simpan</button>
                                <a class="btn btn-secondary" href="/listuser">Batal</a>
                            </div>
                        </form>
                        
                    </div><!--end::Form Validation-->
                    
                </div>
            </div>
        </main><!--end::App Main--><!--begin::Footer-->
        @include('footer')

    </div><!--end::App Wrapper--><!--begin::Script--><!--begin::Third Party Plugin(OverlayScrollbars)-->

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <!--end::Required Plugi (popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
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
        // Function to toggle password visibility
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }

        // Event listener for toggling password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            togglePasswordVisibility('password');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
    
    </body>
</html>
