<?php
/**
 * Template Name: Studio
 *
 */

get_header(); ?>

<main data-barba="container" data-barba-namespace="studio">
  <section class="hero hero--studio">
    <?php $hero = get_field('hero'); ?>
    <div class="hero__text-wrap reveal">
      <?php if ( !empty($hero['word_pairs']) ): ?>
      <h1>
        <?php foreach ( $hero['word_pairs'] as $pair ): ?>
        <span class="heading--lg ">
          <?php echo $pair['word_1']; ?>
          <svg width="26" height="15">
            <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow--right"></use>
          </svg>
          <?php echo $pair['word_2']; ?>
        </span>
      <?php endforeach; ?>
      </h1>
    <?php endif; ?>
      <p>
        <?php echo $hero['description']; ?>
      </p>
    </div>
    <button data-anchor="intro" class="scroll-btn">
      At a glance
      <svg width="20" height="10">
        <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow"></use>
      </svg>
    </button>
  </section>

  <div class="studio">
    <div class="studio__intro" id="intro">
      <div class="container reveal">
        <?php the_field('intro'); ?>
      </div>
    </div>
    <?php $section = "studio"; ?>
    <?php include(locate_template('template-parts/content-two-col.php')); ?>
  </div>

<?php $specialty = get_field('specialty');
if ( !empty($specialty) ):
  $count = 1;
  $len = count($specialty); ?>
  <div class="specialty" id="specialty">
    <?php foreach ( $specialty as $item ):
      if ( $item['bg_colour'] == 'green'){
        $colour = '#489f93';
      } elseif ( $item['bg_colour'] == 'red' ) {
        $colour = '#f44545';
      } elseif ( $item['bg_colour'] == 'black' ) {
        $colour = '#131413';
      }
      ?>
    <section class="specialty__block" style="background-color: <?php echo $colour; ?>">
      <div class="specialty__text-wrap">
        <span class="medium--upper"><?php echo $item['title']; ?></span>
        <h3 class="heading--md">
          <?php echo $item['subtitle']; ?>
        </h3>
      </div>
      <svg
        width="230"
        height="230"
        class="specialty__logo specialty__logo--identity"
        fill="#fff"
      >
        <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-<?php echo $item['shape']; ?>"></use>
      </svg>

      <?php if ( $count == $len ): ?>
      <button data-anchor="clients" class="scroll-btn scroll-btn--no-arrow">
        Who we’ve worked with
        <svg width="20" height="10">
          <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow"></use>
        </svg>
      </button>
      <?php endif; $count ++; ?>
    </section>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

  <section class="studio studio--clients" id="clients">
    <?php $section = "clients"; ?>
    <?php include(locate_template('template-parts/content-two-col.php')); ?>
  </section>

  <?php $quotes = get_field('testimonials');
  if ( !empty($quotes) ): ?>
  <div class="testimonials" id="testimonials">
    <div class="testimonials__carousel carousel reveal">
      <?php foreach ( $quotes as $item ): ?>
      <div class="testimonials__item">
        <blockquote>
          “<?php echo $item['quote']; ?>”
          <footer>
            <cite>
              <span><?php echo $item['author']; ?></span>
              <span><?php echo $item['company']; ?></span>
            </cite>
          </footer>
        </blockquote>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="arrows"></div>
  </div>
<?php endif; ?>


<?php get_footer(); ?>
