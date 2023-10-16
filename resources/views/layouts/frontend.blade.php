<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }} - {{ $setting->name }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ Storage::url('public/') . $setting->favicon }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">

    @yield('cssCustom')
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        {{-- <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    @php
                        $jsonSosmed = json_decode($setting->social_media, true);
                    @endphp
                    <a class="text-dark px-2" href="{{ $jsonSosmed['facebook'] }}">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="{{ $jsonSosmed['facebook'] }}">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div> --}}
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="#" class="text-decoration-none">
                    <img src="{{ Storage::url('public/') . $setting->logo }}" width="30%">
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    {{-- <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Produk">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
  <div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block position-relative">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                data-toggle="collapse" href="#navbar-vertical"
                style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Kategori</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse @if (request()->url() == url('/')) show @endif navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 position-absolute"
                id="navbar-vertical" style="width: 100%; top: 65px;">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    @foreach ($kategoris as $kategori)
                        <a href="{{ route('produk', ['kategori' => $kategori->id]) }}" class="nav-item nav-link list-kategori">{{ $kategori->nama }} </a>
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            @include('components.frontend-menu')
            
            @if (request()->url() == url('/'))
                @yield('slider')
            @endif
        </div>
    </div>
</div>

    </div>
</div>

        </div>
    </div>

    <!-- Navbar End -->
    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-3 pb-3">
        <div class="row mx-xl-5">
            <div class="col-md-12 px-xl-0">
                <p class="text-center text-md-center" style="text-transform: capitalize">
                    {{ $setting->description }}
                </p>
                <p class="mb-2 text-center text-md-center"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{ $setting->address }}</p>
                <p class="mb-2 text-center text-md-center"><i class="fa fa-envelope text-primary mr-3"></i>{{ $setting->email }}</p>
                <p class="mb-2 text-center text-md-center"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ $setting->phone }}</p>
                <p class="mb-md-0 pt-3 text-center text-md-center text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">{{ $setting->name }}</a>. All Rights
                    Reserved.
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    @yield('jsCustom')
    <script>
        $(document).ready(function() {
            
        });
    </script>
    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>


</body>

</html>
