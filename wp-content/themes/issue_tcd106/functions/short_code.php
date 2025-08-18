<?php
/**
 * 吹き出しクイックタグ用ショートコード
 */
function tcd_shortcode_speech_balloon( $atts, $content, $tag ) {
  global $dp_options;
  if ( ! $dp_options ) $dp_options = get_design_plus_option();

  $atts = shortcode_atts( array(
    'user_image_url' => '',
    'user_name' => ''
  ), $atts );

  // user_image_urlが指定されていればメディアID取得・差し替えを試みる
  $user_image_url = $atts['user_image_url'];
  if ( $atts['user_image_url'] ) {
    $attachment_id = attachment_url_to_postid( $atts['user_image_url'] );
    if ( $attachment_id ) {
      $user_image = wp_get_attachment_image_src( $attachment_id, array( 300, 300, true ) );
      if ( $user_image ) {
        $atts['user_image_url'] = $user_image[0];
      }
    }
  }

  $html = '<div class="speach_balloon ' . esc_attr( $tag ) . '">'
      . '<div class="speach_balloon_user">';

  if ( $atts['user_image_url'] ) {
    $html .= '<img class="speach_balloon_user_image" src="' . esc_attr( $atts['user_image_url'] ) . '" alt="' . esc_attr( $atts['user_image_url'] ) . '">';
  }

  $html .= '<div class="speach_balloon_user_name">' . esc_html( $atts['user_name'] ) . '</div>'
      . '</div>'
      . '<div class="speach_balloon_text">' .  wpautop( $content )   . '</div>'
      .  '</div>';

  return $html;
}
// add_shortcode( 'speech_balloon_left1', 'tcd_shortcode_speech_balloon' );
// add_shortcode( 'speech_balloon_left2', 'tcd_shortcode_speech_balloon' );
// add_shortcode( 'speech_balloon_right1', 'tcd_shortcode_speech_balloon' );
// add_shortcode( 'speech_balloon_right2', 'tcd_shortcode_speech_balloon' );


function speech_balloon_template( $content, $i, $type = 'left' ) {

  $options = get_design_plus_option();

  $image = get_template_directory_uri().'/img/no_avatar.png';
  if($options['qt_speech_balloon'.$i.'_user_image']){
    $image = wp_get_attachment_image_src( $options['qt_speech_balloon'.$i.'_user_image'], array( 300, 300, true ) );
    if(!empty($image)) $image = $image[0];
  }
  $name = $options['qt_speech_balloon'.$i.'_user_name'];

  $html = '<div class="speech_balloon '.$type.'">'."\n";
  $html .= '<div class="speech_balloon_user">'."\n";
  $html .= '<img class="speech_balloon_user_image" src="'.esc_attr($image).'" alt="">'."\n";
  if($name) $html .= '<div class="speech_balloon_user_name">' . esc_html($name) . '</div>'."\n";
  $html .= '</div>'."\n";
  $html .= '<div class="speech_balloon_text speech_balloon'.$i.'">'."\n";
  $html .= '<span class="before"></span>';
  $html .= '<div class="speech_balloon_text_inner">'.wpautop( $content ).'</div>'."\n";
  $html .= '<span class="after"></span>';
  $html .= '</div>'."\n";
  $html .= '</div>'."\n";

  return $html;

}


function tcd_speech_balloon1( $attr, $content ) {
  return speech_balloon_template($content, 1, 'left');
}
add_shortcode( 'speech_balloon_left1', 'tcd_speech_balloon1' );

function tcd_speech_balloon2( $attr, $content ) {
  return speech_balloon_template($content, 2, 'left');
}
add_shortcode( 'speech_balloon_left2', 'tcd_speech_balloon2' );

function tcd_speech_balloon3( $attr, $content ) {
  return speech_balloon_template($content, 3, 'right');
}
add_shortcode( 'speech_balloon_right1', 'tcd_speech_balloon3' );

function tcd_speech_balloon4( $attr, $content ) {
  return speech_balloon_template($content, 4, 'right');
}
add_shortcode( 'speech_balloon_right2', 'tcd_speech_balloon4' );





/**
 * 吹き出しクイックタグ用ショートコード（フリー）
 */
