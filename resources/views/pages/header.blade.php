    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route('home.index') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs>
                                    <path
                                        d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                                        id="path-1"></path>
                                    <path
                                        d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                                        id="path-3"></path>
                                    <path
                                        d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                                        id="path-4"></path>
                                    <path
                                        d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                                        id="path-5"></path>
                                </defs>
                                <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                                        <g id="Icon" transform="translate(27.000000, 15.000000)">
                                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                                                <mask id="mask-2" fill="white">
                                                    <use xlink:href="#path-1"></use>
                                                </mask>
                                                <use fill="#696cff" xlink:href="#path-1"></use>
                                                <g id="Path-3" mask="url(#mask-2)">
                                                    <use fill="#696cff" xlink:href="#path-3"></use>
                                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                                </g>
                                                <g id="Path-4" mask="url(#mask-2)">
                                                    <use fill="#696cff" xlink:href="#path-4"></use>
                                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                                </g>
                                            </g>
                                            <g id="Triangle"
                                                transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                                <use fill="#696cff" xlink:href="#path-5"></use>
                                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">FastFood</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Trang chủ -->
                    <li
                        class="menu-item {{ request()->is('place-add*') || request()->is('place-list*') ? 'active menu-open' : '' }}">
                        <a href="{{ route('home.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Trang chủ</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Món</span>
                    </li>
                    <!-- Món ăn -->
                    <li class="menu-item {{ request()->is('monAn*') || request()->is('monAn*') ? 'active' : '' }}">
                        <a href="{{ route('monAn.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-dish"></i>
                            <div data-i18n="Analytics">Món</div>
                        </a>
                    </li>
                    <!-- Loại món ăn -->
                    <li
                        class="menu-item {{ request()->is('loaiMonAn*') || request()->is('loaiMonAns*') ? 'active' : '' }}">
                        <a href="{{ route('loaiMonAn.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-fridge"></i>
                            <div data-i18n="Analytics">Loại món</div>
                        </a>
                    </li>
                    <!-- Địa điểm -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Địa điểm</span>
                    </li>
                    <!-- Địa điểm -->
                    <li
                        class="menu-item {{ request()->is('diaDiem*') || request()->is('diaDiems*') ? 'active' : '' }}">
                        <a href="{{ route('diaDiem.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-store-alt"></i>
                            <div data-i18n="Analytics">Địa điểm</div>
                        </a>
                    </li>
                    <!-- Tài khoản -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Tài khoản</span>
                    </li>
                    <!-- Tài khoản -->
                    <li
                        class="menu-item {{ request()->is('taiKhoan*') || request()->is('taiKhoan*') ? 'active' : '' }}">
                        <a href="{{ route('taiKhoan.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div data-i18n="Analytics">Tài khoản</div>
                        </a>
                    </li>
                    <!-- Đơn hàng -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Đơn hàng</span></li>
                    <!-- Đơn hàng -->
                    <li
                        class="menu-item {{ request()->is('donHang*') || request()->is('donHang*') ? 'active' : '' }}">
                        <a href="{{ route('donHang.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-memory-card"></i>
                            <div data-i18n="Analytics">Đơn hàng</div>
                        </a>
                    </li>
                    <!-- Trạng thái đơn hàng -->
                    <li
                        class="menu-item {{ request()->is('trangThaiDonHang*') || request()->is('trangThaiDonHangs*') ? 'active' : '' }}">
                        <a href="{{ route('trangThaiDonHang.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-food-menu"></i>
                            <div data-i18n="Analytics">Trạng thái đơn hàng</div>
                        </a>
                    </li>
                    <!-- Đánh giá -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Đánh giá</span></li>
                    <!-- Đánh giá -->
                    <li
                        class="menu-item {{ request()->is('danhGia*') || request()->is('danhGia*') ? 'active' : '' }}">
                        <a href="{{ route('danhGia.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-star"></i>
                            <div data-i18n="Analytics">Đánh giá</div>
                        </a>
                    </li>
                    <!-- Bình luận -->
                    {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Bình luận</span></li> --}}
                    <!-- Bình luận -->
                    {{-- <li
                        class="menu-item {{ request()->is('binhLuan*') || request()->is('binhLuan*') ? 'active' : '' }}">
                        <a href="{{ route('binhLuan.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-message-square-dots"></i>
                            <div data-i18n="Analytics">Bình luận</div>
                        </a>
                    </li> --}}
                    <!-- Mã giảm giá -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Mã giảm giá</span>
                    </li>
                    <!-- Loại mã giảm giá -->
                    <li
                        class="menu-item {{ request()->is('loaiGiamGia*') || request()->is('loaiGiamGias*') ? 'active' : '' }}">
                        <a href="{{ route('loaiGiamGia.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-coupon"></i>
                            <div data-i18n="Analytics">Loại mã giảm giá</div>
                        </a>
                    </li>
                    <!-- Mã giảm giá -->
                    <li
                        class="menu-item {{ request()->is('maGiamGia*') || request()->is('maGiamGia*') ? 'active' : '' }}">
                        <a href="{{ route('maGiamGia.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-discount"></i>
                            <div data-i18n="Analytics">Mã giảm giá</div>
                        </a>
                    </li>
                    <!-- Ảnh bìa -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Ảnh bìa</span></li>
                    <!-- Ảnh bìa -->
                    <li
                        class="menu-item {{ request()->is('anhBias*') || request()->is('anhBias*') ? 'active' : '' }}">
                        <a href="{{ route('anhBias.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-image-alt"></i>
                            <div data-i18n="Analytics">Ảnh bìa</div>
                        </a>
                    </li>
                    <!-- Điểm mua hàng -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Điểm mua hàng</span>
                    </li>
                    <!-- Điểm mua hàng -->
                    <li
                        class="menu-item {{ request()->is('diemMuaHang*') || request()->is('diemMuaHang*') ? 'active' : '' }}">
                        <a href="{{ route('diemMuaHang.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-coin"></i>
                            <div data-i18n="Analytics">Điểm mua hàng</div>
                        </a>
                    </li>
                    <!-- Thống kê -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Thống kê</span>
                    </li>
                    <li
                        class="menu-item {{ request()->is('thongKe*') || request()->is('thongKe*') ? 'active' : '' }}">
                        <a href="{{ route('thongKe.index') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-bar-chart-alt-2'></i>
                            <div data-i18n="Vertical Form">Thống kê đơn hàng</div>
                        </a>
                    </li>
                    {{-- <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-detail"></i>
                            <div data-i18n="Form Layouts">Thống kê</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('thongKe.index') }}" class="menu-link">
                                    <div data-i18n="Vertical Form">Thống kê đơn hàng</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="form-layouts-horizontal.html" class="menu-link">
                                    <div data-i18n="Horizontal Form">Horizontal Form</div>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    <!-- Đăng xuất -->
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Đăng xuất</span>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('logout') }}">
                            <i class="menu-icon tf-icons bx bx-power-off"></i>
                            <div>Đăng xuất</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        {{-- <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none"
                                    placeholder="Search..." aria-label="Search..." />
                            </div>
                        </div> --}}
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            {{-- <li class="nav-item lh-1 me-3">
                                <a class="github-button"
                                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                                    data-icon="octicon-star" data-size="large" data-show-count="true"
                                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
                            </li> --}}

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        @if (Auth::user()->phan_loai_tai_khoan == 1)
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        @endif
                                        @if (Auth::user()->phan_loai_tai_khoan != 1)
                                            <img src="{{ asset('storage') .'/' .Auth::user()->hinhAnhs()->first()->duong_dan }}"
                                                alt class="w-px-40 h-auto rounded-circle" alt="User Image">
                                        @endif
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        @if (Auth::user()->phan_loai_tai_khoan == 1)
                                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                                                class="w-px-40 h-auto rounded-circle" />
                                                        @endif
                                                        @if (Auth::user()->phan_loai_tai_khoan != 1)
                                                            <img src="{{ asset('storage') .'/' .Auth::user()->hinhAnhs()->first()->duong_dan }}"
                                                                alt class="w-px-40 h-auto rounded-circle"
                                                                alt="User Image">
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- <div class="info">
                                                    <a href="{{ route('taiKhoan.maneger', ['id' => Auth::user()->id]) }}"
                                                        class="d-block">
                                                        @if (Auth::check())
                                                            {{ Auth::user()->ho_ten }}
                                                        @endif
                                                    </a>
                                                </div> --}}
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">
                                                        @if (Auth::check())
                                                            {{ Auth::user()->ho_ten }}
                                                        @endif
                                                    </span>
                                                    <small class="text-muted">
                                                        @if (Auth::check())
                                                            @if (Auth::user()->phan_loai_tai_khoan == 1)
                                                                Supper Admin
                                                            @endif
                                                            @if (Auth::user()->phan_loai_tai_khoan == 2)
                                                                Admin
                                                            @endif
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        {{-- <div class="dropdown-divider"></div> --}}
                                        {{-- </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle">Billing</span>
                                                <span
                                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <form id="frm-logout" action="{{ route('logout') }}" method="POST">
                                            {{ csrf_field() }}

                                            <button type="submit" class="dropdown-item">
                                                <i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">Đăng xuất</span>
                                            </button>
                                        </form>
                                    </li> --}}
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->
