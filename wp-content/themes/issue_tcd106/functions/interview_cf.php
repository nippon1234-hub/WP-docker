<?php
function interview_meta_box() {
  $options = get_design_plus_option();
  $interview_label = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Conversation', 'tcd-issue' );
  add_meta_box(
    'interview_meta_box',//ID of meta box
    sprintf(__('%s information', 'tcd-issue'), $interview_label),//label
    'show_interview_meta_box',//callback function
    'interview',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'interview_meta_box', 998);

function show_interview_meta_box() {
  global $post;
  $options =  get_design_plus_option();

  $interview_title = get_post_meta($post->ID, 'interview_title', true);
  $interview_sub_title = get_post_meta($post->ID, 'interview_sub_title', true);

  echo '<input type="hidden" name="interview_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>
<div class="tcd_custom_fields">

 <div class="tcd_cf_content tab_parent">

  <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-issue');  ?></h4>

  <div class="cb_image">
   <img src="<?php bloginfo('template_url'); ?>/admin/img/image/interview_main3.jpg" width="" height="" />
  </div>

  <ul class="option_list">
   <li class="cf">
    <span class="label"><span class="num">1</span><?php _e('Title', 'tcd-issue'); ?></span>
    <input type="text" class="full_width" name="interview_title" value="<?php echo esc_attr($interview_title); ?>" />
   </li>
   <li class="cf">
    <span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span>
    <input type="text" class="full_width" name="interview_sub_title" value="<?php echo esc_attr($interview_sub_title); ?>" />
   </li>
  </ul>

  <h4 class="theme_option_headline2"><?php _e('Speaker', 'tcd-issue');  ?></h4>

  <div class="cb_image">
   <img src="<?php bloginfo('template_url'); ?>/admin/img/image/interview_main2.jpg" width="" height="" />
  </div>

  <div class="theme_option_message2" style="margin-top:20px;">
   <p><?php _e('Speaker will not be displayed when Last name field is blank.<br>You can display Speaker\'s speech bubble content by using corresponding Speaker\'s quicktag.', 'tcd-issue'); ?></p>
  </div>

  <div class="sub_box_tab">
   <?php for($i = 1; $i <= 6; $i++) : ?>
   <div class="tab<?php if($i == 1){ echo ' active'; }; ?>" data-tab="tab<?php echo $i; ?>"><span class="label"><?php printf(__('Speaker%s', 'tcd-issue'), $i); ?></span></div>
   <?php endfor; ?>
  </div>

  <?php
      for($i = 1; $i <= 6; $i++) :
        $interview_first_name = get_post_meta($post->ID, 'interview_first_name' . $i, true);
        $interview_last_name = get_post_meta($post->ID, 'interview_last_name' . $i, true);
        $interview_department = get_post_meta($post->ID, 'interview_department' . $i, true);
        $interview_occupation = get_post_meta($post->ID, 'interview_occupation' . $i, true);
        $interview_position = get_post_meta($post->ID, 'interview_position' . $i, true);
  ?>
  <div class="interview_name sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

   <div class="theme_option_message2" style="margin-top:15px;">
    <p><?php _e('Please copy and paste the short code below where you want to display speaker.', 'tcd-issue'); ?></p>
    <p><?php _e( 'Short code', 'tcd-issue' ); ?> : <input style="background:#fff; width:200px;" onfocus='this.select();' type="text" value="[interviewer<?php echo $i; ?>]<?php _e( 'Enter text here.', 'tcd-issue' ); ?>[/interviewer<?php echo $i; ?>]" readonly></p>
   </div>

   <ul class="option_list">
    <li class="cf two_text_item">
     <span class="label"><span class="num">1</span><?php _e('Name', 'tcd-issue'); ?></span>
     <input placeholder="<?php _e('Last name', 'tcd-issue'); ?>" type="text" name="interview_last_name<?php echo $i; ?>" value="<?php echo esc_attr($interview_last_name); ?>" />
     <input placeholder="<?php _e('First name', 'tcd-issue'); ?>" type="text" name="interview_first_name<?php echo $i; ?>" value="<?php echo esc_attr($interview_first_name); ?>" />
    </li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Information', 'tcd-issue'); ?>1</span><input placeholder="<?php _e('ex:Department', 'tcd-issue'); ?>" class="full_width" type="text" name="interview_department<?php echo $i; ?>" value="<?php echo esc_attr($interview_department); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">3</span><?php _e('Information', 'tcd-issue'); ?>2</span><input placeholder="<?php _e('ex:Occupation', 'tcd-issue'); ?>" class="full_width" type="text" name="interview_occupation<?php echo $i; ?>" value="<?php echo esc_attr($interview_occupation); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">4</span><?php _e('Information', 'tcd-issue'); ?>3</span><input placeholder="<?php _e('ex:Official position', 'tcd-issue'); ?>" class="full_width" type="text" name="interview_position<?php echo $i; ?>" value="<?php echo esc_attr($interview_position); ?>" /></li>
    <li class="cf">
     <span class="label">
      <span class="num">5</span><?php _e('Image', 'tcd-issue'); ?>
      <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '180', '180'); ?></span>
     </span>
     <?php mlcf_media_form('interview_image' . $i, __('Image', 'tcd-issue')); ?>
    </li>
   </ul>

  </div><!-- END .sub_box_tab_content -->
  <?php endfor; ?>

 </div><!-- END .content -->


</div><!-- END #tcd_custom_fields -->

<?php
}

function save_interview_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['interview_meta_box_nonce']) || !wp_verify_nonce($_POST['interview_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'interview_title','interview_sub_title',
    'interview_first_name1','interview_last_name1','interview_department1','interview_occupation1','interview_position1','interview_image1',
    'interview_first_name2','interview_last_name2','interview_department2','interview_occupation2','interview_position2','interview_image2',
    'interview_first_name3','interview_last_name3','interview_department3','interview_occupation3','interview_position3','interview_image3',
    'interview_first_name4','interview_last_name4','interview_department4','interview_occupation4','interview_position4','interview_image4',
    'interview_first_name5','interview_last_name5','interview_department5','interview_occupation5','interview_position5','interview_image5',
    'interview_first_name6','interview_last_name6','interview_department6','interview_occupation6','interview_position6','interview_image6',
  );
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

  // repeater save or delete
  $cf_keys = array('interview_data_list');
  foreach ( $cf_keys as $cf_key ) {
    $old = get_post_meta( $post_id, $cf_key, true );

    if ( isset( $_POST[$cf_key] ) && is_array( $_POST[$cf_key] ) ) {
      $new = array_values( $_POST[$cf_key] );
    } else {
      $new = false;
    }

    if ( $new && $new != $old ) {
      update_post_meta( $post_id, $cf_key, $new );
    } elseif ( ! $new && $old ) {
      delete_post_meta( $post_id, $cf_key, $old );
    }
  }

}
add_action('save_post', 'save_interview_meta_box');


