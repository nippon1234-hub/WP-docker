<?php


// 言語ファイル --------------------------------------------------------------------------------
load_textdomain('tcd-issue', dirname(__FILE__).'/languages/tcd-issue-' . determine_locale() . '.mo');


// テーマの説明文
__('WordPress theme "ISSUE" is a template for recruitment websites. It features memorable animations and rich leading line design, and it has options to produce staff introductions, dialogue contents, interview articles, and so on.', 'tcd-issue');


// hook wp_head --------------------------------------------------------------------------------
require get_template_directory() . '/functions/head.php';


// テーマオプション --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/admin/theme-options.php' );
$options = get_design_plus_option();

// セットアップ -------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/theme-setup.php' );

// 更新通知 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/update-notifier.php' );

// マニュアル --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/manual.php' );


// カスタマイザー設定( 外観 > ウィジェットから設定を取り除く)----------------------------------
require_once  ( dirname(__FILE__) . '/functions/customizer.php' );

// 「トップページ」と「ブログ一覧ページ」用の固定ページ作成機能の実装----------------------------------
require_once  ( dirname(__FILE__) . '/functions/class-page-new.php' );

// 新フォント機能 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/admin/font/hooks-font.php' );

// フロントページ用スクリプト --------------------------------------------------------------
function front_page_scripts(){

  $options = get_design_plus_option();

  wp_enqueue_script('tcd-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);
  if( is_front_page() ) {
    wp_enqueue_script( 'header-slider', get_template_directory_uri() . '/js/header-slider.js', array(), version_num(), true );
  }

  wp_enqueue_style( 'main-style', get_stylesheet_uri(), false, version_num(), 'all');
  wp_enqueue_style( 'design-plus', get_template_directory_uri() . '/css/design-plus.css', array('main-style'),version_num() );
  wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css', array('main-style'),version_num() );
  wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array('main-style'),version_num(), 'screen and (max-width:1391px)' );
  if ( $options['use_google_material_icon'] == 1 ) {
    wp_enqueue_style( 'google-material-icon-css', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200', array('main-style'), version_num() );
  }
  if(wp_is_mobile()) {
    wp_enqueue_style( 'footer-bar', get_template_directory_uri() . '/css/footer-bar.css', array('main-style'),version_num(), 'screen and (max-width:1391px)' );
  };

  // wp_enqueue_script( 'jquery' );
  wp_deregister_script('jquery');
  if (isset($wp_scripts->registered['jquery']->ver)) {
    $jquery_version = $wp_scripts->registered['jquery']->ver;
  } else {
    $jquery_version = '3.4.1';
  }
  wp_enqueue_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@' . $jquery_version . '/dist/jquery.min.js', array(), $jquery_version, true);
  if ( is_single() ) {
    wp_enqueue_script('comment-reply');
    wp_enqueue_script( 'comment', get_template_directory_uri() . '/js/comment.js', array(), version_num(), true );
  }
  wp_enqueue_script( 'jquery.easing.1.4', get_template_directory_uri() . '/js/jquery.easing.1.4.js', array(), version_num(), true );
  wp_enqueue_script( 'jscript', get_template_directory_uri() . '/js/jscript.js', array(), version_num(), true );
  wp_enqueue_script( 'jquery.cookie.min', get_template_directory_uri() . '/js/tcd_cookie.js', array(), version_num(), true );

}
add_action('wp_enqueue_scripts', 'front_page_scripts', 8); //8が無いとブロックエディタによって上書きされる


/**
 * ブロックエディタ関連スクリプトの読み込みを制御
 */
function manage_block_scripts() {
  $options = get_design_plus_option();
  //記事ページ、固定ページ（トップページ以外）、トップページ（通常コンテンツver）では必ず読み込む
  if (is_single() || (is_page() && !is_front_page()) || (is_front_page() && $options['index_content_type'] == 'type2')) {
    return;
  }
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('global-styles');
  wp_dequeue_style('classic-theme-styles');
  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
  remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
}
add_action('wp_enqueue_scripts', 'manage_block_scripts', 9999);


// 管理画面用スクリプト --------------------------------------------------------------------------
function my_admin_scripts() {
  $options = get_design_plus_option();
  wp_enqueue_script( 'wp-color-picker');
  wp_enqueue_script('thickbox');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('font_ui', get_template_directory_uri().'/admin/font/ui/font_ui.js', '', '1.0.4', true);
  wp_enqueue_script('ml-widget-js', get_template_directory_uri().'/widget/js/script.js', '', '1.0.0', true);
  wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/js/jquery.cookieTab.js', '', '1.0.0', true);
  wp_enqueue_script('jquery.cookie', get_template_directory_uri().'/js/jquery.cookie.min.js', '', '1.0.0', true);
  wp_enqueue_script('my_script', get_template_directory_uri().'/admin/js/my_script.js', '', '1.1.4', true);
  wp_enqueue_script('new_ui', get_template_directory_uri().'/admin/js/new_ui.js', '', '1.0.4', true);
  wp_enqueue_script('lightcase_script', get_template_directory_uri().'/admin/js/lightcase/lightcase.js', '', '1.0.0', true);
  wp_localize_script( 'my_script', 'TCD_MESSAGES', array(
    'cookieResetSuccess' => __( 'Cookie has been deleted', 'tcd-issue' ),
    'ajaxSubmitSuccess' => __( 'Settings Saved Successfully', 'tcd-issue' ),
    'ajaxSubmitError' => __( 'Can not save data. Please try again', 'tcd-issue' ),
    'tabChangeWithoutSave' => __( "Your changes on the current tab have not been saved.\nTo stay on the current tab so that you can save your changes, click Cancel.", 'tcd-issue' ),
    'contentBuilderDelete' => __( 'Are you sure you want to delete this content?', 'tcd-issue' ),
    'imageContentWidthMessage' => __( '<span>You can display image by content width when you displaying border around the content on LP page.</span>', 'tcd-issue' ),
    'mainColor' => $options['main_color'],
    'deleteCookie' => __( 'Cookie is deleted', 'tcd-issue' ),
    'font_color_picker' => __( 'Font color', 'tcd-issue' ),
    'bg_color_picker' => __( 'Background color', 'tcd-issue' ),
    'font_color_picker_hover' => __( 'Font hover color', 'tcd-issue' ),
    'bg_color_picker_hover' => __( 'Background hover color', 'tcd-issue' ),
  ) );
  wp_enqueue_media();//画像アップロード用
  wp_enqueue_script('cf-media-field', get_template_directory_uri().'/admin/js/cf-media-field.js', '', '1.0.0', true); //画像アップロード用
  wp_localize_script( 'cf-media-field', 'cfmf_text', array(
    'image_title' => __( 'Please select image', 'tcd-issue' ),
    'image_button' => __( 'Use this image', 'tcd-issue' ),
    'video_title' => __( 'Please select MP4 file', 'tcd-issue' ),
    'video_button' => __( 'Use this MP4 file', 'tcd-issue' ),
    'image_save' => __( 'Save', 'tcd-issue' ),
  ) );
  wp_enqueue_script('multi-media-uploader', get_template_directory_uri().'/admin/js/multi-media-uploader.js', '', '1.0.3', true); //複数画像アップロード用
  wp_localize_script( 'multi-media-uploader', 'MULTI_UPLOADER_TEXTS', array(
    'image_title' => __( 'Please select image', 'tcd-issue' ),
    'image_button' => __( 'Use this image', 'tcd-issue' ),
    'image_save' => __( 'Save', 'tcd-issue' ),
  ) );

}
add_action('admin_print_scripts', 'my_admin_scripts');


// 管理画面用スタイルシートの読み込み -----------------------------------------------------------------------
function my_admin_styles() {
  wp_enqueue_style('imgareaselect');
  wp_enqueue_style('jquery-ui-draggable');
  wp_enqueue_style('wp-color-picker');
  wp_enqueue_style('thickbox');
  wp_enqueue_style( 'editor-buttons' );
  wp_enqueue_style('font_ui_css', get_template_directory_uri() . '/admin/font/ui/font_ui.css','','1.0.0');
  wp_enqueue_style('my_widget_css', get_template_directory_uri() . '/widget/css/style.css','','1.0.0');
  wp_enqueue_style('my_admin_css', get_template_directory_uri() .'/admin/css/my_admin.css','','1.1.0');
  wp_enqueue_style('new_ui_css', get_template_directory_uri() .'/admin/css/new_ui.css','','1.0.7');
  wp_enqueue_style('lightcase_style', get_template_directory_uri() . '/admin/js/lightcase/lightcase.css','','1.0.2');
  wp_enqueue_style( 'google-material-icon-css', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200', '', version_num() );
}
add_action('admin_print_styles', 'my_admin_styles');


//　サムネイルの設定 --------------------------------------------------------------------------------
add_theme_support( 'post-thumbnails' );
add_image_size( 'size1', 220, 220, true );
add_image_size( 'size2', 715, 410, true );// ブログ、お知らせ詳細ページのメイン画像　アーカイブでも使用
add_image_size( 'size3', 672, 384, true );// ブログ、お知らせ詳細ページのおすすめ記事
add_image_size( 'size4', 680, 940, true );// スタッフ　デザインtype1　アーカイブ
add_image_size( 'size5', 1034, 500, true );// スタッフ　デザインtype2　アーカイブ
add_image_size( 'size6', 960, 400, true );// インタビュー　アーカイブ


// アイキャッチ画像登録エリアに推奨サイズを表示する
function message_image_meta_box($content, $post_id, $thumbnail_id) {
  $post = get_post($post_id);
  $options = get_design_plus_option();
  if ( $post->post_type == 'post' || $post->post_type == 'news') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '715', '410') . '</p>';
    return $content;
  }
  if ( $post->post_type == 'interview') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '1740', '720') . '</p>';
    return $content;
  }
  if ( $post->post_type == 'staff') {
    if($options['staff_design_type'] == 'type1'){
      $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '870', '1200') . '</p>';
    } else {
      $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-issue'), '1740', '840') . '</p>';
    }
    return $content;
  }
  if ( $post->post_type == 'page') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.<br>This image will be used in search result and OGP tag.', 'tcd-issue'),'1200','630') . '</p>';
    return $content;
  }
  return $content;
}
add_filter('admin_post_thumbnail_html', 'message_image_meta_box', 10, 3);


