<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_blog_headline'];
     $sub_title = $options['archive_blog_sub_title'];
     $desc = $options['archive_blog_desc'];
     $desc_mobile = $options['archive_blog_desc_mobile'];
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

<section id="archive_blog">
<?php if ($options['archive_blog_show_category_list'] == 'display' ) {
  get_template_part('template-parts/category_sort'); 
 }?>

 <?php if ( have_posts() ) : ?>

 <div class="blog_list">
  <?php
       $i = 1;
       while ( have_posts() ) : the_post();
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
         $post_category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
  ?>
  <div class="item">
   <?php if($post_category || $options['blog_show_date'] == 'display') { ?>
   <div class="meta">
    <?php
         if ( $post_category ) {
           foreach ( $post_category as $cat ) :
             $cat_name = $cat->name;
             $cat_id = $cat->term_id;
             $cat_url = get_term_link($cat_id,'category');
             break;
           endforeach;
    ?>
    <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
    <?php }; ?>
    <?php if($options['blog_show_date'] == 'display'){ ?>
    <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <?php }; ?>
   </div>
   <?php }; ?>
   <a class="animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <img class="image" <?php if(!wp_is_mobile() || (wp_is_mobile() && $i > 1)){ ?>loading="lazy" fetchpriority="low" <?php }; ?>src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <div class="content">
     <h2 class="title"><span><?php the_title(); ?></span></h2>
    </div>
   </a>
  </div>
  <?php $i++; endwhile; ?>
 </div><!-- END .blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-issue');  ?></p>

 <?php endif; ?>


</section><!-- END #archive_blog -->

<?php get_footer(); ?>