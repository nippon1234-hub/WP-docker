<?php
/*
 * ヘッダーの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );


// タブの名前
function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-issue' );
	return $tab_labels;
}


// 初期値
function add_header_dp_default_options( $dp_default_options ) {

	$dp_default_options['header_menu_type'] = 'type1';

  //ボタン
  $dp_default_options['header_button_label1'] = __('Button', 'tcd-issue');
  $dp_default_options['header_button_url1'] = '#';
  $dp_default_options['header_button_target1'] = '';
  $dp_default_options['header_button_label2'] = '';
  $dp_default_options['header_button_url2'] = '';
  $dp_default_options['header_button_target2'] = '';

  // メッセージ
	$dp_default_options['show_header_message'] = 'hide';
	$dp_default_options['header_message'] = __('Header message', 'tcd-issue');
  $dp_default_options['header_message_url'] = '';
  $dp_default_options['header_message_target'] = '';
  $dp_default_options['header_message_font_color'] = '#ffffff';
  $dp_default_options['header_message_bg_color'] = '#0a578c';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $basic_display_options, $bool_options, $logo_type_options, $font_type_options, $header_type_options;

  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-issue' );
  $interview_label = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Conversation', 'tcd-issue' );
  $staff_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Staff', 'tcd-issue' );

  $main_color = $options['main_color'];

?>

<div id="tab-content-header" class="tab-content">


   <?php // メッセージ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header message', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/header_message.jpg?2.0" alt="" title="" />
     </div>

     <div class="theme_option_message2">
      <p><?php _e('The "header message" is displayed at the top of the site (above the header bar).', 'tcd-issue'); ?></br>
      <?php _e('If you are using LP template, you can set display setting individually from page edit screen.', 'tcd-issue'); ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Header message', 'tcd-issue');  ?></span><?php echo tcd_basic_radio_button($options, 'show_header_message', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Message', 'tcd-issue');  ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[header_message]"><?php echo esc_textarea( $options['header_message'] ); ?></textarea></li>
      <li class="cf">
       <span class="label"><?php _e('URL', 'tcd-issue'); ?></span>
       <div class="admin_link_option">
        <input type="text" name="dp_options[header_message_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['header_message_url'] ); ?>">
        <input id="header_message_target" class="admin_link_option_target" name="dp_options[header_message_target]" type="checkbox" value="1" <?php checked( $options['header_message_target'], 1 ); ?>>
        <label for="header_message_target">&#xe920;</label>
       </div>
      </li>
      <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[header_message_font_color]" value="<?php echo esc_attr( $options['header_message_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[header_message_bg_color]" value="<?php echo esc_attr( $options['header_message_bg_color'] ); ?>" data-default-color="#0a578c" class="c-color-picker"></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 基本設定 ----------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header bar', 'tcd-issue');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <?php // デザイン ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e( 'Design', 'tcd-issue' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Drawer menu displays only up to two levels.', 'tcd-issue'); ?></p>
     </div>
     <?php echo tcd_admin_image_radio_button($options, 'header_menu_type', $header_type_options) ?>

     <?php // ロゴ ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e( 'Logo', 'tcd-issue' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('You can set logo from "Basic Settings" logo section.', 'tcd-issue'); ?></p>
     </div>

     <?php // メニュー ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e( 'Menu', 'tcd-issue' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('You can set menu from <a href="./nav-menus.php">custom menu</a> page.', 'tcd-issue'); ?></p>
     </div>

     <?php // ボタン ----------------------------------------------------------------- ?>
     <div class="header_menu_type2_option">
      <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-issue');  ?></h4>

      <div class="theme_option_message2">
       <p><?php _e('Leave the "URL" field blank if you don\'t want to display button.', 'tcd-issue'); ?></p>
      </div>

      <div class="sub_box_tab">
       <?php for($i = 1; $i <= 2; $i++) : ?>
       <div class="tab<?php if($i == 1){ echo ' active'; }; ?>" data-tab="tab<?php echo $i; ?>"><span class="label"><?php printf(__('Button%s', 'tcd-issue'), $i); ?></span></div>
       <?php endfor; ?>
      </div>

      <?php for($i = 1; $i <= 2; $i++) : ?>
      <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Label', 'tcd-issue');  ?></span><input class="full_width tab_label" type="text" placeholder="<?php _e( 'e.g.', 'tcd-issue' ); _e( 'Invoice', 'tcd-issue' ); ?>" name="dp_options[header_button_label<?php echo $i; ?>]" value="<?php echo esc_textarea( $options['header_button_label'.$i] ); ?>" /></li>
       <li class="cf">
        <span class="label"><?php _e('URL', 'tcd-issue'); ?></span>
        <div class="admin_link_option">
         <input type="text" name="dp_options[header_button_url<?php echo $i; ?>]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['header_button_url'.$i] ); ?>">
         <input id="header_button_target<?php echo $i; ?>" class="admin_link_option_target" name="dp_options[header_button_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['header_button_target'.$i], 1 ); ?>>
         <label for="header_button_target<?php echo $i; ?>">&#xe920;</label>
        </div>
       </li>
      </ul>

      </div><!-- END .sub_box_tab_content -->
      <?php endfor; ?>

     </div><!-- END .header_menu_type2_option -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-issue' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-issue' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_header_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_theme_options_validate( $input ) {

  global $dp_default_options, $logo_type_options;

  $input['header_menu_type'] = wp_filter_nohtml_kses( $input['header_menu_type'] );

  // ボタン
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['header_button_label'.$i] = wp_filter_nohtml_kses( $input['header_button_label'.$i] );
    $input['header_button_url'.$i] = wp_filter_nohtml_kses( $input['header_button_url'.$i] );
    $input['header_button_target'.$i] = wp_filter_nohtml_kses( $input['header_button_target'.$i] );
  }

  // メッセージ
  $input['show_header_message'] = wp_filter_nohtml_kses( $input['show_header_message'] );
  $input['header_message'] = wp_filter_nohtml_kses( $input['header_message'] );
  $input['header_message_url'] = wp_filter_nohtml_kses( $input['header_message_url'] );
  $input['header_message_target'] = wp_filter_nohtml_kses( $input['header_message_target'] );
  $input['header_message_font_color'] = sanitize_hex_color( $input['header_message_font_color'] );
  $input['header_message_bg_color'] = sanitize_hex_color( $input['header_message_bg_color'] );


  return $input;

};


?>