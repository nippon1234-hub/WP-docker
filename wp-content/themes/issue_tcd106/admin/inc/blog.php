<?php
/*
 * ブログの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );


//  Add label of blog tab
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );


// Add HTML of blog tab
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );


// タブの名前
function add_blog_tab_label( $tab_labels ) {
	$tab_labels['blog'] = __( 'Post', 'tcd-issue' );
	return $tab_labels;
}


// 初期値
function add_blog_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['blog_show_date'] = 'display';

	// アーカイブページ
	$dp_default_options['archive_blog_headline'] = 'BLOG';
	$dp_default_options['archive_blog_sub_title'] = __( 'Blog', 'tcd-issue' );
	$dp_default_options['archive_blog_desc'] = __( 'Description will be displayed here.', 'tcd-issue' );
	$dp_default_options['archive_blog_desc_mobile'] = '';
  $dp_default_options['archive_blog_show_category_list'] = 'display';

	// 詳細ページ
	$dp_default_options['single_blog_show_sns'] = 'top';
	$dp_default_options['single_blog_show_copy'] = 'top';
	$dp_default_options['single_blog_show_tag_list'] = 'display';
	$dp_default_options['single_blog_show_mod_date'] = 'display';
    $dp_default_options['single_blog_sidebar_pos'] = 'right';

	// おすすめ記事
	$dp_default_options['recommend_post_headline1'] = __( 'Recommend post', 'tcd-issue' );
	$dp_default_options['recommend_post_headline2'] = '';
	$dp_default_options['recommend_post_headline3'] = '';
	for ( $i = 1; $i <= 3; $i++ ) {
	$dp_default_options['recommend_post_num'.$i] = '6';
	$dp_default_options['recommend_post_num'.$i.'_sp'] = '3';
	$dp_default_options['recommend_post_type'.$i] = 'recommend_post';
	$dp_default_options['recommend_post_order'.$i] = 'rand';
	$dp_default_options['recommend_post_order_custom'.$i] = '';
    }

	// 記事ページの追加コンテンツ
	$dp_default_options['single_top_ad_code'] = '';
	$dp_default_options['single_top_ad_code_mobile'] = '';
	$dp_default_options['single_bottom_ad_code'] = '';
	$dp_default_options['single_bottom_ad_code_mobile'] = '';

    // CTA
    $dp_default_options['use_single_cta'] = '';
    $dp_default_options['single_cta_headline'] = '';
    $dp_default_options['single_cta_headline_font_size'] = '24';
    $dp_default_options['single_cta_headline_font_size_sp'] = '18';
    $dp_default_options['single_cta_desc'] = '';
    $dp_default_options['single_cta_desc_mobile'] = '';
    $dp_default_options['single_cta_btn_label'] = '';
    $dp_default_options['single_cta_btn_url'] = '';
    $dp_default_options['single_cta_btn_target'] = '';
    $dp_default_options['single_cta_btn_color'] = '#000000';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $font_type_options, $basic_display_options, $single_page_display_options, $single_sidebar_pos_options;

?>

<div id="tab-content-blog" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content">

     <?php
          $blog_page_id = get_option( 'page_for_posts' );
          if($blog_page_id) {
     ?>

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/content_name_url.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e('Name of content', 'tcd-issue'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Title that are set on the <a href="post.php?post=%s&action=edit" target="_blank">post page</a> will affect to breadcrumb link name.', 'tcd-issue'), $blog_page_id); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-issue'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Permalinks that are set on the <a href="post.php?post=%s&action=edit" target="_blank">post page</a> will affect to blog page URL.', 'tcd-issue'), $blog_page_id); ?></p>
     </div>

     <?php } else { ?>

     <div class="theme_option_message2">
      <p><?php _e('After creating the blog page by <a href="./edit.php?post_type=page" target="_blank">WP-page</a>, please register the page as a blog from the <a href="./options-reading.php" target="_blank">display settings page</a>.', 'tcd-issue'); ?></p>
     </div>

     <?php }; ?>

     <h4 class="theme_option_headline2"><?php _e('Date', 'tcd-issue');  ?></h4>
     <div class="clearfix"><?php echo tcd_basic_radio_button($options, 'blog_show_date', $basic_display_options); ?></div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-issue'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/blog_archive.jpg" alt="" title="" />
     </div>

     <div class="theme_option_message2" style="margin-top:20px;">
      <?php
           if($blog_page_id) {
             $blog_page_url = get_page_link( $blog_page_id );
             if($blog_page_url){
      ?>
      <p><?php _e('URL of the post archive page:', 'tcd-issue'); ?><a class="e_link" href="<?php echo esc_url($blog_page_url) ?>" target="_blank"><?php echo esc_url($blog_page_url) ?></a></p>
      <?php
             };
           } else {
      ?>
      <p><?php _e('The page for the post archive page is not set.', 'tcd-issue'); ?>
         <?php _e('Please refer to the <a href="https://tcd-theme.com/2022/07/wordpress-homepage.html" target="_blank">manual</a> to create and configure.', 'tcd-issue'); ?></p>
      <?php } ?>
      <p><?php printf(__('The number of posts displayed in %s archive page can be set from "Settings > Display Settings > Maximum number of posts per page".<br>Click <a href="./options-reading.php" target="_blank">here</a> for display settings', 'tcd-issue'), $blog_label); ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[archive_blog_headline]" value="<?php echo esc_attr($options['archive_blog_headline']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Subtitle', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[archive_blog_sub_title]" value="<?php echo esc_attr($options['archive_blog_sub_title']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Description', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_blog_desc]"><?php echo esc_textarea(  $options['archive_blog_desc'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-issue'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-issue' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_blog_desc_mobile]"><?php echo esc_textarea(  $options['archive_blog_desc_mobile'] ); ?></textarea></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Category list', 'tcd-issue'); ?></h4>
     <div class="clearfix"><?php echo tcd_basic_radio_button($options, 'archive_blog_show_category_list', $basic_display_options); ?></div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-issue'), $blog_label); ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/blog_single.jpg?2.0" alt="" title="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-issue');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set share button design from basic setting menu in theme option page.', 'tcd-issue');  ?><br>
      <?php _e('The content displayed in the sidebar can be set from Appearance > <a href="./widgets.php" target="_blank">Widgets</a>.', 'tcd-issue');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Modified date', 'tcd-issue');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_mod_date', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Share button', 'tcd-issue');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_sns', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('"COPY Title&amp;URL" button', 'tcd-issue');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_copy', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Tag cloud', 'tcd-issue');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_tag_list', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">4</span><?php _e('Position of sidebar', 'tcd-issue');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_sidebar_pos', $single_sidebar_pos_options); ?></li>
     </ul>

     <?php // おすすめ記事 ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php printf(__('%s article carousel', 'tcd-issue'), $blog_label); ?></h4>

     <div class="front_page_image middle">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/blog_related.jpg" alt="" title="" />
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
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue');  ?></span><input class="full_width" type="text" placeholder="<?php _e( 'e.g.', 'tcd-issue' ); _e( 'Recommend post', 'tcd-issue' ); ?>" name="dp_options[recommend_post_headline<?php echo $i; ?>]" value="<?php echo esc_attr($options['recommend_post_headline'.$i]); ?>"></li>
      <li class="cf">
       <span class="label"><span class="num">2</span><?php _e('Post type', 'tcd-issue');  ?></span>
       <select class="post_list_type" name="dp_options[recommend_post_type<?php echo $i; ?>]">
        <option style="padding-right: 10px;" value="all_post" <?php selected( $options['recommend_post_type'.$i], 'all_post' ); ?>><?php _e('All post', 'tcd-issue'); ?></option>
        <option style="padding-right: 10px;" value="category_post" <?php selected( $options['recommend_post_type'.$i], 'category_post' ); ?>><?php _e('Same category post', 'tcd-issue'); ?></option>
        <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['recommend_post_type'.$i], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>1</option>
        <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $options['recommend_post_type'.$i], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>2</option>
        <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $options['recommend_post_type'.$i], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-issue'); ?>3</option>
        <option style="padding-right: 10px;" value="custom" <?php selected( $options['recommend_post_type'.$i], 'custom' ); ?>><?php _e('Custom', 'tcd-issue'); ?></option>
       </select>
      </li>
      <li class="cf space post_list_type_normal_option"><span class="label"><?php _e('Number of post to display', 'tcd-issue');  ?></span><?php echo tcd_display_post_num_option_type2($options, 'recommend_post_num' . $i); ?></li>
      <li class="cf space post_list_type_normal_option">
       <span class="label"><?php _e('Post order', 'tcd-issue');  ?></span>
       <div class="standard_radio_button">
        <input id="recommend_post_order_date<?php echo $i; ?>" type="radio" name="dp_options[recommend_post_order<?php echo $i; ?>]" value="date" <?php checked( $options['recommend_post_order'.$i], 'date' ); ?>>
        <label for="recommend_post_order_date<?php echo $i; ?>"><?php _e('Date', 'tcd-issue'); ?></label>
        <input id="recommend_post_order_rand<?php echo $i; ?>" type="radio" name="dp_options[recommend_post_order<?php echo $i; ?>]" value="rand" <?php checked( $options['recommend_post_order'.$i], 'rand' ); ?>>
        <label for="recommend_post_order_rand<?php echo $i; ?>"><?php _e('Random', 'tcd-issue'); ?></label>
       </div>
      </li>
      <li class="cf space post_list_type_custom_option">
       <span class="label"><?php _e('ID of the article you want to display', 'tcd-issue');  ?><span class="recommend_desc"><?php _e('Enter article IDs separated by commas.<br>The ID can be found in the administration screen.<br><a href="https://tcd-theme.com/2017/01/check_pageid_categoryid.html#tcd_id" target="_blank">Click here to see the ID display section of the TCD theme.</a>', 'tcd-issue'); ?></span></span>
       <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-issue' ); ?>1,3,10" class="full_width hankaku" name="dp_options[recommend_post_order_custom<?php echo $i; ?>]" value="<?php echo esc_attr($options['recommend_post_order_custom'.$i]); ?>">
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


   <?php // CTA ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('CTA', 'tcd-issue'); ?></h3>
    <div class="theme_option_field_ac_content">
     <p class="displayment_checkbox"><label><input name="dp_options[use_single_cta]" type="checkbox" value="1" <?php checked( $options['use_single_cta'], 1 ); ?>><?php _e( 'Use CTA', 'tcd-issue' ); ?></label></p>

     <div style="<?php if($options['use_single_cta'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
        <div class="front_page_image" style="margin-top: 0;">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/blog_cta.jpg" alt="" title="" />
        </div>
        <div class="theme_option_message2" style="margin-top:20px;">
            <p><?php _e('The CTA will appear at the bottom of every post page when it is set up.', 'tcd-issue'); ?></p>
        </div>
        <ul class="option_list">
          <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-issue'); ?></span><input type="text" class="full_width" name="dp_options[single_cta_headline]" value="<?php echo esc_attr($options['single_cta_headline']); ?>" ></li>
          <li class="cf space"><span class="label"><?php _e('Font size of headline', 'tcd-issue'); ?></span><?php echo tcd_font_size_option($options, 'single_cta_headline_font_size'); ?></li>
          <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-issue'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[single_cta_desc]"><?php echo esc_textarea(  $options['single_cta_desc'] ); ?></textarea></li>
          <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-issue'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-issue' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[single_cta_desc_mobile]"><?php echo esc_textarea(  $options['single_cta_desc_mobile'] ); ?></textarea></li>
          <li class="cf">
            <span class="label"><span class="num sc_content_type1_option">3</span><span class="num sc_content_type2_option" style="display:none;">4</span><?php _e('Button label', 'tcd-issue'); ?></span>
            <input type="text" class="full_width" name="dp_options[single_cta_btn_label]" value="<?php echo esc_attr($options['single_cta_btn_label']); ?>" />
          </li>
          <li class="cf space">
            <span class="label"><?php _e('URL', 'tcd-issue'); ?></span>
            <div class="admin_link_option">
             <input type="text" name="dp_options[single_cta_btn_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['single_cta_btn_url'] ); ?>">
             <input id="single_cta_btn_target" class="admin_link_option_target" name="dp_options[single_cta_btn_target]" type="checkbox" value="1" <?php checked( $options['single_cta_btn_target'], 1 ); ?>>
             <label for="single_cta_btn_target">&#xe920;</label>
            </div>
          </li>
          <li class="cf space color_picker_bottom">
            <span class="label"><?php _e('Button color', 'tcd-issue'); ?></span><input type="text" name="dp_options[single_cta_btn_color]" value="<?php echo esc_attr( $options['single_cta_btn_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
          </li>
        </ul>
     </div>

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
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_top_ad_code]"><?php echo esc_textarea( $options['single_top_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-issue');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-issue');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_top_ad_code_mobile]"><?php echo esc_textarea( $options['single_top_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // メインコンテンツの下部 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (PC)', 'tcd-issue');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in PC only.', 'tcd-issue');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_bottom_ad_code]"><?php echo esc_textarea( $options['single_bottom_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-issue');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-issue');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_bottom_ad_code_mobile]"><?php echo esc_textarea( $options['single_bottom_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_blog_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $single_sidebar_pos_options;

  // 基本設定
  $input['blog_show_date'] = wp_filter_nohtml_kses( $input['blog_show_date'] );


  // アーカイブ
  $input['archive_blog_headline'] = wp_filter_nohtml_kses( $input['archive_blog_headline'] );
  $input['archive_blog_sub_title'] = wp_filter_nohtml_kses( $input['archive_blog_sub_title'] );
  $input['archive_blog_desc'] = wp_kses_post( $input['archive_blog_desc'] );
  $input['archive_blog_desc_mobile'] = wp_kses_post( $input['archive_blog_desc_mobile'] );
  $input['archive_blog_show_category_list'] = wp_filter_nohtml_kses( $input['archive_blog_show_category_list'] );

  // 記事ページ
  $input['single_blog_show_sns'] = wp_filter_nohtml_kses( $input['single_blog_show_sns'] );
  $input['single_blog_show_copy'] = wp_filter_nohtml_kses( $input['single_blog_show_copy'] );
  $input['single_blog_show_tag_list'] = wp_filter_nohtml_kses( $input['single_blog_show_tag_list'] );
  $input['single_blog_show_mod_date'] = wp_filter_nohtml_kses( $input['single_blog_show_mod_date'] );
  $input['single_blog_sidebar_pos'] = wp_filter_nohtml_kses( $input['single_blog_sidebar_pos'] );


  // おすすめ記事
	for ( $i = 1; $i <= 3; $i++ ) {
  $input['recommend_post_headline'.$i] = wp_filter_nohtml_kses( $input['recommend_post_headline'.$i] );
  $input['recommend_post_num'.$i] = wp_filter_nohtml_kses( $input['recommend_post_num'.$i] );
  $input['recommend_post_num'.$i.'_sp'] = wp_filter_nohtml_kses( $input['recommend_post_num'.$i.'_sp'] );
  $input['recommend_post_type'.$i] = wp_filter_nohtml_kses( $input['recommend_post_type'.$i] );
  $input['recommend_post_order'.$i] = wp_filter_nohtml_kses( $input['recommend_post_order'.$i] );
  $input['recommend_post_order_custom'.$i] = wp_filter_nohtml_kses( $input['recommend_post_order_custom'.$i] );
  }

  // 記事ページの追加コンテンツ
  $input['single_top_ad_code'] = $input['single_top_ad_code'];
  $input['single_top_ad_code_mobile'] = $input['single_top_ad_code_mobile'];
  $input['single_bottom_ad_code'] = $input['single_bottom_ad_code'];
  $input['single_bottom_ad_code_mobile'] = $input['single_bottom_ad_code_mobile'];

  // CTA
  $input['use_single_cta'] = ! empty( $input['use_single_cta'] ) ? 1 : 0;
  $input['single_cta_headline'] = wp_filter_nohtml_kses( $input['single_cta_headline'] );
  $input['single_cta_headline_font_size'] = wp_filter_nohtml_kses( $input['single_cta_headline_font_size'] );
  $input['single_cta_headline_font_size_sp'] = wp_filter_nohtml_kses( $input['single_cta_headline_font_size_sp'] );
  $input['single_cta_desc'] = wp_kses_post( $input['single_cta_desc'] );
  $input['single_cta_desc_mobile'] = wp_kses_post( $input['single_cta_desc_mobile'] );
  $input['single_cta_btn_url'] = wp_kses_post( $input['single_cta_btn_url'] );
  $input['single_cta_btn_target'] = wp_kses_post( $input['single_cta_btn_target'] );
  $input['single_cta_btn_color'] = sanitize_hex_color( $input['single_cta_btn_color'] );

	return $input;

};


?>