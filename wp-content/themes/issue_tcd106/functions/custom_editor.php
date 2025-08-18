<?php

/**
 * エディターに関連する記述をここにまとめる
 *
 * NOTE: TCD Classic Editorの個別対応もここ
 */

/**
 * プラグインが有効化されている場合の処理
 *
 * NOTE: TCDCE_ACTIVEは、プラグインで定義された定数（有効化されていればtrue）
 */
if ( defined( 'TCDCE_ACTIVE' ) && TCDCE_ACTIVE ) {

	/**
	 * スタートガイド
	 */
	// 告知追加： このプラグインを有効化している間、TCDテーマの「クイックタグ」機能は利用できません。
	add_action( 'tcdce_top_menu', 'tcdce_top_menu_common_caution', 9 );

	/**
	 * 基本設定
	 */
	// 告知追加： TCDテーマオプションの設定が本文に反映されるため、基本設定はお使いいただけません。
	add_action( 'tcdce_submenu_tcd_classic_editor_basic', 'tcdce_submenu_basic_common_caution' );
	// 基本設定のスタイルを読み込まない
	remove_filter( 'tcdce_render_quicktag_style', 'tcdce_render_quicktag_basic_style' );

	/**
	 * クイックタグ
	 */
	// フロントの use_quicktagオプションを強制的にオフにする（元テーマの関連スタイルを除去）
	add_filter( 'option_dp_options', 'tcdce_disable_theme_quicktag' );

	/**
	 * Googleマップ
	 */
	// 特に無し

	/**
	 * 目次
	 */
	// スマホ用目次ウィジェットアイコンを表示するブレイクポイント
	// ISSUEは1200pxでサイドバーがなくなるので、ぞれに合わせる
	add_filter( 'tcdce_toc_show_breakpoint', fn() => 1200 );

	// 目次のスタイル調整
	add_filter( 'tcdce_enqueue_inline_style', function( $style ){
		$style .=
		// 目次のスタイル調整（背景がグレーの場合など）
		// '.widget_tcdce_toc_widget { background:initial; }
		// .p-toc--sidebar { background:#fff; }' .
		// 目次追従時のtop調整
		'body.header_type2 { --tcdce-toc-sticky-top:120px; }' .
		// 目次アイコン表示時は、トップに戻るボタンを非表示にする
		'body:has(.p-toc-open) #return_top { display: none; }' .
		// スマホフッターバー、レビューフッターバー表示時の対策
		'body:has(.p-review-footer-bar) .p-toc-open, body:has(.p-footer-bar) .p-toc-open { margin-bottom: 50px; }' .
		// ドロワーメニュー表示に目次アイコン非表示
		'html.open_menu .p-toc-open { display:none; }';
		return $style;
	} );

	/**
	 * design-plus.cssを取り除く
	 *
	 * NOTE: design-plus.cssの中に必要な記述があればスタイルシートに移設
	 */
	add_action( 'wp_enqueue_scripts', function(){
		wp_dequeue_style( 'design-plus' );
	} );

	/**
	 * ISSUE独自ショートコード: スクロールコンテンツのHTML変更
	 */
	add_filter( 'tcd_scroll_content_start', function( $html ){
		return "</div><!-- END .tcdce-body -->\n" . $html;
	} );
	add_filter( 'tcd_scroll_content_end', function( $html ){
		return $html . "<div class='tcdce-body'>\n";
	} );

	/**
	 * エディタ独自スタイル対応
	 */
	add_filter( 'tcdce_enqueue_inline_style', function( $style ){
		$style .=
		/* 最初と最後の要素のmarginを０に */
		'.post_content .tcdce-body > *:first-child { margin-top: 0 !important; }' .
		'.post_content .tcdce-body > *:last-child { margin-bottom: 0 !important; }' .
		/* .entry_content内のテーブルスタイル */
		'.tcdce-body .entry_content :is(td, th) { padding: 18px 30px 16px; line-height: 2.2; }' .
		'@media screen and (max-width:800px) { .tcdce-body .entry_content :is(td, th) { padding: 14px 15px; line-height: 1.8; } }' .
		/* #company_tableの行間調整 */
		'.tcdce-body #company_table :is(td, th) { line-height: 2.2; }' .
		'@media screen and (max-width:800px) { .tcdce-body #company_table :is(td, th) { line-height: 1.8; } }';
		return $style;
	} );

	/**
	 * 有効化されていれば、ココで処理を止める
	 */
	return;
}

/**
 * 以下はテーマのエディタ周りの機能
 *
 * NOTE: プラグイン有効化時は、以下は実行されない
 */


/**
 * 新たに移設したものを以下
 *
 * NOTE:
 * - スタイルやスクリプト
 * - the_contentフィルターで実行されているもの
 * - mce_ や tiny_mce 関連のフック
 * - ビジュアルエディタのスタイルシートの読み込み など
 */

add_action( 'wp_head', function(){

/**
 * エディタに使われているhead内のスタイルがあればココに移設
 *
 * NOTE: use_quicktagsをオフにするので、head内のクイックタグスタイルは移設不要（要確認）
 * NOTE: その他styleの上書きが必要なら
 */

/**
 * エディタに使われているスクリプトをココに移設
 *
 * NOTE: マーカーは干渉するので移設が必要
 */

?>
<script>
document.addEventListener('DOMContentLoaded', function () {
	var $window = $(window);
	var $body = $('body');

  // クイックタグ - underline ------------------------------------------
  if ($('.q_underline').length) {
    var gradient_prefix = null;

    $('.q_underline').each(function(){
      var bbc = $(this).css('borderBottomColor');
      if (jQuery.inArray(bbc, ['transparent', 'rgba(0, 0, 0, 0)']) == -1) {
        if (gradient_prefix === null) {
          gradient_prefix = '';
          var ua = navigator.userAgent.toLowerCase();
          if (/webkit/.test(ua)) {
            gradient_prefix = '-webkit-';
          } else if (/firefox/.test(ua)) {
            gradient_prefix = '-moz-';
          } else {
            gradient_prefix = '';
          }
        }
        $(this).css('borderBottomColor', 'transparent');
        if (gradient_prefix) {
          $(this).css('backgroundImage', gradient_prefix+'linear-gradient(left, transparent 50%, '+bbc+ ' 50%)');
        } else {
          $(this).css('backgroundImage', 'linear-gradient(to right, transparent 50%, '+bbc+ ' 50%)');
        }
      }
    });

    $window.on('scroll.q_underline', function(){
      $('.q_underline:not(.is-active)').each(function(){
        if ($body.hasClass('show-serumtal')) {
          var left = $(this).offset().left;
          if (window.scrollX > left - window.innerHeight) {
            $(this).addClass('is-active');
          }
        } else {
          var top = $(this).offset().top;
          if (window.scrollY > top - window.innerHeight) {
            $(this).addClass('is-active');
          }
        }
      });
      if (!$('.q_underline:not(.is-active)').length) {
        $window.off('scroll.q_underline');
      }
    });
  }

} );
</script>
<?php

} );


/**
 * the_content フィルターで実行されているもの
 */

// ショートコードがpタグで包まれる・brタグが後ろに入る現象を回避
function remove_p_tags_from_shortcodes($the_content){
  $array = array (
    '<p>[' => '[',
    ']</p>' => ']',
    ']<br />' => ']'
  );
  $the_content = strtr($the_content, $array);
  return $the_content;
}
add_filter('the_content', 'remove_p_tags_from_shortcodes');

// 出力されるtableタグをdivで囲む（the_contentフィルターで実行）ブロックが使われていないエディターのみで動作
// s_tableを使いたくない場合は、tableタグにno_s_tableクラスを付ければ回避できる
add_filter('the_content', function( $content ){
  if( !has_blocks() ){
    $content = preg_replace_callback('/<table(.*?)>(.*?)<\/table>/s', function($matches) {
      if (strpos($matches[1], 'class="no_s_table"') !== false) {
        return $matches[0];
      } else {
        return '<div class="s_table">' . $matches[0] . '</div>';
      }
    }, $content);
  }
  return $content;
});


