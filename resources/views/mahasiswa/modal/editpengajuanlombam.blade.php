<form action="{{ route('updatepengajuanlombam', ['id_lomba_mahasiswa' => $data->id_lomba_mahasiswa]) }}" method="POST" enctype="multipart/form-data">
 @csrf
 @method('PUT')
    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Update Data Pengajuan<span class="badge bg-success">{{ $data->user->nama_pt }}</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="id_lomba" class="form-label">Nama Lomba</label>
                                        <select class="form-select" id="id_lomba" name="id_lomba" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            @foreach($lomba as $item)
                                                <option value="{{ $item->id_lomba }}" {{ $data->id_lomba == $item->id_lomba ? 'selected' : (old('id_lomba') == $item->id_lomba ? 'selected' : '') }}>
                                                    {{ $item->nama_lomba }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Pilih Jenis Lomba!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_menang" class="form-label">Tanggal Menang</label>
                                        <input type="date" name="tanggal_menang" class="form-control" id="tanggal_menang" value="{{ $data->tanggal_menang }}"required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Tanggal Menang
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" name="status" id="status" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1"{{ $data->status == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="0"{{ $data->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Status Akreditasi
                                        </div>
                                    </div>
                                    <div class="col-md-20">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea name="keterangan" class="form-control" id="keterangan">{{ $data->keterangan }}</textarea>
                                        <div class="invalid-feedback">
                                            Harap masukkan Keterangan
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

