@extends('layouts.pelanggan')

@section('cssCustom')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('jsCustom')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $('#data-table').on('click', '#detailData', function() {
                var id = $(this).data('id');
                var url = "{{ route('pelanggan.pesanDetail', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#bodyDetailModal').html(data);
                        detailData(id);
                        $('#detailModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#data-table').on('click', '#konfirmasiPesanan', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');
                var url = "{{ route('pelanggan.konfirmasiPenerimaanBarang', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        status: status
                    },
                    success: function(response) {
                        if (response.success == true) {
                            Swal.fire({
                                title: 'Apakah Barang Sudah Anda Terima?',
                                text: "Barang yang sudah diterima tidak bisa dikembalikan!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Barang Sudah Diterima'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Terima Kasih Atas Konfirmasi Anda',
                                        'Silahkan Memesan Lagi',
                                        'success'
                                    ),
                                    $('#data-table').DataTable().ajax.reload();
                                }
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            tableData();

            function tableData() {
                $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('pelanggan.pesan') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'kode_transaksi',
                            name: 'kode_transaksi'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data) {
                                var date = new Date(data);
                                var day = date.getDate();
                                var month = date.getMonth() + 1;
                                var year = date.getFullYear();
                                var formattedDate = day + '-' + month + '-' + year;
                                return formattedDate;
                            }
                        },
                        {
                            data: 'statusPesanan',
                            name: 'statusPesanan'
                        },
                        {
                            data: 'statusPembayaran',
                            name: 'statusPembayaran'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        }
                    ]
                });
            }

            function detailData(idDetail) {
                var urlDetail = "{{ route('pelanggan.pesanDetailProduk', ':id') }}";
                urlDetail = urlDetail.replace(':id', idDetail);
                $('#detail-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: urlDetail,
                    columns: [{
                            data: 'produk',
                            name: 'produk'
                        },
                        {
                            data: 'hargaProduk',
                            name: 'hargaProduk'
                        },
                        {
                            data: 'jumlah_dipesanan',
                            name: 'jumlah_dipesanan'
                        },
                        {
                            data: 'totalHarga',
                            name: 'totalHarga'
                        },
                    ]
                });
            }
        });
    </script>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> {{ $title }}</h4>

        {{-- TOAST --}}
        <div class=" position-fixed top-0 end-0 p-3" style="z-index: 10000 !important">
            <div id="toastContainer"></div>
        </div>
        {{-- TOAST --}}

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Data {{ $title }}</h5>
                    <div class="card-body">

                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Pembayaran</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL --}}
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modal Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bodyDetailModal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL DETAIL --}}

    {{-- MODAL KONFIRMASI PEMBAYARAN --}}
    <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modal Konfrimasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="imageForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="bodyKonfirmasiModal">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- MODAL KONFIRMASI PEMBAYARAN --}}
@endsection
