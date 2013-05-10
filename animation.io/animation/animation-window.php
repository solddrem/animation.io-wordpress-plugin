<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Insert Animation.io Shortcode</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php
		//GET THE CURRENT WORDPRESS INSTALL LOCATION
        $url_with_file = $_SERVER['HTTP_REFERER'];
        $file_pos = strpos($url_with_file,"/wp-admin");
        $url = substr($url_with_file, 0,$file_pos);
    ?>    
    <!-- GET THE NECESARY JAVASCRIPT AND CSS -->
	<script language="javascript" type="text/javascript" src="<?php echo $url; ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $url; ?>/wp-includes/js/jquery/jquery.js?ver=1.4.2"></script>
	<script language="javascript" type="text/javascript" src="../../js/jquery.jqtransform.js"></script>    
	<script language="javascript" type="text/javascript">
	jQuery(document).ready(function($) {
		jQuery("#shorcode-manager").jqTransform();
	});	
	function insertShortcode() {
		var animation_title = document.getElementById('animation_title').value;
		var animation_firstscene = document.getElementById('animation_firstscene').value;
		var animation_includes = document.getElementById('animation_includes').value;
		var animation_width = document.getElementById('animation_width').value;
		var animation_height = document.getElementById('animation_height').value;
        	
		var shortcode_content = ' [animation  title="' + animation_title + '" startscene="' + animation_firstscene + '" includes="' + animation_includes + '" width="' + animation_width + '" height="' + animation_height + '"]'

		if(window.tinyMCE) {
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcode_content);
			tinyMCEPopup.editor.execCommand('mceRepaint');
			tinyMCEPopup.close();
		}
		
		return;
	}
	</script>
</head>
<body>
	<form action="#">
        <h3 class="page-title">Insert Animation</h3>
            <div class="table-row table-row-alternative">
        		<label>Animation Title:</label>
            	<input type="text" id="animation_title" />	            
            </div>
            <div class="table-row table-row-alternative">
        		<label>First scene to start with:</label>
            	<input type="text" id="animation_firstscene" />	            
            </div>
            <div class="table-row table-row-alternative">
        		<label>Additional scenes (comma separated):</label>
            	<input type="text" id="animation_includes" />	            
            </div>
            <div class="table-row table-row-alternative">
        		<label>Width:</label>
            	<input type="text" id="animation_width" />	            
            </div>
            <div class="table-row table-row-beforelast">
        		<label>Height:</label>
            	<input type="text" id="animation_height" />	            
            </div>
            <div class="table-row table-row-last">            
                <input class="cancel" type="button" value="Close" onclick="tinyMCEPopup.close();" />
                <input type="submit" value="Insert" onclick="insertShortcode();" />                
            </div>             
        </div>    
	</form>
</body>
</html>
<?php

?>
