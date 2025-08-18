<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_news_headline'];
     $sub_title = $options['archive_news_sub_title'];
     $desc = $options['archive_news_desc'];
     $desc_mobile = $options['archive_news_desc_mobile'];
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
                    echo '<span data-href="'.$cate_url.'">'.$cate_name.'</span>'."\n";
                }
    ?>
        </div>
    <?php
            }
        }
    ?>
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