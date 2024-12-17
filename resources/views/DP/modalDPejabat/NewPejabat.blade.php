<form action="{{ route('storedaftarpejabat', ['id_pts' => $dataPJ->id_pts]) }}" method="POST" enctype="multipart/form-data">
@csrf
    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Buat Data Baru Pejabat <span class="badge bg-success">{{ $dataPJ->nama_pts }}</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="kode_prodi" class="form-label">Nama</label>
                                        <input type="text" name="nama_pimpinan" class="form-control" id="nama_pimpinan" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Pejabat
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status_prodi" class="form-label">Jabatan</label>
                                        <select class="form-select" name="nm_jabatan_pim" id="nm_jabatan_pim" required>
                                            <option selected disabled value="">--Pilih--</option>
                                        @foreach($allProgram as $item)
                                            <option value="{{ $item->nm_jabatan_pim }}">{{ $item->nm_jabatan_pim }}</option>
                                        @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Jabatan Pejabat
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl_sk" class="form-label">Tanggal Awal</label>
                                        <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Tanggal Awal
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl_sk" class="form-label">Tanggal Akhir</label>
                                        <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Tanggal Akhir
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_prodi" class="form-label">Nomor HP</label>
                                        <input type="text" name="no_hp" class="form-control" id="no_hp" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nomor HP
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_prodi" class="form-label">Link Dokumen</label>
                                        <input type="text" name="link_dokumen" class="form-control" id="link_dokumen" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Link Dokumen
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status_prodi" class="form-label">Status</label>
                                        <select class="form-select" name="status_jab" id="status_jab" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
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