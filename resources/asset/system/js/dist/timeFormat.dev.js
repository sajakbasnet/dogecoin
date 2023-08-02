"use strict";

$(function () {
  timeFormat.init();
}); // Toggle visibility of application settings

var timeFormat = function () {
  var init = function init() {
    attachEventListeners();
  };

  var attachEventListeners = function attachEventListeners() {
    $('.localTime').each(function () {
      var date = $(this).html();
      var format = $(this).attr('format');
      console.log(moment.utc(date));
      var result = moment.utc(date).utcOffset(moment().format("Z")).format(format || "YYYY-MM-DD HH:mm:ss"); // $(this).html(result)

      $(this).append('   ' + result);
    });
  };

  return {
    init: init
  };
}();