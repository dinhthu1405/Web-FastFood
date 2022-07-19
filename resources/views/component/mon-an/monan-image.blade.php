@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang hình ảnh món ăn')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <a href="{{ route('monAn.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm món
                            ăn</button></a>
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
            <h2>Hình của món ăn : <span class="text-primary">{{ $monAn->ten_mon }}</span></h2>
            <a href="{{ route('monAn.index') }}" class="btn btn-primary">Trở về</a>
            <div class="row mt-4">
                @foreach ($images as $image)
                    @if ($image->trang_thai == 1)
                        <div class="col-md-3">
                            <div class="card text-white bg-secondary mb-3" style="max-width: 20rem;">
                                <div class="card-body">
                                    <img src="{{ asset("storage/$image->duong_dan") }}" class="card-img-top"
                                        style="margin-left: auto;margin-left: auto;">
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- Bootstrap Table with Header - Light -->
        @endsection
