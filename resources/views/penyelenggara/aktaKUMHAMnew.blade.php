<form action="{{ route('aktakumhamstore', ['id_akta_yys' => $aktaData->id_akta_yys]) }}" method="POST" enctype="multipart/form-data">
 @csrf
    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Buat Data Pengurus <span class="badge bg-success">{{ $yayasanData->nama_yys_pt }}</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="namap" class="form-label">Nama Pengurus</label>
                                        <input type="text" name="namap" class="form-control" id="namap" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Pengurus
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jabatanp" class="form-label">Jabatan</label>
                                        <input type="text" name="jabatanp" class="form-control" id="jabatanp" required>
                                        <div class="invalid-feedback">
                                            Harap jabatan pengurus
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="statusp" class="form-label">Status Pengurus</label>
                                        <select class="form-select" name="statusp" id="statusp" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1">Aktif</option>
                                            <option value="2">Tidak Aktif</option>
                                            <option value="3">Bermasalah</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih status pengurus
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea type="text" name="keterangan" class="form-control" id="keterangan" required></textarea>
                                        <div class="invalid-feedback">
                                            Harap masukkan keterangan pengurus
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