<?php
/**
 * Template Name: Contact
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
    <div id="client-form">    
      <div class="form-general container">
        <h2><?php echo $gi_heading ?></h2>
        <div class="form-grid-two">
          <div class="input-row <?php if ($gi_inputs['input_one']['mandatory']) { ?>form-manditory <?php } ?>">
            <label for="project-name-wp"><?php echo $gi_inputs['input_one']['input_label'] ?></label>
            <input type="text" id="project-name-wp" placeholder="<?php echo $gi_inputs['input_one']['input_placeholder'] ?>">
          </div>
          <div class="input-row <?php if ($gi_inputs['input_two']['mandatory']) { ?>form-manditory <?php } ?>">
            <label for="company-name-wp"><?php echo $gi_inputs['input_two']['input_label'] ?></label>
            <input type="text" id="company-name-wp" placeholder="<?php echo $gi_inputs['input_two']['input_placeholder'] ?>">
          </div>
        </div>
        <div class="form-grid-three">
          <div class="input-row <?php if ($gi_inputs['input_three']['mandatory']) { ?>form-manditory <?php } ?>">
            <label for="contact-name-wp"><?php echo $gi_inputs['input_three']['input_label'] ?></label>
            <input type="text" id="contact-name-wp" placeholder="<?php echo $gi_inputs['input_three']['input_placeholder'] ?>">
          </div>
          <div class="input-row <?php if ($gi_inputs['input_four']['mandatory']) { ?>form-manditory form-manditory-email <?php } ?>" >
            <label for="contact-email-wp"><?php echo $gi_inputs['input_four']['input_label'] ?></label>
            <input type="text" id="contact-email-wp"  placeholder="<?php echo $gi_inputs['input_four']['input_placeholder'] ?>">
          </div>
          <div class="input-row form-manditory">
              <label for="product-name-wp">Contact Phone Number</label>
              <input type="text" id="contact-phone-number-wp" placeholder="Telephone Number">
            </div>  
        </div>
        <div class="form-grid-three">          
          <div class="input-row <?php if ($gi_inputs['input_five']['mandatory']) { ?>form-manditory <?php } ?>">
            <label for="andi-number-wp"><?php echo $gi_inputs['input_five']['input_label'] ?></label>
            <input type="text" id="andi-number-wp" placeholder="<?php echo $gi_inputs['input_five']['input_placeholder'] ?>">
          </div>
          <div class="input-row <?php if ($gi_inputs['input_six']['mandatory']) { ?>form-manditory <?php } ?>">
            <label for="product-name-wp"><?php echo $gi_inputs['input_six']['input_label'] ?></label>
            <input type="text" id="product-name-wp" placeholder="<?php echo $gi_inputs['input_six']['input_placeholder'] ?>">
          </div>
          <div class="notice-wrap">     
   
            <div class="notice">
              <div class="notice__left">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                <g id="Group_427" data-name="Group 427" transform="translate(-999.004 -1444.248)">
                  <circle id="Ellipse_28" data-name="Ellipse 28" cx="15" cy="15" r="15" transform="translate(999.004 1444.248)" fill="#f24f4f"/>
                  <g id="Group_427-2" data-name="Group 427" transform="translate(1012.49 1449.781)">
                    <path id="Path_43" data-name="Path 43" d="M1022.982,1469.8h3.029v3.219h-3.029Zm.054-15.716h2.922v6.3l-.352,7.277h-2.218l-.352-7.277Z" transform="translate(-1022.982 -1454.085)" fill="#fff"/>
                  </g>
                </g>
              </svg>
              </div>
              <div class="notice__right">
                <p><?php echo $gi_notice['notice_title'] ?></p>
                <div class="p-light">
                  <?php echo $gi_notice['notice_text'] ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-grid-three js-project-added">    

          <div class="input-row">
            <label for="andi-number-two-wp"><?php echo $gi_inputs['input_five']['input_label'] ?></label>
            <input type="text" id="andi-number-two-wp" placeholder="<?php echo $gi_inputs['input_five']['input_placeholder'] ?>">
          </div>

          <div class="input-row">
            <label for="product-name-two-wp"><?php echo $gi_inputs['input_six']['input_label'] ?></label>
            <input type="text" id="product-name-two-wp" placeholder="<?php echo $gi_inputs['input_six']['input_placeholder'] ?>">
          </div>
        </div>
        <div class="form-grid-three js-project-added">          
          <div class="input-row">
            <label for="andi-number-two-wp"><?php echo $gi_inputs['input_five']['input_label'] ?></label>
            <input type="text" id="andi-number-three-wp" placeholder="<?php echo $gi_inputs['input_five']['input_placeholder'] ?>">
          </div>
          <div class="input-row">
            <label for="product-name-two-wp"><?php echo $gi_inputs['input_six']['input_label'] ?></label>
            <input type="text" id="product-name-three-wp" placeholder="<?php echo $gi_inputs['input_six']['input_placeholder'] ?>">
          </div>
        </div>
        <div class="form-grid-three js-project-added">          
          <div class="input-row">
            <label for="andi-number-two-wp"><?php echo $gi_inputs['input_five']['input_label'] ?></label>
            <input type="text" id="andi-number-four-wp" placeholder="<?php echo $gi_inputs['input_five']['input_placeholder'] ?>">
          </div>
          <div class="input-row">
            <label for="product-name-two-wp"><?php echo $gi_inputs['input_six']['input_label'] ?></label>
            <input type="text" id="product-name-four-wp" placeholder="<?php echo $gi_inputs['input_six']['input_placeholder'] ?>">
          </div>
        </div>
        <div class="form-grid-three js-project-added">          
          <div class="input-row">
            <label for="andi-number-two-wp"><?php echo $gi_inputs['input_five']['input_label'] ?></label>
            <input type="text" id="andi-number-five-wp" placeholder="<?php echo $gi_inputs['input_five']['input_placeholder'] ?>">
          </div>
          <div class="input-row">
            <label for="product-name-two-wp"><?php echo $gi_inputs['input_six']['input_label'] ?></label>
            <input type="text" id="product-name-five-wp" placeholder="<?php echo $gi_inputs['input_six']['input_placeholder'] ?>">
          </div>
        </div>
        <div class="form-grid-three js-project-added">          
          <div class="input-row">
            <label for="andi-number-two-wp"><?php echo $gi_inputs['input_five']['input_label'] ?></label>
            <input type="text" id="andi-number-six-wp" placeholder="<?php echo $gi_inputs['input_five']['input_placeholder'] ?>">
          </div>
          <div class="input-row">
            <label for="product-name-two-wp"><?php echo $gi_inputs['input_six']['input_label'] ?></label>
            <input type="text" id="product-name-six-wp" placeholder="<?php echo $gi_inputs['input_six']['input_placeholder'] ?>">
          </div>
        </div>
        <div class="form-grid-three js-project-added">          
          <div class="input-row">
            <label for="andi-number-two-wp"><?php echo $gi_inputs['input_five']['input_label'] ?></label>
            <input type="text" id="andi-number-seven-wp" placeholder="<?php echo $gi_inputs['input_five']['input_placeholder'] ?>">
          </div>
          <div class="input-row">
            <label for="product-name-two-wp"><?php echo $gi_inputs['input_six']['input_label'] ?></label>
            <input type="text" id="product-name-seven-wp" placeholder="<?php echo $gi_inputs['input_six']['input_placeholder'] ?>">
          </div>
        </div>
        <div class="form-grid-three js-project-added">          
          <div class="input-row">
            <label for="andi-number-two-wp"><?php echo $gi_inputs['input_five']['input_label'] ?></label>
            <input type="text" id="andi-number-eight-wp" placeholder="<?php echo $gi_inputs['input_five']['input_placeholder'] ?>">
          </div>
          <div class="input-row">
            <label for="product-name-two-wp"><?php echo $gi_inputs['input_six']['input_label'] ?></label>
            <input type="text" id="product-name-eight-wp" placeholder="<?php echo $gi_inputs['input_six']['input_placeholder'] ?>">
          </div>
        </div>
        <div class="form-grid-three js-project-added">          
          <div class="input-row">
            <label for="andi-number-two-wp"><?php echo $gi_inputs['input_five']['input_label'] ?></label>
            <input type="text" id="andi-number-nine-wp" placeholder="<?php echo $gi_inputs['input_five']['input_placeholder'] ?>">
          </div>
          <div class="input-row">
            <label for="product-name-two-wp"><?php echo $gi_inputs['input_six']['input_label'] ?></label>
            <input type="text" id="product-name-nine-wp" placeholder="<?php echo $gi_inputs['input_six']['input_placeholder'] ?>">
          </div>
        </div>
        <div class="form-grid-three js-project-added">          
          <div class="input-row">
            <label for="andi-number-two-wp"><?php echo $gi_inputs['input_five']['input_label'] ?></label>
            <input type="text" id="andi-number-ten-wp" placeholder="<?php echo $gi_inputs['input_five']['input_placeholder'] ?>">
          </div>
          <div class="input-row">
            <label for="product-name-two-wp"><?php echo $gi_inputs['input_six']['input_label'] ?></label>
            <input type="text" id="product-name-ten-wp" placeholder="<?php echo $gi_inputs['input_six']['input_placeholder'] ?>">
          </div>
        </div>
        <div class="form-general__add-remove-btns">
        <p class="add-project">+ Add product</p>
        <p class="remove-project">Remove</p>
        </div>

      </div>
      <div class="form-cutterguides container">
        <h2><?php echo $cg_heading ?>Cutterguides</h2>
        <div class="form-grid-two">
          <div class="form-cutterguides__left">
            <p><?php echo $cg_file_upload['title'] ?></p>
            <div class="p-light">
              <?php echo $cg_file_upload['copy'] ?>
            </div>
            <?php echo do_shortcode('[contact-form-7 id="1044" html_id="product-uploads" title="Product Upload"]') ?>
   
          </div>
          <div class="form-cutterguides__right">
            <p class="p-light"><?php echo $cutterguide_multiple_choices['instructions'] ?></p>             
            <div class="form-cutterguides__selects checkbox-manditory" id="cutterguide-selects">
              <div class="checkbox-row">
                <label class="checkbox-label">Barcode Area is Flexible
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Barcode Area is Fixed
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Use By Area is Flexible
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Use By Area is Fixed
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>      
            </div>
            <p style="max-width: 100%; font-size: 14px;"><?php echo $cutterguide_multiple_choices['note'] ?></p>
            <div class="notice-wrap">          
              <div class="notice">
                <div class="notice__left">
                  <p><?php echo $cg_notice['notice_title'] ?></p>
                  <div class="p-light">
                   <?php echo $cg_notice['notice_text'] ?>
                  </div>                  
                </div>
                <div class="notice__right">
                  <a href="<?php echo $cg_notice['file_to_download']['url'] ?>" download="<?php echo $cg_notice['file_to_download']['filename'] ?>" target="_blank" >
                    <div class="form-btn ">
                      <div class="form-btn__inner">
                        <p>Download File</p>                      
                          <svg  class="reveal-form reveal"  xmlns="http://www.w3.org/2000/svg" width="16.636" height="16.636" viewBox="0 0 16.636 16.636">
                            <g id="Icon_feather-download" data-name="Icon feather-download" transform="translate(-3.875 -3.875)">
                              <path id="Path_37" data-name="Path 37" d="M19.886,22.5v3.419a1.71,1.71,0,0,1-1.71,1.71H6.21a1.71,1.71,0,0,1-1.71-1.71V22.5" transform="translate(0 -7.743)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.25"/>
                              <path id="Path_38" data-name="Path 38" d="M10.5,15l4.274,4.274L19.048,15" transform="translate(-2.581 -4.517)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.25"/>
                              <path id="Path_39" data-name="Path 39" d="M18,14.757V4.5" transform="translate(-5.807)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.25"/>
                            </g>
                          </svg>                     
                      </div>
                    </div>
                  </a>  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-print container">
        <h2> <?php echo $ps_heading ?></h2>
        <div class="notice-wrap">          
          <div class="notice">
            <div class="notice__left">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
              <g id="Group_427" data-name="Group 427" transform="translate(-999.004 -1444.248)">
                <circle id="Ellipse_28" data-name="Ellipse 28" cx="15" cy="15" r="15" transform="translate(999.004 1444.248)" fill="#f24f4f"/>
                <g id="Group_427-2" data-name="Group 427" transform="translate(1012.49 1449.781)">
                  <path id="Path_43" data-name="Path 43" d="M1022.982,1469.8h3.029v3.219h-3.029Zm.054-15.716h2.922v6.3l-.352,7.277h-2.218l-.352-7.277Z" transform="translate(-1022.982 -1454.085)" fill="#fff"/>
                </g>
              </g>
            </svg>            
            </div>
            <div class="notice__right">
              <p><?php echo $ps_notice['notice_title'] ?></p>            
            </div>
          </div>
        </div>
        <div class="form-grid-three">          
          <div class="form-print__row">
            <p><?php echo $ps_inputs['print_process_label'] ?></p>
            <p style="margin-bottom: 2px" class="p-light"> <?php echo $ps_inputs['print_process_instructions'] ?></p>
            <div class="form-cutterguides__selects checkbox-manditory" id="print-process-selects">
              <div class="checkbox-row">
                <label class="checkbox-label">Digital
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Lithographic
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Roto Gravure
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Flexographic
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Screen
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Other
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <p><?php echo $ps_inputs['print_medium_label'] ?></p>
            <div class="input-row">
              <textarea id="print-medium-textarea" placeholder="<?php echo $ps_inputs['print_medium_placeholder'] ?>"></textarea>
            </div>
            <p><?php echo $ps_inputs['select_max_print_station_label'] ?></p>
            <div class="custom-drop-down" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/drop-down-arrow.png');">
              <select id="max-print-station" name="cars">
              <option selected="true" disabled="disabled">- Select Print Stations -</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
              </select>
            </div>
            <p class="p-light"><?php echo $ps_inputs['select_max_print_station_extra_info'] ?> <br> </p>
            <div class="input-row">
              <textarea id="res-print-stations" placeholder="<?php echo $ps_inputs['select_max_print_station_extra_info_placeholder'] ?>Name"></textarea>
            </div>
          </div>
          <div class="form-print__row">
            <p><?php echo $ps_inputs['special_board_label'] ?></p>
            <p style="margin-bottom: 2px" class="p-light"><?php echo $ps_inputs['special_board_instructions'] ?></p>
            <div class="form-cutterguides__selects form-cutterguides__selects--narrow exculsive-check checkbox-manditory" id="colured-mediums-selects">
              <div class="checkbox-row">
                <label class="checkbox-label">Yes
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">No
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <p class="p-light"><?php echo $ps_inputs['special_board_substrate'] ?></p>
            <div class="input-row">
              <textarea id="coloured-medium-details" placeholder="<?php echo $ps_inputs['special_board_placeholder'] ?>"></textarea>
            </div>
            <p style="margin-bottom: 5px"><?php echo $ps_inputs['varnish_type_label'] ?></p>
            <div class="form-cutterguides__selects checkbox-manditory" id="varnish-type-selects">
              <div class="checkbox-row">
                <label class="checkbox-label">Matte Varnish
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Gloss Varnish
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Matte Lamination
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Gloss Lamination
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Tactile
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">Soft Touch
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <p class="p-light"><?php echo $ps_inputs['varnish_type_instructions'] ?></p>
            <div class="input-row">
              <textarea style="height: 39px" id="varnish-details" placeholder="<?php echo $ps_inputs['varnish_type_placeholder'] ?>"></textarea>
            </div>
            <p><?php echo $ps_inputs['white_print_label'] ?></p>
            <p style="margin-bottom: 2px" class="p-light"><?php echo $ps_inputs['white_print_instructions'] ?></p>
            <div class="form-cutterguides__selects form-cutterguides__selects--narrow exculsive-check checkbox-manditory" id="white-print-selects">
              <div class="checkbox-row">
                <label class="checkbox-label">Yes
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">No
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
          </div>
          <div class="form-print__row">
            <p style="margin-bottom: 2px">Spot Varnish?</p>
            <div class="form-cutterguides__selects form-cutterguides__selects--narrow exculsive-check checkbox-manditory" id="spot-varnish-selects">
              <div class="checkbox-row">
                <label class="checkbox-label">Yes
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">No
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <p style="margin-bottom: 2px">Emboss / Deboss?</p>
            <div class="form-cutterguides__selects form-cutterguides__selects--narrow exculsive-check checkbox-manditory" id="emboss-selects">
              <div class="checkbox-row">
                <label class="checkbox-label">Yes
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">No
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <p style="margin-bottom: 2px"><?php echo $ps_inputs['hot_foil_label'] ?></p>
            <div class="form-cutterguides__selects form-cutterguides__selects--narrow exculsive-check checkbox-manditory" id="hot-foil-selects">
              <div class="checkbox-row">
                <label class="checkbox-label">Yes
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="checkbox-row">
                <label class="checkbox-label">No
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <p class="p-light"><?php echo $ps_inputs['hot_foil_instructions'] ?></p>
            <div class="input-row">
              <textarea id="brand-details" placeholder="<?php echo $ps_inputs['hot_foil_placeholder'] ?>"></textarea>
            </div>
            <p><?php echo $ps_inputs['additional_information_label'] ?></p>
            <p class="p-light"><?php echo $ps_inputs['additional_information_instructions'] ?></p>
            <div class="input-row">
              <textarea id="additional-details" placeholder="<?php echo $ps_inputs['additional_information_placeholder'] ?>"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="form-samples container">
        <h2><?php echo $s_heading ?></h2>
        <div class="form-grid-three">   
          <div class="form-samples__row">
            <p><?php echo $file_upload_heading ?></p>
            <div class="p-light">
              <?php echo $file_upload_text ?>
            </div>           
            <?php echo do_shortcode('[contact-form-7 id="1045" html_id="sample-uploads" title="Product Upload_copy"]') ?>
          </div>
          <div class="form-samples__row">
            <p><?php echo $physical_sample_requirements_heading ?></p>
            <?php echo $physical_sample_requirements_copy ?>
          </div>
          <div class="form-samples__row">
            <?php echo $delivery_address_copy ?>
            <p  style="padding-top: 20px; margin-bottom: 12px;"><?php echo $tracking_reference_label ?></p>
            <div class="input-row form-manditory">
              <input type="text" id="tracking-number-wp" placeholder="<?php echo $tracking_reference_placeholder ?>">
            </div>
            <p style="font-size: 14px; margin-top: 59px;"><?php echo $tracking_reference_note ?></p>
          </div>
        </div> 
      </div>
      <div class="form-next-steps container">
        <h2><?php echo $ns_heading_copy ?></h2>
        <div class="form-grid-three">
          <div class="form-next-steps__row">
            <div class="form-next-steps__header">
            <p style="margin-bottom: 45px;"><?php echo $pre_artwork_meeting_header ?></p>
              <svg xmlns="http://www.w3.org/2000/svg" width="70.207" height="23.358" viewBox="0 0 70.207 23.358">
                <g id="Group_427" data-name="Group 427" transform="translate(-922.37 -142.385)">
                  <path id="Path_36" data-name="Path 36" d="M3465,73.738l11.326,11.326L3465,96.39" transform="translate(-2484.457 69)" fill="none" stroke="#131413" stroke-width="1"/>
                  <line id="Line_10" data-name="Line 10" x1="69.499" transform="translate(922.37 154.059)" fill="none" stroke="#131413" stroke-width="1"/>
                </g>
              </svg>
            </div>
            <?php echo $pre_artwork_copy ?>
            <div class="notice-wrap">          
            <div class="notice">
              <div class="notice__left">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                <g id="Group_427" data-name="Group 427" transform="translate(-999.004 -1444.248)">
                  <circle id="Ellipse_28" data-name="Ellipse 28" cx="15" cy="15" r="15" transform="translate(999.004 1444.248)" fill="#f24f4f"/>
                  <g id="Group_427-2" data-name="Group 427" transform="translate(1012.49 1449.781)">
                    <path id="Path_43" data-name="Path 43" d="M1022.982,1469.8h3.029v3.219h-3.029Zm.054-15.716h2.922v6.3l-.352,7.277h-2.218l-.352-7.277Z" transform="translate(-1022.982 -1454.085)" fill="#fff"/>
                  </g>
                </g>
              </svg>
                <p><?php echo $ns_notice['notice_title'] ?></p>
              </div>
              <div class="notice__right">
                <?php echo $ns_notice['notice_copy'] ?>
              </div>
            </div>
          </div>
          </div>
          <div class="form-next-steps__row">
          <div class="form-next-steps__header">
            <p style="margin-bottom: 45px;"><?php echo $artwork_process_header ?></p>
              <svg xmlns="http://www.w3.org/2000/svg" width="70.207" height="23.358" viewBox="0 0 70.207 23.358">
                <g id="Group_427" data-name="Group 427" transform="translate(-922.37 -142.385)">
                  <path id="Path_36" data-name="Path 36" d="M3465,73.738l11.326,11.326L3465,96.39" transform="translate(-2484.457 69)" fill="none" stroke="#131413" stroke-width="1"/>
                  <line id="Line_10" data-name="Line 10" x1="69.499" transform="translate(922.37 154.059)" fill="none" stroke="#131413" stroke-width="1"/>
                </g>
              </svg>
            </div>           
            <?php echo $artwork_process_copy_above_btn ?>
            <a href="<?php echo $next_steps_file_download['url'] ?>" download="<?php echo $next_steps_file_download['filename'] ?>">
            <div class="form-btn">
              <div class="form-btn__inner">
                <p>Download File</p>
                <svg class="reveal-form reveal"  xmlns="http://www.w3.org/2000/svg" width="16.636" height="16.636" viewBox="0 0 16.636 16.636">
                  <g id="Icon_feather-download" data-name="Icon feather-download" transform="translate(-3.875 -3.875)">
                    <path id="Path_37" data-name="Path 37" d="M19.886,22.5v3.419a1.71,1.71,0,0,1-1.71,1.71H6.21a1.71,1.71,0,0,1-1.71-1.71V22.5" transform="translate(0 -7.743)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.25"/>
                    <path id="Path_38" data-name="Path 38" d="M10.5,15l4.274,4.274L19.048,15" transform="translate(-2.581 -4.517)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.25"/>
                    <path id="Path_39" data-name="Path 39" d="M18,14.757V4.5" transform="translate(-5.807)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.25"/>
                  </g>
                </svg>                      
              </div>
            </div>
          </a>
            <?php echo $artwork_process_copy_bellow_btn ?>
            <div class="form-btn submit-btn" style="display: flex; justify-content: center; margin-top: 150px;">
              <div class="form-btn__inner js-form-submit wpcf7-submit">
                <p>SUBMIT FORM</p>                    
              </div>
            </div>
          </div>
          <div class="form-next-steps__row">
              <p style="margin-bottom: 45px;">GMG Process</p>
            <?php echo $gmg_process_copy ?>
            <p style="font-size: 14px"><?php echo $gmg_process_form_header ?></p>
            <div class="input-row <?php if ($ns_inputs['one_mandatory']) { ?>form-manditory <?php } ?>">
              <input type="text" id="send-sample-name" placeholder="<?php echo $ns_inputs['input_one_placeholder'] ?>">
            </div>
            <div class="input-row <?php if ($ns_inputs['two_mandatory']) { ?>form-manditory <?php } ?>">
              <input type="text" id="send-sample-company" placeholder="<?php echo $ns_inputs['input_two_placeholder'] ?>">
            </div>
            <div class="input-row <?php if ($ns_inputs['three_mandatory']) { ?>form-manditory <?php } ?>">
              <input type="text" id="send-sample-address" placeholder="<?php echo $ns_inputs['input_three_placeholder'] ?>">
            </div>
            <div class="input-row <?php if ($ns_inputs['four_mandatory']) { ?>form-manditory <?php } ?>">
              <input type="text" id="send-sample-telephone" placeholder="<?php echo $ns_inputs['input_four_placeholder'] ?>">
            </div>
            <div class="checkbox-manditory">
              <div class="checkbox-row">
                <label class="checkbox-label">I confirm I have read and understood the Next Steps.
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
          </div>
        </div> 
      </div>
      <?php echo do_shortcode('[contact-form-7 id="1037" html_id="general-form" title="General Form"]') ?>
  </div>




  <div class="form-sucsess">
    <div class="form-sucsess__inner">
      <h1>We’ve got it!</h1>
      <p>Thank you for submitting the Supplier Submission Form. A member of the Marmalade Team will be in touch shortly if any additional information is required.</p>
    </div>
  </div>
</seciton>




<?php get_footer(); ?>





