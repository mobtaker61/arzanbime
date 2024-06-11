    (function() {
        const n = document.createElement("link").relList;
        if (n && n.supports && n.supports("modulepreload")) return;
        for (const d of document.querySelectorAll('link[rel="modulepreload"]')) a(d);
        new MutationObserver((d) => {
            for (const u of d)
                if (u.type === "childList")
                    for (const f of u.addedNodes)
                        f.tagName === "LINK" && f.rel === "modulepreload" && a(f);
        }).observe(document, {
            childList: !0,
            subtree: !0
        });

        function r(d) {
            const u = {};
            return (
                d.integrity && (u.integrity = d.integrity),
                d.referrerPolicy && (u.referrerPolicy = d.referrerPolicy),
                d.crossOrigin === "use-credentials" ?
                (u.credentials = "include") :
                d.crossOrigin === "anonymous" ?
                (u.credentials = "omit") :
                (u.credentials = "same-origin"),
                u
            );
        }

        function a(d) {
            if (d.ep) return;
            d.ep = !0;
            const u = r(d);
            fetch(d.href, u);
        }
    })();
    const Si = document.querySelector("html"),
        Li = document.querySelector("#header-nav"),
        Ei = document.querySelector("#header-logo");

    function Xs(o, n) {
        o.addEventListener("change", () => {
            n.classList.toggle("burger-open"),
                Si == null || Si.classList.toggle("burger-open"),
                Li == null || Li.classList.toggle("slide-nav"),
                Ei == null || Ei.classList.toggle("header-logo");
        });
    }
    const Mi = document.querySelector("#copy-btn"),
        Ci = document.querySelector("#copy-text");

    function $s() {
        Mi == null ||
            Mi.addEventListener("click", () => {
                navigator.clipboard.writeText(Ci == null ? void 0 : Ci.textContent);
            });
    }
    const ir = document.querySelectorAll("#qa-button");

    function Ks() {
        for (let o = 0; o < ir.length; o++) {
            let n = !0;
            ir[o].addEventListener("click", (r) => {
                let a = r.target.closest("li");
                n
                    ?
                    (a.classList.add("qa-item"), (n = !1)) :
                    (a.classList.remove("qa-item"), (n = !0));
            });
        }
    }
    var Js =
        typeof globalThis < "u" ?
        globalThis :
        typeof window < "u" ?
        window :
        typeof global < "u" ?
        global :
        typeof self < "u" ?
        self : {};

    function Qs(o) {
        return o && o.__esModule && Object.prototype.hasOwnProperty.call(o, "default") ?
            o.default :
            o;
    }
    var Fi = {
        exports: {}
    };
    /* @preserve
        * Leaflet 1.9.4, a JS library for interactive maps. https://leafletjs.com
        * (c) 2010-2023 Vladimir Agafonkin, (c) 2010-2011 CloudMade
        */
    (function(o, n) {
        (function(r, a) {
            a(n);
        })(Js, function(r) {
            var a = "1.9.4";

            function d(t) {
                var e, i, s, l;
                for (i = 1, s = arguments.length; i < s; i++) {
                    l = arguments[i];
                    for (e in l) t[e] = l[e];
                }
                return t;
            }
            var u =
                Object.create ||
                (function() {
                    function t() {}
                    return function(e) {
                        return (t.prototype = e), new t();
                    };
                })();

            function f(t, e) {
                var i = Array.prototype.slice;
                if (t.bind) return t.bind.apply(t, i.call(arguments, 1));
                var s = i.call(arguments, 2);
                return function() {
                    return t.apply(e, s.length ? s.concat(i.call(arguments)) : arguments);
                };
            }
            var p = 0;

            function h(t) {
                return "_leaflet_id" in t || (t._leaflet_id = ++p), t._leaflet_id;
            }

            function y(t, e, i) {
                var s, l, c, m;
                return (
                    (m = function() {
                        (s = !1), l && (c.apply(i, l), (l = !1));
                    }),
                    (c = function() {
                        s
                            ?
                            (l = arguments) :
                            (t.apply(i, arguments), setTimeout(m, e), (s = !0));
                    }),
                    c
                );
            }

            function g(t, e, i) {
                var s = e[1],
                    l = e[0],
                    c = s - l;
                return t === s && i ? t : ((((t - l) % c) + c) % c) + l;
            }

            function v() {
                return !1;
            }

            function P(t, e) {
                if (e === !1) return t;
                var i = Math.pow(10, e === void 0 ? 6 : e);
                return Math.round(t * i) / i;
            }

            function T(t) {
                return t.trim ? t.trim() : t.replace(/^\s+|\s+$/g, "");
            }

            function w(t) {
                return T(t).split(/\s+/);
            }

            function b(t, e) {
                Object.prototype.hasOwnProperty.call(t, "options") ||
                    (t.options = t.options ? u(t.options) : {});
                for (var i in e) t.options[i] = e[i];
                return t.options;
            }

            function C(t, e, i) {
                var s = [];
                for (var l in t)
                    s.push(
                        encodeURIComponent(i ? l.toUpperCase() : l) +
                        "=" +
                        encodeURIComponent(t[l])
                    );
                return (!e || e.indexOf("?") === -1 ? "?" : "&") + s.join("&");
            }
            var E = /\{ *([\w_ -]+) *\}/g;

            function A(t, e) {
                return t.replace(E, function(i, s) {
                    var l = e[s];
                    if (l === void 0)
                        throw new Error("No value provided for variable " + i);
                    return typeof l == "function" && (l = l(e)), l;
                });
            }
            var M =
                Array.isArray ||
                function(t) {
                    return Object.prototype.toString.call(t) === "[object Array]";
                };

            function z(t, e) {
                for (var i = 0; i < t.length; i++)
                    if (t[i] === e) return i;
                return -1;
            }
            var B = "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=";

            function j(t) {
                return window["webkit" + t] || window["moz" + t] || window["ms" + t];
            }
            var gt = 0;

            function K(t) {
                var e = +new Date(),
                    i = Math.max(0, 16 - (e - gt));
                return (gt = e + i), window.setTimeout(t, i);
            }
            var dt = window.requestAnimationFrame || j("RequestAnimationFrame") || K,
                O =
                window.cancelAnimationFrame ||
                j("CancelAnimationFrame") ||
                j("CancelRequestAnimationFrame") ||
                function(t) {
                    window.clearTimeout(t);
                };

            function D(t, e, i) {
                if (i && dt === K) t.call(e);
                else return dt.call(window, f(t, e));
            }

            function R(t) {
                t && O.call(window, t);
            }
            var H = {
                __proto__: null,
                extend: d,
                create: u,
                bind: f,
                get lastId() {
                    return p;
                },
                stamp: h,
                throttle: y,
                wrapNum: g,
                falseFn: v,
                formatNum: P,
                trim: T,
                splitWords: w,
                setOptions: b,
                getParamString: C,
                template: A,
                isArray: M,
                indexOf: z,
                emptyImageUrl: B,
                requestFn: dt,
                cancelFn: O,
                requestAnimFrame: D,
                cancelAnimFrame: R,
            };

            function q() {}
            (q.extend = function(t) {
                var e = function() {
                        b(this),
                            this.initialize && this.initialize.apply(this, arguments),
                            this.callInitHooks();
                    },
                    i = (e.__super__ = this.prototype),
                    s = u(i);
                (s.constructor = e), (e.prototype = s);
                for (var l in this)
                    Object.prototype.hasOwnProperty.call(this, l) &&
                    l !== "prototype" &&
                    l !== "__super__" &&
                    (e[l] = this[l]);
                return (
                    t.statics && d(e, t.statics),
                    t.includes && (at(t.includes), d.apply(null, [s].concat(t.includes))),
                    d(s, t),
                    delete s.statics,
                    delete s.includes,
                    s.options &&
                    ((s.options = i.options ? u(i.options) : {}),
                        d(s.options, t.options)),
                    (s._initHooks = []),
                    (s.callInitHooks = function() {
                        if (!this._initHooksCalled) {
                            i.callInitHooks && i.callInitHooks.call(this),
                                (this._initHooksCalled = !0);
                            for (var c = 0, m = s._initHooks.length; c < m; c++)
                                s._initHooks[c].call(this);
                        }
                    }),
                    e
                );
            }),
            (q.include = function(t) {
                var e = this.prototype.options;
                return (
                    d(this.prototype, t),
                    t.options &&
                    ((this.prototype.options = e), this.mergeOptions(t.options)),
                    this
                );
            }),
            (q.mergeOptions = function(t) {
                return d(this.prototype.options, t), this;
            }),
            (q.addInitHook = function(t) {
                var e = Array.prototype.slice.call(arguments, 1),
                    i =
                    typeof t == "function" ?
                    t :
                    function() {
                        this[t].apply(this, e);
                    };
                return (
                    (this.prototype._initHooks = this.prototype._initHooks || []),
                    this.prototype._initHooks.push(i),
                    this
                );
            });

            function at(t) {
                if (!(typeof L > "u" || !L || !L.Mixin)) {
                    t = M(t) ? t : [t];
                    for (var e = 0; e < t.length; e++)
                        t[e] === L.Mixin.Events &&
                        console.warn(
                            "Deprecated include of L.Mixin.Events: this property will be removed in future releases, please inherit from L.Evented instead.",
                            new Error().stack
                        );
                }
            }
            var tt = {
                on: function(t, e, i) {
                    if (typeof t == "object")
                        for (var s in t) this._on(s, t[s], e);
                    else {
                        t = w(t);
                        for (var l = 0, c = t.length; l < c; l++) this._on(t[l], e, i);
                    }
                    return this;
                },
                off: function(t, e, i) {
                    if (!arguments.length) delete this._events;
                    else if (typeof t == "object")
                        for (var s in t) this._off(s, t[s], e);
                    else {
                        t = w(t);
                        for (var l = arguments.length === 1, c = 0, m = t.length; c < m; c++)
                            l ? this._off(t[c]) : this._off(t[c], e, i);
                    }
                    return this;
                },
                _on: function(t, e, i, s) {
                    if (typeof e != "function") {
                        console.warn("wrong listener type: " + typeof e);
                        return;
                    }
                    if (this._listens(t, e, i) === !1) {
                        i === this && (i = void 0);
                        var l = {
                            fn: e,
                            ctx: i
                        };
                        s && (l.once = !0),
                            (this._events = this._events || {}),
                            (this._events[t] = this._events[t] || []),
                            this._events[t].push(l);
                    }
                },
                _off: function(t, e, i) {
                    var s, l, c;
                    if (this._events && ((s = this._events[t]), !!s)) {
                        if (arguments.length === 1) {
                            if (this._firingCount)
                                for (l = 0, c = s.length; l < c; l++) s[l].fn = v;
                            delete this._events[t];
                            return;
                        }
                        if (typeof e != "function") {
                            console.warn("wrong listener type: " + typeof e);
                            return;
                        }
                        var m = this._listens(t, e, i);
                        if (m !== !1) {
                            var _ = s[m];
                            this._firingCount &&
                                ((_.fn = v), (this._events[t] = s = s.slice())),
                                s.splice(m, 1);
                        }
                    }
                },
                fire: function(t, e, i) {
                    if (!this.listens(t, i)) return this;
                    var s = d({}, e, {
                        type: t,
                        target: this,
                        sourceTarget: (e && e.sourceTarget) || this,
                    });
                    if (this._events) {
                        var l = this._events[t];
                        if (l) {
                            this._firingCount = this._firingCount + 1 || 1;
                            for (var c = 0, m = l.length; c < m; c++) {
                                var _ = l[c],
                                    x = _.fn;
                                _.once && this.off(t, x, _.ctx), x.call(_.ctx || this, s);
                            }
                            this._firingCount--;
                        }
                    }
                    return i && this._propagateEvent(s), this;
                },
                listens: function(t, e, i, s) {
                    typeof t != "string" && console.warn('"string" type argument expected');
                    var l = e;
                    typeof e != "function" && ((s = !!e), (l = void 0), (i = void 0));
                    var c = this._events && this._events[t];
                    if (c && c.length && this._listens(t, l, i) !== !1) return !0;
                    if (s) {
                        for (var m in this._eventParents)
                            if (this._eventParents[m].listens(t, e, i, s)) return !0;
                    }
                    return !1;
                },
                _listens: function(t, e, i) {
                    if (!this._events) return !1;
                    var s = this._events[t] || [];
                    if (!e) return !!s.length;
                    i === this && (i = void 0);
                    for (var l = 0, c = s.length; l < c; l++)
                        if (s[l].fn === e && s[l].ctx === i) return l;
                    return !1;
                },
                once: function(t, e, i) {
                    if (typeof t == "object")
                        for (var s in t) this._on(s, t[s], e, !0);
                    else {
                        t = w(t);
                        for (var l = 0, c = t.length; l < c; l++) this._on(t[l], e, i, !0);
                    }
                    return this;
                },
                addEventParent: function(t) {
                    return (
                        (this._eventParents = this._eventParents || {}),
                        (this._eventParents[h(t)] = t),
                        this
                    );
                },
                removeEventParent: function(t) {
                    return this._eventParents && delete this._eventParents[h(t)], this;
                },
                _propagateEvent: function(t) {
                    for (var e in this._eventParents)
                        this._eventParents[e].fire(
                            t.type,
                            d({
                                layer: t.target,
                                propagatedFrom: t.target
                            }, t),
                            !0
                        );
                },
            };
            (tt.addEventListener = tt.on),
            (tt.removeEventListener = tt.clearAllEventListeners = tt.off),
            (tt.addOneTimeEventListener = tt.once),
            (tt.fireEvent = tt.fire),
            (tt.hasEventListeners = tt.listens);
            var kt = q.extend(tt);

            function I(t, e, i) {
                (this.x = i ? Math.round(t) : t), (this.y = i ? Math.round(e) : e);
            }
            var ct =
                Math.trunc ||
                function(t) {
                    return t > 0 ? Math.floor(t) : Math.ceil(t);
                };
            I.prototype = {
                clone: function() {
                    return new I(this.x, this.y);
                },
                add: function(t) {
                    return this.clone()._add(Z(t));
                },
                _add: function(t) {
                    return (this.x += t.x), (this.y += t.y), this;
                },
                subtract: function(t) {
                    return this.clone()._subtract(Z(t));
                },
                _subtract: function(t) {
                    return (this.x -= t.x), (this.y -= t.y), this;
                },
                divideBy: function(t) {
                    return this.clone()._divideBy(t);
                },
                _divideBy: function(t) {
                    return (this.x /= t), (this.y /= t), this;
                },
                multiplyBy: function(t) {
                    return this.clone()._multiplyBy(t);
                },
                _multiplyBy: function(t) {
                    return (this.x *= t), (this.y *= t), this;
                },
                scaleBy: function(t) {
                    return new I(this.x * t.x, this.y * t.y);
                },
                unscaleBy: function(t) {
                    return new I(this.x / t.x, this.y / t.y);
                },
                round: function() {
                    return this.clone()._round();
                },
                _round: function() {
                    return (
                        (this.x = Math.round(this.x)), (this.y = Math.round(this.y)), this
                    );
                },
                floor: function() {
                    return this.clone()._floor();
                },
                _floor: function() {
                    return (
                        (this.x = Math.floor(this.x)), (this.y = Math.floor(this.y)), this
                    );
                },
                ceil: function() {
                    return this.clone()._ceil();
                },
                _ceil: function() {
                    return (this.x = Math.ceil(this.x)), (this.y = Math.ceil(this.y)), this;
                },
                trunc: function() {
                    return this.clone()._trunc();
                },
                _trunc: function() {
                    return (this.x = ct(this.x)), (this.y = ct(this.y)), this;
                },
                distanceTo: function(t) {
                    t = Z(t);
                    var e = t.x - this.x,
                        i = t.y - this.y;
                    return Math.sqrt(e * e + i * i);
                },
                equals: function(t) {
                    return (t = Z(t)), t.x === this.x && t.y === this.y;
                },
                contains: function(t) {
                    return (
                        (t = Z(t)),
                        Math.abs(t.x) <= Math.abs(this.x) && Math.abs(t.y) <= Math.abs(this.y)
                    );
                },
                toString: function() {
                    return "Point(" + P(this.x) + ", " + P(this.y) + ")";
                },
            };

            function Z(t, e, i) {
                return t instanceof I ?
                    t :
                    M(t) ?
                    new I(t[0], t[1]) :
                    t == null ?
                    t :
                    typeof t == "object" && "x" in t && "y" in t ?
                    new I(t.x, t.y) :
                    new I(t, e, i);
            }

            function $(t, e) {
                if (t)
                    for (var i = e ? [t, e] : t, s = 0, l = i.length; s < l; s++)
                        this.extend(i[s]);
            }
            $.prototype = {
                extend: function(t) {
                    var e, i;
                    if (!t) return this;
                    if (t instanceof I || typeof t[0] == "number" || "x" in t) e = i = Z(t);
                    else if (((t = ot(t)), (e = t.min), (i = t.max), !e || !i)) return this;
                    return (
                        !this.min && !this.max ?
                        ((this.min = e.clone()), (this.max = i.clone())) :
                        ((this.min.x = Math.min(e.x, this.min.x)),
                            (this.max.x = Math.max(i.x, this.max.x)),
                            (this.min.y = Math.min(e.y, this.min.y)),
                            (this.max.y = Math.max(i.y, this.max.y))),
                        this
                    );
                },
                getCenter: function(t) {
                    return Z(
                        (this.min.x + this.max.x) / 2,
                        (this.min.y + this.max.y) / 2,
                        t
                    );
                },
                getBottomLeft: function() {
                    return Z(this.min.x, this.max.y);
                },
                getTopRight: function() {
                    return Z(this.max.x, this.min.y);
                },
                getTopLeft: function() {
                    return this.min;
                },
                getBottomRight: function() {
                    return this.max;
                },
                getSize: function() {
                    return this.max.subtract(this.min);
                },
                contains: function(t) {
                    var e, i;
                    return (
                        typeof t[0] == "number" || t instanceof I ? (t = Z(t)) : (t = ot(t)),
                        t instanceof $ ? ((e = t.min), (i = t.max)) : (e = i = t),
                        e.x >= this.min.x &&
                        i.x <= this.max.x &&
                        e.y >= this.min.y &&
                        i.y <= this.max.y
                    );
                },
                intersects: function(t) {
                    t = ot(t);
                    var e = this.min,
                        i = this.max,
                        s = t.min,
                        l = t.max,
                        c = l.x >= e.x && s.x <= i.x,
                        m = l.y >= e.y && s.y <= i.y;
                    return c && m;
                },
                overlaps: function(t) {
                    t = ot(t);
                    var e = this.min,
                        i = this.max,
                        s = t.min,
                        l = t.max,
                        c = l.x > e.x && s.x < i.x,
                        m = l.y > e.y && s.y < i.y;
                    return c && m;
                },
                isValid: function() {
                    return !!(this.min && this.max);
                },
                pad: function(t) {
                    var e = this.min,
                        i = this.max,
                        s = Math.abs(e.x - i.x) * t,
                        l = Math.abs(e.y - i.y) * t;
                    return ot(Z(e.x - s, e.y - l), Z(i.x + s, i.y + l));
                },
                equals: function(t) {
                    return t ?
                        ((t = ot(t)),
                            this.min.equals(t.getTopLeft()) &&
                            this.max.equals(t.getBottomRight())) :
                        !1;
                },
            };

            function ot(t, e) {
                return !t || t instanceof $ ? t : new $(t, e);
            }

            function pt(t, e) {
                if (t)
                    for (var i = e ? [t, e] : t, s = 0, l = i.length; s < l; s++)
                        this.extend(i[s]);
            }
            pt.prototype = {
                extend: function(t) {
                    var e = this._southWest,
                        i = this._northEast,
                        s,
                        l;
                    if (t instanceof J)(s = t), (l = t);
                    else if (t instanceof pt) {
                        if (((s = t._southWest), (l = t._northEast), !s || !l)) return this;
                    } else return t ? this.extend(U(t) || nt(t)) : this;
                    return (
                        !e && !i ?
                        ((this._southWest = new J(s.lat, s.lng)),
                            (this._northEast = new J(l.lat, l.lng))) :
                        ((e.lat = Math.min(s.lat, e.lat)),
                            (e.lng = Math.min(s.lng, e.lng)),
                            (i.lat = Math.max(l.lat, i.lat)),
                            (i.lng = Math.max(l.lng, i.lng))),
                        this
                    );
                },
                pad: function(t) {
                    var e = this._southWest,
                        i = this._northEast,
                        s = Math.abs(e.lat - i.lat) * t,
                        l = Math.abs(e.lng - i.lng) * t;
                    return new pt(new J(e.lat - s, e.lng - l), new J(i.lat + s, i.lng + l));
                },
                getCenter: function() {
                    return new J(
                        (this._southWest.lat + this._northEast.lat) / 2,
                        (this._southWest.lng + this._northEast.lng) / 2
                    );
                },
                getSouthWest: function() {
                    return this._southWest;
                },
                getNorthEast: function() {
                    return this._northEast;
                },
                getNorthWest: function() {
                    return new J(this.getNorth(), this.getWest());
                },
                getSouthEast: function() {
                    return new J(this.getSouth(), this.getEast());
                },
                getWest: function() {
                    return this._southWest.lng;
                },
                getSouth: function() {
                    return this._southWest.lat;
                },
                getEast: function() {
                    return this._northEast.lng;
                },
                getNorth: function() {
                    return this._northEast.lat;
                },
                contains: function(t) {
                    typeof t[0] == "number" || t instanceof J || "lat" in t ?
                        (t = U(t)) :
                        (t = nt(t));
                    var e = this._southWest,
                        i = this._northEast,
                        s,
                        l;
                    return (
                        t instanceof pt ?
                        ((s = t.getSouthWest()), (l = t.getNorthEast())) :
                        (s = l = t),
                        s.lat >= e.lat && l.lat <= i.lat && s.lng >= e.lng && l.lng <= i.lng
                    );
                },
                intersects: function(t) {
                    t = nt(t);
                    var e = this._southWest,
                        i = this._northEast,
                        s = t.getSouthWest(),
                        l = t.getNorthEast(),
                        c = l.lat >= e.lat && s.lat <= i.lat,
                        m = l.lng >= e.lng && s.lng <= i.lng;
                    return c && m;
                },
                overlaps: function(t) {
                    t = nt(t);
                    var e = this._southWest,
                        i = this._northEast,
                        s = t.getSouthWest(),
                        l = t.getNorthEast(),
                        c = l.lat > e.lat && s.lat < i.lat,
                        m = l.lng > e.lng && s.lng < i.lng;
                    return c && m;
                },
                toBBoxString: function() {
                    return [
                        this.getWest(),
                        this.getSouth(),
                        this.getEast(),
                        this.getNorth(),
                    ].join(",");
                },
                equals: function(t, e) {
                    return t ?
                        ((t = nt(t)),
                            this._southWest.equals(t.getSouthWest(), e) &&
                            this._northEast.equals(t.getNorthEast(), e)) :
                        !1;
                },
                isValid: function() {
                    return !!(this._southWest && this._northEast);
                },
            };

            function nt(t, e) {
                return t instanceof pt ? t : new pt(t, e);
            }

            function J(t, e, i) {
                if (isNaN(t) || isNaN(e))
                    throw new Error("Invalid LatLng object: (" + t + ", " + e + ")");
                (this.lat = +t), (this.lng = +e), i !== void 0 && (this.alt = +i);
            }
            J.prototype = {
                equals: function(t, e) {
                    if (!t) return !1;
                    t = U(t);
                    var i = Math.max(
                        Math.abs(this.lat - t.lat),
                        Math.abs(this.lng - t.lng)
                    );
                    return i <= (e === void 0 ? 1e-9 : e);
                },
                toString: function(t) {
                    return "LatLng(" + P(this.lat, t) + ", " + P(this.lng, t) + ")";
                },
                distanceTo: function(t) {
                    return Ft.distance(this, U(t));
                },
                wrap: function() {
                    return Ft.wrapLatLng(this);
                },
                toBounds: function(t) {
                    var e = (180 * t) / 40075017,
                        i = e / Math.cos((Math.PI / 180) * this.lat);
                    return nt([this.lat - e, this.lng - i], [this.lat + e, this.lng + i]);
                },
                clone: function() {
                    return new J(this.lat, this.lng, this.alt);
                },
            };

            function U(t, e, i) {
                return t instanceof J ?
                    t :
                    M(t) && typeof t[0] != "object" ?
                    t.length === 3 ?
                    new J(t[0], t[1], t[2]) :
                    t.length === 2 ?
                    new J(t[0], t[1]) :
                    null :
                    t == null ?
                    t :
                    typeof t == "object" && "lat" in t ?
                    new J(t.lat, "lng" in t ? t.lng : t.lon, t.alt) :
                    e === void 0 ?
                    null :
                    new J(t, e, i);
            }
            var At = {
                    latLngToPoint: function(t, e) {
                        var i = this.projection.project(t),
                            s = this.scale(e);
                        return this.transformation._transform(i, s);
                    },
                    pointToLatLng: function(t, e) {
                        var i = this.scale(e),
                            s = this.transformation.untransform(t, i);
                        return this.projection.unproject(s);
                    },
                    project: function(t) {
                        return this.projection.project(t);
                    },
                    unproject: function(t) {
                        return this.projection.unproject(t);
                    },
                    scale: function(t) {
                        return 256 * Math.pow(2, t);
                    },
                    zoom: function(t) {
                        return Math.log(t / 256) / Math.LN2;
                    },
                    getProjectedBounds: function(t) {
                        if (this.infinite) return null;
                        var e = this.projection.bounds,
                            i = this.scale(t),
                            s = this.transformation.transform(e.min, i),
                            l = this.transformation.transform(e.max, i);
                        return new $(s, l);
                    },
                    infinite: !1,
                    wrapLatLng: function(t) {
                        var e = this.wrapLng ? g(t.lng, this.wrapLng, !0) : t.lng,
                            i = this.wrapLat ? g(t.lat, this.wrapLat, !0) : t.lat,
                            s = t.alt;
                        return new J(i, e, s);
                    },
                    wrapLatLngBounds: function(t) {
                        var e = t.getCenter(),
                            i = this.wrapLatLng(e),
                            s = e.lat - i.lat,
                            l = e.lng - i.lng;
                        if (s === 0 && l === 0) return t;
                        var c = t.getSouthWest(),
                            m = t.getNorthEast(),
                            _ = new J(c.lat - s, c.lng - l),
                            x = new J(m.lat - s, m.lng - l);
                        return new pt(_, x);
                    },
                },
                Ft = d({}, At, {
                    wrapLng: [-180, 180],
                    R: 6371e3,
                    distance: function(t, e) {
                        var i = Math.PI / 180,
                            s = t.lat * i,
                            l = e.lat * i,
                            c = Math.sin(((e.lat - t.lat) * i) / 2),
                            m = Math.sin(((e.lng - t.lng) * i) / 2),
                            _ = c * c + Math.cos(s) * Math.cos(l) * m * m,
                            x = 2 * Math.atan2(Math.sqrt(_), Math.sqrt(1 - _));
                        return this.R * x;
                    },
                }),
                ji = 6378137,
                je = {
                    R: ji,
                    MAX_LATITUDE: 85.0511287798,
                    project: function(t) {
                        var e = Math.PI / 180,
                            i = this.MAX_LATITUDE,
                            s = Math.max(Math.min(i, t.lat), -i),
                            l = Math.sin(s * e);
                        return new I(
                            this.R * t.lng * e,
                            (this.R * Math.log((1 + l) / (1 - l))) / 2
                        );
                    },
                    unproject: function(t) {
                        var e = 180 / Math.PI;
                        return new J(
                            (2 * Math.atan(Math.exp(t.y / this.R)) - Math.PI / 2) * e,
                            (t.x * e) / this.R
                        );
                    },
                    bounds: (function() {
                        var t = ji * Math.PI;
                        return new $([-t, -t], [t, t]);
                    })(),
                };

            function qe(t, e, i, s) {
                if (M(t)) {
                    (this._a = t[0]), (this._b = t[1]), (this._c = t[2]), (this._d = t[3]);
                    return;
                }
                (this._a = t), (this._b = e), (this._c = i), (this._d = s);
            }
            qe.prototype = {
                transform: function(t, e) {
                    return this._transform(t.clone(), e);
                },
                _transform: function(t, e) {
                    return (
                        (e = e || 1),
                        (t.x = e * (this._a * t.x + this._b)),
                        (t.y = e * (this._c * t.y + this._d)),
                        t
                    );
                },
                untransform: function(t, e) {
                    return (
                        (e = e || 1),
                        new I((t.x / e - this._b) / this._a, (t.y / e - this._d) / this._c)
                    );
                },
            };

            function se(t, e, i, s) {
                return new qe(t, e, i, s);
            }
            var Ue = d({}, Ft, {
                    code: "EPSG:3857",
                    projection: je,
                    transformation: (function() {
                        var t = 0.5 / (Math.PI * je.R);
                        return se(t, 0.5, -t, 0.5);
                    })(),
                }),
                Sr = d({}, Ue, {
                    code: "EPSG:900913"
                });

            function qi(t) {
                return document.createElementNS("http://www.w3.org/2000/svg", t);
            }

            function Ui(t, e) {
                var i = "",
                    s,
                    l,
                    c,
                    m,
                    _,
                    x;
                for (s = 0, c = t.length; s < c; s++) {
                    for (_ = t[s], l = 0, m = _.length; l < m; l++)
                        (x = _[l]), (i += (l ? "L" : "M") + x.x + " " + x.y);
                    i += e ? (N.svg ? "z" : "x") : "";
                }
                return i || "M0 0";
            }
            var Ye = document.documentElement.style,
                ye = "ActiveXObject" in window,
                Lr = ye && !document.addEventListener,
                Yi = "msLaunchUri" in navigator && !("documentMode" in document),
                Xe = Lt("webkit"),
                Xi = Lt("android"),
                $i = Lt("android 2") || Lt("android 3"),
                Er = parseInt(/WebKit\/([0-9]+)|$/.exec(navigator.userAgent)[1], 10),
                Mr = Xi && Lt("Google") && Er < 537 && !("AudioNode" in window),
                $e = !!window.opera,
                Ki = !Yi && Lt("chrome"),
                Ji = Lt("gecko") && !Xe && !$e && !ye,
                Cr = !Ki && Lt("safari"),
                Qi = Lt("phantom"),
                tn = "OTransition" in Ye,
                Ir = navigator.platform.indexOf("Win") === 0,
                en = ye && "transition" in Ye,
                Ke =
                "WebKitCSSMatrix" in window &&
                "m11" in new window.WebKitCSSMatrix() &&
                !$i,
                nn = "MozPerspective" in Ye,
                kr = !window.L_DISABLE_3D && (en || Ke || nn) && !tn && !Qi,
                oe = typeof orientation < "u" || Lt("mobile"),
                Ar = oe && Xe,
                Or = oe && Ke,
                rn = !window.PointerEvent && window.MSPointerEvent,
                sn = !!(window.PointerEvent || rn),
                on = "ontouchstart" in window || !!window.TouchEvent,
                zr = !window.L_NO_TOUCH && (on || sn),
                Br = oe && $e,
                Zr = oe && Ji,
                Dr =
                (window.devicePixelRatio ||
                    window.screen.deviceXDPI / window.screen.logicalXDPI) > 1,
                Nr = (function() {
                    var t = !1;
                    try {
                        var e = Object.defineProperty({}, "passive", {
                            get: function() {
                                t = !0;
                            },
                        });
                        window.addEventListener("testPassiveEventSupport", v, e),
                            window.removeEventListener("testPassiveEventSupport", v, e);
                    } catch {}
                    return t;
                })(),
                Rr = (function() {
                    return !!document.createElement("canvas").getContext;
                })(),
                Je = !!(document.createElementNS && qi("svg").createSVGRect),
                Fr = !!Je &&
                (function() {
                    var t = document.createElement("div");
                    return (
                        (t.innerHTML = "<svg/>"),
                        (t.firstChild && t.firstChild.namespaceURI) ===
                        "http://www.w3.org/2000/svg"
                    );
                })(),
                Hr = !Je &&
                (function() {
                    try {
                        var t = document.createElement("div");
                        t.innerHTML = '<v:shape adj="1"/>';
                        var e = t.firstChild;
                        return (
                            (e.style.behavior = "url(#default#VML)"),
                            e && typeof e.adj == "object"
                        );
                    } catch {
                        return !1;
                    }
                })(),
                Gr = navigator.platform.indexOf("Mac") === 0,
                Vr = navigator.platform.indexOf("Linux") === 0;

            function Lt(t) {
                return navigator.userAgent.toLowerCase().indexOf(t) >= 0;
            }
            var N = {
                    ie: ye,
                    ielt9: Lr,
                    edge: Yi,
                    webkit: Xe,
                    android: Xi,
                    android23: $i,
                    androidStock: Mr,
                    opera: $e,
                    chrome: Ki,
                    gecko: Ji,
                    safari: Cr,
                    phantom: Qi,
                    opera12: tn,
                    win: Ir,
                    ie3d: en,
                    webkit3d: Ke,
                    gecko3d: nn,
                    any3d: kr,
                    mobile: oe,
                    mobileWebkit: Ar,
                    mobileWebkit3d: Or,
                    msPointer: rn,
                    pointer: sn,
                    touch: zr,
                    touchNative: on,
                    mobileOpera: Br,
                    mobileGecko: Zr,
                    retina: Dr,
                    passiveEvents: Nr,
                    canvas: Rr,
                    svg: Je,
                    vml: Hr,
                    inlineSvg: Fr,
                    mac: Gr,
                    linux: Vr,
                },
                an = N.msPointer ? "MSPointerDown" : "pointerdown",
                ln = N.msPointer ? "MSPointerMove" : "pointermove",
                dn = N.msPointer ? "MSPointerUp" : "pointerup",
                un = N.msPointer ? "MSPointerCancel" : "pointercancel",
                Qe = {
                    touchstart: an,
                    touchmove: ln,
                    touchend: dn,
                    touchcancel: un
                },
                cn = {
                    touchstart: Xr,
                    touchmove: be,
                    touchend: be,
                    touchcancel: be
                },
                Xt = {},
                hn = !1;

            function Wr(t, e, i) {
                return (
                    e === "touchstart" && Yr(),
                    cn[e] ?
                    ((i = cn[e].bind(this, i)), t.addEventListener(Qe[e], i, !1), i) :
                    (console.warn("wrong event specified:", e), v)
                );
            }

            function jr(t, e, i) {
                if (!Qe[e]) {
                    console.warn("wrong event specified:", e);
                    return;
                }
                t.removeEventListener(Qe[e], i, !1);
            }

            function qr(t) {
                Xt[t.pointerId] = t;
            }

            function Ur(t) {
                Xt[t.pointerId] && (Xt[t.pointerId] = t);
            }

            function fn(t) {
                delete Xt[t.pointerId];
            }

            function Yr() {
                hn ||
                    (document.addEventListener(an, qr, !0),
                        document.addEventListener(ln, Ur, !0),
                        document.addEventListener(dn, fn, !0),
                        document.addEventListener(un, fn, !0),
                        (hn = !0));
            }

            function be(t, e) {
                if (e.pointerType !== (e.MSPOINTER_TYPE_MOUSE || "mouse")) {
                    e.touches = [];
                    for (var i in Xt) e.touches.push(Xt[i]);
                    (e.changedTouches = [e]), t(e);
                }
            }

            function Xr(t, e) {
                e.MSPOINTER_TYPE_TOUCH &&
                    e.pointerType === e.MSPOINTER_TYPE_TOUCH &&
                    ut(e),
                    be(t, e);
            }

            function $r(t) {
                var e = {},
                    i,
                    s;
                for (s in t)(i = t[s]), (e[s] = i && i.bind ? i.bind(t) : i);
                return (
                    (t = e),
                    (e.type = "dblclick"),
                    (e.detail = 2),
                    (e.isTrusted = !1),
                    (e._simulated = !0),
                    e
                );
            }
            var Kr = 200;

            function Jr(t, e) {
                t.addEventListener("dblclick", e);
                var i = 0,
                    s;

                function l(c) {
                    if (c.detail !== 1) {
                        s = c.detail;
                        return;
                    }
                    if (
                        !(
                            c.pointerType === "mouse" ||
                            (c.sourceCapabilities && !c.sourceCapabilities.firesTouchEvents)
                        )
                    ) {
                        var m = vn(c);
                        if (
                            !(
                                m.some(function(x) {
                                    return x instanceof HTMLLabelElement && x.attributes.for;
                                }) &&
                                !m.some(function(x) {
                                    return (
                                        x instanceof HTMLInputElement ||
                                        x instanceof HTMLSelectElement
                                    );
                                })
                            )
                        ) {
                            var _ = Date.now();
                            _ - i <= Kr ? (s++, s === 2 && e($r(c))) : (s = 1), (i = _);
                        }
                    }
                }
                return t.addEventListener("click", l), {
                    dblclick: e,
                    simDblclick: l
                };
            }

            function Qr(t, e) {
                t.removeEventListener("dblclick", e.dblclick),
                    t.removeEventListener("click", e.simDblclick);
            }
            var ti = Te([
                    "transform",
                    "webkitTransform",
                    "OTransform",
                    "MozTransform",
                    "msTransform",
                ]),
                ae = Te([
                    "webkitTransition",
                    "transition",
                    "OTransition",
                    "MozTransition",
                    "msTransition",
                ]),
                pn =
                ae === "webkitTransition" || ae === "OTransition" ?
                ae + "End" :
                "transitionend";

            function mn(t) {
                return typeof t == "string" ? document.getElementById(t) : t;
            }

            function le(t, e) {
                var i = t.style[e] || (t.currentStyle && t.currentStyle[e]);
                if ((!i || i === "auto") && document.defaultView) {
                    var s = document.defaultView.getComputedStyle(t, null);
                    i = s ? s[e] : null;
                }
                return i === "auto" ? null : i;
            }

            function X(t, e, i) {
                var s = document.createElement(t);
                return (s.className = e || ""), i && i.appendChild(s), s;
            }

            function et(t) {
                var e = t.parentNode;
                e && e.removeChild(t);
            }

            function xe(t) {
                for (; t.firstChild;) t.removeChild(t.firstChild);
            }

            function $t(t) {
                var e = t.parentNode;
                e && e.lastChild !== t && e.appendChild(t);
            }

            function Kt(t) {
                var e = t.parentNode;
                e && e.firstChild !== t && e.insertBefore(t, e.firstChild);
            }

            function ei(t, e) {
                if (t.classList !== void 0) return t.classList.contains(e);
                var i = we(t);
                return i.length > 0 && new RegExp("(^|\\s)" + e + "(\\s|$)").test(i);
            }

            function V(t, e) {
                if (t.classList !== void 0)
                    for (var i = w(e), s = 0, l = i.length; s < l; s++)
                        t.classList.add(i[s]);
                else if (!ei(t, e)) {
                    var c = we(t);
                    ii(t, (c ? c + " " : "") + e);
                }
            }

            function it(t, e) {
                t.classList !== void 0 ?
                    t.classList.remove(e) :
                    ii(t, T((" " + we(t) + " ").replace(" " + e + " ", " ")));
            }

            function ii(t, e) {
                t.className.baseVal === void 0 ?
                    (t.className = e) :
                    (t.className.baseVal = e);
            }

            function we(t) {
                return (
                    t.correspondingElement && (t = t.correspondingElement),
                    t.className.baseVal === void 0 ? t.className : t.className.baseVal
                );
            }

            function xt(t, e) {
                "opacity" in t.style ?
                    (t.style.opacity = e) :
                    "filter" in t.style && ts(t, e);
            }

            function ts(t, e) {
                var i = !1,
                    s = "DXImageTransform.Microsoft.Alpha";
                try {
                    i = t.filters.item(s);
                } catch {
                    if (e === 1) return;
                }
                (e = Math.round(e * 100)),
                i
                    ?
                    ((i.Enabled = e !== 100), (i.Opacity = e)) :
                    (t.style.filter += " progid:" + s + "(opacity=" + e + ")");
            }

            function Te(t) {
                for (var e = document.documentElement.style, i = 0; i < t.length; i++)
                    if (t[i] in e) return t[i];
                return !1;
            }

            function Wt(t, e, i) {
                var s = e || new I(0, 0);
                t.style[ti] =
                    (N.ie3d ?
                        "translate(" + s.x + "px," + s.y + "px)" :
                        "translate3d(" + s.x + "px," + s.y + "px,0)") +
                    (i ? " scale(" + i + ")" : "");
            }

            function rt(t, e) {
                (t._leaflet_pos = e),
                N.any3d ?
                    Wt(t, e) :
                    ((t.style.left = e.x + "px"), (t.style.top = e.y + "px"));
            }

            function jt(t) {
                return t._leaflet_pos || new I(0, 0);
            }
            var de, ue, ni;
            if ("onselectstart" in document)
                (de = function() {
                    G(window, "selectstart", ut);
                }),
                (ue = function() {
                    Q(window, "selectstart", ut);
                });
            else {
                var ce = Te([
                    "userSelect",
                    "WebkitUserSelect",
                    "OUserSelect",
                    "MozUserSelect",
                    "msUserSelect",
                ]);
                (de = function() {
                    if (ce) {
                        var t = document.documentElement.style;
                        (ni = t[ce]), (t[ce] = "none");
                    }
                }),
                (ue = function() {
                    ce && ((document.documentElement.style[ce] = ni), (ni = void 0));
                });
            }

            function ri() {
                G(window, "dragstart", ut);
            }

            function si() {
                Q(window, "dragstart", ut);
            }
            var Pe, oi;

            function ai(t) {
                for (; t.tabIndex === -1;) t = t.parentNode;
                t.style &&
                    (Se(),
                        (Pe = t),
                        (oi = t.style.outlineStyle),
                        (t.style.outlineStyle = "none"),
                        G(window, "keydown", Se));
            }

            function Se() {
                Pe &&
                    ((Pe.style.outlineStyle = oi),
                        (Pe = void 0),
                        (oi = void 0),
                        Q(window, "keydown", Se));
            }

            function _n(t) {
                do t = t.parentNode;
                while ((!t.offsetWidth || !t.offsetHeight) && t !== document.body);
                return t;
            }

            function li(t) {
                var e = t.getBoundingClientRect();
                return {
                    x: e.width / t.offsetWidth || 1,
                    y: e.height / t.offsetHeight || 1,
                    boundingClientRect: e,
                };
            }
            var es = {
                __proto__: null,
                TRANSFORM: ti,
                TRANSITION: ae,
                TRANSITION_END: pn,
                get: mn,
                getStyle: le,
                create: X,
                remove: et,
                empty: xe,
                toFront: $t,
                toBack: Kt,
                hasClass: ei,
                addClass: V,
                removeClass: it,
                setClass: ii,
                getClass: we,
                setOpacity: xt,
                testProp: Te,
                setTransform: Wt,
                setPosition: rt,
                getPosition: jt,
                get disableTextSelection() {
                    return de;
                },
                get enableTextSelection() {
                    return ue;
                },
                disableImageDrag: ri,
                enableImageDrag: si,
                preventOutline: ai,
                restoreOutline: Se,
                getSizedParentNode: _n,
                getScale: li,
            };

            function G(t, e, i, s) {
                if (e && typeof e == "object")
                    for (var l in e) ui(t, l, e[l], i);
                else {
                    e = w(e);
                    for (var c = 0, m = e.length; c < m; c++) ui(t, e[c], i, s);
                }
                return this;
            }
            var Et = "_leaflet_events";

            function Q(t, e, i, s) {
                if (arguments.length === 1) gn(t), delete t[Et];
                else if (e && typeof e == "object")
                    for (var l in e) ci(t, l, e[l], i);
                else if (((e = w(e)), arguments.length === 2))
                    gn(t, function(_) {
                        return z(e, _) !== -1;
                    });
                else
                    for (var c = 0, m = e.length; c < m; c++) ci(t, e[c], i, s);
                return this;
            }

            function gn(t, e) {
                for (var i in t[Et]) {
                    var s = i.split(/\d/)[0];
                    (!e || e(s)) && ci(t, s, null, null, i);
                }
            }
            var di = {
                mouseenter: "mouseover",
                mouseleave: "mouseout",
                wheel: !("onwheel" in window) && "mousewheel",
            };

            function ui(t, e, i, s) {
                var l = e + h(i) + (s ? "_" + h(s) : "");
                if (t[Et] && t[Et][l]) return this;
                var c = function(_) {
                        return i.call(s || t, _ || window.event);
                    },
                    m = c;
                !N.touchNative && N.pointer && e.indexOf("touch") === 0 ?
                    (c = Wr(t, e, c)) :
                    N.touch && e === "dblclick" ?
                    (c = Jr(t, c)) :
                    "addEventListener" in t ?
                    e === "touchstart" ||
                    e === "touchmove" ||
                    e === "wheel" ||
                    e === "mousewheel" ?
                    t.addEventListener(
                        di[e] || e,
                        c,
                        N.passiveEvents ? {
                            passive: !1
                        } : !1
                    ) :
                    e === "mouseenter" || e === "mouseleave" ?
                    ((c = function(_) {
                            (_ = _ || window.event), fi(t, _) && m(_);
                        }),
                        t.addEventListener(di[e], c, !1)) :
                    t.addEventListener(e, m, !1) :
                    t.attachEvent("on" + e, c),
                    (t[Et] = t[Et] || {}),
                    (t[Et][l] = c);
            }

            function ci(t, e, i, s, l) {
                l = l || e + h(i) + (s ? "_" + h(s) : "");
                var c = t[Et] && t[Et][l];
                if (!c) return this;
                !N.touchNative && N.pointer && e.indexOf("touch") === 0 ?
                    jr(t, e, c) :
                    N.touch && e === "dblclick" ?
                    Qr(t, c) :
                    "removeEventListener" in t ?
                    t.removeEventListener(di[e] || e, c, !1) :
                    t.detachEvent("on" + e, c),
                    (t[Et][l] = null);
            }

            function qt(t) {
                return (
                    t.stopPropagation ?
                    t.stopPropagation() :
                    t.originalEvent ?
                    (t.originalEvent._stopped = !0) :
                    (t.cancelBubble = !0),
                    this
                );
            }

            function hi(t) {
                return ui(t, "wheel", qt), this;
            }

            function he(t) {
                return (
                    G(t, "mousedown touchstart dblclick contextmenu", qt),
                    (t._leaflet_disable_click = !0),
                    this
                );
            }

            function ut(t) {
                return t.preventDefault ? t.preventDefault() : (t.returnValue = !1), this;
            }

            function Ut(t) {
                return ut(t), qt(t), this;
            }

            function vn(t) {
                if (t.composedPath) return t.composedPath();
                for (var e = [], i = t.target; i;) e.push(i), (i = i.parentNode);
                return e;
            }

            function yn(t, e) {
                if (!e) return new I(t.clientX, t.clientY);
                var i = li(e),
                    s = i.boundingClientRect;
                return new I(
                    (t.clientX - s.left) / i.x - e.clientLeft,
                    (t.clientY - s.top) / i.y - e.clientTop
                );
            }
            var is =
                N.linux && N.chrome ?
                window.devicePixelRatio :
                N.mac ?
                window.devicePixelRatio * 3 :
                window.devicePixelRatio > 0 ?
                2 * window.devicePixelRatio :
                1;

            function bn(t) {
                return N.edge ?
                    t.wheelDeltaY / 2 :
                    t.deltaY && t.deltaMode === 0 ?
                    -t.deltaY / is :
                    t.deltaY && t.deltaMode === 1 ?
                    -t.deltaY * 20 :
                    t.deltaY && t.deltaMode === 2 ?
                    -t.deltaY * 60 :
                    t.deltaX || t.deltaZ ?
                    0 :
                    t.wheelDelta ?
                    (t.wheelDeltaY || t.wheelDelta) / 2 :
                    t.detail && Math.abs(t.detail) < 32765 ?
                    -t.detail * 20 :
                    t.detail ?
                    (t.detail / -32765) * 60 :
                    0;
            }

            function fi(t, e) {
                var i = e.relatedTarget;
                if (!i) return !0;
                try {
                    for (; i && i !== t;) i = i.parentNode;
                } catch {
                    return !1;
                }
                return i !== t;
            }
            var ns = {
                    __proto__: null,
                    on: G,
                    off: Q,
                    stopPropagation: qt,
                    disableScrollPropagation: hi,
                    disableClickPropagation: he,
                    preventDefault: ut,
                    stop: Ut,
                    getPropagationPath: vn,
                    getMousePosition: yn,
                    getWheelDelta: bn,
                    isExternalTarget: fi,
                    addListener: G,
                    removeListener: Q,
                },
                xn = kt.extend({
                    run: function(t, e, i, s) {
                        this.stop(),
                            (this._el = t),
                            (this._inProgress = !0),
                            (this._duration = i || 0.25),
                            (this._easeOutPower = 1 / Math.max(s || 0.5, 0.2)),
                            (this._startPos = jt(t)),
                            (this._offset = e.subtract(this._startPos)),
                            (this._startTime = +new Date()),
                            this.fire("start"),
                            this._animate();
                    },
                    stop: function() {
                        this._inProgress && (this._step(!0), this._complete());
                    },
                    _animate: function() {
                        (this._animId = D(this._animate, this)), this._step();
                    },
                    _step: function(t) {
                        var e = +new Date() - this._startTime,
                            i = this._duration * 1e3;
                        e < i ?
                            this._runFrame(this._easeOut(e / i), t) :
                            (this._runFrame(1), this._complete());
                    },
                    _runFrame: function(t, e) {
                        var i = this._startPos.add(this._offset.multiplyBy(t));
                        e && i._round(), rt(this._el, i), this.fire("step");
                    },
                    _complete: function() {
                        R(this._animId), (this._inProgress = !1), this.fire("end");
                    },
                    _easeOut: function(t) {
                        return 1 - Math.pow(1 - t, this._easeOutPower);
                    },
                }),
                Y = kt.extend({
                    options: {
                        crs: Ue,
                        center: void 0,
                        zoom: void 0,
                        minZoom: void 0,
                        maxZoom: void 0,
                        layers: [],
                        maxBounds: void 0,
                        renderer: void 0,
                        zoomAnimation: !0,
                        zoomAnimationThreshold: 4,
                        fadeAnimation: !0,
                        markerZoomAnimation: !0,
                        transform3DLimit: 8388608,
                        zoomSnap: 1,
                        zoomDelta: 1,
                        trackResize: !0,
                    },
                    initialize: function(t, e) {
                        (e = b(this, e)),
                        (this._handlers = []),
                        (this._layers = {}),
                        (this._zoomBoundLayers = {}),
                        (this._sizeChanged = !0),
                        this._initContainer(t),
                            this._initLayout(),
                            (this._onResize = f(this._onResize, this)),
                            this._initEvents(),
                            e.maxBounds && this.setMaxBounds(e.maxBounds),
                            e.zoom !== void 0 && (this._zoom = this._limitZoom(e.zoom)),
                            e.center &&
                            e.zoom !== void 0 &&
                            this.setView(U(e.center), e.zoom, {
                                reset: !0
                            }),
                            this.callInitHooks(),
                            (this._zoomAnimated =
                                ae && N.any3d && !N.mobileOpera && this.options.zoomAnimation),
                            this._zoomAnimated &&
                            (this._createAnimProxy(),
                                G(this._proxy, pn, this._catchTransitionEnd, this)),
                            this._addLayers(this.options.layers);
                    },
                    setView: function(t, e, i) {
                        if (
                            ((e = e === void 0 ? this._zoom : this._limitZoom(e)),
                                (t = this._limitCenter(U(t), e, this.options.maxBounds)),
                                (i = i || {}),
                                this._stop(),
                                this._loaded && !i.reset && i !== !0)
                        ) {
                            i.animate !== void 0 &&
                                ((i.zoom = d({
                                        animate: i.animate
                                    }, i.zoom)),
                                    (i.pan = d({
                                        animate: i.animate,
                                        duration: i.duration
                                    }, i.pan)));
                            var s =
                                this._zoom !== e ?
                                this._tryAnimatedZoom && this._tryAnimatedZoom(t, e, i.zoom) :
                                this._tryAnimatedPan(t, i.pan);
                            if (s) return clearTimeout(this._sizeTimer), this;
                        }
                        return this._resetView(t, e, i.pan && i.pan.noMoveStart), this;
                    },
                    setZoom: function(t, e) {
                        return this._loaded ?
                            this.setView(this.getCenter(), t, {
                                zoom: e
                            }) :
                            ((this._zoom = t), this);
                    },
                    zoomIn: function(t, e) {
                        return (
                            (t = t || (N.any3d ? this.options.zoomDelta : 1)),
                            this.setZoom(this._zoom + t, e)
                        );
                    },
                    zoomOut: function(t, e) {
                        return (
                            (t = t || (N.any3d ? this.options.zoomDelta : 1)),
                            this.setZoom(this._zoom - t, e)
                        );
                    },
                    setZoomAround: function(t, e, i) {
                        var s = this.getZoomScale(e),
                            l = this.getSize().divideBy(2),
                            c = t instanceof I ? t : this.latLngToContainerPoint(t),
                            m = c.subtract(l).multiplyBy(1 - 1 / s),
                            _ = this.containerPointToLatLng(l.add(m));
                        return this.setView(_, e, {
                            zoom: i
                        });
                    },
                    _getBoundsCenterZoom: function(t, e) {
                        (e = e || {}), (t = t.getBounds ? t.getBounds() : nt(t));
                        var i = Z(e.paddingTopLeft || e.padding || [0, 0]),
                            s = Z(e.paddingBottomRight || e.padding || [0, 0]),
                            l = this.getBoundsZoom(t, !1, i.add(s));
                        if (
                            ((l = typeof e.maxZoom == "number" ? Math.min(e.maxZoom, l) : l),
                                l === 1 / 0)
                        )
                            return {
                                center: t.getCenter(),
                                zoom: l
                            };
                        var c = s.subtract(i).divideBy(2),
                            m = this.project(t.getSouthWest(), l),
                            _ = this.project(t.getNorthEast(), l),
                            x = this.unproject(m.add(_).divideBy(2).add(c), l);
                        return {
                            center: x,
                            zoom: l
                        };
                    },
                    fitBounds: function(t, e) {
                        if (((t = nt(t)), !t.isValid()))
                            throw new Error("Bounds are not valid.");
                        var i = this._getBoundsCenterZoom(t, e);
                        return this.setView(i.center, i.zoom, e);
                    },
                    fitWorld: function(t) {
                        return this.fitBounds(
                            [
                                [-90, -180],
                                [90, 180],
                            ],
                            t
                        );
                    },
                    panTo: function(t, e) {
                        return this.setView(t, this._zoom, {
                            pan: e
                        });
                    },
                    panBy: function(t, e) {
                        if (((t = Z(t).round()), (e = e || {}), !t.x && !t.y))
                            return this.fire("moveend");
                        if (e.animate !== !0 && !this.getSize().contains(t))
                            return (
                                this._resetView(
                                    this.unproject(this.project(this.getCenter()).add(t)),
                                    this.getZoom()
                                ),
                                this
                            );
                        if (
                            (this._panAnim ||
                                ((this._panAnim = new xn()),
                                    this._panAnim.on({
                                            step: this._onPanTransitionStep,
                                            end: this._onPanTransitionEnd,
                                        },
                                        this
                                    )),
                                e.noMoveStart || this.fire("movestart"),
                                e.animate !== !1)
                        ) {
                            V(this._mapPane, "leaflet-pan-anim");
                            var i = this._getMapPanePos().subtract(t).round();
                            this._panAnim.run(
                                this._mapPane,
                                i,
                                e.duration || 0.25,
                                e.easeLinearity
                            );
                        } else this._rawPanBy(t), this.fire("move").fire("moveend");
                        return this;
                    },
                    flyTo: function(t, e, i) {
                        if (((i = i || {}), i.animate === !1 || !N.any3d))
                            return this.setView(t, e, i);
                        this._stop();
                        var s = this.project(this.getCenter()),
                            l = this.project(t),
                            c = this.getSize(),
                            m = this._zoom;
                        (t = U(t)), (e = e === void 0 ? m : e);
                        var _ = Math.max(c.x, c.y),
                            x = _ * this.getZoomScale(m, e),
                            S = l.distanceTo(s) || 1,
                            k = 1.42,
                            F = k * k;

                        function W(st) {
                            var De = st ? -1 : 1,
                                js = st ? x : _,
                                qs = x * x - _ * _ + De * F * F * S * S,
                                Us = 2 * js * F * S,
                                Pi = qs / Us,
                                er = Math.sqrt(Pi * Pi + 1) - Pi,
                                Ys = er < 1e-9 ? -18 : Math.log(er);
                            return Ys;
                        }

                        function ht(st) {
                            return (Math.exp(st) - Math.exp(-st)) / 2;
                        }

                        function lt(st) {
                            return (Math.exp(st) + Math.exp(-st)) / 2;
                        }

                        function Tt(st) {
                            return ht(st) / lt(st);
                        }
                        var mt = W(0);

                        function ne(st) {
                            return _ * (lt(mt) / lt(mt + k * st));
                        }

                        function Hs(st) {
                            return (_ * (lt(mt) * Tt(mt + k * st) - ht(mt))) / F;
                        }

                        function Gs(st) {
                            return 1 - Math.pow(1 - st, 1.5);
                        }
                        var Vs = Date.now(),
                            Qn = (W(1) - mt) / k,
                            Ws = i.duration ? 1e3 * i.duration : 1e3 * Qn * 0.8;

                        function tr() {
                            var st = (Date.now() - Vs) / Ws,
                                De = Gs(st) * Qn;
                            st <= 1 ?
                                ((this._flyToFrame = D(tr, this)),
                                    this._move(
                                        this.unproject(
                                            s.add(l.subtract(s).multiplyBy(Hs(De) / S)),
                                            m
                                        ),
                                        this.getScaleZoom(_ / ne(De), m), {
                                            flyTo: !0
                                        }
                                    )) :
                                this._move(t, e)._moveEnd(!0);
                        }
                        return this._moveStart(!0, i.noMoveStart), tr.call(this), this;
                    },
                    flyToBounds: function(t, e) {
                        var i = this._getBoundsCenterZoom(t, e);
                        return this.flyTo(i.center, i.zoom, e);
                    },
                    setMaxBounds: function(t) {
                        return (
                            (t = nt(t)),
                            this.listens("moveend", this._panInsideMaxBounds) &&
                            this.off("moveend", this._panInsideMaxBounds),
                            t.isValid() ?
                            ((this.options.maxBounds = t),
                                this._loaded && this._panInsideMaxBounds(),
                                this.on("moveend", this._panInsideMaxBounds)) :
                            ((this.options.maxBounds = null), this)
                        );
                    },
                    setMinZoom: function(t) {
                        var e = this.options.minZoom;
                        return (
                            (this.options.minZoom = t),
                            this._loaded &&
                            e !== t &&
                            (this.fire("zoomlevelschange"),
                                this.getZoom() < this.options.minZoom) ?
                            this.setZoom(t) :
                            this
                        );
                    },
                    setMaxZoom: function(t) {
                        var e = this.options.maxZoom;
                        return (
                            (this.options.maxZoom = t),
                            this._loaded &&
                            e !== t &&
                            (this.fire("zoomlevelschange"),
                                this.getZoom() > this.options.maxZoom) ?
                            this.setZoom(t) :
                            this
                        );
                    },
                    panInsideBounds: function(t, e) {
                        this._enforcingBounds = !0;
                        var i = this.getCenter(),
                            s = this._limitCenter(i, this._zoom, nt(t));
                        return (
                            i.equals(s) || this.panTo(s, e), (this._enforcingBounds = !1), this
                        );
                    },
                    panInside: function(t, e) {
                        e = e || {};
                        var i = Z(e.paddingTopLeft || e.padding || [0, 0]),
                            s = Z(e.paddingBottomRight || e.padding || [0, 0]),
                            l = this.project(this.getCenter()),
                            c = this.project(t),
                            m = this.getPixelBounds(),
                            _ = ot([m.min.add(i), m.max.subtract(s)]),
                            x = _.getSize();
                        if (!_.contains(c)) {
                            this._enforcingBounds = !0;
                            var S = c.subtract(_.getCenter()),
                                k = _.extend(c).getSize().subtract(x);
                            (l.x += S.x < 0 ? -k.x : k.x),
                            (l.y += S.y < 0 ? -k.y : k.y),
                            this.panTo(this.unproject(l), e),
                                (this._enforcingBounds = !1);
                        }
                        return this;
                    },
                    invalidateSize: function(t) {
                        if (!this._loaded) return this;
                        t = d({
                            animate: !1,
                            pan: !0
                        }, t === !0 ? {
                            animate: !0
                        } : t);
                        var e = this.getSize();
                        (this._sizeChanged = !0), (this._lastCenter = null);
                        var i = this.getSize(),
                            s = e.divideBy(2).round(),
                            l = i.divideBy(2).round(),
                            c = s.subtract(l);
                        return !c.x && !c.y ?
                            this :
                            (t.animate && t.pan ?
                                this.panBy(c) :
                                (t.pan && this._rawPanBy(c),
                                    this.fire("move"),
                                    t.debounceMoveend ?
                                    (clearTimeout(this._sizeTimer),
                                        (this._sizeTimer = setTimeout(
                                            f(this.fire, this, "moveend"),
                                            200
                                        ))) :
                                    this.fire("moveend")),
                                this.fire("resize", {
                                    oldSize: e,
                                    newSize: i
                                }));
                    },
                    stop: function() {
                        return (
                            this.setZoom(this._limitZoom(this._zoom)),
                            this.options.zoomSnap || this.fire("viewreset"),
                            this._stop()
                        );
                    },
                    locate: function(t) {
                        if (
                            ((t = this._locateOptions = d({
                                    timeout: 1e4,
                                    watch: !1
                                }, t)),
                                !("geolocation" in navigator))
                        )
                            return (
                                this._handleGeolocationError({
                                    code: 0,
                                    message: "Geolocation not supported.",
                                }),
                                this
                            );
                        var e = f(this._handleGeolocationResponse, this),
                            i = f(this._handleGeolocationError, this);
                        return (
                            t.watch ?
                            (this._locationWatchId = navigator.geolocation.watchPosition(
                                e,
                                i,
                                t
                            )) :
                            navigator.geolocation.getCurrentPosition(e, i, t),
                            this
                        );
                    },
                    stopLocate: function() {
                        return (
                            navigator.geolocation &&
                            navigator.geolocation.clearWatch &&
                            navigator.geolocation.clearWatch(this._locationWatchId),
                            this._locateOptions && (this._locateOptions.setView = !1),
                            this
                        );
                    },
                    _handleGeolocationError: function(t) {
                        if (this._container._leaflet_id) {
                            var e = t.code,
                                i =
                                t.message ||
                                (e === 1 ?
                                    "permission denied" :
                                    e === 2 ?
                                    "position unavailable" :
                                    "timeout");
                            this._locateOptions.setView && !this._loaded && this.fitWorld(),
                                this.fire("locationerror", {
                                    code: e,
                                    message: "Geolocation error: " + i + ".",
                                });
                        }
                    },
                    _handleGeolocationResponse: function(t) {
                        if (this._container._leaflet_id) {
                            var e = t.coords.latitude,
                                i = t.coords.longitude,
                                s = new J(e, i),
                                l = s.toBounds(t.coords.accuracy * 2),
                                c = this._locateOptions;
                            if (c.setView) {
                                var m = this.getBoundsZoom(l);
                                this.setView(s, c.maxZoom ? Math.min(m, c.maxZoom) : m);
                            }
                            var _ = {
                                latlng: s,
                                bounds: l,
                                timestamp: t.timestamp
                            };
                            for (var x in t.coords)
                                typeof t.coords[x] == "number" && (_[x] = t.coords[x]);
                            this.fire("locationfound", _);
                        }
                    },
                    addHandler: function(t, e) {
                        if (!e) return this;
                        var i = (this[t] = new e(this));
                        return this._handlers.push(i), this.options[t] && i.enable(), this;
                    },
                    remove: function() {
                        if (
                            (this._initEvents(!0),
                                this.options.maxBounds &&
                                this.off("moveend", this._panInsideMaxBounds),
                                this._containerId !== this._container._leaflet_id)
                        )
                            throw new Error(
                                "Map container is being reused by another instance"
                            );
                        try {
                            delete this._container._leaflet_id, delete this._containerId;
                        } catch {
                            (this._container._leaflet_id = void 0),
                            (this._containerId = void 0);
                        }
                        this._locationWatchId !== void 0 && this.stopLocate(),
                            this._stop(),
                            et(this._mapPane),
                            this._clearControlPos && this._clearControlPos(),
                            this._resizeRequest &&
                            (R(this._resizeRequest), (this._resizeRequest = null)),
                            this._clearHandlers(),
                            this._loaded && this.fire("unload");
                        var t;
                        for (t in this._layers) this._layers[t].remove();
                        for (t in this._panes) et(this._panes[t]);
                        return (
                            (this._layers = []),
                            (this._panes = []),
                            delete this._mapPane,
                            delete this._renderer,
                            this
                        );
                    },
                    createPane: function(t, e) {
                        var i =
                            "leaflet-pane" +
                            (t ? " leaflet-" + t.replace("Pane", "") + "-pane" : ""),
                            s = X("div", i, e || this._mapPane);
                        return t && (this._panes[t] = s), s;
                    },
                    getCenter: function() {
                        return (
                            this._checkIfLoaded(),
                            this._lastCenter && !this._moved() ?
                            this._lastCenter.clone() :
                            this.layerPointToLatLng(this._getCenterLayerPoint())
                        );
                    },
                    getZoom: function() {
                        return this._zoom;
                    },
                    getBounds: function() {
                        var t = this.getPixelBounds(),
                            e = this.unproject(t.getBottomLeft()),
                            i = this.unproject(t.getTopRight());
                        return new pt(e, i);
                    },
                    getMinZoom: function() {
                        return this.options.minZoom === void 0 ?
                            this._layersMinZoom || 0 :
                            this.options.minZoom;
                    },
                    getMaxZoom: function() {
                        return this.options.maxZoom === void 0 ?
                            this._layersMaxZoom === void 0 ?
                            1 / 0 :
                            this._layersMaxZoom :
                            this.options.maxZoom;
                    },
                    getBoundsZoom: function(t, e, i) {
                        (t = nt(t)), (i = Z(i || [0, 0]));
                        var s = this.getZoom() || 0,
                            l = this.getMinZoom(),
                            c = this.getMaxZoom(),
                            m = t.getNorthWest(),
                            _ = t.getSouthEast(),
                            x = this.getSize().subtract(i),
                            S = ot(this.project(_, s), this.project(m, s)).getSize(),
                            k = N.any3d ? this.options.zoomSnap : 1,
                            F = x.x / S.x,
                            W = x.y / S.y,
                            ht = e ? Math.max(F, W) : Math.min(F, W);
                        return (
                            (s = this.getScaleZoom(ht, s)),
                            k &&
                            ((s = Math.round(s / (k / 100)) * (k / 100)),
                                (s = e ? Math.ceil(s / k) * k : Math.floor(s / k) * k)),
                            Math.max(l, Math.min(c, s))
                        );
                    },
                    getSize: function() {
                        return (
                            (!this._size || this._sizeChanged) &&
                            ((this._size = new I(
                                    this._container.clientWidth || 0,
                                    this._container.clientHeight || 0
                                )),
                                (this._sizeChanged = !1)),
                            this._size.clone()
                        );
                    },
                    getPixelBounds: function(t, e) {
                        var i = this._getTopLeftPoint(t, e);
                        return new $(i, i.add(this.getSize()));
                    },
                    getPixelOrigin: function() {
                        return this._checkIfLoaded(), this._pixelOrigin;
                    },
                    getPixelWorldBounds: function(t) {
                        return this.options.crs.getProjectedBounds(
                            t === void 0 ? this.getZoom() : t
                        );
                    },
                    getPane: function(t) {
                        return typeof t == "string" ? this._panes[t] : t;
                    },
                    getPanes: function() {
                        return this._panes;
                    },
                    getContainer: function() {
                        return this._container;
                    },
                    getZoomScale: function(t, e) {
                        var i = this.options.crs;
                        return (e = e === void 0 ? this._zoom : e), i.scale(t) / i.scale(e);
                    },
                    getScaleZoom: function(t, e) {
                        var i = this.options.crs;
                        e = e === void 0 ? this._zoom : e;
                        var s = i.zoom(t * i.scale(e));
                        return isNaN(s) ? 1 / 0 : s;
                    },
                    project: function(t, e) {
                        return (
                            (e = e === void 0 ? this._zoom : e),
                            this.options.crs.latLngToPoint(U(t), e)
                        );
                    },
                    unproject: function(t, e) {
                        return (
                            (e = e === void 0 ? this._zoom : e),
                            this.options.crs.pointToLatLng(Z(t), e)
                        );
                    },
                    layerPointToLatLng: function(t) {
                        var e = Z(t).add(this.getPixelOrigin());
                        return this.unproject(e);
                    },
                    latLngToLayerPoint: function(t) {
                        var e = this.project(U(t))._round();
                        return e._subtract(this.getPixelOrigin());
                    },
                    wrapLatLng: function(t) {
                        return this.options.crs.wrapLatLng(U(t));
                    },
                    wrapLatLngBounds: function(t) {
                        return this.options.crs.wrapLatLngBounds(nt(t));
                    },
                    distance: function(t, e) {
                        return this.options.crs.distance(U(t), U(e));
                    },
                    containerPointToLayerPoint: function(t) {
                        return Z(t).subtract(this._getMapPanePos());
                    },
                    layerPointToContainerPoint: function(t) {
                        return Z(t).add(this._getMapPanePos());
                    },
                    containerPointToLatLng: function(t) {
                        var e = this.containerPointToLayerPoint(Z(t));
                        return this.layerPointToLatLng(e);
                    },
                    latLngToContainerPoint: function(t) {
                        return this.layerPointToContainerPoint(this.latLngToLayerPoint(U(t)));
                    },
                    mouseEventToContainerPoint: function(t) {
                        return yn(t, this._container);
                    },
                    mouseEventToLayerPoint: function(t) {
                        return this.containerPointToLayerPoint(
                            this.mouseEventToContainerPoint(t)
                        );
                    },
                    mouseEventToLatLng: function(t) {
                        return this.layerPointToLatLng(this.mouseEventToLayerPoint(t));
                    },
                    _initContainer: function(t) {
                        var e = (this._container = mn(t));
                        if (e) {
                            if (e._leaflet_id)
                                throw new Error("Map container is already initialized.");
                        } else throw new Error("Map container not found.");
                        G(e, "scroll", this._onScroll, this), (this._containerId = h(e));
                    },
                    _initLayout: function() {
                        var t = this._container;
                        (this._fadeAnimated = this.options.fadeAnimation && N.any3d),
                        V(
                            t,
                            "leaflet-container" +
                            (N.touch ? " leaflet-touch" : "") +
                            (N.retina ? " leaflet-retina" : "") +
                            (N.ielt9 ? " leaflet-oldie" : "") +
                            (N.safari ? " leaflet-safari" : "") +
                            (this._fadeAnimated ? " leaflet-fade-anim" : "")
                        );
                        var e = le(t, "position");
                        e !== "absolute" &&
                            e !== "relative" &&
                            e !== "fixed" &&
                            e !== "sticky" &&
                            (t.style.position = "relative"),
                            this._initPanes(),
                            this._initControlPos && this._initControlPos();
                    },
                    _initPanes: function() {
                        var t = (this._panes = {});
                        (this._paneRenderers = {}),
                        (this._mapPane = this.createPane("mapPane", this._container)),
                        rt(this._mapPane, new I(0, 0)),
                            this.createPane("tilePane"),
                            this.createPane("overlayPane"),
                            this.createPane("shadowPane"),
                            this.createPane("markerPane"),
                            this.createPane("tooltipPane"),
                            this.createPane("popupPane"),
                            this.options.markerZoomAnimation ||
                            (V(t.markerPane, "leaflet-zoom-hide"),
                                V(t.shadowPane, "leaflet-zoom-hide"));
                    },
                    _resetView: function(t, e, i) {
                        rt(this._mapPane, new I(0, 0));
                        var s = !this._loaded;
                        (this._loaded = !0),
                        (e = this._limitZoom(e)),
                        this.fire("viewprereset");
                        var l = this._zoom !== e;
                        this._moveStart(l, i)._move(t, e)._moveEnd(l),
                            this.fire("viewreset"),
                            s && this.fire("load");
                    },
                    _moveStart: function(t, e) {
                        return t && this.fire("zoomstart"), e || this.fire("movestart"), this;
                    },
                    _move: function(t, e, i, s) {
                        e === void 0 && (e = this._zoom);
                        var l = this._zoom !== e;
                        return (
                            (this._zoom = e),
                            (this._lastCenter = t),
                            (this._pixelOrigin = this._getNewPixelOrigin(t)),
                            s ?
                            i && i.pinch && this.fire("zoom", i) :
                            ((l || (i && i.pinch)) && this.fire("zoom", i),
                                this.fire("move", i)),
                            this
                        );
                    },
                    _moveEnd: function(t) {
                        return t && this.fire("zoomend"), this.fire("moveend");
                    },
                    _stop: function() {
                        return (
                            R(this._flyToFrame), this._panAnim && this._panAnim.stop(), this
                        );
                    },
                    _rawPanBy: function(t) {
                        rt(this._mapPane, this._getMapPanePos().subtract(t));
                    },
                    _getZoomSpan: function() {
                        return this.getMaxZoom() - this.getMinZoom();
                    },
                    _panInsideMaxBounds: function() {
                        this._enforcingBounds || this.panInsideBounds(this.options.maxBounds);
                    },
                    _checkIfLoaded: function() {
                        if (!this._loaded) throw new Error("Set map center and zoom first.");
                    },
                    _initEvents: function(t) {
                        (this._targets = {}), (this._targets[h(this._container)] = this);
                        var e = t ? Q : G;
                        e(
                                this._container,
                                "click dblclick mousedown mouseup mouseover mouseout mousemove contextmenu keypress keydown keyup",
                                this._handleDOMEvent,
                                this
                            ),
                            this.options.trackResize &&
                            e(window, "resize", this._onResize, this),
                            N.any3d &&
                            this.options.transform3DLimit &&
                            (t ? this.off : this.on).call(this, "moveend", this._onMoveEnd);
                    },
                    _onResize: function() {
                        R(this._resizeRequest),
                            (this._resizeRequest = D(function() {
                                this.invalidateSize({
                                    debounceMoveend: !0
                                });
                            }, this));
                    },
                    _onScroll: function() {
                        (this._container.scrollTop = 0), (this._container.scrollLeft = 0);
                    },
                    _onMoveEnd: function() {
                        var t = this._getMapPanePos();
                        Math.max(Math.abs(t.x), Math.abs(t.y)) >=
                            this.options.transform3DLimit &&
                            this._resetView(this.getCenter(), this.getZoom());
                    },
                    _findEventTargets: function(t, e) {
                        for (
                            var i = [],
                                s,
                                l = e === "mouseout" || e === "mouseover",
                                c = t.target || t.srcElement,
                                m = !1; c;

                        ) {
                            if (
                                ((s = this._targets[h(c)]),
                                    s &&
                                    (e === "click" || e === "preclick") &&
                                    this._draggableMoved(s))
                            ) {
                                m = !0;
                                break;
                            }
                            if (
                                (s && s.listens(e, !0) && ((l && !fi(c, t)) || (i.push(s), l))) ||
                                c === this._container
                            )
                                break;
                            c = c.parentNode;
                        }
                        return (
                            !i.length && !m && !l && this.listens(e, !0) && (i = [this]), i
                        );
                    },
                    _isClickDisabled: function(t) {
                        for (; t && t !== this._container;) {
                            if (t._leaflet_disable_click) return !0;
                            t = t.parentNode;
                        }
                    },
                    _handleDOMEvent: function(t) {
                        var e = t.target || t.srcElement;
                        if (
                            !(
                                !this._loaded ||
                                e._leaflet_disable_events ||
                                (t.type === "click" && this._isClickDisabled(e))
                            )
                        ) {
                            var i = t.type;
                            i === "mousedown" && ai(e), this._fireDOMEvent(t, i);
                        }
                    },
                    _mouseEvents: [
                        "click",
                        "dblclick",
                        "mouseover",
                        "mouseout",
                        "contextmenu",
                    ],
                    _fireDOMEvent: function(t, e, i) {
                        if (t.type === "click") {
                            var s = d({}, t);
                            (s.type = "preclick"), this._fireDOMEvent(s, s.type, i);
                        }
                        var l = this._findEventTargets(t, e);
                        if (i) {
                            for (var c = [], m = 0; m < i.length; m++)
                                i[m].listens(e, !0) && c.push(i[m]);
                            l = c.concat(l);
                        }
                        if (l.length) {
                            e === "contextmenu" && ut(t);
                            var _ = l[0],
                                x = {
                                    originalEvent: t
                                };
                            if (
                                t.type !== "keypress" &&
                                t.type !== "keydown" &&
                                t.type !== "keyup"
                            ) {
                                var S = _.getLatLng && (!_._radius || _._radius <= 10);
                                (x.containerPoint = S ?
                                    this.latLngToContainerPoint(_.getLatLng()) :
                                    this.mouseEventToContainerPoint(t)),
                                (x.layerPoint = this.containerPointToLayerPoint(
                                    x.containerPoint
                                )),
                                (x.latlng = S ?
                                    _.getLatLng() :
                                    this.layerPointToLatLng(x.layerPoint));
                            }
                            for (m = 0; m < l.length; m++)
                                if (
                                    (l[m].fire(e, x, !0),
                                        x.originalEvent._stopped ||
                                        (l[m].options.bubblingMouseEvents === !1 &&
                                            z(this._mouseEvents, e) !== -1))
                                )
                                    return;
                        }
                    },
                    _draggableMoved: function(t) {
                        return (
                            (t = t.dragging && t.dragging.enabled() ? t : this),
                            (t.dragging && t.dragging.moved()) ||
                            (this.boxZoom && this.boxZoom.moved())
                        );
                    },
                    _clearHandlers: function() {
                        for (var t = 0, e = this._handlers.length; t < e; t++)
                            this._handlers[t].disable();
                    },
                    whenReady: function(t, e) {
                        return (
                            this._loaded ?
                            t.call(e || this, {
                                target: this
                            }) :
                            this.on("load", t, e),
                            this
                        );
                    },
                    _getMapPanePos: function() {
                        return jt(this._mapPane) || new I(0, 0);
                    },
                    _moved: function() {
                        var t = this._getMapPanePos();
                        return t && !t.equals([0, 0]);
                    },
                    _getTopLeftPoint: function(t, e) {
                        var i =
                            t && e !== void 0 ?
                            this._getNewPixelOrigin(t, e) :
                            this.getPixelOrigin();
                        return i.subtract(this._getMapPanePos());
                    },
                    _getNewPixelOrigin: function(t, e) {
                        var i = this.getSize()._divideBy(2);
                        return this.project(t, e)
                            ._subtract(i)
                            ._add(this._getMapPanePos())
                            ._round();
                    },
                    _latLngToNewLayerPoint: function(t, e, i) {
                        var s = this._getNewPixelOrigin(i, e);
                        return this.project(t, e)._subtract(s);
                    },
                    _latLngBoundsToNewLayerBounds: function(t, e, i) {
                        var s = this._getNewPixelOrigin(i, e);
                        return ot([
                            this.project(t.getSouthWest(), e)._subtract(s),
                            this.project(t.getNorthWest(), e)._subtract(s),
                            this.project(t.getSouthEast(), e)._subtract(s),
                            this.project(t.getNorthEast(), e)._subtract(s),
                        ]);
                    },
                    _getCenterLayerPoint: function() {
                        return this.containerPointToLayerPoint(this.getSize()._divideBy(2));
                    },
                    _getCenterOffset: function(t) {
                        return this.latLngToLayerPoint(t).subtract(
                            this._getCenterLayerPoint()
                        );
                    },
                    _limitCenter: function(t, e, i) {
                        if (!i) return t;
                        var s = this.project(t, e),
                            l = this.getSize().divideBy(2),
                            c = new $(s.subtract(l), s.add(l)),
                            m = this._getBoundsOffset(c, i, e);
                        return Math.abs(m.x) <= 1 && Math.abs(m.y) <= 1 ?
                            t :
                            this.unproject(s.add(m), e);
                    },
                    _limitOffset: function(t, e) {
                        if (!e) return t;
                        var i = this.getPixelBounds(),
                            s = new $(i.min.add(t), i.max.add(t));
                        return t.add(this._getBoundsOffset(s, e));
                    },
                    _getBoundsOffset: function(t, e, i) {
                        var s = ot(
                                this.project(e.getNorthEast(), i),
                                this.project(e.getSouthWest(), i)
                            ),
                            l = s.min.subtract(t.min),
                            c = s.max.subtract(t.max),
                            m = this._rebound(l.x, -c.x),
                            _ = this._rebound(l.y, -c.y);
                        return new I(m, _);
                    },
                    _rebound: function(t, e) {
                        return t + e > 0 ?
                            Math.round(t - e) / 2 :
                            Math.max(0, Math.ceil(t)) - Math.max(0, Math.floor(e));
                    },
                    _limitZoom: function(t) {
                        var e = this.getMinZoom(),
                            i = this.getMaxZoom(),
                            s = N.any3d ? this.options.zoomSnap : 1;
                        return s && (t = Math.round(t / s) * s), Math.max(e, Math.min(i, t));
                    },
                    _onPanTransitionStep: function() {
                        this.fire("move");
                    },
                    _onPanTransitionEnd: function() {
                        it(this._mapPane, "leaflet-pan-anim"), this.fire("moveend");
                    },
                    _tryAnimatedPan: function(t, e) {
                        var i = this._getCenterOffset(t)._trunc();
                        return (e && e.animate) !== !0 && !this.getSize().contains(i) ?
                            !1 :
                            (this.panBy(i, e), !0);
                    },
                    _createAnimProxy: function() {
                        var t = (this._proxy = X(
                            "div",
                            "leaflet-proxy leaflet-zoom-animated"
                        ));
                        this._panes.mapPane.appendChild(t),
                            this.on(
                                "zoomanim",
                                function(e) {
                                    var i = ti,
                                        s = this._proxy.style[i];
                                    Wt(
                                            this._proxy,
                                            this.project(e.center, e.zoom),
                                            this.getZoomScale(e.zoom, 1)
                                        ),
                                        s === this._proxy.style[i] &&
                                        this._animatingZoom &&
                                        this._onZoomTransitionEnd();
                                },
                                this
                            ),
                            this.on("load moveend", this._animMoveEnd, this),
                            this._on("unload", this._destroyAnimProxy, this);
                    },
                    _destroyAnimProxy: function() {
                        et(this._proxy),
                            this.off("load moveend", this._animMoveEnd, this),
                            delete this._proxy;
                    },
                    _animMoveEnd: function() {
                        var t = this.getCenter(),
                            e = this.getZoom();
                        Wt(this._proxy, this.project(t, e), this.getZoomScale(e, 1));
                    },
                    _catchTransitionEnd: function(t) {
                        this._animatingZoom &&
                            t.propertyName.indexOf("transform") >= 0 &&
                            this._onZoomTransitionEnd();
                    },
                    _nothingToAnimate: function() {
                        return !this._container.getElementsByClassName(
                            "leaflet-zoom-animated"
                        ).length;
                    },
                    _tryAnimatedZoom: function(t, e, i) {
                        if (this._animatingZoom) return !0;
                        if (
                            ((i = i || {}),
                                !this._zoomAnimated ||
                                i.animate === !1 ||
                                this._nothingToAnimate() ||
                                Math.abs(e - this._zoom) > this.options.zoomAnimationThreshold)
                        )
                            return !1;
                        var s = this.getZoomScale(e),
                            l = this._getCenterOffset(t)._divideBy(1 - 1 / s);
                        return i.animate !== !0 && !this.getSize().contains(l) ?
                            !1 :
                            (D(function() {
                                    this._moveStart(!0, i.noMoveStart || !1)._animateZoom(t, e, !0);
                                }, this),
                                !0);
                    },
                    _animateZoom: function(t, e, i, s) {
                        this._mapPane &&
                            (i &&
                                ((this._animatingZoom = !0),
                                    (this._animateToCenter = t),
                                    (this._animateToZoom = e),
                                    V(this._mapPane, "leaflet-zoom-anim")),
                                this.fire("zoomanim", {
                                    center: t,
                                    zoom: e,
                                    noUpdate: s
                                }),
                                this._tempFireZoomEvent ||
                                (this._tempFireZoomEvent = this._zoom !== this._animateToZoom),
                                this._move(this._animateToCenter, this._animateToZoom, void 0, !0),
                                setTimeout(f(this._onZoomTransitionEnd, this), 250));
                    },
                    _onZoomTransitionEnd: function() {
                        this._animatingZoom &&
                            (this._mapPane && it(this._mapPane, "leaflet-zoom-anim"),
                                (this._animatingZoom = !1),
                                this._move(this._animateToCenter, this._animateToZoom, void 0, !0),
                                this._tempFireZoomEvent && this.fire("zoom"),
                                delete this._tempFireZoomEvent,
                                this.fire("move"),
                                this._moveEnd(!0));
                    },
                });

            function rs(t, e) {
                return new Y(t, e);
            }
            var Pt = q.extend({
                    options: {
                        position: "topright"
                    },
                    initialize: function(t) {
                        b(this, t);
                    },
                    getPosition: function() {
                        return this.options.position;
                    },
                    setPosition: function(t) {
                        var e = this._map;
                        return (
                            e && e.removeControl(this),
                            (this.options.position = t),
                            e && e.addControl(this),
                            this
                        );
                    },
                    getContainer: function() {
                        return this._container;
                    },
                    addTo: function(t) {
                        this.remove(), (this._map = t);
                        var e = (this._container = this.onAdd(t)),
                            i = this.getPosition(),
                            s = t._controlCorners[i];
                        return (
                            V(e, "leaflet-control"),
                            i.indexOf("bottom") !== -1 ?
                            s.insertBefore(e, s.firstChild) :
                            s.appendChild(e),
                            this._map.on("unload", this.remove, this),
                            this
                        );
                    },
                    remove: function() {
                        return this._map ?
                            (et(this._container),
                                this.onRemove && this.onRemove(this._map),
                                this._map.off("unload", this.remove, this),
                                (this._map = null),
                                this) :
                            this;
                    },
                    _refocusOnMap: function(t) {
                        this._map &&
                            t &&
                            t.screenX > 0 &&
                            t.screenY > 0 &&
                            this._map.getContainer().focus();
                    },
                }),
                fe = function(t) {
                    return new Pt(t);
                };
            Y.include({
                addControl: function(t) {
                    return t.addTo(this), this;
                },
                removeControl: function(t) {
                    return t.remove(), this;
                },
                _initControlPos: function() {
                    var t = (this._controlCorners = {}),
                        e = "leaflet-",
                        i = (this._controlContainer = X(
                            "div",
                            e + "control-container",
                            this._container
                        ));

                    function s(l, c) {
                        var m = e + l + " " + e + c;
                        t[l + c] = X("div", m, i);
                    }
                    s("top", "left"),
                        s("top", "right"),
                        s("bottom", "left"),
                        s("bottom", "right");
                },
                _clearControlPos: function() {
                    for (var t in this._controlCorners) et(this._controlCorners[t]);
                    et(this._controlContainer),
                        delete this._controlCorners,
                        delete this._controlContainer;
                },
            });
            var wn = Pt.extend({
                    options: {
                        collapsed: !0,
                        position: "topright",
                        autoZIndex: !0,
                        hideSingleBase: !1,
                        sortLayers: !1,
                        sortFunction: function(t, e, i, s) {
                            return i < s ? -1 : s < i ? 1 : 0;
                        },
                    },
                    initialize: function(t, e, i) {
                        b(this, i),
                            (this._layerControlInputs = []),
                            (this._layers = []),
                            (this._lastZIndex = 0),
                            (this._handlingClick = !1),
                            (this._preventClick = !1);
                        for (var s in t) this._addLayer(t[s], s);
                        for (s in e) this._addLayer(e[s], s, !0);
                    },
                    onAdd: function(t) {
                        this._initLayout(),
                            this._update(),
                            (this._map = t),
                            t.on("zoomend", this._checkDisabledLayers, this);
                        for (var e = 0; e < this._layers.length; e++)
                            this._layers[e].layer.on("add remove", this._onLayerChange, this);
                        return this._container;
                    },
                    addTo: function(t) {
                        return Pt.prototype.addTo.call(this, t), this._expandIfNotCollapsed();
                    },
                    onRemove: function() {
                        this._map.off("zoomend", this._checkDisabledLayers, this);
                        for (var t = 0; t < this._layers.length; t++)
                            this._layers[t].layer.off("add remove", this._onLayerChange, this);
                    },
                    addBaseLayer: function(t, e) {
                        return this._addLayer(t, e), this._map ? this._update() : this;
                    },
                    addOverlay: function(t, e) {
                        return this._addLayer(t, e, !0), this._map ? this._update() : this;
                    },
                    removeLayer: function(t) {
                        t.off("add remove", this._onLayerChange, this);
                        var e = this._getLayer(h(t));
                        return (
                            e && this._layers.splice(this._layers.indexOf(e), 1),
                            this._map ? this._update() : this
                        );
                    },
                    expand: function() {
                        V(this._container, "leaflet-control-layers-expanded"),
                            (this._section.style.height = null);
                        var t = this._map.getSize().y - (this._container.offsetTop + 50);
                        return (
                            t < this._section.clientHeight ?
                            (V(this._section, "leaflet-control-layers-scrollbar"),
                                (this._section.style.height = t + "px")) :
                            it(this._section, "leaflet-control-layers-scrollbar"),
                            this._checkDisabledLayers(),
                            this
                        );
                    },
                    collapse: function() {
                        return it(this._container, "leaflet-control-layers-expanded"), this;
                    },
                    _initLayout: function() {
                        var t = "leaflet-control-layers",
                            e = (this._container = X("div", t)),
                            i = this.options.collapsed;
                        e.setAttribute("aria-haspopup", !0), he(e), hi(e);
                        var s = (this._section = X("section", t + "-list"));
                        i &&
                            (this._map.on("click", this.collapse, this),
                                G(
                                    e, {
                                        mouseenter: this._expandSafely,
                                        mouseleave: this.collapse
                                    },
                                    this
                                ));
                        var l = (this._layersLink = X("a", t + "-toggle", e));
                        (l.href = "#"),
                        (l.title = "Layers"),
                        l.setAttribute("role", "button"),
                            G(
                                l, {
                                    keydown: function(c) {
                                        c.keyCode === 13 && this._expandSafely();
                                    },
                                    click: function(c) {
                                        ut(c), this._expandSafely();
                                    },
                                },
                                this
                            ),
                            i || this.expand(),
                            (this._baseLayersList = X("div", t + "-base", s)),
                            (this._separator = X("div", t + "-separator", s)),
                            (this._overlaysList = X("div", t + "-overlays", s)),
                            e.appendChild(s);
                    },
                    _getLayer: function(t) {
                        for (var e = 0; e < this._layers.length; e++)
                            if (this._layers[e] && h(this._layers[e].layer) === t)
                                return this._layers[e];
                    },
                    _addLayer: function(t, e, i) {
                        this._map && t.on("add remove", this._onLayerChange, this),
                            this._layers.push({
                                layer: t,
                                name: e,
                                overlay: i
                            }),
                            this.options.sortLayers &&
                            this._layers.sort(
                                f(function(s, l) {
                                    return this.options.sortFunction(
                                        s.layer,
                                        l.layer,
                                        s.name,
                                        l.name
                                    );
                                }, this)
                            ),
                            this.options.autoZIndex &&
                            t.setZIndex &&
                            (this._lastZIndex++, t.setZIndex(this._lastZIndex)),
                            this._expandIfNotCollapsed();
                    },
                    _update: function() {
                        if (!this._container) return this;
                        xe(this._baseLayersList),
                            xe(this._overlaysList),
                            (this._layerControlInputs = []);
                        var t,
                            e,
                            i,
                            s,
                            l = 0;
                        for (i = 0; i < this._layers.length; i++)
                            (s = this._layers[i]),
                            this._addItem(s),
                            (e = e || s.overlay),
                            (t = t || !s.overlay),
                            (l += s.overlay ? 0 : 1);
                        return (
                            this.options.hideSingleBase &&
                            ((t = t && l > 1),
                                (this._baseLayersList.style.display = t ? "" : "none")),
                            (this._separator.style.display = e && t ? "" : "none"),
                            this
                        );
                    },
                    _onLayerChange: function(t) {
                        this._handlingClick || this._update();
                        var e = this._getLayer(h(t.target)),
                            i = e.overlay ?
                            t.type === "add" ?
                            "overlayadd" :
                            "overlayremove" :
                            t.type === "add" ?
                            "baselayerchange" :
                            null;
                        i && this._map.fire(i, e);
                    },
                    _createRadioElement: function(t, e) {
                        var i =
                            '<input type="radio" class="leaflet-control-layers-selector" name="' +
                            t +
                            '"' +
                            (e ? ' checked="checked"' : "") +
                            "/>",
                            s = document.createElement("div");
                        return (s.innerHTML = i), s.firstChild;
                    },
                    _addItem: function(t) {
                        var e = document.createElement("label"),
                            i = this._map.hasLayer(t.layer),
                            s;
                        t.overlay ?
                            ((s = document.createElement("input")),
                                (s.type = "checkbox"),
                                (s.className = "leaflet-control-layers-selector"),
                                (s.defaultChecked = i)) :
                            (s = this._createRadioElement(
                                "leaflet-base-layers_" + h(this),
                                i
                            )),
                            this._layerControlInputs.push(s),
                            (s.layerId = h(t.layer)),
                            G(s, "click", this._onInputClick, this);
                        var l = document.createElement("span");
                        l.innerHTML = " " + t.name;
                        var c = document.createElement("span");
                        e.appendChild(c), c.appendChild(s), c.appendChild(l);
                        var m = t.overlay ? this._overlaysList : this._baseLayersList;
                        return m.appendChild(e), this._checkDisabledLayers(), e;
                    },
                    _onInputClick: function() {
                        if (!this._preventClick) {
                            var t = this._layerControlInputs,
                                e,
                                i,
                                s = [],
                                l = [];
                            this._handlingClick = !0;
                            for (var c = t.length - 1; c >= 0; c--)
                                (e = t[c]),
                                (i = this._getLayer(e.layerId).layer),
                                e.checked ? s.push(i) : e.checked || l.push(i);
                            for (c = 0; c < l.length; c++)
                                this._map.hasLayer(l[c]) && this._map.removeLayer(l[c]);
                            for (c = 0; c < s.length; c++)
                                this._map.hasLayer(s[c]) || this._map.addLayer(s[c]);
                            (this._handlingClick = !1), this._refocusOnMap();
                        }
                    },
                    _checkDisabledLayers: function() {
                        for (
                            var t = this._layerControlInputs,
                                e,
                                i,
                                s = this._map.getZoom(),
                                l = t.length - 1; l >= 0; l--
                        )
                            (e = t[l]),
                            (i = this._getLayer(e.layerId).layer),
                            (e.disabled =
                                (i.options.minZoom !== void 0 && s < i.options.minZoom) ||
                                (i.options.maxZoom !== void 0 && s > i.options.maxZoom));
                    },
                    _expandIfNotCollapsed: function() {
                        return this._map && !this.options.collapsed && this.expand(), this;
                    },
                    _expandSafely: function() {
                        var t = this._section;
                        (this._preventClick = !0), G(t, "click", ut), this.expand();
                        var e = this;
                        setTimeout(function() {
                            Q(t, "click", ut), (e._preventClick = !1);
                        });
                    },
                }),
                ss = function(t, e, i) {
                    return new wn(t, e, i);
                },
                pi = Pt.extend({
                    options: {
                        position: "topleft",
                        zoomInText: '<span aria-hidden="true">+</span>',
                        zoomInTitle: "Zoom in",
                        zoomOutText: '<span aria-hidden="true">&#x2212;</span>',
                        zoomOutTitle: "Zoom out",
                    },
                    onAdd: function(t) {
                        var e = "leaflet-control-zoom",
                            i = X("div", e + " leaflet-bar"),
                            s = this.options;
                        return (
                            (this._zoomInButton = this._createButton(
                                s.zoomInText,
                                s.zoomInTitle,
                                e + "-in",
                                i,
                                this._zoomIn
                            )),
                            (this._zoomOutButton = this._createButton(
                                s.zoomOutText,
                                s.zoomOutTitle,
                                e + "-out",
                                i,
                                this._zoomOut
                            )),
                            this._updateDisabled(),
                            t.on("zoomend zoomlevelschange", this._updateDisabled, this),
                            i
                        );
                    },
                    onRemove: function(t) {
                        t.off("zoomend zoomlevelschange", this._updateDisabled, this);
                    },
                    disable: function() {
                        return (this._disabled = !0), this._updateDisabled(), this;
                    },
                    enable: function() {
                        return (this._disabled = !1), this._updateDisabled(), this;
                    },
                    _zoomIn: function(t) {
                        !this._disabled &&
                            this._map._zoom < this._map.getMaxZoom() &&
                            this._map.zoomIn(
                                this._map.options.zoomDelta * (t.shiftKey ? 3 : 1)
                            );
                    },
                    _zoomOut: function(t) {
                        !this._disabled &&
                            this._map._zoom > this._map.getMinZoom() &&
                            this._map.zoomOut(
                                this._map.options.zoomDelta * (t.shiftKey ? 3 : 1)
                            );
                    },
                    _createButton: function(t, e, i, s, l) {
                        var c = X("a", i, s);
                        return (
                            (c.innerHTML = t),
                            (c.href = "#"),
                            (c.title = e),
                            c.setAttribute("role", "button"),
                            c.setAttribute("aria-label", e),
                            he(c),
                            G(c, "click", Ut),
                            G(c, "click", l, this),
                            G(c, "click", this._refocusOnMap, this),
                            c
                        );
                    },
                    _updateDisabled: function() {
                        var t = this._map,
                            e = "leaflet-disabled";
                        it(this._zoomInButton, e),
                            it(this._zoomOutButton, e),
                            this._zoomInButton.setAttribute("aria-disabled", "false"),
                            this._zoomOutButton.setAttribute("aria-disabled", "false"),
                            (this._disabled || t._zoom === t.getMinZoom()) &&
                            (V(this._zoomOutButton, e),
                                this._zoomOutButton.setAttribute("aria-disabled", "true")),
                            (this._disabled || t._zoom === t.getMaxZoom()) &&
                            (V(this._zoomInButton, e),
                                this._zoomInButton.setAttribute("aria-disabled", "true"));
                    },
                });
            Y.mergeOptions({
                    zoomControl: !0
                }),
                Y.addInitHook(function() {
                    this.options.zoomControl &&
                        ((this.zoomControl = new pi()), this.addControl(this.zoomControl));
                });
            var os = function(t) {
                    return new pi(t);
                },
                Tn = Pt.extend({
                    options: {
                        position: "bottomleft",
                        maxWidth: 100,
                        metric: !0,
                        imperial: !0,
                    },
                    onAdd: function(t) {
                        var e = "leaflet-control-scale",
                            i = X("div", e),
                            s = this.options;
                        return (
                            this._addScales(s, e + "-line", i),
                            t.on(s.updateWhenIdle ? "moveend" : "move", this._update, this),
                            t.whenReady(this._update, this),
                            i
                        );
                    },
                    onRemove: function(t) {
                        t.off(
                            this.options.updateWhenIdle ? "moveend" : "move",
                            this._update,
                            this
                        );
                    },
                    _addScales: function(t, e, i) {
                        t.metric && (this._mScale = X("div", e, i)),
                            t.imperial && (this._iScale = X("div", e, i));
                    },
                    _update: function() {
                        var t = this._map,
                            e = t.getSize().y / 2,
                            i = t.distance(
                                t.containerPointToLatLng([0, e]),
                                t.containerPointToLatLng([this.options.maxWidth, e])
                            );
                        this._updateScales(i);
                    },
                    _updateScales: function(t) {
                        this.options.metric && t && this._updateMetric(t),
                            this.options.imperial && t && this._updateImperial(t);
                    },
                    _updateMetric: function(t) {
                        var e = this._getRoundNum(t),
                            i = e < 1e3 ? e + " m" : e / 1e3 + " km";
                        this._updateScale(this._mScale, i, e / t);
                    },
                    _updateImperial: function(t) {
                        var e = t * 3.2808399,
                            i,
                            s,
                            l;
                        e > 5280 ?
                            ((i = e / 5280),
                                (s = this._getRoundNum(i)),
                                this._updateScale(this._iScale, s + " mi", s / i)) :
                            ((l = this._getRoundNum(e)),
                                this._updateScale(this._iScale, l + " ft", l / e));
                    },
                    _updateScale: function(t, e, i) {
                        (t.style.width = Math.round(this.options.maxWidth * i) + "px"),
                        (t.innerHTML = e);
                    },
                    _getRoundNum: function(t) {
                        var e = Math.pow(10, (Math.floor(t) + "").length - 1),
                            i = t / e;
                        return (
                            (i = i >= 10 ? 10 : i >= 5 ? 5 : i >= 3 ? 3 : i >= 2 ? 2 : 1), e * i
                        );
                    },
                }),
                as = function(t) {
                    return new Tn(t);
                },
                ls =
                '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" class="leaflet-attribution-flag"><path fill="#4C7BE1" d="M0 0h12v4H0z"/><path fill="#FFD500" d="M0 4h12v3H0z"/><path fill="#E0BC00" d="M0 7h12v1H0z"/></svg>',
                mi = Pt.extend({
                    options: {
                        position: "bottomright",
                        prefix: '<a href="https://leafletjs.com" title="A JavaScript library for interactive maps">' +
                            (N.inlineSvg ? ls + " " : "") +
                            "Leaflet</a>",
                    },
                    initialize: function(t) {
                        b(this, t), (this._attributions = {});
                    },
                    onAdd: function(t) {
                        (t.attributionControl = this),
                        (this._container = X("div", "leaflet-control-attribution")),
                        he(this._container);
                        for (var e in t._layers)
                            t._layers[e].getAttribution &&
                            this.addAttribution(t._layers[e].getAttribution());
                        return (
                            this._update(),
                            t.on("layeradd", this._addAttribution, this),
                            this._container
                        );
                    },
                    onRemove: function(t) {
                        t.off("layeradd", this._addAttribution, this);
                    },
                    _addAttribution: function(t) {
                        t.layer.getAttribution &&
                            (this.addAttribution(t.layer.getAttribution()),
                                t.layer.once(
                                    "remove",
                                    function() {
                                        this.removeAttribution(t.layer.getAttribution());
                                    },
                                    this
                                ));
                    },
                    setPrefix: function(t) {
                        return (this.options.prefix = t), this._update(), this;
                    },
                    addAttribution: function(t) {
                        return t ?
                            (this._attributions[t] || (this._attributions[t] = 0),
                                this._attributions[t]++,
                                this._update(),
                                this) :
                            this;
                    },
                    removeAttribution: function(t) {
                        return t ?
                            (this._attributions[t] &&
                                (this._attributions[t]--, this._update()),
                                this) :
                            this;
                    },
                    _update: function() {
                        if (this._map) {
                            var t = [];
                            for (var e in this._attributions)
                                this._attributions[e] && t.push(e);
                            var i = [];
                            this.options.prefix && i.push(this.options.prefix),
                                t.length && i.push(t.join(", ")),
                                (this._container.innerHTML = i.join(
                                    ' <span aria-hidden="true">|</span> '
                                ));
                        }
                    },
                });
            Y.mergeOptions({
                    attributionControl: !0
                }),
                Y.addInitHook(function() {
                    this.options.attributionControl && new mi().addTo(this);
                });
            var ds = function(t) {
                return new mi(t);
            };
            (Pt.Layers = wn),
            (Pt.Zoom = pi),
            (Pt.Scale = Tn),
            (Pt.Attribution = mi),
            (fe.layers = ss),
            (fe.zoom = os),
            (fe.scale = as),
            (fe.attribution = ds);
            var Mt = q.extend({
                initialize: function(t) {
                    this._map = t;
                },
                enable: function() {
                    return this._enabled ?
                        this :
                        ((this._enabled = !0), this.addHooks(), this);
                },
                disable: function() {
                    return this._enabled ?
                        ((this._enabled = !1), this.removeHooks(), this) :
                        this;
                },
                enabled: function() {
                    return !!this._enabled;
                },
            });
            Mt.addTo = function(t, e) {
                return t.addHandler(e, this), this;
            };
            var us = {
                    Events: tt
                },
                Pn = N.touch ? "touchstart mousedown" : "mousedown",
                Ht = kt.extend({
                    options: {
                        clickTolerance: 3
                    },
                    initialize: function(t, e, i, s) {
                        b(this, s),
                            (this._element = t),
                            (this._dragStartTarget = e || t),
                            (this._preventOutline = i);
                    },
                    enable: function() {
                        this._enabled ||
                            (G(this._dragStartTarget, Pn, this._onDown, this),
                                (this._enabled = !0));
                    },
                    disable: function() {
                        this._enabled &&
                            (Ht._dragging === this && this.finishDrag(!0),
                                Q(this._dragStartTarget, Pn, this._onDown, this),
                                (this._enabled = !1),
                                (this._moved = !1));
                    },
                    _onDown: function(t) {
                        if (
                            this._enabled &&
                            ((this._moved = !1), !ei(this._element, "leaflet-zoom-anim"))
                        ) {
                            if (t.touches && t.touches.length !== 1) {
                                Ht._dragging === this && this.finishDrag();
                                return;
                            }
                            if (
                                !(
                                    Ht._dragging ||
                                    t.shiftKey ||
                                    (t.which !== 1 && t.button !== 1 && !t.touches)
                                ) &&
                                ((Ht._dragging = this),
                                    this._preventOutline && ai(this._element),
                                    ri(),
                                    de(),
                                    !this._moving)
                            ) {
                                this.fire("down");
                                var e = t.touches ? t.touches[0] : t,
                                    i = _n(this._element);
                                (this._startPoint = new I(e.clientX, e.clientY)),
                                (this._startPos = jt(this._element)),
                                (this._parentScale = li(i));
                                var s = t.type === "mousedown";
                                G(document, s ? "mousemove" : "touchmove", this._onMove, this),
                                    G(
                                        document,
                                        s ? "mouseup" : "touchend touchcancel",
                                        this._onUp,
                                        this
                                    );
                            }
                        }
                    },
                    _onMove: function(t) {
                        if (this._enabled) {
                            if (t.touches && t.touches.length > 1) {
                                this._moved = !0;
                                return;
                            }
                            var e = t.touches && t.touches.length === 1 ? t.touches[0] : t,
                                i = new I(e.clientX, e.clientY)._subtract(this._startPoint);
                            (!i.x && !i.y) ||
                            Math.abs(i.x) + Math.abs(i.y) < this.options.clickTolerance ||
                                ((i.x /= this._parentScale.x),
                                    (i.y /= this._parentScale.y),
                                    ut(t),
                                    this._moved ||
                                    (this.fire("dragstart"),
                                        (this._moved = !0),
                                        V(document.body, "leaflet-dragging"),
                                        (this._lastTarget = t.target || t.srcElement),
                                        window.SVGElementInstance &&
                                        this._lastTarget instanceof window.SVGElementInstance &&
                                        (this._lastTarget = this._lastTarget.correspondingUseElement),
                                        V(this._lastTarget, "leaflet-drag-target")),
                                    (this._newPos = this._startPos.add(i)),
                                    (this._moving = !0),
                                    (this._lastEvent = t),
                                    this._updatePosition());
                        }
                    },
                    _updatePosition: function() {
                        var t = {
                            originalEvent: this._lastEvent
                        };
                        this.fire("predrag", t),
                            rt(this._element, this._newPos),
                            this.fire("drag", t);
                    },
                    _onUp: function() {
                        this._enabled && this.finishDrag();
                    },
                    finishDrag: function(t) {
                        it(document.body, "leaflet-dragging"),
                            this._lastTarget &&
                            (it(this._lastTarget, "leaflet-drag-target"),
                                (this._lastTarget = null)),
                            Q(document, "mousemove touchmove", this._onMove, this),
                            Q(document, "mouseup touchend touchcancel", this._onUp, this),
                            si(),
                            ue();
                        var e = this._moved && this._moving;
                        (this._moving = !1),
                        (Ht._dragging = !1),
                        e &&
                            this.fire("dragend", {
                                noInertia: t,
                                distance: this._newPos.distanceTo(this._startPos),
                            });
                    },
                });

            function Sn(t, e, i) {
                var s,
                    l = [1, 4, 2, 8],
                    c,
                    m,
                    _,
                    x,
                    S,
                    k,
                    F,
                    W;
                for (c = 0, k = t.length; c < k; c++) t[c]._code = Yt(t[c], e);
                for (_ = 0; _ < 4; _++) {
                    for (F = l[_], s = [], c = 0, k = t.length, m = k - 1; c < k; m = c++)
                        (x = t[c]),
                        (S = t[m]),
                        x._code & F ?
                        S._code & F ||
                        ((W = Le(S, x, F, e, i)), (W._code = Yt(W, e)), s.push(W)) :
                        (S._code & F &&
                            ((W = Le(S, x, F, e, i)), (W._code = Yt(W, e)), s.push(W)),
                            s.push(x));
                    t = s;
                }
                return t;
            }

            function Ln(t, e) {
                var i, s, l, c, m, _, x, S, k;
                if (!t || t.length === 0) throw new Error("latlngs not passed");
                wt(t) ||
                    (console.warn("latlngs are not flat! Only the first ring will be used"),
                        (t = t[0]));
                var F = U([0, 0]),
                    W = nt(t),
                    ht =
                    W.getNorthWest().distanceTo(W.getSouthWest()) *
                    W.getNorthEast().distanceTo(W.getNorthWest());
                ht < 1700 && (F = _i(t));
                var lt = t.length,
                    Tt = [];
                for (i = 0; i < lt; i++) {
                    var mt = U(t[i]);
                    Tt.push(e.project(U([mt.lat - F.lat, mt.lng - F.lng])));
                }
                for (_ = x = S = 0, i = 0, s = lt - 1; i < lt; s = i++)
                    (l = Tt[i]),
                    (c = Tt[s]),
                    (m = l.y * c.x - c.y * l.x),
                    (x += (l.x + c.x) * m),
                    (S += (l.y + c.y) * m),
                    (_ += m * 3);
                _ === 0 ? (k = Tt[0]) : (k = [x / _, S / _]);
                var ne = e.unproject(Z(k));
                return U([ne.lat + F.lat, ne.lng + F.lng]);
            }

            function _i(t) {
                for (var e = 0, i = 0, s = 0, l = 0; l < t.length; l++) {
                    var c = U(t[l]);
                    (e += c.lat), (i += c.lng), s++;
                }
                return U([e / s, i / s]);
            }
            var cs = {
                __proto__: null,
                clipPolygon: Sn,
                polygonCenter: Ln,
                centroid: _i,
            };

            function En(t, e) {
                if (!e || !t.length) return t.slice();
                var i = e * e;
                return (t = ps(t, i)), (t = fs(t, i)), t;
            }

            function Mn(t, e, i) {
                return Math.sqrt(pe(t, e, i, !0));
            }

            function hs(t, e, i) {
                return pe(t, e, i);
            }

            function fs(t, e) {
                var i = t.length,
                    s = typeof Uint8Array < "u" ? Uint8Array : Array,
                    l = new s(i);
                (l[0] = l[i - 1] = 1), gi(t, l, e, 0, i - 1);
                var c,
                    m = [];
                for (c = 0; c < i; c++) l[c] && m.push(t[c]);
                return m;
            }

            function gi(t, e, i, s, l) {
                var c = 0,
                    m,
                    _,
                    x;
                for (_ = s + 1; _ <= l - 1; _++)
                    (x = pe(t[_], t[s], t[l], !0)), x > c && ((m = _), (c = x));
                c > i && ((e[m] = 1), gi(t, e, i, s, m), gi(t, e, i, m, l));
            }

            function ps(t, e) {
                for (var i = [t[0]], s = 1, l = 0, c = t.length; s < c; s++)
                    ms(t[s], t[l]) > e && (i.push(t[s]), (l = s));
                return l < c - 1 && i.push(t[c - 1]), i;
            }
            var Cn;

            function In(t, e, i, s, l) {
                var c = s ? Cn : Yt(t, i),
                    m = Yt(e, i),
                    _,
                    x,
                    S;
                for (Cn = m;;) {
                    if (!(c | m)) return [t, e];
                    if (c & m) return !1;
                    (_ = c || m),
                    (x = Le(t, e, _, i, l)),
                    (S = Yt(x, i)),
                    _ === c ? ((t = x), (c = S)) : ((e = x), (m = S));
                }
            }

            function Le(t, e, i, s, l) {
                var c = e.x - t.x,
                    m = e.y - t.y,
                    _ = s.min,
                    x = s.max,
                    S,
                    k;
                return (
                    i & 8 ?
                    ((S = t.x + (c * (x.y - t.y)) / m), (k = x.y)) :
                    i & 4 ?
                    ((S = t.x + (c * (_.y - t.y)) / m), (k = _.y)) :
                    i & 2 ?
                    ((S = x.x), (k = t.y + (m * (x.x - t.x)) / c)) :
                    i & 1 && ((S = _.x), (k = t.y + (m * (_.x - t.x)) / c)),
                    new I(S, k, l)
                );
            }

            function Yt(t, e) {
                var i = 0;
                return (
                    t.x < e.min.x ? (i |= 1) : t.x > e.max.x && (i |= 2),
                    t.y < e.min.y ? (i |= 4) : t.y > e.max.y && (i |= 8),
                    i
                );
            }

            function ms(t, e) {
                var i = e.x - t.x,
                    s = e.y - t.y;
                return i * i + s * s;
            }

            function pe(t, e, i, s) {
                var l = e.x,
                    c = e.y,
                    m = i.x - l,
                    _ = i.y - c,
                    x = m * m + _ * _,
                    S;
                return (
                    x > 0 &&
                    ((S = ((t.x - l) * m + (t.y - c) * _) / x),
                        S > 1 ?
                        ((l = i.x), (c = i.y)) :
                        S > 0 && ((l += m * S), (c += _ * S))),
                    (m = t.x - l),
                    (_ = t.y - c),
                    s ? m * m + _ * _ : new I(l, c)
                );
            }

            function wt(t) {
                return !M(t[0]) || (typeof t[0][0] != "object" && typeof t[0][0] < "u");
            }

            function kn(t) {
                return (
                    console.warn(
                        "Deprecated use of _flat, please use L.LineUtil.isFlat instead."
                    ),
                    wt(t)
                );
            }

            function An(t, e) {
                var i, s, l, c, m, _, x, S;
                if (!t || t.length === 0) throw new Error("latlngs not passed");
                wt(t) ||
                    (console.warn("latlngs are not flat! Only the first ring will be used"),
                        (t = t[0]));
                var k = U([0, 0]),
                    F = nt(t),
                    W =
                    F.getNorthWest().distanceTo(F.getSouthWest()) *
                    F.getNorthEast().distanceTo(F.getNorthWest());
                W < 1700 && (k = _i(t));
                var ht = t.length,
                    lt = [];
                for (i = 0; i < ht; i++) {
                    var Tt = U(t[i]);
                    lt.push(e.project(U([Tt.lat - k.lat, Tt.lng - k.lng])));
                }
                for (i = 0, s = 0; i < ht - 1; i++) s += lt[i].distanceTo(lt[i + 1]) / 2;
                if (s === 0) S = lt[0];
                else
                    for (i = 0, c = 0; i < ht - 1; i++)
                        if (
                            ((m = lt[i]),
                                (_ = lt[i + 1]),
                                (l = m.distanceTo(_)),
                                (c += l),
                                c > s)
                        ) {
                            (x = (c - s) / l),
                            (S = [_.x - x * (_.x - m.x), _.y - x * (_.y - m.y)]);
                            break;
                        }
                var mt = e.unproject(Z(S));
                return U([mt.lat + k.lat, mt.lng + k.lng]);
            }
            var _s = {
                    __proto__: null,
                    simplify: En,
                    pointToSegmentDistance: Mn,
                    closestPointOnSegment: hs,
                    clipSegment: In,
                    _getEdgeIntersection: Le,
                    _getBitCode: Yt,
                    _sqClosestPointOnSegment: pe,
                    isFlat: wt,
                    _flat: kn,
                    polylineCenter: An,
                },
                vi = {
                    project: function(t) {
                        return new I(t.lng, t.lat);
                    },
                    unproject: function(t) {
                        return new J(t.y, t.x);
                    },
                    bounds: new $([-180, -90], [180, 90]),
                },
                yi = {
                    R: 6378137,
                    R_MINOR: 6356752314245179e-9,
                    bounds: new $(
                        [-2003750834279e-5, -1549657073972e-5],
                        [2003750834279e-5, 1876465623138e-5]
                    ),
                    project: function(t) {
                        var e = Math.PI / 180,
                            i = this.R,
                            s = t.lat * e,
                            l = this.R_MINOR / i,
                            c = Math.sqrt(1 - l * l),
                            m = c * Math.sin(s),
                            _ =
                            Math.tan(Math.PI / 4 - s / 2) /
                            Math.pow((1 - m) / (1 + m), c / 2);
                        return (
                            (s = -i * Math.log(Math.max(_, 1e-10))), new I(t.lng * e * i, s)
                        );
                    },
                    unproject: function(t) {
                        for (
                            var e = 180 / Math.PI,
                                i = this.R,
                                s = this.R_MINOR / i,
                                l = Math.sqrt(1 - s * s),
                                c = Math.exp(-t.y / i),
                                m = Math.PI / 2 - 2 * Math.atan(c),
                                _ = 0,
                                x = 0.1,
                                S; _ < 15 && Math.abs(x) > 1e-7; _++
                        )
                            (S = l * Math.sin(m)),
                            (S = Math.pow((1 - S) / (1 + S), l / 2)),
                            (x = Math.PI / 2 - 2 * Math.atan(c * S) - m),
                            (m += x);
                        return new J(m * e, (t.x * e) / i);
                    },
                },
                gs = {
                    __proto__: null,
                    LonLat: vi,
                    Mercator: yi,
                    SphericalMercator: je
                },
                vs = d({}, Ft, {
                    code: "EPSG:3395",
                    projection: yi,
                    transformation: (function() {
                        var t = 0.5 / (Math.PI * yi.R);
                        return se(t, 0.5, -t, 0.5);
                    })(),
                }),
                On = d({}, Ft, {
                    code: "EPSG:4326",
                    projection: vi,
                    transformation: se(1 / 180, 1, -1 / 180, 0.5),
                }),
                ys = d({}, At, {
                    projection: vi,
                    transformation: se(1, 0, -1, 0),
                    scale: function(t) {
                        return Math.pow(2, t);
                    },
                    zoom: function(t) {
                        return Math.log(t) / Math.LN2;
                    },
                    distance: function(t, e) {
                        var i = e.lng - t.lng,
                            s = e.lat - t.lat;
                        return Math.sqrt(i * i + s * s);
                    },
                    infinite: !0,
                });
            (At.Earth = Ft),
            (At.EPSG3395 = vs),
            (At.EPSG3857 = Ue),
            (At.EPSG900913 = Sr),
            (At.EPSG4326 = On),
            (At.Simple = ys);
            var St = kt.extend({
                options: {
                    pane: "overlayPane",
                    attribution: null,
                    bubblingMouseEvents: !0,
                },
                addTo: function(t) {
                    return t.addLayer(this), this;
                },
                remove: function() {
                    return this.removeFrom(this._map || this._mapToAdd);
                },
                removeFrom: function(t) {
                    return t && t.removeLayer(this), this;
                },
                getPane: function(t) {
                    return this._map.getPane(t ? this.options[t] || t : this.options.pane);
                },
                addInteractiveTarget: function(t) {
                    return (this._map._targets[h(t)] = this), this;
                },
                removeInteractiveTarget: function(t) {
                    return delete this._map._targets[h(t)], this;
                },
                getAttribution: function() {
                    return this.options.attribution;
                },
                _layerAdd: function(t) {
                    var e = t.target;
                    if (e.hasLayer(this)) {
                        if (
                            ((this._map = e),
                                (this._zoomAnimated = e._zoomAnimated),
                                this.getEvents)
                        ) {
                            var i = this.getEvents();
                            e.on(i, this),
                                this.once(
                                    "remove",
                                    function() {
                                        e.off(i, this);
                                    },
                                    this
                                );
                        }
                        this.onAdd(e), this.fire("add"), e.fire("layeradd", {
                            layer: this
                        });
                    }
                },
            });
            Y.include({
                addLayer: function(t) {
                    if (!t._layerAdd)
                        throw new Error("The provided object is not a Layer.");
                    var e = h(t);
                    return this._layers[e] ?
                        this :
                        ((this._layers[e] = t),
                            (t._mapToAdd = this),
                            t.beforeAdd && t.beforeAdd(this),
                            this.whenReady(t._layerAdd, t),
                            this);
                },
                removeLayer: function(t) {
                    var e = h(t);
                    return this._layers[e] ?
                        (this._loaded && t.onRemove(this),
                            delete this._layers[e],
                            this._loaded &&
                            (this.fire("layerremove", {
                                layer: t
                            }), t.fire("remove")),
                            (t._map = t._mapToAdd = null),
                            this) :
                        this;
                },
                hasLayer: function(t) {
                    return h(t) in this._layers;
                },
                eachLayer: function(t, e) {
                    for (var i in this._layers) t.call(e, this._layers[i]);
                    return this;
                },
                _addLayers: function(t) {
                    t = t ? (M(t) ? t : [t]) : [];
                    for (var e = 0, i = t.length; e < i; e++) this.addLayer(t[e]);
                },
                _addZoomLimit: function(t) {
                    (!isNaN(t.options.maxZoom) || !isNaN(t.options.minZoom)) &&
                    ((this._zoomBoundLayers[h(t)] = t), this._updateZoomLevels());
                },
                _removeZoomLimit: function(t) {
                    var e = h(t);
                    this._zoomBoundLayers[e] &&
                        (delete this._zoomBoundLayers[e], this._updateZoomLevels());
                },
                _updateZoomLevels: function() {
                    var t = 1 / 0,
                        e = -1 / 0,
                        i = this._getZoomSpan();
                    for (var s in this._zoomBoundLayers) {
                        var l = this._zoomBoundLayers[s].options;
                        (t = l.minZoom === void 0 ? t : Math.min(t, l.minZoom)),
                        (e = l.maxZoom === void 0 ? e : Math.max(e, l.maxZoom));
                    }
                    (this._layersMaxZoom = e === -1 / 0 ? void 0 : e),
                    (this._layersMinZoom = t === 1 / 0 ? void 0 : t),
                    i !== this._getZoomSpan() && this.fire("zoomlevelschange"),
                        this.options.maxZoom === void 0 &&
                        this._layersMaxZoom &&
                        this.getZoom() > this._layersMaxZoom &&
                        this.setZoom(this._layersMaxZoom),
                        this.options.minZoom === void 0 &&
                        this._layersMinZoom &&
                        this.getZoom() < this._layersMinZoom &&
                        this.setZoom(this._layersMinZoom);
                },
            });
            var Jt = St.extend({
                    initialize: function(t, e) {
                        b(this, e), (this._layers = {});
                        var i, s;
                        if (t)
                            for (i = 0, s = t.length; i < s; i++) this.addLayer(t[i]);
                    },
                    addLayer: function(t) {
                        var e = this.getLayerId(t);
                        return (
                            (this._layers[e] = t), this._map && this._map.addLayer(t), this
                        );
                    },
                    removeLayer: function(t) {
                        var e = t in this._layers ? t : this.getLayerId(t);
                        return (
                            this._map &&
                            this._layers[e] &&
                            this._map.removeLayer(this._layers[e]),
                            delete this._layers[e],
                            this
                        );
                    },
                    hasLayer: function(t) {
                        var e = typeof t == "number" ? t : this.getLayerId(t);
                        return e in this._layers;
                    },
                    clearLayers: function() {
                        return this.eachLayer(this.removeLayer, this);
                    },
                    invoke: function(t) {
                        var e = Array.prototype.slice.call(arguments, 1),
                            i,
                            s;
                        for (i in this._layers)
                            (s = this._layers[i]), s[t] && s[t].apply(s, e);
                        return this;
                    },
                    onAdd: function(t) {
                        this.eachLayer(t.addLayer, t);
                    },
                    onRemove: function(t) {
                        this.eachLayer(t.removeLayer, t);
                    },
                    eachLayer: function(t, e) {
                        for (var i in this._layers) t.call(e, this._layers[i]);
                        return this;
                    },
                    getLayer: function(t) {
                        return this._layers[t];
                    },
                    getLayers: function() {
                        var t = [];
                        return this.eachLayer(t.push, t), t;
                    },
                    setZIndex: function(t) {
                        return this.invoke("setZIndex", t);
                    },
                    getLayerId: function(t) {
                        return h(t);
                    },
                }),
                bs = function(t, e) {
                    return new Jt(t, e);
                },
                Ot = Jt.extend({
                    addLayer: function(t) {
                        return this.hasLayer(t) ?
                            this :
                            (t.addEventParent(this),
                                Jt.prototype.addLayer.call(this, t),
                                this.fire("layeradd", {
                                    layer: t
                                }));
                    },
                    removeLayer: function(t) {
                        return this.hasLayer(t) ?
                            (t in this._layers && (t = this._layers[t]),
                                t.removeEventParent(this),
                                Jt.prototype.removeLayer.call(this, t),
                                this.fire("layerremove", {
                                    layer: t
                                })) :
                            this;
                    },
                    setStyle: function(t) {
                        return this.invoke("setStyle", t);
                    },
                    bringToFront: function() {
                        return this.invoke("bringToFront");
                    },
                    bringToBack: function() {
                        return this.invoke("bringToBack");
                    },
                    getBounds: function() {
                        var t = new pt();
                        for (var e in this._layers) {
                            var i = this._layers[e];
                            t.extend(i.getBounds ? i.getBounds() : i.getLatLng());
                        }
                        return t;
                    },
                }),
                xs = function(t, e) {
                    return new Ot(t, e);
                },
                Qt = q.extend({
                    options: {
                        popupAnchor: [0, 0],
                        tooltipAnchor: [0, 0],
                        crossOrigin: !1,
                    },
                    initialize: function(t) {
                        b(this, t);
                    },
                    createIcon: function(t) {
                        return this._createIcon("icon", t);
                    },
                    createShadow: function(t) {
                        return this._createIcon("shadow", t);
                    },
                    _createIcon: function(t, e) {
                        var i = this._getIconUrl(t);
                        if (!i) {
                            if (t === "icon")
                                throw new Error(
                                    "iconUrl not set in Icon options (see the docs)."
                                );
                            return null;
                        }
                        var s = this._createImg(i, e && e.tagName === "IMG" ? e : null);
                        return (
                            this._setIconStyles(s, t),
                            (this.options.crossOrigin || this.options.crossOrigin === "") &&
                            (s.crossOrigin =
                                this.options.crossOrigin === !0 ?
                                "" :
                                this.options.crossOrigin),
                            s
                        );
                    },
                    _setIconStyles: function(t, e) {
                        var i = this.options,
                            s = i[e + "Size"];
                        typeof s == "number" && (s = [s, s]);
                        var l = Z(s),
                            c = Z(
                                (e === "shadow" && i.shadowAnchor) ||
                                i.iconAnchor ||
                                (l && l.divideBy(2, !0))
                            );
                        (t.className = "leaflet-marker-" + e + " " + (i.className || "")),
                        c &&
                            ((t.style.marginLeft = -c.x + "px"),
                                (t.style.marginTop = -c.y + "px")),
                            l && ((t.style.width = l.x + "px"), (t.style.height = l.y + "px"));
                    },
                    _createImg: function(t, e) {
                        return (e = e || document.createElement("img")), (e.src = t), e;
                    },
                    _getIconUrl: function(t) {
                        return (
                            (N.retina && this.options[t + "RetinaUrl"]) ||
                            this.options[t + "Url"]
                        );
                    },
                });

            function ws(t) {
                return new Qt(t);
            }
            var me = Qt.extend({
                    options: {
                        iconUrl: "marker-icon.png",
                        iconRetinaUrl: "marker-icon-2x.png",
                        shadowUrl: "marker-shadow.png",
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        tooltipAnchor: [16, -28],
                        shadowSize: [41, 41],
                    },
                    _getIconUrl: function(t) {
                        return (
                            typeof me.imagePath != "string" &&
                            (me.imagePath = this._detectIconPath()),
                            (this.options.imagePath || me.imagePath) +
                            Qt.prototype._getIconUrl.call(this, t)
                        );
                    },
                    _stripUrl: function(t) {
                        var e = function(i, s, l) {
                            var c = s.exec(i);
                            return c && c[l];
                        };
                        return (
                            (t = e(t, /^url\((['"])?(.+)\1\)$/, 2)),
                            t && e(t, /^(.*)marker-icon\.png$/, 1)
                        );
                    },
                    _detectIconPath: function() {
                        var t = X("div", "leaflet-default-icon-path", document.body),
                            e = le(t, "background-image") || le(t, "backgroundImage");
                        if ((document.body.removeChild(t), (e = this._stripUrl(e)), e))
                            return e;
                        var i = document.querySelector('link[href$="leaflet.css"]');
                        return i ? i.href.substring(0, i.href.length - 11 - 1) : "";
                    },
                }),
                zn = Mt.extend({
                    initialize: function(t) {
                        this._marker = t;
                    },
                    addHooks: function() {
                        var t = this._marker._icon;
                        this._draggable || (this._draggable = new Ht(t, t, !0)),
                            this._draggable
                            .on({
                                    dragstart: this._onDragStart,
                                    predrag: this._onPreDrag,
                                    drag: this._onDrag,
                                    dragend: this._onDragEnd,
                                },
                                this
                            )
                            .enable(),
                            V(t, "leaflet-marker-draggable");
                    },
                    removeHooks: function() {
                        this._draggable
                            .off({
                                    dragstart: this._onDragStart,
                                    predrag: this._onPreDrag,
                                    drag: this._onDrag,
                                    dragend: this._onDragEnd,
                                },
                                this
                            )
                            .disable(),
                            this._marker._icon &&
                            it(this._marker._icon, "leaflet-marker-draggable");
                    },
                    moved: function() {
                        return this._draggable && this._draggable._moved;
                    },
                    _adjustPan: function(t) {
                        var e = this._marker,
                            i = e._map,
                            s = this._marker.options.autoPanSpeed,
                            l = this._marker.options.autoPanPadding,
                            c = jt(e._icon),
                            m = i.getPixelBounds(),
                            _ = i.getPixelOrigin(),
                            x = ot(m.min._subtract(_).add(l), m.max._subtract(_).subtract(l));
                        if (!x.contains(c)) {
                            var S = Z(
                                (Math.max(x.max.x, c.x) - x.max.x) / (m.max.x - x.max.x) -
                                (Math.min(x.min.x, c.x) - x.min.x) / (m.min.x - x.min.x),
                                (Math.max(x.max.y, c.y) - x.max.y) / (m.max.y - x.max.y) -
                                (Math.min(x.min.y, c.y) - x.min.y) / (m.min.y - x.min.y)
                            ).multiplyBy(s);
                            i.panBy(S, {
                                    animate: !1
                                }),
                                this._draggable._newPos._add(S),
                                this._draggable._startPos._add(S),
                                rt(e._icon, this._draggable._newPos),
                                this._onDrag(t),
                                (this._panRequest = D(this._adjustPan.bind(this, t)));
                        }
                    },
                    _onDragStart: function() {
                        (this._oldLatLng = this._marker.getLatLng()),
                        this._marker.closePopup && this._marker.closePopup(),
                            this._marker.fire("movestart").fire("dragstart");
                    },
                    _onPreDrag: function(t) {
                        this._marker.options.autoPan &&
                            (R(this._panRequest),
                                (this._panRequest = D(this._adjustPan.bind(this, t))));
                    },
                    _onDrag: function(t) {
                        var e = this._marker,
                            i = e._shadow,
                            s = jt(e._icon),
                            l = e._map.layerPointToLatLng(s);
                        i && rt(i, s),
                            (e._latlng = l),
                            (t.latlng = l),
                            (t.oldLatLng = this._oldLatLng),
                            e.fire("move", t).fire("drag", t);
                    },
                    _onDragEnd: function(t) {
                        R(this._panRequest),
                            delete this._oldLatLng,
                            this._marker.fire("moveend").fire("dragend", t);
                    },
                }),
                Ee = St.extend({
                    options: {
                        icon: new me(),
                        interactive: !0,
                        keyboard: !0,
                        title: "",
                        alt: "Marker",
                        zIndexOffset: 0,
                        opacity: 1,
                        riseOnHover: !1,
                        riseOffset: 250,
                        pane: "markerPane",
                        shadowPane: "shadowPane",
                        bubblingMouseEvents: !1,
                        autoPanOnFocus: !0,
                        draggable: !1,
                        autoPan: !1,
                        autoPanPadding: [50, 50],
                        autoPanSpeed: 10,
                    },
                    initialize: function(t, e) {
                        b(this, e), (this._latlng = U(t));
                    },
                    onAdd: function(t) {
                        (this._zoomAnimated =
                            this._zoomAnimated && t.options.markerZoomAnimation),
                        this._zoomAnimated && t.on("zoomanim", this._animateZoom, this),
                            this._initIcon(),
                            this.update();
                    },
                    onRemove: function(t) {
                        this.dragging &&
                            this.dragging.enabled() &&
                            ((this.options.draggable = !0), this.dragging.removeHooks()),
                            delete this.dragging,
                            this._zoomAnimated && t.off("zoomanim", this._animateZoom, this),
                            this._removeIcon(),
                            this._removeShadow();
                    },
                    getEvents: function() {
                        return {
                            zoom: this.update,
                            viewreset: this.update
                        };
                    },
                    getLatLng: function() {
                        return this._latlng;
                    },
                    setLatLng: function(t) {
                        var e = this._latlng;
                        return (
                            (this._latlng = U(t)),
                            this.update(),
                            this.fire("move", {
                                oldLatLng: e,
                                latlng: this._latlng
                            })
                        );
                    },
                    setZIndexOffset: function(t) {
                        return (this.options.zIndexOffset = t), this.update();
                    },
                    getIcon: function() {
                        return this.options.icon;
                    },
                    setIcon: function(t) {
                        return (
                            (this.options.icon = t),
                            this._map && (this._initIcon(), this.update()),
                            this._popup && this.bindPopup(this._popup, this._popup.options),
                            this
                        );
                    },
                    getElement: function() {
                        return this._icon;
                    },
                    update: function() {
                        if (this._icon && this._map) {
                            var t = this._map.latLngToLayerPoint(this._latlng).round();
                            this._setPos(t);
                        }
                        return this;
                    },
                    _initIcon: function() {
                        var t = this.options,
                            e = "leaflet-zoom-" + (this._zoomAnimated ? "animated" : "hide"),
                            i = t.icon.createIcon(this._icon),
                            s = !1;
                        i !== this._icon &&
                            (this._icon && this._removeIcon(),
                                (s = !0),
                                t.title && (i.title = t.title),
                                i.tagName === "IMG" && (i.alt = t.alt || "")),
                            V(i, e),
                            t.keyboard &&
                            ((i.tabIndex = "0"), i.setAttribute("role", "button")),
                            (this._icon = i),
                            t.riseOnHover &&
                            this.on({
                                mouseover: this._bringToFront,
                                mouseout: this._resetZIndex,
                            }),
                            this.options.autoPanOnFocus &&
                            G(i, "focus", this._panOnFocus, this);
                        var l = t.icon.createShadow(this._shadow),
                            c = !1;
                        l !== this._shadow && (this._removeShadow(), (c = !0)),
                            l && (V(l, e), (l.alt = "")),
                            (this._shadow = l),
                            t.opacity < 1 && this._updateOpacity(),
                            s && this.getPane().appendChild(this._icon),
                            this._initInteraction(),
                            l && c && this.getPane(t.shadowPane).appendChild(this._shadow);
                    },
                    _removeIcon: function() {
                        this.options.riseOnHover &&
                            this.off({
                                mouseover: this._bringToFront,
                                mouseout: this._resetZIndex,
                            }),
                            this.options.autoPanOnFocus &&
                            Q(this._icon, "focus", this._panOnFocus, this),
                            et(this._icon),
                            this.removeInteractiveTarget(this._icon),
                            (this._icon = null);
                    },
                    _removeShadow: function() {
                        this._shadow && et(this._shadow), (this._shadow = null);
                    },
                    _setPos: function(t) {
                        this._icon && rt(this._icon, t),
                            this._shadow && rt(this._shadow, t),
                            (this._zIndex = t.y + this.options.zIndexOffset),
                            this._resetZIndex();
                    },
                    _updateZIndex: function(t) {
                        this._icon && (this._icon.style.zIndex = this._zIndex + t);
                    },
                    _animateZoom: function(t) {
                        var e = this._map
                            ._latLngToNewLayerPoint(this._latlng, t.zoom, t.center)
                            .round();
                        this._setPos(e);
                    },
                    _initInteraction: function() {
                        if (
                            this.options.interactive &&
                            (V(this._icon, "leaflet-interactive"),
                                this.addInteractiveTarget(this._icon),
                                zn)
                        ) {
                            var t = this.options.draggable;
                            this.dragging &&
                                ((t = this.dragging.enabled()), this.dragging.disable()),
                                (this.dragging = new zn(this)),
                                t && this.dragging.enable();
                        }
                    },
                    setOpacity: function(t) {
                        return (
                            (this.options.opacity = t), this._map && this._updateOpacity(), this
                        );
                    },
                    _updateOpacity: function() {
                        var t = this.options.opacity;
                        this._icon && xt(this._icon, t), this._shadow && xt(this._shadow, t);
                    },
                    _bringToFront: function() {
                        this._updateZIndex(this.options.riseOffset);
                    },
                    _resetZIndex: function() {
                        this._updateZIndex(0);
                    },
                    _panOnFocus: function() {
                        var t = this._map;
                        if (t) {
                            var e = this.options.icon.options,
                                i = e.iconSize ? Z(e.iconSize) : Z(0, 0),
                                s = e.iconAnchor ? Z(e.iconAnchor) : Z(0, 0);
                            t.panInside(this._latlng, {
                                paddingTopLeft: s,
                                paddingBottomRight: i.subtract(s),
                            });
                        }
                    },
                    _getPopupAnchor: function() {
                        return this.options.icon.options.popupAnchor;
                    },
                    _getTooltipAnchor: function() {
                        return this.options.icon.options.tooltipAnchor;
                    },
                });

            function Ts(t, e) {
                return new Ee(t, e);
            }
            var Gt = St.extend({
                    options: {
                        stroke: !0,
                        color: "#3388ff",
                        weight: 3,
                        opacity: 1,
                        lineCap: "round",
                        lineJoin: "round",
                        dashArray: null,
                        dashOffset: null,
                        fill: !1,
                        fillColor: null,
                        fillOpacity: 0.2,
                        fillRule: "evenodd",
                        interactive: !0,
                        bubblingMouseEvents: !0,
                    },
                    beforeAdd: function(t) {
                        this._renderer = t.getRenderer(this);
                    },
                    onAdd: function() {
                        this._renderer._initPath(this),
                            this._reset(),
                            this._renderer._addPath(this);
                    },
                    onRemove: function() {
                        this._renderer._removePath(this);
                    },
                    redraw: function() {
                        return this._map && this._renderer._updatePath(this), this;
                    },
                    setStyle: function(t) {
                        return (
                            b(this, t),
                            this._renderer &&
                            (this._renderer._updateStyle(this),
                                this.options.stroke &&
                                t &&
                                Object.prototype.hasOwnProperty.call(t, "weight") &&
                                this._updateBounds()),
                            this
                        );
                    },
                    bringToFront: function() {
                        return this._renderer && this._renderer._bringToFront(this), this;
                    },
                    bringToBack: function() {
                        return this._renderer && this._renderer._bringToBack(this), this;
                    },
                    getElement: function() {
                        return this._path;
                    },
                    _reset: function() {
                        this._project(), this._update();
                    },
                    _clickTolerance: function() {
                        return (
                            (this.options.stroke ? this.options.weight / 2 : 0) +
                            (this._renderer.options.tolerance || 0)
                        );
                    },
                }),
                Me = Gt.extend({
                    options: {
                        fill: !0,
                        radius: 10
                    },
                    initialize: function(t, e) {
                        b(this, e),
                            (this._latlng = U(t)),
                            (this._radius = this.options.radius);
                    },
                    setLatLng: function(t) {
                        var e = this._latlng;
                        return (
                            (this._latlng = U(t)),
                            this.redraw(),
                            this.fire("move", {
                                oldLatLng: e,
                                latlng: this._latlng
                            })
                        );
                    },
                    getLatLng: function() {
                        return this._latlng;
                    },
                    setRadius: function(t) {
                        return (this.options.radius = this._radius = t), this.redraw();
                    },
                    getRadius: function() {
                        return this._radius;
                    },
                    setStyle: function(t) {
                        var e = (t && t.radius) || this._radius;
                        return Gt.prototype.setStyle.call(this, t), this.setRadius(e), this;
                    },
                    _project: function() {
                        (this._point = this._map.latLngToLayerPoint(this._latlng)),
                        this._updateBounds();
                    },
                    _updateBounds: function() {
                        var t = this._radius,
                            e = this._radiusY || t,
                            i = this._clickTolerance(),
                            s = [t + i, e + i];
                        this._pxBounds = new $(this._point.subtract(s), this._point.add(s));
                    },
                    _update: function() {
                        this._map && this._updatePath();
                    },
                    _updatePath: function() {
                        this._renderer._updateCircle(this);
                    },
                    _empty: function() {
                        return (
                            this._radius && !this._renderer._bounds.intersects(this._pxBounds)
                        );
                    },
                    _containsPoint: function(t) {
                        return (
                            t.distanceTo(this._point) <= this._radius + this._clickTolerance()
                        );
                    },
                });

            function Ps(t, e) {
                return new Me(t, e);
            }
            var bi = Me.extend({
                initialize: function(t, e, i) {
                    if (
                        (typeof e == "number" && (e = d({}, i, {
                                radius: e
                            })),
                            b(this, e),
                            (this._latlng = U(t)),
                            isNaN(this.options.radius))
                    )
                        throw new Error("Circle radius cannot be NaN");
                    this._mRadius = this.options.radius;
                },
                setRadius: function(t) {
                    return (this._mRadius = t), this.redraw();
                },
                getRadius: function() {
                    return this._mRadius;
                },
                getBounds: function() {
                    var t = [this._radius, this._radiusY || this._radius];
                    return new pt(
                        this._map.layerPointToLatLng(this._point.subtract(t)),
                        this._map.layerPointToLatLng(this._point.add(t))
                    );
                },
                setStyle: Gt.prototype.setStyle,
                _project: function() {
                    var t = this._latlng.lng,
                        e = this._latlng.lat,
                        i = this._map,
                        s = i.options.crs;
                    if (s.distance === Ft.distance) {
                        var l = Math.PI / 180,
                            c = this._mRadius / Ft.R / l,
                            m = i.project([e + c, t]),
                            _ = i.project([e - c, t]),
                            x = m.add(_).divideBy(2),
                            S = i.unproject(x).lat,
                            k =
                            Math.acos(
                                (Math.cos(c * l) - Math.sin(e * l) * Math.sin(S * l)) /
                                (Math.cos(e * l) * Math.cos(S * l))
                            ) / l;
                        (isNaN(k) || k === 0) && (k = c / Math.cos((Math.PI / 180) * e)),
                        (this._point = x.subtract(i.getPixelOrigin())),
                        (this._radius = isNaN(k) ? 0 : x.x - i.project([S, t - k]).x),
                        (this._radiusY = x.y - m.y);
                    } else {
                        var F = s.unproject(
                            s.project(this._latlng).subtract([this._mRadius, 0])
                        );
                        (this._point = i.latLngToLayerPoint(this._latlng)),
                        (this._radius = this._point.x - i.latLngToLayerPoint(F).x);
                    }
                    this._updateBounds();
                },
            });

            function Ss(t, e, i) {
                return new bi(t, e, i);
            }
            var zt = Gt.extend({
                options: {
                    smoothFactor: 1,
                    noClip: !1
                },
                initialize: function(t, e) {
                    b(this, e), this._setLatLngs(t);
                },
                getLatLngs: function() {
                    return this._latlngs;
                },
                setLatLngs: function(t) {
                    return this._setLatLngs(t), this.redraw();
                },
                isEmpty: function() {
                    return !this._latlngs.length;
                },
                closestLayerPoint: function(t) {
                    for (
                        var e = 1 / 0, i = null, s = pe, l, c, m = 0, _ = this._parts.length; m < _; m++
                    )
                        for (var x = this._parts[m], S = 1, k = x.length; S < k; S++) {
                            (l = x[S - 1]), (c = x[S]);
                            var F = s(t, l, c, !0);
                            F < e && ((e = F), (i = s(t, l, c)));
                        }
                    return i && (i.distance = Math.sqrt(e)), i;
                },
                getCenter: function() {
                    if (!this._map)
                        throw new Error("Must add layer to map before using getCenter()");
                    return An(this._defaultShape(), this._map.options.crs);
                },
                getBounds: function() {
                    return this._bounds;
                },
                addLatLng: function(t, e) {
                    return (
                        (e = e || this._defaultShape()),
                        (t = U(t)),
                        e.push(t),
                        this._bounds.extend(t),
                        this.redraw()
                    );
                },
                _setLatLngs: function(t) {
                    (this._bounds = new pt()), (this._latlngs = this._convertLatLngs(t));
                },
                _defaultShape: function() {
                    return wt(this._latlngs) ? this._latlngs : this._latlngs[0];
                },
                _convertLatLngs: function(t) {
                    for (var e = [], i = wt(t), s = 0, l = t.length; s < l; s++)
                        i ?
                        ((e[s] = U(t[s])), this._bounds.extend(e[s])) :
                        (e[s] = this._convertLatLngs(t[s]));
                    return e;
                },
                _project: function() {
                    var t = new $();
                    (this._rings = []),
                    this._projectLatlngs(this._latlngs, this._rings, t),
                        this._bounds.isValid() &&
                        t.isValid() &&
                        ((this._rawPxBounds = t), this._updateBounds());
                },
                _updateBounds: function() {
                    var t = this._clickTolerance(),
                        e = new I(t, t);
                    this._rawPxBounds &&
                        (this._pxBounds = new $([
                            this._rawPxBounds.min.subtract(e),
                            this._rawPxBounds.max.add(e),
                        ]));
                },
                _projectLatlngs: function(t, e, i) {
                    var s = t[0] instanceof J,
                        l = t.length,
                        c,
                        m;
                    if (s) {
                        for (m = [], c = 0; c < l; c++)
                            (m[c] = this._map.latLngToLayerPoint(t[c])), i.extend(m[c]);
                        e.push(m);
                    } else
                        for (c = 0; c < l; c++) this._projectLatlngs(t[c], e, i);
                },
                _clipPoints: function() {
                    var t = this._renderer._bounds;
                    if (
                        ((this._parts = []),
                            !(!this._pxBounds || !this._pxBounds.intersects(t)))
                    ) {
                        if (this.options.noClip) {
                            this._parts = this._rings;
                            return;
                        }
                        var e = this._parts,
                            i,
                            s,
                            l,
                            c,
                            m,
                            _,
                            x;
                        for (i = 0, l = 0, c = this._rings.length; i < c; i++)
                            for (x = this._rings[i], s = 0, m = x.length; s < m - 1; s++)
                                (_ = In(x[s], x[s + 1], t, s, !0)),
                                _ &&
                                ((e[l] = e[l] || []),
                                    e[l].push(_[0]),
                                    (_[1] !== x[s + 1] || s === m - 2) && (e[l].push(_[1]), l++));
                    }
                },
                _simplifyPoints: function() {
                    for (
                        var t = this._parts,
                            e = this.options.smoothFactor,
                            i = 0,
                            s = t.length; i < s; i++
                    )
                        t[i] = En(t[i], e);
                },
                _update: function() {
                    this._map &&
                        (this._clipPoints(), this._simplifyPoints(), this._updatePath());
                },
                _updatePath: function() {
                    this._renderer._updatePoly(this);
                },
                _containsPoint: function(t, e) {
                    var i,
                        s,
                        l,
                        c,
                        m,
                        _,
                        x = this._clickTolerance();
                    if (!this._pxBounds || !this._pxBounds.contains(t)) return !1;
                    for (i = 0, c = this._parts.length; i < c; i++)
                        for (
                            _ = this._parts[i], s = 0, m = _.length, l = m - 1; s < m; l = s++
                        )
                            if (!(!e && s === 0) && Mn(t, _[l], _[s]) <= x) return !0;
                    return !1;
                },
            });

            function Ls(t, e) {
                return new zt(t, e);
            }
            zt._flat = kn;
            var te = zt.extend({
                options: {
                    fill: !0
                },
                isEmpty: function() {
                    return !this._latlngs.length || !this._latlngs[0].length;
                },
                getCenter: function() {
                    if (!this._map)
                        throw new Error("Must add layer to map before using getCenter()");
                    return Ln(this._defaultShape(), this._map.options.crs);
                },
                _convertLatLngs: function(t) {
                    var e = zt.prototype._convertLatLngs.call(this, t),
                        i = e.length;
                    return (
                        i >= 2 && e[0] instanceof J && e[0].equals(e[i - 1]) && e.pop(), e
                    );
                },
                _setLatLngs: function(t) {
                    zt.prototype._setLatLngs.call(this, t),
                        wt(this._latlngs) && (this._latlngs = [this._latlngs]);
                },
                _defaultShape: function() {
                    return wt(this._latlngs[0]) ? this._latlngs[0] : this._latlngs[0][0];
                },
                _clipPoints: function() {
                    var t = this._renderer._bounds,
                        e = this.options.weight,
                        i = new I(e, e);
                    if (
                        ((t = new $(t.min.subtract(i), t.max.add(i))),
                            (this._parts = []),
                            !(!this._pxBounds || !this._pxBounds.intersects(t)))
                    ) {
                        if (this.options.noClip) {
                            this._parts = this._rings;
                            return;
                        }
                        for (var s = 0, l = this._rings.length, c; s < l; s++)
                            (c = Sn(this._rings[s], t, !0)), c.length && this._parts.push(c);
                    }
                },
                _updatePath: function() {
                    this._renderer._updatePoly(this, !0);
                },
                _containsPoint: function(t) {
                    var e = !1,
                        i,
                        s,
                        l,
                        c,
                        m,
                        _,
                        x,
                        S;
                    if (!this._pxBounds || !this._pxBounds.contains(t)) return !1;
                    for (c = 0, x = this._parts.length; c < x; c++)
                        for (
                            i = this._parts[c], m = 0, S = i.length, _ = S - 1; m < S; _ = m++
                        )
                            (s = i[m]),
                            (l = i[_]),
                            s.y > t.y != l.y > t.y &&
                            t.x < ((l.x - s.x) * (t.y - s.y)) / (l.y - s.y) + s.x &&
                            (e = !e);
                    return e || zt.prototype._containsPoint.call(this, t, !0);
                },
            });

            function Es(t, e) {
                return new te(t, e);
            }
            var Bt = Ot.extend({
                initialize: function(t, e) {
                    b(this, e), (this._layers = {}), t && this.addData(t);
                },
                addData: function(t) {
                    var e = M(t) ? t : t.features,
                        i,
                        s,
                        l;
                    if (e) {
                        for (i = 0, s = e.length; i < s; i++)
                            (l = e[i]),
                            (l.geometries || l.geometry || l.features || l.coordinates) &&
                            this.addData(l);
                        return this;
                    }
                    var c = this.options;
                    if (c.filter && !c.filter(t)) return this;
                    var m = Ce(t, c);
                    return m ?
                        ((m.feature = Ae(t)),
                            (m.defaultOptions = m.options),
                            this.resetStyle(m),
                            c.onEachFeature && c.onEachFeature(t, m),
                            this.addLayer(m)) :
                        this;
                },
                resetStyle: function(t) {
                    return t === void 0 ?
                        this.eachLayer(this.resetStyle, this) :
                        ((t.options = d({}, t.defaultOptions)),
                            this._setLayerStyle(t, this.options.style),
                            this);
                },
                setStyle: function(t) {
                    return this.eachLayer(function(e) {
                        this._setLayerStyle(e, t);
                    }, this);
                },
                _setLayerStyle: function(t, e) {
                    t.setStyle &&
                        (typeof e == "function" && (e = e(t.feature)), t.setStyle(e));
                },
            });

            function Ce(t, e) {
                var i = t.type === "Feature" ? t.geometry : t,
                    s = i ? i.coordinates : null,
                    l = [],
                    c = e && e.pointToLayer,
                    m = (e && e.coordsToLatLng) || xi,
                    _,
                    x,
                    S,
                    k;
                if (!s && !i) return null;
                switch (i.type) {
                    case "Point":
                        return (_ = m(s)), Bn(c, t, _, e);
                    case "MultiPoint":
                        for (S = 0, k = s.length; S < k; S++)
                            (_ = m(s[S])), l.push(Bn(c, t, _, e));
                        return new Ot(l);
                    case "LineString":
                    case "MultiLineString":
                        return (x = Ie(s, i.type === "LineString" ? 0 : 1, m)), new zt(x, e);
                    case "Polygon":
                    case "MultiPolygon":
                        return (x = Ie(s, i.type === "Polygon" ? 1 : 2, m)), new te(x, e);
                    case "GeometryCollection":
                        for (S = 0, k = i.geometries.length; S < k; S++) {
                            var F = Ce({
                                    geometry: i.geometries[S],
                                    type: "Feature",
                                    properties: t.properties,
                                },
                                e
                            );
                            F && l.push(F);
                        }
                        return new Ot(l);
                    case "FeatureCollection":
                        for (S = 0, k = i.features.length; S < k; S++) {
                            var W = Ce(i.features[S], e);
                            W && l.push(W);
                        }
                        return new Ot(l);
                    default:
                        throw new Error("Invalid GeoJSON object.");
                }
            }

            function Bn(t, e, i, s) {
                return t ? t(e, i) : new Ee(i, s && s.markersInheritOptions && s);
            }

            function xi(t) {
                return new J(t[1], t[0], t[2]);
            }

            function Ie(t, e, i) {
                for (var s = [], l = 0, c = t.length, m; l < c; l++)
                    (m = e ? Ie(t[l], e - 1, i) : (i || xi)(t[l])), s.push(m);
                return s;
            }

            function wi(t, e) {
                return (
                    (t = U(t)),
                    t.alt !== void 0 ? [P(t.lng, e), P(t.lat, e), P(t.alt, e)] : [P(t.lng, e), P(t.lat, e)]
                );
            }

            function ke(t, e, i, s) {
                for (var l = [], c = 0, m = t.length; c < m; c++)
                    l.push(e ? ke(t[c], wt(t[c]) ? 0 : e - 1, i, s) : wi(t[c], s));
                return !e && i && l.length > 0 && l.push(l[0].slice()), l;
            }

            function ee(t, e) {
                return t.feature ? d({}, t.feature, {
                    geometry: e
                }) : Ae(e);
            }

            function Ae(t) {
                return t.type === "Feature" || t.type === "FeatureCollection" ?
                    t : {
                        type: "Feature",
                        properties: {},
                        geometry: t
                    };
            }
            var Ti = {
                toGeoJSON: function(t) {
                    return ee(this, {
                        type: "Point",
                        coordinates: wi(this.getLatLng(), t),
                    });
                },
            };
            Ee.include(Ti),
                bi.include(Ti),
                Me.include(Ti),
                zt.include({
                    toGeoJSON: function(t) {
                        var e = !wt(this._latlngs),
                            i = ke(this._latlngs, e ? 1 : 0, !1, t);
                        return ee(this, {
                            type: (e ? "Multi" : "") + "LineString",
                            coordinates: i,
                        });
                    },
                }),
                te.include({
                    toGeoJSON: function(t) {
                        var e = !wt(this._latlngs),
                            i = e && !wt(this._latlngs[0]),
                            s = ke(this._latlngs, i ? 2 : e ? 1 : 0, !0, t);
                        return (
                            e || (s = [s]),
                            ee(this, {
                                type: (i ? "Multi" : "") + "Polygon",
                                coordinates: s
                            })
                        );
                    },
                }),
                Jt.include({
                    toMultiPoint: function(t) {
                        var e = [];
                        return (
                            this.eachLayer(function(i) {
                                e.push(i.toGeoJSON(t).geometry.coordinates);
                            }),
                            ee(this, {
                                type: "MultiPoint",
                                coordinates: e
                            })
                        );
                    },
                    toGeoJSON: function(t) {
                        var e =
                            this.feature && this.feature.geometry && this.feature.geometry.type;
                        if (e === "MultiPoint") return this.toMultiPoint(t);
                        var i = e === "GeometryCollection",
                            s = [];
                        return (
                            this.eachLayer(function(l) {
                                if (l.toGeoJSON) {
                                    var c = l.toGeoJSON(t);
                                    if (i) s.push(c.geometry);
                                    else {
                                        var m = Ae(c);
                                        m.type === "FeatureCollection" ?
                                            s.push.apply(s, m.features) :
                                            s.push(m);
                                    }
                                }
                            }),
                            i ?
                            ee(this, {
                                geometries: s,
                                type: "GeometryCollection"
                            }) : {
                                type: "FeatureCollection",
                                features: s
                            }
                        );
                    },
                });

            function Zn(t, e) {
                return new Bt(t, e);
            }
            var Ms = Zn,
                Oe = St.extend({
                    options: {
                        opacity: 1,
                        alt: "",
                        interactive: !1,
                        crossOrigin: !1,
                        errorOverlayUrl: "",
                        zIndex: 1,
                        className: "",
                    },
                    initialize: function(t, e, i) {
                        (this._url = t), (this._bounds = nt(e)), b(this, i);
                    },
                    onAdd: function() {
                        this._image ||
                            (this._initImage(),
                                this.options.opacity < 1 && this._updateOpacity()),
                            this.options.interactive &&
                            (V(this._image, "leaflet-interactive"),
                                this.addInteractiveTarget(this._image)),
                            this.getPane().appendChild(this._image),
                            this._reset();
                    },
                    onRemove: function() {
                        et(this._image),
                            this.options.interactive &&
                            this.removeInteractiveTarget(this._image);
                    },
                    setOpacity: function(t) {
                        return (
                            (this.options.opacity = t),
                            this._image && this._updateOpacity(),
                            this
                        );
                    },
                    setStyle: function(t) {
                        return t.opacity && this.setOpacity(t.opacity), this;
                    },
                    bringToFront: function() {
                        return this._map && $t(this._image), this;
                    },
                    bringToBack: function() {
                        return this._map && Kt(this._image), this;
                    },
                    setUrl: function(t) {
                        return (this._url = t), this._image && (this._image.src = t), this;
                    },
                    setBounds: function(t) {
                        return (this._bounds = nt(t)), this._map && this._reset(), this;
                    },
                    getEvents: function() {
                        var t = {
                            zoom: this._reset,
                            viewreset: this._reset
                        };
                        return this._zoomAnimated && (t.zoomanim = this._animateZoom), t;
                    },
                    setZIndex: function(t) {
                        return (this.options.zIndex = t), this._updateZIndex(), this;
                    },
                    getBounds: function() {
                        return this._bounds;
                    },
                    getElement: function() {
                        return this._image;
                    },
                    _initImage: function() {
                        var t = this._url.tagName === "IMG",
                            e = (this._image = t ? this._url : X("img"));
                        if (
                            (V(e, "leaflet-image-layer"),
                                this._zoomAnimated && V(e, "leaflet-zoom-animated"),
                                this.options.className && V(e, this.options.className),
                                (e.onselectstart = v),
                                (e.onmousemove = v),
                                (e.onload = f(this.fire, this, "load")),
                                (e.onerror = f(this._overlayOnError, this, "error")),
                                (this.options.crossOrigin || this.options.crossOrigin === "") &&
                                (e.crossOrigin =
                                    this.options.crossOrigin === !0 ?
                                    "" :
                                    this.options.crossOrigin),
                                this.options.zIndex && this._updateZIndex(),
                                t)
                        ) {
                            this._url = e.src;
                            return;
                        }
                        (e.src = this._url), (e.alt = this.options.alt);
                    },
                    _animateZoom: function(t) {
                        var e = this._map.getZoomScale(t.zoom),
                            i = this._map._latLngBoundsToNewLayerBounds(
                                this._bounds,
                                t.zoom,
                                t.center
                            ).min;
                        Wt(this._image, i, e);
                    },
                    _reset: function() {
                        var t = this._image,
                            e = new $(
                                this._map.latLngToLayerPoint(this._bounds.getNorthWest()),
                                this._map.latLngToLayerPoint(this._bounds.getSouthEast())
                            ),
                            i = e.getSize();
                        rt(t, e.min),
                            (t.style.width = i.x + "px"),
                            (t.style.height = i.y + "px");
                    },
                    _updateOpacity: function() {
                        xt(this._image, this.options.opacity);
                    },
                    _updateZIndex: function() {
                        this._image &&
                            this.options.zIndex !== void 0 &&
                            this.options.zIndex !== null &&
                            (this._image.style.zIndex = this.options.zIndex);
                    },
                    _overlayOnError: function() {
                        this.fire("error");
                        var t = this.options.errorOverlayUrl;
                        t && this._url !== t && ((this._url = t), (this._image.src = t));
                    },
                    getCenter: function() {
                        return this._bounds.getCenter();
                    },
                }),
                Cs = function(t, e, i) {
                    return new Oe(t, e, i);
                },
                Dn = Oe.extend({
                    options: {
                        autoplay: !0,
                        loop: !0,
                        keepAspectRatio: !0,
                        muted: !1,
                        playsInline: !0,
                    },
                    _initImage: function() {
                        var t = this._url.tagName === "VIDEO",
                            e = (this._image = t ? this._url : X("video"));
                        if (
                            (V(e, "leaflet-image-layer"),
                                this._zoomAnimated && V(e, "leaflet-zoom-animated"),
                                this.options.className && V(e, this.options.className),
                                (e.onselectstart = v),
                                (e.onmousemove = v),
                                (e.onloadeddata = f(this.fire, this, "load")),
                                t)
                        ) {
                            for (
                                var i = e.getElementsByTagName("source"), s = [], l = 0; l < i.length; l++
                            )
                                s.push(i[l].src);
                            this._url = i.length > 0 ? s : [e.src];
                            return;
                        }
                        M(this._url) || (this._url = [this._url]),
                            !this.options.keepAspectRatio &&
                            Object.prototype.hasOwnProperty.call(e.style, "objectFit") &&
                            (e.style.objectFit = "fill"),
                            (e.autoplay = !!this.options.autoplay),
                            (e.loop = !!this.options.loop),
                            (e.muted = !!this.options.muted),
                            (e.playsInline = !!this.options.playsInline);
                        for (var c = 0; c < this._url.length; c++) {
                            var m = X("source");
                            (m.src = this._url[c]), e.appendChild(m);
                        }
                    },
                });

            function Is(t, e, i) {
                return new Dn(t, e, i);
            }
            var Nn = Oe.extend({
                _initImage: function() {
                    var t = (this._image = this._url);
                    V(t, "leaflet-image-layer"),
                        this._zoomAnimated && V(t, "leaflet-zoom-animated"),
                        this.options.className && V(t, this.options.className),
                        (t.onselectstart = v),
                        (t.onmousemove = v);
                },
            });

            function ks(t, e, i) {
                return new Nn(t, e, i);
            }
            var Ct = St.extend({
                options: {
                    interactive: !1,
                    offset: [0, 0],
                    className: "",
                    pane: void 0,
                    content: "",
                },
                initialize: function(t, e) {
                    t && (t instanceof J || M(t)) ?
                        ((this._latlng = U(t)), b(this, e)) :
                        (b(this, t), (this._source = e)),
                        this.options.content && (this._content = this.options.content);
                },
                openOn: function(t) {
                    return (
                        (t = arguments.length ? t : this._source._map),
                        t.hasLayer(this) || t.addLayer(this),
                        this
                    );
                },
                close: function() {
                    return this._map && this._map.removeLayer(this), this;
                },
                toggle: function(t) {
                    return (
                        this._map ?
                        this.close() :
                        (arguments.length ? (this._source = t) : (t = this._source),
                            this._prepareOpen(),
                            this.openOn(t._map)),
                        this
                    );
                },
                onAdd: function(t) {
                    (this._zoomAnimated = t._zoomAnimated),
                    this._container || this._initLayout(),
                        t._fadeAnimated && xt(this._container, 0),
                        clearTimeout(this._removeTimeout),
                        this.getPane().appendChild(this._container),
                        this.update(),
                        t._fadeAnimated && xt(this._container, 1),
                        this.bringToFront(),
                        this.options.interactive &&
                        (V(this._container, "leaflet-interactive"),
                            this.addInteractiveTarget(this._container));
                },
                onRemove: function(t) {
                    t._fadeAnimated ?
                        (xt(this._container, 0),
                            (this._removeTimeout = setTimeout(
                                f(et, void 0, this._container),
                                200
                            ))) :
                        et(this._container),
                        this.options.interactive &&
                        (it(this._container, "leaflet-interactive"),
                            this.removeInteractiveTarget(this._container));
                },
                getLatLng: function() {
                    return this._latlng;
                },
                setLatLng: function(t) {
                    return (
                        (this._latlng = U(t)),
                        this._map && (this._updatePosition(), this._adjustPan()),
                        this
                    );
                },
                getContent: function() {
                    return this._content;
                },
                setContent: function(t) {
                    return (this._content = t), this.update(), this;
                },
                getElement: function() {
                    return this._container;
                },
                update: function() {
                    this._map &&
                        ((this._container.style.visibility = "hidden"),
                            this._updateContent(),
                            this._updateLayout(),
                            this._updatePosition(),
                            (this._container.style.visibility = ""),
                            this._adjustPan());
                },
                getEvents: function() {
                    var t = {
                        zoom: this._updatePosition,
                        viewreset: this._updatePosition
                    };
                    return this._zoomAnimated && (t.zoomanim = this._animateZoom), t;
                },
                isOpen: function() {
                    return !!this._map && this._map.hasLayer(this);
                },
                bringToFront: function() {
                    return this._map && $t(this._container), this;
                },
                bringToBack: function() {
                    return this._map && Kt(this._container), this;
                },
                _prepareOpen: function(t) {
                    var e = this._source;
                    if (!e._map) return !1;
                    if (e instanceof Ot) {
                        e = null;
                        var i = this._source._layers;
                        for (var s in i)
                            if (i[s]._map) {
                                e = i[s];
                                break;
                            }
                        if (!e) return !1;
                        this._source = e;
                    }
                    if (!t)
                        if (e.getCenter) t = e.getCenter();
                        else if (e.getLatLng) t = e.getLatLng();
                    else if (e.getBounds) t = e.getBounds().getCenter();
                    else throw new Error("Unable to get source layer LatLng.");
                    return this.setLatLng(t), this._map && this.update(), !0;
                },
                _updateContent: function() {
                    if (this._content) {
                        var t = this._contentNode,
                            e =
                            typeof this._content == "function" ?
                            this._content(this._source || this) :
                            this._content;
                        if (typeof e == "string") t.innerHTML = e;
                        else {
                            for (; t.hasChildNodes();) t.removeChild(t.firstChild);
                            t.appendChild(e);
                        }
                        this.fire("contentupdate");
                    }
                },
                _updatePosition: function() {
                    if (this._map) {
                        var t = this._map.latLngToLayerPoint(this._latlng),
                            e = Z(this.options.offset),
                            i = this._getAnchor();
                        this._zoomAnimated ?
                            rt(this._container, t.add(i)) :
                            (e = e.add(t).add(i));
                        var s = (this._containerBottom = -e.y),
                            l = (this._containerLeft = -Math.round(this._containerWidth / 2) + e.x);
                        (this._container.style.bottom = s + "px"),
                        (this._container.style.left = l + "px");
                    }
                },
                _getAnchor: function() {
                    return [0, 0];
                },
            });
            Y.include({
                    _initOverlay: function(t, e, i, s) {
                        var l = e;
                        return (
                            l instanceof t || (l = new t(s).setContent(e)), i && l.setLatLng(i), l
                        );
                    },
                }),
                St.include({
                    _initOverlay: function(t, e, i, s) {
                        var l = i;
                        return (
                            l instanceof t ?
                            (b(l, s), (l._source = this)) :
                            ((l = e && !s ? e : new t(s, this)), l.setContent(i)),
                            l
                        );
                    },
                });
            var ze = Ct.extend({
                    options: {
                        pane: "popupPane",
                        offset: [0, 7],
                        maxWidth: 300,
                        minWidth: 50,
                        maxHeight: null,
                        autoPan: !0,
                        autoPanPaddingTopLeft: null,
                        autoPanPaddingBottomRight: null,
                        autoPanPadding: [5, 5],
                        keepInView: !1,
                        closeButton: !0,
                        autoClose: !0,
                        closeOnEscapeKey: !0,
                        className: "",
                    },
                    openOn: function(t) {
                        return (
                            (t = arguments.length ? t : this._source._map),
                            !t.hasLayer(this) &&
                            t._popup &&
                            t._popup.options.autoClose &&
                            t.removeLayer(t._popup),
                            (t._popup = this),
                            Ct.prototype.openOn.call(this, t)
                        );
                    },
                    onAdd: function(t) {
                        Ct.prototype.onAdd.call(this, t),
                            t.fire("popupopen", {
                                popup: this
                            }),
                            this._source &&
                            (this._source.fire("popupopen", {
                                    popup: this
                                }, !0),
                                this._source instanceof Gt || this._source.on("preclick", qt));
                    },
                    onRemove: function(t) {
                        Ct.prototype.onRemove.call(this, t),
                            t.fire("popupclose", {
                                popup: this
                            }),
                            this._source &&
                            (this._source.fire("popupclose", {
                                    popup: this
                                }, !0),
                                this._source instanceof Gt || this._source.off("preclick", qt));
                    },
                    getEvents: function() {
                        var t = Ct.prototype.getEvents.call(this);
                        return (
                            (this.options.closeOnClick !== void 0 ?
                                this.options.closeOnClick :
                                this._map.options.closePopupOnClick) &&
                            (t.preclick = this.close),
                            this.options.keepInView && (t.moveend = this._adjustPan),
                            t
                        );
                    },
                    _initLayout: function() {
                        var t = "leaflet-popup",
                            e = (this._container = X(
                                "div",
                                t +
                                " " +
                                (this.options.className || "") +
                                " leaflet-zoom-animated"
                            )),
                            i = (this._wrapper = X("div", t + "-content-wrapper", e));
                        if (
                            ((this._contentNode = X("div", t + "-content", i)),
                                he(e),
                                hi(this._contentNode),
                                G(e, "contextmenu", qt),
                                (this._tipContainer = X("div", t + "-tip-container", e)),
                                (this._tip = X("div", t + "-tip", this._tipContainer)),
                                this.options.closeButton)
                        ) {
                            var s = (this._closeButton = X("a", t + "-close-button", e));
                            s.setAttribute("role", "button"),
                                s.setAttribute("aria-label", "Close popup"),
                                (s.href = "#close"),
                                (s.innerHTML = '<span aria-hidden="true">&#215;</span>'),
                                G(
                                    s,
                                    "click",
                                    function(l) {
                                        ut(l), this.close();
                                    },
                                    this
                                );
                        }
                    },
                    _updateLayout: function() {
                        var t = this._contentNode,
                            e = t.style;
                        (e.width = ""), (e.whiteSpace = "nowrap");
                        var i = t.offsetWidth;
                        (i = Math.min(i, this.options.maxWidth)),
                        (i = Math.max(i, this.options.minWidth)),
                        (e.width = i + 1 + "px"),
                        (e.whiteSpace = ""),
                        (e.height = "");
                        var s = t.offsetHeight,
                            l = this.options.maxHeight,
                            c = "leaflet-popup-scrolled";
                        l && s > l ? ((e.height = l + "px"), V(t, c)) : it(t, c),
                            (this._containerWidth = this._container.offsetWidth);
                    },
                    _animateZoom: function(t) {
                        var e = this._map._latLngToNewLayerPoint(
                                this._latlng,
                                t.zoom,
                                t.center
                            ),
                            i = this._getAnchor();
                        rt(this._container, e.add(i));
                    },
                    _adjustPan: function() {
                        if (this.options.autoPan) {
                            if (
                                (this._map._panAnim && this._map._panAnim.stop(),
                                    this._autopanning)
                            ) {
                                this._autopanning = !1;
                                return;
                            }
                            var t = this._map,
                                e = parseInt(le(this._container, "marginBottom"), 10) || 0,
                                i = this._container.offsetHeight + e,
                                s = this._containerWidth,
                                l = new I(this._containerLeft, -i - this._containerBottom);
                            l._add(jt(this._container));
                            var c = t.layerPointToContainerPoint(l),
                                m = Z(this.options.autoPanPadding),
                                _ = Z(this.options.autoPanPaddingTopLeft || m),
                                x = Z(this.options.autoPanPaddingBottomRight || m),
                                S = t.getSize(),
                                k = 0,
                                F = 0;
                            c.x + s + x.x > S.x && (k = c.x + s - S.x + x.x),
                                c.x - k - _.x < 0 && (k = c.x - _.x),
                                c.y + i + x.y > S.y && (F = c.y + i - S.y + x.y),
                                c.y - F - _.y < 0 && (F = c.y - _.y),
                                (k || F) &&
                                (this.options.keepInView && (this._autopanning = !0),
                                    t.fire("autopanstart").panBy([k, F]));
                        }
                    },
                    _getAnchor: function() {
                        return Z(
                            this._source && this._source._getPopupAnchor ?
                            this._source._getPopupAnchor() : [0, 0]
                        );
                    },
                }),
                As = function(t, e) {
                    return new ze(t, e);
                };
            Y.mergeOptions({
                    closePopupOnClick: !0
                }),
                Y.include({
                    openPopup: function(t, e, i) {
                        return this._initOverlay(ze, t, e, i).openOn(this), this;
                    },
                    closePopup: function(t) {
                        return (t = arguments.length ? t : this._popup), t && t.close(), this;
                    },
                }),
                St.include({
                    bindPopup: function(t, e) {
                        return (
                            (this._popup = this._initOverlay(ze, this._popup, t, e)),
                            this._popupHandlersAdded ||
                            (this.on({
                                    click: this._openPopup,
                                    keypress: this._onKeyPress,
                                    remove: this.closePopup,
                                    move: this._movePopup,
                                }),
                                (this._popupHandlersAdded = !0)),
                            this
                        );
                    },
                    unbindPopup: function() {
                        return (
                            this._popup &&
                            (this.off({
                                    click: this._openPopup,
                                    keypress: this._onKeyPress,
                                    remove: this.closePopup,
                                    move: this._movePopup,
                                }),
                                (this._popupHandlersAdded = !1),
                                (this._popup = null)),
                            this
                        );
                    },
                    openPopup: function(t) {
                        return (
                            this._popup &&
                            (this instanceof Ot || (this._popup._source = this),
                                this._popup._prepareOpen(t || this._latlng) &&
                                this._popup.openOn(this._map)),
                            this
                        );
                    },
                    closePopup: function() {
                        return this._popup && this._popup.close(), this;
                    },
                    togglePopup: function() {
                        return this._popup && this._popup.toggle(this), this;
                    },
                    isPopupOpen: function() {
                        return this._popup ? this._popup.isOpen() : !1;
                    },
                    setPopupContent: function(t) {
                        return this._popup && this._popup.setContent(t), this;
                    },
                    getPopup: function() {
                        return this._popup;
                    },
                    _openPopup: function(t) {
                        if (!(!this._popup || !this._map)) {
                            Ut(t);
                            var e = t.layer || t.target;
                            if (this._popup._source === e && !(e instanceof Gt)) {
                                this._map.hasLayer(this._popup) ?
                                    this.closePopup() :
                                    this.openPopup(t.latlng);
                                return;
                            }
                            (this._popup._source = e), this.openPopup(t.latlng);
                        }
                    },
                    _movePopup: function(t) {
                        this._popup.setLatLng(t.latlng);
                    },
                    _onKeyPress: function(t) {
                        t.originalEvent.keyCode === 13 && this._openPopup(t);
                    },
                });
            var Be = Ct.extend({
                    options: {
                        pane: "tooltipPane",
                        offset: [0, 0],
                        direction: "auto",
                        permanent: !1,
                        sticky: !1,
                        opacity: 0.9,
                    },
                    onAdd: function(t) {
                        Ct.prototype.onAdd.call(this, t),
                            this.setOpacity(this.options.opacity),
                            t.fire("tooltipopen", {
                                tooltip: this
                            }),
                            this._source &&
                            (this.addEventParent(this._source),
                                this._source.fire("tooltipopen", {
                                    tooltip: this
                                }, !0));
                    },
                    onRemove: function(t) {
                        Ct.prototype.onRemove.call(this, t),
                            t.fire("tooltipclose", {
                                tooltip: this
                            }),
                            this._source &&
                            (this.removeEventParent(this._source),
                                this._source.fire("tooltipclose", {
                                    tooltip: this
                                }, !0));
                    },
                    getEvents: function() {
                        var t = Ct.prototype.getEvents.call(this);
                        return this.options.permanent || (t.preclick = this.close), t;
                    },
                    _initLayout: function() {
                        var t = "leaflet-tooltip",
                            e =
                            t +
                            " " +
                            (this.options.className || "") +
                            " leaflet-zoom-" +
                            (this._zoomAnimated ? "animated" : "hide");
                        (this._contentNode = this._container = X("div", e)),
                        this._container.setAttribute("role", "tooltip"),
                            this._container.setAttribute("id", "leaflet-tooltip-" + h(this));
                    },
                    _updateLayout: function() {},
                    _adjustPan: function() {},
                    _setPosition: function(t) {
                        var e,
                            i,
                            s = this._map,
                            l = this._container,
                            c = s.latLngToContainerPoint(s.getCenter()),
                            m = s.layerPointToContainerPoint(t),
                            _ = this.options.direction,
                            x = l.offsetWidth,
                            S = l.offsetHeight,
                            k = Z(this.options.offset),
                            F = this._getAnchor();
                        _ === "top" ?
                            ((e = x / 2), (i = S)) :
                            _ === "bottom" ?
                            ((e = x / 2), (i = 0)) :
                            _ === "center" ?
                            ((e = x / 2), (i = S / 2)) :
                            _ === "right" ?
                            ((e = 0), (i = S / 2)) :
                            _ === "left" ?
                            ((e = x), (i = S / 2)) :
                            m.x < c.x ?
                            ((_ = "right"), (e = 0), (i = S / 2)) :
                            ((_ = "left"), (e = x + (k.x + F.x) * 2), (i = S / 2)),
                            (t = t.subtract(Z(e, i, !0)).add(k).add(F)),
                            it(l, "leaflet-tooltip-right"),
                            it(l, "leaflet-tooltip-left"),
                            it(l, "leaflet-tooltip-top"),
                            it(l, "leaflet-tooltip-bottom"),
                            V(l, "leaflet-tooltip-" + _),
                            rt(l, t);
                    },
                    _updatePosition: function() {
                        var t = this._map.latLngToLayerPoint(this._latlng);
                        this._setPosition(t);
                    },
                    setOpacity: function(t) {
                        (this.options.opacity = t), this._container && xt(this._container, t);
                    },
                    _animateZoom: function(t) {
                        var e = this._map._latLngToNewLayerPoint(
                            this._latlng,
                            t.zoom,
                            t.center
                        );
                        this._setPosition(e);
                    },
                    _getAnchor: function() {
                        return Z(
                            this._source &&
                            this._source._getTooltipAnchor &&
                            !this.options.sticky ?
                            this._source._getTooltipAnchor() : [0, 0]
                        );
                    },
                }),
                Os = function(t, e) {
                    return new Be(t, e);
                };
            Y.include({
                    openTooltip: function(t, e, i) {
                        return this._initOverlay(Be, t, e, i).openOn(this), this;
                    },
                    closeTooltip: function(t) {
                        return t.close(), this;
                    },
                }),
                St.include({
                    bindTooltip: function(t, e) {
                        return (
                            this._tooltip && this.isTooltipOpen() && this.unbindTooltip(),
                            (this._tooltip = this._initOverlay(Be, this._tooltip, t, e)),
                            this._initTooltipInteractions(),
                            this._tooltip.options.permanent &&
                            this._map &&
                            this._map.hasLayer(this) &&
                            this.openTooltip(),
                            this
                        );
                    },
                    unbindTooltip: function() {
                        return (
                            this._tooltip &&
                            (this._initTooltipInteractions(!0),
                                this.closeTooltip(),
                                (this._tooltip = null)),
                            this
                        );
                    },
                    _initTooltipInteractions: function(t) {
                        if (!(!t && this._tooltipHandlersAdded)) {
                            var e = t ? "off" : "on",
                                i = {
                                    remove: this.closeTooltip,
                                    move: this._moveTooltip
                                };
                            this._tooltip.options.permanent ?
                                (i.add = this._openTooltip) :
                                ((i.mouseover = this._openTooltip),
                                    (i.mouseout = this.closeTooltip),
                                    (i.click = this._openTooltip),
                                    this._map ?
                                    this._addFocusListeners() :
                                    (i.add = this._addFocusListeners)),
                                this._tooltip.options.sticky && (i.mousemove = this._moveTooltip),
                                this[e](i),
                                (this._tooltipHandlersAdded = !t);
                        }
                    },
                    openTooltip: function(t) {
                        return (
                            this._tooltip &&
                            (this instanceof Ot || (this._tooltip._source = this),
                                this._tooltip._prepareOpen(t) &&
                                (this._tooltip.openOn(this._map),
                                    this.getElement ?
                                    this._setAriaDescribedByOnLayer(this) :
                                    this.eachLayer &&
                                    this.eachLayer(this._setAriaDescribedByOnLayer, this))),
                            this
                        );
                    },
                    closeTooltip: function() {
                        if (this._tooltip) return this._tooltip.close();
                    },
                    toggleTooltip: function() {
                        return this._tooltip && this._tooltip.toggle(this), this;
                    },
                    isTooltipOpen: function() {
                        return this._tooltip.isOpen();
                    },
                    setTooltipContent: function(t) {
                        return this._tooltip && this._tooltip.setContent(t), this;
                    },
                    getTooltip: function() {
                        return this._tooltip;
                    },
                    _addFocusListeners: function() {
                        this.getElement ?
                            this._addFocusListenersOnLayer(this) :
                            this.eachLayer &&
                            this.eachLayer(this._addFocusListenersOnLayer, this);
                    },
                    _addFocusListenersOnLayer: function(t) {
                        var e = typeof t.getElement == "function" && t.getElement();
                        e &&
                            (G(
                                    e,
                                    "focus",
                                    function() {
                                        (this._tooltip._source = t), this.openTooltip();
                                    },
                                    this
                                ),
                                G(e, "blur", this.closeTooltip, this));
                    },
                    _setAriaDescribedByOnLayer: function(t) {
                        var e = typeof t.getElement == "function" && t.getElement();
                        e && e.setAttribute("aria-describedby", this._tooltip._container.id);
                    },
                    _openTooltip: function(t) {
                        if (!(!this._tooltip || !this._map)) {
                            if (
                                this._map.dragging &&
                                this._map.dragging.moving() &&
                                !this._openOnceFlag
                            ) {
                                this._openOnceFlag = !0;
                                var e = this;
                                this._map.once("moveend", function() {
                                    (e._openOnceFlag = !1), e._openTooltip(t);
                                });
                                return;
                            }
                            (this._tooltip._source = t.layer || t.target),
                            this.openTooltip(
                                this._tooltip.options.sticky ? t.latlng : void 0
                            );
                        }
                    },
                    _moveTooltip: function(t) {
                        var e = t.latlng,
                            i,
                            s;
                        this._tooltip.options.sticky &&
                            t.originalEvent &&
                            ((i = this._map.mouseEventToContainerPoint(t.originalEvent)),
                                (s = this._map.containerPointToLayerPoint(i)),
                                (e = this._map.layerPointToLatLng(s))),
                            this._tooltip.setLatLng(e);
                    },
                });
            var Rn = Qt.extend({
                options: {
                    iconSize: [12, 12],
                    html: !1,
                    bgPos: null,
                    className: "leaflet-div-icon",
                },
                createIcon: function(t) {
                    var e = t && t.tagName === "DIV" ? t : document.createElement("div"),
                        i = this.options;
                    if (
                        (i.html instanceof Element ?
                            (xe(e), e.appendChild(i.html)) :
                            (e.innerHTML = i.html !== !1 ? i.html : ""),
                            i.bgPos)
                    ) {
                        var s = Z(i.bgPos);
                        e.style.backgroundPosition = -s.x + "px " + -s.y + "px";
                    }
                    return this._setIconStyles(e, "icon"), e;
                },
                createShadow: function() {
                    return null;
                },
            });

            function zs(t) {
                return new Rn(t);
            }
            Qt.Default = me;
            var _e = St.extend({
                options: {
                    tileSize: 256,
                    opacity: 1,
                    updateWhenIdle: N.mobile,
                    updateWhenZooming: !0,
                    updateInterval: 200,
                    zIndex: 1,
                    bounds: null,
                    minZoom: 0,
                    maxZoom: void 0,
                    maxNativeZoom: void 0,
                    minNativeZoom: void 0,
                    noWrap: !1,
                    pane: "tilePane",
                    className: "",
                    keepBuffer: 2,
                },
                initialize: function(t) {
                    b(this, t);
                },
                onAdd: function() {
                    this._initContainer(),
                        (this._levels = {}),
                        (this._tiles = {}),
                        this._resetView();
                },
                beforeAdd: function(t) {
                    t._addZoomLimit(this);
                },
                onRemove: function(t) {
                    this._removeAllTiles(),
                        et(this._container),
                        t._removeZoomLimit(this),
                        (this._container = null),
                        (this._tileZoom = void 0);
                },
                bringToFront: function() {
                    return (
                        this._map && ($t(this._container), this._setAutoZIndex(Math.max)),
                        this
                    );
                },
                bringToBack: function() {
                    return (
                        this._map && (Kt(this._container), this._setAutoZIndex(Math.min)),
                        this
                    );
                },
                getContainer: function() {
                    return this._container;
                },
                setOpacity: function(t) {
                    return (this.options.opacity = t), this._updateOpacity(), this;
                },
                setZIndex: function(t) {
                    return (this.options.zIndex = t), this._updateZIndex(), this;
                },
                isLoading: function() {
                    return this._loading;
                },
                redraw: function() {
                    if (this._map) {
                        this._removeAllTiles();
                        var t = this._clampZoom(this._map.getZoom());
                        t !== this._tileZoom && ((this._tileZoom = t), this._updateLevels()),
                            this._update();
                    }
                    return this;
                },
                getEvents: function() {
                    var t = {
                        viewprereset: this._invalidateAll,
                        viewreset: this._resetView,
                        zoom: this._resetView,
                        moveend: this._onMoveEnd,
                    };
                    return (
                        this.options.updateWhenIdle ||
                        (this._onMove ||
                            (this._onMove = y(
                                this._onMoveEnd,
                                this.options.updateInterval,
                                this
                            )),
                            (t.move = this._onMove)),
                        this._zoomAnimated && (t.zoomanim = this._animateZoom),
                        t
                    );
                },
                createTile: function() {
                    return document.createElement("div");
                },
                getTileSize: function() {
                    var t = this.options.tileSize;
                    return t instanceof I ? t : new I(t, t);
                },
                _updateZIndex: function() {
                    this._container &&
                        this.options.zIndex !== void 0 &&
                        this.options.zIndex !== null &&
                        (this._container.style.zIndex = this.options.zIndex);
                },
                _setAutoZIndex: function(t) {
                    for (
                        var e = this.getPane().children,
                            i = -t(-1 / 0, 1 / 0),
                            s = 0,
                            l = e.length,
                            c; s < l; s++
                    )
                        (c = e[s].style.zIndex),
                        e[s] !== this._container && c && (i = t(i, +c));
                    isFinite(i) &&
                        ((this.options.zIndex = i + t(-1, 1)), this._updateZIndex());
                },
                _updateOpacity: function() {
                    if (this._map && !N.ielt9) {
                        xt(this._container, this.options.opacity);
                        var t = +new Date(),
                            e = !1,
                            i = !1;
                        for (var s in this._tiles) {
                            var l = this._tiles[s];
                            if (!(!l.current || !l.loaded)) {
                                var c = Math.min(1, (t - l.loaded) / 200);
                                xt(l.el, c),
                                    c < 1 ?
                                    (e = !0) :
                                    (l.active ? (i = !0) : this._onOpaqueTile(l),
                                        (l.active = !0));
                            }
                        }
                        i && !this._noPrune && this._pruneTiles(),
                            e &&
                            (R(this._fadeFrame),
                                (this._fadeFrame = D(this._updateOpacity, this)));
                    }
                },
                _onOpaqueTile: v,
                _initContainer: function() {
                    this._container ||
                        ((this._container = X(
                                "div",
                                "leaflet-layer " + (this.options.className || "")
                            )),
                            this._updateZIndex(),
                            this.options.opacity < 1 && this._updateOpacity(),
                            this.getPane().appendChild(this._container));
                },
                _updateLevels: function() {
                    var t = this._tileZoom,
                        e = this.options.maxZoom;
                    if (t !== void 0) {
                        for (var i in this._levels)
                            (i = Number(i)),
                            this._levels[i].el.children.length || i === t ?
                            ((this._levels[i].el.style.zIndex = e - Math.abs(t - i)),
                                this._onUpdateLevel(i)) :
                            (et(this._levels[i].el),
                                this._removeTilesAtZoom(i),
                                this._onRemoveLevel(i),
                                delete this._levels[i]);
                        var s = this._levels[t],
                            l = this._map;
                        return (
                            s ||
                            ((s = this._levels[t] = {}),
                                (s.el = X(
                                    "div",
                                    "leaflet-tile-container leaflet-zoom-animated",
                                    this._container
                                )),
                                (s.el.style.zIndex = e),
                                (s.origin = l
                                    .project(l.unproject(l.getPixelOrigin()), t)
                                    .round()),
                                (s.zoom = t),
                                this._setZoomTransform(s, l.getCenter(), l.getZoom()),
                                v(s.el.offsetWidth),
                                this._onCreateLevel(s)),
                            (this._level = s),
                            s
                        );
                    }
                },
                _onUpdateLevel: v,
                _onRemoveLevel: v,
                _onCreateLevel: v,
                _pruneTiles: function() {
                    if (this._map) {
                        var t,
                            e,
                            i = this._map.getZoom();
                        if (i > this.options.maxZoom || i < this.options.minZoom) {
                            this._removeAllTiles();
                            return;
                        }
                        for (t in this._tiles)(e = this._tiles[t]), (e.retain = e.current);
                        for (t in this._tiles)
                            if (((e = this._tiles[t]), e.current && !e.active)) {
                                var s = e.coords;
                                this._retainParent(s.x, s.y, s.z, s.z - 5) ||
                                    this._retainChildren(s.x, s.y, s.z, s.z + 2);
                            }
                        for (t in this._tiles) this._tiles[t].retain || this._removeTile(t);
                    }
                },
                _removeTilesAtZoom: function(t) {
                    for (var e in this._tiles)
                        this._tiles[e].coords.z === t && this._removeTile(e);
                },
                _removeAllTiles: function() {
                    for (var t in this._tiles) this._removeTile(t);
                },
                _invalidateAll: function() {
                    for (var t in this._levels)
                        et(this._levels[t].el),
                        this._onRemoveLevel(Number(t)),
                        delete this._levels[t];
                    this._removeAllTiles(), (this._tileZoom = void 0);
                },
                _retainParent: function(t, e, i, s) {
                    var l = Math.floor(t / 2),
                        c = Math.floor(e / 2),
                        m = i - 1,
                        _ = new I(+l, +c);
                    _.z = +m;
                    var x = this._tileCoordsToKey(_),
                        S = this._tiles[x];
                    return S && S.active ?
                        ((S.retain = !0), !0) :
                        (S && S.loaded && (S.retain = !0),
                            m > s ? this._retainParent(l, c, m, s) : !1);
                },
                _retainChildren: function(t, e, i, s) {
                    for (var l = 2 * t; l < 2 * t + 2; l++)
                        for (var c = 2 * e; c < 2 * e + 2; c++) {
                            var m = new I(l, c);
                            m.z = i + 1;
                            var _ = this._tileCoordsToKey(m),
                                x = this._tiles[_];
                            if (x && x.active) {
                                x.retain = !0;
                                continue;
                            } else x && x.loaded && (x.retain = !0);
                            i + 1 < s && this._retainChildren(l, c, i + 1, s);
                        }
                },
                _resetView: function(t) {
                    var e = t && (t.pinch || t.flyTo);
                    this._setView(this._map.getCenter(), this._map.getZoom(), e, e);
                },
                _animateZoom: function(t) {
                    this._setView(t.center, t.zoom, !0, t.noUpdate);
                },
                _clampZoom: function(t) {
                    var e = this.options;
                    return e.minNativeZoom !== void 0 && t < e.minNativeZoom ?
                        e.minNativeZoom :
                        e.maxNativeZoom !== void 0 && e.maxNativeZoom < t ?
                        e.maxNativeZoom :
                        t;
                },
                _setView: function(t, e, i, s) {
                    var l = Math.round(e);
                    (this.options.maxZoom !== void 0 && l > this.options.maxZoom) ||
                    (this.options.minZoom !== void 0 && l < this.options.minZoom) ?
                    (l = void 0) :
                    (l = this._clampZoom(l));
                    var c = this.options.updateWhenZooming && l !== this._tileZoom;
                    (!s || c) &&
                    ((this._tileZoom = l),
                        this._abortLoading && this._abortLoading(),
                        this._updateLevels(),
                        this._resetGrid(),
                        l !== void 0 && this._update(t),
                        i || this._pruneTiles(),
                        (this._noPrune = !!i)),
                    this._setZoomTransforms(t, e);
                },
                _setZoomTransforms: function(t, e) {
                    for (var i in this._levels)
                        this._setZoomTransform(this._levels[i], t, e);
                },
                _setZoomTransform: function(t, e, i) {
                    var s = this._map.getZoomScale(i, t.zoom),
                        l = t.origin
                        .multiplyBy(s)
                        .subtract(this._map._getNewPixelOrigin(e, i))
                        .round();
                    N.any3d ? Wt(t.el, l, s) : rt(t.el, l);
                },
                _resetGrid: function() {
                    var t = this._map,
                        e = t.options.crs,
                        i = (this._tileSize = this.getTileSize()),
                        s = this._tileZoom,
                        l = this._map.getPixelWorldBounds(this._tileZoom);
                    l && (this._globalTileRange = this._pxBoundsToTileRange(l)),
                        (this._wrapX = e.wrapLng &&
                            !this.options.noWrap && [
                                Math.floor(t.project([0, e.wrapLng[0]], s).x / i.x),
                                Math.ceil(t.project([0, e.wrapLng[1]], s).x / i.y),
                            ]),
                        (this._wrapY = e.wrapLat &&
                            !this.options.noWrap && [
                                Math.floor(t.project([e.wrapLat[0], 0], s).y / i.x),
                                Math.ceil(t.project([e.wrapLat[1], 0], s).y / i.y),
                            ]);
                },
                _onMoveEnd: function() {
                    !this._map || this._map._animatingZoom || this._update();
                },
                _getTiledPixelBounds: function(t) {
                    var e = this._map,
                        i = e._animatingZoom ?
                        Math.max(e._animateToZoom, e.getZoom()) :
                        e.getZoom(),
                        s = e.getZoomScale(i, this._tileZoom),
                        l = e.project(t, this._tileZoom).floor(),
                        c = e.getSize().divideBy(s * 2);
                    return new $(l.subtract(c), l.add(c));
                },
                _update: function(t) {
                    var e = this._map;
                    if (e) {
                        var i = this._clampZoom(e.getZoom());
                        if (
                            (t === void 0 && (t = e.getCenter()), this._tileZoom !== void 0)
                        ) {
                            var s = this._getTiledPixelBounds(t),
                                l = this._pxBoundsToTileRange(s),
                                c = l.getCenter(),
                                m = [],
                                _ = this.options.keepBuffer,
                                x = new $(
                                    l.getBottomLeft().subtract([_, -_]),
                                    l.getTopRight().add([_, -_])
                                );
                            if (
                                !(
                                    isFinite(l.min.x) &&
                                    isFinite(l.min.y) &&
                                    isFinite(l.max.x) &&
                                    isFinite(l.max.y)
                                )
                            )
                                throw new Error("Attempted to load an infinite number of tiles");
                            for (var S in this._tiles) {
                                var k = this._tiles[S].coords;
                                (k.z !== this._tileZoom || !x.contains(new I(k.x, k.y))) &&
                                (this._tiles[S].current = !1);
                            }
                            if (Math.abs(i - this._tileZoom) > 1) {
                                this._setView(t, i);
                                return;
                            }
                            for (var F = l.min.y; F <= l.max.y; F++)
                                for (var W = l.min.x; W <= l.max.x; W++) {
                                    var ht = new I(W, F);
                                    if (((ht.z = this._tileZoom), !!this._isValidTile(ht))) {
                                        var lt = this._tiles[this._tileCoordsToKey(ht)];
                                        lt ? (lt.current = !0) : m.push(ht);
                                    }
                                }
                            if (
                                (m.sort(function(mt, ne) {
                                        return mt.distanceTo(c) - ne.distanceTo(c);
                                    }),
                                    m.length !== 0)
                            ) {
                                this._loading || ((this._loading = !0), this.fire("loading"));
                                var Tt = document.createDocumentFragment();
                                for (W = 0; W < m.length; W++) this._addTile(m[W], Tt);
                                this._level.el.appendChild(Tt);
                            }
                        }
                    }
                },
                _isValidTile: function(t) {
                    var e = this._map.options.crs;
                    if (!e.infinite) {
                        var i = this._globalTileRange;
                        if (
                            (!e.wrapLng && (t.x < i.min.x || t.x > i.max.x)) ||
                            (!e.wrapLat && (t.y < i.min.y || t.y > i.max.y))
                        )
                            return !1;
                    }
                    if (!this.options.bounds) return !0;
                    var s = this._tileCoordsToBounds(t);
                    return nt(this.options.bounds).overlaps(s);
                },
                _keyToBounds: function(t) {
                    return this._tileCoordsToBounds(this._keyToTileCoords(t));
                },
                _tileCoordsToNwSe: function(t) {
                    var e = this._map,
                        i = this.getTileSize(),
                        s = t.scaleBy(i),
                        l = s.add(i),
                        c = e.unproject(s, t.z),
                        m = e.unproject(l, t.z);
                    return [c, m];
                },
                _tileCoordsToBounds: function(t) {
                    var e = this._tileCoordsToNwSe(t),
                        i = new pt(e[0], e[1]);
                    return this.options.noWrap || (i = this._map.wrapLatLngBounds(i)), i;
                },
                _tileCoordsToKey: function(t) {
                    return t.x + ":" + t.y + ":" + t.z;
                },
                _keyToTileCoords: function(t) {
                    var e = t.split(":"),
                        i = new I(+e[0], +e[1]);
                    return (i.z = +e[2]), i;
                },
                _removeTile: function(t) {
                    var e = this._tiles[t];
                    e &&
                        (et(e.el),
                            delete this._tiles[t],
                            this.fire("tileunload", {
                                tile: e.el,
                                coords: this._keyToTileCoords(t),
                            }));
                },
                _initTile: function(t) {
                    V(t, "leaflet-tile");
                    var e = this.getTileSize();
                    (t.style.width = e.x + "px"),
                    (t.style.height = e.y + "px"),
                    (t.onselectstart = v),
                    (t.onmousemove = v),
                    N.ielt9 && this.options.opacity < 1 && xt(t, this.options.opacity);
                },
                _addTile: function(t, e) {
                    var i = this._getTilePos(t),
                        s = this._tileCoordsToKey(t),
                        l = this.createTile(this._wrapCoords(t), f(this._tileReady, this, t));
                    this._initTile(l),
                        this.createTile.length < 2 && D(f(this._tileReady, this, t, null, l)),
                        rt(l, i),
                        (this._tiles[s] = {
                            el: l,
                            coords: t,
                            current: !0
                        }),
                        e.appendChild(l),
                        this.fire("tileloadstart", {
                            tile: l,
                            coords: t
                        });
                },
                _tileReady: function(t, e, i) {
                    e && this.fire("tileerror", {
                        error: e,
                        tile: i,
                        coords: t
                    });
                    var s = this._tileCoordsToKey(t);
                    (i = this._tiles[s]),
                    i &&
                        ((i.loaded = +new Date()),
                            this._map._fadeAnimated ?
                            (xt(i.el, 0),
                                R(this._fadeFrame),
                                (this._fadeFrame = D(this._updateOpacity, this))) :
                            ((i.active = !0), this._pruneTiles()),
                            e ||
                            (V(i.el, "leaflet-tile-loaded"),
                                this.fire("tileload", {
                                    tile: i.el,
                                    coords: t
                                })),
                            this._noTilesToLoad() &&
                            ((this._loading = !1),
                                this.fire("load"),
                                N.ielt9 || !this._map._fadeAnimated ?
                                D(this._pruneTiles, this) :
                                setTimeout(f(this._pruneTiles, this), 250)));
                },
                _getTilePos: function(t) {
                    return t.scaleBy(this.getTileSize()).subtract(this._level.origin);
                },
                _wrapCoords: function(t) {
                    var e = new I(
                        this._wrapX ? g(t.x, this._wrapX) : t.x,
                        this._wrapY ? g(t.y, this._wrapY) : t.y
                    );
                    return (e.z = t.z), e;
                },
                _pxBoundsToTileRange: function(t) {
                    var e = this.getTileSize();
                    return new $(
                        t.min.unscaleBy(e).floor(),
                        t.max.unscaleBy(e).ceil().subtract([1, 1])
                    );
                },
                _noTilesToLoad: function() {
                    for (var t in this._tiles)
                        if (!this._tiles[t].loaded) return !1;
                    return !0;
                },
            });

            function Bs(t) {
                return new _e(t);
            }
            var ie = _e.extend({
                options: {
                    minZoom: 0,
                    maxZoom: 18,
                    subdomains: "abc",
                    errorTileUrl: "",
                    zoomOffset: 0,
                    tms: !1,
                    zoomReverse: !1,
                    detectRetina: !1,
                    crossOrigin: !1,
                    referrerPolicy: !1,
                },
                initialize: function(t, e) {
                    (this._url = t),
                    (e = b(this, e)),
                    e.detectRetina && N.retina && e.maxZoom > 0 ?
                        ((e.tileSize = Math.floor(e.tileSize / 2)),
                            e.zoomReverse ?
                            (e.zoomOffset--,
                                (e.minZoom = Math.min(e.maxZoom, e.minZoom + 1))) :
                            (e.zoomOffset++,
                                (e.maxZoom = Math.max(e.minZoom, e.maxZoom - 1))),
                            (e.minZoom = Math.max(0, e.minZoom))) :
                        e.zoomReverse ?
                        (e.minZoom = Math.min(e.maxZoom, e.minZoom)) :
                        (e.maxZoom = Math.max(e.minZoom, e.maxZoom)),
                        typeof e.subdomains == "string" &&
                        (e.subdomains = e.subdomains.split("")),
                        this.on("tileunload", this._onTileRemove);
                },
                setUrl: function(t, e) {
                    return (
                        this._url === t && e === void 0 && (e = !0),
                        (this._url = t),
                        e || this.redraw(),
                        this
                    );
                },
                createTile: function(t, e) {
                    var i = document.createElement("img");
                    return (
                        G(i, "load", f(this._tileOnLoad, this, e, i)),
                        G(i, "error", f(this._tileOnError, this, e, i)),
                        (this.options.crossOrigin || this.options.crossOrigin === "") &&
                        (i.crossOrigin =
                            this.options.crossOrigin === !0 ? "" : this.options.crossOrigin),
                        typeof this.options.referrerPolicy == "string" &&
                        (i.referrerPolicy = this.options.referrerPolicy),
                        (i.alt = ""),
                        (i.src = this.getTileUrl(t)),
                        i
                    );
                },
                getTileUrl: function(t) {
                    var e = {
                        r: N.retina ? "@2x" : "",
                        s: this._getSubdomain(t),
                        x: t.x,
                        y: t.y,
                        z: this._getZoomForUrl(),
                    };
                    if (this._map && !this._map.options.crs.infinite) {
                        var i = this._globalTileRange.max.y - t.y;
                        this.options.tms && (e.y = i), (e["-y"] = i);
                    }
                    return A(this._url, d(e, this.options));
                },
                _tileOnLoad: function(t, e) {
                    N.ielt9 ? setTimeout(f(t, this, null, e), 0) : t(null, e);
                },
                _tileOnError: function(t, e, i) {
                    var s = this.options.errorTileUrl;
                    s && e.getAttribute("src") !== s && (e.src = s), t(i, e);
                },
                _onTileRemove: function(t) {
                    t.tile.onload = null;
                },
                _getZoomForUrl: function() {
                    var t = this._tileZoom,
                        e = this.options.maxZoom,
                        i = this.options.zoomReverse,
                        s = this.options.zoomOffset;
                    return i && (t = e - t), t + s;
                },
                _getSubdomain: function(t) {
                    var e = Math.abs(t.x + t.y) % this.options.subdomains.length;
                    return this.options.subdomains[e];
                },
                _abortLoading: function() {
                    var t, e;
                    for (t in this._tiles)
                        if (
                            this._tiles[t].coords.z !== this._tileZoom &&
                            ((e = this._tiles[t].el),
                                (e.onload = v),
                                (e.onerror = v),
                                !e.complete)
                        ) {
                            e.src = B;
                            var i = this._tiles[t].coords;
                            et(e),
                                delete this._tiles[t],
                                this.fire("tileabort", {
                                    tile: e,
                                    coords: i
                                });
                        }
                },
                _removeTile: function(t) {
                    var e = this._tiles[t];
                    if (e)
                        return (
                            e.el.setAttribute("src", B), _e.prototype._removeTile.call(this, t)
                        );
                },
                _tileReady: function(t, e, i) {
                    if (!(!this._map || (i && i.getAttribute("src") === B)))
                        return _e.prototype._tileReady.call(this, t, e, i);
                },
            });

            function Fn(t, e) {
                return new ie(t, e);
            }
            var Hn = ie.extend({
                defaultWmsParams: {
                    service: "WMS",
                    request: "GetMap",
                    layers: "",
                    styles: "",
                    format: "image/jpeg",
                    transparent: !1,
                    version: "1.1.1",
                },
                options: {
                    crs: null,
                    uppercase: !1
                },
                initialize: function(t, e) {
                    this._url = t;
                    var i = d({}, this.defaultWmsParams);
                    for (var s in e) s in this.options || (i[s] = e[s]);
                    e = b(this, e);
                    var l = e.detectRetina && N.retina ? 2 : 1,
                        c = this.getTileSize();
                    (i.width = c.x * l), (i.height = c.y * l), (this.wmsParams = i);
                },
                onAdd: function(t) {
                    (this._crs = this.options.crs || t.options.crs),
                    (this._wmsVersion = parseFloat(this.wmsParams.version));
                    var e = this._wmsVersion >= 1.3 ? "crs" : "srs";
                    (this.wmsParams[e] = this._crs.code), ie.prototype.onAdd.call(this, t);
                },
                getTileUrl: function(t) {
                    var e = this._tileCoordsToNwSe(t),
                        i = this._crs,
                        s = ot(i.project(e[0]), i.project(e[1])),
                        l = s.min,
                        c = s.max,
                        m = (
                            this._wmsVersion >= 1.3 && this._crs === On ? [l.y, l.x, c.y, c.x] : [l.x, l.y, c.x, c.y]
                        ).join(","),
                        _ = ie.prototype.getTileUrl.call(this, t);
                    return (
                        _ +
                        C(this.wmsParams, _, this.options.uppercase) +
                        (this.options.uppercase ? "&BBOX=" : "&bbox=") +
                        m
                    );
                },
                setParams: function(t, e) {
                    return d(this.wmsParams, t), e || this.redraw(), this;
                },
            });

            function Zs(t, e) {
                return new Hn(t, e);
            }
            (ie.WMS = Hn), (Fn.wms = Zs);
            var Zt = St.extend({
                    options: {
                        padding: 0.1
                    },
                    initialize: function(t) {
                        b(this, t), h(this), (this._layers = this._layers || {});
                    },
                    onAdd: function() {
                        this._container ||
                            (this._initContainer(),
                                V(this._container, "leaflet-zoom-animated")),
                            this.getPane().appendChild(this._container),
                            this._update(),
                            this.on("update", this._updatePaths, this);
                    },
                    onRemove: function() {
                        this.off("update", this._updatePaths, this), this._destroyContainer();
                    },
                    getEvents: function() {
                        var t = {
                            viewreset: this._reset,
                            zoom: this._onZoom,
                            moveend: this._update,
                            zoomend: this._onZoomEnd,
                        };
                        return this._zoomAnimated && (t.zoomanim = this._onAnimZoom), t;
                    },
                    _onAnimZoom: function(t) {
                        this._updateTransform(t.center, t.zoom);
                    },
                    _onZoom: function() {
                        this._updateTransform(this._map.getCenter(), this._map.getZoom());
                    },
                    _updateTransform: function(t, e) {
                        var i = this._map.getZoomScale(e, this._zoom),
                            s = this._map.getSize().multiplyBy(0.5 + this.options.padding),
                            l = this._map.project(this._center, e),
                            c = s
                            .multiplyBy(-i)
                            .add(l)
                            .subtract(this._map._getNewPixelOrigin(t, e));
                        N.any3d ? Wt(this._container, c, i) : rt(this._container, c);
                    },
                    _reset: function() {
                        this._update(), this._updateTransform(this._center, this._zoom);
                        for (var t in this._layers) this._layers[t]._reset();
                    },
                    _onZoomEnd: function() {
                        for (var t in this._layers) this._layers[t]._project();
                    },
                    _updatePaths: function() {
                        for (var t in this._layers) this._layers[t]._update();
                    },
                    _update: function() {
                        var t = this.options.padding,
                            e = this._map.getSize(),
                            i = this._map.containerPointToLayerPoint(e.multiplyBy(-t)).round();
                        (this._bounds = new $(i, i.add(e.multiplyBy(1 + t * 2)).round())),
                        (this._center = this._map.getCenter()),
                        (this._zoom = this._map.getZoom());
                    },
                }),
                Gn = Zt.extend({
                    options: {
                        tolerance: 0
                    },
                    getEvents: function() {
                        var t = Zt.prototype.getEvents.call(this);
                        return (t.viewprereset = this._onViewPreReset), t;
                    },
                    _onViewPreReset: function() {
                        this._postponeUpdatePaths = !0;
                    },
                    onAdd: function() {
                        Zt.prototype.onAdd.call(this), this._draw();
                    },
                    _initContainer: function() {
                        var t = (this._container = document.createElement("canvas"));
                        G(t, "mousemove", this._onMouseMove, this),
                            G(
                                t,
                                "click dblclick mousedown mouseup contextmenu",
                                this._onClick,
                                this
                            ),
                            G(t, "mouseout", this._handleMouseOut, this),
                            (t._leaflet_disable_events = !0),
                            (this._ctx = t.getContext("2d"));
                    },
                    _destroyContainer: function() {
                        R(this._redrawRequest),
                            delete this._ctx,
                            et(this._container),
                            Q(this._container),
                            delete this._container;
                    },
                    _updatePaths: function() {
                        if (!this._postponeUpdatePaths) {
                            var t;
                            this._redrawBounds = null;
                            for (var e in this._layers)(t = this._layers[e]), t._update();
                            this._redraw();
                        }
                    },
                    _update: function() {
                        if (!(this._map._animatingZoom && this._bounds)) {
                            Zt.prototype._update.call(this);
                            var t = this._bounds,
                                e = this._container,
                                i = t.getSize(),
                                s = N.retina ? 2 : 1;
                            rt(e, t.min),
                                (e.width = s * i.x),
                                (e.height = s * i.y),
                                (e.style.width = i.x + "px"),
                                (e.style.height = i.y + "px"),
                                N.retina && this._ctx.scale(2, 2),
                                this._ctx.translate(-t.min.x, -t.min.y),
                                this.fire("update");
                        }
                    },
                    _reset: function() {
                        Zt.prototype._reset.call(this),
                            this._postponeUpdatePaths &&
                            ((this._postponeUpdatePaths = !1), this._updatePaths());
                    },
                    _initPath: function(t) {
                        this._updateDashArray(t), (this._layers[h(t)] = t);
                        var e = (t._order = {
                            layer: t,
                            prev: this._drawLast,
                            next: null
                        });
                        this._drawLast && (this._drawLast.next = e),
                            (this._drawLast = e),
                            (this._drawFirst = this._drawFirst || this._drawLast);
                    },
                    _addPath: function(t) {
                        this._requestRedraw(t);
                    },
                    _removePath: function(t) {
                        var e = t._order,
                            i = e.next,
                            s = e.prev;
                        i ? (i.prev = s) : (this._drawLast = s),
                            s ? (s.next = i) : (this._drawFirst = i),
                            delete t._order,
                            delete this._layers[h(t)],
                            this._requestRedraw(t);
                    },
                    _updatePath: function(t) {
                        this._extendRedrawBounds(t),
                            t._project(),
                            t._update(),
                            this._requestRedraw(t);
                    },
                    _updateStyle: function(t) {
                        this._updateDashArray(t), this._requestRedraw(t);
                    },
                    _updateDashArray: function(t) {
                        if (typeof t.options.dashArray == "string") {
                            var e = t.options.dashArray.split(/[, ]+/),
                                i = [],
                                s,
                                l;
                            for (l = 0; l < e.length; l++) {
                                if (((s = Number(e[l])), isNaN(s))) return;
                                i.push(s);
                            }
                            t.options._dashArray = i;
                        } else t.options._dashArray = t.options.dashArray;
                    },
                    _requestRedraw: function(t) {
                        this._map &&
                            (this._extendRedrawBounds(t),
                                (this._redrawRequest =
                                    this._redrawRequest || D(this._redraw, this)));
                    },
                    _extendRedrawBounds: function(t) {
                        if (t._pxBounds) {
                            var e = (t.options.weight || 0) + 1;
                            (this._redrawBounds = this._redrawBounds || new $()),
                            this._redrawBounds.extend(t._pxBounds.min.subtract([e, e])),
                                this._redrawBounds.extend(t._pxBounds.max.add([e, e]));
                        }
                    },
                    _redraw: function() {
                        (this._redrawRequest = null),
                        this._redrawBounds &&
                            (this._redrawBounds.min._floor(), this._redrawBounds.max._ceil()),
                            this._clear(),
                            this._draw(),
                            (this._redrawBounds = null);
                    },
                    _clear: function() {
                        var t = this._redrawBounds;
                        if (t) {
                            var e = t.getSize();
                            this._ctx.clearRect(t.min.x, t.min.y, e.x, e.y);
                        } else
                            this._ctx.save(),
                            this._ctx.setTransform(1, 0, 0, 1, 0, 0),
                            this._ctx.clearRect(
                                0,
                                0,
                                this._container.width,
                                this._container.height
                            ),
                            this._ctx.restore();
                    },
                    _draw: function() {
                        var t,
                            e = this._redrawBounds;
                        if ((this._ctx.save(), e)) {
                            var i = e.getSize();
                            this._ctx.beginPath(),
                                this._ctx.rect(e.min.x, e.min.y, i.x, i.y),
                                this._ctx.clip();
                        }
                        this._drawing = !0;
                        for (var s = this._drawFirst; s; s = s.next)
                            (t = s.layer),
                            (!e || (t._pxBounds && t._pxBounds.intersects(e))) &&
                            t._updatePath();
                        (this._drawing = !1), this._ctx.restore();
                    },
                    _updatePoly: function(t, e) {
                        if (this._drawing) {
                            var i,
                                s,
                                l,
                                c,
                                m = t._parts,
                                _ = m.length,
                                x = this._ctx;
                            if (_) {
                                for (x.beginPath(), i = 0; i < _; i++) {
                                    for (s = 0, l = m[i].length; s < l; s++)
                                        (c = m[i][s]), x[s ? "lineTo" : "moveTo"](c.x, c.y);
                                    e && x.closePath();
                                }
                                this._fillStroke(x, t);
                            }
                        }
                    },
                    _updateCircle: function(t) {
                        if (!(!this._drawing || t._empty())) {
                            var e = t._point,
                                i = this._ctx,
                                s = Math.max(Math.round(t._radius), 1),
                                l = (Math.max(Math.round(t._radiusY), 1) || s) / s;
                            l !== 1 && (i.save(), i.scale(1, l)),
                                i.beginPath(),
                                i.arc(e.x, e.y / l, s, 0, Math.PI * 2, !1),
                                l !== 1 && i.restore(),
                                this._fillStroke(i, t);
                        }
                    },
                    _fillStroke: function(t, e) {
                        var i = e.options;
                        i.fill &&
                            ((t.globalAlpha = i.fillOpacity),
                                (t.fillStyle = i.fillColor || i.color),
                                t.fill(i.fillRule || "evenodd")),
                            i.stroke &&
                            i.weight !== 0 &&
                            (t.setLineDash &&
                                t.setLineDash((e.options && e.options._dashArray) || []),
                                (t.globalAlpha = i.opacity),
                                (t.lineWidth = i.weight),
                                (t.strokeStyle = i.color),
                                (t.lineCap = i.lineCap),
                                (t.lineJoin = i.lineJoin),
                                t.stroke());
                    },
                    _onClick: function(t) {
                        for (
                            var e = this._map.mouseEventToLayerPoint(t),
                                i,
                                s,
                                l = this._drawFirst; l; l = l.next
                        )
                            (i = l.layer),
                            i.options.interactive &&
                            i._containsPoint(e) &&
                            (!(t.type === "click" || t.type === "preclick") ||
                                !this._map._draggableMoved(i)) &&
                            (s = i);
                        this._fireEvent(s ? [s] : !1, t);
                    },
                    _onMouseMove: function(t) {
                        if (
                            !(
                                !this._map ||
                                this._map.dragging.moving() ||
                                this._map._animatingZoom
                            )
                        ) {
                            var e = this._map.mouseEventToLayerPoint(t);
                            this._handleMouseHover(t, e);
                        }
                    },
                    _handleMouseOut: function(t) {
                        var e = this._hoveredLayer;
                        e &&
                            (it(this._container, "leaflet-interactive"),
                                this._fireEvent([e], t, "mouseout"),
                                (this._hoveredLayer = null),
                                (this._mouseHoverThrottled = !1));
                    },
                    _handleMouseHover: function(t, e) {
                        if (!this._mouseHoverThrottled) {
                            for (var i, s, l = this._drawFirst; l; l = l.next)
                                (i = l.layer),
                                i.options.interactive && i._containsPoint(e) && (s = i);
                            s !== this._hoveredLayer &&
                                (this._handleMouseOut(t),
                                    s &&
                                    (V(this._container, "leaflet-interactive"),
                                        this._fireEvent([s], t, "mouseover"),
                                        (this._hoveredLayer = s))),
                                this._fireEvent(
                                    this._hoveredLayer ? [this._hoveredLayer] : !1,
                                    t
                                ),
                                (this._mouseHoverThrottled = !0),
                                setTimeout(
                                    f(function() {
                                        this._mouseHoverThrottled = !1;
                                    }, this),
                                    32
                                );
                        }
                    },
                    _fireEvent: function(t, e, i) {
                        this._map._fireDOMEvent(e, i || e.type, t);
                    },
                    _bringToFront: function(t) {
                        var e = t._order;
                        if (e) {
                            var i = e.next,
                                s = e.prev;
                            if (i) i.prev = s;
                            else return;
                            s ? (s.next = i) : i && (this._drawFirst = i),
                                (e.prev = this._drawLast),
                                (this._drawLast.next = e),
                                (e.next = null),
                                (this._drawLast = e),
                                this._requestRedraw(t);
                        }
                    },
                    _bringToBack: function(t) {
                        var e = t._order;
                        if (e) {
                            var i = e.next,
                                s = e.prev;
                            if (s) s.next = i;
                            else return;
                            i ? (i.prev = s) : s && (this._drawLast = s),
                                (e.prev = null),
                                (e.next = this._drawFirst),
                                (this._drawFirst.prev = e),
                                (this._drawFirst = e),
                                this._requestRedraw(t);
                        }
                    },
                });

            function Vn(t) {
                return N.canvas ? new Gn(t) : null;
            }
            var ge = (function() {
                    try {
                        return (
                            document.namespaces.add("lvml", "urn:schemas-microsoft-com:vml"),
                            function(t) {
                                return document.createElement("<lvml:" + t + ' class="lvml">');
                            }
                        );
                    } catch {}
                    return function(t) {
                        return document.createElement(
                            "<" + t + ' xmlns="urn:schemas-microsoft.com:vml" class="lvml">'
                        );
                    };
                })(),
                Ds = {
                    _initContainer: function() {
                        this._container = X("div", "leaflet-vml-container");
                    },
                    _update: function() {
                        this._map._animatingZoom ||
                            (Zt.prototype._update.call(this), this.fire("update"));
                    },
                    _initPath: function(t) {
                        var e = (t._container = ge("shape"));
                        V(e, "leaflet-vml-shape " + (this.options.className || "")),
                            (e.coordsize = "1 1"),
                            (t._path = ge("path")),
                            e.appendChild(t._path),
                            this._updateStyle(t),
                            (this._layers[h(t)] = t);
                    },
                    _addPath: function(t) {
                        var e = t._container;
                        this._container.appendChild(e),
                            t.options.interactive && t.addInteractiveTarget(e);
                    },
                    _removePath: function(t) {
                        var e = t._container;
                        et(e), t.removeInteractiveTarget(e), delete this._layers[h(t)];
                    },
                    _updateStyle: function(t) {
                        var e = t._stroke,
                            i = t._fill,
                            s = t.options,
                            l = t._container;
                        (l.stroked = !!s.stroke),
                        (l.filled = !!s.fill),
                        s.stroke ?
                            (e || (e = t._stroke = ge("stroke")),
                                l.appendChild(e),
                                (e.weight = s.weight + "px"),
                                (e.color = s.color),
                                (e.opacity = s.opacity),
                                s.dashArray ?
                                (e.dashStyle = M(s.dashArray) ?
                                    s.dashArray.join(" ") :
                                    s.dashArray.replace(/( *, *)/g, " ")) :
                                (e.dashStyle = ""),
                                (e.endcap = s.lineCap.replace("butt", "flat")),
                                (e.joinstyle = s.lineJoin)) :
                            e && (l.removeChild(e), (t._stroke = null)),
                            s.fill ?
                            (i || (i = t._fill = ge("fill")),
                                l.appendChild(i),
                                (i.color = s.fillColor || s.color),
                                (i.opacity = s.fillOpacity)) :
                            i && (l.removeChild(i), (t._fill = null));
                    },
                    _updateCircle: function(t) {
                        var e = t._point.round(),
                            i = Math.round(t._radius),
                            s = Math.round(t._radiusY || i);
                        this._setPath(
                            t,
                            t._empty() ?
                            "M0 0" :
                            "AL " +
                            e.x +
                            "," +
                            e.y +
                            " " +
                            i +
                            "," +
                            s +
                            " 0," +
                            65535 * 360
                        );
                    },
                    _setPath: function(t, e) {
                        t._path.v = e;
                    },
                    _bringToFront: function(t) {
                        $t(t._container);
                    },
                    _bringToBack: function(t) {
                        Kt(t._container);
                    },
                },
                Ze = N.vml ? ge : qi,
                ve = Zt.extend({
                    _initContainer: function() {
                        (this._container = Ze("svg")),
                        this._container.setAttribute("pointer-events", "none"),
                            (this._rootGroup = Ze("g")),
                            this._container.appendChild(this._rootGroup);
                    },
                    _destroyContainer: function() {
                        et(this._container),
                            Q(this._container),
                            delete this._container,
                            delete this._rootGroup,
                            delete this._svgSize;
                    },
                    _update: function() {
                        if (!(this._map._animatingZoom && this._bounds)) {
                            Zt.prototype._update.call(this);
                            var t = this._bounds,
                                e = t.getSize(),
                                i = this._container;
                            (!this._svgSize || !this._svgSize.equals(e)) &&
                            ((this._svgSize = e),
                                i.setAttribute("width", e.x),
                                i.setAttribute("height", e.y)),
                            rt(i, t.min),
                                i.setAttribute("viewBox", [t.min.x, t.min.y, e.x, e.y].join(" ")),
                                this.fire("update");
                        }
                    },
                    _initPath: function(t) {
                        var e = (t._path = Ze("path"));
                        t.options.className && V(e, t.options.className),
                            t.options.interactive && V(e, "leaflet-interactive"),
                            this._updateStyle(t),
                            (this._layers[h(t)] = t);
                    },
                    _addPath: function(t) {
                        this._rootGroup || this._initContainer(),
                            this._rootGroup.appendChild(t._path),
                            t.addInteractiveTarget(t._path);
                    },
                    _removePath: function(t) {
                        et(t._path),
                            t.removeInteractiveTarget(t._path),
                            delete this._layers[h(t)];
                    },
                    _updatePath: function(t) {
                        t._project(), t._update();
                    },
                    _updateStyle: function(t) {
                        var e = t._path,
                            i = t.options;
                        e &&
                            (i.stroke ?
                                (e.setAttribute("stroke", i.color),
                                    e.setAttribute("stroke-opacity", i.opacity),
                                    e.setAttribute("stroke-width", i.weight),
                                    e.setAttribute("stroke-linecap", i.lineCap),
                                    e.setAttribute("stroke-linejoin", i.lineJoin),
                                    i.dashArray ?
                                    e.setAttribute("stroke-dasharray", i.dashArray) :
                                    e.removeAttribute("stroke-dasharray"),
                                    i.dashOffset ?
                                    e.setAttribute("stroke-dashoffset", i.dashOffset) :
                                    e.removeAttribute("stroke-dashoffset")) :
                                e.setAttribute("stroke", "none"),
                                i.fill ?
                                (e.setAttribute("fill", i.fillColor || i.color),
                                    e.setAttribute("fill-opacity", i.fillOpacity),
                                    e.setAttribute("fill-rule", i.fillRule || "evenodd")) :
                                e.setAttribute("fill", "none"));
                    },
                    _updatePoly: function(t, e) {
                        this._setPath(t, Ui(t._parts, e));
                    },
                    _updateCircle: function(t) {
                        var e = t._point,
                            i = Math.max(Math.round(t._radius), 1),
                            s = Math.max(Math.round(t._radiusY), 1) || i,
                            l = "a" + i + "," + s + " 0 1,0 ",
                            c = t._empty() ?
                            "M0 0" :
                            "M" +
                            (e.x - i) +
                            "," +
                            e.y +
                            l +
                            i * 2 +
                            ",0 " +
                            l +
                            -i * 2 +
                            ",0 ";
                        this._setPath(t, c);
                    },
                    _setPath: function(t, e) {
                        t._path.setAttribute("d", e);
                    },
                    _bringToFront: function(t) {
                        $t(t._path);
                    },
                    _bringToBack: function(t) {
                        Kt(t._path);
                    },
                });
            N.vml && ve.include(Ds);

            function Wn(t) {
                return N.svg || N.vml ? new ve(t) : null;
            }
            Y.include({
                getRenderer: function(t) {
                    var e =
                        t.options.renderer ||
                        this._getPaneRenderer(t.options.pane) ||
                        this.options.renderer ||
                        this._renderer;
                    return (
                        e || (e = this._renderer = this._createRenderer()),
                        this.hasLayer(e) || this.addLayer(e),
                        e
                    );
                },
                _getPaneRenderer: function(t) {
                    if (t === "overlayPane" || t === void 0) return !1;
                    var e = this._paneRenderers[t];
                    return (
                        e === void 0 &&
                        ((e = this._createRenderer({
                                pane: t
                            })),
                            (this._paneRenderers[t] = e)),
                        e
                    );
                },
                _createRenderer: function(t) {
                    return (this.options.preferCanvas && Vn(t)) || Wn(t);
                },
            });
            var jn = te.extend({
                initialize: function(t, e) {
                    te.prototype.initialize.call(this, this._boundsToLatLngs(t), e);
                },
                setBounds: function(t) {
                    return this.setLatLngs(this._boundsToLatLngs(t));
                },
                _boundsToLatLngs: function(t) {
                    return (
                        (t = nt(t)),
                        [
                            t.getSouthWest(),
                            t.getNorthWest(),
                            t.getNorthEast(),
                            t.getSouthEast(),
                        ]
                    );
                },
            });

            function Ns(t, e) {
                return new jn(t, e);
            }
            (ve.create = Ze),
            (ve.pointsToPath = Ui),
            (Bt.geometryToLayer = Ce),
            (Bt.coordsToLatLng = xi),
            (Bt.coordsToLatLngs = Ie),
            (Bt.latLngToCoords = wi),
            (Bt.latLngsToCoords = ke),
            (Bt.getFeature = ee),
            (Bt.asFeature = Ae),
            Y.mergeOptions({
                boxZoom: !0
            });
            var qn = Mt.extend({
                initialize: function(t) {
                    (this._map = t),
                    (this._container = t._container),
                    (this._pane = t._panes.overlayPane),
                    (this._resetStateTimeout = 0),
                    t.on("unload", this._destroy, this);
                },
                addHooks: function() {
                    G(this._container, "mousedown", this._onMouseDown, this);
                },
                removeHooks: function() {
                    Q(this._container, "mousedown", this._onMouseDown, this);
                },
                moved: function() {
                    return this._moved;
                },
                _destroy: function() {
                    et(this._pane), delete this._pane;
                },
                _resetState: function() {
                    (this._resetStateTimeout = 0), (this._moved = !1);
                },
                _clearDeferredResetState: function() {
                    this._resetStateTimeout !== 0 &&
                        (clearTimeout(this._resetStateTimeout),
                            (this._resetStateTimeout = 0));
                },
                _onMouseDown: function(t) {
                    if (!t.shiftKey || (t.which !== 1 && t.button !== 1)) return !1;
                    this._clearDeferredResetState(),
                        this._resetState(),
                        de(),
                        ri(),
                        (this._startPoint = this._map.mouseEventToContainerPoint(t)),
                        G(
                            document, {
                                contextmenu: Ut,
                                mousemove: this._onMouseMove,
                                mouseup: this._onMouseUp,
                                keydown: this._onKeyDown,
                            },
                            this
                        );
                },
                _onMouseMove: function(t) {
                    this._moved ||
                        ((this._moved = !0),
                            (this._box = X("div", "leaflet-zoom-box", this._container)),
                            V(this._container, "leaflet-crosshair"),
                            this._map.fire("boxzoomstart")),
                        (this._point = this._map.mouseEventToContainerPoint(t));
                    var e = new $(this._point, this._startPoint),
                        i = e.getSize();
                    rt(this._box, e.min),
                        (this._box.style.width = i.x + "px"),
                        (this._box.style.height = i.y + "px");
                },
                _finish: function() {
                    this._moved &&
                        (et(this._box), it(this._container, "leaflet-crosshair")),
                        ue(),
                        si(),
                        Q(
                            document, {
                                contextmenu: Ut,
                                mousemove: this._onMouseMove,
                                mouseup: this._onMouseUp,
                                keydown: this._onKeyDown,
                            },
                            this
                        );
                },
                _onMouseUp: function(t) {
                    if (
                        !(t.which !== 1 && t.button !== 1) &&
                        (this._finish(), !!this._moved)
                    ) {
                        this._clearDeferredResetState(),
                            (this._resetStateTimeout = setTimeout(
                                f(this._resetState, this),
                                0
                            ));
                        var e = new pt(
                            this._map.containerPointToLatLng(this._startPoint),
                            this._map.containerPointToLatLng(this._point)
                        );
                        this._map.fitBounds(e).fire("boxzoomend", {
                            boxZoomBounds: e
                        });
                    }
                },
                _onKeyDown: function(t) {
                    t.keyCode === 27 &&
                        (this._finish(), this._clearDeferredResetState(), this._resetState());
                },
            });
            Y.addInitHook("addHandler", "boxZoom", qn),
                Y.mergeOptions({
                    doubleClickZoom: !0
                });
            var Un = Mt.extend({
                addHooks: function() {
                    this._map.on("dblclick", this._onDoubleClick, this);
                },
                removeHooks: function() {
                    this._map.off("dblclick", this._onDoubleClick, this);
                },
                _onDoubleClick: function(t) {
                    var e = this._map,
                        i = e.getZoom(),
                        s = e.options.zoomDelta,
                        l = t.originalEvent.shiftKey ? i - s : i + s;
                    e.options.doubleClickZoom === "center" ?
                        e.setZoom(l) :
                        e.setZoomAround(t.containerPoint, l);
                },
            });
            Y.addInitHook("addHandler", "doubleClickZoom", Un),
                Y.mergeOptions({
                    dragging: !0,
                    inertia: !0,
                    inertiaDeceleration: 3400,
                    inertiaMaxSpeed: 1 / 0,
                    easeLinearity: 0.2,
                    worldCopyJump: !1,
                    maxBoundsViscosity: 0,
                });
            var Yn = Mt.extend({
                addHooks: function() {
                    if (!this._draggable) {
                        var t = this._map;
                        (this._draggable = new Ht(t._mapPane, t._container)),
                        this._draggable.on({
                                    dragstart: this._onDragStart,
                                    drag: this._onDrag,
                                    dragend: this._onDragEnd,
                                },
                                this
                            ),
                            this._draggable.on("predrag", this._onPreDragLimit, this),
                            t.options.worldCopyJump &&
                            (this._draggable.on("predrag", this._onPreDragWrap, this),
                                t.on("zoomend", this._onZoomEnd, this),
                                t.whenReady(this._onZoomEnd, this));
                    }
                    V(this._map._container, "leaflet-grab leaflet-touch-drag"),
                        this._draggable.enable(),
                        (this._positions = []),
                        (this._times = []);
                },
                removeHooks: function() {
                    it(this._map._container, "leaflet-grab"),
                        it(this._map._container, "leaflet-touch-drag"),
                        this._draggable.disable();
                },
                moved: function() {
                    return this._draggable && this._draggable._moved;
                },
                moving: function() {
                    return this._draggable && this._draggable._moving;
                },
                _onDragStart: function() {
                    var t = this._map;
                    if (
                        (t._stop(),
                            this._map.options.maxBounds && this._map.options.maxBoundsViscosity)
                    ) {
                        var e = nt(this._map.options.maxBounds);
                        (this._offsetLimit = ot(
                            this._map.latLngToContainerPoint(e.getNorthWest()).multiplyBy(-1),
                            this._map
                            .latLngToContainerPoint(e.getSouthEast())
                            .multiplyBy(-1)
                            .add(this._map.getSize())
                        )),
                        (this._viscosity = Math.min(
                            1,
                            Math.max(0, this._map.options.maxBoundsViscosity)
                        ));
                    } else this._offsetLimit = null;
                    t.fire("movestart").fire("dragstart"),
                        t.options.inertia && ((this._positions = []), (this._times = []));
                },
                _onDrag: function(t) {
                    if (this._map.options.inertia) {
                        var e = (this._lastTime = +new Date()),
                            i = (this._lastPos =
                                this._draggable._absPos || this._draggable._newPos);
                        this._positions.push(i), this._times.push(e), this._prunePositions(e);
                    }
                    this._map.fire("move", t).fire("drag", t);
                },
                _prunePositions: function(t) {
                    for (; this._positions.length > 1 && t - this._times[0] > 50;)
                        this._positions.shift(), this._times.shift();
                },
                _onZoomEnd: function() {
                    var t = this._map.getSize().divideBy(2),
                        e = this._map.latLngToLayerPoint([0, 0]);
                    (this._initialWorldOffset = e.subtract(t).x),
                    (this._worldWidth = this._map.getPixelWorldBounds().getSize().x);
                },
                _viscousLimit: function(t, e) {
                    return t - (t - e) * this._viscosity;
                },
                _onPreDragLimit: function() {
                    if (!(!this._viscosity || !this._offsetLimit)) {
                        var t = this._draggable._newPos.subtract(this._draggable._startPos),
                            e = this._offsetLimit;
                        t.x < e.min.x && (t.x = this._viscousLimit(t.x, e.min.x)),
                            t.y < e.min.y && (t.y = this._viscousLimit(t.y, e.min.y)),
                            t.x > e.max.x && (t.x = this._viscousLimit(t.x, e.max.x)),
                            t.y > e.max.y && (t.y = this._viscousLimit(t.y, e.max.y)),
                            (this._draggable._newPos = this._draggable._startPos.add(t));
                    }
                },
                _onPreDragWrap: function() {
                    var t = this._worldWidth,
                        e = Math.round(t / 2),
                        i = this._initialWorldOffset,
                        s = this._draggable._newPos.x,
                        l = ((s - e + i) % t) + e - i,
                        c = ((s + e + i) % t) - e - i,
                        m = Math.abs(l + i) < Math.abs(c + i) ? l : c;
                    (this._draggable._absPos = this._draggable._newPos.clone()),
                    (this._draggable._newPos.x = m);
                },
                _onDragEnd: function(t) {
                    var e = this._map,
                        i = e.options,
                        s = !i.inertia || t.noInertia || this._times.length < 2;
                    if ((e.fire("dragend", t), s)) e.fire("moveend");
                    else {
                        this._prunePositions(+new Date());
                        var l = this._lastPos.subtract(this._positions[0]),
                            c = (this._lastTime - this._times[0]) / 1e3,
                            m = i.easeLinearity,
                            _ = l.multiplyBy(m / c),
                            x = _.distanceTo([0, 0]),
                            S = Math.min(i.inertiaMaxSpeed, x),
                            k = _.multiplyBy(S / x),
                            F = S / (i.inertiaDeceleration * m),
                            W = k.multiplyBy(-F / 2).round();
                        !W.x && !W.y ?
                            e.fire("moveend") :
                            ((W = e._limitOffset(W, e.options.maxBounds)),
                                D(function() {
                                    e.panBy(W, {
                                        duration: F,
                                        easeLinearity: m,
                                        noMoveStart: !0,
                                        animate: !0,
                                    });
                                }));
                    }
                },
            });
            Y.addInitHook("addHandler", "dragging", Yn),
                Y.mergeOptions({
                    keyboard: !0,
                    keyboardPanDelta: 80
                });
            var Xn = Mt.extend({
                keyCodes: {
                    left: [37],
                    right: [39],
                    down: [40],
                    up: [38],
                    zoomIn: [187, 107, 61, 171],
                    zoomOut: [189, 109, 54, 173],
                },
                initialize: function(t) {
                    (this._map = t),
                    this._setPanDelta(t.options.keyboardPanDelta),
                        this._setZoomDelta(t.options.zoomDelta);
                },
                addHooks: function() {
                    var t = this._map._container;
                    t.tabIndex <= 0 && (t.tabIndex = "0"),
                        G(
                            t, {
                                focus: this._onFocus,
                                blur: this._onBlur,
                                mousedown: this._onMouseDown,
                            },
                            this
                        ),
                        this._map.on({
                                focus: this._addHooks,
                                blur: this._removeHooks
                            },
                            this
                        );
                },
                removeHooks: function() {
                    this._removeHooks(),
                        Q(
                            this._map._container, {
                                focus: this._onFocus,
                                blur: this._onBlur,
                                mousedown: this._onMouseDown,
                            },
                            this
                        ),
                        this._map.off({
                                focus: this._addHooks,
                                blur: this._removeHooks
                            },
                            this
                        );
                },
                _onMouseDown: function() {
                    if (!this._focused) {
                        var t = document.body,
                            e = document.documentElement,
                            i = t.scrollTop || e.scrollTop,
                            s = t.scrollLeft || e.scrollLeft;
                        this._map._container.focus(), window.scrollTo(s, i);
                    }
                },
                _onFocus: function() {
                    (this._focused = !0), this._map.fire("focus");
                },
                _onBlur: function() {
                    (this._focused = !1), this._map.fire("blur");
                },
                _setPanDelta: function(t) {
                    var e = (this._panKeys = {}),
                        i = this.keyCodes,
                        s,
                        l;
                    for (s = 0, l = i.left.length; s < l; s++) e[i.left[s]] = [-1 * t, 0];
                    for (s = 0, l = i.right.length; s < l; s++) e[i.right[s]] = [t, 0];
                    for (s = 0, l = i.down.length; s < l; s++) e[i.down[s]] = [0, t];
                    for (s = 0, l = i.up.length; s < l; s++) e[i.up[s]] = [0, -1 * t];
                },
                _setZoomDelta: function(t) {
                    var e = (this._zoomKeys = {}),
                        i = this.keyCodes,
                        s,
                        l;
                    for (s = 0, l = i.zoomIn.length; s < l; s++) e[i.zoomIn[s]] = t;
                    for (s = 0, l = i.zoomOut.length; s < l; s++) e[i.zoomOut[s]] = -t;
                },
                _addHooks: function() {
                    G(document, "keydown", this._onKeyDown, this);
                },
                _removeHooks: function() {
                    Q(document, "keydown", this._onKeyDown, this);
                },
                _onKeyDown: function(t) {
                    if (!(t.altKey || t.ctrlKey || t.metaKey)) {
                        var e = t.keyCode,
                            i = this._map,
                            s;
                        if (e in this._panKeys) {
                            if (!i._panAnim || !i._panAnim._inProgress)
                                if (
                                    ((s = this._panKeys[e]),
                                        t.shiftKey && (s = Z(s).multiplyBy(3)),
                                        i.options.maxBounds &&
                                        (s = i._limitOffset(Z(s), i.options.maxBounds)),
                                        i.options.worldCopyJump)
                                ) {
                                    var l = i.wrapLatLng(
                                        i.unproject(i.project(i.getCenter()).add(s))
                                    );
                                    i.panTo(l);
                                } else i.panBy(s);
                        } else if (e in this._zoomKeys)
                            i.setZoom(i.getZoom() + (t.shiftKey ? 3 : 1) * this._zoomKeys[e]);
                        else if (e === 27 && i._popup && i._popup.options.closeOnEscapeKey)
                            i.closePopup();
                        else return;
                        Ut(t);
                    }
                },
            });
            Y.addInitHook("addHandler", "keyboard", Xn),
                Y.mergeOptions({
                    scrollWheelZoom: !0,
                    wheelDebounceTime: 40,
                    wheelPxPerZoomLevel: 60,
                });
            var $n = Mt.extend({
                addHooks: function() {
                    G(this._map._container, "wheel", this._onWheelScroll, this),
                        (this._delta = 0);
                },
                removeHooks: function() {
                    Q(this._map._container, "wheel", this._onWheelScroll, this);
                },
                _onWheelScroll: function(t) {
                    var e = bn(t),
                        i = this._map.options.wheelDebounceTime;
                    (this._delta += e),
                    (this._lastMousePos = this._map.mouseEventToContainerPoint(t)),
                    this._startTime || (this._startTime = +new Date());
                    var s = Math.max(i - (+new Date() - this._startTime), 0);
                    clearTimeout(this._timer),
                        (this._timer = setTimeout(f(this._performZoom, this), s)),
                        Ut(t);
                },
                _performZoom: function() {
                    var t = this._map,
                        e = t.getZoom(),
                        i = this._map.options.zoomSnap || 0;
                    t._stop();
                    var s = this._delta / (this._map.options.wheelPxPerZoomLevel * 4),
                        l = (4 * Math.log(2 / (1 + Math.exp(-Math.abs(s))))) / Math.LN2,
                        c = i ? Math.ceil(l / i) * i : l,
                        m = t._limitZoom(e + (this._delta > 0 ? c : -c)) - e;
                    (this._delta = 0),
                    (this._startTime = null),
                    m &&
                        (t.options.scrollWheelZoom === "center" ?
                            t.setZoom(e + m) :
                            t.setZoomAround(this._lastMousePos, e + m));
                },
            });
            Y.addInitHook("addHandler", "scrollWheelZoom", $n);
            var Rs = 600;
            Y.mergeOptions({
                tapHold: N.touchNative && N.safari && N.mobile,
                tapTolerance: 15,
            });
            var Kn = Mt.extend({
                addHooks: function() {
                    G(this._map._container, "touchstart", this._onDown, this);
                },
                removeHooks: function() {
                    Q(this._map._container, "touchstart", this._onDown, this);
                },
                _onDown: function(t) {
                    if ((clearTimeout(this._holdTimeout), t.touches.length === 1)) {
                        var e = t.touches[0];
                        (this._startPos = this._newPos = new I(e.clientX, e.clientY)),
                        (this._holdTimeout = setTimeout(
                            f(function() {
                                this._cancel(),
                                    this._isTapValid() &&
                                    (G(document, "touchend", ut),
                                        G(
                                            document,
                                            "touchend touchcancel",
                                            this._cancelClickPrevent
                                        ),
                                        this._simulateEvent("contextmenu", e));
                            }, this),
                            Rs
                        )),
                        G(document, "touchend touchcancel contextmenu", this._cancel, this),
                            G(document, "touchmove", this._onMove, this);
                    }
                },
                _cancelClickPrevent: function t() {
                    Q(document, "touchend", ut), Q(document, "touchend touchcancel", t);
                },
                _cancel: function() {
                    clearTimeout(this._holdTimeout),
                        Q(document, "touchend touchcancel contextmenu", this._cancel, this),
                        Q(document, "touchmove", this._onMove, this);
                },
                _onMove: function(t) {
                    var e = t.touches[0];
                    this._newPos = new I(e.clientX, e.clientY);
                },
                _isTapValid: function() {
                    return (
                        this._newPos.distanceTo(this._startPos) <=
                        this._map.options.tapTolerance
                    );
                },
                _simulateEvent: function(t, e) {
                    var i = new MouseEvent(t, {
                        bubbles: !0,
                        cancelable: !0,
                        view: window,
                        screenX: e.screenX,
                        screenY: e.screenY,
                        clientX: e.clientX,
                        clientY: e.clientY,
                    });
                    (i._simulated = !0), e.target.dispatchEvent(i);
                },
            });
            Y.addInitHook("addHandler", "tapHold", Kn),
                Y.mergeOptions({
                    touchZoom: N.touch,
                    bounceAtZoomLimits: !0
                });
            var Jn = Mt.extend({
                addHooks: function() {
                    V(this._map._container, "leaflet-touch-zoom"),
                        G(this._map._container, "touchstart", this._onTouchStart, this);
                },
                removeHooks: function() {
                    it(this._map._container, "leaflet-touch-zoom"),
                        Q(this._map._container, "touchstart", this._onTouchStart, this);
                },
                _onTouchStart: function(t) {
                    var e = this._map;
                    if (
                        !(
                            !t.touches ||
                            t.touches.length !== 2 ||
                            e._animatingZoom ||
                            this._zooming
                        )
                    ) {
                        var i = e.mouseEventToContainerPoint(t.touches[0]),
                            s = e.mouseEventToContainerPoint(t.touches[1]);
                        (this._centerPoint = e.getSize()._divideBy(2)),
                        (this._startLatLng = e.containerPointToLatLng(this._centerPoint)),
                        e.options.touchZoom !== "center" &&
                            (this._pinchStartLatLng = e.containerPointToLatLng(
                                i.add(s)._divideBy(2)
                            )),
                            (this._startDist = i.distanceTo(s)),
                            (this._startZoom = e.getZoom()),
                            (this._moved = !1),
                            (this._zooming = !0),
                            e._stop(),
                            G(document, "touchmove", this._onTouchMove, this),
                            G(document, "touchend touchcancel", this._onTouchEnd, this),
                            ut(t);
                    }
                },
                _onTouchMove: function(t) {
                    if (!(!t.touches || t.touches.length !== 2 || !this._zooming)) {
                        var e = this._map,
                            i = e.mouseEventToContainerPoint(t.touches[0]),
                            s = e.mouseEventToContainerPoint(t.touches[1]),
                            l = i.distanceTo(s) / this._startDist;
                        if (
                            ((this._zoom = e.getScaleZoom(l, this._startZoom)),
                                !e.options.bounceAtZoomLimits &&
                                ((this._zoom < e.getMinZoom() && l < 1) ||
                                    (this._zoom > e.getMaxZoom() && l > 1)) &&
                                (this._zoom = e._limitZoom(this._zoom)),
                                e.options.touchZoom === "center")
                        ) {
                            if (((this._center = this._startLatLng), l === 1)) return;
                        } else {
                            var c = i._add(s)._divideBy(2)._subtract(this._centerPoint);
                            if (l === 1 && c.x === 0 && c.y === 0) return;
                            this._center = e.unproject(
                                e.project(this._pinchStartLatLng, this._zoom).subtract(c),
                                this._zoom
                            );
                        }
                        this._moved || (e._moveStart(!0, !1), (this._moved = !0)),
                            R(this._animRequest);
                        var m = f(
                            e._move,
                            e,
                            this._center,
                            this._zoom, {
                                pinch: !0,
                                round: !1
                            },
                            void 0
                        );
                        (this._animRequest = D(m, this, !0)), ut(t);
                    }
                },
                _onTouchEnd: function() {
                    if (!this._moved || !this._zooming) {
                        this._zooming = !1;
                        return;
                    }
                    (this._zooming = !1),
                    R(this._animRequest),
                        Q(document, "touchmove", this._onTouchMove, this),
                        Q(document, "touchend touchcancel", this._onTouchEnd, this),
                        this._map.options.zoomAnimation ?
                        this._map._animateZoom(
                            this._center,
                            this._map._limitZoom(this._zoom),
                            !0,
                            this._map.options.zoomSnap
                        ) :
                        this._map._resetView(
                            this._center,
                            this._map._limitZoom(this._zoom)
                        );
                },
            });
            Y.addInitHook("addHandler", "touchZoom", Jn),
                (Y.BoxZoom = qn),
                (Y.DoubleClickZoom = Un),
                (Y.Drag = Yn),
                (Y.Keyboard = Xn),
                (Y.ScrollWheelZoom = $n),
                (Y.TapHold = Kn),
                (Y.TouchZoom = Jn),
                (r.Bounds = $),
                (r.Browser = N),
                (r.CRS = At),
                (r.Canvas = Gn),
                (r.Circle = bi),
                (r.CircleMarker = Me),
                (r.Class = q),
                (r.Control = Pt),
                (r.DivIcon = Rn),
                (r.DivOverlay = Ct),
                (r.DomEvent = ns),
                (r.DomUtil = es),
                (r.Draggable = Ht),
                (r.Evented = kt),
                (r.FeatureGroup = Ot),
                (r.GeoJSON = Bt),
                (r.GridLayer = _e),
                (r.Handler = Mt),
                (r.Icon = Qt),
                (r.ImageOverlay = Oe),
                (r.LatLng = J),
                (r.LatLngBounds = pt),
                (r.Layer = St),
                (r.LayerGroup = Jt),
                (r.LineUtil = _s),
                (r.Map = Y),
                (r.Marker = Ee),
                (r.Mixin = us),
                (r.Path = Gt),
                (r.Point = I),
                (r.PolyUtil = cs),
                (r.Polygon = te),
                (r.Polyline = zt),
                (r.Popup = ze),
                (r.PosAnimation = xn),
                (r.Projection = gs),
                (r.Rectangle = jn),
                (r.Renderer = Zt),
                (r.SVG = ve),
                (r.SVGOverlay = Nn),
                (r.TileLayer = ie),
                (r.Tooltip = Be),
                (r.Transformation = qe),
                (r.Util = H),
                (r.VideoOverlay = Dn),
                (r.bind = f),
                (r.bounds = ot),
                (r.canvas = Vn),
                (r.circle = Ss),
                (r.circleMarker = Ps),
                (r.control = fe),
                (r.divIcon = zs),
                (r.extend = d),
                (r.featureGroup = xs),
                (r.geoJSON = Zn),
                (r.geoJson = Ms),
                (r.gridLayer = Bs),
                (r.icon = ws),
                (r.imageOverlay = Cs),
                (r.latLng = U),
                (r.latLngBounds = nt),
                (r.layerGroup = bs),
                (r.map = rs),
                (r.marker = Ts),
                (r.point = Z),
                (r.polygon = Es),
                (r.polyline = Ls),
                (r.popup = As),
                (r.rectangle = Ns),
                (r.setOptions = b),
                (r.stamp = h),
                (r.svg = Wn),
                (r.svgOverlay = ks),
                (r.tileLayer = Fn),
                (r.tooltip = Os),
                (r.transformation = se),
                (r.version = a),
                (r.videoOverlay = Is);
            var Fs = window.L;
            (r.noConflict = function() {
                return (window.L = Fs), this;
            }),
            (window.L = r);
        });
    })(Fi, Fi.exports);
    var Nt = Fi.exports;
    const vt = Qs(Nt);
    Nt.Icon.Default.mergeOptions({
        iconUrl: null,
        iconRetinaUrl: null,
        shadowUrl: null,
        iconSize: null,
        iconAnchor: null,
        popupAnchor: null,
        tooltipAnchor: null,
        shadowSize: null,
        classNamePrefix: "leaflet-default-icon-",
    });
    Nt.Icon.Default.include({
        _needsInit: !0,
        _getIconUrl: function(o) {
            var n = this.options.imagePath || Nt.Icon.Default.imagePath || "";
            return (
                this._needsInit && this._initializeOptions(n),
                n + Nt.Icon.prototype._getIconUrl.call(this, o)
            );
        },
        _initializeOptions: function(o) {
            this._setOptions("icon", nr, o),
                this._setOptions("shadow", nr, o),
                this._setOptions("popup", rr),
                this._setOptions("tooltip", rr),
                (this._needsInit = !1);
        },
        _setOptions: function(o, n, r) {
            var a = this.options,
                d = a.classNamePrefix,
                u = n(d + o, r);
            for (var f in u) a[o + f] = a[o + f] || u[f];
        },
    });

    function nr(o, n) {
        var r = Nt.DomUtil.create("div", o, document.body),
            a = io(r),
            d = to(a, n),
            u = re(r, "width"),
            f = re(r, "height"),
            p = re(r, "margin-left"),
            h = re(r, "margin-top");
        return (
            r.parentNode.removeChild(r), {
                Url: d[0],
                RetinaUrl: d[1],
                Size: [u, f],
                Anchor: [-p, -h]
            }
        );
    }

    function rr(o) {
        var n = Nt.DomUtil.create("div", o, document.body),
            r = re(n, "margin-left"),
            a = re(n, "margin-top");
        return n.parentNode.removeChild(n), {
            Anchor: [r, a]
        };
    }

    function to(o, n) {
        for (var r = /url\(['"]?([^"']*?)['"]?\)/gi, a = [], d = r.exec(o); d;)
            a.push(n ? eo(d[1]) : d[1]), (d = r.exec(o));
        return a;
    }

    function eo(o) {
        return o.substr(o.lastIndexOf("/") + 1);
    }

    function re(o, n) {
        return parseInt(Hi(o, n), 10);
    }

    function Hi(o, n) {
        return Nt.DomUtil.getStyle(o, n) || Nt.DomUtil.getStyle(o, no(n));
    }

    function io(o) {
        var n = Hi(o, "background-image");
        return n && n !== "none" ? n : Hi(o, "cursor");
    }

    function no(o) {
        return o.replace(/-(\w)/g, function(n, r) {
            return r.toUpperCase();
        });
    }
    const ro =
        "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAoCAYAAACfKfiZAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAMXSURBVHgBvVhdbtpAEJ71GoTyIzlvkQKSe4K2Jyg8VCnqQ+AEVU5QcgLICVpuQE9A+oToC/QEpSeoJUDKW/0ASVRhb2ccQ4z52TF/n2Sxtndnvp2ZnRkjYAM0LcvK4AWTiU33vlLuv/HYKbuuCwkhuBNb2WxeKVWSAFcghL10klI9BdDzAOofh8MeQ6yeACnGSVW88pAASKSL121xMOjCJgTIzEenp1XcVQW2AFqt8Tge36xyz1ICrfNz25Cys9LUyVk4vucVivf3DugI7Fy5hoQRvSGz70U5AWWi7CbpWEkg8Pk+lL+QeHN0fFydezQdBKY3zT9wAPgAhenpeLGAlDU4EOhYR8bJdy+EcDH7fcMjFiQbwzDy+PMOA83myngYjc7oaJqBwHS6BL7PWohK6w+mWSs7TvRcN1q2bcvJpILJ5zNHTubkpAKuWwsIGL5/pRiLcOeNy8FgaWIqOo6DP5X2xYWFEz9pZZHFYBoDGJ3AgCflrW5OOpWqkIt085BAoNPo2LaFZrV0C9BC38NdrkUBXYPx8RP0sIK884QDxmQiwKpuSeZSSTeACcGw0iYwMgC8JkKI18CEDANMhyc8hkEe+JHL/eXEQTSDrUKCnOLiiTp7dkGYUHQwlPoSLyZRzIoZA7iZ34HM6I0Wz8XkF3VJ8Vf0jN5xi5kINx0kIozaO8HMYEFZBehgwukpIRy8d4Xv5/GNjWPgAtfeBeKmD7hxsBMg8ct+/xUNZ8eQigscCLjr7nQ8I6BM8yscCNGUPiNAaTbKbF+gghZN6XOZ0DPNa9gz4gVtjkBohTrsCdRLxAvaQi1IYbNBUQq7Bsp8TKVq8ccLBMJyunNXkMxYF7WcACHM99rmg618zTfi2tTVzuWa6LgSbAEDM977fr+88v26xWkpr0WCRmQB6PcRylg3ZS0Bigc8muWNghLX+FIWlvl9bhowQC234Xkddt8fKuf0kPx/SLgkEignsHtCEkiCNe7oJVGeiMCUBAbmWwhr+RywmuIXUyLlBH4HEUM7m61B+JGJKfbmw3B4sGo6A8UFXbAF/gOjXVdgD1BoTAAAAABJRU5ErkJggg==",
        sr = document.querySelector("#map"),
        so = document.querySelector(".map-message-bg"),
        oo = document.querySelector(".map-message-para"),
        Ii = document.querySelector("#map-btn"),
        ki = document.querySelector("#map-contacts"),
        or = document.querySelector("#map-buttons"),
        ar = document.querySelectorAll(".office-btn");

    function ao() {
        sr.addEventListener("keydown", (b) => {
                b.code === "KeyM" &&
                    (so.classList.remove("map-message-bg"),
                        (oo.style.opacity = "0"),
                        r.scrollWheelZoom.enable(),
                        r.dragging.enable());
            }),
            sr.addEventListener("keyup", (b) => {
                b.code === "KeyM" && (r.scrollWheelZoom.disable(), r.dragging.disable());
            });
        const o = (b) => {
                switch (b) {
                    case "استانبول":
                        r.setView([41.0082, 28.9784], 15),
                            (ki.innerHTML = Ai.istanbul1),
                            (or.innerHTML = lr.istanbul);
                        break;
                    case "تهران":
                        r.setView([35.7219, 51.3347], 15),
                            (ki.innerHTML = Ai.tehran1),
                            (or.innerHTML = lr.tehran);
                        break;
                }
            },
            n = (b) => {
                var E, A;
                let C = (E = b.target) == null ? void 0 : E.closest("button");
                switch (
                    (console.log("dawd"),
                        (A = document.querySelector(".active-office-btn")) == null ||
                        A.classList.remove("active-office-btn"),
                        C.classList.add("active-office-btn"),
                        C.id)
                ) {
                    case "istanbul1":
                        r.setView([41.02, 28.91], 15);
                        break;
                    case "istanbul2":
                        r.setView([41.028, 28.02], 15);
                        break;
                    case "istanbul3":
                        r.setView([41.04, 28.35], 15);
                        break;
                    case "istanbul4":
                        r.setView([41.039, 28.991], 15);
                        break;
                    case "istanbul5":
                        r.setView([41.044, 28.944], 15);
                        break;
                    case "tehran1":
                        r.setView([35.7209, 51.3347], 15);
                        break;
                    case "tehran2":
                        r.setView([35.73, 51.35], 15);
                        break;
                    case "tehran3":
                        r.setView([35.74, 51.36], 15);
                        break;
                    case "tehran4":
                        r.setView([35.78, 51.3], 15);
                        break;
                    case "tehran5":
                        r.setView([35.6, 51.8], 15);
                        break;
                }
                ki.innerHTML = Ai[C.id];
            };
        Ii.addEventListener("change", () => {
            console.log(Ii.value), o(Ii.value);
            const b = document.querySelectorAll(".office-btn");
            for (let C = 0; C < b.length; C++)
                b[C].addEventListener("click", (A) => {
                    n(A);
                });
        });
        for (let b = 0; b < ar.length; b++)
            ar[b].addEventListener("click", (E) => {
                n(E);
            });
        const r = vt
            .map("map", {
                scrollWheelZoom: !1,
                zoomControl: !1,
                touchZoom: !0,
                dragging: !1,
            })
            .setView([41.02, 28.99], 15),
            a = vt.tileLayer(
                "https://tile.jawg.io/jawg-dark/{z}/{x}/{y}{r}.png?access-token={accessToken}", {
                    attribution: '<a href="https://jawg.io" title="Tiles Courtesy of Jawg Maps" target="_blank">&copy; <b>Jawg</b>Maps</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    minZoom: 0,
                    maxZoom: 22,
                    accessToken: "I9sI0BJkoA8vTSwh5gd10q0QdjBr5Ur78Ta1HxCBnB2omlZkOVevdX2UJfvlDv7n",
                }
            );
        r.addLayer(a);
        const d = vt.icon({
                iconUrl: ro,
                iconSize: [44, 44]
            }),
            u = vt.marker([41.02, 28.99], {
                icon: d
            });
        u.bindPopup(
            "<p>Istanbul, Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>"
        );
        const f = vt.marker([41.028, 28.02], {
            icon: d
        });
        u.bindPopup(
            "<p>Istanbul, Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>"
        );
        const p = vt.marker([41.04, 28.35], {
            icon: d
        });
        u.bindPopup(
            "<p>Istanbul, Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>"
        );
        const h = vt.marker([41.039, 28.991], {
            icon: d
        });
        u.bindPopup(
            "<p>Istanbul, Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>"
        );
        const y = vt.marker([41.044, 28.944], {
            icon: d
        });
        u.bindPopup(
            "<p>Istanbul, Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>"
        );
        const g = vt.marker([35.7209, 51.3347], {
            icon: d
        });
        g.bindPopup(
            "<p>Tehran, Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>"
        );
        const v = vt.marker([35.73, 51.35], {
            icon: d
        });
        g.bindPopup(
            "<p>Tehran, Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>"
        );
        const P = vt.marker([35.74, 51.36], {
            icon: d
        });
        g.bindPopup(
            "<p>Tehran, Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>"
        );
        const T = vt.marker([35.78, 51.3], {
            icon: d
        });
        g.bindPopup(
            "<p>Tehran, Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>"
        );
        const w = vt.marker([35.6, 51.8], {
            icon: d
        });
        g.bindPopup(
                "<p>Tehran, Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>"
            ),
            r.addLayer(u),
            r.addLayer(f),
            r.addLayer(p),
            r.addLayer(h),
            r.addLayer(y),
            r.addLayer(g),
            r.addLayer(v),
            r.addLayer(P),
            r.addLayer(T),
            r.addLayer(w),
            window.matchMedia("(max-width: 840px)").matches && r.dragging.disable();
    }
    const lr = {
            istanbul: `<button id="istanbul1" class="active-office-btn office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
            Istanbul 1
        </button>
        <button id="istanbul2" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
            Istanbul 2
        </button>
        <button id="istanbul3" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
            Istanbul 3
        </button>
        <button id="istanbul4" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
            Istanbul 4
        </button>
        <button id="istanbul5" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
            Istanbul 5
        </button>`,
            tehran: `<button id="tehran1" class="active-office-btn office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
            Tehran 1
        </button>
        <button id="tehran2" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
            Tehran 2
        </button>
        <button id="tehran3" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
            Tehran 3
        </button>
        <button id="tehran4" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
            Tehran 4
        </button>
        <button id="tehran5" class="office-btn pointer-events-auto pri-btn text-vkl-t-sub font-normal rounded-md bg-neutral-950 border-1  border-red-700  hover:bg-red-700 hover:text-neutral-50">
            Tehran 5
        </button>`,
        },
        Ai = {
            istanbul1: ` <h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
        Istanbul Main Office
        </h3>

        <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
            <span
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit</span
            >
        </li>
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="mailto:email@gmail.com">email@gmail.com</a>
        </li>
        </ul>`,
            istanbul2: ` <h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
        Istanbul 2 Office
        </h3>

        <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
            <span
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit</span
            >
        </li>
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="mailto:email@gmail.com">email@gmail.com</a>
        </li>
        </ul>`,
            istanbul3: ` <h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
        Istanbul 3 Office
        </h3>

        <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
            <span
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit</span
            >
        </li>
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="mailto:email@gmail.com">email@gmail.com</a>
        </li>
        </ul>`,
            istanbul4: ` <h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
        Istanbul 4 Office
        </h3>

        <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
            <span
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit</span
            >
        </li>
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="mailto:email@gmail.com">email@gmail.com</a>
        </li>
        </ul>`,
            istanbul5: ` <h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
        Istanbul 5 Office
        </h3>

        <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
            <span
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit</span
            >
        </li>
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="mailto:email@gmail.com">email@gmail.com</a>
        </li>
        </ul>`,
            tehran1: `<h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
        Tehran Main Office
        </h3>

        <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
            <span
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit</span
            >
        </li>
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="mailto:email@gmail.com">email@gmail.com</a>
        </li>
        </ul>`,
            tehran2: `<h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
        Tehran 2 Office
        </h3>

        <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
            <span
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit</span
            >
        </li>
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="mailto:email@gmail.com">email@gmail.com</a>
        </li>
        </ul>`,
            tehran3: `<h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
        Tehran 3 Office
        </h3>

        <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
            <span
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit</span
            >
        </li>
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="mailto:email@gmail.com">email@gmail.com</a>
        </li>
        </ul>`,
            tehran4: `<h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
        Tehran 4 Office
        </h3>

        <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
            <span
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit</span
            >
        </li>
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="mailto:email@gmail.com">email@gmail.com</a>
        </li>
        </ul>`,
            tehran5: `<h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
        Tehran 5 Office
        </h3>

        <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
            <span
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit</span
            >
        </li>
        <li class="flex justify-start items-center gap-2">
            <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="tel:098123456789">098123456789</a>
        </li>
        <li class="flex justify-start items-center gap-2">
            <span
            ><i class="ph text-red-700 ph-envelope-simple text-xl"></i
            ></span>
            <a href="mailto:email@gmail.com">email@gmail.com</a>
        </li>
        </ul>`,
        },
        ft = document.querySelector("header");

    function vr() {
        let o = 100;
        window.addEventListener("scroll", () => {
            let n = window.scrollY || document.documentElement.scrollTop;
            n > o ?
                (ft == null || ft.classList.add("sticky-desck"),
                    ft == null || ft.classList.remove("sticky-desck-up")) :
                n < o &&
                (ft == null || ft.classList.remove("sticky-desck"),
                    ft == null || ft.classList.add("sticky-desck-up")),
                n == 0 && (ft == null || ft.classList.remove("sticky-desck-up")),
                (o = n <= 0 ? 0 : n);
        });
    }
    vr();

    function dr(o) {
        return (
            o !== null &&
            typeof o == "object" &&
            "constructor" in o &&
            o.constructor === Object
        );
    }

    function Wi(o, n) {
        o === void 0 && (o = {}),
            n === void 0 && (n = {}),
            Object.keys(n).forEach((r) => {
                typeof o[r] > "u" ?
                    (o[r] = n[r]) :
                    dr(n[r]) &&
                    dr(o[r]) &&
                    Object.keys(n[r]).length > 0 &&
                    Wi(o[r], n[r]);
            });
    }
    const yr = {
        body: {},
        addEventListener() {},
        removeEventListener() {},
        activeElement: {
            blur() {},
            nodeName: ""
        },
        querySelector() {
            return null;
        },
        querySelectorAll() {
            return [];
        },
        getElementById() {
            return null;
        },
        createEvent() {
            return {
                initEvent() {}
            };
        },
        createElement() {
            return {
                children: [],
                childNodes: [],
                style: {},
                setAttribute() {},
                getElementsByTagName() {
                    return [];
                },
            };
        },
        createElementNS() {
            return {};
        },
        importNode() {
            return null;
        },
        location: {
            hash: "",
            host: "",
            hostname: "",
            href: "",
            origin: "",
            pathname: "",
            protocol: "",
            search: "",
        },
    };

    function Rt() {
        const o = typeof document < "u" ? document : {};
        return Wi(o, yr), o;
    }
    const lo = {
        document: yr,
        navigator: {
            userAgent: ""
        },
        location: {
            hash: "",
            host: "",
            hostname: "",
            href: "",
            origin: "",
            pathname: "",
            protocol: "",
            search: "",
        },
        history: {
            replaceState() {},
            pushState() {},
            go() {},
            back() {}
        },
        CustomEvent: function() {
            return this;
        },
        addEventListener() {},
        removeEventListener() {},
        getComputedStyle() {
            return {
                getPropertyValue() {
                    return "";
                },
            };
        },
        Image() {},
        Date() {},
        screen: {},
        setTimeout() {},
        clearTimeout() {},
        matchMedia() {
            return {};
        },
        requestAnimationFrame(o) {
            return typeof setTimeout > "u" ? (o(), null) : setTimeout(o, 0);
        },
        cancelAnimationFrame(o) {
            typeof setTimeout > "u" || clearTimeout(o);
        },
    };

    function bt() {
        const o = typeof window < "u" ? window : {};
        return Wi(o, lo), o;
    }

    function uo(o) {
        return (
            o === void 0 && (o = ""),
            o
            .trim()
            .split(" ")
            .filter((n) => !!n.trim())
        );
    }

    function co(o) {
        const n = o;
        Object.keys(n).forEach((r) => {
            try {
                n[r] = null;
            } catch {}
            try {
                delete n[r];
            } catch {}
        });
    }

    function Gi(o, n) {
        return n === void 0 && (n = 0), setTimeout(o, n);
    }

    function Ge() {
        return Date.now();
    }

    function ho(o) {
        const n = bt();
        let r;
        return (
            n.getComputedStyle && (r = n.getComputedStyle(o, null)),
            !r && o.currentStyle && (r = o.currentStyle),
            r || (r = o.style),
            r
        );
    }

    function fo(o, n) {
        n === void 0 && (n = "x");
        const r = bt();
        let a, d, u;
        const f = ho(o);
        return (
            r.WebKitCSSMatrix ?
            ((d = f.transform || f.webkitTransform),
                d.split(",").length > 6 &&
                (d = d
                    .split(", ")
                    .map((p) => p.replace(",", "."))
                    .join(", ")),
                (u = new r.WebKitCSSMatrix(d === "none" ? "" : d))) :
            ((u =
                    f.MozTransform ||
                    f.OTransform ||
                    f.MsTransform ||
                    f.msTransform ||
                    f.transform ||
                    f
                    .getPropertyValue("transform")
                    .replace("translate(", "matrix(1, 0, 0, 1,")),
                (a = u.toString().split(","))),
            n === "x" &&
            (r.WebKitCSSMatrix ?
                (d = u.m41) :
                a.length === 16 ?
                (d = parseFloat(a[12])) :
                (d = parseFloat(a[4]))),
            n === "y" &&
            (r.WebKitCSSMatrix ?
                (d = u.m42) :
                a.length === 16 ?
                (d = parseFloat(a[13])) :
                (d = parseFloat(a[5]))),
            d || 0
        );
    }

    function Ne(o) {
        return (
            typeof o == "object" &&
            o !== null &&
            o.constructor &&
            Object.prototype.toString.call(o).slice(8, -1) === "Object"
        );
    }

    function po(o) {
        return typeof window < "u" && typeof window.HTMLElement < "u" ?
            o instanceof HTMLElement :
            o && (o.nodeType === 1 || o.nodeType === 11);
    }

    function yt() {
        const o = Object(arguments.length <= 0 ? void 0 : arguments[0]),
            n = ["__proto__", "constructor", "prototype"];
        for (let r = 1; r < arguments.length; r += 1) {
            const a = r < 0 || arguments.length <= r ? void 0 : arguments[r];
            if (a != null && !po(a)) {
                const d = Object.keys(Object(a)).filter((u) => n.indexOf(u) < 0);
                for (let u = 0, f = d.length; u < f; u += 1) {
                    const p = d[u],
                        h = Object.getOwnPropertyDescriptor(a, p);
                    h !== void 0 &&
                        h.enumerable &&
                        (Ne(o[p]) && Ne(a[p]) ?
                            a[p].__swiper__ ?
                            (o[p] = a[p]) :
                            yt(o[p], a[p]) :
                            !Ne(o[p]) && Ne(a[p]) ?
                            ((o[p] = {}), a[p].__swiper__ ? (o[p] = a[p]) : yt(o[p], a[p])) :
                            (o[p] = a[p]));
                }
            }
        }
        return o;
    }

    function Re(o, n, r) {
        o.style.setProperty(n, r);
    }

    function br(o) {
        let {
            swiper: n,
            targetPosition: r,
            side: a
        } = o;
        const d = bt(),
            u = -n.translate;
        let f = null,
            p;
        const h = n.params.speed;
        (n.wrapperEl.style.scrollSnapType = "none"),
        d.cancelAnimationFrame(n.cssModeFrameID);
        const y = r > u ? "next" : "prev",
            g = (P, T) => (y === "next" && P >= T) || (y === "prev" && P <= T),
            v = () => {
                (p = new Date().getTime()), f === null && (f = p);
                const P = Math.max(Math.min((p - f) / h, 1), 0),
                    T = 0.5 - Math.cos(P * Math.PI) / 2;
                let w = u + T * (r - u);
                if ((g(w, r) && (w = r), n.wrapperEl.scrollTo({
                        [a]: w
                    }), g(w, r))) {
                    (n.wrapperEl.style.overflow = "hidden"),
                    (n.wrapperEl.style.scrollSnapType = ""),
                    setTimeout(() => {
                            (n.wrapperEl.style.overflow = ""), n.wrapperEl.scrollTo({
                                [a]: w
                            });
                        }),
                        d.cancelAnimationFrame(n.cssModeFrameID);
                    return;
                }
                n.cssModeFrameID = d.requestAnimationFrame(v);
            };
        v();
    }

    function It(o, n) {
        return n === void 0 && (n = ""), [...o.children].filter((r) => r.matches(n));
    }

    function Ve(o) {
        try {
            console.warn(o);
            return;
        } catch {}
    }

    function We(o, n) {
        n === void 0 && (n = []);
        const r = document.createElement(o);
        return r.classList.add(...(Array.isArray(n) ? n : uo(n))), r;
    }

    function mo(o, n) {
        const r = [];
        for (; o.previousElementSibling;) {
            const a = o.previousElementSibling;
            n ? a.matches(n) && r.push(a) : r.push(a), (o = a);
        }
        return r;
    }

    function _o(o, n) {
        const r = [];
        for (; o.nextElementSibling;) {
            const a = o.nextElementSibling;
            n ? a.matches(n) && r.push(a) : r.push(a), (o = a);
        }
        return r;
    }

    function Vt(o, n) {
        return bt().getComputedStyle(o, null).getPropertyValue(n);
    }

    function ur(o) {
        let n = o,
            r;
        if (n) {
            for (r = 0;
                (n = n.previousSibling) !== null;)
                n.nodeType === 1 && (r += 1);
            return r;
        }
    }

    function go(o, n) {
        const r = [];
        let a = o.parentElement;
        for (; a;) n ? a.matches(n) && r.push(a) : r.push(a), (a = a.parentElement);
        return r;
    }

    function cr(o, n, r) {
        const a = bt();
        return r ?
            o[n === "width" ? "offsetWidth" : "offsetHeight"] +
            parseFloat(
                a
                .getComputedStyle(o, null)
                .getPropertyValue(n === "width" ? "margin-right" : "margin-top")
            ) +
            parseFloat(
                a
                .getComputedStyle(o, null)
                .getPropertyValue(n === "width" ? "margin-left" : "margin-bottom")
            ) :
            o.offsetWidth;
    }

    function Dt(o) {
        return (Array.isArray(o) ? o : [o]).filter((n) => !!n);
    }
    let Oi;

    function vo() {
        const o = bt(),
            n = Rt();
        return {
            smoothScroll: n.documentElement &&
                n.documentElement.style &&
                "scrollBehavior" in n.documentElement.style,
            touch: !!(
                "ontouchstart" in o ||
                (o.DocumentTouch && n instanceof o.DocumentTouch)
            ),
        };
    }

    function xr() {
        return Oi || (Oi = vo()), Oi;
    }
    let zi;

    function yo(o) {
        let {
            userAgent: n
        } = o === void 0 ? {} : o;
        const r = xr(),
            a = bt(),
            d = a.navigator.platform,
            u = n || a.navigator.userAgent,
            f = {
                ios: !1,
                android: !1
            },
            p = a.screen.width,
            h = a.screen.height,
            y = u.match(/(Android);?[\s\/]+([\d.]+)?/);
        let g = u.match(/(iPad).*OS\s([\d_]+)/);
        const v = u.match(/(iPod)(.*OS\s([\d_]+))?/),
            P = !g && u.match(/(iPhone\sOS|iOS)\s([\d_]+)/),
            T = d === "Win32";
        let w = d === "MacIntel";
        const b = [
            "1024x1366",
            "1366x1024",
            "834x1194",
            "1194x834",
            "834x1112",
            "1112x834",
            "768x1024",
            "1024x768",
            "820x1180",
            "1180x820",
            "810x1080",
            "1080x810",
        ];
        return (
            !g &&
            w &&
            r.touch &&
            b.indexOf(`${p}x${h}`) >= 0 &&
            ((g = u.match(/(Version)\/([\d.]+)/)),
                g || (g = [0, 1, "13_0_0"]),
                (w = !1)),
            y && !T && ((f.os = "android"), (f.android = !0)),
            (g || P || v) && ((f.os = "ios"), (f.ios = !0)),
            f
        );
    }

    function wr(o) {
        return o === void 0 && (o = {}), zi || (zi = yo(o)), zi;
    }
    let Bi;

    function bo() {
        const o = bt(),
            n = wr();
        let r = !1;

        function a() {
            const p = o.navigator.userAgent.toLowerCase();
            return (
                p.indexOf("safari") >= 0 &&
                p.indexOf("chrome") < 0 &&
                p.indexOf("android") < 0
            );
        }
        if (a()) {
            const p = String(o.navigator.userAgent);
            if (p.includes("Version/")) {
                const [h, y] = p
                    .split("Version/")[1]
                    .split(" ")[0]
                    .split(".")
                    .map((g) => Number(g));
                r = h < 16 || (h === 16 && y < 2);
            }
        }
        const d = /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(
                o.navigator.userAgent
            ),
            u = a(),
            f = u || (d && n.ios);
        return {
            isSafari: r || u,
            needPerspectiveFix: r,
            need3dFix: f,
            isWebView: d,
        };
    }

    function xo() {
        return Bi || (Bi = bo()), Bi;
    }

    function wo(o) {
        let {
            swiper: n,
            on: r,
            emit: a
        } = o;
        const d = bt();
        let u = null,
            f = null;
        const p = () => {
                !n || n.destroyed || !n.initialized || (a("beforeResize"), a("resize"));
            },
            h = () => {
                !n ||
                    n.destroyed ||
                    !n.initialized ||
                    ((u = new ResizeObserver((v) => {
                            f = d.requestAnimationFrame(() => {
                                const {
                                    width: P,
                                    height: T
                                } = n;
                                let w = P,
                                    b = T;
                                v.forEach((C) => {
                                        let {
                                            contentBoxSize: E,
                                            contentRect: A,
                                            target: M
                                        } = C;
                                        (M && M !== n.el) ||
                                        ((w = A ? A.width : (E[0] || E).inlineSize),
                                            (b = A ? A.height : (E[0] || E).blockSize));
                                    }),
                                    (w !== P || b !== T) && p();
                            });
                        })),
                        u.observe(n.el));
            },
            y = () => {
                f && d.cancelAnimationFrame(f),
                    u && u.unobserve && n.el && (u.unobserve(n.el), (u = null));
            },
            g = () => {
                !n || n.destroyed || !n.initialized || a("orientationchange");
            };
        r("init", () => {
                if (n.params.resizeObserver && typeof d.ResizeObserver < "u") {
                    h();
                    return;
                }
                d.addEventListener("resize", p), d.addEventListener("orientationchange", g);
            }),
            r("destroy", () => {
                y(),
                    d.removeEventListener("resize", p),
                    d.removeEventListener("orientationchange", g);
            });
    }

    function To(o) {
        let {
            swiper: n,
            extendParams: r,
            on: a,
            emit: d
        } = o;
        const u = [],
            f = bt(),
            p = function(g, v) {
                v === void 0 && (v = {});
                const P = f.MutationObserver || f.WebkitMutationObserver,
                    T = new P((w) => {
                        if (n.__preventObserver__) return;
                        if (w.length === 1) {
                            d("observerUpdate", w[0]);
                            return;
                        }
                        const b = function() {
                            d("observerUpdate", w[0]);
                        };
                        f.requestAnimationFrame ?
                            f.requestAnimationFrame(b) :
                            f.setTimeout(b, 0);
                    });
                T.observe(g, {
                        attributes: typeof v.attributes > "u" ? !0 : v.attributes,
                        childList: typeof v.childList > "u" ? !0 : v.childList,
                        characterData: typeof v.characterData > "u" ? !0 : v.characterData,
                    }),
                    u.push(T);
            },
            h = () => {
                if (n.params.observer) {
                    if (n.params.observeParents) {
                        const g = go(n.hostEl);
                        for (let v = 0; v < g.length; v += 1) p(g[v]);
                    }
                    p(n.hostEl, {
                            childList: n.params.observeSlideChildren
                        }),
                        p(n.wrapperEl, {
                            attributes: !1
                        });
                }
            },
            y = () => {
                u.forEach((g) => {
                        g.disconnect();
                    }),
                    u.splice(0, u.length);
            };
        r({
                observer: !1,
                observeParents: !1,
                observeSlideChildren: !1
            }),
            a("init", h),
            a("destroy", y);
    }
    var Po = {
        on(o, n, r) {
            const a = this;
            if (!a.eventsListeners || a.destroyed || typeof n != "function") return a;
            const d = r ? "unshift" : "push";
            return (
                o.split(" ").forEach((u) => {
                    a.eventsListeners[u] || (a.eventsListeners[u] = []),
                        a.eventsListeners[u][d](n);
                }),
                a
            );
        },
        once(o, n, r) {
            const a = this;
            if (!a.eventsListeners || a.destroyed || typeof n != "function") return a;

            function d() {
                a.off(o, d), d.__emitterProxy && delete d.__emitterProxy;
                for (var u = arguments.length, f = new Array(u), p = 0; p < u; p++)
                    f[p] = arguments[p];
                n.apply(a, f);
            }
            return (d.__emitterProxy = n), a.on(o, d, r);
        },
        onAny(o, n) {
            const r = this;
            if (!r.eventsListeners || r.destroyed || typeof o != "function") return r;
            const a = n ? "unshift" : "push";
            return r.eventsAnyListeners.indexOf(o) < 0 && r.eventsAnyListeners[a](o), r;
        },
        offAny(o) {
            const n = this;
            if (!n.eventsListeners || n.destroyed || !n.eventsAnyListeners) return n;
            const r = n.eventsAnyListeners.indexOf(o);
            return r >= 0 && n.eventsAnyListeners.splice(r, 1), n;
        },
        off(o, n) {
            const r = this;
            return (
                !r.eventsListeners ||
                r.destroyed ||
                !r.eventsListeners ||
                o.split(" ").forEach((a) => {
                    typeof n > "u" ?
                        (r.eventsListeners[a] = []) :
                        r.eventsListeners[a] &&
                        r.eventsListeners[a].forEach((d, u) => {
                            (d === n || (d.__emitterProxy && d.__emitterProxy === n)) &&
                            r.eventsListeners[a].splice(u, 1);
                        });
                }),
                r
            );
        },
        emit() {
            const o = this;
            if (!o.eventsListeners || o.destroyed || !o.eventsListeners) return o;
            let n, r, a;
            for (var d = arguments.length, u = new Array(d), f = 0; f < d; f++)
                u[f] = arguments[f];
            return (
                typeof u[0] == "string" || Array.isArray(u[0]) ?
                ((n = u[0]), (r = u.slice(1, u.length)), (a = o)) :
                ((n = u[0].events), (r = u[0].data), (a = u[0].context || o)),
                r.unshift(a),
                (Array.isArray(n) ? n : n.split(" ")).forEach((h) => {
                    o.eventsAnyListeners &&
                        o.eventsAnyListeners.length &&
                        o.eventsAnyListeners.forEach((y) => {
                            y.apply(a, [h, ...r]);
                        }),
                        o.eventsListeners &&
                        o.eventsListeners[h] &&
                        o.eventsListeners[h].forEach((y) => {
                            y.apply(a, r);
                        });
                }),
                o
            );
        },
    };

    function So() {
        const o = this;
        let n, r;
        const a = o.el;
        typeof o.params.width < "u" && o.params.width !== null ?
            (n = o.params.width) :
            (n = a.clientWidth),
            typeof o.params.height < "u" && o.params.height !== null ?
            (r = o.params.height) :
            (r = a.clientHeight),
            !((n === 0 && o.isHorizontal()) || (r === 0 && o.isVertical())) &&
            ((n =
                    n -
                    parseInt(Vt(a, "padding-left") || 0, 10) -
                    parseInt(Vt(a, "padding-right") || 0, 10)),
                (r =
                    r -
                    parseInt(Vt(a, "padding-top") || 0, 10) -
                    parseInt(Vt(a, "padding-bottom") || 0, 10)),
                Number.isNaN(n) && (n = 0),
                Number.isNaN(r) && (r = 0),
                Object.assign(o, {
                    width: n,
                    height: r,
                    size: o.isHorizontal() ? n : r,
                }));
    }

    function Lo() {
        const o = this;

        function n(O, D) {
            return parseFloat(O.getPropertyValue(o.getDirectionLabel(D)) || 0);
        }
        const r = o.params,
            {
                wrapperEl: a,
                slidesEl: d,
                size: u,
                rtlTranslate: f,
                wrongRTL: p
            } = o,
            h = o.virtual && r.virtual.enabled,
            y = h ? o.virtual.slides.length : o.slides.length,
            g = It(d, `.${o.params.slideClass}, swiper-slide`),
            v = h ? o.virtual.slides.length : g.length;
        let P = [];
        const T = [],
            w = [];
        let b = r.slidesOffsetBefore;
        typeof b == "function" && (b = r.slidesOffsetBefore.call(o));
        let C = r.slidesOffsetAfter;
        typeof C == "function" && (C = r.slidesOffsetAfter.call(o));
        const E = o.snapGrid.length,
            A = o.slidesGrid.length;
        let M = r.spaceBetween,
            z = -b,
            B = 0,
            j = 0;
        if (typeof u > "u") return;
        typeof M == "string" && M.indexOf("%") >= 0 ?
            (M = (parseFloat(M.replace("%", "")) / 100) * u) :
            typeof M == "string" && (M = parseFloat(M)),
            (o.virtualSize = -M),
            g.forEach((O) => {
                f ? (O.style.marginLeft = "") : (O.style.marginRight = ""),
                    (O.style.marginBottom = ""),
                    (O.style.marginTop = "");
            }),
            r.centeredSlides &&
            r.cssMode &&
            (Re(a, "--swiper-centered-offset-before", ""),
                Re(a, "--swiper-centered-offset-after", ""));
        const gt = r.grid && r.grid.rows > 1 && o.grid;
        gt ? o.grid.initSlides(g) : o.grid && o.grid.unsetSlides();
        let K;
        const dt =
            r.slidesPerView === "auto" &&
            r.breakpoints &&
            Object.keys(r.breakpoints).filter(
                (O) => typeof r.breakpoints[O].slidesPerView < "u"
            ).length > 0;
        for (let O = 0; O < v; O += 1) {
            K = 0;
            let D;
            if (
                (g[O] && (D = g[O]),
                    gt && o.grid.updateSlide(O, D, g),
                    !(g[O] && Vt(D, "display") === "none"))
            ) {
                if (r.slidesPerView === "auto") {
                    dt && (g[O].style[o.getDirectionLabel("width")] = "");
                    const R = getComputedStyle(D),
                        H = D.style.transform,
                        q = D.style.webkitTransform;
                    if (
                        (H && (D.style.transform = "none"),
                            q && (D.style.webkitTransform = "none"),
                            r.roundLengths)
                    )
                        K = o.isHorizontal() ? cr(D, "width", !0) : cr(D, "height", !0);
                    else {
                        const at = n(R, "width"),
                            tt = n(R, "padding-left"),
                            kt = n(R, "padding-right"),
                            I = n(R, "margin-left"),
                            ct = n(R, "margin-right"),
                            Z = R.getPropertyValue("box-sizing");
                        if (Z && Z === "border-box") K = at + I + ct;
                        else {
                            const {
                                clientWidth: $,
                                offsetWidth: ot
                            } = D;
                            K = at + tt + kt + I + ct + (ot - $);
                        }
                    }
                    H && (D.style.transform = H),
                        q && (D.style.webkitTransform = q),
                        r.roundLengths && (K = Math.floor(K));
                } else
                    (K = (u - (r.slidesPerView - 1) * M) / r.slidesPerView),
                    r.roundLengths && (K = Math.floor(K)),
                    g[O] && (g[O].style[o.getDirectionLabel("width")] = `${K}px`);
                g[O] && (g[O].swiperSlideSize = K),
                    w.push(K),
                    r.centeredSlides ?
                    ((z = z + K / 2 + B / 2 + M),
                        B === 0 && O !== 0 && (z = z - u / 2 - M),
                        O === 0 && (z = z - u / 2 - M),
                        Math.abs(z) < 1 / 1e3 && (z = 0),
                        r.roundLengths && (z = Math.floor(z)),
                        j % r.slidesPerGroup === 0 && P.push(z),
                        T.push(z)) :
                    (r.roundLengths && (z = Math.floor(z)),
                        (j - Math.min(o.params.slidesPerGroupSkip, j)) %
                        o.params.slidesPerGroup ===
                        0 && P.push(z),
                        T.push(z),
                        (z = z + K + M)),
                    (o.virtualSize += K + M),
                    (B = K),
                    (j += 1);
            }
        }
        if (
            ((o.virtualSize = Math.max(o.virtualSize, u) + C),
                f &&
                p &&
                (r.effect === "slide" || r.effect === "coverflow") &&
                (a.style.width = `${o.virtualSize + M}px`),
                r.setWrapperSize &&
                (a.style[o.getDirectionLabel("width")] = `${o.virtualSize + M}px`),
                gt && o.grid.updateWrapperSize(K, P),
                !r.centeredSlides)
        ) {
            const O = [];
            for (let D = 0; D < P.length; D += 1) {
                let R = P[D];
                r.roundLengths && (R = Math.floor(R)),
                    P[D] <= o.virtualSize - u && O.push(R);
            }
            (P = O),
            Math.floor(o.virtualSize - u) - Math.floor(P[P.length - 1]) > 1 &&
                P.push(o.virtualSize - u);
        }
        if (h && r.loop) {
            const O = w[0] + M;
            if (r.slidesPerGroup > 1) {
                const D = Math.ceil(
                        (o.virtual.slidesBefore + o.virtual.slidesAfter) / r.slidesPerGroup
                    ),
                    R = O * r.slidesPerGroup;
                for (let H = 0; H < D; H += 1) P.push(P[P.length - 1] + R);
            }
            for (let D = 0; D < o.virtual.slidesBefore + o.virtual.slidesAfter; D += 1)
                r.slidesPerGroup === 1 && P.push(P[P.length - 1] + O),
                T.push(T[T.length - 1] + O),
                (o.virtualSize += O);
        }
        if ((P.length === 0 && (P = [0]), M !== 0)) {
            const O =
                o.isHorizontal() && f ? "marginLeft" : o.getDirectionLabel("marginRight");
            g.filter((D, R) =>
                !r.cssMode || r.loop ? !0 : R !== g.length - 1
            ).forEach((D) => {
                D.style[O] = `${M}px`;
            });
        }
        if (r.centeredSlides && r.centeredSlidesBounds) {
            let O = 0;
            w.forEach((R) => {
                    O += R + (M || 0);
                }),
                (O -= M);
            const D = O - u;
            P = P.map((R) => (R <= 0 ? -b : R > D ? D + C : R));
        }
        if (r.centerInsufficientSlides) {
            let O = 0;
            w.forEach((R) => {
                    O += R + (M || 0);
                }),
                (O -= M);
            const D = (r.slidesOffsetBefore || 0) + (r.slidesOffsetAfter || 0);
            if (O + D < u) {
                const R = (u - O - D) / 2;
                P.forEach((H, q) => {
                        P[q] = H - R;
                    }),
                    T.forEach((H, q) => {
                        T[q] = H + R;
                    });
            }
        }
        if (
            (Object.assign(o, {
                    slides: g,
                    snapGrid: P,
                    slidesGrid: T,
                    slidesSizesGrid: w,
                }),
                r.centeredSlides && r.cssMode && !r.centeredSlidesBounds)
        ) {
            Re(a, "--swiper-centered-offset-before", `${-P[0]}px`),
                Re(
                    a,
                    "--swiper-centered-offset-after",
                    `${o.size / 2 - w[w.length - 1] / 2}px`
                );
            const O = -o.snapGrid[0],
                D = -o.slidesGrid[0];
            (o.snapGrid = o.snapGrid.map((R) => R + O)),
            (o.slidesGrid = o.slidesGrid.map((R) => R + D));
        }
        if (
            (v !== y && o.emit("slidesLengthChange"),
                P.length !== E &&
                (o.params.watchOverflow && o.checkOverflow(),
                    o.emit("snapGridLengthChange")),
                T.length !== A && o.emit("slidesGridLengthChange"),
                r.watchSlidesProgress && o.updateSlidesOffset(),
                o.emit("slidesUpdated"),
                !h && !r.cssMode && (r.effect === "slide" || r.effect === "fade"))
        ) {
            const O = `${r.containerModifierClass}backface-hidden`,
                D = o.el.classList.contains(O);
            v <= r.maxBackfaceHiddenSlides ?
                D || o.el.classList.add(O) :
                D && o.el.classList.remove(O);
        }
    }

    function Eo(o) {
        const n = this,
            r = [],
            a = n.virtual && n.params.virtual.enabled;
        let d = 0,
            u;
        typeof o == "number" ?
            n.setTransition(o) :
            o === !0 && n.setTransition(n.params.speed);
        const f = (p) => (a ? n.slides[n.getSlideIndexByData(p)] : n.slides[p]);
        if (n.params.slidesPerView !== "auto" && n.params.slidesPerView > 1)
            if (n.params.centeredSlides)
                (n.visibleSlides || []).forEach((p) => {
                    r.push(p);
                });
            else
                for (u = 0; u < Math.ceil(n.params.slidesPerView); u += 1) {
                    const p = n.activeIndex + u;
                    if (p > n.slides.length && !a) break;
                    r.push(f(p));
                }
        else r.push(f(n.activeIndex));
        for (u = 0; u < r.length; u += 1)
            if (typeof r[u] < "u") {
                const p = r[u].offsetHeight;
                d = p > d ? p : d;
            }
            (d || d === 0) && (n.wrapperEl.style.height = `${d}px`);
    }

    function Mo() {
        const o = this,
            n = o.slides,
            r = o.isElement ?
            o.isHorizontal() ?
            o.wrapperEl.offsetLeft :
            o.wrapperEl.offsetTop :
            0;
        for (let a = 0; a < n.length; a += 1)
            n[a].swiperSlideOffset =
            (o.isHorizontal() ? n[a].offsetLeft : n[a].offsetTop) -
            r -
            o.cssOverflowAdjustment();
    }
    const hr = (o, n, r) => {
        n && !o.classList.contains(r) ?
            o.classList.add(r) :
            !n && o.classList.contains(r) && o.classList.remove(r);
    };

    function Co(o) {
        o === void 0 && (o = (this && this.translate) || 0);
        const n = this,
            r = n.params,
            {
                slides: a,
                rtlTranslate: d,
                snapGrid: u
            } = n;
        if (a.length === 0) return;
        typeof a[0].swiperSlideOffset > "u" && n.updateSlidesOffset();
        let f = -o;
        d && (f = o), (n.visibleSlidesIndexes = []), (n.visibleSlides = []);
        let p = r.spaceBetween;
        typeof p == "string" && p.indexOf("%") >= 0 ?
            (p = (parseFloat(p.replace("%", "")) / 100) * n.size) :
            typeof p == "string" && (p = parseFloat(p));
        for (let h = 0; h < a.length; h += 1) {
            const y = a[h];
            let g = y.swiperSlideOffset;
            r.cssMode && r.centeredSlides && (g -= a[0].swiperSlideOffset);
            const v =
                (f + (r.centeredSlides ? n.minTranslate() : 0) - g) /
                (y.swiperSlideSize + p),
                P =
                (f - u[0] + (r.centeredSlides ? n.minTranslate() : 0) - g) /
                (y.swiperSlideSize + p),
                T = -(f - g),
                w = T + n.slidesSizesGrid[h],
                b = T >= 0 && T <= n.size - n.slidesSizesGrid[h],
                C =
                (T >= 0 && T < n.size - 1) ||
                (w > 1 && w <= n.size) ||
                (T <= 0 && w >= n.size);
            C && (n.visibleSlides.push(y), n.visibleSlidesIndexes.push(h)),
                hr(y, C, r.slideVisibleClass),
                hr(y, b, r.slideFullyVisibleClass),
                (y.progress = d ? -v : v),
                (y.originalProgress = d ? -P : P);
        }
    }

    function Io(o) {
        const n = this;
        if (typeof o > "u") {
            const g = n.rtlTranslate ? -1 : 1;
            o = (n && n.translate && n.translate * g) || 0;
        }
        const r = n.params,
            a = n.maxTranslate() - n.minTranslate();
        let {
            progress: d,
            isBeginning: u,
            isEnd: f,
            progressLoop: p
        } = n;
        const h = u,
            y = f;
        if (a === 0)(d = 0), (u = !0), (f = !0);
        else {
            d = (o - n.minTranslate()) / a;
            const g = Math.abs(o - n.minTranslate()) < 1,
                v = Math.abs(o - n.maxTranslate()) < 1;
            (u = g || d <= 0), (f = v || d >= 1), g && (d = 0), v && (d = 1);
        }
        if (r.loop) {
            const g = n.getSlideIndexByData(0),
                v = n.getSlideIndexByData(n.slides.length - 1),
                P = n.slidesGrid[g],
                T = n.slidesGrid[v],
                w = n.slidesGrid[n.slidesGrid.length - 1],
                b = Math.abs(o);
            b >= P ? (p = (b - P) / w) : (p = (b + w - T) / w), p > 1 && (p -= 1);
        }
        Object.assign(n, {
                progress: d,
                progressLoop: p,
                isBeginning: u,
                isEnd: f
            }),
            (r.watchSlidesProgress || (r.centeredSlides && r.autoHeight)) &&
            n.updateSlidesProgress(o),
            u && !h && n.emit("reachBeginning toEdge"),
            f && !y && n.emit("reachEnd toEdge"),
            ((h && !u) || (y && !f)) && n.emit("fromEdge"),
            n.emit("progress", d);
    }
    const Zi = (o, n, r) => {
        n && !o.classList.contains(r) ?
            o.classList.add(r) :
            !n && o.classList.contains(r) && o.classList.remove(r);
    };

    function ko() {
        const o = this,
            {
                slides: n,
                params: r,
                slidesEl: a,
                activeIndex: d
            } = o,
            u = o.virtual && r.virtual.enabled,
            f = o.grid && r.grid && r.grid.rows > 1,
            p = (v) => It(a, `.${r.slideClass}${v}, swiper-slide${v}`)[0];
        let h, y, g;
        if (u)
            if (r.loop) {
                let v = d - o.virtual.slidesBefore;
                v < 0 && (v = o.virtual.slides.length + v),
                    v >= o.virtual.slides.length && (v -= o.virtual.slides.length),
                    (h = p(`[data-swiper-slide-index="${v}"]`));
            } else h = p(`[data-swiper-slide-index="${d}"]`);
        else
            f ?
            ((h = n.filter((v) => v.column === d)[0]),
                (g = n.filter((v) => v.column === d + 1)[0]),
                (y = n.filter((v) => v.column === d - 1)[0])) :
            (h = n[d]);
        h &&
            (f ||
                ((g = _o(h, `.${r.slideClass}, swiper-slide`)[0]),
                    r.loop && !g && (g = n[0]),
                    (y = mo(h, `.${r.slideClass}, swiper-slide`)[0]),
                    r.loop && !y === 0 && (y = n[n.length - 1]))),
            n.forEach((v) => {
                Zi(v, v === h, r.slideActiveClass),
                    Zi(v, v === g, r.slideNextClass),
                    Zi(v, v === y, r.slidePrevClass);
            }),
            o.emitSlidesClasses();
    }
    const He = (o, n) => {
            if (!o || o.destroyed || !o.params) return;
            const r = () => (o.isElement ? "swiper-slide" : `.${o.params.slideClass}`),
                a = n.closest(r());
            if (a) {
                let d = a.querySelector(`.${o.params.lazyPreloaderClass}`);
                !d &&
                    o.isElement &&
                    (a.shadowRoot ?
                        (d = a.shadowRoot.querySelector(`.${o.params.lazyPreloaderClass}`)) :
                        requestAnimationFrame(() => {
                            a.shadowRoot &&
                                ((d = a.shadowRoot.querySelector(
                                        `.${o.params.lazyPreloaderClass}`
                                    )),
                                    d && d.remove());
                        })),
                    d && d.remove();
            }
        },
        Di = (o, n) => {
            if (!o.slides[n]) return;
            const r = o.slides[n].querySelector('[loading="lazy"]');
            r && r.removeAttribute("loading");
        },
        Vi = (o) => {
            if (!o || o.destroyed || !o.params) return;
            let n = o.params.lazyPreloadPrevNext;
            const r = o.slides.length;
            if (!r || !n || n < 0) return;
            n = Math.min(n, r);
            const a =
                o.params.slidesPerView === "auto" ?
                o.slidesPerViewDynamic() :
                Math.ceil(o.params.slidesPerView),
                d = o.activeIndex;
            if (o.params.grid && o.params.grid.rows > 1) {
                const f = d,
                    p = [f - n];
                p.push(...Array.from({
                        length: n
                    }).map((h, y) => f + a + y)),
                    o.slides.forEach((h, y) => {
                        p.includes(h.column) && Di(o, y);
                    });
                return;
            }
            const u = d + a - 1;
            if (o.params.rewind || o.params.loop)
                for (let f = d - n; f <= u + n; f += 1) {
                    const p = ((f % r) + r) % r;
                    (p < d || p > u) && Di(o, p);
                }
            else
                for (let f = Math.max(d - n, 0); f <= Math.min(u + n, r - 1); f += 1)
                    f !== d && (f > u || f < d) && Di(o, f);
        };

    function Ao(o) {
        const {
            slidesGrid: n,
            params: r
        } = o,
        a = o.rtlTranslate ? o.translate : -o.translate;
        let d;
        for (let u = 0; u < n.length; u += 1)
            typeof n[u + 1] < "u" ?
            a >= n[u] && a < n[u + 1] - (n[u + 1] - n[u]) / 2 ?
            (d = u) :
            a >= n[u] && a < n[u + 1] && (d = u + 1) :
            a >= n[u] && (d = u);
        return r.normalizeSlideIndex && (d < 0 || typeof d > "u") && (d = 0), d;
    }

    function Oo(o) {
        const n = this,
            r = n.rtlTranslate ? n.translate : -n.translate,
            {
                snapGrid: a,
                params: d,
                activeIndex: u,
                realIndex: f,
                snapIndex: p
            } = n;
        let h = o,
            y;
        const g = (T) => {
            let w = T - n.virtual.slidesBefore;
            return (
                w < 0 && (w = n.virtual.slides.length + w),
                w >= n.virtual.slides.length && (w -= n.virtual.slides.length),
                w
            );
        };
        if ((typeof h > "u" && (h = Ao(n)), a.indexOf(r) >= 0)) y = a.indexOf(r);
        else {
            const T = Math.min(d.slidesPerGroupSkip, h);
            y = T + Math.floor((h - T) / d.slidesPerGroup);
        }
        if ((y >= a.length && (y = a.length - 1), h === u && !n.params.loop)) {
            y !== p && ((n.snapIndex = y), n.emit("snapIndexChange"));
            return;
        }
        if (h === u && n.params.loop && n.virtual && n.params.virtual.enabled) {
            n.realIndex = g(h);
            return;
        }
        const v = n.grid && d.grid && d.grid.rows > 1;
        let P;
        if (n.virtual && d.virtual.enabled && d.loop) P = g(h);
        else if (v) {
            const T = n.slides.filter((b) => b.column === h)[0];
            let w = parseInt(T.getAttribute("data-swiper-slide-index"), 10);
            Number.isNaN(w) && (w = Math.max(n.slides.indexOf(T), 0)),
                (P = Math.floor(w / d.grid.rows));
        } else if (n.slides[h]) {
            const T = n.slides[h].getAttribute("data-swiper-slide-index");
            T ? (P = parseInt(T, 10)) : (P = h);
        } else P = h;
        Object.assign(n, {
                previousSnapIndex: p,
                snapIndex: y,
                previousRealIndex: f,
                realIndex: P,
                previousIndex: u,
                activeIndex: h,
            }),
            n.initialized && Vi(n),
            n.emit("activeIndexChange"),
            n.emit("snapIndexChange"),
            (n.initialized || n.params.runCallbacksOnInit) &&
            (f !== P && n.emit("realIndexChange"), n.emit("slideChange"));
    }

    function zo(o, n) {
        const r = this,
            a = r.params;
        let d = o.closest(`.${a.slideClass}, swiper-slide`);
        !d &&
            r.isElement &&
            n &&
            n.length > 1 &&
            n.includes(o) && [...n.slice(n.indexOf(o) + 1, n.length)].forEach((p) => {
                !d && p.matches && p.matches(`.${a.slideClass}, swiper-slide`) && (d = p);
            });
        let u = !1,
            f;
        if (d) {
            for (let p = 0; p < r.slides.length; p += 1)
                if (r.slides[p] === d) {
                    (u = !0), (f = p);
                    break;
                }
        }
        if (d && u)
            (r.clickedSlide = d),
            r.virtual && r.params.virtual.enabled ?
            (r.clickedIndex = parseInt(
                d.getAttribute("data-swiper-slide-index"),
                10
            )) :
            (r.clickedIndex = f);
        else {
            (r.clickedSlide = void 0), (r.clickedIndex = void 0);
            return;
        }
        a.slideToClickedSlide &&
            r.clickedIndex !== void 0 &&
            r.clickedIndex !== r.activeIndex &&
            r.slideToClickedSlide();
    }
    var Bo = {
        updateSize: So,
        updateSlides: Lo,
        updateAutoHeight: Eo,
        updateSlidesOffset: Mo,
        updateSlidesProgress: Co,
        updateProgress: Io,
        updateSlidesClasses: ko,
        updateActiveIndex: Oo,
        updateClickedSlide: zo,
    };

    function Zo(o) {
        o === void 0 && (o = this.isHorizontal() ? "x" : "y");
        const n = this,
            {
                params: r,
                rtlTranslate: a,
                translate: d,
                wrapperEl: u
            } = n;
        if (r.virtualTranslate) return a ? -d : d;
        if (r.cssMode) return d;
        let f = fo(u, o);
        return (f += n.cssOverflowAdjustment()), a && (f = -f), f || 0;
    }

    function Do(o, n) {
        const r = this,
            {
                rtlTranslate: a,
                params: d,
                wrapperEl: u,
                progress: f
            } = r;
        let p = 0,
            h = 0;
        const y = 0;
        r.isHorizontal() ? (p = a ? -o : o) : (h = o),
            d.roundLengths && ((p = Math.floor(p)), (h = Math.floor(h))),
            (r.previousTranslate = r.translate),
            (r.translate = r.isHorizontal() ? p : h),
            d.cssMode ?
            (u[r.isHorizontal() ? "scrollLeft" : "scrollTop"] = r.isHorizontal() ?
                -p :
                -h) :
            d.virtualTranslate ||
            (r.isHorizontal() ?
                (p -= r.cssOverflowAdjustment()) :
                (h -= r.cssOverflowAdjustment()),
                (u.style.transform = `translate3d(${p}px, ${h}px, ${y}px)`));
        let g;
        const v = r.maxTranslate() - r.minTranslate();
        v === 0 ? (g = 0) : (g = (o - r.minTranslate()) / v),
            g !== f && r.updateProgress(o),
            r.emit("setTranslate", r.translate, n);
    }

    function No() {
        return -this.snapGrid[0];
    }

    function Ro() {
        return -this.snapGrid[this.snapGrid.length - 1];
    }

    function Fo(o, n, r, a, d) {
        o === void 0 && (o = 0),
            n === void 0 && (n = this.params.speed),
            r === void 0 && (r = !0),
            a === void 0 && (a = !0);
        const u = this,
            {
                params: f,
                wrapperEl: p
            } = u;
        if (u.animating && f.preventInteractionOnTransition) return !1;
        const h = u.minTranslate(),
            y = u.maxTranslate();
        let g;
        if (
            (a && o > h ? (g = h) : a && o < y ? (g = y) : (g = o),
                u.updateProgress(g),
                f.cssMode)
        ) {
            const v = u.isHorizontal();
            if (n === 0) p[v ? "scrollLeft" : "scrollTop"] = -g;
            else {
                if (!u.support.smoothScroll)
                    return (
                        br({
                            swiper: u,
                            targetPosition: -g,
                            side: v ? "left" : "top"
                        }), !0
                    );
                p.scrollTo({
                    [v ? "left" : "top"]: -g,
                    behavior: "smooth"
                });
            }
            return !0;
        }
        return (
            n === 0 ?
            (u.setTransition(0),
                u.setTranslate(g),
                r && (u.emit("beforeTransitionStart", n, d), u.emit("transitionEnd"))) :
            (u.setTransition(n),
                u.setTranslate(g),
                r && (u.emit("beforeTransitionStart", n, d), u.emit("transitionStart")),
                u.animating ||
                ((u.animating = !0),
                    u.onTranslateToWrapperTransitionEnd ||
                    (u.onTranslateToWrapperTransitionEnd = function(P) {
                        !u ||
                            u.destroyed ||
                            (P.target === this &&
                                (u.wrapperEl.removeEventListener(
                                        "transitionend",
                                        u.onTranslateToWrapperTransitionEnd
                                    ),
                                    (u.onTranslateToWrapperTransitionEnd = null),
                                    delete u.onTranslateToWrapperTransitionEnd,
                                    (u.animating = !1),
                                    r && u.emit("transitionEnd")));
                    }),
                    u.wrapperEl.addEventListener(
                        "transitionend",
                        u.onTranslateToWrapperTransitionEnd
                    ))),
            !0
        );
    }
    var Ho = {
        getTranslate: Zo,
        setTranslate: Do,
        minTranslate: No,
        maxTranslate: Ro,
        translateTo: Fo,
    };

    function Go(o, n) {
        const r = this;
        r.params.cssMode ||
            ((r.wrapperEl.style.transitionDuration = `${o}ms`),
                (r.wrapperEl.style.transitionDelay = o === 0 ? "0ms" : "")),
            r.emit("setTransition", o, n);
    }

    function Tr(o) {
        let {
            swiper: n,
            runCallbacks: r,
            direction: a,
            step: d
        } = o;
        const {
            activeIndex: u,
            previousIndex: f
        } = n;
        let p = a;
        if (
            (p || (u > f ? (p = "next") : u < f ? (p = "prev") : (p = "reset")),
                n.emit(`transition${d}`),
                r && u !== f)
        ) {
            if (p === "reset") {
                n.emit(`slideResetTransition${d}`);
                return;
            }
            n.emit(`slideChangeTransition${d}`),
                p === "next" ?
                n.emit(`slideNextTransition${d}`) :
                n.emit(`slidePrevTransition${d}`);
        }
    }

    function Vo(o, n) {
        o === void 0 && (o = !0);
        const r = this,
            {
                params: a
            } = r;
        a.cssMode ||
            (a.autoHeight && r.updateAutoHeight(),
                Tr({
                    swiper: r,
                    runCallbacks: o,
                    direction: n,
                    step: "Start"
                }));
    }

    function Wo(o, n) {
        o === void 0 && (o = !0);
        const r = this,
            {
                params: a
            } = r;
        (r.animating = !1),
        !a.cssMode &&
            (r.setTransition(0),
                Tr({
                    swiper: r,
                    runCallbacks: o,
                    direction: n,
                    step: "End"
                }));
    }
    var jo = {
        setTransition: Go,
        transitionStart: Vo,
        transitionEnd: Wo
    };

    function qo(o, n, r, a, d) {
        o === void 0 && (o = 0),
            r === void 0 && (r = !0),
            typeof o == "string" && (o = parseInt(o, 10));
        const u = this;
        let f = o;
        f < 0 && (f = 0);
        const {
            params: p,
            snapGrid: h,
            slidesGrid: y,
            previousIndex: g,
            activeIndex: v,
            rtlTranslate: P,
            wrapperEl: T,
            enabled: w,
        } = u;
        if (
            (!w && !a && !d) ||
            u.destroyed ||
            (u.animating && p.preventInteractionOnTransition)
        )
            return !1;
        typeof n > "u" && (n = u.params.speed);
        const b = Math.min(u.params.slidesPerGroupSkip, f);
        let C = b + Math.floor((f - b) / u.params.slidesPerGroup);
        C >= h.length && (C = h.length - 1);
        const E = -h[C];
        if (p.normalizeSlideIndex)
            for (let M = 0; M < y.length; M += 1) {
                const z = -Math.floor(E * 100),
                    B = Math.floor(y[M] * 100),
                    j = Math.floor(y[M + 1] * 100);
                typeof y[M + 1] < "u" ?
                    z >= B && z < j - (j - B) / 2 ?
                    (f = M) :
                    z >= B && z < j && (f = M + 1) :
                    z >= B && (f = M);
            }
        if (
            u.initialized &&
            f !== v &&
            ((!u.allowSlideNext &&
                    (P ?
                        E > u.translate && E > u.minTranslate() :
                        E < u.translate && E < u.minTranslate())) ||
                (!u.allowSlidePrev &&
                    E > u.translate &&
                    E > u.maxTranslate() &&
                    (v || 0) !== f))
        )
            return !1;
        f !== (g || 0) && r && u.emit("beforeSlideChangeStart"), u.updateProgress(E);
        let A;
        if (
            (f > v ? (A = "next") : f < v ? (A = "prev") : (A = "reset"),
                (P && -E === u.translate) || (!P && E === u.translate))
        )
            return (
                u.updateActiveIndex(f),
                p.autoHeight && u.updateAutoHeight(),
                u.updateSlidesClasses(),
                p.effect !== "slide" && u.setTranslate(E),
                A !== "reset" && (u.transitionStart(r, A), u.transitionEnd(r, A)),
                !1
            );
        if (p.cssMode) {
            const M = u.isHorizontal(),
                z = P ? E : -E;
            if (n === 0) {
                const B = u.virtual && u.params.virtual.enabled;
                B &&
                    ((u.wrapperEl.style.scrollSnapType = "none"),
                        (u._immediateVirtual = !0)),
                    B && !u._cssModeVirtualInitialSet && u.params.initialSlide > 0 ?
                    ((u._cssModeVirtualInitialSet = !0),
                        requestAnimationFrame(() => {
                            T[M ? "scrollLeft" : "scrollTop"] = z;
                        })) :
                    (T[M ? "scrollLeft" : "scrollTop"] = z),
                    B &&
                    requestAnimationFrame(() => {
                        (u.wrapperEl.style.scrollSnapType = ""), (u._immediateVirtual = !1);
                    });
            } else {
                if (!u.support.smoothScroll)
                    return (
                        br({
                            swiper: u,
                            targetPosition: z,
                            side: M ? "left" : "top"
                        }), !0
                    );
                T.scrollTo({
                    [M ? "left" : "top"]: z,
                    behavior: "smooth"
                });
            }
            return !0;
        }
        return (
            u.setTransition(n),
            u.setTranslate(E),
            u.updateActiveIndex(f),
            u.updateSlidesClasses(),
            u.emit("beforeTransitionStart", n, a),
            u.transitionStart(r, A),
            n === 0 ?
            u.transitionEnd(r, A) :
            u.animating ||
            ((u.animating = !0),
                u.onSlideToWrapperTransitionEnd ||
                (u.onSlideToWrapperTransitionEnd = function(z) {
                    !u ||
                        u.destroyed ||
                        (z.target === this &&
                            (u.wrapperEl.removeEventListener(
                                    "transitionend",
                                    u.onSlideToWrapperTransitionEnd
                                ),
                                (u.onSlideToWrapperTransitionEnd = null),
                                delete u.onSlideToWrapperTransitionEnd,
                                u.transitionEnd(r, A)));
                }),
                u.wrapperEl.addEventListener(
                    "transitionend",
                    u.onSlideToWrapperTransitionEnd
                )),
            !0
        );
    }

    function Uo(o, n, r, a) {
        o === void 0 && (o = 0),
            r === void 0 && (r = !0),
            typeof o == "string" && (o = parseInt(o, 10));
        const d = this;
        if (d.destroyed) return;
        typeof n > "u" && (n = d.params.speed);
        const u = d.grid && d.params.grid && d.params.grid.rows > 1;
        let f = o;
        if (d.params.loop)
            if (d.virtual && d.params.virtual.enabled) f = f + d.virtual.slidesBefore;
            else {
                let p;
                if (u) {
                    const P = f * d.params.grid.rows;
                    p = d.slides.filter(
                        (T) => T.getAttribute("data-swiper-slide-index") * 1 === P
                    )[0].column;
                } else p = d.getSlideIndexByData(f);
                const h = u ?
                    Math.ceil(d.slides.length / d.params.grid.rows) :
                    d.slides.length,
                    {
                        centeredSlides: y
                    } = d.params;
                let g = d.params.slidesPerView;
                g === "auto" ?
                    (g = d.slidesPerViewDynamic()) :
                    ((g = Math.ceil(parseFloat(d.params.slidesPerView, 10))),
                        y && g % 2 === 0 && (g = g + 1));
                let v = h - p < g;
                if (
                    (y && (v = v || p < Math.ceil(g / 2)),
                        a && y && d.params.slidesPerView !== "auto" && !u && (v = !1),
                        v)
                ) {
                    const P = y ?
                        p < d.activeIndex ?
                        "prev" :
                        "next" :
                        p - d.activeIndex - 1 < d.params.slidesPerView ?
                        "next" :
                        "prev";
                    d.loopFix({
                        direction: P,
                        slideTo: !0,
                        activeSlideIndex: P === "next" ? p + 1 : p - h + 1,
                        slideRealIndex: P === "next" ? d.realIndex : void 0,
                    });
                }
                if (u) {
                    const P = f * d.params.grid.rows;
                    f = d.slides.filter(
                        (T) => T.getAttribute("data-swiper-slide-index") * 1 === P
                    )[0].column;
                } else f = d.getSlideIndexByData(f);
            }
        return (
            requestAnimationFrame(() => {
                d.slideTo(f, n, r, a);
            }),
            d
        );
    }

    function Yo(o, n, r) {
        n === void 0 && (n = !0);
        const a = this,
            {
                enabled: d,
                params: u,
                animating: f
            } = a;
        if (!d || a.destroyed) return a;
        typeof o > "u" && (o = a.params.speed);
        let p = u.slidesPerGroup;
        u.slidesPerView === "auto" &&
            u.slidesPerGroup === 1 &&
            u.slidesPerGroupAuto &&
            (p = Math.max(a.slidesPerViewDynamic("current", !0), 1));
        const h = a.activeIndex < u.slidesPerGroupSkip ? 1 : p,
            y = a.virtual && u.virtual.enabled;
        if (u.loop) {
            if (f && !y && u.loopPreventsSliding) return !1;
            if (
                (a.loopFix({
                        direction: "next"
                    }),
                    (a._clientLeft = a.wrapperEl.clientLeft),
                    a.activeIndex === a.slides.length - 1 && u.cssMode)
            )
                return (
                    requestAnimationFrame(() => {
                        a.slideTo(a.activeIndex + h, o, n, r);
                    }),
                    !0
                );
        }
        return u.rewind && a.isEnd ?
            a.slideTo(0, o, n, r) :
            a.slideTo(a.activeIndex + h, o, n, r);
    }

    function Xo(o, n, r) {
        n === void 0 && (n = !0);
        const a = this,
            {
                params: d,
                snapGrid: u,
                slidesGrid: f,
                rtlTranslate: p,
                enabled: h,
                animating: y,
            } = a;
        if (!h || a.destroyed) return a;
        typeof o > "u" && (o = a.params.speed);
        const g = a.virtual && d.virtual.enabled;
        if (d.loop) {
            if (y && !g && d.loopPreventsSliding) return !1;
            a.loopFix({
                direction: "prev"
            }), (a._clientLeft = a.wrapperEl.clientLeft);
        }
        const v = p ? a.translate : -a.translate;

        function P(E) {
            return E < 0 ? -Math.floor(Math.abs(E)) : Math.floor(E);
        }
        const T = P(v),
            w = u.map((E) => P(E));
        let b = u[w.indexOf(T) - 1];
        if (typeof b > "u" && d.cssMode) {
            let E;
            u.forEach((A, M) => {
                    T >= A && (E = M);
                }),
                typeof E < "u" && (b = u[E > 0 ? E - 1 : E]);
        }
        let C = 0;
        if (
            (typeof b < "u" &&
                ((C = f.indexOf(b)),
                    C < 0 && (C = a.activeIndex - 1),
                    d.slidesPerView === "auto" &&
                    d.slidesPerGroup === 1 &&
                    d.slidesPerGroupAuto &&
                    ((C = C - a.slidesPerViewDynamic("previous", !0) + 1),
                        (C = Math.max(C, 0)))),
                d.rewind && a.isBeginning)
        ) {
            const E =
                a.params.virtual && a.params.virtual.enabled && a.virtual ?
                a.virtual.slides.length - 1 :
                a.slides.length - 1;
            return a.slideTo(E, o, n, r);
        } else if (d.loop && a.activeIndex === 0 && d.cssMode)
            return (
                requestAnimationFrame(() => {
                    a.slideTo(C, o, n, r);
                }),
                !0
            );
        return a.slideTo(C, o, n, r);
    }

    function $o(o, n, r) {
        n === void 0 && (n = !0);
        const a = this;
        if (!a.destroyed)
            return (
                typeof o > "u" && (o = a.params.speed), a.slideTo(a.activeIndex, o, n, r)
            );
    }

    function Ko(o, n, r, a) {
        n === void 0 && (n = !0), a === void 0 && (a = 0.5);
        const d = this;
        if (d.destroyed) return;
        typeof o > "u" && (o = d.params.speed);
        let u = d.activeIndex;
        const f = Math.min(d.params.slidesPerGroupSkip, u),
            p = f + Math.floor((u - f) / d.params.slidesPerGroup),
            h = d.rtlTranslate ? d.translate : -d.translate;
        if (h >= d.snapGrid[p]) {
            const y = d.snapGrid[p],
                g = d.snapGrid[p + 1];
            h - y > (g - y) * a && (u += d.params.slidesPerGroup);
        } else {
            const y = d.snapGrid[p - 1],
                g = d.snapGrid[p];
            h - y <= (g - y) * a && (u -= d.params.slidesPerGroup);
        }
        return (
            (u = Math.max(u, 0)),
            (u = Math.min(u, d.slidesGrid.length - 1)),
            d.slideTo(u, o, n, r)
        );
    }

    function Jo() {
        const o = this;
        if (o.destroyed) return;
        const {
            params: n,
            slidesEl: r
        } = o,
        a = n.slidesPerView === "auto" ? o.slidesPerViewDynamic() : n.slidesPerView;
        let d = o.clickedIndex,
            u;
        const f = o.isElement ? "swiper-slide" : `.${n.slideClass}`;
        if (n.loop) {
            if (o.animating) return;
            (u = parseInt(o.clickedSlide.getAttribute("data-swiper-slide-index"), 10)),
            n.centeredSlides ?
                d < o.loopedSlides - a / 2 ||
                d > o.slides.length - o.loopedSlides + a / 2 ?
                (o.loopFix(),
                    (d = o.getSlideIndex(
                        It(r, `${f}[data-swiper-slide-index="${u}"]`)[0]
                    )),
                    Gi(() => {
                        o.slideTo(d);
                    })) :
                o.slideTo(d) :
                d > o.slides.length - a ?
                (o.loopFix(),
                    (d = o.getSlideIndex(
                        It(r, `${f}[data-swiper-slide-index="${u}"]`)[0]
                    )),
                    Gi(() => {
                        o.slideTo(d);
                    })) :
                o.slideTo(d);
        } else o.slideTo(d);
    }
    var Qo = {
        slideTo: qo,
        slideToLoop: Uo,
        slideNext: Yo,
        slidePrev: Xo,
        slideReset: $o,
        slideToClosest: Ko,
        slideToClickedSlide: Jo,
    };

    function ta(o) {
        const n = this,
            {
                params: r,
                slidesEl: a
            } = n;
        if (!r.loop || (n.virtual && n.params.virtual.enabled)) return;
        const d = () => {
                It(a, `.${r.slideClass}, swiper-slide`).forEach((v, P) => {
                    v.setAttribute("data-swiper-slide-index", P);
                });
            },
            u = n.grid && r.grid && r.grid.rows > 1,
            f = r.slidesPerGroup * (u ? r.grid.rows : 1),
            p = n.slides.length % f !== 0,
            h = u && n.slides.length % r.grid.rows !== 0,
            y = (g) => {
                for (let v = 0; v < g; v += 1) {
                    const P = n.isElement ?
                        We("swiper-slide", [r.slideBlankClass]) :
                        We("div", [r.slideClass, r.slideBlankClass]);
                    n.slidesEl.append(P);
                }
            };
        if (p) {
            if (r.loopAddBlankSlides) {
                const g = f - (n.slides.length % f);
                y(g), n.recalcSlides(), n.updateSlides();
            } else
                Ve(
                    "Swiper Loop Warning: The number of slides is not even to slidesPerGroup, loop mode may not function properly. You need to add more slides (or make duplicates, or empty slides)"
                );
            d();
        } else if (h) {
            if (r.loopAddBlankSlides) {
                const g = r.grid.rows - (n.slides.length % r.grid.rows);
                y(g), n.recalcSlides(), n.updateSlides();
            } else
                Ve(
                    "Swiper Loop Warning: The number of slides is not even to grid.rows, loop mode may not function properly. You need to add more slides (or make duplicates, or empty slides)"
                );
            d();
        } else d();
        n.loopFix({
            slideRealIndex: o,
            direction: r.centeredSlides ? void 0 : "next",
        });
    }

    function ea(o) {
        let {
            slideRealIndex: n,
            slideTo: r = !0,
            direction: a,
            setTranslate: d,
            activeSlideIndex: u,
            byController: f,
            byMousewheel: p,
        } = o === void 0 ? {} : o;
        const h = this;
        if (!h.params.loop) return;
        h.emit("beforeLoopFix");
        const {
            slides: y,
            allowSlidePrev: g,
            allowSlideNext: v,
            slidesEl: P,
            params: T,
        } = h, {
            centeredSlides: w
        } = T;
        if (
            ((h.allowSlidePrev = !0),
                (h.allowSlideNext = !0),
                h.virtual && T.virtual.enabled)
        ) {
            r &&
                (!T.centeredSlides && h.snapIndex === 0 ?
                    h.slideTo(h.virtual.slides.length, 0, !1, !0) :
                    T.centeredSlides && h.snapIndex < T.slidesPerView ?
                    h.slideTo(h.virtual.slides.length + h.snapIndex, 0, !1, !0) :
                    h.snapIndex === h.snapGrid.length - 1 &&
                    h.slideTo(h.virtual.slidesBefore, 0, !1, !0)),
                (h.allowSlidePrev = g),
                (h.allowSlideNext = v),
                h.emit("loopFix");
            return;
        }
        let b = T.slidesPerView;
        b === "auto" ?
            (b = h.slidesPerViewDynamic()) :
            ((b = Math.ceil(parseFloat(T.slidesPerView, 10))),
                w && b % 2 === 0 && (b = b + 1));
        const C = T.slidesPerGroupAuto ? b : T.slidesPerGroup;
        let E = C;
        E % C !== 0 && (E += C - (E % C)),
            (E += T.loopAdditionalSlides),
            (h.loopedSlides = E);
        const A = h.grid && T.grid && T.grid.rows > 1;
        y.length < b + E ?
            Ve(
                "Swiper Loop Warning: The number of slides is not enough for loop mode, it will be disabled and not function properly. You need to add more slides (or make duplicates) or lower the values of slidesPerView and slidesPerGroup parameters"
            ) :
            A &&
            T.grid.fill === "row" &&
            Ve(
                "Swiper Loop Warning: Loop mode is not compatible with grid.fill = `row`"
            );
        const M = [],
            z = [];
        let B = h.activeIndex;
        typeof u > "u" ?
            (u = h.getSlideIndex(
                y.filter((H) => H.classList.contains(T.slideActiveClass))[0]
            )) :
            (B = u);
        const j = a === "next" || !a,
            gt = a === "prev" || !a;
        let K = 0,
            dt = 0;
        const O = A ? Math.ceil(y.length / T.grid.rows) : y.length,
            R = (A ? y[u].column : u) + (w && typeof d > "u" ? -b / 2 + 0.5 : 0);
        if (R < E) {
            K = Math.max(E - R, C);
            for (let H = 0; H < E - R; H += 1) {
                const q = H - Math.floor(H / O) * O;
                if (A) {
                    const at = O - q - 1;
                    for (let tt = y.length - 1; tt >= 0; tt -= 1)
                        y[tt].column === at && M.push(tt);
                } else M.push(O - q - 1);
            }
        } else if (R + b > O - E) {
            dt = Math.max(R - (O - E * 2), C);
            for (let H = 0; H < dt; H += 1) {
                const q = H - Math.floor(H / O) * O;
                A
                    ?
                    y.forEach((at, tt) => {
                        at.column === q && z.push(tt);
                    }) :
                    z.push(q);
            }
        }
        if (
            ((h.__preventObserver__ = !0),
                requestAnimationFrame(() => {
                    h.__preventObserver__ = !1;
                }),
                gt &&
                M.forEach((H) => {
                    (y[H].swiperLoopMoveDOM = !0),
                    P.prepend(y[H]),
                        (y[H].swiperLoopMoveDOM = !1);
                }),
                j &&
                z.forEach((H) => {
                    (y[H].swiperLoopMoveDOM = !0),
                    P.append(y[H]),
                        (y[H].swiperLoopMoveDOM = !1);
                }),
                h.recalcSlides(),
                T.slidesPerView === "auto" ?
                h.updateSlides() :
                A &&
                ((M.length > 0 && gt) || (z.length > 0 && j)) &&
                h.slides.forEach((H, q) => {
                    h.grid.updateSlide(q, H, h.slides);
                }),
                T.watchSlidesProgress && h.updateSlidesOffset(),
                r)
        ) {
            if (M.length > 0 && gt) {
                if (typeof n > "u") {
                    const H = h.slidesGrid[B],
                        at = h.slidesGrid[B + K] - H;
                    p
                        ?
                        h.setTranslate(h.translate - at) :
                        (h.slideTo(B + Math.ceil(K), 0, !1, !0),
                            d &&
                            ((h.touchEventsData.startTranslate =
                                    h.touchEventsData.startTranslate - at),
                                (h.touchEventsData.currentTranslate =
                                    h.touchEventsData.currentTranslate - at)));
                } else if (d) {
                    const H = A ? M.length / T.grid.rows : M.length;
                    h.slideTo(h.activeIndex + H, 0, !1, !0),
                        (h.touchEventsData.currentTranslate = h.translate);
                }
            } else if (z.length > 0 && j)
                if (typeof n > "u") {
                    const H = h.slidesGrid[B],
                        at = h.slidesGrid[B - dt] - H;
                    p
                        ?
                        h.setTranslate(h.translate - at) :
                        (h.slideTo(B - dt, 0, !1, !0),
                            d &&
                            ((h.touchEventsData.startTranslate =
                                    h.touchEventsData.startTranslate - at),
                                (h.touchEventsData.currentTranslate =
                                    h.touchEventsData.currentTranslate - at)));
                } else {
                    const H = A ? z.length / T.grid.rows : z.length;
                    h.slideTo(h.activeIndex - H, 0, !1, !0);
                }
        }
        if (
            ((h.allowSlidePrev = g),
                (h.allowSlideNext = v),
                h.controller && h.controller.control && !f)
        ) {
            const H = {
                slideRealIndex: n,
                direction: a,
                setTranslate: d,
                activeSlideIndex: u,
                byController: !0,
            };
            Array.isArray(h.controller.control) ?
                h.controller.control.forEach((q) => {
                    !q.destroyed &&
                        q.params.loop &&
                        q.loopFix({
                            ...H,
                            slideTo: q.params.slidesPerView === T.slidesPerView ? r : !1,
                        });
                }) :
                h.controller.control instanceof h.constructor &&
                h.controller.control.params.loop &&
                h.controller.control.loopFix({
                    ...H,
                    slideTo: h.controller.control.params.slidesPerView === T.slidesPerView ?
                        r :
                        !1,
                });
        }
        h.emit("loopFix");
    }

    function ia() {
        const o = this,
            {
                params: n,
                slidesEl: r
            } = o;
        if (!n.loop || (o.virtual && o.params.virtual.enabled)) return;
        o.recalcSlides();
        const a = [];
        o.slides.forEach((d) => {
                const u =
                    typeof d.swiperSlideIndex > "u" ?
                    d.getAttribute("data-swiper-slide-index") * 1 :
                    d.swiperSlideIndex;
                a[u] = d;
            }),
            o.slides.forEach((d) => {
                d.removeAttribute("data-swiper-slide-index");
            }),
            a.forEach((d) => {
                r.append(d);
            }),
            o.recalcSlides(),
            o.slideTo(o.realIndex, 0);
    }
    var na = {
        loopCreate: ta,
        loopFix: ea,
        loopDestroy: ia
    };

    function ra(o) {
        const n = this;
        if (
            !n.params.simulateTouch ||
            (n.params.watchOverflow && n.isLocked) ||
            n.params.cssMode
        )
            return;
        const r = n.params.touchEventsTarget === "container" ? n.el : n.wrapperEl;
        n.isElement && (n.__preventObserver__ = !0),
            (r.style.cursor = "move"),
            (r.style.cursor = o ? "grabbing" : "grab"),
            n.isElement &&
            requestAnimationFrame(() => {
                n.__preventObserver__ = !1;
            });
    }

    function sa() {
        const o = this;
        (o.params.watchOverflow && o.isLocked) ||
        o.params.cssMode ||
            (o.isElement && (o.__preventObserver__ = !0),
                (o[
                    o.params.touchEventsTarget === "container" ? "el" : "wrapperEl"
                ].style.cursor = ""),
                o.isElement &&
                requestAnimationFrame(() => {
                    o.__preventObserver__ = !1;
                }));
    }
    var oa = {
        setGrabCursor: ra,
        unsetGrabCursor: sa
    };

    function aa(o, n) {
        n === void 0 && (n = this);

        function r(a) {
            if (!a || a === Rt() || a === bt()) return null;
            a.assignedSlot && (a = a.assignedSlot);
            const d = a.closest(o);
            return !d && !a.getRootNode ? null : d || r(a.getRootNode().host);
        }
        return r(n);
    }

    function fr(o, n, r) {
        const a = bt(),
            {
                params: d
            } = o,
            u = d.edgeSwipeDetection,
            f = d.edgeSwipeThreshold;
        return u && (r <= f || r >= a.innerWidth - f) ?
            u === "prevent" ?
            (n.preventDefault(), !0) :
            !1 :
            !0;
    }

    function la(o) {
        const n = this,
            r = Rt();
        let a = o;
        a.originalEvent && (a = a.originalEvent);
        const d = n.touchEventsData;
        if (a.type === "pointerdown") {
            if (d.pointerId !== null && d.pointerId !== a.pointerId) return;
            d.pointerId = a.pointerId;
        } else
            a.type === "touchstart" &&
            a.targetTouches.length === 1 &&
            (d.touchId = a.targetTouches[0].identifier);
        if (a.type === "touchstart") {
            fr(n, a, a.targetTouches[0].pageX);
            return;
        }
        const {
            params: u,
            touches: f,
            enabled: p
        } = n;
        if (
            !p ||
            (!u.simulateTouch && a.pointerType === "mouse") ||
            (n.animating && u.preventInteractionOnTransition)
        )
            return;
        !n.animating && u.cssMode && u.loop && n.loopFix();
        let h = a.target;
        if (
            (u.touchEventsTarget === "wrapper" && !n.wrapperEl.contains(h)) ||
            ("which" in a && a.which === 3) ||
            ("button" in a && a.button > 0) ||
            (d.isTouched && d.isMoved)
        )
            return;
        const y = !!u.noSwipingClass && u.noSwipingClass !== "",
            g = a.composedPath ? a.composedPath() : a.path;
        y && a.target && a.target.shadowRoot && g && (h = g[0]);
        const v = u.noSwipingSelector ? u.noSwipingSelector : `.${u.noSwipingClass}`,
            P = !!(a.target && a.target.shadowRoot);
        if (u.noSwiping && (P ? aa(v, h) : h.closest(v))) {
            n.allowClick = !0;
            return;
        }
        if (u.swipeHandler && !h.closest(u.swipeHandler)) return;
        (f.currentX = a.pageX), (f.currentY = a.pageY);
        const T = f.currentX,
            w = f.currentY;
        if (!fr(n, a, T)) return;
        Object.assign(d, {
                isTouched: !0,
                isMoved: !1,
                allowTouchCallbacks: !0,
                isScrolling: void 0,
                startMoving: void 0,
            }),
            (f.startX = T),
            (f.startY = w),
            (d.touchStartTime = Ge()),
            (n.allowClick = !0),
            n.updateSize(),
            (n.swipeDirection = void 0),
            u.threshold > 0 && (d.allowThresholdMove = !1);
        let b = !0;
        h.matches(d.focusableElements) &&
            ((b = !1), h.nodeName === "SELECT" && (d.isTouched = !1)),
            r.activeElement &&
            r.activeElement.matches(d.focusableElements) &&
            r.activeElement !== h &&
            r.activeElement.blur();
        const C = b && n.allowTouchMove && u.touchStartPreventDefault;
        (u.touchStartForcePreventDefault || C) &&
        !h.isContentEditable &&
            a.preventDefault(),
            u.freeMode &&
            u.freeMode.enabled &&
            n.freeMode &&
            n.animating &&
            !u.cssMode &&
            n.freeMode.onTouchStart(),
            n.emit("touchStart", a);
    }

    function da(o) {
        const n = Rt(),
            r = this,
            a = r.touchEventsData,
            {
                params: d,
                touches: u,
                rtlTranslate: f,
                enabled: p
            } = r;
        if (!p || (!d.simulateTouch && o.pointerType === "mouse")) return;
        let h = o;
        if (
            (h.originalEvent && (h = h.originalEvent),
                h.type === "pointermove" &&
                (a.touchId !== null || h.pointerId !== a.pointerId))
        )
            return;
        let y;
        if (h.type === "touchmove") {
            if (
                ((y = [...h.changedTouches].filter((j) => j.identifier === a.touchId)[0]),
                    !y || y.identifier !== a.touchId)
            )
                return;
        } else y = h;
        if (!a.isTouched) {
            a.startMoving && a.isScrolling && r.emit("touchMoveOpposite", h);
            return;
        }
        const g = y.pageX,
            v = y.pageY;
        if (h.preventedByNestedSwiper) {
            (u.startX = g), (u.startY = v);
            return;
        }
        if (!r.allowTouchMove) {
            h.target.matches(a.focusableElements) || (r.allowClick = !1),
                a.isTouched &&
                (Object.assign(u, {
                        startX: g,
                        startY: v,
                        currentX: g,
                        currentY: v
                    }),
                    (a.touchStartTime = Ge()));
            return;
        }
        if (d.touchReleaseOnEdges && !d.loop) {
            if (r.isVertical()) {
                if (
                    (v < u.startY && r.translate <= r.maxTranslate()) ||
                    (v > u.startY && r.translate >= r.minTranslate())
                ) {
                    (a.isTouched = !1), (a.isMoved = !1);
                    return;
                }
            } else if (
                (g < u.startX && r.translate <= r.maxTranslate()) ||
                (g > u.startX && r.translate >= r.minTranslate())
            )
                return;
        }
        if (
            n.activeElement &&
            h.target === n.activeElement &&
            h.target.matches(a.focusableElements)
        ) {
            (a.isMoved = !0), (r.allowClick = !1);
            return;
        }
        a.allowTouchCallbacks && r.emit("touchMove", h),
            (u.previousX = u.currentX),
            (u.previousY = u.currentY),
            (u.currentX = g),
            (u.currentY = v);
        const P = u.currentX - u.startX,
            T = u.currentY - u.startY;
        if (r.params.threshold && Math.sqrt(P ** 2 + T ** 2) < r.params.threshold)
            return;
        if (typeof a.isScrolling > "u") {
            let j;
            (r.isHorizontal() && u.currentY === u.startY) ||
            (r.isVertical() && u.currentX === u.startX) ?
            (a.isScrolling = !1) :
            P * P + T * T >= 25 &&
                ((j = (Math.atan2(Math.abs(T), Math.abs(P)) * 180) / Math.PI),
                    (a.isScrolling = r.isHorizontal() ?
                        j > d.touchAngle :
                        90 - j > d.touchAngle));
        }
        if (
            (a.isScrolling && r.emit("touchMoveOpposite", h),
                typeof a.startMoving > "u" &&
                (u.currentX !== u.startX || u.currentY !== u.startY) &&
                (a.startMoving = !0),
                a.isScrolling ||
                (h.type === "touchmove" && a.preventTouchMoveFromPointerMove))
        ) {
            a.isTouched = !1;
            return;
        }
        if (!a.startMoving) return;
        (r.allowClick = !1),
        !d.cssMode && h.cancelable && h.preventDefault(),
            d.touchMoveStopPropagation && !d.nested && h.stopPropagation();
        let w = r.isHorizontal() ? P : T,
            b = r.isHorizontal() ? u.currentX - u.previousX : u.currentY - u.previousY;
        d.oneWayMovement &&
            ((w = Math.abs(w) * (f ? 1 : -1)), (b = Math.abs(b) * (f ? 1 : -1))),
            (u.diff = w),
            (w *= d.touchRatio),
            f && ((w = -w), (b = -b));
        const C = r.touchesDirection;
        (r.swipeDirection = w > 0 ? "prev" : "next"),
        (r.touchesDirection = b > 0 ? "prev" : "next");
        const E = r.params.loop && !d.cssMode,
            A =
            (r.touchesDirection === "next" && r.allowSlideNext) ||
            (r.touchesDirection === "prev" && r.allowSlidePrev);
        if (!a.isMoved) {
            if (
                (E && A && r.loopFix({
                        direction: r.swipeDirection
                    }),
                    (a.startTranslate = r.getTranslate()),
                    r.setTransition(0),
                    r.animating)
            ) {
                const j = new window.CustomEvent("transitionend", {
                    bubbles: !0,
                    cancelable: !0,
                    detail: {
                        bySwiperTouchMove: !0
                    },
                });
                r.wrapperEl.dispatchEvent(j);
            }
            (a.allowMomentumBounce = !1),
            d.grabCursor &&
                (r.allowSlideNext === !0 || r.allowSlidePrev === !0) &&
                r.setGrabCursor(!0),
                r.emit("sliderFirstMove", h);
        }
        let M;
        if (
            (new Date().getTime(),
                a.isMoved &&
                a.allowThresholdMove &&
                C !== r.touchesDirection &&
                E &&
                A &&
                Math.abs(w) >= 1)
        ) {
            Object.assign(u, {
                    startX: g,
                    startY: v,
                    currentX: g,
                    currentY: v,
                    startTranslate: a.currentTranslate,
                }),
                (a.loopSwapReset = !0),
                (a.startTranslate = a.currentTranslate);
            return;
        }
        r.emit("sliderMove", h),
            (a.isMoved = !0),
            (a.currentTranslate = w + a.startTranslate);
        let z = !0,
            B = d.resistanceRatio;
        if (
            (d.touchReleaseOnEdges && (B = 0),
                w > 0 ?
                (E &&
                    A &&
                    !M &&
                    a.allowThresholdMove &&
                    a.currentTranslate >
                    (d.centeredSlides ?
                        r.minTranslate() - r.slidesSizesGrid[r.activeIndex + 1] :
                        r.minTranslate()) &&
                    r.loopFix({
                        direction: "prev",
                        setTranslate: !0,
                        activeSlideIndex: 0,
                    }),
                    a.currentTranslate > r.minTranslate() &&
                    ((z = !1),
                        d.resistance &&
                        (a.currentTranslate =
                            r.minTranslate() -
                            1 +
                            (-r.minTranslate() + a.startTranslate + w) ** B))) :
                w < 0 &&
                (E &&
                    A &&
                    !M &&
                    a.allowThresholdMove &&
                    a.currentTranslate <
                    (d.centeredSlides ?
                        r.maxTranslate() +
                        r.slidesSizesGrid[r.slidesSizesGrid.length - 1] :
                        r.maxTranslate()) &&
                    r.loopFix({
                        direction: "next",
                        setTranslate: !0,
                        activeSlideIndex: r.slides.length -
                            (d.slidesPerView === "auto" ?
                                r.slidesPerViewDynamic() :
                                Math.ceil(parseFloat(d.slidesPerView, 10))),
                    }),
                    a.currentTranslate < r.maxTranslate() &&
                    ((z = !1),
                        d.resistance &&
                        (a.currentTranslate =
                            r.maxTranslate() +
                            1 -
                            (r.maxTranslate() - a.startTranslate - w) ** B))),
                z && (h.preventedByNestedSwiper = !0),
                !r.allowSlideNext &&
                r.swipeDirection === "next" &&
                a.currentTranslate < a.startTranslate &&
                (a.currentTranslate = a.startTranslate),
                !r.allowSlidePrev &&
                r.swipeDirection === "prev" &&
                a.currentTranslate > a.startTranslate &&
                (a.currentTranslate = a.startTranslate),
                !r.allowSlidePrev &&
                !r.allowSlideNext &&
                (a.currentTranslate = a.startTranslate),
                d.threshold > 0)
        )
            if (Math.abs(w) > d.threshold || a.allowThresholdMove) {
                if (!a.allowThresholdMove) {
                    (a.allowThresholdMove = !0),
                    (u.startX = u.currentX),
                    (u.startY = u.currentY),
                    (a.currentTranslate = a.startTranslate),
                    (u.diff = r.isHorizontal() ?
                        u.currentX - u.startX :
                        u.currentY - u.startY);
                    return;
                }
            } else {
                a.currentTranslate = a.startTranslate;
                return;
            }! d.followFinger ||
            d.cssMode ||
            (((d.freeMode && d.freeMode.enabled && r.freeMode) ||
                    d.watchSlidesProgress) &&
                (r.updateActiveIndex(), r.updateSlidesClasses()),
                d.freeMode && d.freeMode.enabled && r.freeMode && r.freeMode.onTouchMove(),
                r.updateProgress(a.currentTranslate),
                r.setTranslate(a.currentTranslate));
    }

    function ua(o) {
        const n = this,
            r = n.touchEventsData;
        let a = o;
        a.originalEvent && (a = a.originalEvent);
        let d;
        if (a.type === "touchend" || a.type === "touchcancel") {
            if (
                ((d = [...a.changedTouches].filter((B) => B.identifier === r.touchId)[0]),
                    !d || d.identifier !== r.touchId)
            )
                return;
        } else {
            if (r.touchId !== null || a.pointerId !== r.pointerId) return;
            d = a;
        }
        if (
            ["pointercancel", "pointerout", "pointerleave", "contextmenu"].includes(
                a.type
            ) &&
            !(
                ["pointercancel", "contextmenu"].includes(a.type) &&
                (n.browser.isSafari || n.browser.isWebView)
            )
        )
            return;
        (r.pointerId = null), (r.touchId = null);
        const {
            params: f,
            touches: p,
            rtlTranslate: h,
            slidesGrid: y,
            enabled: g,
        } = n;
        if (!g || (!f.simulateTouch && a.pointerType === "mouse")) return;
        if (
            (r.allowTouchCallbacks && n.emit("touchEnd", a),
                (r.allowTouchCallbacks = !1),
                !r.isTouched)
        ) {
            r.isMoved && f.grabCursor && n.setGrabCursor(!1),
                (r.isMoved = !1),
                (r.startMoving = !1);
            return;
        }
        f.grabCursor &&
            r.isMoved &&
            r.isTouched &&
            (n.allowSlideNext === !0 || n.allowSlidePrev === !0) &&
            n.setGrabCursor(!1);
        const v = Ge(),
            P = v - r.touchStartTime;
        if (n.allowClick) {
            const B = a.path || (a.composedPath && a.composedPath());
            n.updateClickedSlide((B && B[0]) || a.target, B),
                n.emit("tap click", a),
                P < 300 &&
                v - r.lastClickTime < 300 &&
                n.emit("doubleTap doubleClick", a);
        }
        if (
            ((r.lastClickTime = Ge()),
                Gi(() => {
                    n.destroyed || (n.allowClick = !0);
                }),
                !r.isTouched ||
                !r.isMoved ||
                !n.swipeDirection ||
                (p.diff === 0 && !r.loopSwapReset) ||
                (r.currentTranslate === r.startTranslate && !r.loopSwapReset))
        ) {
            (r.isTouched = !1), (r.isMoved = !1), (r.startMoving = !1);
            return;
        }
        (r.isTouched = !1), (r.isMoved = !1), (r.startMoving = !1);
        let T;
        if (
            (f.followFinger ?
                (T = h ? n.translate : -n.translate) :
                (T = -r.currentTranslate),
                f.cssMode)
        )
            return;
        if (f.freeMode && f.freeMode.enabled) {
            n.freeMode.onTouchEnd({
                currentPos: T
            });
            return;
        }
        const w = T >= -n.maxTranslate() && !n.params.loop;
        let b = 0,
            C = n.slidesSizesGrid[0];
        for (
            let B = 0; B < y.length; B += B < f.slidesPerGroupSkip ? 1 : f.slidesPerGroup
        ) {
            const j = B < f.slidesPerGroupSkip - 1 ? 1 : f.slidesPerGroup;
            typeof y[B + j] < "u" ?
                (w || (T >= y[B] && T < y[B + j])) && ((b = B), (C = y[B + j] - y[B])) :
                (w || T >= y[B]) && ((b = B), (C = y[y.length - 1] - y[y.length - 2]));
        }
        let E = null,
            A = null;
        f.rewind &&
            (n.isBeginning ?
                (A =
                    f.virtual && f.virtual.enabled && n.virtual ?
                    n.virtual.slides.length - 1 :
                    n.slides.length - 1) :
                n.isEnd && (E = 0));
        const M = (T - y[b]) / C,
            z = b < f.slidesPerGroupSkip - 1 ? 1 : f.slidesPerGroup;
        if (P > f.longSwipesMs) {
            if (!f.longSwipes) {
                n.slideTo(n.activeIndex);
                return;
            }
            n.swipeDirection === "next" &&
                (M >= f.longSwipesRatio ?
                    n.slideTo(f.rewind && n.isEnd ? E : b + z) :
                    n.slideTo(b)),
                n.swipeDirection === "prev" &&
                (M > 1 - f.longSwipesRatio ?
                    n.slideTo(b + z) :
                    A !== null && M < 0 && Math.abs(M) > f.longSwipesRatio ?
                    n.slideTo(A) :
                    n.slideTo(b));
        } else {
            if (!f.shortSwipes) {
                n.slideTo(n.activeIndex);
                return;
            }
            n.navigation &&
                (a.target === n.navigation.nextEl || a.target === n.navigation.prevEl) ?
                a.target === n.navigation.nextEl ?
                n.slideTo(b + z) :
                n.slideTo(b) :
                (n.swipeDirection === "next" && n.slideTo(E !== null ? E : b + z),
                    n.swipeDirection === "prev" && n.slideTo(A !== null ? A : b));
        }
    }

    function pr() {
        const o = this,
            {
                params: n,
                el: r
            } = o;
        if (r && r.offsetWidth === 0) return;
        n.breakpoints && o.setBreakpoint();
        const {
            allowSlideNext: a,
            allowSlidePrev: d,
            snapGrid: u
        } = o,
        f = o.virtual && o.params.virtual.enabled;
        (o.allowSlideNext = !0),
        (o.allowSlidePrev = !0),
        o.updateSize(),
            o.updateSlides(),
            o.updateSlidesClasses();
        const p = f && n.loop;
        (n.slidesPerView === "auto" || n.slidesPerView > 1) &&
        o.isEnd &&
            !o.isBeginning &&
            !o.params.centeredSlides &&
            !p ?
            o.slideTo(o.slides.length - 1, 0, !1, !0) :
            o.params.loop && !f ?
            o.slideToLoop(o.realIndex, 0, !1, !0) :
            o.slideTo(o.activeIndex, 0, !1, !0),
            o.autoplay &&
            o.autoplay.running &&
            o.autoplay.paused &&
            (clearTimeout(o.autoplay.resizeTimeout),
                (o.autoplay.resizeTimeout = setTimeout(() => {
                    o.autoplay &&
                        o.autoplay.running &&
                        o.autoplay.paused &&
                        o.autoplay.resume();
                }, 500))),
            (o.allowSlidePrev = d),
            (o.allowSlideNext = a),
            o.params.watchOverflow && u !== o.snapGrid && o.checkOverflow();
    }

    function ca(o) {
        const n = this;
        n.enabled &&
            (n.allowClick ||
                (n.params.preventClicks && o.preventDefault(),
                    n.params.preventClicksPropagation &&
                    n.animating &&
                    (o.stopPropagation(), o.stopImmediatePropagation())));
    }

    function ha() {
        const o = this,
            {
                wrapperEl: n,
                rtlTranslate: r,
                enabled: a
            } = o;
        if (!a) return;
        (o.previousTranslate = o.translate),
        o.isHorizontal() ?
            (o.translate = -n.scrollLeft) :
            (o.translate = -n.scrollTop),
            o.translate === 0 && (o.translate = 0),
            o.updateActiveIndex(),
            o.updateSlidesClasses();
        let d;
        const u = o.maxTranslate() - o.minTranslate();
        u === 0 ? (d = 0) : (d = (o.translate - o.minTranslate()) / u),
            d !== o.progress && o.updateProgress(r ? -o.translate : o.translate),
            o.emit("setTranslate", o.translate, !1);
    }

    function fa(o) {
        const n = this;
        He(n, o.target),
            !(
                n.params.cssMode ||
                (n.params.slidesPerView !== "auto" && !n.params.autoHeight)
            ) && n.update();
    }

    function pa() {
        const o = this;
        o.documentTouchHandlerProceeded ||
            ((o.documentTouchHandlerProceeded = !0),
                o.params.touchReleaseOnEdges && (o.el.style.touchAction = "auto"));
    }
    const Pr = (o, n) => {
        const r = Rt(),
            {
                params: a,
                el: d,
                wrapperEl: u,
                device: f
            } = o,
            p = !!a.nested,
            h = n === "on" ? "addEventListener" : "removeEventListener",
            y = n;
        !d ||
            typeof d == "string" ||
            (r[h]("touchstart", o.onDocumentTouchStart, {
                    passive: !1,
                    capture: p
                }),
                d[h]("touchstart", o.onTouchStart, {
                    passive: !1
                }),
                d[h]("pointerdown", o.onTouchStart, {
                    passive: !1
                }),
                r[h]("touchmove", o.onTouchMove, {
                    passive: !1,
                    capture: p
                }),
                r[h]("pointermove", o.onTouchMove, {
                    passive: !1,
                    capture: p
                }),
                r[h]("touchend", o.onTouchEnd, {
                    passive: !0
                }),
                r[h]("pointerup", o.onTouchEnd, {
                    passive: !0
                }),
                r[h]("pointercancel", o.onTouchEnd, {
                    passive: !0
                }),
                r[h]("touchcancel", o.onTouchEnd, {
                    passive: !0
                }),
                r[h]("pointerout", o.onTouchEnd, {
                    passive: !0
                }),
                r[h]("pointerleave", o.onTouchEnd, {
                    passive: !0
                }),
                r[h]("contextmenu", o.onTouchEnd, {
                    passive: !0
                }),
                (a.preventClicks || a.preventClicksPropagation) &&
                d[h]("click", o.onClick, !0),
                a.cssMode && u[h]("scroll", o.onScroll),
                a.updateOnWindowResize ?
                o[y](
                    f.ios || f.android ?
                    "resize orientationchange observerUpdate" :
                    "resize observerUpdate",
                    pr,
                    !0
                ) :
                o[y]("observerUpdate", pr, !0),
                d[h]("load", o.onLoad, {
                    capture: !0
                }));
    };

    function ma() {
        const o = this,
            {
                params: n
            } = o;
        (o.onTouchStart = la.bind(o)),
        (o.onTouchMove = da.bind(o)),
        (o.onTouchEnd = ua.bind(o)),
        (o.onDocumentTouchStart = pa.bind(o)),
        n.cssMode && (o.onScroll = ha.bind(o)),
            (o.onClick = ca.bind(o)),
            (o.onLoad = fa.bind(o)),
            Pr(o, "on");
    }

    function _a() {
        Pr(this, "off");
    }
    var ga = {
        attachEvents: ma,
        detachEvents: _a
    };
    const mr = (o, n) => o.grid && n.grid && n.grid.rows > 1;

    function va() {
        const o = this,
            {
                realIndex: n,
                initialized: r,
                params: a,
                el: d
            } = o,
            u = a.breakpoints;
        if (!u || (u && Object.keys(u).length === 0)) return;
        const f = o.getBreakpoint(u, o.params.breakpointsBase, o.el);
        if (!f || o.currentBreakpoint === f) return;
        const h = (f in u ? u[f] : void 0) || o.originalParams,
            y = mr(o, a),
            g = mr(o, h),
            v = o.params.grabCursor,
            P = h.grabCursor,
            T = a.enabled;
        y && !g ?
            (d.classList.remove(
                    `${a.containerModifierClass}grid`,
                    `${a.containerModifierClass}grid-column`
                ),
                o.emitContainerClasses()) :
            !y &&
            g &&
            (d.classList.add(`${a.containerModifierClass}grid`),
                ((h.grid.fill && h.grid.fill === "column") ||
                    (!h.grid.fill && a.grid.fill === "column")) &&
                d.classList.add(`${a.containerModifierClass}grid-column`),
                o.emitContainerClasses()),
            v && !P ? o.unsetGrabCursor() : !v && P && o.setGrabCursor(),
            ["navigation", "pagination", "scrollbar"].forEach((M) => {
                if (typeof h[M] > "u") return;
                const z = a[M] && a[M].enabled,
                    B = h[M] && h[M].enabled;
                z && !B && o[M].disable(), !z && B && o[M].enable();
            });
        const w = h.direction && h.direction !== a.direction,
            b = a.loop && (h.slidesPerView !== a.slidesPerView || w),
            C = a.loop;
        w && r && o.changeDirection(), yt(o.params, h);
        const E = o.params.enabled,
            A = o.params.loop;
        Object.assign(o, {
                allowTouchMove: o.params.allowTouchMove,
                allowSlideNext: o.params.allowSlideNext,
                allowSlidePrev: o.params.allowSlidePrev,
            }),
            T && !E ? o.disable() : !T && E && o.enable(),
            (o.currentBreakpoint = f),
            o.emit("_beforeBreakpoint", h),
            r &&
            (b ?
                (o.loopDestroy(), o.loopCreate(n), o.updateSlides()) :
                !C && A ?
                (o.loopCreate(n), o.updateSlides()) :
                C && !A && o.loopDestroy()),
            o.emit("breakpoint", h);
    }

    function ya(o, n, r) {
        if ((n === void 0 && (n = "window"), !o || (n === "container" && !r))) return;
        let a = !1;
        const d = bt(),
            u = n === "window" ? d.innerHeight : r.clientHeight,
            f = Object.keys(o).map((p) => {
                if (typeof p == "string" && p.indexOf("@") === 0) {
                    const h = parseFloat(p.substr(1));
                    return {
                        value: u * h,
                        point: p
                    };
                }
                return {
                    value: p,
                    point: p
                };
            });
        f.sort((p, h) => parseInt(p.value, 10) - parseInt(h.value, 10));
        for (let p = 0; p < f.length; p += 1) {
            const {
                point: h,
                value: y
            } = f[p];
            n === "window" ?
                d.matchMedia(`(min-width: ${y}px)`).matches && (a = h) :
                y <= r.clientWidth && (a = h);
        }
        return a || "max";
    }
    var ba = {
        setBreakpoint: va,
        getBreakpoint: ya
    };

    function xa(o, n) {
        const r = [];
        return (
            o.forEach((a) => {
                typeof a == "object" ?
                    Object.keys(a).forEach((d) => {
                        a[d] && r.push(n + d);
                    }) :
                    typeof a == "string" && r.push(n + a);
            }),
            r
        );
    }

    function wa() {
        const o = this,
            {
                classNames: n,
                params: r,
                rtl: a,
                el: d,
                device: u
            } = o,
            f = xa(
                [
                    "initialized",
                    r.direction,
                    {
                        "free-mode": o.params.freeMode && r.freeMode.enabled
                    },
                    {
                        autoheight: r.autoHeight
                    },
                    {
                        rtl: a
                    },
                    {
                        grid: r.grid && r.grid.rows > 1
                    },
                    {
                        "grid-column": r.grid && r.grid.rows > 1 && r.grid.fill === "column",
                    },
                    {
                        android: u.android
                    },
                    {
                        ios: u.ios
                    },
                    {
                        "css-mode": r.cssMode
                    },
                    {
                        centered: r.cssMode && r.centeredSlides
                    },
                    {
                        "watch-progress": r.watchSlidesProgress
                    },
                ],
                r.containerModifierClass
            );
        n.push(...f), d.classList.add(...n), o.emitContainerClasses();
    }

    function Ta() {
        const o = this,
            {
                el: n,
                classNames: r
            } = o;
        !n ||
            typeof n == "string" ||
            (n.classList.remove(...r), o.emitContainerClasses());
    }
    var Pa = {
        addClasses: wa,
        removeClasses: Ta
    };

    function Sa() {
        const o = this,
            {
                isLocked: n,
                params: r
            } = o,
            {
                slidesOffsetBefore: a
            } = r;
        if (a) {
            const d = o.slides.length - 1,
                u = o.slidesGrid[d] + o.slidesSizesGrid[d] + a * 2;
            o.isLocked = o.size > u;
        } else o.isLocked = o.snapGrid.length === 1;
        r.allowSlideNext === !0 && (o.allowSlideNext = !o.isLocked),
            r.allowSlidePrev === !0 && (o.allowSlidePrev = !o.isLocked),
            n && n !== o.isLocked && (o.isEnd = !1),
            n !== o.isLocked && o.emit(o.isLocked ? "lock" : "unlock");
    }
    var La = {
            checkOverflow: Sa
        },
        _r = {
            init: !0,
            direction: "horizontal",
            oneWayMovement: !1,
            swiperElementNodeName: "SWIPER-CONTAINER",
            touchEventsTarget: "wrapper",
            initialSlide: 0,
            speed: 300,
            cssMode: !1,
            updateOnWindowResize: !0,
            resizeObserver: !0,
            nested: !1,
            createElements: !1,
            eventsPrefix: "swiper",
            enabled: !0,
            focusableElements: "input, select, option, textarea, button, video, label",
            width: null,
            height: null,
            preventInteractionOnTransition: !1,
            userAgent: null,
            url: null,
            edgeSwipeDetection: !1,
            edgeSwipeThreshold: 20,
            autoHeight: !1,
            setWrapperSize: !1,
            virtualTranslate: !1,
            effect: "slide",
            breakpoints: void 0,
            breakpointsBase: "window",
            spaceBetween: 0,
            slidesPerView: 1,
            slidesPerGroup: 1,
            slidesPerGroupSkip: 0,
            slidesPerGroupAuto: !1,
            centeredSlides: !1,
            centeredSlidesBounds: !1,
            slidesOffsetBefore: 0,
            slidesOffsetAfter: 0,
            normalizeSlideIndex: !0,
            centerInsufficientSlides: !1,
            watchOverflow: !0,
            roundLengths: !1,
            touchRatio: 1,
            touchAngle: 45,
            simulateTouch: !0,
            shortSwipes: !0,
            longSwipes: !0,
            longSwipesRatio: 0.5,
            longSwipesMs: 300,
            followFinger: !0,
            allowTouchMove: !0,
            threshold: 5,
            touchMoveStopPropagation: !1,
            touchStartPreventDefault: !0,
            touchStartForcePreventDefault: !1,
            touchReleaseOnEdges: !1,
            uniqueNavElements: !0,
            resistance: !0,
            resistanceRatio: 0.85,
            watchSlidesProgress: !1,
            grabCursor: !1,
            preventClicks: !0,
            preventClicksPropagation: !0,
            slideToClickedSlide: !1,
            loop: !1,
            loopAddBlankSlides: !0,
            loopAdditionalSlides: 0,
            loopPreventsSliding: !0,
            rewind: !1,
            allowSlidePrev: !0,
            allowSlideNext: !0,
            swipeHandler: null,
            noSwiping: !0,
            noSwipingClass: "swiper-no-swiping",
            noSwipingSelector: null,
            passiveListeners: !0,
            maxBackfaceHiddenSlides: 10,
            containerModifierClass: "swiper-",
            slideClass: "swiper-slide",
            slideBlankClass: "swiper-slide-blank",
            slideActiveClass: "swiper-slide-active",
            slideVisibleClass: "swiper-slide-visible",
            slideFullyVisibleClass: "swiper-slide-fully-visible",
            slideNextClass: "swiper-slide-next",
            slidePrevClass: "swiper-slide-prev",
            wrapperClass: "swiper-wrapper",
            lazyPreloaderClass: "swiper-lazy-preloader",
            lazyPreloadPrevNext: 0,
            runCallbacksOnInit: !0,
            _emitClasses: !1,
        };

    function Ea(o, n) {
        return function(a) {
            a === void 0 && (a = {});
            const d = Object.keys(a)[0],
                u = a[d];
            if (typeof u != "object" || u === null) {
                yt(n, a);
                return;
            }
            if (
                (o[d] === !0 && (o[d] = {
                        enabled: !0
                    }),
                    d === "navigation" &&
                    o[d] &&
                    o[d].enabled &&
                    !o[d].prevEl &&
                    !o[d].nextEl &&
                    (o[d].auto = !0),
                    ["pagination", "scrollbar"].indexOf(d) >= 0 &&
                    o[d] &&
                    o[d].enabled &&
                    !o[d].el &&
                    (o[d].auto = !0),
                    !(d in o && "enabled" in u))
            ) {
                yt(n, a);
                return;
            }
            typeof o[d] == "object" && !("enabled" in o[d]) && (o[d].enabled = !0),
                o[d] || (o[d] = {
                    enabled: !1
                }),
                yt(n, a);
        };
    }
    const Ni = {
            eventsEmitter: Po,
            update: Bo,
            translate: Ho,
            transition: jo,
            slide: Qo,
            loop: na,
            grabCursor: oa,
            events: ga,
            breakpoints: ba,
            checkOverflow: La,
            classes: Pa,
        },
        Ri = {};
    class _t {
        constructor() {
            let n, r;
            for (var a = arguments.length, d = new Array(a), u = 0; u < a; u++)
                d[u] = arguments[u];
            d.length === 1 &&
                d[0].constructor &&
                Object.prototype.toString.call(d[0]).slice(8, -1) === "Object" ?
                (r = d[0]) :
                ([n, r] = d),
                r || (r = {}),
                (r = yt({}, r)),
                n && !r.el && (r.el = n);
            const f = Rt();
            if (
                r.el &&
                typeof r.el == "string" &&
                f.querySelectorAll(r.el).length > 1
            ) {
                const g = [];
                return (
                    f.querySelectorAll(r.el).forEach((v) => {
                        const P = yt({}, r, {
                            el: v
                        });
                        g.push(new _t(P));
                    }),
                    g
                );
            }
            const p = this;
            (p.__swiper__ = !0),
            (p.support = xr()),
            (p.device = wr({
                userAgent: r.userAgent
            })),
            (p.browser = xo()),
            (p.eventsListeners = {}),
            (p.eventsAnyListeners = []),
            (p.modules = [...p.__modules__]),
            r.modules && Array.isArray(r.modules) && p.modules.push(...r.modules);
            const h = {};
            p.modules.forEach((g) => {
                g({
                    params: r,
                    swiper: p,
                    extendParams: Ea(r, h),
                    on: p.on.bind(p),
                    once: p.once.bind(p),
                    off: p.off.bind(p),
                    emit: p.emit.bind(p),
                });
            });
            const y = yt({}, _r, h);
            return (
                (p.params = yt({}, y, Ri, r)),
                (p.originalParams = yt({}, p.params)),
                (p.passedParams = yt({}, r)),
                p.params &&
                p.params.on &&
                Object.keys(p.params.on).forEach((g) => {
                    p.on(g, p.params.on[g]);
                }),
                p.params && p.params.onAny && p.onAny(p.params.onAny),
                Object.assign(p, {
                    enabled: p.params.enabled,
                    el: n,
                    classNames: [],
                    slides: [],
                    slidesGrid: [],
                    snapGrid: [],
                    slidesSizesGrid: [],
                    isHorizontal() {
                        return p.params.direction === "horizontal";
                    },
                    isVertical() {
                        return p.params.direction === "vertical";
                    },
                    activeIndex: 0,
                    realIndex: 0,
                    isBeginning: !0,
                    isEnd: !1,
                    translate: 0,
                    previousTranslate: 0,
                    progress: 0,
                    velocity: 0,
                    animating: !1,
                    cssOverflowAdjustment() {
                        return Math.trunc(this.translate / 2 ** 23) * 2 ** 23;
                    },
                    allowSlideNext: p.params.allowSlideNext,
                    allowSlidePrev: p.params.allowSlidePrev,
                    touchEventsData: {
                        isTouched: void 0,
                        isMoved: void 0,
                        allowTouchCallbacks: void 0,
                        touchStartTime: void 0,
                        isScrolling: void 0,
                        currentTranslate: void 0,
                        startTranslate: void 0,
                        allowThresholdMove: void 0,
                        focusableElements: p.params.focusableElements,
                        lastClickTime: 0,
                        clickTimeout: void 0,
                        velocities: [],
                        allowMomentumBounce: void 0,
                        startMoving: void 0,
                        pointerId: null,
                        touchId: null,
                    },
                    allowClick: !0,
                    allowTouchMove: p.params.allowTouchMove,
                    touches: {
                        startX: 0,
                        startY: 0,
                        currentX: 0,
                        currentY: 0,
                        diff: 0
                    },
                    imagesToLoad: [],
                    imagesLoaded: 0,
                }),
                p.emit("_swiper"),
                p.params.init && p.init(),
                p
            );
        }
        getDirectionLabel(n) {
            return this.isHorizontal() ?
                n : {
                    width: "height",
                    "margin-top": "margin-left",
                    "margin-bottom ": "margin-right",
                    "margin-left": "margin-top",
                    "margin-right": "margin-bottom",
                    "padding-left": "padding-top",
                    "padding-right": "padding-bottom",
                    marginRight: "marginBottom",
                } [n];
        }
        getSlideIndex(n) {
            const {
                slidesEl: r,
                params: a
            } = this,
            d = It(r, `.${a.slideClass}, swiper-slide`),
                u = ur(d[0]);
            return ur(n) - u;
        }
        getSlideIndexByData(n) {
            return this.getSlideIndex(
                this.slides.filter(
                    (r) => r.getAttribute("data-swiper-slide-index") * 1 === n
                )[0]
            );
        }
        recalcSlides() {
            const n = this,
                {
                    slidesEl: r,
                    params: a
                } = n;
            n.slides = It(r, `.${a.slideClass}, swiper-slide`);
        }
        enable() {
            const n = this;
            n.enabled ||
                ((n.enabled = !0),
                    n.params.grabCursor && n.setGrabCursor(),
                    n.emit("enable"));
        }
        disable() {
            const n = this;
            n.enabled &&
                ((n.enabled = !1),
                    n.params.grabCursor && n.unsetGrabCursor(),
                    n.emit("disable"));
        }
        setProgress(n, r) {
            const a = this;
            n = Math.min(Math.max(n, 0), 1);
            const d = a.minTranslate(),
                f = (a.maxTranslate() - d) * n + d;
            a.translateTo(f, typeof r > "u" ? 0 : r),
                a.updateActiveIndex(),
                a.updateSlidesClasses();
        }
        emitContainerClasses() {
            const n = this;
            if (!n.params._emitClasses || !n.el) return;
            const r = n.el.className
                .split(" ")
                .filter(
                    (a) =>
                    a.indexOf("swiper") === 0 ||
                    a.indexOf(n.params.containerModifierClass) === 0
                );
            n.emit("_containerClasses", r.join(" "));
        }
        getSlideClasses(n) {
            const r = this;
            return r.destroyed ?
                "" :
                n.className
                .split(" ")
                .filter(
                    (a) =>
                    a.indexOf("swiper-slide") === 0 ||
                    a.indexOf(r.params.slideClass) === 0
                )
                .join(" ");
        }
        emitSlidesClasses() {
            const n = this;
            if (!n.params._emitClasses || !n.el) return;
            const r = [];
            n.slides.forEach((a) => {
                    const d = n.getSlideClasses(a);
                    r.push({
                        slideEl: a,
                        classNames: d
                    }), n.emit("_slideClass", a, d);
                }),
                n.emit("_slideClasses", r);
        }
        slidesPerViewDynamic(n, r) {
            n === void 0 && (n = "current"), r === void 0 && (r = !1);
            const a = this,
                {
                    params: d,
                    slides: u,
                    slidesGrid: f,
                    slidesSizesGrid: p,
                    size: h,
                    activeIndex: y,
                } = a;
            let g = 1;
            if (typeof d.slidesPerView == "number") return d.slidesPerView;
            if (d.centeredSlides) {
                let v = u[y] ? Math.ceil(u[y].swiperSlideSize) : 0,
                    P;
                for (let T = y + 1; T < u.length; T += 1)
                    u[T] &&
                    !P &&
                    ((v += Math.ceil(u[T].swiperSlideSize)), (g += 1), v > h && (P = !0));
                for (let T = y - 1; T >= 0; T -= 1)
                    u[T] &&
                    !P &&
                    ((v += u[T].swiperSlideSize), (g += 1), v > h && (P = !0));
            } else if (n === "current")
                for (let v = y + 1; v < u.length; v += 1)
                    (r ? f[v] + p[v] - f[y] < h : f[v] - f[y] < h) && (g += 1);
            else
                for (let v = y - 1; v >= 0; v -= 1) f[y] - f[v] < h && (g += 1);
            return g;
        }
        update() {
            const n = this;
            if (!n || n.destroyed) return;
            const {
                snapGrid: r,
                params: a
            } = n;
            a.breakpoints && n.setBreakpoint(),
                [...n.el.querySelectorAll('[loading="lazy"]')].forEach((f) => {
                    f.complete && He(n, f);
                }),
                n.updateSize(),
                n.updateSlides(),
                n.updateProgress(),
                n.updateSlidesClasses();

            function d() {
                const f = n.rtlTranslate ? n.translate * -1 : n.translate,
                    p = Math.min(Math.max(f, n.maxTranslate()), n.minTranslate());
                n.setTranslate(p), n.updateActiveIndex(), n.updateSlidesClasses();
            }
            let u;
            if (a.freeMode && a.freeMode.enabled && !a.cssMode)
                d(), a.autoHeight && n.updateAutoHeight();
            else {
                if (
                    (a.slidesPerView === "auto" || a.slidesPerView > 1) &&
                    n.isEnd &&
                    !a.centeredSlides
                ) {
                    const f = n.virtual && a.virtual.enabled ? n.virtual.slides : n.slides;
                    u = n.slideTo(f.length - 1, 0, !1, !0);
                } else u = n.slideTo(n.activeIndex, 0, !1, !0);
                u || d();
            }
            a.watchOverflow && r !== n.snapGrid && n.checkOverflow(), n.emit("update");
        }
        changeDirection(n, r) {
            r === void 0 && (r = !0);
            const a = this,
                d = a.params.direction;
            return (
                n || (n = d === "horizontal" ? "vertical" : "horizontal"),
                n === d ||
                (n !== "horizontal" && n !== "vertical") ||
                (a.el.classList.remove(`${a.params.containerModifierClass}${d}`),
                    a.el.classList.add(`${a.params.containerModifierClass}${n}`),
                    a.emitContainerClasses(),
                    (a.params.direction = n),
                    a.slides.forEach((u) => {
                        n === "vertical" ? (u.style.width = "") : (u.style.height = "");
                    }),
                    a.emit("changeDirection"),
                    r && a.update()),
                a
            );
        }
        changeLanguageDirection(n) {
            const r = this;
            (r.rtl && n === "rtl") ||
            (!r.rtl && n === "ltr") ||
            ((r.rtl = n === "rtl"),
                (r.rtlTranslate = r.params.direction === "horizontal" && r.rtl),
                r.rtl ?
                (r.el.classList.add(`${r.params.containerModifierClass}rtl`),
                    (r.el.dir = "rtl")) :
                (r.el.classList.remove(`${r.params.containerModifierClass}rtl`),
                    (r.el.dir = "ltr")),
                r.update());
        }
        mount(n) {
            const r = this;
            if (r.mounted) return !0;
            let a = n || r.params.el;
            if ((typeof a == "string" && (a = document.querySelector(a)), !a))
                return !1;
            (a.swiper = r),
            a.parentNode &&
                a.parentNode.host &&
                a.parentNode.host.nodeName ===
                r.params.swiperElementNodeName.toUpperCase() &&
                (r.isElement = !0);
            const d = () =>
                `.${(r.params.wrapperClass || "").trim().split(" ").join(".")}`;
            let f =
                a && a.shadowRoot && a.shadowRoot.querySelector ?
                a.shadowRoot.querySelector(d()) :
                It(a, d())[0];
            return (
                !f &&
                r.params.createElements &&
                ((f = We("div", r.params.wrapperClass)),
                    a.append(f),
                    It(a, `.${r.params.slideClass}`).forEach((p) => {
                        f.append(p);
                    })),
                Object.assign(r, {
                    el: a,
                    wrapperEl: f,
                    slidesEl: r.isElement && !a.parentNode.host.slideSlots ? a.parentNode.host : f,
                    hostEl: r.isElement ? a.parentNode.host : a,
                    mounted: !0,
                    rtl: a.dir.toLowerCase() === "rtl" || Vt(a, "direction") === "rtl",
                    rtlTranslate: r.params.direction === "horizontal" &&
                        (a.dir.toLowerCase() === "rtl" || Vt(a, "direction") === "rtl"),
                    wrongRTL: Vt(f, "display") === "-webkit-box",
                }),
                !0
            );
        }
        init(n) {
            const r = this;
            if (r.initialized || r.mount(n) === !1) return r;
            r.emit("beforeInit"),
                r.params.breakpoints && r.setBreakpoint(),
                r.addClasses(),
                r.updateSize(),
                r.updateSlides(),
                r.params.watchOverflow && r.checkOverflow(),
                r.params.grabCursor && r.enabled && r.setGrabCursor(),
                r.params.loop && r.virtual && r.params.virtual.enabled ?
                r.slideTo(
                    r.params.initialSlide + r.virtual.slidesBefore,
                    0,
                    r.params.runCallbacksOnInit,
                    !1,
                    !0
                ) :
                r.slideTo(
                    r.params.initialSlide,
                    0,
                    r.params.runCallbacksOnInit,
                    !1,
                    !0
                ),
                r.params.loop && r.loopCreate(),
                r.attachEvents();
            const d = [...r.el.querySelectorAll('[loading="lazy"]')];
            return (
                r.isElement && d.push(...r.hostEl.querySelectorAll('[loading="lazy"]')),
                d.forEach((u) => {
                    u.complete ?
                        He(r, u) :
                        u.addEventListener("load", (f) => {
                            He(r, f.target);
                        });
                }),
                Vi(r),
                (r.initialized = !0),
                Vi(r),
                r.emit("init"),
                r.emit("afterInit"),
                r
            );
        }
        destroy(n, r) {
            n === void 0 && (n = !0), r === void 0 && (r = !0);
            const a = this,
                {
                    params: d,
                    el: u,
                    wrapperEl: f,
                    slides: p
                } = a;
            return (
                typeof a.params > "u" ||
                a.destroyed ||
                (a.emit("beforeDestroy"),
                    (a.initialized = !1),
                    a.detachEvents(),
                    d.loop && a.loopDestroy(),
                    r &&
                    (a.removeClasses(),
                        u && typeof u != "string" && u.removeAttribute("style"),
                        f && f.removeAttribute("style"),
                        p &&
                        p.length &&
                        p.forEach((h) => {
                            h.classList.remove(
                                    d.slideVisibleClass,
                                    d.slideFullyVisibleClass,
                                    d.slideActiveClass,
                                    d.slideNextClass,
                                    d.slidePrevClass
                                ),
                                h.removeAttribute("style"),
                                h.removeAttribute("data-swiper-slide-index");
                        })),
                    a.emit("destroy"),
                    Object.keys(a.eventsListeners).forEach((h) => {
                        a.off(h);
                    }),
                    n !== !1 &&
                    (a.el && typeof a.el != "string" && (a.el.swiper = null), co(a)),
                    (a.destroyed = !0)),
                null
            );
        }
        static extendDefaults(n) {
            yt(Ri, n);
        }
        static get extendedDefaults() {
            return Ri;
        }
        static get defaults() {
            return _r;
        }
        static installModule(n) {
            _t.prototype.__modules__ || (_t.prototype.__modules__ = []);
            const r = _t.prototype.__modules__;
            typeof n == "function" && r.indexOf(n) < 0 && r.push(n);
        }
        static use(n) {
            return Array.isArray(n) ?
                (n.forEach((r) => _t.installModule(r)), _t) :
                (_t.installModule(n), _t);
        }
    }
    Object.keys(Ni).forEach((o) => {
        Object.keys(Ni[o]).forEach((n) => {
            _t.prototype[n] = Ni[o][n];
        });
    });
    _t.use([wo, To]);

    function Ma(o, n, r, a) {
        return (
            o.params.createElements &&
            Object.keys(a).forEach((d) => {
                if (!r[d] && r.auto === !0) {
                    let u = It(o.el, `.${a[d]}`)[0];
                    u || ((u = We("div", a[d])), (u.className = a[d]), o.el.append(u)),
                        (r[d] = u),
                        (n[d] = u);
                }
            }),
            r
        );
    }

    function Ca(o) {
        let {
            swiper: n,
            extendParams: r,
            on: a,
            emit: d
        } = o;
        r({
                navigation: {
                    nextEl: null,
                    prevEl: null,
                    hideOnClick: !1,
                    disabledClass: "swiper-button-disabled",
                    hiddenClass: "swiper-button-hidden",
                    lockClass: "swiper-button-lock",
                    navigationDisabledClass: "swiper-navigation-disabled",
                },
            }),
            (n.navigation = {
                nextEl: null,
                prevEl: null
            });

        function u(w) {
            let b;
            return w &&
                typeof w == "string" &&
                n.isElement &&
                ((b = n.el.querySelector(w)), b) ?
                b :
                (w &&
                    (typeof w == "string" && (b = [...document.querySelectorAll(w)]),
                        n.params.uniqueNavElements &&
                        typeof w == "string" &&
                        b &&
                        b.length > 1 &&
                        n.el.querySelectorAll(w).length === 1 ?
                        (b = n.el.querySelector(w)) :
                        b && b.length === 1 && (b = b[0])),
                    w && !b ? w : b);
        }

        function f(w, b) {
            const C = n.params.navigation;
            (w = Dt(w)),
            w.forEach((E) => {
                E &&
                    (E.classList[b ? "add" : "remove"](...C.disabledClass.split(" ")),
                        E.tagName === "BUTTON" && (E.disabled = b),
                        n.params.watchOverflow &&
                        n.enabled &&
                        E.classList[n.isLocked ? "add" : "remove"](C.lockClass));
            });
        }

        function p() {
            const {
                nextEl: w,
                prevEl: b
            } = n.navigation;
            if (n.params.loop) {
                f(b, !1), f(w, !1);
                return;
            }
            f(b, n.isBeginning && !n.params.rewind), f(w, n.isEnd && !n.params.rewind);
        }

        function h(w) {
            w.preventDefault(),
                !(n.isBeginning && !n.params.loop && !n.params.rewind) &&
                (n.slidePrev(), d("navigationPrev"));
        }

        function y(w) {
            w.preventDefault(),
                !(n.isEnd && !n.params.loop && !n.params.rewind) &&
                (n.slideNext(), d("navigationNext"));
        }

        function g() {
            const w = n.params.navigation;
            if (
                ((n.params.navigation = Ma(
                        n,
                        n.originalParams.navigation,
                        n.params.navigation, {
                            nextEl: "swiper-button-next",
                            prevEl: "swiper-button-prev"
                        }
                    )),
                    !(w.nextEl || w.prevEl))
            )
                return;
            let b = u(w.nextEl),
                C = u(w.prevEl);
            Object.assign(n.navigation, {
                    nextEl: b,
                    prevEl: C
                }),
                (b = Dt(b)),
                (C = Dt(C));
            const E = (A, M) => {
                A && A.addEventListener("click", M === "next" ? y : h),
                    !n.enabled && A && A.classList.add(...w.lockClass.split(" "));
            };
            b.forEach((A) => E(A, "next")), C.forEach((A) => E(A, "prev"));
        }

        function v() {
            let {
                nextEl: w,
                prevEl: b
            } = n.navigation;
            (w = Dt(w)), (b = Dt(b));
            const C = (E, A) => {
                E.removeEventListener("click", A === "next" ? y : h),
                    E.classList.remove(...n.params.navigation.disabledClass.split(" "));
            };
            w.forEach((E) => C(E, "next")), b.forEach((E) => C(E, "prev"));
        }
        a("init", () => {
                n.params.navigation.enabled === !1 ? T() : (g(), p());
            }),
            a("toEdge fromEdge lock unlock", () => {
                p();
            }),
            a("destroy", () => {
                v();
            }),
            a("enable disable", () => {
                let {
                    nextEl: w,
                    prevEl: b
                } = n.navigation;
                if (((w = Dt(w)), (b = Dt(b)), n.enabled)) {
                    p();
                    return;
                }
                [...w, ...b]
                .filter((C) => !!C)
                    .forEach((C) => C.classList.add(n.params.navigation.lockClass));
            }),
            a("click", (w, b) => {
                let {
                    nextEl: C,
                    prevEl: E
                } = n.navigation;
                (C = Dt(C)), (E = Dt(E));
                const A = b.target;
                let M = E.includes(A) || C.includes(A);
                if (n.isElement && !M) {
                    const z = b.path || (b.composedPath && b.composedPath());
                    z && (M = z.find((B) => C.includes(B) || E.includes(B)));
                }
                if (n.params.navigation.hideOnClick && !M) {
                    if (
                        n.pagination &&
                        n.params.pagination &&
                        n.params.pagination.clickable &&
                        (n.pagination.el === A || n.pagination.el.contains(A))
                    )
                        return;
                    let z;
                    C.length ?
                        (z = C[0].classList.contains(n.params.navigation.hiddenClass)) :
                        E.length &&
                        (z = E[0].classList.contains(n.params.navigation.hiddenClass)),
                        d(z === !0 ? "navigationShow" : "navigationHide"),
                        [...C, ...E]
                        .filter((B) => !!B)
                        .forEach((B) =>
                            B.classList.toggle(n.params.navigation.hiddenClass)
                        );
                }
            });
        const P = () => {
                n.el.classList.remove(
                        ...n.params.navigation.navigationDisabledClass.split(" ")
                    ),
                    g(),
                    p();
            },
            T = () => {
                n.el.classList.add(
                        ...n.params.navigation.navigationDisabledClass.split(" ")
                    ),
                    v();
            };
        Object.assign(n.navigation, {
            enable: P,
            disable: T,
            update: p,
            init: g,
            destroy: v,
        });
    }

    function Ia(o) {
        let {
            swiper: n,
            extendParams: r,
            on: a,
            emit: d,
            params: u
        } = o;
        (n.autoplay = {
            running: !1,
            paused: !1,
            timeLeft: 0
        }),
        r({
            autoplay: {
                enabled: !1,
                delay: 3e3,
                waitForTransition: !0,
                disableOnInteraction: !1,
                stopOnLastSlide: !1,
                reverseDirection: !1,
                pauseOnMouseEnter: !1,
            },
        });
        let f,
            p,
            h = u && u.autoplay ? u.autoplay.delay : 3e3,
            y = u && u.autoplay ? u.autoplay.delay : 3e3,
            g,
            v = new Date().getTime(),
            P,
            T,
            w,
            b,
            C,
            E,
            A;

        function M(I) {
            !n ||
                n.destroyed ||
                !n.wrapperEl ||
                (I.target === n.wrapperEl &&
                    (n.wrapperEl.removeEventListener("transitionend", M),
                        !(A || (I.detail && I.detail.bySwiperTouchMove)) && O()));
        }
        const z = () => {
                if (n.destroyed || !n.autoplay.running) return;
                n.autoplay.paused ? (P = !0) : P && ((y = g), (P = !1));
                const I = n.autoplay.paused ? g : v + y - new Date().getTime();
                (n.autoplay.timeLeft = I),
                d("autoplayTimeLeft", I, I / h),
                    (p = requestAnimationFrame(() => {
                        z();
                    }));
            },
            B = () => {
                let I;
                return (
                    n.virtual && n.params.virtual.enabled ?
                    (I = n.slides.filter((Z) =>
                        Z.classList.contains("swiper-slide-active")
                    )[0]) :
                    (I = n.slides[n.activeIndex]),
                    I ? parseInt(I.getAttribute("data-swiper-autoplay"), 10) : void 0
                );
            },
            j = (I) => {
                if (n.destroyed || !n.autoplay.running) return;
                cancelAnimationFrame(p), z();
                let ct = typeof I > "u" ? n.params.autoplay.delay : I;
                (h = n.params.autoplay.delay), (y = n.params.autoplay.delay);
                const Z = B();
                !Number.isNaN(Z) &&
                    Z > 0 &&
                    typeof I > "u" &&
                    ((ct = Z), (h = Z), (y = Z)),
                    (g = ct);
                const $ = n.params.speed,
                    ot = () => {
                        !n ||
                            n.destroyed ||
                            (n.params.autoplay.reverseDirection ?
                                !n.isBeginning || n.params.loop || n.params.rewind ?
                                (n.slidePrev($, !0, !0), d("autoplay")) :
                                n.params.autoplay.stopOnLastSlide ||
                                (n.slideTo(n.slides.length - 1, $, !0, !0), d("autoplay")) :
                                !n.isEnd || n.params.loop || n.params.rewind ?
                                (n.slideNext($, !0, !0), d("autoplay")) :
                                n.params.autoplay.stopOnLastSlide ||
                                (n.slideTo(0, $, !0, !0), d("autoplay")),
                                n.params.cssMode &&
                                ((v = new Date().getTime()),
                                    requestAnimationFrame(() => {
                                        j();
                                    })));
                    };
                return (
                    ct > 0 ?
                    (clearTimeout(f),
                        (f = setTimeout(() => {
                            ot();
                        }, ct))) :
                    requestAnimationFrame(() => {
                        ot();
                    }),
                    ct
                );
            },
            gt = () => {
                (v = new Date().getTime()),
                (n.autoplay.running = !0),
                j(),
                    d("autoplayStart");
            },
            K = () => {
                (n.autoplay.running = !1),
                clearTimeout(f),
                    cancelAnimationFrame(p),
                    d("autoplayStop");
            },
            dt = (I, ct) => {
                if (n.destroyed || !n.autoplay.running) return;
                clearTimeout(f), I || (E = !0);
                const Z = () => {
                    d("autoplayPause"),
                        n.params.autoplay.waitForTransition ?
                        n.wrapperEl.addEventListener("transitionend", M) :
                        O();
                };
                if (((n.autoplay.paused = !0), ct)) {
                    C && (g = n.params.autoplay.delay), (C = !1), Z();
                    return;
                }
                (g = (g || n.params.autoplay.delay) - (new Date().getTime() - v)),
                !(n.isEnd && g < 0 && !n.params.loop) && (g < 0 && (g = 0), Z());
            },
            O = () => {
                (n.isEnd && g < 0 && !n.params.loop) ||
                n.destroyed ||
                    !n.autoplay.running ||
                    ((v = new Date().getTime()),
                        E ? ((E = !1), j(g)) : j(),
                        (n.autoplay.paused = !1),
                        d("autoplayResume"));
            },
            D = () => {
                if (n.destroyed || !n.autoplay.running) return;
                const I = Rt();
                I.visibilityState === "hidden" && ((E = !0), dt(!0)),
                    I.visibilityState === "visible" && O();
            },
            R = (I) => {
                I.pointerType === "mouse" &&
                    ((E = !0), (A = !0), !(n.animating || n.autoplay.paused) && dt(!0));
            },
            H = (I) => {
                I.pointerType === "mouse" && ((A = !1), n.autoplay.paused && O());
            },
            q = () => {
                n.params.autoplay.pauseOnMouseEnter &&
                    (n.el.addEventListener("pointerenter", R),
                        n.el.addEventListener("pointerleave", H));
            },
            at = () => {
                n.el &&
                    typeof n.el != "string" &&
                    (n.el.removeEventListener("pointerenter", R),
                        n.el.removeEventListener("pointerleave", H));
            },
            tt = () => {
                Rt().addEventListener("visibilitychange", D);
            },
            kt = () => {
                Rt().removeEventListener("visibilitychange", D);
            };
        a("init", () => {
                n.params.autoplay.enabled && (q(), tt(), gt());
            }),
            a("destroy", () => {
                at(), kt(), n.autoplay.running && K();
            }),
            a("_freeModeStaticRelease", () => {
                (w || E) && O();
            }),
            a("_freeModeNoMomentumRelease", () => {
                n.params.autoplay.disableOnInteraction ? K() : dt(!0, !0);
            }),
            a("beforeTransitionStart", (I, ct, Z) => {
                n.destroyed ||
                    !n.autoplay.running ||
                    (Z || !n.params.autoplay.disableOnInteraction ? dt(!0, !0) : K());
            }),
            a("sliderFirstMove", () => {
                if (!(n.destroyed || !n.autoplay.running)) {
                    if (n.params.autoplay.disableOnInteraction) {
                        K();
                        return;
                    }
                    (T = !0),
                    (w = !1),
                    (E = !1),
                    (b = setTimeout(() => {
                        (E = !0), (w = !0), dt(!0);
                    }, 200));
                }
            }),
            a("touchEnd", () => {
                if (!(n.destroyed || !n.autoplay.running || !T)) {
                    if (
                        (clearTimeout(b),
                            clearTimeout(f),
                            n.params.autoplay.disableOnInteraction)
                    ) {
                        (w = !1), (T = !1);
                        return;
                    }
                    w && n.params.cssMode && O(), (w = !1), (T = !1);
                }
            }),
            a("slideChange", () => {
                n.destroyed || !n.autoplay.running || (C = !0);
            }),
            Object.assign(n.autoplay, {
                start: gt,
                stop: K,
                pause: dt,
                resume: O
            });
    }
    _t.use([Ca, Ia]);
    const gr = {
        slidesPerView: 2,
        spaceBetween: 20,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        loop: !0,
        breakpoints: {
            700: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            1215: {
                slidesPerView: 4,
                spaceBetween: 24
            },
        },
    };

    function ka() {
        new _t(".companies-slider", {
            ...gr
        }), new _t(".articles-slider", {
            ...gr
        });
    }
    const Fe = document.querySelectorAll(".company-card"),
        Aa = document.querySelector("#company-card-detail"),
        Oa = {
            sigorta: `<div class="flex justify-start items-start tablet-small:items-center flex-col">
    <h1 class="text-vkl-t-h2 font-bold text-red-950">
    شرکت ANKARA SIGORTA
    </h1>
    <p class="mt-6  text-justify mobile-medium:mt-3  tablet-small:pb-4">
    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با
    استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در
    ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و
    کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی
    در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می
    طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی
    الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
    صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و
    شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای
    اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده
    قرار گیرد.

    </p>
    <div
    class="mt-auto flex justify-start items-center tablet-small:justify-center gap-4 w-full text-vkl-c-header"
    >
    <p>لیست مراکز درمانی طرف قرارداد</p>
    <button class="pri-btn">دانلود لیست</button>
    </div>
</div>
<div id="assurance-table" dir="ltr" class="relative overflow-hidden">
    <table class="table-auto w-full text-left">
    <thead class="bg-red-950 text-neutral-50 font-bold">
        <tr>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            دوساله
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            سال دوم
            <br />
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            سال اول
            <br />
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            <div>
            رده سنی&nbsp;&nbsp;&nbsp;
            <br />
            </div>
        </td>
        </tr>
    </thead>
    <tbody class="bg-transparent">
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            6,265
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            5,175
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            0 تا 15
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            16 تا 25
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            26 تا 35
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            36 تا45
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            46 تا 50
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            51 تا 55
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            56 تا 60
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            61 تا 65
            <br />
        </td>
        </tr>
    </tbody>
    </table>
</div>`,
            demir: `<div class="flex justify-start items-start tablet-small:items-center flex-col">
    <h1 class="text-vkl-t-h2 font-bold text-red-950">
    شرکت DEMIR 
    </h1>
    <p class="mt-6  text-justify mobile-medium:mt-3  tablet-small:pb-4">
    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با
    استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در
    ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و
    کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی
    در شصت و سه درصد گذشته حال و آینده، شناهکارها، و
    شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای
    اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده
    قرار گیرد.
    </p>
    <div
    class="mt-auto flex justify-start items-center tablet-small:justify-center gap-4 w-full text-vkl-c-header"
    >
    <p>لیست مراکز درمانی طرف قرارداد</p>
    <button class="pri-btn">دانلود لیست</button>
    </div>
</div>
<div id="assurance-table" dir="ltr" class="relative overflow-hidden">
    <table class="table-auto w-full text-left">
    <thead class="bg-red-950 text-neutral-50 font-bold">
        <tr>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            دوساله
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            سال دوم
            <br />
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            سال اول
            <br />
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            <div>
            رده سنی&nbsp;&nbsp;&nbsp;
            <br />
            </div>
        </td>
        </tr>
    </thead>
    <tbody class="bg-transparent">
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            1,265
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            5,175
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            0 تا 15
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            16 تا 25
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            26 تا 35
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            36 تا45
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            46 تا 50
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            51 تا 55
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            56 تا 60
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            61 تا 65
            <br />
        </td>
        </tr>
    </tbody>
    </table>
</div>`,
            sompo: `<div class="flex justify-start items-start tablet-small:items-center flex-col">
    <h1 class="text-vkl-t-h2 font-bold text-red-950">
    شرکت SIMPO
    </h1>
    <p class="mt-6  text-justify mobile-medium:mt-3  tablet-small:pb-4">
    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با
    استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در
    ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و
    کاربردهای متنوع با هدفربردی می باشد، کتابهای زیادی
    در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می
    طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی
    الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
    صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و
    شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای
    اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده
    قرار گیرد.
    </p>
    <div
    class="mt-auto flex justify-start items-center tablet-small:justify-center gap-4 w-full text-vkl-c-header"
    >
    <p>لیست مراکز درمانی طرف قرارداد</p>
    <button class="pri-btn">دانلود لیست</button>
    </div>
</div>
<div id="assurance-table" dir="ltr" class="relative overflow-hidden">
    <table class="table-auto w-full text-left">
    <thead class="bg-red-950 text-neutral-50 font-bold">
        <tr>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            دوساله
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            سال دوم
            <br />
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            سال اول
            <br />
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            <div>
            رده سنی&nbsp;&nbsp;&nbsp;
            <br />
            </div>
        </td>
        </tr>
    </thead>
    <tbody class="bg-transparent">
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            4,265
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            5,175
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            0 تا 15
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            16 تا 25
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            26 تا 35
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            36 تا45
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            46 تا 50
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            51 تا 55
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            56 تا 60
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            61 تا 65
            <br />
        </td>
        </tr>
    </tbody>
    </table>
</div>`,
            nippon: `<div class="flex justify-start items-start tablet-small:items-center flex-col">
    <h1 class="text-vkl-t-h2 font-bold text-red-950">
    شرکت NIPPON
    </h1>
    <p class="mt-6  text-justify mobile-medium:mt-3  tablet-small:pb-4">
    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با
    استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در
    ستون و سطرآنچنان که لازم است، وعه و متخصصان را می
    طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی
    الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
    صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و
    شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای
    اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده
    قرار گیرد.
    </p>
    <div
    class="mt-auto flex justify-start items-center tablet-small:justify-center gap-4 w-full text-vkl-c-header"
    >
    <p>لیست مراکز درمانی طرف قرارداد</p>
    <button class="pri-btn">دانلود لیست</button>
    </div>
</div>
<div id="assurance-table" dir="ltr" class="relative overflow-hidden">
    <table class="table-auto w-full text-left">
    <thead class="bg-red-950 text-neutral-50 font-bold">
        <tr>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            دوساله
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            سال دوم
            <br />
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            سال اول
            <br />
        </td>
        <td
            class="py-2 border border-red-100 text-center p-4"
            contenteditable="true"
        >
            <div>
            رده سنی&nbsp;&nbsp;&nbsp;
            <br />
            </div>
        </td>
        </tr>
    </thead>
    <tbody class="bg-transparent">
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            2,265
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            5,175
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            0 تا 15
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            16 تا 25
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            26 تا 35
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            36 تا45
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            46 تا 50
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            51 تا 55
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            56 تا 60
            <br />
        </td>
        </tr>
        <tr class="">
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            3,450
        </td>
        <td
            class="border border-red-100 text-center py-2"
            contenteditable="true"
        >
            61 تا 65
            <br />
        </td>
        </tr>
    </tbody>
    </table>
</div>`,
        };

    function za() {
        for (let o = 0; o < Fe.length; o++)
            Fe[o].addEventListener("click", (r) => {
                var d;
                let a = (d = r.target) == null ? void 0 : d.closest("li");
                for (let u = 0; u < Fe.length; u++)
                    Fe[u].classList.remove("active-company-card");
                a.classList.add("active-company-card"), (Aa.innerHTML = Oa[a.id]);
            });
    }
    const Ba = document.querySelector("#burger-btn"),
        Za = document.querySelector("body");
    Xs(Ba, Za);
    vr();
    ka();
    Ks();
    ao();
    $s();
    za();