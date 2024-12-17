<!DOCTYPE html>
<html lang="en"><!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Profile User| LLDIKTI Wilayah</title><!--begin::Primary Meta Tags-->
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
     <!-- DataTables -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables-responsive@2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables-buttons@2.0.2/css/buttons.bootstrap4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.css">
    <!-- passowrd -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-..." crossorigin="anonymous">




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
                @include('usermenu')
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
                                <h5 class="mb-0">Profile User</h5>
                            </div>
                            <form action="{{ route('uploadImage', ['id_userx' => $data->id_userx]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label for="nama_pt" class="control-label" style="font-weight: bold;">Nama PT</label>
                                            <input type="text"  class="form-control form-control-sm" name="nama_pt" id="v" value="{{ $data->nama_pt }}">
                                        </div>     
                                        <div class="col-md-12">
                                            <label for="username" class="control-label" style="font-weight: bold;">Username</label>
                                            <input type="text" class="form-control form-control-sm" name="username" id="username"  value="{{ $data->username }}" disabled>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="password" class="form-label" style="font-weight: bold;">Password Baru</label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control" id="password" >
                                                <button type="button" id="togglePassword" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
                                            </div>
                                            <div class="invalid-feedback">
                                                Harap masukkan Password.
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="image" class="control-label" style="font-weight: bold;">Logo [<span style="color: red; font-weight: bold;">Hapus Terlebih Dahulu Jika Sudah Ada Logo</span>] 
                                                <a href="{{ route('deleteimage') }}" class="btn btn-danger">Hapus</a></label>
                                            <div class="custom-file">
                                                <input type="file" class="rounded-circle" name="image" id="image" accept="image/png, image/jpeg" onchange="displayImg(this)">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-group d-flex justify-content-center">
                                                <img src="{{ route('profile', Auth::user()->id_userx) }}?t=<?php echo time(); ?>" alt="" id="cimg" class="img-fluid img-thumbnail" style="max-width: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button class="btn btn-info" type="submit" value="Upload">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
    @include('footer')
    <div id="modal"></div>

    </div><!--end::App Wrapper--><!--begin::Script--><!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script><!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.js"></script>

    <!-- gatau penting -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- Menggunakan Bootstrap dari CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-V4HRGC27m1G21IWXJwy6p1V9KLb8FSVZj5EoFDDZn0I2zjzK1lqag5RD5I2fF5+K" crossorigin="anonymous"></script>

    <!-- datatable -->
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

    <!-- Datatables -->
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
                if ("<?php echo Auth::user()->role; ?>" !== 'admin') {
                // Menggunakan jQuery untuk menyembunyikan tombol CRUD
                $('.btn-primary.dropdown-toggle').hide();
                $('th.text-center:contains("Aksi")').hide();
                $('td.text-center:contains("Pilih")').hide(); // Jika ingin menyembunyikan seluruh kolom "Aksi"
            }
            });
    </script>
    
    <!-- Message Alert -->
    


    <!-- Sweet Alert -->
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

    <style>
        img#cimg{
            height: 15vh;
            width: 15vh;
            object-fit: cover;
            border-radius: 100% 100%;
        }
        img#cimg2{
            height: 50vh;
            width: 100%;
            object-fit: contain;
            /* border-radius: 100% 100%; */
        }
    </style>
    <script>
        function updateLink() {
            var pengembangValue = document.getElementById('pengembang').value;
            var linkPlaceholder = document.getElementById('linkPlaceholder');
            linkPlaceholder.innerHTML = '<a href="/dashboard" class="text-decoration-none">' + pengembangValue + '</a>.';
        }
    </script>
    <script>
    function displayImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('cimg').src = e.target.result;
                input.nextElementSibling.innerHTML = input.files[0].name;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

    <script>
        // Menunggu dokumen HTML selesai dimuat
        $(document).ready(function(){
            // Tampilkan nilai awal pengembang saat dokumen dimuat
            $('#nama_pengembang').text($('#pengembang').val());
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

<script src="../assets/js/jquery.min.js"></script>

</body>
</html>
