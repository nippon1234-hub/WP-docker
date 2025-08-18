<?php

// カテゴリー編集用入力欄を出力 -------------------------------------------------------
function news_category_edit_extra_fields( $term ) {
	$term_meta = get_option( 'taxonomy_' . $term->term_id, array() );
	$term_meta = array_merge( array(
		'desc_mobile' => '',
	), $term_meta );
?>
<tr class="form-field term-order-wrap">
 <th><label for="term-order"><?php _e('Description(mobile)', 'tcd-issue'); ?></label></th>
 <td><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-issue' ); ?>" cols="50" rows="5" name="term_meta[desc_mobile]"><?php echo esc_textarea(  $term_meta['desc_mobile'] ); ?></textarea></td>
</tr><!-- END .form-field -->
<?php
}
add_action( 'news_category_edit_form_fields', 'news_category_edit_extra_fields' );



// データを保存 -------------------------------------------------------
function news_category_save_extra_fileds( $term_id ) {
  $new_meta = array();
  if ( isset( $_POST['term_meta'] ) ) {
		$current_term_id = $term_id;
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$new_meta[$key] = $_POST['term_meta'][$key];
			}
		}
	}
  update_option( "taxonomy_$current_term_id", $new_meta );
}
add_action( 'edited_news_category', 'news_category_save_extra_fileds' );

?>