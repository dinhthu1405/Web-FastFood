@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí mã giảm giá')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Danh sách</span></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <a href="{{ route('maGiamGia.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            mã giảm giá</button></a>
                </div>
            </div>
            <form action="{{ route('loaiMonAn.search') }}" method="post">
                {{ csrf_field() }}
                <label>Tìm kiếm</label>
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" type="search" name="search" required />
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="form-control btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <br />
            <!-- Bootstrap Table with Header - Light -->
            <div class="card">
                <h5 class="card-header">Danh sách loại món ăn</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên mã</th>
                                <th>Số lượng</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Loại giảm giá</th>
                                <th>Chỉnh sửa</th>
                                <th>Khoá - Mở</th>
                            </tr>
                        </thead>
                        <?php $count = $lstMaGiamGia->perPage() * ($lstMaGiamGia->currentPage() - 1) + 1; ?>
                        @foreach ($lstMaGiamGia as $maGiamGia)
                            @if ($maGiamGia->trang_thai == 0)
                                <tbody class="table-border-bottom-0" style="background-color: #ECEEF1">
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $maGiamGia->ten_ma }}</strong>
                                        </td>
                                        <td>{{ $maGiamGia->so_luong }}</td>
                                        <td>{{ date('d-m-Y: H:i:s', strtotime($maGiamGia->ngay_bat_dau)) }}</td>
                                        <td>{{ date('d-m-Y: H:i:s', strtotime($maGiamGia->ngay_ket_thuc)) }}</td>
                                        <td>{{ $maGiamGia->loaiGiamGia->ten_loai_giam_gia }}</td>
                                        <td><a href="{{ route('maGiamGia.edit', $maGiamGia->id) }}"><button type="button"
                                                    id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                        <td> <a href="{{ route('maGiamGia.xoa', $maGiamGia->id) }}"><button type="button"
                                                    id="btn-edit" class="btn btn-danger py-2 mb-4" data-target="#modal-edit"
                                                    data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-lock-open me-1"></i> </button></a></td>
                                    </tr>
                                </tbody>
                            @else
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $maGiamGia->ten_ma }}</strong>
                                        </td>
                                        <td>{{ $maGiamGia->so_luong }}</td>
                                        <td>{{ date('d-m-Y: H:i:s', strtotime($maGiamGia->ngay_bat_dau)) }}</td>
                                        <td>{{ date('d-m-Y: H:i:s', strtotime($maGiamGia->ngay_ket_thuc)) }}</td>
                                        <td>{{ $maGiamGia->loaiGiamGia->ten_loai_giam_gia }}</td>
                                        <td><a href="{{ route('maGiamGia.edit', $maGiamGia->id) }}"><button type="button"
                                                    id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                        <td> <a href="{{ route('maGiamGia.xoa', $maGiamGia->id) }}"><button type="button"
                                                    id="btn-edit" class="btn btn-danger py-2 mb-4" data-target="#modal-edit"
                                                    data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-lock me-1"></i> </button></a></td>
                                    </tr>
                                </tbody>
                            @endif
                        @endforeach
                    </table>
                    @if ($lstMaGiamGia->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstMaGiamGia->links() }}
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
        @endsection
