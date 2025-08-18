<?php
/*
 * お知らせの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_news_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );


// タブの名前
function add_news_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  if($options['use_news']){
    $tab_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-issue' );
  } else {
    $title = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-issue' );
    $tab_label = __('(N/A) ', 'tcd-issue') . $title;
  }
  $tab_labels['news'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_news_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['use_news'] = '1';
	$dp_default_options['news_label'] = __( 'News', 'tcd-issue' );
	$dp_default_options['news_slug'] = 'news';
	$dp_default_options['news_show_image'] = 'display';
  $dp_default_options['news_show_category'] = 'display';

	// アーカイブページ
	$dp_default_options['archive_news_headline'] = 'NEWS';
	$dp_default_options['archive_news_sub_title'] = __( 'News', 'tcd-issue' );
	$dp_default_options['archive_news_desc'] = __( 'Description will be displayed here.', 'tcd-issue' );
	$dp_default_options['archive_news_desc_mobile'] = '';

	$dp_default_options['archive_news_num'] = '5';
	$dp_default_options['archive_news_num_sp'] = '5';
  $dp_default_options['archive_news_show_category_list'] = 'display';

	// 詳細ページ
	$dp_default_options['single_news_show_sns'] = 'top';
	$dp_default_options['single_news_show_copy'] = 'top';
	$dp_default_options['single_news_show_mod_date'] = 'display';
  $dp_default_options['single_news_sidebar_pos'] = 'right';

	// おすすめのお知らせ一覧
	$dp_default_options['recommend_news_headline1'] = __( 'Recommend post', 'tcd-issue' );
	$dp_default_options['recommend_news_headline2'] = '';
	$dp_default_options['recommend_news_headline3'] = '';
	for ( $i = 1; $i <= 3; $i++ ) {
	$dp_default_options['recommend_news_num'.$i] = '6';
	$dp_default_options['recommend_news_num'.$i.'_sp'] = '3';
	$dp_default_options['recommend_news_type'.$i] = 'recommend_post';
	$dp_default_options['recommend_news_order'.$i] = 'rand';
	$dp_default_options['recommend_news_order_custom'.$i] = '';
  }

	// 記事ページの追加コンテンツ
	$dp_default_options['single_news_top_ad_code'] = '';
	$dp_default_options['single_news_top_ad_code_mobile'] = '';
	$dp_default_options['single_news_bottom_ad_code'] = '';
	$dp_default_options['single_news_bottom_ad_code_mobile'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $basic_display_options, $single_page_display_options, $custom_post_usage_options, $single_sidebar_pos_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-issue' );

?>

<div id="tab-content-news" class="tab-content">


   <?php // 有効化 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac active open custon_post_usage_option">
    <h3 class="theme_option_headline"><?php _e('Validation', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2 custon_post_usage_option_message" style="<?php if($options['use_news']){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <p><?php printf(__('Currently, all function related to custom post "%s" have been disabled.<br>All areas that have already been set up will be hidden from the site.<br>Please use this option only if you don\'t want to use the custom post "%s" at all. (No archive page will be generated either).', 'tcd-issue'), $news_label, $news_label); ?></p>
     </div>
     <div class="theme_option_message2" style="<?php if($options['use_news']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <p><?php printf(__('Please check off the checkbox if you don\'t want to use custom post "%s".', 'tcd-issue'), $news_label); ?></p>
     </div>
     <p><label><input class="custon_post_usage_option_checkbox" name="dp_options[use_news]" type="checkbox" value="1" <?php checked( 1, $options['use_news'] ); ?>><?php printf(__('Use custom post "%s"', 'tcd-issue'), $news_label); ?></label></p>

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
     <input type="text" name="dp_options[news_label]" value="<?php echo esc_attr( $options['news_label'] ); ?>" />

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-issue'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-issue'); ?></p>
     </div>
     <p><input class="hankaku" type="text" name="dp_options[news_slug]" value="<?php echo sanitize_title( $options['news_slug'] ); ?>" /></p>

     <h4 class="theme_option_headline2"><?php _e('Featured image', 'tcd-issue'); ?></h4>
     <div class="clearfix"><?php echo tcd_basic_radio_button($options, 'news_show_image', $basic_display_options); ?></div>

     <h4 class="theme_option_headline2"><?php echo sprintf(__('%s category', 'tcd-issue'), $news_label); ?></h4>
     <div class="clearfix"><?php echo tcd_basic_radio_button($options, 'news_show_category', $basic_display_options); ?></div>

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
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/news_archive.jpg" alt="" title="" />
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[archive_news_headline]" value="<?php echo esc_attr($options['archive_news_headline']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[archive_news_sub_title]" value="<?php echo esc_attr($options['archive_news_sub_title']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Description', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_news_desc]"><?php echo esc_textarea(  $options['archive_news_desc'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-issue'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-issue' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_news_desc_mobile]"><?php echo esc_textarea(  $options['archive_news_desc_mobile'] ); ?></textarea></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Category list', 'tcd-issue'); ?></h4>
     <div class="clearfix"><?php echo tcd_basic_radio_button($options, 'archive_news_show_category_list', $basic_display_options); ?></div>
     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-issue'), $news_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'archive_news_num'); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-issue'), $news_label); ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/news_single.jpg?2.0" alt="" title="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-issue');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set share button design from basic setting menu in theme option page.', 'tcd-issue');  ?><br>
      <?php _e('The content displayed in the sidebar can be set from Appearance > <a href="./widgets.php" target="_blank">Widgets</a>.', 'tcd-issue');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Modified date', 'tcd-issue');  ?></span><?php echo tcd_basic_radio_button($options, 'single_news_show_mod_date', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Share button', 'tcd-issue');  ?></span><?php echo tcd_basic_radio_button($options, 'single_news_show_sns', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('"COPY Title&amp;URL" button', 'tcd-issue');  ?></span><?php echo tcd_basic_radio_button($options, 'single_news_show_copy', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Position of sidebar', 'tcd-issue');  ?></span><?php echo tcd_basic_radio_button($options, 'single_news_sidebar_pos', $single_sidebar_pos_options); ?></li>
     </ul>

     <?php // おすすめ記事 ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php printf(__('%s article carousel', 'tcd-issue'), $news_label); ?></h4>

     <div class="front_page_image middle">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/news_related.jpg" alt="" title="" />
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
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue');  ?></span><input class="full_width" type="text" placeholder="<?php _e( 'e.g.', 'tcd-issue' ); _e( 'Recommend news', 'tcd-issue' ); ?>" name="dp_options[recommend_news_headline<?php echo $i; ?>]" value="<?php echo esc_textarea(  $options['recommend_news_headline'.$i] ); ?>" /></li>
      <li class="cf">
       <span class="label"><span class="num">2</span><?php _e('Post type', 'tcd-issue');  ?></span>
       <select class="post_list_type" name="dp_options[recommend_news_type<?php echo $i; ?>]">
        <option style="padding-right: 10px;" value="all_post" <?php selected( $options['recommend_news_type'.$i], 'all_post' ); ?>><?php _e('All post', 'tcd-issue'); ?></option>
        <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['recommend_news_type'.$i], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>1</option>
        <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $options['recommend_news_type'.$i], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>2</option>
        <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $options['recommend_news_type'.$i], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>3</option>
        <option style="padding-right: 10px;" value="custom" <?php selected( $options['recommend_news_type'.$i], 'custom' ); ?>><?php _e('Custom', 'tcd-issue'); ?></option>
       </select>
      </li>
      <li class="cf space post_list_type_normal_option"><span class="label"><?php _e('Number of post to display', 'tcd-issue'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'recommend_news_num'.$i); ?></li>
      <li class="cf space post_list_type_normal_option">
       <span class="label"><?php _e('Post order', 'tcd-issue');  ?></span>
       <div class="standard_radio_button">
        <input id="recommend_news_order_date<?php echo $i; ?>" type="radio" name="dp_options[recommend_news_order<?php echo $i; ?>]" value="date" <?php checked( $options['recommend_news_order'.$i], 'date' ); ?>>
        <label for="recommend_news_order_date<?php echo $i; ?>"><?php _e('Date', 'tcd-issue'); ?></label>
        <input id="recommend_news_order_rand<?php echo $i; ?>" type="radio" name="dp_options[recommend_news_order<?php echo $i; ?>]" value="rand" <?php checked( $options['recommend_news_order'.$i], 'rand' ); ?>>
        <label for="recommend_news_order_rand<?php echo $i; ?>"><?php _e('Random', 'tcd-issue'); ?></label>
       </div>
      </li>
      <li class="cf space post_list_type_custom_option">
       <span class="label"><?php _e('ID of the article you want to display', 'tcd-issue');  ?><span class="recommend_desc"><?php _e('Please enter post ids by comma separated.', 'tcd-issue'); ?></span></span>
       <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-issue' ); ?>1,3,10" class="full_width hankaku" name="dp_options[recommend_news_order_custom<?php echo $i; ?>]" value="<?php echo esc_attr($options['recommend_news_order_custom'.$i]); ?>">
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
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_top_ad_code]"><?php echo esc_textarea( $options['single_news_top_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-issue');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-issue');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_top_ad_code_mobile]"><?php echo esc_textarea( $options['single_news_top_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // メインコンテンツの下部 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (PC)', 'tcd-issue');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in PC only.', 'tcd-issue');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_bottom_ad_code]"><?php echo esc_textarea( $options['single_news_bottom_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-issue');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-issue');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_news_bottom_ad_code_mobile]"><?php echo esc_textarea( $options['single_news_bottom_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_news_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_theme_options_validate( $input ) {

  global $dp_default_options, $no_image_options, $font_type_options, $single_sidebar_pos_options;

  //基本設定
  $input['use_news'] = wp_filter_nohtml_kses( $input['use_news'] );
  $input['news_slug'] = sanitize_title( $input['news_slug'] );
  $input['news_label'] = wp_filter_nohtml_kses( $input['news_label'] );
  $input['news_show_image'] = wp_filter_nohtml_kses( $input['news_show_image'] );
  $input['news_show_category'] = wp_filter_nohtml_kses( $input['news_show_category'] );

  // アーカイブ
  $input['archive_news_headline'] = wp_filter_nohtml_kses( $input['archive_news_headline'] );
  $input['archive_news_sub_title'] = wp_filter_nohtml_kses( $input['archive_news_sub_title'] );
  $input['archive_news_desc'] = wp_kses_post( $input['archive_news_desc'] );
  $input['archive_news_desc_mobile'] = wp_kses_post( $input['archive_news_desc_mobile'] );

  $input['archive_news_num'] = wp_filter_nohtml_kses( $input['archive_news_num'] );
  $input['archive_news_num_sp'] = wp_filter_nohtml_kses( $input['archive_news_num_sp'] );
  $input['archive_news_show_category_list'] = wp_filter_nohtml_kses( $input['archive_news_show_category_list'] );

  // 詳細ページ
  $input['single_news_show_sns'] = wp_filter_nohtml_kses( $input['single_news_show_sns'] );
  $input['single_news_show_copy'] = wp_filter_nohtml_kses( $input['single_news_show_copy'] );
  $input['single_news_show_mod_date'] = wp_filter_nohtml_kses( $input['single_news_show_mod_date'] );
  $input['single_news_sidebar_pos'] = wp_filter_nohtml_kses( $input['single_news_sidebar_pos'] );


  // おすすめのお知らせ一覧
	for ( $i = 1; $i <= 3; $i++ ) {
  $input['recommend_news_headline'.$i] = wp_filter_nohtml_kses( $input['recommend_news_headline'.$i] );
  $input['recommend_news_num'.$i] = wp_filter_nohtml_kses( $input['recommend_news_num'.$i] );
  $input['recommend_news_num'.$i.'_sp'] = wp_filter_nohtml_kses( $input['recommend_news_num'.$i.'_sp'] );
  $input['recommend_news_type'.$i] = wp_filter_nohtml_kses( $input['recommend_news_type'.$i] );
  $input['recommend_news_order'.$i] = wp_filter_nohtml_kses( $input['recommend_news_order'.$i] );
  $input['recommend_news_order_custom'.$i] = wp_filter_nohtml_kses( $input['recommend_news_order_custom'.$i] );
  }


  // 記事ページの追加コンテンツ
  $input['single_news_top_ad_code'] = $input['single_news_top_ad_code'];
  $input['single_news_top_ad_code_mobile'] = $input['single_news_top_ad_code_mobile'];
  $input['single_news_bottom_ad_code'] = $input['single_news_bottom_ad_code'];
  $input['single_news_bottom_ad_code_mobile'] = $input['single_news_bottom_ad_code_mobile'];


	return $input;

};


?>