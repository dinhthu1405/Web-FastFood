<script>
    $(function() {
        $('#sap_xep_don_hang').change(function() {
            $("#form-search").submit();
        });
        // document.getElementById("demo").onclick = function() {myFunction()};
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
    });
</script>
