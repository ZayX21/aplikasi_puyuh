@extends('layouts.frontend')

@section('jsCustom')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#kurangQty', function() {
                var idKeranjang = $(this).data('id');
                var qtyInput = $(this).closest('.quantity').find('#qtyValue');
                var qty = parseInt(qtyInput.val());
                updateQty(idKeranjang, qty);
            });

            $(document).on('click', '#tambahQty', function() {
                var idKeranjang = $(this).data('id');
                var qtyInput = $(this).closest('.quantity').find('#qtyValue');
                var qty = parseInt(qtyInput.val());
                updateQty(idKeranjang, qty);
            });

            $(document).on('click', '#btnDelete', function() {
                var keranjangId = $(this).data('id');
                deleteProduk(keranjangId);
            });

            function updateQty(keranjangId, qty) {
                var url = "{{ route('updateKeranjang', ':id') }}";
                url = url.replace(':id', keranjangId);
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        qty: qty
                    },
                    success: function(response) {
                        if (response.success) {
                            updateTotalHarga(keranjangId, qty)
                            updateSubTotal()
                        }
                    },
                    error: function() {
                        console.log('Error updating qty');
                    }
                });
            }

            function deleteProduk(keranjangId) {
                var urlDelete = "{{ route('deleteKeranjang', ':id') }}";
                urlDelete = urlDelete.replace(':id', keranjangId);
                $.ajax({
                    url: urlDelete,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('.keranjang-' + keranjangId).remove();
                            updateSubTotal()
                        }
                    },
                    error: function() {
                        console.log('Error deleting produk');
                    }
                });
            }

            function updateSubTotal() {
                var subTotal = 0;
                $('.totalProdukHidden').each(function() {
                    var hargaProduk = parseFloat($(this).text());
                    subTotal += hargaProduk;
                });
                $('#subTotalSummary').text('Rp. ' + formatNumber(subTotal));
                $('#totalSummary').text('Rp. ' + formatNumber(subTotal));
            }

            function updateTotalHarga(keranjangId, qty) {
                var hargaProduk = parseFloat($('#hargaProduk' + keranjangId).text());
                var totalHarga = hargaProduk * qty;

                $('#totalProduk' + keranjangId).text('Rp. ' + formatNumber(totalHarga));
                $('#totalProdukHidden' + keranjangId).text(totalHarga);
            }

            function formatNumber(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }

        });
    </script>
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Keranjang</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ url('/') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="#">Keranjang</a></p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php
                            $subTotal = 0;
                        @endphp
                        @foreach ($keranjangs as $keranjang)
                            <tr class="keranjang-{{ $keranjang->id }}">
                                <td class="align-middle"><img
                                        src="{{ Storage::url('public/produk/') . $keranjang->produk->fotoProduk()->first()->foto }}"
                                        alt="" style="width: 50px;"> {{ $keranjang->produk->nama_produk }}</td>
                                <td class="align-middle">Rp. {{ number_format($keranjang->produk->harga) }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" id="kurangQty"
                                                data-id="{{ $keranjang->id }}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center"
                                            id="qtyValue" value="{{ $keranjang->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus" id="tambahQty"
                                                data-id="{{ $keranjang->id }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    @php
                                        $totalPerproduk = $keranjang->produk->harga * $keranjang->qty;
                                        $subTotal += $totalPerproduk;
                                    @endphp
                                    <span id="totalProduk{{ $keranjang->id }}">Rp.
                                        {{ number_format($totalPerproduk) }}</span>
                                    <span id="totalProdukHidden{{ $keranjang->id }}" class="totalProdukHidden"
                                        style="display: none">{{ $totalPerproduk }}</span>
                                    <span id="hargaProduk{{ $keranjang->id }}"
                                        style="display: none">{{ $keranjang->produk->harga }}</span>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-primary" id="btnDelete" data-id="{{ $keranjang->id }}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                {{-- <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form> --}}
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Detail</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium" id="subTotalSummary">Rp. {{ number_format($subTotal) }}</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold" id="totalSummary">Rp. {{ number_format($subTotal) }}</h5>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-block btn-primary my-3 py-3">
                            Lanjutkan ke Pembayaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
