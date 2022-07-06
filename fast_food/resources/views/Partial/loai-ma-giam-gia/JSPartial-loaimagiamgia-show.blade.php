<script>
    $(function() {
        $('#refresh').click(function() {
            var search = "";
            document.getElementById("timKiem").value = search;
        })
    });
    $(document).ready(function() {
        // index();

        // $(document).on('click', '.pagination a', function(e) {
        //     e.preventDefault();
        //     var page = $(this).attr('href').split('page=')[1];
        //     index(page);
        //     console.log(page);  
        // });

        function index() {
            var count = 1;
            // var page = 1;
            // console.log(page);   
            $.ajax({
                // url: "/loaiMonAn/fetch_loaiMonAn?page=" + page,
                url: "{{ route('loaiGiamGia.indexAjax') }}",
                success: function(response) {
                    console.log(response);
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
            var loai_giam_gia = $("#LoaiGiamGia").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                }
            });
            var data = {
                'loai_giam_gia': $('#LoaiGiamGia').val()
            }
            $.ajax({
                url: "{{ route('loaiGiamGia.store') }}",
                // url: "/loaiMonAn",
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    // printMsg(data);
                    // console.log(response);
                    if (response.status == 200) {
                        console.log(response.success);
                        $('#alert-msg').addClass('alert alert-success alert-dismissible');

                        $('#alert-msg').append('<strong style="text-align: center">' +
                            response.success +
                            '</strong>');
                        $('#modalCenter').modal('hide');
                        $('#modalCenter').find('input').val("");
                        setTimeout(function() {
                            // $('#alert-msg').remove();
                            // index();
                            window.location.href =
                                "{{ route('loaiGiamGia.index') }}"
                        }, 1000);

                    } else {
                        if (response.status == 401) {
                            $('.loai_giam_gia_err').innerHTML = "";
                            $('.loai_giam_gia_err').text(response.errors);
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
