@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang thống kê đơn hàng')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a
                                href="{{ route('thongKe.index') }}">Danh sách</a></span></h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                </div>
            </div>
            <form action="{{ route('loaiMonAn.search') }}" method="POST">
                {{ csrf_field() }}
                <label>Tìm kiếm</label>
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-control" type="search" name="search" value="{{ request('search') }}" required
                            placeholder="Tìm kiếm..." />
                    </div>
                    <div class="col-md-2">
                        <label></label>
                        <button type="submit" class="form-control btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <br />
            <form action="{{ route('thongKe.thongKeDonHang') }}" method="POST" class="form-inline">
                {{ csrf_field() }}
                <div class="row">
                    {{-- @if (request('ThongKe') == 'Thống kê theo ngày') --}}
                    <div class="col-md-3">
                        <div class="form-group" id="TuNgay" style="display: {{ $value != 1 ? 'none' : 'block' }}">
                            <label for="">Từ ngày</label>
                            <input type="date" name="tu_ngay" id="tu_ngay" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ request('tu_ngay') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" id="DenNgay" style="display: {{ $value != 1 ? 'none' : 'block' }}">
                            <label for="">Đến ngày</label>
                            <input type="date" name="den_ngay" id="den_ngay" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ request('den_ngay') }}">
                        </div>
                    </div>
                    {{-- @else
                    @endif --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-select" name="ThongKe" id="thongKe" aria-label="Default select example"
                                onchange="getThongKe(this)">
                                <option value="0">-- Chọn loại để thống kê --</option>
                                <option value="1" {{ $value == 1 ? 'selected' : '' }}>Thống kê theo ngày/tháng/năm
                                </option>
                                <option value="2" {{ $value == 2 ? 'selected' : '' }}>Thống kê ngày hiện tại</option>
                                <option value="3" {{ $value == 3 ? 'selected' : '' }}>Thống kê ngày hôm qua</option>
                                <option value="4" {{ $value == 4 ? 'selected' : '' }}>Thống kê tuần hiện tại</option>
                                <option value="5" {{ $value == 5 ? 'selected' : '' }}>Thống kê tuần trước</option>
                                <option value="6" {{ $value == 6 ? 'selected' : '' }}>Thống kê tháng hiện tại</option>
                                <option value="8" {{ $value == 8 ? 'selected' : '' }}>Thống kê đơn hàng có tổng tiền lớn
                                    nhất</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for=""></label>
                            <button type="submit" class="form-control btn btn-primary">Thống kê</button>
                        </div>
                    </div>
                </div>
            </form>
            <br />
            <!-- Bootstrap Table with Header - Light -->
            <div class="card">
                <h5 class="card-header">Danh sách đơn hàng</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Ngày lập đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>Người giao hàng</th>
                                <th>Người đặt</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Chi tiết đơn hàng</th>
                            </tr>
                        </thead>
                        <?php $count = $lstDonHang->perPage() * ($lstDonHang->currentPage() - 1) + 1; ?>
                        @foreach ($lstDonHang as $donHang)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        {{ date('d-m-Y', strtotime($donHang->ngay_lap_dh)) }}
                                    </td>
                                    <td>{{ number_format($donHang->tong_tien) }}</td>
                                    @foreach ($lstTaiKhoan as $taiKhoan)
                                        @if ($donHang->nguoi_giao_hang_id == $taiKhoan->id)
                                            <td>{{ $taiKhoan->email }}</td>
                                        @endif
                                    @endforeach
                                    @foreach ($lstTaiKhoan as $taiKhoan)
                                        @if ($donHang->user_id == $taiKhoan->id)
                                            <td>{{ $taiKhoan->email }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $donHang->trangThaiDonHang->ten_trang_thai }}</td>
                                    <td><a href="{{ route('donHang.show', $donHang->id) }}"><button type="button"
                                                id="btn-edit" class="btn btn-info py-2 mb-4" data-target="#modal-edit"
                                                data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-edit-alt me-1"></i> </button></a> </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    @if ($lstDonHang->total() > 5)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            {{ $lstDonHang->onEachSide(3)->links() }}
                                            {{-- search with paginate --}}
                                            {{-- {{ $lstDonHang->withQueryString()->links() }} --}}
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
        <script>
            function getThongKe(selectObject) {
                var tuNgay = document.getElementById('TuNgay');
                var denNgay = document.getElementById('DenNgay');
                //Lấy giá trị đoạn text trong select
                // var select = value.options[value.selectedIndex].text;
                // var value = selectObject.value;

                var select = $('#thongKe').val(); //Lấy giá trị value trong select     
                // var tu_ngay = document.getElementById('tu_ngay');
                // var den_ngay = document.getElementById('den_ngay');
                // console.log(tu_ngay);     
                // alert('Thống kê theo ' + select);
                if (select != 1) {
                    tuNgay.style.display = 'none';
                    denNgay.style.display = 'none';

                } else {
                    tuNgay.style.display = 'block';
                    denNgay.style.display = 'block';
                    // console.log('1');
                    // if (select == 1) {
                    //     // tuNgay.type = 'date';
                    //     // denNgay.type = 'date'
                    //     tu_ngay.setAttribute('type', 'date');
                    //     den_ngay.setAttribute('type', 'date');
                    // } else
                    // if (select == 2) {
                    //     // tuNgay.type = 'month'
                    //     // denNgay.type = 'month'
                    //     tu_ngay.setAttribute('type', 'month');
                    //     den_ngay.setAttribute('type', 'month');
                    // }
                }
                // $("#thongKe").show();
            }
        </script>
    @endsection
