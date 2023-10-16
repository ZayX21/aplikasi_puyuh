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
    {{-- <nav class="navbar navbar-expand-lg bg-light navbar-light sticky-top mb-2 shadow-sm">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ Storage::url('public/') . $setting->logo }}" width="10%">
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produk') }}" class="nav-link">Produk</a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Halo, <span class="nama-user">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('login') }}">Dashboard</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center align-item-center"
                            href="{{ route('keranjang') }}">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge jumlah-keranjang">{{ $countCart }}</span>
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </ul>
        </div>
    </nav> --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top mb-2 shadow-sm">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ Storage::url('public/') . $setting->logo }}" width="10%">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produk') }}" class="nav-link">Produk</a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Halo, <span class="nama-user">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('login') }}">Dashboard</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-center align-item-center"
                            href="{{ route('keranjang') }}">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge jumlah-keranjang">{{ $countCart }}</span>
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </ul>
        </div>
    </nav>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        @if (request()->url() == url('/'))
            @yield('slider')
        @endif
        {{-- <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Kategori</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse @if (request()->url() == url('/')) show @endif navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                    id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        @foreach ($kategoris as $kategori)
                            <a href="{{ route('produk', ['kategori' => $kategori->id]) }}"
                                class="nav-item nav-link list-kategori">{{ $kategori->nama }} </a>
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
        </div> --}}
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
                <p class="mb-2 text-center text-md-center"><i
                        class="fa fa-map-marker-alt text-primary mr-3"></i>{{ $setting->address }}</p>
                <p class="mb-2 text-center text-md-center"><i
                        class="fa fa-envelope text-primary mr-3"></i>{{ $setting->email }}</p>
                <p class="mb-2 text-center text-md-center"><i
                        class="fa fa-phone-alt text-primary mr-3"></i>{{ $setting->phone }}</p>
                <p class="mb-md-0 pt-3 text-center text-md-center text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">{{ $setting->name }}</a>. All
                    Rights
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
