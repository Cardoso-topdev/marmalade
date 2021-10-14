<div class="contact">
  <div class="contact__address">
    <p>
      <a href="tel:<?php the_field('telephone', 'option'); ?>">
        <?php the_field('telephone', 'option'); ?>
      </a>
    </p>
    <p>
      <?php the_field('address', 'option'); ?>
    </p>
    <a href="<?php the_field('google_maps_link', 'option'); ?>" class="contact__maps">
      <svg width="18" height="25">
        <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-marker"></use>
      </svg>
      Google Maps
    </a>
    <button class="contact__scroll">
      <svg width="20" height="10">
        <use href="<?php echo get_template_directory_uri(); ?>/img/sprite.svg#icon-arrow"></use>
      </svg>
    </button>
  </div>
  <div class="contact__text">
    <?php $emails = get_field('emails', 'option');
    foreach ( $emails as $email ):
    ?>
    <p>
      <?php echo $email['text_description']; ?>
      <a href='mailto:<?php echo $email['email']; ?>'>
        <?php echo $email['email']; ?>
      </a>
    </p>
    <?php endforeach; ?>

    <p class="contact__social">
      <?php $media = get_field('social_media', 'option'); ?>
      You can also find us on
      <span>
        <a href="<?php echo $media['instagram_link']; ?>">
          Instagram
        </a>
        &
        <a href="<?php echo $media['linkedin_link']; ?>">
          LinkedIn
        </a>
      </span>
    </p>
  </div>
</div>
