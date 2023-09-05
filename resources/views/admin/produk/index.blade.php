@extends('layouts.admin')

@section('cssCustom')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('jsCustom')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>


    <script>
        $(document).ready(function() {

            $('#kategori').select2();
            $('#kategori_edit').select2();

            $('#harga').maskMoney({
                prefix: 'Rp ',
                thousands: '.',
                decimal: ',',
                precision: 0
            });

            $('#harga_edit').maskMoney({
                prefix: 'Rp ',
                thousands: '.',
                decimal: ',',
                precision: 0
            });

            $('#addModal').on('shown.bs.modal', function() {
                $('#kategori').select2({
                    dropdownParent: $('#addModal')
                });
            });

            $('#editModal').on('shown.bs.modal', function() {
                $('#kategori_edit').select2({
                    dropdownParent: $('#editModal')
                });
            });

            $('#data-table').on('click', '.updateData', function() {
                var id = $(this).data('id');
                var url = "{{ route('produk.edit', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        var urlEdit = "{{ route('produk.update', ':id') }}";
                        urlEdit = urlEdit.replace(':id', id);
                        $('#editForm').attr('action', urlEdit);
                        $('#id-edit').val(id);

                        $('#name_edit').val(data.data.nama_produk);
                        $('#harga_edit').val(data.data.harga);
                        $('#stok_edit').val(data.data.stok);
                        $('#deskripsi_edit').val(data.data.deskripsi);

                        var kategoriProduk = [];
                        data.data.kategori.forEach(function(k) {
                            kategoriProduk.push(k.kategori_id);
                        });
                        $('#kategori_edit').val(kategoriProduk).trigger('change');

                        $('#editModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#editForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        if (response.success == true) {
                            $('#editModal').modal('hide');
                            $('#data-table').DataTable().ajax.reload();
                            $('#editForm')[0].reset();
                            showToast('Berhasil Mengubah Data!', 'Sukses', 'bg-success');
                        } else if (response.success == 'validasi') {

                            var errors = response.errors;
                            $.each(errors, function(field, messages) {
                                var errorMessages = '';
                                $.each(messages, function(index, message) {
                                    errorMessages += message + '<br>';
                                });
                                $('#' + field + '_error_edit').html(errorMessages);
                            });

                        } else {
                            showToast('Gagal Mengubah Data!', 'Gagal', 'bg-danger');
                        }
                    }
                });
            });

            $('#addForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('produk.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success == true) {
                            $('#addModal').modal('hide');
                            $('#data-table').DataTable().ajax.reload();
                            $('#addForm')[0].reset();
                            showToast('Berhasil Menambahkan Data!', 'Sukses', 'bg-success');
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
                            showToast('Gagal Menambahkan Data!', 'Gagal', 'bg-danger');
                        }
                    }
                });
            });

            $('#data-table').on('click', '.deleteData', function() {
                var idDelete = $(this).data('id');
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var urlDelete = "{{ route('produk.destroy', ':id') }}";
                        urlDelete = urlDelete.replace(':id', idDelete);
                        $.ajax({
                            url: urlDelete,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('#data-table').DataTable().ajax.reload();
                                    showToast('Berhasil menghapus Data!', 'Sukses',
                                        'bg-success');
                                } else {
                                    showToast('Gagal menghapus Data!', 'Gagal',
                                        'bg-danger');
                                }
                            },
                            error: function(xhr) {
                                showToast('Gagal menghapus Data!', 'Gagal',
                                    'bg-danger');
                            }
                        });
                    }
                });
            });

            tableData();

            function tableData() {
                $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('produk.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'nama_produk',
                            name: 'nama_produk'
                        },
                        {
                            data: 'hargaProduk',
                            name: 'hargaProduk'
                        },
                        {
                            data: 'stok',
                            name: 'stok'
                        },
                        {
                            data: 'kategori',
                            render: function(data) {
                                return data;
                            },
                            orderable: true,
                            searchable: true
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

            $('#data-table').on('click', '.imageData', function() {
                var id = $(this).data('id');
                var url = "{{ route('produk.image', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        var urlEdit = "{{ route('produk.imageAct') }}";
                        $('#imageForm').attr('action', urlEdit);
                        $('#id-image').val(id);

                        $('#fotoContainer').html(data);

                        $('#imageModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#imageForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success == true) {
                            var idImage = $('#id-image').val();
                            imageProduk(idImage)
                            $('#foto').val('');
                            showToast('Berhasil Menambah Foto!', 'Sukses', 'bg-success');
                        } else if (response.success == 'validasi') {

                            var errors = response.errors;
                            $.each(errors, function(field, messages) {
                                var errorMessages = '';
                                $.each(messages, function(index, message) {
                                    errorMessages += message + '<br>';
                                });
                                $('#' + field + '_error_image').html(errorMessages);
                            });

                        } else {
                            showToast('Gagal Menambah Foto!', 'Gagal', 'bg-danger');
                        }
                    }
                });
            });

            $('#fotoContainer').on('click', '.delete-foto', function() {
                var id = $(this).data('id');
                var idProduk = $(this).data('produk');
                var urlDeleteFoto =
                    "{{ route('produk.imageDel', ['id' => ':id', 'produk' => ':produk']) }}";
                urlDeleteFoto = urlDeleteFoto.replace(':id', id).replace(':produk', idProduk);
                $.ajax({
                    url: urlDeleteFoto,
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            imageProduk(idProduk)
                            showToast('Berhasil Menghapus Foto!', 'Sukses', 'bg-success');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            function imageProduk(id) {
                var url = "{{ route('produk.image', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#fotoContainer').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
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

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="bx bx-plus"></i> Tambah Data
                        </button>
                        <br>
                        <br>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <br>

                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Kategori</th>
                                    <th width="20%">Action</th>
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

    @include('admin.produk.add')
    @include('admin.produk.edit')
    @include('admin.produk.image')
@endsection