// ウィジェット ------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/widget/tab_post_list.php' );
require_once ( dirname(__FILE__) . '/widget/post_slider.php' );
if($options['use_staff']){
  require_once ( dirname(__FILE__) . '/widget/staff_slider.php' );
}
if($options['use_interview']){
  require_once ( dirname(__FILE__) . '/widget/interview_slider.php' );
}

$news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-issue' );

register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => __('Common widget', 'tcd-issue'),
  'description' => __('Widgets set in this area are displayed as basic widget in the sidebar of all pages. If there are individual settings, the widget will be displayed.', 'tcd-issue'),
  'id' => 'common_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<p class="widget_headline"><span>',
  'after_title' => "</span></p>",
  'name' => __('Common widget (smarphone)', 'tcd-issue'),
  'description' => __('Widgets set in this area are displayed as basic widget in the sidebar of all pages. If there are individual settings, the widget will be displayed.', 'tcd-issue'),
  'id' => 'common_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<p class="widget_headline"><span>',
  'after_title' => "</span></p>",
  'name' => __('Post page', 'tcd-issue'),
  'id' => 'post_single_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<p class="widget_headline"><span>',
  'after_title' => "</span></p>",
  'name' => __('Post page (smartphone)', 'tcd-issue'),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-issue'),
  'id' => 'post_single_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<p class="widget_headline"><span>',
  'after_title' => "</span></p>",
  'name' => sprintf(__('%s page', 'tcd-issue'), $news_label),
  'id' => 'news_single_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<p class="widget_headline"><span>',
  'after_title' => "</span></p>",
  'name' => sprintf(__('%s page (smartphone)', 'tcd-issue'), $news_label),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-issue'),
  'id' => 'news_single_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<p class="widget_headline"><span>',
  'after_title' => "</span></p>",
  'name' => __('Page', 'tcd-issue'),
  'id' => 'page_single_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<p class="widget_headline"><span>',
  'after_title' => "</span></p>",
  'name' => __('Page (smartphone)', 'tcd-issue'),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-issue'),
  'id' => 'page_single_widget_mobile'
));


// ウィジェットのブロックエディタ無効化
function example_theme_support() {
  remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );


