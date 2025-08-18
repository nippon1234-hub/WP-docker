<?php
     get_header();
     $options = get_design_plus_option();
     $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true) ?  get_post_meta($post->ID, 'hide_sidebar', true) : 'hide';
     $hide_breadcrumb = get_post_meta($post->ID, 'hide_breadcrumb', true) ?  get_post_meta($post->ID, 'hide_breadcrumb', true) : 'no';
     $headline = get_post_meta($post->ID, 'header_headline', true) ?  get_post_meta($post->ID, 'header_headline', true) : get_the_title();
     $sub_title = get_post_meta($post->ID, 'header_sub_title', true) ?  get_post_meta($post->ID, 'header_sub_title', true) : '';
     $desc = get_post_meta($post->ID, 'header_desc', true) ?  get_post_meta($post->ID, 'header_desc', true) : '';
     $desc_mobile = get_post_meta($post->ID, 'header_desc_mobile', true) ?  get_post_meta($post->ID, 'header_desc_mobile', true) : '';
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

<?php if($hide_breadcrumb != 'yes'){ get_template_part('template-parts/breadcrumb'); }; ?>

<?php if($hide_sidebar == 'hide'){ ?>

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

<?php } else { ?>

<div id="main_content">

 <div id="main_col">

  <article id="article">

   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

 </div><!-- END #main_col -->

 <?php get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php }; ?>

<?php get_footer(); ?>