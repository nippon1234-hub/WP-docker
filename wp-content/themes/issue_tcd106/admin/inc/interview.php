<?php
/*
 * インタビューの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_interview_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_interview_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_interview_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_interview_theme_options_validate' );


// タブの名前
function add_interview_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  if($options['use_interview']){
    $tab_label = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Conversation', 'tcd-issue' );
  } else {
    $title = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Conversation', 'tcd-issue' );
    $tab_label = __('(N/A) ', 'tcd-issue') . $title;
  }
  $tab_labels['interview'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_interview_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['use_interview'] = '1';
	$dp_default_options['interview_label'] = __( 'Conversation', 'tcd-issue' );
	$dp_default_options['interview_slug'] = 'interview';

	// アーカイブページ
	$dp_default_options['archive_interview_headline'] = 'INTERVIEW';
	$dp_default_options['archive_interview_sub_title'] = __( 'Conversation', 'tcd-issue' );
	$dp_default_options['archive_interview_desc'] = __( 'Description will be displayed here.', 'tcd-issue' );
	$dp_default_options['archive_interview_desc_mobile'] = '';

	$dp_default_options['archive_interview_num'] = '3';
	$dp_default_options['archive_interview_num_sp'] = '3';

	$dp_default_options['interview_category_type'] = 'type1';

	// 詳細ページ
	$dp_default_options['interview_title_font_size'] = '32';
	$dp_default_options['interview_title_font_size_sp'] = '20';
	$dp_default_options['interview_show_date'] = 'display';
	$dp_default_options['single_interview_show_mod_date'] = 'display';
	$dp_default_options['interview_header_overlay_color'] = '#000000';
	$dp_default_options['interview_header_overlay_opacity'] = '0.2';

	$dp_default_options['related_interview_headline1'] = __( 'Related article', 'tcd-issue' );
	$dp_default_options['related_interview_headline2'] = '';
	$dp_default_options['related_interview_headline3'] = '';
	for ( $i = 1; $i <= 3; $i++ ) {
	$dp_default_options['related_interview_post_type'.$i] = 'all_post';
	$dp_default_options['related_interview_post_order'.$i] = 'rand';
	$dp_default_options['related_interview_post_order_custom'.$i] = '';
	$dp_default_options['related_interview_num'.$i] = '4';
	$dp_default_options['related_interview_num'.$i.'_sp'] = '4';
  }

	// 記事ページの追加コンテンツ
	$dp_default_options['single_interview_top_ad_code'] = '';
	$dp_default_options['single_interview_top_ad_code_mobile'] = '';
	$dp_default_options['single_interview_bottom_ad_code'] = '';
	$dp_default_options['single_interview_bottom_ad_code_mobile'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_interview_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $basic_display_options, $interview_category_type_options;
  $interview_label = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Conversation', 'tcd-issue' );

?>

<div id="tab-content-interview" class="tab-content">


   <?php // 有効化 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac active open custon_post_usage_option">
    <h3 class="theme_option_headline"><?php _e('Validation', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2 custon_post_usage_option_message" style="<?php if($options['use_interview']){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <p><?php printf(__('Currently, all function related to custom post "%s" have been disabled.<br>All areas that have already been set up will be hidden from the site.<br>Please use this option only if you don\'t want to use the custom post "%s" at all. (No archive page will be generated either).', 'tcd-issue'), $interview_label, $interview_label); ?></p>
     </div>
     <div class="theme_option_message2" style="<?php if($options['use_interview']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <p><?php printf(__('Please check off the checkbox if you don\'t want to use custom post "%s".', 'tcd-issue'), $interview_label); ?></p>
     </div>
     <p><label><input class="custon_post_usage_option_checkbox" name="dp_options[use_interview]" type="checkbox" value="1" <?php checked( 1, $options['use_interview'] ); ?>><?php printf(__('Use custom post "%s"', 'tcd-issue'), $interview_label); ?></label></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/content_name_url.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e('Name of content', 'tcd-issue'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-issue'); ?></p>
     </div>
     <input type="text" name="dp_options[interview_label]" value="<?php echo esc_attr( $options['interview_label'] ); ?>" />

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-issue'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-issue'); ?></p>
     </div>
     <p><input class="hankaku" type="text" name="dp_options[interview_slug]" value="<?php echo sanitize_title( $options['interview_slug'] ); ?>" /></p>

     <h4 class="theme_option_headline2"><?php _e('Date', 'tcd-issue');  ?></h4>
     <div class="clearfix"><?php echo tcd_basic_radio_button($options, 'interview_show_date', $basic_display_options); ?></div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-issue'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/interview_archive.jpg" alt="" title="" />
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[archive_interview_headline]" value="<?php echo esc_attr($options['archive_interview_headline']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[archive_interview_sub_title]" value="<?php echo esc_attr($options['archive_interview_sub_title']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Description', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_interview_desc]"><?php echo esc_textarea(  $options['archive_interview_desc'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-issue'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-issue' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_interview_desc_mobile]"><?php echo esc_textarea(  $options['archive_interview_desc_mobile'] ); ?></textarea></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Category list', 'tcd-issue'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please select TypeB if you have many categories.', 'tcd-issue'); ?></p>
     </div>
     <?php echo tcd_admin_image_radio_button($options, 'interview_category_type', $interview_category_type_options) ?>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-issue'), $interview_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'archive_interview_num'); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-issue'), $interview_label); ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/interview_main.jpg?4.0" alt="" title="" />
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Font size of title', 'tcd-issue'); ?></span><?php echo tcd_font_size_option($options, 'interview_title_font_size'); ?></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Modified date', 'tcd-issue');  ?></span><?php echo tcd_basic_radio_button($options, 'single_interview_show_mod_date', $basic_display_options); ?></li>
      <li class="cf">
       <span class="label"><span class="num">3</span><?php _e('Color of overlay', 'tcd-issue'); ?></span><input type="text" name="dp_options[interview_header_overlay_color]" value="<?php echo esc_attr( $options['interview_header_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
      </li>
      <li class="cf space">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-issue'); ?></span><input class="hankaku" style="width:70px;" type="number" step="0.1" min="0" max="1" name="dp_options[interview_header_overlay_opacity]" value="<?php echo esc_attr( $options['interview_header_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-issue');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-issue');  ?></p>
       </div>
      </li>
     </ul>

     <?php // 関連記事 ------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php printf(__('%s article carousel', 'tcd-issue'), $interview_label); ?></h4>

     <div class="front_page_image middle">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/interview_related.jpg" alt="" title="" />
     </div>

     <div class="theme_option_message2">
      <p><?php _e('Up to three types of article carousels can be displayed at the bottom of the page. A carousel with no headline will be hidden.', 'tcd-issue'); ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><span class="label"><?php _e('First line carousel', 'tcd-issue'); ?></span></div>
      <div class="tab" data-tab="tab2"><span class="label"><?php _e('Second line carousel', 'tcd-issue'); ?></span></div>
      <div class="tab" data-tab="tab3"><span class="label"><?php _e('Third line carousel', 'tcd-issue'); ?></span></div>
     </div>

     <?php for($i = 1; $i <= 3; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue');  ?></span><input class="full_width" type="text" placeholder="<?php _e( 'e.g.', 'tcd-issue' ); _e('Related article', 'tcd-issue'); ?>" name="dp_options[related_interview_headline<?php echo $i; ?>]" value="<?php echo esc_textarea(  $options['related_interview_headline'.$i] ); ?>" /></li>
      <li class="cf">
       <span class="label"><span class="num">2</span><?php _e('Post type', 'tcd-issue');  ?></span>
       <select class="post_list_type" name="dp_options[related_interview_post_type<?php echo $i; ?>]">
        <option style="padding-right: 10px;" value="all_post" <?php selected( $options['related_interview_post_type'.$i], 'all_post' ); ?>><?php _e('All post', 'tcd-issue'); ?></option>
        <option style="padding-right: 10px;" value="category_post" <?php selected( $options['related_interview_post_type'.$i], 'category_post' ); ?>><?php _e('Same category post', 'tcd-issue'); ?></option>
        <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['related_interview_post_type'.$i], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>1</option>
        <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $options['related_interview_post_type'.$i], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>2</option>
        <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $options['related_interview_post_type'.$i], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>3</option>
        <option style="padding-right: 10px;" value="custom" <?php selected( $options['related_interview_post_type'.$i], 'custom' ); ?>><?php _e('Custom', 'tcd-issue'); ?></option>
       </select>
      </li>
      <li class="cf space post_list_type_normal_option"><span class="label"><?php _e('Number of post to display', 'tcd-issue'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'related_interview_num'.$i); ?></li>
      <li class="cf space post_list_type_normal_option">
       <span class="label"><?php _e('Post order', 'tcd-issue');  ?></span>
       <div class="standard_radio_button">
        <input id="related_interview_post_order_date<?php echo $i; ?>" type="radio" name="dp_options[related_interview_post_order<?php echo $i; ?>]" value="menu_order" <?php checked( $options['related_interview_post_order'.$i], 'menu_order' ); ?>>
        <label for="related_interview_post_order_date<?php echo $i; ?>"><?php _e('Order specified in the admin screen', 'tcd-issue'); ?></label>
        <input id="related_interview_post_order_rand<?php echo $i; ?>" type="radio" name="dp_options[related_interview_post_order<?php echo $i; ?>]" value="rand" <?php checked( $options['related_interview_post_order'.$i], 'rand' ); ?>>
        <label for="related_interview_post_order_rand<?php echo $i; ?>"><?php _e('Random', 'tcd-issue'); ?></label>
       </div>
      </li>
      <li class="cf space post_list_type_custom_option">
       <span class="label"><?php _e('ID of the article you want to display', 'tcd-issue');  ?><span class="recommend_desc"><?php _e('Enter article IDs separated by commas.<br>The ID can be found in the administration screen.<br><a href="https://tcd-theme.com/2017/01/check_pageid_categoryid.html#tcd_id" target="_blank">Click here to see the ID display section of the TCD theme.</a>', 'tcd-issue'); ?></span></span>
       <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-issue' ); ?>1,3,10" class="full_width hankaku" name="dp_options[related_interview_post_order_custom<?php echo $i; ?>]" value="<?php echo esc_attr($options['related_interview_post_order_custom'.$i]); ?>">
      </li>
     </ul>

     </div><!-- END .sub_box_tab_content -->
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 追加コンテンツ -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Additional content', 'tcd-issue'); ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('Additional content can be placed above and below all articles. HTML can also be used, so please use it for affiliates as well.', 'tcd-issue');  ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><span class="label"><?php _e('Above main content', 'tcd-issue'); ?></span></div>
      <div class="tab" data-tab="tab2"><span class="label"><?php _e('Below main content', 'tcd-issue'); ?></span></div>
     </div>

     <?php // メインコンテンツの上部 ----------------------- ?>
     <div class="sub_box_tab_content active" data-tab-content="tab1">

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (PC)', 'tcd-issue');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in PC only.', 'tcd-issue');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_interview_top_ad_code]"><?php echo esc_textarea( $options['single_interview_top_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-issue');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-issue');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_interview_top_ad_code_mobile]"><?php echo esc_textarea( $options['single_interview_top_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // メインコンテンツの下部 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (PC)', 'tcd-issue');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in PC only.', 'tcd-issue');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_interview_bottom_ad_code]"><?php echo esc_textarea( $options['single_interview_bottom_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-issue');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-issue');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_interview_bottom_ad_code_mobile]"><?php echo esc_textarea( $options['single_interview_bottom_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_interview_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_interview_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options;

  //基本設定
  $input['use_interview'] = wp_filter_nohtml_kses( $input['use_interview'] );
  $input['interview_slug'] = sanitize_title( $input['interview_slug'] );
  $input['interview_label'] = wp_filter_nohtml_kses( $input['interview_label'] );

  // アーカイブ
  $input['archive_interview_headline'] = wp_filter_nohtml_kses( $input['archive_interview_headline'] );
  $input['archive_interview_sub_title'] = wp_filter_nohtml_kses( $input['archive_interview_sub_title'] );
  $input['archive_interview_desc'] = wp_kses_post( $input['archive_interview_desc'] );
  $input['archive_interview_desc_mobile'] = wp_kses_post( $input['archive_interview_desc_mobile'] );

  $input['interview_category_type'] = wp_kses_post( $input['interview_category_type'] );

  $input['archive_interview_num'] = wp_filter_nohtml_kses( $input['archive_interview_num'] );
  $input['archive_interview_num_sp'] = wp_filter_nohtml_kses( $input['archive_interview_num_sp'] );


  //詳細ページ
  $input['interview_title_font_size'] = wp_filter_nohtml_kses( $input['interview_title_font_size'] );
  $input['interview_title_font_size_sp'] = wp_filter_nohtml_kses( $input['interview_title_font_size_sp'] );
  $input['interview_show_date'] = wp_filter_nohtml_kses( $input['interview_show_date'] );
  $input['single_interview_show_mod_date'] = wp_filter_nohtml_kses( $input['single_interview_show_mod_date'] );
  $input['interview_header_overlay_color'] = wp_filter_nohtml_kses( $input['interview_header_overlay_color'] );
  $input['interview_header_overlay_opacity'] = wp_filter_nohtml_kses( $input['interview_header_overlay_opacity'] );

	for ( $i = 1; $i <= 3; $i++ ) {
  $input['related_interview_headline'.$i] = wp_filter_nohtml_kses( $input['related_interview_headline'.$i] );
  $input['related_interview_num'.$i] = wp_filter_nohtml_kses( $input['related_interview_num'.$i] );
  $input['related_interview_num'.$i.'_sp'] = wp_filter_nohtml_kses( $input['related_interview_num'.$i.'_sp'] );
  $input['related_interview_post_type'.$i] = wp_filter_nohtml_kses( $input['related_interview_post_type'.$i] );
  $input['related_interview_post_order'.$i] = wp_filter_nohtml_kses( $input['related_interview_post_order'.$i] );
  $input['related_interview_post_order_custom'.$i] = wp_filter_nohtml_kses( $input['related_interview_post_order_custom'.$i] );
  }


  // 記事ページの追加コンテンツ
  $input['single_interview_top_ad_code'] = $input['single_interview_top_ad_code'];
  $input['single_interview_top_ad_code_mobile'] = $input['single_interview_top_ad_code_mobile'];
  $input['single_interview_bottom_ad_code'] = $input['single_interview_bottom_ad_code'];
  $input['single_interview_bottom_ad_code_mobile'] = $input['single_interview_bottom_ad_code_mobile'];


	return $input;

};


?>