/**
 * ビジュアルエディタにテーブルを追加するカスタマイズ
 */

// ビジュアルエディタに表(テーブル)の機能を追加 -----------------------------------------------
function mce_external_plugins_table($plugins) {
	$plugins['table'] = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/plugins/table/plugin.min.js';
	return $plugins;
}
add_filter( 'mce_external_plugins', 'mce_external_plugins_table' );

// tinymceのtableボタンにclass属性プルダウンメニューを追加
function mce_buttons_table($buttons) {
	$buttons[] = 'table';
	return $buttons;
}
add_filter( 'mce_buttons', 'mce_buttons_table' );

function bootstrap_classes_tinymce($settings) {
$styles = array(
	array('title' => __('Default style', 'tcd-issue'), 'value' => ''),
	array('title' => __('No border', 'tcd-issue'), 'value' => 'table_no_border'),
	array('title' => __('Display only horizontal border', 'tcd-issue'), 'value' => 'table_border_horizontal'),
);
$settings['table_class_list'] = json_encode($styles);
return $settings;
}
add_filter('tiny_mce_before_init', 'bootstrap_classes_tinymce');


/**
 * その他ビジュアルエディタのカスタマイズ
 */

// 改ページ
add_filter("mce_buttons", "add_nextpage_buttons");

// ビジュアルエディタに文字サイズを追加 ---------------------------------------------------------------------
add_filter('mce_buttons', function ($buttons){
  array_unshift($buttons, 'fontsizeselect');
  return $buttons;
});
add_filter( 'tiny_mce_before_init', function ($settings) {
  $settings['fontsize_formats'] = '10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 42px 48px';
  return $settings;
});

// ビジュアルエディタに書体を追加 ---------------------------------------------------------------------
add_filter('mce_buttons', function($buttons){
  array_unshift($buttons, 'fontselect');
  return $buttons;
});
add_filter('tiny_mce_before_init', function($settings){
  $settings['font_formats'] =
    "メイリオ=Arial, 'ヒラギノ角ゴ ProN W3', 'Hiragino Kaku Gothic ProN', 'メイリオ', Meiryo, sans-serif;" .
    "游ゴシック='Hiragino Sans', 'ヒラギノ角ゴ ProN', 'Hiragino Kaku Gothic ProN', '游ゴシック', YuGothic, 'メイリオ', Meiryo, sans-serif;" .
    "游明朝='Times New Roman' , '游明朝' , 'Yu Mincho' , '游明朝体' , 'YuMincho' , 'ヒラギノ明朝 Pro W3' , 'Hiragino Mincho Pro' , 'HiraMinProN-W3' , 'HGS明朝E' , 'ＭＳ Ｐ明朝' , 'MS PMincho' , serif;" .
    "Andale Mono=andale mono,times;" .
    "Arial=arial,helvetica,sans-serif;" .
    "Arial Black=arial black,avant garde;" .
    "Book Antiqua=book antiqua,palatino;" .
    "Comic Sans MS=comic sans ms,sans-serif;" .
    "Courier New=courier new,courier;" .
    "Georgia=georgia,palatino;" .
    "Helvetica=helvetica;" .
    "Impact=impact,chicago;" .
    "Symbol=symbol;" .
    "Tahoma=tahoma,arial,helvetica,sans-serif;" .
    "Terminal=terminal,monaco;" .
    "Times New Roman=times new roman,times;" .
    "Trebuchet MS=trebuchet ms,geneva;" .
    "Verdana=verdana,geneva;" .
    "Webdings=webdings;" .
    "Wingdings=wingdings,zapf dingbats";
  ;
  return $settings;
});

// エディタのビジュアル・テキスト切替でコード消滅を防止
function stop_clear_tags( $init_array ) {
  $init_array['valid_elements'] = '*[*]';
  $init_array['extended_valid_elements'] = '*[*]';
  return $init_array;
}
add_filter( 'tiny_mce_before_init' , 'stop_clear_tags' );


// ビジュアルエディタに切り替えで、空の span タグや div タグが消されるのを防止
if ( ! function_exists('tinymce_init') ) {
  function tinymce_init( $init ) {
    $init['verify_html'] = false; // 空タグや属性なしのタグを消させない
    $initArray['valid_children'] = '+body[style], +div[div|span|a], +span[span]'; // 指定の子要素を消させない
    return $init;
  }
  add_filter( 'tiny_mce_before_init', 'tinymce_init', 100 );
}

/**
 * 以下は custom_editorにもともと記載されていたもの
 */
function tcd_quicktag_admin_init() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	if ( $dp_options['use_quicktags'] && ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) ) {
		add_filter( 'mce_external_plugins', 'tcd_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'tcd_register_mce_button' );
		add_action( 'admin_print_footer_scripts', 'tcd_add_quicktags' );
	}

	// Dynamic css for classic visual editor
	add_filter( 'editor_stylesheets', 'editor_stylesheets_tcd_visual_editor_dynamic_css' );

	// Dymamic css for visual editor on block editor
	wp_enqueue_style( 'tcd-quicktags', get_tcd_quicktags_dynamic_css_url(), false, version_num() );

}
add_action( 'admin_init', 'tcd_quicktag_admin_init' );

// Declare script for new button
function tcd_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['tcd_mce_button'] = get_template_directory_uri() . '/admin/js/mce-button.js?ver=' . version_num();
	return $plugin_array;
}

// Register new button in the editor
function tcd_register_mce_button( $buttons ) {
	array_push( $buttons, 'tcd_mce_button' );
	return $buttons;
}

