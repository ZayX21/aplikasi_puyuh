@extends('layouts.admin')

@section('cssCustom')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('jsCustom')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {

            $('#data-table').on('click', '.updateData', function() {
                var id = $(this).data('id');
                var url = "{{ route('user.edit', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        var urlEdit = "{{ route('user.update', ':id') }}";
                        urlEdit = urlEdit.replace(':id', id);
                        $('#editForm').attr('action', urlEdit);
                        $('#id-edit').val(id);

                        $('#name_edit').val(data.data.name);
                        $('#email_edit').val(data.data.email);

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
                    url: '{{ route('user.store') }}',
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
                        var urlDelete = "{{ route('user.destroy', ':id') }}";
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
                    ajax: "{{ route('user.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
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
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        }
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
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Created At</th>
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

    @include('admin.user.add')
    @include('admin.user.edit')
@endsection
