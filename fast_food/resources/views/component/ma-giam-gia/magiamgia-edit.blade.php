@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí sửa mã giảm giá')
@section('content')
    <!-- Form controls -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ route('maGiamGia.index') }}"><span class="text-muted fw-light">Danh sách /</span></a> Sửa mã giảm giá</h4>
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
                    <h5 class="card-header">Sửa mã giảm giá</h5>
                    <div class="card-body">
                        <form action="{{ route('maGiamGia.update', ['maGiamGium' => $maGiamGium]) }}" method="post"
                            enctype="multipart/form-data">
                            {!! @csrf_field() !!}
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tên mã giảm giá</label>
                                <input type="text" name="TenMaGiamGia" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Tên mã giảm giá" value="{{ $maGiamGium->ten_ma }}" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Số lượng</label>
                                <input type="number" name="SoLuong" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Số lượng" value="{{ $maGiamGium->so_luong }}" />
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-time-input" class="form-label">Ngày bắt đầu</label>
                                <div class="col-md-12">
                                    <input class="form-control" name="NgayBatDau" type="datetime-local" id="html5-datetime-local-input" value="{{ date('Y-m-d\TH:i', strtotime($maGiamGium->ngay_bat_dau)) }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-time-input" class="form-label">Ngày kết thúc</label>
                                <div class="col-md-12">
                                    <input class="form-control" name="NgayKetThuc" type="datetime-local" id="html5-datetime-local-input" value="{{ date('Y-m-d\TH:i', strtotime($maGiamGium->ngay_ket_thuc)) }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Loại giảm giá</label>
                                <select class="form-select" name="LoaiGiamGia" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    @foreach ($lstLoaiGiamGia as $loaiGiamGia)
                                        <option value="{{ $loaiGiamGia->id }}" @if ($loaiGiamGia->id == $maGiamGium->loai_giam_gia_id) selected @endif>
                                            {{ $loaiGiamGia->ten_loai_giam_gia }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-5 mb-3">
                                    <button type="submit" class="btn btn-success py-2 mb-4">Sửa mã giảm giá</button>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endsection
