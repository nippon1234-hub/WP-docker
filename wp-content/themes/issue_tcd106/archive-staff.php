<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_staff_headline'];
     $sub_title = $options['archive_staff_sub_title'];
     $desc = $options['archive_staff_desc'];
     $desc_mobile = $options['archive_staff_desc_mobile'];
?>
<div id="page_header">

 <?php if($headline){ ?>
 <h1 class="headline"><?php echo esc_html($headline); ?></h1>
 <?php }; ?>

 <?php if($sub_title){ ?>
 <p class="sub_title"><?php echo esc_html($sub_title); ?></p>
 <?php }; ?>

 <?php if(!is_paged() && $desc){ ?>
 <div class="desc<?php if($desc_mobile){ echo ' pc'; }; ?> post_content">
  <?php echo wp_kses_post(nl2br($desc)); ?>
 </div>
 <?php if($desc_mobile){ ?>
 <div class="desc mobile post_content">
  <?php echo wp_kses_post(nl2br($desc_mobile)); ?>
 </div>
 <?php }; ?>
 <?php }; ?>

</div>

<section id="archive_staff">

 <?php
      // カテゴリーソートタブ ----------------------------------------------------------------
      $category = get_terms( 'staff_category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true) );
      if ($category) {
 ?>
 <div id="category_sort_button_wrap">
  <div id="category_sort_button_slider" class="swiper">
   <div id="category_sort_button" class="swiper-wrapper">
    <div class="item swiper-slide active_menu">
     <a href="<?php echo esc_url(get_post_type_archive_link('staff')); ?>" class="no_auto_scroll"><?php _e( 'All', 'tcd-issue' ); ?></a>
    </div>
    <?php
         $i = 1;
         foreach ( $category as $cat ) :
           $cat_id = $cat->term_id;
           $cat_url = get_term_link($cat_id,'staff_category');
    ?>
    <div class="item swiper-slide">
     <a href="<?php echo esc_url($cat_url); ?>" class="no_auto_scroll"><?php echo esc_html($cat->name); ?></a>
    </div>
    <?php $i++; endforeach; ?>
   </div>
  </div>
  <div class="category_sort_button_prev swiper-nav-button type2 swiper-button-prev"></div>
  <div class="category_sort_button_next swiper-nav-button type2 swiper-button-next"></div>
 </div>
 <?php }; ?>

 <?php if ( have_posts() ) : ?>

 <div class="staff_list_<?php echo esc_html($options['staff_design_type']); ?>">
  <?php
       $i = 1;
       while ( have_posts() ) : the_post();
       if(has_post_thumbnail()) {
         if($options['staff_design_type'] == 'type1'){
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
         } else {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size5' );
         }
       } elseif($options['no_image']) {
         $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
       } else {
         $image = array();
         $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
         if($options['staff_design_type'] == 'type1'){
           $image[1] = '680';
           $image[2] = '940';
         } else {
           $image[1] = '1034';
           $image[2] = '500';
         }
       }
       $post_category = wp_get_post_terms( $post->ID, 'staff_category' , array( 'orderby' => 'term_order' ));
       $staff_name = get_post_meta($post->ID, 'staff_name', true);
       $staff_job = get_post_meta($post->ID, 'staff_job', true);
       $staff_date = get_post_meta($post->ID, 'staff_date', true);
       $staff_catch = get_post_meta($post->ID, 'staff_catch', true);
  ?>
  <a class="item animate_background" href="<?php the_permalink(); ?>">
   <div class="image_wrap staff_list_image<?php if($options['staff_design_type'] == 'type1'){ echo ' mouse_stalker_element'; }; ?>">
    <?php if($options['staff_design_type'] == 'type1' && ($staff_name || $staff_job || $staff_date)){ ?>
    <h2 class="mouse_stalker_target"><?php the_title(); ?></h2>
    <?php }; ?>
    <img class="image" <?php if(!wp_is_mobile() || (wp_is_mobile() && $i > 1)){ ?>loading="lazy" fetchpriority="low" <?php }; ?>src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
   <?php if($options['staff_design_type'] == 'type2'){ ?>
   <div class="title_area">
    <h2 class="title"><span><?php the_title(); ?></span></h2>
   </div>
   <?php }; ?>
   <?php if( $options['staff_design_type'] == 'type1' || ($options['staff_design_type'] == 'type2' && ($staff_name || $staff_job || $staff_date)) ){ ?>
   <div class="content">
   <?php }; ?>
    <?php if($staff_name || $staff_job || $staff_date){ ?>
    <?php if($staff_name){ ?>
    <p class="name"><?php echo esc_html($staff_name); ?></p>
    <?php }; ?>
    <?php if($staff_job){ ?>
    <div class="job_area">
     <p class="job"><?php echo esc_html($staff_job); ?></p>
    </div>
    <?php }; ?>
    <?php if($options['staff_design_type'] == 'type1' && $staff_date){ ?>
    <p class="date"><?php echo esc_html($staff_date); ?></p>
    <?php }; ?>
    <?php } elseif($options['staff_design_type'] == 'type1') { ?>
    <p class="title"><?php the_title(); ?></p>
    <?php }; ?>
   <?php if( $options['staff_design_type'] == 'type1' || ($options['staff_design_type'] == 'type2' && ($staff_name || $staff_job || $staff_date)) ){ ?>
   </div>
   <?php }; ?>
  </a>
  <?php $i++; endwhile; ?>
 </div><!-- END .staff_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-issue');  ?></p>

 <?php endif; ?>

</section><!-- END #archive_staff -->

<?php get_footer(); ?>