@extends('layouts.app', ['pageId' => 'xuatfile'])

@section('title', 'Trang in thống kê đơn hàng')
@section('content')
    @include('Partial/thong-ke/CSSPartial-thongke-xuatfilepdf')
    <div class="card">
        {{-- <img src="{{ asset('assets/img/icons/unicons/logo.png') }}" alt="" style="width: 10%"> --}}
        {{-- <img src="{{ '/../assets/img/icons/unicons/logo.png' }}" alt="" style="width: 10%"> --}}
        <div id="watermark">
            <img src="{{ public_path('assets/img/favicon/favicon.ico') }}" alt="" style="width: 6%">
        </div>
        <div class="TieuDeCongHoaDocLap">
            <span class="TieuDeCongHoa">
                CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM
            </span>
            <p class="TieuDeDocLap">
                Độc lập - Tự do - Hạnh phúc
            </p>
            <p class="GachNgang1">----------------------</p>
        </div>

        <div class="TieuDe">
            <div class="col-sm-6 invoice-amounts">
                <span class="ten_cua_hang">FASTFOOD</span>
                <p class="GachNgang2">---------------</p>
                <p class="TieuDeLienHe">- Liên hệ: 028 3821 2360</p>
                <p class="TieuDeWebsite">- Website: https://caothang.edu.vn</p>
                <p class="TieuDeDiaChi">- Địa chỉ: 65 Đ. Huỳnh Thúc Kháng, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh</p>
            </div>
        </div>
        <h2 class="card-header">Danh sách đơn hàng</h2>
        @if ($thongKe == 1)
            <div class="TuNgay_DenNgay">
                <span id="tu_ngay">Từ ngày: {{ date('d-m-Y', strtotime($tu_ngay)) }}</span>
                <span id="den_ngay">Đến ngày: {{ date('d-m-Y', strtotime($den_ngay)) }}</span>
            </div>
            <div class="Nguoi_Ngay">
                @if (Auth::user()->phan_loai_tai_khoan == 1)
                    <span class="NguoiLap">Người lập: Tổng quản lí</span>
                @else
                    <span class="NguoiLap">Người lập: {{ Auth::user()->ho_ten }}</span>
                @endif
                <span class="NgayLap">Ngày lập: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
            </div>
            <div class="DonViTien">
                <span>Đơn vị tiền tệ: Việt Nam Đồng</span>
            </div>
        @else
            <div class="Nguoi_Ngay">
                @if (Auth::user()->phan_loai_tai_khoan == 1)
                    <span class="NguoiLap">Người lập: Tổng quản lí</span>
                @else
                    <span class="NguoiLap">Người lập: {{ Auth::user()->ho_ten }}</span>
                @endif
                <span class="NgayLap">Ngày lập: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</span>
            </div>
        @endif
        <div class="table-responsive text-nowrap">
            <table class="table" id="bo_vien">
                <thead class="table-light">
                    <tr id="color-th">
                        <th>STT</th>
                        <th>Ngày lập</th>
                        <th>Tổng tiền</th>
                        <th>Người giao hàng</th>
                        <th>Người đặt</th>
                        <th>Địa chỉ</th>
                        <th>Phương thức</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <?php $count = 1; ?>
                @foreach ($lstDonHang as $donHang)
                    {{-- <tbody class="table-border-bottom-0"> --}}
                    <tbody>
                        <tr>
                            <td> {{ $count++ }} </td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                {{ date('d-m-Y', strtotime($donHang->ngay_lap_dh)) }}
                            </td>
                            <td>{{ number_format($donHang->tong_tien) }}</td>
                            @foreach ($lstTaiKhoan as $taiKhoan)
                                @if ($donHang->nguoi_giao_hang_id == $taiKhoan->id)
                                    <td>{{ $taiKhoan->email }}</td>
                                @endif
                            @endforeach
                            @foreach ($lstTaiKhoan as $taiKhoan)
                                @if ($donHang->user_id == $taiKhoan->id)
                                    <td>{{ $taiKhoan->email }}</td>
                                @endif
                            @endforeach
                            <td>{{ $donHang->dia_chi }}</td>
                            <td>{{ $donHang->loai_thanh_toan }}</td>
                            @foreach ($lstTrangThaiDonHang as $trangThaiDonHang)
                                @if ($donHang->trang_thai_don_hang_id == $trangThaiDonHang->id)
                                    <td> @switch($donHang->trang_thai_don_hang_id)
                                            @case(1)
                                                <span
                                                    class="badge bg-label-warning me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span>
                                            @break

                                            @case(2)
                                                <span
                                                    class="badge bg-label-secondary me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span>
                                            @break

                                            @case(3)
                                                <span
                                                    class="badge bg-label-dark me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span>
                                            @break

                                            @case(4)
                                                <span
                                                    class="badge bg-label-warning me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span>
                                            @break

                                            @case(5)
                                                <span
                                                    class="badge bg-label-info me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span>
                                            @break

                                            @case(6)
                                                <span
                                                    class="badge bg-label-primary me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span>
                                            @break

                                            @case(7)
                                                <span
                                                    class="badge bg-label-danger me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span>
                                            @break

                                            @case(8)
                                                <span
                                                    class="badge bg-label-success me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span>
                                            @break

                                            @default
                                                {{ $trangThaiDonHang->ten_trang_thai }}
                                        @endswitch
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection
