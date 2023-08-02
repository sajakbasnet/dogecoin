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
  var global$1 = tinymce.util.Tools.resolve('tinymce.util.Tools');

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

  var isSimpleType = function isSimpleType(type) {
    return function (value) {
      return _typeof(value) === type;
    };
  };

  var isNullable = function isNullable(a) {
    return a === null || a === undefined;
  };

  var isNonNullable = function isNonNullable(a) {
    return !isNullable(a);
  };

  var isFunction = isSimpleType('function');

  var create = function create(width, height) {
    return resize(document.createElement('canvas'), width, height);
  };

  var clone = function clone(canvas) {
    var tCanvas = create(canvas.width, canvas.height);
    var ctx = get2dContext(tCanvas);
    ctx.drawImage(canvas, 0, 0);
    return tCanvas;
  };

  var get2dContext = function get2dContext(canvas) {
    return canvas.getContext('2d');
  };

  var resize = function resize(canvas, width, height) {
    canvas.width = width;
    canvas.height = height;
    return canvas;
  };

  var getWidth = function getWidth(image) {
    return image.naturalWidth || image.width;
  };

  var getHeight = function getHeight(image) {
    return image.naturalHeight || image.height;
  };

  var promise = function promise() {
    var Promise = function Promise(fn) {
      if (_typeof(this) !== 'object') {
        throw new TypeError('Promises must be constructed via new');
      }

      if (typeof fn !== 'function') {
        throw new TypeError('not a function');
      }

      this._state = null;
      this._value = null;
      this._deferreds = [];
      doResolve(fn, bind(resolve, this), bind(reject, this));
    };

    var anyWindow = window;

    var asap = Promise.immediateFn || typeof anyWindow.setImmediate === 'function' && anyWindow.setImmediate || function (fn) {
      return setTimeout(fn, 1);
    };

    var bind = function bind(fn, thisArg) {
      return function () {
        var args = [];

        for (var _i = 0; _i < arguments.length; _i++) {
          args[_i] = arguments[_i];
        }

        return fn.apply(thisArg, args);
      };
    };

    var isArray = Array.isArray || function (value) {
      return Object.prototype.toString.call(value) === '[object Array]';
    };

    function handle(deferred) {
      var me = this;

      if (this._state === null) {
        this._deferreds.push(deferred);

        return;
      }

      asap(function () {
        var cb = me._state ? deferred.onFulfilled : deferred.onRejected;

        if (cb === null) {
          (me._state ? deferred.resolve : deferred.reject)(me._value);
          return;
        }

        var ret;

        try {
          ret = cb(me._value);
        } catch (e) {
          deferred.reject(e);
          return;
        }

        deferred.resolve(ret);
      });
    }

    function resolve(newValue) {
      try {
        if (newValue === this) {
          throw new TypeError('A promise cannot be resolved with itself.');
        }

        if (newValue && (_typeof(newValue) === 'object' || typeof newValue === 'function')) {
          var then = newValue.then;

          if (typeof then === 'function') {
            doResolve(bind(then, newValue), bind(resolve, this), bind(reject, this));
            return;
          }
        }

        this._state = true;
        this._value = newValue;
        finale.call(this);
      } catch (e) {
        reject.call(this, e);
      }
    }

    function reject(newValue) {
      this._state = false;
      this._value = newValue;
      finale.call(this);
    }

    function finale() {
      for (var _i = 0, _a = this._deferreds; _i < _a.length; _i++) {
        var deferred = _a[_i];
        handle.call(this, deferred);
      }

      this._deferreds = [];
    }

    function Handler(onFulfilled, onRejected, resolve, reject) {
      this.onFulfilled = typeof onFulfilled === 'function' ? onFulfilled : null;
      this.onRejected = typeof onRejected === 'function' ? onRejected : null;
      this.resolve = resolve;
      this.reject = reject;
    }

    var doResolve = function doResolve(fn, onFulfilled, onRejected) {
      var done = false;

      try {
        fn(function (value) {
          if (done) {
            return;
          }

          done = true;
          onFulfilled(value);
        }, function (reason) {
          if (done) {
            return;
          }

          done = true;
          onRejected(reason);
        });
      } catch (ex) {
        if (done) {
          return;
        }

        done = true;
        onRejected(ex);
      }
    };

    Promise.prototype["catch"] = function (onRejected) {
      return this.then(null, onRejected);
    };

    Promise.prototype.then = function (onFulfilled, onRejected) {
      var me = this;
      return new Promise(function (resolve, reject) {
        handle.call(me, new Handler(onFulfilled, onRejected, resolve, reject));
      });
    };

    Promise.all = function () {
      var values = [];

      for (var _i = 0; _i < arguments.length; _i++) {
        values[_i] = arguments[_i];
      }

      var args = Array.prototype.slice.call(values.length === 1 && isArray(values[0]) ? values[0] : values);
      return new Promise(function (resolve, reject) {
        if (args.length === 0) {
          return resolve([]);
        }

        var remaining = args.length;

        var res = function res(i, val) {
          try {
            if (val && (_typeof(val) === 'object' || typeof val === 'function')) {
              var then = val.then;

              if (typeof then === 'function') {
                then.call(val, function (val) {
                  res(i, val);
                }, reject);
                return;
              }
            }

            args[i] = val;

            if (--remaining === 0) {
              resolve(args);
            }
          } catch (ex) {
            reject(ex);
          }
        };

        for (var i = 0; i < args.length; i++) {
          res(i, args[i]);
        }
      });
    };

    Promise.resolve = function (value) {
      if (value && _typeof(value) === 'object' && value.constructor === Promise) {
        return value;
      }

      return new Promise(function (resolve) {
        resolve(value);
      });
    };

    Promise.reject = function (reason) {
      return new Promise(function (resolve, reject) {
        reject(reason);
      });
    };

    Promise.race = function (values) {
      return new Promise(function (resolve, reject) {
        for (var _i = 0, values_1 = values; _i < values_1.length; _i++) {
          var value = values_1[_i];
          value.then(resolve, reject);
        }
      });
    };

    return Promise;
  };

  var Promise = window.Promise ? window.Promise : promise();

  var imageToBlob = function imageToBlob(image) {
    var src = image.src;

    if (src.indexOf('data:') === 0) {
      return dataUriToBlob(src);
    }

    return anyUriToBlob(src);
  };

  var blobToImage = function blobToImage(blob) {
    return new Promise(function (resolve, reject) {
      var blobUrl = URL.createObjectURL(blob);
      var image = new Image();

      var removeListeners = function removeListeners() {
        image.removeEventListener('load', loaded);
        image.removeEventListener('error', error);
      };

      var loaded = function loaded() {
        removeListeners();
        resolve(image);
      };

      var error = function error() {
        removeListeners();
        reject('Unable to load data of type ' + blob.type + ': ' + blobUrl);
      };

      image.addEventListener('load', loaded);
      image.addEventListener('error', error);
      image.src = blobUrl;

      if (image.complete) {
        setTimeout(loaded, 0);
      }
    });
  };

  var anyUriToBlob = function anyUriToBlob(url) {
    return new Promise(function (resolve, reject) {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', url, true);
      xhr.responseType = 'blob';

      xhr.onload = function () {
        if (this.status === 200) {
          resolve(this.response);
        }
      };

      xhr.onerror = function () {
        var _this = this;

        var corsError = function corsError() {
          var obj = new Error('No access to download image');
          obj.code = 18;
          obj.name = 'SecurityError';
          return obj;
        };

        var genericError = function genericError() {
          return new Error('Error ' + _this.status + ' downloading image');
        };

        reject(this.status === 0 ? corsError() : genericError());
      };

      xhr.send();
    });
  };

  var dataUriToBlobSync = function dataUriToBlobSync(uri) {
    var data = uri.split(',');
    var matches = /data:([^;]+)/.exec(data[0]);

    if (!matches) {
      return Optional.none();
    }

    var mimetype = matches[1];
    var base64 = data[1];
    var sliceSize = 1024;
    var byteCharacters = atob(base64);
    var bytesLength = byteCharacters.length;
    var slicesCount = Math.ceil(bytesLength / sliceSize);
    var byteArrays = new Array(slicesCount);

    for (var sliceIndex = 0; sliceIndex < slicesCount; ++sliceIndex) {
      var begin = sliceIndex * sliceSize;
      var end = Math.min(begin + sliceSize, bytesLength);
      var bytes = new Array(end - begin);

      for (var offset = begin, i = 0; offset < end; ++i, ++offset) {
        bytes[i] = byteCharacters[offset].charCodeAt(0);
      }

      byteArrays[sliceIndex] = new Uint8Array(bytes);
    }

    return Optional.some(new Blob(byteArrays, {
      type: mimetype
    }));
  };

  var dataUriToBlob = function dataUriToBlob(uri) {
    return new Promise(function (resolve, reject) {
      dataUriToBlobSync(uri).fold(function () {
        reject('uri is not base64: ' + uri);
      }, resolve);
    });
  };

  var canvasToBlob = function canvasToBlob(canvas, type, quality) {
    type = type || 'image/png';

    if (isFunction(HTMLCanvasElement.prototype.toBlob)) {
      return new Promise(function (resolve, reject) {
        canvas.toBlob(function (blob) {
          if (blob) {
            resolve(blob);
          } else {
            reject();
          }
        }, type, quality);
      });
    } else {
      return dataUriToBlob(canvas.toDataURL(type, quality));
    }
  };

  var canvasToDataURL = function canvasToDataURL(canvas, type, quality) {
    type = type || 'image/png';
    return canvas.toDataURL(type, quality);
  };

  var blobToCanvas = function blobToCanvas(blob) {
    return blobToImage(blob).then(function (image) {
      revokeImageUrl(image);
      var canvas = create(getWidth(image), getHeight(image));
      var context = get2dContext(canvas);
      context.drawImage(image, 0, 0);
      return canvas;
    });
  };

  var blobToDataUri = function blobToDataUri(blob) {
    return new Promise(function (resolve) {
      var reader = new FileReader();

      reader.onloadend = function () {
        resolve(reader.result);
      };

      reader.readAsDataURL(blob);
    });
  };

  var revokeImageUrl = function revokeImageUrl(image) {
    URL.revokeObjectURL(image.src);
  };

  var blobToImage$1 = function blobToImage$1(blob) {
    return blobToImage(blob);
  };

  var imageToBlob$1 = function imageToBlob$1(image) {
    return imageToBlob(image);
  };

  var each = function each(xs, f) {
    for (var i = 0, len = xs.length; i < len; i++) {
      var x = xs[i];
      f(x, i);
    }
  };

  var foldl = function foldl(xs, f, acc) {
    each(xs, function (x) {
      acc = f(acc, x);
    });
    return acc;
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

  var create$1 = function create$1(getCanvas, blob, uri) {
    var initialType = blob.type;
    var getType = constant(initialType);

    var toBlob = function toBlob() {
      return Promise.resolve(blob);
    };

    var toDataURL = constant(uri);

    var toBase64 = function toBase64() {
      return uri.split(',')[1];
    };

    var toAdjustedBlob = function toAdjustedBlob(type, quality) {
      return getCanvas.then(function (canvas) {
        return canvasToBlob(canvas, type, quality);
      });
    };

    var toAdjustedDataURL = function toAdjustedDataURL(type, quality) {
      return getCanvas.then(function (canvas) {
        return canvasToDataURL(canvas, type, quality);
      });
    };

    var toAdjustedBase64 = function toAdjustedBase64(type, quality) {
      return toAdjustedDataURL(type, quality).then(function (dataurl) {
        return dataurl.split(',')[1];
      });
    };

    var toCanvas = function toCanvas() {
      return getCanvas.then(clone);
    };

    return {
      getType: getType,
      toBlob: toBlob,
      toDataURL: toDataURL,
      toBase64: toBase64,
      toAdjustedBlob: toAdjustedBlob,
      toAdjustedDataURL: toAdjustedDataURL,
      toAdjustedBase64: toAdjustedBase64,
      toCanvas: toCanvas
    };
  };

  var fromBlob = function fromBlob(blob) {
    return blobToDataUri(blob).then(function (uri) {
      return create$1(blobToCanvas(blob), blob, uri);
    });
  };

  var fromCanvas = function fromCanvas(canvas, type) {
    return canvasToBlob(canvas, type).then(function (blob) {
      return create$1(Promise.resolve(canvas), blob, canvas.toDataURL());
    });
  };

  var rotate = function rotate(ir, angle) {
    return ir.toCanvas().then(function (canvas) {
      return applyRotate(canvas, ir.getType(), angle);
    });
  };

  var applyRotate = function applyRotate(image, type, angle) {
    var canvas = create(image.width, image.height);
    var context = get2dContext(canvas);
    var translateX = 0;
    var translateY = 0;
    angle = angle < 0 ? 360 + angle : angle;

    if (angle === 90 || angle === 270) {
      resize(canvas, canvas.height, canvas.width);
    }

    if (angle === 90 || angle === 180) {
      translateX = canvas.width;
    }

    if (angle === 270 || angle === 180) {
      translateY = canvas.height;
    }

    context.translate(translateX, translateY);
    context.rotate(angle * Math.PI / 180);
    context.drawImage(image, 0, 0);
    return fromCanvas(canvas, type);
  };

  var flip = function flip(ir, axis) {
    return ir.toCanvas().then(function (canvas) {
      return applyFlip(canvas, ir.getType(), axis);
    });
  };

  var applyFlip = function applyFlip(image, type, axis) {
    var canvas = create(image.width, image.height);
    var context = get2dContext(canvas);

    if (axis === 'v') {
      context.scale(1, -1);
      context.drawImage(image, 0, -canvas.height);
    } else {
      context.scale(-1, 1);
      context.drawImage(image, -canvas.width, 0);
    }

    return fromCanvas(canvas, type);
  };

  var flip$1 = function flip$1(ir, axis) {
    return flip(ir, axis);
  };

  var rotate$1 = function rotate$1(ir, angle) {
    return rotate(ir, angle);
  };

  var keys = Object.keys;

  var each$1 = function each$1(obj, f) {
    var props = keys(obj);

    for (var k = 0, len = props.length; k < len; k++) {
      var i = props[k];
      var x = obj[i];
      f(x, i);
    }
  };

  var sendRequest = function sendRequest(url, headers, withCredentials) {
    if (withCredentials === void 0) {
      withCredentials = false;
    }

    return new Promise(function (resolve) {
      var xhr = new XMLHttpRequest();

      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          resolve({
            status: xhr.status,
            blob: xhr.response
          });
        }
      };

      xhr.open('GET', url, true);
      xhr.withCredentials = withCredentials;
      each$1(headers, function (value, key) {
        xhr.setRequestHeader(key, value);
      });
      xhr.responseType = 'blob';
      xhr.send();
    });
  };

  var readBlobText = function readBlobText(blob) {
    return new Promise(function (resolve, reject) {
      var reader = new FileReader();

      reader.onload = function () {
        resolve(reader.result);
      };

      reader.onerror = function (e) {
        reject(e);
      };

      reader.readAsText(blob);
    });
  };

  var parseJson = function parseJson(text) {
    try {
      return Optional.some(JSON.parse(text));
    } catch (ex) {
      return Optional.none();
    }
  };

  var friendlyHttpErrors = [{
    code: 404,
    message: 'Could not find Image Proxy'
  }, {
    code: 403,
    message: 'Rejected request'
  }, {
    code: 0,
    message: 'Incorrect Image Proxy URL'
  }];
  var friendlyServiceErrors = [{
    type: 'not_found',
    message: 'Failed to load image.'
  }, {
    type: 'key_missing',
    message: 'The request did not include an api key.'
  }, {
    type: 'key_not_found',
    message: 'The provided api key could not be found.'
  }, {
    type: 'domain_not_trusted',
    message: 'The api key is not valid for the request origins.'
  }];

  var traverseJson = function traverseJson(json, path) {
    var value = foldl(path, function (result, key) {
      return isNonNullable(result) ? result[key] : undefined;
    }, json);
    return Optional.from(value);
  };

  var isServiceErrorCode = function isServiceErrorCode(code, blob) {
    return (blob === null || blob === void 0 ? void 0 : blob.type) === 'application/json' && (code === 400 || code === 403 || code === 404 || code === 500);
  };

  var getHttpErrorMsg = function getHttpErrorMsg(status) {
    var message = find(friendlyHttpErrors, function (error) {
      return status === error.code;
    }).fold(constant('Unknown ImageProxy error'), function (error) {
      return error.message;
    });
    return 'ImageProxy HTTP error: ' + message;
  };

  var handleHttpError = function handleHttpError(status) {
    var message = getHttpErrorMsg(status);
    return Promise.reject(message);
  };

  var getServiceErrorMsg = function getServiceErrorMsg(type) {
    return find(friendlyServiceErrors, function (error) {
      return error.type === type;
    }).fold(constant('Unknown service error'), function (error) {
      return error.message;
    });
  };

  var getServiceError = function getServiceError(text) {
    var serviceError = parseJson(text);
    var errorMsg = serviceError.bind(function (err) {
      return traverseJson(err, ['error', 'type']).map(getServiceErrorMsg);
    }).getOr('Invalid JSON in service error message');
    return 'ImageProxy Service error: ' + errorMsg;
  };

  var handleServiceError = function handleServiceError(blob) {
    return readBlobText(blob).then(function (text) {
      var serviceError = getServiceError(text);
      return Promise.reject(serviceError);
    });
  };

  var handleServiceErrorResponse = function handleServiceErrorResponse(status, blob) {
    return isServiceErrorCode(status, blob) ? handleServiceError(blob) : handleHttpError(status);
  };

  var appendApiKey = function appendApiKey(url, apiKey) {
    var separator = url.indexOf('?') === -1 ? '?' : '&';

    if (/[?&]apiKey=/.test(url)) {
      return url;
    } else {
      return url + separator + 'apiKey=' + encodeURIComponent(apiKey);
    }
  };

  var isError = function isError(status) {
    return status < 200 || status >= 300;
  };

  var requestServiceBlob = function requestServiceBlob(url, apiKey) {
    var headers = {
      'Content-Type': 'application/json;charset=UTF-8',
      'tiny-api-key': apiKey
    };
    return sendRequest(appendApiKey(url, apiKey), headers).then(function (result) {
      return isError(result.status) ? handleServiceErrorResponse(result.status, result.blob) : Promise.resolve(result.blob);
    });
  };

  var requestBlob = function requestBlob(url, withCredentials) {
    return sendRequest(url, {}, withCredentials).then(function (result) {
      return isError(result.status) ? handleHttpError(result.status) : Promise.resolve(result.blob);
    });
  };

  var getUrl = function getUrl(url, apiKey, withCredentials) {
    if (withCredentials === void 0) {
      withCredentials = false;
    }

    return apiKey ? requestServiceBlob(url, apiKey) : requestBlob(url, withCredentials);
  };

  var blobToImageResult = function blobToImageResult(blob) {
    return fromBlob(blob);
  };

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

  var child = function child(scope, predicate) {
    var pred = function pred(node) {
      return predicate(SugarElement.fromDom(node));
    };

    var result = find(scope.dom.childNodes, pred);
    return result.map(SugarElement.fromDom);
  };

  var child$1 = function child$1(scope, selector) {
    return child(scope, function (e) {
      return is(e, selector);
    });
  };

  var global$2 = tinymce.util.Tools.resolve('tinymce.util.Delay');
  var global$3 = tinymce.util.Tools.resolve('tinymce.util.Promise');
  var global$4 = tinymce.util.Tools.resolve('tinymce.util.URI');

  var getToolbarItems = function getToolbarItems(editor) {
    return editor.getParam('imagetools_toolbar', 'rotateleft rotateright flipv fliph editimage imageoptions');
  };

  var getProxyUrl = function getProxyUrl(editor) {
    return editor.getParam('imagetools_proxy');
  };

  var getCorsHosts = function getCorsHosts(editor) {
    return editor.getParam('imagetools_cors_hosts', [], 'string[]');
  };

  var getCredentialsHosts = function getCredentialsHosts(editor) {
    return editor.getParam('imagetools_credentials_hosts', [], 'string[]');
  };

  var getFetchImage = function getFetchImage(editor) {
    return Optional.from(editor.getParam('imagetools_fetch_image', null, 'function'));
  };

  var getApiKey = function getApiKey(editor) {
    return editor.getParam('api_key', editor.getParam('imagetools_api_key', '', 'string'), 'string');
  };

  var getUploadTimeout = function getUploadTimeout(editor) {
    return editor.getParam('images_upload_timeout', 30000, 'number');
  };

  var shouldReuseFilename = function shouldReuseFilename(editor) {
    return editor.getParam('images_reuse_filename', false, 'boolean');
  };

  var getImageSize = function getImageSize(img) {
    var width, height;

    var isPxValue = function isPxValue(value) {
      return /^[0-9\.]+px$/.test(value);
    };

    width = img.style.width;
    height = img.style.height;

    if (width || height) {
      if (isPxValue(width) && isPxValue(height)) {
        return {
          w: parseInt(width, 10),
          h: parseInt(height, 10)
        };
      }

      return null;
    }

    width = img.width;
    height = img.height;

    if (width && height) {
      return {
        w: parseInt(width, 10),
        h: parseInt(height, 10)
      };
    }

    return null;
  };

  var setImageSize = function setImageSize(img, size) {
    var width, height;

    if (size) {
      width = img.style.width;
      height = img.style.height;

      if (width || height) {
        img.style.width = size.w + 'px';
        img.style.height = size.h + 'px';
        img.removeAttribute('data-mce-style');
      }

      width = img.width;
      height = img.height;

      if (width || height) {
        img.setAttribute('width', String(size.w));
        img.setAttribute('height', String(size.h));
      }
    }
  };

  var getNaturalImageSize = function getNaturalImageSize(img) {
    return {
      w: img.naturalWidth,
      h: img.naturalHeight
    };
  };

  var count = 0;

  var getFigureImg = function getFigureImg(elem) {
    return child$1(SugarElement.fromDom(elem), 'img');
  };

  var isFigure = function isFigure(editor, elem) {
    return editor.dom.is(elem, 'figure');
  };

  var isImage = function isImage(editor, imgNode) {
    return editor.dom.is(imgNode, 'img:not([data-mce-object],[data-mce-placeholder])');
  };

  var getEditableImage = function getEditableImage(editor, node) {
    var isEditable = function isEditable(imgNode) {
      return isImage(editor, imgNode) && (isLocalImage(editor, imgNode) || isCorsImage(editor, imgNode) || isNonNullable(getProxyUrl(editor)));
    };

    if (isFigure(editor, node)) {
      return getFigureImg(node).bind(function (img) {
        return isEditable(img.dom) ? Optional.some(img.dom) : Optional.none();
      });
    } else {
      return isEditable(node) ? Optional.some(node) : Optional.none();
    }
  };

  var displayError = function displayError(editor, error) {
    editor.notificationManager.open({
      text: error,
      type: 'error'
    });
  };

  var getSelectedImage = function getSelectedImage(editor) {
    var elem = editor.selection.getNode();
    var figureElm = editor.dom.getParent(elem, 'figure.image');

    if (figureElm !== null && isFigure(editor, figureElm)) {
      return getFigureImg(figureElm);
    } else if (isImage(editor, elem)) {
      return Optional.some(SugarElement.fromDom(elem));
    } else {
      return Optional.none();
    }
  };

  var extractFilename = function extractFilename(editor, url, group) {
    var m = url.match(/(?:\/|^)(([^\/\?]+)\.(?:[a-z0-9.]+))(?:\?|$)/i);
    return isNonNullable(m) ? editor.dom.encode(m[group]) : null;
  };

  var createId = function createId() {
    return 'imagetools' + count++;
  };

  var isLocalImage = function isLocalImage(editor, img) {
    var url = img.src;
    return url.indexOf('data:') === 0 || url.indexOf('blob:') === 0 || new global$4(url).host === editor.documentBaseURI.host;
  };

  var isCorsImage = function isCorsImage(editor, img) {
    return global$1.inArray(getCorsHosts(editor), new global$4(img.src).host) !== -1;
  };

  var isCorsWithCredentialsImage = function isCorsWithCredentialsImage(editor, img) {
    return global$1.inArray(getCredentialsHosts(editor), new global$4(img.src).host) !== -1;
  };

  var defaultFetchImage = function defaultFetchImage(editor, img) {
    if (isCorsImage(editor, img)) {
      return getUrl(img.src, null, isCorsWithCredentialsImage(editor, img));
    }

    if (!isLocalImage(editor, img)) {
      var proxyUrl = getProxyUrl(editor);
      var src = proxyUrl + (proxyUrl.indexOf('?') === -1 ? '?' : '&') + 'url=' + encodeURIComponent(img.src);
      var apiKey = getApiKey(editor);
      return getUrl(src, apiKey, false);
    }

    return imageToBlob$1(img);
  };

  var imageToBlob$2 = function imageToBlob$2(editor, img) {
    return getFetchImage(editor).fold(function () {
      return defaultFetchImage(editor, img);
    }, function (customFetchImage) {
      return customFetchImage(img);
    });
  };

  var findBlob = function findBlob(editor, img) {
    var blobInfo = editor.editorUpload.blobCache.getByUri(img.src);

    if (blobInfo) {
      return global$3.resolve(blobInfo.blob());
    }

    return imageToBlob$2(editor, img);
  };

  var startTimedUpload = function startTimedUpload(editor, imageUploadTimerState) {
    var imageUploadTimer = global$2.setEditorTimeout(editor, function () {
      editor.editorUpload.uploadImagesAuto();
    }, getUploadTimeout(editor));
    imageUploadTimerState.set(imageUploadTimer);
  };

  var cancelTimedUpload = function cancelTimedUpload(imageUploadTimerState) {
    global$2.clearTimeout(imageUploadTimerState.get());
  };

  var updateSelectedImage = function updateSelectedImage(editor, origBlob, ir, uploadImmediately, imageUploadTimerState, selectedImage, size) {
    return ir.toBlob().then(function (blob) {
      var uri, name, filename, blobInfo;
      var blobCache = editor.editorUpload.blobCache;
      uri = selectedImage.src;
      var useFilename = origBlob.type === blob.type;

      if (shouldReuseFilename(editor)) {
        blobInfo = blobCache.getByUri(uri);

        if (isNonNullable(blobInfo)) {
          uri = blobInfo.uri();
          name = blobInfo.name();
          filename = blobInfo.filename();
        } else {
          name = extractFilename(editor, uri, 2);
          filename = extractFilename(editor, uri, 1);
        }
      }

      blobInfo = blobCache.create({
        id: createId(),
        blob: blob,
        base64: ir.toBase64(),
        uri: uri,
        name: name,
        filename: useFilename ? filename : undefined
      });
      blobCache.add(blobInfo);
      editor.undoManager.transact(function () {
        var imageLoadedHandler = function imageLoadedHandler() {
          editor.$(selectedImage).off('load', imageLoadedHandler);
          editor.nodeChanged();

          if (uploadImmediately) {
            editor.editorUpload.uploadImagesAuto();
          } else {
            cancelTimedUpload(imageUploadTimerState);
            startTimedUpload(editor, imageUploadTimerState);
          }
        };

        editor.$(selectedImage).on('load', imageLoadedHandler);

        if (size) {
          editor.$(selectedImage).attr({
            width: size.w,
            height: size.h
          });
        }

        editor.$(selectedImage).attr({
          src: blobInfo.blobUri()
        }).removeAttr('data-mce-src');
      });
      return blobInfo;
    });
  };

  var selectedImageOperation = function selectedImageOperation(editor, imageUploadTimerState, fn, size) {
    return function () {
      var imgOpt = getSelectedImage(editor);
      return imgOpt.fold(function () {
        displayError(editor, 'Could not find selected image');
      }, function (img) {
        return editor._scanForImages().then(function () {
          return findBlob(editor, img.dom);
        }).then(function (blob) {
          return blobToImageResult(blob).then(fn).then(function (imageResult) {
            return updateSelectedImage(editor, blob, imageResult, false, imageUploadTimerState, img.dom, size);
          });
        })["catch"](function (error) {
          displayError(editor, error);
        });
      });
    };
  };

  var rotate$2 = function rotate$2(editor, imageUploadTimerState, angle) {
    return function () {
      var imgOpt = getSelectedImage(editor);
      var flippedSize = imgOpt.fold(function () {
        return null;
      }, function (img) {
        var size = getImageSize(img.dom);
        return size ? {
          w: size.h,
          h: size.w
        } : null;
      });
      return selectedImageOperation(editor, imageUploadTimerState, function (imageResult) {
        return rotate$1(imageResult, angle);
      }, flippedSize)();
    };
  };

  var flip$2 = function flip$2(editor, imageUploadTimerState, axis) {
    return function () {
      return selectedImageOperation(editor, imageUploadTimerState, function (imageResult) {
        return flip$1(imageResult, axis);
      })();
    };
  };

  var handleDialogBlob = function handleDialogBlob(editor, imageUploadTimerState, img, originalSize, blob) {
    return blobToImage$1(blob).then(function (newImage) {
      var newSize = getNaturalImageSize(newImage);

      if (originalSize.w !== newSize.w || originalSize.h !== newSize.h) {
        if (getImageSize(img)) {
          setImageSize(img, newSize);
        }
      }

      URL.revokeObjectURL(newImage.src);
      return blob;
    }).then(blobToImageResult).then(function (imageResult) {
      return updateSelectedImage(editor, blob, imageResult, true, imageUploadTimerState, img);
    });
  };

  var saveState = 'save-state';
  var disable = 'disable';
  var enable = 'enable';

  var createState = function createState(blob) {
    return {
      blob: blob,
      url: URL.createObjectURL(blob)
    };
  };

  var makeOpen = function makeOpen(editor, imageUploadTimerState) {
    return function () {
      var getLoadedSpec = function getLoadedSpec(currentState) {
        return {
          title: 'Edit Image',
          size: 'large',
          body: {
            type: 'panel',
            items: [{
              type: 'imagetools',
              name: 'imagetools',
              label: 'Edit Image',
              currentState: currentState
            }]
          },
          buttons: [{
            type: 'cancel',
            name: 'cancel',
            text: 'Cancel'
          }, {
            type: 'submit',
            name: 'save',
            text: 'Save',
            primary: true,
            disabled: true
          }],
          onSubmit: function onSubmit(api) {
            var blob = api.getData().imagetools.blob;
            originalImgOpt.each(function (originalImg) {
              originalSizeOpt.each(function (originalSize) {
                handleDialogBlob(editor, imageUploadTimerState, originalImg.dom, originalSize, blob);
              });
            });
            api.close();
          },
          onCancel: noop,
          onAction: function onAction(api, details) {
            switch (details.name) {
              case saveState:
                if (details.value) {
                  api.enable('save');
                } else {
                  api.disable('save');
                }

                break;

              case disable:
                api.disable('save');
                api.disable('cancel');
                break;

              case enable:
                api.enable('cancel');
                break;
            }
          }
        };
      };

      var originalImgOpt = getSelectedImage(editor);
      var originalSizeOpt = originalImgOpt.map(function (origImg) {
        return getNaturalImageSize(origImg.dom);
      });
      originalImgOpt.each(function (img) {
        getEditableImage(editor, img.dom).each(function (_) {
          findBlob(editor, img.dom).then(function (blob) {
            var state = createState(blob);
            editor.windowManager.open(getLoadedSpec(state));
          });
        });
      });
    };
  };

  var register = function register(editor, imageUploadTimerState) {
    global$1.each({
      mceImageRotateLeft: rotate$2(editor, imageUploadTimerState, -90),
      mceImageRotateRight: rotate$2(editor, imageUploadTimerState, 90),
      mceImageFlipVertical: flip$2(editor, imageUploadTimerState, 'v'),
      mceImageFlipHorizontal: flip$2(editor, imageUploadTimerState, 'h'),
      mceEditImage: makeOpen(editor, imageUploadTimerState)
    }, function (fn, cmd) {
      editor.addCommand(cmd, fn);
    });
  };

  var setup = function setup(editor, imageUploadTimerState, lastSelectedImageState) {
    editor.on('NodeChange', function (e) {
      var lastSelectedImage = lastSelectedImageState.get();
      var selectedImage = getEditableImage(editor, e.element);

      if (lastSelectedImage && !selectedImage.exists(function (img) {
        return lastSelectedImage.src === img.src;
      })) {
        cancelTimedUpload(imageUploadTimerState);
        editor.editorUpload.uploadImagesAuto();
        lastSelectedImageState.set(null);
      }

      selectedImage.each(lastSelectedImageState.set);
    });
  };

  var register$1 = function register$1(editor) {
    var cmd = function cmd(command) {
      return function () {
        return editor.execCommand(command);
      };
    };

    editor.ui.registry.addButton('rotateleft', {
      tooltip: 'Rotate counterclockwise',
      icon: 'rotate-left',
      onAction: cmd('mceImageRotateLeft')
    });
    editor.ui.registry.addButton('rotateright', {
      tooltip: 'Rotate clockwise',
      icon: 'rotate-right',
      onAction: cmd('mceImageRotateRight')
    });
    editor.ui.registry.addButton('flipv', {
      tooltip: 'Flip vertically',
      icon: 'flip-vertically',
      onAction: cmd('mceImageFlipVertical')
    });
    editor.ui.registry.addButton('fliph', {
      tooltip: 'Flip horizontally',
      icon: 'flip-horizontally',
      onAction: cmd('mceImageFlipHorizontal')
    });
    editor.ui.registry.addButton('editimage', {
      tooltip: 'Edit image',
      icon: 'edit-image',
      onAction: cmd('mceEditImage'),
      onSetup: function onSetup(buttonApi) {
        var setDisabled = function setDisabled() {
          var disabled = getSelectedImage(editor).forall(function (element) {
            return getEditableImage(editor, element.dom).isNone();
          });
          buttonApi.setDisabled(disabled);
        };

        editor.on('NodeChange', setDisabled);
        return function () {
          editor.off('NodeChange', setDisabled);
        };
      }
    });
    editor.ui.registry.addButton('imageoptions', {
      tooltip: 'Image options',
      icon: 'image',
      onAction: cmd('mceImage')
    });
    editor.ui.registry.addContextMenu('imagetools', {
      update: function update(element) {
        return getEditableImage(editor, element).fold(function () {
          return [];
        }, function (_) {
          return [{
            text: 'Edit image',
            icon: 'edit-image',
            onAction: cmd('mceEditImage')
          }];
        });
      }
    });
  };

  var register$2 = function register$2(editor) {
    editor.ui.registry.addContextToolbar('imagetools', {
      items: getToolbarItems(editor),
      predicate: function predicate(elem) {
        return getEditableImage(editor, elem).isSome();
      },
      position: 'node',
      scope: 'node'
    });
  };

  function Plugin() {
    global.add('imagetools', function (editor) {
      var imageUploadTimerState = Cell(0);
      var lastSelectedImageState = Cell(null);
      register(editor, imageUploadTimerState);
      register$1(editor);
      register$2(editor);
      setup(editor, imageUploadTimerState, lastSelectedImageState);
    });
  }

  Plugin();
})();