// ウィジェットのタイトルが空の場合見出しを表示しない
function hide_widget_title_if_empty ( $title, $instance = array(), $id_base = null ) {
	if ( empty( $instance['title'] ) ) {
		$title = '';
	}
	return $title;
}
add_filter( 'widget_title', 'hide_widget_title_if_empty', 10, 3 );


// アーカイブ・カテゴリーウィジェットの文言を変更
function change_widget_text( $translated, $original, $domain ) {
  if ( $translated == "月を選択" ) {
    $translated = "アーカイブ";
  }
  if ( $translated == "カテゴリーを選択" ) {
    $translated = "カテゴリー";
  }
  return $translated;
}
add_filter( 'gettext', 'change_widget_text', 10, 3 );


// カテゴリーウィジェットの記事数をspanで囲む
function smittenkitchen_cat_count_span( $links ) {
	$links = str_replace( '</a> (', '</a><span class="post-count">', $links );
	$links = str_replace( ')', '</span>', $links );
	return $links;
}
add_filter( 'wp_list_categories', 'smittenkitchen_cat_count_span' );


// アーカイブウィジェットの記事数をspanで囲む
function smittenkitchen_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a><span class="post-count">', $links );
	$links = str_replace( ')</li>', '</span></li>', $links );
	return $links;
}
add_filter( 'get_archives_link', 'smittenkitchen_archive_count_span' );


// カードリンクパーツ --------------------------------------------------------------------------------
require get_template_directory() . '/functions/clink.php';


// フッターバー --------------------------------------------------------------------------------
require get_template_directory() . '/functions/footer-bar.php';


// おすすめ記事 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/recommend.php';
require get_template_directory() . '/functions/recommend_news.php';
require get_template_directory() . '/functions/recommend_staff.php';
require get_template_directory() . '/functions/recommend_interview.php';


// アクセス数 --------------------------------------------------------------------------------------
//require get_template_directory() . '/functions/views.php';


// meta title meta description  --------------------------------------------------------------------------------
add_theme_support('title-tag');
require_once ( dirname(__FILE__) . '/functions/seo.php' );


// 管理画面の記事一覧、クイック編集 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/admin_column.php';
require get_template_directory() . '/functions/quick_edit.php';


// カスタムフィールド --------------------------------------------------------------------------------
require get_template_directory() . '/functions/page_cf.php';
require get_template_directory() . '/functions/blog_category_cf.php';
require get_template_directory() . '/functions/interview_cf.php';
require get_template_directory() . '/functions/staff_cf.php';
require get_template_directory() . '/functions/staff_category_cf.php';
require get_template_directory() . '/functions/news_category_cf.php';


// 並び替え --------------------------------------------------------------------------------
require get_template_directory() . '/functions/post_order.php';


// カスタムCSS・スクリプト --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_script.php';


// ビジュアルエディタにクイックタグを追加 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_editor.php';


// ショートコード --------------------------------------------------------------------------------
require get_template_directory() . '/functions/short_code.php';


// カスタムページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/custom_page_link.php' );


// OGP tag  -------------------------------------------------------------------------------------------
require get_template_directory() . '/functions/ogp.php';


// 次のページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/next_prev.php' );


//ロゴ用関数 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/logo.php' );


// プロフィール追加情報 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/user-profile.php';


// ロードアイコン -----------------------------------------------------------------------------
require get_template_directory() . '/functions/load_icon.php';
require get_template_directory() . '/functions/footer_script.php';


// パスワード保護 -----------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/password_form.php' );


// 高速化 --------------------------------------------------------------------------------
require ( dirname(__FILE__) . '/functions/acceleration.php' );


// 埋め込みコンテンツのレスポンシブ化
add_theme_support( 'responsive-embeds' );


// スクリプトのバージョン管理 ----------------------------------------------------------------------------------------------
function version_num() {

 if (function_exists('wp_get_theme')) {
   $theme_data = wp_get_theme( get_template() );
 } else {
   $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
 };

 $current_version = $theme_data['Version'];

 return $current_version;

};


// オリジナルの抜粋記事 --------------------------------------------------------------------------------
function trim_excerpt($a) {

 if(has_excerpt()) { 

   $base_content = get_the_excerpt();
   $base_content = str_replace(array("\r\n", "\r", "\n"), "", $base_content);
   $trim_content = mb_substr($base_content, 0, $a ,"utf-8");

 } else {

   $base_content = get_the_content();
   $base_content = preg_replace('!<style.*?>.*?</style.*?>!is', '', $base_content);
   $base_content = preg_replace('!<script.*?>.*?</script.*?>!is', '', $base_content);
   $base_content = preg_replace('/\[.+\]/','', $base_content);
   $base_content = strip_tags($base_content);
   $trim_content = mb_substr($base_content, 0, $a,"utf-8");
   $trim_content = str_replace(']]>', ']]&gt;', $trim_content);
   $trim_content = str_replace(array("\r\n", "\r", "\n" , "&nbsp;"), "", $trim_content);
   $trim_content = htmlspecialchars($trim_content);

 };

 return $trim_content;

};
function trim_desc($desc,$num) {

  $trim_desc = mb_substr($desc, 0, $num ,"utf-8");
  $count_word = mb_strlen($trim_desc,"utf-8");
  return $trim_desc;

};

//抜粋からPタグを取り除く
remove_filter( 'the_excerpt', 'wpautop' );


// 記事タイトルの文字数制限 --------------------------------------------------------------------------------
function trim_title($num) {
 $base_title = strip_tags(get_the_title());
 $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
 $count_title = mb_strlen($trim_title,"utf-8");
 if($count_title > $num-1) {
  echo $trim_title . '…';
 } else {
  echo $trim_title;
 };
};

function trim_title2($num) {
 $base_title = strip_tags(get_the_title());
 $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
 $count_title = mb_strlen($trim_title,"utf-8");
 if($count_title > $num-1) {
  return $trim_title . '…';
 } else {
  return $trim_title;
 };
};

/* ショートコード用 */
function trim_title_sc($num) {
 $base_title = get_the_title();
 $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
 $count_title = mb_strwidth($trim_title,"utf-8");
 if($count_title > $num-1) {
  return $trim_title . '…';
 } else {
  return $trim_title;
 };
};


// タイトルをエンコード --------------------------------------------------------------------------------
function get_encoded_title($title){
  return urlencode(mb_convert_encoding($title, "UTF-8"));
}


