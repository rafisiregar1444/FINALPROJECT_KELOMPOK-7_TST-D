<form action="{{ route('akreditasipsupdate', ['id_akreditasi' => $box->id_akreditasi]) }}" method="POST" enctype="multipart/form-data">
 @csrf
 @method('PUT')
 <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Buat Akreditasi Prodi <span class="badge bg-success">{{ $ps->nama_prodi }}</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                <div class="card-header">
                    <h4 class="mb-0" style="color: green;">{{ $pt->nama_pts }}</h3>
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="id_lembaga_aps" class="form-label">Lembaga Akreditasi</label>
                                        <select class="form-select" id="id_lembaga_aps" name="id_lembaga_aps" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            @foreach($alllembaga as $item)
                                                <option value="{{ $item->id_lembaga_aps }}"{{ $box->lembagaakreditasiprodi->id_lembaga_aps === $item->id_lembaga_aps ? 'selected' : '' }}>
                                                    {{ $item->sort_lembaga }} - {{ $item->nama_lembaga }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Pilih Program!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="no_sk_aps" class="form-label">Nomor SK</label>
                                        <input type="text" name="no_sk_aps" class="form-control" id="no_sk_aps" value="{{ $box->no_sk_aps }}" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Prodi
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl_sk_aps" class="form-label">Tanggal Awal SK</label>
                                        <input type="date" name="tgl_sk_aps" class="form-control" id="tgl_sk_aps" value="{{ $box->tgl_sk_aps }}" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Tanggal Awal SK
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl_akhir_aps" class="form-label">Tanggal Akhir SK</label>
                                        <input type="date" name="tgl_akhir_aps" class="form-control" id="tgl_akhir_aps" value="{{ $box->tgl_akhir_aps }}" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Tanggal Akhir SK
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="peringkat_aps" class="form-label">Peringkat Akreditasi PT</label>
                                        <select class="form-select" id="peringkat_aps" name="peringkat_aps" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            @foreach($allperingkat as $item)
                                                <option value="{{ $item->id_peringkat }}"{{ $box->peringkat->id_peringkat === $item->id_peringkat ? 'selected' : '' }}>
                                                    {{ $item->nm_peringkat }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Pilih Program!
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status_akreditasi_aps" class="form-label">Status Akreditasi</label>
                                        <select class="form-select" name="status_akreditasi_aps" id="status_akreditasi_aps" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1"{{ $box->status_akreditasi == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="0"{{ $box->status_akreditasi == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
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