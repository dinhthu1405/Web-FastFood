@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang điểm mua hàng')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><a href="{{ route('diemMuaHang.index') }}"><span
                                class="text-muted fw-light">Danh sách</span></a></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    {{-- <a href="{{ route('anhBias.create') }}"><button type="button" class="btn btn-success py-2 mb-4">Thêm
                            điểm mua hàng</button></a> --}}
                </div>
            </div>
            {{-- <form action="{{ route('diemMuaHang.search') }}" method="GET">
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
                <h5 class="card-header">Danh sách điểm mua hàng</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Số điểm</th>
                                <th>Người dùng</th>
                                <th>Tổng đơn hàng</th>
                                {{-- <th>Chi tiết</th> --}}
                                <th>Xoá</th>
                            </tr>
                        </thead>
                        <?php
                        $count = $lstDiemMuaHang->perPage() * ($lstDiemMuaHang->currentPage() - 1) + 1;
                        $lstDiemMuaHangs = App\Models\DiemMuaHang::all();
                        $lstUsers = App\Models\User::all();
                        $lstDonHang = App\Models\DonHang::all();
                        $lstDonHangUnique = $lstDonHang->unique('user_id');
                        $lstDiemMuaHangUnique = $lstDiemMuaHangs->unique('user_id');
                        
                        $lstDiemMuaHangDupes = $lstDiemMuaHangs->diff($lstDiemMuaHangUnique);
                        // $results = App\Models\DiemMuaHang::whereIn('user_id', function ($query) {
                        //     $query
                        //         ->selectRaw('user_id')
                        //         ->from('diem_mua_hangs')
                        //         ->groupBy('user_id')
                        //         ->havingRaw('count(*) > 1');
                        // })->get();
                        //Lấy tổng điểm
                        $resultDiem = $lstDiemMuaHangs
                            ->mapToGroups(function ($item) {
                                return [$item->user_id => $item->so_diem];
                            })
                            ->map->sum();
                        //Lấy tổng đơn hàng
                        $resultTongDonHang = $lstDiemMuaHangs
                            ->mapToGroups(function ($item) {
                                return [$item->user_id => $item->so_diem];
                            })
                            ->map->count();
                        //Lấy email
                        $resultEmail = $lstUsers->mapToGroups(function ($item) {
                            return [$item->id => $item->email];
                        });
                        // $result = $lstDiemMuaHangs->sum(function ($item) {
                        //     return $item->so_diem;
                        // });
                        
                        // dump($resultEmail);
                        ?>
                        @foreach ($lstDiemMuaHangUnique as $diemMuaHang)
                            @foreach ($lstDonHangUnique as $donHang)
                                @if ($diemMuaHang->user_id == $donHang->user_id)
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td> {{ $count++ }} </td>
                                            <td>
                                                @foreach ($resultDiem as $key => $value)
                                                    @if ($key == $diemMuaHang->user_id)
                                                        {{ $value }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            {{-- @foreach ($lstTaiKhoan as $taiKhoan)
                                                @if ($diemMuaHang->user_id == $taiKhoan->id) --}}
                                            @foreach ($resultEmail as $key => $value)
                                                @if ($key == $diemMuaHang->user_id)
                                                    @foreach ($value as $key1 => $value1)
                                                        <td>
                                                            <a style="color: #697a8d"
                                                                href="{{ route('taiKhoan.index1', [$diemMuaHang->user_id, 0]) }}">{{ $value1 }}
                                                            </a>
                                                        </td>
                                                    @endforeach
                                                @endif
                                            @endforeach

                                            {{-- @endif
                                        @endforeach --}}
                                            @foreach ($resultTongDonHang as $key => $value)
                                                @if ($key == $diemMuaHang->user_id)
                                                    <td data-target="#modal-detail" data-bs-toggle="modal"
                                                        data-bs-target="#modalCenter-Detail{{ $key }}">
                                                        {{ $value }}</td>
                                                @endif
                                            @endforeach
                                            @foreach ($resultEmail as $key => $value)
                                                @if ($key == $diemMuaHang->user_id)
                                                    @foreach ($value as $key1 => $value1)
                                                        <div class="modal fade" id="modalCenter-Detail{{ $key }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalCenterTitle">
                                                                            Chi tiết điểm mua hàng của "{{ $value1 }}"
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-1">
                                                                                <strong>STT</strong>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <strong>Mã đơn hàng</strong>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <strong>Thời gian</strong>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <strong>Tổng tiền</strong>
                                                                            </div>
                                                                        </div>
                                                                        <?php $countDetail = 1; ?>
                                                                        @foreach ($lstDiemMuaHangs as $diemMuaHang1)
                                                                            @foreach ($lstDonHang as $donHang1)
                                                                                @if ($diemMuaHang1->don_hang_id == $donHang1->id)
                                                                                    {{-- @dump($diemMuaHang1->don_hang_id) --}}
                                                                                    @if ($key == $diemMuaHang1->user_id)
                                                                                        <div class="row">
                                                                                            <div class="col-md-1">
                                                                                                {{ $countDetail++ }}
                                                                                            </div>
                                                                                            <div class="col-md-3">
                                                                                                {{ $donHang1->id }}
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                {{ date('d-m-Y H:i:s', strtotime($donHang1->ngay_lap_dh)) }}
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                {{ number_format($donHang1->tong_tien) }}
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- <td>
                                                        <button type="button" id="btn-detail"
                                                            class="btn btn-info py-2 mb-4" data-target="#modal-detail"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalCenter-Detail{{ $key }}">
                                                            <i class="bx bx-edit-alt me-1"></i> </button>
                                                    </td> --}}
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            <td> <button type="button" id="btn-edit" class="btn btn-danger py-2 mb-4"
                                                    data-target="#modal-edit" data-bs-toggle="modal"
                                                    data-bs-target="#modalCenter-Delete{{ $diemMuaHang->id }}">
                                                    <i class="bx bx-trash me-1"></i> </button></td>
                                            <!-- Modal Cảnh báo -->
                                            <div class="modal fade" id="modalCenter-Delete{{ $diemMuaHang->id }}"
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
                                                                    <span style="font-size: 22px;">Bạn có chắc muốn xoá điểm
                                                                        mua
                                                                        hàng này
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding: 3%">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-2">
                                                                <a
                                                                    href="{{ route('diemMuaHang.xoa', $diemMuaHang->id) }}"><button
                                                                        type="submit"
                                                                        class="btn btn-danger btn-delete-confirm"
                                                                        data-bs-dismiss="modal">Xoá</button></a>
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
                                    {{-- @break --}}
                                @endif
                            @endforeach
                            <script>
                                $(document).on('click', '.btn-delete-close', function(e) {
                                    $('#modalCenter-Delete{{ $diemMuaHang->id }}').modal('hide');
                                });
                            </script>
                        @endforeach
                    </table>
                    @if ($lstDiemMuaHang->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstDiemMuaHang->appends($request->except('page'))->onEachSide(1)->links() }}
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
            @include('Partial/diem-mua-hang/JSPartial-diemmuahang-show')
        @endsection
