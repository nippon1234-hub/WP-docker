<?php


// カスタムメニュー画面に新しい入力欄の追加
function add_custom_filed_to_nav( $item_id, $item ) {
  $menu_item_catch = get_post_meta( $item_id, '_menu-item-catch', true );
?>
<div class="custom_nav_catch_field">
 <p class="field-catch description description-wide">
  <label for="menu-item-catch-<?php echo $item_id ;?>">
  <?php _e( 'Catchphrase', 'tcd-issue' ); ?>
  </label>
 </p>
 <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
 <p class="description description-wide">
  <input type="text" name="menu-item-catch[<?php echo $item_id ;?>]" class="widefat edit-menu-item-catch" id="menu-item-catch-<?php echo $item_id ;?>" value="<?php echo esc_attr( $menu_item_catch ); ?>" />
 </p>
</div>

<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'add_custom_filed_to_nav', 10, 2 );


// データの保存
function custom_nav_update($menu_id, $menu_item_db_id ) {
  if ( isset( $_POST['menu-item-catch'][$menu_item_db_id]  ) ) {
    $sanitized_data = sanitize_text_field( $_POST['menu-item-catch'][$menu_item_db_id] );
    update_post_meta( $menu_item_db_id, '_menu-item-catch', $sanitized_data );
  } else {
    delete_post_meta( $menu_item_db_id, '_menu-item-catch' );
  }
}
add_action('wp_update_nav_menu_item', 'custom_nav_update',10, 3);


// ドロワーメニューへの出力内容を変更
class drawer_menu extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $item_id = $item->ID;
    $target = ($item->target)? ' target="_blank"' : '';
    if ( $depth == 0 ) {
      $catch = get_post_meta( $item_id, '_menu-item-catch', true );
      $output .= '<li><a href="'. esc_url($item->url) .'"'.$target.'>';
      $output .= '<span class="title">' . esc_html($item->title) . '</span>';
      if($catch){
        $output .= '<span class="sub_title">' . esc_html($catch) . '</span>';
      }
      $output .= '</a>';
    } else {
      $output .= '<li><a href="'. esc_url($item->url) .'"'.$target.'>';
      $output .= esc_html($item->title);
      $output .= '</a>';
    }
  }
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<div class=\"sub-menu\"><ul>\n";
  }
  function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul></div>\n";
  }
}


// フッターメニューの見出しを取得
function get_menu_name_from_location( $location ) {
  if( empty($location) ) return false;
  $locations = get_nav_menu_locations();
  if( ! isset( $locations[$location] ) ) return false;
  $menu_obj = get_term( $locations[$location], 'nav_menu' );
  return $menu_obj;
}

?>