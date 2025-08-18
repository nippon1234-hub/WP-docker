<?php
     $options = get_design_plus_option();
     get_header();
?>
<?php
     // 通常のコンテンツを読み込む ------------------------------------------------------------------------------
     if($options['index_content_type'] == 'type2'){
       if ( have_posts() ) : while ( have_posts() ) : the_post();
       $page_content_width = $options['page_content_width_type'] ?  $options['page_content_width_type'] : 'type1';
       if($page_content_width == 'type2'){
         $page_content_width_size = 'auto';
       } else {
         $page_content_width_size = $options['page_content_width'] . 'px';
       }
?>
<article id="front_page_contents" style="max-width:<?php echo esc_html($page_content_width_size); ?>;<?php if($page_content_width == 'type2'){ echo ' margin:0 !important;'; }; ?>">
 <div class="post_content clearfix">
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>
</div><!-- END #page_contents -->
<?php
        endwhile; endif;
     } else {
?>
<div id="content_builder">
<?php
     // コンテンツビルダー
     if ($options['contents_builder']) :
       $content_count = 1;
       $contents_builder = $options['contents_builder'];
       foreach($contents_builder as $content) :

         // バナー --------------------------------------------------------------------------------
         $catch = '';
         $desc = '';
         $button_label = '';
         if ( $content['type'] == 'banner' && $content['show_content']) {
           $catch = isset($content['catch']) ?  $content['catch'] : '';
           $catch_mobile = isset($content['catch_mobile']) ?  $content['catch_mobile'] : '';
           $desc = isset($content['desc']) ?  $content['desc'] : '';
           $desc_mobile = isset($content['desc_mobile']) ?  $content['desc_mobile'] : '';
           $button_url = isset($content['button_url']) ?  $content['button_url'] : '';
           $button_target = isset($content['button_target']) ?  $content['button_target'] : '';
           $bg_type = isset($content['bg_type']) ?  $content['bg_type'] : 'type1';
           $video = isset($content['video']) ?  $content['video'] : '';
           $image = isset($content['image']) ?  wp_get_attachment_image_src($content['image'], 'full') : '';
           $image_sp = isset($content['image']) ?  wp_get_attachment_image_src($content['image'], 'size2') : '';
           $video = isset($content['video']) ?  wp_get_attachment_url($content['video']) : '';
           $overlay_color = isset($content['overlay_color']) ?  $content['overlay_color'] : '#000000';
           $overlay_color = hex2rgb($overlay_color);
           $overlay_color = implode(",",$overlay_color);
           $overlay_opacity = isset($content['overlay_opacity']) ?  $content['overlay_opacity'] : '';
?>
<section class="cb_banner logo_change_trigger num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($button_url){ ?>
 <a class="link" href="<?php echo esc_url($button_url); ?>"<?php if($button_target){ echo ' target="_blank"'; }; ?>>
 <?php }; ?>

 <div class="content inview">
  <?php if($catch){ ?>
  <h2 class="catch<?php if($catch_mobile){ echo ' pc'; }; ?>"><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h2>
  <?php if($catch_mobile){ ?>
  <p class="catch mobile"><span><?php echo wp_kses_post(nl2br($catch_mobile)); ?></span></p>
  <?php }; ?>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc item">
  <p<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($desc)); ?></p>
  <?php if($desc_mobile){ ?>
  <p class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
  <?php }; ?>
  </div>
  <?php }; ?>
 </div>

 <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>

 <?php if($bg_type == 'type1' && $image){ ?>
 <picture class="image_wrap">
  <source media="(max-width: 650px)" srcset="<?php echo esc_attr($image_sp[0]); ?>">
  <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
 </picture>
 <?php } elseif($bg_type == 'type2' && $video) { ?>
 <video class="video" src="<?php echo esc_url($video); ?>" playsinline autoplay loop muted></video>
 <?php }; ?>

 <?php if($button_url){ ?>
 </a>
 <?php }; ?>

</section><!-- END .cb_banner -->

