<?php

/* フォーム用 画像フィールド出力 */
function mlcf_media_form($cf_key, $label) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($label)) $label = $cf_key;

	$media_id = get_post_meta($post->ID, $cf_key, true);
?>
 <div class="image_box cf">
  <div class="cf cf_media_field hide-if-no-js <?php echo esc_attr($cf_key); ?>">
    <input type="hidden" class="cf_media_id" name="<?php echo esc_attr($cf_key); ?>" id="<?php echo esc_attr($cf_key); ?>" value="<?php echo esc_attr($media_id); ?>" />
    <div class="preview_field"><?php if ($media_id) the_mlcf_image($post->ID, $cf_key); ?></div>
    <div class="buttton_area">
     <input type="button" class="cfmf-select-img button" value="<?php _e('Select Image', 'tcd-issue'); ?>" />
     <input type="button" class="cfmf-delete-img button<?php if (!$media_id) echo ' hidden'; ?>" value="<?php _e('Remove Image', 'tcd-issue'); ?>" />
    </div>
  </div>
 </div>
<?php
}




/* 画像フィールドで選択された画像をimgタグで出力 */
function the_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	echo get_mlcf_image($post_id, $cf_key, $image_size);
}

/* 画像フィールドで選択された画像をimgタグで返す */
function get_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_image($media_id, $image_size, $image_size);
	}

	return false;
}

/* 画像フィールドで選択された画像urlを返す */
function get_mlcf_image_url($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		$img = wp_get_attachment_image_src($media_id, $image_size);
		if (!empty($img[0])) {
			return $img[0];
		}
	}

	return false;
}

/* 画像フィールドで選択されたメディアのURLを出力 */
function the_mlcf_media_url($post_id, $cf_key) {
	echo get_mlcf_media_url($post_id, $cf_key);
}

/* 画像フィールドで選択されたメディアのURLを返す */
function get_mlcf_media_url($post_id, $cf_key) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_url($media_id);
	}

	return false;
}


// ヘッダーの設定 -------------------------------------------------------

