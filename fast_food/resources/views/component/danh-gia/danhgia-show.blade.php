@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí đánh giá')
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
                    {{-- <a href="{{ route('danhGia.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                                    đánh giá</button></a> --}}
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
                <h5 class="card-header">Danh sách đánh giá</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Đánh giá sao</th>
                                <th>Nội dung</th>
                                <th>Người dùng</th>
                                <th>Món ăn</th>
                                <th>Địa điểm</th>
                                <th>Khoá - Mở</th>
                            </tr>
                        </thead>
                        <?php $count = 1; ?>
                        @foreach ($lstDanhGia as $danhGia)
                            @if ($danhGia->trang_thai == 0)
                                <tbody class="table-border-bottom-0" style="background-color: #ECEEF1">
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            {{ $danhGia->danh_gia_sao }}
                                        </td>
                                        @if ($danhGia->noi_dung == null)
                                            <td></td>
                                        @else
                                            <td>{{ $danhGia->noi_dung }}</td>
                                        @endif
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
                                            {{ $danhGia->danh_gia_sao }}
                                        </td>
                                        @if ($danhGia->noi_dung == null)
                                            <td></td>
                                        @else
                                            <td>{{ $danhGia->noi_dung }}</td>
                                        @endif
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
                                                    id="btn-edit" class="btn btn-danger py-2 mb-4" data-target="#modal-edit"
                                                    data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-lock me-1"></i> </button></a></td>
                                    </tr>
                                </tbody>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
        @endsection
