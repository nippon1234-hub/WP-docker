<?php
/*
 * トップページの設定
 */

 use TCD\Helper\UI;
 use TCD\Helper\Sanitization as San;

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_front_page_dp_default_options' );


// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_front_page_tab_label' );


// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_front_page_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_front_page_theme_options_validate' );


// タブの名前
function add_front_page_tab_label( $tab_labels ) {
	$tab_labels['front_page'] = __( 'Front page', 'tcd-issue' );
	return $tab_labels;
}


// 初期値
function add_front_page_dp_default_options( $dp_default_options ) {

  // ヘッダーコンテンツ
	$dp_default_options['index_header_content_type'] = 'type1';

  // 画像スライダー
  $dp_default_options['index_slider_image'] = false;
  $dp_default_options['index_slider_image_sp'] = false;
	$dp_default_options['index_image_slider_animation_type'] = 'zoom_in';

  // 動画・YouTube
	$dp_default_options['index_header_content_video'] = '';
	$dp_default_options['index_header_content_youtube'] = '';

  // その他
	$dp_default_options['index_header_content_overlay_color'] = '#000000';
	$dp_default_options['index_header_content_overlay_opacity'] = '0.1';
	$dp_default_options['index_header_content_catch'] = __( 'Catchphrase', 'tcd-issue' );
	$dp_default_options['index_header_content_catch_mobile'] = '';
	$dp_default_options['index_header_content_catch_font_type'] = 1;
	$dp_default_options['index_header_content_catch_font_size'] = '70';
	$dp_default_options['index_header_content_catch_font_size_sp'] = '24';
	$dp_default_options['index_header_content_catch_animation'] = 'type1';
	$dp_default_options['index_header_content_position'] = 'type1';
	$dp_default_options['index_header_content_desc'] = __( 'Description will be displayed here.', 'tcd-issue' );
	$dp_default_options['index_header_content_desc_mobile'] = '';
	$dp_default_options['index_header_content_desc_font_size'] = '18';
	$dp_default_options['index_header_content_desc_font_size_sp'] = '14';
	$dp_default_options['index_header_content_notice'] = __( 'Notice will be displayed here.', 'tcd-issue' );
  $dp_default_options['index_header_content_notice_url'] = 'https://demo.tcd-theme.com/tcd106/';
  $dp_default_options['index_header_content_notice_target'] = '1';
	$dp_default_options['index_header_content_first_view_animation'] = 'yes';

	// ニュースティッカーの設定
	$dp_default_options['show_header_news'] = '1';
	$dp_default_options['header_news_post_type'] = 'news';
	$dp_default_options['header_news_post_order'] = 'date';

  // コンテンツビルダー
	$dp_default_options['page_content_width_type'] = 'type1';
	$dp_default_options['page_content_width'] = '800';
	$dp_default_options['index_content_type'] = 'type1';

	$dp_default_options['contents_builder'] = array(
		array(
            "type" => "free_space",
            "show_content" => 1,
            "headline" => 'HEADLINE',
            "sub_title" => 'SUB TITLE',
            "content_width" => "type1",
            "free_space" => "<p style='text-align:center;'>" . __( 'Description will be displayed here.', 'tcd-issue' ) . "</p>\n<p style='text-align:center;'>" . __( 'Description will be displayed here.', 'tcd-issue' ) . "</p>\n<p style='text-align:center;'>" . __( 'Description will be displayed here.', 'tcd-issue' ) . "</p>\n<p style='text-align:center;'>" . __( 'Description will be displayed here.', 'tcd-issue' ) . "</p>\n" . "<div class='link_button'><a class='design_button' href='#'>" . __( 'Button', 'tcd-issue' ) . "</a></div>",
		),
		array(
            "type" => "banner",
            "show_content" => 1,
            "catch" => __( 'Catchphrase will be displayed here.', 'tcd-issue' ),
            "catch_mobile" => "",
            "button_url" => "#",
            "button_target" => "",
            "bg_type" => "type1",
            "image" => "",
            "video" => "",
            "overlay_color" => "#000000",
            "overlay_opacity" => "0",
		),
		array(
            "type" => "scroll_content",
            "show_content" => 1,
            "headline1" => 'HEADLINE',
            "sub_title1" => 'SUB TITLE',
            "catch1" => __( 'Catchphrase', 'tcd-issue' ),
            "desc1" => __( 'Description will be displayed here.', 'tcd-issue' ),
            "desc_mobile1" => "",
            "button_label1" => __( 'Button', 'tcd-issue' ),
            "button_url1" => "#",
            "button_target1" => "",
            "image1" => "",
            "image_mobile1" => "",
            "image21" => "",
            "overlay_color1" => "#000000",
            "overlay_opacity1" => "0.5",
            "bg_color1" => "#000000",
            "content_type1" => "type1",
            "bg_type1" => "type1",
            "headline2" => 'HEADLINE',
            "sub_title2" => 'SUB TITLE',
            "catch2" => __( 'Catchphrase', 'tcd-issue' ),
            "desc2" => __( 'Description will be displayed here.', 'tcd-issue' ),
            "desc_mobile2" => "",
            "button_label2" => __( 'Button', 'tcd-issue' ),
            "button_url2" => "#",
            "button_target2" => "",
            "image2" => "",
            "image_mobile2" => "",
            "image22" => "",
            "overlay_color2" => "#000000",
            "overlay_opacity2" => "0.5",
            "bg_color2" => "#0a578c",
            "content_type2" => "type2",
            "bg_type2" => "type2",
            "headline3" => '',
            "sub_title3" => '',
            "catch3" => '',
            "desc3" => '',
            "desc_mobile3" => "",
            "button_label3" => '',
            "button_url3" => "",
            "button_target3" => "",
            "image3" => "",
            "image_mobile3" => "",
            "image23" => "",
            "overlay_color3" => "#000000",
            "overlay_opacity3" => "0.2",
            "bg_color3" => "#000000",
            "content_type3" => "type1",
            "bg_type3" => "type1",
		),
		array(
            "type" => "staff_list",
            "show_content" => 1,
            "headline" => 'STAFF',
            "sub_title" => 'SUB TITLE',
            "button_label" => __( 'Archive page', 'tcd-issue' ),
            "post_num" => "4",
            "post_num_sp" => "4",
            "post_type" => "all_post",
            "post_order" => "rand",
            "post_order_custom" => "",
            "category_id" => "",
		),
		array(
            "type" => "interview_list",
            "show_content" => 1,
            "headline" => 'INTERVIEWS',
            "sub_title" => 'SUB TITLE',
            "button_label" => __( 'Archive page', 'tcd-issue' ),
            "post_num" => "4",
            "post_num_sp" => "4",
            "post_type" => "all_post",
            "post_order" => "rand",
            "post_order_custom" => "",
            "category_id" => "",
		),
		array(
            "type" => "blog_list",
            "show_content" => 1,
            "headline" => 'BLOG',
            "sub_title" => 'SUB TITLE',
            "button_label" => __( 'Archive page', 'tcd-issue' ),
            "post_num" => "4",
            "post_num_sp" => "4",
            "post_type" => "all_post",
            "post_order" => "rand",
            "post_order_custom" => "",
            "category_id" => "",
		)
  );

	return $dp_default_options;

}

// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $item_type_options, $font_type_options, $bool_options, $basic_display_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-issue' );
  $staff_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Staff', 'tcd-issue' );
  $interview_label = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Conversation', 'tcd-issue' );

?>

