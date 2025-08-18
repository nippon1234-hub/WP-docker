<?php
     // 共通のスクリプト --------------------------------------------------------------------------
     function footer_common_script(){
       global $post;
       $options = get_design_plus_option();
?>
<?php
     // スクロールコンテンツ ---------------------------
     if(is_page() || is_front_page()){
       if(is_page_template('page-tcd-lp.php') || is_page_template('page-tcd-tab.php') || is_front_page()) {
         $hide_sidebar = 'hide';
       } else {
         $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true) ?  get_post_meta($post->ID, 'hide_sidebar', true) : 'right';
       }
       if($hide_sidebar == 'hide'){
        if(!is_front_page()):
?>
window.onload = function() {

  var sections = document.querySelectorAll('.scroll_content_spacer_item');
  if( sections.length < 1 ){
    return;
  }

  const observer = new IntersectionObserver(changeSection, {
    root: null,
    rootMargin: "-50% 0px",
    threshold: 0
  });

  sections.forEach(section => {
    observer.observe(section);
  });

  function changeSection(entries) {
    entries.forEach(entry => {

      var section = entry.target;
      var sectionNum = section.getAttribute('data-section');
      var target = document.getElementById('scroll_content_section_' + sectionNum);
      var navTarget = document.getElementById('scroll_content_nav_' + sectionNum);
      var items = target.querySelectorAll('.item');

      var firstTarget = document.querySelector('.scroll_content_spacer_item:first-of-type');
      var lastTarget = document.querySelector('.scroll_content_spacer_item:last-of-type');
      var windowTop = window.pageYOffset;
      var firstTargetTop = windowTop + firstTarget.getBoundingClientRect().top;
      var lastTargetTop = windowTop + lastTarget.getBoundingClientRect().top;

      if (entry.isIntersecting) {
        target.classList.add('active');
        navTarget.classList.add('active');
        setTimeout(function(){
          target.classList.add('displayed');
        }, 3300);
        setTimeout(function(){
          target.classList.add('displayed_mobile');
        }, 1400);
      // 最後のスライドを過ぎた場合はactiveを外さない
      } else if( windowTop < lastTargetTop ){
        target.classList.remove('active');
        navTarget.classList.remove('active');
      }

      // 最初のスライドを過ぎていなければactiveをつける
      if( windowTop < firstTargetTop ){
        var parents = document.querySelectorAll('.scroll_content_inner');
        for (var i = 0; i < parents.length; i++) {
          var firstChild = parents[i].querySelector('.scroll_content_section');
          firstChild.classList.add('active');
        }
      }

      // 最後のスライドを過ぎている場合は最後のスライドにactiveをつける
      if( windowTop >= lastTargetTop ){
        var parents = document.querySelectorAll('.scroll_content_inner');
        for (var i = 0; i < parents.length; i++) {
          var sections = parents[i].querySelectorAll('.scroll_content_section');
          var lastChild = sections[sections.length - 1];
          lastChild.classList.add('active');
        }
      }

    });
  }

}

// scroll_contentが画面上部に到達したタイミングでactiveを付ける
let items = document.querySelectorAll('.scroll_content');
let options = {
  root: null,
  rootMargin: '-300px 0px -300px 0px',
  threshold: 0
};
let observer = new IntersectionObserver((entries, observer) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('active');
      document.body.classList.add('scroll_content_is_active');
    } else {
      entry.target.classList.remove('active');
      document.body.classList.remove('scroll_content_is_active');
    }
  });
}, options);
items.forEach(item => {
  observer.observe(item);
});
<?php
        else:
          if ($options['contents_builder']){
            $content_count = 1;
            $contents_builder = $options['contents_builder'];
            $sc_ids = array();
            foreach($contents_builder as $content) {
              if ( $content['type'] == 'scroll_content' && $content['show_content']) {
                $sc_ids[] = 'cb_content_' . $content_count;
              }
              $content_count++;
            }
?>
window.onload = function() {
<?php
            if(!empty($sc_ids)){
              foreach($sc_ids as $id){
?>

  var sections<?php echo $id; ?> = document.querySelectorAll('#<?php echo $id; ?> .scroll_content_spacer_item');
  if( sections<?php echo $id; ?>.length < 1 ){
    return;
  }

  const observer<?php echo $id; ?> = new IntersectionObserver(changeSection<?php echo $id; ?>, {
    root: null,
    rootMargin: "-50% 0px",
    threshold: 0
  });

  sections<?php echo $id; ?>.forEach(section => {
    observer<?php echo $id; ?>.observe(section);
  });

  function changeSection<?php echo $id; ?>(entries) {
    entries.forEach(entry => {

      var section = entry.target;
      var sectionNum = section.getAttribute('data-section');
      var target = document.getElementById('scroll_content_section_' + sectionNum);
      var navTarget = document.getElementById('scroll_content_nav_' + sectionNum);
      var items = target.querySelectorAll('.item');

      var firstTarget = document.querySelector('#<?php echo $id; ?> .scroll_content_spacer_item:first-of-type');
      var lastTarget = document.querySelector('#<?php echo $id; ?> .scroll_content_spacer_item:last-of-type');
      var windowTop = window.pageYOffset;
      var firstTargetTop = windowTop + firstTarget.getBoundingClientRect().top;
      var lastTargetTop = windowTop + lastTarget.getBoundingClientRect().top;

      if (entry.isIntersecting) {
        target.classList.add('active');
        navTarget.classList.add('active');
        setTimeout(function(){
          target.classList.add('displayed');
        }, 3300);
        setTimeout(function(){
          target.classList.add('displayed_mobile');
        }, 1400);
      // 最後のスライドを過ぎた場合はactiveを外さない
      } else if( windowTop < lastTargetTop ){
        target.classList.remove('active');
        navTarget.classList.remove('active');
      }

      // 最初のスライドを過ぎていなければactiveをつける
      if( windowTop < firstTargetTop ){
        var parents = document.querySelectorAll('#<?php echo $id; ?> .scroll_content_inner');
        for (var i = 0; i < parents.length; i++) {
          var firstChild = parents[i].querySelector('#<?php echo $id; ?> .scroll_content_section');
          firstChild.classList.add('active');
        }
      }

      // 最後のスライドを過ぎている場合は最後のスライドにactiveをつける
      if( windowTop >= lastTargetTop ){
        var parents = document.querySelectorAll('#<?php echo $id; ?> .scroll_content_inner');
        for (var i = 0; i < parents.length; i++) {
          var sections = parents[i].querySelectorAll('#<?php echo $id; ?> .scroll_content_section');
          var lastChild = sections[sections.length - 1];
          lastChild.classList.add('active');
        }
      }

    });
  }
<?php
              }; // end foreach
            }; // end if
?>
}
// scroll_contentが画面上部に到達したタイミングでactiveを付ける
let items = document.querySelectorAll('.scroll_content');
let options = {
  root: null,
  rootMargin: '-300px 0px -300px 0px',
  threshold: 0
};
let observer = new IntersectionObserver((entries, observer) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('active');
      document.body.classList.add('scroll_content_is_active');
    } else {
      entry.target.classList.remove('active');
      document.body.classList.remove('scroll_content_is_active');
    }
  });
}, options);
items.forEach(item => {
  observer.observe(item);
});

