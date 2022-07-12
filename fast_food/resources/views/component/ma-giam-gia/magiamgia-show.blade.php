@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí mã giảm giá')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('maGiamGia.index') }}"><span
                                class="text-muted fw-light">Danh sách</span></a></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <a href="{{ route('maGiamGia.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            mã giảm giá</button></a>
                </div>
            </div>
            <form action="{{ route('maGiamGia.search') }}" method="GET">
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
                <h5 class="card-header">Danh sách mã giảm giá</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Tên mã</th>
                                <th>Tiền giảm</th>
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
                            @if ($maGiamGia->trang_thai == 0 || $maGiamGia->so_luong == 0)
                                <tbody class="table-border-bottom-0" style="background-color: #ECEEF1">
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong>{{ $maGiamGia->ten_ma }}</strong>
                                        </td>
                                        <td>10000</td>
                                        <td>{{ $maGiamGia->so_luong }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($maGiamGia->ngay_bat_dau)) }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($maGiamGia->ngay_ket_thuc)) }}</td>
                                        <td>{{ $maGiamGia->loaiGiamGia->ten_loai_giam_gia }}</td>
                                        <td><a href="{{ route('maGiamGia.edit', $maGiamGia->id) }}"><button
                                                    type="button" id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                        <td> <button type="button" id="btn-delete" class="btn btn-danger py-2 mb-4"
                                                data-target="#modal-delete" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Delete-Unlock{{ $maGiamGia->id }}">
                                                <i class="bx bx-lock-open me-1"></i> </button></td>
                                        <!-- Modal Cảnh báo (Mở khoá)-->
                                        <div class="modal fade" id="modalCenter-Delete-Unlock{{ $maGiamGia->id }}"
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
                                                                <span style="font-size: 22px; padding-left: 5%">
                                                                    Bạn có chắc muốn mở khoá mã giảm giá này
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding: 3%">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-3">
                                                            <a href="{{ route('maGiamGia.xoa', $maGiamGia->id) }}"><button
                                                                    type="submit" class="btn btn-danger btn-delete-confirm"
                                                                    data-bs-dismiss="modal">Mở khoá</button></a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button type="submit" value="delete"
                                                                class="btn btn-primary btn-delete-close">Huỷ</button>
                                                        </div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-2"></div>
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
                                            <strong>{{ $maGiamGia->ten_ma }}</strong>
                                        </td>
                                        <td>10000</td>
                                        <td>{{ $maGiamGia->so_luong }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($maGiamGia->ngay_bat_dau)) }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($maGiamGia->ngay_ket_thuc)) }}</td>
                                        <td>
                                            <a style="color: #697a8d"
                                                href="{{ route('loaiGiamGia.index1', [$maGiamGia->loai_giam_gia_id]) }}">{{ $maGiamGia->loaiGiamGia->ten_loai_giam_gia }}
                                            </a>
                                        </td>

                                        <td><a href="{{ route('maGiamGia.edit', $maGiamGia->id) }}"><button
                                                    type="button" id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                        <td><button type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                data-target="#modal-edit" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-Delete-Lock{{ $maGiamGia->id }}">
                                                <i class="bx bx-lock me-1"></i> </button></td>
                                        <!-- Modal Cảnh báo (Khoá)-->
                                        <div class="modal fade" id="modalCenter-Delete-Lock{{ $maGiamGia->id }}"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    @if (Session::has('success'))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ Session::get('success') }}
                                                        </div>
                                                    @endif
                                                    @if (Session::has('error'))
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ Session::get('error') }}</div>
                                                    @endif
                                                    @if ($errors->any())
                                                        @foreach ($errors->all() as $error)
                                                            <div class="alert alert-danger" role="alert">
                                                                {{ $error }}
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="mb-3" style="text-align: center">
                                                                <img src="{{ asset('assets/img/icons/unicons/!.png') }}"
                                                                    alt="" width="180px" height="75px">
                                                            </div>
                                                            <div class="mb3 text-nowrap" style="text-align: center">
                                                                <span style="font-size: 22px; padding-left: 5%">
                                                                    Bạn có chắc muốn khoá mã giảm giá này
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding: 3%">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-4">
                                                            <a href="{{ route('maGiamGia.xoa', $maGiamGia->id) }}"><button
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
                                    $('#modalCenter-Delete-Unlock{{ $maGiamGia->id }}').modal('hide');
                                    $('#modalCenter-Delete-Lock{{ $maGiamGia->id }}').modal('hide');
                                });
                            </script>
                        @endforeach
                    </table>
                    @if ($lstMaGiamGia->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstMaGiamGia->appends($request->except('page'))->onEachSide(1)->links() }}
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
            @include('Partial/ma-giam-gia/JSPartial-magiamgia-show')
        @endsection
