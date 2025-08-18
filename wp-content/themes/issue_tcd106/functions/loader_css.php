<?php
     $options = get_design_plus_option();

     // ロード画面 ------------------------------------------------------------
     $loading_catch_font_size = $options['loading_catch_font_size'] ?  $options['loading_catch_font_size'] : '26';
     $loading_catch_font_size_sp = $options['loading_catch_font_size_sp'] ?  $options['loading_catch_font_size_sp'] : '20';
?>
#site_loader_overlay {
  position:relative; overflow:hidden; pointer-events:none;
  position:fixed; top:0px; left:0px; width:100%; height:100%; height:100vh; height:100dvh; z-index:99999999999;
  opacity:1; background:<?php if($options['loading_type'] == 'type5') { echo esc_attr($options['loading_bg_color3']); } else { echo esc_attr($options['loading_bg_color1']); }; ?>;

  .c-preloader__logo-text {
  font-family: var(--log_font_family);
  font-weight:var(--tcd-logo-font-weight, 600);
  font-size: var(--tcd-preloader-logo-font-size-pc);
  color: var(--tcd-preloader-logo-font-color);
  line-height: 1.5;
}

@media screen and (max-width: 800px) { 
  .c-preloader__logo-text {
  font-size: var(--tcd-preloader-logo-font-size-sp);
  }
}
}
/* body.end_loading #site_loader_overlay { opacity:0; transition: opacity 0.7s ease 0.7s; } */

