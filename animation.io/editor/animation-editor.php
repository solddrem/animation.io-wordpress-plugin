<?php
/**
*http://www.dollyonrails.de/wp-content/plugins/animation.io/aditor/animation-editor.php
 * Animation editor panel.
 *
 * @package Animation.io
 */

if (basename($_SERVER['PHP_SELF']) == basename (__FILE__)) {
	wp_die('<p>'.__('Use Animation.io menu to access scene editor').'</p>');
}

if ( !(current_user_can('edit_posts') &&  current_user_can('edit_pages')) )
	wp_die('<p>'.__('You do not have sufficient permissions to edit animations for this site.').'</p>');

$title = __("Edit Animation");
$parent_file = 'plugins.php';

get_current_screen()->add_help_tab( array(
'id'		=> 'overview',
'title'		=> __('Overview'),
'content'	=>
	'<p>' . __('You can use the animation editor to edit the javascript animation files which make up your animation.') . '</p>
	<p>' . __('Begin by choosing a scene file to edit from the list. Clicking once on any acene file name causes the file to appear in the large Editor box.') . '</p>
	<p>' . __('') . '</p>' .
	( is_network_admin() ? '<p>' . __('') . '</p>' : '' )
) );

get_current_screen()->set_help_sidebar(
	'<p><strong>' . __('For more information:') . '</strong></p>' .
	'<p>' . __('<a href="http://animation.io/" target="_blank">Official website</a>') . '</p>' .
	'<p>' . __('<a href="http://demo.animation.io/#" target="_blank">Online examples</a>') . '</p>' .
	'<p>' . __('<a href="http://group.animation.io/" target="_blank">Support group</a>') . '</p>' .
	'<p>' . __('<a href="https://github.com/mehreinfach/animation.io/" target="_blank">Animation.io on GitHub</a>') . '</p>' .
	'<p>' . __('<a href="http://mehreinfach.de/" target="_blank">about the initiator: Mehreinfach</a>') . '</p>'
);

wp_reset_vars( array( 'action', 'error', 'file' ) );

if ( ! file_exists( get_scenes_directory() ) )
	wp_die( __( 'The scenes does not exist.' ) );

$allowed_files = get_animation_files( 'js', 0 );
$has_animations = ! empty( $allowed_files );

if ( empty( $file ) ) {
	$relative_file = 'scene0.js';
	$file = $allowed_files['scene0.js'];
} else {
	$relative_file = urldecode( stripslashes( $file ) );
	$file = get_scenes_directory() . $relative_file;
}

validate_file_to_edit( $file, $allowed_files );
$scrollto = isset( $_REQUEST['scrollto'] ) ? (int) $_REQUEST['scrollto'] : 0;

