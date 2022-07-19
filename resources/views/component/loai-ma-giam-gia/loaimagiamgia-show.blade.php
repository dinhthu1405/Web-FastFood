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
                    <button type="button" class="btn btn-success py-2 mb-4" data-target="#modal-add" data-bs-toggle="modal"
                        data-bs-target="#modalCenter">Thêm
                        loại giảm giá</button>
                </div>
                <!-- Modal Thêm -->
                <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Thêm loại giảm giá
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    {{-- <input type="hidden" name="_token" id="_token" value="{{ Session::token() }}"> --}}
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tên
                                            loại giảm giá</label>
                                        <input type="text" name="LoaiGiamGia" class="form-control" id="LoaiGiamGia"
                                            placeholder="Tên loại giảm giá" />
                                        <span class="text-danger error-text loai_giam_gia_err" id="LoaiGiamGia"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="submit" value="add" class="btn btn-primary btn-save">Thêm loại giảm
                                    giá</button>
                            </div>
                        </div>
                    </div>
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
                <form method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-header">Danh sách loại giảm giá</h5>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for=""></label>
                                <button formaction="{{ route('loaiGiamGia.xoaNhieu') }}" type="submit"
                                    class="form-control btn btn-primary">Xoá
                                    lựa chọn</button>
                            </div>

                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên loại giảm giá</th>
                                    {{-- <th>Chỉnh sửa</th> --}}
                                    <th>Xoá</th>
                                    <th><input type="checkbox" class="checkAll" /></th>
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
                                                data-bs-target="#modalCenter-Delete{{ $loaiGiamGia->id }}">
                                                <i class="bx bx-trash me-1"></i> </button></td>
                                        <td class="selectBox"><input name='ids[]' type="checkbox" id="checkItem"
                                                value="{{ $loaiGiamGia->id }}"></td>
                                        <!-- Modal Cảnh báo -->
                                        <div class="modal fade" id="modalCenter-Delete{{ $loaiGiamGia->id }}"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="mb-3" style="text-align: center">
                                                                <img src="{{ asset('assets/img/icons/unicons/!.png') }}"
                                                                    alt="" width="180px" height="75px">
                                                            </div>
                                                            <div class="mb3 text-nowrap" style="text-align: center">
                                                                <span style="font-size: 22px;">
                                                                    Bạn có chắc muốn xoá loại giảm giá này
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding: 3%">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-2">
                                                            <button
                                                                formaction="{{ route('loaiGiamGia.xoa', $loaiGiamGia->id) }}"
                                                                type="submit" class="btn btn-danger btn-delete-confirm"
                                                                data-bs-dismiss="modal">Xoá</button>
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
                                <script>
                                    $(document).on('click', '.btn-delete-close', function(e) {
                                        $('#modalCenter-Delete{{ $loaiGiamGia->id }}').modal('hide');
                                    });
                                </script>
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
                </form>
            </div>
            <!-- Bootstrap Table with Header - Light -->
            @include('Partial/loai-ma-giam-gia/JSPartial-loaimagiamgia-show')
        @endsection
