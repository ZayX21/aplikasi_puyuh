<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Modal Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="post" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" class="id-edit" id="id-edit" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name_edit" class="form-label">Judul</label>
                            <input type="text" id="name_edit" name="name" class="form-control" placeholder="Masukkan Judul" />
                            <span id="name_error_edit" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="deskripsi_edit" class="form-label">Deskripsi</label>
                            <input type="text" id="deskripsi_edit" name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Singkat" />
                            <span id="deskripsi_error_edit" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="foto_edit" class="form-label">Foto</label>
                            <input type="file" id="foto_edit" name="foto" class="form-control">
                            <span id="foto_error_edit" class="text-danger"></span>
                            <small class="text-danger">Ukuran min 1268 x 410 dan ukuran 2 MB</small>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Foto Saat Ini</label>
                            <img id="foto_src" src="" width="100%" alt="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" id="updateBtn" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
