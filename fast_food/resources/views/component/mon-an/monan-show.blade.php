@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí món ăn')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('monAn.index') }}"><span class="text-muted fw-light">Danh
                                sách</span></a></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <a href="{{ route('monAn.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            món ăn</button></a>
                </div>
            </div>
            <form action="{{ route('monAn.search') }}" method="GET" id="form-search">
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
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Lọc</label>
                            <select class="form-control" name="LocDonHang" id="loc_don_hang">
                                <option value="0">--Chọn loại muốn lọc--</option>
                                <option value="Còn món" {{ request()->LocDonHang == 'Còn món' ? 'selected' : '' }}>
                                    Còn món
                                </option>
                                <option value="Hết món" {{ request()->LocDonHang == 'Hết món' ? 'selected' : '' }}>
                                    Hết món
                                </option>
                                <option value="Sắp hết" {{ request()->LocDonHang == 'Sắp hết' ? 'selected' : '' }}>
                                    Sắp hết
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <br />
            <!-- Bootstrap Table with Header - Light -->
            <div class="card">
                <h5 class="card-header">Danh sách món ăn</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên món</th>
                                <th>Hình món</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Loại món</th>
                                <th>Địa điểm</th>
                                <th>Tình trạng</th>
                                <th>Chỉnh sửa</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <?php $count = $lstMonAn->perPage() * ($lstMonAn->currentPage() - 1) + 1; ?>
                        @foreach ($lstMonAn as $monAn)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $monAn->ten_mon }}</strong>
                                    </td>
                                    {{-- <td><a href="{{ route('monAn.images', $monAn->id) }}" class="btn btn-outline-dark">Xem
                                            hình</a></td> --}}
                                    @foreach ($lstHinhAnh as $hinhAnh)
                                        @if ($monAn->id == $hinhAnh->mon_an_id)
                                            <td>
                                                <img class="d-block w-100" id="preview-image"
                                                    src="{{ asset("storage/$hinhAnh->duong_dan") }}" alt="preview image"
                                                    style="max-height: 80px; border-radius: 50%;" data-target="#modal-add"
                                                    data-bs-toggle="modal"
                                                    data-bs-target='#modalCenter{{ $monAn->id }}' />
                                            </td>
                                        @break
                                    @endif
                                @endforeach
                                <div class="modal fade" id="modalCenter{{ $monAn->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            @foreach ($lstHinhAnh as $hinhAnh)
                                                @if ($monAn->id == $hinhAnh->mon_an_id)
                                                    <img class="d-block w-100" id="preview-image"
                                                        src="{{ asset("storage/$hinhAnh->duong_dan") }}"
                                                        alt="preview image" style="max-height: 200px;" />
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <td>{{ number_format($monAn->don_gia) }}</td>
                                <td>{{ $monAn->so_luong }}</td>
                                <td><a style="color: #697a8d"
                                        href="{{ route('loaiMonAn.index1', $monAn->loai_mon_an_id) }}">{{ $monAn->loaiMonAn->ten_loai }}</a>
                                </td>

                                <td> <a style="color: #697a8d"
                                        href="{{ route('diaDiem.index1', $monAn->dia_diem_id) }}">{{ $monAn->diaDiem->ten_dia_diem }}</a>
                                </td>
                                @if ($monAn->tinh_trang == 'Còn món')
                                    <td>Còn món</td>
                                @elseif($monAn->tinh_trang == 'Sắp hết')
                                    <td>Sắp hết</td>
                                @else
                                    <td>Hết món</td>
                                @endif
                                <td><a href="{{ route('monAn.edit', $monAn->id) }}"><button type="button"
                                            id="btn-edit" class="btn btn-warning py-2 mb-4" data-target="#modal-edit"
                                            data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                            <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
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
                                                        <span style="font-size: 22px;">
                                                            Bạn có chắc muốn xoá món ăn này, vì nó sẽ ảnh<br /> hưởng
                                                            đến đánh giá; bình luận và ảnh bìa
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="padding: 3%">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-2">
                                                    <a href="{{ route('monAn.xoa', $monAn->id) }}"><button
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
                @if ($lstMonAn->total() > 5)
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <!-- Basic Pagination -->
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        {{ $lstMonAn->appends($request->except('page'))->onEachSide(1)->links() }}
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
        @include('Partial/mon-an/JSPartial-monan-show')
    @endsection
