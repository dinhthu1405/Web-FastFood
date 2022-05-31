@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí đơn hàng')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <a href="{{ route('monAn.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            đơn hàng</button></a>
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
                <h5 class="card-header">Danh sách đơn hàng</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Ngày lập đơn hàng</th>
                                <th>Tổng tiền</th>                                
                                <th>Người giao hàng</th>
                                <th>Người đặt</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Chi tiết</th>
                                <th>Chỉnh sửa</th>
                                <th>Xoá</th>
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
                                    <td>{{ $donHang->tong_tien }}</td>                                    
                                    @foreach ($lstTaiKhoan as $taiKhoan)
                                    @if($donHang->nguoi_giao_hang_id == $taiKhoan->id )
                                    
                                    <td>{{ $taiKhoan->email }}</td>                                                                
                                @endif
                                    @endforeach
                                    @foreach ($lstTaiKhoan as $taiKhoan)
                                    @if($donHang->user_id == $taiKhoan->id )
                                    
                                    <td>{{ $taiKhoan->email }}</td>                                                                
                                @endif
                                    @endforeach                                 
                                    <td>{{ $donHang->trangThaiDonHang->ten_trang_thai }}</td>
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
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
        @endsection