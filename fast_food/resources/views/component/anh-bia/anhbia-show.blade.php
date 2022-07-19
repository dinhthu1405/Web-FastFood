@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí ảnh bìa')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('anhBias.index') }}"><span
                                class="text-muted fw-light">Danh sách</span></a></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <a href="{{ route('anhBias.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            ảnh bìa</button></a>
                </div>
            </div>
            {{-- <form action="{{ route('loaiMonAn.search') }}" method="post">
                {{ csrf_field() }}
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
            </form> --}}
            <br />
            <!-- Bootstrap Table with Header - Light -->
            <div class="card">
                <form method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-header">Danh sách ảnh bìa</h5>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for=""></label>
                                <button formaction="{{ route('anhBia.xoaNhieu') }}" type="submit"
                                    class="form-control btn btn-primary">Xoá
                                    lựa chọn</button>
                            </div>

                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên món</th>
                                    <th>Ảnh bìa</th>
                                    <th>Chỉnh sửa</th>
                                    <th>Xoá</th>
                                    <th><input type="checkbox" class="checkAll" /></th>
                                </tr>
                            </thead>
                            <?php $count = $lstAnhBia->perPage() * ($lstAnhBia->currentPage() - 1) + 1; ?>
                            @foreach ($lstAnhBia as $anhBia)
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td>
                                            <strong>
                                                <a style="color: #697a8d"
                                                    href="{{ route('monAn.index1', [$anhBia->mon_an_id]) }}">{{ $anhBia->monAn->ten_mon }}
                                                </a>
                                            </strong>
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
                                                <div class="modal fade" id="modalCenter{{ $count }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <img style="vertical-align: middle; height: 50%; "
                                                                src="{{ asset("storage/$hinhAnh->duong_dan") }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <td><a href="{{ route('anhBias.edit', $anhBia->id) }}"><button type="button"
                                                    id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                        <td> <button type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                data-target="#modal-edit" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Delete{{ $anhBia->id }}">
                                                <i class="bx bx-trash me-1"></i> </button></td>
                                        <td class="selectBox"><input name='ids[]' type="checkbox" id="checkItem"
                                                value="{{ $anhBia->id }}"></td>

                                        <!-- Modal Cảnh báo -->
                                        <div class="modal fade" id="modalCenter-Delete{{ $anhBia->id }}" tabindex="-1"
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
                                                                <span style="font-size: 22px;">Bạn có chắc muốn xoá ảnh bìa
                                                                    này
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding: 3%">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-2">
                                                            <button formaction="{{ route('anhBia.xoa', $anhBia->id) }}"
                                                                type="submit" class="btn btn-danger btn-delete-confirm"
                                                                data-bs-dismiss="modal">Xoá</button>
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
                                <script>
                                    $(document).on('click', '.btn-delete-close', function(e) {
                                        $('#modalCenter-Delete{{ $anhBia->id }}').modal('hide');
                                    });
                                </script>
                            @endforeach
                        </table>
                        @if ($lstAnhBia->total() > 5)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <!-- Basic Pagination -->
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination">
                                                {{ $lstAnhBia->onEachSide(1)->links() }}
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
            @include('Partial/anh-bia/JSPartial-anhbia-show')
        @endsection
