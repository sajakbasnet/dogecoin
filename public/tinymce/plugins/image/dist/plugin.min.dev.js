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

  var e,
      t,
      n,
      r,
      o,
      i = tinymce.util.Tools.resolve("tinymce.PluginManager"),
      _c = function c() {
    return (_c = Object.assign || function (e) {
      for (var t, n = 1, r = arguments.length; n < r; n++) {
        for (var i in t = arguments[n]) {
          Object.prototype.hasOwnProperty.call(t, i) && (e[i] = t[i]);
        }
      }

      return e;
    }).apply(this, arguments);
  },
      a = function a() {},
      l = function l(e) {
    return function () {
      return e;
    };
  },
      s = l(!1),
      u = l(!0),
      m = function m() {
    return d;
  },
      d = (e = function e(_e2) {
    return _e2.isNone();
  }, {
    fold: function fold(e, t) {
      return e();
    },
    is: s,
    isSome: s,
    isNone: u,
    getOr: n = function n(e) {
      return e;
    },
    getOrThunk: t = function t(e) {
      return e();
    },
    getOrDie: function getOrDie(e) {
      throw new Error(e || "error: getOrDie called on none.");
    },
    getOrNull: l(null),
    getOrUndefined: l(undefined),
    or: n,
    orThunk: t,
    map: m,
    each: a,
    bind: m,
    exists: s,
    forall: u,
    filter: m,
    equals: e,
    equals_: e,
    toArray: function toArray() {
      return [];
    },
    toString: l("none()")
  }),
      g = function g(n) {
    var e = l(n),
        t = function t() {
      return i;
    },
        r = function r(e) {
      return e(n);
    },
        i = {
      fold: function fold(e, t) {
        return t(n);
      },
      is: function is(e) {
        return n === e;
      },
      isSome: u,
      isNone: s,
      getOr: e,
      getOrThunk: e,
      getOrDie: e,
      getOrNull: e,
      getOrUndefined: e,
      or: t,
      orThunk: t,
      map: function map(e) {
        return g(e(n));
      },
      each: function each(e) {
        e(n);
      },
      bind: r,
      exists: r,
      forall: r,
      filter: function filter(e) {
        return e(n) ? i : d;
      },
      toArray: function toArray() {
        return [n];
      },
      toString: function toString() {
        return "some(" + n + ")";
      },
      equals: function equals(e) {
        return e.is(n);
      },
      equals_: function equals_(e, t) {
        return e.fold(s, function (e) {
          return t(n, e);
        });
      }
    };

    return i;
  },
      v = {
    some: g,
    none: m,
    from: function from(e) {
      return null === e || e === undefined ? d : g(e);
    }
  },
      f = Object.keys,
      p = Object.hasOwnProperty,
      h = function h(e, n, r, i) {
    return function (e, t) {
      for (var n = f(e), r = 0, i = n.length; r < i; r++) {
        var a = n[r];
        t(e[a], a);
      }
    }(e, function (e, t) {
      (n(e, t) ? r : i)(e, t);
    }), {};
  },
      b = function b(e, t) {
    var n,
        r = {};
    return h(e, t, (n = r, function (e, t) {
      n[t] = e;
    }), a), r;
  },
      y = function y(e, t) {
    return n = e, r = t, p.call(n, r) && e[t] !== undefined && null !== e[t];
    var n, r;
  },
      D = function D(r) {
    return function (e) {
      return n = _typeof(t = e), (null === t ? "null" : "object" == n && (Array.prototype.isPrototypeOf(t) || t.constructor && "Array" === t.constructor.name) ? "array" : "object" == n && (String.prototype.isPrototypeOf(t) || t.constructor && "String" === t.constructor.name) ? "string" : n) === r;
      var t, n;
    };
  },
      A = function A(t) {
    return function (e) {
      return _typeof(e) === t;
    };
  },
      w = D("string"),
      S = D("object"),
      x = D("array"),
      U = (r = null, function (e) {
    return r === e;
  }),
      C = A("boolean"),
      I = function I(e) {
    return !(null === (t = e) || t === undefined);
    var t;
  },
      O = A("number"),
      T = Array.prototype.push,
      N = function N(e) {
    for (var t = [], n = 0, r = e.length; n < r; ++n) {
      if (!x(e[n])) throw new Error("Arr.flatten item " + n + " was not an array, input: " + e);
      T.apply(t, e[n]);
    }

    return t;
  },
      P = function P(e) {
    return t = e, (n = 0) <= n && n < t.length ? v.some(t[n]) : v.none();
    var t, n;
  },
      L = ("undefined" != typeof window || Function("return this;")(), function (e, t, n) {
    !function (e, t, n) {
      if (!(w(n) || C(n) || O(n))) throw console.error("Invalid call to Attribute.set. Key ", t, ":: Value ", n, ":: Element ", e), new Error("Attribute value was not simple");
      e.setAttribute(t, n + "");
    }(e.dom, t, n);
  }),
      _ = function _(e) {
    if (null === e || e === undefined) throw new Error("Node cannot be null or undefined");
    return {
      dom: e
    };
  },
      E = {
    fromHtml: function fromHtml(e, t) {
      var n = (t || document).createElement("div");
      if (n.innerHTML = e, !n.hasChildNodes() || 1 < n.childNodes.length) throw console.error("HTML does not have a single root node", e), new Error("HTML must have a single root node");
      return _(n.childNodes[0]);
    },
    fromTag: function fromTag(e, t) {
      var n = (t || document).createElement(e);
      return _(n);
    },
    fromText: function fromText(e, t) {
      var n = (t || document).createTextNode(e);
      return _(n);
    },
    fromDom: _,
    fromPoint: function fromPoint(e, t, n) {
      return v.from(e.dom.elementFromPoint(t, n)).map(_);
    }
  },
      M = tinymce.util.Tools.resolve("tinymce.dom.DOMUtils"),
      j = tinymce.util.Tools.resolve("tinymce.util.Promise"),
      R = tinymce.util.Tools.resolve("tinymce.util.XHR"),
      k = function k(e) {
    return e.getParam("image_dimensions", !0, "boolean");
  },
      z = function z(e, t) {
    return Math.max(parseInt(e, 10), parseInt(t, 10));
  },
      B = function B(e) {
    return e = e && e.replace(/px$/, "");
  },
      H = function H(e) {
    return 0 < e.length && /^[0-9]+$/.test(e) && (e += "px"), e;
  },
      F = function F(e) {
    if (e.margin) {
      var t = String(e.margin).split(" ");

      switch (t.length) {
        case 1:
          e["margin-top"] = e["margin-top"] || t[0], e["margin-right"] = e["margin-right"] || t[0], e["margin-bottom"] = e["margin-bottom"] || t[0], e["margin-left"] = e["margin-left"] || t[0];
          break;

        case 2:
          e["margin-top"] = e["margin-top"] || t[0], e["margin-right"] = e["margin-right"] || t[1], e["margin-bottom"] = e["margin-bottom"] || t[0], e["margin-left"] = e["margin-left"] || t[1];
          break;

        case 3:
          e["margin-top"] = e["margin-top"] || t[0], e["margin-right"] = e["margin-right"] || t[1], e["margin-bottom"] = e["margin-bottom"] || t[2], e["margin-left"] = e["margin-left"] || t[1];
          break;

        case 4:
          e["margin-top"] = e["margin-top"] || t[0], e["margin-right"] = e["margin-right"] || t[1], e["margin-bottom"] = e["margin-bottom"] || t[2], e["margin-left"] = e["margin-left"] || t[3];
      }

      delete e.margin;
    }

    return e;
  },
      G = function G(e) {
    return "IMG" === e.nodeName && (e.hasAttribute("data-mce-object") || e.hasAttribute("data-mce-placeholder"));
  },
      W = M.DOM,
      q = function q(e) {
    return e.style.marginLeft && e.style.marginRight && e.style.marginLeft === e.style.marginRight ? B(e.style.marginLeft) : "";
  },
      V = function V(e) {
    return e.style.marginTop && e.style.marginBottom && e.style.marginTop === e.style.marginBottom ? B(e.style.marginTop) : "";
  },
      $ = function $(e) {
    return e.style.borderWidth ? B(e.style.borderWidth) : "";
  },
      J = function J(e, t) {
    return e.hasAttribute(t) ? e.getAttribute(t) : "";
  },
      K = function K(e, t) {
    return e.style[t] ? e.style[t] : "";
  },
      X = function X(e) {
    return null !== e.parentNode && "FIGURE" === e.parentNode.nodeName;
  },
      Z = function Z(e, t, n) {
    "" === n ? e.removeAttribute(t) : e.setAttribute(t, n);
  },
      Q = function Q(e) {
    var t, n, r, i;
    X(e) ? (i = (r = e).parentNode, W.insertAfter(r, i), W.remove(i)) : (t = e, n = W.create("figure", {
      "class": "image"
    }), W.insertAfter(n, t), n.appendChild(t), n.appendChild(W.create("figcaption", {
      contentEditable: "true"
    }, "Caption")), n.contentEditable = "false");
  },
      Y = function Y(e, t) {
    var n = e.getAttribute("style"),
        r = t(null !== n ? n : "");
    0 < r.length ? (e.setAttribute("style", r), e.setAttribute("data-mce-style", r)) : e.removeAttribute("style");
  },
      ee = function ee(e, r) {
    return function (e, t, n) {
      e.style[t] ? (e.style[t] = H(n), Y(e, r)) : Z(e, t, n);
    };
  },
      te = function te(e, t) {
    return e.style[t] ? B(e.style[t]) : J(e, t);
  },
      ne = function ne(e, t) {
    var n = H(t);
    e.style.marginLeft = n, e.style.marginRight = n;
  },
      re = function re(e, t) {
    var n = H(t);
    e.style.marginTop = n, e.style.marginBottom = n;
  },
      ie = function ie(e, t) {
    var n = H(t);
    e.style.borderWidth = n;
  },
      ae = function ae(e, t) {
    e.style.borderStyle = t;
  },
      oe = function oe(e) {
    return "FIGURE" === e.nodeName;
  },
      le = function le(e) {
    return 0 === W.getAttrib(e, "alt").length && "presentation" === W.getAttrib(e, "role");
  },
      se = function se() {
    return {
      src: "",
      alt: "",
      title: "",
      width: "",
      height: "",
      "class": "",
      style: "",
      caption: !1,
      hspace: "",
      vspace: "",
      border: "",
      borderStyle: "",
      isDecorative: !1
    };
  },
      ue = function ue(e, t) {
    var n = document.createElement("img");
    return Z(n, "style", t.style), !q(n) && "" === t.hspace || ne(n, t.hspace), !V(n) && "" === t.vspace || re(n, t.vspace), !$(n) && "" === t.border || ie(n, t.border), !K(n, "borderStyle") && "" === t.borderStyle || ae(n, t.borderStyle), e(n.getAttribute("style"));
  },
      ce = function ce(e, t) {
    return {
      src: J(t, "src"),
      alt: le(n = t) ? "" : J(n, "alt"),
      title: J(t, "title"),
      width: te(t, "width"),
      height: te(t, "height"),
      "class": J(t, "class"),
      style: e(J(t, "style")),
      caption: X(t),
      hspace: q(t),
      vspace: V(t),
      border: $(t),
      borderStyle: K(t, "borderStyle"),
      isDecorative: le(t)
    };
    var n;
  },
      me = function me(e, t, n, r, i) {
    n[r] !== t[r] && i(e, r, n[r]);
  },
      de = function de(e, t, n) {
    var r, i;
    n ? (W.setAttrib(e, "role", "presentation"), r = E.fromDom(e), L(r, "alt", "")) : (U(t) ? (r = E.fromDom(e), i = "alt", r.dom.removeAttribute(i)) : (r = E.fromDom(e), L(r, "alt", t)), "presentation" === W.getAttrib(e, "role") && W.setAttrib(e, "role", ""));
  },
      ge = function ge(r, i) {
    return function (e, t, n) {
      r(e, n), Y(e, i);
    };
  },
      fe = function fe(e, t, n) {
    var r,
        i,
        a,
        o = ce(e, n);
    me(n, o, t, "caption", function (e, t, n) {
      return Q(e), 0;
    }), me(n, o, t, "src", Z), me(n, o, t, "title", Z), me(n, o, t, "width", ee(0, e)), me(n, o, t, "height", ee(0, e)), me(n, o, t, "class", Z), me(n, o, t, "style", ge(function (e, t) {
      return Z(e, "style", t), 0;
    }, e)), me(n, o, t, "hspace", ge(ne, e)), me(n, o, t, "vspace", ge(re, e)), me(n, o, t, "border", ge(ie, e)), me(n, o, t, "borderStyle", ge(ae, e)), r = n, i = o, (a = t).alt === i.alt && a.isDecorative === i.isDecorative || de(r, a.alt, a.isDecorative);
  },
      pe = function pe(e, t) {
    var n = e.dom.styles.parse(t),
        r = F(n),
        i = e.dom.styles.parse(e.dom.styles.serialize(r));
    return e.dom.styles.serialize(i);
  },
      he = function he(e) {
    var t = e.selection.getNode(),
        n = e.dom.getParent(t, "figure.image");
    return n ? e.dom.select("img", n)[0] : t && ("IMG" !== t.nodeName || G(t)) ? null : t;
  },
      be = function be(n, e) {
    var t = n.dom,
        r = b(n.schema.getTextBlockElements(), function (e, t) {
      return !n.schema.isValidChild(t, "figure");
    }),
        i = t.getParent(e.parentNode, function (e) {
      return y(r, e.nodeName);
    }, n.getBody());
    return i ? t.split(i, e) : e;
  },
      ve = function ve(t, e) {
    var n = function (e, t) {
      var n = document.createElement("img");

      if (fe(e, _c(_c({}, t), {
        caption: !1
      }), n), de(n, t.alt, t.isDecorative), t.caption) {
        var r = W.create("figure", {
          "class": "image"
        });
        return r.appendChild(n), r.appendChild(W.create("figcaption", {
          contentEditable: "true"
        }, "Caption")), r.contentEditable = "false", r;
      }

      return n;
    }(function (e) {
      return pe(t, e);
    }, e);

    t.dom.setAttrib(n, "data-mce-id", "__mcenew"), t.focus(), t.selection.setContent(n.outerHTML);
    var r,
        i = t.dom.select('*[data-mce-id="__mcenew"]')[0];
    t.dom.setAttrib(i, "data-mce-id", null), oe(i) ? (r = be(t, i), t.selection.select(r)) : t.selection.select(i);
  },
      ye = function ye(t, e) {
    var n,
        r,
        i,
        a,
        o,
        l,
        s = he(t);
    fe(function (e) {
      return pe(t, e);
    }, e, s), n = s, t.dom.setAttrib(n, "src", n.getAttribute("src")), oe(s.parentNode) ? (r = s.parentNode, be(t, r), t.selection.select(s.parentNode)) : (t.selection.select(s), i = t, a = e, l = function l() {
      o.onload = o.onerror = null, i.selection && (i.selection.select(o), i.nodeChanged());
    }, (o = s).onload = function () {
      a.width || a.height || !k(i) || i.dom.setAttribs(o, {
        width: String(o.clientWidth),
        height: String(o.clientHeight)
      }), l();
    }, o.onerror = l);
  },
      De = Object.prototype.hasOwnProperty,
      Ae = (o = function o(e, t) {
    return S(e) && S(t) ? Ae(e, t) : t;
  }, function () {
    for (var e = [], t = 0; t < arguments.length; t++) {
      e[t] = arguments[t];
    }

    if (0 === e.length) throw new Error("Can't merge zero objects");

    for (var n = {}, r = 0; r < e.length; r++) {
      var i = e[r];

      for (var a in i) {
        De.call(i, a) && (n[a] = o(n[a], i[a]));
      }
    }

    return n;
  }),
      we = tinymce.util.Tools.resolve("tinymce.util.ImageUploader"),
      Se = tinymce.util.Tools.resolve("tinymce.util.Tools"),
      xe = function xe(e) {
    return w(e.value) ? e.value : "";
  },
      Ue = function Ue(e, a) {
    var o = [];
    return Se.each(e, function (e) {
      var t,
          n,
          r,
          i = w((t = e).text) ? t.text : w(t.title) ? t.title : "";
      e.menu !== undefined ? (n = Ue(e.menu, a), o.push({
        text: i,
        items: n
      })) : (r = a(e), o.push({
        text: i,
        value: r
      }));
    }), o;
  },
      Ce = function Ce(t) {
    return void 0 === t && (t = xe), function (e) {
      return e ? v.from(e).map(function (e) {
        return Ue(e, t);
      }) : v.none();
    };
  },
      Ie = function Ie(e, n) {
    return function (e, t) {
      for (var n = 0; n < e.length; n++) {
        var r = t(e[n], n);
        if (r.isSome()) return r;
      }

      return v.none();
    }(e, function (e) {
      return t = e, Object.prototype.hasOwnProperty.call(t, "items") ? Ie(e.items, n) : e.value === n ? v.some(e) : v.none();
      var t;
    });
  },
      Oe = Ce,
      Te = function Te(e) {
    return Ce(xe)(e);
  },
      Ne = function Ne(e, t) {
    return e.bind(function (e) {
      return Ie(e, t);
    });
  },
      Pe = function Pe(e) {
    return {
      title: "Advanced",
      name: "advanced",
      items: [{
        type: "input",
        label: "Style",
        name: "style"
      }, {
        type: "grid",
        columns: 2,
        items: [{
          type: "input",
          label: "Vertical space",
          name: "vspace",
          inputMode: "numeric"
        }, {
          type: "input",
          label: "Horizontal space",
          name: "hspace",
          inputMode: "numeric"
        }, {
          type: "input",
          label: "Border width",
          name: "border",
          inputMode: "numeric"
        }, {
          type: "listbox",
          name: "borderstyle",
          label: "Border style",
          items: [{
            text: "Select...",
            value: ""
          }, {
            text: "Solid",
            value: "solid"
          }, {
            text: "Dotted",
            value: "dotted"
          }, {
            text: "Dashed",
            value: "dashed"
          }, {
            text: "Double",
            value: "double"
          }, {
            text: "Groove",
            value: "groove"
          }, {
            text: "Ridge",
            value: "ridge"
          }, {
            text: "Inset",
            value: "inset"
          }, {
            text: "Outset",
            value: "outset"
          }, {
            text: "None",
            value: "none"
          }, {
            text: "Hidden",
            value: "hidden"
          }]
        }]
      }]
    };
  },
      Le = function Le(r) {
    var t,
        e,
        i = Oe(function (e) {
      return r.convertURL(e.value || e.url, "src");
    }),
        n = new j(function (t) {
      var n, e;
      n = function n(e) {
        t(i(e).map(function (e) {
          return N([[{
            text: "None",
            value: ""
          }], e]);
        }));
      }, "string" == typeof (e = r.getParam("image_list", !1)) ? R.send({
        url: e,
        success: function success(e) {
          n(JSON.parse(e));
        }
      }) : "function" == typeof e ? e(n) : n(e);
    }),
        a = Te(r.getParam("image_class_list")),
        o = r.getParam("image_advtab", !1, "boolean"),
        l = r.getParam("image_uploadtab", !0, "boolean"),
        s = I(r.getParam("images_upload_url")),
        u = I(r.getParam("images_upload_handler")),
        c = (e = he(t = r)) ? ce(function (e) {
      return pe(t, e);
    }, e) : se(),
        m = r.getParam("image_description", !0, "boolean"),
        d = r.getParam("image_title", !1, "boolean"),
        g = k(r),
        f = r.getParam("image_caption", !1, "boolean"),
        p = r.getParam("a11y_advanced_options", !1, "boolean"),
        h = r.getParam("automatic_uploads", !0, "boolean"),
        b = v.some(r.getParam("image_prepend_url", "", "string")).filter(function (e) {
      return w(e) && 0 < e.length;
    });
    return n.then(function (e) {
      return {
        image: c,
        imageList: e,
        classList: a,
        hasAdvTab: o,
        hasUploadTab: l,
        hasUploadUrl: s,
        hasUploadHandler: u,
        hasDescription: m,
        hasImageTitle: d,
        hasDimensions: g,
        hasImageCaption: f,
        prependURL: b,
        hasAccessibilityOptions: p,
        automaticUploads: h
      };
    });
  },
      _e = function _e(e) {
    var t = e.imageList.map(function (e) {
      return {
        name: "images",
        type: "listbox",
        label: "Image list",
        items: e
      };
    }),
        n = {
      name: "alt",
      type: "input",
      label: "Alternative description",
      disabled: e.hasAccessibilityOptions && e.image.isDecorative
    },
        r = e.classList.map(function (e) {
      return {
        name: "classes",
        type: "listbox",
        label: "Class",
        items: e
      };
    });
    return N([[{
      name: "src",
      type: "urlinput",
      filetype: "image",
      label: "Source"
    }], t.toArray(), e.hasAccessibilityOptions && e.hasDescription ? [{
      type: "label",
      label: "Accessibility",
      items: [{
        name: "isDecorative",
        type: "checkbox",
        label: "Image is decorative"
      }]
    }] : [], e.hasDescription ? [n] : [], e.hasImageTitle ? [{
      name: "title",
      type: "input",
      label: "Image title"
    }] : [], e.hasDimensions ? [{
      name: "dimensions",
      type: "sizeinput"
    }] : [], [{
      type: "grid",
      columns: 2,
      items: N([r.toArray(), e.hasImageCaption ? [{
        type: "label",
        label: "Caption",
        items: [{
          type: "checkbox",
          name: "caption",
          label: "Show caption"
        }]
      }] : []])
    }]]);
  },
      Ee = function Ee(e) {
    return {
      title: "General",
      name: "general",
      items: _e(e)
    };
  },
      Me = _e,
      je = function je(e) {
    return {
      title: "Upload",
      name: "upload",
      items: [{
        type: "dropzone",
        name: "fileinput"
      }]
    };
  },
      Re = function Re(e) {
    return {
      src: {
        value: e.src,
        meta: {}
      },
      images: e.src,
      alt: e.alt,
      title: e.title,
      dimensions: {
        width: e.width,
        height: e.height
      },
      classes: e["class"],
      caption: e.caption,
      style: e.style,
      vspace: e.vspace,
      border: e.border,
      hspace: e.hspace,
      borderstyle: e.borderStyle,
      fileinput: [],
      isDecorative: e.isDecorative
    };
  },
      ke = function ke(e, t) {
    return {
      src: e.src.value,
      alt: 0 === e.alt.length && t ? null : e.alt,
      title: e.title,
      width: e.dimensions.width,
      height: e.dimensions.height,
      "class": e.classes,
      style: e.style,
      caption: e.caption,
      hspace: e.hspace,
      vspace: e.vspace,
      border: e.border,
      borderStyle: e.borderstyle,
      isDecorative: e.isDecorative
    };
  },
      ze = function ze(e, t) {
    var n,
        r,
        i = t.getData();
    n = e, r = i.src.value, (/^(?:[a-zA-Z]+:)?\/\//.test(r) ? v.none() : n.prependURL.bind(function (e) {
      return r.substring(0, e.length) !== e ? v.some(e + r) : v.none();
    })).each(function (e) {
      t.setData({
        src: {
          value: e,
          meta: i.src.meta
        }
      });
    });
  },
      Be = function Be(e, t) {
    var n,
        r,
        i,
        a,
        o = t.getData(),
        l = o.src.meta;
    l !== undefined && (n = Ae({}, o), i = n, a = l, (r = e).hasDescription && w(a.alt) && (i.alt = a.alt), r.hasAccessibilityOptions && (i.isDecorative = a.isDecorative || i.isDecorative || !1), r.hasImageTitle && w(a.title) && (i.title = a.title), r.hasDimensions && (w(a.width) && (i.dimensions.width = a.width), w(a.height) && (i.dimensions.height = a.height)), w(a["class"]) && Ne(r.classList, a["class"]).each(function (e) {
      i.classes = e.value;
    }), r.hasImageCaption && C(a.caption) && (i.caption = a.caption), r.hasAdvTab && (w(a.style) && (i.style = a.style), w(a.vspace) && (i.vspace = a.vspace), w(a.border) && (i.border = a.border), w(a.hspace) && (i.hspace = a.hspace), w(a.borderstyle) && (i.borderstyle = a.borderstyle)), t.setData(n));
  },
      He = function He(e, t, n, r) {
    var i, a, o, l, s, u, c, m, d, g, f, p;
    ze(t, r), Be(t, r), i = e, a = t, o = n, s = (l = r).getData(), u = s.src.value, (c = s.src.meta || {}).width || c.height || !a.hasDimensions || (0 < u.length ? i.imageSize(u).then(function (e) {
      o.open && l.setData({
        dimensions: e
      });
    })["catch"](function (e) {
      return console.error(e);
    }) : l.setData({
      dimensions: {
        width: "",
        height: ""
      }
    })), m = t, d = n, f = (g = r).getData(), p = Ne(m.imageList, f.src.value), d.prevImage = p, g.setData({
      images: p.map(function (e) {
        return e.value;
      }).getOr("")
    });
  },
      Fe = function Fe(e, t, n) {
    var r,
        i,
        a,
        o,
        l,
        s = F(e(n.style)),
        u = Ae({}, n);
    return u.vspace = (r = s)["margin-top"] && r["margin-bottom"] && r["margin-top"] === r["margin-bottom"] ? B(String(r["margin-top"])) : "", u.hspace = (i = s)["margin-right"] && i["margin-left"] && i["margin-right"] === i["margin-left"] ? B(String(i["margin-right"])) : "", u.border = (a = s)["border-width"] ? B(String(a["border-width"])) : "", u.borderstyle = (o = s)["border-style"] ? String(o["border-style"]) : "", u.style = (l = t)(e(l(s))), u;
  },
      Ge = function Ge(l, s, t, u) {
    var e = u.getData();
    u.block("Uploading image"), P(e.fileinput).fold(function () {
      u.unblock();
    }, function (n) {
      var r,
          i = URL.createObjectURL(n),
          a = function a() {
        u.unblock(), URL.revokeObjectURL(i);
      },
          o = function o(e) {
        u.setData({
          src: {
            value: e,
            meta: {}
          }
        }), u.showTab("general"), He(l, s, t, u);
      };

      r = n, new j(function (e, t) {
        var n = new FileReader();
        n.onload = function () {
          e(n.result);
        }, n.onerror = function () {
          t(n.error.message);
        }, n.readAsDataURL(r);
      }).then(function (e) {
        var t = l.createBlobCache(n, i, e);
        s.automaticUploads ? l.uploadImage(t).then(function (e) {
          o(e.url), a();
        })["catch"](function (e) {
          a(), l.alertErr(e);
        }) : (l.addToBlobCache(t), o(t.blobUri()), u.unblock());
      });
    });
  },
      We = function We(h, b, v) {
    return function (e, t) {
      var n, r, i, a, o, l, s, u, c, m, d, g, f, p;
      "src" === t.name ? He(h, b, v, e) : "images" === t.name ? (c = h, m = b, d = v, f = (g = e).getData(), (p = Ne(m.imageList, f.images)).each(function (e) {
        "" === f.alt || d.prevImage.map(function (e) {
          return e.text === f.alt;
        }).getOr(!1) ? "" === e.value ? g.setData({
          src: e,
          alt: d.prevAlt
        }) : g.setData({
          src: e,
          alt: e.text
        }) : g.setData({
          src: e
        });
      }), d.prevImage = p, He(c, m, d, g)) : "alt" === t.name ? v.prevAlt = e.getData().alt : "style" === t.name ? (o = h, s = (l = e).getData(), u = Fe(o.parseStyle, o.serializeStyle, s), l.setData(u)) : "vspace" === t.name || "hspace" === t.name || "border" === t.name || "borderstyle" === t.name ? (n = h, r = e, i = Ae(Re(b.image), r.getData()), a = ue(n.normalizeCss, ke(i, !1)), r.setData({
        style: a
      })) : "fileinput" === t.name ? Ge(h, b, v, e) : "isDecorative" === t.name && (e.getData().isDecorative ? e.disable("alt") : e.enable("alt"));
    };
  },
      qe = function qe(a) {
    return function (e) {
      var t,
          n,
          r,
          i = {
        prevImage: Ne((t = e).imageList, t.image.src),
        prevAlt: t.image.alt,
        open: !0
      };
      return {
        title: "Insert/Edit Image",
        size: "normal",
        body: (r = e).hasAdvTab || r.hasUploadUrl || r.hasUploadHandler ? {
          type: "tabpanel",
          tabs: N([[Ee(r)], r.hasAdvTab ? [Pe(r)] : [], r.hasUploadTab && (r.hasUploadUrl || r.hasUploadHandler) ? [je(r)] : []])
        } : {
          type: "panel",
          items: Me(r)
        },
        buttons: [{
          type: "cancel",
          name: "cancel",
          text: "Cancel"
        }, {
          type: "submit",
          name: "save",
          text: "Save",
          primary: !0
        }],
        initialData: Re(e.image),
        onSubmit: a.onSubmit(e),
        onChange: We(a, e, i),
        onClose: (n = i, function () {
          n.open = !1;
        })
      };
    };
  },
      Ve = function Ve(t) {
    return function (e) {
      return i = t.documentBaseURI.toAbsolute(e), new j(function (t) {
        var n = document.createElement("img"),
            r = function r(e) {
          n.parentNode && n.parentNode.removeChild(n), t(e);
        };

        n.onload = function () {
          var e = {
            width: z(n.width, n.clientWidth),
            height: z(n.height, n.clientHeight)
          };
          r(j.resolve(e));
        }, n.onerror = function () {
          r(j.reject("Failed to get image dimensions for: " + i));
        };
        var e = n.style;
        e.visibility = "hidden", e.position = "fixed", e.bottom = e.left = "0px", e.width = e.height = "auto", document.body.appendChild(n), n.src = i;
      }).then(function (e) {
        return {
          width: String(e.width),
          height: String(e.height)
        };
      });
      var i;
    };
  },
      $e = function $e(e) {
    var t,
        n,
        r,
        i,
        a,
        o,
        l,
        s,
        u = {
      onSubmit: function onSubmit(n) {
        return function (e) {
          var t = Ae(Re(n.image), e.getData());
          s.execCommand("mceUpdateImage", !1, ke(t, n.hasAccessibilityOptions)), s.editorUpload.uploadImagesAuto(), e.close();
        };
      },
      imageSize: Ve(s = e),
      addToBlobCache: function addToBlobCache(e) {
        l.editorUpload.blobCache.add(e);
      },
      createBlobCache: function createBlobCache(e, t, n) {
        return o.editorUpload.blobCache.create({
          blob: e,
          blobUri: t,
          name: e.name ? e.name.replace(/\.[^\.]+$/, "") : null,
          filename: e.name,
          base64: n.split(",")[1]
        });
      },
      alertErr: function alertErr(e) {
        a.windowManager.alert(e);
      },
      normalizeCss: function normalizeCss(e) {
        return pe(i, e);
      },
      parseStyle: function parseStyle(e) {
        return r.dom.parseStyle(e);
      },
      serializeStyle: function serializeStyle(e, t) {
        return n.dom.serializeStyle(e, t);
      },
      uploadImage: (t = n = r = i = a = o = l = e, function (e) {
        return we(t).upload([e], !1).then(function (e) {
          return 0 === e.length ? j.reject("Failed to upload image") : !1 === e[0].status ? j.reject(e[0].error) : e[0];
        });
      })
    };
    return {
      open: function open() {
        Le(e).then(qe(u)).then(e.windowManager.open);
      }
    };
  },
      Je = function Je(u) {
    u.addCommand("mceImage", $e(u).open), u.addCommand("mceUpdateImage", function (e, s) {
      u.undoManager.transact(function () {
        return e = s, void ((l = he(t = u)) ? (n = ce(function (e) {
          return pe(t, e);
        }, l), (r = _c(_c({}, n), e)).src ? ye(t, r) : (i = t, (a = l) && (o = i.dom.is(a.parentNode, "figure.image") ? a.parentNode : a, i.dom.remove(o), i.focus(), i.nodeChanged(), i.dom.isEmpty(i.getBody()) && (i.setContent(""), i.selection.setCursorLocation())))) : e.src && ve(t, _c(_c({}, se()), e)));
        var t, e, n, r, i, a, o, l;
      });
    });
  },
      Ke = function Ke(a) {
    return function (e) {
      for (var t, n = e.length, r = function r(e) {
        e.attr("contenteditable", a ? "true" : null);
      }; n--;) {
        var i = e[n];
        (t = i.attr("class")) && /\bimage\b/.test(t) && (i.attr("contenteditable", a ? "false" : null), Se.each(i.getAll("figcaption"), r));
      }
    };
  };

  i.add("image", function (e) {
    var t, n;
    (t = e).on("PreInit", function () {
      t.parser.addNodeFilter("figure", Ke(!0)), t.serializer.addNodeFilter("figure", Ke(!1));
    }), (n = e).ui.registry.addToggleButton("image", {
      icon: "image",
      tooltip: "Insert/edit image",
      onAction: $e(n).open,
      onSetup: function onSetup(e) {
        return n.selection.selectorChangedWithUnbind("img:not([data-mce-object],[data-mce-placeholder]),figure.image", e.setActive).unbind;
      }
    }), n.ui.registry.addMenuItem("image", {
      icon: "image",
      text: "Image...",
      onAction: $e(n).open
    }), n.ui.registry.addContextMenu("image", {
      update: function update(e) {
        return oe(e) || "IMG" === e.nodeName && !G(e) ? ["image"] : [];
      }
    }), Je(e);
  });
}();