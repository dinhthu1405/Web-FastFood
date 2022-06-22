@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí đánh giá')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('danhGia.index') }}"><span
                                class="text-muted fw-light">Danh sách</span></a></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    {{-- <a href="{{ route('danhGia.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                                    đánh giá</button></a> --}}
                </div>
            </div>
            <form action="{{ route('danhGia.search') }}" method="GET">
                <label>Tìm kiếm</label>
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" type="search" name="search" required
                            value="{{ request('search') }}" />
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="form-control btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <br />
            <!-- Bootstrap Table with Header - Light -->
            <div class="card">
                <h5 class="card-header">Danh sách đánh giá</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Đánh giá sao</th>
                                <th>Người dùng</th>
                                <th>Món ăn</th>
                                <th>Địa điểm</th>
                                <th>Khoá - Mở</th>
                            </tr>
                        </thead>
                        <?php $count = $lstDanhGia->perPage() * ($lstDanhGia->currentPage() - 1) + 1; ?>
                        @foreach ($lstDanhGia as $danhGia)
                            @if ($danhGia->trang_thai == 0)
                                <tbody class="table-border-bottom-0" style="background-color: #ECEEF1">
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            {{ $danhGia->danh_gia_sao }}
                                        </td>
                                        @if ($danhGia->user_id == null)
                                            <td></td>
                                        @else
                                            <td>{{ $danhGia->user->email }}</td>
                                        @endif
                                        @if ($danhGia->mon_an_id == null)
                                            <td></td>
                                        @else
                                            <td>{{ $danhGia->monAn->ten_mon }}</td>
                                        @endif
                                        @if ($danhGia->dia_diem_id == null)
                                            <td></td>
                                        @else
                                            <td>{{ $danhGia->diaDiem->ten_dia_diem }}</td>
                                        @endif

                                        <td> <a href="{{ route('danhGia.xoa', $danhGia->id) }}"><button type="button"
                                                    id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-lock-open me-1"></i> </button></a></td>
                                    </tr>
                                </tbody>
                            @else
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            {{ $danhGia->danh_gia_sao }}
                                        </td>
                                        @if ($danhGia->user_id == null)
                                            <td></td>
                                        @else
                                            <td>{{ $danhGia->user->email }}</td>
                                        @endif
                                        @if ($danhGia->mon_an_id == null)
                                            <td></td>
                                        @else
                                            <td>{{ $danhGia->monAn->ten_mon }}</td>
                                        @endif
                                        @if ($danhGia->dia_diem_id == null)
                                            <td></td>
                                        @else
                                            <td>{{ $danhGia->diaDiem->ten_dia_diem }}</td>
                                        @endif

                                        <td> <a href="{{ route('danhGia.xoa', $danhGia->id) }}"><button type="button"
                                                    id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-lock me-1"></i> </button></a></td>
                                    </tr>
                                </tbody>
                            @endif
                        @endforeach
                    </table>
                    @if ($lstDanhGia->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstDanhGia->appends($request->except('page'))->links() }}
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
