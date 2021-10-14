<?php
/**
 * The template for displaying the front-page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package marmalade-theme
 */

get_header(); ?>

<main data-barba="container" data-barba-namespace="home">
  <?php $hero_title = get_field('hero_title');?>
  <section class="hero hero--home">
    <?php if( have_rows('hero_carousel') ): ?>
      <div class="hero__carousel carousel">
        <?php while ( have_rows('hero_carousel') ) : the_row();
          $type = get_sub_field('type');
        ?>

          <?php if($type) { ?>
            <div
            class="hero__item"
          >
            <video autoplay loop muted playsinline>
              <source src="<?php the_sub_field('video') ?>" type="video/mp4">
            </video>
        </div>
          <?php } else {
            $desktop = get_sub_field('image');
            $mobile = get_sub_field('mobile_image');
          ?>
            <div class="hero__item js-image-loaded is-loading" >
              <?php _get_template_part('template-parts/_resp-img', [
                'field' => $desktop,
                'mobile' => $mobile,
                'sizes' => '100vw',
              ]); ?>
            </div>

          <?php } ?>

        <?php endwhile; ?>
      </div>
    <?php endif; ?>

    <div class="arrows"></div>
    <div class="hero__text-wrap">
      <?php if ( $hero_title ): ?>
      <h2 class="hero__title">
        <?php foreach ( $hero_title as $row ): ?>
        <span><?php echo $row['title']; ?></span>
        <?php endforeach; ?>
      </h2>
      <?php endif; ?>
      <div class="hero__symbols">
        <svg>
          <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-logo"></use>
        </svg>
      </div>
    </div>
    <button
      data-anchor="intro"
      class="hero__scroll-down scroll-btn"
    ></button>
  </section>

  <section class="intro" id="intro">
    <div class="intro__text-wrap container">
      <h2 class="heading--md reveal">
        <?php the_field('intro_text'); ?>
      </h2>
      <button data-anchor="projects" class="scroll-btn medium--md reveal">
        Latest projects
        <svg width="20" height="10">
          <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow"></use>
        </svg>
      </button>
    </div>

    <?php $featured = get_field('featured_projects');
    if ( !empty($featured) ): ?>
    <div class="intro__projects" id="projects">
      <?php foreach ( $featured as $pid ): ?>
      <section class="intro__project">
        <?php $project = get_field('featured', $pid );
        $gallery = $project['gallery'];
        if ( !empty($gallery) ):
        ?>
        <div class="intro__canvas-wrap reveal">
          <a href="<?php echo get_the_permalink($pid) ?>">
            <div class="intro__carousel js-image-loaded is-loading">
              <?php foreach ( $gallery as $img ):  ?>
              <div class="intro__slide">
                <?php  _get_template_part('template-parts/_resp-img', [
                  'field' => $img,
                  'sizes' => '(max-width: 767px) 100vw, (max-width: 1023px) 85vw, (max-width: 1440px) 1550px'
                ]); ?>
              </div>
              <?php endforeach; ?>
            </div>

            <?php foreach ( $gallery as $img ): ?>
            <div class="intro__img" data-src="<?php echo $img['url']; ?>"></div>
            <?php endforeach; ?>
            <canvas class="intro__canvas displacement"></canvas>
          </a>
        </div>
      <?php endif; ?>
        <div class="intro__details">
          <div class="intro__meta reveal">
            <span class="intro__name"><?php echo get_the_title($pid); ?></span>
            <div class="intro__cat">
              <button class="intro__cat-btn" style="left: 0;">
                <?php
                $terms = get_the_terms($pid, 'project_category');

                foreach ($terms as $term) {

                  if ($term->slug == 'identity') { ?>
                    <svg width="25" height="25" class="intro__cat--identity">
                      <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-circle"></use>
                    </svg>
                  <?php } elseif($term->slug == 'packaging') { ?>
                    <svg width="24" height="24" class="intro__cat--packaging">
                      <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-square"></use>
                    </svg>
                  <?php } elseif ($term->slug == 'events') { ?>
                    <svg width="27" height="25" class="intro__cat--events">
                      <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-triangle"></use>
                    </svg>
                  <?php }
                }
                ?>
              </button>
            </div>
          </div>
          <?php if ( !empty($project['description']) ): ?>
          <h3 class="heading--md reveal">
            <?php echo $project['description']; ?>
          </h3>
          <?php endif; ?>
        </div>
      </section>
    <?php endforeach; ?>
    </div>
  <?php endif; ?>

  </section>


<?php get_footer(); ?>
