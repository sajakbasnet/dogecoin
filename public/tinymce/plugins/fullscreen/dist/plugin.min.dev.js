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

  var c = function c(n) {
    var e = n;
    return {
      get: function get() {
        return e;
      },
      set: function set(n) {
        e = n;
      }
    };
  },
      n = tinymce.util.Tools.resolve("tinymce.PluginManager"),
      i = function i(n) {
    return {
      isFullscreen: function isFullscreen() {
        return null !== n.get();
      }
    };
  },
      e = function e() {},
      u = function u(n) {
    return function () {
      return n;
    };
  };

  var t,
      r,
      o,
      l = u(!1),
      f = u(!0),
      a = function a() {
    return d;
  },
      d = (t = function t(n) {
    return n.isNone();
  }, {
    fold: function fold(n, e) {
      return n();
    },
    is: l,
    isSome: l,
    isNone: f,
    getOr: o = function o(n) {
      return n;
    },
    getOrThunk: r = function r(n) {
      return n();
    },
    getOrDie: function getOrDie(n) {
      throw new Error(n || "error: getOrDie called on none.");
    },
    getOrNull: u(null),
    getOrUndefined: u(undefined),
    or: o,
    orThunk: r,
    map: a,
    each: e,
    bind: a,
    exists: l,
    forall: f,
    filter: a,
    equals: t,
    equals_: t,
    toArray: function toArray() {
      return [];
    },
    toString: u("none()")
  }),
      s = function s(t) {
    var n = u(t),
        e = function e() {
      return o;
    },
        r = function r(n) {
      return n(t);
    },
        o = {
      fold: function fold(n, e) {
        return e(t);
      },
      is: function is(n) {
        return t === n;
      },
      isSome: f,
      isNone: l,
      getOr: n,
      getOrThunk: n,
      getOrDie: n,
      getOrNull: n,
      getOrUndefined: n,
      or: e,
      orThunk: e,
      map: function map(n) {
        return s(n(t));
      },
      each: function each(n) {
        n(t);
      },
      bind: r,
      exists: r,
      forall: r,
      filter: function filter(n) {
        return n(t) ? o : d;
      },
      toArray: function toArray() {
        return [t];
      },
      toString: function toString() {
        return "some(" + t + ")";
      },
      equals: function equals(n) {
        return n.is(t);
      },
      equals_: function equals_(n, e) {
        return n.fold(l, function (n) {
          return e(t, n);
        });
      }
    };

    return o;
  },
      S = {
    some: s,
    none: a,
    from: function from(n) {
      return null === n || n === undefined ? d : s(n);
    }
  },
      m = function m() {
    return n = function n(_n) {
      return _n.unbind();
    }, e = c(S.none()), t = function t() {
      return e.get().each(n);
    }, {
      clear: function clear() {
        t(), e.set(S.none());
      },
      isSet: function isSet() {
        return e.get().isSome();
      },
      set: function set(n) {
        t(), e.set(S.some(n));
      }
    };
    var n, e, t;
  },
      h = function h(r) {
    return function (n) {
      return t = _typeof(e = n), (null === e ? "null" : "object" == t && (Array.prototype.isPrototypeOf(e) || e.constructor && "Array" === e.constructor.name) ? "array" : "object" == t && (String.prototype.isPrototypeOf(e) || e.constructor && "String" === e.constructor.name) ? "string" : t) === r;
      var e, t;
    };
  },
      g = function g(e) {
    return function (n) {
      return _typeof(n) === e;
    };
  },
      p = h("string"),
      v = h("array"),
      y = g("boolean"),
      w = function w(n) {
    return !(null === (e = n) || e === undefined);
    var e;
  },
      b = g("function"),
      E = g("number"),
      F = Array.prototype.push,
      T = function T(n, e) {
    for (var t = n.length, r = new Array(t), o = 0; o < t; o++) {
      var u = n[o];
      r[o] = e(u, o);
    }

    return r;
  },
      x = function x(n, e) {
    for (var t = 0, r = n.length; t < r; t++) {
      e(n[t], t);
    }
  },
      D = function D(n, e) {
    for (var t = [], r = 0, o = n.length; r < o; r++) {
      var u = n[r];
      e(u, r) && t.push(u);
    }

    return t;
  },
      k = function k(n, e) {
    return function (n) {
      for (var e = [], t = 0, r = n.length; t < r; ++t) {
        if (!v(n[t])) throw new Error("Arr.flatten item " + t + " was not an array, input: " + n);
        F.apply(e, n[t]);
      }

      return e;
    }(T(n, e));
  },
      C = function C(n) {
    return e = n, (t = 0) <= t && t < e.length ? S.some(e[t]) : S.none();
    var e, t;
  },
      O = Object.keys,
      A = function A(n) {
    return n.style !== undefined && b(n.style.getPropertyValue);
  },
      N = function N(n) {
    if (null === n || n === undefined) throw new Error("Node cannot be null or undefined");
    return {
      dom: n
    };
  },
      M = {
    fromHtml: function fromHtml(n, e) {
      var t = (e || document).createElement("div");
      if (t.innerHTML = n, !t.hasChildNodes() || 1 < t.childNodes.length) throw console.error("HTML does not have a single root node", n), new Error("HTML must have a single root node");
      return N(t.childNodes[0]);
    },
    fromTag: function fromTag(n, e) {
      var t = (e || document).createElement(n);
      return N(t);
    },
    fromText: function fromText(n, e) {
      var t = (e || document).createTextNode(n);
      return N(t);
    },
    fromDom: N,
    fromPoint: function fromPoint(n, e, t) {
      return S.from(n.dom.elementFromPoint(e, t)).map(N);
    }
  },
      P = ("undefined" != typeof window || Function("return this;")(), function (e) {
    return function (n) {
      return n.dom.nodeType === e;
    };
  }),
      L = P(1),
      q = P(3),
      H = P(9),
      R = P(11),
      V = function V(n, e) {
    var t = n.dom;
    if (1 !== t.nodeType) return !1;
    var r = t;
    if (r.matches !== undefined) return r.matches(e);
    if (r.msMatchesSelector !== undefined) return r.msMatchesSelector(e);
    if (r.webkitMatchesSelector !== undefined) return r.webkitMatchesSelector(e);
    if (r.mozMatchesSelector !== undefined) return r.mozMatchesSelector(e);
    throw new Error("Browser lacks native selectors");
  },
      W = function W(n) {
    return M.fromDom(n.dom.ownerDocument);
  },
      B = function B(t) {
    var n;
    return n = t, S.from(n.dom.parentNode).map(M.fromDom).map(j).map(function (n) {
      return D(n, function (n) {
        return e = n, t.dom !== e.dom;
        var e;
      });
    }).getOr([]);
  },
      j = function j(n) {
    return T(n.dom.childNodes, M.fromDom);
  },
      z = b(Element.prototype.attachShadow) && b(Node.prototype.getRootNode),
      I = u(z),
      U = z ? function (n) {
    return M.fromDom(n.dom.getRootNode());
  } : function (n) {
    return H(n) ? n : W(n);
  },
      _ = function _(n) {
    var e,
        t = U(n);
    return R(e = t) && w(e.dom.host) ? S.some(t) : S.none();
  },
      K = function K(n) {
    return M.fromDom(n.dom.host);
  },
      X = function X(n) {
    return w(n.dom.shadowRoot);
  },
      Y = function Y(n) {
    var e = q(n) ? n.dom.parentNode : n.dom;
    if (e === undefined || null === e || null === e.ownerDocument) return !1;
    var t,
        r,
        o = e.ownerDocument;
    return _(M.fromDom(e)).fold(function () {
      return o.body.contains(e);
    }, (t = Y, r = K, function (n) {
      return t(r(n));
    }));
  },
      G = function G(n, e, t) {
    !function (n, e, t) {
      if (!(p(t) || y(t) || E(t))) throw console.error("Invalid call to Attribute.set. Key ", e, ":: Value ", t, ":: Element ", n), new Error("Attribute value was not simple");
      n.setAttribute(e, t + "");
    }(n.dom, e, t);
  },
      J = function J(n, e) {
    var t = n.dom.getAttribute(e);
    return null === t ? undefined : t;
  },
      Q = function Q(n, e) {
    n.dom.removeAttribute(e);
  },
      Z = function Z(n, e) {
    var t = n.dom;
    !function (n, e) {
      for (var t = O(n), r = 0, o = t.length; r < o; r++) {
        var u = t[r];
        e(n[u], u);
      }
    }(e, function (n, e) {
      !function (n, e, t) {
        if (!p(t)) throw console.error("Invalid call to CSS.set. Property ", e, ":: Value ", t, ":: Element ", n), new Error("CSS value must be a string: " + t);
        A(n) && n.style.setProperty(e, t);
      }(t, e, n);
    });
  },
      $ = function $(n, e) {
    return A(n) ? n.style.getPropertyValue(e) : "";
  },
      nn = function nn(n) {
    var t,
        r,
        e = M.fromDom(function (n) {
      if (I() && w(n.target)) {
        var e = M.fromDom(n.target);

        if (L(e) && X(e) && n.composed && n.composedPath) {
          var t = n.composedPath();
          if (t) return C(t);
        }
      }

      return S.from(n.target);
    }(n).getOr(n.target)),
        o = function o() {
      return n.stopPropagation();
    },
        u = function u() {
      return n.preventDefault();
    },
        i = (t = u, r = o, function () {
      for (var n = [], e = 0; e < arguments.length; e++) {
        n[e] = arguments[e];
      }

      return t(r.apply(null, n));
    });

    return {
      target: e,
      x: n.clientX,
      y: n.clientY,
      stop: o,
      prevent: u,
      kill: i,
      raw: n
    };
  },
      en = function en(n, e, t, r, o) {
    var u,
        i,
        c = (u = t, i = r, function (n) {
      u(n) && i(nn(n));
    });
    return n.dom.addEventListener(e, c, o), {
      unbind: function (r) {
        for (var o = [], n = 1; n < arguments.length; n++) {
          o[n - 1] = arguments[n];
        }

        return function () {
          for (var n = [], e = 0; e < arguments.length; e++) {
            n[e] = arguments[e];
          }

          var t = o.concat(n);
          return r.apply(null, t);
        };
      }(tn, n, e, c, o)
    };
  },
      tn = function tn(n, e, t, r) {
    n.dom.removeEventListener(e, t, r);
  },
      rn = f,
      on = function on(n, e, t) {
    return en(n, e, rn, t, !1);
  },
      un = function un(t, r) {
    return {
      left: t,
      top: r,
      translate: function translate(n, e) {
        return un(t + n, r + e);
      }
    };
  },
      cn = un,
      ln = function ln(n) {
    var e = n === undefined ? window : n;
    return S.from(e.visualViewport);
  },
      fn = function fn(n, e, t, r) {
    return {
      x: n,
      y: e,
      width: t,
      height: r,
      right: n + t,
      bottom: e + r
    };
  },
      an = function an(n) {
    var e,
        t,
        r,
        o,
        u = n === undefined ? window : n,
        i = u.document,
        c = (e = M.fromDom(i), t = e !== undefined ? e.dom : document, r = t.body.scrollLeft || t.documentElement.scrollLeft, o = t.body.scrollTop || t.documentElement.scrollTop, cn(r, o));
    return ln(u).fold(function () {
      var n = u.document.documentElement,
          e = n.clientWidth,
          t = n.clientHeight;
      return fn(c.left, c.top, e, t);
    }, function (n) {
      return fn(Math.max(n.pageLeft, c.left), Math.max(n.pageTop, c.top), n.width, n.height);
    });
  },
      dn = function dn(t, r, n) {
    return ln(n).map(function (n) {
      var e = function e(n) {
        return r(nn(n));
      };

      return n.addEventListener(t, e), {
        unbind: function unbind() {
          return n.removeEventListener(t, e);
        }
      };
    }).getOrThunk(function () {
      return {
        unbind: e
      };
    });
  },
      sn = tinymce.util.Tools.resolve("tinymce.dom.DOMUtils"),
      mn = tinymce.util.Tools.resolve("tinymce.Env"),
      hn = tinymce.util.Tools.resolve("tinymce.util.Delay"),
      gn = function gn(n, e) {
    n.fire("FullscreenStateChanged", {
      state: e
    });
  },
      pn = function pn(n) {
    return n.getParam("fullscreen_native", !1, "boolean");
  },
      vn = function vn(n) {
    var e = M.fromDom(n.getElement());
    return _(e).map(K).getOrThunk(function () {
      return function (n) {
        var e = n.dom.body;
        if (null === e || e === undefined) throw new Error("Body is not available yet");
        return M.fromDom(e);
      }(W(e));
    });
  },
      yn = function yn(n) {
    return n.dom === ((e = W(n).dom).fullscreenElement !== undefined ? e.fullscreenElement : e.msFullscreenElement !== undefined ? e.msFullscreenElement : e.webkitFullscreenElement !== undefined ? e.webkitFullscreenElement : null);
    var e;
  },
      wn = function wn(n, e, t) {
    return D(function (n, e) {
      for (var t = b(e) ? e : l, r = n.dom, o = []; null !== r.parentNode && r.parentNode !== undefined;) {
        var u = r.parentNode,
            i = M.fromDom(u);
        if (o.push(i), !0 === t(i)) break;
        r = u;
      }

      return o;
    }(n, t), e);
  },
      bn = function bn(n) {
    return e = n, o = t === undefined ? document : t.dom, 1 !== (r = o).nodeType && 9 !== r.nodeType && 11 !== r.nodeType || 0 === r.childElementCount ? [] : T(o.querySelectorAll(e), M.fromDom);
    var e, t, r, o;
  },
      Sn = function Sn(n, e) {
    return t = function t(n) {
      return V(n, e);
    }, D(B(n), t);
    var t;
  },
      En = "data-ephox-mobile-fullscreen-style",
      Fn = "position:absolute!important;",
      Tn = "top:0!important;left:0!important;margin:0!important;padding:0!important;width:100%!important;height:100%!important;overflow:visible!important;",
      xn = mn.os.isAndroid(),
      Dn = function Dn(n) {
    var e,
        t,
        r,
        o,
        u = (t = "background-color", r = (e = n).dom, "" !== (o = window.getComputedStyle(r).getPropertyValue(t)) || Y(e) ? o : $(r, t));
    return u !== undefined && "" !== u ? "background-color:" + u + "!important" : "background-color:rgb(255,255,255)!important;";
  },
      kn = function kn(o, n, e) {
    var t,
        r,
        u = function u(r) {
      return function (n) {
        var e = J(n, "style"),
            t = e === undefined ? "no-styles" : e.trim();
        t !== r && (G(n, En, t), Z(n, o.parseStyle(r)));
      };
    },
        i = (t = "*", wn(n, function (n) {
      return V(n, t);
    }, r)),
        c = k(i, function (n) {
      return Sn(n, "*:not(.tox-silver-sink)");
    }),
        l = Dn(e);

    x(c, u("display:none!important;")), x(i, u(Fn + Tn + l)), u((!0 === xn ? "" : Fn) + Tn + l)(n);
  },
      Cn = sn.DOM,
      On = ln().fold(function () {
    return {
      bind: e,
      unbind: e
    };
  }, function (e) {
    var t,
        r = (t = c(S.none()), {
      clear: function clear() {
        return t.set(S.none());
      },
      set: function set(n) {
        return t.set(S.some(n));
      },
      isSet: function isSet() {
        return t.get().isSome();
      },
      on: function on(n) {
        return t.get().each(n);
      }
    }),
        o = m(),
        u = m(),
        i = hn.throttle(function () {
      document.body.scrollTop = 0, document.documentElement.scrollTop = 0, window.requestAnimationFrame(function () {
        r.on(function (n) {
          return Z(n, {
            top: e.offsetTop + "px",
            left: e.offsetLeft + "px",
            height: e.height + "px",
            width: e.width + "px"
          });
        });
      });
    }, 50);
    return {
      bind: function bind(n) {
        r.set(n), i(), o.set(dn("resize", i)), u.set(dn("scroll", i));
      },
      unbind: function unbind() {
        r.on(function () {
          o.clear(), u.clear();
        }), r.clear();
      }
    };
  }),
      An = function An(e, r) {
    var n,
        t,
        o,
        u,
        i,
        c,
        l,
        f = document.body,
        a = document.documentElement,
        d = e.getContainer(),
        s = M.fromDom(d),
        m = vn(e),
        h = r.get(),
        g = M.fromDom(e.getBody()),
        p = mn.deviceType.isTouch(),
        v = d.style,
        y = e.iframeElement.style,
        w = function w(e) {
      e(f, "tox-fullscreen"), e(a, "tox-fullscreen"), e(d, "tox-fullscreen"), _(s).map(function (n) {
        return K(n).dom;
      }).each(function (n) {
        e(n, "tox-fullscreen"), e(n, "tox-shadowhost");
      });
    },
        b = function b() {
      var t, n;
      p && (t = e.dom, n = bn("[" + En + "]"), x(n, function (n) {
        var e = J(n, En);
        "no-styles" !== e ? Z(n, t.parseStyle(e)) : Q(n, "style"), Q(n, En);
      })), w(Cn.removeClass), On.unbind(), S.from(r.get()).each(function (n) {
        return n.fullscreenChangeHandler.unbind();
      });
    };

    h ? (h.fullscreenChangeHandler.unbind(), pn(e) && yn(m) && (u = W(m), (i = u.dom).exitFullscreen ? i.exitFullscreen() : i.msExitFullscreen ? i.msExitFullscreen() : i.webkitCancelFullScreen && i.webkitCancelFullScreen()), y.width = h.iframeWidth, y.height = h.iframeHeight, v.width = h.containerWidth, v.height = h.containerHeight, v.top = h.containerTop, v.left = h.containerLeft, o = h.scrollPos, window.scrollTo(o.x, o.y), r.set(null), gn(e, !1), b(), e.off("remove", b)) : (n = on(W(m), document.fullscreenElement !== undefined ? "fullscreenchange" : document.msFullscreenElement !== undefined ? "MSFullscreenChange" : document.webkitFullscreenElement !== undefined ? "webkitfullscreenchange" : "fullscreenchange", function (n) {
      pn(e) && (yn(m) || null === r.get() || An(e, r));
    }), t = {
      scrollPos: {
        x: (l = an(window)).x,
        y: l.y
      },
      containerWidth: v.width,
      containerHeight: v.height,
      containerTop: v.top,
      containerLeft: v.left,
      iframeWidth: y.width,
      iframeHeight: y.height,
      fullscreenChangeHandler: n
    }, p && kn(e.dom, s, g), y.width = y.height = "100%", v.width = v.height = "", w(Cn.addClass), On.bind(s), e.on("remove", b), r.set(t), pn(e) && ((c = m.dom).requestFullscreen ? c.requestFullscreen() : c.msRequestFullscreen ? c.msRequestFullscreen() : c.webkitRequestFullScreen && c.webkitRequestFullScreen()), gn(e, !0));
  },
      Nn = function Nn(t, r) {
    return function (e) {
      e.setActive(null !== r.get());

      var n = function n(_n2) {
        return e.setActive(_n2.state);
      };

      return t.on("FullscreenStateChanged", n), function () {
        return t.off("FullscreenStateChanged", n);
      };
    };
  };

  n.add("fullscreen", function (n) {
    var e,
        t,
        r,
        o,
        u = c(null);
    return n.inline || (t = u, (e = n).addCommand("mceFullScreen", function () {
      An(e, t);
    }), o = u, (r = n).ui.registry.addToggleMenuItem("fullscreen", {
      text: "Fullscreen",
      icon: "fullscreen",
      shortcut: "Meta+Shift+F",
      onAction: function onAction() {
        return r.execCommand("mceFullScreen");
      },
      onSetup: Nn(r, o)
    }), r.ui.registry.addToggleButton("fullscreen", {
      tooltip: "Fullscreen",
      icon: "fullscreen",
      onAction: function onAction() {
        return r.execCommand("mceFullScreen");
      },
      onSetup: Nn(r, o)
    }), n.addShortcut("Meta+Shift+F", "", "mceFullScreen")), i(u);
  });
}();