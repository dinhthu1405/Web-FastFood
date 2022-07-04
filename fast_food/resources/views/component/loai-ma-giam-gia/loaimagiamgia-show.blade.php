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
                                    <td> <a href="{{ route('loaiGiamGia.xoa', $loaiGiamGia->id) }}"
                                            onclick="return confirm('Bạn có chắc muốn xoá loại giảm giá này, vì nó có thể ảnh hưởng đến mã giảm giá')"><button
                                                type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                data-target="#modal-edit" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-trash me-1"></i> </button></a></td>
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
