@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí đơn hàng')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('donHang.index') }}"><span
                                class="text-muted fw-light">Danh sách</span></a></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                </div>
            </div>
            <form action="{{ route('donHang.searchDonHang') }}" method="GET">
                <label>Tìm kiếm</label>
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" type="search" name="search" required
                            value="{{ request('search') }}" />
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="form-control btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <br />
            <!-- Bootstrap Table with Header - Light -->
            <div class="card">
                <h5 class="card-header">Danh sách đơn hàng</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Ngày lập</th>
                                <th>Tổng tiền</th>
                                <th>Người giao hàng</th>
                                <th>Người đặt</th>
                                <th>Địa chỉ</th>
                                <th>Phương thức</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết</th>
                                <th>Chỉnh sửa</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <?php $count = $lstDonHang->perPage() * ($lstDonHang->currentPage() - 1) + 1; ?>
                        @foreach ($lstDonHang as $donHang)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td>
                                        {{ date('d-m-Y H:i:s', strtotime($donHang->ngay_lap_dh)) }}
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
                                    <td> @switch($donHang->trang_thai_don_hang_id)
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
                                    <td><a href="{{ route('donHang.show', $donHang->id) }}"><button type="button"
                                                id="btn-edit" class="btn btn-info py-2 mb-4" data-target="#modal-edit"
                                                data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                    <td><a href="{{ route('donHang.edit', $donHang->id) }}"><button type="button"
                                                id="btn-edit" class="btn btn-warning py-2 mb-4" data-target="#modal-edit"
                                                data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                    <td> <a href="{{ route('donHang.xoa', $donHang->id) }}"
                                            onclick="return confirm('Bạn có chắc muốn xoá món ăn này')"><button
                                                type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                data-target="#modal-edit" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-trash me-1"></i> </button></a></td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    @if ($lstDonHang->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstDonHang->appends($request->except('page'))->links() }}
                                        </ul>
                                    </nav>
                                    <!--/ Basic Pagination -->
                                </div>
                            </div>
                        </div>
                    @else
                    @endif
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
        @endsection
