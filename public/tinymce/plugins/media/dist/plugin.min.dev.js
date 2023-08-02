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
      r,
      n = tinymce.util.Tools.resolve("tinymce.PluginManager"),
      _p = function p() {
    return (_p = Object.assign || function (e) {
      for (var t, r = 1, n = arguments.length; r < n; r++) {
        for (var o in t = arguments[r]) {
          Object.prototype.hasOwnProperty.call(t, o) && (e[o] = t[o]);
        }
      }

      return e;
    }).apply(this, arguments);
  },
      c = function c() {},
      i = function i(e) {
    return function () {
      return e;
    };
  },
      a = i(!1),
      u = i(!0),
      o = function o() {
    return s;
  },
      s = (e = function e(_e) {
    return _e.isNone();
  }, {
    fold: function fold(e, t) {
      return e();
    },
    is: a,
    isSome: a,
    isNone: u,
    getOr: r = function r(e) {
      return e;
    },
    getOrThunk: t = function t(e) {
      return e();
    },
    getOrDie: function getOrDie(e) {
      throw new Error(e || "error: getOrDie called on none.");
    },
    getOrNull: i(null),
    getOrUndefined: i(undefined),
    or: r,
    orThunk: t,
    map: o,
    each: c,
    bind: o,
    exists: a,
    forall: u,
    filter: o,
    equals: e,
    equals_: e,
    toArray: function toArray() {
      return [];
    },
    toString: i("none()")
  }),
      l = function l(r) {
    var e = i(r),
        t = function t() {
      return o;
    },
        n = function n(e) {
      return e(r);
    },
        o = {
      fold: function fold(e, t) {
        return t(r);
      },
      is: function is(e) {
        return r === e;
      },
      isSome: u,
      isNone: a,
      getOr: e,
      getOrThunk: e,
      getOrDie: e,
      getOrNull: e,
      getOrUndefined: e,
      or: t,
      orThunk: t,
      map: function map(e) {
        return l(e(r));
      },
      each: function each(e) {
        e(r);
      },
      bind: n,
      exists: n,
      forall: n,
      filter: function filter(e) {
        return e(r) ? o : s;
      },
      toArray: function toArray() {
        return [r];
      },
      toString: function toString() {
        return "some(" + r + ")";
      },
      equals: function equals(e) {
        return e.is(r);
      },
      equals_: function equals_(e, t) {
        return e.fold(a, function (e) {
          return t(r, e);
        });
      }
    };

    return o;
  },
      m = {
    some: l,
    none: o,
    from: function from(e) {
      return null === e || e === undefined ? s : l(e);
    }
  },
      d = function d(n) {
    return function (e) {
      return r = _typeof(t = e), (null === t ? "null" : "object" == r && (Array.prototype.isPrototypeOf(t) || t.constructor && "Array" === t.constructor.name) ? "array" : "object" == r && (String.prototype.isPrototypeOf(t) || t.constructor && "String" === t.constructor.name) ? "string" : r) === n;
      var t, r;
    };
  },
      f = d("string"),
      h = d("object"),
      g = d("array"),
      v = function v(e) {
    return !(null === (t = e) || t === undefined);
    var t;
  },
      w = Array.prototype.push,
      b = function b(e, t) {
    for (var r = 0, n = e.length; r < n; r++) {
      t(e[r], r);
    }
  },
      y = function y(e) {
    var t = e;
    return {
      get: function get() {
        return t;
      },
      set: function set(e) {
        t = e;
      }
    };
  },
      x = Object.keys,
      j = Object.hasOwnProperty,
      O = function O(e, t) {
    for (var r = x(e), n = 0, o = r.length; n < o; n++) {
      var i = r[n];
      t(e[i], i);
    }
  },
      S = function S(e, t) {
    var r,
        n,
        o,
        i,
        a = {};
    return r = t, i = a, n = function n(e, t) {
      i[t] = e;
    }, o = c, O(e, function (e, t) {
      (r(e, t) ? n : o)(e, t);
    }), a;
  },
      _ = function _(e, t) {
    return k(e, t) ? m.from(e[t]) : m.none();
  },
      k = function k(e, t) {
    return j.call(e, t);
  },
      A = function A(e) {
    return e.getParam("media_scripts");
  },
      T = tinymce.util.Tools.resolve("tinymce.util.Tools"),
      C = tinymce.util.Tools.resolve("tinymce.dom.DOMUtils"),
      P = tinymce.util.Tools.resolve("tinymce.html.SaxParser"),
      D = function D(e, t) {
    if (e) for (var r = 0; r < e.length; r++) {
      if (-1 !== t.indexOf(e[r].filter)) return e[r];
    }
  },
      $ = C.DOM,
      M = function M(e) {
    return e.replace(/px$/, "");
  },
      z = function z(a, e) {
    var c = y(!1),
        u = {};
    return P({
      validate: !1,
      allow_conditional_comments: !0,
      start: function start(e, t) {
        if (!c.get()) if (k(t.map, "data-ephox-embed-iri")) c.set(!0), o = (n = t).map.style, i = o ? $.parseStyle(o) : {}, u = {
          type: "ephox-embed-iri",
          source: n.map["data-ephox-embed-iri"],
          altsource: "",
          poster: "",
          width: _(i, "max-width").map(M).getOr(""),
          height: _(i, "max-height").map(M).getOr("")
        };else {
          if (u.source || "param" !== e || (u.source = t.map.movie), "iframe" !== e && "object" !== e && "embed" !== e && "video" !== e && "audio" !== e || (u.type || (u.type = e), u = T.extend(t.map, u)), "script" === e) {
            var r = D(a, t.map.src);
            if (!r) return;
            u = {
              type: "script",
              source: t.map.src,
              width: String(r.width),
              height: String(r.height)
            };
          }

          "source" === e && (u.source ? u.altsource || (u.altsource = t.map.src) : u.source = t.map.src), "img" !== e || u.poster || (u.poster = t.map.src);
        }
        var n, o, i;
      }
    }).parse(e), u.source = u.source || u.src || u.data, u.altsource = u.altsource || "", u.poster = u.poster || "", u;
  },
      F = function F(e) {
    var t = {
      mp3: "audio/mpeg",
      m4a: "audio/x-m4a",
      wav: "audio/wav",
      mp4: "video/mp4",
      webm: "video/webm",
      ogg: "video/ogg",
      swf: "application/x-shockwave-flash"
    }[e.toLowerCase().split(".").pop()];
    return t || "";
  },
      N = tinymce.util.Tools.resolve("tinymce.html.Schema"),
      U = tinymce.util.Tools.resolve("tinymce.html.Writer"),
      E = C.DOM,
      R = function R(e) {
    return /^[0-9.]+$/.test(e) ? e + "px" : e;
  },
      L = function L(i, e) {
    O(e, function (e, t) {
      var r = "" + e;
      if (i.map[t]) for (var n = i.length; n--;) {
        var o = i[n];
        o.name === t && (r ? (i.map[t] = r, o.value = r) : (delete i.map[t], i.splice(n, 1)));
      } else r && (i.push({
        name: t,
        value: r
      }), i.map[t] = r);
    });
  },
      I = ["source", "altsource"],
      q = function q(e, c, u) {
    var s,
        l = U(),
        m = y(!1),
        d = 0;
    return P({
      validate: !1,
      allow_conditional_comments: !0,
      comment: function comment(e) {
        l.comment(e);
      },
      cdata: function cdata(e) {
        l.cdata(e);
      },
      text: function text(e, t) {
        l.text(e, t);
      },
      start: function start(e, t, r) {
        if (!m.get()) if (k(t.map, "data-ephox-embed-iri")) m.set(!0), n = c, i = (o = t).map.style, (a = i ? E.parseStyle(i) : {})["max-width"] = R(n.width), a["max-height"] = R(n.height), L(o, {
          style: E.serializeStyle(a)
        });else {
          switch (e) {
            case "video":
            case "object":
            case "embed":
            case "img":
            case "iframe":
              c.height !== undefined && c.width !== undefined && L(t, {
                width: c.width,
                height: c.height
              });
          }

          if (u) switch (e) {
            case "video":
              L(t, {
                poster: c.poster,
                src: ""
              }), c.altsource && L(t, {
                src: ""
              });
              break;

            case "iframe":
              L(t, {
                src: c.source
              });
              break;

            case "source":
              if (d < 2 && (L(t, {
                src: c[I[d]],
                type: c[I[d] + "mime"]
              }), !c[I[d]])) return;
              d++;
              break;

            case "img":
              if (!c.poster) return;
              s = !0;
          }
        }
        var n, o, i, a;
        l.start(e, t, r);
      },
      end: function end(e) {
        if (!m.get()) {
          if ("video" === e && u) for (var t, r = 0; r < 2; r++) {
            c[I[r]] && ((t = []).map = {}, d <= r && (L(t, {
              src: c[I[r]],
              type: c[I[r] + "mime"]
            }), l.start("source", t, !0)));
          }
          var n;
          c.poster && "object" === e && u && !s && ((n = []).map = {}, L(n, {
            src: c.poster,
            width: c.width,
            height: c.height
          }), l.start("img", n, !0));
        }

        l.end(e);
      }
    }, N({})).parse(e), l.getContent();
  },
      B = [{
    regex: /youtu\.be\/([\w\-_\?&=.]+)/i,
    type: "iframe",
    w: 560,
    h: 314,
    url: "www.youtube.com/embed/$1",
    allowFullscreen: !0
  }, {
    regex: /youtube\.com(.+)v=([^&]+)(&([a-z0-9&=\-_]+))?/i,
    type: "iframe",
    w: 560,
    h: 314,
    url: "www.youtube.com/embed/$2?$4",
    allowFullscreen: !0
  }, {
    regex: /youtube.com\/embed\/([a-z0-9\?&=\-_]+)/i,
    type: "iframe",
    w: 560,
    h: 314,
    url: "www.youtube.com/embed/$1",
    allowFullscreen: !0
  }, {
    regex: /vimeo\.com\/([0-9]+)/,
    type: "iframe",
    w: 425,
    h: 350,
    url: "player.vimeo.com/video/$1?title=0&byline=0&portrait=0&color=8dc7dc",
    allowFullscreen: !0
  }, {
    regex: /vimeo\.com\/(.*)\/([0-9]+)/,
    type: "iframe",
    w: 425,
    h: 350,
    url: "player.vimeo.com/video/$2?title=0&amp;byline=0",
    allowFullscreen: !0
  }, {
    regex: /maps\.google\.([a-z]{2,3})\/maps\/(.+)msid=(.+)/,
    type: "iframe",
    w: 425,
    h: 350,
    url: 'maps.google.com/maps/ms?msid=$2&output=embed"',
    allowFullscreen: !1
  }, {
    regex: /dailymotion\.com\/video\/([^_]+)/,
    type: "iframe",
    w: 480,
    h: 270,
    url: "www.dailymotion.com/embed/video/$1",
    allowFullscreen: !0
  }, {
    regex: /dai\.ly\/([^_]+)/,
    type: "iframe",
    w: 480,
    h: 270,
    url: "www.dailymotion.com/embed/video/$1",
    allowFullscreen: !0
  }],
      W = function W(t) {
    var e = B.filter(function (e) {
      return e.regex.test(t);
    });
    return 0 < e.length ? T.extend({}, e[0], {
      url: function (e, t) {
        for (var r, n = (r = t.match(/^(https?:\/\/|www\.)(.+)$/i)) && 1 < r.length && "www." !== r[1] ? r[1] : "https://", o = e.regex.exec(t), i = n + e.url, a = 0; a < o.length; a++) {
          !function (e) {
            i = i.replace("$" + e, function () {
              return o[e] ? o[e] : "";
            });
          }(a);
        }

        return i.replace(/\?$/, "");
      }(e[0], t)
    }) : null;
  },
      G = function G(r, e) {
    var n = T.extend({}, e);
    if (!n.source && (T.extend(n, z(A(r), n.embed)), !n.source)) return "";
    n.altsource || (n.altsource = ""), n.poster || (n.poster = ""), n.source = r.convertURL(n.source, "source"), n.altsource = r.convertURL(n.altsource, "source"), n.sourcemime = F(n.source), n.altsourcemime = F(n.altsource), n.poster = r.convertURL(n.poster, "poster");
    var t = W(n.source);
    if (t && (n.source = t.url, n.type = t.type, n.allowfullscreen = t.allowFullscreen, n.width = n.width || String(t.w), n.height = n.height || String(t.h)), n.embed) return q(n.embed, n, !0);
    var o = D(A(r), n.source);
    o && (n.type = "script", n.width = String(o.width), n.height = String(o.height));
    var i,
        a,
        c,
        u,
        s,
        l,
        m,
        d,
        f = r.getParam("audio_template_callback"),
        h = r.getParam("video_template_callback");
    return n.width = n.width || "300", n.height = n.height || "150", T.each(n, function (e, t) {
      n[t] = r.dom.encode("" + e);
    }), "iframe" === n.type ? (d = (m = n).allowfullscreen ? ' allowFullscreen="1"' : "", '<iframe src="' + m.source + '" width="' + m.width + '" height="' + m.height + '"' + d + "></iframe>") : "application/x-shockwave-flash" === n.sourcemime ? (l = '<object data="' + (s = n).source + '" width="' + s.width + '" height="' + s.height + '" type="application/x-shockwave-flash">', s.poster && (l += '<img src="' + s.poster + '" width="' + s.width + '" height="' + s.height + '" />'), l += "</object>") : -1 !== n.sourcemime.indexOf("audio") ? (c = n, (u = f) ? u(c) : '<audio controls="controls" src="' + c.source + '">' + (c.altsource ? '\n<source src="' + c.altsource + '"' + (c.altsourcemime ? ' type="' + c.altsourcemime + '"' : "") + " />\n" : "") + "</audio>") : "script" === n.type ? '<script src="' + n.source + '"><\/script>' : (i = n, (a = h) ? a(i) : '<video width="' + i.width + '" height="' + i.height + '"' + (i.poster ? ' poster="' + i.poster + '"' : "") + ' controls="controls">\n<source src="' + i.source + '"' + (i.sourcemime ? ' type="' + i.sourcemime + '"' : "") + " />\n" + (i.altsource ? '<source src="' + i.altsource + '"' + (i.altsourcemime ? ' type="' + i.altsourcemime + '"' : "") + " />\n" : "") + "</video>");
  },
      H = tinymce.util.Tools.resolve("tinymce.util.Promise"),
      J = {},
      K = function K(t) {
    return function (e) {
      return G(t, e);
    };
  },
      Q = function Q(e, t) {
    var r,
        n,
        o,
        i,
        a,
        c = e.getParam("media_url_resolver");
    return c ? (o = t, i = K(e), a = c, new H(function (t, e) {
      var r = function r(e) {
        return e.html && (J[o.source] = e), t({
          url: o.source,
          html: e.html ? e.html : i(o)
        });
      };

      J[o.source] ? r(J[o.source]) : a({
        url: o.source
      }, r, e);
    })) : (r = t, n = K(e), new H(function (e) {
      e({
        html: n(r),
        url: r.source
      });
    }));
  },
      V = function V(i, a, c) {
    return function (e) {
      var t = function t() {
        return _(i, e);
      },
          r = function r() {
        return _(a, e);
      },
          n = function n(e) {
        return _(e, "value").bind(function (e) {
          return 0 < e.length ? m.some(e) : m.none();
        });
      },
          o = {};

      return o[e] = (e === c ? t().bind(function (e) {
        return h(e) ? n(e).orThunk(r) : r().orThunk(function () {
          return m.from(e);
        });
      }) : r().orThunk(function () {
        return t().bind(function (e) {
          return h(e) ? n(e) : m.from(e);
        });
      })).getOr(""), o;
    };
  },
      X = function X(e, t) {
    var r,
        n,
        o = t ? _(e, t).bind(function (e) {
      return _(e, "meta");
    }).getOr({}) : {},
        i = V(e, o, t);
    return _p(_p(_p(_p(_p({}, i("source")), i("altsource")), i("poster")), i("embed")), (r = o, n = {}, _(e, "dimensions").each(function (e) {
      b(["width", "height"], function (t) {
        _(r, t).orThunk(function () {
          return _(e, t);
        }).each(function (e) {
          return n[t] = e;
        });
      });
    }), n));
  },
      Y = function Y(e) {
    var n = _p(_p({}, e), {
      source: {
        value: _(e, "source").getOr("")
      },
      altsource: {
        value: _(e, "altsource").getOr("")
      },
      poster: {
        value: _(e, "poster").getOr("")
      }
    });

    return b(["width", "height"], function (r) {
      _(e, r).each(function (e) {
        var t = n.dimensions || {};
        t[r] = e, n.dimensions = t;
      });
    }), n;
  },
      Z = function Z(r) {
    return function (e) {
      var t = e && e.msg ? "Media embed handler error: " + e.msg : "Media embed handler threw unknown error.";
      r.notificationManager.open({
        type: "error",
        text: t
      });
    };
  },
      ee = function ee(e, t) {
    return z(A(e), t);
  },
      te = function te(o, i) {
    return function (e) {
      var t, r, n;
      f(e.url) && 0 < e.url.trim().length && (t = e.html, r = ee(i, t), n = _p(_p({}, r), {
        source: e.url,
        embed: t
      }), o.setData(Y(n)));
    };
  },
      re = function re(e, t) {
    var r = e.dom.select("*[data-mce-object]");
    e.insertContent(t), function (e, t) {
      for (var r = e.dom.select("*[data-mce-object]"), n = 0; n < t.length; n++) {
        for (var o = r.length - 1; 0 <= o; o--) {
          t[n] === r[o] && r.splice(o, 1);
        }
      }

      e.selection.select(r[0]);
    }(e, r), e.nodeChanged();
  },
      ne = function ne(e, t, r) {
    var n;
    t.embed = q(t.embed, t), t.embed && (e.source === t.source || (n = t.source, J.hasOwnProperty(n))) ? re(r, t.embed) : Q(r, t).then(function (e) {
      re(r, e.html);
    })["catch"](Z(r));
  },
      oe = function oe(m) {
    var e,
        t,
        r,
        n,
        o = (r = (e = m).selection.getNode(), n = (t = r).getAttribute("data-mce-object") || t.getAttribute("data-ephox-embed-iri") ? e.serializer.serialize(r, {
      selection: !0
    }) : "", _p({
      embed: n
    }, z(A(e), n))),
        d = y(o),
        i = Y(o),
        a = {
      title: "General",
      name: "general",
      items: function (e) {
        for (var t = [], r = 0, n = e.length; r < n; ++r) {
          if (!g(e[r])) throw new Error("Arr.flatten item " + r + " was not an array, input: " + e);
          w.apply(t, e[r]);
        }

        return t;
      }([[{
        name: "source",
        type: "urlinput",
        filetype: "media",
        label: "Source"
      }], m.getParam("media_dimensions", !0) ? [{
        type: "sizeinput",
        name: "dimensions",
        label: "Constrain proportions",
        constrain: !0
      }] : []])
    },
        c = {
      title: "Embed",
      items: [{
        type: "textarea",
        name: "embed",
        label: "Paste your embed code below:"
      }]
    },
        u = [];
    m.getParam("media_alt_source", !0) && u.push({
      name: "altsource",
      type: "urlinput",
      filetype: "media",
      label: "Alternative source URL"
    }), m.getParam("media_poster", !0) && u.push({
      name: "poster",
      type: "urlinput",
      filetype: "image",
      label: "Media poster (Image URL)"
    });
    var s = {
      title: "Advanced",
      name: "advanced",
      items: u
    },
        l = [a, c];
    0 < u.length && l.push(s);
    var f = {
      type: "tabpanel",
      tabs: l
    },
        h = m.windowManager.open({
      title: "Insert/Edit Media",
      size: "normal",
      body: f,
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
      onSubmit: function onSubmit(e) {
        var t = X(e.getData());
        ne(d.get(), t, m), e.close();
      },
      onChange: function onChange(e, t) {
        switch (t.name) {
          case "source":
            s = d.get(), l = X(e.getData(), "source"), s.source !== l.source && (te(h, m)({
              url: l.source,
              html: ""
            }), Q(m, l).then(te(h, m))["catch"](Z(m)));
            break;

          case "embed":
            c = X((a = e).getData()), u = ee(m, c.embed), a.setData(Y(u));
            break;

          case "dimensions":
          case "altsource":
          case "poster":
            r = e, n = t.name, o = X(r.getData(), n), i = G(m, o), r.setData(Y(_p(_p({}, o), {
              embed: i
            })));
        }

        var r, n, o, i, a, c, u, s, l;
        d.set(X(e.getData()));
      },
      initialData: i
    });
  },
      ie = tinymce.util.Tools.resolve("tinymce.html.Node"),
      ae = tinymce.util.Tools.resolve("tinymce.Env"),
      ce = tinymce.util.Tools.resolve("tinymce.html.DomParser"),
      ue = function ue(i, e) {
    if (!1 === i.getParam("media_filter_html", !0)) return e;
    var a,
        c = U();
    return P({
      validate: !1,
      allow_conditional_comments: !1,
      comment: function comment(e) {
        a || c.comment(e);
      },
      cdata: function cdata(e) {
        a || c.cdata(e);
      },
      text: function text(e, t) {
        a || c.text(e, t);
      },
      start: function start(e, t, r) {
        if (a = !0, "script" !== e && "noscript" !== e && "svg" !== e) {
          for (var n = t.length - 1; 0 <= n; n--) {
            var o = t[n].name;
            0 === o.indexOf("on") && (delete t.map[o], t.splice(n, 1)), "style" === o && (t[n].value = i.dom.serializeStyle(i.dom.parseStyle(t[n].value), e));
          }

          c.start(e, t, r), a = !1;
        }
      },
      end: function end(e) {
        a || c.end(e);
      }
    }, N({})).parse(e), c.getContent();
  },
      se = function se(e, t, r, n) {
    void 0 === n && (n = null);
    var o = e.attr(r);
    return v(o) ? o : k(t, r) ? null : n;
  },
      le = function le(e, t, r) {
    var n = "img" === t.name || "video" === e.name,
        o = n ? "300" : null,
        i = "audio" === e.name ? "30" : "150",
        a = n ? i : null;
    t.attr({
      width: se(e, r, "width", o),
      height: se(e, r, "height", a)
    });
  },
      me = function me(e, t) {
    var r = t.name,
        n = e.dom.parseStyle(t.attr("style")),
        o = S(n, function (e, t) {
      return "width" !== t && "height" !== t;
    }),
        i = new ie("span", 1);
    i.attr({
      contentEditable: "false",
      style: e.dom.serializeStyle(o),
      "data-mce-object": r,
      "class": "mce-preview-object mce-object-" + r
    }), de(e, t, i);
    var a,
        c = new ie(r, 1);
    le(t, c, n), c.attr({
      src: t.attr("src"),
      style: t.attr("style"),
      "class": t.attr("class")
    }), "iframe" === r ? c.attr({
      allowfullscreen: t.attr("allowfullscreen"),
      frameborder: "0"
    }) : (b(["controls", "crossorigin", "currentTime", "loop", "muted", "poster", "preload"], function (e) {
      c.attr(e, t.attr(e));
    }), a = i.attr("data-mce-html"), v(a) && function (e, t, r, n) {
      for (var o = ce({
        forced_root_block: !1,
        validate: !1
      }, e.schema).parse(n, {
        context: t
      }); o.firstChild;) {
        r.append(o.firstChild);
      }
    }(e, r, c, a));
    var u = new ie("span", 1);
    return u.attr("class", "mce-shim"), i.append(c), i.append(u), i;
  },
      de = function de(e, t, r) {
    for (var n = t.attributes, o = n.length; o--;) {
      var i = n[o].name,
          a = n[o].value;
      "width" !== i && "height" !== i && "style" !== i && ("data" !== i && "src" !== i || (a = e.convertURL(a, i)), r.attr("data-mce-p-" + i, a));
    }

    var c = t.firstChild && t.firstChild.value;
    c && (r.attr("data-mce-html", escape(ue(e, c))), r.firstChild = null);
  },
      fe = function fe(e) {
    for (; e = e.parent;) {
      if (e.attr("data-ephox-embed-iri") || (t = e.attr("class")) && /\btiny-pageembed\b/.test(t)) return !0;
    }

    var t;
    return !1;
  },
      he = function he(s) {
    return function (e) {
      for (var t, r, n, o, i, a, c, u = e.length; u--;) {
        (t = e[u]).parent && (t.parent.attr("data-mce-object") || "script" === t.name && !(r = D(A(s), t.attr("src"))) || (r && (r.width && t.attr("width", r.width.toString()), r.height && t.attr("height", r.height.toString())), ("iframe" === (c = t.name) || "video" === c || "audio" === c) && s.getParam("media_live_embeds", !0) && ae.ceFalse ? fe(t) || t.replace(me(s, t)) : fe(t) || t.replace((n = s, a = void 0, i = (o = t).name, (a = new ie("img", 1)).shortEnded = !0, de(n, o, a), le(o, a, {}), a.attr({
          style: o.attr("style"),
          src: ae.transparentSrc,
          "data-mce-object": i,
          "class": "mce-object mce-object-" + i
        }), a))));
      }
    };
  },
      pe = function pe(e) {
    var t, r;
    e.ui.registry.addToggleButton("media", {
      tooltip: "Insert/edit media",
      icon: "embed",
      onAction: function onAction() {
        e.execCommand("mceMedia");
      },
      onSetup: (t = e, r = ["img[data-mce-object]", "span[data-mce-object]", "div[data-ephox-embed-iri]"], function (e) {
        return t.selection.selectorChangedWithUnbind(r.join(","), e.setActive).unbind;
      })
    }), e.ui.registry.addMenuItem("media", {
      icon: "embed",
      text: "Media...",
      onAction: function onAction() {
        e.execCommand("mceMedia");
      }
    });
  };

  n.add("media", function (e) {
    var t, d, r, n;
    return (t = e).addCommand("mceMedia", function () {
      oe(t);
    }), pe(e), e.on("ResolveName", function (e) {
      var t;
      1 === e.target.nodeType && (t = e.target.getAttribute("data-mce-object")) && (e.name = t);
    }), (d = e).on("preInit", function () {
      var t = d.schema.getSpecialElements();
      T.each("video audio iframe object".split(" "), function (e) {
        t[e] = new RegExp("</" + e + "[^>]*>", "gi");
      });
      var r = d.schema.getBoolAttrs();
      T.each("webkitallowfullscreen mozallowfullscreen allowfullscreen".split(" "), function (e) {
        r[e] = {};
      }), d.parser.addNodeFilter("iframe,video,audio,object,embed,script", he(d)), d.serializer.addAttributeFilter("data-mce-object", function (e, t) {
        for (var r, n, o, i, a, c, u, s, l = e.length; l--;) {
          if ((r = e[l]).parent) {
            for (u = r.attr(t), n = new ie(u, 1), "audio" !== u && "script" !== u && ((s = r.attr("class")) && -1 !== s.indexOf("mce-preview-object") ? n.attr({
              width: r.firstChild.attr("width"),
              height: r.firstChild.attr("height")
            }) : n.attr({
              width: r.attr("width"),
              height: r.attr("height")
            })), n.attr({
              style: r.attr("style")
            }), o = (i = r.attributes).length; o--;) {
              var m = i[o].name;
              0 === m.indexOf("data-mce-p-") && n.attr(m.substr(11), i[o].value);
            }

            "script" === u && n.attr("type", "text/javascript"), (a = r.attr("data-mce-html")) && ((c = new ie("#text", 3)).raw = !0, c.value = ue(d, unescape(a)), n.append(c)), r.replace(n);
          }
        }
      });
    }), d.on("SetContent", function () {
      d.$("span.mce-preview-object").each(function (e, t) {
        var r = d.$(t);
        0 === r.find("span.mce-shim").length && r.append('<span class="mce-shim"></span>');
      });
    }), (r = e).on("click keyup touchend", function () {
      var e = r.selection.getNode();
      e && r.dom.hasClass(e, "mce-preview-object") && r.dom.getAttrib(e, "data-mce-selected") && e.setAttribute("data-mce-selected", "2");
    }), r.on("ObjectSelected", function (e) {
      "script" === e.target.getAttribute("data-mce-object") && e.preventDefault();
    }), r.on("ObjectResized", function (e) {
      var t,
          r = e.target;
      r.getAttribute("data-mce-object") && (t = r.getAttribute("data-mce-html")) && (t = unescape(t), r.setAttribute("data-mce-html", escape(q(t, {
        width: String(e.width),
        height: String(e.height)
      }))));
    }), n = e, {
      showDialog: function showDialog() {
        oe(n);
      }
    };
  });
}();