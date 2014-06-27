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
Drupal.behaviors.uiToTop = {
  attach: function(context, settings) {
      /*
      |--------------------------------------------------------------------------
      | UItoTop jQuery Plugin 1.2 by Matt Varone
      | http://www.mattvarone.com/web-design/uitotop-jquery-plugin/
      |--------------------------------------------------------------------------
      */
      (function($){
        $.fn.UItoTop = function(options) {

          var defaults = {
            text: 'To Top',
            min: 200,
            inDelay:600,
            outDelay:400,
            containerID: 'toTop',
            containerHoverID: 'toTopHover',
            scrollSpeed: 1200,
            easingType: 'linear'
          },
                  settings = $.extend(defaults, options),
                  containerIDhash = '#' + settings.containerID,
                  containerHoverIDHash = '#'+settings.containerHoverID;
          
          $('body').append('<a href="#" id="'+settings.containerID+'">'+settings.text+'</a>');
          $(containerIDhash).hide().on('click.UItoTop',function(){
            $('html, body').animate({scrollTop:0}, settings.scrollSpeed, settings.easingType);
            $('#'+settings.containerHoverID, this).stop().animate({'opacity': 0 }, settings.inDelay,
              settings.easingType);
            return false;
          })
          .prepend('<span id="'+settings.containerHoverID+'"></span>')
          .hover(function() {
              $(containerHoverIDHash, this).stop().animate({
                'opacity': 1
              }, 600, 'linear');
            }, function() { 
              $(containerHoverIDHash, this).stop().animate({
                'opacity': 0
              }, 400, 'linear');
            });
                
          $(window).scroll(function() {
            var sd = $(window).scrollTop();
            if(typeof document.body.style.maxHeight === "undefined") {
              $(containerIDhash).css({
                'position': 'absolute',
                'top': sd + $(window).height() - 50
              });
            }
            if ( sd > settings.min ) 
              $(containerIDhash).fadeIn(settings.inDelay);
            else 
              $(containerIDhash).fadeOut(settings.Outdelay);
          });
      };
      })(jQuery);

  }
};


})(jQuery, Drupal, this, this.document);
