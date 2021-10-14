<?php
$image = $template_args['field'];
$mobile = $template_args['mobile'];
$class = $template_args['class'];
$sizes = $template_args['sizes'];
$data_src = $template_args['data-src'];
$ID = $template_args['ID'];
$data_url = $image ? $image['url'] : get_the_post_thumbnail_url( $ID, 'full' );

if($image) {
  $medium = $image['sizes']['medium'];
  $srcset = wp_get_attachment_image_srcset( $image['ID'], 'medium' );
  $alt = $image['alt'];
} elseif($ID) {
  $img_id = get_post_thumbnail_id( $ID );
  $medium = wp_get_attachment_image_url( $img_id, 'medium' );
  $srcset = wp_get_attachment_image_srcset( $img_id, 'medium' );
  $alt = get_post_meta($img_id, '_wp_attachment_image_alt', TRUE);
}

if(!$srcset) $srcset = $medium;
if($mobile) {
  $medium_mob = $mobile['sizes']['medium'];
  $srcset_mob = wp_get_attachment_image_srcset( $mobile['ID'], 'medium' );
  if(!$srcset_mob) $srcset_mob = $medium_mob;
?>
<picture <?php if($data_src) echo 'data-src="' . $data_url . '"'; ?>>
  <source srcset="<?php echo $srcset; ?>" sizes="<?php echo $sizes; ?>" media="(min-width: 768px)">
  <img
    class="<?php echo $class; ?>"
    src="<?php echo $medium; ?>"
    srcset="<?php echo $srcset_mob; ?>"
    sizes="<?php echo $sizes; ?>"
    alt="<?php echo $alt; ?>"
    loading="lazy">
</picture>
<?php } else {

$filetype = wp_check_filetype($data_url);
if ($filetype['ext'] == 'gif') {
?>
  <img
    <?php if($data_src) echo 'data-src="' . $data_url . '"'; ?>
    class="<?php echo $class; ?>"
    src="<?php echo $data_url; ?>"
    alt="<?php echo $alt; ?>"
    loading="lazy">
<?php } else { ?>
 <img
  <?php if($data_src) echo 'data-src="' . $data_url . '"'; ?>
  class="<?php echo $class; ?>"
  src="<?php echo $medium; ?>"
  srcset="<?php echo $srcset; ?>"
  sizes="<?php echo $sizes; ?>"
  alt="<?php echo $alt; ?>"
  loading="lazy">
<?php }
}?>
