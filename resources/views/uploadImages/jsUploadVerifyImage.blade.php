<script>
    function previewVerifyImages() {
        var preview = document.querySelector('#preview-verify-images');

        if (this.files) {
            [].forEach.call(this.files, readAndPreviewVerifyImages);
        }

        function readAndPreviewVerifyImages(file) {

            // Make sure `file.name` matches our extensions criteria
            // if (!/\.(jpe?g|png|gif|jpg|svg)$/i.test(file.name)) {
            //     return alert(file.name + " không hỗ trợ");
            // } // else...
            var reader = new FileReader();

            reader.addEventListener("load", function() {
                var div = document.createElement("div");
                div.classList.add('preview-images');
                div.classList.add('col-md-2');
                preview.appendChild(div);

                var image = new Image();
                image.title = file.name;
                image.classList.add('image-verify-images');
                image.src = this.result;
                div.appendChild(image);
            });
            reader.readAsDataURL(file);
        }
        if(this.files.length > 0){
            $('.delete-verify').removeClass('hide')
        }
    }

        $(document).on('click', '.add-verify', function() {
            var html =
                '<input class="file-input-verify-images hide" id="file-verify-images" type="file" multiple name="verifications[]" accept="image/*">';
            $('#list-input-verify-images').prepend(html)
            $('#file-verify-images').trigger('click')
            document.querySelector('#file-verify-images').addEventListener("change", previewVerifyImages);
        });


        $(document).on('click', '.delete-verify', function() {
            $('.file-input-verify-images').val('');
            $('#preview-verify-images').html('');
            $(this).addClass('hide')
        });
</script>