<?php
     global $post;
     $options = get_design_plus_option();
     $staff_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Staff', 'tcd-issue' );

     if ( have_posts() ) : while ( have_posts() ) : the_post();

       if(has_post_thumbnail()) {
         $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
         $image_sp = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
       } elseif($options['no_image']) {
         $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         $image_sp = '';
       } else {
         $image = array();
         $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
         $image[1] = '725';
         $image[2] = '1200';
         $image_sp = '';
       }
       $post_category = wp_get_post_terms( $post->ID, 'staff_category' , array( 'orderby' => 'term_order' ));
       if ( $post_category ) {
         foreach ( $post_category as $cat ) :
           $cat_name = $cat->name;
           $cat_id = $cat->term_id;
           $cat_url = get_term_link($cat_id,'staff_category');
           break;
         endforeach;
       }
       $staff_name = get_post_meta($post->ID, 'staff_name', true);
       $staff_job = get_post_meta($post->ID, 'staff_job', true);
       $staff_date = get_post_meta($post->ID, 'staff_date', true);
       $staff_catch = get_post_meta($post->ID, 'staff_catch', true);
       $overlay_color = hex2rgb($options['interview_header_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['interview_header_overlay_opacity'];
?>
<article id="staff_content_type1">

 <div id="staff_left_content" class="logo_change_trigger">

  <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>

  <?php
       // 画像スライダー -------------------------------------------------------
       $staff_image_slider = get_post_meta($post->ID, 'staff_image_slider', true);
       $images = $staff_image_slider ? explode( ',', $staff_image_slider ) : array();
       if( !empty( $images ) ){
  ?>
  <div id="staff_image_carousel_wrap" class="swiper">
   <div id="staff_image_carousel" class="swiper-wrapper">
    <div class="item swiper-slide">
     <picture class="image">
      <source media="(max-width: 650px)" srcset="<?php echo esc_attr($image_sp[0]); ?>">
      <img fetchpriority="high" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
     </picture>
    </div>
    <?php
         foreach( $images as $image_id ):
           $image = wp_get_attachment_image_src( $image_id, 'full' );
           $image_sp = wp_get_attachment_image_src( $image_id, 'size4' );
           if($image){
    ?>
    <div class="item swiper-slide">
     <picture class="image">
      <source media="(max-width: 650px)" srcset="<?php echo esc_attr($image_sp[0]); ?>">
      <img loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
     </picture>
    </div>
    <?php
           };
         endforeach;
    ?>
   </div>
  </div><!-- END #staff_image_carousel_wrap -->
  <?php
       // 通常の画像 -----------------
       } else {
  ?>
  <picture class="main_image">
   <source media="(max-width: 650px)" srcset="<?php echo esc_attr($image_sp[0]); ?>">
   <img fetchpriority="high" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
  </picture>
  <?php
       };
  ?>

  <?php if($staff_name || $post_category || $staff_job || $staff_catch){ ?>
  <div class="content">
   <?php if($staff_name || $post_category || $staff_job){ ?>
   <ul class="info">
    <?php if($staff_name){ ?>
    <li class="name"><p><span><?php echo esc_html($staff_name); ?></span></p></li>
    <?php }; ?>
    <?php if ($post_category) { ?>
    <li class="category"><p><span><?php echo esc_html($cat_name); ?></span></p></li>
    <?php }; ?>
    <?php if($staff_job){ ?>
    <li class="job"><p><span><?php echo esc_html($staff_job); ?></span></p></li>
    <?php }; ?>
   </ul>
   <?php }; ?>
   <?php if($staff_catch){ ?>
   <p class="catch"><span><?php echo wp_kses_post(nl2br($staff_catch)); ?></span></p>
   <?php }; ?>
  </div>
  <?php }; ?>

 </div><!-- END #staff_left_content -->

 <div id="staff_right_content">

  <div id="staff_title_area">
   <div class="meta">
    <?php if ($post_category) { ?>
    <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
    <?php }; ?>
    <?php if ($options['staff_show_date'] == 'display'){ ?>
    <div class="date_area">
     <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
     <?php
          $post_date = get_the_time('Ymd');
          $modified_date = get_the_modified_date('Ymd');
          if($post_date < $modified_date && $options['single_staff_show_mod_date'] == 'display'){
     ?>
     <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
     <?php }; ?>
    </div>
    <?php }; ?>
   </div>
   <h1 class="title entry-title"><?php the_title(); ?></h1>
  </div>

  <?php if($staff_name || $post_category || $staff_job || $staff_date){ ?>
  <div id="staff_info_area">
   <?php if($staff_name){ ?>
   <p class="name"><?php echo esc_html($staff_name); ?></p>
   <?php }; ?>
   <?php if($post_category || $staff_job){ ?>
   <div class="job_area">
    <?php if ($post_category) { ?>
    <p class="category"><?php echo esc_html($cat_name); ?></p>
    <?php }; ?>
    <?php if($staff_job){ ?>
    <p class="job"><?php echo esc_html($staff_job); ?></p>
    <?php }; ?>
   </div>
   <?php }; ?>
   <?php if($staff_date){ ?>
   <p class="date"><?php echo esc_html($staff_date); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>

   <?php
        // 追加コンテンツ（上） ------------------------------------------------------------------------------------------------------------------------
        if(!wp_is_mobile()) {
          if( $options['single_staff_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_staff_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        } else {
          if( $options['single_staff_top_ad_code_mobile']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_staff_top_ad_code_mobile']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        };
   ?>

  <div class="post_content clearfix">
   <?php
        the_content();
        if ( ! post_password_required() ) {
          custom_wp_link_pages();
        }
   ?>
  </div>

  <?php
       // 追加コンテンツ（下） ------------------------------------------------------------------------------------------------------------------------
       if(!wp_is_mobile()) {
         if( $options['single_staff_bottom_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_staff_bottom_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       } else {
         if( $options['single_staff_bottom_ad_code_mobile'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_staff_bottom_ad_code_mobile']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

  <?php staff_prev_post(); ?>

  <a id="staff_back_button" href="<?php echo esc_url(get_post_type_archive_link('staff')); ?>"><?php printf(__('Back to %s list', 'tcd-issue'), $staff_label); ?></a>

 </div><!-- END #staff_right_content -->

</article>

<?php endwhile; endif; ?>

<?php
     // カルーセル ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     for ( $i = 1; $i <= 3; $i++ ):

     if($options['related_staff_headline'.$i]){

     $post_num = $options['related_staff_post_num'.$i];
     if(wp_is_mobile()){
       $post_num = $options['related_staff_post_num'.$i.'_sp'];
     }
     $post_order = $options['related_staff_post_order'.$i];
     if($post_order == 'menu_order'){
       $post_order = array();
       $post_order['menu_order'] = 'ASC';
       $post_order['date'] = 'DESC';
     }
     $post_type = $options['related_staff_post_type'.$i];
     if ( $post_type == 'category_post' && $post_category) {
       $args = array( 'post_status' => 'publish', 'post_type' => 'staff', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'staff_category', 'field' => 'term_id', 'terms' => $cat_id ), ) );
     } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
       $args = array('post_type' => 'staff', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
     } elseif ( $post_type == 'custom' ) {
       $post_ids = $options['related_staff_post_order_custom'.$i];
       $post_ids_array = array_map('intval', explode(',', $post_ids));
       $args = array( 'post_status' => 'publish', 'post_type' => 'staff', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
     } else {
       $args = array( 'post_status' => 'publish', 'post_type' => 'staff', 'posts_per_page' => $post_num, 'orderby' => $post_order );
     }
     $staff_carousel = new wp_query($args);
     if($staff_carousel->have_posts()):
?>
<div class="staff_carousel">

 <h2 class="headline"><?php echo esc_html($options['related_staff_headline'.$i]); ?></h2>

 <div class="staff_carousel_wrap_type1">
  <div class="staff_carousel_type1_<?php echo $i; ?> swiper">
   <div class="staff_list_type1 swiper-wrapper">
    <?php
         while( $staff_carousel->have_posts() ) : $staff_carousel->the_post();
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
          } elseif($options['no_image']) {
            $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
          } else {
            $image = array();
            $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
            $image[1] = '680';
            $image[2] = '940';
          }
          $post_category = wp_get_post_terms( $post->ID, 'staff_category' , array( 'orderby' => 'term_order' ));
          $staff_name = get_post_meta($post->ID, 'staff_name', true);
          $staff_job = get_post_meta($post->ID, 'staff_job', true);
          $staff_date = get_post_meta($post->ID, 'staff_date', true);
    ?>
    <a class="item animate_background swiper-slide" href="<?php the_permalink(); ?>">
     <div class="image_wrap staff_list_image mouse_stalker_element">
      <?php if($staff_name || $staff_job || $staff_date){ ?>
      <p class="mouse_stalker_target"><?php the_title(); ?></p>
      <?php }; ?>
      <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
     <div class="content">
      <?php if($staff_name || $staff_job || $staff_date){ ?>
      <?php if($staff_name){ ?>
      <p class="name"><?php echo esc_html($staff_name); ?></p>
      <?php }; ?>
      <?php if($staff_job){ ?>
      <div class="job_area">
       <p class="job"><?php echo esc_html($staff_job); ?></p>
      </div>
      <?php }; ?>
      <?php if($staff_date){ ?>
      <p class="date"><?php echo esc_html($staff_date); ?></p>
      <?php }; ?>
      <?php } else { ?>
      <p class="title"><?php the_title(); ?></p>
      <?php }; ?>
     </div>
    </a>
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .staff_list_type1 -->
  </div><!-- END .staff_carousel_type1 -->
  <div class="staff_carousel_prev<?php echo $i; ?> swiper-nav-button swiper-button-prev"></div>
  <div class="staff_carousel_next<?php echo $i; ?> swiper-nav-button swiper-button-next"></div>
 </div><!-- END .staff_carousel_wrap_type1 -->

</div><!-- END .staff_carousel -->
<?php
       endif;
     };
     endfor;
?>