<script>
    $(function() {
        $('#refresh').click(function() {
            var search = "";
            document.getElementById("timKiem").value = search;
            console.log(search);
        })
        $('.checkAll').click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
            // $('.selectBox').prop('checked', $(this).prop('checked'));
        })
    });
</script>
