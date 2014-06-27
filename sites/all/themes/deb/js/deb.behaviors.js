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
  Drupal.behaviors.ecozenBehaviors = {
    attach: function(context, settings) {

      // Place your code here.
      $(document).ready(function() {
        if ($('.post-cover').length && context.location.href.indexOf("post") >= 0) {
          var ht = $.viewportH() * 0.8;
          $('.post-cover').css('height', ht);
        }
        //var isTouch = Modernizr.touch;
        $('textarea').addClass('form-control');
        $('.form-submit').addClass('btn btn-default');$('input[type="submit"]').addClass('btn btn-default');
        $('select').addClass('form-control');
        scroller = {
          topScrollOffset: -100,
          scrollTiming: 1000,
          pageLoadScrollDelay: 800,
          hashLinkClicked: function(e) {
            // current path
            var temp = window.location.pathname.split('#');
            var curPath = scroller.addTrailingSlash(temp[0]);

            // target path
            var link = $(this).attr('href'),
            linkArray = link.split('#'),
            navId = (typeof linkArray[1] !== 'undefined') ? linkArray[1] : null;
            var targetPath = scroller.addTrailingSlash(linkArray[0]);

            // scrollTo the hash id if the target is on the same page.
            if (targetPath == curPath && navId) {
              e.preventDefault();
              scroller.scrollToElement('#'+navId);
              window.location.hash = scroller.generateTempNavId(navId);

              // otherwise add '_' to hash
            } else if (navId) {
              e.preventDefault();
              navId = scroller.generateTempNavId(navId);
              window.location = targetPath+'#'+navId;
            }
          },
          addTrailingSlash: function(str) {
            lastChar = str.substring(str.length - 1, str.length);
            if (lastChar != '/') str = str+'/'; return str;
          },
          scrollToElement: function(whereTo) {
            $.scrollTo(whereTo, scroller.scrollTiming, {offset: { top: scroller.topScrollOffset }, easing: 'easeInOutQuad' });
          },
          generateTempNavId: function(navId) {
            return '_'+navId;
          },
          getNavIdFromHash: function() {
            var hash = window.location.hash;
            if (scroller.hashIsTempNavId()) {
              hash = hash.substring(2);
            }
            return hash;
          },
          hashIsTempNavId: function() {
            var hash = window.location.hash;
            return hash.substring(0, 2) === '#_';
          },
          loaded: function() {
            if (scroller.hashIsTempNavId()) {
              setTimeout(function() {
                scroller.scrollToElement('#'+scroller.getNavIdFromHash());
                //ga('send', 'event', 'nav', 'scroll', 'nav hashes');
              }, scroller.pageLoadScrollDelay);
            }
          }
        };
        $('.menu__link').on('click', scroller.hashLinkClicked);
        scroller.loaded();
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
                enabled: false,
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
        if ($('.tweet').length) {
          $('.tweet').tweet({
            username: "PCGCampbell",
            modpath: "/sites/all/themes/pcgc/js/twitter/",
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
        if ($('.royalSlider').length) {
          var videoSlider = $('#video-slider');
          videoSlider.royalSlider({
            arrowsNav: false,
            fadeinLoadedSlide: true,
            controlNavigationSpacing: 10,
            controlNavigation: 'arrows',
            thumbs: {
              autoCenter: false,
              fitInViewport: false,
              orientation: 'horizontal',
              spacing: 0,
              paddingBottom: 0
            },
            keyboardNavEnabled: true,
            imageScaleMode: 'fill',
            imageAlignCenter: true,
            slidesSpacing: 0,
            loop: false,
            loopRewind: true,
            numImagesToPreload: 3,
            video: {
              autoHideArrows: true,
              autoHideControlNav: false,
              autoHideBlocks: true
            },
            autoScaleSlider: true,
            autoScaleSliderWidth: 960,
            autoScaleSliderHeight: 350,
            imgWidth: 1400,
            imgHeight: 680
          });
          $('.royalSlider').royalSlider({
            arrowsNav: true,
            loop: false,
            keyboardNavEnabled: true,
            controlsInside: false,
            imageScaleMode: 'fill',
            arrowsNavAutoHide: false,
            autoScaleSlider: true, 
            autoScaleSliderWidth: 960,
            autoScaleSliderHeight: 350,
            controlNavigation: 'bullets',
            thumbsFitInViewport: false,
            navigateByClick: true,
            startSlideId: 0,
            autoPlay: true,
            transitionType:'move',
            globalCaption: true,
            deeplinking: {
              enabled: true,
              change: false
            },
            /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
            imgWidth: 1400,
            imgHeight: 680
          });
        }
        $().UItoTop({ easingType: 'easeOutQuad', scrollSpeed: 1600, text:''});
        var flyingHeader = function() {
          var $head = $( '#theheader' );
          var $trigger = $('#waypointsCtrl');
          $trigger.css({
            'position': 'absolute',
            'top': $.viewportH()+'px',
            'left': 0
          });
          $( '.waypoint' ).each( function() {
            var $el = $( this ),
            animClassDown = $el.data( 'animateDown' ),
            animClassUp = $el.data( 'animateUp' );
            $el.waypoint( function( direction ) {
              if( direction === 'down' && animClassDown ) {
                $head.attr('class', 'navbar navbar-default navbar-fixed-top theheader ' + animClassDown + ' clearfix');
              }
              else if( direction === 'up' && animClassUp ){
                $head.attr('class', 'navbar navbar-default navbar-fixed-top theheader ' + animClassUp + ' clearfix');
              }
            },
            { offset: '80%' } );
          });
        };
        flyingHeader();
        var ua = navigator.userAgent,
        isMobileWebkit = /WebKit/.test(ua) && /Mobile/.test(ua);
        var iScrollInstance;
        if (isMobileWebkit) {
          // don't parallax
        } else {// we're using a desktop browser
          $.stellar({
            //horizontalScrolling: false,
            //verticalOffset: 150
          });
        }
        var apiKey = '4ba1ceaa63fb416d807ccd81b4ebaf5a',
        styleId = '47928';
        function generateTileUrl(apiKey, styleId) {
          return 'http://{s}.tile.cloudmade.com/'+apiKey+'/'+styleId+'/256/{z}/{x}/{y}.png';
        }
        var cloudMadeURL = generateTileUrl(apiKey, styleId);
        if ($('#map').length) {
          var map = L.map('map', {
            scrollWheelZoom: false
          }).setView([42.349648,-83.2], 11);
          L.tileLayer(cloudMadeURL, {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>.'
        }).addTo(map);
        L.marker([42.296727,-83.197697]).addTo(map).bindPopup("<strong>Headquarters:<br />EcoMotors</strong><br />17000 Federal Dr., Suite 200<br />Allen Park, MI 48101<br />Fax: (313) 982-1935").openPopup();
      }
    });
  }
};


})(jQuery, Drupal, this, this.document);
