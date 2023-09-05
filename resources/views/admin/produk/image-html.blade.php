<div class="row">

    @foreach ($produk->fotoProduk as $foto)
        <div class="col-md-4 mb-4">
            <div class="bg-white rounded shadow-sm"><img src="{{ Storage::url('public/produk/') . $foto->foto }}"
                    alt="" class="img-fluid card-img-top" style="object-fit: cover;height: 300px;">
                <div class="p-1">
                    <div class="d-flex align-items-center justify-content-between badge bg-light px-3 py-2 mt-1">
                        <p class="mb-0 text-dark"><i class="bx bx-image mr-2"></i><b class="">
                                {{ pathinfo(Storage::url('public/produk/') . $foto->foto, PATHINFO_EXTENSION) }}</b></p>
                        <button class="btn btn-danger btn-sm px-3 font-weight-normal delete-foto" type="button"
                            data-id="{{ $foto->id }}" data-produk="{{ $idProduk }}">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>

<script>
    $(document).ready(function() {
        

    });
</script>
