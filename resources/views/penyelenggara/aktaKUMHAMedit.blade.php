
                        <form action="{{ route('aktakumhamupdate', $pengurusData->id_pengurus) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal fade text-left" id="modal-default" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">'
                            <div class="modal-header">
                                <h4 class="modal-title">Perbarui Data Pengurus <span class="badge bg-success">{{ $yayasanData->nama_yys_pt }}</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>                    
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="namap" class="form-label">Nama Pengurus</label>
                                        <input type="text" name="namap" class="form-control" id="namap" value="{{ $pengurusData->namap }}" required>
                                        <div class="invalid-feedback">
                                            Harap masukkan Nama Pengurus
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="jabatanp" class="form-label">Jabatan</label>
                                        <input type="text" name="jabatanp" class="form-control" id="jabatanp" value="{{ $pengurusData->jabatanp }}" required>
                                        <div class="invalid-feedback">
                                            Harap jabatan pengurus
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="statusp" class="form-label">Status Pengurus</label>
                                        <select class="form-select" name="statusp" id="statusp" required>
                                            <option selected disabled value="">--Pilih--</option>
                                            <option value="1"{{ $pengurusData->statusp == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="2"{{ $pengurusData->statusp == 2 ? 'selected' : '' }}>Tidak Aktif</option>
                                            <option value="3"{{ $pengurusData->statusp == 3 ? 'selected' : '' }}>Bermasalah</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Harap pilih status pengurus
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea type="text" name="keterangan" class="form-control" id="keterangan" required>{{ $pengurusData->keterangan }}</textarea>
                                        <div class="invalid-feedback">
                                            Harap masukkan keterangan pengurus
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-info" type="submit">Update</button>
                                <!-- <a class="btn btn-secondary" href="{{ route('aktakumham', ['id_akta_yys' => $aktaData->id_akta_yys]) }}">Batal</a> -->
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
            