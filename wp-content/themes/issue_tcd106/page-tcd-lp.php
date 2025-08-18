<?php
/*
Template Name:Landing page
*/
__('Landing page', 'tcd-issue');
     get_header();
     $options = get_design_plus_option();
     $headline = get_post_meta($post->ID, 'header_headline', true) ?  get_post_meta($post->ID, 'header_headline', true) : get_the_title();
     $sub_title = get_post_meta($post->ID, 'header_sub_title', true) ?  get_post_meta($post->ID, 'header_sub_title', true) : '';
     $desc = get_post_meta($post->ID, 'header_desc', true) ?  get_post_meta($post->ID, 'header_desc', true) : '';
     $desc_mobile = get_post_meta($post->ID, 'header_desc_mobile', true) ?  get_post_meta($post->ID, 'header_desc_mobile', true) : '';
     $image = wp_get_attachment_image_src(get_post_meta($post->ID, 'header_image', true), 'full');
     $image_sp = wp_get_attachment_image_src(get_post_meta($post->ID, 'header_image', true), 'medium_large');
     $overlay_color = get_post_meta($post->ID, 'header_overlay_color', true) ?  get_post_meta($post->ID, 'header_overlay_color', true) : '#000000';
     $overlay_color = hex2rgb($overlay_color);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = get_post_meta($post->ID, 'header_overlay_color_opacity', true) ?  get_post_meta($post->ID, 'header_overlay_color_opacity', true) : '0.3';
     if($overlay_opacity == 'zero'){
       $overlay_opacity = '0';
     }
     $hide_page_header = get_post_meta($post->ID, 'hide_page_header', true) ?  get_post_meta($post->ID, 'hide_page_header', true) : 'no';
     if($hide_page_header != 'yes' && $image){
?>
<div id="lp_page_header" class="logo_change_trigger">

 <div class="content">

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

 <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>

 <picture class="bg_image">
  <source media="(max-width: 600px)" srcset="<?php echo esc_attr($image_sp[0]); ?>">
  <img fetchpriority="high" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
 </picture>

</div>
<?php } elseif($hide_page_header != 'yes' && !$image){ ?>
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
<?php }; ?>

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