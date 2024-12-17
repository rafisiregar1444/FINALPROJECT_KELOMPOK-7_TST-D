<form action="{{ route('updateperubahanstatus', $data->id_pts) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-default" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Perbarui Status<span class="badge bg-success">{{ $data->nama_pts }}</span></h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Status</label>
                        <select class="form-select" id="validationCustom04" name="status_pts">
                            <option selected disabled value="">--Pilih--</option>
                            <option value="A" {{ $data->status_pts == 'A' ? 'selected' : '' }}>Aktif</option>
                            <option value="N" {{ $data->status_pts == 'N' ? 'selected' : '' }}>Pembinaan</option>
                            <option value="H" {{ $data->status_pts == 'H' ? 'selected' : '' }}>Tutup</option>
                            <option value="B" {{ $data->status_pts == 'B' ? 'selected' : '' }}>Alih Bentuk</option>
                            <option value="M" {{ $data->status_pts == 'M' ? 'selected' : '' }}>Alih Kelola</option>
                            <option value="K" {{ $data->status_pts == 'K' ? 'selected' : '' }}>Belum Terdefinisikan</option>
                        </select>
                        <div class="invalid-feedback">
                            Pilih Status!
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-info" type="submit">{{ isset($id_pts) ? 'Update' : 'Update' }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>
