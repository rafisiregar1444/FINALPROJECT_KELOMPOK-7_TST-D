<!DOCTYPE html>
<html lang="en"><!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Akta KUMHAM | LLDIKTI Wilayah</title><!--begin::Primary Meta Tags-->
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
                            <h5 class="mb-0">Buat Data KUMHAM <span class="badge bg-success">No Akta: {{ $aktaData->no_akta }}</span></h5>
                        </div>
                        <div class="card-header">
                            <h3 class="mb-0" style="color: green;">{{ $yayasanData->nama_yys_pt }}</h3>
                        </div>
                        <form action="{{ route('updateakta', $aktaData->id_akta_yys) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nomor_akta" class="form-label">No Akta</label>
                                        <input type="text" name="nomor_akta" class="form-control" id="nomor_akta" value="{{ $aktaData->no_akta }}" readonly>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nomor Akta.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_akta" class="form-label">Tanggal Akta</label>
                                        <input type="date" name="tanggal_akta" class="form-control" id="tanggal_akta" value="{{ $aktaData->tgl_akta }}" readonly>
                                        <div class="invalid-feedback">
                                            Harap masukkan Tanggal Akta.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_notaris" class="form-label">Nama Notaris</label>
                                        <input type="text" name="nama_notaris" class="form-control" id="nama_notaris" value="{{ $aktaData->nm_notaris }}" readonly>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Notaris.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kota_notaris" class="form-label">Kota Notaris</label>
                                        <input type="text" name="kota_notaris" class="form-control" id="kota_notaris" value="{{ $aktaData->kota_notaris }}" readonly>
                                        <div class="invalid-feedback">
                                            Harap masukkan Kota Notaris.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kode_akta" class="form-label">Jenis Akta</label>
                                        <select class="form-select" name="kode_akta" id="kode_akta" disabled>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1"{{ $aktaData->jns_akta == 1 ? 'selected' : '' }}>Pendirian Baru</option>
                                            <option value="2"{{ $aktaData->jns_akta == 2 ? 'selected' : '' }}>Perubahan</option>
                                            <option value="3"{{ $aktaData->jns_akta == 3 ? 'selected' : '' }}>Pembubaran</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Jenis Akta.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status_akta" class="form-label">Status Akta</label>
                                        <select class="form-select" name="status_akta" id="status_akta" disabled>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1"{{ $aktaData->status_akta == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="2"{{ $aktaData->status_akta == 2 ? 'selected' : '' }}>Tidak Aktif</option>
                                            <option value="3"{{ $aktaData->status_akta == 3 ? 'selected' : '' }}>Bermasalah</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Status Akta.
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <a class="btn btn-secondary" href="{{ route('aktabp', ['id_yys_pt' => $yayasanData->id_yys_pt]) }}">Kembali</a>
                            </div>
                        </form>
                    <br>
                    
                    <div class="card card-info card-outline mb-4"><!--begin::Header-->
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Data Pengurus</h5>
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-primary mr-2" onClick="add()" href="/listdatapengurus">Daftar Data Pengurus</a>
                                    <a class="btn btn-success ml-auto modal-trigger" href="{{ route('aktakumhamnew', ['id_akta_yys' => $aktaData->id_akta_yys]) }}">Rekam Baru</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card mb-6">
                                <table id="table1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr class="align-middle">
                                                    <th class="text-center" style="width: 5%">No</th>
                                                    <th class="text-center" style="width: 15%">Nama Pengurus</th>
                                                    <th class="text-center" style="width: 15%">Jabatan</th>
                                                    <th class="text-center" style="width: 15%">Keterangan</th>
                                                    <th class="text-center" style="width: 15%">Tanggal Pengajuan</th>
                                                    <th class="text-center" style="width: 15%">Status Pengurus</th>
                                                    <th class="text-center" style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if($pengurusData)
                                                @foreach ($pengurusData as $index => $list)
                                                <tr class="align-middle">
                                                    <td class="text-center">{{ $index+1 }}</td>
                                                    <td class="text-left">{{ $list->namap }}</td>
                                                    <td class="text-left">{{ $list->jabatanp }}</td>
                                                    <td class="text-left">{{ $list->keterangan }}</td>
                                                    <td class="text-left">{{ $list->tgl_update }}</td>
                                                    <td class="text-center">
                                                        @if($list->statusp == 1)
                                                            <span class="badge text-bg-success">Aktif</span>
                                                        @elseif($list->statusp == 2)
                                                            <span class="badge text-bg-secondary">Tidak Aktif</span>
                                                        @elseif($list->statusp == 3)
                                                            <span class="badge text-bg-danger">Bermasalah</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group mb-2" role="group" aria-label="Button group with nested dropdown">
                                                            <div class="btn-group" role="group">
                                                                <form action="{{ route('ajukankumham', ['id_pengurus' => $list->id_pengurus]) }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id_yys_pt" value="{{ $yayasanData->id_yys_pt }}">
                                                                    <input type="hidden" name="id_pengurus" value="{{ $list->id_pengurus }}">
                                                                    <button type="submit" class="btn btn-success ajukan" id="ajukan"
                                                                        data-idpengurus="{{ $list->id_pengurus }}" 
                                                                        data-idyyspt="{{ $yayasanData->id_yys_pt }}">
                                                                            Ajukan</button>
                                                                </form>
                                                                <a class="btn btn-warning modal-trigger" href="{{ route('aktakumhamedit', $list->id_pengurus)}}">Edit</a>
                                                                <a class="btn btn-danger delete-confirm" href="{{ route('aktakumhamdelete', $list->id_pengurus)}}" id="delete">Hapus</a>
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
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card card-info card-outline mb-4"><!--begin::Header-->
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0" >Data KUMHAM</h5>
                                <a class="btn btn-success" onClick="add()" href="{{ route('aktakumhamnew', ['id_akta_yys' => $aktaData->id_akta_yys]) }}" data-toggle="modal" data-target="#ModalCreate">Rekam Baru</a>
                            </div>
                        </div>
                    </div>
                        
                </div><!--end::Form Validation-->
            </div>

        </main><!--end::App Main--><!--begin::Footer-->
        @include('footer')

    </div><!--end::App Wrapper--><!--begin::Script--><!--begin::Third Party Plugin(OverlayScrollbars)-->

    <div id="modal"></div>

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

            $('.ajukan').click(function(e) {
                e.preventDefault();

                let form = $(this).closest('form'); // Temukan formulir terdekat dari tombol "Ajukan"
                let url = form.attr('action'); // Dapatkan URL aksi formulir

                // Kumpulkan data yang diperlukan dari tombol "Ajukan"
                let idpengurus = $(this).data('idpengurus');
                let idyyspt = $(this).data('idyyspt');

                // Setel nilai input tersembunyi dalam formulir
                form.find('input[name="id_pengurus"]').val(idpengurus);
                form.find('input[name="id_yys_pt"]').val(idyyspt);

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda akan mengajukan nama pengurus sebagai pengurus {{ $yayasanData->nama_yys_pt }}',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, ajukan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit formulir secara manual setelah mengatur nilainya
                        form.submit();
                    }
                });
            });


        });
        </script>


    <script>
        function loadModalContent(url) {
            $('#modal').load(url, function() {
                $('#modal-default').modal('show');
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