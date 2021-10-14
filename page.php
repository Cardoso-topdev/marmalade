<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ben_Theme
 */

 get_header(); ?>

 		<?php
 		if ( have_posts() ) :

 			/* Start the Loop */
 			while ( have_posts() ) : the_post();

 			the_content();

 			endwhile;

 		else :

 			echo "No posts found.";

 		endif; ?>

 <?php get_footer(); ?>