// セルフピンバックを禁止する -------------------------------------------------------------------------------------
function no_self_ping( &$links ) {
  $home = home_url();
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );


// RSS用のフィードを追加 ---------------------------------------------------------------------------------------------------
add_theme_support( 'automatic-feed-links' );


//　ヘッダーから余分なMETA情報を削除 --------------------------------------------------------------------
remove_action( 'wp_head', 'wp_generator' ); 
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0);


// インラインスタイルを取り除く --------------------------------------------------------------------------------
function remove_recent_comments_style() {
  global $wp_widget_factory;
  if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
  }
}
add_action( 'widgets_init', 'remove_recent_comments_style' );

function remove_adminbar_inline_style() {
  remove_action( 'wp_head', '_admin_bar_bump_cb' );
  remove_action( 'wp_head', 'wp_admin_bar_header' );
  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_admin_bar_bump_styles' );
  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_admin_bar_header_styles' );
}
add_action('get_header', 'remove_adminbar_inline_style');


// カスタムメニューの設定 --------------------------------------------------------------------------------
if(function_exists('register_nav_menu')) {
  register_nav_menu( 'global-menu', __( 'Global menu', 'tcd-issue' ));
  register_nav_menu( 'footer-menu1', __( 'Footer menu (left)', 'tcd-issue' ));
  register_nav_menu( 'footer-menu2', __( 'Footer menu (center)', 'tcd-issue' ));
  register_nav_menu( 'footer-menu3', __( 'Footer menu (right)', 'tcd-issue' ));
}

// current-menu-itemを付ける
function custom_active_item_classes($classes, $menu_item) {
  if(is_tax('news_category') || is_singular('news')){
    $news_archive_page_url = get_post_type_archive_link('news');
    if($menu_item->url == $news_archive_page_url){
      $classes[] = 'current-menu-item';
    }
  }
  if(is_tax('interview_category') || is_singular('interview')){
    $case_archive_page_url = get_post_type_archive_link('interview');
    if($menu_item->url == $case_archive_page_url){
      $classes[] = 'current-menu-item';
    }
  }
  if(is_singular('staff')){
    $staff_archive_page_url = get_post_type_archive_link('staff');
    if($menu_item->url == $staff_archive_page_url){
      $classes[] = 'current-menu-item';
    }
  }
  if(is_singular('post')){
    $blog_page_url = get_permalink(get_option('page_for_posts'));
    if($menu_item->url == $blog_page_url){
      $classes[] = 'current-menu-item';
    }
  }
  if(is_category() || is_tag() || is_author() || is_day() || is_month() || is_year()){
    $blog_page_url = get_permalink(get_option('page_for_posts'));
    if($menu_item->url == $blog_page_url){
      $classes[] = 'current-menu-item';
    }
  }
  return $classes;
}
add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );


// メガメニュー --------------------------------------------------------------------------------
require get_template_directory() . '/functions/menu.php';
if ( ! function_exists( 'wp_get_nav_menu_name' ) ) {
  function wp_get_nav_menu_name( $location ) {
    $menu_name = '';
    $locations = get_nav_menu_locations();
    if ( isset( $locations[ $location ] ) ) {
      $menu = wp_get_nav_menu_object( $locations[ $location ] );
      if ( $menu && $menu->name ) {
        $menu_name = $menu->name;
      }
    }
    return apply_filters( 'wp_get_nav_menu_name', $menu_name, $location );
  }
}


// wp_nav_menuのliにclass追加 ------------------------------------------------------------------
function add_additional_class_on_li($classes, $item, $args)
{
  if (isset($args->add_li_class)) {
    $classes['class'] = $args->add_li_class;
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);


// 絵文字を消す ------------------------------------------------------------------
function disable_emoji() {
  $options = get_design_plus_option();
  if ( $options['use_emoji'] == 0 ) {
    // remove inline script
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    // remove inline style
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    // remove inline style  6.4 later
    if ( function_exists( 'wp_enqueue_emoji_styles' ) ) {
      remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );
      remove_action( 'admin_enqueue_scripts', 'wp_enqueue_emoji_styles' );
    }
    // initだと早いため、admin_initで実行
    add_action( 'admin_init', function(){
      // remove inline script
      remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
      // remove inline style
      remove_action( 'admin_print_styles', 'print_emoji_styles' );
      // remove inline style 6.4 later
      if ( function_exists( 'wp_enqueue_emoji_styles' ) ) {
        remove_action( 'admin_enqueue_scripts', 'wp_enqueue_emoji_styles' );
      }
    });
  }
}
add_action( 'init', 'disable_emoji' );


