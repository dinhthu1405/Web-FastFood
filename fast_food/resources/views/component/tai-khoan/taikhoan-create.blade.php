@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang thêm tài khoản')
@section('content')
    <!-- Form controls -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ route('taiKhoan.index') }}"><span class="text-muted fw-light">Danh
                        sách /</span></a> Thêm tài khoản</h4>
            <div class="row">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                @endif
                {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif --}}
                <div class="col-md-12">
                    {{-- <div class="card mb-4">
                    <h5 class="card-header">Thêm tài khoản</h5>
                    <div class="card-body">
                        <form action="{{ route('taiKhoan.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="email" name="Email" class="form-control" id="email"
                                        placeholder="Email" value="{{ old('Email') }}" />
                                    @error('Email')
                                        <div class="error">
                                            <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                <strong style="font-size: 14px">{{ $message }}</strong>
                                            </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3 form-password-toggle">
                                    <label for="exampleFormControlInput1" class="form-label">Mật khẩu</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="MatKhau" class="form-control" id="password"
                                            placeholder="Mật khẩu" value="{{ old('MatKhau') }}" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    @error('MatKhau')
                                        <div class="error">
                                            <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                <strong style="font-size: 14px">{{ $message }}</strong>
                                            </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                                    <input type="file" class="form-control" name="images" accept="image/*"
                                        onchange="loadFile(event)" id="images" placeholder="Hình ảnh" />
                                    @error('images')
                                        <div class="error">
                                            <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                <strong style="font-size: 14px">{{ $message }}</strong>
                                            </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Xem trước hình</label>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="user-image col-md-6 text-center">
                                            <img id="preview-image" src="{{ asset('assets/img/khongxacdinh.jpg') }}"
                                                alt="preview image" style="max-height: 200px;">
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Họ tên</label>
                                        <input type="text" name="HoTen" class="form-control" id="hoTen"
                                            placeholder="Họ tên" value="{{ old('HoTen') }}" />
                                        @error('HoTen')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Số điện thoại</label>
                                        <input type="text" name="SDT" class="form-control" id="SDT"
                                            placeholder="Số điện thoại" value="{{ old('SDT') }}" />
                                        @error('SDT')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleDataList" class="form-label">Ngày sinh</label>
                                        <input type="date" name="NgaySinh" class="form-control" min="1"
                                            id="ngaySinh" placeholder="Ngày sinh" value="{{ old('NgaySinh') }}" />
                                        @if (Session::has('error'))
                                            <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                <strong style="font-size: 14px">{{ Session::get('error') }}</strong>
                                            </span>
                                        @endif
                                        @error('NgaySinh')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleDataList" class="form-label">Địa chỉ</label>
                                        <input type="text" name="DiaChi" class="form-control" min="1"
                                            id="diaChi" placeholder="Địa chỉ" value="{{ old('DiaChi') }}" />
                                        @error('DiaChi')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-5 mb-3">
                                        <button type="submit" class="btn btn-success py-2 mb-4 themTaiKhoan">Thêm tài
                                            khoản</button>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                        </form>
                    </div>
                </div> --}}

                    <div class="card mb-4">
                        <h5 class="card-header">Thêm tài khoản</h5>
                        <!-- Account -->
                        <form action="{{ route('taiKhoan.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    {{-- <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100"
                                width="100" id="uploadedAvatar" /> --}}
                                    <img id="preview-image" src="{{ asset('assets/img/khongxacdinh.jpg') }}"
                                        alt="preview image" class="d-block rounded" height="100" width="100"
                                        id="uploadedAvatar">
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Chọn hình đại diện</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            {{-- <input type="file" id="upload" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" /> --}}
                                            <input type="file" id="upload" hidden class="account-file-input"
                                                name="images" onchange="loadFile(event)" id="images"
                                                placeholder="Hình ảnh" accept="image/png, image/jpeg"
                                                value="{{ old('images') }}" />
                                        </label>
                                        {{-- <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button> --}}

                                        @error('images')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="text" name="Email" class="form-control" id="email"
                                            placeholder="Email" value="{{ old('Email') }}" />
                                        @error('Email')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label for="exampleFormControlInput1" class="form-label">Mật khẩu</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="MatKhau" class="form-control" id="password"
                                                placeholder="Mật khẩu" value="{{ old('MatKhau') }}" />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                        @error('MatKhau')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                                    <input type="file" class="form-control" name="images" accept="image/*"
                                        onchange="loadFile(event)" id="images" placeholder="Hình ảnh" />
                                    @error('images')
                                        <div class="error">
                                            <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                <strong style="font-size: 14px">{{ $message }}</strong>
                                            </span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Xem trước hình</label>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="user-image col-md-6 text-center">
                                            <img id="preview-image" src="{{ asset('assets/img/khongxacdinh.jpg') }}"
                                                alt="preview image" style="max-height: 200px;">
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Họ tên</label>
                                        <input type="text" name="HoTen" class="form-control" id="hoTen"
                                            placeholder="Họ tên" value="{{ old('HoTen') }}" />
                                        @error('HoTen')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Số điện thoại</label>
                                        <input type="phone" name="SDT" class="form-control" id="SDT"
                                            placeholder="Số điện thoại" value="{{ old('SDT') }}" />
                                        @error('SDT')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleDataList" class="form-label">Ngày sinh</label>
                                        <input type="date" name="NgaySinh" class="form-control" min="1"
                                            id="ngaySinh" placeholder="Ngày sinh" value="{{ old('NgaySinh') }}" />
                                        @if (Session::has('error'))
                                            <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                <strong style="font-size: 14px">{{ Session::get('error') }}</strong>
                                            </span>
                                        @endif
                                        @error('NgaySinh')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleDataList" class="form-label">Địa chỉ</label>
                                        <input type="text" name="DiaChi" class="form-control" min="1"
                                            id="diaChi" placeholder="Địa chỉ" value="{{ old('DiaChi') }}" />
                                        @error('DiaChi')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-5 mb-3">
                                        <button type="submit" class="btn btn-success py-2 mb-4 themTaiKhoan">Thêm tài
                                            khoản</button>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                            <!-- /Account -->
                        </form>
                    </div>
                </div>
            </div>
            @include('Partial/tai-khoan/JSPartial-taikhoan-create')
        @endsection
