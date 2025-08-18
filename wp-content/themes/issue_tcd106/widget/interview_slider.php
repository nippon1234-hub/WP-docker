<?php

class interview_slider_widget extends WP_Widget {

  function __construct() {
    $options = get_design_plus_option();
    $interview_label = $options['interview_label'] ? esc_html( $options['interview_label'] ) : __( 'Conversation', 'tcd-issue' );
    parent::__construct(
      'interview_slider_widget',// ID
      sprintf(__('%s post slider (tcd ver)', 'tcd-issue'), $interview_label),
      array(
        'classname' => 'interview_slider_widget',
        'description' => sprintf(__('Display %s post slider.', 'tcd-issue'), $interview_label),
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    global $post;

    extract( $args );
    $post_num = $instance['post_num'];
    $post_type = $instance['post_type'];
    $post_order = $instance['post_order'];
    if($post_order == 'menu_order'){
      $post_order = array();
      $post_order['menu_order'] = 'ASC';
      $post_order['date'] = 'DESC';
    }

    // Before widget //
    echo $before_widget;

    // Widget output //
    if($post_type == 'all_post') {
      $args = array('post_type' => 'interview', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order);
    } else {
      $args = array('post_type' => 'interview', 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
    };

    $options = get_design_plus_option();
    $post_slider_query = new WP_Query($args);
?>
<div class="interview_slider_widget_wrap swiper">
 <div class="interview_slider swiper-wrapper">
  <?php
       if ($post_slider_query->have_posts()) {
         while ($post_slider_query->have_posts()) : $post_slider_query->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size6' );
           } elseif($options['no_image']) {
             $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
           } else {
             $image = array();
             $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
             $image[1] = '460';
             $image[2] = '190';
           }
           $headline = get_post_meta($post->ID, 'interview_title', true);
           $sub_title = get_post_meta($post->ID, 'interview_sub_title', true);
  ?>
  <div class="item swiper-slide">
   <a class="animate_background" href="<?php the_permalink(); ?>">
    <?php if($headline || $sub_title){ ?>
    <div class="headline_area">
     <?php if($headline){ ?>
     <h2 class="headline"><?php echo esc_html($headline); ?></h2>
     <?php }; ?>
     <?php if($sub_title){ ?>
     <p class="sub_title"><?php echo esc_html($sub_title); ?></p>
     <?php }; ?>
    </div>
    <?php }; ?>
    <div class="image_wrap">
     <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <div class="title">
     <p><span><?php the_title_attribute(); ?></span></p>
    </div>
   </a>
  </div>
  <?php endwhile; wp_reset_query(); }; ?>
 </div>
</div>
<div class="interview_slider_widget_pagination swiper-pagination"></div>
<?php

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['post_num'] = $new_instance['post_num'];
    $instance['post_type'] = $new_instance['post_type'];
    $instance['post_order'] = $new_instance['post_order'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $defaults = array('post_num' => 3, 'post_type' => 'all_post', 'post_order' => 'rand');
    $instance = wp_parse_args( (array) $instance, $defaults );
    $options = get_design_plus_option();
?>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post type', 'tcd-issue'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type'); ?>" class="widefat" style="width:100%;">
  <option value="all_post" <?php selected('all_post', $instance['post_type']); ?>><?php _e('All post', 'tcd-issue'); ?></option>
  <option value="recommend_post" <?php selected('recommend_post', $instance['post_type']); ?>><?php _e('Recommend post', 'tcd-issue'); ?>1</option>
  <option value="recommend_post2" <?php selected('recommend_post2', $instance['post_type']); ?>><?php _e('Recommend post', 'tcd-issue'); ?>2</option>
  <option value="recommend_post3" <?php selected('recommend_post3', $instance['post_type']); ?>><?php _e('Recommend post', 'tcd-issue'); ?>3</option>
 </select>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Number of post', 'tcd-issue'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('post_num'); ?>'" type="number" value="<?php echo $instance['post_num']; ?>" min="3" />
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post order', 'tcd-issue'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_order'); ?>" class="widefat" style="width:100%;">
  <option value="menu_order" <?php selected('menu_order', $instance['post_order']); ?>><?php _e('Order specified in the admin screen', 'tcd-issue'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order']); ?>><?php _e('Random', 'tcd-issue'); ?></option>
 </select>
</div>

<?php

  } // end function form

} // end class


function register_interview_slider_widget() {
	register_widget( 'interview_slider_widget' );
}
add_action( 'widgets_init', 'register_interview_slider_widget' );


?>
