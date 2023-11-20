<html lang="en">

{{-- <head>
    <meta charset="UTF-8">
    <title>Laravel 10 AJAX CRUD using DataTable js Tutorial From Scratch - Tutsmake.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head> --}}

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE | Dashboard v2</title><!--begin::Primary Meta Tags-->
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    @vite(['resources/css/adminlte.css', 'resources/js/adminlte.js'])
</head>


<body>
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>List Badan Penyelenggara</h2>
                        </div>
                        <div class="pull-right mb-2">
                            <a class="btn btn-primary" onClick="add()" href="javascript:void(0)"> Tambah Badan
                                Penyelenggara</a>
                        </div>
                    </div>
                </div>

                {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif --}}
            </div>
        </div>
        <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-12">
                        <table class="table table-bordered" id="crud-yys" >
                            <thead>
                                <tr class="align-middle">
                                    <th class="text-center" style="width: 5%">#</th>
                                    <th class="text-center" style="width: 25%">Nama Badan Penyelenggara</th>
                                    <th class="text-center" style="width: 25%">Data Akta Notaris</th>
                                    <th class="text-center" style="width: 25%">Perguruan Tinggi</th>
                                    <th class="text-center" style="width: 10%">Status BP</th>
                                    <th class="text-center" style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <!-- boostrap Yayasan model -->
    <div class="modal fade" id="Yayasan-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="YayasanModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="YayasanForm" name="YayasanForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id_yys_pt">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nama Yayasan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Yayasan Name" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Email Yayasan</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Yayasan Email" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Yayasan Address</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Yayasan Address" required="">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success" id="btn-save">Simpan
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->
    <footer class="app-footer"><!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div><!--end::To the end--><!--begin::Copyright--><strong>
            Copyright &copy; 2014-2023&nbsp;
            <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
    </footer><!--end::Footer-->
</div>
</body>
<script type="text/javascript">
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            responsive: true,
        });
        $('#crud-yys').DataTable({
            "dom": 'rtip',
            
            processing: true,
            serverSide: true,
            ajax: "{{ url('crud-yys') }}",
            columns: [{
                    data: 'id_yys_pt',
                    name: 'id_yys_pt',
                },
                {
                    data: 'nama_yys_pt',
                    name: 'nama_yys_pt',
                },
                {
                    data: 'nama_yys_pt',
                    name: 'nama_yys_pt',
                },
                {
                    data: 'nama_yys_pt',
                    name: 'nama_yys_pt',
                },
                {
                    data: 'jenis_yys',
                    name: 'jenis_yys',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                },
            ],
            order: [
                [0, 'desc']
            ]
        });

    });

    function add() {

        $('#YayasanForm').trigger("reset");
        $('#YayasanModal').html("Add Yayasan");
        $('#Yayasan-modal').modal('show');
        $('#id_yys_pt').val('');

    }

    function editFunc(id_yys_pt) {

        $.ajax({
            type: "POST",
            url: "{{ url('edit-yys') }}",
            data: {
                id_yys_pt: id_yys_pt,
            },
            dataType: 'json',
            success: function(res) {
                $('#YayasanModal').html("Edit Yayasan");
                $('#Yayasan-modal').modal('show');
                $('#id_yys_pt').val(res.id_yys_pt);
                $('#name').val(res.name);
                $('#address').val(res.address);
                $('#email').val(res.email);
            }
        });
    }

    function deleteFunc(id_yys_pt) {
        if (confirm("Delete Record?") == true) {
            var id_yys_pt = id_yys_pt;

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('delete-yys') }}",
                data: {
                    id_yys_pt: id_yys_pt,
                },
                dataType: 'json',
                success: function(res) {

                    var oTable = $('#crud-yys').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    }

    $('#YayasanForm').submit(function(e) {

        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: "{{ url('store-yys') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#Yayasan-modal").modal('hide');
                var oTable = $('#crud-yys').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save").attr("disabled", false);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>

</html>
