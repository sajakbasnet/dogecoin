"use strict";

var masonry_gallery = {
  init: function init() {
    $('.grid').isotope({
      itemSelector: '.grid-item'
    });
  }
};

(function ($) {
  "use strict";

  masonry_gallery.init();
})(jQuery);