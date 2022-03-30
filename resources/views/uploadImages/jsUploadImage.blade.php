<script>
    function previewImages() {

        var preview = document.querySelector('#preview-images');
        if (this.files) {
            [].forEach.call(this.files, readAndPreviewImages);
        }

        function readAndPreviewImages(file) {

            // Make sure `file.name` matches our extensions criteria
            // if (!/\.(jpe?g|png|gif|jpg|svg)$/i.test(file.name)) {
            //     return alert(file.name + " không hỗ trợ");
            // } // else...
            
            var reader = new FileReader();

            reader.addEventListener("load", function() {
                var div = document.createElement("div");
                div.classList.add('preview-images');
                div.classList.add('center');
                div.classList.add('col-md-2');
                preview.appendChild(div);

                var image = new Image();
                image.title = file.name;
                image.classList.add('image-images');
                image.src = this.result;
                div.appendChild(image);
            });
            reader.readAsDataURL(file);
        }

       
        if(this.files.length > 0){
            $('.delete-image').removeClass('hide')
        }
    }

    $(document).on('click', '.add-image', function() {
        var html =
            '<input class="file-input-images hide" id="file-images" type="file" name="avatar[]" multiple accept="image/*">'
        $('#list-input-images').prepend(html)
        $('#file-images').trigger('click')
        document.querySelector('#file-images').addEventListener("change", previewImages);
    });

    $(document).on('click', '.delete-image', function() {
        $('.file-input-images').val('');
        $('#preview-images').html('');
        $(this).addClass('hide')
    });
</script>