<div id="tab-content-front-page" class="tab-content">

   <?php // ヘッダーコンテンツ ---------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header content', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content header_content_setting_area tab_parent">

     <h4 class="theme_option_headline2"><?php _e('Background type', 'tcd-issue'); ?></h4>
     <ul class="design_radio_button horizontal clearfix">
      <li class="index_header_content_type1">
       <input type="radio" id="index_header_content_type1" name="dp_options[index_header_content_type]" value="type1" <?php checked( $options['index_header_content_type'], 'type1' ); ?> />
       <label for="index_header_content_type1"><?php _e('Image slider', 'tcd-issue');  ?></label>
      </li>
      <li class="index_header_content_type2">
       <input type="radio" id="index_header_content_type2" name="dp_options[index_header_content_type]" value="type2" <?php checked( $options['index_header_content_type'], 'type2' ); ?> />
       <label for="index_header_content_type2"><?php _e('Video', 'tcd-issue');  ?></label>
      </li>
      <li class="index_header_content_type3">
       <input type="radio" id="index_header_content_type3" name="dp_options[index_header_content_type]" value="type3" <?php checked( $options['index_header_content_type'], 'type3' ); ?> />
       <label for="index_header_content_type3"><?php _e('YouTube', 'tcd-issue');  ?></label>
      </li>
     </ul>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><span class="label"><?php _e('Content', 'tcd-issue'); ?></span></div>
      <div class="tab" data-tab="tab2"><span class="label index_header_content_type1_option"><?php _e('Image slider', 'tcd-issue'); ?></span><span class="label index_header_content_type2_option"><?php _e('Video', 'tcd-issue'); ?></span><span class="index_header_content_type3_option"><?php _e('YouTube', 'tcd-issue'); ?></span></div>
     </div>

     <?php // コンテンツ ?>
     <div class="sub_box_tab_content active" data-tab-content="tab1">

     <h4 class="theme_option_headline2"><?php _e('Main content', 'tcd-issue'); ?></h4>
     <div class="front_page_image middle">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/index_header.jpg?2.0" alt="" title="" />
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Tagline', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[index_header_content_catch]"><?php echo esc_textarea(  $options['index_header_content_catch'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Tagline (mobile)', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-issue' ); ?>" name="dp_options[index_header_content_catch_mobile]"><?php echo esc_textarea(  $options['index_header_content_catch_mobile'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Font type of tagline', 'tcd-issue'); ?></span>
        <?php echo UI\font_select( 'dp_options[index_header_content_catch_font_type]', $options['index_header_content_catch_font_type'] ); ?>
      </li>
      <li class="cf space"><span class="label"><?php _e('Font size of tagline', 'tcd-issue'); ?></span><?php echo tcd_font_size_option($options, 'index_header_content_catch_font_size'); ?></li>
      <li class="cf space">
       <span class="label"><?php _e('Animation of tagline', 'tcd-issue'); ?></span>
       <div class="standard_radio_button">
        <input id="index_header_content_catch_animation_type1" type="radio" name="dp_options[index_header_content_catch_animation]" value="type1" <?php checked( $options['index_header_content_catch_animation'], 'type1' ); ?>>
        <label for="index_header_content_catch_animation_type1"><?php _e('Pop in', 'tcd-issue'); ?></label>
        <input id="index_header_content_catch_animation_type2" type="radio" name="dp_options[index_header_content_catch_animation]" value="type2" <?php checked( $options['index_header_content_catch_animation'], 'type2' ); ?>>
        <label for="index_header_content_catch_animation_type2"><?php _e('Blur', 'tcd-issue'); ?></label>
        <input id="index_header_content_catch_animation_type3" type="radio" name="dp_options[index_header_content_catch_animation]" value="type3" <?php checked( $options['index_header_content_catch_animation'], 'type3' ); ?>>
        <label for="index_header_content_catch_animation_type3"><?php _e('Impact', 'tcd-issue'); ?></label>
       </div>
      </li>
      <li class="cf space">
       <span class="label"><?php _e('Position of tagline and sub tagline', 'tcd-issue'); ?></span>
       <div class="standard_radio_button">
        <input id="index_header_content_position_type1" type="radio" name="dp_options[index_header_content_position]" value="type1" <?php checked( $options['index_header_content_position'], 'type1' ); ?>>
        <label for="index_header_content_position_type1"><?php _e('Bottom left', 'tcd-issue'); ?></label>
        <input id="index_header_content_position_type2" type="radio" name="dp_options[index_header_content_position]" value="type2" <?php checked( $options['index_header_content_position'], 'type2' ); ?>>
        <label for="index_header_content_position_type2"><?php _e('Center', 'tcd-issue'); ?></label>
       </div>
      </li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Sub tagline', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[index_header_content_desc]"><?php echo esc_textarea(  $options['index_header_content_desc'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Sub tagline (mobile)', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-issue' ); ?>" name="dp_options[index_header_content_desc_mobile]"><?php echo esc_textarea(  $options['index_header_content_desc_mobile'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Font size of sub tagline', 'tcd-issue'); ?></span><?php echo tcd_font_size_option($options, 'index_header_content_desc_font_size'); ?></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Announcement', 'tcd-issue'); ?></span><textarea placeholder="<?php _e('2024&#13;Corporate Information Briefing&#13;Held on May 5', 'tcd-issue'); ?>" class="full_width" cols="50" rows="3" name="dp_options[index_header_content_notice]"><?php echo esc_textarea(  $options['index_header_content_notice'] ); ?></textarea></li>
      <li class="cf space">
       <span class="label"><?php _e('Link URL of announcement', 'tcd-issue'); ?></span>
       <div class="admin_link_option">
        <input type="text" name="dp_options[index_header_content_notice_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['index_header_content_notice_url'] ); ?>">
        <input id="index_header_content_notice_target" class="admin_link_option_target" name="dp_options[index_header_content_notice_target]" type="checkbox" value="1" <?php checked( $options['index_header_content_notice_target'], 1 ); ?>>
        <label for="index_header_content_notice_target">&#xe920;</label>
       </div>
      </li>
     </ul>

     </div><!-- END .sub_box_tab_content -->

     <?php // 背景画像 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

     <?php // 画像スライダー ----------------------- ?>
     <div class="index_header_content_type1_option">

      <h4 class="theme_option_headline2"><?php _e('Image slider', 'tcd-issue'); ?></h4>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e( 'Image', 'tcd-issue' ); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '1740', '1320'); ?></span>
          <span class="recommend_desc"><?php _e('You can register multiple image by clicking images in media library.', 'tcd-issue'); ?></span>
        </span>
        <?php echo tcd_multi_media_uploader( 'index_slider_image', $options ); ?>
       </li>
       <li class="cf">
        <span class="label"><?php _e( 'Image (mobile)', 'tcd-issue' ); ?>
         <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '750', '1324'); ?></span>
        </span>
        <?php echo tcd_multi_media_uploader( 'index_slider_image_sp', $options ); ?>
       </li>
       <li class="cf">
        <span class="label"><?php _e('Animation type', 'tcd-issue');  ?>
         <span class="recommend_desc"><?php _e('Applies when multiple images are set.', 'tcd-issue'); ?></span>
        </span>
        <div class="standard_radio_button">
         <input id="index_header_slide_type1" type="radio" name="dp_options[index_image_slider_animation_type]" value="zoom_in" <?php checked( $options['index_image_slider_animation_type'], 'zoom_in' ); ?>>
         <label for="index_header_slide_type1"><?php _e('Zoom in', 'tcd-issue'); ?></label>
         <input id="index_header_slide_type2" type="radio" name="dp_options[index_image_slider_animation_type]" value="zoom_out" <?php checked( $options['index_image_slider_animation_type'], 'zoom_out' ); ?>>
         <label for="index_header_slide_type2"><?php _e('Zoom out', 'tcd-issue'); ?></label>
         <input id="index_header_slide_type3" type="radio" name="dp_options[index_image_slider_animation_type]" value="fade" <?php checked( $options['index_image_slider_animation_type'], 'fade' ); ?>>
         <label for="index_header_slide_type3"><?php _e('Fade', 'tcd-issue'); ?></label>
        </div>
       </li>
      </ul>

     </div><!-- END .index_header_content_type1_option -->

     <?php // 動画 --------------------------------------- ?>
     <div class="index_header_content_type2_option">

      <h4 class="theme_option_headline2"><?php _e('Video', 'tcd-issue'); ?></h4>
      <div class="theme_option_message2" style="margin-top:25px;">
       <p><?php _e('Please upload MP4 format file.', 'tcd-issue');  ?><br>
       <?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-issue'); ?><br>
       <?php _e('Recommended MP4 file size: 10 MB or less.<br>The screen ratio of the video is assumed to be 16:9.', 'tcd-issue'); ?></p>
      </div>
      <div class="cf cf_media_field hide-if-no-js index_header_content_video">
       <input type="hidden" value="<?php if($options['index_header_content_video']) { echo esc_attr( $options['index_header_content_video'] ); }; ?>" id="index_header_content_video" name="dp_options[index_header_content_video]" class="cf_media_id">
       <div class="preview_field preview_field_video">
        <?php if($options['index_header_content_video']){ ?>
        <h4><?php _e( 'Uploaded MP4 file', 'tcd-issue' ); ?></h4>
        <p><?php echo esc_url(wp_get_attachment_url($options['index_header_content_video'])); ?></p>
        <?php }; ?>
       </div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select MP4 file', 'tcd-issue'); ?>" class="cfmf-select-video button">
        <input type="button" value="<?php _e('Remove MP4 file', 'tcd-issue'); ?>" class="cfmf-delete-video button <?php if(!$options['index_header_content_video']){ echo 'hidden'; }; ?>">
       </div>
      </div>

     </div><!-- END .index_header_content_type2_option -->

     <?php // YouTube --------------------------------------- ?>
     <div class="index_header_content_type3_option">

      <h4 class="theme_option_headline2"><?php _e('YouTube', 'tcd-issue'); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please enter YouTube URL.', 'tcd-issue');  ?></p>
       <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-issue'); ?></p>
      </div>
      <input class="full_width" type="text" name="dp_options[index_header_content_youtube]" value="<?php echo esc_attr( $options['index_header_content_youtube'] ); ?>">

     </div><!-- END .index_header_content_type3_option -->

     <?php // オーバーレイ（共通） ?>
     <h4 class="theme_option_headline2"><?php _e('Overlay', 'tcd-issue'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Color', 'tcd-issue'); ?></span><input type="text" name="dp_options[index_header_content_overlay_color]" value="<?php echo esc_attr( $options['index_header_content_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-issue'); ?></span><input class="hankaku" style="width:70px;" type="number" min="0" max="1" step="0.1" name="dp_options[index_header_content_overlay_opacity]" value="<?php echo esc_attr( $options['index_header_content_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-issue');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-issue');  ?></p>
       </div>
      </li>
     </ul>

     </div><!-- END .sub_box_tab_content -->

     <h4 class="theme_option_headline2"><?php _e('First view anination', 'tcd-issue'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Set to "Do not use" if you want all content to be displayed immediately.<br>Stops all animations in the first view.', 'tcd-issue'); ?></p>
     </div>

     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('First view anination', 'tcd-issue');  ?></span>
       <div class="standard_radio_button">
        <input id="index_header_content_first_view_animation_yes" type="radio" name="dp_options[index_header_content_first_view_animation]" value="yes" <?php checked( $options['index_header_content_first_view_animation'], 'yes' ); ?>>
        <label for="index_header_content_first_view_animation_yes"><?php _e('Use', 'tcd-issue'); ?></label>
        <input id="index_header_content_first_view_animation_no" type="radio" name="dp_options[index_header_content_first_view_animation]" value="no" <?php checked( $options['index_header_content_first_view_animation'], 'no' ); ?>>
        <label for="index_header_content_first_view_animation_no"><?php _e('Don\'t use', 'tcd-issue'); ?></label>
       </div>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ニュースティッカー設定 ----------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('News ticker', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/index_news.jpg?2.0" alt="" title="" />
     </div>

     <p class="displayment_checkbox"><label><input name="dp_options[show_header_news]" type="checkbox" value="1" <?php checked( $options['show_header_news'], 1 ); ?>><?php _e( 'Display news ticker', 'tcd-issue' ); ?></label></p>
     <div style="<?php if($options['show_header_news'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list">
       <li class="cf" style="border-top:1px dotted #ccc;">
        <span class="label"><?php _e('Post type', 'tcd-issue');  ?></span>
        <div class="standard_radio_button">
         <input id="header_news_post_type_post" type="radio" name="dp_options[header_news_post_type]" value="post" <?php checked( $options['header_news_post_type'], 'post' ); ?>>
         <label for="header_news_post_type_post"><?php echo esc_html($blog_label); ?></label>
         <input id="header_news_post_type_news" type="radio" name="dp_options[header_news_post_type]" value="news" <?php checked( $options['header_news_post_type'], 'news' ); ?>>
         <label for="header_news_post_type_news"><?php echo esc_html($news_label); ?></label>
        </div>
       </li>
       <li class="cf">
        <span class="label"><?php _e('Post order', 'tcd-issue');  ?></span>
        <div class="standard_radio_button">
         <input id="header_news_post_order_date" type="radio" name="dp_options[header_news_post_order]" value="date" <?php checked( $options['header_news_post_order'], 'date' ); ?>>
         <label for="header_news_post_order_date"><?php _e('Date', 'tcd-issue'); ?></label>
         <input id="header_news_post_order_rand" type="radio" name="dp_options[header_news_post_order]" value="rand" <?php checked( $options['header_news_post_order'], 'rand' ); ?>>
         <label for="header_news_post_order_rand"><?php _e('Random', 'tcd-issue'); ?></label>
        </div>
       </li>
      </ul>
     </div><!-- END .displayment_checkbox -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コンテンツビルダー ここから ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
   <div class="theme_option_field theme_option_field_ac open active">
    <h3 class="theme_option_headline"><?php _e('Content builder', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content">

     <ul class="design_radio_button" style="margin-bottom:25px;">
      <li class="index_content_type1_button">
       <input type="radio" id="index_content_type1" name="dp_options[index_content_type]" value="type1" <?php checked( $options['index_content_type'], 'type1' ); ?> />
       <label for="index_content_type1"><?php _e('Use content builder', 'tcd-issue');  ?></label>
      </li>
      <li class="index_content_type2_button">
       <input type="radio" id="index_content_type2" name="dp_options[index_content_type]" value="type2" <?php checked( $options['index_content_type'], 'type2' ); ?> />
       <label for="index_content_type2"><?php _e('Use page content instead of content builder', 'tcd-issue');  ?></label>
      </li>
     </ul>

     <?php
          // コンテンツビルダーの代わりに使う固定ページのコンテンツ
          $front_page_id = get_option('page_on_front');
          if($front_page_id){
     ?>
     <div class="index_content_type2_option" style="<?php if($options['index_content_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <p><?php printf(__('Please set content from <a href="post.php?post=%s&action=edit" target="_blank">Front page edit screen</a>.', 'tcd-issue'), $front_page_id); ?></p>
      </div>
      <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-issue');  ?></h4>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Content width type', 'tcd-issue'); ?></span>
        <div class="standard_radio_button">
         <input id="page_content_width_type1" type="radio" name="dp_options[page_content_width_type]" value="type1" <?php checked( $options['page_content_width_type'], 'type1' ); ?>>
         <label for="page_content_width_type1"><?php _e('Any width', 'tcd-issue'); ?></label>
         <input id="page_content_width_type2" type="radio" name="dp_options[page_content_width_type]" value="type2" <?php checked( $options['page_content_width_type'], 'type2' ); ?>>
         <label for="page_content_width_type2"><?php _e('Full screen width', 'tcd-issue'); ?></label>
        </div>
       </li>
       <li class="cf page_content_width_type1_option" style="<?php if($options['page_content_width_type'] == 'type1'){ echo 'display:block;'; } else {  echo 'display:none;'; }; ?>">
        <span class="label"><?php _e('Content width', 'tcd-issue'); ?></span><input class="hankaku page_content_width_input" style="width:100px;" type="number" name="dp_options[page_content_width]" value="<?php echo esc_attr($options['page_content_width']); ?>" /><span>px</span>
       </li>
      </ul>
     </div>
     <?php }; ?>

     <?php // コンテンツビルダー ------------------------------------------------------------------------------------- ?>
     <div class="index_content_type1_option" style="<?php if($options['index_content_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <h4 class="theme_option_headline2"><?php _e( 'Contents Builder', 'tcd-issue' ); ?></h4>

      <div class="js-contents-builder admin-contents-builder">
       <input type="hidden" name="dp_options[contents_builder]" value="">
       <div class="admin-contents-builder__list js-contents-builder-list">
        <?php
             if ( !empty( $options['contents_builder'] ) ) {
               foreach( $options['contents_builder'] as $key => $values ) :
                 admin_contents_builder_start( $key, $values );
                 switch( true ){
                   case $values['type'] == 'banner' :
                     admin_contents_builder_banner( $key, $values );
                     break;
                   case $values['type'] == 'scroll_content' :
                     admin_contents_builder_scroll_content( $key, $values );
                     break;
                   case $values['type'] == 'staff_list':
                     admin_contents_builder_staff_list( $key, $values );
                     break;
                   case $values['type'] == 'interview_list' :
                     admin_contents_builder_interview_list( $key, $values );
                     break;
                   case $values['type'] == 'blog_list' :
                     admin_contents_builder_blog_list( $key, $values );
                     break;
                   case $values['type'] == 'news_list' :
                     admin_contents_builder_news_list( $key, $values );
                     break;
                   case $values['type'] == 'free_space' :
                     admin_contents_builder_free_space( $key, $values );
                     break;
                 }
                 admin_contents_builder_end();
               endforeach;
             }
        ?>
       </div>
       <div class="admin-contents-builder__add">
        <div class="admin-contents-builder__add-info">
         <span><?php _e( 'Additional Items', 'tcd-issue' ); ?></span>
         <p><?php _e( 'The following items can be added by clicking on them', 'tcd-issue' ); ?></p>
        </div>
        <div class="admin-contents-builder__add-list">
         <?php
              $content_types = array('banner','scroll_content','staff_list','interview_list', 'blog_list', 'news_list', 'free_space');
              foreach( $content_types as $type ){
                ob_start();
                $key = 'cb-index';
                admin_contents_builder_start( $key, array( 'type' => $type ) );
                switch( true ){
                  case $type == 'banner' :
                    $title = __( 'Background image / movie', 'tcd-issue' );
                    $is_active = 'is-active';
                    $image_name = 'banner';
                    admin_contents_builder_banner( $key, array() );
                    break;
                  case $type == 'scroll_content' :
                    $title = __( 'Scroll content', 'tcd-issue' );
                    $is_active = 'is-active';
                    $image_name = 'scroll_content';
                    admin_contents_builder_scroll_content( $key, array() );
                    break;
                  case $type == 'staff_list' :
                    $title = sprintf(__('%s list', 'tcd-issue'), $staff_label);
                    $is_active = $options['use_staff'] ? 'is-active' : '';
                    if($options['staff_design_type'] == 'type1'){
                      $image_name = 'staff_list_type1';
                    } else {
                      $image_name = 'staff_list_type2';
                    }
                    admin_contents_builder_staff_list( $key, array() );
                    break;
                  case $type == 'interview_list':
                    $title = sprintf(__('Pickup %s', 'tcd-issue'), $interview_label);
                    $is_active = $options['use_interview'] ? 'is-active' : '';
                    $image_name = 'interview_list';
                    admin_contents_builder_interview_list( $key, array() );
                    break;
                  case $type == 'blog_list' :
                    $title = sprintf(__('%s list', 'tcd-issue'), $blog_label);
                    $is_active = 'is-active';
                    $image_name = 'blog_list';
                    admin_contents_builder_blog_list( $key, array() );
                    break;
                  case $type == 'news_list' :
                    $title = sprintf(__('%s list', 'tcd-issue'), $news_label);
                    $is_active = $options['use_news'] ? 'is-active' : '';
                    $image_name = 'news_list';
                    admin_contents_builder_news_list( $key, array() );
                    break;
                  case $type == 'free_space' :
                    $title = __( 'Free space', 'tcd-issue' );
                    $is_active = 'is-active';
                    $image_name = 'free_space';
                    admin_contents_builder_free_space( $key, array() );
                    break;
                }
                admin_contents_builder_end();
                $clone = ob_get_clean();
         ?>
         <div class="admin-contents-builder__add-item js-contents-builder-add <?php echo $is_active; ?>" data-clone="<?php echo esc_attr( $clone ); ?>">
          <div class="admin-contents-builder__add-item__inner">
           <div class="admin-contents-builder__add-item__overlay">
            <?php if( $is_active ){ ?>
            <span class="admin-contents-builder__add-item__icon c-icon">&#xe145;</span>
            <?php _e( 'Add this item', 'tcd-issue' ); ?>
            <?php } else { ?>
            <?php _e( 'Not available now', 'tcd-issue' ); ?>
            <?php } ?>
           </div>
           <img class="admin-contents-builder__add-item__image" src="<?php echo get_template_directory_uri() . '/admin/img/image/cb_' . $image_name . '.jpg'; ?>?2.0" width="" height="" />
          </div>
          <span class="admin-contents-builder__add-item__label"><?php echo $title; ?></span>
         </div>
         <?php
              } // END foreach
         ?>
        </div><!-- END .admin-contents-builder__add-list -->
       </div><!-- END .admin-contents-builder__add -->
      </div><!-- END .admin-contents-builder -->

     </div><!-- END .index_content_type1_option -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_front_page_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_theme_options_validate( $input ) {

  global $dp_default_options, $item_type_options, $font_type_options;


  // ヘッダーコンテンツ
  $input['index_header_content_type'] = wp_filter_nohtml_kses( $input['index_header_content_type'] );

  // 画像スライダーの設定
  $input['index_slider_image'] = wp_filter_nohtml_kses( $input['index_slider_image'] );
  $input['index_slider_image_sp'] = wp_filter_nohtml_kses( $input['index_slider_image_sp'] );
  $input['index_image_slider_animation_type'] = wp_filter_nohtml_kses( $input['index_image_slider_animation_type'] );
  $input['index_header_content_first_view_animation'] = wp_filter_nohtml_kses( $input['index_header_content_first_view_animation'] );

  // 動画・YouTube
  $input['index_header_content_video'] = wp_filter_nohtml_kses( $input['index_header_content_video'] );
  $input['index_header_content_youtube'] = wp_filter_nohtml_kses( $input['index_header_content_youtube'] );

  $input['index_header_content_catch'] = wp_kses_post( $input['index_header_content_catch'] );
  $input['index_header_content_catch_mobile'] = wp_kses_post( $input['index_header_content_catch_mobile'] );
  $input['index_header_content_catch_font_type'] = San\choice( $input['index_header_content_catch_font_type'], [ '1', '2', '3' ] );
  $input['index_header_content_catch_font_size'] = wp_filter_nohtml_kses( $input['index_header_content_catch_font_size'] );
  $input['index_header_content_catch_font_size_sp'] = wp_filter_nohtml_kses( $input['index_header_content_catch_font_size_sp'] );
  $input['index_header_content_catch_animation'] = wp_filter_nohtml_kses( $input['index_header_content_catch_animation'] );
  $input['index_header_content_position'] = wp_filter_nohtml_kses( $input['index_header_content_position'] );
  $input['index_header_content_desc'] = wp_kses_post( $input['index_header_content_desc'] );
  $input['index_header_content_desc_mobile'] = wp_kses_post( $input['index_header_content_desc_mobile'] );
  $input['index_header_content_desc_font_size'] = wp_filter_nohtml_kses( $input['index_header_content_desc_font_size'] );
  $input['index_header_content_desc_font_size_sp'] = wp_filter_nohtml_kses( $input['index_header_content_desc_font_size_sp'] );
  $input['index_header_content_notice'] = wp_kses_post( $input['index_header_content_notice'] );
  $input['index_header_content_notice_url'] = wp_kses_post( $input['index_header_content_notice_url'] );
  $input['index_header_content_notice_target'] = wp_kses_post( $input['index_header_content_notice_target'] );

  $input['index_header_content_overlay_color'] = wp_filter_nohtml_kses( $input['index_header_content_overlay_color'] );
  $input['index_header_content_overlay_opacity'] = wp_filter_nohtml_kses( $input['index_header_content_overlay_opacity'] );


  // ニュースティッカーの設定
  $input['show_header_news'] = ! empty( $input['show_header_news'] ) ? 1 : 0;
  $input['header_news_post_type'] = wp_kses_post( $input['header_news_post_type'] );
  $input['header_news_post_order'] = wp_filter_nohtml_kses( $input['header_news_post_order'] );


  // コンテンツビルダーの代わりに使う固定ページのコンテンツ
  $input['index_content_type'] = wp_filter_nohtml_kses( $input['index_content_type'] );
  $input['page_content_width'] = wp_filter_nohtml_kses( $input['page_content_width'] );


  // コンテンツビルダー -----------------------------------------------------------------------------
  $contents_builder = array();
  if ( isset( $input['contents_builder'] ) && is_array( $input['contents_builder'] ) ) {
    foreach ( $input['contents_builder'] as $key => $value ) {

      if( !isset( $value['type'] ) || !$value['type'] )
        continue;

      switch( $value['type'] ){

        case 'banner' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'catch' => isset( $input['contents_builder'][$key]['catch'] ) ? wp_kses_post( $input['contents_builder'][$key]['catch'] ) : '',
            'catch_mobile' => isset( $input['contents_builder'][$key]['catch_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['catch_mobile'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'button_url' => isset( $input['contents_builder'][$key]['button_url'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_url'] ) : '',
            'button_target' => ! empty( $input['contents_builder'][$key]['button_target'] ) ? 1 : 0,
            'bg_type' => isset( $input['contents_builder'][$key]['bg_type'] ) ? wp_kses_post( $input['contents_builder'][$key]['bg_type'] ) : 'type1',
            'image' => isset( $input['contents_builder'][$key]['image'] ) ? wp_kses_post( $input['contents_builder'][$key]['image'] ) : '',
            'video' => isset( $input['contents_builder'][$key]['video'] ) ? wp_kses_post( $input['contents_builder'][$key]['video'] ) : '',
            'overlay_color' => isset( $input['contents_builder'][$key]['overlay_color'] ) ? wp_kses_post( $input['contents_builder'][$key]['overlay_color'] ) : '#000000',
            'overlay_opacity' => isset( $input['contents_builder'][$key]['overlay_opacity'] ) ? wp_kses_post( $input['contents_builder'][$key]['overlay_opacity'] ) : '0',
          );
          break;

        case 'scroll_content' :
          $temp_array = array();
          for($i = 1; $i <= 3; $i++) {
            $temp_array['headline'.$i] = isset( $input['contents_builder'][$key]['headline'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'.$i] ) : '';
            $temp_array['sub_title'.$i] = isset( $input['contents_builder'][$key]['sub_title'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'.$i] ) : '';
            $temp_array['catch'.$i] = isset( $input['contents_builder'][$key]['catch'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['catch'.$i] ) : '';
            $temp_array['desc'.$i] = isset( $input['contents_builder'][$key]['desc'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'.$i] ) : '';
            $temp_array['desc_mobile'.$i] = isset( $input['contents_builder'][$key]['desc_mobile'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'.$i] ) : '';
            $temp_array['button_label'.$i] = isset( $input['contents_builder'][$key]['button_label'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'.$i] ) : '';
            $temp_array['button_url'.$i] = isset( $input['contents_builder'][$key]['button_url'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['button_url'.$i] ) : '';
            $temp_array['button_target'.$i] = isset( $input['contents_builder'][$key]['button_target'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['button_target'.$i] ) : '';
            $temp_array['image'.$i] = isset( $input['contents_builder'][$key]['image'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['image'.$i] ) : '';
            $temp_array['image_mobile'.$i] = isset( $input['contents_builder'][$key]['image_mobile'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['image_mobile'.$i] ) : '';
            $temp_array['image2'.$i] = isset( $input['contents_builder'][$key]['image2'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['image2'.$i] ) : '';
            $temp_array['overlay_color'.$i] = isset( $input['contents_builder'][$key]['overlay_color'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['overlay_color'.$i] ) : '#000000';
            $temp_array['overlay_opacity'.$i] = isset( $input['contents_builder'][$key]['overlay_opacity'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['overlay_opacity'.$i] ) : '0';
            $temp_array['bg_color'.$i] = isset( $input['contents_builder'][$key]['bg_color'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['bg_color'.$i] ) : '#000000';
            $temp_array['content_type'.$i] = isset( $input['contents_builder'][$key]['content_type'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['content_type'.$i] ) : 'type1';
            $temp_array['bg_type'.$i] = isset( $input['contents_builder'][$key]['bg_type'.$i] ) ? wp_kses_post( $input['contents_builder'][$key]['bg_type'.$i] ) : 'type1';
          }
          $temp_array['type'] = $value['type'];
          $temp_array['show_content'] = ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0;
          $contents_builder[] = $temp_array;
          break;

        case 'staff_list' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'post_num' => isset( $input['contents_builder'][$key]['post_num'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num'] ) : '6',
            'post_num_sp' => isset( $input['contents_builder'][$key]['post_num_sp'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num_sp'] ) : '6',
            'post_type' => isset( $input['contents_builder'][$key]['post_type'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_type'] ) : 'all_post',
            'post_order' => isset( $input['contents_builder'][$key]['post_order'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order'] ) : 'menu_order',
            'post_order_custom' => isset( $input['contents_builder'][$key]['post_order_custom'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order_custom'] ) : '',
            'category_id' => isset( $input['contents_builder'][$key]['category_id'] ) ? wp_kses_post( $input['contents_builder'][$key]['category_id'] ) : '',
          );
          break;

        case 'interview_list' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'post_num' => isset( $input['contents_builder'][$key]['post_num'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num'] ) : '6',
            'post_num_sp' => isset( $input['contents_builder'][$key]['post_num_sp'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num_sp'] ) : '6',
            'post_type' => isset( $input['contents_builder'][$key]['post_type'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_type'] ) : 'all_post',
            'post_order' => isset( $input['contents_builder'][$key]['post_order'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order'] ) : 'menu_order',
            'post_order_custom' => isset( $input['contents_builder'][$key]['post_order_custom'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order_custom'] ) : '',
            'category_id' => isset( $input['contents_builder'][$key]['category_id'] ) ? wp_kses_post( $input['contents_builder'][$key]['category_id'] ) : '',
          );
          break;

        case 'blog_list' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'post_num' => isset( $input['contents_builder'][$key]['post_num'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num'] ) : '6',
            'post_num_sp' => isset( $input['contents_builder'][$key]['post_num_sp'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num_sp'] ) : '6',
            'post_type' => isset( $input['contents_builder'][$key]['post_type'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_type'] ) : 'recent_post',
            'post_order' => isset( $input['contents_builder'][$key]['post_order'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order'] ) : 'date',
            'post_order_custom' => isset( $input['contents_builder'][$key]['post_order_custom'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order_custom'] ) : '',
            'category_id' => isset( $input['contents_builder'][$key]['category_id'] ) ? wp_kses_post( $input['contents_builder'][$key]['category_id'] ) : '',
          );
          break;

        case 'news_list' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'post_num' => isset( $input['contents_builder'][$key]['post_num'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num'] ) : '6',
            'post_num_sp' => isset( $input['contents_builder'][$key]['post_num_sp'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num_sp'] ) : '6',
            'post_type' => isset( $input['contents_builder'][$key]['post_type'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_type'] ) : 'recent_post',
            'post_order' => isset( $input['contents_builder'][$key]['post_order'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order'] ) : 'date',
            'post_order_custom' => isset( $input['contents_builder'][$key]['post_order_custom'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order_custom'] ) : '',
            'category_id' => isset( $input['contents_builder'][$key]['category_id'] ) ? wp_kses_post( $input['contents_builder'][$key]['category_id'] ) : '',
          );
          break;

        case 'free_space' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'content_width' => isset( $input['contents_builder'][$key]['content_width'] ) ? wp_kses_post( $input['contents_builder'][$key]['content_width'] ) : 'type1',
            'free_space' => isset( $input['contents_builder'][$key]['free_space'] ) ? $input['contents_builder'][$key]['free_space'] : '',
          );
          break;

      }

    }
  };
  $input['contents_builder'] = $contents_builder;


  return $input;

};


/**
 * コンテンツビルダー用 コンテンツ設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
// コンテンツビルダー
function admin_contents_builder_start( $key, $values = array() ){

  global $blog_label, $font_type_options, $button_type_options, $button_border_radius_options, $button_size_options, $button_animation_options, $post;
  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-issue' );
  $staff_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Staff', 'tcd-issue' );
  $interview_label = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Conversation', 'tcd-issue' );

  $title = '';
  switch( $values['type'] ?? '' ){

    case 'banner' :
      $title = __( 'Background image / movie', 'tcd-issue' );
      break;
    case 'scroll_content' :
      $title = __( 'Scroll content', 'tcd-issue' );
      break;
    case 'staff_list' :
      if($options['use_staff']){
        $title = sprintf(__('%s list', 'tcd-issue'), $staff_label);
      } else {
        $title = __('(N/A) ', 'tcd-issue') . sprintf(__('%s list', 'tcd-issue'), $staff_label);
      }
      break;
    case 'interview_list' :
      if($options['use_interview']){
        $title = sprintf(__('Pickup %s', 'tcd-issue'), $interview_label);
      } else {
        $title = __('(N/A) ', 'tcd-issue') . sprintf(__('Pickup %s', 'tcd-issue'), $interview_label);
      }
      break;
    case 'blog_list' :
      $title = sprintf(__('%s list', 'tcd-issue'), $blog_label);
      break;
    case 'news_list' :
      if($options['use_news']){
        $title = sprintf(__('%s list', 'tcd-issue'), $news_label);
      } else {
        $title = __('(N/A) ', 'tcd-issue') . sprintf(__('%s list', 'tcd-issue'), $news_label);
      }
      break;
    case 'free_space' :
      $title = __( 'Free space', 'tcd-issue' );
      break;

  }

?>
<div class="js-contents-builder-item admin-contents-builder__item">
 <div class="admin-contents-builder__item-headline">
  <span class="admin-contents-builder__item-headline__handle c-icon js-contents-builder-handle">&#xe25d;</span>
  <label class="admin-contents-builder__item-headline__status">
   <input class="js-contents-builder-status" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][show_content]" type="checkbox" value="1" <?php checked( $values['show_content'] ?? 1, 1 ); ?> style="display:none;">
  </label>
  <h4 class="admin-contents-builder__item-headline__label"><?php echo $title; ?></h4>
  <p class="admin-contents-builder__item-headline__info js-contents-builder-item-label-target"><?php echo isset( $values['catch'] ) ? esc_html($values['catch']) : ''; ?></p>
  <span class="admin-contents-builder__item-headline__delete c-icon js-contents-builder-delete" data-alert-msg="<?php _e( 'Are you sure you want to delete this content?', 'tcd-issue' ); ?>">&#xe872;</span>
  <span class="admin-contents-builder__item-headline__arrow c-icon" style="margin-right:10px;">&#xe5cf;</span>
 </div>
 <div class="admin-contents-builder__item-content">
  <div class="admin-contents-builder__item-content__inner">
<?php

}

function admin_contents_builder_end(){

?>
   <ul class="button_list cf">
    <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
   </ul>
  </div>
 </div>
</div>
<?php
}


// バナー
function admin_contents_builder_banner( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'catch' => '',
    'catch_mobile' => '',
    'desc' => '',
    'desc_mobile' => '',
    'button_url' => '',
    'button_target' => '',
    'bg_type' => 'type1',
    'image' => '',
    'video' => '',
    'overlay_color' => '#000000',
    'overlay_opacity' => '0.3',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="banner">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/cb_banner2.jpg" width="" height="" />
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-issue'); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-issue'); ?></span><textarea class="js-contents-builder-item-label full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][catch]"><?php echo esc_textarea($values['catch']); ?></textarea></li>
    <li class="cf space"><span class="label"><?php _e('Catchphrase (mobile)', 'tcd-issue'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-issue' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][catch_mobile]"><?php echo esc_textarea( $values['catch_mobile'] ); ?></textarea></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-issue'); ?></span><textarea class="js-contents-builder-item-label full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php if(isset($values['desc'])){ echo esc_textarea($values['desc']); }; ?></textarea></li>
    <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-issue'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-issue' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php if(isset($values['desc_mobile'])){ echo esc_textarea( $values['desc_mobile'] ); }; ?></textarea></li>
    <li class="cf">
     <span class="label"><span class="num">3</span><?php _e('Link URL', 'tcd-issue'); ?></span>
     <div class="admin_link_option">
      <input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][button_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $values['button_url'] ); ?>">
      <input id="button_target<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][button_target]" type="checkbox" value="1" <?php checked( $values['button_target'], 1 ); ?>>
      <label for="button_target<?php echo $key; ?>">&#xe920;</label>
     </div>
    </li>
    <li class="cf space">
     <span class="label"><?php _e('Background type', 'tcd-issue'); ?></span>
     <div class="standard_radio_button">
      <input class="cb_banner_bg_type1" id="cb_banner_bg_type1_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][bg_type]" value="type1" <?php checked( $values['bg_type'], 'type1' ); ?>>
      <label for="cb_banner_bg_type1_<?php echo $key; ?>"><?php _e('Image', 'tcd-issue'); ?></label>
      <input class="cb_banner_bg_type2" id="cb_banner_bg_type2_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][bg_type]" value="type2" <?php checked( $values['bg_type'], 'type2' ); ?>>
      <label for="cb_banner_bg_type2_<?php echo $key; ?>"><?php _e('Video', 'tcd-issue'); ?></label>
     </div>
    </li>
    <li class="cf space cb_banner_image_option">
     <span class="label">
      <?php _e('Image', 'tcd-issue'); ?>
      <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '1450', '600'); ?></span>
     </span>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js image-<?php echo $key; ?>">
       <input type="hidden" class="cf_media_id" name="dp_options[contents_builder][<?php echo $key; ?>][image]" id="image-<?php echo $key; ?>" value="<?php echo esc_attr( $values['image'] ); ?>">
       <div class="preview_field"><?php if ( $values['image'] ) echo wp_get_attachment_image( $values['image'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-issue' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( empty($values['image']) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-issue'); ?>">
       </div>
      </div>
     </div>
    </li>
    <li class="cf space cb_banner_video_option" style="display:none;">
     <span class="label">
      <?php _e('Video', 'tcd-issue'); ?>
      <span class="recommend_desc"><?php _e('Please upload MP4 format file.', 'tcd-issue');  ?></span>
      <span class="recommend_desc"><?php _e('Recommended MP4 file size: 10 MB or less.<br>The screen ratio of the video is assumed to be 16:9.', 'tcd-issue'); ?></span>
     </span>
     <div class="video_option cf cf_media_field hide-if-no-js video-<?php echo $key; ?>">
      <input type="hidden" value="<?php if($values['video']) { echo esc_attr( $values['video'] ); }; ?>" id="video-<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][video]" class="cf_media_id">
      <div class="preview_field preview_field_video">
       <?php if($values['video']){ ?>
       <h4><?php _e( 'Uploaded MP4 file', 'tcd-issue' ); ?></h4>
       <p><?php echo esc_url(wp_get_attachment_url($values['video'])); ?></p>
       <?php }; ?>
      </div>
      <div class="buttton_area">
       <input type="button" value="<?php _e('Select MP4 file', 'tcd-issue'); ?>" class="cfmf-select-video button">
       <input type="button" value="<?php _e('Remove MP4 file', 'tcd-issue'); ?>" class="cfmf-delete-video button <?php if(!$values['video']){ echo 'hidden'; }; ?>">
      </div>
     </div>
    </li>
    <li class="cf space">
     <span class="label"><?php _e('Color of overlay', 'tcd-issue'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][overlay_color]" value="<?php echo esc_attr( $values['overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
    </li>
    <li class="cf space">
     <span class="label"><?php _e('Transparency of overlay', 'tcd-issue'); ?></span><input class="hankaku" style="width:70px;" type="number" step="0.1" min="0" max="1" name="dp_options[contents_builder][<?php echo $key; ?>][overlay_opacity]" value="<?php echo esc_attr( $values['overlay_opacity'] ); ?>" />
     <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
      <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-issue');  ?>
      <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-issue');  ?></p>
     </div>
    </li>
   </ul>

<?php
}


// スクロールコンテンツ
function admin_contents_builder_scroll_content( $key, $values ){

  if(empty($values)) {
    $values = array();
    for($i = 1; $i <= 3; $i++) {
      $values['headline'.$i] = '';
      $values['sub_title'.$i] = '';
      $values['catch'.$i] = '';
      $values['desc'.$i] = '';
      $values['desc_mobile'.$i] = '';
      $values['button_label'.$i] = '';
      $values['button_url'.$i] = '';
      $values['button_target'.$i] = '';
      $values['image'.$i] = '';
      $values['image_mobile'.$i] = '';
      $values['image2'.$i] = '';
      $values['overlay_color'.$i] = '#000000';
      $values['overlay_opacity'.$i] = '0.3';
      $values['bg_color'.$i] = '#000000';
      $values['content_type'.$i] = 'type1';
      $values['bg_type'.$i] = 'type1';
    }
  }

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="scroll_content">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/cb_scroll_content.jpg" width="" height="" />
   </div>

   <div class="tab_parent">

    <div class="sub_box_tab">
     <?php for($i = 1; $i <= 3; $i++) : ?>
     <div class="tab<?php if($i == 1){ echo ' active'; }; ?>" data-tab="tab<?php echo $i; ?>"><span class="label"><?php printf(__('Content%s', 'tcd-issue'), $i); ?></span></div>
     <?php endfor; ?>
    </div>

    <?php
        for($i = 1; $i <= 3; $i++) :
          $image2 = isset( $values['image2'.$i] ) ? $values['image2'.$i] : '';
          $button_target = isset( $values['button_target'.$i] ) ? $values['button_target'.$i] : '';
    ?>
    <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Content type', 'tcd-issue');  ?></span>
       <div class="option_list_image_radio_button">
        <div class="item">
         <input class="tcd_admin_image_radio_button sc_content_type1" id="sc_content_type1_<?php echo $key; ?>_<?php echo $i; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][content_type<?php echo $i; ?>]" value="type1" <?php checked( $values['content_type'.$i], 'type1' ); ?>>
         <label for="sc_content_type1_<?php echo $key; ?>_<?php echo $i; ?>">
          <span class="image_wrap"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/cb_scroll_content2.jpg" alt=""></span>
          <span class="title_wrap"><span class="title"><?php _e('TypeA', 'tcd-issue');  ?></span></span>
         </label>
        </div>
        <div class="item">
         <input class="tcd_admin_image_radio_button sc_content_type2" id="sc_content_type2_<?php echo $key; ?>_<?php echo $i; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][content_type<?php echo $i; ?>]" value="type2" <?php checked( $values['content_type'.$i], 'type2' ); ?>>
         <label for="sc_content_type2_<?php echo $key; ?>_<?php echo $i; ?>">
          <span class="image_wrap"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/cb_scroll_content2_type2.jpg?2.0" alt=""></span>
          <span class="title_wrap"><span class="title"><?php _e('TypeB', 'tcd-issue');  ?></span></span>
         </label>
        </div>
       </div>
      </li>
      <li class="cf sc_content_type1_option"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input type="text" class="tab_label full_width" name="dp_options[contents_builder][<?php echo $key; ?>][headline<?php echo $i; ?>]" value="<?php echo esc_attr($values['headline'.$i]); ?>" /></li>
      <li class="cf sc_content_type1_option"><span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title<?php echo $i; ?>]" value="<?php echo esc_attr($values['sub_title'.$i]); ?>" /></li>
      <li class="cf sc_content_type2_option" style="display:none;">
       <span class="label"><span class="num">1</span><?php _e('Circle image', 'tcd-issue'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '400', '400'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image2-<?php echo $key; ?>-<?php echo $i; ?>">
         <input type="hidden" class="cf_media_id" name="dp_options[contents_builder][<?php echo $key; ?>][image2<?php echo $i; ?>]" id="image2-<?php echo $key; ?>-<?php echo $i; ?>" value="<?php echo esc_attr($image2); ?>">
         <div class="preview_field"><?php if ($image2) echo wp_get_attachment_image( $image2, 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-issue' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if (empty($image2)) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-issue'); ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf"><span class="label"><span class="num sc_content_type1_option">3</span><span class="num sc_content_type2_option" style="display:none;">2</span><?php _e('Catchphrase', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[contents_builder][<?php echo $key; ?>][catch<?php echo $i; ?>]"><?php echo esc_textarea($values['catch'.$i]); ?></textarea></li>
      <li class="cf"><span class="label"><span class="num sc_content_type1_option">4</span><span class="num sc_content_type2_option" style="display:none;">3</span><?php _e('Description', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc<?php echo $i; ?>]"><?php echo esc_textarea($values['desc'.$i]); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile<?php echo $i; ?>]"><?php echo esc_textarea($values['desc_mobile'.$i]); ?></textarea></li>
      <li class="cf">
       <span class="label"><span class="num sc_content_type1_option">5</span><span class="num sc_content_type2_option" style="display:none;">4</span><?php _e('Button label', 'tcd-issue'); ?>
        <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-issue');  ?></span>
       </span>
       <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label<?php echo $i; ?>]" value="<?php echo esc_attr($values['button_label'.$i]); ?>" />
      </li>
      <li class="cf space">
       <span class="label"><?php _e('Button URL', 'tcd-issue'); ?></span>
       <div class="admin_link_option">
        <input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][button_url<?php echo $i; ?>]" placeholder="https://example.com/" value="<?php echo esc_attr( $values['button_url'.$i] ); ?>">
        <input id="button_target<?php echo $i; ?>_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][button_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $button_target, 1 ); ?>>
        <label for="button_target<?php echo $i; ?>_<?php echo $key; ?>">&#xe920;</label>
       </div>
      </li>
      <li class="cf">
       <span class="label"><span class="num sc_content_type1_option">6</span><span class="num sc_content_type2_option" style="display:none;">5</span><?php _e('Background', 'tcd-issue');  ?></span>
       <div class="standard_radio_button">
        <input class="sc_bg_type1" id="sc_bg_type1_<?php echo $key; ?>_<?php echo $i; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][bg_type<?php echo $i; ?>]" value="type1" <?php checked( $values['bg_type'.$i], 'type1' ); ?>>
        <label for="sc_bg_type1_<?php echo $key; ?>_<?php echo $i; ?>"><?php _e('Background image', 'tcd-issue'); ?></label>
        <input class="sc_bg_type2" id="sc_bg_type2_<?php echo $key; ?>_<?php echo $i; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][bg_type<?php echo $i; ?>]" value="type2" <?php checked( $values['bg_type'.$i], 'type2' ); ?>>
        <label for="sc_bg_type2_<?php echo $key; ?>_<?php echo $i; ?>"><?php _e('Background color', 'tcd-issue'); ?></label>
       </div>
      </li>
      <li class="cf space sc_bg_type1_option">
       <span class="label"><?php _e('Background image', 'tcd-issue'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '1740', '1320'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image-<?php echo $key; ?>-<?php echo $i; ?>">
         <input type="hidden" class="cf_media_id" name="dp_options[contents_builder][<?php echo $key; ?>][image<?php echo $i; ?>]" id="image-<?php echo $key; ?>-<?php echo $i; ?>" value="<?php echo esc_attr( $values['image'.$i] ); ?>">
         <div class="preview_field"><?php if ( $values['image'.$i] ) echo wp_get_attachment_image( $values['image'.$i], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-issue' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( empty($values['image'.$i]) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-issue'); ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf space sc_bg_type1_option">
       <span class="label"><?php _e('Background image (mobile)', 'tcd-issue'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '750', '1324'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image_mobile-<?php echo $key; ?>-<?php echo $i; ?>">
         <input type="hidden" class="cf_media_id" name="dp_options[contents_builder][<?php echo $key; ?>][image_mobile<?php echo $i; ?>]" id="image_mobile-<?php echo $key; ?>-<?php echo $i; ?>" value="<?php echo esc_attr( $values['image_mobile'.$i] ); ?>">
         <div class="preview_field"><?php if ( $values['image_mobile'.$i] ) echo wp_get_attachment_image( $values['image_mobile'.$i], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-issue' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( empty($values['image_mobile'.$i]) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-issue'); ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf space sc_bg_type1_option">
       <span class="label"><?php _e('Color of overlay', 'tcd-issue'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][overlay_color<?php echo $i; ?>]" value="<?php echo esc_attr( $values['overlay_color'.$i] ); ?>" data-default-color="#000000" class="c-color-picker">
      </li>
      <li class="cf space sc_bg_type1_option">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-issue'); ?></span><input class="hankaku" style="width:70px;" type="number" step="0.1" min="0" max="1" name="dp_options[contents_builder][<?php echo $key; ?>][overlay_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $values['overlay_opacity'.$i] ); ?>" />
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
        <input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][bg_color<?php echo $i; ?>]" value="<?php echo esc_attr( $values['bg_color'.$i] ); ?>" data-default-color="#000000" class="c-color-picker js-color-preset-target--main">
       </div>
      </li>
     </ul>

    </div><!-- END .sub_box_tab_content -->
    <?php endfor; ?>

   </div>

<?php
}


// スタッフ一覧
function admin_contents_builder_staff_list( $key, $values ){

  $options = get_design_plus_option();
  $staff_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Staff', 'tcd-issue' );

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'button_label' => '',
    'post_num' => '6',
    'post_num_sp' => '6',
    'post_type' => 'all_post',
    'post_order' => 'menu_order',
    'post_order_custom' => '',
    'category_id' => '',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="staff_list">

   <div class="cb_image">
    <img class="cb_staff_list_type1_option" style="<?php if($options['staff_design_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>" src="<?php bloginfo('template_url'); ?>/admin/img/image/cb_staff_list_type1_2.jpg?2.0" width="" height="" />
    <img class="cb_staff_list_type2_option" style="<?php if($options['staff_design_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>" src="<?php bloginfo('template_url'); ?>/admin/img/image/cb_staff_list_type2_2.jpg?2.0" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php printf(__('Displays content created with the custom post type "<a href="./edit.php?post_type=staff" target="_blank">%s</a>" by carousel.', 'tcd-issue'), $staff_label); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-issue');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input type="text" class="js-contents-builder-item-label full_width" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-issue'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-issue'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
   </ul>


   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-issue');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Post type', 'tcd-issue');  ?></span>
     <select class="post_list_type" name="dp_options[contents_builder][<?php echo $key; ?>][post_type]">
      <option style="padding-right: 10px;" value="all_post" <?php selected( $values['post_type'], 'all_post' ); ?>><?php _e('All post', 'tcd-issue'); ?></option>
      <option style="padding-right: 10px;" value="category_post" <?php selected( $values['post_type'], 'category_post' ); ?>><?php _e('Category post', 'tcd-issue'); ?></option>
      <option style="padding-right: 10px;" value="recommend_post" <?php selected( $values['post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>1</option>
      <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $values['post_type'], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>2</option>
      <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $values['post_type'], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>3</option>
      <option style="padding-right: 10px;" value="custom" <?php selected( $values['post_type'], 'custom' ); ?>><?php _e('Custom', 'tcd-issue'); ?></option>
     </select>
    </li>
    <li class="cf post_list_type_category_option" style="display:none">
     <span class="label"><?php _e('Category', 'tcd-issue'); ?></span>
     <?php
          $category_list = get_terms( 'staff_category', array( 'orderby' => 'order', 'hide_empty' => true ) );
          if ( $category_list && ! is_wp_error( $category_list ) ) {
            $selected_value = $values['category_id'];
            wp_dropdown_categories( array(
             'taxonomy' => 'staff_category',
             'class' => 'staff_category',
             'hierarchical' => true,
             'id' => '',
             'name' => 'dp_options[contents_builder][' . $key . '][category_id]',
             'selected' => $selected_value,
             'value_field' => 'term_id'
            ) );
          } else {
     ?>
     <p><?php _e('No category is registered', 'tcd-issue');  ?></p>
     <?php }; ?>
    </li>
    <li class="cf post_list_type_normal_option">
     <span class="label"><?php _e('Number of post to display', 'tcd-issue'); ?></span>
     <div class="display_post_num_option">
      <label for="cb_staff_list_post_num_<?php echo $key; ?>"><input type="number" id="cb_staff_list_post_num_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num]" value="<?php echo esc_attr($values['post_num']); ?>"><span class="icon icon_pc"></span></label>
      <label for="cb_staff_list_post_num_sp_<?php echo $key; ?>"><input type="number" id="cb_staff_list_post_num_sp_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num_sp]" value="<?php echo esc_attr($values['post_num_sp']); ?>"><span class="icon icon_sp"></span></label>
     </div>
    </li>
    <li class="cf post_list_type_normal_option">
     <span class="label"><?php _e('Post order', 'tcd-issue');  ?></span>
     <div class="standard_radio_button">
      <input id="cb_staff_list_post_order_date_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="menu_order" <?php checked( $values['post_order'], 'menu_order' ); ?>>
      <label for="cb_staff_list_post_order_date_<?php echo $key; ?>"><?php _e('Order specified in the admin screen', 'tcd-issue'); ?></label>
      <input id="cb_staff_list_post_order_rand_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="rand" <?php checked( $values['post_order'], 'rand' ); ?>>
      <label for="cb_staff_list_post_order_rand_<?php echo $key; ?>"><?php _e('Random', 'tcd-issue'); ?></label>
     </div>
    </li>
    <li class="cf post_list_type_custom_option" style="display:none;">
     <span class="label"><?php _e('ID of the article you want to display', 'tcd-issue');  ?><span class="recommend_desc"><?php _e('Enter article IDs separated by commas.<br>The ID can be found in the administration screen.<br><a href="https://tcd-theme.com/2017/01/check_pageid_categoryid.html#tcd_id" target="_blank">Click here to see the ID display section of the TCD theme.</a>', 'tcd-issue'); ?></span></span>
     <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-issue' ); ?>1,3,10" class="full_width hankaku" name="dp_options[contents_builder][<?php echo $key; ?>][post_order_custom]" value="<?php echo esc_attr($values['post_order_custom']); ?>">
    </li>
   </ul>

<?php
}


// インタビュー一覧
function admin_contents_builder_interview_list( $key, $values ){

  $options = get_design_plus_option();
  $interview_label = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Conversation', 'tcd-issue' );

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'button_label' => '',
    'post_num' => '6',
    'post_num_sp' => '6',
    'post_type' => 'all_post',
    'post_order' => 'menu_order',
    'post_order_custom' => '',
    'category_id' => '',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="interview_list">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/cb_interview_list2.jpg?2.0" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php printf(__('Displays content created with the custom post type "<a href="./edit.php?post_type=interview" target="_blank">%s</a>" by carousel.', 'tcd-issue'), $interview_label); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-issue');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input type="text" class="js-contents-builder-item-label full_width" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-issue'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-issue'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-issue');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Post type', 'tcd-issue');  ?></span>
     <select class="post_list_type" name="dp_options[contents_builder][<?php echo $key; ?>][post_type]">
      <option style="padding-right: 10px;" value="all_post" <?php selected( $values['post_type'], 'all_post' ); ?>><?php _e('All post', 'tcd-issue'); ?></option>
      <option style="padding-right: 10px;" value="category_post" <?php selected( $values['post_type'], 'category_post' ); ?>><?php _e('Category post', 'tcd-issue'); ?></option>
      <option style="padding-right: 10px;" value="recommend_post" <?php selected( $values['post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>1</option>
      <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $values['post_type'], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>2</option>
      <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $values['post_type'], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>3</option>
      <option style="padding-right: 10px;" value="custom" <?php selected( $values['post_type'], 'custom' ); ?>><?php _e('Custom', 'tcd-issue'); ?></option>
     </select>
    </li>
    <li class="cf post_list_type_category_option" style="display:none">
     <span class="label"><?php _e('Category', 'tcd-issue'); ?></span>
     <?php
          $category_list = get_terms( 'interview_category', array( 'orderby' => 'order', 'hide_empty' => true ) );
          if ( $category_list && ! is_wp_error( $category_list ) ) {
            $selected_value = $values['category_id'];
            wp_dropdown_categories( array(
             'taxonomy' => 'interview_category',
             'class' => 'interview_category',
             'hierarchical' => true,
             'id' => '',
             'name' => 'dp_options[contents_builder][' . $key . '][category_id]',
             'selected' => $selected_value,
             'value_field' => 'term_id'
            ) );
          } else {
     ?>
     <p><?php _e('No category is registered', 'tcd-issue');  ?></p>
     <?php }; ?>
    </li>
    <li class="cf post_list_type_normal_option">
     <span class="label"><?php _e('Number of post to display', 'tcd-issue'); ?></span>
     <div class="display_post_num_option">
      <label for="cb_interview_list_post_num_<?php echo $key; ?>"><input type="number" id="cb_interview_list_post_num_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num]" value="<?php echo esc_attr($values['post_num']); ?>"><span class="icon icon_pc"></span></label>
      <label for="cb_interivew_list_post_num_sp_<?php echo $key; ?>"><input type="number" id="cb_interview_list_post_num_sp_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num_sp]" value="<?php echo esc_attr($values['post_num_sp']); ?>"><span class="icon icon_sp"></span></label>
     </div>
    </li>
    <li class="cf post_list_type_normal_option">
     <span class="label"><?php _e('Post order', 'tcd-issue');  ?></span>
     <div class="standard_radio_button">
      <input id="cb_interview_list_post_order_date_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="menu_order" <?php checked( $values['post_order'], 'menu_order' ); ?>>
      <label for="cb_interview_list_post_order_date_<?php echo $key; ?>"><?php _e('Order specified in the admin screen', 'tcd-issue'); ?></label>
      <input id="cb_interview_list_post_order_rand_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="rand" <?php checked( $values['post_order'], 'rand' ); ?>>
      <label for="cb_interview_list_post_order_rand_<?php echo $key; ?>"><?php _e('Random', 'tcd-issue'); ?></label>
     </div>
    </li>
    <li class="cf post_list_type_custom_option" style="display:none;">
     <span class="label"><?php _e('ID of the article you want to display', 'tcd-issue');  ?><span class="recommend_desc"><?php _e('Please enter post ids by comma separated.', 'tcd-issue'); ?></span></span>
     <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-issue' ); ?>1,3,10" class="full_width hankaku" name="dp_options[contents_builder][<?php echo $key; ?>][post_order_custom]" value="<?php echo esc_attr($values['post_order_custom']); ?>">
    </li>
   </ul>

<?php
}


// ブログ一覧
function admin_contents_builder_blog_list( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'button_label' => '',
    'post_num' => '6',
    'post_num_sp' => '6',
    'post_type' => 'all_post',
    'post_order' => 'date',
    'post_order_custom' => '',
    'category_id' => '',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="blog_list">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/cb_blog_list2.jpg?2.0" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php _e('Display <a href="./edit.php?post_type=post" target="_blank">post article</a> by carousel.', 'tcd-issue'); ?></p>
   </div>


   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-issue');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input type="text" class="js-contents-builder-item-label full_width" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-issue'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-issue'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-issue');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Post type', 'tcd-issue');  ?></span>
     <select class="post_list_type" name="dp_options[contents_builder][<?php echo $key; ?>][post_type]">
      <option style="padding-right: 10px;" value="all_post" <?php selected( $values['post_type'], 'all_post' ); ?>><?php _e('All post', 'tcd-issue'); ?></option>
      <option style="padding-right: 10px;" value="category_post" <?php selected( $values['post_type'], 'category_post' ); ?>><?php _e('Category post', 'tcd-issue'); ?></option>
      <option style="padding-right: 10px;" value="recommend_post" <?php selected( $values['post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>1</option>
      <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $values['post_type'], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>2</option>
      <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $values['post_type'], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>3</option>
      <option style="padding-right: 10px;" value="custom" <?php selected( $values['post_type'], 'custom' ); ?>><?php _e('Custom', 'tcd-issue'); ?></option>
     </select>
    </li>
    <li class="cf post_list_type_category_option" style="display:none">
     <span class="label"><?php _e('Category', 'tcd-issue'); ?></span>
     <?php
          $category_list = get_terms( 'category', array( 'orderby' => 'order', 'hide_empty' => true ) );
          if ( $category_list && ! is_wp_error( $category_list ) ) {
            $selected_value = $values['category_id'];
            wp_dropdown_categories( array(
             'taxonomy' => 'category',
             'class' => 'category',
             'hierarchical' => true,
             'id' => '',
             'name' => 'dp_options[contents_builder][' . $key . '][category_id]',
             'selected' => $selected_value,
             'value_field' => 'term_id'
            ) );
          } else {
     ?>
     <p><?php _e('No category is registered', 'tcd-issue');  ?></p>
     <?php }; ?>
    </li>
    <li class="cf post_list_type_normal_option">
     <span class="label"><?php _e('Number of post to display', 'tcd-issue'); ?></span>
     <div class="display_post_num_option">
      <label for="cb_post_list_post_num_<?php echo $key; ?>"><input type="number" id="cb_post_list_post_num_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num]" value="<?php echo esc_attr($values['post_num']); ?>"><span class="icon icon_pc"></span></label>
      <label for="cb_post_list_post_num_sp_<?php echo $key; ?>"><input type="number" id="cb_post_list_post_num_sp_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num_sp]" value="<?php echo esc_attr($values['post_num_sp']); ?>"><span class="icon icon_sp"></span></label>
     </div>
    </li>
    <li class="cf post_list_type_normal_option">
     <span class="label"><?php _e('Post order', 'tcd-issue');  ?></span>
     <div class="standard_radio_button">
      <input id="carousel_post_order_date_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="date" <?php checked( $values['post_order'], 'date' ); ?>>
      <label for="carousel_post_order_date_<?php echo $key; ?>"><?php _e('Date', 'tcd-issue'); ?></label>
      <input id="carousel_post_order_rand_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="rand" <?php checked( $values['post_order'], 'rand' ); ?>>
      <label for="carousel_post_order_rand_<?php echo $key; ?>"><?php _e('Random', 'tcd-issue'); ?></label>
     </div>
    </li>
    <li class="cf post_list_type_custom_option" style="display:none;">
     <span class="label"><?php _e('ID of the article you want to display', 'tcd-issue');  ?><span class="recommend_desc"><?php _e('Enter article IDs separated by commas.<br>The ID can be found in the administration screen.<br><a href="https://tcd-theme.com/2017/01/check_pageid_categoryid.html#tcd_id" target="_blank">Click here to see the ID display section of the TCD theme.</a>', 'tcd-issue'); ?></span></span>
     <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-issue' ); ?>1,3,10" class="full_width hankaku" name="dp_options[contents_builder][<?php echo $key; ?>][post_order_custom]" value="<?php echo esc_attr($values['post_order_custom']); ?>">
    </li>
   </ul>

<?php
}

// お知らせ一覧
function admin_contents_builder_news_list( $key, $values ){

  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-issue' );

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'button_label' => '',
    'post_num' => '6',
    'post_num_sp' => '6',
    'post_type' => 'all_post',
    'post_order' => 'date',
    'post_order_custom' => '',
    'category_id' => '',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="news_list">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/cb_news_list2.jpg?2.0" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php printf(__('Displays content created with the custom post type "<a href="./edit.php?post_type=news" target="_blank">%s</a>" by carousel.', 'tcd-issue'), $news_label); ?><br>
    <?php _e('If you set the eye-catcher to "Do not display" from "Notices > Common Settings", you can change the display to a single column, vertically aligned.', 'tcd-issue'); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-issue');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input type="text" class="js-contents-builder-item-label full_width" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-issue'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-issue'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-issue');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Post type', 'tcd-issue');  ?></span>
     <select class="post_list_type" name="dp_options[contents_builder][<?php echo $key; ?>][post_type]">
      <option style="padding-right: 10px;" value="all_post" <?php selected( $values['post_type'], 'all_post' ); ?>><?php _e('All post', 'tcd-issue'); ?></option>
      <option style="padding-right: 10px;" value="category_post" <?php selected( $values['post_type'], 'category_post' ); ?>><?php _e('Category post', 'tcd-issue'); ?></option>
      <option style="padding-right: 10px;" value="recommend_post" <?php selected( $values['post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>1</option>
      <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $values['post_type'], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>2</option>
      <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $values['post_type'], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>3</option>
      <option style="padding-right: 10px;" value="custom" <?php selected( $values['post_type'], 'custom' ); ?>><?php _e('Custom', 'tcd-issue'); ?></option>
     </select>
    </li>
    <li class="cf post_list_type_category_option" style="display:none">
     <span class="label"><?php _e('Category', 'tcd-issue'); ?></span>
     <?php
          $category_list = get_terms( 'news_category', array( 'orderby' => 'order', 'hide_empty' => true ) );
          if ( $category_list && ! is_wp_error( $category_list ) ) {
            $selected_value = $values['category_id'];
            wp_dropdown_categories( array(
             'taxonomy' => 'news_category',
             'class' => 'category',
             'hierarchical' => true,
             'id' => '',
             'name' => 'dp_options[contents_builder][' . $key . '][category_id]',
             'selected' => $selected_value,
             'value_field' => 'term_id'
            ) );
          } else {
     ?>
     <p><?php _e('No category is registered', 'tcd-issue');  ?></p>
     <?php }; ?>
    </li>
    <li class="cf post_list_type_normal_option">
     <span class="label"><?php _e('Number of post to display', 'tcd-issue'); ?></span>
     <div class="display_post_num_option">
      <label for="cb_news_list_post_num_<?php echo $key; ?>"><input type="number" id="cb_news_list_post_num_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num]" value="<?php echo esc_attr($values['post_num']); ?>"><span class="icon icon_pc"></span></label>
      <label for="cb_news_list_post_num_sp_<?php echo $key; ?>"><input type="number" id="cb_news_list_post_num_sp_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num_sp]" value="<?php echo esc_attr($values['post_num_sp']); ?>"><span class="icon icon_sp"></span></label>
     </div>
    </li>
    <li class="cf post_list_type_normal_option">
     <span class="label"><?php _e('Post order', 'tcd-issue');  ?></span>
     <div class="standard_radio_button">
      <input id="carousel_news_order_date_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="date" <?php checked( $values['post_order'], 'date' ); ?>>
      <label for="carousel_news_order_date_<?php echo $key; ?>"><?php _e('Date', 'tcd-issue'); ?></label>
      <input id="carousel_news_order_rand_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="rand" <?php checked( $values['post_order'], 'rand' ); ?>>
      <label for="carousel_news_order_rand_<?php echo $key; ?>"><?php _e('Random', 'tcd-issue'); ?></label>
     </div>
    </li>
    <li class="cf post_list_type_custom_option" style="display:none;">
     <span class="label"><?php _e('ID of the article you want to display', 'tcd-issue');  ?><span class="recommend_desc"><?php _e('Please enter post ids by comma separated.', 'tcd-issue'); ?></span></span>
     <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-issue' ); ?>1,3,10" class="full_width hankaku" name="dp_options[contents_builder][<?php echo $key; ?>][post_order_custom]" value="<?php echo esc_attr($values['post_order_custom']); ?>">
    </li>
   </ul>

<?php
}


// フリースペース
function admin_contents_builder_free_space( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'free_space' => '',
    'content_width' => 'type1',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="free_space">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/cb_free_space2.jpg" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php _e('You can create free content using the WordPress Classic Editor.', 'tcd-issue'); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-issue'); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input type="text" class="js-contents-builder-item-label full_width" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf">
     <span class="label"><span class="num">3</span><?php _e('Content width', 'tcd-issue'); ?></span>
     <div class="standard_radio_button">
      <input id="cb_content_width_type1_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][content_width]" value="type1" <?php checked( $values['content_width'], 'type1' ); ?>>
      <label for="cb_content_width_type1_<?php echo $key; ?>">800px</label>
      <input id="cb_content_width_type2_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][content_width]" value="type2" <?php checked( $values['content_width'], 'type2' ); ?>>
      <label for="cb_content_width_type2_<?php echo $key; ?>"><?php _e('Full size', 'tcd-issue'); ?></label>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Content', 'tcd-issue');  ?></h4>
   <?php
        wp_editor(
          $values['free_space'],
          'cb_wysiwyg_editor-' . $key,
          array (
            'textarea_name' => 'dp_options[contents_builder][' . $key . '][free_space]',
            //'editor_class' => 'js-contents-builder-item-label'
          )
       );
   ?>

<?php
}

?>