<?php if($options['loading_type'] == 'type5') { ?>
#site_loader_overlay_for_catchphrase {
  position:relative; overflow:hidden; pointer-events:none; display:flex; flex-wrap:wrap; justify-content:center; align-items:center;
  position:fixed; top:0px; left:0px; width:100%; height:100%; width:100%; height:100vh; height:100dvh; z-index:99998; padding:0 100px;
  background:<?php echo esc_attr($options['loading_bg_color2']); ?>;
}
#site_loader_overlay_for_catchphrase.active { opacity:0; transition: opacity 0.1s ease 1.5s; }
#site_loader_overlay { transform: translate3d(0,-100%,0); transition: transform 0.7s cubic-bezier(.83,0,.17,1) 0.5s; }
#site_loader_overlay.active { transform: translate3d(0,0%,0); }
@media screen and (max-width:1000px) {
  #site_loader_overlay_for_catchphrase { padding:0 50px; }
}
@media screen and (max-width:800px) {
  #site_loader_overlay_for_catchphrase { padding:0 20px; }
}
<?php } else { ?>
#site_loader_overlay { transform: translate3d(0,0,0); transition: transform 0.7s cubic-bezier(.83,0,.17,1) 0.5s; }
<?php }; ?>
<?php
     // ロード完了後のメインコンテンツアニメーション（フェード用）
     if($options['loading_animation_type'] == 'type1'){
?>
body.end_loading #site_loader_overlay { opacity:0; transition: opacity 0.5s ease 0.4s; }
<?php
     // ロード完了後のメインコンテンツアニメーション（フロート用）
     } elseif($options['loading_animation_type'] == 'type2') {
?>
#header, #container, #header_message { transform: translate3d(0,-100px,0); transition: transform 0.7s ease 0.7s, opacity 0.7s ease 0.7s; opacity:0; }
body.end_loading #header, body.end_loading #container, body.end_loading #header_message { transform: translate3d(0,0,0); opacity:1; }
body.end_loading #site_loader_overlay { opacity:0; transition: opacity 0.3s ease 0.4s; }
<?php
     // ロード完了後のメインコンテンツアニメーション（横スライド用）
     } elseif($options['loading_animation_type'] == 'type3') {
?>
body.end_loading #site_loader_overlay { transform: translate3d(100%,0,0); opacity:1; }
<?php
     // ロード完了後のメインコンテンツアニメーション（縦スライド用）
     } elseif($options['loading_animation_type'] == 'type4') {
?>
body.end_loading #site_loader_overlay { transform: translate3d(0,-100%,0); opacity:1; }
<?php
     };

     // キャッチフレーズとロゴ（別々の画面） ---------------------------------------------------------------------
     if($options['loading_type'] == 'type5'){
       $loading_catch_font_size_middle = ($loading_catch_font_size + $loading_catch_font_size_sp) / 2;
?>
<?php // キャッチフレーズ ?>
#loader_catch { text-align:center; line-height:1.8; font-size:<?php echo esc_html($loading_catch_font_size); ?>px; color:<?php echo esc_html($options['loading_catch_font_color']); ?>; position:relative; }
#loader_catch.animation_type1 span { opacity:0; transform:scale(1.2) translate3d(20px,20px,0px); display:inline-block; position:relative; }
#loader_catch.animation_type1 span.animate { opacity:1; transform:scale(1) translate3d(0px,0px,0px); transition: opacity 0.5s ease 0.5s, transform 0.5s ease-out 0.5s; }
#loader_catch.animation_type2 span { opacity:0; filter:blur(20px); display:inline-block; position:relative; }
#loader_catch.animation_type2 span.animate { opacity:1; filter:blur(0px); transition: opacity 1.0s ease 0.5s, filter 1.0s ease-out 0.5s; }
#loader_catch.animation_type3 span { display:block; }
#loader_catch.animation_type3 span.first_item { opacity:0; }
#loader_catch.animation_type3 span.second_item { display:block; position:absolute; top:0; left:0; bottom:0; right:0 margin:auto; opacity:0; }
#loader_catch.animation_type3.animate span.first_item { animation:catch_animation_type3_item1 0.4s ease-in 0.5s forwards; }
#loader_catch.animation_type3.animate span.second_item { animation:catch_animation_type3_item2 0.6s ease-in 0.6s forwards; }
#loader_catch span.blank { width:0.3em; }
@media screen and (max-width:1100px) {
  #loader_catch { font-size:<?php echo esc_attr(ceil($loading_catch_font_size_middle)); ?>px; }
}
@media screen and (max-width:800px) {
  #loader_catch { font-size:<?php echo esc_html($loading_catch_font_size_sp); ?>px; }
}
<?php // ロゴ ?>
#loader_logo_image { opacity:0; display:flex; flex-wrap:wrap; justify-content:center; align-items:center; width:100%; height:100%; }
#site_loader_overlay.active #loader_logo_image { opacity:1; transition: opacity 1.0s ease 1.5s; }
#loader_logo_image .mobile { display:none; }
@media screen and (max-width:800px) {
  #loader_logo_image .pc { display:none; }
  #loader_logo_image .mobile { display:block; }
}
<?php
     // ロゴとキャッチフレーズ ---------------------------------------------------------------------
     } elseif($options['loading_type'] == 'type4'){
       $loading_catch_font_size_middle = ($loading_catch_font_size + $loading_catch_font_size_sp) / 2;
?>
#site_loader_overlay .content { display:flex; flex-direction:column; justify-content:center; width:100%; height:100%; text-align:center; }
#site_loader_overlay #loader_logo_image + #loader_catch { margin-top:50px; line-height:1.5; }
<?php // キャッチフレーズ ?>
#loader_catch { opacity:0; font-size:<?php echo esc_html($loading_catch_font_size); ?>px; color:<?php echo esc_html($options['loading_catch_font_color']); ?>; }
#site_loader_overlay.start_loading #loader_catch { opacity:1; transition: opacity 1.0s ease 0.5s; }
#site_loader_overlay.start_loading #loader_logo_image + #loader_catch { opacity:1; transition: opacity 1.0s ease 1.0s; }
@media screen and (max-width:1100px) {
  #loader_catch { font-size:<?php echo esc_attr(ceil($loading_catch_font_size_middle)); ?>px; }
}
@media screen and (max-width:800px) {
  #loader_catch { font-size:<?php echo esc_html($loading_catch_font_size_sp); ?>px; }
}
<?php // ロゴ ?>
#loader_logo_image { opacity:0; }
#site_loader_overlay.start_loading #loader_logo_image { opacity:1; transition: opacity 1.0s ease 0.5s; }
#loader_logo_image img { display:block; margin:0 auto; }
#loader_logo_image .mobile { display:none; }
@media screen and (max-width:800px) {
  #loader_logo_image .pc { display:none; }
  #loader_logo_image .mobile { display:block; }
}
<?php
     // サークルアニメーション ------------------------------------------------------------------------------------
     } elseif($options['loading_type'] == 'type1'){
?>
.circular_loader {
  position:absolute; width:60px; z-index:10;
  left:50%; top:50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);
}
.circular_loader:before { content:''; display:block; padding-top:100%; }
.circular_loader .circular {
  width:100%; height:100%;
  -webkit-animation: circular_loader_rotate 2s linear infinite; animation: circular_loader_rotate 2s linear infinite;
  -webkit-transform-origin: center center; -ms-transform-origin: center center; transform-origin: center center;
  position: absolute; top:0; bottom:0; left:0; right:0; margin:auto;
}
.circular_loader .path {
  stroke-dasharray: 1, 200;
  stroke-dashoffset: 0;
  stroke-linecap: round;
  stroke: <?php echo $options['loading_icon_color']; ?>;
  -webkit-animation: circular_loader_dash 1.5s ease-in-out infinite; animation: circular_loader_dash 1.5s ease-in-out infinite;
}
@-webkit-keyframes circular_loader_rotate {
  100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
}
@keyframes circular_loader_rotate {
  100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
}
@-webkit-keyframes circular_loader_dash {
  0% { stroke-dasharray: 1, 200; stroke-dashoffset: 0; }
  50% { stroke-dasharray: 89, 200; stroke-dashoffset: -35; }
  100% { stroke-dasharray: 89, 200; stroke-dashoffset: -124; }
}
@keyframes circular_loader_dash {
  0% { stroke-dasharray: 1, 200; stroke-dashoffset: 0; }
  50% { stroke-dasharray: 89, 200; stroke-dashoffset: -35; }
  100% { stroke-dasharray: 89, 200; stroke-dashoffset: -124; }
}
@media screen and (max-width:800px) {
  .circular_loader { width:40px; }
}