// bodyにclassを追加 --------------------------------------------------------------------------------
function tcd_body_classes($classes) {
    global $wp_query, $post;
    $options = get_design_plus_option();

    if(wp_is_mobile()){ $classes[] = 'mobile_device'; }

    if (is_page()) {
      $page = get_post();
      $classes[] = 'page_' . esc_attr($page->post_name);
    }

    if( (is_search() && isset($_GET['s']) && empty($_GET['s'])) || (is_search() && !have_posts()) ){ $classes[] = 'search-no-results'; };

    if($options['show_header_message'] == 'display') { $classes[] = 'show_header_message'; }

    if($options['header_menu_type'] == 'type1'){
      $classes[] = 'header_type1';
    } else {
      $classes[] = 'header_type2';
    }

    if( is_front_page() || is_singular('staff') || is_singular('interview') || is_page_template('page-tcd-lp.php') && get_post_meta($post->ID, 'header_image', true) && get_post_meta($post->ID, 'hide_page_header', true) == 'no' ){
      $classes[] = 'switch_logo';
    }

    if( is_front_page() && $options['index_header_content_first_view_animation'] == 'no'){
      $classes[] = 'no_first_view_animation';
    }

    if($options['staff_design_type'] == 'type1'){
      $classes[] = 'staff_design_type1';
    } else {
      $classes[] = 'staff_design_type2';
    }

    if($options['blog_show_date'] == 'hide') { $classes[] = 'hide_blog_date'; }
    if($options['news_show_image'] == 'hide') { $classes[] = 'hide_news_image'; }

    if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
    ){
      $classes[] = 'use_loading_screen';
      $classes[] = 'loading_animation_' . esc_attr($options['loading_animation_type']);
    };
    if(is_page() && !is_front_page()){
      $image = wp_get_attachment_image_src(get_post_meta($post->ID, 'header_image', true), 'full');
      if(!$image){
        $classes[] = 'no_header_image';
      } else {
        $classes[] = 'has_header_image';
      }
      if(is_page_template('page-tcd-lp.php') && get_post_meta($post->ID, 'hide_side_button', true) != 'no'){
        $classes[] = 'hide_side_button';
      }
    }
    if( is_page() && (get_post_meta($post->ID, 'hide_sidebar', true) == 'left') ) { $classes[] = 'show_sidebar show_sidebar_left'; } elseif( is_page() && (get_post_meta($post->ID, 'hide_sidebar', true) == 'right') ) { $classes[] = 'show_sidebar'; } elseif( is_page() && (get_post_meta($post->ID, 'hide_sidebar', true) == 'hide') ) { $classes[] = 'hide_sidebar'; };
    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'page_width', true) == 'normal') ) { $classes[] = 'normal_page_width'; } elseif( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'page_width', true) == 'wide')) { $classes[] = 'large_page_width'; };
    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_header_message', true) == 'yes') ) { $classes[] = 'hide_header_message'; };
    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_header_message', true) == 'no') ) { $classes[] = 'show_header_message'; };
    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_logo', true) == 'yes')) { $classes[] = 'hide_logo'; };
    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_global_menu', true) == 'yes') && (get_post_meta($post->ID, 'hide_logo', true) == 'yes')) { $classes[] = 'hide_page_header_bar'; };
    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_page_header', true) == 'yes') ) { $classes[] = 'hide_page_header'; } elseif(is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_page_header', true) != 'yes')) { $classes[] = 'show_page_header'; };
    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'page_hide_footer', true) == 'yes') ) { $classes[] = 'hide_footer'; };
    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_global_menu', true) == 'yes') ) { $classes[] = 'hide_global_menu'; };

    if(is_archive()) {
      global $wp_query;
      if($wp_query->max_num_pages == 1) {
        $classes[] = 'no_page_nav';
      }
    }

    if( is_single() && (!comments_open() && !pings_open()) ) { $classes[] = 'no_comment_form'; };

    if ( wp_is_mobile() && ($options['footer_bar_type'] != 'type1') ) { $classes[] = 'show_footer_bar'; };

    return array_unique($classes);
};
add_filter('body_class','tcd_body_classes');


// HEXをRGBに変換 ------------------------------------------------------------------
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb;
}


// RGBAカラーの明るさを変更する関数 ----------------------------------------------------------------
function adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}


// RGBAカラーの彩度を下げる関数 ----------------------------------------------------------------
function lowerSaturation($hex, $percentage) {
    // Convert HEX to RGB
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");

    // Convert RGB to HSL
    $r /= 255;
    $g /= 255;
    $b /= 255;
    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
    $l = ($max + $min) / 2;
    $d = $max - $min;

    if ($d == 0) {
        $h = $s = 0; // achromatic
    } else {
        $s = $d / (1 - abs(2 * $l - 1));
        switch ($max) {
            case $r:
                $h = 60 * fmod((($g - $b) / $d), 6); 
                break;
            case $g: 
                $h = 60 * (($b - $r) / $d + 2); 
                break;
            case $b: 
                $h = 60 * (($r - $g) / $d + 4); 
                break;
        }
    }

    // Lower the saturation
    $s *= (1 - $percentage / 100);

    // Convert HSL back to RGB
    $c = (1 - abs(2 * $l - 1)) * $s;
    $x = $c * (1 - abs(fmod(($h / 60), 2) - 1));
    $m = $l - $c / 2;

    if ($h < 60) {
        $r = $c; $g = $x; $b = 0;
    } else if ($h < 120) {
        $r = $x; $g = $c; $b = 0;          
    } else if ($h < 180) {
        $r = 0; $g = $c; $b = $x;                    
    } else if ($h < 240) {
        $r = 0; $g = $x; $b = $c;
    } else if ($h < 300) {
        $r = $x; $g = 0; $b = $c;
    } else {
        $r = $c; $g = 0; $b = $x;
    }

    $r = ($r + $m) * 255;
    $g = ($g + $m) * 255;
    $b = ($b + $m) * 255;

    // Convert the RGB values to HEX
    $hex = sprintf("#%02x%02x%02x", $r, $g, $b);

    return $hex;
}


// archive_title() 関数をカスタマイズ --------------------------------------------------------------------------------
function monolith_archive_title( $title ) {
	global $author, $post, $wp_query;
	if ( is_author() ) {
		$title = get_the_author_meta( 'display_name', $author );
	} elseif ( is_category() || is_tag() ) {
		$title = single_term_title( '', false );
	} elseif ( is_day() ) {
		$title = get_the_time( __( 'F jS, Y', 'tcd-issue' ), $post );
	} elseif ( is_month() ) {
		$title = get_the_time( __( 'F, Y', 'tcd-issue' ), $post );
	} elseif ( is_year() ) {
		$title = get_the_time( __( 'Y', 'tcd-issue' ), $post );
	} elseif ( is_search() ) {
		if ( $wp_query->found_posts ) {
			//$title = sprintf( __( 'Search results for - ', 'tcd-issue' ) . get_search_query() 
		} else {
			$title = __( 'Search result', 'tcd-issue' );
		}
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'monolith_archive_title', 10 );


// カスタムコメント --------------------------------------------------------------------------------------

if (function_exists('wp_list_comments')) {
	// comment count
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $commentcount ) {
		global $id;
		$_commnets = get_comments('post_id=' . $id);
		$comments_by_type = separate_comments($_commnets);
		return count($comments_by_type['comment']);
	}
}


function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>

 <li class="comment <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-comment';} else {echo 'guest-comment';} ?>" id="comment-<?php comment_ID() ?>">
  <div class="comment-meta clearfix">
   <div class="comment-meta-left">
  <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 60); } ?>
  
    <ul class="comment-name-date">
     <li class="comment-name">
<?php if (get_comment_author_url()) : ?>
<a id="commentauthor-<?php comment_ID() ?>" class="url <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-url';} else {echo 'guest-url';} ?>" href="<?php comment_author_url() ?>" rel="nofollow">
<?php else : ?>
<span id="commentauthor-<?php comment_ID() ?>">
<?php endif; ?>

<?php comment_author(); ?>

