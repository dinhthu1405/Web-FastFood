<script>
    $(function() {
        $('#loc_don_hang').change(function() {
            $("#form-search").submit();
        });
        $('#refresh').click(function() {
            var search = "";
            document.getElementById("timKiem").value = search;
            console.log(search);
        });
        $('.checkAll').click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
            // $('.selectBox').prop('checked', $(this).prop('checked'));
        })
        // $('.selectBox').change(function() {
        //     var tong = $('.selectBox').length;
        //     var so = $('.selectBox:checked').length;
        //     if (tong == so) {
        //         $('.checkAll').prop('checked', true);
        //     } else {
        //         $('.checkAll').prop('checked', false);
        //     }
        // })
    });
</script>
