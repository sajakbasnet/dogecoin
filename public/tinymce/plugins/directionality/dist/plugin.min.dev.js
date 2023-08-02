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
!function () {
  "use strict";

  var n,
      t,
      e,
      o,
      r = tinymce.util.Tools.resolve("tinymce.PluginManager"),
      u = tinymce.util.Tools.resolve("tinymce.util.Tools"),
      i = function i(n, t) {
    var e,
        o = n.dom,
        r = n.selection.getSelectedBlocks();
    r.length && (e = o.getAttrib(r[0], "dir"), u.each(r, function (n) {
      o.getParent(n.parentNode, '*[dir="' + t + '"]', o.getRoot()) || o.setAttrib(n, "dir", e !== t ? t : null);
    }), n.nodeChanged());
  },
      c = function c(n) {
    return function () {
      return n;
    };
  },
      f = c(!1),
      d = c(!0),
      l = function l() {
    return m;
  },
      m = (n = function n(_n) {
    return _n.isNone();
  }, {
    fold: function fold(n, t) {
      return n();
    },
    is: f,
    isSome: f,
    isNone: d,
    getOr: e = function e(n) {
      return n;
    },
    getOrThunk: t = function t(n) {
      return n();
    },
    getOrDie: function getOrDie(n) {
      throw new Error(n || "error: getOrDie called on none.");
    },
    getOrNull: c(null),
    getOrUndefined: c(undefined),
    or: e,
    orThunk: t,
    map: l,
    each: function each() {},
    bind: l,
    exists: f,
    forall: d,
    filter: l,
    equals: n,
    equals_: n,
    toArray: function toArray() {
      return [];
    },
    toString: c("none()")
  }),
      a = function a(e) {
    var n = c(e),
        t = function t() {
      return r;
    },
        o = function o(n) {
      return n(e);
    },
        r = {
      fold: function fold(n, t) {
        return t(e);
      },
      is: function is(n) {
        return e === n;
      },
      isSome: d,
      isNone: f,
      getOr: n,
      getOrThunk: n,
      getOrDie: n,
      getOrNull: n,
      getOrUndefined: n,
      or: t,
      orThunk: t,
      map: function map(n) {
        return a(n(e));
      },
      each: function each(n) {
        n(e);
      },
      bind: o,
      exists: o,
      forall: o,
      filter: function filter(n) {
        return n(e) ? r : m;
      },
      toArray: function toArray() {
        return [e];
      },
      toString: function toString() {
        return "some(" + e + ")";
      },
      equals: function equals(n) {
        return n.is(e);
      },
      equals_: function equals_(n, t) {
        return n.fold(f, function (n) {
          return t(e, n);
        });
      }
    };

    return r;
  },
      s = {
    some: a,
    none: l,
    from: function from(n) {
      return null === n || n === undefined ? m : a(n);
    }
  },
      g = function g(n) {
    return !(null === (t = n) || t === undefined);
    var t;
  },
      h = (o = "function", function (n) {
    return _typeof(n) === o;
  }),
      v = function v(n) {
    if (null === n || n === undefined) throw new Error("Node cannot be null or undefined");
    return {
      dom: n
    };
  },
      y = {
    fromHtml: function fromHtml(n, t) {
      var e = (t || document).createElement("div");
      if (e.innerHTML = n, !e.hasChildNodes() || 1 < e.childNodes.length) throw console.error("HTML does not have a single root node", n), new Error("HTML must have a single root node");
      return v(e.childNodes[0]);
    },
    fromTag: function fromTag(n, t) {
      var e = (t || document).createElement(n);
      return v(e);
    },
    fromText: function fromText(n, t) {
      var e = (t || document).createTextNode(n);
      return v(e);
    },
    fromDom: v,
    fromPoint: function fromPoint(n, t, e) {
      return s.from(n.dom.elementFromPoint(t, e)).map(v);
    }
  },
      p = ("undefined" != typeof window || Function("return this;")(), function (t) {
    return function (n) {
      return n.dom.nodeType === t;
    };
  }),
      T = p(3),
      N = p(9),
      D = p(11),
      w = h(Element.prototype.attachShadow) && h(Node.prototype.getRootNode) ? function (n) {
    return y.fromDom(n.dom.getRootNode());
  } : function (n) {
    return N(n) ? n : (t = n, y.fromDom(t.dom.ownerDocument));
    var t;
  },
      O = function O(n) {
    var t,
        e = w(n);
    return D(t = e) && g(t.dom.host) ? s.some(e) : s.none();
  },
      C = function C(n) {
    return y.fromDom(n.dom.host);
  },
      S = function S(n) {
    var t = T(n) ? n.dom.parentNode : n.dom;
    if (t === undefined || null === t || null === t.ownerDocument) return !1;
    var e,
        o,
        r = t.ownerDocument;
    return O(y.fromDom(t)).fold(function () {
      return r.body.contains(t);
    }, (e = S, o = C, function (n) {
      return e(o(n));
    }));
  },
      L = function L(n, t) {
    return (e = n).style !== undefined && h(e.style.getPropertyValue) ? n.style.getPropertyValue(t) : "";
    var e;
  },
      R = function R(n) {
    return "rtl" === (e = "direction", o = (t = n).dom, "" !== (r = window.getComputedStyle(o).getPropertyValue(e)) || S(t) ? r : L(o, e)) ? "rtl" : "ltr";
    var t, e, o, r;
  },
      A = function A(t, o) {
    return function (e) {
      var n = function n(_n2) {
        var t = y.fromDom(_n2.element);
        e.setActive(R(t) === o);
      };

      return t.on("NodeChange", n), function () {
        return t.off("NodeChange", n);
      };
    };
  };

  r.add("directionality", function (n) {
    var t, e;
    (t = n).addCommand("mceDirectionLTR", function () {
      i(t, "ltr");
    }), t.addCommand("mceDirectionRTL", function () {
      i(t, "rtl");
    }), (e = n).ui.registry.addToggleButton("ltr", {
      tooltip: "Left to right",
      icon: "ltr",
      onAction: function onAction() {
        return e.execCommand("mceDirectionLTR");
      },
      onSetup: A(e, "ltr")
    }), e.ui.registry.addToggleButton("rtl", {
      tooltip: "Right to left",
      icon: "rtl",
      onAction: function onAction() {
        return e.execCommand("mceDirectionRTL");
      },
      onSetup: A(e, "rtl")
    });
  });
}();