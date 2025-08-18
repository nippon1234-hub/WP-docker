<?php $options = get_design_plus_option(); ?>
<!DOCTYPE html>
<html class="pc" <?php language_attributes(); ?>>
<?php if($options['use_ogp']) { ?>
<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb#">
<?php } else { ?>
<head>
<?php }; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width">
<meta name="description" content="<?php echo get_seo_description(); ?>">
<?php if(is_attachment() && (get_option( 'blog_public' ) != 0)) { ?>
<meta name='robots' content='noindex, nofollow' />
<?php }; ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>
<div id="js-body-start"></div>

<?php
     // ロード画面 --------------------------------------------------------------------
     if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
     ){
       load_icon();
     };

     // メッセージ --------------------------------------------------------------------
     if( is_404() || ((is_search() && isset($_GET['s']) && empty($_GET['s'])) || (is_search() && !have_posts())) ){ } else {
       if( (is_front_page() && $options['show_header_message'] == 'display') || (!is_page() && $options['show_header_message'] == 'display') || (is_page() && !is_page_template('page-tcd-lp.php') && $options['show_header_message'] == 'display') || (is_page() && is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_header_message', true)) == 'no') ) {
         $message = $options['header_message'];
         $url = $options['header_message_url'];
         $target = $options['header_message_target'];
         $font_color = $options['header_message_font_color'];
         $bg_color = $options['header_message_bg_color'];
         if($message){
?>
<div id="header_message" style="color:<?php esc_attr_e($font_color); ?>;background-color:<?php esc_attr_e($bg_color); ?>;">
 <?php if($url){ ?>
 <a href="<?php echo esc_url($url); ?>" <?php if($target){ echo 'target="_blank" rel="nofollow noopener"'; }; ?> class="label"><?php echo wp_kses_post(nl2br($message)); ?></a>
 <?php }else{ ?>
 <p class="label"><?php echo wp_kses_post(nl2br($message)); ?></p>
 <?php } ?>
</div>
<?php
         };
       };
     };
?>

<?php
     // ヘッダー ----------------------------------------------------------------------
      if(is_page_template('page-tcd-lp.php')){ 
        $hide_global_menu = get_post_meta($post->ID, 'hide_global_menu', true) ?  get_post_meta($post->ID, 'hide_global_menu', true) : 'no';
        $hide_logo = get_post_meta($post->ID, 'hide_logo', true) ?  get_post_meta($post->ID, 'hide_logo', true) : 'no';
        if($hide_global_menu == 'yes' && $hide_logo == 'yes'){
          $hide_page_header_bar = 'yes';
        } else {
          $hide_page_header_bar = 'no';
        }
      } else {
        $hide_page_header_bar = 'no';
        $hide_global_menu = 'no';
        $hide_logo = 'no';
      }
      if( $hide_page_header_bar != 'yes' ) {
?>
<header id="header">
 <?php
      // ロゴ ----------------------------------------
      if( $hide_logo != 'yes' ) {
        header_logo();
      }

      // グローバルメニュー ----------------------------------------------------------------
      if ( $hide_global_menu != 'yes' && has_nav_menu('global-menu')) {
 ?>
 <div id="drawer_menu_button"><span></span><span></span><span></span></div>
 <div id="drawer_menu_wrap">
  <div id="drawer_menu_inner">
   <div id="drawer_menu_close_button"><span></span><span></span><span></span></div>
   <?php
        if($options['header_menu_type'] == 'type1'){
          get_template_part('template-parts/side_button_mobile');
          wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'depth' => '2', 'container' => 'nav', 'container_id' => 'drawer_menu', 'walker' => new drawer_menu  ) );
        } else {
          get_template_part('template-parts/side_button_mobile');
          wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => 'nav', 'container_id' => 'global_menu'  ) );
          if($options['header_button_url1'] || $options['header_button_url2']){
   ?>
   <div id="header_button">
    <?php
            for ( $i = 1; $i <= 2; $i++ ) :
              $url = $options['header_button_url'.$i];
              if($url) {
                $title = $options['header_button_label'.$i];
                $target = $options['header_button_target'.$i];
    ?>
    <a class="item label" href="<?php echo esc_url($url); ?>"<?php if($target){ echo ' target="_blank" rel="nofollow noopener"'; }; ?>><?php echo esc_html($title); ?></a>
    <?php
              };
            endfor;
    ?>
   </div>
   <?php
          };
        };
   ?>
   <?php
        // SNSボタン ------------------------------------
        if($options['show_sns_mobile'] == 'display') {
          $line = $options['sns_button_line_url'];
          $facebook = $options['sns_button_facebook_url'];
          $twitter = $options['sns_button_twitter_url'];
          $insta = $options['sns_button_instagram_url'];
          $pinterest = $options['sns_button_pinterest_url'];
          $youtube = $options['sns_button_youtube_url'];
          $tiktok = $options['sns_button_tiktok_url'];
          $note = $options['sns_button_note_url'];
          $contact = $options['sns_button_contact_url'];
          $show_rss = $options['sns_button_show_rss'];
   ?>
   <ul id="mobile_sns" class="sns_button_list color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
    <?php if($line) { ?><li class="line"><a href="<?php echo esc_url($line); ?>" rel="nofollow noopener" target="_blank" title="LINE"><span>LINE</span></a></li><?php }; ?>
    <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
    <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow noopener" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
    <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
    <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
    <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
    <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
    <?php if($note) { ?><li class="note"><a href="<?php echo esc_url($note); ?>" rel="nofollow noopener" target="_blank" title="note"><span>note</span></a></li><?php }; ?>
    <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
    <?php if($show_rss == 'display') { ?><li class="rss"><a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
   </ul>
   <?php }; ?>
  </div>
  <div id="drawer_menu_overlay"></div>
 </div><!-- END #drawer_menu_wrap -->
 <?php }; ?>