function tcd_shortcode_speech_balloon_free( $atts, $content ) {

  $atts = shortcode_atts( array(
    'image' => '',
    'name' => '',
    'type' => 'left',
    'color' => '',
    'bg_color' => '',
    'border_color' => ''
  ), $atts );

  // user_image_urlが指定されていればメディアID取得・差し替えを試みる
  $image = get_template_directory_uri().'/img/no_avatar.png';
  $user_image_url = $atts['image'];
  if ( $atts['image'] ) {
    $attachment_id = attachment_url_to_postid( $atts['image'] );
    if ( $attachment_id ) {
      $user_image = wp_get_attachment_image_src( $attachment_id, array( 300, 300, true ) );
      if ( $user_image ) {
        $image = esc_attr($user_image[0]);
      }
    }
  }

  $name = esc_html($atts['name']);
  $type = esc_attr($atts['type']);
  $color = ($atts['color']) ? 'color:'.esc_attr($atts['color']).';' : '';
  $bg_color = ($atts['bg_color']) ? 'background-color:'.esc_attr($atts['bg_color']).';' : '';
  $border_color = ($atts['border_color']) ? 'border-color:'.esc_attr($atts['border_color']).';' : '';

  $border_right_color = ($atts['bg_color']) ? 'border-right-color:'.esc_attr($atts['bg_color']).';' : '';
  $border_left_color = ($atts['border_color']) ? 'border-left-color:'.esc_attr($atts['border_color']).';' : '';

  $html = '<div class="speech_balloon '.$type.'">'."\n";
  $html .= '<div class="speech_balloon_user">'."\n";
  $html .= '<img class="speech_balloon_user_image" src="'.$image.'" alt="">'."\n";
  if($name) $html .= '<div class="speech_balloon_user_name">' . $name . '</div>'."\n";
  $html .= '</div>'."\n";
  $html .= '<div class="speech_balloon_text">' ."\n";
  $html .= '<span class="before" style="'.$border_left_color.'"></span>';
  $html .= '<div class="speech_balloon_text_inner" style="'.$color.$bg_color.$border_color.'">' .  wpautop( $content )   . '</div>'."\n";
  $html .= '<span class="after" style="'.$border_right_color.'"></span>';
  $html .= '</div>'."\n";
  $html .= '</div>'."\n";

  return $html;
}
add_shortcode( 'speech_balloon_free', 'tcd_shortcode_speech_balloon_free' );




/**
 * Google Map用ショートコード
 */
function tcd_google_map($atts) {
  global $options;
  if ( ! $options ) $options = get_design_plus_option();

  $atts = shortcode_atts( array(
    'address' => '',
  ), $atts );

  $html = '';

  if ( $atts['address'] ) {

    $use_custom_overlay = 'type1' !== $options['qt_gmap_marker_type'] ? 1 : 0;
    $custom_marker_type = $options['qt_gmap_marker_type'] ? $options['qt_gmap_marker_type'] : 'type2';

    $marker_img = $options['qt_gmap_marker_img'] ? wp_get_attachment_url( $options['qt_gmap_marker_img'] ) : get_template_directory_uri().'/img/gmap_no_image.png';
    if(($custom_marker_type == 'type3') && !empty($marker_img)) {
      $marker_text = '';
    } else {
      $marker_text = $options['qt_gmap_marker_text'];
    }
    if($options['qt_access_saturation'] == 'default'){
      $access_saturation = 0;
    }else{
      $access_saturation = -100;
    }
    $rand = rand();

    $html .= "<div class='qt_google_map'>\n";
    $html .= " <div class='qt_googlemap clearfix'>\n";
    $html .= "  <div id='qt_google_map" . $rand . "' class='qt_googlemap_embed'></div>\n";
    $html .= " </div>\n";
    $html .= " <script defer>\n";
    $html .= " window.onload = function() {\n";
    $html .= "  initMap('qt_google_map" . $rand . "', '" . esc_js( $atts['address'] ) . "', " . esc_js( $access_saturation ) . ", " . esc_js( $use_custom_overlay ) . ", '" . esc_js( $marker_img ) . "', '" . esc_js( $marker_text ) . "');\n";
    $html .= " };\n";
    $html .= " </script>\n";
    $html .= "</div>\n";

    if ( ! wp_script_is( 'qt_google_map_api', 'enqueued' ) ) {
      wp_enqueue_script( 'qt_google_map_api', 'https://maps.googleapis.com/maps/api/js?key=' . esc_attr( $options['qt_gmap_api_key'] ), array(), version_num(), true );
      wp_enqueue_script( 'qt_google_map', get_template_directory_uri() . '/js/googlemap.js', array(), version_num(), true );
    }
  }

  return $html;
}
add_shortcode( 'qt_google_map', 'tcd_google_map' );
// 非同期で読み込み
function add_defer_attribute_to_google_maps($tag, $handle) {
  if ('qt_google_map_api' === $handle || 'qt_google_map' === $handle) {
    return str_replace(' src', ' defer="defer" src', $tag);
  }
  return $tag;
}




