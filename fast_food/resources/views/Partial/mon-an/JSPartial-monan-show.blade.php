<script>
    $(function() {
        $('#loc_don_hang').change(function() {
            $("#form-search").submit();
        });
        $('#refresh').click(function() {
            var search = "";
            document.getElementById("timKiem").value = search;
            console.log(search);
        })
        $(document).on('click', '.btn-delete-close', function(e) {
            $('#modalCenter-Delete').modal('hide');
        });
    });
</script>