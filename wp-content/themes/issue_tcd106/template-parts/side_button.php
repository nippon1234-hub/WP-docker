<?php
     $options = get_design_plus_option();
     if($options['side_button_url1'] || $options['side_button_url2'] || $options['side_button_url3']){
       if(
         is_front_page() && $options['display_side_button_index'] == 'yes' ||
         !is_front_page() && is_page() && $options['display_side_button_page'] == 'yes' ||
         is_post_type_archive('staff') && $options['display_side_button_staff'] == 'yes' || is_tax('staff_category') && $options['display_side_button_staff'] == 'yes' ||
         is_post_type_archive('interview') && $options['display_side_button_interview'] == 'yes' || is_singular('interview') && $options['display_side_button_interview'] == 'yes' || is_tax('interview_category') && $options['display_side_button_interview'] == 'yes' ||
         is_post_type_archive('news') && $options['display_side_button_news'] == 'yes' || is_singular('news') && $options['display_side_button_news'] == 'yes' ||
         is_home() && $options['display_side_button_blog'] == 'yes' || is_singular('post') && $options['display_side_button_blog'] == 'yes' ||
         is_category() && $options['display_side_button_blog'] == 'yes' || is_date() && $options['display_side_button_blog'] == 'yes' || is_tag() && $options['display_side_button_blog'] == 'yes' || is_author() && $options['display_side_button_blog'] == 'yes' || is_search() && $options['display_side_button_blog'] == 'yes'
       ){
?>
<div class="side_menu_button">
 <?php
      for ( $i = 1; $i <= 3; $i++ ) :
        $url = $options['side_button_url'.$i] ?? '';
        if($url) {
          $title = $options['side_button_title'.$i];
          $catch = $options['side_button_catch'.$i];
          $desc = $options['side_button_desc'.$i];
          $target = $options['side_button_target'.$i];
 ?>
 <a class="item item<?php echo $i; ?>" href="<?php echo esc_url($url); ?>" <?php if($target){ echo 'target="_blank" rel="nofollow noopener"'; }; ?>>
  <?php if($title){ ?><p class="title"><?php echo esc_html($title); ?></p><?php }; ?>
  <?php if($catch || $desc){ ?>
  <div class="content">
   <?php if($catch){ ?>
   <p class="catch"><?php echo wp_kses_post(nl2br($catch)); ?></p>
   <?php }; ?>
   <?php if($desc){ ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>
 </a>
 <?php
        };
      endfor;
 ?>
</div><!-- END #side_button -->
<?php
       };
     };
?>