@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí địa điểm')
@section('content')
    @include('Partial/dia-diem/CSSPartial-diadiem')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('diaDiem.index') }}"><span
                                class="text-muted fw-light">Danh sách</span></a></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    {{-- <button type="button" id="btn-add" class="btn btn-success py-2 mb-4" data-target="#modal-add"
                        data-bs-toggle="modal" data-bs-target="#modalCenter">
                        Thêm địa điểm
                    </button> --}}
                    <a href="{{ route('diaDiem.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            địa điểm</button></a>
                    <!-- Modal Thêm -->
                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="" id="form-add" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Thêm địa điểm</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {!! @csrf_field() !!}
                                        <div class="row">
                                            <!-- <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}"> -->
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Tên địa
                                                    điểm</label>
                                                <input type="text" name="TenDiaDiem" class="form-control" id="TenDiaDiem"
                                                    placeholder="Tên địa điểm" />
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="thoiGianMo" class="form-label">Thời gian mở</label>
                                                <input type="time" id="ThoiGianMo" name="ThoiGianMo" class="form-control"
                                                    value="12:30" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="thoiGianDong" class="form-label">Thời gian đóng</label>
                                                <input type="time" id="ThoiGianDong" name="ThoiGianDong"
                                                    class="form-control" value="13:30" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Đóng
                                        </button>
                                        <button type="submit" id="btn-save" value="add" class="btn btn-primary">Thêm
                                            địa
                                            điểm</button>
                                        <input type="hidden" id="todo_id" name="todo_id" value="0">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- Modal Sửa -->
                    {{-- <div class="modal fade" id="modalCenter-Edit" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form action="" id="form-edit" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Sửa địa điểm</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {!! @csrf_field() !!}
                                        <ul id="saveform-errList"></ul>
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Tên địa
                                                    điểm</label>
                                                <input type="text" name="TenDiaDiemEdit" class="form-control"
                                                    id="TenDiaDiem" placeholder="Tên địa điểm" />
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="thoiGianMo" class="form-label">Thời gian mở</label>
                                                <input type="time" id="ThoiGianMoEdit" name="ThoiGianMo"
                                                    class="form-control" value="12:30" />
                                            </div>
                                            <div class="col mb-0">
                                                <label for="thoiGianDong" class="form-label">Thời gian đóng</label>
                                                <input type="time" id="ThoiGianDongEdit" name="ThoiGianDong"
                                                    class="form-control" value="13:30" />
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Đóng
                                        </button>
                                        <button type="submit" id="btn-save-edit" value="edit"
                                            class="btn btn-primary">Sửa
                                            địa
                                            điểm</button>
                                        <input type="hidden" id="todo_id" name="todo_id" value="0">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div> --}}
                </div>
            </div>

            <form action="{{ route('diaDiem.search') }}" method="GET">
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
            <div id="success_message"></div>
            <div class="card">
                <h5 class="card-header">Danh sách địa điểm</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên địa điểm</th>
                                <th>Thời gian mở</th>
                                <th>Thời gian đóng</th>
                                <th>Chỉnh sửa</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <?php $count = $lstDiaDiem->perPage() * ($lstDiaDiem->currentPage() - 1) + 1; ?>
                        @foreach ($lstDiaDiem as $diaDiem)
                            <tbody id="todos-list" class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong id="ten_dia_diem">{{ $diaDiem->ten_dia_diem }}</strong>
                                    </td>
                                    <td>{{ $diaDiem->thoi_gian_mo }}</td>
                                    <td>{{ $diaDiem->thoi_gian_dong }}</td>
                                    <!-- <td><button type="button" id="btn-edit" class="btn btn-warning py-2 mb-4" data-target="#modal-edit" data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <i class="bx bx-edit-alt me-1"></i> </button></td> -->
                                    <td><a href="{{ route('diaDiem.edit', $diaDiem->id) }}"><button type="button"
                                                id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                data-target="#modal-edit" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                    <td> <button type="button" id="btn-delete" class="btn btn-danger py-2 mb-4"
                                            data-target="#modal-delete" data-bs-toggle="modal"
                                            data-bs-target="#modalCenter-Delete{{ $diaDiem->id }}">
                                            <i class="bx bx-trash me-1"></i> </button></td>
                                    <!-- Modal Cảnh báo -->
                                    <div class="modal fade" id="modalCenter-Delete{{ $diaDiem->id }}" tabindex="-1"
                                        aria-hidden="true">
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
                                                                Bạn có chắc muốn xoá địa điểm này
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" style="padding: 3%">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-2">
                                                        <a href="{{ route('diaDiem.xoa', $diaDiem->id) }}"><button
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
                            @include('Partial/dia-diem/JSPartial-diadiem-show')
                        @endforeach
                    </table>
                    @if ($lstDiaDiem->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstDiaDiem->appends($request->except('page'))->onEachSide(1)->links() }}
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
        </div>
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-2 mb-2"><span class="text-muted fw-light">Bản đồ</span></h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div style="width: 100%; height: 480px" id="mapContainer"></div>
                        </div>
                    </div>
                </div>
                @include('Partial/dia-diem/JSPartial-diadiem-show-map')
            @endsection
