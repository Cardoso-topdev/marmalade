<?php
if ($section == 'studio'){
  $group = get_field('about');
} elseif ($section == 'clients') {
  $group = get_field('clients');
}?>
<div class="studio__two-col">
  <div class="studio__two-inner">
    <?php foreach ( $group['columns'] as $item ): ?>
    <div class="studio__col">
      <?php $col = $item['column'];
      if ( !(empty($col['image'])) ):
        $filter = $col['image_displacement'];
      ?>
          <div
            class="studio__img reveal js-image-loaded is-loading"
          >
          <?php _get_template_part('template-parts/_resp-img', [
            'field' => $col['image'],
            'sizes' => '(max-width: 767px) 100vw, (max-width: 1023px) 35vw',
            'data-src' => true
          ]); ?>
        <?php if($filter) { ?>
            <canvas class="displacement"></canvas>
        <?php } ?>
          </div>
      <?php endif; ?>
      <div class="studio__details reveal">
        <div class="studio__title-wrap">
          <?php if ( !(empty($col['title'])) ): ?>
          <h3><?php echo $col['title']; ?></h3>
          <?php endif; ?>
          <span class="studio__line"></span>
        </div>
        <?php if ( !(empty($col['content'])) ): ?>
        <div class="studio__copy">
          <?php echo $col['content']; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <?php $next = $group['next_section']; ?>
  <button
    data-anchor="<?php echo $next['link_to']; ?>"
    class="scroll-btn scroll-btn--no-arrow"
  >
    <?php echo $next['text']; ?>
    <svg width="20" height="10">
      <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow"></use>
    </svg>
  </button>
</div>
