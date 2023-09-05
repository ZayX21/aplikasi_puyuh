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
                var url = "{{ route('slider.edit', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        var urlEdit = "{{ route('slider.update', ':id') }}";
                        urlEdit = urlEdit.replace(':id', id);
                        $('#editForm').attr('action', urlEdit);
                        $('#id-edit').val(id);

                        $('#name_edit').val(data.data.name);
                        $('#deskripsi_edit').val(data.data.deskripsi);
                        $('#foto_src').attr('src', data.data.foto);

                        $('#editModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#editForm').submit(function(e) {
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
                var form = $(this);
                var formData = new FormData(form[0]);
                $.ajax({
                    url: '{{ route('slider.store') }}',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
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
                        var urlDelete = "{{ route('slider.destroy', ':id') }}";
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
                    ajax: "{{ route('slider.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'judul',
                            name: 'judul'
                        },
                        {
                            data: 'deskripsi',
                            name: 'deskripsi'
                        },
                        {
                            data: 'fotoImg',
                            name: 'fotoImg'
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
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('admin.setting') }}"><i class="bx bx-window-alt me-1"></i>
                            Website</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('slider.index') }}"><i class="bx bx-dialpad me-1"></i> Slider</a>
                    </li>
                </ul>
            </div>
        </div>

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
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th width="20%">Foto</th>
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
    <!-- / Content -->
    @include('admin.slider.add')
    @include('admin.slider.edit')
@endsection
