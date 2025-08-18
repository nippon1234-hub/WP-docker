<?php

// フッターバー フロントエンドフック登録
function footer_bar_wp() {

	global $dp_options, $post;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	// フッターバーを表示するかどうか
	$show_footer_bar = ( $dp_options['footer_bar_type'] == 'type1' ) ? false : true;

	if( $show_footer_bar ){

		if( !wp_is_mobile() )
			$show_footer_bar = false;

		if( is_404() )
			$show_footer_bar = false;

	}

	// フック登録
	if ( $show_footer_bar ) {
		add_filter( 'body_class', 'footer_bar_body_class' );
		add_action( 'tcd_footer_after', 'render_footer_bar' );
	}

}
add_action( 'wp', 'footer_bar_wp' );


// フッターバー body class
function footer_bar_body_class( $classes ) {
  $classes[] = 'show_footer_bar';
	return $classes;
}

// フッターバー 出力
function render_footer_bar() {

  global $footer_bar_icon_options;

	// テーマオプションを取得
	$options = get_design_plus_option();

	// ページタイトルを取得
	$title = wp_title( '|', false, 'right' );

	// ページ URL を取得
	$url = ( empty( $_SERVER['HTTPS'] ) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	$footer_bar_btn_classes = array();
	$footer_bar_btn_url = '';
	$footer_bar_btn_target = '';
	$footer_bar_type = $options['footer_bar_type'];

?>
<div id="js-footer-bar" class="p-footer-bar">
	<div class="p-footer-bar__inner">
		<ul class="p-footer-bar__list p-footer-bar--<?php echo esc_attr($footer_bar_type); ?>">
<?php
	// ボタンを表示

	$is_share = false;
	foreach ( $options['footer_bar_btns'] as $key => $value ) :

		switch ( $value['type'] ) {

			// ボタンタイプ：デフォルト
			case 'type1' :
				$footer_bar_btn_class = '';
				$footer_bar_btn_url = $value['url'];
				$footer_bar_btn_target = $value['target'];
				break;

			// ボタンタイプ：シェア
			case 'type2' :
				$footer_bar_btn_class = 'js-footer-bar-share';
				$footer_bar_btn_url = '#';
				$is_share = true;
				break;
			
			// ボタンタイプ：電話番号
			case 'type3' :
				$footer_bar_btn_class = '';
				$footer_bar_btn_url = 'tel:' . $value['number'];
				break;

		}

		$button_color = ( $footer_bar_type === 'type4' ) ? 'style="background-color:'.esc_attr($value['color']).';"' : '' ;

    // アイコン
    if($value['icon'] == 'material_icon' && $value['material_icon']){
      $icon = $value['material_icon'];
      $icon_type = 'google';
      $icon_label = 'others';
    } else {
      $icon = $value['icon'];
      $icon_type = $value['icon'] ? $footer_bar_icon_options[$value['icon']]['type'] : '';
      $icon_label = $value['icon'] ? $footer_bar_icon_options[$value['icon']]['label'] : '';
    }

?>
			<li class="p-footer-bar__item <?php echo $footer_bar_btn_class; ?>">
				<a class="p-footer-bar__item-link no_auto_scroll" href="<?php echo esc_url( $footer_bar_btn_url ); ?>" <?php echo $footer_bar_btn_target ? ' target="_blank"' : ''; ?> <?php echo $button_color; ?>>
					<?php if( $footer_bar_type !== 'type4' ) { ?>
					<span class="icon icon_type_<?php echo esc_attr($icon_type); ?> <?php echo esc_attr($icon_label); ?>">&#x<?php echo esc_attr($icon); ?>;</span>
					<?php } ?>
					<span class="label"><?php echo esc_html( $value['label'] ); ?></span>
				</a>
			</li>
<?php
	endforeach;
?>
		</ul>
	</div>

	<?php if( $is_share ){ ?>
	<div id="js-footer-bar-modal" class="modal-overlay p-footer-bar__modal">
		<ul class="p-footer-bar__modal-share">
			<li class="p-footer-bar__modal-share-item">
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( $url ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook.png?2.0" alt=""></a>
			</li>
			<li class="p-footer-bar__modal-share-item" style="border-radius:2px; overflow:hidden;">
				<a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>" onClick="window.open(encodeURI(decodeURI(this.href)), 'tweetwindow', 'width=650, height=470, personalbar=0, toolbar=0, scrollbars=1, sizable=1'); return false;"><img src="<?php echo get_template_directory_uri(); ?>/img/twitter_x.png?2.0" alt=""></a>
			</li>
			<li class="p-footer-bar__modal-share-item">
				<a href="https://line.me/R/msg/text/?<?php echo rawurlencode( $title ); ?><?php echo rawurlencode( $url ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/line.png?2.0" alt=""></a>
			</li>
			<li class="p-footer-bar__modal-share-item">
				<a href="https://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="simple" data-hatena-bookmark-width="100" data-hatena-bookmark-height="100" title="このエントリーをはてなブックマークに追加"><img src="<?php echo get_template_directory_uri(); ?>/img/hatena.png" alt="このエントリーをはてなブックマークに追加" width="400" height="400" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
			</li>
		</ul>
		<div id="js-footer-bar-modal-overlay" class="p-footer-bar__modal-overlay"></div>
	</div>
	<?php } ?>

</div>
<?php

}
