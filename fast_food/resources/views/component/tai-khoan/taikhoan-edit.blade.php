@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí sửa tài khoản')
@section('content')
    <!-- Form controls -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <h4 class="fw-bold py-3 mb-4"><a href="{{ route('taiKhoan.index') }}"><span class="text-muted fw-light">Danh
                            sách
                            /</span></a> Sửa tài khoản</h4>
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                @endif
                {{-- @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
            @endif --}}
                {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif --}}
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Sửa tài khoản</h5>
                        <!-- Account -->
                                                    <form action="{{ route('taiKhoan.update', ['taiKhoan' => $taiKhoan]) }}" method="post"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @method('PATCH')
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                {{-- <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100"
                            width="100" id="uploadedAvatar" /> --}}
                                @foreach ($lstHinhAnh as $image)
                                    <img id="preview-image" src="{{ asset("storage/$image->duong_dan") }}"
                                        alt="preview image" class="d-block rounded" height="100" width="100"
                                        id="uploadedAvatar">
                                @endforeach
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Chọn hình đại diện</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        {{-- <input type="file" id="upload" class="account-file-input" hidden
                                    accept="image/png, image/jpeg" /> --}}
                                        <input type="file" id="upload" hidden class="account-file-input"
                                            name="images" onchange="loadFile(event)" id="images" placeholder="Hình ảnh"
                                            accept="image/png, image/jpeg" value="{{ old('images') }}" />
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
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                                        <input type="email" disabled name="Email" class="form-control"
                                            value="{{ $taiKhoan->email }}" id="exampleFormControlInput1"
                                            placeholder="Email" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Mật khẩu</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="MatKhau" class="form-control" id="password"
                                                placeholder="Mật khẩu" value="" />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                        @if (Session::has('error'))
                                            <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                <strong style="font-size: 14px">{{ Session::get('error') }}</strong>
                                            </span>
                                        @endif
                                        @error('MatKhau')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlSelect1" class="form-label">Họ tên</label>
                                        <input type="text" name="HoTen" class="form-control"
                                            value="{{ old('HoTen', $taiKhoan->ho_ten) }}" id="exampleFormControlInput1"
                                            placeholder="Họ tên" />
                                        @error('HoTen')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleFormControlSelect1" class="form-label">Số điện thoại</label>
                                        <input type="text" name="SDT" class="form-control"
                                            value="{{ old('SDT', $taiKhoan->sdt) }}" id="exampleFormControlInput1"
                                            placeholder="Số điện thoại" />
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
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleDataList" class="form-label">Ngày sinh</label>
                                        <input type="date" name="NgaySinh" class="form-control" min="1"
                                            value="{{ old('NgaySinh', $taiKhoan->ngay_sinh) }}"
                                            id="exampleFormControlInput1" placeholder="Ngày sinh" />
                                        @error('NgaySinh')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="exampleDataList" class="form-label">Địa chỉ</label>
                                        <input type="text" name="DiaChi" class="form-control" min="1"
                                            value="{{ old('DiaChi', $taiKhoan->dia_chi) }}"
                                            id="exampleFormControlInput1" placeholder="Địa chỉ" />
                                        @error('DiaChi')
                                            <div class="error">
                                                <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                                    <strong style="font-size: 14px">{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="text" hidden name="PhanLoaiTaiKhoan" class="form-control"
                                        placeholder="" value="{{ $taiKhoan->phan_loai_tai_khoan }}">
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-5 mb-3">
                                        <button type="submit" class="btn btn-success py-2 mb-4">Sửa tài
                                            khoản</button>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            </form>
                        </div>
                        </form>
                        <!-- /Account -->
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