/**
 * FAQ用ショートコード
 */
function tcd_faq ( $content, $i,$attr = array() ) {
  global $post;
  
  if($attr['post_id']){
    $post_id = intval($attr['post_id']);
  } else {
    $post_id = intval($post->ID);
  }

  $faq_list = get_post_meta($post_id, 'faq_list'.$i, true);

  $html = '';

  if ( $faq_list ) {
    $html .= "<div class='faq_list'>\n";
    foreach ( $faq_list as $key => $value ) :
      $question = $value['question'];
      $answer = $value['answer'];
      if ( $question && $answer) {
        $html .= "<div class='item'>\n";
        $html .= '<div class="title no_editor_style"><span>' . esc_html($question) . "</span></div>\n";
        $html .= '<div class="desc_area"><p class="desc no_editor_style"><span>' . wp_kses_post(nl2br($answer)) . "</span></p></div>\n";
        $html .= "</div>\n";
      }
    endforeach;
    $html .= "</div>\n";
  }

  return $html;
}

function tcd_faq1( $attr, $content ) {
  $attr = shortcode_atts( array(
    'post_id' => '',
  ), $attr );
  return tcd_faq($content, 1, $attr);
}
add_shortcode( 'sc_faq1', 'tcd_faq1' );

function tcd_faq2( $attr, $content ) {
  $attr = shortcode_atts( array(
    'post_id' => '',
  ), $attr );
  return tcd_faq($content, 2, $attr);
}
add_shortcode( 'sc_faq2', 'tcd_faq2' );

function tcd_faq3( $attr, $content ) {
  $attr = shortcode_atts( array(
    'post_id' => '',
  ), $attr );
  return tcd_faq($content, 3, $attr);
}
add_shortcode( 'sc_faq3', 'tcd_faq3' );

function tcd_faq4( $attr, $content ) {
  $attr = shortcode_atts( array(
    'post_id' => '',
  ), $attr );
  return tcd_faq($content, 4, $attr);
}
add_shortcode( 'sc_faq4', 'tcd_faq4' );

function tcd_faq5( $attr, $content ) {
  $attr = shortcode_atts( array(
    'post_id' => '',
  ), $attr );
  return tcd_faq($content, 5, $attr);
}
add_shortcode( 'sc_faq5', 'tcd_faq5' );


/**
 * タブコンテンツ
 */
function qt_tab_content($atts) {

  $atts = shortcode_atts( array(
    'tab1' => '',
    'img1' => '',
    'tab2' => '',
    'img2' => '',
  ), $atts );


  $html = '';

  if ( $atts['tab1'] || $atts['tab2']) {

  $html .= "<div class='qt_tab_content_wrap'>\n";

  $html .= "<div class='qt_tab_content_header'>\n";

  if ( $atts['tab1'] ) {
    $html .= '<div class="item active" data-tab-target=".qt_tab_content1">' . esc_html($atts['tab1']) . "</div>\n";
  }
  if ( $atts['tab2'] ) {
    $html .= '<div class="item" data-tab-target=".qt_tab_content2">' . esc_html($atts['tab2']) . "</div>\n";
  }

  $html .= "</div>\n";

  $html .= "<div class='qt_tab_content_main'>\n";

  if ( $atts['img1'] ) {
    $html .= '<div class="qt_tab_content active qt_tab_content1">' . "\n";
    if ( $atts['img1'] ) {
      $html .= '<img src="' . esc_url($atts['img1']) . '" title="" alt="">' . "\n";
      $image_id = attachment_url_to_postid($atts['img1']);
      $image_caption = $image_id ?  get_post($image_id)->post_excerpt : '';
      if ($image_caption) {
        $html .= '<p class="desc">' . wp_kses_post($image_caption) . "</p>\n";
      }
    }
    $html .= "</div>\n";
  }

  if ( $atts['img2'] ) {
    $html .= '<div class="qt_tab_content qt_tab_content2">' . "\n";
    if ( $atts['img2'] ) {
      $html .= '<img src="' . esc_url($atts['img2']) . '" title="" alt="">' . "\n";
      $image_id = attachment_url_to_postid($atts['img2']);
      $image_caption = $image_id ?  get_post($image_id)->post_excerpt : '';
      if ($image_caption) {
        $html .= '<p class="desc">' . wp_kses_post($image_caption) . "</p>\n";
      }
    }
    $html .= "</div>\n";
  }

  $html .= "</div>\n";

  $html .= "</div>\n";

  };

  return $html;
}
add_shortcode( 'tcd_tab', 'qt_tab_content' );


