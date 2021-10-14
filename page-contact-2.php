<?php
/**
 * Template Name: Contact Two
 *
 */

get_header(); ?>


<!-- To change the checkbox options - change them here and change them in the Contact Form 7 plugin 
(General Fom) they have to match or the dummy form will not send them, copy and paste each option in 
to the CF7 form checkbox field, keep id and class the same-->


<?php
  $heading_title = get_field('heading_title');
  $heading_subtitle = get_field('heading_subtitle');
  $border_image = get_field('border_image');
  $gi_heading = get_field('gi_heading');
  $gi_inputs = get_field('gi_inputs');
  $gi_notice = get_field('gi_notice');

  $cg_heading = get_field('cg_heading');
  $cg_file_upload = get_field('cg_file_upload');
  $cutterguide_multiple_choices = get_field('cutterguide_multiple_choices');
  $cg_notice = get_field('cg_notice');

  $ps_heading = get_field('ps_heading');
  $ps_notice = get_field('ps_notice');
  $ps_inputs = get_field('ps_inputs');

  $s_heading = get_field('s_heading');
  $file_upload_heading = get_field('file_upload_heading');
  $file_upload_text = get_field('file_upload_text');
  $physical_sample_requirements_heading = get_field('physical_sample_requirements_heading');
  $physical_sample_requirements_copy = get_field('physical_sample_requirements_copy');
  $delivery_address_copy = get_field('delivery_address_copy');
  $tracking_reference_label = get_field('tracking_reference_label');
  $tracking_reference_placeholder = get_field('tracking_reference_placeholder');
  $tracking_reference_note = get_field('tracking_reference_note');  


  $ns_heading_copy = get_field('ns_heading_copy');
  $pre_artwork_meeting_header = get_field('pre-artwork_meeting_header');
  $pre_artwork_copy = get_field('pre_artwork_copy');
  $artwork_process_header = get_field('artwork_process_header');
  $artwork_process_copy_above_btn = get_field('artwork_process_copy_above_btn');
  $next_steps_file_download = get_field('next_steps_file_download');
  $artwork_process_copy_bellow_btn = get_field('artwork_process_copy_bellow_btn');
  $gmg_process_copy = get_field('gmg_process_copy');
  $gmg_process_form_header = get_field('gmg_process_form_header');
  $ns_inputs = get_field('ns_inputs');
  $ns_notice = get_field('ns_notice');
?>

<style>
  h2:after{
    content: "";
    display: block;
    background-image: url("<?php echo $border_image['url'] ?>");
    width: 100%;
    height: 2px;
    margin-top: 10px;
  }
</style>

<main data-barba="container" data-barba-namespace="work">
  <div class="form-header">
    <p style="display:none" class="js-home-url"><?php echo  get_home_url()?></p>
    <div class="form-header__inner container">
      <h1><?php echo $heading_title ?></h1>
      <div class="form-header__flex">
        <p><?php echo $heading_subtitle ?></p>
        <svg class="reveal-form reveal"  xmlns="http://www.w3.org/2000/svg" width="23.535" height="51.253" viewBox="0 0 23.535 51.253">
          <g id="CURSOR_DOWN_WHITE" transform="translate(165.832 -941.5) rotate(90)">
            <path id="Path_36" data-name="Path 36" d="M3465,73.738l11.326,11.326L3465,96.39" transform="translate(-2484.457 69)" fill="none" stroke="#fff" stroke-width="1.25"/>
            <line id="Line_10" data-name="Line 10" x1="50.369" transform="translate(941.5 154.059)" fill="none" stroke="#fff" stroke-width="1.25"/>
          </g>
        </svg>        
      </div>
    </div>
  </div>



  <seciton class="form-wrap">
    <?php echo do_shortcode('[contact-form-7 id="1037" html_id="general-form" title="General Form"]') ?>
</seciton>






<?php get_footer(); ?>