<?php if(get_comment_author_url()) : ?>
</a>
<?php else : ?>
</span>
<?php endif; ?>
     <li class="comment-date"><?php echo get_comment_time('Y.m.d'); echo get_comment_time(' g:ia'); ?></li>
    </ul>
   </div>

   <ul class="comment-act">
<?php if (function_exists('comment_reply_link')) { 
        if ( get_option('thread_comments') == '1' ) { ?>
    <li class="comment-reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('REPLY','tcd-issue').'</span></span>'))) ?></li>
<?php   } else { ?>
    <li class="comment-reply"><a class="no_auto_scroll" href="#" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-issue'); ?></a></li>
<?php   }
      } else { ?>
    <li class="comment-reply"><a class="no_auto_scroll" href="#" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-issue'); ?></a></li>
<?php } ?>
    <li class="comment-quote"><a class="no_auto_scroll" href="#" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'comment');"><?php _e('QUOTE', 'tcd-issue'); ?></a></li>
    <?php edit_comment_link(__('EDIT', 'tcd-issue'), '<li class="comment-edit">', '</li>'); ?>
   </ul>

  </div>
  <div class="comment-content post_content" id="comment-content-<?php comment_ID() ?>">
  <?php if ($comment->comment_approved == '0') : ?>
   <span class="comment-note"><?php _e('Your comment is awaiting moderation.', 'tcd-issue'); ?></span>
  <?php endif; ?>
  <?php comment_text(); ?>
  </div>

<?php

}


/* 記事編集画面のカテゴリー階層を保つ */
function lig_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
  $args['checked_ontop'] = false;
  return $args;
}
add_action( 'wp_terms_checklist_args', 'lig_wp_category_terms_checklist_no_top' );


// カスタム投稿の数が多い為、メディアメニューの位置を変更 ----------------------------------------------------------
function customize_menus(){
  global $menu;
  $menu[19] = $menu[10];
  unset($menu[10]);
}
add_action( 'admin_menu', 'customize_menus' );


// 投稿（ブログ）のラベルを変更 --------------------------------------------------------------------------------
$blog_label = __( 'Post', 'tcd-issue' );


// カスタム投稿とタクソノミーの追加 --------------------------------------------------------------------------------

function custom_post_type_init() {

$options = get_design_plus_option();

// カスタム投稿「お知らせ」 --------------------------------------------------------------------------------
if($options['use_news']){
$news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-issue' );
$news_slug = $options['news_slug'] ? sanitize_title( $options['news_slug'] ) : 'news';
$news_labels = array(
  'name' => $news_label,
  'add_new' => __( 'Add New', 'tcd-issue' ),
  'add_new_item' => __( 'Add New Item', 'tcd-issue' ),
  'edit_item' => __( 'Edit', 'tcd-issue' ),
  'new_item' => __( 'New item', 'tcd-issue' ),
  'view_item' => __( 'View Item', 'tcd-issue' ),
  'search_items' => __( 'Search Items', 'tcd-issue' ),
  'not_found' => __( 'Not Found', 'tcd-issue' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-issue' ),
  'parent_item_colon' => ''
);

register_post_type( 'news', array(
  'label' => $news_label,
  'labels' => $news_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $news_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'editor', 'thumbnail' ),
  'show_in_rest' => true	// ブロックエディターを使用しない、REST APIで表示しない
));

// 「お知らせ」カテゴリー
$news_category_label = sprintf(__('%s category', 'tcd-issue'), $news_label);
$news_category_slug = $news_slug . '_category';
$news_category_labels = array(
  'name' => $news_category_label,
  'singular_name' => $news_category_label
);
register_taxonomy( 'news_category', 'news', array(
  'labels' => $news_category_labels,
  'hierarchical' => true,
  'rewrite' => array( 'slug' => $news_category_slug ),
  'show_in_rest' => true  // ブロックエディターを使用しない、REST APIで表示しない
));
}; //end if use news


// カスタム投稿「スタッフ」 --------------------------------------------------------------------------------
if($options['use_staff']){

$staff_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Staff', 'tcd-issue' );
$staff_slug = $options['staff_slug'] ? sanitize_title( $options['staff_slug'] ) : 'staff';
$staff_labels = array(
  'name' => $staff_label,
  'add_new' => __( 'Add New', 'tcd-issue' ),
  'add_new_item' => __( 'Add New Item', 'tcd-issue' ),
  'edit_item' => __( 'Edit', 'tcd-issue' ),
  'new_item' => __( 'New item', 'tcd-issue' ),
  'view_item' => __( 'View Item', 'tcd-issue' ),
  'search_items' => __( 'Search Items', 'tcd-issue' ),
  'not_found' => __( 'Not Found', 'tcd-issue' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-issue' ),
  'parent_item_colon' => ''
);

register_post_type( 'staff', array(
  'label' => $staff_label,
  'labels' => $staff_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $staff_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'editor', 'thumbnail'),
  'show_in_rest' => true	// ブロックエディターを使用しない、REST APIで表示しない
));


// 「スタッフ」カテゴリー
$staff_category_label = sprintf(__('%s category', 'tcd-issue'), $staff_label);
$staff_category_slug = $staff_slug . '_category';
$staff_category_labels = array(
  'name' => $staff_category_label,
  'singular_name' => $staff_category_label
);
register_taxonomy( 'staff_category', 'staff', array(
  'labels' => $staff_category_labels,
  'hierarchical' => true,
  'rewrite' => array( 'slug' => $staff_category_slug ),
  'show_in_rest' => true	// ブロックエディターを使用しない、REST APIで表示しない
));


}; //end if use staff


// カスタム投稿「インタビュー」 --------------------------------------------------------------------------------
if($options['use_interview']){

$interview_label = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Conversation', 'tcd-issue' );
$interview_slug = $options['interview_slug'] ? sanitize_title( $options['interview_slug'] ) : 'interview';
$interview_labels = array(
  'name' => $interview_label,
  'add_new' => __( 'Add New', 'tcd-issue' ),
  'add_new_item' => __( 'Add New Item', 'tcd-issue' ),
  'edit_item' => __( 'Edit', 'tcd-issue' ),
  'new_item' => __( 'New item', 'tcd-issue' ),
  'view_item' => __( 'View Item', 'tcd-issue' ),
  'search_items' => __( 'Search Items', 'tcd-issue' ),
  'not_found' => __( 'Not Found', 'tcd-issue' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-issue' ),
  'parent_item_colon' => ''
);

register_post_type( 'interview', array(
  'label' => $interview_label,
  'labels' => $interview_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $interview_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'editor', 'thumbnail'),
  'show_in_rest' => true	// ブロックエディターを使用しない、REST APIで表示しない
));


// 「インタビュー」カテゴリー
$interview_category_label = sprintf(__('%s category', 'tcd-issue'), $interview_label);
$interview_category_slug = $interview_slug . '_category';
$interview_category_labels = array(
  'name' => $interview_category_label,
  'singular_name' => $interview_category_label
);
register_taxonomy( 'interview_category', 'interview', array(
  'labels' => $interview_category_labels,
  'hierarchical' => true,
  'rewrite' => array( 'slug' => $interview_category_slug ),
  'show_in_rest' => true	// ブロックエディターを使用しない、REST APIで表示しない
));

// 説明文カラムを消す
add_filter('manage_edit-interview_category_columns', function ( $columns ) {
  if( isset( $columns['description'] ) )
    unset( $columns['description'] );
  return $columns;
});


}; //end if use interview


// カスタム投稿ここまで

}
add_action( 'init', 'custom_post_type_init' );