</header>
<?php }; ?>

<?php
     // サイドボタン --------------------------------------------------
     if(!wp_is_mobile()){
       get_template_part('template-parts/side_button');
     }
?>

<div id="container">

 <?php
      //  トップページ -------------------------------------------------------------------------
      if(is_front_page()) {

        //  ヘッダースライダー -------------------------------------------------------------------------
       $content_position = $options['index_header_content_position'];
       $catch_animation_type = $options['index_header_content_catch_animation'];
 ?>
 <div id="header_slider_container" class="logo_change_trigger">
 <div id="header_slider_wrap" class="content_position_<?php echo esc_attr($content_position); ?> catch_animation_<?php echo esc_attr($catch_animation_type); ?>">

  <?php
       // キャッチフレーズエリア -----------------
       $catch = $options['index_header_content_catch'];
       if(wp_is_mobile() && $options['index_header_content_catch_mobile']){
         $catch = $options['index_header_content_catch_mobile'];
       }

       $catch_font_type_raw = $options['index_header_content_catch_font_type'] ?? '1';

       // 正しい値マッピング
       $map = [
         'type1' => 1,
         'type2' => 1,
         'type3' => 2,
         '1'     => 1,
         '2'     => 2,
         '3'     => 3,
         1       => 1,
         2       => 2,
         3       => 3,
       ];
       
       // 不明な値は 1 にフォールバック
       $catch_font_type = $map[$catch_font_type_raw] ?? 1;

       $desc = $options['index_header_content_desc'];
       if(wp_is_mobile() && $options['index_header_content_desc_mobile']){
         $desc = $options['index_header_content_desc_mobile'];
       }
       $notice = $options['index_header_content_notice'];
       $notice_url = $options['index_header_content_notice_url'] ?  $options['index_header_content_notice_url'] : '';
       $notice_target = $options['index_header_content_notice_target'];
  ?>
  <div id="header_slider_content">
   <div class="content">
    <?php if($catch){ ?>
    <h2 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?>"><?php if($catch_animation_type != 'type3'){ echo sepText($catch); } else {  echo '<span class="first_item">' . wp_kses_post(nl2br($catch)) . '</span><span class="second_item">' . wp_kses_post(nl2br($catch)); }; ?></h2>
    <?php }; ?>
    <?php if($desc){ ?>
    <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
    <?php }; ?>
   </div>
  </div>

  <?php if($notice){ // 告知 ?>
  <div id="header_slider_notice"<?php if(!$options['show_header_news']){ echo ' class="no_news_ticker"'; }; ?>><a href="<?php echo esc_url($notice_url); ?>" class="content<?php if(!$notice_url){ echo ' no_link'; }; ?>"<?php if($notice_url && $notice_target){ echo ' target="_blank" rel="nofollow noopener"'; }; ?>><div class="inner"><?php echo wp_kses_post(nl2br($notice)); ?></div></a></div>
  <?php }; ?>

  <?php
       // スライダーエリア -----------------
        $index_header_content_type = $options['index_header_content_type'];
        $overlay = hex2rgb($options['index_header_content_overlay_color']);
        $overlay = implode(",",$overlay);
        $overlay_opacity = $options['index_header_content_overlay_opacity'];
        $animation_type = $options['index_image_slider_animation_type'] ?  $options['index_image_slider_animation_type'] : 'slide';
  ?>
  <div id="header_slider" class="swiper animation_type_<?php echo esc_attr($animation_type); ?>" data-fade_speed="1500">
   <div class="swiper-wrapper">
    <?php
         // 画像スライダー
         if($index_header_content_type == 'type1'){
           $i = 1;
           $images = $options['index_slider_image'];
           if(wp_is_mobile() && $options['index_slider_image_sp']){
             $images = $options['index_slider_image_sp'];
           }
           $images = $images ? explode( ',', $images ) : array();
           if( !empty( $images ) ){
    ?>
    <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
    <?php
             foreach( $images as $image_id ):
               $image = wp_get_attachment_image_src( $image_id, 'full' );
               if(!$options['index_slider_image_sp']){
                 $image_sp = wp_get_attachment_image_src( $image_id, 'size4' );
               }
               if( $image ){
    ?>
    <div class="swiper-slide item item<?php echo $i; if($i == 1){ echo ' first_item'; }; ?>" data-item-type="type1">
     <div class="item-inner">
      <picture class="bg_image">
       <?php if(!$options['index_slider_image_sp']){ ?>
       <source media="(max-width: 650px)" srcset="<?php echo esc_attr($image_sp[0]); ?>">
       <?php }; ?>
       <img <?php if($i != 1){ echo 'loading="lazy" decoding="auto" fetchpriority="low" '; } else { echo 'fetchpriority="high" '; }; ?>src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
      </picture>
     </div>
    </div><!-- END .item -->
    <?php
               };
               $i++;
             endforeach;
           };

         // 動画
         } elseif($index_header_content_type == 'type2') {
           $video_url = $options['index_header_content_video'];
           if($video_url){
    ?>
    <div class="swiper-slide item item first_item" data-item-type="type2">
     <div class="item-inner">
      <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
      <video class="bg_video" src="<?php echo esc_url(wp_get_attachment_url($video_url)); ?>" playsinline muted></video>
     </div>
    </div><!-- END .item -->
    <?php
           };

         // YouTube
         } elseif($index_header_content_type == 'type3') {
           if ( $options['index_header_content_youtube'] && preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $options['index_header_content_youtube'], $matches ) ) {
             $youtube_id = $matches[1];
    ?>
    <div class="swiper-slide item item first_item" data-item-type="type3">
     <div class="item-inner">
      <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
      <div class="bg_youtube" data-video-id="<?php echo esc_attr( $youtube_id ); ?>"></div>
     </div>
    </div><!-- END .item -->
    <?php
           };
         };
    ?>
   </div>
  </div><!-- END #header_slider -->

  <?php
       // ニュースティッカー
       if($options['show_header_news']){
         $post_num = 5;
         $post_type = $options['header_news_post_type'];
         $post_order = $options['header_news_post_order'];
         $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num, 'orderby' => $post_order );
         $post_list = new wp_query($args);
         if($post_list->have_posts()):
  ?>
  <div id="news_ticker" class="swiper post_type_<?php echo esc_attr($post_type); ?>">
   <div class="post_list swiper-wrapper">
    <?php while( $post_list->have_posts() ) : $post_list->the_post(); ?>
    <a class="item swiper-slide" href="<?php the_permalink(); ?>">
     <div class="item_inner">
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <p class="title"><?php the_title_attribute(); ?></p>
     </div>
    </a>
    <?php endwhile; wp_reset_query(); ?>
   </div>
  </div>
  <?php
         endif;
       };
  ?>

 </div><!-- END #header_slider_wrap -->
 </div><!-- END #header_slider_container -->

 <?php
      }; // END front page

