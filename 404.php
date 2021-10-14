<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package marmalade-theme
 */

get_header(); ?>

<main data-barba="container" data-barba-namespace="page-404">
  <section class="project">
    <header class="project__header">
      <h1 class="heading--md reveal">404</h1>
      <h2 class="medium--upper reveal">Somethign went wrong</h2>
      <a href="<?php echo home_url( '/' ) ?>">Go back</a>
    </header>
  </section>

<?php get_footer(); ?>
