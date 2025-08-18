<?php
// ヘッダーロゴ ------------------------------
function header_logo(){

  global $post;
  $options = get_design_plus_option();

  // 通常のロゴ

  $pc_image_width = '';
  $pc_image_height = '';

  $logo_image = wp_get_attachment_image_src( $options['header_logo_image'], 'full' );
  if($logo_image) {
    $pc_image_width = $logo_image[1];
    $pc_image_height = $logo_image[2];
    if($options['header_logo_retina'] == 'yes') {
      $pc_image_width = round($pc_image_width / 2);
      $pc_image_height = round($pc_image_height / 2);
    };
  };

  $logo_image_mobile = wp_get_attachment_image_src( $options['header_logo_image_mobile'], 'full' );
  if($logo_image_mobile) {
    $mobile_image_width = $logo_image_mobile[1];
    $mobile_image_height = $logo_image_mobile[2];
    if($options['header_logo_retina'] == 'yes') {
      $mobile_image_width = round($mobile_image_width / 2);
      $mobile_image_height = round($mobile_image_height / 2);
    };
  };

  // 白いロゴ

  $pc_white_image_width = '';
  $pc_white_image_height = '';

  $logo_white_image = wp_get_attachment_image_src( $options['header_logo_type2_image'], 'full' );
  if(!$logo_white_image){
    $logo_white_image = wp_get_attachment_image_src( $options['header_logo_image'], 'full' );
  }
  if($logo_white_image) {
    $pc_white_image_width = $logo_white_image[1];
    $pc_white_image_height = $logo_white_image[2];
    if($options['header_logo_retina'] == 'yes') {
      $pc_white_image_width = round($pc_white_image_width / 2);
      $pc_white_image_height = round($pc_white_image_height / 2);
    };
  };

  $logo_white_image_mobile = wp_get_attachment_image_src( $options['header_logo_type2_image_mobile'], 'full' );
  if(!$logo_white_image_mobile){
    $logo_white_image_mobile = wp_get_attachment_image_src( $options['header_logo_image_mobile'], 'full' );
  }
  if($logo_white_image_mobile) {
    $mobile_white_image_width = $logo_white_image_mobile[1];
    $mobile_white_image_height = $logo_white_image_mobile[2];
    if($options['header_logo_retina'] == 'yes') {
      $mobile_white_image_width = round($mobile_white_image_width / 2);
      $mobile_white_image_height = round($mobile_white_image_height / 2);
    };
  };

  $title = get_bloginfo('name');
  $url = home_url();
  $logo_tag = is_front_page() ? 'h1' : 'p';
?>
<<?php echo $logo_tag ?> id="header_logo">
 <a href="<?php echo esc_url($url); ?>/" title="<?php echo esc_attr($title); ?>">
  <?php
       if( $options['header_logo_type'] == 'type2' && $logo_image ){
  ?>
  <img class="logo_image<?php if($logo_image_mobile){ echo ' pc'; }; ?> type1" fetchpriority="low" src="<?php echo esc_attr($logo_image[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($pc_image_width); ?>" height="<?php echo esc_attr($pc_image_height); ?>" />
  <?php
         if($logo_white_image){
  ?>
  <img class="logo_image<?php if($logo_white_image_mobile){ echo ' pc'; }; ?> type2" fetchpriority="low" src="<?php echo esc_attr($logo_white_image[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($pc_white_image_width); ?>" height="<?php echo esc_attr($pc_white_image_height); ?>" />
  <?php
         };
         if($logo_image_mobile){
  ?>
  <img class="logo_image mobile type1" fetchpriority="low" src="<?php echo esc_attr($logo_image_mobile[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($mobile_image_width); ?>" height="<?php echo esc_attr($mobile_image_height); ?>" />
  <?php
           if($logo_white_image_mobile){
  ?>
  <img class="logo_image mobile type2" fetchpriority="low" src="<?php echo esc_attr($logo_white_image_mobile[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($mobile_white_image_width); ?>" height="<?php echo esc_attr($mobile_white_image_height); ?>" />
  <?php
           };
         };
       } else {
  ?>
  <span class="logo_text rich_font_logo"><?php echo esc_html($title); ?></span>
  <?php }; ?>
 </a>
</<?php echo $logo_tag ?>>

<?php
}


//フッターロゴ　---------------------------------------------------------------------------------------------
function footer_logo(){

  global $post;
  $options = get_design_plus_option();

  $pc_image_width = '';
  $pc_image_height = '';

  $logo_image = wp_get_attachment_image_src( $options['header_logo_type2_image'], 'full' );
  if(!$logo_image){
    $logo_image = wp_get_attachment_image_src( $options['header_logo_image'], 'full' );
  }
  if($logo_image) {
    $pc_image_width = $logo_image[1];
    $pc_image_height = $logo_image[2];
    if($options['header_logo_retina'] == 'yes') {
      $pc_image_width = round($pc_image_width / 2);
      $pc_image_height = round($pc_image_height / 2);
    };
  };

  $logo_image_mobile = wp_get_attachment_image_src( $options['header_logo_type2_image_mobile'], 'full' );
  if(!$logo_image_mobile){
    $logo_image_mobile = wp_get_attachment_image_src( $options['header_logo_image_mobile'], 'full' );
  }
  if($logo_image_mobile) {
    $mobile_image_width = $logo_image_mobile[1];
    $mobile_image_height = $logo_image_mobile[2];
    if($options['header_logo_retina'] == 'yes') {
      $mobile_image_width = round($mobile_image_width / 2);
      $mobile_image_height = round($mobile_image_height / 2);
    };
  };

  $title = get_bloginfo('name');
  $url = home_url();

?>
<p id="footer_logo">
 <a href="<?php echo esc_url($url); ?>/" title="<?php echo esc_attr($title); ?>">
  <?php if( ($options['header_logo_type'] == 'type2') && $logo_image ){ ?>
  <img class="logo_image<?php if($logo_image_mobile){ echo ' pc'; }; ?>" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($logo_image[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($pc_image_width); ?>" height="<?php echo esc_attr($pc_image_height); ?>" />
  <?php if($logo_image_mobile){ ?>
  <img class="logo_image mobile" loading="lazy" fetchpriority="low" src="<?php echo esc_attr($logo_image_mobile[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($mobile_image_width); ?>" height="<?php echo esc_attr($mobile_image_height); ?>" />
  <?php }; ?>
  <?php } else { ?>
  <span class="logo_text rich_font_logo"><?php echo esc_html($title); ?></span>
  <?php }; ?>
 </a>
</p>

<?php
}


?>