<form action="{{ route('akreditasiptstore', ['id_pts' => $box->id_pts]) }}" method="POST" enctype="multipart/form-data">
 @csrf
    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Buat Akreditasi PT <span class="badge bg-success">{{ $pt->nama_pts }}</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="id_lembaga_apt" class="form-label">Lembaga Akreditasi</label>
                                        <select class="form-select" id="id_lembaga_apt" name="id_lembaga_apt" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            @foreach($alllembaga as $item)
                                                <option value="{{ $item->id_lembaga_apt }}">
                                                    {{ $item->sort_lembaga }} - {{ $item->nama_lembaga }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Pilih Program!
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="no_sk_apt" class="form-label">Nomor SK</label>
                                        <input type="text" name="no_sk_apt" class="form-control" id="no_sk_apt" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Prodi
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl_sk_apt" class="form-label">Tanggal Awal SK</label>
                                        <input type="date" name="tgl_sk_apt" class="form-control" id="tgl_sk_apt" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Tanggal Awal SK
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl_akhir_apt" class="form-label">Tanggal Akhir SK</label>
                                        <input type="date" name="tgl_akhir_apt" class="form-control" id="tgl_akhir_apt" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Tanggal Akhir SK
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="peringkat_apt" class="form-label">Peringkat Akreditasi PT</label>
                                        <select class="form-select" id="peringkat_apt" name="peringkat_apt" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            @foreach($allperingkat as $item)
                                                <option value="{{ $item->id_peringkat }}">
                                                    {{ $item->nm_peringkat }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Pilih Program!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status_akreditasi" class="form-label">Status Akreditasi</label>
                                        <select class="form-select" name="status_akreditasi" id="status_akreditasi" required>
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