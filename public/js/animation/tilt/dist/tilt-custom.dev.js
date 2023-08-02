"use strict";

(function ($) {
  "use strict";

  var tilt_custom = {
    init: function init() {
      var tilt = $('.js-tilt').tilt();
      $('.js-destroy').on('click', function () {
        var element = $(this).closest('.js-parent').find('.js-tilt');
        element.tilt.destroy.call(element);
      });
      $('.js-getvalue').on('click', function () {
        var element = $(this).closest('.js-parent').find('.js-tilt');
        var test = element.tilt.getValues.call(element);
        console.log(test[0]);
      });
      $('.js-reset').on('click', function () {
        var element = $(this).closest('.js-parent').find('.js-tilt');
        element.tilt.reset.call(element);
      });
    }
  };
  tilt_custom.init();
})(jQuery);