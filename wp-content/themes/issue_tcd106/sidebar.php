<?php
     global $post;
     $options = get_design_plus_option();

     $sidebar = '';

     if ( wp_is_mobile() ) {

       if(is_singular('news')) {
         $sidebar = 'news_single_widget_mobile';
       } elseif ( is_single() || is_home() || is_archive() || is_search()) {
         $sidebar = 'post_single_widget_mobile';
       } elseif(is_page()) {
         $sidebar = 'page_single_widget_mobile';
       }

       if ( is_active_sidebar( $sidebar ) || is_active_sidebar( 'common_widget_mobile' )) {
         if ( is_active_sidebar( $sidebar ) ) {
           echo '<div id="side_col">';
             dynamic_sidebar( $sidebar );
           echo '</div>';
         } elseif(is_active_sidebar( 'common_widget_mobile' )) {
           echo '<div id="side_col">';
             dynamic_sidebar( 'common_widget_mobile' );
           echo '</div>';
         };
       };

     } else {

       if(is_singular('news')) {
         $sidebar = 'news_single_widget';
       } elseif ( is_single() || is_home() || is_archive() || is_search()) {
         $sidebar = 'post_single_widget';
       } elseif(is_page()) {
         $sidebar = 'page_single_widget';
       }

       if ( is_active_sidebar( $sidebar ) || is_active_sidebar( 'common_widget' )) {
         if ( is_active_sidebar( $sidebar ) ) {
           echo '<div id="side_col">';
             dynamic_sidebar( $sidebar );
           echo '</div>';
         } elseif(is_active_sidebar( 'common_widget' )) {
           echo '<div id="side_col">';
             dynamic_sidebar( 'common_widget' );
           echo '</div>';
         };
       };

     };
?>