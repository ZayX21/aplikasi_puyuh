<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Modal Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Judul</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan Judul" />
                            <span id="name_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" id="deskripsi" name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Singkat" />
                            <span id="deskripsi_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" id="foto" name="foto" class="form-control">
                            <span id="foto_error" class="text-danger"></span>
                            <small class="text-danger">Ukuran min 1268 x 410 dan ukuran 2 MB</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
