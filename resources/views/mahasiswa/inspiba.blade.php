<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>ISNPIBA | LLDIKTI Wilayah</title><!--begin::Primary Meta Tags-->
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

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <!-- Header -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a href="/home" class="nav-link">home</a></li>
                </ul>
                @include('usermenu')
            </div>
        </nav>

        <!-- Sidebar -->
        @if (Auth::user()->role !== 'admin') 
            @include('asideuser')
        @else
            @include('aside')
        @endif

        <!-- Main Content -->
        <main class="app-main">
            <div class="app-content">
                <div class="container-fluid">
                <br>
                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Pemesanan Tiket INSPIBA</h5>
                        </div>
                        <div class="card-body">
                            <!-- Form Pemesanan Tiket -->
                            <form id="pesanTiketForm" method="POST" action="{{ route('inspiba') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="transportasiId">Transportasi:</label>
                                    <select id="transportasiId" name="transportasiId" class="form-control" required>
                                        <option selected disabled>Pilih</option>
                                        <option value="1">BRAWIJAYA - KERETA API</option>
                                        <option value="2">GARUDA INDONESIA - PESAWAT</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="mahasiswaId">Mahasiswa:</label>
                                    <select id="mahasiswaId" name="jumlahOrang[]" class="form-control" multiple required>
                                        @foreach($mahasiswa as $mhs)
                                            <option value="{{ $mhs->id_userx }}">{{ $mhs->nama_pt }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Pesan Tiket</button>
                            </form>

                            @if(session('error'))
                                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                            @endif

                           <!-- Modal -->
                        <div class="modal fade" id="tiketModal" tabindex="-1" aria-labelledby="tiketModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tiketModalLabel">Detail Pemesanan Tiket</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                    <thead>
                                        <tr>
                                        <th>Transportasi</th>
                                        <th>Penumpang</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th>Diskon</th>
                                        <th>Harga Diskon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td id="modalTransportasi"></td>
                                        <td id="modalJumlahOrang"></td>
                                        <td id="modalHargaPerOrang"></td>
                                        <td id="modalTotalHarga"></td>
                                        <td id="modalDiskon"></td>
                                        <td id="modalHargaSetelahDiskon"></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                                </div>
                            </div>
                        </div>

                            <a class="btn btn-secondary mt-3" href="{{ route('listmahasiswa') }}">Kembali</a>
                        </div><!-- /.card-body -->
                    </div>          
                </div>
            </div>
        </main>

        <!-- Footer -->
        @include('footer')

    </div>

    <!-- Scripts -->
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Inisialisasi select2 untuk mahasiswa
            $('#mahasiswaId').select2({
                placeholder: "--Pilih Mahasiswa--",
                allowClear: true
            });
        })
    </script>
    
    @if(isset($routeData))
        <script>
            // Isi data di modal saat halaman dimuat
            document.addEventListener('DOMContentLoaded', function () {
                $('#modalTransportasi').text("{{ $routeData->transportasi_name }}");
                $('#modalJumlahOrang').text("{{ $jumlahOrang }}");
                $('#modalHargaPerOrang').text("{{ number_format($hargaPerOrang, 0, ',', '.') }}");
                $('#modalTotalHarga').text("{{ number_format($totalHarga, 0, ',', '.') }}");
                $('#modalDiskon').text("{{ number_format($diskon, 0, ',', '.') }}({{ $disc }}%)");
                $('#modalHargaSetelahDiskon').text("{{ number_format($hargaSetelahDiskon, 0, ',', '.') }}");

                // Menampilkan modal
                $('#tiketModal').modal('show');
            });
        </script>
    @endif

</body>
</html>
