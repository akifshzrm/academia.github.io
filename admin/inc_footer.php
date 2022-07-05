</main>
<footer>
<div class="text-center p-3" style="background:#CCCCCC">
        Copyright &copy; Academia Team 2022
</div>
</footer>  
<script>
    $(document).ready(function() {
    $('#summernote').summernote({
        callbacks: {
            onImageUpload: function(files) {
                for(let i=0; i < files.length; i++) {
                    $.upload(files[i]);
                }
            }
        },
        height:200,
		toolbar: [
			["style", ["bold", "italic", "underline", "clear"]],
			["fontname", ["fontname"]],
			["fontsize", ["fontsize"]],
			["color", ["color"]],
			["para", ["ul", "ol", "paragraph"]],
			["height", ["height"]],
			["insert", ["link", "picture", "imageList", "video", "hr"]],
			["help", ["help"]]
		],
		dialogsInBody: true,
		imageList: {
			endpoint: "register_picture.php",
			fullUrlPrefix: "../images/",
			thumbUrlPrefix: "../images/"
		}
    });
    $.upload = function (file) {
        let out = new FormData();
        out.append('file', file, file.name);

        $.ajax({
            method: 'POST',
            url: 'upload_picture.php',
            contentType: false,
            cache: false,
            processData: false,
            data: out,
            success: function (img) {
                $('#summernote').summernote('insertImage', img);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus + " " + errorThrown);
            }
        });
    };
});
</script> 
</body>
</html>