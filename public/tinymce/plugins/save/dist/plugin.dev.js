"use strict";

/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 * Licensed under the LGPL or a commercial license.
 * For LGPL see License.txt in the project root for license information.
 * For commercial licenses see https://www.tiny.cloud/
 *
 * Version: 5.7.0 (2021-02-10)
 */
(function () {
  'use strict';

  var global = tinymce.util.Tools.resolve('tinymce.PluginManager');
  var global$1 = tinymce.util.Tools.resolve('tinymce.dom.DOMUtils');
  var global$2 = tinymce.util.Tools.resolve('tinymce.util.Tools');

  var enableWhenDirty = function enableWhenDirty(editor) {
    return editor.getParam('save_enablewhendirty', true);
  };

  var hasOnSaveCallback = function hasOnSaveCallback(editor) {
    return !!editor.getParam('save_onsavecallback');
  };

  var hasOnCancelCallback = function hasOnCancelCallback(editor) {
    return !!editor.getParam('save_oncancelcallback');
  };

  var displayErrorMessage = function displayErrorMessage(editor, message) {
    editor.notificationManager.open({
      text: message,
      type: 'error'
    });
  };

  var save = function save(editor) {
    var formObj = global$1.DOM.getParent(editor.id, 'form');

    if (enableWhenDirty(editor) && !editor.isDirty()) {
      return;
    }

    editor.save();

    if (hasOnSaveCallback(editor)) {
      editor.execCallback('save_onsavecallback', editor);
      editor.nodeChanged();
      return;
    }

    if (formObj) {
      editor.setDirty(false);

      if (!formObj.onsubmit || formObj.onsubmit()) {
        if (typeof formObj.submit === 'function') {
          formObj.submit();
        } else {
          displayErrorMessage(editor, 'Error: Form submit field collision.');
        }
      }

      editor.nodeChanged();
    } else {
      displayErrorMessage(editor, 'Error: No form element found.');
    }
  };

  var cancel = function cancel(editor) {
    var h = global$2.trim(editor.startContent);

    if (hasOnCancelCallback(editor)) {
      editor.execCallback('save_oncancelcallback', editor);
      return;
    }

    editor.resetContent(h);
  };

  var register = function register(editor) {
    editor.addCommand('mceSave', function () {
      save(editor);
    });
    editor.addCommand('mceCancel', function () {
      cancel(editor);
    });
  };

  var stateToggle = function stateToggle(editor) {
    return function (api) {
      var handler = function handler() {
        api.setDisabled(enableWhenDirty(editor) && !editor.isDirty());
      };

      editor.on('NodeChange dirty', handler);
      return function () {
        return editor.off('NodeChange dirty', handler);
      };
    };
  };

  var register$1 = function register$1(editor) {
    editor.ui.registry.addButton('save', {
      icon: 'save',
      tooltip: 'Save',
      disabled: true,
      onAction: function onAction() {
        return editor.execCommand('mceSave');
      },
      onSetup: stateToggle(editor)
    });
    editor.ui.registry.addButton('cancel', {
      icon: 'cancel',
      tooltip: 'Cancel',
      disabled: true,
      onAction: function onAction() {
        return editor.execCommand('mceCancel');
      },
      onSetup: stateToggle(editor)
    });
    editor.addShortcut('Meta+S', '', 'mceSave');
  };

  function Plugin() {
    global.add('save', function (editor) {
      register$1(editor);
      register(editor);
    });
  }

  Plugin();
})();