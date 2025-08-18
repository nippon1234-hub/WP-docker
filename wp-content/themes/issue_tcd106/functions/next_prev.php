<?php

function next_prev_post_link() {

  $options = get_design_plus_option();
  $prev_post = get_adjacent_post(false, '', true);
  $next_post = get_adjacent_post(false, '', false);

  if ($prev_post) {
    $post_id = $prev_post->ID;
    if(has_post_thumbnail($post_id)) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'size1' );
    } elseif($options['no_image']) {
      $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
    } else {
      $image = array();
      $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
      $image[1] = '200';
      $image[2] = '200';
    }
?>
<a class="item prev_post animate_background" href="<?php echo get_permalink($post_id); ?>">
 <div class="image_wrap">
  <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
 </div>
 <div class="content">
  <p class="title"><span><?php the_title_attribute('post='.$post_id); ?></span></p>
  <p class="nav"><?php echo __('Prev post', 'tcd-issue'); ?></p>
 </div>
</a>
<?php
  };
  if ($next_post) {
    $post_id = $next_post->ID;
    if(has_post_thumbnail($post_id)) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'size1' );
    } elseif($options['no_image']) {
      $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
    } else {
      $image = array();
      $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
      $image[1] = '200';
      $image[2] = '200';
    }
?>
<a class="item next_post animate_background" href="<?php echo get_permalink($post_id); ?>">
 <div class="image_wrap">
  <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
 </div>
 <div class="content">
  <p class="title"><span><?php the_title_attribute('post='.$post_id); ?></span></p>
  <p class="nav"><?php echo __('Next post', 'tcd-issue'); ?></p>
 </div>
</a>
<?php
  };

}


// スタッフ
function staff_prev_post() {

  $options = get_design_plus_option();
  $prev_post = get_adjacent_post( true, '', false, 'staff_category' );
  if ($prev_post) {
    $post_id = $prev_post->ID;
    if(has_post_thumbnail($post_id)) {
      if($options['staff_design_type'] == 'type1'){
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'size4' );
      } else {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'size5' );
      }
    } elseif($options['no_image']) {
      $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
    } else {
      $image = array();
      $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
      if($options['staff_design_type'] == 'type1'){
        $image[1] = '680';
        $image[2] = '940';
      } else {
        $image[1] = '1034';
        $image[2] = '500';
      }
    }
    $post_category = wp_get_post_terms( $post_id, 'staff_category' , array( 'orderby' => 'term_order' ));
    if ( $post_category ) {
      foreach ( $post_category as $cat ) :
        $cat_name = $cat->name;
        $cat_id = $cat->term_id;
        $cat_url = get_term_link($cat_id,'staff_category');
        break;
      endforeach;
    }
    $staff_name = get_post_meta($post_id, 'staff_name', true);
?>
<div class="staff_prev_post_link<?php if(!$post_category){ echo ' no_category'; }; if(!$staff_name){ echo ' no_name'; }; ?>">
 <a class="link animate_background" href="<?php echo get_permalink($post_id); ?>">
  <div class="image_wrap">
   <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
  </div>
  <div class="content">
   <div class="title_area">
    <?php if($staff_name){ ?>
    <p class="name"><?php echo esc_html($staff_name); ?></p>
    <?php }; ?>
    <p class="title"><span><?php the_title_attribute('post='.$post_id); ?></span></p>
   </div>
  </div>
 </a>
 <?php if($post_category){ ?>
 <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
 <?php }; ?>
</div>
<?php
  };

}


// インタビュー
function interview_next_prev_post() {

  $options = get_design_plus_option();
  $prev_post = get_adjacent_post( false, '', true );
  $next_post = get_adjacent_post( false, '', false );

  if ($prev_post) {
    $post_id = $prev_post->ID;
    if(has_post_thumbnail($post_id)) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'size6' );
    } elseif($options['no_image']) {
      $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
    } else {
      $image = array();
      $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
      $image[1] = '460';
      $image[2] = '190';
    }
    $post_category = wp_get_post_terms( $post_id, 'interview_category' , array( 'orderby' => 'term_order' ));
    if ( $post_category ) {
      foreach ( $post_category as $cat ) :
        $cat_name = $cat->name;
        $cat_id = $cat->term_id;
        $cat_url = get_term_link($cat_id,'interview_category');
        break;
      endforeach;
    }
?>
<a class="item swiper-slide animate_background" href="<?php echo get_permalink($post_id); ?>">
 <?php if($post_category){ ?>
 <p class="category"><?php echo esc_html($cat_name); ?></p>
 <?php }; ?>
 <div class="image_wrap">
  <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
 </div>
 <div class="title_area">
  <p class="title"><span><?php echo wp_kses_post(get_the_title($post_id)); ?></span></p>
 </div>
</a>
<?php
  };

  if ($next_post) {
    $post_id = $next_post->ID;
    if(has_post_thumbnail($post_id)) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'size6' );
    } elseif($options['no_image']) {
      $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
    } else {
      $image = array();
      $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
      $image[1] = '460';
      $image[2] = '190';
    }
    $post_category = wp_get_post_terms( $post_id, 'interview_category' , array( 'orderby' => 'term_order' ));
    if ( $post_category ) {
      foreach ( $post_category as $cat ) :
        $cat_name = $cat->name;
        $cat_id = $cat->term_id;
        $cat_url = get_term_link($cat_id,'interview_category');
        break;
      endforeach;
    }
?>
<a class="item swiper-slide animate_background" href="<?php echo get_permalink($post_id); ?>">
 <?php if($post_category){ ?>
 <p class="category"><?php echo esc_html($cat_name); ?></p>
 <?php }; ?>
 <div class="image_wrap">
  <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
 </div>
 <div class="title_area">
  <p class="title"><span><?php echo wp_kses_post(get_the_title($post_id)); ?></span></p>
 </div>
</a>
<?php
  };

}


// add class to posts_nav_link()
add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="next"';
}
function posts_link_attributes_2() {
    return 'class="prev"';
}


?>