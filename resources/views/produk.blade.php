@extends('layouts.frontend')

@section('jsCustom')
    <script>
        $(document).ready(function() {
            var page = 1;

            tampilProduk(page)

            $(document).on('click', '#btnKeranjang', function() {
                var idProduk = $(this).data('id');
                tambahKeranjang(idProduk, 1);
            });

            $('#load-more-btn').click(function() {
                page++;
                tampilProduk(page);
            });

            $('#searchInput, #categorySelect, #kategoriSelect').on('change keyup', function() {
                page = 1;
                tampilProduk(page);
            });

            function tampilProduk(page) {
                var keyword = $('#searchInput').val();
                var filter = $('#categorySelect').val();
                var kategori = "{{ $kategoriUrl }}";

                if ($('#kategoriSelect').val() != "") {
                    kategori = $('#kategoriSelect').val();
                }

                $.ajax({
                    url: '{{ route('produkData') }}',
                    type: 'GET',
                    data: {
                        keyword: keyword,
                        filter: filter,
                        kategori: kategori,
                        page: page
                    },
                    success: function(response) {
                        if (response.trim() != '') {
                            if (page == 1) {
                                $('.produk-list').html(response);
                            } else {
                                $('.produk-list').append(response);
                            }
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

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5" style="margin-top: -3%">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Produk Yang Tersedia</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ url('/') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Belanja</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    <div class="col-3 pb-1 mr-0">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari nama produk" id="searchInput">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-3 pb-1">
                        <select id="categorySelect" class="form-control ml-4">
                            <option value="">Filter berdasarkan</option>
                            <option value="Terlaris">Terlaris</option>
                            <option value="Termurah">Termurah</option>
                        </select>
                    </div>
                    <div class="col-3 pb-1">
                        <select id="kategoriSelect" class="form-control ml-4">
                            <option value="semua">Semua Kategori</option>
                            @foreach ($kategoris as $kt)
                                <option {{ $kategoriUrl == $kt->id ? 'selected' : '' }} value="{{ $kt->id }}">{{ $kt->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3"></div>
                </div>

                <div class="row pb-3 produk-list">

                </div>

                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <center>
                            <button class="btn btn-primary text-white" id="load-more-btn" data-page="1">Load More</button>
                        </center>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
