@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí điểm mua hàng')
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
                <h5 class="card-header">Danh sách ảnh bìa</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Số điểm</th>
                                <th>Người dùng</th>
                                <th>Hóa đơn</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <?php $count = 1; ?>
                        @foreach ($lstDiemMuaHang as $diemMuaHang)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $diemMuaHang->so_diem }}</strong>
                                    </td>
                                    @foreach ($lstTaiKhoan as $taiKhoan)
                                        @if ($diemMuaHang->user_id == $taiKhoan->id)
                                            <td>{{ $taiKhoan->email }}</td>
                                        @endif
                                    @endforeach
                                    @foreach ($lstDonHang as $donHang)
                                        @if ($diemMuaHang->don_hang_id == $donHang->id)
                                            <td>{{ $donHang->id }}</td>
                                        @endif
                                    @endforeach
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
