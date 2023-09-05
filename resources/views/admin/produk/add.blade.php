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
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Masukkan Nama Produk" />
                            <span id="name_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="harga" class="form-label">Harga Produk</label>
                            <input type="text" id="harga" name="harga" class="form-control"
                                placeholder="Masukkan Harga Produk" />
                            <span id="harga_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="stok" class="form-label">Stok Produk</label>
                            <input type="number" id="stok" name="stok" class="form-control">
                            <span id="stok_error" class="text-danger"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="kategori" class="form-label">Kategori Produk</label>
                            <select class="form-control" name="kategori[]" id="kategori" multiple>
                                @foreach ($kategori as $a)
                                    <option value="{{ $a->id }}">{{ $a->nama }}</option>
                                @endforeach
                            </select>
                            <span id="kategori_error" class="text-danger"></span>
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
