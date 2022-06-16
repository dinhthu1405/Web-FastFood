@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí ảnh bìa')
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
                    <a href="{{ route('anhBias.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            ảnh bìa</button></a>
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
                <h5 class="card-header">Danh sách ảnh bìa</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên món</th>
                                <th>Ảnh bìa</th>
                                <th>Chỉnh sửa</th>
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <?php $count = $lstAnhBia->perPage() * ($lstAnhBia->currentPage() - 1) + 1; ?>
                        @foreach ($lstAnhBia as $anhBia)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $anhBia->monAn->ten_mon }}</strong>
                                    </td>
                                    @foreach ($lstHinhAnh as $hinhAnh)
                                        @if ($anhBia->id == $hinhAnh->anh_bia_id)
                                            {{-- <button type="button" id="btn-image" class="btn btn-success py-2 mb-4" data-target="#modal-add"
                                        data-bs-toggle="modal" data-bs-target="#modalCenter">

                                        </button> --}}
                                            <td><img style="vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;"
                                                    src="{{ asset("storage/$hinhAnh->duong_dan") }}" id="btn-image"
                                                    data-target="#modal-add" data-bs-toggle="modal"
                                                    data-bs-target='#modalCenter{{ $count }}' alt="">
                                            </td>
                                            <div class="modal fade" id="modalCenter{{ $count }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <img style="vertical-align: middle; height: 50%; "
                                                            src="{{ asset("storage/$hinhAnh->duong_dan") }}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <td><a href="{{ route('anhBias.edit', $anhBia->id) }}"><button type="button"
                                                id="btn-edit" class="btn btn-warning py-2 mb-4" data-target="#modal-edit"
                                                data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                    <td> <a href="{{ route('anhBias.xoa', $anhBia->id) }}"
                                            onclick="return confirm('Bạn có chắc muốn xoá ảnh bìa')"><button type="button"
                                                id="btn-edit" class="btn btn-danger py-2 mb-4" data-target="#modal-edit"
                                                data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-trash me-1"></i> </button></a></td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    @if ($lstAnhBia->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstAnhBia->links() }}
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