// インタビュー
function interview_template( $content, $i ) {

  global $post;
  $options = get_design_plus_option();

  $last_name = get_post_meta($post->ID, 'interview_last_name' . $i, true);
  $image = get_post_meta($post->ID, 'interview_image' . $i, true);

  $html = '';
  $html .= '<div class="interviewer_content">'."\n";
  $html .= '<div class="left_content">'."\n";
  if($image){
    $image = wp_get_attachment_image_src($image, 'full');
    $html .= '<img loading="lazy" src="' . esc_attr($image[0]) . '" alt="" width="' . esc_attr($image[1]) . '" height="' .  esc_attr($image[2]) . '" />' . "\n";
  }
  if($last_name){
    $html .= '<p class="name">'. esc_html($last_name) . "</p>\n";
  }
  $html .= '</div>'."\n";
  $html .= '<div class="right_content">'."\n";
  $html .= wpautop( $content ) . "\n";
  $html .= '</div>'."\n";
  $html .= '</div>'."\n";

  return $html;

}

function tcd_interview1( $attr, $content ) {
  return interview_template($content, 1);
}
add_shortcode( 'interviewer1', 'tcd_interview1' );

function tcd_interview2( $attr, $content ) {
  return interview_template($content, 2);
}
add_shortcode( 'interviewer2', 'tcd_interview2' );

function tcd_interview3( $attr, $content ) {
  return interview_template($content, 3);
}
add_shortcode( 'interviewer3', 'tcd_interview3' );

function tcd_interview4( $attr, $content ) {
  return interview_template($content, 4);
}
add_shortcode( 'interviewer4', 'tcd_interview4' );

function tcd_interview5( $attr, $content ) {
  return interview_template($content, 5);
}
add_shortcode( 'interviewer5', 'tcd_interview5' );

function tcd_interview6( $attr, $content ) {
  return interview_template($content, 6);
}
add_shortcode( 'interviewer6', 'tcd_interview6' );


/**
 * スクロールコンテンツ
 */
