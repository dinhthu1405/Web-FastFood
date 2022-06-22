@extends('layouts.app', ['pageId' => ''])
@section('title', 'Trang chủ')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                    {{-- <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                                    <p class="mb-4">
                                        You have done <span class="fw-bold">72%</span> more sales today.
                                        Check your new badge in
                                        your profile.
                                    </p>

                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary">View
                                        Badges</a>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                        alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-4 col-md-4 order-1">

                </div>
                <!-- Trạng thái đơn hàng trong ngày -->
                <div class="col-12 col-lg-4 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card h-100" id="refresh-statis">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Trạng thái đơn hàng trong ngày</h5>
                                <h4 class="text-muted">Tổng tiền: {{ number_format($tongTien) }} đ</h4>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                    <a class="dropdown-item" href="{{ route('donHang.index') }}">Tất cả dữ liệu</a>
                                    <button class="dropdown-item" id="btn_fresh" onclick="refreshDiv();">Refresh</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-column align-items-center gap-1">
                                    <h2 class="mb-2">{{ number_format($tongDonHang) }}</h2>
                                    <span>Tổng đơn hàng</span>
                                </div>
                                <div id="orderStatisticsChart1"></div>
                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="bx bx-mobile-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Chờ xác nhận</h6>
                                            <small class="text-muted">Mobile, Earbuds, TV</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $choXacNhan }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-success"><i
                                                class="bx bx-closet"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Xác nhận giao</h6>
                                            <small class="text-muted">T-shirt, Jeans, Shoes</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $xacNhanGiao }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i
                                                class="bx bx-home-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Chờ giao</h6>
                                            <small class="text-muted">Fine Art, Dining</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $choGiao }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i
                                                class="bx bx-home-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Đang giao</h6>
                                            <small class="text-muted">Fine Art, Dining</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $dangGiao }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i
                                                class="bx bx-home-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Đã nhận</h6>
                                            <small class="text-muted">Fine Art, Dining</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $daNhan }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i
                                                class="bx bx-home-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Xác nhận đã giao</h6>
                                            <small class="text-muted">Fine Art, Dining</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $xacNhanDaGiao }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i
                                                class="bx bx-home-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Đơn hàng boom</h6>
                                            <small class="text-muted">Fine Art, Dining</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $donHangBoom }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i
                                                class="bx bx-home-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Hoàn thành</h6>
                                            <small class="text-muted">Fine Art, Dining</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $hoanThanh }}</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-8 order-3 order-md-2">
                    <div class="row">
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card"
                                                class="rounded" />
                                        </div>
                                        {{-- <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                <a class="dropdown-item" href="javascript:void(0);">View
                                                    More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <span class="d-block mb-1">Thẻ tín dụng</span>
                                    @if ($hinhThucThanhToanThe > 0)
                                        <h3 class="card-title mb-2">{{ number_format($hinhThucThanhToanThe) }} đ
                                        </h3>
                                    @else
                                        <h3 class="card-title mb-2">0 đ
                                        </h3>
                                    @endif
                                    </h3>
                                    {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i>
                                        -14.82%</small> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                                class="rounded" />
                                        </div>
                                        {{-- <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="javascript:void(0);">View
                                                    More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Tiền mặt</span>
                                    @if ($hinhThucThanhToanTienMat > 0)
                                        <h3 class="card-title mb-2">{{ number_format($hinhThucThanhToanTienMat) }} đ
                                        </h3>
                                    @else
                                        <h3 class="card-title mb-2">0 đ
                                        </h3>
                                    @endif
                                    {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                        +28.14%</small> --}}
                                </div>
                            </div>
                        </div>
                        <!-- </div>
                                                                                                                                                                                                                      <div class="row"> -->
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                        <div
                                            class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                            <div class="card-title">
                                                <h5 class="text-nowrap mb-2">Profile Report</h5>
                                                <span class="badge bg-label-warning rounded-pill">Year
                                                    2021</span>
                                            </div>
                                            <div class="mt-sm-auto">
                                                <small class="text-success text-nowrap fw-semibold"><i
                                                        class="bx bx-chevron-up"></i> 68.2%</small>
                                                <h3 class="mb-0">$84,686k</h3>
                                            </div>
                                        </div>
                                        <div id="profileReportChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                            <div class="content-wrapper">
                                <!-- Content -->

                                <!-- Bootstrap Table with Header - Light -->
                                <div class="card h-100">
                                    <h5 class="card-header">Danh sách đơn hàng mới nhất</h5>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Ngày lập đơn hàng</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Người đặt</th>
                                                    <th>Trạng thái đơn hàng</th>
                                                </tr>
                                            </thead>
                                            <?php $count = 1; ?>
                                            @foreach ($lstDonHang as $donHang)
                                                <tbody class="table-border-bottom-0">
                                                    <tr>
                                                        <td> {{ $count++ }} </td>
                                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                            {{ date('d-m-Y', strtotime($donHang->ngay_lap_dh)) }}
                                                        </td>
                                                        <td>{{ number_format($donHang->tong_tien) }}</td>
                                                        @foreach ($lstTaiKhoan as $taiKhoan)
                                                            @if ($donHang->user_id == $taiKhoan->id)
                                                                <td>{{ $taiKhoan->email }}</td>
                                                            @endif
                                                        @endforeach
                                                        <td>
                                                            @switch($donHang->trang_thai_don_hang_id)
                                                                @case(1)
                                                                    <span
                                                                        class="badge bg-label-warning me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span>
                                                                @break

                                                                @case(2)
                                                                    <span
                                                                        class="badge bg-label-secondary me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span>
                                                                @break

                                                                @case(3)
                                                                    <span
                                                                        class="badge bg-label-dark me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span>
                                                                @break

                                                                @case(4)
                                                                    <span
                                                                        class="badge bg-label-warning me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span>
                                                                @break

                                                                @case(5)
                                                                    <span
                                                                        class="badge bg-label-info me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span>
                                                                @break

                                                                @case(6)
                                                                    <span
                                                                        class="badge bg-label-primary me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span>
                                                                @break

                                                                @case(7)
                                                                    <span
                                                                        class="badge bg-label-danger me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span>
                                                                @break

                                                                @case(8)
                                                                    <span
                                                                        class="badge bg-label-success me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span>
                                                                @break

                                                                @default
                                                                    {{ $donHang->trangThaiDonHang->ten_trang_thai }}
                                                            @endswitch
                                                        </td>
                                                        {{-- <td><span class="badge bg-label-info me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span></td> --}}
                                                    </tr>
                                                </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- / Content -->
            @include('Partial/home/JSPartial-home')
        @endsection
