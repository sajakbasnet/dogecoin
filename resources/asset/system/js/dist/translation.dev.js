"use strict";

$(document).ready(function () {
  languageSelector.init();
  translation.init();
});

var languageSelector = function () {
  var $countrySelector = $('#country_id');
  var $languageSelecor = $('#language_code');
  var $prefix = $countrySelector.data('prefix');
  var $url = $countrySelector.data('url');

  var init = function init() {
    registerEventListeners();
  };

  var registerEventListeners = function registerEventListeners() {
    $countrySelector.on('change', handleCountryChange);
  };

  var handleCountryChange = function handleCountryChange() {
    var countyId = $(this).val();
    populateLanguages(countyId);
  };

  var populateLanguages = function populateLanguages(countryId) {
    var $languageOptions = "<option value=\"\">Select Language</option>";
    $.ajax({
      url: $url + '/' + $prefix + '/country-language/' + countryId,
      type: "GET",
      success: function success(response) {
        var languages = response.languages;
        languages.forEach(function (_ref) {
          var name = _ref.name,
              code = _ref.iso639_1;
          $languageOptions += "<option value=\"".concat(code, "\">").concat(name, " (").concat(code, ")</option>");
        });
        $languageSelecor.html($languageOptions);
      },
      error: function error() {
        $.toast({
          heading: 'ERROR',
          text: 'Something went wrong.',
          showHideTransition: 'plain',
          icon: 'error',
          position: 'bottom-center'
        });
      }
    });
  };

  return {
    init: init
  };
}();

var translation = function () {
  var $content = $('.translation-content');

  var init = function init() {
    registerEventListeners();
  };

  var registerEventListeners = function registerEventListeners() {
    $content.on('change', handleContentChange);
  };

  var handleContentChange = function handleContentChange() {
    var group = $(this).data('group');
    var locale = $(this).data('locale');
    updateText($(this).val(), $(this).data('href'), group, locale);
  };

  var updateText = function updateText(value, url, group, locale) {
    var $csrfToken = $('meta[name="csrf"]').attr('content');
    $.ajax({
      url: url,
      type: 'PUT',
      data: {
        text: value,
        group: group,
        locale: locale,
        _token: $csrfToken
      },
      success: function success() {
        $.toast({
          heading: 'Success',
          text: 'Successfully updated.',
          showHideTransition: 'plain',
          icon: 'success',
          position: 'bottom-center'
        });
      },
      error: function error() {
        $.toast({
          heading: 'ERROR',
          text: 'Something went wrong.',
          showHideTransition: 'plain',
          icon: 'error',
          position: 'bottom-center'
        });
      }
    });
  };

  return {
    init: init
  };
}();