/* ブログアーカイブページの表示数を変更 */
function change_blog_num( $query ) {
  if( (!is_admin() && is_archive()) || (!is_admin() && is_home()) || (!is_admin() && is_search())) {
    if($query->is_main_query()) {
      $post_num = get_option('posts_per_page');
      if(!wp_is_mobile()){
        $query->set('posts_per_page', $post_num);
      }
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_blog_num' );


/* お知らせアーカイブページの記事数を変更 */
function change_news_num( $query ) {
  $options = get_design_plus_option();
  if(wp_is_mobile()){
    $post_num = $options['archive_news_num_sp'];
  } else {
    $post_num = $options['archive_news_num'];
  }
  if( !is_admin() && is_post_type_archive('news')|| is_tax('news_category') ) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_news_num' );


/* スタッフアーカイブページの記事数を変更 */
function change_staff_num( $query ) {
  $options = get_design_plus_option();
  if(wp_is_mobile()){
    $post_num = $options['archive_staff_num_sp'];
  } else {
    $post_num = $options['archive_staff_num'];
  }
  if( !is_admin() && is_post_type_archive('staff')|| is_tax('staff_category') ) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_staff_num' );


// 全てのカスタムフィールドを検索対象に含める --------------------------------------------------------------------------------
function cf_search_join($join, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' AS tcd_pm_search ON '. $wpdb->posts . '.ID = tcd_pm_search.post_id ';
    }
    return $join;
}
add_filter('posts_join', 'cf_search_join', 10, 2);

function cf_search_where($where, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (tcd_pm_search.meta_value LIKE $1)", $where);
    }
    return $where;
}
add_filter('posts_where', 'cf_search_where', 10, 2);

function cf_search_distinct($distinct, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        return "DISTINCT";
    }
    return $distinct;
}
add_filter('posts_distinct', 'cf_search_distinct', 10, 2);


// 検索対象にする記事タイプを設定 --------------------------------------------------------------------------------
function SearchFilter($query) {
  $options = get_design_plus_option();
  if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
    $post_types = array();
    if($options['search_type_post'] == 'yes'){
      array_push($post_types,'post');
    }
    if($options['search_type_page'] == 'yes'){
      array_push($post_types,'page');
    }
    if($options['use_news'] && $options['search_type_news'] == 'yes'){
      array_push($post_types,'news');
    }
    if($options['use_interview'] && $options['search_type_interview'] == 'yes'){
      array_push($post_types,'interview');
    }
    if($options['use_staff']  && $options['search_type_staff'] == 'yes'){
      array_push($post_types,'staff');
    }
    $query->set('post_type', $post_types );

    if($options['search_type_post'] == 'no' && $options['search_type_page'] == 'no' && $options['search_type_news'] == 'no' && $options['search_type_interview'] == 'no' && $options['search_type_staff'] == 'no'){
      $query->set('name', 'set_dummy_page_id' );
    }

    if($options['search_type_page'] == 'yes'){
      $front_page_id = get_option('page_on_front');
      if($front_page_id){
        $query->set('post__not_in', array($front_page_id) );
      }
    }
  }
}
add_action( 'pre_get_posts','SearchFilter' );


// タイトルとurlをコピーのスクリプト --------------------------------------------------------------------------------
function copy_title_url_script() {
  global $options;
  if ( ! $options ) $options = get_design_plus_option();

  if ( (is_singular('post') && $options['single_blog_show_copy'] != 'hide') || (is_singular('news') && $options['single_news_show_copy'] != 'hide') ) {
    wp_enqueue_script( 'copy_title_url', get_template_directory_uri().'/js/copy_title_url.js', array(), version_num(), true );
  }
}
add_action( 'wp_enqueue_scripts', 'copy_title_url_script' );


// カテゴリー編集画面にIDを表示する ------------------------------------------------------------------------------------
function add_category_columns( $columns ) {
  echo '<style>
  .taxonomy-category .manage-column.num {width: 90px;}
  .taxonomy-category .manage-column.column-id {width: 60px;}
  </style>';

  $columns['id'] = 'ID';
  return $columns;
}
function add_category_sortable_columns( $columns ) {
  $columns['id'] = 'ID';
  return $columns;
}
function custom_category_column( $content, $column_name, $term_id ) {
  if ( $column_name == 'id' ) {
    echo $term_id;
  }
}
add_filter( 'manage_edit-category_columns', 'add_category_columns' );
add_filter( 'manage_edit-category_sortable_columns', 'add_category_sortable_columns' );
add_action( 'manage_category_custom_column', 'custom_category_column', 10, 3 );


// ページのナビの有無をチェック ---------------------------------------------------------------------------------------
function show_posts_nav() {
  global $wp_query;
  return ($wp_query->max_num_pages > 1);
};


// ブログ用固定ページからメタボックス削除 ------------------------------------------------------------------------
function tcd_remove_meta_boxes() {
  global $typenow, $post;

  // ホームページ・投稿ページ表示に設定されているに固定ページ編集時
  if ( 'page' === $typenow && ! empty( $post->ID ) && 'page' === get_option('show_on_front') && in_array( $post->ID, array( get_option( 'page_on_front' ), get_option( 'page_for_posts' ) ) ) ) {
    remove_meta_box( 'tcd_meta_box1', 'page', 'normal' );
    remove_meta_box( 'select_pw_meta_box', 'page', 'normal' );
    remove_meta_box( 'postexcerpt', 'page', 'normal' );
    remove_meta_box( 'pageparentdiv', 'page', 'normal' );
  }

}
add_action( 'add_meta_boxes', 'tcd_remove_meta_boxes', 999 );


// 文字をspanタグで囲む ---------------------------------------------------------------------------------------
function sepText($text, $count = 0) {
  $text = esc_html($text);
  $text = str_replace(array("\r\n", "\r", "\n"), '␣', $text);
  $matches = preg_split("//u", $text, -1, PREG_SPLIT_NO_EMPTY);
  $text = '';
  foreach ($matches as $val) {
    $count++;
    if ($val === '␣') {
      $text .= '<br>';
    } elseif ($val === ' ') {
      $text .= '<span class="item blank"></span>';
    } else {
      $text .= '<span class="item">' . $val . '</span>';
    }
  }
  return $text;
}


// AJAXで記事取得 ------------------------------------------------------------------------
// インタビュー
function ajax_get_interview_items() {
  if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) return;
  if ( isset( $_POST['offset_post_num'], $_POST['post_cat_id'] ) ) {
    get_template_part('ajax-interview-item');
    exit;
  }
}
add_action( 'wp_ajax_get_interview_items', 'ajax_get_interview_items' );
add_action( 'wp_ajax_nopriv_get_interview_items', 'ajax_get_interview_items' );

