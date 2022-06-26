@extends('layouts.app', ['pageId' => 'xuatfile'])

@section('title', 'Trang thống kê đơn hàng')
@section('content')
    <div class="card" style="font-family: DejaVu Sans, sans-serif; font-size: 8">
        <h2 class="card-header">Danh sách đơn hàng</h2>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>STT</th>
                        <th>Ngày lập</th>
                        <th>Tổng tiền</th>
                        <th>Người giao hàng</th>
                        <th>Người đặt</th>
                        <th>Địa chỉ hàng</th>
                        <th>Phương thức</th>
                        <th>Trạng thái</th>
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
                                @if ($donHang->nguoi_giao_hang_id == $taiKhoan->id)
                                    <td>{{ $taiKhoan->email }}</td>
                                @endif
                            @endforeach
                            @foreach ($lstTaiKhoan as $taiKhoan)
                                @if ($donHang->user_id == $taiKhoan->id)
                                    <td>{{ $taiKhoan->email }}</td>
                                @endif
                            @endforeach
                            @foreach ($lstTaiKhoan as $taiKhoan)
                                @if ($donHang->user_id == $taiKhoan->id)
                                    <td>{{ $taiKhoan->dia_chi }}</td>
                                @endif
                            @endforeach
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
