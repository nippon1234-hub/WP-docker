<?php
     get_header();
     $options = get_design_plus_option();
     $headline = 'SEARCH';
     $sub_title = sprintf( __( 'Search result for %s', 'tcd-issue' ), get_search_query() );

     // 検索結果がある場合
     if ( isset($_GET['s']) && !empty($_GET['s']) && have_posts() ) :
?>
<div id="page_header">

 <?php if($headline){ ?>
 <h1 class="headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h1>
 <?php }; ?>

 <?php if($sub_title){ ?>
 <p class="sub_title"><?php echo esc_html($sub_title); ?></p>
 <?php }; ?>

</div>

<div id="archive_blog">

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
  ?>
  <div class="item" style="opacity:1; transform:none;">
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

</div><!-- END #archive_blog -->

<?php
     else:

     // 検索結果が無い場合、もしくはキーワードが空の場合 --------------------------------------------------------------------
     $bg_image = wp_get_attachment_image_src($options['search_result_bg_image'], 'full');
     $bg_image_sp = wp_get_attachment_image_src($options['search_result_bg_image'], 'size4');
     $overlay_color = hex2rgb($options['search_result_overlay_color']);
     $overlay_opacity = $options['search_result_overlay_opacity'];
     $overlay_color = implode(",",$overlay_color);
?>

<div id="no_search_result"<?php if($bg_image){ echo ' class="logo_change_trigger"'; }; ?>>

 <div class="content">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo nl2br(esc_html($headline)); ?></h2>
  <?php } ?>
  <?php if ($options['search_result_desc']) { ?>
<div class="desc"><?php if(empty($_GET['s'])){ echo __( 'Search keyword is blank.', 'tcd-homme' ); } else { echo apply_filters('the_content', $options['search_result_desc'] );  }; ?></div>
  <?php } ?>
  <div class="search_form">
   <form role="search" method="get" action="<?php echo esc_url(home_url()); ?>">
    <div class="input_area"><input <?php if($options['search_result_placeholder']){ echo 'placeholder="' . esc_html($options['search_result_placeholder']) . '"'; }; ?> type="text" value="" name="s" autocomplete="off"></div>
    <div class="search_button"><label for="no_search_result_button"></label><input type="submit" id="no_search_result_button" value=""></div>
   </form>
  </div>
 </div>

 <?php if(!empty($bg_image) && $options['search_result_overlay_opacity'] != 0){ ?>
 <div class="overlay" style="background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <?php }; ?>

 <?php if(!empty($bg_image)) { ?>
 <picture class="bg_image">
  <source media="(max-width: 600px)" srcset="<?php echo esc_attr($bg_image_sp[0]); ?>">
  <img fetchpriority="high" src="<?php echo esc_attr($bg_image[0]); ?>" alt="" width="<?php echo esc_attr($bg_image[1]); ?>" height="<?php echo esc_attr($bg_image[2]); ?>">
 </picture>
 <?php }; ?>

</div>

<?php endif; ?>

<?php get_footer(); ?>