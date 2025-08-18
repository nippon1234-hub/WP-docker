<?php
     get_header();
     $options = get_design_plus_option();
     if ( have_posts() ) : while ( have_posts() ) : the_post();

       if(has_post_thumbnail()) {
         $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
         $image_sp = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
       } elseif($options['no_image']) {
         $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         $image_sp = '';
       } else {
         $image = array();
         $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
         $image[1] = '1450';
         $image[2] = '600';
         $image_sp = '';
       }
       $post_category = wp_get_post_terms( $post->ID, 'interview_category' , array( 'orderby' => 'term_order' ));
       if ( $post_category ) {
         foreach ( $post_category as $cat ) :
           $cat_name = $cat->name;
           $cat_id = $cat->term_id;
           $cat_url = get_term_link($cat_id,'interview_category');
           break;
         endforeach;
       }
       $overlay_color = hex2rgb($options['interview_header_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['interview_header_overlay_opacity'];
?>
<article id="single_interview">

 <div id="interview_header" class="logo_change_trigger">

  <?php if ($post_category) { ?>
  <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
  <?php }; ?>

  <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>

  <picture class="main_image">
   <source media="(max-width: 650px)" srcset="<?php echo esc_attr($image_sp[0]); ?>">
   <img fetchpriority="high" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
  </picture>

 </div><!-- END #interview_header -->

 <div id="interview_main_content">

  <h1 id="interview_title" class="entry-title"><span><?php the_title(); ?></span></h1>

  <?php if ($options['interview_show_date'] == 'display'){ ?>
  <div class="date_area">
   <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
   <?php
        $post_date = get_the_time('Ymd');
        $modified_date = get_the_modified_date('Ymd');
        if($post_date < $modified_date && $options['single_interview_show_mod_date'] == 'display'){
   ?>
   <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
   <?php }; ?>
  </div>
  <?php }; ?>

  <?php
       $headline = get_post_meta($post->ID, 'interview_title', true);
       $sub_title = get_post_meta($post->ID, 'interview_sub_title', true);
       $total_interviewer = 0;
       for($i = 1; $i <= 6; $i++) :
         $last_name = get_post_meta($post->ID, 'interview_last_name' . $i, true);
         if($last_name){
           $total_interviewer++;
         }
       endfor;
  ?>
  <div id="interview_info">
   <?php if($headline || $sub_title){ ?>
   <div class="headline_area">
    <?php if($headline){ ?>
    <h2 class="headline"><?php echo esc_html($headline); ?></h2>
    <?php }; ?>
    <?php if($sub_title){ ?>
    <p class="sub_title"><?php echo esc_html($sub_title); ?></p>
    <?php }; ?>
   </div>
   <?php }; ?>
   <?php if($total_interviewer != 0){ ?>
   <div class="interviewer<?php if($total_interviewer == 2 || $total_interviewer == 4){ echo ' type2'; } elseif($total_interviewer == 3 || $total_interviewer == 5 || $total_interviewer == 6){ echo ' type3'; }; ?>">
    <?php
         for($i = 1; $i <= 6; $i++) :
           $last_name = get_post_meta($post->ID, 'interview_last_name' . $i, true);
           if($last_name){
             $first_name = get_post_meta($post->ID, 'interview_first_name' . $i, true);
             $department = get_post_meta($post->ID, 'interview_department' . $i, true);
             $occupation = get_post_meta($post->ID, 'interview_occupation' . $i, true);
             $position = get_post_meta($post->ID, 'interview_position' . $i, true);
    ?>
    <div class="interviewer_item">
     <?php if($last_name){ ?>
     <h3 class="name"><span><?php echo esc_html($last_name); ?></span><?php if($first_name){ ?><span><?php echo esc_html($first_name); ?></span><?php }; ?></h3>
     <?php }; ?>
     <?php if($department || $occupation){ ?>
     <p class="department"><?php if($department) { echo '<span>' . esc_html($department) . '</span>'; }; if($occupation) { echo '<span>' . esc_html($occupation) . '</span>'; }; ?></p>
     <?php }; ?>
     <?php if($position){ ?>
     <p class="position"><?php echo esc_html($position); ?></p>
     <?php }; ?>
    </div>
    <?php }; endfor; ?>
   </div>
   <?php }; ?>
  </div>

   <?php
        // 追加コンテンツ（上） ------------------------------------------------------------------------------------------------------------------------
        if(!wp_is_mobile()) {
          if( $options['single_interview_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_interview_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        } else {
          if( $options['single_interview_top_ad_code_mobile']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_interview_top_ad_code_mobile']; ?>
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
         if( $options['single_interview_bottom_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_interview_bottom_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       } else {
         if( $options['single_interview_bottom_ad_code_mobile'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner">
   <?php echo $options['single_interview_bottom_ad_code_mobile']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

  <div class="link_button">
   <a class="design_button" href="<?php echo esc_url(get_post_type_archive_link('interview')); ?>"><?php _e('Article list', 'tcd-issue'); ?></a>
  </div>

 </div><!-- END #interview_main_content -->

</article>

<?php endwhile; endif; ?>

<?php
     // カルーセル ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     for ( $i = 1; $i <= 3; $i++ ):

     if($options['related_interview_headline'.$i]){

     $post_num = $options['related_interview_num'.$i];
     if(wp_is_mobile()){
       $post_num = $options['related_interview_num'.$i.'_sp'];
     }
     $post_order = $options['related_interview_post_order'.$i];
     if($post_order == 'menu_order'){
       $post_order = array();
       $post_order['menu_order'] = 'ASC';
       $post_order['date'] = 'DESC';
     }
     $post_type = $options['related_interview_post_type'.$i];
     if ( $post_type == 'category_post' && $post_category) {
       $args = array( 'post_status' => 'publish', 'post_type' => 'interview', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'staff_category', 'field' => 'term_id', 'terms' => $cat_id ), ) );
     } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
       $args = array('post_type' => 'interview', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
     } elseif ( $post_type == 'custom' ) {
       $post_ids = $options['related_interview_post_order_custom'.$i];
       $post_ids_array = array_map('intval', explode(',', $post_ids));
       $args = array( 'post_status' => 'publish', 'post_type' => 'interview', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
     } else {
       $args = array( 'post_status' => 'publish', 'post_type' => 'interview', 'posts_per_page' => $post_num, 'orderby' => $post_order );
     }
     $staff_carousel = new wp_query($args);
     if($staff_carousel->have_posts()):
?>
<div class="related_interview">

 <h2 class="headline"><?php echo esc_html($options['related_interview_headline'.$i]); ?></h2>

 <div class="related_interview_carousel_wrap">
  <div class="related_interview_carousel<?php echo $i; ?> swiper">
   <div class="post_list swiper-wrapper">
    <?php
         while( $staff_carousel->have_posts() ) : $staff_carousel->the_post();
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size6' );
          } elseif($options['no_image']) {
            $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
          } else {
            $image = array();
            $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
            $image[1] = '460';
            $image[2] = '190';
          }
          $post_category = wp_get_post_terms( $post->ID, 'interview_category' , array( 'orderby' => 'term_order' ));
          if ( $post_category ) {
            foreach ( $post_category as $cat ) :
              $cat_name = $cat->name;
              $cat_id = $cat->term_id;
              $cat_url = get_term_link($cat_id,'interview_category');
              break;
            endforeach;
          }
    ?>
    <div class="item swiper-slide">
     <?php if($post_category){ ?>
     <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
     <?php }; ?>
     <a class="link animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <div class="title_area">
       <h3 class="title"><span><?php the_title(); ?></span></h3>
      </div>
     </a>
    </div>
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .post_list -->
  </div><!-- END .related_interview_carousel -->
  <div class="interview_carousel_prev<?php echo $i; ?> swiper-nav-button swiper-button-prev"></div>
  <div class="interview_carousel_next<?php echo $i; ?> swiper-nav-button swiper-button-next"></div>
 </div><!-- END .related_interview_carousel_wrap -->

</div><!-- END .related_interview -->
<?php
       endif;
     };
     endfor;
?>

<?php get_footer(); ?>