<?php
          };
        endif;
       };
     };
?>

<?php
     // ロゴの切り替え ---------------------------
?>
// ターゲットとなる要素を取得
const targetElement = document.getElementById('header_logo'); // 画面の左上に固定表示されている要素
const overlappingElements = document.querySelectorAll('.logo_change_trigger'); // 特定の要素

if(targetElement != null){

// 重なりをチェックする関数
function checkOverlap() {
  const targetRect = targetElement.getBoundingClientRect();
  
  for (const overlappingElement of overlappingElements) {
    const overlapRect = overlappingElement.getBoundingClientRect();

    if (
      targetRect.top < overlapRect.bottom - 50 &&
      targetRect.bottom > overlapRect.top + 50 &&
      targetRect.left < overlapRect.right - 50 &&
      targetRect.right > overlapRect.left - 50
    ) {
      // 重なっている間はbodyタグにswitch_logoクラスを付与
      document.body.classList.add('switch_logo');
      return; // 一つでも重なっている要素があれば、ループを抜ける
    }
  }
  
  // どの要素とも重なっていない場合はswitch_logoクラスを削除
  document.body.classList.remove('switch_logo');
}

// ページの読み込み時、スクロール時、リサイズ時に重なりをチェック
window.addEventListener('load', () => requestAnimationFrame(checkOverlap));
window.addEventListener('scroll', () => requestAnimationFrame(checkOverlap));
window.addEventListener('resize', () => requestAnimationFrame(checkOverlap));

};

