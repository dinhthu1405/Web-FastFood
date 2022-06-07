@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang chi tiết điểm mua hàng')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh sách</span></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    {{-- <a href="{{ route('anhBias.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            điểm mua hàng</button></a> --}}
                </div>
            </div>
            <form action="{{ route('monAn.search') }}" method="post">
                {{ csrf_field() }}
                <label>Tìm kiếm</label>
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" type="search" name="search" required />
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="form-control btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <br />
            <!-- Bootstrap Table with Header - Light -->
            <div class="card">
                <h5 class="card-header">Danh sách điểm mua hàng</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Số điểm</th>
                                <th>Người dùng</th>
                                <th>Tổng đơn hàng</th>
                                <th>Chi tiết</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <?php $count = 1;
                        $countDetail = 1; ?>
                        @foreach ($lstDiemMuaHang as $diemMuaHang)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        @if ($diemMuaHang->count('user_id') > 0)
                                            <strong>{{ $diemMuaHang->sum('so_diem') }}</strong>
                                        @else
                                            <strong>{{ $diemMuaHang->so_diem }}</strong>
                                        @endif

                                    </td>
                                    @foreach ($lstTaiKhoan as $taiKhoan)
                                        @if ($diemMuaHang->user_id == $taiKhoan->id)
                                            <td>{{ $taiKhoan->email }}</td>
                                        @endif
                                    @endforeach
                                    @foreach ($lstDonHang as $donHang)
                                        @if ($diemMuaHang->don_hang_id == $donHang->id && $diemMuaHang->user_id == $donHang->user_id)
                                            <td>{{ $diemMuaHang->donHangs->count('id') }}</td>
                                        @endif
                                    @endforeach
                                    <div class="modal fade" id="modalCenter-Detail" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle">Chi tiết đơn hàng
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <strong>STT</strong>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <strong>Mã đơn hàng</strong>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <strong>Thời gian</strong>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <strong>Tổng tiền</strong>
                                                        </div>
                                                    </div>
                                                    @foreach ($lstDonHang as $donHang)
                                                        @if ($diemMuaHang->don_hang_id == $donHang->id && $diemMuaHang->user_id == $donHang->user_id)
                                                            <div class="row">
                                                                <div class="col-md-1">
                                                                    {{ $countDetail++ }}
                                                                </div>
                                                                <div class="col-md-3">
                                                                    {{ $donHang->id }}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    {{ $donHang->ngay_lap_dh }}
                                                                </div>
                                                                <div class="col-md-4">
                                                                    {{ number_format($donHang->tong_tien) }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <td>
                                        <button type="button" id="btn-detail" class="btn btn-info py-2 mb-4"
                                            data-target="#modal-detail" data-bs-toggle="modal"
                                            data-bs-target="#modalCenter-Detail">
                                            <i class="bx bx-edit-alt me-1"></i> </button>
                                    </td>
                                    <td> <a href="{{ route('diemMuaHang.xoa', $diemMuaHang->id) }}"
                                            onclick="return confirm('Bạn có chắc muốn xoá điểm mua hàng này')"><button
                                                type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                data-target="#modal-edit" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-trash me-1"></i> </button></a></td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
        @endsection
