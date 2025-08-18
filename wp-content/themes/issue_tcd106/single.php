<?php
     get_header();
     $options = get_design_plus_option();
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_content">

 <div id="main_col">

  <article id="article">

   <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
        if ( $category && ! is_wp_error($category) ) {
          foreach ( $category as $cat ) :
            $cat_name = $cat->name;
            $cat_id = $cat->term_id;
            $cat_url = get_term_link($cat_id,'category');
            break;
          endforeach;
        };
   ?>

   <?php if($page == '1') { // 1ページ目のみ表示 
   
   $post_date = get_the_time('Ymd');
   $modified_date = get_the_modified_date('Ymd');
   
    if ($options['blog_show_date'] &&  ($post_date < $modified_date && $options['single_blog_show_mod_date'] == 'display')) {
      $category_class = 'show-update-date'; // カテゴリーが2つ以上のときのクラス
    }
    ?>

   <div id="single_post_header"<?php if(!has_post_thumbnail()) { echo ' class="no_image"'; }; ?>>

    <?php if ($category || $options['blog_show_date'] == 'display') { ?>
    <div class="meta <?php echo $category_class; ?>">
     <?php if ($category) { ?>
     <div class="category">
      <?php
           foreach ( $category as $cat ) :
             $cat_name = $cat->name;
             $cat_id = $cat->term_id;
             $cat_url = get_term_link($cat_id,'category');
      ?>
      <a href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
      <?php endforeach; ?>
     </div>
     <?php }; ?>
     <?php if ($options['blog_show_date'] == 'display'){ ?>
     <div class="date_area">
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php
           if($post_date < $modified_date && $options['single_blog_show_mod_date'] == 'display'){
      ?>
      <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
      <?php }; ?>
     </div>
     <?php }; ?>
    </div>
    <?php }; ?>

    <?php
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
    ?>
    <div class="image">
     <img fetchpriority="high" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <?php }; ?>

    <h1 class="title entry-title"><?php the_title(); ?></h1>

   </div><!-- END #single_post_header -->

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
       if($options['single_blog_show_sns'] == 'top' || $options['single_blog_show_sns'] == 'both') {
   ?>
   <div class="single_share" id="single_share_top">
    <?php get_template_part('template-parts/share_button'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_copy'] == 'top' || $options['single_blog_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-issue' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-issue' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // 追加コンテンツ（上） ------------------------------------------------------------------------------------------------------------------------
        if(!wp_is_mobile()) {
          if( $options['single_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        } else {
          if( $options['single_top_ad_code_mobile']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_top_ad_code_mobile']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        };
   ?>

   <?php }; // 1ページ目のみ表示ここまで ?>

   <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

   <?php
        // Author profile ------------------------------------------------------------------------------------------------------------------------------
        $author_id = get_the_author_meta('ID');
        $user_data = get_userdata($author_id);
        $show_author = get_the_author_meta( 'show_author', $author_id );
        if(empty($show_author)){
          $show_author = '2';
        }
        if($show_author == '1') {
          $desc = $user_data->description;
          $facebook = $user_data->facebook_url;
          $twitter = $user_data->twitter_url;
          $insta = $user_data->instagram_url;
          $pinterest = $user_data->pinterest_url;
          $youtube = $user_data->youtube_url;
          $tiktok = $user_data->tiktok_url;
          $contact = $user_data->contact_url;
          $author_url = get_author_posts_url($author_id);
          $user_url = $user_data->user_url;
   ?>
   <div class="author_profile clearfix">
    <a class="avatar_area animate_background" href="<?php echo esc_url($author_url); ?>">
     <div class="image_wrap"><?php echo wp_kses_post(get_avatar($author_id, 300)); ?></div>
    </a>
    <div class="info">
     <div class="info_inner">
      <h2 class="name rich_font_type2"><a href="<?php echo esc_url($author_url); ?>"><span class="author"><?php echo esc_html($user_data->display_name); ?></span></a></h2>
      <?php if($desc) { ?>
      <p class="desc"><span><?php echo wp_kses_post($desc); ?></span></p>
      <?php }; ?>
      <?php if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $user_url || $tiktok) { ?>
      <ul id="author_sns" class="sns_button_list color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
       <?php if($user_url) { ?><li class="user_url"><a href="<?php echo esc_url($user_url); ?>" target="_blank"><span><?php echo esc_url($user_url); ?></span></a></li><?php }; ?>
       <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
       <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
       <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
       <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
       <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
       <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
       <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
      </ul>
      <?php }; ?>
     </div>
    </div>
   </div><!-- END .author_profile -->
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_copy'] == 'bottom' || $options['single_blog_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_btm">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-issue' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-issue' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // CTA ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['use_single_cta'] == '1') {
            $cta_headline = $options['single_cta_headline'];
            $cta_desc = $options['single_cta_desc'];
            $cta_desc_mobile = $options['single_cta_desc_mobile'];
            $cta_url = $options['single_cta_btn_url'];
            $cta_target = $options['single_cta_btn_target'];
            $cta_label = $options['single_cta_btn_label'];
   ?>
   <div class="single_cta">
    <h3 class="single_cta_title"><?php echo wp_kses_post(nl2br($cta_headline)); ?></h3>
    <div class="single_cta_desc">
        <p<?php if($cta_desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($cta_desc)); ?></p>
        <?php if($cta_desc_mobile){ ?>
        <p class="mobile"><?php echo wp_kses_post(nl2br($cta_desc_mobile)); ?></p>
        <?php }; ?>
    </div>
    <a class="single_cta_btn no_auto_scroll" href="<?php echo esc_url($cta_url); ?>"<?php if($cta_target){ echo ' target="_blank"'; }; ?>><span><?php echo wp_kses_post($cta_label); ?></span></a>
   </div>
   <?php }; ?>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_sns'] == 'bottom' || $options['single_blog_show_sns'] == 'both') {
   ?>
   <div class="single_share" id="single_share_bottom">
    <?php get_template_part('template-parts/share_button'); ?>
   </div>
   <?php }; ?>

   <?php
        // meta ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if ( $options['single_blog_show_tag_list'] == 'display' && has_tag() ) {
          the_tags('<div id="post_tag_list">','','</div>');
        };
   ?>

   <?php
       // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   ?>
   <div id="next_prev_post">
    <?php next_prev_post_link(); ?>
   </div>

   <?php endwhile; endif; ?>

  </article><!-- END #article -->

  <?php
       // 追加コンテンツ（下） ------------------------------------------------------------------------------------------------------------------------
       if(!wp_is_mobile()) {
         if( $options['single_bottom_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_bottom_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       } else {
         if( $options['single_bottom_ad_code_mobile'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_bottom_ad_code_mobile']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

  <?php
       // comment ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if (comments_open() || pings_open()) { comments_template('', true); };
  ?>

 </div><!-- END #main_col -->

 <?php
      // widget ------------------------
      get_sidebar();
 ?>

</div><!-- END #main_content -->

<?php
     // おすすめ記事 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     for ( $i = 1; $i <= 3; $i++ ):

     if($options['recommend_post_headline'.$i]){

     $post_num = $options['recommend_post_num'.$i];
     if(wp_is_mobile()){
       $post_num = $options['recommend_post_num'.$i.'_sp'];
     }
     $post_type = $options['recommend_post_type'.$i];
     $post_order = $options['recommend_post_order'.$i];
     if ( $post_type == 'category_post' && $category) {
       $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => $cat_id ), ) );
     } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
       $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
     } elseif ( $post_type == 'custom' ) {
       $post_ids = $options['recommend_post_order_custom'.$i];
       $post_ids_array = array_map('intval', explode(',', $post_ids));
       $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
     } else {
       $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order );
     }
     $recommend_post_list = new wp_query($args);
     if($recommend_post_list->have_posts()):
?>
<div class="recommend_post_wrap">

 <h2 class="headline"><?php echo wp_kses_post(nl2br($options['recommend_post_headline'.$i])); ?></h2>

 <div class="recommend_post_carousel_wrap">
  <div class="recommend_post_carousel<?php echo $i; ?> swiper">
   <div class="post_list swiper-wrapper">
    <?php
         while( $recommend_post_list->have_posts() ) : $recommend_post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
           } elseif($options['no_image']) {
             $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
           } else {
             $image = array();
             $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
             $image[1] = '672';
             $image[2] = '384';
           }
    ?>
    <div class="item swiper-slide">
     <?php
          if(!is_category()) {
            $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
            if ( $category && ! is_wp_error($category) ) {
              foreach ( $category as $cat ) :
                $cat_name = $cat->name;
                $cat_id = $cat->term_id;
                break;
              endforeach;
     ?>
     <a class="category" href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><?php echo esc_html($cat_name); ?></a>
     <?php
            };
          };
     ?>
     <a class="animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <div class="content">
       <h3 class="title"><span><?php the_title(); ?></span></h3>
      </div>
     </a>
    </div>
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .post_list -->
  </div><!-- END .recommend_post_carousel -->
  <div class="recommend_post_prev<?php echo $i; ?> swiper-nav-button swiper-button-prev"></div>
  <div class="recommend_post_next<?php echo $i; ?> swiper-nav-button swiper-button-next"></div>
 </div><!-- END .recommend_post_carousel_wrap -->

</div><!-- END .recommend_post_wrap -->
<?php
       endif;
     };
     endfor;
?>

<?php get_footer(); ?>