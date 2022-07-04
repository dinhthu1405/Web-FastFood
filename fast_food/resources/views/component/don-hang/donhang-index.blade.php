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
            @foreach ($lstDonHang as $donHang)
                @foreach ($lstTaiKhoan as $taiKhoan)
                    @if ($taiKhoan->id == $donHang->nguoi_giao_hang_id)
                        <form action="{{ route('donHang.searchDonHang', $taiKhoan->id) }}" method="GET" id="form-search">
                        @else
                            <form action="{{ route('donHang.searchDonHang', $taiKhoan->id) }}" method="GET"
                                id="form-search">
                    @endif
                @endforeach
            @endforeach
            <div class="row">
                <div class="col-md-4">
                    <label>Tìm kiếm</label>
                    <input class="form-control" type="search" name="search" required value="{{ request('search') }}"
                        id="timKiem" />
                </div>
                <div class="col-md-2">
                    <label for=""></label>
                    <button type="submit" class="form-control btn btn-primary">Tìm kiếm</button>
                </div>
                <div class="col-md-1">
                    <label for=""></label>
                    <button type="button" class="form-control btn btn-info" id="refresh">
                        <i class='bx bx-refresh'></i>
                    </button>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Lọc</label>
                        <select class="form-control" name="LocDonHang" id="loc_don_hang">
                            <option value="macDinh">-Chọn loại muốn lọc-</option>
                            <option value="tienMat" {{ request()->LocDonHang == 'tienMat' ? 'selected' : '' }}>
                                Tiền mặt
                            </option>
                            <option value="the" {{ request()->LocDonHang == 'the' ? 'selected' : '' }}>
                                Thẻ
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">Sắp xếp</label>
                        <select class="form-control" name="SapXep" id="sap_xep_don_hang">
                            <option value="0">-Chọn loại muốn sắp xếp-</option>
                            <option value="moiNhat" {{ request()->SapXep == 'moiNhat' ? 'selected' : '' }}>
                                Mới nhất
                            </option>
                            <option value="ngayLap" {{ request()->SapXep == 'ngayLap' ? 'selected' : '' }}>
                                Ngày lập
                            </option>
                            <option value="tongTien" {{ request()->SapXep == 'tongTien' ? 'selected' : '' }}>
                                Tổng tiền
                            </option>
                            <option value="nguoiGiaoHang" {{ request()->SapXep == 'nguoiGiaoHang' ? 'selected' : '' }}>
                                Người giao hàng
                            </option>
                            <option value="diaChi" {{ request()->SapXep == 'diaChi' ? 'selected' : '' }}>
                                Địa chỉ
                            </option>
                            <option value="phuongThuc" {{ request()->SapXep == 'phuongThuc' ? 'selected' : '' }}>
                                Phương thức
                            </option>
                        </select>
                    </div>
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
                                <th>Mã</th>
                                <th>Ngày lập</th>
                                <th>Tổng tiền</th>
                                <th>Người giao hàng</th>
                                <th>Người đặt</th>
                                <th>Địa chỉ</th>
                                <th>Phương thức</th>
                                <th>Trạng thái</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <?php $count = $lstDonHang->perPage() * ($lstDonHang->currentPage() - 1) + 1; ?>
                        @foreach ($lstDonHang as $donHang)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><a style="color: #697a8d"
                                            href="{{ route('donHang.show', $donHang->id) }}">{{ $donHang->id }}</a>
                                    </td>
                                    <td>
                                        {{ date('d-m-Y H:i:s', strtotime($donHang->ngay_lap_dh)) }}
                                    </td>
                                    <td>{{ number_format($donHang->tong_tien) }}</td>
                                    @foreach ($lstTaiKhoan as $taiKhoan)
                                        @if ($donHang->nguoi_giao_hang_id == $taiKhoan->id)
                                            <td>
                                                <a style="color: #697a8d"
                                                    href="{{ route('taiKhoan.index1', [0, $donHang->nguoi_giao_hang_id]) }}">{{ $taiKhoan->email }}</a>
                                            </td>
                                        @endif
                                    @endforeach
                                    @foreach ($lstTaiKhoan as $taiKhoan)
                                        @if ($donHang->user_id == $taiKhoan->id)
                                            <td>
                                                <a style="color: #697a8d"
                                                    href="{{ route('taiKhoan.index1', [$donHang->user_id, 0]) }}">{{ $taiKhoan->email }}</a>
                                            </td>
                                        @endif
                                    @endforeach
                                    <td data-target="#modal-add" data-bs-toggle="modal"
                                        data-bs-target='#modalCenter{{ $donHang->id }}'>{{ $donHang->dia_chi }}</td>
                                    <div class="modal fade" id="modalCenter{{ $donHang->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle">Địa chỉ</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">{{ $donHang->dia_chi }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <td>{{ $donHang->loai_thanh_toan }}</td>
                                    <td> @switch($donHang->trang_thai_don_hang_id)
                                            @case(1)
                                                <a
                                                    href="{{ route('trangThaiDonHang.index1', $donHang->trang_thai_don_hang_id) }}"><span
                                                        class="badge bg-label-warning me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span></a>
                                            @break

                                            @case(2)
                                                <a
                                                    href="{{ route('trangThaiDonHang.index1', $donHang->trang_thai_don_hang_id) }}"><span
                                                        class="badge bg-label-secondary me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span></a>
                                            @break

                                            @case(3)
                                                <a
                                                    href="{{ route('trangThaiDonHang.index1', $donHang->trang_thai_don_hang_id) }}"><span
                                                        class="badge bg-label-dark me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span></a>
                                            @break

                                            @case(4)
                                                <a
                                                    href="{{ route('trangThaiDonHang.index1', $donHang->trang_thai_don_hang_id) }}"><span
                                                        class="badge bg-label-warning me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span></a>
                                            @break

                                            @case(5)
                                                <a
                                                    href="{{ route('trangThaiDonHang.index1', $donHang->trang_thai_don_hang_id) }}"><span
                                                        class="badge bg-label-info me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span></a>
                                            @break

                                            @case(6)
                                                <a
                                                    href="{{ route('trangThaiDonHang.index1', $donHang->trang_thai_don_hang_id) }}"><span
                                                        class="badge bg-label-primary me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span></a>
                                            @break

                                            @case(7)
                                                <a
                                                    href="{{ route('trangThaiDonHang.index1', $donHang->trang_thai_don_hang_id) }}"><span
                                                        class="badge bg-label-danger me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span></a>
                                            @break

                                            @case(8)
                                                <a
                                                    href="{{ route('trangThaiDonHang.index1', $donHang->trang_thai_don_hang_id) }}"><span
                                                        class="badge bg-label-success me-1">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</span></a>
                                            @break

                                            @default
                                                <a
                                                    href="{{ route('trangThaiDonHang.index1', $donHang->trang_thai_don_hang_id) }}">{{ $donHang->trangThaiDonHang->ten_trang_thai }}</a>
                                        @endswitch
                                    </td>
                                    {{-- <td><a href="{{ route('donHang.show', $donHang->id) }}"><button type="button"
                                                id="btn-edit" class="btn btn-info py-2 mb-4" data-target="#modal-edit"
                                                data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-edit-alt me-1"></i> </button></a> </td> --}}
                                    {{-- <td><a href="{{ route('donHang.edit', $donHang->id) }}"><button type="button"
                                                id="btn-edit" class="btn btn-warning py-2 mb-4" data-target="#modal-edit"
                                                data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-edit-alt me-1"></i> </button></a> </td> --}}
                                    <td><button type="button" id="btn-delete" class="btn btn-danger py-2 mb-4"
                                            data-target="#modal-delete" data-bs-toggle="modal"
                                            data-bs-target="#modalCenter-Delete">
                                            <i class="bx bx-trash me-1"></i> </button></td>
                                    <!-- Modal Cảnh báo -->
                                    <div class="modal fade" id="modalCenter-Delete" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                @if (Session::has('success'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ Session::get('success') }}
                                                    </div>
                                                @endif
                                                @if (Session::has('error'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ Session::get('error') }}</div>
                                                @endif
                                                @if ($errors->any())
                                                    @foreach ($errors->all() as $error)
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ $error }}
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="mb-3" style="text-align: center">
                                                            <img src="{{ asset('assets/img/icons/unicons/!.png') }}"
                                                                alt="" width="180px" height="75px">
                                                        </div>
                                                        <div class="mb3 text-nowrap" style="text-align: center">
                                                            <span style="font-size: 22px">
                                                                Bạn có chắc muốn xoá đơn hàng này
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" style="padding: 3%">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-2">
                                                        <a href="{{ route('donHang.xoa', $donHang->id) }}"><button
                                                                type="submit" class="btn btn-danger btn-delete-confirm"
                                                                data-bs-dismiss="modal">Xoá</button></a>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" value="delete"
                                                            class="btn btn-primary btn-delete-close">Huỷ</button>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                            {{ $lstDonHang->appends($request->except('page'))->onEachSide(1)->links() }}
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
            @include('Partial/don-hang/JSPartial-donhang-index')
        @endsection
