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

  var n,
      e,
      t,
      r = tinymce.util.Tools.resolve("tinymce.PluginManager"),
      u = function u(n, e, t) {
    var r = "UL" === e ? "InsertUnorderedList" : "InsertOrderedList";
    n.execCommand(r, !1, !1 === t ? null : {
      "list-style-type": t
    });
  },
      l = tinymce.util.Tools.resolve("tinymce.util.Tools"),
      i = function i(n) {
    return function () {
      return n;
    };
  },
      s = i(!1),
      c = i(!0),
      o = function o() {
    return a;
  },
      a = (n = function n(_n) {
    return _n.isNone();
  }, {
    fold: function fold(n, e) {
      return n();
    },
    is: s,
    isSome: s,
    isNone: c,
    getOr: t = function t(n) {
      return n;
    },
    getOrThunk: e = function e(n) {
      return n();
    },
    getOrDie: function getOrDie(n) {
      throw new Error(n || "error: getOrDie called on none.");
    },
    getOrNull: i(null),
    getOrUndefined: i(undefined),
    or: t,
    orThunk: e,
    map: o,
    each: function each() {},
    bind: o,
    exists: s,
    forall: c,
    filter: o,
    equals: n,
    equals_: n,
    toArray: function toArray() {
      return [];
    },
    toString: i("none()")
  }),
      d = function d(t) {
    var n = i(t),
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
      isSome: c,
      isNone: s,
      getOr: n,
      getOrThunk: n,
      getOrDie: n,
      getOrNull: n,
      getOrUndefined: n,
      or: e,
      orThunk: e,
      map: function map(n) {
        return d(n(t));
      },
      each: function each(n) {
        n(t);
      },
      bind: r,
      exists: r,
      forall: r,
      filter: function filter(n) {
        return n(t) ? o : a;
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
        return n.fold(s, function (n) {
          return e(t, n);
        });
      }
    };

    return o;
  },
      f = function f(n) {
    return null === n || n === undefined ? a : d(n);
  },
      g = function g(n) {
    return n && /^(TH|TD)$/.test(n.nodeName);
  },
      m = function m(r) {
    return function (n) {
      return n && /^(OL|UL|DL)$/.test(n.nodeName) && (t = n, (e = r).$.contains(e.getBody(), t));
      var e, t;
    };
  },
      p = function p(n, e, t) {
    var r = function (n, e) {
      for (var t = 0; t < n.length; t++) {
        if (e(n[t])) return t;
      }

      return -1;
    }(e.parents, g),
        o = -1 !== r ? e.parents.slice(0, r) : e.parents,
        i = l.grep(o, m(n));

    return 0 < i.length && i[0].nodeName === t;
  },
      y = function y(o, n, e, t, r, i) {
    o.ui.registry.addSplitButton(n, {
      tooltip: e,
      icon: "OL" === r ? "ordered-list" : "unordered-list",
      presets: "listpreview",
      columns: 3,
      fetch: function fetch(n) {
        n(l.map(i, function (n) {
          return {
            type: "choiceitem",
            value: "default" === n ? "" : n,
            icon: "list-" + ("OL" === r ? "num" : "bull") + "-" + ("disc" === n || "decimal" === n ? "default" : n),
            text: n.replace(/\-/g, " ").replace(/\b\w/g, function (n) {
              return n.toUpperCase();
            })
          };
        }));
      },
      onAction: function onAction() {
        return o.execCommand(t);
      },
      onItemAction: function onItemAction(n, e) {
        u(o, r, e);
      },
      select: function select(e) {
        var n, t, r;
        return (t = (n = o).dom.getParent(n.selection.getNode(), "ol,ul"), r = n.dom.getStyle(t, "listStyleType"), f(r)).map(function (n) {
          return e === n;
        }).getOr(!1);
      },
      onSetup: function onSetup(e) {
        var n = function n(_n2) {
          e.setActive(p(o, _n2, r));
        };

        return o.on("NodeChange", n), function () {
          return o.off("NodeChange", n);
        };
      }
    });
  },
      h = function h(n, e, t, r, o, i) {
    var u, l, s, c, a;
    1 < i.length ? y(n, e, t, r, o, i) : (l = e, s = t, c = r, a = o, (u = n).ui.registry.addToggleButton(l, {
      active: !1,
      tooltip: s,
      icon: "OL" === a ? "ordered-list" : "unordered-list",
      onSetup: function onSetup(e) {
        var n = function n(_n3) {
          e.setActive(p(u, _n3, a));
        };

        return u.on("NodeChange", n), function () {
          return u.off("NodeChange", n);
        };
      },
      onAction: function onAction() {
        return u.execCommand(c);
      }
    }));
  };

  r.add("advlist", function (n) {
    var t, e, r, o;
    n.hasPlugin("lists") ? (h(e = n, "numlist", "Numbered list", "InsertOrderedList", "OL", (r = e.getParam("advlist_number_styles", "default,lower-alpha,lower-greek,lower-roman,upper-alpha,upper-roman")) ? r.split(/[ ,]/) : []), h(e, "bullist", "Bullet list", "InsertUnorderedList", "UL", (o = e.getParam("advlist_bullet_styles", "default,circle,square")) ? o.split(/[ ,]/) : []), (t = n).addCommand("ApplyUnorderedListStyle", function (n, e) {
      u(t, "UL", e["list-style-type"]);
    }), t.addCommand("ApplyOrderedListStyle", function (n, e) {
      u(t, "OL", e["list-style-type"]);
    })) : console.error("Please use the Lists plugin together with the Advanced List plugin.");
  });
}();