<?php
     // トップページ ------------------------------
     if(is_front_page()) {
?>
// ヘッダーコンテンツを隠す
var headerContent = document.querySelector('#header_slider_container');
if (headerContent) {
  var offset = headerContent.offsetHeight + 500;
  var headerContentOptions = {
    root: null,
    rootMargin: '500px 0px 0px 0px',
    threshold: 0
  };
  var headerContentObserver = new IntersectionObserver(function(entries, headerContentObserver) {
    entries.forEach(function(entry) {
      if (!entry.isIntersecting) {
        document.body.classList.add('hide_header_slider_container');
      } else {
        document.body.classList.remove('hide_header_slider_container');
      }
    });
  }, headerContentOptions);
  headerContentObserver.observe(headerContent);
}
<?php
       // コンテンツビルダー ------------------------
       if ($options['contents_builder']) :
         $show_design_carousel = true;
         $show_interview_list = true;
         $show_staff_list = true;
         $show_blog_list = true;
         $show_news_list = true;
         $contents_builder = $options['contents_builder'];
         foreach($contents_builder as $content) :

           // スタッフ ------------------------
           if (  $options['use_staff'] && ($show_staff_list == true) && $content['type'] == 'staff_list' && $content['show_content'] ) {
             $show_staff_list = false;
?>
(function($) {

  if( $('.cb_staff_carousel').length ){
    let cb_staff_carousel = new Swiper(".cb_staff_carousel", {
      loop: false,
      loopAdditionalSlides: 0,
      centeredSlides: false,
      slidesPerView: "auto",
      grabCursor: true,
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
        momentumRatio: 0.5,
        momentumVelocityRatio: 0.5,
      },
      navigation: {
        nextEl: ".cb_staff_carousel_button_next",
        prevEl: ".cb_staff_carousel_button_prev",
      },
      breakpoints: {
        1160: {
          loop: true,
          loopAdditionalSlides: 2,
          centeredSlides: true,
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      }
    });
  };

})(jQuery);
<?php
           // インタビュー ------------------------
           } elseif (  $options['use_interview'] && ($show_interview_list == true) && $content['type'] == 'interview_list' && $content['show_content'] ) {
             $show_interview_list = false;
?>
(function($) {

  if( $('.cb_interview_carousel_inner').length ){

    let cb_interview_carousel_inner = new Swiper(".cb_interview_carousel_inner", {
      loop: false,
      centeredSlides: false,
      slidesPerView: 1,
      resistanceRatio: 0,
      autoHeight: true,
      navigation: {
        nextEl: ".cb_interview_carousel_button_next",
        prevEl: ".cb_interview_carousel_button_prev",
      },
    });

  };


})(jQuery);
<?php
           // ブログ一覧 ------------------------
           } elseif ( $show_blog_list == true && $content['type'] == 'blog_list' && $content['show_content'] ) {
             $show_blog_list = false;
?>
(function($) {

  if( $('.cb_blog_list .cb_blog_carousel').length ){
    let cb_blog_carousel = new Swiper(".cb_blog_list .cb_blog_carousel", {
      slidesPerView: 1,
      loop: false,
      loopAdditionalSlides: 0,
      centeredSlides: false,
      grabCursor: true,
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
        momentumRatio: 0.5,
        momentumVelocityRatio: 0.5,
      },
      navigation: {
        nextEl: ".cb_blog_carousel_button_next",
        prevEl: ".cb_blog_carousel_button_prev",
      },
      breakpoints: {
        1160: {
          slidesPerView: "auto",
          loop: true,
          loopAdditionalSlides: 2,
          centeredSlides: true,
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        },
        600: {
          slidesPerView: "auto",
        }
      }
    });
  };

})(jQuery);
<?php
           // お知らせ一覧 ------------------------
           } elseif ( $options['use_news'] && $show_news_list == true && $content['type'] == 'news_list' && $content['show_content'] ) {
             $show_news_list = false;
             if($options['news_show_image'] == 'display'){
?>
(function($) {

  if( $('.cb_news_list .cb_blog_carousel').length ){
    let cb_blog_carousel = new Swiper(".cb_news_list .cb_blog_carousel", {
      slidesPerView: 1,
      loop: false,
      loopAdditionalSlides: 0,
      centeredSlides: false,
      grabCursor: true,
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
        momentumRatio: 0.5,
        momentumVelocityRatio: 0.5,
      },
      navigation: {
        nextEl: ".cb_news_carousel_button_next",
        prevEl: ".cb_news_carousel_button_prev",
      },
      breakpoints: {
        1160: {
          slidesPerView: "auto",
          loop: true,
          loopAdditionalSlides: 2,
          centeredSlides: true,
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        },
        600: {
          slidesPerView: "auto",
        }
      }
    });
  };

})(jQuery);
<?php
             };
           };
         endforeach;
       endif; // END コンテンツビルダーここまで

        // ヘッダーメッセージ
        if($options['show_header_message'] == 'display'){
?>
(function($) {
  if( $("#header_message").length ){
    var adjustHeight = function() {
      var header_message_height = $("#header_message").innerHeight();
      var new_height = 'calc(100vh - ' + header_message_height + 'px)';
      $('#header_slider_wrap').css({'height': new_height });
    };

    var adjustTop = function() {
      var header_message_height = $("#header_message").innerHeight();
      var scroll_top = $(window).scrollTop();
      var new_top = Math.max(0, header_message_height - scroll_top);
      $('#header_slider_wrap').css({'top': new_top});
    };

    $(window).on('load resize', function(){
      adjustHeight();
      adjustTop();
    });

    $(window).on('scroll', function(){
      adjustTop();
    });
  };
})(jQuery);
<?php
        };

       // ニュースティッカー
       if($options['show_header_news']){
?>
(function($) {

  if( $('#news_ticker').length ){
    let news_ticker = new Swiper("#news_ticker", {
      loop: true,
      direction: 'vertical',
      slidesPerView: 1,
      speed: 600,
      autoplay: {
        delay: 5000
      }
    });
  }


})(jQuery);
<?php
        }; // ニュースティッカーここまで

        // マウスストーカー
        if(!wp_is_mobile()){
?>
// DOMContentLoadedイベントでマウスストーカー初期化
document.addEventListener("DOMContentLoaded", tcdMouseStalkerInit);

// マウスストーカー動作用関数
function tcdMouseStalkerInit() {

  //ポインタがない場合は終了
  if (!window.matchMedia('(pointer: fine)').matches) {
    return;
  }

  // マウスストーカーエリアがなければ終了
  const imageContainers = document.querySelectorAll('.mouse_stalker_element');
  if (!imageContainers.length) {
    return;
  }

  // 各マウスストーカーの処理
  imageContainers.forEach((imageContainer) => {

    const targetPointer = imageContainer.querySelector('.mouse_stalker_target');

    if(targetPointer != null){

      // ポインタ表示
      imageContainer.addEventListener('mouseenter', () => {
        targetPointer.classList.add('is-active');
      });

      // ポインタ非表示
      imageContainer.addEventListener('mouseleave', () => {
        targetPointer.classList.remove('is-active');
      });

      // ポインタ移動時の処理
      imageContainer.addEventListener('mousemove', (e) => {
        const rect = imageContainer.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const minX = targetPointer.offsetWidth / 2;
        const minY = targetPointer.offsetHeight / 2;
        const maxX = rect.width - minX;
        const maxY = rect.height - minY;
        // position
        targetPointer.style.setProperty('--tcd-stalker-position-x', x + 'px');
        targetPointer.style.setProperty('--tcd-stalker-position-y', y + 'px');
        // min position
        targetPointer.style.setProperty('--tcd-stalker-position-x--min', minX + 'px');
        targetPointer.style.setProperty('--tcd-stalker-position-y--min', minY + 'px');
        // max position
        targetPointer.style.setProperty('--tcd-stalker-position-x--max', maxX + 'px');
        targetPointer.style.setProperty('--tcd-stalker-position-y--max', maxY + 'px');
      });

    };

  });

}
<?php
        }; // マウスストーカーここまで
     }; // トップページここまで
