@extends('layouts.frontend')

@section('jsCustom')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#btnKeranjang', function() {
                var idProduk = $(this).data('id');
                tambahKeranjang(idProduk, 1);
            });

            $('#btnDetailKeranjang').click(function() {
                var qtyProduk = $('#qtyProduk').val();
                var idProduk = "{{ $details->id }}";
                tambahKeranjang(idProduk, qtyProduk);
            });

            function tambahKeranjang(idProduk, qty = 1) {
                $.ajax({
                    url: "{{ route('tambahKeranjang') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        produk_id: idProduk,
                        qty: qty
                    },
                    success: function(response) {
                        if (response.success) {
                            $('.jumlah-keranjang').text(response.total_keranjang);
                            Swal.fire(
                                'Konfirmasi Berhasil',
                                'Berhasil Masukkan ke keranjang',
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Konfirmasi Login',
                                'Anda harus login terlebih dahulu!',
                                'info'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Terjadi Masalah!',
                            'Gagal Masukkan ke keranjang',
                            'error'
                        )
                    }
                });
            }
        });
    </script>
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5" style="margin-top: -3%">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Produk Yang Tersedia</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ url('/') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="{{ route('produk') }}">Produk</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Detail Produk</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        @php $noSlide = 1 @endphp

                        @foreach ($details->fotoProduk as $detail)
                            <div class="carousel-item @if ($noSlide == 1) active @endif">
                                <img class="w-100 h-100" src="{{ Storage::url('public/produk/') . $detail->foto }}"
                                    alt="Image">
                            </div>
                            @php $noSlide++ @endphp
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $details->nama_produk }}</h3>
                <div class="d-flex mb-3">
                    <small class="pt-0">
                        @if ($details->stok == 0)
                            <span class="text-danger">Stok Habis!</span>
                        @else
                            <span>Stok {{ $details->stok }}</span>
                        @endif
                        ({{ $details->jumlahTerjual() }} Terjual)
                    </small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">Rp. {{ number_format($details->harga) }}</h3>
                <p class="mb-4">
                    {{ $details->deskripsi }}
                </p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" id="qtyProduk" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary px-3" id="btnDetailKeranjang"><i class="fa fa-shopping-cart mr-1"></i>
                        Masukkan
                        Keranjang</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Anda Mungkin Juga Menyukai</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">

                    @foreach ($produks as $produk)
                        <div class="card product-item border-0">
                            <div
                                class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100"
                                    src="{{ Storage::url('public/produk/') . $produk->fotoProduk()->first()->foto }}"
                                    alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{ $produk->nama_produk }}</h6>
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
                                <button type="button" class="btn btn-sm text-dark p-0 @if ($produk->stok == 0) disabled @endif"
                                    data-id="{{ $produk->id }}" id="btnKeranjang">
                                    <i class="fas fa-shopping-cart text-primary mr-1 "></i>Masukkan Keranjang
                                </button>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
