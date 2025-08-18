<?php
/*
 * オプションの設定
 */

//フォントの縦方向
global $font_direction_options;
$font_direction_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Horizontal', 'tcd-issue' )),
  'type2' => array('value' => 'type2','label' => __( 'Vertical', 'tcd-issue' )),
);


// コンテンツの方向
global $content_direction_options;
$content_direction_options = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Align left', 'tcd-issue' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Align center', 'tcd-issue' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Align right', 'tcd-issue' ))
);


// コンテンツの方向（縦方向）
global $content_direction_options2;
$content_direction_options2 = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Align top', 'tcd-issue' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Align middle', 'tcd-issue' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Align bottom', 'tcd-issue' ))
);


// hover effect
global $hover_type_options;
$hover_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Zoom in', 'tcd-issue' )),
  'type2' => array('value' => 'type2','label' => __( 'Zoom out', 'tcd-issue' )),
  'type3' => array('value' => 'type3','label' => __( 'Slide', 'tcd-issue' )),
  'type4' => array('value' => 'type4','label' => __( 'Fade', 'tcd-issue' )),
  'type5' => array('value' => 'type5','label' => __( 'No animation', 'tcd-issue' ))
);
global $hover3_direct_options;
$hover3_direct_options = array(
  'type2' => array('value' => 'type2','label' => __( 'Right to Left', 'tcd-issue' )),
  'type1' => array('value' => 'type1','label' => __( 'Left to Right', 'tcd-issue' )),
);


//フォントタイプ
global $font_type_options;
$font_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Meiryo', 'tcd-issue' ),'label_en' => 'Arial'),
  'type2' => array('value' => 'type2','label' => __( 'YuGothic', 'tcd-issue' ),'label_en' => 'San Serif'),
  'type3' => array('value' => 'type3','label' => __( 'YuMincho', 'tcd-issue' ),'label_en' => 'Times New Roman')
);

//ロゴタイプ
global $loding_logo_type_options;
$loding_logo_type_options = array(
  'text' => array('value' => 'text','label' => __( 'Site name', 'tcd-issue' ),'label_en' => 'Text'),
  'image' => array('value' => 'image','label' => __( 'Site image', 'tcd-issue' ),'label_en' => 'Image'),
);



// ソーシャルボタンの設定
global $sns_type_options;
$sns_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Type1 (color)', 'tcd-issue' ), 'img' => 'share_type1.jpg'),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Type2 (mono)', 'tcd-issue' ), 'img' => 'share_type2.jpg'),
  'type3' => array( 'value' => 'type3', 'label' => __( 'Type3 (4 column - color)', 'tcd-issue' ), 'img' => 'share_type3.jpg'),
  'type4' => array( 'value' => 'type4', 'label' => __( 'Type4 (4 column - mono)', 'tcd-issue' ), 'img' => 'share_type4.jpg'),
  'type5' => array( 'value' => 'type5', 'label' => __( 'Type5 (official design)', 'tcd-issue' ), 'img' => 'share_type5.jpg')
);


// ロゴに画像を使うか否か
global $logo_type_options;
$logo_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Use text for logo', 'tcd-issue' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type1.gif'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Use image for logo', 'tcd-issue' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type2.gif'
  )
);


// Google Maps
global $gmap_marker_type_options;
$gmap_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Use default marker', 'tcd-issue' ), 'img' => 'gmap_marker_type1.jpg'),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Use custom marker', 'tcd-issue' ), 'img' => 'gmap_marker_type2.jpg' )
);
global $gmap_custom_marker_type_options;
$gmap_custom_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Text', 'tcd-issue' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Image', 'tcd-issue' ) )
);


// アイテムのタイプ
global $item_type_options;
$item_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Image', 'tcd-issue' )),
  'type2' => array('value' => 'type2','label' => __( 'Video', 'tcd-issue' )),
  'type3' => array('value' => 'type3','label' => __( 'Youtube', 'tcd-issue' )),
);


// スライダーのコンテンツタイプ
global $index_slider_content_type_options;
$index_slider_content_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Same as PC setting', 'tcd-issue' )),
  'type2' => array('value' => 'type2','label' => __( 'Display diffrent content in mobile size', 'tcd-issue' )),
);


// 表示設定
global $basic_display_options;
$basic_display_options = array(
	'display' => array(
		'value' => 'display',
		'label' => __( 'Display', 'tcd-issue' ),
	),
	'hide' => array(
		'value' => 'hide',
		'label' => __( 'Hide', 'tcd-issue' ),
	)
);


