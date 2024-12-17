<form action="{{ route('updatebp', $data->id_yys_pt) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Perbarui Badan Penyelenggara Baru <span class="badge bg-success">{{ $data->nama_yys_pt }}</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Nama Badan Penyelenggara</label>
                                        <input type="text" class="form-control" id="validationCustom01" value="{{ $data->nama_yys_pt }}" name="nama_yys_pt">
                                        <div class="invalid-feedback">
                                            Masukkan Nama Badan Penyelenggara
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Status</label>
                                        <select class="form-select" id="validationCustom04" name="jenis_yys">
                                            <option selected disabled value="">--Pilih--<</option>
                                            <option value="1" {{ $data->jenis_yys == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ $data->jenis_yys == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Pilih Status!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Alamat Badan Penyelenggara [<span style="color: red; font-weight: bold;">Huruf Besar</span>]</label>
                                        <input type="text" name="alamat" class="form-control" id="validationCustom01" value="{{ $data->alamat_yys_pt }}"required>
                                        <div class="invalid-feedback">
                                            Masukkan Alamat
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Kode Badan Penyelenggara [<span style="color: red; font-weight: bold;">Khusus Admin</span>]</label>
                                        <input type="text" name="kodepddikti" class="form-control" id="validationCustom01" value="{{ $data->kd_kl_pddikti }}"required>
                                        <div class="invalid-feedback">
                                            Masukkan Kode Kl PDDIKTI
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-info" type="submit">{{ isset($id_yys_pt) ? 'Update' : 'Update' }}</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
        </div>
    </div>
                        </form> 