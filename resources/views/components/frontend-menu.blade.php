<nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
    <a href="" class="text-decoration-none d-block d-lg-none">
        <img src="{{ Storage::url('public/') . $setting->logo }}" width="80%">
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
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
                <a href="#" class="nav-item nav-link">Halo, {{ Auth::user()->name }}</a>
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
    </div>
</nav>
