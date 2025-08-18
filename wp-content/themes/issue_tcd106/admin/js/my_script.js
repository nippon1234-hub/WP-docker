jQuery(document).ready(function($){

  // フッターバーのGoogleマテリアルアイコン
  if ($('#use_google_material_icon').is(":checked")) {
    $('.use_google_material_icon_message').hide();
  } else {
    $('.use_google_material_icon_message').show();
  }
  $(document).on('click', '#use_google_material_icon', function(event){
    if ($(this).is(":checked")) {
      $('.use_google_material_icon_message').hide();
    } else {
      $('.use_google_material_icon_message').show();
    }
  });

    //ローディングロゴタイプの選択肢
   function toggleLogoType() {
    var val = $('input[name="dp_options[loading_logo_type]"]:checked').val();

    if (val === 'text') {
      $('.loding_logo_text').show();
      $('.loading_logo_image').hide();
    } else if (val === 'image') {
      $('.loding_logo_text').hide();
      $('.loading_logo_image').show();
    } else {
      // fallback: 両方非表示など
      $('.loding_logo_text').hide();
      $('.loading_logo_image').hide();
    }
  }

  // ページロード時に初期状態を反映
  toggleLogoType();

  // ラジオボタン変更時に切り替え
  $('input[name="dp_options[loading_logo_type]"]').on('change', toggleLogoType);


  // 関連記事
  $('select.post_list_type').each(function(){
    if ( $(this).val() == 'all_post' || $(this).val() == 'recommend_post' || $(this).val() == 'recommend_post2' || $(this).val() == 'recommend_post3') {
      $(this).closest('.option_list').find('.post_list_type_normal_option').show();
      $(this).closest('.option_list').find('.post_list_type_custom_option').hide();
      $(this).closest('.option_list').find('.post_list_type_category_option').hide();
    } else if ( $(this).val() == 'custom' ) {
      $(this).closest('.option_list').find('.post_list_type_normal_option').hide();
      $(this).closest('.option_list').find('.post_list_type_custom_option').show();
      $(this).closest('.option_list').find('.post_list_type_category_option').hide();
    } else if ( $(this).val() == 'category_post' ) {
      $(this).closest('.option_list').find('.post_list_type_normal_option').show();
      $(this).closest('.option_list').find('.post_list_type_custom_option').hide();
      $(this).closest('.option_list').find('.post_list_type_category_option').show();
    }
  });
  $(document).on('change', 'select.post_list_type', function(){
    if ( $(this).val() == 'all_post' || $(this).val() == 'recommend_post' || $(this).val() == 'recommend_post2' || $(this).val() == 'recommend_post3') {
      $(this).closest('.option_list').find('.post_list_type_normal_option').show();
      $(this).closest('.option_list').find('.post_list_type_custom_option').hide();
      $(this).closest('.option_list').find('.post_list_type_category_option').hide();
    } else if ( $(this).val() == 'custom' ) {
      $(this).closest('.option_list').find('.post_list_type_normal_option').hide();
      $(this).closest('.option_list').find('.post_list_type_custom_option').show();
      $(this).closest('.option_list').find('.post_list_type_category_option').hide();
    } else if ( $(this).val() == 'category_post' ) {
      $(this).closest('.option_list').find('.post_list_type_normal_option').show();
      $(this).closest('.option_list').find('.post_list_type_custom_option').hide();
      $(this).closest('.option_list').find('.post_list_type_category_option').show();
    }
  }).trigger('change');


  // ヘッダーのタイプ
  $(document).on('click', '#header_menu_type1', function(event){
    if ($(this).prop("checked")) {
      $('.header_menu_type2_option').hide();
    }
  });
  $(document).on('click', '#header_menu_type2', function(event){
    if ($(this).prop("checked")) {
      $('.header_menu_type2_option').show();
    }
  });
  if ($('#header_menu_type1').prop("checked")) {
    $('.header_menu_type2_option').hide();
  }
  if ($('#header_menu_type2').prop("checked")) {
    $('.header_menu_type2_option').show();
  }


  // CB スクロールコンテンツ（コンテンツタイプ）
  $(document).on('click', '.sc_content_type1', function(event){
    if ($(this).prop("checked")) {
      $(this).closest('.option_list').find('.sc_content_type1_option').show();
      $(this).closest('.option_list').find('.sc_content_type2_option').hide();
    }
  });
  $(document).on('click', '.sc_content_type2', function(event){
    if ($(this).prop("checked")) {
      $(this).closest('.option_list').find('.sc_content_type1_option').hide();
      $(this).closest('.option_list').find('.sc_content_type2_option').show();
    }
  });
  $('.sc_content_type1').each(function(){
    if( $(this).prop("checked") ) {
      $(this).closest('.option_list').find('.sc_content_type1_option').show();
      $(this).closest('.option_list').find('.sc_content_type2_option').hide();
    }
  });
  $('.sc_content_type2').each(function(){
    if( $(this).prop("checked") ) {
      $(this).closest('.option_list').find('.sc_content_type1_option').hide();
      $(this).closest('.option_list').find('.sc_content_type2_option').show();
    }
  });


  // CB スクロールコンテンツ（背景タイプ）
  $(document).on('click', '.sc_bg_type1', function(event){
    if ($(this).prop("checked")) {
      $(this).closest('.option_list').find('.sc_bg_type1_option').show();
      $(this).closest('.option_list').find('.sc_bg_type2_option').hide();
    }
  });
  $(document).on('click', '.sc_bg_type2', function(event){
    if ($(this).prop("checked")) {
      $(this).closest('.option_list').find('.sc_bg_type1_option').hide();
      $(this).closest('.option_list').find('.sc_bg_type2_option').show();
    }
  });
  $('.sc_bg_type1').each(function(){
    if( $(this).prop("checked") ) {
      $(this).closest('.option_list').find('.sc_bg_type1_option').show();
      $(this).closest('.option_list').find('.sc_bg_type2_option').hide();
    }
  });
  $('.sc_bg_type2').each(function(){
    if( $(this).prop("checked") ) {
      $(this).closest('.option_list').find('.sc_bg_type1_option').hide();
      $(this).closest('.option_list').find('.sc_bg_type2_option').show();
    }
  });


  // CBバナーのタイプ
  $(document).on('click', '.cb_banner_bg_type1', function(event){
    if ($(this).prop("checked")) {
      $(this).closest('.option_list').find('.cb_banner_image_option').show();
      $(this).closest('.option_list').find('.cb_banner_video_option').hide();
    }
  });
  $(document).on('click', '.cb_banner_bg_type2', function(event){
    if ($(this).prop("checked")) {
      $(this).closest('.option_list').find('.cb_banner_image_option').hide();
      $(this).closest('.option_list').find('.cb_banner_video_option').show();
    }
  });
  $('.cb_banner_bg_type1').each(function(){
    if( $(this).prop("checked") ) {
      $(this).closest('.option_list').find('.cb_banner_image_option').show();
      $(this).closest('.option_list').find('.cb_banner_video_option').hide();
    }
  });
  $('.cb_banner_bg_type2').each(function(){
    if( $(this).prop("checked") ) {
      $(this).closest('.option_list').find('.cb_banner_image_option').hide();
      $(this).closest('.option_list').find('.cb_banner_video_option').show();
    }
  });


  // スタッフのデザインタイプ
  $(document).on('click', '#staff_design_type1', function(event){
    if ($(this).prop("checked")) {
      $('.staff_design_type1_option').show();
      $('.staff_design_type2_option').hide();
    }
  });
  $(document).on('click', '#staff_design_type2', function(event){
    if ($(this).prop("checked")) {
      $('.staff_design_type1_option').hide();
      $('.staff_design_type2_option').show();
    }
  });
  if ($('#staff_design_type1').prop("checked")) {
    $('.staff_design_type1_option').show();
    $('.staff_design_type2_option').hide();
  }
  if ($('#staff_design_type2').prop("checked")) {
    $('.staff_design_type1_option').hide();
    $('.staff_design_type2_option').show();
  }


  // カスタムナビゲーションのキャッチフレーズの表示　（判定用のチェックボックスは「メニューの位置」を利用）
  if ($('#locations-global-menu').is(":checked")) {
    $('#menu-to-edit').addClass('global_active_menu');
  } else {
    $('#menu-to-edit').removeClass('global_active_menu');
  }
  $(document).on('click', '#locations-global-menu', function(event){
    if ($(this).is(":checked")) {
      $('#menu-to-edit').addClass('global_active_menu');
    } else {
      $('#menu-to-edit').removeClass('global_active_menu');
    }
  });


  // 利用しないカスタム投稿のテーマオプション入力欄を非表示にする
  $(document).on('click', '.custon_post_usage_option_checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).closest('.tab-content').find('.theme_option_field').not('.custon_post_usage_option').show();
    } else {
      $(this).closest('.tab-content').find('.theme_option_field').not('.custon_post_usage_option').hide();
    }
  });
  $('.custon_post_usage_option_checkbox').each(function(){
    if ($(this).is(":checked")) {
      $(this).closest('.tab-content').find('.theme_option_field').not('.custon_post_usage_option').show();
    } else {
      $(this).closest('.tab-content').find('.theme_option_field').not('.custon_post_usage_option').hide();
    }
  });


  // トップページ　ノーマル固定ページコンテンツの横幅
  $(document).on('click', '#page_content_width_type1', function(event){
    $('.page_content_width_type1_option').show();
  });
  $(document).on('click', '#page_content_width_type2', function(event){
    $('.page_content_width_type1_option').hide();
  });


  // トップページ　スライダーのタイプ
  $(document).on('click', '.index_header_content_type1', function(event){
    $('.index_header_content_type1_option').show();
    $('.index_header_content_type2_option').hide();
    $('.index_header_content_type3_option').hide();
    $('.index_header_content_video_option').hide();
  });
  $(document).on('click', '.index_header_content_type2', function(event){
    $('.index_header_content_type1_option').hide();
    $('.index_header_content_type2_option').show();
    $('.index_header_content_type3_option').hide();
    $('.index_header_content_video_option').show();
  });
  $(document).on('click', '.index_header_content_type3', function(event){
    $('.index_header_content_type1_option').hide();
    $('.index_header_content_type2_option').hide();
    $('.index_header_content_type3_option').show();
    $('.index_header_content_video_option').show();
  });
  if ($('.index_header_content_type1 input').is(":checked")) {
    $('.index_header_content_type1_option').show();
    $('.index_header_content_type2_option').hide();
    $('.index_header_content_type3_option').hide();
    $('.index_header_content_video_option').hide();
  }
  if ($('.index_header_content_type2 input').is(":checked")) {
    $('.index_header_content_type1_option').hide();
    $('.index_header_content_type2_option').show();
    $('.index_header_content_type3_option').hide();
    $('.index_header_content_video_option').show();
  }
  if ($('.index_header_content_type3 input').is(":checked")) {
    $('.index_header_content_type1_option').hide();
    $('.index_header_content_type2_option').hide();
    $('.index_header_content_type3_option').show();
    $('.index_header_content_video_option').show();
  }


  // lightcase (lightbox)
  $('a[data-rel^=lightcase]').lightcase();


  // フッターバーのマテリアルアイコン
  $(document).on('change', '.footer_bar_icon_type input', function(event){
    var radioval = $(this).val();
    if (radioval == 'material_icon') {
      $(this).closest('.footer_bar_icon_option').find('.material_icon_option').show();
    } else {
      $(this).closest('.footer_bar_icon_option').find('.material_icon_option').hide();
    }
  });
  $('.material_icon input').each(function(){
    if ($(this).prop("checked")) {
      $(this).closest('.footer_bar_icon_option').find('.material_icon_option').show();
    } else {
      $(this).closest('.footer_bar_icon_option').find('.material_icon_option').hide();
    }
  });


  // ロード画面の選択
  $(document).on('click', '#loading_type1, #loading_type2, #loading_type3', function(event){
    if ($(this).prop("checked")) {
      $('#loading_logo_catch_area').removeClass('type4');
      $('#loading_logo_catch_area').removeClass('type5');
      $('.loading_screen_icon_option').show();
      $('.loading_screen_logo_option').hide();
      $('.loading_type5_option').hide();
      $('.loading_non_type5_option').show();
    };
  });
  $(document).on('click', '#loading_type4', function(event){
    if ($(this).prop("checked")) {
      $('#loading_logo_catch_area').addClass('type4');
      $('#loading_logo_catch_area').removeClass('type5');
      $('.loading_screen_icon_option').hide();
      $('.loading_screen_logo_option').show();
      $('.loading_type5_option').hide();
      $('.loading_non_type5_option').show();
    };
  });
  $(document).on('click', '#loading_type5', function(event){
    if ($(this).prop("checked")) {
      $('#loading_logo_catch_area').removeClass('type4');
      $('#loading_logo_catch_area').addClass('type5');
      $('.loading_screen_icon_option').hide();
      $('.loading_screen_logo_option').show();
      $('.loading_type5_option').show();
      $('.loading_non_type5_option').hide();
    };
  });
  if ($('#loading_type1').prop("checked")) {
    $('#loading_logo_catch_area').removeClass('type4');
    $('#loading_logo_catch_area').removeClass('type5');
    $('.loading_screen_icon_option').show();
    $('.loading_screen_logo_option').hide();
    $('.loading_type5_option').hide();
    $('.loading_non_type5_option').show();
  }
  if ($('#loading_type2').prop("checked")) {
    $('#loading_logo_catch_area').removeClass('type4');
    $('#loading_logo_catch_area').removeClass('type5');
    $('.loading_screen_icon_option').show();
    $('.loading_screen_logo_option').hide();
    $('.loading_type5_option').hide();
    $('.loading_non_type5_option').show();
  }
  if ($('#loading_type3').prop("checked")) {
    $('#loading_logo_catch_area').removeClass('type4');
    $('#loading_logo_catch_area').removeClass('type5');
    $('.loading_screen_icon_option').show();
    $('.loading_screen_logo_option').hide();
    $('.loading_type5_option').hide();
    $('.loading_non_type5_option').show();
  }
  if ($('#loading_type4').prop("checked")) {
    $('#loading_logo_catch_area').addClass('type4');
    $('#loading_logo_catch_area').removeClass('type5');
    $('.loading_screen_icon_option').hide();
    $('.loading_screen_logo_option').show();
    $('.loading_type5_option').hide();
    $('.loading_non_type5_option').show();
  }
  if ($('#loading_type5').prop("checked")) {
    $('#loading_logo_catch_area').removeClass('type4');
    $('#loading_logo_catch_area').addClass('type5');
    $('.loading_screen_icon_option').hide();
    $('.loading_screen_logo_option').show();
    $('.loading_type5_option').show();
    $('.loading_non_type5_option').hide();
  }


  // inputに入力できる文字数を制限　以下のような使い方
  // input type="number" data-limit-num="4"　（4文字以上は入力できない）
  $(".limit_input_number").on('keyup', function(){
    var limit_num = $(this).data('limit-num');
    var txt = $(this).val();
    if( limit_num < txt.length ){
      $(this).val(txt.substr(0,limit_num));
    }
  });


  // サブボックス内のタブ
  $(document).on('click', '.sub_box_tab .tab', function(event){
    var tab_name = $(this).attr('data-tab');
    $(this).addClass('active');
    $(this).siblings().removeClass('active');
    $(this).closest('.tab_parent').find('.sub_box_tab_content').each( function() {
      $(this).removeClass('active');
    });
    $(this).closest('.tab_parent').find('[data-tab-content="'+tab_name+'"]').each( function() {
      $(this).addClass('active');
    });
//    $(this).closest('.tab_parent').find('[data-tab-content="'+tab_name+'"]').addClass('active').siblings().removeClass('active');
  });
  $(document).on('change keyup', '.sub_box_tab_content .tab_label', function(){
    var tab_content_name = $(this).closest('.sub_box_tab_content').attr('data-tab-content');
    $(this).closest('.tab_parent').find('[data-tab="'+tab_content_name+'"] .label').text($(this).val());
  });
  $('.sub_box_tab_content .tab_label').each(function(){
    if( $(this).val() != 0 ){
      var tab_content_name = $(this).closest('.sub_box_tab_content').attr('data-tab-content');
      $(this).closest('.tab_parent').find('[data-tab="'+tab_content_name+'"] .label').text($(this).val());
    }
  });


  // 文字数をカウントして超えた場合はメッセージを表示
  $(document).on('keyup', 'textarea.check_characters', function(){
    var maxlen = $(this).attr('maxlength');
    var length = $(this).val().length;
    if(length > (maxlen - 3) ){
      $(this).next().show();
    } else {
      $(this).next().hide();
    }
  });


  // デザインラジオボタン２
  $(document).on('click', '.design_radio_button2 li', function(event){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
  });


  // クイックタグのボタン
  $(document).on('click', '.qtag_button_hover_option .button_hover_type1', function(event){
    $(this).closest('.button_option').find('.hide_bg_color').show();
    $(this).closest('.button_option').find('.hide_for_button_type4').show();
    $(this).closest('.button_option').find('.show_for_button_type4').hide();
  });
  $(document).on('click', '.qtag_button_hover_option .button_hover_type2, .qtag_button_hover_option .button_hover_type3', function(event){
    $(this).closest('.button_option').find('.hide_bg_color').hide();
    $(this).closest('.button_option').find('.hide_for_button_type4').show();
    $(this).closest('.button_option').find('.show_for_button_type4').hide();
  });
  $(document).on('click', '.qtag_button_hover_option .button_hover_type4', function(event){
    $(this).closest('.button_option').find('.hide_bg_color').hide();
    $(this).closest('.button_option').find('.hide_for_button_type4').hide();
    $(this).closest('.button_option').find('.show_for_button_type4').show();
  });
  $('.qtag_button_hover_option .button_hover_type1').each(function(){
    if( $(this).hasClass('active') ){
      $(this).closest('.button_option').find('.hide_bg_color').show();
      $(this).closest('.button_option').find('.hide_for_button_type4').show();
      $(this).closest('.button_option').find('.show_for_button_type4').hide();
    }
  });
  $('.qtag_button_hover_option .button_hover_type2, .qtag_button_hover_option .button_hover_type3').each(function(){
    if( $(this).hasClass('active') ){
      $(this).closest('.button_option').find('.hide_bg_color').hide();
      $(this).closest('.button_option').find('.hide_for_button_type4').show();
      $(this).closest('.button_option').find('.show_for_button_type4').hide();
    }
  });
  $('.qtag_button_hover_option .button_hover_type4').each(function(){
    if( $(this).hasClass('active') ){
      $(this).closest('.button_option').find('.hide_bg_color').hide();
      $(this).closest('.button_option').find('.hide_for_button_type4').hide();
      $(this).closest('.button_option').find('.show_for_button_type4').show();
    }
  });


  // カラーピッカー
  var color_picker_change_timer = null
	$('.c-color-picker').wpColorPicker({
		change: function(event){
			clearTimeout(color_picker_change_timer);
			color_picker_change_timer = setTimeout(function(){
				$(event.target).trigger('change')
			}, 100);
		},
		palettes: ['#000000','#FFFFFF','#dd3333','#dd9933','#eeee22','#81d742','#1e73be',TCD_MESSAGES.mainColor ]
	});
	// カラープリセット
	$(document).on('click', '.js-color-preset-item', function(){
		var mainColor = $(this).data('color');
		var bgColor = $(this).data('bg-color');
		$(this).siblings().removeClass('is-active');
		$(this).addClass('is-active');
		$('.js-color-preset-target--main').wpColorPicker('color', mainColor);
		$('.js-color-preset-target--main').wpColorPicker('defaultColor', mainColor);
		$('.js-color-preset-target--bg').wpColorPicker('color', bgColor);
		$('.js-color-preset-target--bg').wpColorPicker('defaultColor', bgColor);
		$('.js-color-preset-target--link').wpColorPicker('color', bgColor);
		$('.js-color-preset-target--link').wpColorPicker('defaultColor', bgColor);
		return false;
	});
  // 「色を選択」を変更
  $('.font_color_picker .wp-color-result-text').each(function(){
    $(this).text(TCD_MESSAGES.font_color_picker);
  });
  $('.bg_color_picker .wp-color-result-text').each(function(){
    $(this).text(TCD_MESSAGES.bg_color_picker);
  });
  $('.font_color_picker_hover .wp-color-result-text').each(function(){
    $(this).text(TCD_MESSAGES.font_color_picker_hover);
  });
  $('.bg_color_picker_hover .wp-color-result-text').each(function(){
    $(this).text(TCD_MESSAGES.bg_color_picker_hover);
  });


  // チェックボックスによって入力欄を表示/非表示にする
  // <input class="display_option" data-option-name="show_new_icon" type="checkbox" />
  // <div class="show_new_icon">
  $(document).on('click', '.display_option', function(event){
    var option_name = $(this).attr('data-option-name');
    if ($(this).is(":checked")) {
      $('.' + option_name).show();
    } else {
      $('.' + option_name).hide();
    }
  });
  $('.display_option').each(function(){
    var option_name = $(this).attr('data-option-name');
    if ($(this).is(":checked")) {
      $('.' + option_name).show();
    } else {
      $('.' + option_name).hide();
    }
  });
  // 逆ver
  $(document).on('click', '.display_option2', function(event){
    var option_name = $(this).attr('data-option2-name');
    if ($(this).is(":checked")) {
      $('.' + option_name).hide();
    } else {
      $('.' + option_name).show();
    }
  });
  $('.display_option2').each(function(){
    var option_name = $(this).attr('data-option2-name');
    if ($(this).is(":checked")) {
      $('.' + option_name).hide();
    } else {
      $('.' + option_name).show();
    }
  });


  // トップページ　コンテンツビルダー/通常の固定ページの選択
  $(document).on('click', '.index_content_type1_button', function(event){
    $('.index_content_type1_option').show();
    $('.index_content_type2_option').hide();
  });
  $(document).on('click', '.index_content_type2_button', function(event){
    $('.index_content_type1_option').hide();
    $('.index_content_type2_option').show();
  });
  $(document).on('click', '.mobile_index_content_type1_button', function(event){
    $('.mobile_index_content_type1_option').show();
    $('.mobile_index_content_type2_option').hide();
  });
  $(document).on('click', '.mobile_index_content_type2_button', function(event){
    $('.mobile_index_content_type1_option').hide();
    $('.mobile_index_content_type2_option').show();
  });


  // ヘッダースライダー　アイテムのタイプ
  $(document).on('click', '.index_slider_item_type1', function(event){
    $(this).closest('.sub_box_content').find('.index_slider_image_area').show();
    $(this).closest('.sub_box_content').find('.index_slider_video_area').hide();
    $(this).closest('.sub_box_content').find('.index_slider_youtube_area').hide();
    $(this).closest('.sub_box_content').find('.index_slider_video_image').hide();
  });
  $(document).on('click', '.index_slider_item_type2', function(event){
    $(this).closest('.sub_box_content').find('.index_slider_image_area').hide();
    $(this).closest('.sub_box_content').find('.index_slider_video_area').show();
    $(this).closest('.sub_box_content').find('.index_slider_youtube_area').hide();
    $(this).closest('.sub_box_content').find('.index_slider_video_image').show();
  });
  $(document).on('click', '.index_slider_item_type3', function(event){
    $(this).closest('.sub_box_content').find('.index_slider_image_area').hide();
    $(this).closest('.sub_box_content').find('.index_slider_video_area').hide();
    $(this).closest('.sub_box_content').find('.index_slider_youtube_area').show();
    $(this).closest('.sub_box_content').find('.index_slider_video_image').show();
  });


  // 固定ページのヘッダー入力欄を隠す
  $(document).on('click', '#hide_page_header_no', function(event){
    if ($(this).prop("checked")) {
      $('#page_header_setting_area').show();
    }
  });
  $(document).on('click', '#hide_page_header_yes', function(event){
    if ($(this).prop("checked")) {
      $('#page_header_setting_area').hide();
    }
  });


  // 固定ページのスクロール入力欄を隠す
  $(document).on('click', '#hide_sidebar_left', function(event){
    if ($(this).prop("checked")) {
      $('#page_scroll_content_option').hide();
    }
  });
  $(document).on('click', '#hide_sidebar_right', function(event){
    if ($(this).prop("checked")) {
      $('#page_scroll_content_option').hide();
    }
  });
  $(document).on('click', '#hide_sidebar_hide', function(event){
    if ($(this).prop("checked")) {
      $('#page_scroll_content_option').show();
    }
  });


  // 固定ページテンプレートで表示メタボックス切替
  function show_lp_meta_box() {
    $('.hide_border_option').removeClass('hide_border');
    $('.normal_template_option').hide();
    $('.lp_template_option').show();
    $('.sidebar_option').show();
    $('#basic_page_setting').show();
    $('#tab_page_setting').hide();
    $('#page_scroll_content_option').show();
  }
  function normal_template() {
    $('.hide_border_option').addClass('hide_border');
    $('.normal_template_option').show();
    $('.lp_template_option').hide();
    $('#basic_page_setting').show();
    $('#tab_page_setting').hide();
    if ($('#hide_sidebar_left').prop("checked")) {
      $('#page_scroll_content_option').hide();
    }
    if ($('#hide_sidebar_right').prop("checked")) {
      $('#page_scroll_content_option').hide();
    }
    if ($('#hide_sidebar_hide').prop("checked")) {
      $('#page_scroll_content_option').show();
    }
  }
  function tab_page_template() {
    $('.hide_border_option').removeClass('hide_border');
    $('.normal_template_option').show();
    $('.lp_template_option').hide();
    $('#basic_page_setting').hide();
    $('#tab_page_setting').show();
    $('#page_scroll_content_option').show();
  }
  $('select#hidden_page_template').each(function(){
    if ( $(this).val() == 'page-tcd-lp.php' ) {
      show_lp_meta_box();
      $('#page_header_setting_area').show();
      if ($('#hide_page_header_no').prop("checked")) {
        $('#page_header_setting_area').show();
      }
      if ($('#hide_page_header_yes').prop("checked")) {
        $('#page_header_setting_area').hide();
      }
    } else if ( $(this).val() == 'page-tcd-tab.php' ) {
      tab_page_template();
      // 親ページが選択されている場合
      if($('#parent_id').val() === null || $('#parent_id').val() === ''){
        $('#page_header_setting_area').show();
      } else {
        $('#page_header_setting_area').hide();
      }
    } else {
      normal_template();
      $('#page_header_setting_area').show();
      if ($('#hide_sidebar_left').prop("checked")) {
        $('#page_scroll_content_option').hide();
      }
      if ($('#hide_sidebar_right').prop("checked")) {
        $('#page_scroll_content_option').hide();
      }
      if ($('#hide_sidebar_hide').prop("checked")) {
        $('#page_scroll_content_option').show();
      }
    }
  });
  $(document).on('change', 'select#page_template, .editor-page-attributes__template select', function(){
    if ( $(this).val() == 'page-tcd-lp.php' ) {
      show_lp_meta_box();
      $('#page_header_setting_area').show();
      if ($('#hide_page_header_no').prop("checked")) {
        $('#page_header_setting_area').show();
      }
      if ($('#hide_page_header_yes').prop("checked")) {
        $('#page_header_setting_area').hide();
      }
    } else if ( $(this).val() == 'page-tcd-tab.php' ) {
      tab_page_template();
      // 親ページが選択されている場合
      if($('select#parent_id').val() === null || $('select#parent_id').val() === ''){
        $('#page_header_setting_area').show();
      } else {
        $('#page_header_setting_area').hide();
      }
    } else {
      normal_template();
      $('#page_header_setting_area').show();
      if ($('#hide_sidebar_left').prop("checked")) {
        $('#page_scroll_content_option').hide();
      }
      if ($('#hide_sidebar_right').prop("checked")) {
        $('#page_scroll_content_option').hide();
      }
      if ($('#hide_sidebar_hide').prop("checked")) {
        $('#page_scroll_content_option').show();
      }
    }
  }).trigger('change');


  // 親ページが選択されている場合
  $(document).on('change', 'select#parent_id', function(){
    var selectedValue = $(this).val();
    if(selectedValue === '') {
      $('#page_header_setting_area').show();
    } else {
      if($('select#page_template').val() === 'page-tcd-tab.php'){
        $('#page_header_setting_area').hide();
      } else {
        $('#page_header_setting_area').show();
      }
    }
  }).trigger('change');


  // 上記コードのブロックエディタ用
  if(wp.data !== undefined ){
    const { select, subscribe } = wp.data;
    class ParentPageSwitcher {
      constructor() {
        this.parent = null;
      }
      init() {
        subscribe(() => {
          const newParent = select('core/editor').getEditedPostAttribute('parent');
          if (newParent !== undefined && this.parent === null) {
            this.parent = newParent;
            this.changeParent();
          }
          if (newParent !== undefined && newParent !== this.parent) {
            this.parent = newParent;
            this.changeParent();
          }
        });
      }
      changeParent() {
        if (this.parent !== undefined) {
          // ここで何かを行う
          //console.log(this.parent);
          if(this.parent === null){
            $('#page_header_setting_area').show();
            $('select#hidden_parent_page').val('');
          } else {
            $('select#hidden_parent_page').val(this.parent);
            if($('select#hidden_page_template').val() === 'page-tcd-tab.php'){
              $('#page_header_setting_area').hide();
            } else {
              $('#page_header_setting_area').show();
            }
          }
        }
      }
    }
    new ParentPageSwitcher().init();
  }


  // ブロックエディタ用　テンプレート選択時
  if(wp.data !== undefined ){
    const { select, subscribe } = wp.data;
    class PageTemplateSwitcher {
      constructor() {
        this.template = null;
      }
      init() {
        subscribe( () => {
          const newTemplate = select( 'core/editor' ).getEditedPostAttribute( 'template' );
          if (newTemplate !== undefined && this.template === null) {
            this.template = newTemplate;
          }
          if ( newTemplate !== undefined && newTemplate !== this.template ) {
            this.template = newTemplate;
            this.changeTemplate();
          }
        });
      }
      changeTemplate() {
        if ( this.template == 'page-tcd-lp.php' ) {
          show_lp_meta_box();
          $('select#hidden_page_template').val('page-tcd-lp.php');
          $('#page_header_setting_area').show();
          if ($('#hide_page_header_no').prop("checked")) {
            $('#page_header_setting_area').show();
          }
          if ($('#hide_page_header_yes').prop("checked")) {
            $('#page_header_setting_area').hide();
          }
        } else if ( this.template == 'page-tcd-tab.php' ) {
          tab_page_template();
          $('select#hidden_page_template').val('page-tcd-tab.php');
          // 親ページが選択されている場合
          if($('select#hidden_parent_page').val() === null || $('select#hidden_parent_page').val() === ''){
            $('#page_header_setting_area').show();
          } else {
            $('#page_header_setting_area').hide();
          }
        } else {
          normal_template();
          $('select#hidden_page_template').val('');
          $('#page_header_setting_area').show();
          if ($('#hide_sidebar_left').prop("checked")) {
            $('#page_scroll_content_option').hide();
          }
          if ($('#hide_sidebar_right').prop("checked")) {
            $('#page_scroll_content_option').hide();
          }
          if ($('#hide_sidebar_hide').prop("checked")) {
            $('#page_scroll_content_option').show();
          }
        }
      }
    }
    new PageTemplateSwitcher().init();
  }


  // 固定ページのカスタムフィールドの並び替え
  $(".theme_option_field_order").sortable({
    placeholder: "theme_option_field_order_placeholder",
    handle: '.theme_option_headline',
    //helper: "clone",
    start: function(e, ui){
      ui.item.find('textarea').each(function () {
        if (window.tinymce) {
          tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
        }
      });
    },
    stop: function (e, ui) {
      ui.item.toggleClass("active");
      ui.item.find('textarea').each(function () {
        if (window.tinymce) {
          const editorId = $(this).attr('id');
          if (!tinymce.get(editorId)) {
            tinymce.execCommand('mceAddEditor', true, editorId);
    
            // テキストモードの場合は、再度テキストボタンをクリック
            setTimeout(() => {
              $(this).closest('.html-active').find('.wp-switch-editor.switch-html').trigger('click');
            }, 100);
          }
        }
     });
    },
    forceHelperSize: true,
    forcePlaceholderSize: true
  });


  //テキストエリアの文字数をカウント
  $('.word_count').each( function(i){
    var count = $(this).val().length;
    $(this).next('.word_count_result').children().text(count);
  });
  $('.word_count').keyup(function(){
    var count = $(this).val().length;
    $(this).next('.word_count_result').children().text(count);
  });


  // チェックボックスにチェックをして、ボックスを表示・非表示する（オーバーレイなどに使用）
  $(document).on('click', '.displayment_checkbox input:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).parents('.displayment_checkbox').next().show();
    } else {
      $(this).parents('.displayment_checkbox').next().hide();
    }
  });
  $(document).on('click', '.displayment_checkbox2 input:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).parents('.displayment_checkbox2').next().hide();
    } else {
      $(this).parents('.displayment_checkbox2').next().show();
    }
  });
  // チェックボックスにチェックをして、ボックスを表示・非表示する（オーバーレイなどに使用）・・・カスタムフィールド用
  $(document).on('click', '.displayment_checkbox_cf input:checkbox', function(event){
    if ($(this).is(":checked")) {
      $(this).parents('.displayment_checkbox_cf').parent().next().show();
    } else {
      $(this).parents('.displayment_checkbox_cf').parent().next().hide();
    }
  });


  // Googleマップ
  $(document).on('click', '.gmap_marker_type_button_type1', function(event){
    $(this).parent().next().hide();
  });
  $(document).on('click', '.gmap_marker_type_button_type2', function(event){
    $(this).parent().next().show();
  });
  $(document).on('click', '.gmap_custom_marker_type_button_type1', function(event){
   $(this).closest('.gmap_marker_type2_area').find('.gmap_custom_marker_type1_area').show();
   $(this).closest('.gmap_marker_type2_area').find('.gmap_custom_marker_type2_area').hide();
  });
  $(document).on('click', '.gmap_custom_marker_type_button_type2', function(event){
   $(this).closest('.gmap_marker_type2_area').find('.gmap_custom_marker_type1_area').hide();
   $(this).closest('.gmap_marker_type2_area').find('.gmap_custom_marker_type2_area').show();
  });


  // Hoverアニメーション
  $(document).on('click', '#hover_type_type1', function(event){
    $('#hover_type1_area').show();
    $('#hover_type2_area, #hover_type3_area, #hover_type4_area').hide();
  });
  $(document).on('click', '#hover_type_type2', function(event){
    $('#hover_type2_area').show();
    $('#hover_type1_area, #hover_type3_area, #hover_type4_area').hide();
  });
  $(document).on('click', '#hover_type_type3', function(event){
    $('#hover_type3_area').show();
    $('#hover_type1_area, #hover_type2_area, #hover_type4_area').hide();
  });
  $(document).on('click', '#hover_type_type4', function(event){
    $('#hover_type4_area').show();
    $('#hover_type1_area, #hover_type2_area, #hover_type3_area').hide();
  });
  $(document).on('click', '#hover_type_type5', function(event){
    $('#hover_type1_area, #hover_type2_area, #hover_type3_area, #hover_type4_area').hide();
  });


  // アコーディオンの開閉
  $(document).on('click', '.theme_option_subbox_headline', function(event){
    $(this).closest('.sub_box').toggleClass('active');
    return false;
  });
  $(document).on('click', '.sub_box .close_sub_box', function(event){
    $(this).closest('.sub_box').toggleClass('active');
    return false;
  });

  // サブボックスのtitleをheadlineに反映させる
  $(document).on('change keyup', '.sub_box .repeater-label', function(){
    $(this).closest('.sub_box').find('.theme_option_subbox_headline:first').text($(this).val());
  });
  $('.sub_box .repeater-label').each(function(){
    if( $(this).val() != "" ){
      $(this).closest('.sub_box').find('.theme_option_subbox_headline:first').text($(this).val());
    }
  });

  // テーマオプションの入力エリアの開閉
  $('.theme_option_field_ac:not(.theme_option_field_ac.open)').on('click', '.theme_option_headline', function(){
    $(this).parents('.theme_option_field_ac').toggleClass('active');
    return false;
  });
  $('.theme_option_field_ac:not(.theme_option_field_ac.open)').on('click', '.close_ac_content', function(){
    $(this).parents('.theme_option_field_ac').toggleClass('active');
    return false;
  });


  // theme option tab
  $('#my_theme_option').cookieTab({
    tabMenuElm: '#theme_tab',
    tabPanelElm: '#tab-panel'
  });


  // radio button for page custom fields
   $("#map_type_type2").click(function () {
     $(".google_map_code_area").hide();
     $(".google_map_code_area2").show();
   });

   $("#map_type_type1").click(function () {
     $(".google_map_code_area").show();
     $(".google_map_code_area2").hide();
   });


  // リピーターフィールド ----------------------------------------------------------------------------------------------------------------------------
  var init_repeater = function(el) {
    $(el).each(function() {
      var $repeater_wrapper = $(this).addClass('repeater-initialized');
      var next_index = $repeater_wrapper.find(".repeater:first > .repeater-item").length || 0;

      // アイテムの並び替え
      $repeater_wrapper.find(".sortable").sortable({
        placeholder: "sortable-placeholder",
        handle: '> .theme_option_subbox_headline, > .plan_list_handler_parent, > .data > .plan_list_handler',
        //helper: "clone",
        start: function(e, ui){
          ui.item.find('textarea').each(function () {
            if (window.tinymce) {
              tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
            }
          });
        },
        stop: function (e, ui) {
          //ui.item.toggleClass("active");
          ui.item.find('textarea').each(function () {
            if (window.tinymce) {
              const editorId = $(this).attr('id');
              if (!tinymce.get(editorId)) {
                tinymce.execCommand('mceAddEditor', true, editorId);
        
                // テキストモードの場合は、再度テキストボタンをクリック
                setTimeout(() => {
                  $(this).closest('.html-active').find('.wp-switch-editor.switch-html').trigger('click');
                }, 100);
              }
            }
          });
        },
        distance: 5,
        forceHelperSize: true,
        forcePlaceholderSize: true
      });

      // 新しいアイテムを追加する
      $repeater_wrapper.off("click", ".button-add-row").on("click", ".button-add-row", function() {
        var clone = $(this).attr("data-clone");
        var $parent = $(this).closest(".repeater-wrapper");
        if (clone && $parent.size()) {
          var addindex = $(this).attr("data-add-index") || "addindex";
          var regexp = new RegExp(addindex, "gu");
          next_index++;
          clone = clone.replace(regexp, next_index);
          $parent.find(".repeater:first").append(clone);

          // 記事カスタムフィールド用 リッチエディターがある場合
          var $clone = $($(this).attr('data-clone'));
          if ($clone.find('.wp-editor-area').length) {
            // クローン元のリッチエディターをループ
            $clone.find('.wp-editor-area').each(function(){
              // id
              var id_clone = $(this).attr('id');
              var id_new = id_clone.replace(regexp, next_index);

              // クローン元のmceInitをコピー置換
              if (typeof tinyMCEPreInit.mceInit[id_clone] != 'undefined') {
                // オブジェクトを=で代入すると参照渡しになるため$.extendを利用
                var mce_init_new = $.extend(true, {}, tinyMCEPreInit.mceInit[id_clone]);
                mce_init_new.body_class = mce_init_new.body_class.replace(regexp, next_index);
                mce_init_new.selector = mce_init_new.selector.replace(regexp, next_index);
                tinyMCEPreInit.mceInit[id_new] = mce_init_new;

                // 解除してからリッチエディター化
                var mceInstance = tinymce.get(id_new);
                if (mceInstance) mceInstance.remove();
                tinymce.init(mce_init_new);
              }

              // クローン元のqtInitをコピー置換
              if (typeof tinyMCEPreInit.qtInit[id_clone] != 'undefined') {
                // オブジェクトを=で代入すると参照渡しになるため$.extendを利用
                var qt_init_new = $.extend(true, {}, tinyMCEPreInit.qtInit[id_clone]);
                qt_init_new.id = qt_init_new.id.replace(regexp, next_index);
                tinyMCEPreInit.qtInit[id_new] = qt_init_new;

                // 解除してからリッチエディター化
                var qtInstance = QTags.getInstance(id_new);
                if (qtInstance) qtInstance.remove();
                quicktags(tinyMCEPreInit.qtInit[id_new]);
              }

              setTimeout(function(){
                if ($('#wp-'+id_new+'-wrap').hasClass('tmce-active')) {
                  switchEditors.go(id_new, 'toggle');
                  switchEditors.go(id_new, 'tmce');
                } else {
                  switchEditors.go(id_new, 'html');
                }
              }, 500);
            });
          }
        }

        $repeater_wrapper.find('.c-color-picker').wpColorPicker();

        // リピーター内リピーターがある場合リピーター初期化
        if ($repeater_wrapper.find('.repeater-wrapper:not(.repeater-initialized)').length) {
          init_repeater($repeater_wrapper.find('.repeater-wrapper:not(.repeater-initialized)'));
        }

        // ここに追加

    // 線チャート用
    if ( $('#tcd_chart_type li.line input').prop("checked") ) {
      $('.chart_color_option').hide();
    }

        return false;
      });

      // アイテムを削除する
      $repeater_wrapper.on("click", ".button-delete-row", function() {
        var del = true;
        var confirm_message = $(this).closest(".repeater").attr("data-delete-confirm");
        if (confirm_message) {
          del = confirm(confirm_message);
        }
        if (del) {
          $(this).closest(".repeater-item").remove();
        }
        return false;
      });

      // フッターの固定ボタンのタイプによって、表示フィールドを切り替える
      $repeater_wrapper.on("change", ".footer-bar-type select", function() {
        var sub_box = $(this).parents(".sub_box");
        var target = sub_box.find(".footer-bar-target");
        var url = sub_box.find(".footer-bar-url");
        var number = sub_box.find(".footer-bar-number");
        switch ($(this).val()) {
          case "type1" :
            target.show();
            url.show();
            number.hide();
            break;
          case "type2" :
            target.hide();
            url.hide();
            number.hide();
            break;
          case "type3" :
            target.hide();
            url.hide();
            number.show();
          break;
        }
      });

    });
  };
  init_repeater($(".repeater-wrapper"));
  // リピーターフィールドここまで --------------------------------------------------------------

	// 保護ページのラベルを見出し（.theme_option_subbox_headline）に反映する
  $(document).on('change keyup', '.theme_option_subbox_headline_label', function(){
		$(this).closest('.sub_box_content').prev().find('span').text(' : ' + $(this).val());
  });

  // Saturation
  $(document).on('change', '.range', function() {
    $(this).prev('.range-output').find('span').text($(this).val());
  }); 


	// AJAX保存 ------------------------------------------------------------------------------------
	var $themeOptionsForm = $('#myOptionsForm');
	if ($themeOptionsForm.length) {

		// タブごとのAJAX保存

		// タブ内フォームAJAX保存中フラグ
		var tabAjaxSaving = 0;

		// 現在値を属性にセット
		var setInputValueToAttr = function(el) {
			// フォーム項目
			var $inputs = $(el).find(':input').not(':button, :submit');

			$inputs.each(function(){
				if ($(this).is('select')) {
					$(this).attr('data-current-value', $(this).val());
					$(this).find('[value="' + $(this).val() + '"]').attr('selected', 'selected');
				} else if ($(this).is(':radio, :checkbox')) {
					if ($(this).is(':checked')) {
						$(this).attr('data-current-checked', 1);
					} else {
						$(this).removeAttr('data-current-checked');
					}

					// チェックボックスで同じname属性が一つだけの場合はマージ対策でinput[type="hidden"]追加
					if ($(this).is(':checkbox') && $(this).closest('form').find('input[name="'+this.name+'"]').length == 1) {
						$(this).before('<input type="hidden" name="'+this.name+'" value="" data-current-value="">')
					}
				} else {
					$(this).attr('data-current-value', $(this).val());
				}
			});
		};

		// タブフォーム項目init処理
		var initAjaxSaveTab = function(el, savedInit) {
			// savedInit以外で更新フラグがあれば終了
			if (!savedInit && $(el).attr('data-has-changed')) return

			// 更新フラグ・ソータブル変更フラグ削除
			$(el).removeAttr('data-has-changed').removeAttr('data-sortable-changed');

			// 現在値を属性にセット
			setInputValueToAttr(el);

			// フォーム項目
			var $inputs = $(el).find(':input').not(':button, :submit');

			// 項目数をセット
			$(el).attr('data-current-inputs', $inputs.length);
		};

		// タブフォーム項目に変更があるか
		var hasChangedAjaxSaveTab = function(el) {
			var hasChange = false;

			// 更新フラグあり
			if ($(el).attr('data-has-changed')) {
				return true
			}

			// フォーム項目
			var $inputs = $(el).find(':input').not(':button, :submit');

			// ソータブル変更フラグチェック
			if ($(el).attr('data-sortable-changed')) {
				hasChange = true;

			// フォーム項目数チェック
			} else if ($inputs.length !== $(el).attr('data-current-inputs') - 0) {
				hasChange = true;

			} else {
				// フォーム変更チェック
				$inputs.each(function(){
					if ($(this).is('select')) {
						if ($(this).val() !== $(this).attr('data-current-value')) {
							hasChange = true;
							return false;
						}
					} else if ($(this).is(':radio, :checkbox')) {
						if ($(this).is(':checked') && !$(this).attr('data-current-checked')) {
							hasChange = true;
							return false;
						} else if (!$(this).is(':checked') && $(this).attr('data-current-checked')) {
							hasChange = true;
							return false;
						}
					} else {
						if ($(this).val() !== $(this).attr('data-current-value')) {
							hasChange = true;
							return false;
						}
					}
				});
			}

			// 変更ありの場合、更新フラグセット
			if (hasChange) {
				$(el).attr('data-has-changed', 1);
			}

			return hasChange;
		};

		// 初期表示タブ
		initAjaxSaveTab($themeOptionsForm.find('.tab-content:visible'));

		// タブ変更前イベント
		$('#my_theme_option').on('jctBeforeTabDisplay', function(event, args) {
			// args.tabDisplayにfalseをセットするとタブ移動キャンセル

			// タブAJAX保存中の場合はタブ移動キャンセル
			if (tabAjaxSaving) {
				args.tabDisplay = false;
				return false;
			}

			// タブ内フォーム項目に変更あり
			if (hasChangedAjaxSaveTab(args.$beforeTabPanel)) {
				if (!confirm(TCD_MESSAGES.tabChangeWithoutSave)) {
					args.tabDisplay = false;
					return false;
				}
			}

			// タブ移動
			initAjaxSaveTab(args.$afterTabPanel);
		});

		// ソータブル監視
		$themeOptionsForm.on('sortupdate', '.ui-sortable', function(event, ui) {
			// 更新フラグセット
			$themeOptionsForm.find('.tab-content:visible').attr('data-sortable-changed', 1);
		});

		// 保存ボタン
		$themeOptionsForm.on('click', '.ajax_button', function() {
			var $buttons = $themeOptionsForm.find('.button-ml');

			// タブAJAX保存中の場合は終了
			if (tabAjaxSaving) return false;

			$('#saveMessage').hide();
			$('#saving_data').show();

			// tinymceを利用しているフィールドのデータを保存
			if (window.tinyMCE) {
				tinyMCE.triggerSave();
			}

			// フォームデータ
			var fd = new FormData();

			// オプション保存用項目
			$themeOptionsForm.find('> input[type="hidden"]').each(function(){
				fd.append(this.name, this.value);
			});

			// 表示中タブ
			var $currentTabPanel = $themeOptionsForm.find('.tab-content:visible');

			// 表示中タブ内フォーム項目
			$currentTabPanel.find(':input').not(':button, :submit').each(function(){
				if ($(this).is('select')) {
					fd.append(this.name, $(this).val());
				} else if ($(this).is(':radio, :checkbox')) {
					if ($(this).is(':checked')) {
						fd.append(this.name, this.value);
					}
				} else {
					fd.append(this.name, this.value);
				}
			});

			// AJAX送信
			$.ajax({
				url: $themeOptionsForm.attr('action'),
				type: 'POST',
				data: fd,
				processData: false,
				contentType: false,
				beforeSend: function() {
					// タブAJAX保存中フラグ
					tabAjaxSaving = 1;

					// ボタン無効化
					$buttons.prop('disabled', true);
				},
				complete: function() {
					// タブAJAX保存中フラグ
					tabAjaxSaving = 0;

					// ボタン有効化
					$buttons.prop('disabled', false);
				},
				success: function(data, textStatus, XMLHttpRequest) {
					$('#saving_data').hide();
					$('#saved_data').html('<div id="saveMessage" class="successModal"></div>');
					$('#saveMessage').append('<p>' + TCD_MESSAGES.ajaxSubmitSuccess + '</p>').show();
					setTimeout(function() {
						$('#saveMessage:not(:hidden, :animated)').fadeOut();
					}, 3000);

					// タブフォーム項目初期値セット
					initAjaxSaveTab($currentTabPanel, true);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					$('#saving_data').hide();
					alert(TCD_MESSAGES.ajaxSubmitError);
				}
			});

			return false;
		});

		// TCDテーマオプション管理のボタン処理
		// max_input_vars=1000だとTCDテーマオプション管理のPOST項目が読みこめずエクスポート等が出来ない対策
		$('#tab-content-tool :submit').on('click', function(){
			var $currentTabPanel = $(this).closest('.tab-content');
			var isFirst = true;
			$('.tab-content').each(function(){
				if ($(this).is($currentTabPanel)) {
					return;
				}
				if (isFirst) {
					isFirst = false;
					return;
				}
				$(this).find(':input').not(':button, :submit').addClass('js-disabled').attr('disabled', 'disabled');
			});
			setTimeout(function(){
				$('.tab-content .js-disabled').removeAttr('disabled');
			}, 1000);
		});

		// タブごとのAJAX保存 ここまで

		// 保存メッセージクリックで非表示
		$themeOptionsForm.on('click', '#saveMessage', function(){
			$('#saveMessage:not(:hidden, :animated)').fadeOut(300);
		});
	}



  // コンテンツビルダー ----------------------------------------------------------------------------------------------------------


	// クリックで開閉
	$(document).on('click', '.js-contents-builder-item .admin-contents-builder__item-headline', function(){
		$(this).parent().toggleClass('is-show');
	});

	// 表示切り替え
	$(document).on('change', '.js-contents-builder-status', function(){
		var next = $(this).next();
		if($(this).prop("checked")){
			// next.text( next.data('active-label') );
			$(this).closest('.js-contents-builder-item, .js-status-target').addClass('is-visible');
		}else{
			// next.text( next.data('inactive-label') );
			$(this).closest('.js-contents-builder-item, .js-status-target').removeClass('is-visible');;
		}
	});
	$('.js-contents-builder-status').trigger('change');


	// 見出しの反映
  $(document).on('change keyup', '.js-contents-builder-item-label', function(){
    var $cb_content_wrap = $(this).closest('.js-contents-builder-item');
    var overview = [];
    $cb_content_wrap.find('.js-contents-builder-item-label').each(function(){
      overview.push($(this).val());
    });
    overview = overview.join(', ');
    if (overview.length) {
      overview = overview.replace(/\s+/gm, ' ').replace(/<.*?>/gm, '').replace(/\[.*?\]/gm, '');
    }
    if (overview.length > 100) {
      overview = overview.substring(0, 99) + '…';
    }
    if (overview.length) {
      $cb_content_wrap.find('.js-contents-builder-item-label-target').text(overview);
    }
  })
  $('.js-contents-builder-item-label').trigger('change');

	// クリックで追加
	$(document).on('click', '.js-contents-builder-add', function() {

    var clone = $(this).data('clone');
    var count = $(this).closest('.js-contents-builder').find('.js-contents-builder-item').length;
		var isNew = $( 'input[name="' + $(clone).find('input').attr('name').replace( /cb-index/g, count ) + '"]' ).length;

		// （追加）CB内リピーター対策<!-- repeater start --> と <!-- repeater end --> の間の文字列を抜き出す
		var regex = /<!-- repeater start -->([\s\S]*?)<!-- repeater end -->/;
		if( regex.exec(clone) != null ){
			var extractedClone = regex.exec(clone)[1];
			var escapedClone = extractedClone.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
			clone = clone.replace(regex, `<!-- repeater start -->${escapedClone}<!-- repeater end -->`);
		}

		var newRow = clone.replace( /cb-index/g, isNew ? count + 1 : count );
    $(this).closest('.js-contents-builder').find('.js-contents-builder-list').append( newRow );

		// ステータス更新
		$('.js-contents-builder-status').trigger('change');

		// カラーピッカー更新
		$('.js-contents-builder').find('.c-color-picker').wpColorPicker();

		// リッチエディター更新
		$(newRow).ready(function() {

			// リッチエディターが存在する場合
			if( $(newRow).find('.wp-editor-area') ){

				var $clone = $(clone);
				$clone.find('.wp-editor-area').each(function(){

					var id_clone = $(this).attr('id');
					var id_new = id_clone.replace(/cb-index/g, count);

					if (typeof tinyMCEPreInit.mceInit[id_clone] != 'undefined') {
						// オブジェクトを=で代入すると参照渡しになるため$.extendを利用
						var mce_init_new = $.extend(true, {}, tinyMCEPreInit.mceInit[id_clone]);
						mce_init_new.body_class = mce_init_new.body_class.replace(/cb-index/g, count);
						mce_init_new.selector = mce_init_new.selector.replace(/cb-index/g, count);
						tinyMCEPreInit.mceInit[id_new] = mce_init_new;

						// 解除してからリッチエディター化
						var mceInstance = tinymce.get(id_new);
						if (mceInstance) mceInstance.remove();
						tinymce.init(mce_init_new);
					}

					// クローン元のqtInitをコピー置換
					if (typeof tinyMCEPreInit.qtInit[id_clone] != 'undefined') {
						// オブジェクトを=で代入すると参照渡しになるため$.extendを利用
						var qt_init_new = $.extend(true, {}, tinyMCEPreInit.qtInit[id_clone]);
						// qt_init_new.id = qt_init_new.id.replace(regexp, next_index);
						qt_init_new.id = qt_init_new.id.replace(/cb-index/g, count);
						tinyMCEPreInit.qtInit[id_new] = qt_init_new;

						// 解除してからリッチエディター化
						var qtInstance = QTags.getInstance(id_new);
						if (qtInstance) qtInstance.remove();
						quicktags(tinyMCEPreInit.qtInit[id_new]);
					}

					setTimeout(function(){
						if ($('#wp-'+id_new+'-wrap').hasClass('tmce-active')) {
							switchEditors.go(id_new, 'toggle');
							switchEditors.go(id_new, 'tmce');
						} else {
							switchEditors.go(id_new, 'html');
						}
					}, 500);

				});

			}

			// （追加）リピーター内リピーターがある場合リピーター初期化
			if ($(newRow).find('.repeater-wrapper:not(.repeater-initialized)').length) {
				init_repeater($('.js-contents-builder .repeater-wrapper:not(.repeater-initialized)'));
			}

		});

    return false;

	});

	// クリックで削除
	$( document ).on( 'click', '.js-contents-builder-delete', function() {
    var target = $(this).closest('.js-contents-builder-item');
		if( confirm($(this).data('alert-msg')) ){
			target.fadeOut(300, function(){
				target.remove();
			});
		}
		return false;
  });

	// 並び替え対応
	$('.js-contents-builder-list').sortable({
		axis: 'y',
		cursor: 'grabbing',
		handle: '.js-contents-builder-handle',
    placeholder: 'sortable-placeholder',
		start: function(e, ui){
      ui.item.find('textarea').each(function () {
        if (window.tinymce) {
          tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
        }
      });
    },
    stop: function (e, ui) {
      ui.item.find('textarea').each(function () {
        if (window.tinymce) {
          const editorId = $(this).attr('id');
          if (!tinymce.get(editorId)) {
            tinymce.execCommand('mceAddEditor', true, editorId);
    
            // テキストモードの場合は、再度テキストボタンをクリック
            setTimeout(() => {
              $(this).closest('.html-active').find('.wp-switch-editor.switch-html').trigger('click');
            }, 100);
          }
        }
			});
    },
  });

  // コンテンツビルダーここまで ----------------------------------------------------



});