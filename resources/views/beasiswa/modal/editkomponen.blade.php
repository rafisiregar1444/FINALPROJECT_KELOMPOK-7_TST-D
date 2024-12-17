<form action="{{ route('komponenbeasiswaupdate', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('put')
    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Update Komponen <span class="badge bg-success">{{ $data->nm_komponen }}</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="nm_komponen" class="form-label">Keterangan Beasiswa</label>
                                        <textarea name="nm_komponen" class="form-control" id="nm_komponen" required>{{ $data->nm_komponen }}</textarea>
                                        <div class="invalid-feedback">
                                            Harap masukkan Keterangan
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="pagu_awal" class="form-label">Kuota Awal</label>
                                        <input type="text" name="pagu_awal" class="form-control" id="pagu_awal" value="{{ $data->pagu_awal }}" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Beasiswa
                                        </div>
                                    </div>
                                    <div class="col-md-12">
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