?>

<?php
     // 記事スライダー　ウィジェット --------------------
     if ( (is_single() && is_active_widget(false, false, 'post_slider_widget', true)) || (is_page() && is_active_widget(false, false, 'post_slider_widget', true)) ) {
?>
(function($) {

  if( $('.post_slider_widget .post_slider_wrap').length ){
    let post_slider_widget = new Swiper(".post_slider_widget .post_slider_wrap", {
      loop: true,
      speed: 600,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.post_slider_widget_pagination',
        clickable: false,
      },
    });
  }


})(jQuery);
<?php } ?>

<?php
     // スタッフスライダー　ウィジェット --------------------
     if ( (is_single() && is_active_widget(false, false, 'staff_slider_widget', true)) || (is_page() && is_active_widget(false, false, 'staff_slider_widget', true)) ) {
?>
(function($) {

  if( $('.staff_slider_widget .staff_slider_widget_wrap').length ){
    let staff_slider_widget = new Swiper(".staff_slider_widget .staff_slider_widget_wrap", {
      loop: true,
      speed: 600,
      autoplay: {
        delay: 5250,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.staff_slider_widget_pagination',
        clickable: false,
      },
    });
  }


})(jQuery);
<?php } ?>

<?php
     // インタビュースライダー　ウィジェット --------------------
     if ( (is_single() && is_active_widget(false, false, 'interview_slider_widget', true)) || (is_page() && is_active_widget(false, false, 'interview_slider_widget', true)) ) {
?>
(function($) {

  if( $('.interview_slider_widget .interview_slider_widget_wrap').length ){
    let interview_slider_widget = new Swiper(".interview_slider_widget .interview_slider_widget_wrap", {
      loop: true,
      speed: 600,
      autoplay: {
        delay: 5500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.interview_slider_widget_pagination',
        clickable: false,
      },
    });
  }


})(jQuery);
<?php } ?>

<?php
     // ブログ詳細ページ, お知らせ詳細ページの関連記事 ------------------------------
     if(is_singular('post') || is_singular('news')) {
?>
(function($) {

<?php
     for ( $i = 1; $i <= 3; $i++ ):
       if(is_singular('post')) {
         $show_recommmend_post = $options['recommend_post_headline'.$i];
       } else {
         $show_recommmend_post = $options['recommend_news_headline'.$i];
       }
       if($show_recommmend_post){
?>
  if( $('.recommend_post_carousel<?php echo $i; ?>').length ){
    let recommend_post_carousel<?php echo $i; ?> = new Swiper(".recommend_post_carousel<?php echo $i; ?>", {
      slidesPerView: 1,
      spaceBetween: '0px',
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
        momentumRatio: 0.5,
        momentumVelocityRatio: 0.5,
      },
      autoplay: {
        enabled: false,
        delay: 5000,
      },
      navigation: {
        nextEl: ".recommend_post_next<?php echo $i; ?>",
        prevEl: ".recommend_post_prev<?php echo $i; ?>",
      },
      breakpoints: {
        1200: {
          slidesPerView: 3,
          spaceBetween: '22px',
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        },
        600: {
          slidesPerView: 'auto',
          spaceBetween: '0px',
        }
      }
    });
  };

<?php
       };
     endfor;
?>

})(jQuery);
<?php
     };
