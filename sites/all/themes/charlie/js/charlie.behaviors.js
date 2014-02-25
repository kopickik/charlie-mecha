/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {
  $.extend(verge);

// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.myBehavior = {

  attach: function(context, settings) {
    function scrolled_menu() {
      if ($(window).scrollTop() > $('#top header').height()+50) {
        $('.fixed-menu').addClass('fixed_show');
      } else {
        $('.fixed-menu').removeClass('fixed_show');
      }
    }
    var fixed_menu = true;
    if ($('.fixed_menu').size() && fixed_menu === true) {
      $('.fixed_menu').append('<div class="fixed-menu-wrapper container">'+$('#top header .container').html()+'</div>');
      $('.fixed_menu').find('.menu').children('li').each(function() {
        $(this).children('a').append('<div class="menu_fader">' + '</div>');
      });

      var fixd_menu = setInterval(scrolled_menu, 1000);

    }
    }
};
Drupal.behaviors.myModuleBehavior = {

  attach: function(context, settings) {
    $(document).ready(function() {
      if ($('.royalSlider').length) {
      $('.royalSlider').royalSlider({
        imgWidth: '100%',
        autoScaleSliderWidth: 1100,
        autoHeight: false
      });
    }
    if ($('.tweet').length) {
      $('.tweet').tweet({
        username: "PCGCampbell",
        modpath: "/sites/all/themes/charlie/js/lib/twitter/",
        join_text: "auto",
        avatar_size: null,
        count: 1,
        auto_join_text_default: " we said,<br>", 
        auto_join_text_ed: " we",
        auto_join_text_ing: " we were",
        auto_join_text_reply: " we replied to",
        auto_join_text_url: " ",
        loading_text: "loading tweets..."
      });
    }
    $().UItoTop({ easingType: 'easeOutQuad', scrollSpeed: 1600, text:''});
    if ($('.post-cover').length) {
        var ht = $.viewportH() * 0.7;
        $('.post-cover').css('height', ht);
      }

    $('#demo-one .quotes').quovolver();
    $(".single-popup").magnificPopup({
        type: 'image',
        removalDelay: 2,
        mainClass: 'mfp-with-fade',
        closeOnContentClick: true
    });
    if ($(".zoom-gallery").length) {
      $(".zoom-gallery").each(function() {
        $(this).magnificPopup({
            type: 'image',
            delegate: 'a',
            removalDelay: 300,
            mainClass: 'mfp-with-fade',

            gallery: {enabled: true},
            zoom: {
                enabled: true,
                duration: 300,
                easing: 'ease-in-out',
                opener: function(openerElement) {
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }
        });
      });
    }
    if ($('.popup-youtube').length) {
      $('.popup-youtube').magnificPopup({
        mainClass: 'mfp-with-fade',
        type: 'iframe'
      });
    }
  });
  }
};

Drupal.behaviors.MYMODULE = {

  attach: function(context, settings) {
    $(document).ready(function() {
      console.log(context.location.href);
      var keyword = 'post';
      if (context.location.href.indexOf("post") >= 0) {
        var coverImg = settings.MYMODULE.cover_image;
        $('.post-cover').backstretch(coverImg);
      } else {
      }
    });
  }
};

})(jQuery, Drupal, this, this.document);
