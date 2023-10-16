@extends('layouts.frontend')

@section('jsCustom')
    <script>
        $(document).ready(function() {
            var page = 1;

            tampilProduk(page)

            $('#load-more-btn').click(function() {
                page++;
                tampilProduk(page);
            });

            $(document).on('click', '#btnKeranjang', function() {
                var idProduk = $(this).data('id');
                tambahKeranjang(idProduk, 1);
            });

            function tampilProduk(page) {
                $.ajax({
                    url: '{{ route('produkData') }}',
                    type: 'GET',
                    data: {
                        page: page
                    },
                    success: function(response) {
                        if (response.trim() != '') {
                            $('.produk-list').append(response);
                        } else {
                            $('#load-more-btn').hide();
                        }
                    }
                });
            }

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

@section('slider')
    <div class="mb-2 px-xl-5">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @php
                    $no = 1;
                @endphp
                @foreach ($sliders as $slider)
                    <div class="carousel-item {{ $no == 1 ? 'active' : '' }} " style="height: 410px;">
                        <img class="img-fluid" src="{{ Storage::url('public/slider/').$slider->foto }}" alt="" >
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">
                                    {{ $slider->deskripsi }}
                                </h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4 text-capitalize">{{ $slider->judul }}</h3>
                                {{-- <a href="" class="btn btn-light py-2 px-3">Shop Now</a> --}}
                            </div>
                        </div>
                    </div>
                    @php
                        $no++
                    @endphp
                @endforeach
    
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Kategori</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse @if (request()->url() == url('/')) show @endif navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                    id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        @foreach ($kategoris as $kategori)
                            <a href="{{ route('produk', ['kategori' => $kategori->id]) }}"
                                class="nav-item nav-link list-kategori">{{ $kategori->nama }} </a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">

                <div class="text-center mb-4">
                    <h2 class="section-title px-5"><span class="px-2">Produk Terkini</span></h2>
                </div>
                <div class="row px-xl-5 pb-3 produk-list">
        
        
                </div>
                <center>
                    <button class="btn btn-primary text-white" id="load-more-btn" data-page="1">Load More</button>
                </center>

            </div>
        </div>
        {{-- <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Produk Terkini</span></h2>
        </div>
        <div class="row px-xl-5 pb-3 produk-list">


        </div>
        <center>
            <button class="btn btn-primary text-white" id="load-more-btn" data-page="1">Load More</button>
        </center> --}}

    </div>
    <!-- Products End -->
@endsection
