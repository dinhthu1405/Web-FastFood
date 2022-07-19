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
                <div class="col-md-2"></div>
                <div class="col-md-2">
                </div>
                <div class="col-md-2">
                </div>
            </div>
            {{-- <form action="{{ route('loaiMonAn.search') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="my-input">Tìm kiếm</label>
                            <input class="form-control" type="search" name="search" value="{{ request('search') }}"
                                required placeholder="Tìm kiếm..." />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""></label>
                            <button type="submit" class="form-control btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
            </form> --}}
            <br />
            {{-- <form action="{{ route('thongKe.show', ['thongKe' => 5]) }}" id="form-thongKe" method="GET"
                class="form-inline"> --}}
            <form action="" id="form-thongKe" method="GET" class="form-inline">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group" id="TuNgay" style="display: {{ $value != 1 ? 'none' : 'block' }}">
                            <label for="">Từ ngày</label>
                            <input type="date" name="tu_ngay" id="tu_ngay" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $tu_ngay }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" id="DenNgay" style="display: {{ $value != 1 ? 'none' : 'block' }}">
                            <label for="">Đến ngày</label>
                            <input type="date" name="den_ngay" id="den_ngay" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $den_ngay }}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        {{-- <input type="text" name="top_dh" class="form-control" value="{{ $topDH }}" /> --}}
                        <div class="form-group" id="TopDH" style="display: {{ $value != 11 ? 'none' : 'block' }}">
                            <label for="">Top</label>
                            <select class="form-select" name="TOPDH" id="" aria-label="Default select example">
                                <option value="1" {{ $value_top == 1 ? 'selected' : '' }}>5</option>
                                <option value="2" {{ $value_top == 2 ? 'selected' : '' }}>10</option>
                                <option value="3" {{ $value_top == 3 ? 'selected' : '' }}>15</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-select" name="ThongKe" id="thongKe" aria-label="Default select example"
                                onchange="getThongKe(this)">
                                <option value="0">-- Hãy chọn một loại thống kê --</option>
                                <option value="1" {{ $value == 1 ? 'selected' : '' }}>Thống kê theo ngày/tháng/năm
                                </option>
                                {{-- <option value="2" {{ $value == 2 ? 'selected' : '' }}>Thống kê ngày hiện tại
                                </option> --}}
                                {{-- <option value="3" {{ $value == 3 ? 'selected' : '' }}>Thống kê ngày hôm qua</option> --}}
                                <option value="4" {{ $value == 4 ? 'selected' : '' }}>Thống kê tuần hiện tại
                                </option>
                                {{-- <option value="5" {{ $value == 5 ? 'selected' : '' }}>Thống kê tuần trước</option> --}}
                                {{-- <option value="6" {{ $value == 6 ? 'selected' : '' }}>Thống kê tháng hiện tại
                                </option> --}}
                                {{-- <option value="7" {{ $value == 7 ? 'selected' : '' }}>Thống kê tháng trước</option> --}}
                                {{-- <option value="8" {{ $value == 8 ? 'selected' : '' }}>Thống kê năm hiện tại</option> --}}
                                <option value="9" {{ $value == 9 ? 'selected' : '' }}>Thống kê theo quý</option>
                                <option value="10" {{ $value == 10 ? 'selected' : '' }}>Thống kê theo tháng</option>
                                <option value="11" {{ $value == 11 ? 'selected' : '' }}>Thống kê đơn hàng có tổng
                                    tiền
                                    lớn
                                    nhất</option>
                                {{-- <option value="10" {{ $value == 10 ? 'selected' : '' }}>Thống kê đơn hàng chưa nhận
                                </option>
                                <option value="11" {{ $value == 11 ? 'selected' : '' }}>Thống kê đơn hàng đã nhận
                                </option>
                                <option value="12" {{ $value == 12 ? 'selected' : '' }}>Thống kê đơn hàng đang giao
                                </option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for=""></label>
                            <button type="submit" class="form-control btn btn-primary">Thống kê</button>
                        </div>
                        {{-- <div class="form-group">
                            <label for=""></label>
                            <select class="form-select" name="LoaiThongKe" id="loaiThongKe"
                                aria-label="Default select example">
                                <option value="0">-- Chọn loại để thống kê --</option>
                                <option value="1" {{ $value_loai == 1 ? 'selected' : '' }}>Thống kê đơn hàng
                                </option>
                                <option value="2" {{ $value_loai == 2 ? 'selected' : '' }}>Thống kê trạng thái đơn
                                    hàng
                                </option>
                            </select>
                        </div> --}}
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for=""></label>
                            <a href="{{ route('thongKe.exportExcel', [$quy, $thang, $tu_ngay, $den_ngay, $topDH, $thongKe]) }}"
                                type="button" class="form-control btn btn-primary"><img style="width: 50%"
                                    src="../assets/img/icons/unicons/excel.png" alt="Credit Card" class="rounded" /></a>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for=""></label>
                            <a href="{{ route('thongKe.exportPDF', [$quy, $thang, $tu_ngay, $den_ngay, $topDH, $thongKe]) }}"
                                type="button" class="form-control btn btn-primary"><img style="width: 50%"
                                    src="../assets/img/icons/unicons/pdf.png" alt="Credit Card" class="rounded" /></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group" id="Quy" style="display: {{ $value != 9 ? 'none' : 'block' }}">
                            <label for="">Quý</label>
                            <select class="form-select" name="quy" id="" aria-label="Default select example">
                                <option value="1" {{ $value_quy == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $value_quy == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $value_quy == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $value_quy == 4 ? 'selected' : '' }}>4</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group" id="Thang" style="display: {{ $value != 10 ? 'none' : 'block' }}">
                            <label for="">Tháng</label>
                            <input type="month" name="thang" id="thang" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $thang }}">
                            {{-- <select class="form-select" name="quy" id="" aria-label="Default select example">
                                <option value="1" {{ $value_top == 1 ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $value_top == 2 ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $value_top == 3 ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $value_top == 4 ? 'selected' : '' }}>4</option>
                                <option value="5" {{ $value_top == 5 ? 'selected' : '' }}>5</option>
                                <option value="6" {{ $value_top == 6 ? 'selected' : '' }}>6</option>
                                <option value="7" {{ $value_top == 7 ? 'selected' : '' }}>7</option>
                                <option value="8" {{ $value_top == 8 ? 'selected' : '' }}>8</option>
                                <option value="9" {{ $value_top == 9 ? 'selected' : '' }}>9</option>
                                <option value="10" {{ $value_top == 10 ? 'selected' : '' }}>10</option>
                                <option value="11" {{ $value_top == 11 ? 'selected' : '' }}>11</option>
                                <option value="12" {{ $value_top == 12 ? 'selected' : '' }}>12</option>

                            </select> --}}
                        </div>
                    </div>
                    {{-- <div class="col-md-1">
                        <div class="form-group" id="Nam" style="display: {{ $value != 11 ? 'none' : 'block' }}">
                            <label for="">Năm</label>
                            <input type="date" name="tu_ngay" id="tu_ngay" class="form-control" placeholder=""
                                aria-describedby="helpId" value="{{ $tu_ngay }}">
                        </div>
                    </div> --}}
                </div>
            </form>
            <br />
            <!-- Bootstrap Table with Header - Light -->
            <div class="card">
                <h5 class="card-header">Danh sách đơn hàng</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>Mã</th>
                                <th>Ngày lập</th>
                                <th>Tổng tiền</th>
                                <th>Người giao hàng</th>
                                <th>Người đặt</th>
                                <th>Địa chỉ</th>
                                <th>Phương thức</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <?php $count = $lstDonHang->perPage() * ($lstDonHang->currentPage() - 1) + 1; ?>
                        @foreach ($lstDonHang as $donHang)
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td> {{ $count++ }} </td>
                                    <td><a style="color: #697a8d"{{-- href="{{ route('donHang.index1') . '?page=' . $lstDonHang->currentPage() }}">{{ $donHang->id }}</a> --}}
                                            href="{{ route('donHang.index1', [$donHang->id, 0, 0, 0]) }}">{{ $donHang->id }}</a>
                                    </td>
                                    <td>
                                        {{ date('d-m-Y H:i:s', strtotime($donHang->ngay_lap_dh)) }}
                                    </td>
                                    <td>{{ number_format($donHang->tong_tien) }}</td>
                                    @foreach ($lstTaiKhoan as $taiKhoan)
                                        @if ($donHang->nguoi_giao_hang_id == $taiKhoan->id)
                                            <td>
                                                <a style="color: #697a8d"
                                                    href="{{ route('donHang.index1', [0, 0, $donHang->nguoi_giao_hang_id, 0]) }}">{{ $taiKhoan->email }}</a>
                                            </td>
                                        @endif
                                    @endforeach
                                    @foreach ($lstTaiKhoan as $taiKhoan)
                                        @if ($donHang->user_id == $taiKhoan->id)
                                            <td>
                                                <a style="color: #697a8d"
                                                    href="{{ route('donHang.index1', [0, $donHang->user_id, 0, 0]) }}">{{ $taiKhoan->email }}</a>
                                            </td>
                                        @endif
                                    @endforeach
                                    <td>{{ $donHang->dia_chi }}</td>
                                    <td>{{ $donHang->loai_thanh_toan }}</td>
                                    @foreach ($lstTrangThaiDonHang as $trangThaiDonHang)
                                        @if ($donHang->trang_thai_don_hang_id == $trangThaiDonHang->id)
                                            <td> @switch($donHang->trang_thai_don_hang_id)
                                                    @case(1)
                                                        <a
                                                            href="{{ route('donHang.index1', [0, 0, 0, $donHang->trang_thai_don_hang_id]) }}"><span
                                                                class="badge bg-label-warning me-1">
                                                                {{ $trangThaiDonHang->ten_trang_thai }}</span></a>
                                                    @break

                                                    @case(2)
                                                        <a
                                                            href="{{ route('donHang.index1', [0, 0, 0, $donHang->trang_thai_don_hang_id]) }}"><span
                                                                class="badge bg-label-secondary me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span></a>
                                                    @break

                                                    @case(3)
                                                        <a
                                                            href="{{ route('donHang.index1', [0, 0, 0, $donHang->trang_thai_don_hang_id]) }}"><span
                                                                class="badge bg-label-dark me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span></a>
                                                    @break

                                                    @case(4)
                                                        <a
                                                            href="{{ route('donHang.index1', [0, 0, 0, $donHang->trang_thai_don_hang_id]) }}"><span
                                                                class="badge bg-label-warning me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span></a>
                                                    @break

                                                    @case(5)
                                                        <a
                                                            href="{{ route('donHang.index1', [0, 0, 0, $donHang->trang_thai_don_hang_id]) }}"><span
                                                                class="badge bg-label-info me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span></a>
                                                    @break

                                                    @case(6)
                                                        <a
                                                            href="{{ route('donHang.index1', [0, 0, 0, $donHang->trang_thai_don_hang_id]) }}"><span
                                                                class="badge bg-label-primary me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span></a>
                                                    @break

                                                    @case(7)
                                                        <a
                                                            href="{{ route('donHang.index1', [0, 0, 0, $donHang->trang_thai_don_hang_id]) }}"><span
                                                                class="badge bg-label-danger me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span></a>
                                                    @break

                                                    @case(8)
                                                        <a
                                                            href="{{ route('donHang.index1', [0, 0, 0, $donHang->trang_thai_don_hang_id]) }}"><span
                                                                class="badge bg-label-success me-1">{{ $trangThaiDonHang->ten_trang_thai }}</span></a>
                                                    @break

                                                    @default
                                                        <a
                                                            href="{{ route('donHang.index1', [0, 0, 0, $donHang->trang_thai_don_hang_id]) }}">{{ $trangThaiDonHang->ten_trang_thai }}</a>
                                                @endswitch
                                            </td>
                                        @endif
                                    @endforeach
                                    {{-- <td><a href="{{ route('donHang.show', $donHang->id) }}"><button type="button"
                                                id="btn-edit" class="btn btn-info py-2 mb-4" data-target="#modal-edit"
                                                data-bs-toggle="modal" data-bs-target="#modalCenter-Edit">
                                                <i class="bx bx-edit-alt me-1"></i> </button></a> </td> --}}
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    @if ($lstDonHang->total() > 5)
                        {{-- @if ($request->input('page') > 1) --}}
                        {{-- @if (request()->all()) --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Basic Pagination -->
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination" name="page" id="paginate">
                                            {{-- {{ $lstDonHang->links() }} --}}
                                            {{ $lstDonHang->appends(request()->all())->onEachSide(1)->links() }}
                                            {{-- {{ $lstDonHang->appends($request->except('page'))->links() }} --}}
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
            function loaiThongKeChange(selectObj) {
                // get the index of the selected option 
                var idx = selectObj.selectedIndex;
                // get the value of the selected option 
                var which = selectObj.options[idx].value;
                // use the selected option value to retrieve the list of items from the loaiThongKe array 
                cList = loaiThongKe[which];
                // get the country select element via its known id 
                var cSelect = document.getElementById("thongKe");
                // remove the current options from the country select 
                var len = cSelect.options.length;
                while (cSelect.options.length > 0) {
                    cSelect.remove(0);
                }
                var newOption;
                // create new options 
                for (var i = 0; i < cList.length; i++) {
                    newOption = document.createElement("option");
                    newOption.value = cList[i]; // assumes option string and value are the same 
                    newOption.text = cList[i];
                    // add the new option 
                    try {
                        cSelect.add(newOption); // this will fail in DOM browsers but is needed for IE 
                    } catch (e) {
                        cSelect.appendChild(newOption);
                    }
                }
            }
            //]]>

            // function getLoaiThongKe(selectObject) {
            //     var select = $('#thongKe').val(); //Lấy giá trị value trong select
            //     var select_loai = $('#loaiThongKe').val();
            //     if (select_loai == 0) {
            //         console.log(select_loai);
            //         select.hide();
            //     }


            //     // if (select_loai == 1 || {{ $value_loai }} == 1) {
            //     //     $("#thongKe").html(
            //     //         "<option value = '1' {{ $value == 1 ? 'selected' : '' }}> Thống kê theo ngày / tháng / năm </option> <option value = '2' {{ $value == 2 ? 'selected' : '' }} > Thống kê ngày hiện tại </option> <option value = '3' {{ $value == 3 ? 'selected' : '' }}> Thống kê ngày hôm qua </option> <option value = '4' {{ $value == 4 ? 'selected' : '' }} > Thống kê tuần hiện tại </option> <option value = '5' {{ $value == 5 ? 'selected' : '' }} > Thống kê tuần trước </option> <option value = '6' {{ $value == 6 ? 'selected' : '' }} > Thống kê tháng hiện tại </option> <option value = '7' {{ $value == 7 ? 'selected' : '' }} > Thống kê tháng trước </option> <option value = '8' {{ $value == 8 ? 'selected' : '' }} > Thống kê năm hiện tại </option> <option value = '9' {{ $value == 9 ? 'selected' : '' }} > Thống kê đơn hàng có tổng tiền lớn nhất </option>"
            //     //     );
            //     // } else if (select_loai == 2) {
            //     //     $("#thongKe").html(
            //     //         "<option value = '1' {{ $value == 1 ? 'selected' : '' }}> Thống kê đơn hàng chưa nhận </option> <option value = '2' {{ $value == 2 ? 'selected' : '' }} > Thống kê đơn hàng đã nhận </option> <option value = '3' {{ $value == 3 ? 'selected' : '' }}> Thống kê đơn hàng đang giao </option>"
            //     //     );
            //     // }

            // }

            function getThongKe() {
                var tuNgay = document.getElementById('TuNgay');
                var denNgay = document.getElementById('DenNgay');
                var quy = document.getElementById('Quy');
                var thang = document.getElementById('Thang');
                var topDH = document.getElementById('TopDH');
                var paginate = document.getElementById('paginate');
                //Lấy giá trị đoạn text trong select
                // var select = value.options[value.selectedIndex].text;
                // var value = selectObject.value;

                var select = $('#thongKe').val(); //Lấy giá trị value trong select
                var select_loai = $('#loaiThongKe').val();
                // var tu_ngay = document.getElementById('tu_ngay');
                // var den_ngay = document.getElementById('den_ngay');
                // console.log(tu_ngay);     
                // alert('Thống kê theo ' + select);

                // $("#thongKe").show();
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
                if (select != 9) {
                    quy.style.display = 'none';
                } else {
                    quy.style.display = 'block';
                }
                if (select != 10) {
                    thang.style.display = 'none';
                } else {
                    thang.style.display = 'block';
                }
                if (select != 11) {
                    topDH.style.display = 'none';
                } else {
                    topDH.style.display = 'block';
                }
                switch (select) {
                    case '1':
                        document.getElementById('form-thongKe').action = "/thongKe";
                        var curAction = document.getElementById('form-thongKe').action;
                        document.getElementById('form-thongKe').action = curAction + "/" + 1;
                        break;
                    case '2':
                        document.getElementById('form-thongKe').action = "/thongKe";
                        var curAction = document.getElementById('form-thongKe').action;
                        document.getElementById('form-thongKe').action = curAction + "/" + 2;
                        break;
                    case '3':
                        document.getElementById('form-thongKe').action = "/thongKe";
                        var curAction = document.getElementById('form-thongKe').action;
                        document.getElementById('form-thongKe').action = curAction + "/" + 3;
                        break;
                    case '4':
                        document.getElementById('form-thongKe').action = "/thongKe";
                        var curAction = document.getElementById('form-thongKe').action;
                        document.getElementById('form-thongKe').action = curAction + "/" + 4;
                        break;
                    case '5':
                        document.getElementById('form-thongKe').action = "/thongKe";
                        var curAction = document.getElementById('form-thongKe').action;
                        document.getElementById('form-thongKe').action = curAction + "/" + 5;
                        break;
                    case '6':
                        document.getElementById('form-thongKe').action = "/thongKe";
                        var curAction = document.getElementById('form-thongKe').action;
                        document.getElementById('form-thongKe').action = curAction + "/" + 6;
                        break;
                    case '7':
                        document.getElementById('form-thongKe').action = "/thongKe";
                        var curAction = document.getElementById('form-thongKe').action;
                        document.getElementById('form-thongKe').action = curAction + "/" + 7;
                        break;
                    case '8':
                        document.getElementById('form-thongKe').action = "/thongKe";
                        var curAction = document.getElementById('form-thongKe').action;
                        document.getElementById('form-thongKe').action = curAction + "/" + 8;
                        break;
                    case '9':
                        document.getElementById('form-thongKe').action = "/thongKe";
                        var curAction = document.getElementById('form-thongKe').action;
                        document.getElementById('form-thongKe').action = curAction + "/" + 9;
                        break;
                    case '10':
                        document.getElementById('form-thongKe').action = "/thongKe";
                        var curAction = document.getElementById('form-thongKe').action;
                        document.getElementById('form-thongKe').action = curAction + "/" + 10;
                        break;
                    case '11':
                        document.getElementById('form-thongKe').action = "/thongKe";
                        var curAction = document.getElementById('form-thongKe').action;
                        document.getElementById('form-thongKe').action = curAction + "/" + 11;
                        break;
                }
                // if (select > 0) {
                //     // $("#form-thongKe").html(
                //     //     "action = {{ route('thongKe.show', ['thongKe' => '+select+']) }}"
                //     // );
                //     // console.log('Thống kê theo ' + select);
                //     console.log(select);
                //     var curAction = document.getElementById('form-thongKe').action;
                //     document.getElementById('form-thongKe').action = curAction + "/" + select;
                //     // document.getElementById('form-thongKe').action =  "{{ route('thongKe.show', ['thongKe' => 5]) }}";

                //     // document.getElementById("form-thongKe").submit();
                //     // document.getElementById("form-thongKe").reset();
                //     // console.log(document.getElementById('form-thongKe').action);
                // }
            }
        </script>
    @endsection
