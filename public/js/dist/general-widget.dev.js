"use strict";

var general_widget = {
  init: function init() {
    $('#owl-carousel-testimonial').owlCarousel({
      loop: true,
      margin: 10,
      items: 1,
      nav: false,
      dots: false
    });
    var months = ["Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
    var now = new Date();
    $('#monthDay').append("".concat(months[now.getMonth()], " ").concat(now.getDate()));
    $('#year').append("".concat(now.getFullYear()));
    $(function () {
      setInterval(function () {
        var seconds = new Date().getSeconds();
        var sdegree = seconds * 6;
        var srotate = "rotate(" + sdegree + "deg)";
        $("#sec").css({
          "transform": srotate
        });
      }, 1000);
      setInterval(function () {
        var hours = new Date().getHours();
        var mins = new Date().getMinutes();
        var hdegree = hours * 30 + mins / 2;
        var hrotate = "rotate(" + hdegree + "deg)";
        $("#hour").css({
          "transform": hrotate
        });
      }, 1000);
      setInterval(function () {
        var mins = new Date().getMinutes();
        var mdegree = mins * 6;
        var mrotate = "rotate(" + mdegree + "deg)";
        $("#min").css({
          "transform": mrotate
        });
      }, 1000);
    });
  }
};

(function ($) {
  "use strict";

  general_widget.init();
})(jQuery);