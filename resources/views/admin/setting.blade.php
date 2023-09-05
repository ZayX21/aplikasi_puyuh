@extends('layouts.admin')

@section('cssCustom')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('jsCustom')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {

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
                      <a class="nav-link active" href="{{ route('admin.setting') }}"><i class="bx bx-window-alt me-1"></i> Website</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('slider.index') }}"
                        ><i class="bx bx-dialpad me-1"></i> Slider</a
                      >
                    </li>
                  </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Pengaturan Website</h5>
                    <!-- Account -->
                    <hr class="my-0" />
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.actUpdate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="mb-3 col-md-12">
                                    <label for="name" class="form-label">Nama Website</label>
                                    <input class="form-control" type="text" id="name" name="name"
                                        value="{{ $setting->name }}" required>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="description" class="form-label">Deskripsi Website</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10">
                                        {{ $setting->description }}
                                    </textarea>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" type="email" id="email" name="email"
                                        value="{{ $setting->email }}">
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="phone" class="form-label">Telepon</label>
                                    <input class="form-control" type="number" id="phone" name="phone"
                                        value="{{ $setting->phone }}">
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input class="form-control" type="text" id="address" name="address"
                                        value="{{ $setting->address }}">
                                </div>

                                @php
                                    $jsonSosmed = json_decode($setting->social_media, true);
                                @endphp
                                <div class="mb-3 col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="facebook" class="form-label">Link Facebook</label>
                                            <input class="form-control" type="text" id="facebook" name="facebook"
                                                value="{{ $jsonSosmed['facebook'] }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="instagram" class="form-label">Link Instagram</label>
                                            <input class="form-control" type="text" id="instagram" name="instagram"
                                                value="{{ $jsonSosmed['instagram'] }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="logo" class="form-label">Logo Website</label>
                                            <input class="form-control" type="file" id="logo" name="logo">
                                            @error('logo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="logo" class="form-label">Logo Website Saat Ini</label>
                                            <br>
                                            <img src="{{ Storage::url('public/') . $setting->logo }}" alt=""
                                                class="img-fluid" style="object-fit: cover;height: 100px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="favicon" class="form-label">Favicon Website</label>
                                            <input class="form-control" type="file" id="favicon" name="favicon">
                                            @error('favicon')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Favicon Website Saat Ini</label>
                                            <br>
                                            <img src="{{ Storage::url('public/') . $setting->favicon }}" alt=""
                                                class="img-fluid" style="object-fit: cover;height: 100px;">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr class="my-0" />
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
