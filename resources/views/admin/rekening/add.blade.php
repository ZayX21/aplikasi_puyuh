<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Modal Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addForm" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="bank" class="form-label">Nama Bank</label>
                            <input type="text" id="bank" name="bank" class="form-control" >
                            <span id="bank_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Atas Nama</label>
                            <input type="text" id="name" name="name" class="form-control">
                            <span id="name_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="norek" class="form-label">Nomor Rekening</label>
                            <input type="number" id="norek" name="norek" class="form-control">
                            <span id="norek_error" class="text-danger"></span>
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
