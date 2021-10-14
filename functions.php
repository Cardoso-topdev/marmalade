<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package marmalade-theme
 */

 if ( ! function_exists( 'theme_setup' ) ) :
 /**
  * Sets up theme defaults and registers support for various WordPress features.
  *
  * Note that this function is hooked into the after_setup_theme hook, which
  * runs before the init hook. The init hook is too late for some features, such
  * as indicating support for post thumbnails.
  */
 function theme_setup() {

 	// Add default posts and comments RSS feed links to head.
 	add_theme_support( 'automatic-feed-links' );

 	/*
 	 * Let WordPress manage the document title.
 	 * By adding theme support, we declare that this theme does not use a
 	 * hard-coded <title> tag in the document head, and expect WordPress to
 	 * provide it for us.
 	 */
 	add_theme_support( 'title-tag' );

 	/*
 	 * Enable support for Post Thumbnails on posts and pages.
 	 *
 	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 	 */
 	add_theme_support( 'post-thumbnails' );


 	register_nav_menus( array(
 		'header-main-menu' => esc_html__( 'Main Menu' ),
 		'footer-menu' => esc_html__( 'Footer Menu' )
 	) );

 	/*
 	 * Switch default core markup for search form, comment form, and comments
 	 * to output valid HTML5.
 	 */
 	add_theme_support( 'html5', array(
 		'search-form',
 		'comment-form',
 		'comment-list',
 		'gallery',
 		'caption',
 	) );

 }
 endif;
 add_action( 'after_setup_theme', 'theme_setup' );

 // Adds CSS
 // ============
 function theme_styles() {
    wp_dequeue_style( 'wp-block-library' );
   wp_enqueue_style( 'fancyboxCSS', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css' );
	 wp_enqueue_style( 'mainCSS', get_template_directory_uri() . '/css/style.min.css', '', '2.5' );
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/css/fonts.css', '', '2.5' );
 }
 add_action( 'wp_enqueue_scripts', 'theme_styles');

 // Adds JS
 // ==========
 function theme_js() {
    wp_enqueue_script( 'picturefill', get_template_directory_uri() . '/js/picturefill.min.js#asyncload', '', '', false);
    wp_enqueue_script( 'barbaJS', 'https://cdn.jsdelivr.net/npm/@barba/core', '', '1.0', true);
    wp_enqueue_script( 'gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.0.4/dist/gsap.min.js', '', '3.0.4', true);
    wp_enqueue_script( 'pixiJS', 'https://cdnjs.cloudflare.com/ajax/libs/pixi.js/4.5.1/pixi.min.js', '', '4.5.1', true);
    wp_enqueue_script( 'fancyboxJS', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', '', '3.5.7', true);
    wp_enqueue_script( 'vimeo', 'https://player.vimeo.com/api/player.js', '', '1.0', true);
    wp_enqueue_script( 'scroll', 'https://cdnjs.cloudflare.com/ajax/libs/smoothscroll/1.4.10/SmoothScroll.min.js', '', '1.0', true);
    wp_enqueue_script( 'imagesLoaded', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', '', '4.0', true);
    wp_enqueue_script( 'libs', get_template_directory_uri() . '/js/libs.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script( 'mainJS', get_template_directory_uri() . '/js/main.min.js', array('jquery'), '2.0', true);

    wp_localize_script( 'mainJS', 'theme', array(
      'home_url' => get_stylesheet_directory_uri(),
      'ajax' => admin_url('admin-ajax.php' )
    ) );
 }
 add_action( 'wp_enqueue_scripts', 'theme_js');



// preload
//  function add_rel_preload($html, $handle, $href, $media) {


// 	if (is_admin())
// 			return $html;

// 	 $html = <<<EOT
// <link rel='preload' as='style' onload="this.onload=null;this.rel='stylesheet'" id='$handle' href='$href' type='text/css' media='all' />
// EOT;
// 	return $html;
// }
// add_filter( 'style_loader_tag', 'add_rel_preload', 10, 4 );



  //defer scripts
function defer_scripts( $tag, $handle, $src ) {
	$defer = array(
		'picturefill',
		'barbaJS',
		'gsap',
		'pixiJS',
		'fancyboxJS',
		'vimeo',
		'scroll',
		'imagesLoaded',
		'libs',
		'mainJS'
	);
	if ( in_array( $handle, $defer ) ) {
		 return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
	}

		return $tag;
}
add_filter( 'script_loader_tag', 'defer_scripts', 10, 3 );

 // Custom login
// =============
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/custom-login.css' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

// Implement Additional files
//==========
//

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
* Load Custom Posts file
*/
require get_template_directory() . '/inc/custom-posts.php';

/**
* Load Custom Taxonomies file
*/
require get_template_directory() . '/inc/custom-taxonomies.php';

/**
* Theme appearance file (for customising login page and other appearance stuff)
*/
require get_template_directory() . '/inc/theme-appearance.php';

// Remove all emoji scripts and styles from the frontend and admin
function removeEmojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action('init', 'removeEmojis');

// Remove embed script
function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );

// Clean up wp_head
function cleanHeader() {
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'index_rel_link' ); // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post
	remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
}
add_action('init', 'cleanHeader');

// changing the logo link from wordpress.org to your site
function login_url() {  return home_url(); }
add_filter( 'login_headerurl', 'login_url' );

// changing the alt text on the logo to show your site name
function login_title() { return get_option( 'blogname' ); }
add_filter( 'login_headertitle', 'login_title' );

// hide posts
// function post_remove ()  {
//    remove_menu_page('edit.php');
// }
// add_action('admin_menu', 'post_remove');





//addsa a custom widget to dashboard


add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
  
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Contact Form Uploads', 'custom_dashboard_help');
}
 
function custom_dashboard_help() {
	echo '<h4>All files uploaded via contact form are accessible here</h4>';
echo '<a href="' . get_home_url() . '/wp-admin/admin.php?page=wp_file_manager" >';
echo '<button style="font-size: 15px;font-weight: 500;padding: 1px 20px;"> Access Files</button></a>';


}