// ブログアーカイブ・お知らせアーカイブ -----------------------------------------------------------------------------
     if(!is_front_page() && is_home() || is_category() || is_post_type_archive('news') || is_tax('news_category')) {
       $display_category_list = false;
       if( !is_front_page() && is_home() || is_category() ){
         if($options['archive_blog_show_category_list'] == 'display'){
           $display_category_list = true;
         }
       }
       if( is_post_type_archive('news') || is_tax('news_category') ){
         if($options['archive_news_show_category_list'] == 'display'){
           $display_category_list = true;
         }
       }
       if($display_category_list == true){
?>
(function($) {

  if( $('.category_sort_button_slider').length ){
    let category_sort_button_slider = new Swiper(".category_sort_button_slider", {
      slidesPerView: 'auto',
      grabCursor: true,
      resistanceRatio: 0,
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: true,
      },
      navigation: {
        nextEl: ".category_sort_button_next",
        prevEl: ".category_sort_button_prev",
      },
      breakpoints: {
        1100: {
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
    });
  };

  document.addEventListener("DOMContentLoaded", function() {
    if (window.location.hash) {
      var target = document.getElementById(window.location.hash.substring(1));
      if (target) {
        target.scrollIntoView({ behavior: "instant" });
      }
    }
  });

})(jQuery);

<?php
       };
     };

     // スタッフアーカイブ -----------------------------------------------------------------------------
     if(is_post_type_archive('staff') || is_tax('staff_category')) {
?>
(function($) {

  let items = Array.from(document.querySelectorAll('#category_sort_button .item:not(.active_menu)'));
  if(items.length){
    let lastItem = items[items.length - 1];
    lastItem.classList.add('last_item');
  }

  var debounceTimer;
  window.addEventListener('load', checkWidth);
  window.addEventListener('resize', function() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(checkWidth, 100);
  });
  function checkWidth() {
    var items = document.querySelectorAll('#category_sort_button_wrap .item');
    var totalWidth = 0;
    for (var i = 0; i < items.length; i++) {
      totalWidth += items[i].offsetWidth;
      var style = window.getComputedStyle(items[i]);
      totalWidth += parseInt(style.marginRight);
    }
    var parentItem = document.querySelector('#category_sort_button_wrap');
    var parentWidth = parentItem.offsetWidth;
    if (totalWidth > parentWidth) {
      parentItem.classList.add('over_size');
    } else {
      parentItem.classList.remove('over_size');
    }
  }

  if( $('#category_sort_button_slider').length ){
    let category_sort_button_slider = new Swiper("#category_sort_button_slider", {
      slidesPerView: "auto",
      grabCursor: true,
      resistanceRatio: 0,
      freeMode: {
        enabled: true,
        sticky: false,
      },
      navigation: {
        nextEl: ".category_sort_button_next",
        prevEl: ".category_sort_button_prev",
      },
    });
  };

  <?php
       // マウスストーカー
       if(!wp_is_mobile() && $options['staff_design_type'] == 'type1'){
  ?>
// DOMContentLoadedイベントでマウスストーカー初期化
document.addEventListener("DOMContentLoaded", tcdMouseStalkerInit);

// マウスストーカー動作用関数
function tcdMouseStalkerInit() {

  //ポインタがない場合は終了
  if (!window.matchMedia('(pointer: fine)').matches) {
    return;
  }

  // マウスストーカーエリアがなければ終了
  const imageContainers = document.querySelectorAll('.mouse_stalker_element');
  if (!imageContainers.length) {
    return;
  }

  // 各マウスストーカーの処理
  imageContainers.forEach((imageContainer) => {

    const targetPointer = imageContainer.querySelector('.mouse_stalker_target');

    if(targetPointer != null){

      // ポインタ表示
      imageContainer.addEventListener('mouseenter', () => {
        targetPointer.classList.add('is-active');
      });

      // ポインタ非表示
      imageContainer.addEventListener('mouseleave', () => {
        targetPointer.classList.remove('is-active');
      });

      // ポインタ移動時の処理
      imageContainer.addEventListener('mousemove', (e) => {
        const rect = imageContainer.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const minX = targetPointer.offsetWidth / 2;
        const minY = targetPointer.offsetHeight / 2;
        const maxX = rect.width - minX;
        const maxY = rect.height - minY;
        // position
        targetPointer.style.setProperty('--tcd-stalker-position-x', x + 'px');
        targetPointer.style.setProperty('--tcd-stalker-position-y', y + 'px');
        // min position
        targetPointer.style.setProperty('--tcd-stalker-position-x--min', minX + 'px');
        targetPointer.style.setProperty('--tcd-stalker-position-y--min', minY + 'px');
        // max position
        targetPointer.style.setProperty('--tcd-stalker-position-x--max', maxX + 'px');
        targetPointer.style.setProperty('--tcd-stalker-position-y--max', maxY + 'px');
      });

    };

  });

}
  <?php }; ?>

})(jQuery);
<?php }; ?>