// 表示設定
global $single_page_display_options;
$single_page_display_options = array(
	'top' => array(
		'value' => 'top',
		'label' => __( 'Above post', 'tcd-issue' ),
	),
	'bottom' => array(
		'value' => 'bottom',
		'label' => __( 'Under post', 'tcd-issue' ),
	),
	'both' => array(
		'value' => 'both',
		'label' => __( 'Both above and bottom', 'tcd-issue' ),
	),
	'hide' => array(
		'value' => 'hide',
		'label' => __( 'Hide', 'tcd-issue' ),
	),
);

// sidebar position
global $single_sidebar_pos_options;
$single_sidebar_pos_options = array(
	'display' => array(
		'value' => 'left',
		'label' => __( 'Left', 'tcd-issue' ),
	),
	'hide' => array(
		'value' => 'right',
		'label' => __( 'Right', 'tcd-issue' ),
	)
);


// クイックタグ関連 -------------------------------------------------------------------------------------------


// テキストの方向（クイックタグで利用中）
global $text_align_options;
$text_align_options = array(
 'left' => array('value' => 'left', 'label' => __( 'Align left', 'tcd-issue' )),
 'center' => array('value' => 'center', 'label' => __( 'Align center', 'tcd-issue' )),
);


// 見出し
global $font_weight_options;
$font_weight_options = array(
	'400' => array('value' => '400','label' => __( 'Normal', 'tcd-issue' )),
	'600' => array('value' => '600','label' => __( 'Bold', 'tcd-issue' ))
);
global $border_potition_options;
$border_potition_options = array(
	'left' => array('value' => 'left','label' => __( 'Left', 'tcd-issue' )),
	'top' => array('value' => 'top','label' => __( 'Top', 'tcd-issue' )),
	'bottom' => array('value' => 'bottom','label' => __( 'Bottom', 'tcd-issue' )),
	'right' => array('value' => 'right','label' => __( 'Right', 'tcd-issue' ))
);
global $border_style_options;
$border_style_options = array(
	'solid' => array('value' => 'solid','label' => __( 'Solid line', 'tcd-issue' )),
	'dotted' => array('value' => 'dotted','label' => __( 'Dot line', 'tcd-issue' )),
	'double' => array('value' => 'double','label' => __( 'Double line', 'tcd-issue' ))
);


// ボタン
global $button_type_options;
$button_type_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Normal', 'tcd-issue' )),
	'type2' => array('value' => 'type2','label' => __( 'Ghost', 'tcd-issue' )),
	'type3' => array('value' => 'type3','label' => __( 'Reverse', 'tcd-issue' ))
);
global $button_border_radius_options;
$button_border_radius_options = array(
	'flat' => array('value' => 'flat','label' => __( 'Square', 'tcd-issue' )),
	'rounded' => array('value' => 'rounded','label' => __( 'Rounded', 'tcd-issue' )),
	'oval' => array('value' => 'oval','label' => __( 'Pill', 'tcd-issue' ))
);
global $button_size_options;
$button_size_options = array(
	'small' => array('value' => 'small','label' => __( 'Small', 'tcd-issue' )),
	'medium' => array('value' => 'medium','label' => __( 'Medium', 'tcd-issue' )),
	'large' => array('value' => 'large','label' => __( 'Large', 'tcd-issue' ))
);
global $button_animation_options;
$button_animation_options = array(
	'animation_type1' => array('value' => 'animation_type1','label' => __( 'Fade', 'tcd-issue' )),
	'animation_type2' => array('value' => 'animation_type2','label' => __( 'Swipe', 'tcd-issue' )),
	'animation_type3' => array('value' => 'animation_type3','label' => __( 'Diagonal swipe', 'tcd-issue' ))
);


// 囲み枠
global $flame_border_radius_options;
$flame_border_radius_options = array(
	'0' => array('value' => '0','label' => __( 'Square', 'tcd-issue' )),
	'10' => array('value' => '10','label' => __( 'Rounded', 'tcd-issue' ))
);


// アンダーライン
global $bool_options;
$bool_options = array(
	'yes' => array('value' => 'yes','label' => __( 'Yes', 'tcd-issue' )),
	'no' => array('value' => 'no','label' => __( 'No', 'tcd-issue' ))
);


// Google Map
global $google_map_design_options;
$google_map_design_options = array(
	'default' => array('value' => 'default','label' => __( 'Default', 'tcd-issue' )),
	'monochrome' => array('value' => 'monochrome','label' => __( 'Monochrome', 'tcd-issue' ))
);
global $google_map_marker_options;
$google_map_marker_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Default', 'tcd-issue' )),
	'type2' => array('value' => 'type2','label' => __( 'Text', 'tcd-issue' )),
	'type3' => array('value' => 'type3','label' => __( 'Image', 'tcd-issue' ))
);



// ロード画面関連 -------------------------------------------------------------------------------------------