function tcd_add_quicktags() {
	global $dp_options, $post_type;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$tcdQuicktagsL10n = array(
		'pulldown_title' => array(
			'display' => __( 'quicktags', 'tcd-issue' ),
		),
		'ytube' => array(
			'display' => __( 'YouTube', 'tcd-issue' ),
			'tag' => __( '<div class="ytube">YouTube code here</div>', 'tcd-issue' )
		),
		'relatedcardlink' => array(
			'display' => __( 'Cardlink', 'tcd-issue' ),
			'tag' => __( '[clink url="Post URL to display"]', 'tcd-issue' )
		),
		'post_col-2' => array(
			'display' => __( '2 column', 'tcd-issue' ),
			'tag' => __( '<div class="post_row"><div class="post_col post_col-2">Text and image tags to display in the left column</div><div class="post_col post_col-2">Text and image tags to display in the right column</div></div>', 'tcd-issue' )
		),
		'post_col-3' => array(
			'display' => __( '3 column', 'tcd-issue' ),
			'tag' => __( '<div class="post_row"><div class="post_col post_col-3">Text and image tags to display in the left column</div><div class="post_col post_col-3">Text and image tags to display in the center column</div><div class="post_col post_col-3">Text and image tags to display in the right column</div></div>', 'tcd-issue' )
		),
		'q_comment_out' => array(
			'display' => __( 'Comment out', 'tcd-issue' ),
			'tagStart' => '<div class="hidden"><!-- ',
			'tagEnd' => ' --></div>'
		),
		'q_h2' => array(
			'display' => __( 'Styled h2 tag', 'tcd-issue' ),
			'tagStart' => '<h2 class="styled_h2">',
			'tagEnd' => '</h2>'
		),
		'q_h3' => array(
			'display' => __( 'Styled h3 tag', 'tcd-issue' ),
			'tagStart' => '<h3 class="styled_h3">',
			'tagEnd' => '</h3>'
		),
		'q_h4' => array(
			'display' => __( 'Styled h4 tag', 'tcd-issue' ),
			'tagStart' => '<h4 class="styled_h4">',
			'tagEnd' => '</h4>'
		),
		'q_h5' => array(
			'display' => __( 'Styled h5 tag', 'tcd-issue' ),
			'tagStart' => '<h5 class="styled_h5">',
			'tagEnd' => '</h5>'
		),
		'q_ol' => array(
			'display' => __( 'Styled ol', 'tcd-issue' ),
			'tag' => '<ol class="q_styled_ol">'."\n".'<li>'.__('List', 'tcd-issue').'1</li>'."\n".'<li>'.__('List', 'tcd-issue').'2</li>'."\n".'<li>'.__('List', 'tcd-issue').'3</li>'."\n".'</ol>'
		),
		'gray_bg' => array(
			'display' => __( 'Gray background', 'tcd-issue' ),
			'tag' => "<div class='gray_bg'>\n\n" . __('Enter content here', 'tcd-issue') . "\n\n</div>",
		),
		'q_frame1' => array(
			'display' => __( 'Frame style', 'tcd-issue' ).'1',
			'tagStart' => '<div class="q_frame q_frame1"><span class="q_frame_label">'.esc_html($dp_options['qt_frame1_label']).'</span>',
			'tagEnd' => '</div>'
		),
		'q_frame2' => array(
			'display' => __( 'Frame style', 'tcd-issue' ).'2',
			'tagStart' => '<div class="q_frame q_frame2"><span class="q_frame_label">'.esc_html($dp_options['qt_frame2_label']).'</span>',
			'tagEnd' => '</div>'
		),
		'q_frame3' => array(
			'display' => __( 'Frame style', 'tcd-issue' ).'3',
			'tagStart' => '<div class="q_frame q_frame3"><span class="q_frame_label">'.esc_html($dp_options['qt_frame3_label']).'</span>',
			'tagEnd' => '</div>'
		),
		'q_custom_button1' => array(
			'display' => sprintf( __( 'Button %d', 'tcd-issue' ), 1 ),
			'tag' => '<div class="q_button_wrap"><a href="#" class="q_custom_button q_custom_button1">' . sprintf( __( 'Button %d', 'tcd-issue' ), 1 ) . '</a></div>'
		),
		'q_custom_button2' => array(
			'display' => sprintf( __( 'Button %d', 'tcd-issue' ), 2 ),
			'tag' => '<div class="q_button_wrap"><a href="#" class="q_custom_button q_custom_button2">' . sprintf( __( 'Button %d', 'tcd-issue' ), 2 ) . '</a></div>'
		),
		'q_custom_button3' => array(
			'display' => sprintf( __( 'Button %d', 'tcd-issue' ), 3 ),
			'tag' => '<div class="q_button_wrap"><a href="#" class="q_custom_button q_custom_button3">' . sprintf( __( 'Button %d', 'tcd-issue' ), 3 ) . '</a></div>'
		),
		'q_underline1' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-issue' ), 1 ),
			'tagStart' => '<span class="q_underline q_underline1" style="border-bottom-color:;">',
			'tagEnd' => '</span>'
		),
		'q_underline2' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-issue' ), 2 ),
			'tagStart' => '<span class="q_underline q_underline2" style="border-bottom-color:;">',
			'tagEnd' => '</span>'
		),
		'q_underline3' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-issue' ), 3 ),
			'tagStart' => '<span class="q_underline q_underline3" style="border-bottom-color:;">',
			'tagEnd' => '</span>'
		),
		'speech_balloon_left1' => array(
			'display' => __( 'Speech balloon left 1', 'tcd-issue' ),
			'tagStart' => '[speech_balloon_left1]',
			'tagEnd' => '[/speech_balloon_left1]'
		),
		'speech_balloon_left2' => array(
			'display' => __( 'Speech balloon left 2', 'tcd-issue' ),
			'tagStart' => '[speech_balloon_left2]',
			'tagEnd' => '[/speech_balloon_left2]'
		),
		'speech_balloon_right1' => array(
			'display' => __( 'Speech balloon right 1', 'tcd-issue' ),
			'tagStart' => '[speech_balloon_right1]',
			'tagEnd' => '[/speech_balloon_right1]'
		),
		'speech_balloon_right2' => array(
			'display' => __( 'Speech balloon right 2', 'tcd-issue' ),
			'tagStart' => '[speech_balloon_right2]',
			'tagEnd' => '[/speech_balloon_right2]'
		),
		'google_map' => array(
			'display' => __( 'Google Maps', 'tcd-issue' ),
			'tag' => '[qt_google_map address="'. __( 'Enter address here', 'tcd-issue' ) . '"]'
		),
		'tab_content' => array(
			'display' => __( 'Tab content', 'tcd-issue' ),
			'tag' => '[tcd_tab tab1="'. __( 'Tab1 headline', 'tcd-issue' ) . '" img1="'. __( 'Enter tab1 image url here', 'tcd-issue' ) . '" tab2="'. __( 'Tab2 headline', 'tcd-issue' ) . '" img2="'. __( 'Enter tab2 image url here', 'tcd-issue' ) . '"]'
		),
	);
  if($post_type == 'interview'){
    $tcdQuicktagsL10n += array('interview1' => array('display' => __('Speaker','tcd-issue') . '1','tagStart' => '[interviewer1]', 'tagEnd' => '[/interviewer1]'));
    $tcdQuicktagsL10n += array('interview2' => array('display' => __('Speaker','tcd-issue') . '2','tagStart' => '[interviewer2]', 'tagEnd' => '[/interviewer2]'));
    $tcdQuicktagsL10n += array('interview3' => array('display' => __('Speaker','tcd-issue') . '3','tagStart' => '[interviewer3]', 'tagEnd' => '[/interviewer3]'));
    $tcdQuicktagsL10n += array('interview4' => array('display' => __('Speaker','tcd-issue') . '4','tagStart' => '[interviewer4]', 'tagEnd' => '[/interviewer4]'));
    $tcdQuicktagsL10n += array('interview5' => array('display' => __('Speaker','tcd-issue') . '5','tagStart' => '[interviewer5]', 'tagEnd' => '[/interviewer5]'));
    $tcdQuicktagsL10n += array('interview6' => array('display' => __('Speaker','tcd-issue') . '6','tagStart' => '[interviewer6]', 'tagEnd' => '[/interviewer6]'));
  }
?>
<script type="text/javascript">
<?php
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		echo "var tcdQuicktagsL10n = " . json_encode( $tcdQuicktagsL10n ) . ";\n";
	}
	if ( wp_script_is( 'quicktags' ) ) {
		foreach ( $tcdQuicktagsL10n as $key => $value ) {
			if ( is_numeric( $key ) || empty( $value['display'] ) ) continue;
			if ( empty( $value['tag'] ) && empty( $value['tagStart'] ) ) continue;

			if ( isset( $value['tag'] ) && ! isset( $value['tagStart'] ) ) {
				$value['tagStart'] = $value['tag'] . "\n\n";
			}
			if ( ! isset( $value['tagEnd'] ) ) {
				$value['tagEnd'] = '';
			}

			$key = json_encode( $key );
			$display = json_encode( $value['display'] );
			$tagStart = json_encode( $value['tagStart'] );
			$tagEnd = json_encode( $value['tagEnd'] );
			echo "QTags.addButton($key, $display, $tagStart, $tagEnd);\n";
		}
	}
?>
</script>
<?php
}

// Get dymamic css url
function get_tcd_quicktags_dynamic_css_url() {
	return admin_url( 'admin-ajax.php?action=tcd_quicktags_dynamic_css' );
}

// Dymamic css for visual editor
function tcd_ajax_quicktags_dynamic_css() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	header( 'Content-Type: text/css; charset=UTF-8' );

  // editor-css.cssの設定をこちらに移動　2024/02/23
?>
/* ----------------------------------------------------------------------
 基本
---------------------------------------------------------------------- */
@font-face {
  font-family: 'normal_icon';
  font-weight: normal;
  font-style: normal;
  font-display:swap;
  src: url('<?php echo esc_url(get_template_directory_uri()); ?>/fonts/normal_icon.woff?v=1.0') format('woff');
}
body#tinymce, .editor-styles-wrapper { /* 注意：入れ子にしないと管理画面内の全ての要素に適用される */

