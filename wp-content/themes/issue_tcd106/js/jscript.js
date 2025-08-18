// jQueryファイルでscroll-blockingが発生するイベントリスナーにpassiveを指定してスクロールジャンクを防ぐ
jQuery.event.special.touchstart={setup:function(e,t,s){t.includes("noPreventDefault")?this.addEventListener("touchstart",s,{passive:!1}):this.addEventListener("touchstart",s,{passive:!0})}},jQuery.event.special.touchmove={setup:function(e,t,s){t.includes("noPreventDefault")?this.addEventListener("touchmove",s,{passive:!1}):this.addEventListener("touchmove",s,{passive:!0})}},jQuery.event.special.wheel={setup:function(e,t,s){this.addEventListener("wheel",s,{passive:!0})}},jQuery.event.special.mousewheel={setup:function(e,t,s){this.addEventListener("mousewheel",s,{passive:!0})}};

(function($) {

  var $window = $(window);
  var $body = $('body');


  // インナーリンク
  $(document).ready(function(){
  $('a[href^="#"], area[href^="#"]').not("a.no_auto_scroll").click(function() {

    var href = $(this).prop("href"),
        hrefPageUrl = href.split("#")[0],
        currentUrl = location.href,
        currentUrl = currentUrl.split("#")[0];

    if(hrefPageUrl == currentUrl){

      href = href.split("#");
      href = href.pop();
      href = "#" + href;

      var target = $(href == "#" || href == "" ? 'html' : href);

      var target_offset = 0;

      if( $('#header').length ){
        var header_innerheight = $('#header').innerHeight();
      } else {
        var header_innerheight = '';
      }
      if( target.length ){
        var position = target.offset().top,
            body = 'html',
            userAgent = window.navigator.userAgent.toLowerCase(),
            header_height = header_innerheight + target_offset;

        $(body).animate({ scrollTop: position - header_height }, 1000, 'easeOutQuint');
      }
      $('html').removeClass('open_menu');

      return false;
    }

  });
  });


  // 他のページから移動した際に、ターゲットまでスクロールして移動する
  const hash = location.hash;
  if(hash){
    $("html, body").stop().scrollTop(0);
    setTimeout(function(){

      var target = $(hash);
      var margin_top = parseInt(target.css('margin-top'), 10);
      var padding_top = parseInt(target.css('padding-top'), 10);
      var target_offset = 0;

      if(window.matchMedia('(max-width:801px)').matches){
        target_offset = 30;
        if(margin_top == 0){
          margin_top = padding_top;
        } else {
          margin_top = margin_top - 50;
        }
      } else if(window.matchMedia('(max-width:1201px)').matches){
        target_offset = 60;
        if(margin_top == 0){
          margin_top = padding_top;
        } else {
          margin_top = margin_top - 100;
        }
      } else {
        if( $body.hasClass('header_design_type2') ){
          target_offset = 0;
        } else {
          target_offset = 130;
        }
        if(margin_top == 0){
          margin_top = padding_top;
        } else if(margin_top > 60){
          margin_top = margin_top - 50;
        } else {
          margin_top = margin_top - 20;
        }
      }

      if( $('#header').length ){
        var header_innerheight = $('#header').innerHeight();
      } else {
        var header_innerheight = '';
      }
      if( target.length ){
        var position = target.offset().top - 0,
            body = 'html',
            userAgent = window.navigator.userAgent.toLowerCase(),
            header_height = header_innerheight + target_offset - margin_top;

        $(body).animate({ scrollTop: position - header_height }, 1000, 'easeOutQuint');
      }

    },200);
  }


  // 画面上部からスクロールが開始された時にbodyにstart_scrollを付ける
  let screen_scroll_observer = new IntersectionObserver((entries) => {
    if(entries[0].boundingClientRect.y < 0) {
        document.body.classList.add('start_scroll');
    } else {
        document.body.classList.remove('start_scroll');
    }
  }, {threshold: [0]});
  screen_scroll_observer.observe(document.querySelector('#js-body-start'));


  // グローバルメニュー
  $("#global_menu li:not(.megamenu_parent)").hover(function(){
    $(this).addClass("active");
  }, function(){
    $(this).removeClass("active");
  });

  // 4つ以上メニューがある場合
  if ($('.sub-menu').length) {
    var divs = document.getElementsByClassName('sub-menu');
    for(var i = 0; i < divs.length; i++) {
      var uls = divs[i].getElementsByTagName('ul');
      for(var j = 0; j < uls.length; j++) {
        var liCount = uls[j].getElementsByTagName('li').length;
        if(liCount >= 4) {
          uls[j].classList.add('has_many_menu');
        }
      }
    }
  }

  // コメントタブ
  $("#comment_tab li").click(function() {
    $("#comment_tab li").removeClass('active');
    $(this).addClass("active");
    $(".tab_contents").hide();
    var selected_tab = $(this).find("a").attr("href");
    $(selected_tab).fadeIn();
    return false;
  });


  // デザインセレクトボックス
  $(".design_select_box select").on("click" , function() {
    $(this).closest('.design_select_box').toggleClass("open");
  });
  $(document).mouseup(function (e){
    var container = $(".design_select_box");
    if (container.has(e.target).length === 0) {
      container.removeClass("open");
    }
  });


  // アーカイブウィジェット　ドロップダウン
  if ($('.p-dropdown').length) {
    $('.p-dropdown__title').click(function() {
      $(this).toggleClass('is-active');
      $('+ .p-dropdown__list:not(:animated)', this).slideToggle();
    });
  }


  // カテゴリーウィジェット
  $(".tcd_category_list li:has(ul)").addClass('parent_menu');
  $(".tcd_category_list li.parent_menu > a").parent().prepend("<span class='child_menu_button'></span>");
  $(".tcd_category_list li .child_menu_button").on('click',function() {
     if($(this).parent().hasClass("open")) {
       $(this).parent().removeClass("active");
       $(this).parent().removeClass("open");
       $(this).parent().find('>ul:not(:animated)').slideUp("fast");
       return false;
     } else {
       $(this).parent().addClass("active");
       $(this).parent().addClass("open");
       $(this).parent().find('>ul:not(:animated)').slideDown("fast");
       return false;
     };
  });


  // 検索ウィジェット
  $('.widget_search #searchsubmit').wrap('<div class="submit_button"></div>');
  $('.google_search #searchsubmit').wrap('<div class="submit_button"></div>');


  // タブ記事ウィジェット
  $('.widget_tab_post_list_button').on('click', '.tab1', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list1').addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list2').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list3').removeClass('active');
    return false;
  });
  $('.widget_tab_post_list_button').on('click', '.tab2', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list1').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list2').addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list3').removeClass('active');
    return false;
  });
  $('.widget_tab_post_list_button').on('click', '.tab3', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list1').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list2').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list3').addClass('active');
    return false;
  });


  // カレンダーウィジェット
  $('.wp-calendar-table td').each(function () {
    if ( $(this).children().length == 0 ) {
      $(this).addClass('no_link');
      $(this).wrapInner('<span></span>');
    } else {
      $(this).addClass('has_link');
    }
  });


  // テキストウィジェット
  $('.textwidget').each(function () {
    $(this).addClass('post_content clearfix');
  });


  // FAQリスト　ショートコード
  $('.faq_list .title').on('click', function() {
    var desc = $(this).next('.desc_area');
    var acc_height = desc.find('.desc').outerHeight(true);
    if($(this).hasClass('active')){
      desc.css('height', '');
      $(this).removeClass('active');
    }else{
      desc.css('height', acc_height);
      $(this).addClass('active');
    }
  });


  // タブコンテンツ　ショートコード
  $(".qt_tab_content_header .item").on('click',function() {
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    var target_content = $(this).data('tab-target');
    $(this).closest('.qt_tab_content_wrap').find(".qt_tab_content").removeClass('active');
    $(this).closest('.qt_tab_content_wrap').find(target_content).addClass('active');
    return false;
  });


  // ページ上部へ戻るリンク
  var return_top_button = $('#return_top');
  $('a',return_top_button).click(function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top;
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });
  return_top_button.removeClass('active');
  $window.scroll(function () {
    if ($(this).scrollTop() > 100) {
      return_top_button.addClass('active');
    } else {
      return_top_button.removeClass('active');
    }
  });


  // news category
  $(document).on({
    'mouseenter':function(){
      var $a = $(this).closest('a');
      $a.attr('data-href', $a.attr('href'));
      if ($(this).attr('data-href')) {
        $a.attr('href', $(this).attr('data-href'));
      }
    },
    'mouseleave':function () {
      var $a = $(this).closest('a');
      $a.attr('href', $a.attr('data-href'));
    }
  },'a span[data-href]');


  // ドロワーメニュー内の子メニューに開閉ボタンを追加
  $('#drawer_menu li > .sub-menu').parent().prepend("<span class='child_menu_button'><span class='icon'></span></span>");
  $("#drawer_menu .child_menu_button").on('click',function() {
    if($(this).parent().hasClass("open")) {
      $(this).parent().removeClass("open");
      var parent_menu = $(this).parent().find('> .sub-menu:not(:animated)');
      parent_menu.slideUp("fast");
      return false;
    } else {
      $(this).parent().addClass("open");
      var parent_menu = $(this).parent().find('> .sub-menu:not(:animated)');
      parent_menu.slideDown("fast");
      return false;
    };
  });

  // ドロワーメニュー内の子メニューに開閉ボタンを追加（type2用）
  $('#global_menu li > .sub-menu').parent().prepend("<span class='child_menu_button'><span class='icon'></span></span>");
  $("#global_menu .child_menu_button").on('click',function() {
    if($(this).parent().hasClass("open")) {
      $(this).parent().removeClass("open");
      var parent_menu = $(this).parent().find('> .sub-menu:not(:animated)');
      parent_menu.slideUp("fast");
      return false;
    } else {
      $(this).parent().addClass("open");
      var parent_menu = $(this).parent().find('> .sub-menu:not(:animated)');
      parent_menu.slideDown("fast");
      return false;
    };
  });

  // ドロワーメニューの開閉ボタン
  var menu_button = $('#drawer_menu_button');
  menu_button.off();
  menu_button.toggleClass("active",false);

  // ドロワーメニューを開く
  menu_button.on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $('html').toggleClass('open_menu');
    $('#drawer_menu_overlay').one('click', function(e){
      if($('html').hasClass('open_menu')){
        $('html').removeClass('open_menu');
        return false;
      };
    });
  });
  $('#drawer_menu_close_button').on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $('html').toggleClass('open_menu');
  });

  $(document).ready(function() {
    // swiperの各アイテムからrole属性を削除
    $('.swiper-slide').removeAttr('role');
    $('.swiper-slide').removeAttr('aria-label');
    // .prevクラスの<a>タグにaria-labelを追加
    $('.prev.page-numbers').attr('aria-label', 'link');
    $('.next.page-numbers').attr('aria-label', 'link');
    // ウィジェット
    $('.widget_archive select').attr('aria-label', 'link');
    $('.widget_categories select').attr('aria-label', 'link');
    $('.widget_search input[type=text]').attr('aria-label', 'search');
  });

// レスポンシブ ------------------------------------------------------------------------
const mql = window.matchMedia('screen and (min-width: 1200px)');
const checkBreakPoint = (event) => {

  if (event.matches) { // PC

    $("html").removeClass("mobile");
    $("html").addClass("pc");

  } else { // スマホ

    $("html").removeClass("pc");
    $("html").addClass("mobile");

    // フッターバー
    var footerBar = $("#js-footer-bar");
    if( footerBar.length == 0 ) return;

    footerBar.find( '.js-footer-bar-share, #js-footer-bar-modal-overlay' ).on('click', function(e) {
      e.preventDefault();
      footerBar.find('#js-footer-bar-modal').toggleClass('is-active');		
      return false;
    });
    footerBar.find('#js-footer-bar-modal').on('touchmove', function(e) {
      e.preventDefault();
    });

    (new IntersectionObserver(function (entries) {
      if( entries[0].isIntersecting ){
        footerBar[0].classList.remove('is-active');
      } else {
        footerBar[0].classList.add('is-active');
      }
    })).observe(document.getElementById('js-body-start'));

  };

};
mql.addEventListener("change", checkBreakPoint);
checkBreakPoint(mql);


})(jQuery);