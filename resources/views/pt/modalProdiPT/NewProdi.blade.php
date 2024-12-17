<form action="{{ route('prodiptstore', ['id_pts' => $data->id_pts]) }}" method="POST" enctype="multipart/form-data">
 @csrf
    <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">'
                <div class="modal-header">
                    <h4 class="modal-title">Buat Program Studi <span class="badge bg-success">{{ $pt->nama_pts }}</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="kode_prodi" class="form-label">Kode Prodi</label>
                                        <input type="text" name="kode_prodi" class="form-control" id="kode_prodi" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Kode Prodi
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_prodi" class="form-label">Nama Prodi</label>
                                        <input type="text" name="nama_prodi" class="form-control" id="nama_prodi" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Prodi
                                        </div>
                                    </div>
                                @if (isset($data->jenjang) && $data->jenjang)
                                    <div class="col-md-6">
                                        <label for="program" class="form-label">Program</label>
                                        <select class="form-select" id="program" name="program" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            @foreach($allProgram as $item)
                                                <option value="{{ $item->kode_jenjang }}" {{ $data->jenjang->kode_jenjang === $item->kode_jenjang ? '' : '' }}>
                                                    {{ $item->sort_jenjang }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Pilih Program!
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <label for="program" class="form-label">Program</label>
                                        <select class="form-select" id="program" name="program" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            @foreach($allProgram as $item)
                                                <option value="{{ $item->kode_jenjang }}">
                                                    {{ $item->sort_jenjang }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Pilih Program!
                                        </div>
                                    </div>
                                @endif
                                    <div class="col-md-6">
                                        <label for="status_prodi" class="form-label">Status Prodi</label>
                                        <select class="form-select" name="status_prodi" id="status_prodi" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="A">Aktif</option>
                                            <option value="N">Pembinaan</option>
                                            <option value="H">Tutup</option>
                                            <option value="M">Alih Bentuk</option>
                                            <option value="T">Bermasalah</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih Status Prodi
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="no_sk" class="form-label">Nomor SK</label>
                                        <input type="text" name="no_sk" class="form-control" id="no_sk" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nomor SK
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tgl_sk" class="form-label">Tanggal SK</label>
                                        <input type="date" name="tgl_sk" class="form-control" id="tgl_sk" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Tanggal SK
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