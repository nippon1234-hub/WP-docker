<?php

use TCD\Helper\UI;

$options = get_query_var('options');
$dp_default_options = get_query_var('dp_default_options');

    // フォントセット
    echo UI\heading( __( 'Font set','tcd-issue' ) );
    echo UI\note( __( 'Any set of fonts can be registered for Japanese and European languages. Fonts registered here can be reflected in various places.','tcd-issue' ), [ 'style' => 'margin-bottom:15px;' ],'tcd-issue' );
    echo UI\repeater(
      'dp_options[font_list]',
      shortcode_atts(
        $dp_default_options['font_list'],
        $options['font_list'],
      ),
      function( $name, $key, $value ){
        global $tcd_font_manager;

        $logo_preview = '';
        $repeater_label = $key;
        $logo_font_note = '';
        $logo_weight_ui = '';
        // ロゴ用設定
        if( $key === 'logo' ){
          // ロゴ用プレビュー
          $logo_preview = '<span style="font-size:1.3em;">' . get_bloginfo( 'name' ) . '</span>';
          // リピーターラベル
          $repeater_label = __( '(Logo)' );
          // ロゴ用注釈
          $logo_font_note = UI\note( __( 'This font is reflected in the text when the logo is not set.','tcd-issue' ));
          // ロゴ用ウェイトオプション
          $logo_weight_ui = UI\title( __( 'Font weight','tcd-issue' ) ) . UI\radio( "{$name}[weight]", $value['weight'] ?? 'bold', [ 'normal' => __( 'Normal','tcd-issue' ), 'bold' => __( 'Bold','tcd-issue' ) ] );
        }

        // ★ ここで title を定義（ラベルが確定してから！）
        $value['title'] = sprintf( __( 'Font %s','tcd-issue' ), $repeater_label );

        return UI\section(
          $tcd_font_manager->view_admin_font_preview( $logo_preview ),
          [
            $logo_font_note,
            // デフォルトタイトル
            UI\text( '', sprintf( __( 'Font %s','tcd-issue' ), $repeater_label ), [ 'data-sync' => true, 'style' => 'display:none;' ] ),
            UI\title( __( 'Font type','tcd-issue' ) ),
            UI\select(
              "{$name}[type]",
              $value['type'] ?? 'system',
              [
                'system' => __( 'System font','tcd-issue' ),
                'web' => __( 'Web font','tcd-issue' ),
              ],
              [
                'data-switch' => 2,
                'data-font-type-select' => true
              ]
            ),
            [
              UI\note( __( 'System fonts are fonts that are built into your device. If the specified font is not installed, an alternative font will be displayed.','tcd-issue' ) ),
              UI\title( __( 'Japanese font','tcd-issue' ) ),
              UI\select(
                "{$name}[japan]",
                $value['japan'] ?? '',
                [ '' => __( 'Unspecified','tcd-issue' ) ] + array_map(
                  fn ( $value ) => $value['label'],
                  $tcd_font_manager->system_font_japan
                ),
                [
                  'data-font-preview-select' => 'japan'
                ]
              ),
              UI\title( __( 'Latin font','tcd-issue') ),
              UI\select(
                "{$name}[latin]",
                $value['latin'] ?? '',
                [ '' => __( 'Unspecified','tcd-issue' ) ] + array_map(
                  fn ( $value ) => $value['label'],
                  $tcd_font_manager->system_font_latin
                ),
                [
                  'data-font-preview-select' => 'latin'
                ]
              ),
            ],
            [
              UI\note( __( 'Web fonts are loaded from an external site (Google Fonts). There may be a time lag, but they will look the same on all devices.','tcd-issue' ) ),
              UI\title( __( 'Japanese font','tcd-issue' ) ),
              UI\select(
                "{$name}[web_japan]",
                $value['web_japan'] ?? '',
                [ '' => __( 'Unspecified','tcd-issue' ) ] + array_map(
                  fn ( $value ) => $value['label'],
                  $tcd_font_manager->web_font_japan
                ),
                [
                  'data-font-preview-select' => 'web-japan'
                ]
              ),
              UI\title( __( 'Latin font','tcd-issue' ) ),
              UI\select(
              "{$name}[web_latin]",
              $value['web_latin'] ?? '',
              [ '' => __( 'Unspecified','tcd-issue' ) ] + array_map(
                fn ( $value ) => $value['label'],
                $tcd_font_manager->web_font_latin
              ),
              [
                'data-font-preview-select' => 'web-latin'
                ]
              ),
            ],
            $logo_weight_ui,
            UI\submit( [ 'class' => 'tcd-ui-submit' ] )
          ],
          false
        );
      },
      [
        'add' => false,
        'delete' => false,
        'sort' => false,
        'show' => false,
      ]
    );
   ?>