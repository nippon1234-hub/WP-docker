<?php
     $options = get_design_plus_option();
     if(wp_is_mobile()){
       $post_num = $options['archive_interview_num_sp'];
     } else {
       $post_num = $options['archive_interview_num'];
     };
     $offset = isset( $_POST['offset_post_num'] ) ? $_POST['offset_post_num'] : $post_num;
     $post_cat_id = isset( $_POST['post_cat_id'] ) ? $_POST['post_cat_id'] : '';

     if($post_cat_id){
       $all_query = new WP_Query( array('post_type' => 'interview', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'tax_query' => array( array( 'taxonomy' => 'interview_category', 'field' => 'term_id', 'terms' => $post_cat_id ) )) );
       $all_post_count = $all_query->found_posts;
       $args = array( 'post_type' => 'interview', 'post_status' => 'publish', 'posts_per_page' => $post_num, 'offset' => $offset, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'tax_query' => array( array( 'taxonomy' => 'interview_category', 'field' => 'term_id', 'terms' => $post_cat_id ) ) );
     } else {
       $all_query = new WP_Query( array('post_type' => 'interview', 'post_status' => 'publish', 'posts_per_page' => -1 ) );
       $all_post_count = $all_query->found_posts;
       $args = array( 'post_type' => 'interview', 'post_status' => 'publish', 'posts_per_page' => $post_num, 'offset' => $offset );
     }

     $post_list = new wp_query($args);
     if($post_list->have_posts()):
       $entry_item = '';
       ob_start();
       while ( $post_list->have_posts() ) : $post_list->the_post();
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
     <div class="item ajax_item offset_<?php echo $offset; ?>" style="opacity:0; display:none;">
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
        <h2 class="title"><span><?php the_title(); ?></span></h2>
        <?php if ($options['interview_show_date'] == 'display'){ ?>
        <div class="date_area">
         <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
        </div>
        <?php }; ?>
       </div>
       <?php if($total_interviewer != 0){ ?>
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
       <?php }; ?>
      </a>
     </div>
<?php
       endwhile;
       $entry_item .= ob_get_contents();
       ob_end_clean();
     endif;

     wp_send_json( array(
       'html' => $entry_item,
       'remain' => $all_post_count - ( $offset + $post_list->post_count )
     ) );
?>