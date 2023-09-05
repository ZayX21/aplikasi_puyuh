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
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Masukkan Nama Lengkap" />
                            <span id="name_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Masukkan Email Valid" />
                            <span id="email_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                            <span id="password_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="password-confirm" class="form-label">Ketik Ulang Password</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation">
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
