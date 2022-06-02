@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang chi tiết đơn hàng')
@section('content')
            <div class="content-wrapper">
                <!-- Content -->
        
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="fw-bold py-3 mb-4"><a href="{{ route('chiTietDonHang.index') }}"><span class="text-muted fw-light">Danh sách /</span></a> Chi tiết đơn hàng/</span> Basic Tables</h4>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                        </div>
                    </div>
                    <form action="{{ route('monAn.search') }}" method="post">
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
                        <h5 class="card-header">Danh sách chi tiết đơn hàng</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn</th>
                                        <th>Tên món</th>  
                                        <th>Đơn giá</th>                              
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        {{-- <th>Chỉnh sửa</th>
                                        <th>Xoá</th> --}}
                                    </tr>
                                </thead>
                                <?php $count = 1; ?>
                                @foreach ($lstChiTietDonHang as $chiTietDonHang)
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td> {{ $count++ }} </td>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                {{ $chiTietDonHang->don_hang_id }}
                                            </td>         
                                            @foreach($lstMonAn as $monAn)
                                            @if($monAn->id == $chiTietDonHang->mon_an_id)
                                            <td>{{ $monAn->ten_mon }}</td>
                                            @endif
                                            @endforeach
                                            <td>{{ $chiTietDonHang->don_gia }}</td>
                                            <td>{{ $chiTietDonHang->so_luong }}</td>
                                            <td>{{ $chiTietDonHang->thanh_tien }}</td>                                    
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
                        </div>
                    </div>
                    <!-- Bootstrap Table with Header - Light -->
                @endsection
        