<?php
     // スクエアアニメーション ------------------------------------------------------------------------------------
     } elseif($options['loading_type'] == 'type2'){
?>
.sk-cube-grid {
  width:60px; height:60px; z-index:10;
  position:absolute; left:50%; top:50%; -ms-transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);
}
@media screen and (max-width:800px) {
  .sk-cube-grid { width:40px; height:40px; }
}
.sk-cube-grid .sk-cube {
  background-color: <?php echo $options['loading_icon_color']; ?>;
  width:33%; height:33%; float:left;
  -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out; animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out; 
}
.sk-cube-grid .sk-cube1 { -webkit-animation-delay: 0.2s; animation-delay: 0.2s; }
.sk-cube-grid .sk-cube2 { -webkit-animation-delay: 0.3s; animation-delay: 0.3s; }
.sk-cube-grid .sk-cube3 { -webkit-animation-delay: 0.4s; animation-delay: 0.4s; }
.sk-cube-grid .sk-cube4 { -webkit-animation-delay: 0.1s; animation-delay: 0.1s; }
.sk-cube-grid .sk-cube5 { -webkit-animation-delay: 0.2s; animation-delay: 0.2s; }
.sk-cube-grid .sk-cube6 { -webkit-animation-delay: 0.3s; animation-delay: 0.3s; }
.sk-cube-grid .sk-cube7 { -webkit-animation-delay: 0s; animation-delay: 0s; }
.sk-cube-grid .sk-cube8 { -webkit-animation-delay: 0.1s; animation-delay: 0.1s; }
.sk-cube-grid .sk-cube9 { -webkit-animation-delay: 0.2s; animation-delay: 0.2s; }
@-webkit-keyframes sk-cubeGridScaleDelay {
  0%, 70%, 100% { -webkit-transform: scale3D(1, 1, 1); transform: scale3D(1, 1, 1); }
  35% { -webkit-transform: scale3D(0, 0, 1); transform: scale3D(0, 0, 1); }
}
@keyframes sk-cubeGridScaleDelay {
  0%, 70%, 100% { -webkit-transform: scale3D(1, 1, 1); transform: scale3D(1, 1, 1); }
  35% { -webkit-transform: scale3D(0, 0, 1); transform: scale3D(0, 0, 1); }
}

