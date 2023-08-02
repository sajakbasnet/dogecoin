"use strict";

$(document).ready(function () {
  sidebar.init();
  confirmDelete.init();
  confirmDeactivate.init();
  fileInput.init();
});

var sidebar = function () {
  var init = function init() {
    highlightModule();
  };

  var highlightModule = function highlightModule() {
    var $navSidebar = $('.nav-sidebar');
    var path = window.location.pathname.split('/');
    var lastSegment = path[path.length - 1];

    if (lastSegment == 'create') {
      path = path[path.length - 2];
    } else if (lastSegment == 'edit') {
      path = path[path.length - 3];
    } else {
      path = lastSegment;
    }

    if (path !== undefined) {
      $navSidebar.find("a[href$='" + path + "']").closest('li').addClass('active');
      $navSidebar.find("a[href$='" + path + "']").parents().eq(2).addClass('active');
      $navSidebar.find("a[href$='" + path + "']").closest('.collapse').collapse();
    }
  };

  return {
    init: init
  };
}();

var confirmDelete = function () {
  var $modal = $('#confirmDeleteModal');
  var $deleteBtn = $('.btn-delete');
  var $deleteForm = $modal.find('form');

  var init = function init() {
    attachEventListeners();
  };

  var attachEventListeners = function attachEventListeners() {
    $deleteBtn.on('click', handleDeleteBtnClick);
    $modal.on('hidden.bs.modal', handleModalHidden);
  };

  var handleDeleteBtnClick = function handleDeleteBtnClick() {
    var url = $(this).data('href');
    setDeleteUrl("".concat(url, "?_method=DELETE"));
  };

  var handleModalHidden = function handleModalHidden() {
    setDeleteUrl('');
  };

  var setDeleteUrl = function setDeleteUrl(url) {
    $deleteForm.attr('action', url);
  };

  return {
    init: init
  };
}();

var confirmDeactivate = function () {
  var $modal = $('#confirmDeactivateModal');
  var $deleteBtn = $('.btn-delete');
  var $deleteForm = $modal.find('form');

  var init = function init() {
    attachEventListeners();
  };

  var attachEventListeners = function attachEventListeners() {
    $deleteBtn.on('click', handleDeleteBtnClick);
    $modal.on('hidden.bs.modal', handleModalHidden);
  };

  var handleDeleteBtnClick = function handleDeleteBtnClick() {
    var url = $(this).data('href');
    setDeleteUrl("".concat(url, "?_method=DELETE"));
  };

  var handleModalHidden = function handleModalHidden() {
    setDeleteUrl('');
  };

  var setDeleteUrl = function setDeleteUrl(url) {
    $deleteForm.attr('action', url);
  };

  return {
    init: init
  };
}();

var fileInput = function () {
  var init = function init() {
    $(document).on('change', '.custom-file-input', function () {
      var files = [];

      for (var i = 0; i < $(this)[0].files.length; i++) {
        files.push($(this)[0].files[i].name);
      }

      $(this).next('.custom-file-label').html(files.join(', '));
    });
  };

  return {
    init: init
  };
}();