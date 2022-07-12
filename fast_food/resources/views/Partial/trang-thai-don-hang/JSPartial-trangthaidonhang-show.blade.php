<script>
    $(function() {
        $('#refresh').click(function() {
            var search = "";
            document.getElementById("timKiem").value = search;
            console.log(search);
        });
    });
    $(document).ready(function() {
        function index() {
            var count = 1;
            $.ajax({
                url: "{{ route('trangThaiDonHang.indexAjax') }}",
                success: function(response) {
                    $.each(response.lstLoaiMonAn, function(key, item) {
                        $('tbody').append('<tr>\
                                    <td>' + count++ + '</td>\
                                    <td>' + item.ten_loai + '</td>\
                                    <td><button type="button" class="btn btn-danger py-2 mb-4" value="' + item.id + '"><i class="bx bx-trash me-1"></i></button></td>\
                                </tr>');
                    });
                    // $('.card').html(data);
                }
            })
        }
        $(document).on('click', '.btn-save', function(e) {
            e.preventDefault();
            // var ten_trang_thai = $("#TenTrangThai").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                }
            });
            var data = {
                // 'ten_trang_thai': document.querySelector('#TenTrangThai')
                'ten_trang_thai': $('#TenTrangThai').val()
            }
            console.log(data);
            $.ajax({
                url: "{{ route('trangThaiDonHang.store') }}",
                // url: "/loaiMonAn",
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    // printMsg(data);
                    // console.log(response);
                    if (response.status == 200) {
                        console.log(response.success);
                        $('#alert-msg').addClass('alert alert-success alert-dismissible');

                        $('#alert-msg').append('<strong style="text-align: center">' +
                            response.success +
                            '</strong>');
                        $('#modalCenter-Add').modal('hide');
                        $('#modalCenter-Add').find('input').val("");
                        setTimeout(function() {
                            // $('#alert-msg').remove();
                            // index();
                            window.location.href =
                                "{{ route('trangThaiDonHang.index') }}"
                        }, 1000);

                    } else {
                        if (response.status == 401) {
                            $('.ten_trang_thai_err').innerHTML = "";
                            $('.ten_trang_thai_err').text(response.errors);
                        } else {
                            $.each(response.errors, function(key, value) {
                                $('.' + key + '_err').text(value);
                            });
                        }
                    }
                }
            });
        });
    });
</script>
