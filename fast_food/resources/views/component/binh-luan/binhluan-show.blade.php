@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí bình luận')
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
                    {{-- <a href="{{ route('binhLuan.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            bình luận</button></a> --}}
                </div>
            </div>
            <form action="{{ route('monAn.search') }}" method="post">
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
                <h5 class="card-header">Danh sách bình luận</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Nội dung</th>
                                <th>Thời gian</th>
                                <th>Người dùng</th>
                                <th>Món ăn</th>
                                <th>Khoá - Mở</th>
                            </tr>
                        </thead>
                        <?php $count = $lstBinhLuan->perPage() * ($lstBinhLuan->currentPage() - 1) + 1; ?>
                        @foreach ($lstBinhLuan as $binhLuan)
                            @if ($binhLuan->trang_thai == 0)
                                <tbody class="table-border-bottom-0" style="background-color: #ECEEF1">
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            {{ $binhLuan->noi_dung }}
                                        </td>
                                        @if ($binhLuan->thoi_gian == null)
                                            <td></td>
                                        @else
                                            <td>{{ date('d-m-Y: H:i:s', strtotime($binhLuan->thoi_gian)) }}</td>
                                        @endif
                                        @foreach ($lstTaiKhoan as $taiKhoan)
                                            @if ($binhLuan->user_id == $taiKhoan->id)
                                                <td>{{ $taiKhoan->email }}</td>
                                            @endif
                                        @endforeach
                                        @foreach ($lstMonAn as $monAn)
                                            @if ($binhLuan->mon_an_id == $monAn->id)
                                                <td>{{ $monAn->ten_mon }}</td>
                                            @endif
                                        @endforeach

                                        <td> <a href="{{ route('binhLuan.xoa', $binhLuan->id) }}"><button type="button"
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
                                            {{ $binhLuan->noi_dung }}
                                        </td>
                                        @if ($binhLuan->thoi_gian == null)
                                            <td></td>
                                        @else
                                            <td>{{ date('d-m-Y: H:i:s', strtotime($binhLuan->thoi_gian)) }}</td>
                                        @endif
                                        @foreach ($lstTaiKhoan as $taiKhoan)
                                            @if ($binhLuan->user_id == $taiKhoan->id)
                                                <td>{{ $taiKhoan->email }}</td>
                                            @endif
                                        @endforeach
                                        @foreach ($lstMonAn as $monAn)
                                            @if ($binhLuan->mon_an_id == $monAn->id)
                                                <td>{{ $monAn->ten_mon }}</td>
                                            @endif
                                        @endforeach

                                        <td> <a href="{{ route('binhLuan.xoa', $binhLuan->id) }}"><button type="button"
                                                    id="btn-edit" class="btn btn-danger py-2 mb-4" data-target="#modal-edit"
                                                    data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-lock me-1"></i> </button></a></td>
                                    </tr>
                                </tbody>
                            @endif
                        @endforeach
                    </table>
                    @if ($lstBinhLuan->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstBinhLuan->links() }}
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
