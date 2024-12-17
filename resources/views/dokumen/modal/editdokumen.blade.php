<form action="{{ route('updatedokumen', ['id_dok' => $data->id_dok]) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('put')
    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Update Dokumen Baru <span class="badge bg-success">{{ $dataD->jenis_dok }}</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="jenis_dok" class="form-label">Nama Dokumen</label>
                                        <input type="text" name="jenis_dok" class="form-control" id="jenis_dok" value="{{ $data->jenis_dok }}" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Dokumen
                                        </div>
                                    </div>
                                    <div class="col-md-20">
                                        <label for="nama_dok" class="form-label">Keterangan</label>
                                        <textarea name="nama_dok" class="form-control" id="nama_dok" required>{{ $data->nama_dok }}</textarea>
                                        <div class="invalid-feedback">
                                            Harap masukkan Keterangan
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="digunakan" class="form-label">Peruntukan Dokumen</label>
                                        <select class="form-select" name="digunakan" id="digunakan" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1"{{ $data->digunakan == '1' ? 'selected' : '' }}>Pengajuan Kuota</option>
                                            <option value="2"{{ $data->digunakan == '1' ? 'selected' : '' }}>Pencarian</option>
                                            <option value="3"{{ $data->digunakan == '1' ? 'selected' : '' }}>Pertanggungjawaban</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Peruntukan Dokumen
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" name="status" id="status" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1"{{ $data->status == '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0"{{ $data->status == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Status Dokumen
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-info" type="submit">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
            </div> 
        </div>             
    </div>                  
</form>                 