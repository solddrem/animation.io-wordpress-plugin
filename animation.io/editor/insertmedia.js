jQuery(document).ready(function($){
    var custom_media_uploader;
    $('#insert_imageurl_button').click(function(e) {
        e.preventDefault();
        if (custom_media_uploader) {
            custom_media_uploader.open();
            return;
        }
        custom_media_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Insert Url'
            },
            multiple: false
        });
        custom_media_uploader.on('select', function() {
            attachment = custom_media_uploader.state().get('selection').first().toJSON();
            var caretPos = document.getElementById("newcontent").selectionStart;
            var textAreaTxt = jQuery("#newcontent").val();
            var txtToAdd = attachment.url + '';
            jQuery("#newcontent").val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos) );
        });
        custom_media_uploader.open();
    });
});