*,*::before,*::after{ box-sizing:border-box; word-wrap:break-word; word-break:break-word; }
.clearfix::after { display:block; clear:both; content:""; }

} /* END body#tinymce */


body#tinymce, .editor-styles-wrapper {
 margin:10px; font-size:<?php echo esc_attr($dp_options['content_font_size']); ?>px;
 <?php if($dp_options['content_font_type'] == 'type1') { ?>
 font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif;
 <?php } elseif($dp_options['content_font_type'] == 'type2') { ?>
 font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif;
 <?php } else { ?>
 font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif;
 <?php }; ?>
}


/* デフォルト見出し+クイックタグ見出しのスタイル */
body#tinymce, .editor-styles-wrapper {

h1 { font-size:<?php echo esc_attr($dp_options['single_title_font_size']); ?>px; font-weight:600; line-height:1.4; margin: 120px auto 1.3em; text-align:center; }
h2 { font-size:<?php echo esc_attr($dp_options['single_title_font_size']); ?>px; font-weight:600; line-height:1.4; margin: 3em auto 1.3em; text-align:center; }
h3 { font-size:<?php echo esc_attr($dp_options['single_title_font_size']) - 2; ?>px; font-weight:600; line-height:1.6; margin: 3em auto 1.3em; }
h4 { font-size:<?php echo esc_attr($dp_options['single_title_font_size']) - 4; ?>; font-weight:600; line-height:1.6; margin: 2.3em auto 1em; }
h5 { font-size:<?php echo esc_attr($dp_options['single_title_font_size']) - 6; ?>; font-weight:600; line-height:1.6; margin: 2.3em auto 1em; }
h6 { font-size:<?php echo esc_attr($dp_options['single_title_font_size']) - 8; ?>; font-weight:600; line-height:1.6; margin: 2.3em auto 1em; }

} /* END body#tinymce */


/* ----------------------------------------------------------------------
 WordPress プリセットスタイル
---------------------------------------------------------------------- */
body#tinymce, .editor-styles-wrapper {

*:first-child { margin-top:0 !important; }
*:last-child { margin-bottom:0 !important; }


/* alignment */
.alignright { float:right; }
.alignleft { float:left; }
.aligncenter { display:block; margin-left:auto; margin-right:auto; margin-bottom:7px; }
blockquote.alignleft, img.alignleft { margin:7px 24px 7px 0; }
.wp-caption.alignleft { margin:7px 14px 7px 0; }
blockquote.alignright, img.alignright { margin:7px 0 7px 24px; }
.wp-caption.alignright { margin:7px 0 7px 14px; }
blockquote.aligncenter, img.aligncenter, .wp-caption.aligncenter { margin-top:2em; margin-bottom:2em; }


/* text and headline */
p { line-height:2.4; margin:0 0 2em 0; }


/* image */
img[class*="align"], img[class*="wp-image-"], img[class*="attachment-"], img.size-full, img.size-large, .wp-post-image, img
{ height:auto; max-width:100%; }


/* list */
li, dt, dd { line-height:2.2; }
ul, ol, dl { margin:0 0 2em; padding:0; }
ol { list-style:decimal outside none; margin-left:1.5em; }
ul { list-style:circle outside none; margin-left:1.3em; }
li > ul, li > ol { margin-bottom:0; }
dt { font-weight:bold; }
dd { margin-bottom:1em; }


