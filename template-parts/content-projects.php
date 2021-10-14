<!-- Category X projects -->
<?php
 $parallax_speed = array('15%', 0, '-20%', '-20%', '-20%', '20%', '-20%', '-40%', '20%');
$count = 0;
?>
<div class="work__grid work__grid--filtered" id="<?php echo $cat_string; ?>">
  <?php foreach ( $category as $cur_id ):
    $parallax_no = $parallax_speed[$count%9];
    $filter = get_field('displacement', $cur_id);
    $sizes = ['50vw', '33vw', '32vw', '65vw', '50vw', '32vw', '50vw', '32vw', '32vw'];
    $size = $count <= 9 ? $sizes[$count] : $sizes[$count - 9]
    ?>
  <div class="work__item js-parallax" data-parallax="<?php echo $parallax_no; ?>" >
    <div class="work__inner">

    <a
    href="<?php echo get_the_permalink($cur_id); ?>"
    class="work__img js-image-loaded is-loading"
    >
      <?php _get_template_part('template-parts/_resp-img', [
        'ID' => $cur_id,
        'sizes' => '(max-width: 767px) 100vw, ' . $size,
        'data-src' => true
      ]); ?>
      <?php if($filter) { ?>
        <canvas class="displacement"></canvas>
      <?php } ?>
    </a>

      <h2 class="work__title"><?php echo get_the_title($cur_id); ?></h2>
      <div class="work__meta">
        <?php $terms = get_the_terms( $cur_id, 'project_category');
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
  </div>
  <?php $count++; ?>
<?php endforeach; ?>
</div>
