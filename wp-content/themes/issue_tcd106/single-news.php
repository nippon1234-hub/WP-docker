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
   ?>

   <?php if($page == '1') { // 1ページ目のみ表示 ?>

   <div id="single_news_header"<?php if(!has_post_thumbnail()) { echo ' class="no_image"'; }; ?>>
    <?php
         if(has_post_thumbnail() && $options['news_show_image'] == 'display') {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
    ?>
    <div class="image">
     <img fetchpriority="high" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <?php }; ?>

    <div class="title_area">
    <?php
        if($options['news_show_category'] == 'display'){
            $terms = get_the_terms($post->ID, 'news_category');
            if($terms){
    ?>
        <div class="news_category">
    <?php
                foreach ($terms as $term) {
                    $cate_name = $term->name;
                    $cate_url = get_term_link($term->term_id);
                    echo '<a href="'.$cate_url.'">'.$cate_name.'</a>'."\n";
                }
    ?>
        </div>
    <?php
            }
        }
    ?>
     <div class="meta">
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php
           $post_date = get_the_time('Ymd');
           $modified_date = get_the_modified_date('Ymd');
           if($post_date < $modified_date && $options['single_news_show_mod_date'] == 'display'){
      ?>
      <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
      <?php }; ?>
     </div>
     <h1 class="title entry-title"><?php the_title(); ?></h1>
    </div>

   </div><!-- END #single_news_header -->

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
       if($options['single_news_show_sns'] == 'top' || $options['single_news_show_sns'] == 'both') {
   ?>
   <div class="single_share" id="single_share_top">
    <?php get_template_part('template-parts/share_button'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_copy'] == 'top' || $options['single_news_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-issue' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-issue' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // 追加コンテンツ（上） ------------------------------------------------------------------------------------------------------------------------
        if(!wp_is_mobile()) {
          if( $options['single_news_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_news_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        } else {
          if( $options['single_news_top_ad_code_mobile']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_news_top_ad_code_mobile']; ?>
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
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_copy'] == 'bottom' || $options['single_news_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_btm">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-issue' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-issue' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_sns'] == 'bottom' || $options['single_news_show_sns'] == 'both') {
   ?>
   <div class="single_share" id="single_share_bottom">
    <?php get_template_part('template-parts/share_button'); ?>
   </div>
   <?php }; ?>

   <?php
        // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   ?>
   <div id="next_prev_post" class="clearfix">
    <?php next_prev_post_link(); ?>
   </div>

   <?php endwhile; endif; ?>

   <?php
        // おすすめ記事 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['news_show_image'] != 'display'){

        for ( $i = 1; $i <= 3; $i++ ):

        if($options['recommend_news_headline'.$i]){

        $post_num = $options['recommend_news_num'.$i];
        if(wp_is_mobile()){
          $post_num = $options['recommend_news_num'.$i.'_sp'];
        }
        $post_type = $options['recommend_news_type'.$i];
        $post_order = $options['recommend_news_order'.$i];
        if ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
          $args = array('post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
        } elseif ( $post_type == 'custom' ) {
          $post_ids = $options['recommend_news_order_custom'.$i];
          $post_ids_array = array_map('intval', explode(',', $post_ids));
          $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
        } else {
          $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order );
        }
        $recommend_post_list = new wp_query($args);
        if($recommend_post_list->have_posts()):
   ?>
   <div class="recommend_news">

    <h2 class="headline"><?php echo wp_kses_post(nl2br($options['recommend_news_headline'.$i])); ?></h2>

    <div class="news_list">
     <?php while( $recommend_post_list->have_posts() ) : $recommend_post_list->the_post(); ?>
     <a class="item" href="<?php the_permalink(); ?>">
      <div class="content">
       <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
       <h3 class="title"><span><?php the_title(); ?></span></h3>
      </div>
     </a>
     <?php endwhile; wp_reset_query(); ?>
    </div><!-- END .news_list -->

   </div><!-- END .recommend_post_no_image -->
   <?php
            endif;
          };
        endfor;
        };
   ?>

  </article><!-- END #article -->

  <?php
       // 追加コンテンツ（下） ------------------------------------------------------------------------------------------------------------------------
       if(!wp_is_mobile()) {
         if( $options['single_news_bottom_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_news_bottom_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       } else {
         if( $options['single_news_bottom_ad_code_mobile'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_news_bottom_ad_code_mobile']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

 </div><!-- END #main_col -->

 <?php
      // widget ------------------------
      get_sidebar();
 ?>

</div><!-- END #main_content -->

<?php
     // おすすめ記事 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     if($options['news_show_image'] == 'display'){

     for ( $i = 1; $i <= 3; $i++ ):

     if($options['recommend_news_headline'.$i]){

     $post_num = $options['recommend_news_num'.$i];
     if(wp_is_mobile()){
       $post_num = $options['recommend_news_num'.$i.'_sp'];
     }
     $post_type = $options['recommend_news_type'.$i];
     $post_order = $options['recommend_news_order'.$i];
     if ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
       $args = array('post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
     } elseif ( $post_type == 'custom' ) {
       $post_ids = $options['recommend_news_order_custom'.$i];
       $post_ids_array = array_map('intval', explode(',', $post_ids));
       $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
     } else {
       $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order );
     }
     $recommend_post_list = new wp_query($args);
     if($recommend_post_list->have_posts()):
?>
<div class="recommend_post_wrap">

 <h2 class="headline"><?php echo wp_kses_post(nl2br($options['recommend_news_headline'.$i])); ?></h2>

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
     <a class="animate_background" href="<?php the_permalink(); ?>">
      <?php if($options['news_show_image'] == 'display'){ ?>
      <div class="image_wrap">
       <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <?php }; ?>
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
     };
?>

<?php get_footer(); ?>