<?php
         // スクロールコンテンツ --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'scroll_content' && $content['show_content']) {
           $section_total = 0;
           $section_num = 1;
           for($i = 1; $i <= 3; $i++) :
             $content_type = isset($content['content_type'.$i]) ?  $content['content_type'.$i] : 'type1';
             $headline = isset($content['headline'.$i]) ?  $content['headline'.$i] : '';
             $image = isset($content['image2'.$i]) ?  wp_get_attachment_image_src($content['image2'.$i], 'full') : '';
             $catch = isset($content['catch'.$i]) ?  $content['catch'.$i] : '';
             $desc = isset($content['desc'.$i]) ?  $content['desc'.$i] : '';
             $button_label = isset($content['button_label'.$i]) ?  $content['button_label'.$i] : '';
             $bg_image = isset($content['image'.$i]) ?  wp_get_attachment_image_src($content['image'.$i], 'full') : '';
             if( ($content_type == 'type1' && ($headline || $catch || $desc || $button_label || $bg_image)) || ($content_type == 'type2' && ($image || $catch || $desc || $button_label || $bg_image)) ){
               $section_total++;
             }
           endfor;
?>
<div id="<?php echo 'cb_content_' . $content_count; ?>" class='scroll_content logo_change_trigger<?php if($section_total == 1){ echo ' one_content'; }; ?>' style='height:calc(100vh + (100vh * <?php echo esc_attr($section_total); ?>) );'>
 <div class='scroll_content_inner'>

  <?php
       for($i = 1; $i <= 3; $i++) :
         $content_type = isset($content['content_type'.$i]) ?  $content['content_type'.$i] : 'type1';
         $headline = isset($content['headline'.$i]) ?  $content['headline'.$i] : '';
         $image = isset($content['image2'.$i]) ?  wp_get_attachment_image_src($content['image2'.$i], 'full') : '';
           $sub_title = isset($content['sub_title'.$i]) ?  $content['sub_title'.$i] : '';
           $catch = isset($content['catch'.$i]) ?  $content['catch'.$i] : '';
           $desc = isset($content['desc'.$i]) ?  $content['desc'.$i] : '';
           $desc_mobile = isset($content['desc_mobile'.$i]) ?  $content['desc_mobile'.$i] : '';
           $button_label = isset($content['button_label'.$i]) ?  $content['button_label'.$i] : '';
           $button_url = isset($content['button_url'.$i]) ?  $content['button_url'.$i] : '';
           $button_target = isset($content['button_target'.$i]) ?  $content['button_target'.$i] : '';
           $bg_type = isset($content['bg_type'.$i]) ?  $content['bg_type'.$i] : 'type1';
           $bg_image = isset($content['image'.$i]) ?  wp_get_attachment_image_src($content['image'.$i], 'full') : '';
           $bg_image_mobile = isset($content['image_mobile'.$i]) ?  wp_get_attachment_image_src($content['image_mobile'.$i], 'full') : '';
           if(!$bg_image_mobile){
             $bg_image_mobile = isset($content['image'.$i]) ?  wp_get_attachment_image_src($content['image'.$i], 'size4') : '';
           }
           $overlay_color = isset($content['overlay_color'.$i]) ?  $content['overlay_color'.$i] : '#000000';
           $overlay_color = hex2rgb($overlay_color);
           $overlay_color = implode(",",$overlay_color);
           $overlay_opacity = isset($content['overlay_opacity'.$i]) ?  $content['overlay_opacity'.$i] : '0';
           $bg_color = isset($content['bg_color'.$i]) ?  $content['bg_color'.$i] : '#000000';
         if( ($content_type == 'type1' && ($headline || $catch || $desc || $button_label || $bg_image)) || ($content_type == 'type2' && ($image || $catch || $desc || $button_label || $bg_image)) ){
            /*** 背景にて「背景画像」が選択されているとき ***/
           if($bg_type == 'type1' ){
            
            /*** モバイルサイズ時の背景画像のみ登録されている場合は、PCもモバイルの画像を利用する ***/
            if( (!isset($bg_image) || empty($bg_image)) && (isset($bg_image_mobile) && !empty($bg_image_mobile) )){
              $bg_image =  $bg_image_mobile;
            }
           
            /*** 画像が登録されていない場合は、背景色を黒にする ***/
            if( ( !isset($bg_image) || empty($bg_image)) && (!isset($bg_image_mobile) || empty($bg_image_mobile) )){
              $bg_type = 'type2';
              $bg_color =  '#000000';
            }
            
          } // $bg_type == 'type1' 
  ?>
  <section id='scroll_content_section_<?php echo esc_attr($section_num) . '_' . esc_attr($content_count); ?>' class='scroll_content_section'<?php if($bg_type == 'type2'){ echo ' style="background:' . esc_attr($bg_color) . ';"'; }; ?>>

   <div class='content'>

    <?php if($content_type == 'type1'){ ?>
     <?php if($headline){ ?>
     <h2 class="headline item"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
     <?php }; ?>
     <?php if($sub_title){ ?>
     <p class="sub_title item"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
     <?php }; ?>
    <?php }; ?>

    <?php if($image || $catch || $desc || $button_label){ ?>
     <?php if($content_type == 'type2' && $image){ ?>
     <div class="circle_image item">
      <div class="circle_image_inner">
       <img loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
      </div>
     </div>
     <?php }; ?>
     <?php if($catch){ ?>
     <<?php if($headline){ echo 'h3'; } else { echo 'h2'; }; ?> class="catch item"><?php echo wp_kses_post(nl2br($catch)); ?></<?php if($headline){ echo 'h3'; } else { echo 'h2'; }; ?>>
     <?php }; ?>
     <?php if($desc){ ?>
     <div class="desc item">
      <p<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($desc)); ?></p>
      <?php if($desc_mobile){ ?>
      <p class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p>
      <?php }; ?>
     </div>
     <?php }; ?>
     <?php if($button_label && $button_url){ ?>
     <div class="link_button <?php if($content_type == 'type2'){ echo 'type2 '; }; ?>item">
      <a class="design_button" href="<?php echo esc_url($button_url); ?>"<?php if($button_target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($button_label); ?></a>
     </div>
     <?php }; ?>
    <?php }; ?>

   </div><!-- END .content -->

   <?php if($bg_type == 'type1' && $bg_image){ ?>
   <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
   <picture class="bg_image">
    <source media="(max-width: 650px)" srcset="<?php echo esc_attr($bg_image_mobile[0]); ?>">
    <img loading="lazy" fetchpriority="low" src="<?php echo esc_attr($bg_image[0]); ?>" alt="" width="<?php echo esc_attr($bg_image[1]); ?>" height="<?php echo esc_attr($bg_image[2]); ?>">
   </picture>
   <?php }; ?>

  </section>
  <?php
           $section_num++;
         };
       endfor;
  ?>

  <div class='scroll_content_nav'>
   <ol class='scroll_content_nav_list'>
    <?php
         for($i = 1; $i <= $section_total; $i++) :
           echo "<li id='scroll_content_nav_" . $i . '_' . esc_attr($content_count) . "' class='scroll_content_nav_item'>0" . $i . "</li>\n";
         endfor;
    ?>
   </ol>
  </div><!-- END .scroll_content_nav -->

 </div><!-- END .scroll_content_inner -->

 <div class='scroll_content_spacer'>
  <?php
       for($i = 1; $i <= $section_total; $i++) :
         echo "<div class='scroll_content_spacer_item' data-section='" . $i . '_' . esc_attr($content_count) . "'></div>\n";
       endfor;
  ?>
 </div><!-- END .scroll_content_spacer -->