<?php
     // スタッフ詳細ページ ------------------------------
     if(is_singular('staff')) {
?>
(function($) {

  <?php
       $staff_image_slider = get_post_meta($post->ID, 'staff_image_slider', true);
       if($staff_image_slider){
  ?>
  if( $('#staff_image_carousel_wrap').length ){
    let staff_image_carousel_wrap = new Swiper("#staff_image_carousel_wrap", {
      effect: 'fade',
      loop: true,
      slidesPerView: 1,
      allowTouchMove : false,
      speed: 5000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      }
    });
  };
  <?php }; ?>

  <?php
       // カルーセル
       for ( $i = 1; $i <= 3; $i++ ):
         if($options['related_staff_headline'.$i]){
           if($options['staff_design_type'] == 'type1'){
  ?>
  if( $('.staff_carousel_type1_<?php echo $i; ?>').length ){
    let staff_carousel_type1_<?php echo $i; ?> = new Swiper(".staff_carousel_type1_<?php echo $i; ?>", {
      slidesPerView: "auto",
      spaceBetween: '0px',
      centeredSlides: false,
      loop: false,
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
        momentumRatio: 0.5,
        momentumVelocityRatio: 0.5,
      },
      autoplay: {
        enabled: false,
        delay: 5000,
      },
      navigation: {
        nextEl: ".staff_carousel_next<?php echo $i; ?>",
        prevEl: ".staff_carousel_prev<?php echo $i; ?>",
      },
      breakpoints: {
        1000: {
          slidesPerView: 3,
          spaceBetween: '18px',
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      }
    });
  };
  <?php } else { ?>
  if( $('.staff_carousel_type2_<?php echo $i; ?>').length ){
    let staff_carousel_type2_<?php echo $i; ?> = new Swiper(".staff_carousel_type2_<?php echo $i; ?>", {
      slidesPerView: "auto",
      resistanceRatio: 0,
      centeredSlides: false,
      loop: false,
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
        momentumRatio: 0.5,
        momentumVelocityRatio: 0.5,
      },
      autoplay: {
        enabled: false,
        delay: 5000,
      },
      navigation: {
        nextEl: ".staff_carousel_next<?php echo $i; ?>",
        prevEl: ".staff_carousel_prev<?php echo $i; ?>",
      },
      breakpoints: {
        1000: {
          slidesPerView: 2,
          spaceBetween: '20px',
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      }
    });
  };
  <?php
           };
         };
       endfor;
  ?>

  <?php
       // マウスストーカー
       if(!wp_is_mobile() && $options['staff_design_type'] == 'type1'){
  ?>
// DOMContentLoadedイベントでマウスストーカー初期化
document.addEventListener("DOMContentLoaded", tcdMouseStalkerInit);

// マウスストーカー動作用関数
function tcdMouseStalkerInit() {

  //ポインタがない場合は終了
  if (!window.matchMedia('(pointer: fine)').matches) {
    return;
  }

  // マウスストーカーエリアがなければ終了
  const imageContainers = document.querySelectorAll('.mouse_stalker_element');
  if (!imageContainers.length) {
    return;
  }

  // 各マウスストーカーの処理
  imageContainers.forEach((imageContainer) => {

    const targetPointer = imageContainer.querySelector('.mouse_stalker_target');

    if(targetPointer != null){

      // ポインタ表示
      imageContainer.addEventListener('mouseenter', () => {
        targetPointer.classList.add('is-active');
      });

      // ポインタ非表示
      imageContainer.addEventListener('mouseleave', () => {
        targetPointer.classList.remove('is-active');
      });

      // ポインタ移動時の処理
      imageContainer.addEventListener('mousemove', (e) => {
        const rect = imageContainer.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const minX = targetPointer.offsetWidth / 2;
        const minY = targetPointer.offsetHeight / 2;
        const maxX = rect.width - minX;
        const maxY = rect.height - minY;
        // position
        targetPointer.style.setProperty('--tcd-stalker-position-x', x + 'px');
        targetPointer.style.setProperty('--tcd-stalker-position-y', y + 'px');
        // min position
        targetPointer.style.setProperty('--tcd-stalker-position-x--min', minX + 'px');
        targetPointer.style.setProperty('--tcd-stalker-position-y--min', minY + 'px');
        // max position
        targetPointer.style.setProperty('--tcd-stalker-position-x--max', maxX + 'px');
        targetPointer.style.setProperty('--tcd-stalker-position-y--max', maxY + 'px');
      });

    };

  });

}
  <?php }; ?>

})(jQuery);
<?php }; ?>

<?php
     // インタビューアーカイブ -----------------------------------------------------------------------------
     if(is_post_type_archive('interview') || is_tax('interview_category')) {
       $ajax_item = 'get_interview_items';
?>
(function($) {

  if( $('#interview_category_sort_<?php echo esc_attr($options['interview_category_type']); ?>').length ){
    let interview_category_sort_button = new Swiper("#interview_category_sort_<?php echo esc_attr($options['interview_category_type']); ?>", {
      slidesPerView: 'auto',
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
        momentumRatio: 0.5,
        momentumVelocityRatio: 0.5,
      },
      autoplay: {
        enabled: false,
        delay: 5000,
      },
      navigation: {
        nextEl: ".interview_category_sort_button_next",
        prevEl: ".interview_category_sort_button_prev",
      },
      breakpoints: {
        800: {
          slidesPerView: 3,
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      }
    });
  };

  $(".interview_category_sort_button a").on('click',function() {
    $(this).parent().siblings().removeClass('active_menu');
    $(this).parent().addClass('active_menu');
    var target_content = $(this).data('filter');
    $(".interview_content").removeClass('active');
    $(target_content).addClass('active');
    var post_category_id = $(this).data('category-id');
    if(post_category_id){
      $('.interview_list').find('.item').removeClass('animate').removeAttr('style');
      $('.ajax_post_list_wrap').removeClass('active');
      $(post_category_id).addClass('active');
      $(post_category_id).find(".item").each(function(i){
        $(this).delay(i * 300).queue(function(next) {
          $(this).addClass('animate');
          next();
        });
      });
    }
    return false;
  });

  var load_hash_tab = function(){
    if (!location.hash) return;
    var active_button = location.hash;
    $(active_button+"_button").trigger("click");
  };
  load_hash_tab();

  <?php
       // AJAXを使って記事をロードする ------------------------
       if(wp_is_mobile()){
         $post_num = $options['archive_interview_num_sp'];
       } else {
         $post_num = $options['archive_interview_num'];
       };
  ?>

  var offsetPost = '',
      catid = '',
      flag = false;

  $(document).on("click", ".entry-more", function() {
    offsetPost = $(this).data('offset-post');
    catid = $(this).data('catid');
    current_button = $(this);
    if (!flag) {
      entry_loading = current_button.closest('.ajax_post_list_wrap').find('.entry-loading');
      item_list = current_button.closest('.ajax_post_list_wrap').find('.interview_list');
      current_button.addClass("is-hide");
      entry_loading.addClass("is-show");
      flag = true;
      $.ajax({
        type: "POST",
        url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
        data: {
          action: '<?php echo esc_attr($ajax_item); ?>',
          offset_post_num: offsetPost,
          post_cat_id: catid
        },
        dataType: 'json'
      }).done(function(data, textStatus, jqXHR) {
        if (data.html) {
          item_list.append(data.html);
          $(".ajax_item",item_list).each(function(i) {
            $(this).css('opacity','0').show();
            $(this).delay(i * 300).queue(function(next) {
              $(this).addClass('animate').fadeIn();
              $(this).removeClass('ajax_item');
              next();
            });
          });
        }
        entry_loading.removeClass("is-show");
        if (data.remain) {
          current_button.removeClass("is-hide");
        }
        offsetPost += <?php echo esc_attr($post_num); ?>;
        current_button.attr('data-offset-post',offsetPost);
        current_button.data('offset-post',offsetPost);
        flag = false;
      }).fail(function(jqXHR, textStatus, errorThrown) {
        entry_loading.removeClass("is-show");
        // console.log('fail loading');
      });
    }
  });

})(jQuery);
<?php }; ?>

