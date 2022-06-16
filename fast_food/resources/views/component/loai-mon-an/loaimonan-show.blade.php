@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí loại món ăn')
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
                    <a href="{{ route('loaiMonAn.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            loại món ăn</button></a>
                </div>
            </div>
            <form action="{{ route('loaiMonAn.search') }}" method="POST">
                {{ csrf_field() }}
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
                <h5 class="card-header">Danh sách loại món ăn</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên loại</th>
                                {{-- <th>Chỉnh sửa</th> --}}
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <?php $count = $lstLoaiMonAn->perPage() * ($lstLoaiMonAn->currentPage() - 1) + 1; ?>
                        @foreach ($lstLoaiMonAn as $loaiMonAn)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $loaiMonAn->ten_loai }}</strong>
                                    </td>
                                    {{-- <td><a href="{{ route('loaiMonAn.edit', $loaiMonAn->id) }}"><button type="button" id="btn-edit" class="btn btn-warning py-2 mb-4" data-target="#modal-edit" data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                        <i class="bx bx-edit-alt me-1"></i> </button></a> </td> --}}
                                    <td> <a href="{{ route('loaiMonAn.xoa', $loaiMonAn->id) }}"
                                            onclick="return confirm('Bạn có chắc muốn xoá loại món ăn này, vì nó có thể ảnh hưởng đến món ăn; đánh giá và bình luận')"><button
                                                type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                data-target="#modal-edit" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-trash me-1"></i> </button></a></td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    @if ($lstLoaiMonAn->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstLoaiMonAn->appends($request->except('page'))->links() }}
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
        <!-- Bootstrap Table with Header - Light -->
    @endsection
