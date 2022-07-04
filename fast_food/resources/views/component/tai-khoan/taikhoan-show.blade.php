@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí tài khoản')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('taiKhoan.index') }}"><span
                                class="text-muted fw-light">Danh
                                sách</span></a></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">

                    @if (Auth::user()->phan_loai_tai_khoan == 1)
                        <a href="{{ route('taiKhoan.create') }}"><button type="button"
                                class="btn btn-success py-2 mb-4">Thêm
                                tài khoản</button></a>
                    @else
                        <div></div>
                    @endif

                </div>
            </div>
            <form action="{{ route('taiKhoan.search') }}" method="GET">
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
                <h5 class="card-header">Danh sách tài khoản</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Email</th>
                                <th>Hình ảnh</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th>Loại tài khoản</th>
                                <th>Chỉnh sửa</th>
                                <th>Khoá - Mở</th>
                            </tr>
                        </thead>
                        <?php $count = $lstTaiKhoan->perPage() * ($lstTaiKhoan->currentPage() - 1) + 1; ?>
                        @foreach ($lstTaiKhoan as $taiKhoan)
                            @if ($taiKhoan->trang_thai == 0 && $taiKhoan->phan_loai_tai_khoan != 1)
                                <tbody class="table-border-bottom-0" style="background-color: #ECEEF1">
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td>
                                            <strong>{{ $taiKhoan->email }}</strong>
                                        </td>
                                        @foreach ($lstHinhAnh as $hinhAnh)
                                            @if ($taiKhoan->id == $hinhAnh->user_id)
                                                <td><img style=" vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;"
                                                        src="{{ asset("storage/$hinhAnh->duong_dan") }}" alt="">
                                                </td>
                                            @endif
                                        @endforeach
                                        <td>{{ $taiKhoan->ho_ten }}</td>
                                        <td>{{ $taiKhoan->sdt }}</td>
                                        <td>{{ $taiKhoan->ngay_sinh }}</td>
                                        <td data-target="#modal-add" data-bs-toggle="modal"
                                            data-bs-target='#modalCenter{{ $taiKhoan->id }}'>{{ $taiKhoan->dia_chi }}
                                        </td>
                                        <div class="modal fade" id="modalCenter{{ $taiKhoan->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Địa chỉ</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">{{ $taiKhoan->dia_chi }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($taiKhoan->phan_loai_tai_khoan == 2)
                                            <td>Quản lí</td>
                                        @endif
                                        @if ($taiKhoan->phan_loai_tai_khoan == 3)
                                            <td>Người giao hàng</td>
                                        @endif
                                        @if ($taiKhoan->phan_loai_tai_khoan == 0)
                                            <td>Người dùng</td>
                                        @endif
                                        <td><a href="{{ route('taiKhoan.edit', $taiKhoan->id) }}"><button type="button"
                                                    id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Edit">
                                                    <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                        @if ($taiKhoan->phan_loai_tai_khoan == 1)
                                            <td></td>
                                        @else
                                            <td> <button type="button" id="btn-delete" class="btn btn-danger py-2 mb-4"
                                                    data-target="#modal-delete" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Delete-Unlock">
                                                    <i class="bx bx-lock-open me-1"></i> </button></td>
                                        @endif
                                        <!-- Modal Cảnh báo (Mở khoá)-->
                                        <div class="modal fade" id="modalCenter-Delete-Unlock" tabindex="-1"
                                            aria-hidden="true">
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
                                                                    Bạn có chắc muốn mở khoá tài khoản này
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding: 3%">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-3">
                                                            <a href="{{ route('taiKhoan.khoa_mo', $taiKhoan->id) }}"><button
                                                                    type="submit"
                                                                    class="btn btn-danger btn-delete-confirm"
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
                            @elseif ($taiKhoan->trang_thai == 1 && $taiKhoan->phan_loai_tai_khoan != 1)
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td> {{ $count++ }} </td>
                                        <td>
                                            <strong>{{ $taiKhoan->email }}</strong>
                                        </td>
                                        {{-- @if ($taiKhoan->id == $taiKhoan->hinhAnh->user_id)
                            @foreach ($lstHinhAnh as $hinhAnh)
                            <td><img style=" vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;" src="{{ asset("storage/$hinhAnh->duong_dan") }}" alt=""></td>
                            @endforeach
                            <td><img style=" vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;" src="{{ asset("storage/$taiKhoan->hinhAnh->duong_dan") }}" alt=""></td>
                            @else
                            <td><img style=" vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;" src="{{ asset("storage/17.jpg") }}" alt=""></td>
                            @endif --}}
                                        @foreach ($lstHinhAnh as $hinhAnh)
                                            @if ($taiKhoan->id == $hinhAnh->user_id)
                                                <td><img style=" vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;"
                                                        src="{{ asset("storage/$hinhAnh->duong_dan") }}"
                                                        alt="">
                                                </td>
                                            @endif
                                        @endforeach
                                        <td>{{ $taiKhoan->ho_ten }}</td>
                                        <td>{{ $taiKhoan->sdt }}</td>
                                        <td>{{ date('d-m-Y', strtotime($taiKhoan->ngay_sinh)) }}</td>
                                        <td data-target="#modal-add" data-bs-toggle="modal"
                                            data-bs-target='#modalCenter{{ $taiKhoan->id }}'>{{ $taiKhoan->dia_chi }}
                                        </td>
                                        <div class="modal fade" id="modalCenter{{ $taiKhoan->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Địa chỉ</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">{{ $taiKhoan->dia_chi }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($taiKhoan->phan_loai_tai_khoan == 2)
                                            <td>Quản lí</td>
                                        @endif
                                        @if ($taiKhoan->phan_loai_tai_khoan == 3)
                                            <td>Người giao hàng</td>
                                        @endif
                                        @if ($taiKhoan->phan_loai_tai_khoan == 0)
                                            <td>Người dùng</td>
                                        @endif
                                        @if (Auth::user()->phan_loai_tai_khoan == 1)
                                            <td><a href="{{ route('taiKhoan.edit', $taiKhoan->id) }}"><button
                                                        type="button" id="btn-edit" class="btn btn-warning py-2 mb-4"
                                                        data-target="#modal-edit" data-bs-toggle="modal"
                                                        data-bs-target="#modalCenter-Edit">
                                                        <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                            <td><button type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Delete-Lock">
                                                    <i class="bx bx-lock me-1"></i> </button></td>
                                        @endif

                                        @if (Auth::user()->phan_loai_tai_khoan == 2)
                                            @if ($taiKhoan->phan_loai_tai_khoan == 2)
                                                <td></td>
                                                <td></td>
                                            @else
                                                <td><a href="{{ route('taiKhoan.edit', $taiKhoan->id) }}"><button
                                                            type="button" id="btn-delete"
                                                            class="btn btn-warning py-2 mb-4" data-target="#modal-delete"
                                                            data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                            <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                                <td> <button type="button" id="btn-delete"
                                                        class="btn btn-danger py-2 mb-4" data-target="#modal-delete"
                                                        data-bs-toggle="modal" data-bs-target="#modalCenter-Delete-Lock">
                                                        <i class="bx bx-lock me-1"></i> </button></td>
                                            @endif
                                        @endif
                                        <!-- Modal Cảnh báo (Khoá)-->
                                        <div class="modal fade" id="modalCenter-Delete-Lock" tabindex="-1"
                                            aria-hidden="true">
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
                                                                    Bạn có chắc muốn khoá tài khoản này
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding: 3%">
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-4">
                                                            <a href="{{ route('taiKhoan.khoa_mo', $taiKhoan->id) }}"><button
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
                        @endforeach
                    </table>
                    @if ($lstTaiKhoan->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstTaiKhoan->appends($request->except('page'))->onEachSide(1)->links() }}
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
            @include('Partial/tai-khoan/JSPartial-taikhoan-show')
        @endsection
