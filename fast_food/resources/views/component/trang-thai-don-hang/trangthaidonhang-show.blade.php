@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí trạng thái đơn hàng')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <a href="{{ route('trangThaiDonHang.create') }}"><button type="button"
                            class="btn btn-success py-2 mb-4">Thêm
                            Trạng Thái Đơn Hàng</button></a>
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
                <h5 class="card-header">Danh sách trạng thái đơn hàng</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên trạng thái</th>
                                <th>Chỉnh sửa</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <?php $count = 1; ?>
                        @foreach ($lstTrangThaiDonHang as $trangThaiDonHang)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $trangThaiDonHang->ten_trang_thai }}</strong>
                                    </td>
                                    <td><a href="{{ route('trangThaiDonHang.edit', $trangThaiDonHang->id) }}"><button
                                                type="button" id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                data-target="#modal-edit" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                    <td> <a href="{{ route('trangThaiDonHang.xoa', $trangThaiDonHang->id) }}"
                                            onclick="return confirm('Bạn có chắc muốn xoá trạng thái đơn hàng này')"><button
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
