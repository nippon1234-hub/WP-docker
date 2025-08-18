<?php

class post_slider_widget extends WP_Widget {

  function __construct() {
    $options = get_design_plus_option();
    parent::__construct(
      'post_slider_widget',// ID
      __('Post slider (tcd ver)', 'tcd-issue'),
      array(
        'classname' => 'post_slider_widget',
        'description' => __('Display post slider.', 'tcd-issue'),
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    global $post;
    $options = get_design_plus_option();

    extract( $args );
    $post_num = isset($instance['post_num']) ?  $instance['post_num'] : 3;
    $post_type = isset($instance['post_type']) ?  $instance['post_type'] : 'recent_post';
    $post_order = isset($instance['post_order']) ?  $instance['post_order'] : 'rand';
    $content_type = isset($instance['content_type']) ?  $instance['content_type'] : 'post';

    if(!$options['use_news'] && $content_type == 'news'){
      return;
    }

    // Before widget //
    echo $before_widget;

    // Widget output //
    if($post_type == 'recent_post') {
      $args = array('post_type' => $content_type, 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order);
    } else {
      $args = array('post_type' => $content_type, 'posts_per_page' => $post_num, 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
    };

    $options = get_design_plus_option();
    $post_slider_query = new WP_Query($args);
?>
<div class="post_slider_wrap swiper<?php if($content_type == 'news' && $options['news_show_image'] != 'display'){ echo ' no_image'; }; ?>">
 <div class="post_slider swiper-wrapper">
  <?php
       $num_post = $post_slider_query->post_count;
       if ($post_slider_query->have_posts()) {
         while ($post_slider_query->have_posts()) : $post_slider_query->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
           } elseif($options['no_image']) {
             $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
           } else {
             $image = array();
             $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
             $image[1] = '480';
             $image[2] = '306';
           }
  ?>
  <div class="item swiper-slide">
   <a class="animate_background" href="<?php the_permalink(); ?>">
    <?php if($content_type == 'news' && $options['news_show_image'] == 'hide'){ } else { ?>
    <div class="image_wrap">
     <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <?php }; ?>
    <div class="title">
     <?php if($content_type == 'news' && $options['news_show_image'] != 'display'){ ?>
     <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
     <?php }; ?>
     <p><span><?php the_title_attribute(); ?></span></p>
    </div>
   </a>
  </div>
  <?php endwhile; wp_reset_query(); }; ?>
 </div>
</div>
<div class="post_slider_widget_pagination swiper-pagination"></div>
<?php

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['post_num'] = $new_instance['post_num'];
    $instance['post_type'] = $new_instance['post_type'];
    $instance['post_order'] = $new_instance['post_order'];
    $instance['content_type'] = $new_instance['content_type'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    global $blog_label;
    $defaults = array('post_num' => 3, 'content_type' => 'post', 'post_type' => 'recent_post', 'post_order' => 'rand');
    $instance = wp_parse_args( (array) $instance, $defaults );
    $options = get_design_plus_option();
    $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-issue' );

?>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Content type', 'tcd-issue'); ?></h3>
 <select name="<?php echo $this->get_field_name('content_type'); ?>" class="widefat" style="width:100%;">
  <option value="post" <?php selected('post', $instance['content_type']); ?>><?php echo esc_html($blog_label); ?></option>
  <option value="news" <?php selected('news', $instance['content_type']); ?>><?php if(!$options['use_news']){ _e('(N/A) ', 'tcd-issue'); }; echo esc_html($news_label); ?></option>
 </select>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post type', 'tcd-issue'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type'); ?>" class="widefat" style="width:100%;">
  <option value="recent_post" <?php selected('recent_post', $instance['post_type']); ?>><?php _e('All post', 'tcd-issue'); ?></option>
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
  <option value="date" <?php selected('date', $instance['post_order']); ?>><?php _e('Post date', 'tcd-issue'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order']); ?>><?php _e('Random', 'tcd-issue'); ?></option>
 </select>
</div>

<?php

  } // end function form

} // end class


function register_post_slider_widget() {
	register_widget( 'post_slider_widget' );
}
add_action( 'widgets_init', 'register_post_slider_widget' );


?>
