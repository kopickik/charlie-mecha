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


// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.fixed_menu = {
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
    if ($('.flexslider').length){
      $('.flexslider').flexslider({
        animation: "fade",
        animationLoop: false
      });
    }
  }
};


})(jQuery, Drupal, this, this.document);
