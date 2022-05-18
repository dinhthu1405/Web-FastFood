@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí loại món ăn')
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
                <a href="{{ route('loaiMonAn.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                        loại món ăn</button></a>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <h5 class="card-header">Danh sách loại món ăn</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Tên loại</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    @foreach ($lstLoaiMonAn as $loaiMonAn)
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $loaiMonAn->ten_loai }}</strong>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('loaiMonAn.edit', $loaiMonAn->id) }}"><i class="bx bx-edit-alt me-1"></i> Chỉnh sửa</a>
                                        <a class="dropdown-item" href="{{ route('loaiMonAn.xoa', $loaiMonAn->id) }}" onclick="return confirm('Bạn có chắc muốn xoá loại món ăn này, vì nó có thể ảnh hưởng đến món ăn')"><i class="bx bx-trash me-1"></i> Xoá</a>
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