// ロードアイコンの表示時間
global $time_options;
$time_options = array(
  '1000' => array('value' => '1000','label' => sprintf(__('%s second', 'tcd-issue'), 1)),
  '2000' => array('value' => '2000','label' => sprintf(__('%s second', 'tcd-issue'), 2)),
  '3000' => array('value' => '3000','label' => sprintf(__('%s second', 'tcd-issue'), 3)),
  '4000' => array('value' => '4000','label' => sprintf(__('%s second', 'tcd-issue'), 4)),
  '5000' => array('value' => '5000','label' => sprintf(__('%s second', 'tcd-issue'), 5)),
);


// ローディングアイコンの種類の設定
global $loading_type;
$loading_type = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Circle', 'tcd-issue' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Square', 'tcd-issue' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Dot circle', 'tcd-issue' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Logo', 'tcd-issue' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type5' => array(
		'value' => 'type5',
		'label' => __( 'Catchphrase', 'tcd-issue' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	)
);


global $loading_display_page_options;
$loading_display_page_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Front page', 'tcd-issue' )),
 'type2' => array('value' => 'type2','label' => __( 'All pages', 'tcd-issue' ))
);


global $loading_display_time_options;
$loading_display_time_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Only once', 'tcd-issue' )),
 'type2' => array('value' => 'type2','label' => __( 'Every time', 'tcd-issue' ))
);


global $loading_animation_type_options;
$loading_animation_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Fade', 'tcd-issue' )),
  'type2' => array('value' => 'type2','label' => __( 'Float', 'tcd-issue' )),
  'type3' => array('value' => 'type3','label' => sprintf( __( 'Slides(%s)', 'tcd-issue' ), '&#x2192;' ) ),
  'type4' => array('value' => 'type4','label' => sprintf( __( 'Slides(%s)', 'tcd-issue' ), '&#x2191;' ) ),
);


// フッター関連 -------------------------------------------------------------------------------------------
global $footer_bar_type_options;
$footer_bar_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Hide', 'tcd-issue' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type1.jpg'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Button with icon (Dark color)', 'tcd-issue' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type2.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Button with icon (Light color)', 'tcd-issue' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type3.jpg'
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Button without icon', 'tcd-issue' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type4.jpg'
	)
);


// フッターの固定メニュー ボタンのタイプ
global $footer_bar_button_options;
$footer_bar_button_options = array(
  'type1' => array('value' => 'type1', 'label' => __( 'Default', 'tcd-issue' )),
  'type2' => array('value' => 'type2', 'label' => __( 'Share', 'tcd-issue' )),
  'type3' => array('value' => 'type3', 'label' => __( 'Telephone', 'tcd-issue' ))
);

