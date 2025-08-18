<?php
$term_slug = 'category';
$archive_slug = 'post';
$show_all_category = false;
if (is_home() || is_category()) {
    $term_slug = 'category';
    $archive_slug = 'post';
}else if( is_post_type_archive('news') || is_tax('news_category') ){
    $term_slug = 'news_category';
    $archive_slug = 'news';
}else if( is_post_type_archive('inteview') || is_tax('inteview_category') ){
    $term_slug = 'inteview_category';
    $archive_slug = 'inteview';
}

 // 投稿アーカイブページかカテゴリーアーカイブページかをチェック
    if (is_home() || is_post_type_archive()) {
        // 投稿アーカイブページでは親カテゴリーのソートボタンを表示
        $category = get_terms($term_slug, array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true, 'parent' => 0));
        $show_all_category = true;
    } elseif (is_category() || is_tax()) {
        // 現在表示しているカテゴリーIDを取得
        $current_category_id = get_queried_object_id();
    
        // 子カテゴリーを取得
        $category = get_terms($term_slug, array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true, 'parent' => $current_category_id));
    
        // 子カテゴリーがある時
        if (empty($category)) {
            $parent_category = get_term($current_category_id);
            $parent_id = $parent_category->parent;
    
            // 親カテゴリーが存在する場合、その親カテゴリーの子カテゴリーを取得
            if ($parent_id !== 0) {
                $category = get_terms($term_slug, array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true, 'parent' => $parent_id));
    
                // 孫カテゴリーが1つしかない場合はソートボタンを表示しない
                if (count($category) == 1 && (is_category() || is_tax())) {
                    $category = null; // 孫カテゴリーが1つの場合はソートボタンを表示しない
                }
            } else {
                // 子カテゴリーがない時全てを表示
                $category = get_terms($term_slug, array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true, 'parent' => 0));
                
                // 「全ての記事」ボタンを表示
                $current_category_id = get_queried_object_id();
                $ancestors = get_ancestors($current_category_id, 'category');
                if (empty($ancestors)) {
                    $show_all_category = true; // 親の時は「全ての記事」ボタンを表示
                } else {
                    $show_all_category = false; // 子カテ、孫カテを表示時
                }
            }
        } else {
            $show_all_category = false; // 子カテゴリーが存在する場合
        }
    }

    // 現在アクティブなカテゴリーを判定
    $current_category_id = (  is_category() || is_tax() ) ? get_queried_object_id() : 0;

    // カテゴリーが取得できた場合のみ表示
    if (isset($category) && $category) {
        $total_category = count($category);
?>
 <div id="category_sort_button_wrap" class="category_sort_button_wrap inview<?php if($total_category < 6){ echo ' small_size'; }; ?>">
  <div id="category_sort_button_slider" class="category_sort_button_slider swiper">
   <div id="category_sort_button" class="category_sort_button swiper-wrapper">
    <?php if ($show_all_category) { ?>
   <div class="item swiper-slide <?php if(is_home() || is_post_type_archive() ){ echo ' active_menu'; }; ?>">
     <a href="<?php echo esc_url(get_post_type_archive_link($archive_slug)); ?>" class="no_auto_scroll"><?php _e( 'All article', 'tcd-issue' ); ?></a>
    </div>
    <?php } ?>
    <?php
         foreach ( $category as $cat ) :
           $cat_id = $cat->term_id;
           $cat_url = get_term_link($cat_id,$term_slug);
    ?>
    <div class="item swiper-slide<?php if( is_category() || is_tax() ){ if($cat_id == $current_category_id){ echo ' active_menu'; }; }; ?>">
     <a href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat->name); ?></a>
    </div>
    <?php endforeach; ?>
   </div>
  </div>
  <div class="category_sort_button_prev swiper-nav-button type2 swiper-button-prev"></div>
  <div class="category_sort_button_next swiper-nav-button type2 swiper-button-next"></div>
 </div>
 <?php
          };
       // カテゴリーソートタブ ----------------------------------------------------------------
 ?>