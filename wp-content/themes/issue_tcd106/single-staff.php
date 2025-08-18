<?php
     get_header();
     $options = get_design_plus_option();
     if($options['staff_design_type'] == 'type1'){
       get_template_part('template-parts/staff_type1');
     } else {
       get_template_part('template-parts/staff_type2');
     }
?>
<?php get_footer(); ?>