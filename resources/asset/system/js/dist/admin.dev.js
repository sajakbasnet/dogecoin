"use strict";

$(document).ready(function () {
  adminPassword.init();
});

var adminPassword = function () {
  var $radioInput = $('input[type="radio"][name="set_password_status"]');
  var $checkedRadioInput = $('input[type="radio"][name="set_password_status"]:checked');
  var $passwordInputWrapper = $('#password-inputs');

  var init = function init() {
    togglePasswordInputs($checkedRadioInput);
    registerEvents();
  };

  var registerEvents = function registerEvents() {
    $radioInput.on('change', handleInputChange);
  };

  var handleInputChange = function handleInputChange() {
    togglePasswordInputs($(this));
  };

  var togglePasswordInputs = function togglePasswordInputs(input) {
    var displayInputs = !!parseInt(input.val());
    displayInputs ? $passwordInputWrapper.removeClass('d-none') : $passwordInputWrapper.addClass('d-none');
  };

  return {
    init: init
  };
}();