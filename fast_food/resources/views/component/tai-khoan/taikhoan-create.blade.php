@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang thêm tài khoản')
@section('content')
<!-- Form controls -->
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4>
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
                <h5 class="card-header">Thêm tài khoản</h5>
                <div class="card-body">
                    <form action="{{ route('taiKhoan.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input type="email" name="Email" class="form-control" id="exampleFormControlInput1" placeholder="Email" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Mật khẩu</label>
                            <input type="password" name="MatKhau" class="form-control" id="exampleFormControlInput1" placeholder="Mật khẩu" />
                        </div>
                    </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" name="images" accept="image/*" onchange="loadFile(event)" id="images" placeholder="Hình ảnh" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Xem trước hình</label>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="user-image col-md-6 text-center">
                                    <img id="preview-image" src="{{ asset('assets/img/khongxacdinh.jpg') }}" alt="preview image" style="max-height: 200px;">
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Họ tên</label>
                            <input type="text" name="HoTen" class="form-control" id="exampleFormControlInput1" placeholder="Họ tên" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Số điện thoại</label>
                            <input type="text" name="SDT" class="form-control" id="exampleFormControlInput1" placeholder="Số điện thoại" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleDataList" class="form-label">Ngày sinh</label>
                            <input type="date" name="NgaySinh" class="form-control" min="1" id="exampleFormControlInput1" placeholder="Ngày sinh" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleDataList" class="form-label">Địa chỉ</label>
                            <input type="text" name="DiaChi" class="form-control" min="1" id="exampleFormControlInput1" placeholder="Địa chỉ" />
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-5 mb-3">
                                <button type="submit" class="btn btn-success py-2 mb-4">Thêm tài khoản</button>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            var loadFile = function(event) {
                var previewImage = document.getElementById('preview-image');
                previewImage.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>
        @endsection