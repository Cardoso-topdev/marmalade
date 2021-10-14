<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package marmalade-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <script>
      // Picture element HTML5 shiv
      document.createElement('picture');
    </script>
    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/fonts/Canela-Regular-Web.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/fonts/basis-grotesque-medium.woff" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="<?php echo get_template_directory_uri() ?>/fonts/basis-grotesque-regular.woff" as="font" type="font/woff" crossorigin>

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?> data-barba="wrapper">
    <div class="page-wrapper">
      <div class="landing <?php if(is_front_page()) echo 'is-active'; ?>">
        <svg width="83" height="20">
          <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-logo"></use>
        </svg>
        <h1>marmalade london</h1>
      </div>

      <div class="loader"></div>

      <header class="page-header">
        <div class="container">
        <div class="" style="display: flex; align-items: baseline;">
          <a class="page-header__link" href="<?php echo esc_url( home_url( '/studio/' ) ); ?>">Studio</a>

              <?php
                $args = array(
                  'numberposts' => '1',
                  'post_status' => 'publish'
                );
                $recent_posts = wp_get_recent_posts( $args );
                foreach( $recent_posts as $recent ) {
                  echo '<a href="' . get_permalink($recent["ID"]) . '" class="page-header__link" style="margin-left: 20px">MarmThinks</a>';
                } ?>
          </div>
          <button class="page-header__menu-btn">
            <a href="<?php echo get_home_url(); ?>" class="page-header__logo">
              <svg width="75" height="18">
                <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-logo"></use>
              </svg>
            </a>
          </button>
          <div class="page-header__wrap">
            <a class="page-header__link" href="<?php echo esc_url( home_url( '/work/' ) ); ?>">Work</a>
            <button class="page-header__link btn-contact">Contact</button>
          </div>
          <div class="page-header__nav-wrap">
            <nav class="page-header__nav">
              <button class="page-header__close">
                <svg width="22" height="22">
                  <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-close"></use>
                </svg>
              </button>
              <ul>
                <li><a href="<?php echo esc_url( home_url( ) ); ?>">Home</a></li>
                <li><a href="<?php echo esc_url( home_url( '/studio/' ) ); ?>">Studio</a></li>
                <li>
              <?php
                $args = array(
                  'numberposts' => '1',
                  'post_status' => 'publish'
                );
                $recent_posts = wp_get_recent_posts( $args );
                foreach( $recent_posts as $recent ) {
                  echo '<a href="' . get_permalink($recent["ID"]) . '">Marm Thinks</a>';
                } ?>
            </li>
                <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>">Work</a></li>
              </ul>

              <?php include(locate_template('template-parts/content-contact.php')); ?>
            </nav>
          </div>
        </div>
      </header>
