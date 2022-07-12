@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang chi tiết đơn hàng')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('donHang.index') }}"><span
                                class="text-muted fw-light">Danh sách đơn hàng / </span></a><a
                            href="{{ route('donHang.show', $id) }}"><span class="text-muted fw-dark">Chi tiết
                                đơn hàng</a></span>
                    </h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                </div>
            </div>
            <form action="{{ route('donHang.searchChiTietDonHang') }}" method="GET">
                <input type="hidden" name="id" value="{{ $id }}" />
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
                <h5 class="card-header">Danh sách chi tiết đơn hàng</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Mã đơn</th>
                                <th>Hình ảnh</th>
                                <th>Tên món</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                {{-- <th>Chỉnh sửa</th>
                                        <th>Xoá</th> --}}
                            </tr>
                        </thead>
                        <?php $count = $lstChiTietDonHang->perPage() * ($lstChiTietDonHang->currentPage() - 1) + 1; ?>
                        @foreach ($lstChiTietDonHang as $chiTietDonHang)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td>
                                        {{ $chiTietDonHang->don_hang_id }}
                                    </td>
                                    @foreach ($lstHinhAnh as $hinhAnh)
                                        @if ($hinhAnh->mon_an_id == $chiTietDonHang->mon_an_id)
                                            <td>
                                                <img class="d-block w-100" id="preview-image"
                                                    src="{{ asset("storage/$hinhAnh->duong_dan") }}" alt="preview image"
                                                    style="max-height: 80px; max-width: 100px; border-radius: 50%;"
                                                    data-target="#modal-add" data-bs-toggle="modal"
                                                    data-bs-target='#modalCenter{{ $chiTietDonHang->id }}' />
                                            </td>
                                        @break
                                    @endif
                                @endforeach
                                <div class="modal fade" id="modalCenter{{ $chiTietDonHang->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            @foreach ($lstHinhAnh as $hinhAnh)
                                                @if ($hinhAnh->mon_an_id == $chiTietDonHang->mon_an_id)
                                                    <img class="d-block w-100" id="preview-image"
                                                        src="{{ asset("storage/$hinhAnh->duong_dan") }}"
                                                        alt="preview image" style="max-height: 200px;" />
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @foreach ($lstMonAn as $monAn)
                                    @if ($monAn->id == $chiTietDonHang->mon_an_id)
                                        <td>{{ $monAn->ten_mon }}</td>
                                    @endif
                                @endforeach
                                <td>{{ number_format($chiTietDonHang->don_gia) }}</td>
                                <td>{{ $chiTietDonHang->so_luong }}</td>
                                <td>{{ number_format($chiTietDonHang->thanh_tien) }}</td>
                                {{-- <td><a href="{{ route('donHang.edit', $donHang->id) }}"><button type="button"
                                                        id="btn-edit" class="btn btn-warning py-2 mb-4" data-target="#modal-edit"
                                                        data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                        <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                            <td> <a href="{{ route('donHang.xoa', $donHang->id) }}"
                                                    onclick="return confirm('Bạn có chắc muốn xoá món ăn này')"><button
                                                        type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                        data-target="#modal-edit" data-bs-toggle="modal"
                                                        data-bs-target="#modalCenter-Edit">
                                                        <i class="bx bx-trash me-1"></i> </button></a></td> --}}
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                @if ($lstChiTietDonHang->total() > 5)
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <!-- Basic Pagination -->
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        {{ $lstChiTietDonHang->appends($request->except('page'))->onEachSide(1)->links() }}
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
        @include('Partial/don-hang/JSPartial-donhang-show')
    @endsection
