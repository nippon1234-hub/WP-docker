<?php
     get_header();
     $options = get_design_plus_option();
     if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

<div id="page_contents">

 <div class="post_content clearfix">

   <?php
        // アイキャッチ画像 -----------------------------------
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
   ?>
   <img style="display:block; margin:0 auto;" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />

 </div>

</div><!-- END #page_contents -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>