/**
 * 管理画面 サイトヘルスのWP情報にユーザーエージェント追加
 *
 * NOTE: カスタマーサポート対策
 */
add_filter( 'debug_information', 'tcd_add_debug_information' );
function tcd_add_debug_information( $info ) {
  if( isset( $info['wp-core']['fields'] ) ){
    $info['wp-core']['fields']['user_agent'] = [
      'label' => 'User Agent',
      'value' => $_SERVER['HTTP_USER_AGENT'] ?? 'UA could not be retrieved',
    ];
  }
  return $info;
}


// avatar画像にloading="lazy"を追加
function add_lazy_loading_to_avatar($avatar) {
  $avatar = str_replace('<img', '<img loading="lazy"', $avatar);
  return $avatar;
}
add_filter('get_avatar', 'add_lazy_loading_to_avatar');


/**
 * the_content()内のimgタグにloading="lazy"を付ける　Google PageSpeed対策
 */
function add_lazy_loading_to_content_images($content) {
  $count = 0;
  $content = preg_replace_callback(
    '/<img(?![^>]*loading=)(?=[^>]*\bwidth\b)(?=[^>]*\bheight\b)([^>]*)>/i',
    function($matches) use (&$count) {
      $count++;
      if ($count === 1) {
        return '<img' . $matches[1] . '>';
      }
      return '<img loading="lazy"' . $matches[1] . '>';
    },
    $content
  );
  return $content;
}
add_filter('the_content', 'add_lazy_loading_to_content_images');


/**
 * 添付ファイルページを強制的に無効化する（WP6.4〜）
 */
add_filter( 'option_wp_attachment_pages_enabled', '__return_false' );


// contact form7のショートコードが利用されているページをリストアップ ------------------------------------------
function get_pages_with_cf7_shortcode() {
  global $wpdb;
  $page_ids = $wpdb->get_col("
    SELECT ID FROM $wpdb->posts
    WHERE post_type IN ('page', 'post', 'interview', 'staff')
    AND post_status = 'publish'
    AND post_content LIKE '%[contact-form-7%'
  ");
  return $page_ids;
}


// Contact form7関連のファイルをお問い合わせフォームが利用されているページ以外では読み込ませない ----------------------------------------
function cf7_enqueue_scripts_and_styles() {
  $contact_pages = get_pages_with_cf7_shortcode();
  if (empty($contact_pages)) {
    $contact_pages = [];
  }
  if (is_page($contact_pages)) {
    if (function_exists('wpcf7_enqueue_scripts')) {
      wpcf7_enqueue_scripts();
    }
    if (function_exists('wpcf7_enqueue_styles')) {
      wpcf7_enqueue_styles();
    }
  }
}
add_filter('wpcf7_load_js', '__return_false');
add_filter('wpcf7_load_css', '__return_false');
add_action('wp_enqueue_scripts', 'cf7_enqueue_scripts_and_styles', 100);

/**
 * PWAプラグイン未インストール時のメッセージ
 *
 * NOTE: TCDユーザーがPWAプラグインを知る・使うための導線を作るために用意
 */
add_action( 'admin_notices', 'tcd_pwa_admin_notice' );
function tcd_pwa_admin_notice(){
  global $plugin_page;

  // テーマオプションページ以外では表示しない
  if( $plugin_page !== 'theme_options' ){
    return;
  }

  // TCD PWA が有効化されていれば表示しない
  if( defined( 'TCDPWA_ACTIVE' ) && TCDPWA_ACTIVE ){
    return;
  }

  // チェックしたいプラグインのメインファイルを指定
  $target_plugin_file = 'tcd-pwa/tcd-pwa.php';

  // すべてのインストール済みプラグインを取得
  $installed_plugins = get_plugins();

  // インストール済みなら終了
  if( isset( $installed_plugins[$target_plugin_file] ) ){
    return;
  }

  // notice作成
  printf(
    '<div class="notice notice-info is-dismissible">
      <p>%1$s</p>
      <p>
        <a class="button" href="%2$s" target="_blank">%3$s</a>
        <a class="button button-primary" href="%4$s" target="_blank">%5$s</a>
      </p>
    </div>',
    // TCDテーマをPWA化できるプラグイン「TCD Progressive Web Apps」を利用できます。
    __( 'The TCD Progressive Web Apps plugin is available to convert TCD themes into PWAs.','tcd-issue' ),
    // 解説記事URL
    'https://tcd-theme.com/2025/05/tcd-pwa.html',
    // 設定・使い方
    __( 'Settings/How to use','tcd-issue' ),
    // マイページの商品URL
    'https://tcd.style/order-history?pname=TCD+Progressive+Web+Apps',
    // 今すぐインストール
    __( 'Install Now','tcd-issue' )
  );
}


?>