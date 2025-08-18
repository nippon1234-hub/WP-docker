<?php

function add_custom_meta_boxes() {
 add_meta_box(
  'wp_recommend_post',//ID of meta box
  __('Recommend post', 'tcd-issue'),//label
  'recommend_post',//callback function
  'post',// post type
  'side'
 );
}
add_action('add_meta_boxes', 'add_custom_meta_boxes');

function recommend_post(){

    global $post;
    $recommend_post = get_post_meta($post->ID,'recommend_post',true);
    $recommend_post2 = get_post_meta($post->ID,'recommend_post2',true);
    $recommend_post3 = get_post_meta($post->ID,'recommend_post3',true);

    echo '<input type="hidden" name="recommend_post_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

?>
<p><?php _e('This option will be used for the carousel displayed in single page widget, single page bottom post list, and index page content builder.', 'tcd-issue');  ?></p>
<ul>
 <li><label><input type="checkbox" name="recommend_post" value="on" <?php checked( $recommend_post, 'on' ); ?>>  <?php _e('Show this post for recommend post1', 'tcd-issue');  ?></label></li>
 <li><label><input type="checkbox" name="recommend_post2" value="on" <?php checked( $recommend_post2, 'on' ); ?>>  <?php _e('Show this post for recommend post2', 'tcd-issue');  ?></label></li>
 <li><label><input type="checkbox" name="recommend_post3" value="on" <?php checked( $recommend_post3, 'on' ); ?>>  <?php _e('Show this post for recommend post3', 'tcd-issue');  ?></label></li>
</ul>
<?php
}

// Save data from meta box
function save_recommend_post_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['recommend_post_meta_box_nonce']) || !wp_verify_nonce($_POST['recommend_post_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'recommend_post','recommend_post2','recommend_post3'
  );
  foreach ($cf_keys as $cf_key) {

    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }

  }

}
add_action('save_post', 'save_recommend_post_meta_box');


?>