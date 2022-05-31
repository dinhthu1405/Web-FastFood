@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí sửa bình luận')
@section('content')
    <!-- Form controls -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4>
            <form action="{{ route('binhLuan.update') }}" method="post" enctype="multipart/form-data">
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
                        <h5 class="card-header">Sửa bình luận</h5>
                        <div class="card-body">
                            <form action="{{ route('binhLuan.update', ['binhLuan' => $id]) }}" method="post"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @method('PATCH')
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Nội dung</label>
                                    <textarea class="form-control" name="NoiDung" id="" rows="10"
                                        placeholder="Nội dung">{{ $binhLuan->noi_dung }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Tài khoản</label>
                                        <select class="form-select" name="TaiKhoan" id="exampleFormControlSelect1"
                                            aria-label="Default select example">
                                            <option selected>-- Chọn tài khoản --</option>
                                            @foreach ($lstTaiKhoan as $taiKhoan)
                                                <option value="{{ $taiKhoan->id }}"
                                                    @if ($taiKhoan->id == $binhLuan->user_id) selected @endif>
                                                    {{ $taiKhoan->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Món Ăn</label>
                                        <select class="form-select" name="MonAn" id="exampleFormControlSelect1"
                                            aria-label="Default select example">
                                            <option selected>-- Chọn món ăn --</option>
                                            @foreach ($lstMonAn as $monAn)
                                                <option value="{{ $monAn->id }}"
                                                    @if ($monAn->id == $binhLuan->mon_an_id) selected @endif>
                                                    {{ $monAn->ten_mon }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="html5-time-input" class="form-label">Thời gian</label>
                                            <div class="col-md-12">
                                                <input class="form-control" name="ThoiGian" type="datetime-local" value=""
                                                    id="html5-time-input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-5 mb-3">
                                        <button type="submit" class="btn btn-success py-2 mb-4">Sửa bình luận</button>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endsection
