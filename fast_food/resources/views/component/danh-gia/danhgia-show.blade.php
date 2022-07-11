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
                                <th>Thời gian</th>
                                <th>Người dùng</th>
                                <th>Món ăn</th>
                                <th>Duyệt</th>
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
                                        @if ($danhGia->noi_dung == null)
                                            <td></td>
                                        @else
                                            <td>{{ str_limit($danhGia->noi_dung, 10) }}</td>
                                        @endif
                                        @if ($danhGia->thoi_gian == null)
                                            <td></td>
                                        @else
                                            <td>{{ date('d-m-Y H:i:s', strtotime($danhGia->thoi_gian)) }}</td>
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
                                        @if ($danhGia->duyet == 1)
                                            <td>
                                                <span class="badge bg-label-success me-1">Đã duyệt</span>
                                            </td>
                                        @else
                                            <td>
                                                @if ($danhGia->trang_thai == 1)
                                                    <a href="{{ route('danhGias.index1', $danhGia->duyet) }}">
                                                        <span class="badge bg-label-warning me-1">Chưa duyệt</span></a>
                                                @else
                                                    <span class="badge bg-label-warning me-1">Chưa duyệt</span>
                                                @endif
                                            </td>
                                        @endif
                                        <td> <button type="button" id="btn-delete" class="btn btn-danger py-2 mb-4"
                                                data-target="#modal-delete" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Delete-UnLock{{ $danhGia->id }}">
                                                <i class="bx bx-lock-open me-1"></i> </button></td>

                                        <!-- Modal Cảnh báo -->
                                        <div class="modal fade" id="modalCenter-Delete-UnLock{{ $danhGia->id }}"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="mb-3" style="text-align: center">
                                                                <img src="{{ asset('assets/img/icons/unicons/!.png') }}"
                                                                    alt="" width="180px" height="75px">
                                                            </div>
                                                            <div class="mb3 text-nowrap" style="text-align: center">
                                                                <span style="font-size: 22px">
                                                                    Bạn có chắc muốn mở khoá đánh giá này
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding: 3%">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-4">
                                                            <a href="{{ route('danhGia.xoa', $danhGia->id) }}"><button
                                                                    type="submit" class="btn btn-danger btn-delete-confirm"
                                                                    data-bs-dismiss="modal">Mở khoá</button></a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button type="submit" value="delete"
                                                                class="btn btn-primary btn-delete-close">Huỷ</button>
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                        @if ($danhGia->thoi_gian == null)
                                            <td></td>
                                        @else
                                            <td>{{ date('d-m-Y H:i:s', strtotime($danhGia->thoi_gian)) }}</td>
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
                                        @if ($danhGia->duyet == 1)
                                            <td>
                                                <span class="badge bg-label-success me-1">Đã duyệt</span>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('danhGias.index1', $danhGia->id) }}"><span
                                                        class="badge bg-label-warning me-1">Chưa duyệt</span></a>
                                            </td>
                                        @endif
                                        <td><button type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                data-target="#modal-edit" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Delete-Lock{{ $danhGia->id }}">
                                                <i class="bx bx-lock me-1"></i> </button></td>
                                        <!-- Modal Cảnh báo -->
                                        <div class="modal fade" id="modalCenter-Delete-Lock{{ $danhGia->id }}"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="mb-3" style="text-align: center">
                                                                <img src="{{ asset('assets/img/icons/unicons/!.png') }}"
                                                                    alt="" width="180px" height="75px">
                                                            </div>
                                                            <div class="mb3 text-nowrap" style="text-align: center">
                                                                <span style="font-size: 22px">
                                                                    Bạn có chắc muốn khoá đánh giá này
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding: 3%">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-4">
                                                            <a href="{{ route('danhGia.xoa', $danhGia->id) }}"><button
                                                                    type="submit"
                                                                    class="btn btn-danger btn-delete-confirm"
                                                                    data-bs-dismiss="modal">Khoá</button></a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button type="submit" value="delete"
                                                                class="btn btn-primary btn-delete-close">Huỷ</button>
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                </tbody>
                            @endif
                            <script>
                                $(document).on('click', '.btn-delete-close', function(e) {
                                    $('#modalCenter-Delete-UnLock{{ $danhGia->id }}').modal('hide');
                                    $('#modalCenter-Delete-Lock{{ $danhGia->id }}').modal('hide');
                                    console.log('ok');
                                });
                            </script>
                        @endforeach
                    </table>
                    @if ($lstDanhGia->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstDanhGia->appends($request->except('page'))->onEachSide(5)->links() }}
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
            @include('Partial/danh-gia/JSPartial-danhgia-show')
        @endsection
