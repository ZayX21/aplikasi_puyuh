@extends('layouts.frontend')

@section('cssCustom')
    <style>
        .rekening-list {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .rekening-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f7f7f7;
        }

        .rekening-info {
            flex: 1;
        }
    </style>
@endsection

@section('jsCustom')
    <script>
        $(document).ready(function() {
            $('#submitBtn').click(function() {
                var csrfToken = "{{ csrf_token() }}";
                var formData = new FormData();
                var buktiPembayaran = $('#file')[0].files[0];
                var alamatPengiriman = $('#alamat').val();
                var kodeTransaksi = $('#kode_transaksi').val();
                var total_harga = $('#total_harga').val();

                formData.append('buktiPembayaran', buktiPembayaran);
                formData.append('alamatPengiriman', alamatPengiriman);
                formData.append('kodeTransaksi', kodeTransaksi);
                formData.append('total_harga', total_harga);
                formData.append('_token', csrfToken);

                $.ajax({
                    url: "{{ route('actCheckout') }}", // Ganti dengan URL endpoint yang sesuai
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success == true) {
                            Swal.fire(
                                'Konfirmasi Berhasil',
                                'Berhasil Melakukan Checkout',
                                'success'
                            ).then(function() {
                                // Redirect ke halaman lain
                                window.location.href = "{{ route('login') }}";
                            });
                        } else if (response.success == 'validasi') {

                            var errors = response.errors;
                            $.each(errors, function(field, messages) {
                                var errorMessages = '';
                                $.each(messages, function(index, message) {
                                    errorMessages += message + '<br>';
                                });
                                $('#' + field + '_error').html(errorMessages);
                            });

                        } else {
                            Swal.fire(
                                'Konfirmasi Gagal',
                                'Gagal melakukan checkout',
                                'info'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Konfirmasi Gagal',
                            'Server sedang bermasalah!',
                            'error'
                        );
                    }
                });
            });
        });
    </script>
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Pembayaran</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ url('/') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="#">Pembayaran</a></p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Detail Informasi</h4>
                    <div class="row">

                        <div class="col-md-12 form-group">
                            <label>Kode Transaksi</label>
                            <input type="text" class="form-control" name="kode_transaksi" id="kode_transaksi"
                                value="{{ $kodeTransaksi }}" readonly>

                        </div>


                        <div class="col-md-12 form-group">
                            <label>Alamat Pengiriman</label>
                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                            <p class="text-danger"><small>Masukan alamat yang valid!</small></p>
                            <small id="alamatPengiriman_error" class="text-danger"></small>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Upload Bukti Pembayaran</label>
                            <input type="file" class="form-control" name="file" id="file">
                            <p class="text-danger"><small>Format PNG, JPG, JPEG Size Maks 2 Mb</small></p>
                            <small id="buktiPembayaran_error" class="text-danger"></small>
                        </div>

                        <div class="col-md-12 form-group">
                            <label><b>Daftar Nomor Rekening</b></label>
                        </div>

                        <div class="col-md-12">
                            <div class="rekening-list">

                                @foreach ($rekenings as $rekening)
                                    <div class="rekening-item">
                                        <div class="rekening-info">
                                            <h5>{{ $rekening->bank }}</h5>
                                            <p>Nomor Rekening: {{ $rekening->norek }}</p>
                                            <p>Atas Nama: {{ $rekening->atas_nama }}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Produk</h5>
                        @php
                            $subTotal = 0;
                        @endphp
                        @foreach ($keranjangs as $keranjang)
                            <div class="d-flex justify-content-between">
                                <p>{{ $keranjang->produk->nama_produk }} <br> <small>X {{ $keranjang->qty }}</small></p>
                                @php
                                    $totalPerproduk = $keranjang->produk->harga * $keranjang->qty;
                                    $subTotal += $totalPerproduk;
                                @endphp
                                <p>{{ 'Rp. ' . number_format($totalPerproduk) }}</p>
                            </div>
                        @endforeach

                        <input type="hidden" class="form-control" name="total_harga" id="total_harga"
                            value="{{ $subTotal }}" readonly>

                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">{{ 'Rp. ' . number_format($subTotal) }}</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">{{ 'Rp. ' . number_format($subTotal) }}</h5>
                        </div>
                        <button id="submitBtn"
                            class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
@endsection
