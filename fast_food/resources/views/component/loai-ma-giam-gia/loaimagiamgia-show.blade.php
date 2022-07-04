@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí loại giảm giá')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('loaiGiamGia.index') }}"><span
                                class="text-muted fw-light">Danh sách</span></a></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <a href="{{ route('loaiGiamGia.create') }}"><button type="button"
                            class="btn btn-success py-2 mb-4">Thêm
                            loại giảm giá</button></a>
                </div>
            </div>
            <form action="{{ route('loaiGiamGia.search') }}" method="GET">
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
                <h5 class="card-header">Danh sách loại giảm giá</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên loại giảm giá</th>
                                {{-- <th>Chỉnh sửa</th> --}}
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <?php $count = $lstLoaiGiamGia->perPage() * ($lstLoaiGiamGia->currentPage() - 1) + 1; ?>
                        @foreach ($lstLoaiGiamGia as $loaiGiamGia)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $loaiGiamGia->ten_loai_giam_gia }}</strong>
                                    </td>
                                    {{-- <td><a href="{{ route('loaiGiamGia.edit', $loaiGiamGia->id) }}"><button type="button" id="btn-edit" class="btn btn-warning py-2 mb-4" data-target="#modal-edit" data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                        <i class="bx bx-edit-alt me-1"></i> </button></a> </td> --}}
                                    <td> <button type="button" id="btn-delete" class="btn btn-danger py-2 mb-4"
                                            data-target="#modal-delete" data-bs-toggle="modal"
                                            data-bs-target="#modalCenter-Delete">
                                            <i class="bx bx-trash me-1"></i> </button></td>
                                    <!-- Modal Cảnh báo -->
                                    <div class="modal fade" id="modalCenter-Delete" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                @if (Session::has('success'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ Session::get('success') }}
                                                    </div>
                                                @endif
                                                @if (Session::has('error'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ Session::get('error') }}</div>
                                                @endif
                                                @if ($errors->any())
                                                    @foreach ($errors->all() as $error)
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ $error }}
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="mb-3" style="text-align: center">
                                                            <img src="{{ asset('assets/img/icons/unicons/!.png') }}"
                                                                alt="" width="180px" height="75px">
                                                        </div>
                                                        <div class="mb3 text-nowrap" style="text-align: center">
                                                            <span style="font-size: 22px;">Bạn có chắc muốn xoá loại giảm
                                                                giá này, vì nó sẽ ảnh <br /> hưởng đến mã giảm giá </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" style="padding: 3%">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-2">
                                                        <a href="{{ route('loaiGiamGia.xoa', $loaiGiamGia->id) }}"><button
                                                                type="submit" class="btn btn-danger btn-delete-confirm"
                                                                data-bs-dismiss="modal">Xoá</button></a>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" value="delete"
                                                            class="btn btn-primary btn-delete-close">Huỷ</button>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    @if ($lstLoaiGiamGia->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstLoaiGiamGia->appends($request->except('page'))->onEachSide(1)->links() }}
                                        </ul>
                                    </nav>
                                    <!--/ Basic Pagination -->
                                </div>
                            </div>
                        </div>
                    @else
                    @endif
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
            @include('Partial/loai-ma-giam-gia/JSPartial-loaimagiamgia-show')
        @endsection
