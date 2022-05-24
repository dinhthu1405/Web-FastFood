@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí thêm địa điểm')
@section('content')
<!-- Form controls -->
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4>
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
                <h5 class="card-header">Thêm địa điểm</h5>
                <div class="card-body">
                    <form action="{{ route('diaDiem.store') }}" method="post" enctype="multipart/form-data">
                        {!! @csrf_field() !!}
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tên địa điểm</label>
                            <input type="text" name="TenDiaDiem" class="form-control" id="exampleFormControlInput1" placeholder="Tên địa điểm" />
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-time-input" class="form-label">Thời gian mở</label>
                            <div class="col-md-10">
                                <input class="form-control" name="ThoiGianMo" type="time" value="12:30:00" id="html5-time-input">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-time-input" class="form-label">Thời gian đóng</label>
                            <div class="col-md-10">
                                <input class="form-control" name="ThoiGianDong" type="time" value="13:30:00" id="html5-time-input">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-5 mb-3">
                                <button type="submit" class="btn btn-success py-2 mb-4">Thêm địa điểm</button>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection