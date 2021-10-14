<?php
/**
 * The template for displaying the footer
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
if(is_singular('project') || is_single()) {
  $footerClass = 'page-footer--project';
} else if(is_page_template('page-work.php')) {
  $footerClass = 'page-footer--min';
}

?>
    <footer class="page-footer <?php echo $footerClass; ?>">
      <div class="container">
        <button class="scroll-top js-scroll-top">
          <svg width="20" height="10">
            <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow"></use>
          </svg>
          back to top
        </button>

        <?php if (  $type  ) {
          $title = 'Similar Projects';
        } else {
          $title = 'Find out more';
        } ?>

        <nav class="page-footer__nav">
          <div class="page-footer__preview">
            <img src="" alt="Project Preview">
          </div>

          <span><?php echo $title; ?></span>
          <ul>
            <?php if ( !is_singular('project') ) {
              $link = get_field('footer_projects_link', 'options');
              if( $link ):
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                  $link_target = $link['target'] ? $link['target'] : '_self';
                  ?>
                  <li><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></li>
              <?php endif; ?>
              <li>
                <button class="btn-contact">Contact Us</button>
              </li>
            <?php } else {
              $current_post = $post;
              $reset = false;
              for($i = 1; $i <= 4; $i++):
                $next = get_next_post(); // this uses $post->ID

                if ($next && !$reset) {
                  $post = $next;
                } else {
                  if(!$reset) {
                    $post = $current_post;
                    $reset = true;
                  }
                  $post = get_previous_post();
                }
                setup_postdata($post);
                $image = get_field('featured')['gallery'][0];

                if($i == 1) {
                  $terms = get_the_terms( get_the_ID(), 'project_category');
                  $terms_string = '';
                  foreach ( $terms as $term ){
                    $terms_string .= '<span class="medium--upper">'.  $term->slug . '</span>';
                  }
                }
                ?>
                <li>
                  <a href="<?php the_permalink() ?>" data-src="<?php the_post_thumbnail_url(); ?>">
                    <?php the_title() ?>
                    <?php
                     if($i == 1) {
                      $first_link = get_the_permalink();
                      echo '<div class="page-footer__meta">'.  $terms_string . '</div>';
                    }
                    ?>
                  </a>
                </li>
              <?php endfor;
              wp_reset_postdata();
            } ?>
          </ul>
        </nav>

        <?php if(is_singular('project') && $first_link) { ?>
          <a href="<?php echo $first_link ?>" class="scroll-top scroll-top--next">
            <svg width="20" height="10">
              <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow"></use>
            </svg>
            Next project
          </a>
        <?php } ?>

        <div class="page-footer__block">
          <a href="<?php echo get_home_url(); ?>" class="page-footer__logo">
            <svg width="62" height="15">
              <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-logo"></use>
            </svg>
            marmalade london
          </a>
          <ul>
            <!-- <li>
              <?php
               // $args = array(
                 // 'numberposts' => '1',
                //  'post_status' => 'publish'
                //);
               // $recent_posts = wp_get_recent_posts( $args );
              //  foreach( $recent_posts as $recent ) {
                //  echo '<a href="' . get_permalink($recent["ID"]) . '">Marm Thinks</a>';
               // } ?>
            </li> -->
            <li>
              <?php $media = get_field('social_media', 'option'); ?>
              <a href="<?php echo $media['instagram_link']; ?>">Instagram</a>
            </li>
            <li>
              <button class="page-footer__subscribe">
                <span>Subscribe</span>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </footer>

    <div class="subscribe">
      <?php $id = get_field('signup_form_id','option');
      $shortcode = '[gravityform id='.$id.' title=false description=false ajax=true]';
      echo do_shortcode($shortcode);
      ?>
    </div>
  </main>
  </div>

  <?php wp_footer(); ?>

  </body>
</html>
