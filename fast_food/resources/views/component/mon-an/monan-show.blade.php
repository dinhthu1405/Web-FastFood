@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí món ăn')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <a href="#" onclick="document.getElementById('id{{ $loi->id }}').style.display='block'"
                        style="width:auto;"><button type="button" class="btn btn-success py-2 mb-4">Thêm món
                        </button></a>
                    {{-- <a href="#" onclick="document.getElementById('id{{ $loi->id }}').style.display='block'"
                        style="width:auto;">Xem thêm</a> --}}
                    <div id="id{{ $loi->id }}" class="modal">
                        <form class="modal-content animate">
                            <span onclick="document.getElementById('id{{ $loi->id }}').style.display='none'"
                                class="close" title="Close Modal">&times;</span>
                            <div class="container">
                                <span>{{ $loi->ten_loi }}</span>
                            </div>
                        </form>
                    </div>
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
                        <?php $count = 1; ?>
                        @foreach ($lstMonAn as $monAn)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $monAn->ten_mon }}</strong>
                                    </td>
                                    <td><a href="{{ route('monAn.images', $monAn->id) }}" class="btn btn-outline-dark">Xem
                                            hình</a></td>
                                    <td>{{ $monAn->don_gia }}</td>
                                    <td>{{ $monAn->so_luong }}</td>
                                    <td>{{ $monAn->loaiMonAn->ten_loai }}</td>
                                    <td>{{ $monAn->diaDiem->ten_dia_diem }}</td>
                                    @if ($monAn->tinh_trang == 1)
                                        <td>Còn món</td>
                                    @else
                                        <td>Hết món</td>
                                    @endif
                                    <td> <a class="dropdown-item" href="{{ route('monAn.edit', $monAn->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i></a></td>
                                    <td> <a class="dropdown-item" href="{{ route('monAn.xoa', $monAn->id) }}"
                                            onclick="return confirm('Bạn có chắc muốn xoá món ăn này')"><i
                                                class="bx bx-trash me-1"></i></a></td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
        @endsection
