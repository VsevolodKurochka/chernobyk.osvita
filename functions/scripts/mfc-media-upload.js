jQuery(document).ready(function($) {
    $(document).on("click", ".upload_image_button", function() {
        jQuery.data(document.body, 'prevElement', $(this).prev());

        window.send_to_editor = function(html) {
            var imageTag = $(html);
            var imageUrl = imageTag.attr('src');
            var inputText = jQuery.data(document.body, 'prevElement');

            if(inputText !== undefined && inputText !== '')
            {
                inputText.val(imageUrl);
            }

            tb_remove();
        };

        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
});
