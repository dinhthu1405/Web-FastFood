<!DOCTYPE html>
<html>

<head>
    <title>Danh sách đơn hàng</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    @include('Partial/thong-ke/CSSPartial-thongke-xuatfileexcel')
</head>

<body>
    {{-- Tạo khoảng cách so với logo --}}
    @for ($i = 1; $i <= 13; $i++)
        <h5></h5>
    @endfor
    <div class="row">
        <table class="table">
            <thead>
                <tr>
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
                        <td> {{ $count++ }}
                        </td>
                        <td>
                            {{ date('d/m/Y H:i:s', strtotime($donHang->ngay_lap_dh)) }}
                        </td>
                        <td>
                            {{ $donHang->tong_tien }}</td>
                        @foreach ($lstTaiKhoan as $taiKhoan)
                            @if ($donHang->nguoi_giao_hang_id == $taiKhoan->id)
                                <td>
                                    {{ $taiKhoan->email }}</td>
                            @endif
                        @endforeach
                        @foreach ($lstTaiKhoan as $taiKhoan)
                            @if ($donHang->user_id == $taiKhoan->id)
                                <td>
                                    {{ $taiKhoan->email }}</td>
                            @endif
                        @endforeach
                        <td>{{ $donHang->dia_chi }}</td>

                        <td>
                            {{ $donHang->loai_thanh_toan }}</td>
                        @foreach ($lstTrangThaiDonHang as $trangThaiDonHang)
                            @if ($donHang->trang_thai_don_hang_id == $trangThaiDonHang->id)
                                <td>
                                    @switch($donHang->trang_thai_don_hang_id)
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
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>

</html>
