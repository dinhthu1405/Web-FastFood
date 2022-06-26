@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí món ăn')
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
                    <a href="{{ route('monAn.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            món ăn</button></a>
                </div>
            </div>
            <form action="{{ route('monAn.search') }}" method="GET">
                <label>Tìm kiếm</label>
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" type="search" name="search" value="{{ request('search') }}"
                            required />
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="form-control btn btn-primary">Tìm kiếm</button>
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
                                <th>Hình món ăn</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Loại món ăn</th>
                                <th>Địa điểm</th>
                                <!-- <th>Đánh giá</th> -->
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
                                    <td><a href="{{ route('monAn.images', $monAn->id) }}" class="btn btn-outline-dark">Xem
                                            hình</a></td>
                                    <td>{{ number_format($monAn->don_gia) }}</td>
                                    <td>{{ $monAn->so_luong }}</td>
                                    <td>{{ $monAn->loaiMonAn->ten_loai }}</td>
                                    <td>{{ $monAn->diaDiem->ten_dia_diem }}</td>
                                    @if ($monAn->tinh_trang == 1)
                                        <td>Còn món</td>
                                    @else
                                        <td>Hết món</td>
                                    @endif
                                    <td><a href="{{ route('monAn.edit', $monAn->id) }}"><button type="button"
                                                id="btn-edit" class="btn btn-warning py-2 mb-4" data-target="#modal-edit"
                                                data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                    <td> <a href="{{ route('monAn.xoa', $monAn->id) }}"
                                            onclick="return confirm('Bạn có chắc muốn xoá món ăn này, vì nó sẽ ảnh hưởng đến đánh giá; bình luận và ảnh bìa')"><button
                                                type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                data-target="#modal-edit" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-trash me-1"></i> </button></a></td>
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
                                            {{ $lstMonAn->appends($request->except('page'))->links() }}
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
