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
Drupal.behaviors.MYMODULE = {
  attach: function(context, settings) {
    $(document).ready(function() {
      if ($('.post-cover').length && context.location.href.indexOf("post") >= 0) {
        var ht = $.viewportH() * 0.8;
        $('.post-cover').css('height', ht);
      }

      var keyword = 'post';
      if ($('.post-cover').length && context.location.href.indexOf("post") >= 0) {
        var coverImg = settings.MYMODULE.cover_image;

        $('.post-cover').backstretch(coverImg);
      } else {
      }
    });
  }
};


})(jQuery, Drupal, this, this.document);