function page_header_meta_box() {
  add_meta_box(
    'tcd_meta_box1',//ID of meta box
    __('Page setting', 'tcd-issue'),//label
    'show_page_header_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'page_header_meta_box');

function show_page_header_meta_box() {

  global $post, $font_type_options, $content_direction_options;
  $options = get_design_plus_option();

  $header_headline = get_post_meta($post->ID, 'header_headline', true);
  $header_sub_title = get_post_meta($post->ID, 'header_sub_title', true);
  $header_desc = get_post_meta($post->ID, 'header_desc', true);
  $header_desc_mobile = get_post_meta($post->ID, 'header_desc_mobile', true);
  $header_overlay_color = get_post_meta($post->ID, 'header_overlay_color', true) ?  get_post_meta($post->ID, 'header_overlay_color', true) : '#000000';
  $header_overlay_color_opacity = get_post_meta($post->ID, 'header_overlay_color_opacity', true) ?  get_post_meta($post->ID, 'header_overlay_color_opacity', true) : '0.3';
  if($header_overlay_color_opacity == 'zero'){
    $header_overlay_color_opacity = '0';
  }


  // 表示設定
  $hide_page_header = get_post_meta($post->ID, 'hide_page_header', true) ?  get_post_meta($post->ID, 'hide_page_header', true) : 'no';
  $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true) ?  get_post_meta($post->ID, 'hide_sidebar', true) : 'right';
  $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true) ?  get_post_meta($post->ID, 'page_hide_footer', true) : 'no';
  $hide_breadcrumb = get_post_meta($post->ID, 'hide_breadcrumb', true) ?  get_post_meta($post->ID, 'hide_breadcrumb', true) : 'no';
  $hide_global_menu = get_post_meta($post->ID, 'hide_global_menu', true) ?  get_post_meta($post->ID, 'hide_global_menu', true) : 'no';
  $hide_logo = get_post_meta($post->ID, 'hide_logo', true) ?  get_post_meta($post->ID, 'hide_logo', true) : 'no';

  $hide_header_message = get_post_meta($post->ID, 'hide_header_message', true);
  if(empty($hide_header_message)){
    $hide_header_message = 'yes';
  }

  $hide_side_button = get_post_meta($post->ID, 'hide_side_button', true) ?  get_post_meta($post->ID, 'hide_side_button', true) : 'no';

  $page_width = get_post_meta($post->ID, 'page_width', true);
  if(empty($page_width)){
    $page_width = 'normal';
  }

  echo '<input type="hidden" name="page_header_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<?php
     // ブロックエディタ用対策として隠しフィールドを用意　選択されているページテンプレートによってLPページ用入力欄を表示・非表示する
     if ( count( get_page_templates( $post ) ) > 0 && get_option( 'page_for_posts' ) != $post->ID ) :
       $template = ! empty( $post->page_template ) ? $post->page_template : false;
?>
<select name="hidden_page_template" id="hidden_page_template" style="display:none;">
 <option value="">Default Template</option>
 <?php page_template_dropdown( $template, 'page' ); ?>
</select>
<?php endif; ?>
<select name="hidden_parent_page" id="hidden_parent_page" style="display:none;">
 <option value="">No parent page</option>
 <?php
      $pages = get_pages();
      foreach ($pages as $page) {
 ?>
 <option value="<?php echo esc_attr($page->ID); ?>"<?php if($page->post_parent != 0){ echo ' selected="selected"'; }; ?>><?php echo esc_html($page->post_title); ?></option>
 <?php }; ?>
</select>

<div class="tcd_custom_field_wrap">

  <?php // タブページ用の設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac open active" id="tab_page_setting">
   <h3 class="theme_option_headline"><?php _e( 'About tab page', 'tcd-issue' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="cb_image">
     <img src="<?php bloginfo('template_url'); ?>/admin/img/image/tab_page.jpg" width="" height="" />
    </div>

    <div class="theme_option_message2">
     <p><?php _e('In tab page, child pages will be displayed in parent page by tab.<br>The first tab displays the contents of the parent page, and the second and subsequent tabs display the child pages registered to the parent page, in that order.', 'tcd-issue'); ?></p>
    </div>

   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // 基本設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac" id="basic_page_setting">
   <h3 class="theme_option_headline"><?php _e( 'Display setting', 'tcd-issue' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="cb_image lp_template_option">
     <img src="<?php bloginfo('template_url'); ?>/admin/img/image/lp_page.jpg?2.0" width="" height="" />
    </div>

    <div class="theme_option_message2 lp_template_option">
     <p><?php _e('Please set header message from <a href="./wp-admin/admin.php?page=theme_options">theme option page</a>.', 'tcd-issue'); ?></p>
    </div>

    <ul class="option_list">
     <li class="lp_template_option cf">
      <span class="label"><span class="num lp_template_option">1</span><?php _e('Header message', 'tcd-issue');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_header_message_no" name="hide_header_message" value="no"<?php checked( $hide_header_message, 'no' ); ?>>
       <label for="hide_header_message_no"><?php _e('Display', 'tcd-issue');  ?></label>
       <input type="radio" id="hide_header_message_yes" name="hide_header_message" value="yes"<?php checked( $hide_header_message, 'yes' ); ?>>
       <label for="hide_header_message_yes"><?php _e('Hide', 'tcd-issue');  ?></label>
      </div>
     </li>
     <li class="lp_template_option cf">
      <span class="label"><span class="num lp_template_option">2</span><?php _e('Logo', 'tcd-issue');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_logo_no" name="hide_logo" value="no"<?php checked( $hide_logo, 'no' ); ?>>
       <label for="hide_logo_no"><?php _e('Display', 'tcd-issue');  ?></label>
       <input type="radio" id="hide_logo_yes" name="hide_logo" value="yes"<?php checked( $hide_logo, 'yes' ); ?>>
       <label for="hide_logo_yes"><?php _e('Hide', 'tcd-issue');  ?></label>
      </div>
     </li>
     <li class="lp_template_option cf">
      <span class="label"><span class="num lp_template_option">3</span><?php _e('Global menu', 'tcd-issue');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_global_menu_no" name="hide_global_menu" value="no"<?php checked( $hide_global_menu, 'no' ); ?>>
       <label for="hide_global_menu_no"><?php _e('Display', 'tcd-issue');  ?></label>
       <input type="radio" id="hide_global_menu_yes" name="hide_global_menu" value="yes"<?php checked( $hide_global_menu, 'yes' ); ?>>
       <label for="hide_global_menu_yes"><?php _e('Hide', 'tcd-issue');  ?></label>
      </div>
     </li>
     <li class="cf hide_border_option">
      <span class="label"><span class="num lp_template_option">4</span><?php _e('Side button', 'tcd-issue');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_side_button_no" name="hide_side_button" value="no"<?php checked( $hide_side_button, 'no' ); ?>>
       <label for="hide_side_button_no"><?php _e('Display', 'tcd-issue');  ?></label>
       <input type="radio" id="hide_side_button_yes" name="hide_side_button" value="yes"<?php checked( $hide_side_button, 'yes' ); ?>>
       <label for="hide_side_button_yes"><?php _e('Hide', 'tcd-issue');  ?></label>
      </div>
     </li>
     <li class="lp_template_option cf">
      <span class="label"><span class="num lp_template_option">5</span><?php _e('Header', 'tcd-issue');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_page_header_no" name="hide_page_header" value="no"<?php checked( $hide_page_header, 'no' ); ?>>
       <label for="hide_page_header_no"><?php _e('Display', 'tcd-issue');  ?></label>
       <input type="radio" id="hide_page_header_yes" name="hide_page_header" value="yes"<?php checked( $hide_page_header, 'yes' ); ?>>
       <label for="hide_page_header_yes"><?php _e('Hide', 'tcd-issue');  ?></label>
      </div>
     </li>
     <li class="lp_template_option cf">
      <span class="label"><span class="num lp_template_option">6</span><?php _e('Footer', 'tcd-issue');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="page_hide_footer_no" name="page_hide_footer" value="no"<?php checked( $page_hide_footer, 'no' ); ?>>
       <label for="page_hide_footer_no"><?php _e('Display', 'tcd-issue');  ?></label>
       <input type="radio" id="page_hide_footer_yes" name="page_hide_footer" value="yes"<?php checked( $page_hide_footer, 'yes' ); ?>>
       <label for="page_hide_footer_yes"><?php _e('Hide', 'tcd-issue');  ?></label>
      </div>
     </li>
     <li class="normal_template_option cf">
      <span class="label"><?php _e('Breadcrumb link', 'tcd-issue');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_breadcrumb_no" name="hide_breadcrumb" value="no"<?php checked( $hide_breadcrumb, 'no' ); ?>>
       <label for="hide_breadcrumb_no"><?php _e('Display', 'tcd-issue');  ?></label>
       <input type="radio" id="hide_breadcrumb_yes" name="hide_breadcrumb" value="yes"<?php checked( $hide_breadcrumb, 'yes' ); ?>>
       <label for="hide_breadcrumb_yes"><?php _e('Hide', 'tcd-issue');  ?></label>
      </div>
     </li>
     <li class="normal_template_option cf">
      <span class="label"><?php _e('Sidebar', 'tcd-issue');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_sidebar_left" name="hide_sidebar" value="left"<?php checked( $hide_sidebar, 'left' ); ?>>
       <label for="hide_sidebar_left"><?php _e('Left', 'tcd-issue');  ?></label>
       <input type="radio" id="hide_sidebar_right" name="hide_sidebar" value="right"<?php checked( $hide_sidebar, 'right' ); ?>>
       <label for="hide_sidebar_right"><?php _e('Right', 'tcd-issue');  ?></label>
       <input type="radio" id="hide_sidebar_hide" name="hide_sidebar" value="hide"<?php checked( $hide_sidebar, 'hide' ); ?>>
       <label for="hide_sidebar_hide"><?php _e('Hide', 'tcd-issue');  ?></label>
      </div>
     </li>
     <li class="cf lp_template_option">
      <span class="label"><span class="num lp_template_option">7</span><?php _e('Content width', 'tcd-issue');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="page_width_normal" name="page_width" value="normal"<?php checked( $page_width, 'normal' ); ?>>
       <label for="page_width_normal"><?php _e('Normal', 'tcd-issue');  ?></label>
       <input type="radio" id="page_width_wide" name="page_width" value="wide"<?php checked( $page_width, 'wide' ); ?>>
       <label for="page_width_wide"><?php _e('Wide', 'tcd-issue');  ?></label>
      </div>
     </li>
    </ul>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // ページヘッダーの設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac" id="page_header_setting_area">
   <h3 class="theme_option_headline"><?php _e( 'Header', 'tcd-issue' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="cb_image">
     <img class="normal_template_option" src="<?php bloginfo('template_url'); ?>/admin/img/image/page_header.jpg" width="" height="" />
     <img class="lp_template_option" src="<?php bloginfo('template_url'); ?>/admin/img/image/page_lp_header.jpg" width="" height="" />
    </div>

    <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-issue');  ?></h4>
    <div class="theme_option_message2">
     <p><?php _e('Page title will be displayed when headline option is blank.', 'tcd-issue'); ?></p>
    </div>
    <ul class="option_list">
     <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input class="full_width" type="text" name="header_headline" value="<?php echo esc_attr($header_headline); ?>" /></li>
     <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span><input class="full_width" type="text" name="header_sub_title" value="<?php echo esc_attr($header_sub_title); ?>" /></li>
     <li class="cf"><span class="label"><span class="num">3</span><?php _e('Description', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" name="header_desc"><?php echo esc_textarea($header_desc); ?></textarea></li>
     <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-issue'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-issue' ); ?>" class="full_width" cols="50" rows="3" name="header_desc_mobile"><?php echo esc_textarea($header_desc_mobile); ?></textarea></li>
     <li class="cf lp_template_option">
      <span class="label">
       <span class="num">4</span><?php _e('Image', 'tcd-issue'); ?>
       <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '1740', '720'); ?></span>
      </span>
      <?php mlcf_media_form('header_image', __('Image', 'tcd-issue')); ?>
     </li>
     <li class="cf lp_template_option space"><span class="label"><?php _e('Overlay color of image', 'tcd-issue'); ?></span><input type="text" name="header_overlay_color" value="<?php echo esc_attr( $header_overlay_color ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     <li class="cf lp_template_option space">
      <span class="label"><?php _e('Transparency of overlay', 'tcd-issue'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="header_overlay_color_opacity" value="<?php echo esc_attr( $header_overlay_color_opacity ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-issue');  ?><br>
       <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-issue');  ?></p>
      </div>
     </li>
    </ul>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // スクロールコンテンツの設定 --------------------------------------------------- ?>
  <div id="page_scroll_content_option" class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Scroll content', 'tcd-issue' ); ?></h3>
   <div class="theme_option_field_ac_content tab_parent">

    <div class="cb_image">
     <img src="<?php bloginfo('template_url'); ?>/admin/img/image/cb_scroll_content.jpg" width="" height="" />
    </div>

    <div class="theme_option_message2">
     <p><?php _e('Please copy and paste the short code below where you want to display scroll content.', 'tcd-issue'); ?></p>
     <p><?php _e( 'Short code', 'tcd-issue' ); ?> : <input style="background:#fff; width:200px;" onfocus='this.select();' type="text" value="[sc_scroll_content]" readonly></p>
    </div>

    <div class="sub_box_tab">
     <?php for($i = 1; $i <= 3; $i++) : ?>
     <div class="tab<?php if($i == 1){ echo ' active'; }; ?>" data-tab="tab<?php echo $i; ?>"><span class="label"><?php printf(__('Content%s', 'tcd-issue'), $i); ?></span></div>
     <?php endfor; ?>
    </div>

    <?php
        for($i = 1; $i <= 3; $i++) :
          $scroll_content_type = get_post_meta($post->ID, 'scroll_content_type' . $i, true) ?  get_post_meta($post->ID, 'scroll_content_type' . $i, true) : 'type1';
          $scroll_content_headline = get_post_meta($post->ID, 'scroll_content_headline' . $i, true);
          $scroll_content_sub_title = get_post_meta($post->ID, 'scroll_content_sub_title' . $i, true);
          $scroll_content_catch = get_post_meta($post->ID, 'scroll_content_catch' . $i, true);
          $scroll_content_desc = get_post_meta($post->ID, 'scroll_content_desc' . $i, true);
          $scroll_content_desc_mobile = get_post_meta($post->ID, 'scroll_content_desc_mobile' . $i, true);
          $scroll_content_button_label = get_post_meta($post->ID, 'scroll_content_button_label' . $i, true);
          $scroll_content_button_url = get_post_meta($post->ID, 'scroll_content_button_url' . $i, true);
          $scroll_content_button_target = get_post_meta($post->ID, 'scroll_content_button_target' . $i, true);
          $scroll_content_overlay_color = get_post_meta($post->ID, 'scroll_content_overlay_color' . $i, true) ?  get_post_meta($post->ID, 'scroll_content_overlay_color' . $i, true) : '#000000';
          $scroll_content_overlay_opacity = get_post_meta($post->ID, 'scroll_content_overlay_opacity' . $i, true) ?  get_post_meta($post->ID, 'scroll_content_overlay_opacity' . $i, true) : '0.3';
          $scroll_content_bg_type = get_post_meta($post->ID, 'scroll_content_bg_type' . $i, true) ?  get_post_meta($post->ID, 'scroll_content_bg_type' . $i, true) : 'type1';
          $scroll_content_bg_color = get_post_meta($post->ID, 'scroll_content_bg_color' . $i, true) ?  get_post_meta($post->ID, 'scroll_content_bg_color' . $i, true) : '#000000';
    ?>
    <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Content type', 'tcd-issue');  ?></span>
       <div class="option_list_image_radio_button">
        <div class="item">
         <input class="tcd_admin_image_radio_button sc_content_type1" id="sc_content_type1_<?php echo $i; ?>" type="radio" name="scroll_content_type<?php echo $i; ?>" value="type1" <?php checked( $scroll_content_type, 'type1' ); ?>>
         <label for="sc_content_type1_<?php echo $i; ?>">
          <span class="image_wrap"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/cb_scroll_content2.jpg" alt=""></span>
          <span class="title_wrap"><span class="title"><?php _e('TypeA', 'tcd-issue');  ?></span></span>
         </label>
        </div>
        <div class="item">
         <input class="tcd_admin_image_radio_button sc_content_type2" id="sc_content_type2_<?php echo $i; ?>" type="radio" name="scroll_content_type<?php echo $i; ?>" value="type2" <?php checked( $scroll_content_type, 'type2' ); ?>>
         <label for="sc_content_type2_<?php echo $i; ?>">
          <span class="image_wrap"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/cb_scroll_content2_type2.jpg?2.0" alt=""></span>
          <span class="title_wrap"><span class="title"><?php _e('TypeB', 'tcd-issue');  ?></span></span>
         </label>
        </div>
       </div>
      </li>
      <li class="cf sc_content_type1_option"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input type="text" class="tab_label full_width" name="scroll_content_headline<?php echo $i; ?>" value="<?php echo esc_attr($scroll_content_headline); ?>" /></li>
      <li class="cf sc_content_type1_option"><span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span><input type="text" class="full_width" name="scroll_content_sub_title<?php echo $i; ?>" value="<?php echo esc_attr($scroll_content_sub_title); ?>" /></li>
      <li class="cf sc_content_type2_option" style="display:none;">
       <span class="label"><span class="num">1</span><?php _e('Circle image', 'tcd-issue'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '400', '400'); ?></span>
       </span>
       <?php mlcf_media_form('scroll_content_image' . $i, __('Image', 'tcd-issue')); ?>
      </li>
      <li class="cf"><span class="label"><span class="num sc_content_type1_option">3</span><span class="num sc_content_type2_option" style="display:none;">2</span><?php _e('Catchphrase', 'tcd-issue'); ?></span><input class="tab_label full_width" type="text" name="scroll_content_catch<?php echo $i; ?>" value="<?php echo esc_attr($scroll_content_catch); ?>" /></li>
      <li class="cf"><span class="label"><span class="num sc_content_type1_option">4</span><span class="num sc_content_type2_option" style="display:none;">3</span><?php _e('Description', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" name="scroll_content_desc<?php echo $i; ?>"><?php echo esc_textarea($scroll_content_desc); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" name="scroll_content_desc_mobile<?php echo $i; ?>"><?php echo esc_textarea($scroll_content_desc_mobile); ?></textarea></li>
      <li class="cf">
       <span class="label"><span class="num sc_content_type1_option">5</span><span class="num sc_content_type2_option" style="display:none;">4</span><?php _e('Button label', 'tcd-issue'); ?>
        <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-issue');  ?></span>
       </span>
       <input type="text" class="full_width" name="scroll_content_button_label<?php echo $i; ?>" value="<?php echo esc_attr($scroll_content_button_label); ?>" />
      </li>
      <li class="cf space">
       <span class="label"><?php _e('Button URL', 'tcd-issue'); ?></span>
       <div class="admin_link_option">
        <input class="full_width" type="text" name="scroll_content_button_url<?php echo $i; ?>" placeholder="https://example.com/" value="<?php echo esc_attr( $scroll_content_button_url ); ?>">
        <input id="sc_button_target<?php echo $i; ?>" name="scroll_content_button_target<?php echo $i; ?>" type="checkbox" value="1" <?php checked( $scroll_content_button_target, 1 ); ?>>
        <label for="sc_button_target<?php echo $i; ?>">&#xe920;</label>
       </div>
      </li>
      <li class="cf">
       <span class="label"><span class="num sc_content_type1_option">6</span><span class="num sc_content_type2_option" style="display:none;">5</span><?php _e('Background', 'tcd-issue');  ?></span>
       <div class="standard_radio_button">
        <input class="sc_bg_type1" id="sc_bg_type1_<?php echo $i; ?>" type="radio" name="scroll_content_bg_type<?php echo $i; ?>" value="type1" <?php checked( $scroll_content_bg_type, 'type1' ); ?>>
        <label for="sc_bg_type1_<?php echo $i; ?>"><?php _e('Background image', 'tcd-issue'); ?></label>
        <input class="sc_bg_type2" id="sc_bg_type2_<?php echo $i; ?>" type="radio" name="scroll_content_bg_type<?php echo $i; ?>" value="type2" <?php checked( $scroll_content_bg_type, 'type2' ); ?>>
        <label for="sc_bg_type2_<?php echo $i; ?>"><?php _e('Background color', 'tcd-issue'); ?></label>
       </div>
      </li>
      <li class="cf space sc_bg_type1_option">
       <span class="label"><?php _e('Background image', 'tcd-issue'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '1740', '1320'); ?></span>
       </span>
       <?php mlcf_media_form('scroll_content_image2_' . $i, __('Image', 'tcd-issue')); ?>
      </li>
      <li class="cf space sc_bg_type1_option">
       <span class="label"><?php _e('Background image (mobile)', 'tcd-issue'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '750', '1324'); ?></span>
       </span>
       <?php mlcf_media_form('scroll_content_image2_mobile_' . $i, __('Image', 'tcd-issue')); ?>
      </li>
      <li class="cf space sc_bg_type1_option">
       <span class="label"><?php _e('Color of overlay', 'tcd-issue'); ?></span><input type="text" name="scroll_content_overlay_color<?php echo $i; ?>" value="<?php echo esc_attr( $scroll_content_overlay_color ); ?>" data-default-color="#000000" class="c-color-picker">
      </li>
      <li class="cf space sc_bg_type1_option">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-issue'); ?></span><input class="hankaku" style="width:70px;" type="number" step="0.1" min="0" max="1" name="scroll_content_overlay_opacity<?php echo $i; ?>" value="<?php echo esc_attr( $scroll_content_overlay_opacity ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-issue');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-issue');  ?></p>
       </div>
      </li>
      <li class="cf space sc_bg_type2_option" style="display:none;">
       <span class="label"><?php _e('Background color', 'tcd-issue'); ?></span>
       <div class="color_presets">
        <ul class="color_presets_list">
         <?php foreach( TCD_COLOR_PRESET_FOR_LIST as $label => $colors ): ?>
         <li class="js-color-preset-item-for-list color_presets_item" data-color="<?php echo $colors['main']; ?>">
          <div class="color_presets_color">
           <span class="color_presets_color-main white_checkbox" style="background:<?php echo $colors['main']; ?>;">
            <span class="color_presets_color-copied">&#xea10;</span>
           </span>
          </div>
         </li>
         <?php endforeach; ?>
        </ul>
        <input type="text" name="scroll_content_bg_color<?php echo $i; ?>" value="<?php echo esc_attr( $scroll_content_bg_color ); ?>" data-default-color="#000000" class="c-color-picker js-color-preset-target--main">
       </div>
      </li>
     </ul>

    </div><!-- END .sub_box_tab_content -->
    <?php endfor; ?>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // FAQの設定 --------------------------------------------------- ?>
  <div id="page_faq_option" class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'FAQ', 'tcd-issue' ); ?></h3>
   <div class="theme_option_field_ac_content tab_parent">

    <div class="cb_image">
     <img src="<?php bloginfo('template_url'); ?>/admin/img/image/page_faq.jpg" width="" height="" />
    </div>

    <div class="sub_box_tab">
     <?php for($i = 1; $i <= 5; $i++) : ?>
     <div class="tab<?php if($i == 1){ echo ' active'; }; ?>" data-tab="tab<?php echo $i; ?>"><span class="label"><?php printf(__('FAQ list%s', 'tcd-issue'), $i); ?></span></div>
     <?php endfor; ?>
    </div>

    <?php
        for($i = 1; $i <= 5; $i++) :
          $faq_list = get_post_meta($post->ID, 'faq_list'.$i, true);
    ?>
    <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

     <div class="theme_option_message2">
      <p><?php _e('Please copy and paste the short code below where you want to display FAQ list.<br>Multiple FAQ lists can also be created, separated by content, etc.', 'tcd-issue'); ?></p>
      <p><?php _e( 'Short code', 'tcd-issue' ); ?> : <input style="background:#fff; width:200px;" onfocus='this.select();' type="text" value="[sc_faq<?php echo $i; ?>]" readonly></p>
     </div>

     <?php //繰り返しフィールド ----- ?>
     <div class="repeater-wrapper">
      <div class="repeater sortable" data-delete-confirm="<?php echo tcd_admin_label('delete'); ?>">
        <?php
            if ( $faq_list ) :
              foreach ( $faq_list as $key => $value ) :
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
         <h4 class="theme_option_subbox_headline"><?php echo esc_html( ! empty( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : tcd_admin_label('new_item') ); ?></h4>
         <div class="sub_box_content">
          <h4 class="theme_option_headline2"><?php _e( 'Question', 'tcd-issue' ); ?></h4>
          <p><input class="repeater-label full_width" type="text" name="faq_list<?php echo $i; ?>[<?php echo esc_attr( $key ); ?>][question]" value="<?php echo esc_attr( isset( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : '' ); ?>" /></p>
          <h4 class="theme_option_headline2"><?php _e( 'Answer', 'tcd-issue' ); ?></h4>
          <textarea class="full_width" cols="50" rows="5" name="faq_list<?php echo $i; ?>[<?php echo esc_attr( $key ); ?>][answer]"><?php echo esc_attr( isset( $faq_list[$key]['answer'] ) ? $faq_list[$key]['answer'] : '' ); ?></textarea>
          <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php echo tcd_admin_label('delete_item'); ?></a></p>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
              endforeach;
            endif;
            $key = 'addindex';
            ob_start();
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
         <h4 class="theme_option_subbox_headline"><?php echo esc_html( ! empty( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : tcd_admin_label('new_item') ); ?></h4>
         <div class="sub_box_content">
          <h4 class="theme_option_headline2"><?php _e( 'Question', 'tcd-issue' ); ?></h4>
          <p><input class="repeater-label full_width" type="text" name="faq_list<?php echo $i; ?>[<?php echo esc_attr( $key ); ?>][question]" value="<?php echo esc_attr( isset( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : '' ); ?>" /></p>
          <h4 class="theme_option_headline2"><?php _e( 'Answer', 'tcd-issue' ); ?></h4>
          <textarea class="full_width" cols="50" rows="5" name="faq_list<?php echo $i; ?>[<?php echo esc_attr( $key ); ?>][answer]"><?php echo esc_attr( isset( $faq_list[$key]['answer'] ) ? $faq_list[$key]['answer'] : '' ); ?></textarea>
          <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php echo tcd_admin_label('delete_item'); ?></a></p>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
            $clone = ob_get_clean();
        ?>
       </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php echo tcd_admin_label('add_item'); ?></a>
     </div><!-- END .repeater-wrapper -->
     <?php //繰り返しフィールドここまで ----- ?>

    </div><!-- END .sub_box_tab_content -->
    <?php endfor; ?>

    <ul class="button_list cf">
      <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_page_header_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['page_header_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['page_header_custom_fields_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'header_headline','header_sub_title','header_desc','header_desc_mobile','header_image','header_overlay_color','header_overlay_color_opacity',
    'hide_page_header','hide_sidebar','page_hide_footer','hide_header_message','page_width','hide_breadcrumb','hide_global_menu','hide_logo','hide_side_button',
    'scroll_content_image1','scroll_content_image2_1','scroll_content_image2_mobile_1','scroll_content_headline1','scroll_content_sub_title1','scroll_content_button_label1','scroll_content_button_url1','scroll_content_button_target1','scroll_content_catch1','scroll_content_desc1','scroll_content_desc_mobile1','scroll_content_bg_color1','scroll_content_overlay_color1','scroll_content_overlay_opacity1','scroll_content_type1','scroll_content_bg_type1',
    'scroll_content_image2','scroll_content_image2_2','scroll_content_image2_mobile_2','scroll_content_headline2','scroll_content_sub_title2','scroll_content_button_label2','scroll_content_button_url2','scroll_content_button_target2','scroll_content_catch2','scroll_content_desc2','scroll_content_desc_mobile2','scroll_content_bg_color2','scroll_content_overlay_color2','scroll_content_overlay_opacity2','scroll_content_type2','scroll_content_bg_type2',
    'scroll_content_image3','scroll_content_image2_3','scroll_content_image2_mobile_3','scroll_content_headline3','scroll_content_sub_title3','scroll_content_button_label3','scroll_content_button_url3','scroll_content_button_target3','scroll_content_catch3','scroll_content_desc3','scroll_content_desc_mobile3','scroll_content_bg_color3','scroll_content_overlay_color3','scroll_content_overlay_opacity3','scroll_content_type3','scroll_content_bg_type3',
  );
  foreach ($cf_keys as $cf_key) {

    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if($cf_key == 'header_overlay_color_opacity'){
      if ( $new == '0' ) {
        $new = 'zero';
      }
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }

  }

  // repeater save or delete
  $cf_keys = array('faq_list1','faq_list2','faq_list3','faq_list4','faq_list5');
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
add_action('save_post', 'save_page_header_meta_box');



?>