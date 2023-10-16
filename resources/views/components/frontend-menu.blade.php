<nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 sticky-top">
    <div class="d-flex">
        <a href="" class="text-decoration-none d-block d-lg-none">
            <img src="{{ Storage::url('public/') . $setting->logo }}" width="25%">
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse justify-content-between text-right mr-2" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="{{ url('/') }}" class="nav-item nav-link">Home</a>
            <a href="{{ route('produk') }}" class="nav-item nav-link">Produk</a>
            {{-- <a href="contact.html" class="nav-item nav-link">Kontak</a> --}}
        </div>
        <div class="navbar-nav ml-auto py-0">
            @guest
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="nav-item nav-link">Halo, <span class="nama-user">{{ Auth::user()->name }}</span></a>
                <a href="{{ route('login') }}" class="nav-item nav-link">Dashboard</a>

                <a class="nav-item nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>
        <div class="col-lg-1 col-3 text-right">
            <a href="{{ route('keranjang') }}" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge jumlah-keranjang">{{ $countCart }}</span>
            </a>
        </div>
    </div>
</nav>
