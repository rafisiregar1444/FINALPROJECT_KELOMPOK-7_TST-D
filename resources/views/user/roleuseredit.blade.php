<form action="{{ route('roleupdate', ['id_userx' => $data->id_userx]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-default" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Perbarui Role <span class="badge bg-success">{{ $data->nama_pt }}</span></h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Role</label>
                        <select class="form-select" id="validationCustom04" name="role">
                            <option selected disabled value="">--Pilih--</option>
                            <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $data->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="mahasiswa" {{ $data->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        </select>
                        <div class="invalid-feedback">
                            Pilih Status!
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-info" type="submit">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>