function tcd_scroll_content( $atts) {
  global $post;

  $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true) ?  get_post_meta($post->ID, 'hide_sidebar', true) : 'right';
  if(is_page_template('page-tcd-lp.php') || is_page_template('page-tcd-tab.php')) {
    $hide_sidebar = 'hide';
  }

  $html = '';

  if($hide_sidebar == 'hide'){

    $section_total = 0;
    $section_num = 1;
    $randomNumber = mt_rand(0, 999999);
    for($i = 1; $i <= 3; $i++) :
      $content_type = get_post_meta($post->ID, 'scroll_content_type' . $i, true) ?  get_post_meta($post->ID, 'scroll_content_type' . $i, true) : 'type1';
      $headline = get_post_meta($post->ID, 'scroll_content_headline' . $i, true);
      $image = get_post_meta($post->ID, 'scroll_content_image' . $i, true);
      $catch = get_post_meta($post->ID, 'scroll_content_catch' . $i, true);
      $desc = get_post_meta($post->ID, 'scroll_content_desc' . $i, true);
      $button_label = get_post_meta($post->ID, 'scroll_content_button_label' . $i, true);
      $bg_image = get_post_meta($post->ID, 'scroll_content_image2_' . $i, true);
     if( ($content_type == 'type1' && ($headline || $catch || $desc || $button_label || $bg_image)) || ($content_type == 'type2' && ($image || $catch || $desc || $button_label || $bg_image)) ){
        $section_total++;
      }
    endfor;

    // TCDCEプラグインで書き換えれるように終了タグにフィルターを追加
    $html .= apply_filters( 'tcd_scroll_content_start', "</div><!-- END .post_content -->\n" );

    $html .= "<div class='scroll_content_space'></div>\n";
    if($section_total == 1){
      $html .= "<div class='scroll_content logo_change_trigger one_content' style='height:calc(100vh + (100vh * " . $section_total . ") );'>\n";
    } else {
      $html .= "<div class='scroll_content logo_change_trigger' style='height:calc(100vh + (100vh * " . $section_total . ") );'>\n";
    }
    $html .= "<div class='scroll_content_inner'>\n";
    for($i = 1; $i <= 3; $i++) :
      $content_type = get_post_meta($post->ID, 'scroll_content_type' . $i, true) ?  get_post_meta($post->ID, 'scroll_content_type' . $i, true) : 'type1';
      $headline = get_post_meta($post->ID, 'scroll_content_headline' . $i, true);
      $image = get_post_meta($post->ID, 'scroll_content_image' . $i, true);
      $sub_title = get_post_meta($post->ID, 'scroll_content_sub_title' . $i, true);
      $catch = get_post_meta($post->ID, 'scroll_content_catch' . $i, true);
      $desc = get_post_meta($post->ID, 'scroll_content_desc' . $i, true);
      $desc_mobile = get_post_meta($post->ID, 'scroll_content_desc_mobile' . $i, true);
      $button_label = get_post_meta($post->ID, 'scroll_content_button_label' . $i, true);
      $button_url = get_post_meta($post->ID, 'scroll_content_button_url' . $i, true);
      $button_target = get_post_meta($post->ID, 'scroll_content_button_target' . $i, true);
      $bg_type = get_post_meta($post->ID, 'scroll_content_bg_type' . $i, true) ?  get_post_meta($post->ID, 'scroll_content_bg_type' . $i, true) : 'type1';
      $bg_image = get_post_meta($post->ID, 'scroll_content_image2_' . $i, true) ? wp_get_attachment_image_src(get_post_meta($post->ID, 'scroll_content_image2_' . $i, true), 'full') : '';
      $bg_image_mobile = get_post_meta($post->ID, 'scroll_content_image2_mobile_' . $i, true) ? wp_get_attachment_image_src(get_post_meta($post->ID, 'scroll_content_image2_mobile_' . $i, true), 'full') : '';
      if(!$bg_image_mobile){
        $bg_image_mobile = get_post_meta($post->ID, 'scroll_content_image2_' . $i, true) ?  wp_get_attachment_image_src(get_post_meta($post->ID, 'scroll_content_image2_' . $i, true), 'size4') : '';
      }
      $overlay_color = get_post_meta($post->ID, 'scroll_content_overlay_color' . $i, true) ?  get_post_meta($post->ID, 'scroll_content_overlay_color' . $i, true) : '#000000';
      $overlay_color = hex2rgb($overlay_color);
      $overlay_color = implode(",",$overlay_color);
      $overlay_opacity = get_post_meta($post->ID, 'scroll_content_overlay_opacity' . $i, true) ?  get_post_meta($post->ID, 'scroll_content_overlay_opacity' . $i, true) : '0.3';
      $bg_color = get_post_meta($post->ID, 'scroll_content_bg_color' . $i, true) ?  get_post_meta($post->ID, 'scroll_content_bg_color' . $i, true) : '#000000';
      if( ($content_type == 'type1' && ($headline || $catch || $desc || $button_label || $bg_image)) || ($content_type == 'type2' && ($image || $catch || $desc || $button_label || $bg_image)) ){
      /*** 背景にて「背景画像」が選択されているとき ***/
      if($bg_type == 'type1' ){
        
          /*** モバイルサイズ時の背景画像のみ登録されている場合は、PCもモバイルの画像を利用する ***/
          if( (!isset($bg_image) || empty($bg_image)) && (isset($bg_image_mobile) && !empty($bg_image_mobile) )){
            $bg_image =  $bg_image_mobile;
          }
          
          /*** 画像が登録されていない場合は、背景色を黒にする ***/
          if( ( !isset($bg_image) || empty($bg_image)) && (!isset($bg_image_mobile) || empty($bg_image_mobile) )){
            $bg_type = 'type2';
            $bg_color =  '#000000';
          }
        } // $bg_type == 'type1' 
        
        if($bg_type == 'type2'){
          $html .= "<section id='scroll_content_section_" . $section_num . '_' . $randomNumber . "' class='scroll_content_section' style='background:" . $bg_color . ";'>\n";
        } else {
          $html .= "<section id='scroll_content_section_" . $section_num . '_' . $randomNumber . "' class='scroll_content_section'>\n";
        }
        $html .= "<div class='content'>\n";
        if($content_type == 'type1'){
          if($headline){
            $html .= "<h2 class='headline item'>" . wp_kses_post(nl2br($headline)) . "</h2>\n";
          }
          if($sub_title){
            $html .= "<p class='sub_title item'>" . wp_kses_post(nl2br($sub_title)) . "</p>\n";
          }
        }
        if($image || $catch || $desc || $button_label){
          if($content_type == 'type2' && $image){
            $image = wp_get_attachment_image_src($image, 'full');
            $html .= "<div class='circle_image item'>\n";
            $html .= "<div class='circle_image_inner'>\n";
            $html .= "<img loading='lazy' src='" . esc_attr($image[0]) . "' alt='' width='" . esc_attr($image[1]) . "' height='" .  esc_attr($image[2]) . "' />\n";
            $html .= "</div>\n";
            $html .= "</div>\n";
          }
          if($catch){
            $html .= "<h3 class='catch item'>" . wp_kses_post(nl2br($catch)) . "</h3>\n";
          }
          if($desc){
            if($desc_mobile){
              $html .= "<div class='desc item'>\n";
              $html .= "<p class='pc'>" . wp_kses_post(nl2br($desc)) . "</p>\n";
              $html .= "<p class='mobile'>" . wp_kses_post(nl2br($desc_mobile)) . "</p>\n";
              $html .= "</div>\n";
            } else {
              $html .= "<div class='desc item'>\n";
              $html .= "<p>" . wp_kses_post(nl2br($desc)) . "</p>\n";
              $html .= "</div>\n";
            }
          }
          if($button_label && $button_url){
            if($content_type == 'type2' && $image){
              $html .= "<div class='link_button type2 item'>\n";
            } else {
              $html .= "<div class='link_button item'>\n";
            }
            if($button_target){
              $html .= "<a class='design_button' href='" . esc_url($button_url) . "' target='_blank'>" . esc_html($button_label) . "</a>\n";
            } else {
              $html .= "<a class='design_button' href='" . esc_url($button_url) . "'>" . esc_html($button_label) . "</a>\n";
            }
            $html .= "</div>\n";
          }
        }
        $html .= "</div>\n";
        if($bg_type == 'type1' && $bg_image){
          $html .= "<div class='overlay' style='background:rgba(" . esc_attr($overlay_color) . "," . esc_attr($overlay_opacity) . ");'></div>\n";
          $html .= "<picture class='bg_image'>\n";
          $html .= "<source media='(max-width: 650px)' srcset='" . esc_attr($bg_image_mobile[0]) . "'>\n";
          $html .= "<img loading='lazy' fetchpriority='low' src='" .  esc_attr($bg_image[0]) . "' alt='' width='" . esc_attr($bg_image[1]) . "' height='" . esc_attr($bg_image[2]) . "'>\n";
          $html .= "</picture>\n";
        }
        $html .= "</section>\n";
        $section_num++;
      }
    endfor;
    $html .= "<div class='scroll_content_nav'>\n";
    $html .= "<ol class='scroll_content_nav_list'>\n";
    for($i = 1; $i <= $section_total; $i++) :
      $html .= "<li id='scroll_content_nav_" . $i . '_' . $randomNumber . "' class='scroll_content_nav_item'>0" . $i . "</li>\n";
    endfor;
    $html .= "</ol>\n";
    $html .= "</div>\n"; // END .scroll_content_nav
    $html .= "</div>\n"; // END .scroll_content_inner
    $html .= "<div class='scroll_content_spacer'>\n";
    for($i = 1; $i <= $section_total; $i++) :
      $html .= "<div class='scroll_content_spacer_item' data-section='" . $i . '_' . $randomNumber . "'></div>\n";
    endfor;
    $html .= "</div>\n"; // END .scroll_content_spacer
    $html .= "</div>\n"; // END .scroll_content
    $html .= "<div class='scroll_content_space'></div>\n";

    // TCDCEプラグインで書き換えれるように開始タグにフィルターを追加
    $html .= apply_filters( 'tcd_scroll_content_end', "<div class='post_content clearfix'>\n" );
  };

  return $html;
}
add_shortcode( 'sc_scroll_content', 'tcd_scroll_content' );


?>