@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí địa điểm')
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
                <a href="{{ route('diaDiem.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                        địa điểm</button></a>
            </div>
        </div>
        <form action="{{ route('diaDiem.search') }}" method="post">
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
            <h5 class="card-header">Danh sách địa điểm</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên địa điểm</th>
                            <th>Thời gian mở</th>
                            <th>Thời gian đóng</th>
                            <th>Sửa</th>
                            <th>Xoá</th>
                        </tr>
                    </thead>
                    <?php $count = 1; ?>
                    @foreach ($lstDiaDiem as $diaDiem)
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td> {{$count++}} </td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $diaDiem->ten_dia_diem }}</strong>
                            </td>
                            <td>{{ $diaDiem->thoi_gian_mo }}</td>
                            <td>{{ $diaDiem->thoi_gian_dong }}</td>
                            <td> <a class="dropdown-item" href="{{ route('diaDiem.edit', $diaDiem->id) }}"><i class="bx bx-edit-alt me-1"></i></a></td>
                            <td> <a class="dropdown-item" href="{{ route('diaDiem.xoa', $diaDiem->id) }}" onclick="return confirm('Bạn có chắc muốn xoá địa điểm này, vì nó có thể ảnh hưởng đến món ăn')"><i class="bx bx-trash me-1"></i></a></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
        @endsection