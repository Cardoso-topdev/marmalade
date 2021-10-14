<?php
/**
 * The template for displaying all single posts
 *
 */

get_header(); ?>

<main data-barba="container" data-barba-namespace="project">
  <div class="project-wrapper <?php if(get_field('project_reverse')) echo 'is-reverse'; ?>">

    <?php get_template_part( 'template-parts/content-post' ); ?>

    <div class="project__more">
      <div class="project__container"></div>
      <button class="project__load medium--md" data-id="<?php echo get_the_ID() ?>" data-total="<?php echo wp_count_posts()->publish ?>">Previous Marm Thinks</button>
    </div>

  </div>

  <div class="cover-form">
    <div class="cover-form__inner container">
      <h2 class="text-light"><?php the_field('cover_title', 'options') ?></h2>
      <?php $id = get_field('signup_form_id','option');
      $shortcode = '[gravityform id='.$id.' title=false description=false ajax=true]';
      echo do_shortcode($shortcode);
      ?>
    </div>
  </div>

<?php get_footer(); ?>
