/*
 * PCGCampbell doc ready scripts.
 *
 */

(function ($, Drupal, window, document, undefined) {
  $.extend(verge);
  
  Drupal.behaviors.behaviorName = {
    attach: function (context, settings) {

      $(document).ready(function() {
        $(".single-popup").magnificPopup({
            type: 'image',
            removalDelay: 300,
            mainClass: 'mfp-with-fade',
            closeOnContentClick: true
        });
        $('.popup-youtube').magnificPopup({
            mainClass: 'mfp-with-fade',
            type: 'iframe'
        });
        $(".views-single-popup").magnificPopup({
            type: 'image',
            removalDelay: 300,
            mainClass: 'mfp-with-fade',
            closeOnContentClick: true,
            titleSrc: 'alt'
        });
        $(".gallery").magnificPopup({
            type: 'image',
            delegate: 'a',
            removalDelay: 300,
            mainClass: 'mfp-with-fade',

            gallery: {enabled: true}
        });
        $(".image-link").on('click', function(e) {
            e.preventDefault();
        });
        /**
        * @author       Rob W <gwnRob@gmail.com>
        * @website      http://stackoverflow.com/a/7513356/938089
        * @version      20120724
        * @description  Executes function on a framed YouTube video (see website link)
        *               For a full list of possible functions, see:
        *               https://developers.google.com/youtube/js_api_reference
        * @param String frame_id The id of (the div containing) the frame
        * @param String func     Desired function to call, eg. "playVideo"
        *        (Function)      Function to call when the player is ready.
        * @param Array  args     (optional) List of arguments to pass to function func*/
        function callPlayer(frame_id, func, args) {
          if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;
          var iframe = document.getElementById(frame_id);
          if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {
              iframe = iframe.getElementsByTagName('iframe')[0];
          }

          // When the player is not ready yet, add the event to a queue
          // Each frame_id is associated with an own queue.
          // Each queue has three possible states:
          //  undefined = uninitialised / array = queue / 0 = ready
          if (!callPlayer.queue) callPlayer.queue = {};
          var queue = callPlayer.queue[frame_id],
              domReady = document.readyState == 'complete';

          if (domReady && !iframe) {
              // DOM is ready and iframe does not exist. Log a message
              window.console && console.log('callPlayer: Frame not found; id=' + frame_id);
              if (queue) clearInterval(queue.poller);
          } else if (func === 'listening') {
              // Sending the "listener" message to the frame, to request status updates
              if (iframe && iframe.contentWindow) {
                  func = '{"event":"listening","id":' + JSON.stringify(''+frame_id) + '}';
                  iframe.contentWindow.postMessage(func, '*');
              }
          } else if (!domReady ||
                     iframe && (!iframe.contentWindow || queue && !queue.ready) ||
                     (!queue || !queue.ready) && typeof func === 'function') {
              if (!queue) queue = callPlayer.queue[frame_id] = [];
              queue.push([func, args]);
              if (!('poller' in queue)) {
                  // keep polling until the document and frame is ready
                  queue.poller = setInterval(function() {
                      callPlayer(frame_id, 'listening');
                  }, 250);
                  // Add a global "message" event listener, to catch status updates:
                  messageEvent(1, function runOnceReady(e) {
                          if (!iframe) {
                              iframe = document.getElementById(frame_id);
                              if (!iframe) return;
                              if (iframe.tagName.toUpperCase() != 'IFRAME') {
                                  iframe = iframe.getElementsByTagName('iframe')[0];
                                  if (!iframe) return;
                              }
                          }
                      if (e.source === iframe.contentWindow) {
                          // Assume that the player is ready if we receive a
                          // message from the iframe
                          clearInterval(queue.poller);
                          queue.ready = true;
                          messageEvent(0, runOnceReady);
                          // .. and release the queue:
                          while (tmp == queue.shift()) {
                              callPlayer(frame_id, tmp[0], tmp[1]);
                          }
                      }
                  }, false);
              }
          } else if (iframe && iframe.contentWindow) {
              // When a function is supplied, just call it (like "onYouTubePlayerReady")
              if (func.call) return func();
              // Frame exists, send message
              iframe.contentWindow.postMessage(JSON.stringify({
                  "event": "command",
                  "func": func,
                  "args": args || [],
                  "id": frame_id
              }), "*");
          }
          /* IE8 does not support addEventListener... */
          function messageEvent(add, listener) {
              var w3 = add ? window.addEventListener : window.removeEventListener;
              w3 ?
                  w3('message', listener, !1)
              :
                  (add ? window.attachEvent : window.detachEvent)('onmessage', listener);
          }
      }
        var youTubeIFrameApiTag = document.createElement('script');
        youTubeIFrameApiTag.src = 'https://www.youtube.com/iframe_api';
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(youTubeIFrameApiTag, firstScriptTag);
        var player;
        function onYouTubePlayerAPIReady() {
          iframez = document.getElementsByTagName('iframe');
          for (var i = 0; i < iframez.length; i++) {
            player = new YT.Player('csvid'+(i+1), {
              events: {
                'onReady': onPlayerReady
              }
            });
          }
        }
        function onPlayerReady(event) {
          var flexPrev = document.getElementsByClassName('flex-prev');
          var flexNext = document.getElementsByClassName('flex-next');
          flexPrev.addEventListener('click', function() {
            player.pauseVideo();
          });
          flexNext.addEventListener('click', function() {
            player.pauseVideo();
          });
        }
        if ($('.flexslider').length) {
          $('.flexslider').flexslider({
            animation: "fade",
            easing: "easeInOutQuad",
            directionNav: true,
            controlNav: false,
            animationSpeed: 800,
            before: function() {
              iframez = document.getElementsByTagName('iframe');
              for (var i = 0; i < iframez.length; i++) {
                callPlayer('csvid'+(i+1), 'pauseVideo');
              }
            }
          });
        }
        if ($('.tp-banner').length) {
          var revapi = $('.tp-banner').revolution({
            delay: 9000,
            startwidth: 1170,
            startheight: 328,
            navigationType: "none",
            fullWidth: "on",
            autoHeight: "on",
            forceFullWidth: "off",
            minFullScreenHeight: 320,
            videoJsPath: "rs-plugin/videojs/",
            fullScreenOffsetContainer: "navbar"
          });
        }
        // TAXONOMY DESCRIPTIONS - FOR CASE STUDIES PAGES
        function caseStudyTaxTooltips() {
          var disciplinesFields = $('.view-whatweused .field-name-field-tax-image');
          var disciplinesImgs = $('.view-whatweused .field-name-field-tax-image img');

          disciplinesFields.on('tap touch click mouseover',function(e) {
            // Hover over code
            var description = $(this).siblings().text();
            var altText = $(this).children().find('img').attr('alt');
            $(this).tooltip({
              title: function() {
                return '<strong style="color: #ffd311;">' + altText + '</strong><br>' + description;
              },
              html: true
            });
          });
        }
        if ($('.view-whatweused').length) {
          caseStudyTaxTooltips();
        }
      });
    }
  };

})(jQuery, Drupal, this, this.document);
