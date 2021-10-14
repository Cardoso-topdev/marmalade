<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package marmalade-theme
 */

 //Add ACF Options page
  if( function_exists('acf_add_options_page') ) {

  	acf_add_options_page(array('page_title' => 'Theme Settings'));
    // acf_add_options_page();

  }

// AJAX load more posts
function load_post()
{
  header('Content-Type: application/json');

  $ids = $_POST['ids'];

  // WP_Query arguments
  $args = array(
    'post_type'              => array( 'post' ),
    'posts_per_page'         => 1,
    'post_status'            => 'publish',
    'post__not_in'           => $ids
  );

  // The Query
  $query = new WP_Query( $args );

  // The Loop
  if ( $query->have_posts() ) {
    ob_start();

    while ( $query->have_posts() ) {
      $query->the_post();
      $id = get_the_ID();
      get_template_part( 'template-parts/content-post' );
    }

    $new_post = ob_get_contents();
    ob_end_clean();
  }

  // Restore original Post Data
  wp_reset_postdata();

  $results = array('post' => $new_post, 'id' => $id );
	$jsonString = json_encode($results);
  die($jsonString);
}

add_action('wp_ajax_load_post', 'load_post');
add_action('wp_ajax_nopriv_load_post', 'load_post');

/**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the template as $template_args array
 * @param string filepart
 * @param mixed wp_args style argument list
 */
function _get_template_part( $file, $template_args = array(), $cache_args = array() ) {

	$template_args = wp_parse_args( $template_args );
	$cache_args = wp_parse_args( $cache_args );

	if ( $cache_args ) {

		foreach ( $template_args as $key => $value ) {
			if ( is_scalar( $value ) || is_array( $value ) ) {
				$cache_args[$key] = $value;
			} else if ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
				$cache_args[$key] = call_user_method( 'get_id', $value );
			}
		}

		if ( ( $cache = wp_cache_get( $file, serialize( $cache_args ) ) ) !== false ) {

			if ( ! empty( $template_args['return'] ) )
				return $cache;

			echo $cache;
			return;
		}

	}

	$file_handle = $file;

	do_action( 'start_operation', 'hm_template_part::' . $file_handle );

	if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) )
		$file = get_stylesheet_directory() . '/' . $file . '.php';

	elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) )
		$file = get_template_directory() . '/' . $file . '.php';

	ob_start();
	$return = require( $file );
	$data = ob_get_clean();

	do_action( 'end_operation', 'hm_template_part::' . $file_handle );

	if ( $cache_args ) {
		wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
	}

	if ( ! empty( $template_args['return'] ) )
		if ( $return === false )
			return false;
		else
			return $data;

	echo $data;
}

