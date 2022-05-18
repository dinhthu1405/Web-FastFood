@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí món ăn')
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
                    <a href="{{ route('monAn.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm món
                            ăn</button></a>
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
            <div class="card">
                <h5 class="card-header">Danh sách món ăn</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>Tên món</th>
                                <th>Hình món ăn</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Loại món ăn</th>
                                <th>Địa điểm</th>
                                {{-- <th>Đánh giá</th> --}}
                                <th>Tình trạng</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        @foreach ($lstMonAn as $monAn)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $monAn->ten_mon }}</strong>
                                    </td>
                                    <td><a href="{{ route('monAn.images', $monAn->id) }}" class="btn btn-outline-dark">Xem
                                            hình</a></td>
                                    <td>{{ $monAn->don_gia }}</td>
                                    <td>{{ $monAn->so_luong }}</td>
                                    <td>{{ $monAn->loaiMonAn->ten_loai }}</td>
                                    <td>{{ $monAn->diaDiem->ten_dia_diem }}</td>
                                    @if ($monAn->tinh_trang == 1)
                                        <td>Còn món</td>
                                    @else
                                        <td>Hết món</td>
                                    @endif

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('monAn.edit', $monAn->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Chỉnh sửa</a>
                                                <a class="dropdown-item" href="{{ route('monAn.xoa', $monAn->id) }}"><i
                                                        class="bx bx-trash me-1"></i> Xoá</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
        @endsection
