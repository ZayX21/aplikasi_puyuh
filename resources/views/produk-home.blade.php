@forelse ($produks as $produk)
    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
        <div class="card product-item border-0 mb-4">
            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                <img class="img-fluid w-100"
                    src="{{ Storage::url('public/produk/') . $produk->fotoProduk()->first()->foto }}" alt="">
            </div>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                <h6 class="text-truncate mb-3 produk">{{ $produk->nama_produk }}</h6>
                <div class="d-flex justify-content-center">
                    <h6>Rp. {{ number_format($produk->harga) }}</h6>

                </div>
                @if ($produk->stok == 0)
                    <p class="text-danger">Stok Habis!</p>
                @else
                    <p>Stok {{ $produk->stok }}</p>
                @endif
            </div>
            <div class="card-footer d-flex justify-content-between bg-light border">
                <a href="{{ route('produkDetail', $produk->id) }}" class="btn btn-sm text-dark p-0 "><i
                        class="fas fa-eye text-primary mr-1"></i>Detail</a>
                <button type="button"
                    class="btn btn-sm text-dark p-0 @if ($produk->stok == 0) disabled @endif"
                    data-id="{{ $produk->id }}" id="btnKeranjang">
                    <i class="fas fa-shopping-cart text-primary mr-1 "></i>Masukkan Keranjang
                </button>
            </div>
        </div>
    </div>

    @empty

    <div class="col-lg-12 pb-1 mt-5 mb-5">
        <div class="d-flex justify-content-center">
            <h3>Tidak Ada Produk</h3>
        </div>
    </div>

@endforelse
