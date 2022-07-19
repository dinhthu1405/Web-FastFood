@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí sửa đánh giá')
@section('content')
<!-- Form controls -->
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4>
        <form action="{{ route('danhGia.store') }}" method="post" enctype="multipart/form-data">
            {!! @csrf_field() !!}
            @if (Session::has('success'))
            <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
            @endif
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
            @endforeach
            @endif
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Sửa đánh giá</h5>
                    <div class="card-body">
                        <form action="{{ route('danhGia.update', ['danhGium' => $danhGium]) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('PATCH')
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Đánh giá sao</label>
                            <select class="form-select" name="DanhGiaSao" id="exampleFormControlSelect1" aria-label="Default select example">
                                <option selected>{{ $danhGium->danh_gia_sao }}</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nội dung</label>
                            <textarea class="form-control" name="NoiDung" id="" rows="10" placeholder="Nội dung">{{ $danhGium->noi_dung }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Tài khoản</label>
                            <select class="form-select" name="TaiKhoan" id="exampleFormControlSelect1" aria-label="Default select example">
                                <option selected>-- Chọn tài khoản --</option>
                                @foreach ($lstTaiKhoan as $taiKhoan)
                                <option value="{{ $taiKhoan->id }}" @if($taiKhoan->id==$danhGium->user_id) selected @endif>{{ $taiKhoan->email }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Món Ăn</label>
                            <select class="form-select" name="MonAn" id="exampleFormControlSelect1" aria-label="Default select example">
                                <option selected>-- Chọn món ăn --</option>
                                @foreach ($lstMonAn as $monAn)
                                <option value="{{ $monAn->id }}" @if($monAn->id==$danhGium->mon_an_id) selected @endif>{{ $monAn->ten_mon }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Địa điểm</label>
                            <select class="form-select" name="DiaDiem" id="exampleFormControlSelect1" aria-label="Default select example">
                                <option selected>-- Chọn địa điểm --</option>
                                @foreach ($lstDiaDiem as $diaDiem)
                                <option value="{{ $diaDiem->id }}" @if($diaDiem->id==$danhGium->dia_diem_id) selected @endif>{{ $diaDiem->ten_dia_diem }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-5 mb-3">
                                <button type="submit" class="btn btn-success py-2 mb-4">Thêm đánh giá</button>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </form>
                    </div>
    </div>
</div>
@endsection