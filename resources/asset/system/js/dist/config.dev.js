"use strict";

$(document).ready(function () {
  cmsConfig.init();
});

var cmsConfig = function () {
  var $typeSelector = $('select#type');
  var $fieldWrapper = $('#dynamic-field-wrapper');
  var htmlContents = {};

  var init = function init() {
    registerEventListeners();
    getHtmlContents();
    populateWrapper($typeSelector.val());
  };

  var getHtmlContents = function getHtmlContents() {
    $fieldWrapper.find('.col-auto').each(function (index, input) {
      var content = $(input);
      htmlContents[content.attr('id')] = content;
    });
    $fieldWrapper.removeClass('d-none').html('');
  };

  var registerEventListeners = function registerEventListeners() {
    $typeSelector.on('change', handleTypeChange);
  };

  var handleTypeChange = function handleTypeChange() {
    populateWrapper($(this).val());
  };

  var populateWrapper = function populateWrapper(type) {
    if (!!type) $fieldWrapper.html(htmlContents["".concat(type, "-type")]);else $fieldWrapper.html('');
  };

  return {
    init: init
  };
}();