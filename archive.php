<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ben_Theme
 */

 get_header(); ?>

 <main data-barba="container" data-barba-namespace="work">
   <div class="filter">
     <?php $tax = $wp_query->get_queried_object(); ?>
     <div class="container">
       <ul>
         <li><button><?php echo $tax->name; ?></button></li>
       </ul>
     </div>
   </div>
   <div class="work">
     <div class="work__grid">
       <?php
         // $args = array(
         //   'post_type' => 'project',
         // );
         //
         // $the_query = new WP_Query($args);
         //
         if ( have_posts() ):
           while ( have_posts() ): the_post();
       ?>
       <div class="work__item rellax" data-rellax-speed="-1">
         <a
           href="<?php the_permalink(); ?>"
           class="work__img"
           style="background-image: url('<?php the_post_thumbnail_url(); ?>');"
         ></a>
         <h2 class="work__title"><?php the_title(); ?></h2>
         <div class="work__meta">
           <?php $terms = get_the_terms( get_the_ID(), 'project_category');
             foreach ( $terms as $term ):
               $term_link = get_term_link( $term );
               if ( !is_wp_error($term_link) ):
           ?>
           <a class="medium--upper" href="<?php echo $term_link; ?>">
             <?php echo $term->name; ?>
           </a>
           <?php endif; endforeach; ?>
         </div>
       </div>
     <?php endwhile; endif; ?>
     </div>
   </div>


 <?php get_footer(); ?>
