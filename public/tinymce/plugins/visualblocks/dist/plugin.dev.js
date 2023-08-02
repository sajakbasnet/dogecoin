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

  var Cell = function Cell(initial) {
    var value = initial;

    var get = function get() {
      return value;
    };

    var set = function set(v) {
      value = v;
    };

    return {
      get: get,
      set: set
    };
  };

  var global = tinymce.util.Tools.resolve('tinymce.PluginManager');

  var fireVisualBlocks = function fireVisualBlocks(editor, state) {
    editor.fire('VisualBlocks', {
      state: state
    });
  };

  var toggleVisualBlocks = function toggleVisualBlocks(editor, pluginUrl, enabledState) {
    var dom = editor.dom;
    dom.toggleClass(editor.getBody(), 'mce-visualblocks');
    enabledState.set(!enabledState.get());
    fireVisualBlocks(editor, enabledState.get());
  };

  var register = function register(editor, pluginUrl, enabledState) {
    editor.addCommand('mceVisualBlocks', function () {
      toggleVisualBlocks(editor, pluginUrl, enabledState);
    });
  };

  var isEnabledByDefault = function isEnabledByDefault(editor) {
    return editor.getParam('visualblocks_default_state', false, 'boolean');
  };

  var setup = function setup(editor, pluginUrl, enabledState) {
    editor.on('PreviewFormats AfterPreviewFormats', function (e) {
      if (enabledState.get()) {
        editor.dom.toggleClass(editor.getBody(), 'mce-visualblocks', e.type === 'afterpreviewformats');
      }
    });
    editor.on('init', function () {
      if (isEnabledByDefault(editor)) {
        toggleVisualBlocks(editor, pluginUrl, enabledState);
      }
    });
  };

  var toggleActiveState = function toggleActiveState(editor, enabledState) {
    return function (api) {
      api.setActive(enabledState.get());

      var editorEventCallback = function editorEventCallback(e) {
        return api.setActive(e.state);
      };

      editor.on('VisualBlocks', editorEventCallback);
      return function () {
        return editor.off('VisualBlocks', editorEventCallback);
      };
    };
  };

  var register$1 = function register$1(editor, enabledState) {
    editor.ui.registry.addToggleButton('visualblocks', {
      icon: 'visualblocks',
      tooltip: 'Show blocks',
      onAction: function onAction() {
        return editor.execCommand('mceVisualBlocks');
      },
      onSetup: toggleActiveState(editor, enabledState)
    });
    editor.ui.registry.addToggleMenuItem('visualblocks', {
      text: 'Show blocks',
      icon: 'visualblocks',
      onAction: function onAction() {
        return editor.execCommand('mceVisualBlocks');
      },
      onSetup: toggleActiveState(editor, enabledState)
    });
  };

  function Plugin() {
    global.add('visualblocks', function (editor, pluginUrl) {
      var enabledState = Cell(false);
      register(editor, pluginUrl, enabledState);
      register$1(editor, enabledState);
      setup(editor, pluginUrl, enabledState);
    });
  }

  Plugin();
})();