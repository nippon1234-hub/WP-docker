<?php
/*
 * SEOの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_seo_dp_default_options' );


//  Add label of seo tab
add_action( 'tcd_tab_labels', 'add_seo_tab_label' );


// Add HTML of seo tab
add_action( 'tcd_tab_panel', 'add_seo_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_seo_theme_options_validate' );


// タブの名前
function add_seo_tab_label( $tab_labels ) {
	$tab_labels['seo'] = __( 'SEO', 'tcd-issue' );
	return $tab_labels;
}


// 初期値
function add_seo_dp_default_options( $dp_default_options ) {

  // SEO
	$dp_default_options['front_page_meta_title'] = '';
	$dp_default_options['front_page_meta_description'] = '';
	$dp_default_options['blog_archive_meta_title'] = '';
	$dp_default_options['blog_archive_meta_description'] = '';
	$dp_default_options['news_archive_meta_title'] = '';
	$dp_default_options['news_archive_meta_description'] = '';
	$dp_default_options['interview_archive_meta_title'] = '';
	$dp_default_options['interview_archive_meta_description'] = '';
	$dp_default_options['staff_archive_meta_title'] = '';
	$dp_default_options['staff_archive_meta_description'] = '';

	// 高速化機能
	$dp_default_options['use_emoji'] = 0;
	$dp_default_options['use_google_material_icon'] = 1;
	$dp_default_options['use_js_optimization'] = 0;
	$dp_default_options['use_css_optimization'] = 0;
	$dp_default_options['use_html_optimization'] = 0;

	// Facebook OGPの設定
	$dp_default_options['use_ogp'] = 0;
	$dp_default_options['fb_app_id'] = '';
	$dp_default_options['ogp_image'] = '';

	// Twitter Cardsの設定
	$dp_default_options['twitter_account_name'] = '';
	$dp_default_options['twitter_cards_size'] = 'summary';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_seo_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $twitter_image_options;

  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-issue' );
  $interview_label = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Conversation', 'tcd-issue' );
  $staff_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Staff', 'tcd-issue' );

?>

<div id="tab-content-seo" class="tab-content">

   <?php // SEO ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Meta tag', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2" style="margin-top:20px;">
      <p>
       <?php _e('You can set individual meta tags for the front page and archive pages.', 'tcd-issue'); ?></br>
       <?php _e('If this option is empty, the site title and catchphrase in <a href="./options-general.php" target="_blank">general setting screen</a> will be reflected instead.', 'tcd-issue'); ?></br>
       <?php _e('You can edit meta tags for single pages and taxonomy pages from the respective editing screens.', 'tcd-issue'); ?>
      </p>
     </div>

     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Front page', 'tcd-issue');  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Title tag', 'tcd-issue' ); ?></h4>
       <input type="text" class="full_width" name="dp_options[front_page_meta_title]" value="<?php echo esc_textarea(  $options['front_page_meta_title'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Meta description tag', 'tcd-issue' ); ?></h4>
       <textarea class="full_width word_count" cols="50" rows="4" name="dp_options[front_page_meta_description]"><?php echo esc_textarea(  $options['front_page_meta_description'] ); ?></textarea>
       <p class="word_count_result"><?php _e( 'Current character is : <span>0</span>', 'tcd-issue' ); ?></p>
      </div>
     </div>

     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Post archive page', 'tcd-issue');  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Title tag', 'tcd-issue' ); ?></h4>
       <input type="text" class="full_width" name="dp_options[blog_archive_meta_title]" value="<?php echo esc_textarea(  $options['blog_archive_meta_title'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Meta description tag', 'tcd-issue' ); ?></h4>
       <textarea class="full_width word_count" cols="50" rows="4" name="dp_options[blog_archive_meta_description]"><?php echo esc_textarea(  $options['blog_archive_meta_description'] ); ?></textarea>
       <p class="word_count_result"><?php _e( 'Current character is : <span>0</span>', 'tcd-issue' ); ?></p>
      </div>
     </div>

     <div class="sub_box cf" style="<?php if($options['use_news']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h3 class="theme_option_subbox_headline"><?php printf(__('%s archive page', 'tcd-issue'), $news_label);  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Title tag', 'tcd-issue' ); ?></h4>
       <input type="text" class="full_width" name="dp_options[news_archive_meta_title]" value="<?php echo esc_textarea(  $options['news_archive_meta_title'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Meta description tag', 'tcd-issue' ); ?></h4>
       <textarea class="full_width word_count" cols="50" rows="4" name="dp_options[news_archive_meta_description]"><?php echo esc_textarea(  $options['news_archive_meta_description'] ); ?></textarea>
       <p class="word_count_result"><?php _e( 'Current character is : <span>0</span>', 'tcd-issue' ); ?></p>
      </div>
     </div>

     <div class="sub_box cf" style="<?php if($options['use_interview']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h3 class="theme_option_subbox_headline"><?php printf(__('%s archive page', 'tcd-issue'), $interview_label);  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Title tag', 'tcd-issue' ); ?></h4>
       <input type="text" class="full_width" name="dp_options[interview_archive_meta_title]" value="<?php echo esc_textarea(  $options['interview_archive_meta_title'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Meta description tag', 'tcd-issue' ); ?></h4>
       <textarea class="full_width word_count" cols="50" rows="4" name="dp_options[interview_archive_meta_description]"><?php echo esc_textarea(  $options['interview_archive_meta_description'] ); ?></textarea>
       <p class="word_count_result"><?php _e( 'Current character is : <span>0</span>', 'tcd-issue' ); ?></p>
      </div>
     </div>

     <div class="sub_box cf" style="<?php if($options['use_staff']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h3 class="theme_option_subbox_headline"><?php printf(__('%s archive page', 'tcd-issue'), $staff_label);  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Title tag', 'tcd-issue' ); ?></h4>
       <input type="text" class="full_width" name="dp_options[staff_archive_meta_title]" value="<?php echo esc_textarea(  $options['staff_archive_meta_title'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Meta description tag', 'tcd-issue' ); ?></h4>
       <textarea class="full_width word_count" cols="50" rows="4" name="dp_options[staff_archive_meta_description]"><?php echo esc_textarea(  $options['staff_archive_meta_description'] ); ?></textarea>
       <p class="word_count_result"><?php _e( 'Current character is : <span>0</span>', 'tcd-issue' ); ?></p>
      </div>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // OGP ------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('OGP', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-issue' ); ?></h4>
     <div class="theme_option_message2" style="margin-bottom:-10px;">
      <p><?php _e('OGP is a mechanism for correctly conveying page information.', 'tcd-issue'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Use OGP', 'tcd-issue'); ?></span>
       <input class="display_option" data-option-name="use_ogp" name="dp_options[use_ogp]" type="checkbox" value="1" <?php checked( $options['use_ogp'], 1 ); ?>>
      </li>
      <li class="cf use_ogp">
       <span class="label"><?php _e('OGP image', 'tcd-issue'); ?></span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" value="<?php echo esc_attr( $options['ogp_image'] ); ?>" id="ogp_image" name="dp_options[ogp_image]" class="cf_media_id">
         <div class="preview_field"><?php if ( $options['ogp_image'] ) { echo wp_get_attachment_image( $options['ogp_image'], 'medium'); } ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-issue' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-issue' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['ogp_image'] ) { echo 'hidden'; } ?>">
         </div>
        </div>
       </div>
       <div class="theme_option_message2" style="clear:both; margin:40px 0 0 0;">
        <p><?php _e( 'This image is displayed for OGP if the page does not have a thumbnail.', 'tcd-issue' ); ?></p>
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '1200', '630'); ?></p>
       </div>
      </li>
     </ul>

     <div class="use_ogp">

      <h4 class="theme_option_headline2"><?php _e( 'Facebook', 'tcd-issue' ); ?></h4>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Your Facebook app ID', 'tcd-issue'); ?></span><input class="full_width" type="text" name="dp_options[fb_app_id]" value="<?php echo esc_attr( $options['fb_app_id'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:10px 0 0 0;">
         <p><?php _e( 'In order to use Facebook Insights please set your app ID.<br><a href="https://tcd-theme.com/2018/01/facebook_app_id.html" target="_blank">What is Facebook app ID?</a>', 'tcd-issue' ); ?></p>
        </div>
       </li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e( 'Twitte Cards', 'tcd-issue' ); ?></h4>
      <div class="theme_option_message2" style="margin-bottom:-10px;">
       <p><?php _e('This theme requires Facebook OGP settings to use Twitter cards.', 'tcd-issue'); ?></p>
       <p><a href="https://tcd-theme.com/2016/11/twitter-cards.html" target="_blank"><?php _e( 'Information about Twitter Cards.', 'tcd-issue' ); ?></a></p>
      </div>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Your X account name (exclude @ mark)', 'tcd-issue'); ?></span><input class="full_width" type="text" name="dp_options[twitter_account_name]" value="<?php echo esc_attr( $options['twitter_account_name'] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Twitter cards size', 'tcd-issue'); ?></span><?php echo tcd_basic_radio_button( $options, 'twitter_cards_size', $twitter_image_options ); ?></li>
      </ul>

     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 高速化 ------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Acceleration', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Emoji', 'tcd-issue' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( "We recommend to checkoff this option if you dont use any Emoji in your post content.", 'tcd-issue' ); ?></p>
     </div>
     <p><label><input name="dp_options[use_emoji]" type="checkbox" value="1" <?php checked( 1, $options['use_emoji'] ); ?>><?php _e( 'Use emoji', 'tcd-issue' ); ?></label></p>

     <h4 class="theme_option_headline2"><?php _e( 'Google material icon', 'tcd-issue' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( "We recommend to checkoff this option if you dont use any Google material icon.<br>If you want to use Google material icon in footer bar check the checkbox below. If unchecked, Google material icon will not be displayed.", 'tcd-issue' ); ?></p>
     </div>
     <p><label><input id="use_google_material_icon" name="dp_options[use_google_material_icon]" type="checkbox" value="1" <?php checked( 1, $options['use_google_material_icon'] ); ?>><?php _e( 'Use use_google_material_icon', 'tcd-issue' ); ?></label></p>

     <h4 class="theme_option_headline2"><?php _e( 'Optimization', 'tcd-issue' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Check here to remove margins and line breaks in JavaScript.', 'tcd-issue' ); ?><br>
      <?php _e( '*This specification does not apply to external resources.', 'tcd-issue' ); ?></p>
     </div>
     <p><label><input name="dp_options[use_js_optimization]" type="checkbox" value="1" <?php checked( 1, $options['use_js_optimization'] ); ?>> <?php _e( 'Use JavaScript optimization', 'tcd-issue' ); ?></label></p>
     <div class="theme_option_message2">
      <p><?php _e( 'Check here to remove margins and line breaks in CSS.<br>It also improves the loading speed by generating a page common CSS cache file.<br>* This specification does not apply to external CSS (CDN, etc.).', 'tcd-issue' ); ?></p>
     </div>
     <p><label><input name="dp_options[use_css_optimization]" type="checkbox" value="1" <?php checked( 1, $options['use_css_optimization'] ); ?>> <?php _e( 'Use CSS optimization', 'tcd-issue' ); ?></label></p>
     <div class="theme_option_message2">
      <p><?php _e( 'Check here to remove margins and line breaks in HTML.', 'tcd-issue' ); ?></p>
     </div>
     <p><label><input name="dp_options[use_html_optimization]" type="checkbox" value="1" <?php checked( 1, $options['use_html_optimization'] ); ?>> <?php _e( 'Use HTML optimization', 'tcd-issue' ); ?></label></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_seo_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_seo_theme_options_validate( $input ) {

  global $dp_default_options;

  // 高速化機能
  $input['use_emoji'] = ! empty( $input['use_emoji'] ) ? 1 : 0;
  $input['use_google_material_icon'] = ! empty( $input['use_google_material_icon'] ) ? 1 : 0;
  $input['use_js_optimization'] = ! empty( $input['use_js_optimization'] ) ? 1 : 0;
  $input['use_css_optimization'] = ! empty( $input['use_css_optimization'] ) ? 1 : 0;
  $input['use_html_optimization'] = ! empty( $input['use_html_optimization'] ) ? 1 : 0;


  // meta tag
  $input['front_page_meta_title'] = wp_filter_nohtml_kses( $input['front_page_meta_title'] );
  $input['front_page_meta_description'] = wp_filter_nohtml_kses( $input['front_page_meta_description'] );
  $input['blog_archive_meta_title'] = wp_filter_nohtml_kses( $input['blog_archive_meta_title'] );
  $input['blog_archive_meta_description'] = wp_filter_nohtml_kses( $input['blog_archive_meta_description'] );
  $input['news_archive_meta_title'] = wp_filter_nohtml_kses( $input['news_archive_meta_title'] );
  $input['news_archive_meta_description'] = wp_filter_nohtml_kses( $input['news_archive_meta_description'] );
  $input['interview_archive_meta_title'] = wp_filter_nohtml_kses( $input['interview_archive_meta_title'] );
  $input['interview_archive_meta_description'] = wp_filter_nohtml_kses( $input['interview_archive_meta_description'] );
  $input['staff_archive_meta_title'] = wp_filter_nohtml_kses( $input['staff_archive_meta_title'] );
  $input['staff_archive_meta_description'] = wp_filter_nohtml_kses( $input['staff_archive_meta_description'] );


  // Facebook OGPの設定
  $input['use_ogp'] = ! empty( $input['use_ogp'] ) ? 1 : 0;
  $input['ogp_image'] = wp_filter_nohtml_kses( $input['ogp_image'] );
  $input['fb_app_id'] = wp_filter_nohtml_kses( $input['fb_app_id'] );


  // Twitter Cardsの設定
  $input['twitter_account_name'] = wp_filter_nohtml_kses( $input['twitter_account_name'] );
  $input['twitter_cards_size'] = wp_filter_nohtml_kses( $input['twitter_cards_size'] );


	return $input;

};


?>