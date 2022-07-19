<script>
    $(function() {
        $('#refresh').click(function() {
            var search = "";
            document.getElementById("timKiem").value = search;
            console.log(search);
        });
        $(document).on('click', '.btn-delete-close', function(e) {
            $('#modalCenter-Delete{{ $diaDiem->id }}').modal('hide');
        });
        $('.checkAll').click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
            // $('.selectBox').prop('checked', $(this).prop('checked'));
        })
    });
</script>
