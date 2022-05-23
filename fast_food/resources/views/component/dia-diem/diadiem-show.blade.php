@extends('layouts.app', ['pageId' => ''])

@section('title', 'Trang quản lí địa điểm')
@section('content')
    <style>
        /* Full-width input fields */
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Extra styles for the cancel button */
        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
            padding-top: 60px;
            margin-left: 8%;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto 15% auto;
            /* 5% from the top, 15% from the bottom and centered */
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
        }

        /* The Close Button (x) */
        .close {
            position: absolute;
            right: 25px;
            top: 0;
            color: #000;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: red;
            cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
            -webkit-animation: animatezoom 0.6s;
            animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes animatezoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }

    </style>
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <a href="javascript:void(0);" onclick="document.getElementById('id1').style.display='block'"
                        style="width:auto;"><button type="button" class="btn btn-success py-2 mb-4">Thêm địa điểm
                        </button></a>
                    {{-- <a href="#" onclick="document.getElementById('id{{ $loi->id }}').style.display='block'"
                    style="width:auto;">Xem thêm</a> --}}
                    <div id="id1" class="modal">
                        <form class="modal-content animate">

                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Thêm địa điểm</h5>
                                    <span onclick="document.getElementById('id1').style.display='none'"
                                        class="close" title="Close Modal">&times;</span>
                                    <div class="card-body">
                                        <div class="alert alert-success" style="display:none"></div>
                                        {{-- <form action="{{ route('diaDiem.store') }}" id="ajax-contact-form" method="post"
                                            enctype="multipart/form-data"> --}}
                                        <form action="" id="ajax-contact-form" method="post" enctype="multipart/form-data">
                                            {!! @csrf_field() !!}
                                            {{-- <input type="hidden" id="token" value="{{ @csrf_token() }}"> --}}
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Tên địa
                                                    điểm</label>
                                                <input type="text" name="TenDiaDiem" class="form-control" id="TenDiaDiem"
                                                    placeholder="Tên địa điểm" />
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="html5-time-input" class="form-label">Thời
                                                    gian mở</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" id="ThoiGianMo" name="ThoiGianMo"
                                                        type="time" value="12:30" id="html5-time-input">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="html5-time-input" class="form-label">Thời gian đóng</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" name="ThoiGianDong" id="ThoiGianDong"
                                                        type="time" value="13:30" id="html5-time-input">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5"></div>
                                                <div class="col-md-5 mb-3">
                                                    <button type="submit" id="ajaxSubmit"
                                                        class="btn btn-success py-2 mb-4">Thêm
                                                        địa
                                                        điểm</button>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                                    <td> <a class="dropdown-item" href="{{ route('diaDiem.edit', $diaDiem->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i></a></td>
                                    <td> <a class="dropdown-item" href="{{ route('diaDiem.xoa', $diaDiem->id) }}"
                                            onclick="return confirm('Bạn có chắc muốn xoá địa điểm này, vì nó có thể ảnh hưởng đến món ăn')"><i
                                                class="bx bx-trash me-1"></i></a></td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- Bootstrap Table with Header - Light -->
            <script>
                var getId = function(id) {
                    var modal = document.getElementById(id);

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                }
            </script>
            <script>
                // jQuery(document).ready(function() {
                //     jQuery('#ajaxSubmit').click(function(e) {
                //         e.preventDefault();
                //         $.ajaxSetup({
                //             headers: {
                //                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                //             }
                //         });
                //         jQuery.ajax({
                //             url: "{{ route('diaDiem.store') }}",
                //             method: 'post',
                //             data: {
                //                 ten_dia_diem: jQuery('#TenDiaDiem').val(),
                //                 thoi_gian_mo: jQuery('#ThoiGianMo').val(),
                //                 thoi_gian_dong: jQuery('#ThoiGianDong').val()
                //             },
                //             dataType: 'json',
                //             success: function(data) {
                //                 $('#ajax-contact-form').trigger("reset");
                //                 $("#ajax-contact-form .close").click();
                //                 window.location.reload();
                //             },
                //             // success: function(result) {
                //             //     jQuery('.alert').show();
                //             //     jQuery('.alert').html(result.success);
                //             // }
                //         });
                //     });
                // });

                $("ajax-contact-form").submit(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('diaDiem.store') }}",
                        type: "POST",
                        data: {
                            ten_dia_diem: $('#TenDiaDiem').val(),
                            thoi_gian_mo: $('#ThoiGianMo').val(),
                            thoi_gian_dong: $('#ThoiGianDong').val()
                        },
                        dataType: 'json',
                        success: function(data) {
                            // $('#ajax-contact-form').trigger("reset");
                            // $("#ajax-contact-form .close").click();
                            // window.location.reload();
                            alert('Thành công');
                        },
                    });
                });
            </script>
        @endsection
