@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí tài khoản')
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

                    @if (Auth::user()->phan_loai_tai_khoan == 1)
                        <a href="{{ route('taiKhoan.create') }}"><button type="button"
                                class="btn btn-success py-2 mb-4">Thêm
                                tài khoản</button></a>
                    @else
                        <div></div>
                    @endif

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
                <h5 class="card-header">Danh sách tài khoản</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Email</th>
                                <th>Hình ảnh</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th>Loại tài khoản</th>
                                <th>Chỉnh sửa</th>
                                <th>Khoá - Mở</th>
                            </tr>
                        </thead>
                        <?php $count = 1; ?>
                        @foreach ($lstTaiKhoan as $taiKhoan)
                            @if ($taiKhoan->trang_thai == 0 && $taiKhoan->phan_loai_tai_khoan != 1)
                                <tbody class="table-border-bottom-0" style="background-color: #ECEEF1">
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $taiKhoan->email }}</strong>
                                        </td>
                                        @foreach ($lstHinhAnh as $hinhAnh)
                                            @if ($taiKhoan->id == $hinhAnh->user_id)
                                                <td><img style=" vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;"
                                                        src="{{ asset("storage/$hinhAnh->duong_dan") }}" alt=""></td>
                                            @endif
                                        @endforeach
                                        <td>{{ $taiKhoan->ho_ten }}</td>
                                        <td>{{ $taiKhoan->sdt }}</td>
                                        <td>{{ $taiKhoan->ngay_sinh }}</td>
                                        <td>{{ $taiKhoan->dia_chi }}</td>
                                        @if ($taiKhoan->phan_loai_tai_khoan == 2)
                                            <td>Quản lí</td>
                                        @endif
                                        @if ($taiKhoan->phan_loai_tai_khoan == 3)
                                            <td>Người giao hàng</td>
                                        @endif
                                        @if ($taiKhoan->phan_loai_tai_khoan == 0)
                                            <td>Người dùng</td>
                                        @endif
                                        <td><a href="{{ route('taiKhoan.edit', $taiKhoan->id) }}"><button type="button"
                                                    id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                        @if ($taiKhoan->phan_loai_tai_khoan == 1)
                                            <td></td>
                                        @else
                                            <td> <a href="{{ route('taiKhoan.khoa_mo', $taiKhoan->id) }}"
                                                    onclick="return confirm('Bạn có chắc muốn mở khóa tài khoản này')"><button
                                                        type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                        data-target="#modal-edit" data-bs-toggle="modal"
                                                        data-bs-target="#modalCenter-Edit">
                                                        <i class="bx bx-trash me-1"></i> </button></a></td>
                                        @endif
                                    </tr>
                                </tbody>
                            @elseif ($taiKhoan->trang_thai == 1 && $taiKhoan->phan_loai_tai_khoan != 1)
                                <tbody class="table-border-bottom-0">

                                    <td> {{ $count++ }} </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $taiKhoan->email }}</strong>
                                    </td>
                                    {{-- @if ($taiKhoan->id == $taiKhoan->hinhAnh->user_id)
                            @foreach ($lstHinhAnh as $hinhAnh)
                            <td><img style=" vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;" src="{{ asset("storage/$hinhAnh->duong_dan") }}" alt=""></td>
                            @endforeach
                            <td><img style=" vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;" src="{{ asset("storage/$taiKhoan->hinhAnh->duong_dan") }}" alt=""></td>
                            @else
                            <td><img style=" vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;" src="{{ asset("storage/17.jpg") }}" alt=""></td>
                            @endif --}}
                                    @foreach ($lstHinhAnh as $hinhAnh)
                                        @if ($taiKhoan->id == $hinhAnh->user_id && $hinhAnh->trang_thai == 1)
                                            <td><img style=" vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;"
                                                    src="{{ asset("storage/$hinhAnh->duong_dan") }}" alt=""></td>
                                        @endif
                                    @endforeach

                                    <td>{{ $taiKhoan->ho_ten }}</td>
                                    <td>{{ $taiKhoan->sdt }}</td>
                                    <td>{{ $taiKhoan->ngay_sinh }}</td>
                                    <td>{{ $taiKhoan->dia_chi }}</td>
                                    @if ($taiKhoan->phan_loai_tai_khoan == 2)
                                        <td>Quản lí</td>
                                    @endif
                                    @if ($taiKhoan->phan_loai_tai_khoan == 3)
                                        <td>Người giao hàng</td>
                                    @endif
                                    @if ($taiKhoan->phan_loai_tai_khoan == 0)
                                        <td>Người dùng</td>
                                    @endif
                                    @if (Auth::user()->phan_loai_tai_khoan == 1)
                                        <td><a href="{{ route('taiKhoan.edit', $taiKhoan->id) }}"><button type="button"
                                                    id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                        <td> <a href="{{ route('taiKhoan.khoa_mo', $taiKhoan->id) }}"
                                                onclick="return confirm('Bạn có chắc muốn khóa tài khoản này, vì nó sẽ ảnh hưởng đến đơn hàng; đánh giá; bình luận và điểm mua hàng ')"><button
                                                    type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-trash me-1"></i> </button></a></td>
                                    @endif

                                    @if (Auth::user()->phan_loai_tai_khoan == 2)
                                        @if ($taiKhoan->phan_loai_tai_khoan == 2)
                                            <td></td>
                                            <td></td>
                                        @else
                                            <td><a href="{{ route('taiKhoan.edit', $taiKhoan->id) }}"><button
                                                        type="button" id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                        data-target="#modal-edit" data-bs-toggle="modal"
                                                        data-bs-target="#modalCenter-Edit">
                                                        <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                            <td> <a href="{{ route('taiKhoan.khoa_mo', $taiKhoan->id) }}"
                                                    onclick="return confirm('Bạn có chắc muốn khóa tài khoản này')"><button
                                                        type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                        data-target="#modal-edit" data-bs-toggle="modal"
                                                        data-bs-target="#modalCenter-Edit">
                                                        <i class="bx bx-trash me-1"></i> </button></a></td>
                                        @endif
                                    @endif
                                </tbody>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
        @endsection
