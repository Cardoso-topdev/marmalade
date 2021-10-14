<?php
/**
 * Template Name: Contact
 *
 */

get_header(); ?>

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
    height: 1px;
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


  <!-- do not delete - provides acfs to cp7 vis JS -->
  <div class="custom-field-values" style="display: none">
    <div data-class="general-notice-title" class="js-acf-field"><?php echo($gi_notice['notice_title']); ?></div>
    <div data-class="general-notice-text" class="js-acf-field"><?php echo($gi_notice['notice_text']); ?></div>
    <div data-class="cutterguides-notice-title" class="js-acf-field"><?php echo($cg_notice['notice_title']); ?></div>
    <div data-class="cutterguides-notice-text" class="js-acf-field"><?php echo($cg_notice['notice_text']); ?></div>

    <div data-class="cutterguides-download-href" class="cutterguides-download-href"><?php echo $cg_notice['file_to_download']['url'] ?></div>
    <div data-class="cutterguides-download-filename" class="cutterguides-download-filename"><?php echo $cg_notice['file_to_download']['filename'] ?></div>

    <div data-class="print-process-mc-title" class="js-acf-field"><?php echo($ps_notice['notice_title'])?></div>
    <div data-class="samples-requirements-title" class="js-acf-field"><?php echo($physical_sample_requirements_heading)?></div>
    <div data-class="samples-requirements-copy" class="js-acf-field"><?php echo($physical_sample_requirements_copy)?></div>
    <div data-class="samples-delivery-copy" class="js-acf-field"><?php echo($delivery_address_copy)?></div>
    <div data-class="next-steps-col-one-copy" class="js-acf-field"><?php echo($pre_artwork_copy)?></div>
    <div data-class="next-steps-col-two-above" class="js-acf-field"><?php echo($artwork_process_copy_above_btn)?></div>
    <div data-class="next-steps-col-two-below" class="js-acf-field"><?php echo($artwork_process_copy_bellow_btn)?></div>
    <div data-class="next-steps-col-three-copy" class="js-acf-field"><?php echo($gmg_process_copy)?></div>

    <div data-class="next-steps-download-href" class="next-steps-download-href"><?php echo $next_steps_file_download['url'] ?></div>
    <div data-class="next-steps-download-filename" class="next-steps-download-filename"><?php echo $next_steps_file_download['filename'] ?></div>  

    <div data-class="next-steps-notice-title" class="js-acf-field"><?php echo($ns_notice['notice_title']); ?></div>
    <div data-class="next-steps-notice-text" class="js-acf-field"><?php echo($ns_notice['notice_copy']); ?></div>  
  </div>  










 
 
 
 
 




  
  
  </div>


</seciton>




<?php get_footer(); ?>





