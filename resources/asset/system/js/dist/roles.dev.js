"use strict";

$(document).ready(function () {
  rolesPermissions.init();
});

var rolesPermissions = function () {
  var $moduleCheckBox = $(".module");
  var $permissionCheckBox = $(".permission");

  var init = function init() {
    registerEvents();
    handleMainModuleCheck();
  };

  var registerEvents = function registerEvents() {
    $moduleCheckBox.on('change', handleSpecificModulePermissionCheck);
    $permissionCheckBox.on('change', handleSpecificMainModuleCheck);
    $permissionCheckBox.on('click', handleViewPermissionCheck);
  };

  var handleSpecificModulePermissionCheck = function handleSpecificModulePermissionCheck() {
    var moduleValue = $(this).data('module');
    $(":checkbox[class='" + moduleValue + "-sub permission" + "']").prop("checked", this.checked);
  };

  var handleSpecificMainModuleCheck = function handleSpecificMainModuleCheck() {
    var moduleValue = $(this).data('module');
    var main = moduleValue.split('-sub');
    var checkBoxes = $(".permission[data-module='" + moduleValue + "']").length;
    var checkedCheckBoxes = $('input[type="checkbox"].' + moduleValue + ':checked').length;

    if (checkBoxes === checkedCheckBoxes) {
      $(".module[data-module='" + main[0] + "']").prop('checked', true);
    } else {
      $(".module[data-module='" + main[0] + "']").prop('checked', false);
    }
  };

  var handleViewPermissionCheck = function handleViewPermissionCheck() {
    if (this.checked) {
      var route = JSON.parse($(this).val());

      if (Array.isArray(route)) {
        route = route[0];
      }

      var keys = route.url.split('/');

      if (!(route.method === 'get' && keys.length === 1)) {
        if (keys.length > 1) {
          var selectRoute = {
            url: '/' + keys[1],
            method: 'get'
          };
          $(":checkbox[value='" + JSON.stringify(selectRoute) + "']").prop("checked", "true");
        } // for nested resource route
        // url = '/campaigns/:campaign_id/products'


        if (keys.length >= 5) {
          var _selectRoute = {
            url: '/' + keys[1] + '/' + keys[2] + '/' + keys[3],
            method: 'get'
          };
          $(":checkbox[value='" + JSON.stringify(_selectRoute) + "']").prop("checked", "true");
        }
      }
    }
  };

  function handleMainModuleCheck() {
    var mainPermissions = $(".module");

    for (var i = mainPermissions.length - 1; i >= 0; i--) {
      var permission = mainPermissions[i];
      var moduleName = $(permission).data("module");
      $(".module[data-module='" + moduleName + "']").prop('checked', false);
      var subModuleName = $(permission).data("module") + '-sub';
      var checkBoxes = $(".permission[data-module='" + subModuleName + "']").length;
      var checkedCheckBoxes = $('input[type="checkbox"].' + subModuleName + ':checked').length;

      if (checkBoxes === checkedCheckBoxes) {
        $(".module[data-module='" + moduleName + "']").prop('checked', true);
      } else {
        $(".module[data-module='" + moduleName + "']").prop('checked', false);
      }
    }
  }

  return {
    init: init
  };
}();