@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí sửa món ăn')
@section('content')
<!-- Form controls -->
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="{{ route('monAn.index') }}"><span class="text-muted fw-light">Danh sách /</span></a> Sửa món ăn</h4>
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
                <h5 class="card-header">Sửa món ăn</h5>
                <div class="card-body">
                    <form action="{{ route('monAn.update', ['monAn' => $monAn]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tên món</label>
                            <input type="text" disabled name="TenMonAn" class="form-control" value="{{ $monAn->ten_mon }}" id="exampleFormControlInput1" placeholder="Tên món" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" name="images[]" accept="image/*" onchange="loadFile(event)" multiple id="images" placeholder="Hình ảnh" />
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
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Loại món ăn</label>
                            <select class="form-select" name="LoaiMonAn" id="exampleFormControlSelect1" aria-label="Default select example">
                                <option selected>-- Chọn loại món ăn --</option>
                                @foreach ($lstLoaiMonAn as $loaiMonAn)
                                <option value="{{ $loaiMonAn->id }}" @if($loaiMonAn->id==$monAn->loai_mon_an_id) selected @endif>{{ $loaiMonAn->ten_loai }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Địa điểm</label>
                            <select class="form-select" name="DiaDiem" id="exampleFormControlSelect1" aria-label="Default select example">
                                <option selected>-- Chọn địa điểm --</option>
                                @foreach ($lstDiaDiem as $diaDiem)
                                <option value="{{ $diaDiem->id }}" @if($diaDiem->id==$monAn->dia_diem_id) selected @endif>{{ $diaDiem->ten_dia_diem }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleDataList" class="form-label">Đơn giá</label>
                            <input type="text" name="DonGia" class="form-control format_number" min="1" value="{{ $monAn->don_gia }}" onkeypress='validate(event)' id="exampleFormControlInput1" placeholder="Đơn giá" />

                        </div>
                        <div class="mb-3">
                            <label for="exampleDataList" class="form-label">Số lượng</label>
                            <input type="number" name="SoLuong" class="form-control" min="1" value="{{ $monAn->so_luong }}" id="exampleFormControlInput1" placeholder="Số lượng" />

                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Tình trạng món ăn</label>
                            <select class="form-select" name="TinhTrang" id="exampleFormControlSelect1" aria-label="Default select example">
                                <option {{ $monAn->tinh_trang == 'Còn món' ? 'selected' : '' }}>Còn món</option>
                                <option {{ $monAn->tinh_trang == 'Sắp hết' ? 'selected' : '' }}>Sắp hết</option>
                                <option {{ $monAn->tinh_trang == 'Hết món' ? 'selected' : '' }}>Hết món</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-5 mb-3">
                                <button type="submit" class="btn btn-success py-2 mb-4">Sửa món ăn</button>
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
        <script>
            function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
            }
        </script>
        @endsection