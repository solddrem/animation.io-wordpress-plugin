<?php
/*
Plugin Name: Animation.io
Plugin URI: http://www.animation.io
Description: Adds Animoation.io support to Wordpress Pages
Version: 0.1
Author: Norman Philipp
*/

register_activation_hook($plugginFile, 'myActivation');
register_deactivation_hook($plugginFile, 'myDeactivation');


if ( !function_exists('myActivation') )
{
    function myActivation()
    {

    }
}

if ( !function_exists('myDeactivation') )
{
    function myDeactivation()
    {
		remove_shortcode('animation');
    }
}
    
//shortcode animaton
		function animationIO( $atts, $content = null )
		{
			extract(shortcode_atts(array(
            	  "title" => '',	
		    	  "width" => '800',	
                  "height" => '600',
                  "minwidth" => '',	
                  "maxwidth" => '',
                  "minheight" => '',	
                  "maxheight" => '',
                  "startscene" => '',		
                  "includes" => '',										 			  				  
				), $atts));
				$random = rand(0,999);
                $title = trim($title);
				$width = trim(str_replace('px','',$width));
				$height = trim(str_replace('px','',$height));
				$minwidth = trim(str_replace('px','',$minwidth));
				$minheight = trim(str_replace('px','',$minheight));
                $maxwidth = trim(str_replace('px','',$maxwidth));
				$maxheight = trim(str_replace('px','',$maxheight));
                $startscene = trim($startscene);	
                $_includes = explode( ',', $includes );

		    foreach ( $_includes as $inc ) {
		    $output =   $output . " 	<script src='" . plugins_url( 'animation.io/scenes/' . trim("$inc") , dirname(__FILE__) ) . ".js?version=" . filemtime(plugin_dir_path(__FILE__) . "scenes/" . trim("$inc") . ".js") . "'></script>"; 
		    }

$output =   $output . " 	<script src='" . plugins_url( 'animation.io/scenes/' . "$startscene" , dirname(__FILE__) ) . ".js?version=" . filemtime(plugin_dir_path(__FILE__) . "scenes/" . trim($startscene) . ".js") . "'></script>" . 
            "   <div id='animframe'></div>" . 
            "   <script type='text/javascript'>" . 
            //"// <![CDATA[" . 
            "   loadAnimationInto('". $title . "', 'animframe', '" . $startscene . "', " . $width . ", " . $height . ");" . 		
            "   developermode = true;" . 
            //"// ]]>".
            "</script>";
			return $output;
		}
		add_shortcode('animation', 'animationIO');        	

//animation.io javascript files in header einbinden
        function my_scripts_method() {
            wp_enqueue_script( 'Animation.io', 'http://server.animation.io/engine/animation.js' );
        }
        add_action( 'wp_enqueue_scripts', 'my_scripts_method' ); // wp_enqueue_scripts action hook to link only on the front-end


//add buton for animation
add_action('init', 'add_button_animation');  
function add_button_animation() {
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'add_plugin_animation');
		add_filter('mce_buttons_2', 'register_button_animation');
	}
}

function register_button_animation($buttons) {
	array_push($buttons, "animation");
	return $buttons;
}

function add_plugin_animation($plugin_array) {  
	$plugin_array['animation'] = plugins_url() . '/animation.io/animation/animation-plugin.js';  
	return $plugin_array;  
} 

add_action( 'admin_menu', 'register_animation_menu' );
function register_animation_menu(){
    add_menu_page( 'edit Animation files', 'Animation.io', 'manage_options', 'animation.io/editor/animation-editor.php', '', plugins_url( 'animation.io/animation/animation-icon.png' ));
}
 

//editor insert media
add_action('admin_enqueue_scripts', 'animation_insertmedia');
function animation_insertmedia() {
    if (isset($_GET['page']) && $_GET['page'] == 'animation.io/editor/animation-editor.php') {
        wp_enqueue_media();
        wp_register_script('animation_insertmedia', plugins_url() . '/animation.io/editor/insertmedia.js', array('jquery'));
        wp_enqueue_script('animation_insertmedia');
    }
}

?>