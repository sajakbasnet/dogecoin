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

  var e = tinymce.util.Tools.resolve("tinymce.PluginManager"),
      u = function u(e) {
    return e.getParam("insertdatetime_timeformat", e.translate("%H:%M:%S"));
  },
      c = function c(e) {
    return e.getParam("insertdatetime_formats", ["%H:%M:%S", "%Y-%m-%d", "%I:%M:%S %p", "%D"]);
  },
      r = "Sun Mon Tue Wed Thu Fri Sat Sun".split(" "),
      a = "Sunday Monday Tuesday Wednesday Thursday Friday Saturday Sunday".split(" "),
      i = "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec".split(" "),
      o = "January February March April May June July August September October November December".split(" "),
      m = function m(e, t) {
    if ((e = "" + e).length < t) for (var n = 0; n < t - e.length; n++) {
      e = "0" + e;
    }
    return e;
  },
      s = function s(e, t, n) {
    return n = n || new Date(), t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = (t = t.replace("%D", "%m/%d/%Y")).replace("%r", "%I:%M:%S %p")).replace("%Y", "" + n.getFullYear())).replace("%y", "" + n.getYear())).replace("%m", m(n.getMonth() + 1, 2))).replace("%d", m(n.getDate(), 2))).replace("%H", "" + m(n.getHours(), 2))).replace("%M", "" + m(n.getMinutes(), 2))).replace("%S", "" + m(n.getSeconds(), 2))).replace("%I", "" + ((n.getHours() + 11) % 12 + 1))).replace("%p", n.getHours() < 12 ? "AM" : "PM")).replace("%B", "" + e.translate(o[n.getMonth()]))).replace("%b", "" + e.translate(i[n.getMonth()]))).replace("%A", "" + e.translate(a[n.getDay()]))).replace("%a", "" + e.translate(r[n.getDay()]))).replace("%%", "%");
  },
      l = function l(e, t) {
    var n, r, a, i, o, u, c, m;
    e.getParam("insertdatetime_element", !1) ? (n = s(e, t), r = void 0, r = /%[HMSIp]/.test(t) ? s(e, "%Y-%m-%dT%H:%M") : s(e, "%Y-%m-%d"), (a = e.dom.getParent(e.selection.getStart(), "time")) ? (o = a, u = r, c = n, m = (i = e).dom.create("time", {
      datetime: u
    }, c), o.parentNode.insertBefore(m, o), i.dom.remove(o), i.selection.select(m, !0), i.selection.collapse(!1)) : e.insertContent('<time datetime="' + r + '">' + n + "</time>")) : e.insertContent(s(e, t));
  },
      t = function t(_t) {
    _t.addCommand("mceInsertDate", function () {
      var e;
      l(_t, (e = _t).getParam("insertdatetime_dateformat", e.translate("%Y-%m-%d")));
    }), _t.addCommand("mceInsertTime", function () {
      l(_t, u(_t));
    });
  },
      d = tinymce.util.Tools.resolve("tinymce.util.Tools"),
      n = function n(_n) {
    var e,
        t,
        r,
        a,
        i = c(_n),
        o = (a = c(r = _n), e = 0 < a.length ? a[0] : u(r), t = e, {
      get: function get() {
        return t;
      },
      set: function set(e) {
        t = e;
      }
    });

    _n.ui.registry.addSplitButton("insertdatetime", {
      icon: "insert-time",
      tooltip: "Insert date/time",
      select: function select(e) {
        return e === o.get();
      },
      fetch: function fetch(e) {
        e(d.map(i, function (e) {
          return {
            type: "choiceitem",
            text: s(_n, e),
            value: e
          };
        }));
      },
      onAction: function onAction(e) {
        l(_n, o.get());
      },
      onItemAction: function onItemAction(e, t) {
        o.set(t), l(_n, t);
      }
    });

    _n.ui.registry.addNestedMenuItem("insertdatetime", {
      icon: "insert-time",
      text: "Date/time",
      getSubmenuItems: function getSubmenuItems() {
        return d.map(i, function (e) {
          return {
            type: "menuitem",
            text: s(_n, e),
            onAction: (t = e, function () {
              o.set(t), l(_n, t);
            })
          };
          var t;
        });
      }
    });
  };

  e.add("insertdatetime", function (e) {
    t(e), n(e);
  });
}();