<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Modal Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="post" action="">
                @csrf
                @method('PUT')
                <input type="hidden" class="id-edit" id="id-edit" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name_edit" class="form-label">Nama Kategori</label>
                            <input type="text" id="name_edit" name="name" class="form-control" placeholder="Masukkan Nama Kategori" />
                            <span id="name_error_edit" class="text-danger"></span>
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
