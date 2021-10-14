<?php
/**
 * Template Name: Work
 *
 */

get_header(); ?>

<main data-barba="container" data-barba-namespace="work">
  <div class="filter">
    <div class="container">
      <ul>
        <li><button data-target="all" class="filter__current">All</button></li>
        <li><button data-target="identity">Identity</button></li>
        <li><button data-target="packaging">Packaging</button></li>
        <li><button data-target="events">Events</button></li>
      </ul>
    </div>
  </div>

<?php $cat_string = 'all'; ?>
  <div class="work">
    <div class="work__grid work__grid--filtered work__grid--current" id="<?php echo $cat_string; ?>">
      <?php
        $args = array(
          'post_type' => 'project',
          'posts_per_page' => -1
        );

        $the_query = new WP_Query($args);

        $identity = array();
        $packaging = array();
        $events = array();

        $parallax_speed = array('10%', 0, '-10%', '-10%', '-10%', '10%', '-10%', '-20%', '10%');
        $count = 0;


        if ( $the_query->have_posts() ):
          while ( $the_query->have_posts() ): $the_query->the_post();
          $filter = get_field('displacement');

          $parallax_no = $parallax_speed[$count%9];
          $terms = get_the_terms( get_the_ID(), 'project_category');
          $term_classes = '';
          foreach ( $terms as $term ){
            $term_classes .= ' '. $term->slug;
          }
          $sizes = ['50vw', '33vw', '32vw', '65vw', '50vw', '32vw', '50vw', '32vw', '32vw'];
          $size = $count <= 9 ? $sizes[$count] : $sizes[$count - 9]
      ?>
      <div class="work__item <?php echo $term_classes; ?> js-parallax"
        data-parallax="<?php echo $parallax_no; ?>">
        <div class="work__inner">

          <a
          href="<?php the_permalink(); ?>"
          class="work__img js-image-loaded is-loading"
          >
            <?php _get_template_part('template-parts/_resp-img', [
              'ID' => get_the_ID(),
              'sizes' => '(max-width: 767px) 100vw, ' . $size,
              'data-src' => true
            ]); ?>
            <?php if($filter) {  
// have removed this - and added thumbnail in div below - not sure whats happened here              
// but displacement not working otherwise ***
?>
              
<!--               <div data-src="<?php // echo get_the_post_thumbnail_url(get_the_ID()) ?>"></div> -->
              <canvas class="displacement"></canvas>
            <?php } ?>
          </a>

        <h2 class="work__title"><?php the_title(); ?></h2>
        <div class="work__meta">
          <?php
            foreach ( $terms as $term ):
              $term_link = get_term_link( $term );
              if ( $term->slug == 'identity' ){
                array_push($identity, get_the_ID() );
              } elseif ( $term->slug == 'packaging' ) {
                array_push($packaging, get_the_ID() );
              } elseif ( $term->slug == 'events' ) {
                array_push($events, get_the_ID() );
              }
              if ( !is_wp_error($term_link) ):
          ?>
          <a class="medium--upper" href="<?php echo $term_link; ?>">
            <?php echo $term->name; ?>
          </a>
          <?php endif; endforeach; ?>
        </div>
      </div>
    </div>

      <?php $count++; ?>
    <?php endwhile; endif; ?>
    </div>

    <?php
    $category = $identity; $cat_string = 'identity';
    include(locate_template('template-parts/content-projects.php'));

    $category = $packaging; $cat_string = 'packaging';
    include(locate_template('template-parts/content-projects.php'));

    $category = $events; $cat_string = 'events';
    include(locate_template('template-parts/content-projects.php'));
    ?>

  </div>


<?php get_footer(); ?>
