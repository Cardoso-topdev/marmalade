<?php
/**
 * The template for displaying all single project
 *
 */

 get_header(); ?>

 <main data-barba="container" data-barba-namespace="project">
    <div class="info">
      <div class="info__container">
        <button class="info__close">
          <svg width="22" height="22">
            <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-close"></use>
          </svg>
        </button>
        <h2><?php the_title(); ?></h2>
        <?php $info = get_field('info'); ?>
        <div class="info__text-wrap">
          <div class="info__col">
            <?php echo $info['left_column']; ?>
          </div>
          <div class="info__col">
            <?php echo $info['right_column']; ?>
          </div>
        </div>
      </div>
    </div>

   <section class="project <?php if(get_field('project_reverse')) echo 'project--reverse'; ?>">
     <header class="project__header">
       <h1 class="heading--md reveal"><?php the_field('header_copy') ?></h1>
       <h2 class="medium--upper reveal"><?php the_title(); ?></h2>
       <button class="project__info-btn reveal">info</button>
     </header>

     <?php
     if ( have_rows('flexible_content') ):
       while( have_rows('flexible_content') ): the_row();
       if ( get_row_layout() == 'gallery' ):
     ?>
     <div class="project__gallery">
       <div class="project__carousel carousel">
          <?php
          $img_length = 0;
          if( have_rows('images') ):
              while ( have_rows('images') ) : the_row();
                $mobile = get_sub_field('mobile_image');
                $desktop = get_sub_field('desktop_image');
                $img_length++;
              ?>

               <div
                class="project__gallery-item js-image-loaded is-loading"
              >
                <?php _get_template_part('template-parts/_resp-img', [
                  'field' => $desktop,
                  'mobile' => $mobile,
                  'sizes' => '(max-width: 767px) 100vw',
                ]); ?>
              </div>

              <?php endwhile;
          endif;
          ?>

       </div>
       <div class="arrows arrows--full">
        <?php if($img_length > 1) { ?>
            <div class="arrows__indicators">
              <svg width="80" height="19">
                <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrows"></use>
              </svg>
            </div>
        <?php } ?>
       </div>
     </div>

   <?php elseif ( get_row_layout() == 'intro' ): ?>
     <div class="project__intro">
       <h2 class="heading--md reveal">
         <?php the_sub_field('intro_text'); ?>
       </h2>
     </div>

   <?php elseif ( get_row_layout() == 'video' ):
      $type = get_sub_field('video_type');
      $color = get_sub_field('background_color');

      if ($color) {
        $color = 'style="background-color: '. $color.';"';
      }
    ?>
     <div class="project__embed reveal <?php if($type) echo 'project__embed--video' ?>" >
       <div class="project__embed-inner" <?php echo $color; ?>>
        <div class="container">
          <?php if($type) { ?>
              <video loop muted playsinline autoplay>
                <source src="<?php the_sub_field('video') ?>" type="video/mp4">
              </video>
            <?php } else {
              $autoplay = get_sub_field('autoplay');
            ?>
              <div class="embed-container">
                <iframe
                  src="<?php the_sub_field('video_url'); ?>?controls=0&muted=1&autopause=0"
                  class="<?php if($autoplay) echo 'is-autoplay'; ?>"
                  frameborder="0"
                  allowfullscreen
                  allow='autoplay'
                ></iframe>
                <button class="project__play">play</button>
                <button class="project__mute">
                  <svg width="25" height="25">
                   <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-mute"></use>
                  </svg>
                </button>
              </div>
          <?php } ?>
        </div>
       </div>
     </div>

   <?php elseif ( get_row_layout() == 'image' ):
      $filter = get_sub_field('displacement');
      $image = get_sub_field('image');
    ?>
     <div class="project__img project__img--centered reveal">
       <div class="js-image-loaded is-loading">
        <?php if($filter) { ?>
          <canvas class="displacement"></canvas>
        <?php } ?>
        <?php _get_template_part('template-parts/_resp-img', [
          'field' => $image,
          'sizes' => '(max-width: 767px) 100vw, (max-width: 1023px) 80vw, 60vw',
          'data-src' => true
        ]); ?>
       </div>
     </div>

    <?php elseif ( get_row_layout() == 'two_image' ):
      $image_1 = get_sub_field('image_1');
      $filter_1 = get_sub_field('displacement_1');
      $image_2 = get_sub_field('image_2');
      $filter_2 = get_sub_field('displacement_2');
    ?>
     <div class="project__double container project__double--<?php the_sub_field('block_type') ?>">
       <div class="project__img-wrap reveal js-image-loaded is-loading">
        <?php if($filter_1) { ?>
          <canvas class="displacement"></canvas>
        <?php } ?>
          <?php _get_template_part('template-parts/_resp-img', [
          'field' => $image_1,
          'sizes' => '(max-width: 767px) 100vw, 30vw',
          'data-src' => true
        ]); ?>
       </div>
       <div class="project__img-wrap reveal js-image-loaded is-loading">
          <?php if($filter_2) { ?>
            <canvas class="displacement"></canvas>
          <?php }?>
          <?php _get_template_part('template-parts/_resp-img', [
            'field' => $image_2,
            'sizes' => '(max-width: 767px) 100vw, (max-width: 1023px) 80vw, 60vw',
            'data-src' => true
          ]); ?>
       </div>
     </div>

   <?php elseif ( get_row_layout() == 'text' ): ?>
     <div class="project__text heading--md reveal">
       <p>
         <?php the_sub_field('text');?>
       </p>
     </div>

   <?php elseif ( get_row_layout() == 'website' ):
    $site = get_sub_field('website_screenshot');
    ?>
     <div class="project__website" style="background-color: <?php the_sub_field('background_color') ?>;">
       <div class="website reveal">
         <div class="website__bar">
           <img src="<?php echo get_template_directory_uri(); ?>/img/browser-bar.jpg" alt="" />
         </div>
         <div class="website__content js-image-loaded is-loading">
           <button data-src="<?php echo $site['url']; ?>" data-fancybox>
            <?php _get_template_part('template-parts/_resp-img', [
              'field' => $site,
              'sizes' => '(max-width: 767px) 70vw, 1024px',
            ]); ?>
           </button>
         </div>
       </div>
     </div>


   <?php elseif ( get_row_layout() == 'mockups' ): ?>
     <div class="project__mockups">
       <img class="reveal" src="<?php the_sub_field('mockup_1'); ?>" alt="Mockup" loading="lazy" />
       <img class="reveal" src="<?php the_sub_field('mockup_2'); ?>" alt="Mockup" loading="lazy" />
     </div>

   <?php elseif ( get_row_layout() == 'three_images_section' ):
      $image_1 = get_sub_field('image_1');
      $filter_1 = get_sub_field('displacement_1');
      $image_2 = get_sub_field('image_2');
      $filter_2 = get_sub_field('displacement_2');
      $image_3 = get_sub_field('image_3');
      $filter_3 = get_sub_field('displacement_3');
    ?>

    <div class="project__triple container">
      <div class="project__img-wrap reveal js-image-loaded is-loading">
        <?php if($filter_1) { ?>
          <canvas class="displacement"></canvas>
        <?php }?>
        <?php _get_template_part('template-parts/_resp-img', [
          'field' => $image_1,
          'sizes' => '(max-width: 767px) 100vw, 36vw',
          'data-src' => true
        ]); ?>
      </div>
      <div class="project__img-wrap reveal js-image-loaded is-loading">
        <?php if($filter_2) { ?>
          <canvas class="displacement"></canvas>
        <?php }?>
        <?php _get_template_part('template-parts/_resp-img', [
          'field' => $image_2,
          'sizes' => '(max-width: 767px) 100vw, 36vw',
          'data-src' => true
        ]); ?>
      </div>
      <div class="project__img-wrap reveal js-image-loaded is-loading">
        <?php if($filter_3) { ?>
          <canvas class="displacement"></canvas>
        <?php }?>
        <?php _get_template_part('template-parts/_resp-img', [
          'field' => $image_3,
          'sizes' => '(max-width: 767px) 100vw, 65vw',
          'data-src' => true
        ]); ?>
      </div>
    </div>

    <?php elseif ( get_row_layout() == 'copy_block' ): ?>

      <div class="copy-block container">
        <?php the_sub_field('copy') ?>
      </div>

   <?php endif; ?>
  <?php endwhile; endif; ?>
</section>

 <?php get_footer(); ?>
