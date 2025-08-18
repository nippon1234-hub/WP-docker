<?php
/**
 * Add custom columns (ID, thumbnails)
 */
function manage_columns( $columns ) {

  global $post_type;

  // Make new column array with ID column and featured image column
  $new_columns = array();

  foreach ( $columns as $column_name => $column_display_name ) {

    // タイトルの前にIDを追加
    if ( isset( $columns['title'] ) && $column_name == 'title' ) {
      $new_columns['post_id'] = 'ID';
    }

    // 日付の前に以下の項目を追加
    if ( isset( $columns['date'] ) && $column_name == 'date' ) {

      if( $post_type === 'news' ){
        $new_columns['recommend_news'] = __( 'Recommend post', 'tcd-issue' );
        $new_columns['news_category'] = __( 'Category', 'tcd-issue' );
      }

      if( $post_type === 'staff' ){
        $new_columns['staff_name'] = __( 'Name', 'tcd-issue' );
        $new_columns['staff_category'] = __( 'Category', 'tcd-issue' );
        $new_columns['recommend_staff'] = __( 'Recommend post', 'tcd-issue' );
      }

      if( $post_type === 'interview' ){
        $new_columns['interview_category'] = __( 'Category', 'tcd-issue' );
        $new_columns['recommend_interview'] = __( 'Recommend post', 'tcd-issue' );
      }

      $new_columns['new_post_thumb'] = __( 'Featured Image', 'tcd-issue' );

    }

    $new_columns[$column_name] = $column_display_name;

  }

  return $new_columns;
}
add_filter( 'manage_posts_columns', 'manage_columns', 5 ); // For post, news, event and special


/**
 * おすすめ記事を追加
 */
function manage_post_posts_columns( $columns ) {

  $new_columns = array();
  foreach ( $columns as $column_name => $column_display_name ) {
    if ( isset( $columns['new_post_thumb'] ) && $column_name == 'new_post_thumb' ) {
      $new_columns['recommend_post'] = __( 'Recommend post', 'tcd-issue' );
    }
    $new_columns[$column_name] = $column_display_name;
  }
  return $new_columns;

}
add_filter( 'manage_post_posts_columns', 'manage_post_posts_columns' ); // Only for post


/**
 * Output the content of custom columns (ID, featured image, recommend post and event date)
 */
function add_column( $column_name, $post_id ) {

  $options = get_design_plus_option();

  switch ( $column_name ) {

    case 'new_post_thumb' : // アイキャッチ画像
      $post_thumbnail_id = get_post_thumbnail_id( $post_id );
      if ( $post_thumbnail_id ) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'size1' );
        echo '<img width="70" src="' . esc_attr( $post_thumbnail_img[0] ) . '">';
      }
      break;

    case 'recommend_post' : // おすすめ記事
      if ( get_post_meta( $post_id, 'recommend_post', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '1</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post2', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '2</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post3', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '3</p>'; }
      break;

    case 'recommend_news' : // おすすめ記事 お知らせ用
      if ( get_post_meta( $post_id, 'recommend_post', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '1</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post2', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '2</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post3', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '3</p>'; }
      break;

    case 'news_category' :
      if ( $news_category = get_the_terms( $post_id, 'news_category' ) ) {
        foreach ( $news_category as $cats ) {
          printf( '<a href="%s">%s</a>', esc_url( get_edit_term_link( $cats, 'news_category' ) ), $cats->name );
        }
      }
      break;
    case 'staff_name' :
      if ( get_post_meta( $post_id, 'staff_name', true ) ) { echo esc_html(get_post_meta( $post_id, 'staff_name', true )); }
      break;

    case 'staff_category' :
      if ( $staff_category = get_the_terms( $post_id, 'staff_category' ) ) {
        foreach ( $staff_category as $cats ) {
          printf( '<a href="%s">%s</a>', esc_url( get_edit_term_link( $cats, 'staff_category' ) ), $cats->name );
        }
      }
      break;

    case 'recommend_staff' :
      if ( get_post_meta( $post_id, 'recommend_post', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '1</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post2', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '2</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post3', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '3</p>'; }
      break;

    case 'interview_category' :
      if ( $interview_category = get_the_terms( $post_id, 'interview_category' ) ) {
        foreach ( $interview_category as $cats ) {
          printf( '<a href="%s">%s</a>', esc_url( get_edit_term_link( $cats, 'interview_category' ) ), $cats->name );
        }
      }
      break;

    case 'recommend_interview' :
      if ( get_post_meta( $post_id, 'recommend_post', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '1</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post2', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '2</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post3', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-issue' ) . '3</p>'; }
      break;

  }

}
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 ); // For post
add_action( 'manage_pages_custom_column', 'add_column', 10, 2 ); // For page


/**
 * Enable sorting of the ID column
 */
function custom_quick_edit_sortable_columns( $sortable_columns ) {
  $sortable_columns['post_id'] = 'ID';
  return $sortable_columns;
}
//add_filter( 'manage_edit-post_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For post
//add_filter( 'manage_edit-news_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For news
add_filter( 'manage_edit-page_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For page





?>