<script>
    var loadFile = function(event) {
        var previewImage = document.getElementById('preview-image');
        previewImage.src = URL.createObjectURL(event.target.files[0]);
    };

</script>