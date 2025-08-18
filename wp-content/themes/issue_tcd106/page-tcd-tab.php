<?php
/*
Template Name:Tab page
*/
__('Tab page', 'tcd-issue');
     get_header();
     $options = get_design_plus_option();
     $query_obj = get_queried_object();
     $current_page_id = $query_obj->ID;
     $parent_page_id = $query_obj->post_parent;
     if($parent_page_id == 0){
       $parent_page_title = get_the_title($current_page_id);
       $headline = get_post_meta($current_page_id, 'header_headline', true) ?  get_post_meta($current_page_id, 'header_headline', true) : get_the_title();
       $sub_title = get_post_meta($current_page_id, 'header_sub_title', true) ?  get_post_meta($current_page_id, 'header_sub_title', true) : '';
       $desc = get_post_meta($current_page_id, 'header_desc', true) ?  get_post_meta($current_page_id, 'header_desc', true) : '';
       $desc_mobile = get_post_meta($current_page_id, 'header_desc_mobile', true) ?  get_post_meta($current_page_id, 'header_desc_mobile', true) : '';
     } else {
       $parent_page_title = get_the_title($parent_page_id);
       $headline = get_post_meta($parent_page_id, 'header_headline', true) ?  get_post_meta($parent_page_id, 'header_headline', true) : get_the_title();
       $sub_title = get_post_meta($parent_page_id, 'header_sub_title', true) ?  get_post_meta($parent_page_id, 'header_sub_title', true) : '';
       $desc = get_post_meta($parent_page_id, 'header_desc', true) ?  get_post_meta($parent_page_id, 'header_desc', true) : '';
       $desc_mobile = get_post_meta($parent_page_id, 'header_desc_mobile', true) ?  get_post_meta($parent_page_id, 'header_desc_mobile', true) : '';
     }
?>
<div id="page_header">

 <?php if($headline){ ?>
 <h1 class="headline"><?php echo esc_html($headline); ?></h1>
 <?php }; ?>

 <?php if($sub_title){ ?>
 <p class="sub_title"><?php echo esc_html($sub_title); ?></p>
 <?php }; ?>

 <?php if(!is_paged() && $desc){ ?>
 <div class="desc<?php if($desc_mobile){ echo ' pc'; }; ?>">
  <div class="post_content clearfix">
   <?php echo wp_kses_post(nl2br($desc)); ?>
  </div>
 </div>
 <?php if($desc_mobile){ ?>
 <div class="desc mobile">
  <div class="post_content clearfix">
   <?php echo wp_kses_post(nl2br($desc_mobile)); ?>
  </div>
 </div>
 <?php }; ?>
 <?php }; ?>

</div>

<?php
     if($parent_page_id == 0){
       $args = array('post_type' => 'page', 'post_parent'=> $current_page_id, 'order' => 'ASC', 'orderby' => 'menu_order', 'posts_per_page' => -1);
     } else {
       $args = array('post_type' => 'page', 'post_parent'=> $parent_page_id, 'order' => 'ASC', 'orderby' => 'menu_order', 'posts_per_page' => -1);
     }
     $child_pages = new WP_Query($args);
     if ($child_pages->have_posts()) :
?>
<div class="tab_page_header">
 <div id="category_sort_button_wrap">
  <div id="category_sort_button_slider" class="swiper">
   <div id="category_sort_button" class="swiper-wrapper">
    <div class="item swiper-slide<?php if($parent_page_id == 0){ echo ' active_menu'; }; ?>">
     <a class="no_auto_scroll" href="<?php if($parent_page_id == 0){ echo esc_url(get_permalink($current_page_id)); } else { echo esc_url(get_permalink($parent_page_id)); }; ?>"><?php echo esc_html($parent_page_title); ?></a>
    </div>
    <?php while ($child_pages->have_posts()) : $child_pages->the_post(); ?>
    <div class="item swiper-slide<?php if($parent_page_id != 0 && $post->ID == $current_page_id){ echo ' active_menu'; }; ?>">
     <a class="no_auto_scroll" href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php the_title(); ?></a>
    </div>
    <?php endwhile; ?>
   </div>
  </div>
  <div class="category_sort_button_prev swiper-nav-button type2 swiper-button-prev"></div>
  <div class="category_sort_button_next swiper-nav-button type2 swiper-button-next"></div>
 </div>
</div>
<?php endif; wp_reset_query(); ?>

<article id="page_contents">

 <div class="post_content clearfix">
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>

</article><!-- END #page_contents -->

<?php get_footer(); ?>