switch( $action ) {
case 'update':

	check_admin_referer( 'edit-animation_' . $file );

	$newcontent = stripslashes( $_POST['newcontent'] );
	$location = 'admin.php?page=animation.io/editor/animation-editor.php&noheader=true&file=' . urlencode( $relative_file ) . '&scrollto=' . $scrollto;
	if ( is_writeable( $file ) ) {
		//is_writable() not always reliable, check return value. see comments @ http://uk.php.net/is_writable
		$f = fopen( $file, 'w+' );
		if ( $f !== false ) {
			fwrite( $f, $newcontent );
			fclose( $f );
			$location .= '&updated=true';
		}
	}
	wp_redirect( $location );
	exit;
break;

default:


if (isset($_GET['noheader'])) {
    require_once(ABSPATH . 'wp-admin/admin-header.php');
    }

	update_recently_edited( $file );

	if ( ! is_file( $file ) )
		$error = true;

	$content = '';
	if ( ! $error && filesize( $file ) > 0 ) {
		$f = fopen($file, 'r');
		$content = fread($f, filesize($file));

		if ( '.php' == substr( $file, strrpos( $file, '.' ) ) ) {
			$functions = wp_doc_link_parse( $content );

			$docs_select = '<select name="docs-list" id="docs-list">';
			$docs_select .= '<option value="">' . esc_attr__( 'Function Name...' ) . '</option>';
			foreach ( $functions as $function ) {
				$docs_select .= '<option value="' . esc_attr( urlencode( $function ) ) . '">' . htmlspecialchars( $function ) . '()</option>';
			}
			$docs_select .= '</select>';
		}

		$content = esc_textarea( $content );
	}

	?>
<?php if ( isset( $_GET['updated'] ) ) : ?>
 <div id="message" class="updated"><p><?php _e( 'File edited successfully.' ) ?></p></div>
<?php endif;

$description = get_file_description( $file );
$file_show = array_search( $file, array_filter( $allowed_files ) );
if ( $description != $file_show )
	$description .= ' <span>(' . $file_show . ')</span>';
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2><?php echo esc_html( $title ); ?></h2>
    
<div class="fileedit-sub">
<div class="alignleft">
<h3><?php if ( $description ) echo $description; ?></h3>
</div>
<div class="alignright">
Further
</div>
<br class="clear" />
</div>
	<div id="templateside">
<?php
if ( $allowed_files ) :
	if ( $has_animations ) :
?>
	<h3><?php _e('Scenes'); ?></h3>
	<ul>
<?php
	endif;

	foreach ( get_animation_files() as $filename => $absolute_filename ) :

		$file_description = get_file_description( $absolute_filename );
		if ( $file_description != basename( $filename ) )
			$file_description .= '<br /><span class="nonessential">(' . $filename . ')</span>';

		if ( $absolute_filename == $file )
			$file_description = '<span class="highlight">' . $file_description . '</span>';
?>
		<li><a href="admin.php?page=animation.io/editor/animation-editor.php&file=<?php echo urlencode( $filename ) ?>&amp;"><?php echo $file_description; ?></a></li>
<?php
	endforeach;
?>
</ul>
<?php endif; ?>
</div>
<label for="insert_media">
      <button name="Klickmich" id="insert_imageurl_button" type="button" value="Add Media">
          <img src="/wp-admin/images/media-button.png"> Add Media
    </button>
</label>
<?php if ( $error ) :
	echo '<div class="error"><p>' . __('Oops, no such file exists! Double check the name and try again, merci.') . '</p></div>';
else : ?>
	<form name="template" id="template" action="admin.php?page=animation.io/editor/animation-editor.php&noheader=true" method="post">
	<?php wp_nonce_field( 'edit-animation_' . $file ); ?>
		 <div><textarea cols="70" rows="30" name="newcontent" id="newcontent" tabindex="1"><?php echo $content ?></textarea>
         <input type="hidden" name="xxpage" id="page" value="animation.io/editor/animation-editor.php" />
  		 <input type="hidden" name="action" value="update" />
		 <input type="hidden" name="file" value="<?php echo esc_attr( $relative_file ); ?>" />
		 <input type="hidden" name="scrollto" id="scrollto" value="<?php echo $scrollto; ?>" />
		 </div>
	<?php if ( ! empty( $functions ) ) : ?>
		<div id="documentation" class="hide-if-no-js">
		<label for="docs-list"><?php _e('Documentation:') ?></label>
		<?php echo $docs_select; ?>
		<input type="button" class="button" value=" <?php esc_attr_e( 'Lookup' ); ?> " onclick="if ( '' != jQuery('#docs-list').val() ) { window.open( 'http://api.wordpress.org/core/handbook/1.0/?function=' + escape( jQuery( '#docs-list' ).val() ) + '&amp;locale=<?php echo urlencode( get_locale() ) ?>&amp;version=<?php echo urlencode( $wp_version ) ?>&amp;redirect=true'); }" />
		</div>
	<?php endif; ?>

		<div>
<?php
	if ( is_writeable( $file ) ) :
		submit_button( __( 'Update File' ), 'primary', 'submit', true, array( 'tabindex' => '2' ) );
	else : ?>
<p><em><?php _e('You need to make this file writable before you can save your changes. See <a href="http://codex.wordpress.org/Changing_File_Permissions">the Codex</a> for more information.'); ?></em></p>
<?php endif; ?>
		</div>
	</form>
<?php
endif; // $error
?>
<br class="clear" />
</div>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){
	$('#template').submit(function(){ $('#scrollto').val( $('#newcontent').scrollTop() ); });
	$('#newcontent').scrollTop( $('#scrollto').val() );
});
/* ]]> */
</script>
<?php
break;
}

function get_animation_files( $type = null, $depth = 0, $search_parent = false ) {
		$files = (array) scan_scene_dir( get_scenes_directory(), $type, $depth );

		return $files;
}

function get_scenes_directory() {
    	if ( ! file_exists( dirname(plugin_dir_path( __FILE__ )) . '/scenes/' ) ) // Don't cache this one.
			return '';

		return dirname(plugin_dir_path( __FILE__ )) . '/scenes/';
	}

function scan_scene_dir( $path, $extensions = null, $depth = 0, $relative_path = '' ) {
		if ( ! is_dir( $path ) )
			return false;

		if ( $extensions ) {
			$extensions = (array) $extensions;
			$_extensions = implode( '|', $extensions );
		}

		$relative_path = trailingslashit( $relative_path );
		if ( '/' == $relative_path )
			$relative_path = '';

		$results = scandir( $path );
		$files = array();

		foreach ( $results as $result ) {
			if ( '.' == $result[0] )
				continue;
			if ( is_dir( $path . '/' . $result ) ) {
				if ( ! $depth || 'CVS' == $result )
					continue;
				$found = self::scandir( $path . '/' . $result, $extensions, $depth - 1 , $relative_path . $result );
				$files = array_merge_recursive( $files, $found );
			} elseif ( ! $extensions || preg_match( '~\.(' . $_extensions . ')$~', $result ) ) {
				$files[ $relative_path . $result ] = $path .  $result; //'/' .
			}
		}

		return $files;
	}