</div><!-- END .scroll_content -->

<?php
         // スタッフ一覧 --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'staff_list' && $content['show_content']  && $options['use_staff']) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $button_label = isset($content['button_label']) ?  $content['button_label'] : '';
?>
<section class="cb_staff_list cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title){ ?>
 <div class="cb_design_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      $post_category = get_terms( 'staff_category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true) );
      $category_id = isset($content['category_id']) ?  $content['category_id'] : '';
      $post_num = isset($content['post_num']) ?  $content['post_num'] : '6';
      if(wp_is_mobile()){
        $post_num = isset($content['post_num_sp']) ?  $content['post_num_sp'] : '6';
      }
      $post_order = isset($content['post_order']) ?  $content['post_order'] : 'menu_order';
      if($post_order == 'menu_order'){
        $post_order = array();
        $post_order['menu_order'] = 'ASC';
        $post_order['date'] = 'DESC';
      }
      $post_type = isset($content['post_type']) ?  $content['post_type'] : 'all_post';
      $post_order_custom = isset($content['post_order_custom']) ?  $content['post_order_custom'] : '';
      if ( $post_type == 'category_post' && $post_category) {
        $args = array( 'post_status' => 'publish', 'post_type' => 'staff', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'staff_category', 'field' => 'term_id', 'terms' => $category_id ), ) );
      } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
        $args = array('post_type' => 'staff', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      } elseif ( $post_type == 'custom') {
        $post_ids = $post_order_custom;
        $post_ids_array = array_map('intval', explode(',', $post_ids));
        $args = array( 'post_status' => 'publish', 'post_type' => 'staff', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
      } else {
        $args = array( 'post_status' => 'publish', 'post_type' => 'staff', 'posts_per_page' => $post_num, 'orderby' => $post_order );
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
        $total = $post_list->post_count;
        $posts_array = array();
        while ($post_list->have_posts()) : $post_list->the_post();
          array_push($posts_array, get_the_ID());
        endwhile;
 ?>
 <div class="cb_staff_carousel_wrap inview <?php echo esc_attr($options['staff_design_type']); ?>">
 <?php
      if($total>2){
 ?> 
  <div class="cb_staff_carousel swiper">
   <div class="staff_list_<?php echo esc_html($options['staff_design_type']); ?> swiper-wrapper">
     <?php
         for($i = 0; $i < 3; $i++) : // swiperのループ使用時に記事が複製されないバグがあるため、事前に記事を複製する
           foreach($posts_array as $post_id) :
             $post = get_post($post_id);
             setup_postdata($post);

             if(has_post_thumbnail()) {
               if($options['staff_design_type'] == 'type1'){
                 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
               } else {
                 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size5' );
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
             $post_category = wp_get_post_terms( $post->ID, 'staff_category' , array( 'orderby' => 'term_order' ));
             $staff_name = get_post_meta($post->ID, 'staff_name', true);
             $staff_job = get_post_meta($post->ID, 'staff_job', true);
             $staff_date = get_post_meta($post->ID, 'staff_date', true);
             $staff_catch = get_post_meta($post->ID, 'staff_catch', true);
     ?>
     <a class="item animate_background swiper-slide<?php if($i == 1){ echo ' clone_item'; }; ?>" href="<?php the_permalink(); ?>">
      <div class="image_wrap staff_list_image<?php if($options['staff_design_type'] == 'type1'){ echo ' mouse_stalker_element'; }; ?>">
       <?php if($options['staff_design_type'] == 'type1' && ($staff_name || $staff_job || $staff_date)){ ?>
       <p class="mouse_stalker_target"><?php the_title(); ?></p>
       <?php }; ?>
       <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <?php if($options['staff_design_type'] == 'type2'){ ?>
      <div class="title_area">
       <h3 class="title"><span><?php the_title(); ?></span></h3>
      </div>
      <?php }; ?>
      <?php if( $options['staff_design_type'] == 'type1' || ($options['staff_design_type'] == 'type2' && ($staff_name || $staff_job || $staff_date)) ){ ?>
      <div class="content">
      <?php }; ?>
       <?php if($staff_name || $staff_job || $staff_date){ ?>
       <?php if($staff_name){ ?>
       <p class="name"><?php echo esc_html($staff_name); ?></p>
       <?php }; ?>
       <?php if($staff_job){ ?>
       <div class="job_area">
        <p class="job"><?php echo esc_html($staff_job); ?></p>
       </div>
       <?php }; ?>
       <?php if($options['staff_design_type'] == 'type1' && $staff_date){ ?>
       <p class="date"><?php echo esc_html($staff_date); ?></p>
       <?php }; ?>
       <?php } elseif($options['staff_design_type'] == 'type1') { ?>
       <h3 class="title"><?php the_title(); ?></h3>
       <?php }; ?>
      <?php if( $options['staff_design_type'] == 'type1' || ($options['staff_design_type'] == 'type2' && ($staff_name || $staff_job || $staff_date)) ){ ?>
      </div>
      <?php }; ?>
     </a>
     <?php endforeach; endfor; ?>
   </div><!-- END .staff_list_ -->
  </div><!-- END .cb_staff_carousel -->
  <?php if($total >= 3){ ?>
  <div class="cb_staff_carousel_button_prev swiper-nav-button swiper-button-prev"></div>
  <div class="cb_staff_carousel_button_next swiper-nav-button swiper-button-next"></div>
  <?php }; ?>
 <?php
      }else{
 ?>
   <div class="staff_list_<?php echo esc_html($options['staff_design_type']); ?> no_carousel">
     <?php
           foreach($posts_array as $post_id) :
             $post = get_post($post_id);
             setup_postdata($post);

             if(has_post_thumbnail()) {
               if($options['staff_design_type'] == 'type1'){
                 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
               } else {
                 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size5' );
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
             $post_category = wp_get_post_terms( $post->ID, 'staff_category' , array( 'orderby' => 'term_order' ));
             $staff_name = get_post_meta($post->ID, 'staff_name', true);
             $staff_job = get_post_meta($post->ID, 'staff_job', true);
             $staff_date = get_post_meta($post->ID, 'staff_date', true);
             $staff_catch = get_post_meta($post->ID, 'staff_catch', true);
     ?>
     <a class="item animate_background swiper-slide<?php if($i == 1){ echo ' clone_item'; }; ?>" href="<?php the_permalink(); ?>">
      <div class="image_wrap staff_list_image<?php if($options['staff_design_type'] == 'type1'){ echo ' mouse_stalker_element'; }; ?>">
       <?php if($options['staff_design_type'] == 'type1' && ($staff_name || $staff_job || $staff_date)){ ?>
       <p class="mouse_stalker_target"><?php the_title(); ?></p>
       <?php }; ?>
       <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <?php if($options['staff_design_type'] == 'type2'){ ?>
      <div class="title_area">
       <h3 class="title"><span><?php the_title(); ?></span></h3>
      </div>
      <?php }; ?>
      <?php if( $options['staff_design_type'] == 'type1' || ($options['staff_design_type'] == 'type2' && ($staff_name || $staff_job || $staff_date)) ){ ?>
      <div class="content">
      <?php }; ?>
       <?php if($staff_name || $staff_job || $staff_date){ ?>
       <?php if($staff_name){ ?>
       <p class="name"><?php echo esc_html($staff_name); ?></p>
       <?php }; ?>
       <?php if($staff_job){ ?>
       <div class="job_area">
        <p class="job"><?php echo esc_html($staff_job); ?></p>
       </div>
       <?php }; ?>
       <?php if($options['staff_design_type'] == 'type1' && $staff_date){ ?>
       <p class="date"><?php echo esc_html($staff_date); ?></p>
       <?php }; ?>
       <?php } elseif($options['staff_design_type'] == 'type1') { ?>
       <h3 class="title"><?php the_title(); ?></h3>
       <?php }; ?>
      <?php if( $options['staff_design_type'] == 'type1' || ($options['staff_design_type'] == 'type2' && ($staff_name || $staff_job || $staff_date)) ){ ?>
      </div>
      <?php }; ?>
     </a>
     <?php endforeach; ?>
   </div><!-- END .staff_list_ -->
 <?php } ?>
 </div><!-- END .cb_staff_carousel_wrap -->
 <?php endif; wp_reset_query(); ?>

 <?php if($button_label){ ?>
 <div class="link_button inview">
  <a class="design_button" href="<?php echo esc_url(get_post_type_archive_link('staff')); ?>"><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_staff_list -->

<?php
         // インタビュー一覧 --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'interview_list' && $content['show_content']  && $options['use_interview']) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $button_label = isset($content['button_label']) ?  $content['button_label'] : '';
?>
<section class="cb_interview_list num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title){ ?>
 <div class="cb_design_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      $post_category = get_terms( 'interview_category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true) );
      $category_id = isset($content['category_id']) ?  $content['category_id'] : '';
      $post_num = isset($content['post_num']) ?  $content['post_num'] : '6';
      if(wp_is_mobile()){
        $post_num = isset($content['post_num_sp']) ?  $content['post_num_sp'] : '6';
      }
      $post_order = isset($content['post_order']) ?  $content['post_order'] : 'menu_order';
      $post_type = isset($content['post_type']) ?  $content['post_type'] : 'all_post';
      $post_order_custom = isset($content['post_order_custom']) ?  $content['post_order_custom'] : '';
      if($post_order == 'menu_order'){
        $post_order = array();
        $post_order['menu_order'] = 'ASC';
        $post_order['date'] = 'DESC';
      }
      if ( $post_type == 'category_post' && $post_category) {
        $args = array( 'post_status' => 'publish', 'post_type' => 'interview', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'interview_category', 'field' => 'term_id', 'terms' => $category_id ), ) );
      } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
        $args = array('post_type' => 'interview', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      } elseif ( $post_type == 'custom') {
        $post_ids = $post_order_custom;
        $post_ids_array = array_map('intval', explode(',', $post_ids));
        $args = array( 'post_status' => 'publish', 'post_type' => 'interview', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
      } else {
        $args = array( 'post_status' => 'publish', 'post_type' => 'interview', 'posts_per_page' => $post_num, 'orderby' => $post_order );
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div class="cb_interview_carousel inview">
  <div class="cb_interview_carousel_inner swiper">
   <div class="interview_list swiper-wrapper">
     <?php
          while( $post_list->have_posts() ) : $post_list->the_post();
            if(has_post_thumbnail()) {
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
              $image_sp = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
            } elseif($options['no_image']) {
              $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
              $image_sp = '';
            } else {
              $image = array();
              $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
              $image[1] = '960';
              $image[2] = '400';
              $image_sp = '';
            }
            $total_interviewer = 0;
            for($i = 1; $i <= 6; $i++) :
              $last_name = get_post_meta($post->ID, 'interview_last_name' . $i, true);
              if($last_name){
                $total_interviewer++;
              }
            endfor;
            $interview_category = wp_get_post_terms( $post->ID, 'interview_category' , array( 'orderby' => 'term_order' ));
     ?>
     <div class="item swiper-slide">
      <?php
           if ( $interview_category ) {
             foreach ( $interview_category as $cat ) :
               $cat_name = $cat->name;
               $cat_id = $cat->term_id;
               $cat_url = get_term_link($cat_id,'interview_category');
               break;
             endforeach;
      ?>
      <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
      <?php }; ?>
      <a class="link" href="<?php the_permalink(); ?>">
       <picture class="image_wrap">
        <?php if($image_sp){ ?>
        <source media="(max-width: 650px)" srcset="<?php echo esc_attr($image_sp[0]); ?>">
        <?php }; ?>
        <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
       </picture>
       <div class="title_area">
        <h3 class="title"><span><?php the_title(); ?></span></h3>
       </div>
       <?php if($total_interviewer != 0){ ?>
       <div class="interviewer_carousel">
        <div class="interviewer<?php if($total_interviewer == 2 || $total_interviewer == 4){ echo ' type2'; } elseif($total_interviewer == 3 || $total_interviewer == 5 || $total_interviewer == 6){ echo ' type3'; }; ?>">
         <?php
              for($i = 1; $i <= 6; $i++) :
                $last_name = get_post_meta($post->ID, 'interview_last_name' . $i, true);
                if($last_name){
                  $first_name = get_post_meta($post->ID, 'interview_first_name' . $i, true);
                  $department = get_post_meta($post->ID, 'interview_department' . $i, true);
                  $occupation = get_post_meta($post->ID, 'interview_occupation' . $i, true);
         ?>
         <div class="interviewer_item">
          <?php if($last_name){ ?>
          <p class="name"><span><?php echo esc_html($last_name); ?></span><?php if($first_name){ ?><span><?php echo esc_html($first_name); ?></span><?php }; ?></p>
          <?php }; ?>
          <?php if($department){ ?>
          <p class="department"><?php echo esc_html($department); ?></p>
          <?php }; ?>
          <?php if($occupation){ ?>
          <p class="occupation"><?php echo esc_html($occupation); ?></p>
          <?php }; ?>
         </div>
         <?php }; endfor; ?>
        </div>
        <div class="swiper-pagination"></div>
       </div>
       <?php }; ?>
      </a>
     </div>
     <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .interview_list -->
  </div><!-- END .cb_interview_carousel_type2_inner -->
  <div class="cb_interview_carousel_button_prev swiper-nav-button swiper-button-prev"></div>
  <div class="cb_interview_carousel_button_next swiper-nav-button swiper-button-next"></div>
 </div><!-- END .cb_interview_carousel_type2 -->
 <?php endif; ?>

 <?php if($button_label){ ?>
 <div class="link_button inview">
  <a class="design_button" href="<?php echo esc_url(get_post_type_archive_link('interview')); ?>"><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_interview_list -->

<?php
         // ブログ記事一覧 --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'blog_list' && $content['show_content'] ) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $button_label = isset($content['button_label']) ?  $content['button_label'] : '';
?>
<section class="cb_blog_list cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title){ ?>
 <div class="cb_design_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      $post_category = get_terms( 'category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true) );
      $category_id = isset($content['category_id']) ?  $content['category_id'] : '';
      $post_num = isset($content['post_num']) ?  $content['post_num'] : '6';
      if(wp_is_mobile()){
        $post_num = isset($content['post_num_sp']) ?  $content['post_num_sp'] : '6';
      }
      $post_order = isset($content['post_order']) ?  $content['post_order'] : 'date';
      $post_type = isset($content['post_type']) ?  $content['post_type'] : 'recent_post';
      $post_order_custom = isset($content['post_order_custom']) ?  $content['post_order_custom'] : '';
      if ( $post_type == 'category_post' && $post_category) {
        $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => $category_id ), ) );
      } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
        $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      } elseif ( $post_type == 'custom') {
        $post_ids = $post_order_custom;
        $post_ids_array = array_map('intval', explode(',', $post_ids));
        $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
      } else {
        $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order );
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
        $total = $post_list->post_count;
        $posts_array = array();
        while ($post_list->have_posts()) : $post_list->the_post();
          array_push($posts_array, get_the_ID());
        endwhile;
 ?>
 <div class="cb_blog_carousel_wrap inview">
 <?php
      if($total>2 || (wp_is_mobile() && $total !== 1)  ){
 ?> 
  <div class="cb_blog_carousel swiper">

   <div class="blog_list swiper-wrapper">
    <?php
         $loop_num = wp_is_mobile()? 2 : 3;
         for($i = 0; $i < $loop_num; $i++) : // swiperのループ使用時に記事が複製されないバグがあるため、事前に記事を複製する
           foreach($posts_array as $post_id) :
             $post = get_post($post_id);
             setup_postdata($post);

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
     <div class="item swiper-slide<?php if($i == 1){ echo ' clone_item'; }; ?>">
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
        <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
       </div>
       <div class="content">
        <h3 class="title"><span><?php the_title(); ?></span></h3>
       </div>
      </a>
     </div>
    <?php endforeach; endfor; ?>
   </div><!-- END .blog_list -->

  </div><!-- END .cb_blog_carousel -->

  <?php if($total >= 3){ ?>
  <div class="cb_blog_carousel_button_prev swiper-nav-button swiper-button-prev"></div>
  <div class="cb_blog_carousel_button_next swiper-nav-button swiper-button-next"></div>
  <?php }; ?>
 <?php
      }else{
 ?>
  <div class="blog_list no_carousel">
    <?php
         foreach($posts_array as $post_id) :
           $post = get_post($post_id);
           setup_postdata($post);

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
        <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
       </div>
       <div class="content">
        <h3 class="title"><span><?php the_title(); ?></span></h3>
       </div>
      </a>
     </div>
    <?php endforeach; ?>
   </div><!-- END .blog_list -->
 <?php
      }
 ?> 
 </div><!-- END .cb_blog_carousel_wrap -->
 <?php endif; wp_reset_query(); ?>

 <?php if($button_label){ ?>
 <div class="link_button inview">
  <a class="design_button" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_blog_list -->

<?php
         // お知らせ一覧 --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'news_list' && $content['show_content'] && $options['use_news']) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $button_label = isset($content['button_label']) ?  $content['button_label'] : '';
?>
<section class="cb_news_list cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title){ ?>
 <div class="cb_design_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      $post_category = get_terms( 'news_category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true) );
      $category_id = isset($content['category_id']) ?  $content['category_id'] : '';
      $post_num = isset($content['post_num']) ?  $content['post_num'] : '6';
      if(wp_is_mobile()){
        $post_num = isset($content['post_num_sp']) ?  $content['post_num_sp'] : '6';
      }
      $post_order = isset($content['post_order']) ?  $content['post_order'] : 'date';
      $post_type = isset($content['post_type']) ?  $content['post_type'] : 'recent_post';
      $post_order_custom = isset($content['post_order_custom']) ?  $content['post_order_custom'] : '';
      if ( $post_type == 'category_post' && $post_category) {
        $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $category_id ), ) );
      } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
        $args = array('post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      } elseif ( $post_type == 'custom') {
        $post_ids = $post_order_custom;
        $post_ids_array = array_map('intval', explode(',', $post_ids));
        $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
      } else {
        $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order );
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
      $total = $post_list->post_count;
      if($options['news_show_image'] == 'display'){
        $posts_array = array();
        while ($post_list->have_posts()) : $post_list->the_post();
          array_push($posts_array, get_the_ID());
        endwhile;
 ?>
 <div class="cb_blog_carousel_wrap inview">
 <?php
      if($total>2 || wp_is_mobile()){
 ?> 
  <div class="cb_blog_carousel swiper">

   <div class="blog_list blog_list__news swiper-wrapper">
    <?php
         $loop_num = wp_is_mobile()? 2 : 3;
         for($i = 0; $i < $loop_num; $i++) : // swiperのループ使用時に記事が複製されないバグがあるため、事前に記事を複製する
           foreach($posts_array as $post_id) :
             $post = get_post($post_id);
             setup_postdata($post);

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
             $post_category = wp_get_post_terms( $post->ID, 'news_category' , array( 'orderby' => 'term_order' ));
    ?>
    <div class="item swiper-slide<?php if($i == 1){ echo ' clone_item'; }; ?>">
     <div class="meta">
       <?php
            if ( $post_category ) {
              foreach ( $post_category as $cat ) :
                $cat_name = $cat->name;
                $cat_id = $cat->term_id;
                $cat_url = get_term_link($cat_id,'news_category');
                break;
              endforeach;
       ?>
       <a class="news_category" href="<?php echo esc_url($cat_url); ?>"><span><?php echo esc_html($cat_name); ?></span></a>
       <?php }; ?>
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
     </div>
     <a class="animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <div class="content">
       <h3 class="title"><span><?php the_title(); ?></span></h3>
      </div>
     </a>
    </div>
    <?php endforeach; endfor; ?>
   </div><!-- END .blog_list -->

  </div><!-- END .cb_blog_carousel -->

  <?php if($total >= 3){ ?>
  <div class="cb_news_carousel_button_prev swiper-nav-button swiper-button-prev"></div>
  <div class="cb_news_carousel_button_next swiper-nav-button swiper-button-next"></div>
  <?php }; ?>
 <?php
      }else{
 ?>
   <div class="blog_list news_list no_carousel">
    <?php
           foreach($posts_array as $post_id) :
             $post = get_post($post_id);
             setup_postdata($post);

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
             $post_category = wp_get_post_terms( $post->ID, 'news_category' , array( 'orderby' => 'term_order' ));
    ?>
    <div class="item swiper-slide<?php if($i == 1){ echo ' clone_item'; }; ?>">
     <div class="meta">
       <?php
            if ( $post_category ) {
              foreach ( $post_category as $cat ) :
                $cat_name = $cat->name;
                $cat_id = $cat->term_id;
                $cat_url = get_term_link($cat_id,'news_category');
                break;
              endforeach;
       ?>
       <a class="news_category" href="<?php echo esc_url($cat_url); ?>"><span><?php echo esc_html($cat_name); ?></span></a>
       <?php }; ?>
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
     </div>
     <a class="animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <img class="image" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <div class="content">
       <h3 class="title"><span><?php the_title(); ?></span></h3>
      </div>
     </a>
    </div>
    <?php endforeach; ?>
   </div><!-- END .blog_list -->
 <?php } ?>
 </div><!-- END .cb_blog_carousel_wrap -->
 <?php } else { ?>

 <div class="news_list">
  <?php while ($post_list->have_posts()) : $post_list->the_post(); ?>
  <a class="item" href="<?php the_permalink(); ?>">
   <div class="content">
    <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
    <h4 class="title"><span><?php the_title(); ?></span></h4>
   </div>
  </a>
  <?php endwhile; ?>
 </div><!-- END .news_list -->

 <?php }; endif; wp_reset_query(); ?>

 <?php if($button_label){ ?>
 <div class="link_button inview">
  <a class="design_button" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_blog_list -->

<?php
         // フリースペース -----------------------------------------------------
         } elseif ( $content['type'] == 'free_space' && $content['show_content'] ) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $content_width = isset($content['content_width']) ?  $content['content_width'] : 'type1';
           $free_space = isset($content['free_space']) ?  $content['free_space'] : '';
?>
<section class="cb_free_space cb_white_bg num<?php echo $content_count; ?><?php if($content_width == 'type2'){ echo ' wide_content'; }; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title){ ?>
 <div class="cb_design_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php if($free_space){ ?>
 <div class="post_content clearfix inview">
  <?php echo apply_filters('the_content', $free_space ); ?>
 </div>
 <?php }; ?>

</section><!-- END .cb_free_space -->
<?php
         };
       $content_count++;
       endforeach;
     endif;

// コンテンツビルダーここまで
?>
</div><!-- END #content_builder -->
<?php
      }; // END index_content_type
?>

<?php get_footer(); ?>