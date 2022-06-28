@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí sửa tài khoản')
@section('content')
    <!-- Form controls -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ route('taiKhoan.index') }}"><span class="text-muted fw-light">Danh sách
                        /</span></a> Sửa tài khoản</h4>
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
                    <h5 class="card-header">Sửa tài khoản</h5>
                    <div class="card-body">
                        <form action="{{ route('taiKhoan.update', ['taiKhoan' => $taiKhoan]) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="email" disabled name="Email" class="form-control"
                                        value="{{ $taiKhoan->email }}" id="exampleFormControlInput1"
                                        placeholder="Email" />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                                    <input type="file" class="form-control" name="images" accept="image/*"
                                        onchange="loadFile(event)" id="images" placeholder="Hình ảnh" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Xem trước hình</label>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="user-image col-md-6 text-center">
                                        @foreach ($lstHinhAnh as $image)
                                            <img id="preview-image" src="{{ asset("storage/$image->duong_dan") }}"
                                                alt="preview image" style="max-height: 200px;">
                                        @endforeach
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Họ tên</label>
                                <input type="text" name="HoTen" class="form-control" value="{{ $taiKhoan->ho_ten }}"
                                    id="exampleFormControlInput1" placeholder="Họ tên" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Số điện thoại</label>
                                <input type="text" name="SDT" class="form-control" value="{{ $taiKhoan->sdt }}"
                                    id="exampleFormControlInput1" placeholder="Số điện thoại" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleDataList" class="form-label">Ngày sinh</label>
                                <input type="date" name="NgaySinh" class="form-control" min="1"
                                    value="{{ $taiKhoan->ngay_sinh }}" id="exampleFormControlInput1"
                                    placeholder="Ngày sinh" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleDataList" class="form-label">Địa chỉ</label>
                                <input type="text" name="DiaChi" class="form-control" min="1"
                                    value="{{ $taiKhoan->dia_chi }}" id="exampleFormControlInput1"
                                    placeholder="Địa chỉ" />
                            </div>
                            <div class="mb-3">
                                <input type="text" hidden name="PhanLoaiTaiKhoan" class="form-control" placeholder=""
                                    value="{{ $taiKhoan->phan_loai_tai_khoan }}">
                            </div>

                            <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-5 mb-3">
                                    <button type="submit" class="btn btn-success py-2 mb-4">Sửa tài khoản</button>
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
