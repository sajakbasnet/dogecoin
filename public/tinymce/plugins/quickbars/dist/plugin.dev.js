"use strict";

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

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
  var unique = 0;

  var generate = function generate(prefix) {
    var date = new Date();
    var time = date.getTime();
    var random = Math.floor(Math.random() * 1000000000);
    unique++;
    return prefix + '_' + random + unique + String(time);
  };

  var createTableHtml = function createTableHtml(cols, rows) {
    var x, y, html;
    html = '<table data-mce-id="mce" style="width: 100%">';
    html += '<tbody>';

    for (y = 0; y < rows; y++) {
      html += '<tr>';

      for (x = 0; x < cols; x++) {
        html += '<td><br></td>';
      }

      html += '</tr>';
    }

    html += '</tbody>';
    html += '</table>';
    return html;
  };

  var getInsertedElement = function getInsertedElement(editor) {
    var elms = editor.dom.select('*[data-mce-id]');
    return elms[0];
  };

  var insertTableHtml = function insertTableHtml(editor, cols, rows) {
    editor.undoManager.transact(function () {
      editor.insertContent(createTableHtml(cols, rows));
      var tableElm = getInsertedElement(editor);
      tableElm.removeAttribute('data-mce-id');
      var cellElm = editor.dom.select('td,th', tableElm);
      editor.selection.setCursorLocation(cellElm[0], 0);
    });
  };

  var insertTable = function insertTable(editor, cols, rows) {
    editor.plugins.table ? editor.plugins.table.insertTable(cols, rows) : insertTableHtml(editor, cols, rows);
  };

  var insertBlob = function insertBlob(editor, base64, blob) {
    var blobCache = editor.editorUpload.blobCache;
    var blobInfo = blobCache.create(generate('mceu'), blob, base64);
    blobCache.add(blobInfo);
    editor.insertContent(editor.dom.createHTML('img', {
      src: blobInfo.blobUri()
    }));
  };

  var global$1 = tinymce.util.Tools.resolve('tinymce.util.Promise');

  var blobToBase64 = function blobToBase64(blob) {
    return new global$1(function (resolve) {
      var reader = new FileReader();

      reader.onloadend = function () {
        resolve(reader.result.split(',')[1]);
      };

      reader.readAsDataURL(blob);
    });
  };

  var global$2 = tinymce.util.Tools.resolve('tinymce.Env');
  var global$3 = tinymce.util.Tools.resolve('tinymce.util.Delay');

  var pickFile = function pickFile(editor) {
    return new global$1(function (resolve) {
      var fileInput = document.createElement('input');
      fileInput.type = 'file';
      fileInput.accept = 'image/*';
      fileInput.style.position = 'fixed';
      fileInput.style.left = '0';
      fileInput.style.top = '0';
      fileInput.style.opacity = '0.001';
      document.body.appendChild(fileInput);

      var changeHandler = function changeHandler(e) {
        resolve(Array.prototype.slice.call(e.target.files));
      };

      fileInput.addEventListener('change', changeHandler);

      var cancelHandler = function cancelHandler(e) {
        var cleanup = function cleanup() {
          resolve([]);
          fileInput.parentNode.removeChild(fileInput);
        };

        if (global$2.os.isAndroid() && e.type !== 'remove') {
          global$3.setEditorTimeout(editor, cleanup, 0);
        } else {
          cleanup();
        }

        editor.off('focusin remove', cancelHandler);
      };

      editor.on('focusin remove', cancelHandler);
      fileInput.click();
    });
  };

  var setupButtons = function setupButtons(editor) {
    editor.ui.registry.addButton('quickimage', {
      icon: 'image',
      tooltip: 'Insert image',
      onAction: function onAction() {
        pickFile(editor).then(function (files) {
          if (files.length > 0) {
            var blob_1 = files[0];
            blobToBase64(blob_1).then(function (base64) {
              insertBlob(editor, base64, blob_1);
            });
          }
        });
      }
    });
    editor.ui.registry.addButton('quicktable', {
      icon: 'table',
      tooltip: 'Insert table',
      onAction: function onAction() {
        insertTable(editor, 2, 2);
      }
    });
  };

  var noop = function noop() {};

  var constant = function constant(value) {
    return function () {
      return value;
    };
  };

  var never = constant(false);
  var always = constant(true);

  var none = function none() {
    return NONE;
  };

  var NONE = function () {
    var eq = function eq(o) {
      return o.isNone();
    };

    var call = function call(thunk) {
      return thunk();
    };

    var id = function id(n) {
      return n;
    };

    var me = {
      fold: function fold(n, _s) {
        return n();
      },
      is: never,
      isSome: never,
      isNone: always,
      getOr: id,
      getOrThunk: call,
      getOrDie: function getOrDie(msg) {
        throw new Error(msg || 'error: getOrDie called on none.');
      },
      getOrNull: constant(null),
      getOrUndefined: constant(undefined),
      or: id,
      orThunk: call,
      map: none,
      each: noop,
      bind: none,
      exists: never,
      forall: always,
      filter: none,
      equals: eq,
      equals_: eq,
      toArray: function toArray() {
        return [];
      },
      toString: constant('none()')
    };
    return me;
  }();

  var some = function some(a) {
    var constant_a = constant(a);

    var self = function self() {
      return me;
    };

    var bind = function bind(f) {
      return f(a);
    };

    var me = {
      fold: function fold(n, s) {
        return s(a);
      },
      is: function is(v) {
        return a === v;
      },
      isSome: always,
      isNone: never,
      getOr: constant_a,
      getOrThunk: constant_a,
      getOrDie: constant_a,
      getOrNull: constant_a,
      getOrUndefined: constant_a,
      or: self,
      orThunk: self,
      map: function map(f) {
        return some(f(a));
      },
      each: function each(f) {
        f(a);
      },
      bind: bind,
      exists: bind,
      forall: bind,
      filter: function filter(f) {
        return f(a) ? me : NONE;
      },
      toArray: function toArray() {
        return [a];
      },
      toString: function toString() {
        return 'some(' + a + ')';
      },
      equals: function equals(o) {
        return o.is(a);
      },
      equals_: function equals_(o, elementEq) {
        return o.fold(never, function (b) {
          return elementEq(a, b);
        });
      }
    };
    return me;
  };

  var from = function from(value) {
    return value === null || value === undefined ? NONE : some(value);
  };

  var Optional = {
    some: some,
    none: none,
    from: from
  };

  var typeOf = function typeOf(x) {
    var t = _typeof(x);

    if (x === null) {
      return 'null';
    } else if (t === 'object' && (Array.prototype.isPrototypeOf(x) || x.constructor && x.constructor.name === 'Array')) {
      return 'array';
    } else if (t === 'object' && (String.prototype.isPrototypeOf(x) || x.constructor && x.constructor.name === 'String')) {
      return 'string';
    } else {
      return t;
    }
  };

  var isType = function isType(type) {
    return function (value) {
      return typeOf(value) === type;
    };
  };

  var isSimpleType = function isSimpleType(type) {
    return function (value) {
      return _typeof(value) === type;
    };
  };

  var eq = function eq(t) {
    return function (a) {
      return t === a;
    };
  };

  var isString = isType('string');
  var isObject = isType('object');
  var isArray = isType('array');
  var isBoolean = isSimpleType('boolean');
  var isUndefined = eq(undefined);
  var isFunction = isSimpleType('function');

  function ClosestOrAncestor(is, ancestor, scope, a, isRoot) {
    if (is(scope, a)) {
      return Optional.some(scope);
    } else if (isFunction(isRoot) && isRoot(scope)) {
      return Optional.none();
    } else {
      return ancestor(scope, a, isRoot);
    }
  }

  var ELEMENT = 1;

  var fromHtml = function fromHtml(html, scope) {
    var doc = scope || document;
    var div = doc.createElement('div');
    div.innerHTML = html;

    if (!div.hasChildNodes() || div.childNodes.length > 1) {
      console.error('HTML does not have a single root node', html);
      throw new Error('HTML must have a single root node');
    }

    return fromDom(div.childNodes[0]);
  };

  var fromTag = function fromTag(tag, scope) {
    var doc = scope || document;
    var node = doc.createElement(tag);
    return fromDom(node);
  };

  var fromText = function fromText(text, scope) {
    var doc = scope || document;
    var node = doc.createTextNode(text);
    return fromDom(node);
  };

  var fromDom = function fromDom(node) {
    if (node === null || node === undefined) {
      throw new Error('Node cannot be null or undefined');
    }

    return {
      dom: node
    };
  };

  var fromPoint = function fromPoint(docElm, x, y) {
    return Optional.from(docElm.dom.elementFromPoint(x, y)).map(fromDom);
  };

  var SugarElement = {
    fromHtml: fromHtml,
    fromTag: fromTag,
    fromText: fromText,
    fromDom: fromDom,
    fromPoint: fromPoint
  };

  var is = function is(element, selector) {
    var dom = element.dom;

    if (dom.nodeType !== ELEMENT) {
      return false;
    } else {
      var elem = dom;

      if (elem.matches !== undefined) {
        return elem.matches(selector);
      } else if (elem.msMatchesSelector !== undefined) {
        return elem.msMatchesSelector(selector);
      } else if (elem.webkitMatchesSelector !== undefined) {
        return elem.webkitMatchesSelector(selector);
      } else if (elem.mozMatchesSelector !== undefined) {
        return elem.mozMatchesSelector(selector);
      } else {
        throw new Error('Browser lacks native selectors');
      }
    }
  };

  var Global = typeof window !== 'undefined' ? window : Function('return this;')();

  var name = function name(element) {
    var r = element.dom.nodeName;
    return r.toLowerCase();
  };

  var ancestor = function ancestor(scope, predicate, isRoot) {
    var element = scope.dom;
    var stop = isFunction(isRoot) ? isRoot : never;

    while (element.parentNode) {
      element = element.parentNode;
      var el = SugarElement.fromDom(element);

      if (predicate(el)) {
        return Optional.some(el);
      } else if (stop(el)) {
        break;
      }
    }

    return Optional.none();
  };

  var closest = function closest(scope, predicate, isRoot) {
    var is = function is(s, test) {
      return test(s);
    };

    return ClosestOrAncestor(is, ancestor, scope, predicate, isRoot);
  };

  var ancestor$1 = function ancestor$1(scope, selector, isRoot) {
    return ancestor(scope, function (e) {
      return is(e, selector);
    }, isRoot);
  };

  var closest$1 = function closest$1(scope, selector, isRoot) {
    var is$1 = function is$1(element, selector) {
      return is(element, selector);
    };

    return ClosestOrAncestor(is$1, ancestor$1, scope, selector, isRoot);
  };

  var validDefaultOrDie = function validDefaultOrDie(value, predicate) {
    if (predicate(value)) {
      return true;
    }

    throw new Error('Default value doesn\'t match requested type.');
  };

  var items = function items(value, defaultValue) {
    if (isArray(value) || isObject(value)) {
      throw new Error('expected a string but found: ' + value);
    }

    if (isUndefined(value)) {
      return defaultValue;
    }

    if (isBoolean(value)) {
      return value === false ? '' : defaultValue;
    }

    return value;
  };

  var getToolbarItemsOr_ = function getToolbarItemsOr_(predicate) {
    return function (editor, name, defaultValue) {
      validDefaultOrDie(defaultValue, predicate);
      var value = editor.getParam(name, defaultValue);
      return items(value, defaultValue);
    };
  };

  var getToolbarItemsOr = getToolbarItemsOr_(isString);

  var getTextSelectionToolbarItems = function getTextSelectionToolbarItems(editor) {
    return getToolbarItemsOr(editor, 'quickbars_selection_toolbar', 'bold italic | quicklink h2 h3 blockquote');
  };

  var getInsertToolbarItems = function getInsertToolbarItems(editor) {
    return getToolbarItemsOr(editor, 'quickbars_insert_toolbar', 'quickimage quicktable');
  };

  var getImageToolbarItems = function getImageToolbarItems(editor) {
    return getToolbarItemsOr(editor, 'quickbars_image_toolbar', 'alignleft aligncenter alignright');
  };

  var addToEditor = function addToEditor(editor) {
    var insertToolbarItems = getInsertToolbarItems(editor);

    if (insertToolbarItems.trim().length > 0) {
      editor.ui.registry.addContextToolbar('quickblock', {
        predicate: function predicate(node) {
          var sugarNode = SugarElement.fromDom(node);
          var textBlockElementsMap = editor.schema.getTextBlockElements();

          var isRoot = function isRoot(elem) {
            return elem.dom === editor.getBody();
          };

          return closest$1(sugarNode, 'table', isRoot).fold(function () {
            return closest(sugarNode, function (elem) {
              return name(elem) in textBlockElementsMap && editor.dom.isEmpty(elem.dom);
            }, isRoot).isSome();
          }, never);
        },
        items: insertToolbarItems,
        position: 'line',
        scope: 'editor'
      });
    }
  };

  var addToEditor$1 = function addToEditor$1(editor) {
    var isEditable = function isEditable(node) {
      return editor.dom.getContentEditableParent(node) !== 'false';
    };

    var isImage = function isImage(node) {
      return node.nodeName === 'IMG' || node.nodeName === 'FIGURE' && /image/i.test(node.className);
    };

    var imageToolbarItems = getImageToolbarItems(editor);

    if (imageToolbarItems.trim().length > 0) {
      editor.ui.registry.addContextToolbar('imageselection', {
        predicate: isImage,
        items: imageToolbarItems,
        position: 'node'
      });
    }

    var textToolbarItems = getTextSelectionToolbarItems(editor);

    if (textToolbarItems.trim().length > 0) {
      editor.ui.registry.addContextToolbar('textselection', {
        predicate: function predicate(node) {
          return !isImage(node) && !editor.selection.isCollapsed() && isEditable(node);
        },
        items: textToolbarItems,
        position: 'selection',
        scope: 'editor'
      });
    }
  };

  function Plugin() {
    global.add('quickbars', function (editor) {
      setupButtons(editor);
      addToEditor(editor);
      addToEditor$1(editor);
    });
  }

  Plugin();
})();