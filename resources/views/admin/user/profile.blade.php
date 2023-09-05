@extends('layouts.admin')

@section('cssCustom')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('jsCustom')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $('#editForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        if (response.success == true) {
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
                    <form id="editForm" method="post" action="{{ route('admin.profileAct') }}">
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name_edit" class="form-label">Nama Lengkap</label>
                                    <input type="text" id="name_edit" name="name" class="form-control"
                                        placeholder="Masukkan Nama Lengkap" value="{{ $user->name }}" />
                                    <span id="name_error_edit" class="text-danger"></span>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="email_edit" class="form-label">Email</label>
                                    <input type="email" id="email_edit" name="email" class="form-control"
                                        placeholder="Masukkan Email Valid" value="{{ $user->email }}" />
                                    <span id="email_error_edit" class="text-danger"></span>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="password_edit" class="form-label">Password</label>
                                    <input type="password" id="password_edit" name="password" class="form-control">
                                    <span id="password_error_edit" class="text-danger"></span>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="password-confirm" class="form-label">Ketik Ulang Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation">
                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
