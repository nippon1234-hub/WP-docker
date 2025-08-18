<?php
     get_header();
     $options = get_design_plus_option();
     $query_obj = get_queried_object();
     $current_cat_id = $query_obj->term_id;
     $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
     $headline = $options['archive_news_headline'];
     $sub_title = isset($query_obj->name) ? $query_obj->name : $options['archive_news_sub_title'];
     $desc = isset($query_obj->description) ? $query_obj->description : $options['archive_news_desc'];
     $desc_mobile = !empty($term_meta['desc_mobile']) ? $term_meta['desc_mobile'] : '';
?>
<div id="page_header">

 <?php if($headline){ ?>
 <h1 class="headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h1>
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

<?php get_template_part('template-parts/breadcrumb'); ?>
<section id="archive_news">

<?php if ($options['archive_news_show_category_list'] == 'display' ) {
  get_template_part('template-parts/category_sort'); 
 }?>

 <?php if ( have_posts() ) : ?>

 <div class="news_list">
  <?php
       $i = 1;
       while ( have_posts() ) : the_post();
         if($options['news_show_image'] == 'display'){
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
           } elseif($options['no_image']) {
             $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
           } else {
             $image = array();
             $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
             $image[1] = '715';
             $image[2] = '410';
           }
         };
  ?>
  <a class="item animate_background" href="<?php the_permalink(); ?>">
   <?php if($options['news_show_image'] == 'display'){ ?>
   <div class="image_wrap">
    <img class="image" <?php if(!wp_is_mobile() || (wp_is_mobile() && $i > 1)){ ?>loading="lazy" fetchpriority="low" <?php }; ?>src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
   <?php }; ?>
   <div class="content">
    <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <h2 class="title"><span><?php the_title(); ?></span></h2>
   </div>
  </a>
  <?php $i++; endwhile; ?>
 </div><!-- END .news_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-issue');  ?></p>

 <?php endif; ?>

</section><!-- END #archive_news -->

<?php get_footer(); ?>