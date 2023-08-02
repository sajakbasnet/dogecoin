"use strict";

(function ($) {
  "use strict";

  var wow_init = {
    init: function init() {
      $('.grid').isotope({
        itemSelector: '.grid-item'
      });
      new WOW().init();
    }
  };
  wow_init.init();
})(jQuery);