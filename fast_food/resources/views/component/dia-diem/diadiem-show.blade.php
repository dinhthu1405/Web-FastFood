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
                <button type="button" id="btn-add" class="btn btn-success py-2 mb-4" data-target="#modal-add" data-bs-toggle="modal" data-bs-target="#modalCenter">
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
                                <form data-target="" id="form-add" method="post" role="form">
                                    {!! @csrf_field() !!}
                                    <!-- @csrfs -->
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
                                <button type="submit" id="btn-save" value="add" class="btn btn-primary">Thêm địa điểm</button>
                                <input type="hidden" id="todo_id" name="todo_id" value="0">
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
                    <tbody id="todos-list" class="table-border-bottom-0">
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
    <!-- <script>
        jQuery(document).ready(function($) {
            $("form-add").submit(function(e) {
                e.preventDefault();
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                //     }
                // });
                $.ajax({
                    url: "{{ route('diaDiem.store') }}",
                    type: "POST",
                    data: {
                        ten_dia_diem: $('#TenDiaDiem').val(),
                        thoi_gian_mo: $('#ThoiGianMo').val(),
                        thoi_gian_dong: $('#ThoiGianDong').val(),
                        _token: $("$input[name=_token]").val(),
                    },
                    dataType: 'json',
                    success: function(data) {
                        // $('#ajax-contact-form').trigger("reset");
                        // $("#ajax-contact-form .close").click();
                        // window.location.reload();
                        alert('Thành công');
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script> -->
    <script>
        jQuery(document).ready(function($) {
            //----- Open model CREATE -----//
            jQuery('#btn-add').click(function() {
                jQuery('#btn-save').val("add");
                jQuery('#form-add').trigger("reset");
                jQuery('#modalCenter').modal('show');
            });
            // CREATE
            $("#btn-save").click(function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var formData = {
                    ten_dia_diem: jQuery('#TenDiaDiem').val(),
                    thoi_gian_mo: jQuery('#ThoiGianMo').val(),
                    thoi_gian_dong: jQuery('#ThoiGianDong').val(),
                };
                var state = jQuery('#btn-save').val();
                var type = "POST";
                var todo_id = jQuery('#todo_id').val();
                var ajaxurl = '{{ route("diaDiem.store") }}';
                $.ajax({
                    type: type,
                    url: ajaxurl,
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.ten_dia_diem + '</td><td>' + data.thoi_gian_mo + '</td><td>' + data.thoi_gian_dong + '</td>';
                        // if (state == "add") {
                        //     jQuery('#todo-list').append(todo);
                        // } else {
                        //     jQuery("#todo" + todo_id).replaceWith(todo);
                        // }
                        alert(data.success);
                        jQuery('#form-add').trigger("reset");
                        jQuery('#modalCenter').modal('hide')
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
    @endsection