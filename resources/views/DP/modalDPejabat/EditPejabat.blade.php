<form action="{{ route('updatedaftarpejabat', ['id_pimpinan' => $data->id_pimpinan]) }}" method="POST" enctype="multipart/form-data">
 @csrf
 @method('PUT')
    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Baru Pejabat <span class="badge bg-success">{{ $dataPJ->nama_pts }}</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="kode_prodi" class="form-label">Nama</label>
                                        <input type="text" name="nama_pimpinan" class="form-control" id="nama_pimpinan" value="{{ $data->nama_pimpinan }}" >
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Pejabat
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status_prodi" class="form-label">Jabatan</label>
                                        <select class="form-select" name="id_jabatan_pim" id="id_jabatan_pim" >
                                                <option selected disabled value="">--Pilih--</option>
                                            @foreach($allProgram as $item)
                                                <option value="{{ $item->id_jabatan }}" {{ $data->jabatan->id_jabatan === $item->id_jabatan ? 'selected' : '' }}>
                                                    {{ $item->nm_jabatan_pim}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Jabatan Pejabat
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl_sk" class="form-label">Tanggal Awal</label>
                                        <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" value="{{ $data->tgl_awal }}">
                                        <div class="invalid-feedback">
                                            Harap masukkan Tanggal Awal
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl_sk" class="form-label">Tanggal Akhir</label>
                                        <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" value="{{ $data->tgl_akhir }}">
                                        <div class="invalid-feedback">
                                            Harap masukkan Tanggal Akhir
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_prodi" class="form-label">Nomor HP</label>
                                        <input type="text" name="no_hp" class="form-control" id="no_hp" value="{{ $data->no_hp }}" >
                                        <div class="invalid-feedback">
                                            Harap masukkan Nomor HP
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_prodi" class="form-label">Link Dokumen</label>
                                        <input type="text" name="link_dokumen" class="form-control" id="link_dokumen" value="{{ $data->link_dokumen }}">
                                        <div class="invalid-feedback">
                                            Harap masukkan Link Dokumen
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status_prodi" class="form-label">Status</label>
                                        <select class="form-select" name="status_jab" id="status_jab" >
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1"{{ $data->status_jab == '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0"{{ $data->status_jab == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Status Pejabat
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