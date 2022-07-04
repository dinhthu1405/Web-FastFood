@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí loại món ăn')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('loaiMonAn.index') }}"><span
                                class="text-muted fw-light">Danh sách</span></a></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-success py-2 mb-4" data-target="#modal-add" data-bs-toggle="modal"
                        data-bs-target="#modalCenter">Thêm
                        loại món</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <div id="alert-msg" role="alert">
                    </div>
                </div>

            </div>
            <!-- Modal Thêm -->
            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
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
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Thêm loại món</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                {{-- <input type="hidden" name="_token" id="_token" value="{{ Session::token() }}"> --}}
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Tên loại món</label>
                                    <input type="text" name="TenLoai" class="form-control" id="TenLoai"
                                        placeholder="Tên địa điểm" />
                                    <span class="text-danger error-text ten_loai_err" id="tenLoai"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Đóng
                            </button>
                            <button type="submit" value="add" class="btn btn-primary btn-save">Thêm loại
                                món</button>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('loaiMonAn.search') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <label>Tìm kiếm</label>
                        <input class="form-control" type="search" name="search" required id="timKiem"
                            value="{{ request('search') }}" />
                    </div>
                    <div class="col-md-2">
                        <label></label>
                        <button type="submit" class="form-control btn btn-primary">Tìm kiếm</button>
                    </div>
                    <div class="col-md-1">
                        <label for=""></label>
                        <button type="button" class="form-control btn btn-info" id="refresh">
                            <i class='bx bx-refresh'></i>
                        </button>
                    </div>
                </div>
            </form>
            <br />
            <!-- Bootstrap Table with Header - Light -->
            <div class="card">
                @include('component/loai-mon-an/loaimonan-paginate')
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->

    @endsection
    @section('script')
        @include('Partial/loai-mon-an/JSPartial-loaimonan-show')
    @endsection