/* table */
table { margin:0 0 2em 0; width:100% !important; border-collapse:separate !important; border-left:1px solid #ddd; border-top:1px solid #ddd; }
td, th { border-right:1px solid #ddd; border-bottom:1px solid #ddd; padding:18px 30px 16px; line-height:2.2; background:#fff; -webkit-box-sizing:border-box; box-sizing:border-box; }
th { background:#f7f7f7; font-weight:normal; }
/* table style */
table.table_no_border th, table.table_no_border td { border:none; padding-left:0; }
table.table_border_serumtal th, table.table_border_serumtal td { border-left:none; border-right:none; padding-left:0; }


/* blockquote */
blockquote {
  position:relative; color:rgba(0, 0, 0, 0.6); margin:0 0 2em; padding:2em 2.4em;
  box-shadow:none; background:rgba(0, 0, 0, 2%); border:none; border-left:3px solid #000;
}
blockquote:before {  line-height:40px; top:5px; left:10px; }
blockquote:after {  text-align:left; line-height:60px; bottom:10px; right:-2px; }
blockquote:before, blockquote:after {
  content: '"'; font-style:italic; font-size:30px; font-weight:normal; color:#000;
  width:30px; height:30px; position:absolute;
}
blockquote p { line-height:1.8; }
blockquote cite{ text-align: right; display: block; border-top: 1px dotted #000; margin: 2em 0 0; padding: 1em 0 0; font-size: 14px; }

} /* END body#tinymce */


/* captions */
.wp-caption { margin-bottom:2em; background:#fff; border:1px solid #ddd; padding:10px; max-width:100%; }
.wp-caption-text { text-align:center; line-height:1.5; margin:0 auto; padding:10px 0 0; font-size:14px; }
.wp-caption img[class*="wp-image-"] { display:block; margin:0 auto 0; }


/* gallery */
.gallery { margin-bottom:2em; }
.gallery img { border: 0 !important; display:block; margin:0; }
.gallery-item { float:left; margin:0 4px 4px 0; overflow:hidden; position:relative; }
.gallery-columns-1, .gallery-columns-2, .gallery-columns-3, .gallery-columns-4, .gallery-columns-5,
  .gallery-columns-6, .gallery-columns-7, .gallery-columns-8, .gallery-columns-9, .gallery-columns-10 { margin:0 -4px -4px 0 !important; }
.gallery-columns-1 .gallery-item { max-width:100%; }
.gallery-columns-2 .gallery-item { max-width:calc(50% - 4px); }
.gallery-columns-3 .gallery-item { max-width:calc(100% / 3 - 4px); }
.gallery-columns-4 .gallery-item { max-width:calc(25% - 4px); }
.gallery-columns-5 .gallery-item { max-width:calc(20% - 4px); }
.gallery-columns-6 .gallery-item { max-width:calc(100% / 6 - 4px); }
.gallery-columns-7 .gallery-item { max-width:calc(100% / 7 - 4px); }
.gallery-columns-8 .gallery-item { max-width:calc(100% / 8 - 4px); }
.gallery-columns-9 .gallery-item { max-width:calc(100% / 9 - 4px); }
.gallery-columns-10 .gallery-item { max-width:calc(10% - 4px); }
.gallery-caption {
  background-color:rgba(0, 0, 0, 0.7); color:#fff; font-size:12px; line-height:1.5; margin:0; pointer-events:none;
  padding:6px 8px; position:absolute; bottom:0; left:0; text-align:left; width:100%;
  -webkit-box-sizing:border-box; box-sizing:border-box;
  transform: translate3d(0, 100%, 0);
  transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1) 0s;
}
.gallery-item:hover .gallery-caption { transform: translate3d(0, 0, 0); }
.gallery-columns-7 .gallery-caption, .gallery-columns-8 .gallery-caption, .gallery-columns-9 .gallery-caption, .gallery-columns-10 .gallery-caption { display: none; }


/* etc */
.wp-smiley { border:0; margin-bottom:0; margin-top:0; padding:0; }
address { margin:0 0 24px 0; line-height:2.2; }
pre { border-left:5px solid <?php echo esc_attr($dp_options['main_color']); ?>; font-size:12px; margin:0 0 27px 0; line-height:30px; background: repeating-linear-gradient(#eee 0, #eee 30px, #fafafa 30px, #fafafa 60px); padding:0 17px; overflow:auto; }
.sticky { }
.mejs-container { margin: 12px 0 25px; }


/* ----------------------------------------------------------------------
 design-plus.css
---------------------------------------------------------------------- */
/* Column layout - カラムレイアウト */
.post_row {
  line-height:2.4; margin-bottom:2em;
  display:-webkit-box; display:-ms-flexbox; display:-webkit-flex; display:flex;
  -ms-flex-wrap:wrap; -webkit-flex-wrap:wrap; flex-wrap:wrap;
  -ms-align-items:flex-start; -webkit-align-items:flex-start; align-items:flex-start;
}
.post_col {
  -ms-flex: 1 1 0%; -webkit-flex: 1 1 0%; flex: 1 1 0%;
}
.post_col-2 { margin-right:30px; width:calc(50% - 15px); }
.post_col-3 { margin-right:25px; }
.post_col:last-of-type { margin-right:0; }


/* headline - 見出しのスタイル */
.style3a, .style3b, .style4a, .style4b, .style5a, .style5b, .style6 { font-weight: 500; line-height:1.6; }
/* h2 */
.style2a { margin:65px 0 30px !important; padding:0 0 .9em !important; border-bottom:3px solid #000; font-size:26px !important; }
.style2b { margin:65px 0 30px !important; padding:.48em 1em .47em !important; background:#000; color:#fff; font-size:26px !important; }
/* h3 */
.style3a { margin:65px 0 30px !important; padding:1.2em .15em !important; border-top:1px solid #ccc; border-bottom:1px solid #ccc; font-size:22px !important; }
.style3b { margin:65px 0 30px !important; padding:1.1em 1.4em 1.15em !important; border:1px solid #ddd; border-top:3px solid #000; background:#fafafa; font-size:22px !important; }
/* h4 */
.style4a { margin:65px 0 30px !important; padding:.4em 0 .4em 1.2em !important; border-left:3px solid #000; font-size:20px !important; font-weight:500; }
.style4b { -webkit-box-sizing:border-box; box-sizing:border-box; position:relative; margin:65px 0 30px !important; padding:.8em 1.5em .8em !important; border-left:#000 3px solid; font-size:20px !important; }
.style4b:after { position:absolute; top:0; left:0; width:100%; height:calc(100% - 2px); border:1px solid #ddd; border-left:none; content: ''; }
/* h5 */
.style5a { margin:65px 0 30px !important; padding:.85em 1.5em .8em !important; border:1px solid #ddd; background:#fafafa; font-size:18px !important; }
.style5b { margin:65px 0 30px !important; padding:.85em 1.5em .8em !important; background:#000; color:#fff; font-size:18px !important; }
/* h6 */
.style6 { position:relative; margin:65px 0 30px !important; padding:0 .8em 0 1.3em !important; color:#000; font-size:16px !important; font-weight:700; }
.style6:before { position:absolute; top:.35em; left:0; width:12px; height:12px; background:#000; content:""; }
.balloon { display:block; z-index:0; position:relative; width:auto; min-width:115px; margin:50px 0 22px; padding:.5em 18px .5em; clear:both; border-bottom:0; background:#222; color:#fff; font-size:20px; font-weight:400; text-align:left; }
.balloon:after { display:block; position:absolute; bottom:-10px; left:30px; width:0px; height:0px; margin-left:-10px; border-width:10px 10px 0 10px; border-style:solid; border-color:#222 transparent transparent transparent; content:""; }


/* Vertical */
.p-vertical { width:100%; margin:70px 0; font-size:36px; line-height:1.4; text-align:center; }
.p-vertical p { display:inline-block; margin:0; font-size:inherit; line-height:inherit; text-align:left; -webkit-writing-mode:vertical-rl; -ms-writing-mode:tb-rl; writing-mode:vertical-rl; }


/* Underline - アンダーライン */
.q_underline { border-bottom: 2px solid #fff799; }


/* Speech balloon - スピーチ */
.q_frame + .speech_balloon { margin-top:2.8em; }
.speech_balloon { margin-bottom:2.5em !important; display: flex; align-items: flex-start; }
.speech_balloon_user { flex: 0 0 auto; margin-right: 36px; min-width: 80px; text-align: center; }
.speech_balloon_user_image { border-radius: 50%; height: 80px !important; width: 80px; object-fit: cover; margin:0 !important; }
.speech_balloon_user_name { font-size: 87.5%; line-height: 1.2; margin-top: 12px; }
.speech_balloon_user_name:only-child { display: flex; align-items: center; margin-top: 0; min-height: 80px; }
.speech_balloon_text { flex: 1 1 auto; margin-bottom: 3em; position:relative; }
.speech_balloon_text_inner { background: #fff; border: 2px solid #ddd; border-radius: 10px; line-height: 2; min-height: 80px; padding: 22px 28px; position: relative; }
.speech_balloon_text_inner > *:last-child { margin-bottom: 0 !important; }
.speech_balloon.right { flex-direction: row-reverse }
.speech_balloon.right .speech_balloon_user { margin-left: 36px; margin-right: 0; }
.speech_balloon_text .before , .speech_balloon_text .after{ border-color: transparent; border-style: solid; pointer-events: none; height: 0; margin-top: -10px; width: 0; position: absolute; right: 100%; top: 40px; }
.speech_balloon_text .before { border-left-color:inherit; border-width: 8px 0 8px 10px; }
.speech_balloon_text .after { border-right-color:inherit; border-width: 8px 10px 8px 0; }
.speech_balloon.left .before { transform:rotate(180deg); }
.speech_balloon.left .after { margin-right:-3px; }
.speech_balloon.right .before { left:100%; }
.speech_balloon.right .after { left:100%; transform:rotate(180deg); margin-left:-3px; }


/* Google Map */
.qt_google_map { width:100%; height:500px; background:#ddd; margin:0 0 35px 0 !important; }
.qt_google_map .qt_googlemap_embed { width:100%; height:500px; }
.qt_google_map .pb_googlemap_custom-overlay-inner { display: -webkit-box; display: -ms-flexbox; display: flex; position: absolute; top: -80px; left: -50px; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; width: 100px !important; height: 100px !important; border-radius: 50%; font-size: 16px; text-align: center; padding:0 15px; box-sizing:border-box; font-weight:600; }
.qt_google_map .pb_googlemap_custom-overlay-inner::after { display: block; position: absolute; right: 0; bottom: -15px; left: 0; width: 0; height: 0; margin: auto; border-width: 16px 5px 0 5px; border-style: solid; content: ""; }


/* flame - 囲み枠 */
.q_frame { line-height:1.8; position: relative; padding:1.3em 2em; margin-bottom:2.5em !important; border:1px solid #ddd; }
* + .q_frame { margin-top:2.5em !important; }
.q_frame + .sc { margin-top:2.5em !important; }
.q_frame_label {
  max-width:calc(100% - 2em); line-height: 1.4; font-weight:600;
  display:inline-block; padding:0 1em; background:inherit;
  position: absolute; top:-0.7em; left:1em;
}
.well { margin-bottom:30px; padding:1.1em 2em; border:1px solid #ddd; border-radius:6px; background-color:#fafafa; }
.well2 { margin-bottom:30px; padding:1.1em 2em; border:1px solid #ddd; }
.well3 { margin-bottom:30px; padding:1.1em 2em; border:1px dashed #ddd; background:#fafafa; }
.wl_red { border-color:#ebccd1; background-color:#f2dede; color:#a94442 !important; }
.wl_yellow { border-color:#faebcc; background-color:#fcf8e3; color:#8a6d3b !important; }
.wl_blue { border-color:#bce8f1; background-color:#d9edf7; color:#31708f !important; }
.wl_green { border-color:#d6e9c6; background-color:#dff0d8; color:#3c763d !important; }


/* リストデザイン */
.q_styled_ol { counter-reset: item; list-style-type: none; margin-left:0 !important; margin-bottom:2em; position: relative;}
.q_styled_ol li {  margin-bottom:0.4em; display: block;
  padding-left: 2em;}
.q_styled_ol li:before {
  counter-increment: item; content: counter(item);
  display:-webkit-box; display:-webkit-flex; display:flex;
  -webkit-box-align: center; -ms-flex-align: center; align-items: center;
  -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center;
  width:1.5em; min-width: 1.5em; height: 1.5em; background:<?php echo esc_attr($dp_options['main_color']); ?>;
  color: #fff; border-radius: 50%; line-height: 1; margin-top: 0.3em; margin-right: 0.7em;
  position: absolute;left: 0;
}


/* button - CSSボタンのスタイル */
.q_custom_button {
  max-width: 100%; line-height:1.5; padding:0 1.5em;
  display:-webkit-box; display:-ms-flexbox; display:-webkit-inline-flex; display:inline-flex;
  -ms-justify-content:center; -webkit-justify-content:center; justify-content:center;
  -ms-align-items:center; -webkit-align-items:center; align-items:center;
  text-align:center; position:relative; overflow:hidden; font-size:16px; z-index:1;
  color:#fff; border-width:1px; border-style:solid; text-decoration: none;
  transition: border-color 0.3s ease;
  -webkit-box-sizing:border-box; box-sizing:border-box;
}
.q_custom_button:before {
  content: ''; display: block; width: 100%; height: calc(100% + 2px);
  position: absolute; top: -1px; z-index: -1;
  transition-property:background-color, left, opacity;
  transition-duration:0.5s;
  transition-timing-function:cubic-bezier(0.22, 1, 0.36, 1);
}
.q_custom_button:hover { color:#fff; text-decoration:none !important; }


/* Button option */
.rounded { border-radius:6px; }
.pill { border-radius:70px; }
.bt_red{ background:#c01f0e; border-color:#c01f0e; color:#fff; }
.bt_red:hover, .bt_red:focus { background-color:#d33929; border-color:#d33929; color:#fff; }
.bt_yellow{ background:#f1c40f; border-color:#f1c40f; color:#fff; }
.bt_yellow:hover, .bt_yellow:focus { background-color:#f9d441; border-color:#f9d441; color:#fff; }
.bt_blue{ background:#2980b9; border-color:#2980b9; color:#fff; }
.bt_blue:hover, .bt_blue:focus { background-color:#3a91c9; border-color:#3a91c9; color:#fff; }
.bt_green{ background:#27ae60; border-color:#27ae60; color:#fff; }
.bt_green:hover, .bt_green:focus { background-color:#39c574; border-color:#39c574; color:#fff; }


/* クイックタグのデザインボタン */
.q_button_wrap { text-align:center; margin-bottom:2em; }


/* YouTune */
.ytube { position:relative; height:0; margin-top:20px; margin-bottom:2em; padding-bottom:56.25%; padding-top:30px; overflow:hidden; }
.ytube iframe { position:absolute; top:0; right:0; width:100% !important; height:100% !important; }


 /* Table */
.rps_table { line-height:2.0; }
.table_no_border { border:none !important; }
.table_no_border th, .table_no_border td { padding-left:0; border:none; }
.table_border_horizontal { border-left:none !important; }
.table_border_horizontal th, .table_border_horizontal td { padding-left:0; border-right:none; border-left:none; }


/* Cardlink style - カードリンクのスタイル */
.cardlink {
  word-wrap:break-word; margin:15px 0 50px; padding:20px; border:1px solid #ddd; background:#fff;
  display:flex; flex-wrap:wrap; align-items:center;
}
.cardlink + .cardlink { margin-top:-20px; }
.cardlink .image { margin-right:25px; }
.cardlink .image img { width:130px; height:130px; -o-object-fit:cover; object-fit:cover; display:block; }
.cardlink .content { width:calc(100% - 155px); padding-top:5px; }
.cardlink .title_area { }
.cardlink .meta { display:flex; flex-wrap:wrap; margin:0 0 5px 0; }
.cardlink .meta > p { color:#222; font-size:14px; line-height:1; margin:0 15px 10px 0; position:relative; }
.cardlink .meta > p.date:before { font-family:'normal_icon'; content:'\e903'; font-size:16px; margin:0 5px 0 0; top:1.5px; position:relative; }
.cardlink .meta > p.modified_date { margin-right:0; }
.cardlink .meta > p.modified_date:before { font-family:'normal_icon'; content:'\e91f'; font-size:16px; margin:0 5px 0 0; top:1.5px; position:relative; }
.cardlink .title { margin:-3px 0 5px 0 !important; font-size:16px; font-weight:600; line-height:1.7; }
.cardlink .title a { text-decoration:none; display:block; }
.cardlink .title a:hover { text-decoration:underline; }
.cardlink .desc { font-size:14px; line-height:1.7; margin:0 0 0 0 !important; max-height:3.4em; overflow:hidden; visibility:visible; }
.cardlink .desc span { display:-webkit-inline-box; -webkit-box-orient:vertical; -webkit-line-clamp:2; }


/* QUADRAから追加分 */
.is-sp { display:none !important; }
.a_break { display:inline-block; }
.underline, .underline:hover { text-decoration:underline; }
.e_link { display: inline-block; position:relative; padding:0 20px 0 0; }
.e_link:after { font-family: 'normal_icon'; content: '\e920'; position:absolute; right:0; top:1px; }
img.frame { border: 1px solid #d2d2d2; margin-bottom:-12px; box-shadow: 0 6px 6px -6px #cccccc; }


/* フォント関連 */
.text70{font-size:70%}       /* フォントサイズ70% */
.text80{font-size:80%}
.text90{font-size:90%}
.text100{font-size:100%}
.text110{font-size:110%}
.text120{font-size:120%}
.text130{font-size:130%}
.text140{font-size:140%}
.text150{font-size:150%}
.text160{font-size:160%}
.text170{font-size:170%}
.text180{font-size:180%}
.text190{font-size:190%}
.text200{font-size:200%}
.text210{font-size:210%}
.text220{font-size:220%}
.b{font-weight:700}     /* 太字 */
.u{text-decoration:underline}     /* 下線 */
.del{text-decoration:line-throug} /* 打ち消し線 */

.red{color:red}     /* 赤色 */
.blue{color:#2ca9e1}    /* 青色 */
.green{color:#82ae46}   /* 緑色 */
.orange{color:#ff7d00}    /* 橙色 */
.yellow{color:#fff000}    /* 黄色 */
.pink{color:#ff0084}    /* ピンク */
.gray{color:#999999}    /* グレー */

.att {padding-left:1em;text-indent:-1em;} /* 注意書き等で二行目以降を字下げ */
.att_box { margin:2em 0 2.5em; padding:1em 1.2em; line-height:2.0; border:1px dotted #cccccc; background:#fcfcfc; box-shadow:0px 4px 0px 0px #f7f7f7; } /* テキストボックス */


/* background-color - 背景色 */
.bg-yellow{padding:2px;background-color:#ff0} /* 黄色の文字背景 */
.bg-blue{padding:2px;background-color:#4ab0f5}  /* 青色の文字背景 */
.bg-red{padding:2px;background-color:red} /* 赤色の文字背景 */


/* text-align - 配置 */
.align1{text-align:center !important} /* 中央寄せ */
.align2{text-align:right !important}  /* 右寄せ */
.align3{text-align:left !important} /* 左寄せ */


/* float - 回り込み */
.r-flo{float:right;margin:10px} /* 右に回り込み */
.l-flo{float:left;margin:10px}  /* 左に回り込み */
.f-clear{clear:both}      /* 回り込みの解除 */


/* margin - 要素の外側の余白 */
.m0{margin:0 !important}    /* margin 0px を指定するクラス */
.mt0{margin-top:0 !important}   /* margin-top0px を指定するクラス */
.mr0{margin-right:0 !important}   /* margin-right0px を指定するクラス*/
.mb0{margin-bottom:0 !important}  /* margin-bottom0px を指定するクラス*/
.ml0{margin-left:0 !important}    /* margin-left0px を指定するクラス*/

.m5{margin:5px !important}
.mt5{margin-top:5px !important}
.mr5{margin-right:5px !important}
.mb5{margin-bottom:5px !important}
.ml5{margin-left:5px !important}

.m10{margin:10px !important}
.mt10{margin-top:10px !important}
.mr10{margin-right:10px !important}
.mb10{margin-bottom:10px !important}
.ml10{margin-left:10px !important}

.m15{margin:15px !important}
.mt15{margin-top:15px !important}
.mr15{margin-right:15px !important}
.mb15{margin-bottom:15px !important}
.ml15{margin-left:15px !important}

.m20{margin:20px !important}
.mt20{margin-top:20px !important}
.mr20{margin-right:20px !important}
.mb20{margin-bottom:20px !important}
.ml20{margin-left:20px !important}

.m25{margin:25px !important}
.mt25{margin-top:25px !important}
.mr25{margin-right:25px !important}
.mb25{margin-bottom:25px !important}
.ml25{margin-left:25px !important}

.m30{margin:30px !important}
.mt30{margin-top:30px !important}
.mr30{margin-right:30px !important}
.mb30{margin-bottom:30px !important}
.ml30{margin-left:30px !important}

.m35{margin:35px !important}
.mt35{margin-top:35px !important}
.mr35{margin-right:35px !important}
.mb35{margin-bottom:35px !important}
.ml35{margin-left:35px !important}

.m40{margin:40px !important}
.mt40{margin-top:40px !important}
.mr40{margin-right:40px !important}
.mb40{margin-bottom:40px !important}
.ml40{margin-left:40px !important}

.m45{margin:45px !important}
.mt45{margin-top:45px !important}
.mr45{margin-right:45px !important}
.mb45{margin-bottom:45px !important}
.ml45{margin-left:45px !important}

.m50{margin:50px !important}
.mt50{margin-top:50px !important}
.mr50{margin-right:50px !important}
.mb50{margin-bottom:50px !important}
.ml50{margin-left:50px !important}

.m55{margin:55px !important}
.mt55{margin-top:55px !important}
.mr55{margin-right:55px !important}
.mb55{margin-bottom:55px !important}
.ml55{margin-left:55px !important}

.m60{margin:60px !important}
.mt60{margin-top:60px !important}
.mr60{margin-right:60px !important}
.mb60{margin-bottom:60px !important}
.ml60{margin-left:60px !important}

.m65{margin:65px !important}
.mt65{margin-top:65px !important}
.mr65{margin-right:65px !important}
.mb65{margin-bottom:65px !important}
.ml65{margin-left:65px !important}

.m70{margin:70px !important}
.mt70{margin-top:70px !important}
.mr70{margin-right:70px !important}
.mb70{margin-bottom:70px !important}
.ml70{margin-left:70px !important}

.m75{margin:75px !important}
.mt75{margin-top:75px !important}
.mr75{margin-right:75px !important}
.mb75{margin-bottom:75px !important}
.ml75{margin-left:75px !important}

.m80{margin:80px !important}
.mt80{margin-top:80px !important}
.mr80{margin-right:80px !important}
.mb80{margin-bottom:80px !important}
.ml80{margin-left:80px !important}


/* padding - 要素の内側の余白 */
.p0{padding:0 !important}   /* padding-0px を指定するクラス */
.pt0{padding-top:0 !important}    /* padding-top0px を指定するクラス */
.pr0{padding-right:0 !important}  /* padding-right0px を指定するクラス */
.pb0{padding-bottom:0 !important} /* padding-bottom0px を指定するクラス */
.pl0{padding-left:0 !important}   /* padding-left0px を指定するクラス */

.p5{padding:5px !important}
.pt5{padding-top:5px !important}
.pr5{padding-right:5px !important}
.pb5{padding-bottom:5px !important}
.pl5{padding-left:5px !important}

.p10{padding:10px !important}
.pt10{padding-top:10px !important}
.pr10{padding-right:10px !important}
.pb10{padding-bottom:10px !important}
.pl10{padding-left:10px !important}

.p15{padding:15px !important}
.pt15{padding-top:15px !important}
.pr15{padding-right:15px !important}
.pb15{padding-bottom:15px !important}
.pl15{padding-left:15px !important}

.p20{padding:20px !important}
.pt20{padding-top:20px !important}
.pr20{padding-right:20px !important}
.pb20{padding-bottom:20px !important}
.pl20{padding-left:20px !important}

.p25{padding:25px !important}
.pt25{padding-top:25px !important}
.pr25{padding-right:25px !important}
.pb25{padding-bottom:25px !important}
.pl25{padding-left:25px !important}

.p30{padding:30px !important}
.pt30{padding-top:30px !important}
.pr30{padding-right:30px !important}
.pb30{padding-bottom:30px !important}
.pl30{padding-left:30px !important}

.p35{padding:35px !important}
.pt35{padding-top:35px !important}
.pr35{padding-right:35px !important}
.pb35{padding-bottom:35px !important}
.pl35{padding-left:35px !important}

.p40{padding:40px !important}
.pt40{padding-top:40px !important}
.pr40{padding-right:40px !important}
.pb40{padding-bottom:40px !important}
.pl40{padding-left:40px !important}

.p45{padding:45px !important}
.pt45{padding-top:45px !important}
.pr45{padding-right:45px !important}
.pb45{padding-bottom:45px !important}
.pl45{padding-left:45px !important}

.p50{padding:50px !important}
.pt50{padding-top:50px !important}
.pr50{padding-right:50px !important}
.pb50{padding-bottom:50px !important}
.pl50{padding-left:50px !important}

.p55{padding:55px !important}
.pt55{padding-top:55px !important}
.pr55{padding-right:55px !important}
.pb55{padding-bottom:55px !important}
.pl55{padding-left:55px !important}

.p60{padding:60px !important}
.pt60{padding-top:60px !important}
.pr60{padding-right:60px !important}
.pb60{padding-bottom:60px !important}
.pl60{padding-left:60px !important}

.p65{padding:65px !important}
.pt65{padding-top:65px !important}
.pr65{padding-right:65px !important}
.pb65{padding-bottom:65px !important}
.pl65{padding-left:65px !important}

.p70{padding:70px !important}
.pt70{padding-top:70px !important}
.pr70{padding-right:70px !important}
.pb70{padding-bottom:70px !important}
.pl70{padding-left:70px !important}

.p75{padding:75px !important}
.pt75{padding-top:75px !important}
.pr75{padding-right:75px !important}
.pb75{padding-bottom:75px !important}
.pl75{padding-left:75px !important}

.p80{padding:80px !important}
.pt80{padding-top:80px !important}
.pr80{padding-right:80px !important}
.pb80{padding-bottom:80px !important}
.pl80{padding-left:80px !important}


/* ----------------------------------------------------------------------
 その他
---------------------------------------------------------------------- */
/* ブロックエディタ */
.wp-block-social-links a { color:#fff !important; }
.has-small-font-size { font-size:.8125em !important; }
.has-normal-font-size,
.has-regular-font-size { font-size:1em !important; }
.has-medium-font-size { font-size:1.25em !important; }
.has-large-font-size { font-size:2.25em !important; }
.has-huge-font-size, .has-larger-font-size { font-size:2.625em !important; }
.has-text-align-left { text-align:left !important; }
.has-text-align-right { text-align:right !important; }
.wp-block-embed { margin:0 0 2em 0; }


/* アイキャッチ画像のサイズ変更 */
.editor-post-featured-image__preview, .editor-post-featured-image__toggle { max-height:inherit !important; }


/* デザインボタン */
.design_button {
  max-width: 100%; line-height:1.5; padding:0 1.5em; display:inline-flex; justify-content:center; align-items:center; text-align:center; position:relative; overflow:hidden; font-size:16px; z-index:1;
  width:300px; height:70px; line-height:70px; border-radius:70px; border:1px solid <?php echo esc_attr($dp_options['main_color']); ?>; background:<?php echo esc_attr($dp_options['main_color']); ?>; color:#ffffff; text-decoration: none; transition: all 0.3s ease; cursor:pointer; 
}
.design_button:hover { background:<?php echo esc_attr($dp_options['main_color']); ?>; color:#fff !important; }


/* グレー背景のボックス */
.gray_bg { background: #f3f3f3; padding:50px; margin-bottom:50px; margin-top:50px; }


/* ----------------------------------------------------------------------
 以下クイックタグ
---------------------------------------------------------------------- */
<?php
			for ( $i = 2; $i <= 5; $i++ ){

				$heading_font_size = $dp_options['qt_h'.$i.'_font_size'];
				$heading_font_size_sp = $dp_options['qt_h'.$i.'_font_size_sp'];
				$heading_text_align = $dp_options['qt_h'.$i.'_text_align'];
				$heading_font_weight = $dp_options['qt_h'.$i.'_font_weight'];
				$heading_font_color = $dp_options['qt_h'.$i.'_font_color'];
				$heading_bg_color = $dp_options['qt_h'.$i.'_bg_color'];
				$heading_ignore_bg = $dp_options['qt_h'.$i.'_ignore_bg'];
				$heading_border = 'qt_h'.$i.'_border_';
				$heading_border_color = $dp_options['qt_h'.$i.'_border_color'];
				$heading_border_width = $dp_options['qt_h'.$i.'_border_width'];
				$heading_border_style = $dp_options['qt_h'.$i.'_border_style'];

?>
.styled_h<?php echo $i ?>, .editor-styles-wrapper .styled_h<?php echo $i ?> {
  font-size:<?php echo esc_attr($heading_font_size); ?>px!important;
  text-align:<?php echo esc_attr($heading_text_align); ?>!important;
  font-weight:<?php echo esc_attr($heading_font_weight); ?>!important;
  color:<?php echo esc_attr($heading_font_color); ?>;
  border-color:<?php echo esc_attr($heading_border_color); ?>;
  border-width:<?php echo esc_attr($heading_border_width); ?>px;
  border-style:<?php echo esc_attr($heading_border_style); ?>;
<?php

  $border_potition = array('left', 'right', 'top', 'bottom');
  foreach( $border_potition as $position ):

    if($dp_options[$heading_border.$position]){
      if($position == 'left' || $position == 'right'){
        echo 'padding-'.$position.':1em!important;'."\n".'padding-top:0.5em!important;'."\n".'padding-bottom:0.5em!important;'."\n";
      }else{
        echo 'padding-'.$position.':0.8em!important;'."\n";
      }
    }else{
      echo 'border-'.$position.':none;'."\n";
    }

  endforeach;

  if($heading_ignore_bg){
    echo 'background-color:transparent;'."\n";
  }else{
    echo 'background-color:'.esc_attr($heading_bg_color).';'."\n".'padding:0.8em 1em!important;'."\n";
  }

?>
}
<?php
		
		}
		
		// カスタムボタン
?>
.q_button_wrap { text-align:center; margin-bottom:2em; }
<?php
		for ( $i = 1; $i <= 3; $i++ ) {

      $button_type = $dp_options['qt_button'.$i.'_type'];
      $button_shape = $dp_options['qt_button'.$i.'_border_radius'];
      $button_size = $dp_options['qt_button'.$i.'_size'];
      $button_animation_type = $dp_options['qt_button'.$i.'_animation_type'];
      $button_color = $dp_options['qt_button'.$i.'_color'];
      $button_color_hover = $dp_options['qt_button'.$i.'_color_hover'];

      $colors = array();
      $animations = array();

      switch ($button_shape){
        case 'flat': $shape = 'border-radius:0px;'; break;
        case 'rounded': $shape = 'border-radius:6px;'; break;
        case 'oval': $shape = 'border-radius:70px;'; break;
      }
      switch ($button_size){
        case 'small':
         $size = 'min-width:130px; height:40px;';
         $sp_size1 = 'min-width:130px;';
         $sp_size2 = 'min-width:130px;';
         break;
        case 'medium':
          $size = 'min-width:280px; height:60px;';
          $sp_size1 = 'min-width:260px;';
          $sp_size2 = 'min-width:240px; height:50px;';
          break;
        case 'large':
          $size = 'min-width:300px; height:70px;';
          $sp_size1 = 'min-width:300px;';
          $sp_size2 = 'min-width:240px;';
          break;
      }
      switch ($button_type){
        case 'type1': $colors = array('color:#fff !important; background-color:'.$button_color.';border:none;', 'background-color:'.$button_color_hover.' !important;', '' ); break;
        case 'type2': $colors = array('color:'.$button_color.' !important; border-color:'.$button_color.';', 'background-color:'.$button_color_hover.' !important;', 'color:#fff !important; border-color:'.$button_color_hover.' !important;'); break;
        case 'type3': $colors = array('color:#fff !important; border-color:'.$button_color.';','background-color:'.$button_color.';', 'color:'.$button_color_hover.' !important; border-color:'.$button_color_hover.'; !important' ); break;
      }
      switch ($button_animation_type){
        case 'animation_type1': $animations = ($button_type != 'type3') ? array('opacity:0;', 'opacity:1;') : array('opacity:1;', 'opacity:0;'); break;
        case 'animation_type2': $animations = ($button_type != 'type3') ? array('left:-100%;', 'left:0;') : array('left:0;', 'left:100%;'); break;
        case 'animation_type3': $animations = ($button_type != 'type3') ? array('left:calc(-100% - 110px);transform:skewX(45deg); width:calc(100% + 70px);', 'left:-35px;') : array('left:-35px;transform:skewX(45deg); width:calc(100% + 70px);', 'left:calc(100% + 50px);'); break;
      }
?>
a.q_custom_button<?php echo $i; ?> { <?php echo $size.$shape.$colors[0]; ?> }
a.q_custom_button<?php echo $i; ?>:before { <?php echo $colors[1].$animations[0]; ?> }
a.q_custom_button<?php echo $i; ?>:hover { <?php echo $colors[2]; ?> }
a.q_custom_button<?php echo $i; ?>:hover:before { <?php echo $animations[1]; ?> }

<?php

	}


	// アンダーライン
	for ( $i = 1; $i <= 3; $i++ ) {

		$underline_color = $dp_options['qt_underline'.$i.'_border_color'];
		$underline_font_weight = $dp_options['qt_underline'.$i.'_font_weight'];

?>
.q_underline<?php echo $i; ?> {
	font-weight:<?php echo esc_attr($underline_font_weight); ?>;
	border-bottom-color:<?php echo esc_attr($underline_color); ?>;
}

<?php

  }

	// 囲み枠
	for ( $i = 1; $i <= 3; $i++ ) {

    $label_color = $dp_options['qt_frame'.$i.'_label_color'];
    $bg_color = $dp_options['qt_frame'.$i.'_content_bg_color'];
		$border_radius = $dp_options['qt_frame'.$i.'_content_shape'];
    $border_width = $dp_options['qt_frame'.$i.'_content_border_width'];
    $border_color = $dp_options['qt_frame'.$i.'_content_border_color'];
		$border_style = $dp_options['qt_frame'.$i.'_content_border_style'];


?>
.q_frame<?php echo $i; ?> {
	background:<?php echo esc_attr($bg_color); ?>;
	border-radius:<?php echo esc_attr($border_radius); ?>px;
	border-width:<?php echo esc_attr($border_width); ?>px;
	border-color:<?php echo esc_attr($border_color); ?>;
	border-style:<?php echo esc_attr($border_style); ?>;
}
.q_frame<?php echo $i; ?> .q_frame_label {
	color:<?php echo esc_attr($label_color); ?>;
}

<?php

	}
?>


<?php
	exit;
}
add_action( 'wp_ajax_tcd_quicktags_dynamic_css', 'tcd_ajax_quicktags_dynamic_css' );

// add_editor_style()だとテーマ内のcssが最後になるためここで最後尾にcss追加
function editor_stylesheets_tcd_visual_editor_dynamic_css( $stylesheets ) {
	$stylesheets[] = get_tcd_quicktags_dynamic_css_url();
	$stylesheets = array_unique( $stylesheets );
	return $stylesheets;
}
