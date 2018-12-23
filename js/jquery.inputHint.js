/*!
 * jquery.inputHint.js v2.0
 *  A jQuery Plugin that adds hints to <input type="text" title="Hint goes here" />
 *
 * Intended for use with the latest jQuery
 *  http://code.jquery.com/jquery-latest.js
 *
 * Copyright 2011, Todd Williams
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *  http://jquery.org/license
 *
 * Usage:
 *  <input name="name" class="inputHint" type="text" title="Enter Name" />
 *  $(document).ready(function () { $(".inputHint").inputHint(); });
 *
 * Advanced Usage:
 *  <input name="name" class="inputHint" type="text" title="Enter Name" />
 *  $(document).ready(function () {
 *    $(".inputHint").inputHint({
 *      fadeOutSpeed: 200,
 *      fontFamily: 'Helvetica, Arial, sans-serif',
 *      fontSize: '12px',
 *      hintColor: '#888',
 *      padding: '4px'
 *    });
 *  });
 */
(function ($) {
  $.fn.inputHint = function (options) {
    options = $.extend({
      fadeOutSpeed: 200,
      fontFamily: 'Helvetica, Arial, sans-serif',
      fontSize: '12px',
      hintColor: '#888',
      padding: '4px',
      effect: 'fade', // jquery-ui required for most effects ('explode', 'blind', 'bounce', 'clip', 'drop', 'explode', 'fold', 'highlight', 'puff', 'pulsate', 'scale', 'shake', 'size', 'slide', 'transfer')
      effectOptions: false
    }, options);
    
    // convert padding from pixels to a number (px is used to remain consistent with css)
    options['padding'] = parseInt(options['padding'].replace(/px/, ''));
    
    // Show overlay and link them together using .data()
    var _showOverlay = function (element) {
      // Build out our overlay
      var offset = element.offset(), 
          overlay = $('<div />').css({
            'position': 'absolute',
            'left': offset.left + 'px',
            'top': offset.top + 'px',
            'width': element.outerWidth() - (options['padding']*2) + 'px',
            'height': element.outerHeight() - (options['padding']*2) + 'px',
            'line-height': element.innerHeight() + 'px',
            'overflow': 'hidden',
            'cursor': 'text',
            'font-family': options['fontFamily'],
            'font-size': options['fontSize'],
            'color': options['hintColor'],
            'padding': options['padding'] + 'px'
          })
          .html(element.attr('title'))
          .addClass('inputHintOverlay')
          .data('inputHintSource', element);
      element.data('inputHintOverlay', overlay);
    
      $('body').append(overlay);
    },
    _removeOverlay = function (element, callback) {
      // remove class so _positionUpdateInterval doesn't touch it durring animation
      element.removeClass('inputHintOverlay');
      element.hide(options['effect'], options['effectOptions'], options['fadeOutSpeed'], function () {
        // Now that we have faded out, remove the overlay
        element.remove();
      });
    },
    _updatePositions = function() {
      $(".inputHintOverlay").each(function () {
        var offset = $(this).data('inputHintSource').offset();
        $(this).css({
          'left': offset.left + 'px',
          'top': offset.top + 'px'
        });
      });
    },
    
    // Constantly scan for position changes
    _positionUpdateInterval = setInterval(function () {
      _updatePositions();
    }, 500);
    
    // Set the stage and show input hint for all blank inputs with a title
    $(this).each(function () {
      if($(this).val() == '' || $(this).val() == $(this).attr('title')) {
        $(this).val('');
        _showOverlay($(this));
      }
    });
    
    // When they click the overlay focus on input
    $(".inputHintOverlay").live('click', function () {
      $(this).data('inputHintSource').focus();
    });

    // user focuses on input, we remove the overlay
    $(this).live('click, keyup, focus', function () {
      var overlay = $(this).data('inputHintOverlay');
      _removeOverlay(overlay);
    }).live('blur', function () {
      if($(this).val() == '') {
        _showOverlay($(this));
      }
    });
    
    // Constantly scan for 

    return $(this);
  };
})(jQuery);