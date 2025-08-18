<?php
     get_header();
     $options = get_design_plus_option();
     $query_obj = get_queried_object();
     $current_cat_id = $query_obj->term_id;
     $headline = $options['archive_interview_headline'];
     $sub_title = $options['archive_interview_sub_title'];
     $desc = $options['archive_interview_desc'];
     $desc_mobile = $options['archive_interview_desc_mobile'];
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

<section id="archive_interview">

 <?php
      // カテゴリーソートタブ ----------------------------------------------------------------
      $category = get_terms( 'interview_category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true) );
      if ($category) {
        $total = count($category);
 ?>
 <div id="interview_category_sort_<?php echo esc_attr($options['interview_category_type']); ?>_wrap">
  <div id="interview_category_sort_<?php echo esc_attr($options['interview_category_type']); ?>" class="swiper<?php if($total < 4){ echo ' small_size'; }; ?>">
   <div class="interview_category_sort_button swiper-wrapper">
    <?php
         $i = 1;
         foreach ( $category as $cat ) :
           $cat_id = $cat->term_id;
    ?>
    <div class="item swiper-slide<?php if($cat_id == $current_cat_id){ echo ' current_category_menu active_menu'; }; ?>">
     <a data-category-id="#ajax_post_cat_<?php echo esc_attr($cat_id); ?>" href="#category_content<?php echo $i; ?>" class="no_auto_scroll" data-filter="#category_content<?php echo $i; ?>"><p><span><?php echo esc_html($cat->name); ?></span></p></a>
    </div>
    <?php $i++; endforeach; ?>
   </div>
  </div>
  <div class="interview_category_sort_button_prev swiper-nav-button type2 swiper-button-prev"></div>
  <div class="interview_category_sort_button_next swiper-nav-button type2 swiper-button-next"></div>
 </div>
 <?php }; ?>

 <div id="interview_list_wrap">

  <?php
       if(wp_is_mobile()){
         $post_num = $options['archive_interview_num_sp'];
       } else {
         $post_num = $options['archive_interview_num'];
       };
       if (!$category) {
  ?>

  <div class="ajax_post_list_wrap interview_content" id="ajax_post_cat_all">

   <div class="interview_content_inner">

    <?php
         $args = array( 'post_status' => 'publish', 'post_type' => 'interview', 'posts_per_page' => $post_num, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC') );
         $post_list = new wp_query($args);
         $all_post_count = $post_list->found_posts;
         if($post_list->have_posts()):
    ?>
    <div class="interview_list ajax_post_list">
     <?php
          $i = 1;
          while( $post_list->have_posts() ) : $post_list->the_post();
            if(has_post_thumbnail()) {
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
              $image_sp = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
            } elseif($options['no_image']) {
              $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
              $image_sp = '';
            } else {
              $image = array();
              $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
              $image[1] = '960';
              $image[2] = '400';
              $image_sp = '';
            }
            $total_interviewer = 0;
            for($i = 1; $i <= 6; $i++) :
              $last_name = get_post_meta($post->ID, 'interview_last_name' . $i, true);
              if($last_name){
                $total_interviewer++;
              }
            endfor;
            $interview_category = wp_get_post_terms( $post->ID, 'interview_category' , array( 'orderby' => 'term_order' ));
     ?>
     <div class="item" style="opacity:1;">
      <?php
           if ( $interview_category ) {
             foreach ( $interview_category as $cat ) :
               $cat_name = $cat->name;
               $cat_id = $cat->term_id;
               $cat_url = get_term_link($cat_id,'interview_category');
               break;
             endforeach;
      ?>
      <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
      <?php }; ?>
      <a class="link" href="<?php the_permalink(); ?>">
       <picture class="image_wrap">
        <?php if($image_sp){ ?>
        <source media="(max-width: 650px)" srcset="<?php echo esc_attr($image_sp[0]); ?>">
        <?php }; ?>
        <img class="image" <?php if(!wp_is_mobile() || (wp_is_mobile() && $i > 1)){ ?>loading="lazy" fetchpriority="low" <?php } else { ?>fetchpriority="high" <?php }; ?>src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
       </picture>
       <div class="title_area">
        <h2 class="title"><span><?php the_title(); ?></span></h2>
        <?php if ($options['interview_show_date'] == 'display'){ ?>
        <div class="date_area">
         <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
        </div>
        <?php }; ?>
       </div>
       <?php if($total_interviewer != 0){ ?>
       <div class="interviewer<?php if($total_interviewer == 2 || $total_interviewer == 4){ echo ' type2'; } elseif($total_interviewer == 3 || $total_interviewer == 5 || $total_interviewer == 6){ echo ' type3'; }; ?>">
        <?php
             for($i = 1; $i <= 6; $i++) :
               $last_name = get_post_meta($post->ID, 'interview_last_name' . $i, true);
               if($last_name){
                 $first_name = get_post_meta($post->ID, 'interview_first_name' . $i, true);
                 $department = get_post_meta($post->ID, 'interview_department' . $i, true);
                 $occupation = get_post_meta($post->ID, 'interview_occupation' . $i, true);
        ?>
        <div class="interviewer_item">
         <?php if($last_name){ ?>
         <p class="name"><span><?php echo esc_html($last_name); ?></span><?php if($first_name){ ?><span><?php echo esc_html($first_name); ?></span><?php }; ?></p>
         <?php }; ?>
         <?php if($department){ ?>
         <p class="department"><?php echo esc_html($department); ?></p>
         <?php }; ?>
         <?php if($occupation){ ?>
         <p class="occupation"><?php echo esc_html($occupation); ?></p>
         <?php }; ?>
        </div>
        <?php }; endfor; ?>
       </div>
       <?php }; ?>
      </a>
     </div>
     <?php $i++; endwhile; wp_reset_query(); ?>
    </div><!-- END .interview_list -->
    <?php endif; ?>

   </div><!-- END .interview_content_inner -->

   <?php if($all_post_count > $post_num) { ?>
   <div class="entry-more" data-catid="" data-offset-post="<?php echo esc_attr($post_num); ?>">
    <span class="design_button"><?php _e( 'Load more', 'tcd-issue' ); ?></span>
   </div>
   <div class="entry-loading"><?php _e( 'LOADING...', 'tcd-issue' ); ?></div>
   <?php }; ?>

  </div><!-- END .interview_content -->

  <?php
       } else {
         $category_count = 1;
         foreach ( $category as $cat ) :
           $cat_id = $cat->term_id;
  ?>
  <div class="ajax_post_list_wrap interview_content<?php if($cat_id == $current_cat_id){ echo ' active'; }; ?>" id="ajax_post_cat_<?php echo esc_attr($cat_id); ?>">

   <div class="interview_content_inner">

    <?php
         $args = array( 'post_status' => 'publish', 'post_type' => 'interview', 'posts_per_page' => $post_num, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'tax_query' => array( array( 'taxonomy' => 'interview_category', 'field' => 'term_id', 'terms' => $cat_id ), ) );
         $post_list = new wp_query($args);
         $all_post_count = $post_list->found_posts;
         if($post_list->have_posts()):
    ?>
    <div class="interview_list ajax_post_list">
     <?php
          $i = 1;
          while( $post_list->have_posts() ) : $post_list->the_post();
            if(has_post_thumbnail()) {
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
              $image_sp = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
            } elseif($options['no_image']) {
              $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
              $image_sp = '';
            } else {
              $image = array();
              $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
              $image[1] = '960';
              $image[2] = '400';
              $image_sp = '';
            }
            $total_interviewer = 0;
            for($i = 1; $i <= 6; $i++) :
              $last_name = get_post_meta($post->ID, 'interview_last_name' . $i, true);
              if($last_name){
                $total_interviewer++;
              }
            endfor;
            $interview_category = wp_get_post_terms( $post->ID, 'interview_category' , array( 'orderby' => 'term_order' ));
     ?>
     <div class="item" style="opacity:1;">
      <?php
           if ( $interview_category ) {
             foreach ( $interview_category as $cat ) :
               $cat_name = $cat->name;
               $cat_id = $cat->term_id;
               $cat_url = get_term_link($cat_id,'interview_category');
               break;
             endforeach;
      ?>
      <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
      <?php }; ?>
      <a class="link" href="<?php the_permalink(); ?>">
       <picture class="image_wrap">
        <?php if($image_sp){ ?>
        <source media="(max-width: 650px)" srcset="<?php echo esc_attr($image_sp[0]); ?>">
        <?php }; ?>
        <img class="image" <?php if(!wp_is_mobile() || (wp_is_mobile() && $i > 1)){ ?>loading="lazy" fetchpriority="low" <?php } else { ?>fetchpriority="high" <?php }; ?>src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
       </picture>
       <div class="title_area">
        <h2 class="title"><span><?php the_title(); ?></span></h2>
        <?php if ($options['interview_show_date'] == 'display'){ ?>
        <div class="date_area">
         <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
        </div>
        <?php }; ?>
       </div>
       <?php if($total_interviewer != 0){ ?>
       <div class="interviewer<?php if($total_interviewer == 2 || $total_interviewer == 4){ echo ' type2'; } elseif($total_interviewer == 3 || $total_interviewer == 5 || $total_interviewer == 6){ echo ' type3'; }; ?>">
        <?php
             for($i = 1; $i <= 6; $i++) :
               $last_name = get_post_meta($post->ID, 'interview_last_name' . $i, true);
               if($last_name){
                 $first_name = get_post_meta($post->ID, 'interview_first_name' . $i, true);
                 $department = get_post_meta($post->ID, 'interview_department' . $i, true);
                 $occupation = get_post_meta($post->ID, 'interview_occupation' . $i, true);
        ?>
        <div class="interviewer_item">
         <?php if($last_name){ ?>
         <p class="name"><span><?php echo esc_html($last_name); ?></span><?php if($first_name){ ?><span><?php echo esc_html($first_name); ?></span><?php }; ?></p>
         <?php }; ?>
         <?php if($department){ ?>
         <p class="department"><?php echo esc_html($department); ?></p>
         <?php }; ?>
         <?php if($occupation){ ?>
         <p class="occupation"><?php echo esc_html($occupation); ?></p>
         <?php }; ?>
        </div>
        <?php }; endfor; ?>
       </div>
       <?php }; ?>
      </a>
     </div>
     <?php $i++; endwhile; wp_reset_query(); ?>
    </div><!-- END .interview_list -->
    <?php endif; ?>

   </div><!-- END .interview_content_inner -->

   <?php if($all_post_count > $post_num) { ?>
   <div class="entry-more" data-catid="<?php echo esc_attr($cat_id); ?>" data-offset-post="<?php echo esc_attr($post_num); ?>">
    <span class="design_button"><?php _e( 'Load more', 'tcd-issue' ); ?></span>
   </div>
   <div class="entry-loading"><?php _e( 'LOADING...', 'tcd-issue' ); ?></div>
   <?php }; ?>

  </div><!-- END .interview_content -->
  <?php $category_count++; endforeach; }; ?>

 </div><!-- END .interview_list_wrap -->

</section><!-- END #archive_interview -->

<?php get_footer(); ?>