<?php
function staff_meta_box() {
  $options = get_design_plus_option();
  $staff_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Function', 'tcd-issue' );
  add_meta_box(
    'staff_meta_box',//ID of meta box
    sprintf(__('%s information', 'tcd-issue'), $staff_label),//label
    'show_staff_meta_box',//callback function
    'staff',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'staff_meta_box', 998);

function show_staff_meta_box() {
  global $post;
  $options =  get_design_plus_option();

  $staff_name = get_post_meta($post->ID, 'staff_name', true);
  $staff_job = get_post_meta($post->ID, 'staff_job', true);
  $staff_date = get_post_meta($post->ID, 'staff_date', true);
  $staff_catch = get_post_meta($post->ID, 'staff_catch', true);

  $staff_image_slider = get_post_meta($post->ID, 'staff_image_slider', true);
  $display = 'none';
  $image_ids = explode( ',', $staff_image_slider );

  echo '<input type="hidden" name="staff_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>
<div class="tcd_custom_fields">

 <div class="tcd_cf_content">

  <h3 class="tcd_cf_headline"><?php _e( 'Basic setting', 'tcd-issue' ); ?></h3>

  <div class="cb_image">
   <?php if($options['staff_design_type'] == 'type1'){ ?>
   <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/staff_a_main_cf.jpg" alt="" title="" />
   <?php } else { ?>
   <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/staff_b_main_cf.jpg" alt="" title="" />
   <?php }; ?>
  </div>

  <ul class="option_list">
   <li class="cf">
    <span class="label"><span class="num">1</span><?php _e('Information', 'tcd-issue'); ?>1</span>
    <input type="text" class="full_width" name="staff_name" placeholder="<?php _e('ex:Name of person, product price', 'tcd-issue'); ?>" value="<?php echo esc_attr($staff_name); ?>" />
   </li>
   <li class="cf">
    <span class="label"><span class="num">2</span><?php _e('Information', 'tcd-issue'); ?>2</span>
    <input type="text" class="full_width" name="staff_job" placeholder="<?php _e('ex:Position, Job title, Product type', 'tcd-issue'); ?>" value="<?php echo esc_attr($staff_job); ?>" />
   </li>
   <li class="cf">
    <span class="label"><span class="num">3</span><?php _e('Description', 'tcd-issue'); ?></span>
    <textarea class="full_width" cols="50" rows="2" name="staff_catch" placeholder="<?php _e('Please enter a few words from the staff or a catchphrase for the product', 'tcd-issue'); ?>"><?php echo esc_textarea($staff_catch); ?></textarea>
   </li>
   <li class="cf">
    <span class="label"><span class="num">4</span><?php _e('Supplemental information', 'tcd-issue'); ?></span>
    <input type="text" class="full_width" name="staff_date" value="<?php echo esc_attr($staff_date); ?>" />
   </li>
  </ul>

 </div><!-- END .content -->

 <div class="tcd_cf_content">

  <h3 class="tcd_cf_headline"><?php _e( 'Image slider', 'tcd-issue' ); ?></h3>

  <div class="cb_image">
   <?php if($options['staff_design_type'] == 'type1'){ ?>
   <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/staff_a_main_slider.jpg" alt="" title="" />
   <?php } else { ?>
   <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/staff_b_main_slider.jpg" alt="" title="" />
   <?php }; ?>
  </div>

  <div class="theme_option_message2" style="margin-top:20px;">
   <p><?php _e('Image slider will be display in article page. Featured image will be used for first image.', 'tcd-issue'); ?><br>
   <?php if($options['staff_design_type'] == 'type1'){ ?>
   <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '870', '1200'); ?><br>
   <?php } else { ?>
   <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '1740', '840'); ?><br>
   <?php }; ?>
   <?php _e('You can register multiple image by clicking images in media library.', 'tcd-issue'); ?></p>
  </div>

  <div class="multi-media-uploader staff_gallery_option" style="float:none; width:100%;">
   <ul>
    <?php
         if ( $staff_image_slider && !empty( $image_ids ) ) {
           $display = 'inline-block';
           foreach ( $image_ids as $image_id ) {
             if ( $image_attributes = wp_get_attachment_image_src( $image_id, 'full' ) ) {
    ?>
    <li data-attechment-id="<?php echo $image_id; ?>">
     <div class="image"><img loading="lazy" src="<?php echo $image_attributes[0]; ?>" /></div>
     <span class="delete-img"></span>
    </li>
    <?php
            }
          }
        }
    ?>
   </ul>
   <a id="staff_image_slider" href="#" class="js-multi-media-upload-button button">
    <?php _e( 'Select Image', 'tcd-issue' ); ?>
   </a>
   <input type="hidden" class="attechments-ids staff_image_slider" name="staff_image_slider" value="<?php echo esc_attr( implode( ',', $image_ids ) ); ?>" />
   <a href="#" class="js-multi-media-remove-button button" style="display:<?php echo $display; ?>;">
    <?php _e( 'Delete all images', 'tcd-issue' ); ?>
   </a>
  </div>

 </div><!-- END .content -->

</div><!-- END #tcd_custom_fields -->

<?php
}

function save_staff_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['staff_meta_box_nonce']) || !wp_verify_nonce($_POST['staff_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  $cf_keys = array('staff_image_slider','staff_name','staff_job','staff_catch','staff_date');
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

}
add_action('save_post', 'save_staff_meta_box');


