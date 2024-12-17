<form action="{{ route('storedokumen', ['id_dok' => $data->id_dok]) }}" method="POST" enctype="multipart/form-data">
@csrf
    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Buat Dokumen Baru</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="jenis_dok" class="form-label">Nama Dokumen</label>
                                        <input type="text" name="jenis_dok" class="form-control" id="jenis_dok" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Dokumen
                                        </div>
                                    </div>
                                    <div class="col-md-20">
                                        <label for="nama_dok" class="form-label">Keterangan</label>
                                        <textarea name="nama_dok" class="form-control" id="nama_dok" required></textarea>
                                        <div class="invalid-feedback">
                                            Harap masukkan Keterangan
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="digunakan" class="form-label">Peruntukan Dokumen</label>
                                        <select class="form-select" name="digunakan" id="digunakan" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1">Pengajuan Kuota</option>
                                            <option value="2">Pencarian</option>
                                            <option value="3">Pertanggungjawaban</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Peruntukan Dokumen
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" name="status" id="status" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
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