<?php
     // ドットアニメーション ------------------------------------------------------------------------------------
     } elseif($options['loading_type'] == 'type3'){
?>
.sk-circle {
  width:60px; height:60px; z-index:10;
  position:absolute; left:50%; top:50%; -ms-transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);
}
@media screen and (max-width:800px) {
  .sk-circle { width:40px; height:40px; }
}
.sk-circle .sk-child {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
}
.sk-circle .sk-child:before {
  content: '';
  display: block;
  margin: 0 auto;
  width: 15%;
  height: 15%;
  background-color: <?php echo $options['loading_icon_color']; ?>;
  border-radius: 100%;
  -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
          animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
}
.sk-circle .sk-circle2 {
  -webkit-transform: rotate(30deg);
      -ms-transform: rotate(30deg);
          transform: rotate(30deg); }
.sk-circle .sk-circle3 {
  -webkit-transform: rotate(60deg);
      -ms-transform: rotate(60deg);
          transform: rotate(60deg); }
.sk-circle .sk-circle4 {
  -webkit-transform: rotate(90deg);
      -ms-transform: rotate(90deg);
          transform: rotate(90deg); }
.sk-circle .sk-circle5 {
  -webkit-transform: rotate(120deg);
      -ms-transform: rotate(120deg);
          transform: rotate(120deg); }
.sk-circle .sk-circle6 {
  -webkit-transform: rotate(150deg);
      -ms-transform: rotate(150deg);
          transform: rotate(150deg); }
.sk-circle .sk-circle7 {
  -webkit-transform: rotate(180deg);
      -ms-transform: rotate(180deg);
          transform: rotate(180deg); }
.sk-circle .sk-circle8 {
  -webkit-transform: rotate(210deg);
      -ms-transform: rotate(210deg);
          transform: rotate(210deg); }
.sk-circle .sk-circle9 {
  -webkit-transform: rotate(240deg);
      -ms-transform: rotate(240deg);
          transform: rotate(240deg); }
.sk-circle .sk-circle10 {
  -webkit-transform: rotate(270deg);
      -ms-transform: rotate(270deg);
          transform: rotate(270deg); }
.sk-circle .sk-circle11 {
  -webkit-transform: rotate(300deg);
      -ms-transform: rotate(300deg);
          transform: rotate(300deg); }
.sk-circle .sk-circle12 {
  -webkit-transform: rotate(330deg);
      -ms-transform: rotate(330deg);
          transform: rotate(330deg); }
.sk-circle .sk-circle2:before {
  -webkit-animation-delay: -1.1s;
          animation-delay: -1.1s; }
.sk-circle .sk-circle3:before {
  -webkit-animation-delay: -1s;
          animation-delay: -1s; }
.sk-circle .sk-circle4:before {
  -webkit-animation-delay: -0.9s;
          animation-delay: -0.9s; }
.sk-circle .sk-circle5:before {
  -webkit-animation-delay: -0.8s;
          animation-delay: -0.8s; }
.sk-circle .sk-circle6:before {
  -webkit-animation-delay: -0.7s;
          animation-delay: -0.7s; }
.sk-circle .sk-circle7:before {
  -webkit-animation-delay: -0.6s;
          animation-delay: -0.6s; }
.sk-circle .sk-circle8:before {
  -webkit-animation-delay: -0.5s;
          animation-delay: -0.5s; }
.sk-circle .sk-circle9:before {
  -webkit-animation-delay: -0.4s;
          animation-delay: -0.4s; }
.sk-circle .sk-circle10:before {
  -webkit-animation-delay: -0.3s;
          animation-delay: -0.3s; }
.sk-circle .sk-circle11:before {
  -webkit-animation-delay: -0.2s;
          animation-delay: -0.2s; }
.sk-circle .sk-circle12:before {
  -webkit-animation-delay: -0.1s;
          animation-delay: -0.1s; }

@-webkit-keyframes sk-circleBounceDelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0);
  } 40% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}

@keyframes sk-circleBounceDelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0);
  } 40% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}
<?php } ?>