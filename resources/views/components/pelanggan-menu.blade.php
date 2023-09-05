<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="#" class="app-brand-link">
        <span class="app-brand-logo demo">
          <img src="{{ Storage::url('public/') . $setting->logo }}" width="100%" style="object-fit: cover;height: 60px;">
        </span>
        <span class="app-brand-text demo menu-text fw-bolder ms-2"></span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <br>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item">
        <a href="{{ route('pelanggan') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">MAIN MENU</span>
      </li>

      <li class="menu-item">
        <a href="{{ route('pelanggan.pesan') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-cart"></i>
          <div>Pesanan</div>
        </a>
      </li>

      {{-- <li class="menu-item">
        <a href="" class="menu-link">
          <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
          <div>Pembayaran</div>
        </a>
      </li> --}}

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Settings</span>
      </li>

      <li class="menu-item">
        <a href="{{ route('pelanggan.profile') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-user-account"></i>
          <div>Atur Akun</div>
        </a>
      </li>

      <li class="menu-item">
        <a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link">
          <i class="menu-icon tf-icons bx bx-power-off"></i>
          <div>Log Out</div>
        </a>
      </li>

    </ul>
  </aside>