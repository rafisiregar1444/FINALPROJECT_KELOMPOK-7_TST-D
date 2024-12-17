<form action="{{ route('catatanptstore', ['id_pts' => $pt->id_pts]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id_pts" value="{{ $pt->id_pts }}"> <!-- Tambahkan input tersembunyi untuk id_pts -->
    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Buat Catatan <span class="badge bg-success">{{ $pt->nama_pts }}</span></h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="kode_prodi" class="form-label">Catatan</label>
                            <input type="text" name="keterangan" class="form-control" id="keterangan" required>
                            <div class="invalid-feedback">
                                Harap masukkan Catatan
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
