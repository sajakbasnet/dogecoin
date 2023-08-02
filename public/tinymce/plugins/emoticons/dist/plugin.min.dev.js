"use strict";

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

  var u,
      t,
      n,
      e,
      r = tinymce.util.Tools.resolve("tinymce.PluginManager"),
      _o = function o() {
    return (_o = Object.assign || function (t) {
      for (var n, e = 1, r = arguments.length; e < r; e++) {
        for (var o in n = arguments[e]) {
          Object.prototype.hasOwnProperty.call(n, o) && (t[o] = n[o]);
        }
      }

      return t;
    }).apply(this, arguments);
  },
      m = function m(t) {
    var n = t;
    return {
      get: function get() {
        return n;
      },
      set: function set(t) {
        n = t;
      }
    };
  },
      a = Object.prototype.hasOwnProperty,
      c = function c() {
    for (var t = [], n = 0; n < arguments.length; n++) {
      t[n] = arguments[n];
    }

    if (0 === t.length) throw new Error("Can't merge zero objects");

    for (var e = {}, r = 0; r < t.length; r++) {
      var o = t[r];

      for (var i in o) {
        a.call(o, i) && (e[i] = u(e[i], o[i]));
      }
    }

    return e;
  },
      i = function i(t) {
    return function () {
      return t;
    };
  },
      l = i(!(u = function u(t, n) {
    return n;
  })),
      s = i(!0),
      f = function f() {
    return g;
  },
      g = (t = function t(_t) {
    return _t.isNone();
  }, {
    fold: function fold(t, n) {
      return t();
    },
    is: l,
    isSome: l,
    isNone: s,
    getOr: e = function e(t) {
      return t;
    },
    getOrThunk: n = function n(t) {
      return t();
    },
    getOrDie: function getOrDie(t) {
      throw new Error(t || "error: getOrDie called on none.");
    },
    getOrNull: i(null),
    getOrUndefined: i(undefined),
    or: e,
    orThunk: n,
    map: f,
    each: function each() {},
    bind: f,
    exists: l,
    forall: s,
    filter: f,
    equals: t,
    equals_: t,
    toArray: function toArray() {
      return [];
    },
    toString: i("none()")
  }),
      d = function d(e) {
    var t = i(e),
        n = function n() {
      return o;
    },
        r = function r(t) {
      return t(e);
    },
        o = {
      fold: function fold(t, n) {
        return n(e);
      },
      is: function is(t) {
        return e === t;
      },
      isSome: s,
      isNone: l,
      getOr: t,
      getOrThunk: t,
      getOrDie: t,
      getOrNull: t,
      getOrUndefined: t,
      or: n,
      orThunk: n,
      map: function map(t) {
        return d(t(e));
      },
      each: function each(t) {
        t(e);
      },
      bind: r,
      exists: r,
      forall: r,
      filter: function filter(t) {
        return t(e) ? o : g;
      },
      toArray: function toArray() {
        return [e];
      },
      toString: function toString() {
        return "some(" + e + ")";
      },
      equals: function equals(t) {
        return t.is(e);
      },
      equals_: function equals_(t, n) {
        return t.fold(l, function (t) {
          return n(e, t);
        });
      }
    };

    return o;
  },
      h = {
    some: d,
    none: f,
    from: function from(t) {
      return null === t || t === undefined ? g : d(t);
    }
  },
      y = Object.keys,
      v = Object.hasOwnProperty,
      p = function p(t, n) {
    for (var e = y(t), r = 0, o = e.length; r < o; r++) {
      var i = e[r];
      n(t[i], i);
    }
  },
      b = function b(t, r) {
    var o = {};
    return p(t, function (t, n) {
      var e = r(t, n);
      o[e.k] = e.v;
    }), o;
  },
      w = function w(t, n) {
    return -1 !== t.indexOf(n);
  },
      O = tinymce.util.Tools.resolve("tinymce.Resource"),
      C = tinymce.util.Tools.resolve("tinymce.util.Delay"),
      j = tinymce.util.Tools.resolve("tinymce.util.Promise"),
      k = "All",
      _ = {
    symbols: "Symbols",
    people: "People",
    animals_and_nature: "Animals and Nature",
    food_and_drink: "Food and Drink",
    activity: "Activity",
    travel_and_places: "Travel and Places",
    objects: "Objects",
    flags: "Flags",
    user: "User Defined"
  },
      A = function A(t, n) {
    return e = t, r = n, v.call(e, r) ? t[n] : n;
    var e, r;
  },
      T = function T(t) {
    var e,
        n = t.getParam("emoticons_append", {}, "object");
    return e = function e(t) {
      return _o({
        keywords: [],
        category: "user"
      }, t);
    }, b(n, function (t, n) {
      return {
        k: n,
        v: e(t, n)
      };
    });
  },
      P = function P(e, o, t) {
    var r = m(h.none()),
        n = m(h.none()),
        f = e.getParam("emoticons_images_url", "https://twemoji.maxcdn.com/v/13.0.1/72x72/", "string"),
        i = function i(t) {
      var l = {},
          s = [];
      p(t, function (t, n) {
        var e,
            r,
            o,
            i,
            u,
            a = {
          title: n,
          keywords: t.keywords,
          "char": (r = (e = t)["char"], u = 0, i = "<img", (o = r).length >= i.length && o.substr(u, u + i.length) === i ? e["char"].replace(/src="([^"]+)"/, function (t, n) {
            return 'src="' + f + n + '"';
          }) : e["char"]),
          category: A(_, t.category)
        },
            c = l[a.category] !== undefined ? l[a.category] : [];
        l[a.category] = c.concat([a]), s.push(a);
      }), r.set(h.some(l)), n.set(h.some(s));
    };

    e.on("init", function () {
      O.load(t, o).then(function (t) {
        var n = T(e);
        i(c(t, n));
      }, function (t) {
        console.log("Failed to load emoticons: " + t), r.set(h.some({})), n.set(h.some([]));
      });
    });

    var u = function u() {
      return n.get().getOr([]);
    },
        a = function a() {
      return r.get().isSome() && n.get().isSome();
    };

    return {
      listCategories: function listCategories() {
        return [k].concat(y(r.get().getOr({})));
      },
      hasLoaded: a,
      waitForLoad: function waitForLoad() {
        return a() ? j.resolve(!0) : new j(function (t, n) {
          var e = 15,
              r = C.setInterval(function () {
            a() ? (C.clearInterval(r), t(!0)) : --e < 0 && (console.log("Could not load emojis from url: " + o), C.clearInterval(r), n(!1));
          }, 100);
        });
      },
      listAll: u,
      listCategory: function listCategory(n) {
        return n === k ? u() : r.get().bind(function (t) {
          return h.from(t[n]);
        }).getOr([]);
      }
    };
  },
      x = function x(t, n, e) {
    for (var r = [], o = n.toLowerCase(), i = e.fold(function () {
      return l;
    }, function (n) {
      return function (t) {
        return n <= t;
      };
    }), u = 0; u < t.length && (0 !== n.length && !function (t, n) {
      return w(t.title.toLowerCase(), n) || function (t, n) {
        for (var e = 0, r = t.length; e < r; e++) {
          if (n(t[e], e)) return !0;
        }

        return !1;
      }(t.keywords, function (t) {
        return w(t.toLowerCase(), n);
      });
    }(t[u], o) || (r.push({
      value: t[u]["char"],
      text: t[u].title,
      icon: t[u]["char"]
    }), !i(r.length))); u++) {
      ;
    }

    return r;
  },
      D = "pattern",
      L = function L(o, u) {
    var e,
        r,
        i,
        t = {
      pattern: "",
      results: x(u.listAll(), "", h.some(300))
    },
        a = m(k),
        c = (e = function e(t) {
      var n, e, r, o, i;
      e = (n = t).getData(), r = a.get(), o = u.listCategory(r), i = x(o, e[D], r === k ? h.some(300) : h.none()), n.setData({
        results: i
      });
    }, r = 200, i = null, {
      cancel: function cancel() {
        null !== i && (clearTimeout(i), i = null);
      },
      throttle: function throttle() {
        for (var t = [], n = 0; n < arguments.length; n++) {
          t[n] = arguments[n];
        }

        null !== i && clearTimeout(i), i = setTimeout(function () {
          e.apply(null, t), i = null;
        }, r);
      }
    }),
        n = {
      label: "Search",
      type: "input",
      name: D
    },
        l = {
      type: "collection",
      name: "results"
    },
        s = function s() {
      return {
        title: "Emoticons",
        size: "normal",
        body: {
          type: "tabpanel",
          tabs: function (t, n) {
            for (var e = t.length, r = new Array(e), o = 0; o < e; o++) {
              var i = t[o];
              r[o] = n(i, o);
            }

            return r;
          }(u.listCategories(), function (t) {
            return {
              title: t,
              name: t,
              items: [n, l]
            };
          })
        },
        initialData: t,
        onTabChange: function onTabChange(t, n) {
          a.set(n.newTabName), c.throttle(t);
        },
        onChange: c.throttle,
        onAction: function onAction(t, n) {
          var e, r;
          "results" === n.name && (e = o, r = n.value, e.insertContent(r), t.close());
        },
        buttons: [{
          type: "cancel",
          text: "Close",
          primary: !0
        }]
      };
    },
        f = o.windowManager.open(s());

    f.focus(D), u.hasLoaded() || (f.block("Loading emoticons..."), u.waitForLoad().then(function () {
      f.redial(s()), c.throttle(f), f.focus(D), f.unblock();
    })["catch"](function (t) {
      f.redial({
        title: "Emoticons",
        body: {
          type: "panel",
          items: [{
            type: "alertbanner",
            level: "error",
            icon: "warning",
            text: "<p>Could not load emoticons</p>"
          }]
        },
        buttons: [{
          type: "cancel",
          text: "Close",
          primary: !0
        }],
        initialData: {
          pattern: "",
          results: []
        }
      }), f.focus(D), f.unblock();
    }));
  };

  r.add("emoticons", function (t, n) {
    var e,
        r,
        o,
        i,
        u,
        a,
        c,
        l,
        s,
        f = (r = n, o = (e = t).getParam("emoticons_database", "emojis", "string"), e.getParam("emoticons_database_url", r + "/js/" + o + e.suffix + ".js", "string")),
        m = t.getParam("emoticons_database_id", "tinymce.plugins.emoticons", "string"),
        g = P(t, f, m);
    u = g, a = function a() {
      return L(i, u);
    }, (i = t).ui.registry.addButton("emoticons", {
      tooltip: "Emoticons",
      icon: "emoji",
      onAction: a
    }), i.ui.registry.addMenuItem("emoticons", {
      text: "Emoticons...",
      icon: "emoji",
      onAction: a
    }), l = g, (c = t).ui.registry.addAutocompleter("emoticons", {
      ch: ":",
      columns: "auto",
      minChars: 2,
      fetch: function fetch(n, e) {
        return l.waitForLoad().then(function () {
          var t = l.listAll();
          return x(t, n, h.some(e));
        });
      },
      onAction: function onAction(t, n, e) {
        c.selection.setRng(n), c.insertContent(e), t.hide();
      }
    }), (s = t).on("PreInit", function () {
      s.parser.addAttributeFilter("data-emoticon", function (t) {
        !function (t, n) {
          for (var e = 0, r = t.length; e < r; e++) {
            n(t[e], e);
          }
        }(t, function (t) {
          t.attr("data-mce-resize", "false"), t.attr("data-mce-placeholder", "1");
        });
      });
    });
  });
}();