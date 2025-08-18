<?php
     get_header();
     $options = get_design_plus_option();
     $bg_image = wp_get_attachment_image_src($options['page_404_bg_image'], 'full');
     $bg_image_sp = wp_get_attachment_image_src($options['page_404_bg_image'], 'size4');
     $overlay_color = hex2rgb($options['page_404_overlay_color']);
     $overlay_opacity = $options['page_404_overlay_opacity'];
     $overlay_color = implode(",",$overlay_color);
?>

<div id="no_search_result"<?php if($bg_image){ echo ' class="logo_change_trigger"'; }; ?>>

 <div class="content">
  <h2 class="headline"><?php if($options['page_404_headline']){ echo nl2br(esc_html($options['page_404_headline'])); } else { echo '404 NOT FOUND'; }; ?></h2>
  <?php if ($options['page_404_desc']) { ?>
  <div class="desc item"><?php echo apply_filters('the_content', $options['page_404_desc'] ); ?></div>
  <?php } ?>
 </div>

 <?php if($options['page_404_overlay_opacity'] != 0 && !empty($bg_image)){ ?>
 <div class="overlay" style="background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <?php }; ?>

 <?php if(!empty($bg_image)) { ?>
 <picture class="bg_image">
  <source media="(max-width: 600px)" srcset="<?php echo esc_attr($bg_image_sp[0]); ?>">
  <img fetchpriority="high" src="<?php echo esc_attr($bg_image[0]); ?>" alt="" width="<?php echo esc_attr($bg_image[1]); ?>" height="<?php echo esc_attr($bg_image[2]); ?>">
 </picture>
 <?php }; ?>

</div>

<?php get_footer(); ?>