@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí thêm ảnh bìa')
@section('content')
    <!-- Form controls -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ route('anhBias.index') }}"><span class="text-muted fw-light">Danh sách
                        /</span></a> Thêm ảnh bìa</h4>
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
            @endif
            {{-- @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif --}}
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Thêm ảnh bìa</h5>
                    <div class="card-body">
                        <form action="{{ route('anhBias.store') }}" method="post" enctype="multipart/form-data">
                            {!! @csrf_field() !!}
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Tên món</label>
                                <select class="form-select" name="TenMon" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    <option value='' selected>-- Chọn tên món --</option>
                                    @foreach ($lstMonAn as $monAn)
                                        <option value="{{ $monAn->id }}">{{ $monAn->ten_mon }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('TenMon')
                                    <div class="error">
                                        <span class="text-danger error-text ten_loai_err" id="tenLoai">
                                            <strong style="font-size: 14px">{{ $message }}</strong>
                                        </span>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" name="images[]" accept="image/*"
                                    onchange="loadFile(event)" id="exampleFormControlInput1" placeholder="Hình ảnh" />
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
                                <div class="col-md-5"></div>
                                <div class="col-md-5 mb-3">
                                    <button type="submit" class="btn btn-success py-2 mb-4">Thêm ảnh bìa</button>
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
