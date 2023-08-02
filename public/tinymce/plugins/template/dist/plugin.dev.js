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

  var noop = function noop() {};

  var constant = function constant(value) {
    return function () {
      return value;
    };
  };

  function curry(fn) {
    var initialArgs = [];

    for (var _i = 1; _i < arguments.length; _i++) {
      initialArgs[_i - 1] = arguments[_i];
    }

    return function () {
      var restArgs = [];

      for (var _i = 0; _i < arguments.length; _i++) {
        restArgs[_i] = arguments[_i];
      }

      var all = initialArgs.concat(restArgs);
      return fn.apply(null, all);
    };
  }

  var never = constant(false);
  var always = constant(true);
  var global$1 = tinymce.util.Tools.resolve('tinymce.util.Tools');
  var global$2 = tinymce.util.Tools.resolve('tinymce.util.XHR');

  var getCreationDateClasses = function getCreationDateClasses(editor) {
    return editor.getParam('template_cdate_classes', 'cdate');
  };

  var getModificationDateClasses = function getModificationDateClasses(editor) {
    return editor.getParam('template_mdate_classes', 'mdate');
  };

  var getSelectedContentClasses = function getSelectedContentClasses(editor) {
    return editor.getParam('template_selected_content_classes', 'selcontent');
  };

  var getPreviewReplaceValues = function getPreviewReplaceValues(editor) {
    return editor.getParam('template_preview_replace_values');
  };

  var getContentStyle = function getContentStyle(editor) {
    return editor.getParam('content_style', '', 'string');
  };

  var shouldUseContentCssCors = function shouldUseContentCssCors(editor) {
    return editor.getParam('content_css_cors', false, 'boolean');
  };

  var getTemplateReplaceValues = function getTemplateReplaceValues(editor) {
    return editor.getParam('template_replace_values');
  };

  var getTemplates = function getTemplates(editor) {
    return editor.getParam('templates');
  };

  var getCdateFormat = function getCdateFormat(editor) {
    return editor.getParam('template_cdate_format', editor.translate('%Y-%m-%d'));
  };

  var getMdateFormat = function getMdateFormat(editor) {
    return editor.getParam('template_mdate_format', editor.translate('%Y-%m-%d'));
  };

  var getBodyClassFromHash = function getBodyClassFromHash(editor) {
    var bodyClass = editor.getParam('body_class', '', 'hash');
    return bodyClass[editor.id] || '';
  };

  var getBodyClass = function getBodyClass(editor) {
    var bodyClass = editor.getParam('body_class', '', 'string');

    if (bodyClass.indexOf('=') === -1) {
      return bodyClass;
    } else {
      return getBodyClassFromHash(editor);
    }
  };

  var addZeros = function addZeros(value, len) {
    value = '' + value;

    if (value.length < len) {
      for (var i = 0; i < len - value.length; i++) {
        value = '0' + value;
      }
    }

    return value;
  };

  var getDateTime = function getDateTime(editor, fmt, date) {
    var daysShort = 'Sun Mon Tue Wed Thu Fri Sat Sun'.split(' ');
    var daysLong = 'Sunday Monday Tuesday Wednesday Thursday Friday Saturday Sunday'.split(' ');
    var monthsShort = 'Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec'.split(' ');
    var monthsLong = 'January February March April May June July August September October November December'.split(' ');
    date = date || new Date();
    fmt = fmt.replace('%D', '%m/%d/%Y');
    fmt = fmt.replace('%r', '%I:%M:%S %p');
    fmt = fmt.replace('%Y', '' + date.getFullYear());
    fmt = fmt.replace('%y', '' + date.getYear());
    fmt = fmt.replace('%m', addZeros(date.getMonth() + 1, 2));
    fmt = fmt.replace('%d', addZeros(date.getDate(), 2));
    fmt = fmt.replace('%H', '' + addZeros(date.getHours(), 2));
    fmt = fmt.replace('%M', '' + addZeros(date.getMinutes(), 2));
    fmt = fmt.replace('%S', '' + addZeros(date.getSeconds(), 2));
    fmt = fmt.replace('%I', '' + ((date.getHours() + 11) % 12 + 1));
    fmt = fmt.replace('%p', '' + (date.getHours() < 12 ? 'AM' : 'PM'));
    fmt = fmt.replace('%B', '' + editor.translate(monthsLong[date.getMonth()]));
    fmt = fmt.replace('%b', '' + editor.translate(monthsShort[date.getMonth()]));
    fmt = fmt.replace('%A', '' + editor.translate(daysLong[date.getDay()]));
    fmt = fmt.replace('%a', '' + editor.translate(daysShort[date.getDay()]));
    fmt = fmt.replace('%%', '%');
    return fmt;
  };

  var createTemplateList = function createTemplateList(editor, callback) {
    return function () {
      var templateList = getTemplates(editor);

      if (typeof templateList === 'function') {
        templateList(callback);
        return;
      }

      if (typeof templateList === 'string') {
        global$2.send({
          url: templateList,
          success: function success(text) {
            callback(JSON.parse(text));
          }
        });
      } else {
        callback(templateList);
      }
    };
  };

  var replaceTemplateValues = function replaceTemplateValues(html, templateValues) {
    global$1.each(templateValues, function (v, k) {
      if (typeof v === 'function') {
        v = v(k);
      }

      html = html.replace(new RegExp('\\{\\$' + k + '\\}', 'g'), v);
    });
    return html;
  };

  var replaceVals = function replaceVals(editor, e) {
    var dom = editor.dom,
        vl = getTemplateReplaceValues(editor);
    global$1.each(dom.select('*', e), function (e) {
      global$1.each(vl, function (v, k) {
        if (dom.hasClass(e, k)) {
          if (typeof vl[k] === 'function') {
            vl[k](e);
          }
        }
      });
    });
  };

  var hasClass = function hasClass(n, c) {
    return new RegExp('\\b' + c + '\\b', 'g').test(n.className);
  };

  var insertTemplate = function insertTemplate(editor, _ui, html) {
    var el;
    var dom = editor.dom;
    var sel = editor.selection.getContent();
    html = replaceTemplateValues(html, getTemplateReplaceValues(editor));
    el = dom.create('div', null, html);
    var n = dom.select('.mceTmpl', el);

    if (n && n.length > 0) {
      el = dom.create('div', null);
      el.appendChild(n[0].cloneNode(true));
    }

    global$1.each(dom.select('*', el), function (n) {
      if (hasClass(n, getCreationDateClasses(editor).replace(/\s+/g, '|'))) {
        n.innerHTML = getDateTime(editor, getCdateFormat(editor));
      }

      if (hasClass(n, getModificationDateClasses(editor).replace(/\s+/g, '|'))) {
        n.innerHTML = getDateTime(editor, getMdateFormat(editor));
      }

      if (hasClass(n, getSelectedContentClasses(editor).replace(/\s+/g, '|'))) {
        n.innerHTML = sel;
      }
    });
    replaceVals(editor, el);
    editor.execCommand('mceInsertContent', false, el.innerHTML);
    editor.addVisual();
  };

  var register = function register(editor) {
    editor.addCommand('mceInsertTemplate', curry(insertTemplate, editor));
  };

  var setup = function setup(editor) {
    editor.on('PreProcess', function (o) {
      var dom = editor.dom,
          dateFormat = getMdateFormat(editor);
      global$1.each(dom.select('div', o.node), function (e) {
        if (dom.hasClass(e, 'mceTmpl')) {
          global$1.each(dom.select('*', e), function (e) {
            if (dom.hasClass(e, getModificationDateClasses(editor).replace(/\s+/g, '|'))) {
              e.innerHTML = getDateTime(editor, dateFormat);
            }
          });
          replaceVals(editor, e);
        }
      });
    });
  };

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

  var map = function map(xs, f) {
    var len = xs.length;
    var r = new Array(len);

    for (var i = 0; i < len; i++) {
      var x = xs[i];
      r[i] = f(x, i);
    }

    return r;
  };

  var findUntil = function findUntil(xs, pred, until) {
    for (var i = 0, len = xs.length; i < len; i++) {
      var x = xs[i];

      if (pred(x, i)) {
        return Optional.some(x);
      } else if (until(x, i)) {
        break;
      }
    }

    return Optional.none();
  };

  var find = function find(xs, pred) {
    return findUntil(xs, pred, never);
  };

  var global$3 = tinymce.util.Tools.resolve('tinymce.Env');
  var global$4 = tinymce.util.Tools.resolve('tinymce.util.Promise');
  var hasOwnProperty = Object.hasOwnProperty;

  var get = function get(obj, key) {
    return has(obj, key) ? Optional.from(obj[key]) : Optional.none();
  };

  var has = function has(obj, key) {
    return hasOwnProperty.call(obj, key);
  };

  var entitiesAttr = {
    '"': '&quot;',
    '<': '&lt;',
    '>': '&gt;',
    '&': '&amp;',
    '\'': '&#039;'
  };

  var htmlEscape = function htmlEscape(html) {
    return html.replace(/["'<>&]/g, function (match) {
      return get(entitiesAttr, match).getOr(match);
    });
  };

  var getPreviewContent = function getPreviewContent(editor, html) {
    if (html.indexOf('<html>') === -1) {
      var contentCssEntries_1 = '';
      var contentStyle = getContentStyle(editor);
      var cors_1 = shouldUseContentCssCors(editor) ? ' crossorigin="anonymous"' : '';
      global$1.each(editor.contentCSS, function (url) {
        contentCssEntries_1 += '<link type="text/css" rel="stylesheet" href="' + editor.documentBaseURI.toAbsolute(url) + '"' + cors_1 + '>';
      });

      if (contentStyle) {
        contentCssEntries_1 += '<style type="text/css">' + contentStyle + '</style>';
      }

      var bodyClass = getBodyClass(editor);
      var encode = editor.dom.encode;
      var isMetaKeyPressed = global$3.mac ? 'e.metaKey' : 'e.ctrlKey && !e.altKey';
      var preventClicksOnLinksScript = '<script>' + 'document.addEventListener && document.addEventListener("click", function(e) {' + 'for (var elm = e.target; elm; elm = elm.parentNode) {' + 'if (elm.nodeName === "A" && !(' + isMetaKeyPressed + ')) {' + 'e.preventDefault();' + '}' + '}' + '}, false);' + '</script> ';
      var directionality = editor.getBody().dir;
      var dirAttr = directionality ? ' dir="' + encode(directionality) + '"' : '';
      html = '<!DOCTYPE html>' + '<html>' + '<head>' + '<base href="' + encode(editor.documentBaseURI.getURI()) + '">' + contentCssEntries_1 + preventClicksOnLinksScript + '</head>' + '<body class="' + encode(bodyClass) + '"' + dirAttr + '>' + html + '</body>' + '</html>';
    }

    return replaceTemplateValues(html, getPreviewReplaceValues(editor));
  };

  var open = function open(editor, templateList) {
    var createTemplates = function createTemplates() {
      if (!templateList || templateList.length === 0) {
        var message = editor.translate('No templates defined.');
        editor.notificationManager.open({
          text: message,
          type: 'info'
        });
        return Optional.none();
      }

      return Optional.from(global$1.map(templateList, function (template, index) {
        var isUrlTemplate = function isUrlTemplate(t) {
          return t.url !== undefined;
        };

        return {
          selected: index === 0,
          text: template.title,
          value: {
            url: isUrlTemplate(template) ? Optional.from(template.url) : Optional.none(),
            content: !isUrlTemplate(template) ? Optional.from(template.content) : Optional.none(),
            description: template.description
          }
        };
      }));
    };

    var createSelectBoxItems = function createSelectBoxItems(templates) {
      return map(templates, function (t) {
        return {
          text: t.text,
          value: t.text
        };
      });
    };

    var findTemplate = function findTemplate(templates, templateTitle) {
      return find(templates, function (t) {
        return t.text === templateTitle;
      });
    };

    var loadFailedAlert = function loadFailedAlert(api) {
      editor.windowManager.alert('Could not load the specified template.', function () {
        return api.focus('template');
      });
    };

    var getTemplateContent = function getTemplateContent(t) {
      return new global$4(function (resolve, reject) {
        t.value.url.fold(function () {
          return resolve(t.value.content.getOr(''));
        }, function (url) {
          return global$2.send({
            url: url,
            success: function success(html) {
              resolve(html);
            },
            error: function error(e) {
              reject(e);
            }
          });
        });
      });
    };

    var onChange = function onChange(templates, updateDialog) {
      return function (api, change) {
        if (change.name === 'template') {
          var newTemplateTitle = api.getData().template;
          findTemplate(templates, newTemplateTitle).each(function (t) {
            api.block('Loading...');
            getTemplateContent(t).then(function (previewHtml) {
              updateDialog(api, t, previewHtml);
            })["catch"](function () {
              updateDialog(api, t, '');
              api.disable('save');
              loadFailedAlert(api);
            });
          });
        }
      };
    };

    var onSubmit = function onSubmit(templates) {
      return function (api) {
        var data = api.getData();
        findTemplate(templates, data.template).each(function (t) {
          getTemplateContent(t).then(function (previewHtml) {
            insertTemplate(editor, false, previewHtml);
            api.close();
          })["catch"](function () {
            api.disable('save');
            loadFailedAlert(api);
          });
        });
      };
    };

    var openDialog = function openDialog(templates) {
      var selectBoxItems = createSelectBoxItems(templates);

      var buildDialogSpec = function buildDialogSpec(bodyItems, initialData) {
        return {
          title: 'Insert Template',
          size: 'large',
          body: {
            type: 'panel',
            items: bodyItems
          },
          initialData: initialData,
          buttons: [{
            type: 'cancel',
            name: 'cancel',
            text: 'Cancel'
          }, {
            type: 'submit',
            name: 'save',
            text: 'Save',
            primary: true
          }],
          onSubmit: onSubmit(templates),
          onChange: onChange(templates, updateDialog)
        };
      };

      var updateDialog = function updateDialog(dialogApi, template, previewHtml) {
        var content = getPreviewContent(editor, previewHtml);
        var bodyItems = [{
          type: 'selectbox',
          name: 'template',
          label: 'Templates',
          items: selectBoxItems
        }, {
          type: 'htmlpanel',
          html: '<p aria-live="polite">' + htmlEscape(template.value.description) + '</p>'
        }, {
          label: 'Preview',
          type: 'iframe',
          name: 'preview',
          sandboxed: false
        }];
        var initialData = {
          template: template.text,
          preview: content
        };
        dialogApi.unblock();
        dialogApi.redial(buildDialogSpec(bodyItems, initialData));
        dialogApi.focus('template');
      };

      var dialogApi = editor.windowManager.open(buildDialogSpec([], {
        template: '',
        preview: ''
      }));
      dialogApi.block('Loading...');
      getTemplateContent(templates[0]).then(function (previewHtml) {
        updateDialog(dialogApi, templates[0], previewHtml);
      })["catch"](function () {
        updateDialog(dialogApi, templates[0], '');
        dialogApi.disable('save');
        loadFailedAlert(dialogApi);
      });
    };

    var optTemplates = createTemplates();
    optTemplates.each(openDialog);
  };

  var showDialog = function showDialog(editor) {
    return function (templates) {
      open(editor, templates);
    };
  };

  var register$1 = function register$1(editor) {
    editor.ui.registry.addButton('template', {
      icon: 'template',
      tooltip: 'Insert template',
      onAction: createTemplateList(editor, showDialog(editor))
    });
    editor.ui.registry.addMenuItem('template', {
      icon: 'template',
      text: 'Insert template...',
      onAction: createTemplateList(editor, showDialog(editor))
    });
  };

  function Plugin() {
    global.add('template', function (editor) {
      register$1(editor);
      register(editor);
      setup(editor);
    });
  }

  Plugin();
})();