// フッターの固定メニューのアイコン
global $footer_bar_icon_options;
$footer_bar_icon_options = array(
  // ブログ
	'e80d' =>  array( 'type' => 'google', 'label' => 'Share' ), // シェア
	'e8dc' =>  array( 'type' => 'google', 'label' => 'Thumb Up' ), // いいね
	// 汎用
	'e5d2' =>  array( 'type' => 'google', 'label' => 'Menu' ), // メニュー
	'e5ca' =>  array( 'type' => 'google', 'label' => 'Check' ), // チェック
	'e838' =>  array( 'type' => 'google', 'label' => 'Star' ), // スター
	'e87d' =>  array( 'type' => 'google', 'label' => 'Favorite' ), // ハート
	'eafb' =>  array( 'type' => 'google', 'label' => 'Currency Yen' ), // 円
	'e894' =>  array( 'type' => 'google', 'label' => 'Language' ), // 言語
	'e7fd' =>  array( 'type' => 'google', 'label' => 'Person' ), // ユーザー
	'ebcc' =>  array( 'type' => 'google', 'label' => 'Calendar Month' ), // カレンダー
	'e8b5' =>  array( 'type' => 'google', 'label' => 'Schedule' ), // スケジュール
	'e0f0' =>  array( 'type' => 'google', 'label' => 'Lightbulb' ), // ヒント
	'e158' =>  array( 'type' => 'google', 'label' => 'Mail' ), // メール
	'e7f4' =>  array( 'type' => 'google', 'label' => 'Notifications' ), // おしらせ
	'e0b0' =>  array( 'type' => 'google', 'label' => 'Call' ), // 電話
	'e0b7' =>  array( 'type' => 'google', 'label' => 'Chat' ), // チャット
	'e3c9' =>  array( 'type' => 'google', 'label' => 'Edit' ), // 執筆
	'e413' =>  array( 'type' => 'google', 'label' => 'Photo Library' ), // ギャラリー
	'e873' =>  array( 'type' => 'google', 'label' => 'Description' ), // ノート
	'f0e2' =>  array( 'type' => 'google', 'label' => 'Support Agent' ), // ヘッドフォン
	'e869' =>  array( 'type' => 'google', 'label' => 'Build' ), // 修理
	'e80b' =>  array( 'type' => 'google', 'label' => 'Public' ), // 地球
	// 食事
	'e88a' =>  array( 'type' => 'google', 'label' => 'Home' ), // Home
	'e56c' =>  array( 'type' => 'google', 'label' => 'Restaurant' ), // レストラン
	'ea61' =>  array( 'type' => 'google', 'label' => 'Lunch Dining' ), // ランチ
	'ea64' =>  array( 'type' => 'google', 'label' => 'Ramen Dining' ), // 麺類
	'e541' =>  array( 'type' => 'google', 'label' => 'Local Cafe' ), // カフェ
	'e91d' =>  array( 'type' => 'google', 'label' => 'Pets' ), // ペット	
  // アクセス
	'e55b' =>  array( 'type' => 'google', 'label' => 'Map' ), // マップ
	'e0c8' =>  array( 'type' => 'google', 'label' => 'Location On' ), // マップアイコン
	'e539' =>  array( 'type' => 'google', 'label' => 'Flight' ), // 飛行機
	'e532' =>  array( 'type' => 'google', 'label' => 'Directions Boat' ), // 船
	'e570' =>  array( 'type' => 'google', 'label' => 'Train' ), // 電車
	'e531' =>  array( 'type' => 'google', 'label' => 'Directions Car' ), // 車
	'eb29' =>  array( 'type' => 'google', 'label' => 'Pedal Bike' ), // 自転車
	'e536' =>  array( 'type' => 'google', 'label' => 'Directions Walk' ), // 徒歩
	// SNS
	'ea92' =>  array( 'type' => 'sns', 'label' => 'Instagram' ), // Instagram
	'e94d' =>  array( 'type' => 'sns', 'label' => 'TikTok' ), // TikTok
	'e950' =>  array( 'type' => 'sns', 'label' => 'Twitter' ), // Twitter
	'e944' =>  array( 'type' => 'sns', 'label' => 'Facebook' ), // Facebook
	'ea9d' =>  array( 'type' => 'sns', 'label' => 'YouTube' ), // YouTube
	'e909' =>  array( 'type' => 'sns', 'label' => 'Line' ), // Line
);


// 新規追加 -------------------------------------------------------------------------------------------


// カラープリセット
define( 'TCD_COLOR_PRESET', array(
	__('Blue', 'tcd-issue') => array(
		'main' => '#0A578C',
		'bg' => '#fafafa'
	),
	__('Red', 'tcd-issue') => array(
		'main' => '#85121E',
		'bg' => '#fafafa'
	),
	__('Dark blue', 'tcd-issue') => array(
		'main' => '#112B62',
		'bg' => '#fafafa'
	),
	__('Green', 'tcd-issue') => array(
		'main' => '#094746',
		'bg' => '#fafafa'
	),
	__('Black', 'tcd-issue') => array(
		'main' => '#000000',
		'bg' => '#fafafa'
	),
) );


// ツイッターのサムネイルサイズ
$twitter_image_options = array(
	'summary' => array('value' => 'summary','label' => __( 'Normal', 'tcd-issue' )),
	'summary_large_image' => array('value' => 'summary_large_image','label' => __( 'Largish', 'tcd-issue' ))
);


// スタッフのタイプ
global $staff_type_options;
$staff_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'TypeA', 'tcd-issue' ),
    'image' => get_template_directory_uri() . '/admin/img/image/staff_type1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'TypeB', 'tcd-issue' ),
    'image' => get_template_directory_uri() . '/admin/img/image/staff_type2.jpg'
  ),
);


// インタビュアーのカテゴリータイプ
global $interview_category_type_options;
$interview_category_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'TypeA', 'tcd-issue' ),
    'image' => get_template_directory_uri() . '/admin/img/image/interview_category_type1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'TypeB', 'tcd-issue' ),
    'image' => get_template_directory_uri() . '/admin/img/image/interview_category_type2.jpg'
  ),
);


// リスト用　カラープリセット
define( 'TCD_COLOR_PRESET_FOR_LIST', array(
	'color1' => array(
		'main' => '#0A578C',
	),
	'color2' => array(
		'main' => '#85121E',
	),
	'color3' => array(
		'main' => '#112B62',
	),
	'color4' => array(
		'main' => '#094746',
	),
	'color5' => array(
		'main' => '#000000',
	)
) );


// ヘッダータイプ
global $header_type_options;
$header_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Drawer menu', 'tcd-issue' ),
    'image' => get_template_directory_uri() . '/admin/img/image/header_type1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Dropdown menu', 'tcd-issue' ),
    'image' => get_template_directory_uri() . '/admin/img/image/header_type2.jpg?2.0'
  )
);


?>