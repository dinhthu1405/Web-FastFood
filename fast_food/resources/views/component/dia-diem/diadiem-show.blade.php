@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí địa điểm')
@section('content')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-6">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-2">
                <button type="button" class="btn btn-success py-2 mb-4" data-target="#modal-add" data-bs-toggle="modal" data-bs-target="#modalCenter">
                    Thêm địa điểm
                </button>
                <!-- Modal -->
                <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Thêm địa điểm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form data-target="{{ route('diaDiem.store') }}" id="form-add" method="post" role="form">
                                    {!! @csrf_field() !!}
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Tên địa điểm</label>
                                            <input type="text" name="TenDiaDiem" class="form-control" id="TenDiaDiem" placeholder="Tên địa điểm" />
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col mb-0">
                                            <label for="thoiGianMo" class="form-label">Thời gian mở</label>
                                            <input type="time" id="ThoiGianMo" name="ThoiGianMo" class="form-control" value="12:30" />
                                        </div>
                                        <div class="col mb-0">
                                            <label for="thoiGianDong" class="form-label">Thời gian đóng</label>
                                            <input type="time" id="ThoiGianDong" name="ThoiGianDong" class="form-control" value="13:30" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Đóng
                                </button>
                                <button type="submit" class="btn btn-primary">Thêm địa điểm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('diaDiem.search') }}" method="post">
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
            <h5 class="card-header">Danh sách địa điểm</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên địa điểm</th>
                            <th>Thời gian mở</th>
                            <th>Thời gian đóng</th>
                            <th>Sửa</th>
                            <th>Xoá</th>
                        </tr>
                    </thead>
                    <?php $count = 1; ?>
                    @foreach ($lstDiaDiem as $diaDiem)
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td> {{ $count++ }} </td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $diaDiem->ten_dia_diem }}</strong>
                            </td>
                            <td>{{ $diaDiem->thoi_gian_mo }}</td>
                            <td>{{ $diaDiem->thoi_gian_dong }}</td>
                            <td> <a class="dropdown-item" href="{{ route('diaDiem.edit', $diaDiem->id) }}"><i class="bx bx-edit-alt me-1"></i></a></td>
                            <td> <a class="dropdown-item" href="{{ route('diaDiem.xoa', $diaDiem->id) }}" onclick="return confirm('Bạn có chắc muốn xoá địa điểm này, vì nó có thể ảnh hưởng đến món ăn')"><i class="bx bx-trash me-1"></i></a></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript" charset="UTF-8">
        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                'X-CSRF-TOKEN': $('meta[name="scrf_token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $('#form-add').submit(function(e) {
                e.preventDefault(); //Hoãn sự kiện submit
                var url = $(this).attr('data-target');
                // $("#ajaxSubmit").attr('disabled', true);
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        ten_dia_diem: $('#TenDiaDiem').val(),
                        thoi_gian_mo: $('#ThoiGianMo').val(),
                        thoi_gian_dong: $('#ThoiGianDong').val(),
                    },
                    success: function(response) {
                        toasts.success('Thêm địa điểm thành công');
                        $('#modalCenter').modal('hide');
                        setTimeout(function() {
                            window.location.href = "{{ route('diaDiem.index') }}";
                        }, 500);
                        window.location.reload();
                    },
                    error: function(response) {
                        console.log(response);
                    },
                })
            });
        });
    </script>
    @endsection