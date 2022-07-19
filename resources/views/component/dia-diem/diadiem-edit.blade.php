@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí sửa địa điểm')
@section('content')
    <!-- Form controls -->
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ route('diaDiem.index') }}"><span class="text-muted fw-light">Danh sách
                        /</span></a> Sửa địa điểm</h4>
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
                    <h5 class="card-header">Sửa địa điểm</h5>
                    <div class="card-body">
                        <form action="{{ route('diaDiem.update', ['diaDiem' => $diaDiem]) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('PATCH')
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="exampleFormControlInput1" class="form-label">Tên địa điểm</label>
                                    <input type="text" disabled name="TenDiaDiem" class="form-control"
                                        id="exampleFormControlInput1" value="{{ $diaDiem->ten_dia_diem }}"
                                        placeholder="Tên địa điểm" />
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="html5-time-input" class="form-label">Thời gian mở</label>
                                    <div class="col-md-12">
                                        <input class="form-control" name="ThoiGianMo" type="time"
                                            value="{{ $diaDiem->thoi_gian_mo }}" id="html5-time-input">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="html5-time-input" class="form-label">Thời gian đóng</label>
                                    <div class="col-md-12">
                                        <input class="form-control" name="ThoiGianDong" type="time"
                                            value="{{ $diaDiem->thoi_gian_dong }}" id="html5-time-input">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row" hidden>
                                <div class="col-md-6">
                                    <input class="form-control" name="KinhDo" type="text"
                                        value="{{ $diaDiem->kinh_do }}" id="KinhDo">
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" name="ViDo" type="text"
                                        value="{{ $diaDiem->vi_do }}" id="ViDo">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Bản đồ</label>
                                <div style="width: 100%; height: 480px" id="mapContainer"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-5 mb-3">
                                    <button type="submit" class="btn btn-success py-2 mb-4">Sửa địa điểm</button>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('Partial/dia-diem/JSPartial-diadiem-edit')
        @endsection
