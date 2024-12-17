<form action="{{ route('storebeasiswa') }}" method="POST" enctype="multipart/form-data">
@csrf
    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Profil Bantuan Biaya Pendidikan</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="jenis_beasiswa" class="form-label">Nama Beasiswa</label>
                                        <input type="text" name="jenis_beasiswa" class="form-control" id="jenis_beasiswa" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Beasiswa
                                        </div>
                                    </div>
                                    <div class="col-md-20">
                                        <label for="keterangan" class="form-label">Keterangan Beasiswa</label>
                                        <textarea name="keterangan" class="form-control" id="keterangan" required></textarea>
                                        <div class="invalid-feedback">
                                            Harap masukkan Keterangan
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pt_penerima" class="form-label">Jenis</label>
                                        <select class="form-select" name="pt_penerima" id="pt_penerima" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1">Selektif</option>
                                            <option value="0">Umum</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Jenis
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