<?php
     // インタビュー詳細ページ ------------------------------
     if(is_singular('interview')) {
?>
(function($) {

  if( $('#interview_next_prev_post .related_interview_carousel').length ){
    let interview_next_prev_post = new Swiper("#interview_next_prev_post .related_interview_carousel", {
      slidesPerView: 1,
      spaceBetween: '0px',
      resistanceRatio: 0,
      autoplay: {
        enabled: false,
        delay: 5000,
      },
      breakpoints: {
        1000: {
          slidesPerView: 2,
          spaceBetween: '40px',
        },
        600: {
          slidesPerView: 'auto',
          spaceBetween: '0px',
        }
      }
    });
  };

<?php
     for ( $i = 1; $i <= 3; $i++ ):
       if($options['related_interview_headline'.$i]){
?>
  if( $('.related_interview_carousel<?php echo $i; ?>').length ){
    let related_interview_carousel<?php echo $i; ?> = new Swiper(".related_interview_carousel<?php echo $i; ?>", {
      slidesPerView: 1,
      spaceBetween: '0px',
      freeMode: {
        enabled: true,
        sticky: false,
        momentumBounce: false,
        momentumRatio: 0.5,
        momentumVelocityRatio: 0.5,
      },
      autoplay: {
        enabled: false,
        delay: 5000,
      },
      navigation: {
        nextEl: ".interview_carousel_next<?php echo $i; ?>",
        prevEl: ".interview_carousel_prev<?php echo $i; ?>",
      },
      breakpoints: {
        1000: {
          slidesPerView: 2,
          spaceBetween: '40px',
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        },
        600: {
          slidesPerView: 'auto',
          spaceBetween: '0px',
        }
      }
    });
  };
<?php
       };
     endfor;
?>

})(jQuery);
<?php }; ?>

<?php
     // 固定ページ　タブページ -----------------------------------------------------------------------------
     if(is_page_template('page-tcd-tab.php')) {
?>
(function($) {

  let items = Array.from(document.querySelectorAll('#category_sort_button .item:not(.active_menu)'));
  if(items.length){
    let lastItem = items[items.length - 1];
    lastItem.classList.add('last_item');
  }

  var debounceTimer;
  window.addEventListener('load', checkWidth);
  window.addEventListener('resize', function() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(checkWidth, 100);
  });
  function checkWidth() {
    var items = document.querySelectorAll('#category_sort_button_wrap .item');
    var totalWidth = 0;
    for (var i = 0; i < items.length; i++) {
      totalWidth += items[i].offsetWidth;
      var style = window.getComputedStyle(items[i]);
      totalWidth += parseInt(style.marginRight);
    }
    var parentItem = document.querySelector('#category_sort_button_wrap');
    var parentWidth = parentItem.offsetWidth;
    if (totalWidth > parentWidth) {
      parentItem.classList.add('over_size');
    } else {
      parentItem.classList.remove('over_size');
    }
  }

  if( $('#category_sort_button_slider').length ){
    let category_sort_button_slider = new Swiper("#category_sort_button_slider", {
      slidesPerView: "auto",
      grabCursor: true,
      resistanceRatio: 0,
      freeMode: {
        enabled: true,
        sticky: false,
      },
      navigation: {
        nextEl: ".category_sort_button_next",
        prevEl: ".category_sort_button_prev",
      },
    });
  };

})(jQuery);
<?php }; ?>

<?php
     }; // END footer common script

     //  ブラウザのスクロールに合わせたアニメーション -----------------------
     function inview_animaton(){
       global $post;
?>

  const targets = document.querySelectorAll('.inview');
  const options = {
    root: null,
    rootMargin: '-100px 0px',
    threshold: 0
  };
  const observer = new IntersectionObserver(intersect, options);
  targets.forEach(target => {
    observer.observe(target);
  });
  function intersect(entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        $(entry.target).addClass('animate');
        $(".item",entry.target).each(function(i){
          $(this).delay(i * 300).queue(function(next) {
            $(this).addClass('animate');
            next();
          });
        });
        observer.unobserve(entry.target);
      }
    });
  }


<?php
     };

     // ロード画面を表示する場合 -----------------------------------------------------------------
     function show_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php footer_common_script(); ?>

