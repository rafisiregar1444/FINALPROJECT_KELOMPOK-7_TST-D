 <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">   <!--begin::Body-->
                @csrf
                <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Buat Badan Penyelenggara Baru</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                    <div class="modal-body"><!--begin::Row-->
                        <div class="row g-3"><!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Nama Badan Penyelenggara</label>
                                        <input type="text" name="nama_yys_pt" class="form-control" id="validationCustom01" required>
                                        <div class="invalid-feedback">
                                            Masukkan Nama Badan Penyelenggara
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Status</label>
                                        <select class="form-select" name="jenis" id="validationCustom04"required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1" {{ isset($data) && $data->jenis_yys == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ isset($data) && $data->jenis_yys == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Pilih Status!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Alamat Badan Penyelenggara [<span style="color: red; font-weight: bold;">Huruf Besar</span>]</label>
                                        <input type="text" name="alamat" class="form-control" id="validationCustom01" required>
                                        <div class="invalid-feedback">
                                            Masukkan Alamat
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Kode Badan Penyelenggara [<span style="color: red; font-weight: bold;">Khusus Admin</span>]</label>
                                        <input type="text" name="kodepddikti" class="form-control" id="validationCustom01" required>
                                        <div class="invalid-feedback">
                                            Masukkan Kode Kl PDDIKTI
                                        </div>
                                    </div>
                        </div><!--end::Row-->
                        <br>
                        <button class="btn btn-info" type="submit">Tambah</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div><!--end::Body--><!--begin::Footer-->
        </div>
    </div>
</form><!--end::Form--><!--begin::JavaScript-->