function after_load() {
  (function($) {

  $('body').addClass('end_loading');

  setTimeout(function(){
    $('body').addClass('start_first_animation');
    <?php inview_animaton(); ?>
  }, 1200);

  <?php
       // トップページのヘッダースライダー -----------------------------------
       if(is_front_page()) {
         if ($options['loading_type'] == 'type5') {
           $header_content_animation_delay = 1600;
         } else {
           $header_content_animation_delay = 500;
         }
  ?>
  setTimeout(function(){
<?php
     $catch = $options['index_header_content_catch'];
     if(wp_is_mobile() && $options['index_header_content_catch_mobile']){
       $catch = $options['index_header_content_catch_mobile'];
     }
     if(!$catch){
?>
    setTimeout(function(){
      $(body).addClass('end_catch_animation');
    },200);
<?php } else { ?>
<?php if($options['index_header_content_catch_animation'] != 'type3'){ ?>
    var total_word = $('#header_slider_content .catch .item').length;
    $('#header_slider_content .catch .item').each(function(i){
      $(this).delay(i * <?php if($options['index_header_content_catch_animation'] == 'type1'){ echo '80'; } else { echo '100'; }; ?>).queue(function(next) {
        $(this).addClass('animate');
        if(i == total_word - 1){
          setTimeout(function(){
            $(body).addClass('end_catch_animation');
          },700);
        }
        next();
      });
    });
<?php } else { ?>
    $('#header_slider_content .catch').addClass('animate');
    setTimeout(function(){
      $(body).addClass('end_catch_animation');
    },600);
<?php }; ?>
<?php }; ?>
  }, <?php echo $header_content_animation_delay; ?>);
  window.dispatchEvent(new Event('initHeaderSlider'));
  <?php }; ?>

<?php
     // スタッフアーカイブ -----------------------------------------------------------------------------
     if(is_post_type_archive('staff') || is_tax('staff_category')) {
?>
 setTimeout(function(){
   $(".staff_list_type1 .item, .staff_list_type2 .item").each(function(i){
     $(this).delay(i * 300).queue(function(next) {
       $(this).addClass('animate');
       next();
     });
   });
 }, 700);
<?php }; ?>

<?php
     // ブログアーカイブ -----------------------------------------------------------------------------
     if(is_home() || is_category()) {
?>
 setTimeout(function(){
   $(".blog_list .item").each(function(i){
     $(this).delay(i * 300).queue(function(next) {
       $(this).addClass('animate');
       next();
     });
   });
 }, 700);
<?php }; ?>

  })( jQuery );
}

(function($) {

  <?php if ( $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ) { ?>
  $.cookie('first_visit', 'on', {
    path:'/'
  });
  <?php }; ?>

  $('#site_loader_overlay').addClass('start_loading');

  <?php if ($options['loading_type'] == 'type5') { ?>

  $('#site_loader_overlay_for_catchphrase').addClass('start_loading');

  <?php if($options['loading_catch_animation'] != 'type3'){ ?>
  $('#loader_catch .item').each(function(i){
    $(this).delay(i * <?php if($options['index_header_content_catch_animation'] == 'type1'){ echo '80'; } else { echo '100'; }; ?>).queue(function(next) {
      $(this).addClass('animate');
      next();
    });
  });
  <?php } else { ?>
  $('#loader_catch').addClass('animate');
  <?php }; ?>

  setTimeout(function(){
    $('#site_loader_overlay_for_catchphrase').addClass('active');
    $('#site_loader_overlay').addClass('active');
  }, 3000);
  setTimeout(function(){
    after_load();
  }, 6000);

  <?php } else { ?>

  setTimeout(function(){
    after_load();
  }, <?php echo esc_attr($options['loading_time']); ?>);

  <?php }; ?>

})( jQuery );

</script>
<?php
     };

     // ロード画面を表示しない場合 ------------------------------------------------------------------------------------------------------------------
     function no_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php footer_common_script(); ?>

(function($) {

  setTimeout(function(){
    $('body').addClass('start_first_animation');
    <?php inview_animaton(); ?>
  }, 500);

  <?php
       // トップページのヘッダースライダー -----------------------------------
       if(is_front_page()) {
  ?>
  setTimeout(function(){
<?php
     $catch = $options['index_header_content_catch'];
     if(wp_is_mobile() && $options['index_header_content_catch_mobile']){
       $catch = $options['index_header_content_catch_mobile'];
     }
     if(!$catch){
?>
    setTimeout(function(){
      $(body).addClass('end_catch_animation');
    },200);
<?php } else { ?>
<?php if($options['index_header_content_catch_animation'] != 'type3'){ ?>
    var total_word = $('#header_slider_content .catch .item').length;
    $('#header_slider_content .catch .item').each(function(i){
      $(this).delay(i * <?php if($options['index_header_content_catch_animation'] == 'type1'){ echo '80'; } else { echo '100'; }; ?>).queue(function(next) {
        $(this).addClass('animate');
        if(i == total_word - 1){
          setTimeout(function(){
            $(body).addClass('end_catch_animation');
          },700);
        }
        next();
      });
    });
<?php } else { ?>
    $('#header_slider_content .catch').addClass('animate');
    setTimeout(function(){
      $(body).addClass('end_catch_animation');
    },600);
<?php }; ?>
<?php }; ?>
  }, 400);
  window.dispatchEvent(new Event('initHeaderSlider'));
  <?php }; ?>

<?php
     // スタッフアーカイブ -----------------------------------------------------------------------------
     if(is_post_type_archive('staff') || is_tax('staff_category')) {
?>
   $(".staff_list_type1 .item, .staff_list_type2 .item").each(function(i){
     $(this).delay(i * 300).queue(function(next) {
       $(this).addClass('animate');
       next();
     });
   });
<?php }; ?>

<?php
     // ブログアーカイブ -----------------------------------------------------------------------------
     if(is_home() || is_category()) {
?>
   $(".blog_list .item").each(function(i){
     $(this).delay(i * 300).queue(function(next) {
       $(this).addClass('animate');
       next();
     });
   });
<?php }; ?>

})( jQuery );

</script>
<?php } ?>