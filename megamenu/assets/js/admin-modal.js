(() => {
    var t = {
            631: () => {
                jQuery(document).ready(function (t) {
                    "use strict";
                    var e;
                    if (
                        (t(".ekit-admin-single-accordion").on("click", ".ekit-admin-single-accordion--heading", function () {
                            t(this).next().slideToggle().parent().toggleClass("active").siblings().removeClass("active").find(".ekit-admin-single-accordion--body").slideUp();
                        }),
                        t(".ekit-admin-single-accordion:first-child .ekit-admin-single-accordion--heading").trigger("click"),
                        t(".ekit-admin-video-tutorial-item").on("click", "a", function (e) {
                            var i = t(this).data("video_id");
                            i &&
                                (e.preventDefault(),
                                t(".ekti-admin-video-tutorial-popup")
                                    .toggleClass("show")
                                    .find(".ekti-admin-video-tutorial-iframe")
                                    .html(
                                        '<iframe width="700" height="400" src="https://www.youtube.com/embed/' +
                                            i +
                                            '?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'
                                    ));
                        }),
                        t(".ekti-admin-video-tutorial-close").on("click", function () {
                            t(this).parents(".ekti-admin-video-tutorial-popup").removeClass("show").find(".ekti-admin-video-tutorial-iframe").html("");
                        }),
                        t(".ekit-admin-nav-link").on("click", function (e) {
                            t(this).hasClass("ekit-admin-nav-hidden")
                                ? e.preventDefault()
                                : ((window.location.hash = this.hash),
                                  t(this).parents(".attr-nav-tabs").find("a").removeClass("top").removeClass("bottom"),
                                  t(this).parents("li").prev().find("a").addClass("top"),
                                  t(this).parents("li").next().find("a").addClass("bottom"));
                        }),
                        (e = window.location.hash) && t(`${e}-tab`).trigger("click"),
                        t("#v-thwidgetpack-tabContent").length > 0)
                    ) {
                        var i = t("#v-thwidgetpack-tabContent").offset().top;
                        t(window).scroll(function () {
                            var e = t(".ekit-admin-section-header");
                            t(window).scrollTop() >= i ? e.addClass("fixed").css({ width: jQuery("#v-thwidgetpack-tabContent").width() }) : e.removeClass("fixed").css({ width: "auto" });
                        });
                    }
                    function n(e) {
                        var i = e.closest(".attr-tab-pane"),
                            n = t(i).find(".ekit-admin-fields-container-fieldset"),
                            o = n.find(".ekit-admin-control-input:checked").length == n.find(".ekit-admin-control-input:not(:disabled)").length;
                        t(i).find(".ekit-all-control-input").prop("checked", o);
                    }
                    function o(e, i) {
                        var n = e.getAttribute("aria-controls"),
                            o = document.getElementById(`${n}`);
                        i
                            ? (t(o).removeClass("attr-in"), (o.style.height = "0px"), (e.style.pointerEvents = "none"))
                            : ((o.style.height = "auto"), (e.style.pointerEvents = "auto"), "mail_chimp_data_control" === n && t(o).addClass("attr-in"));
                    }
                    function r(e) {
                        var i = e.value,
                            n = t(`.label-${i}`),
                            r = n.find(".attr-btn");
                        t(e).prop("checked") ? n.removeClass("widget-disabled") : n.addClass("widget-disabled");
                        var s = document.createElement("small");
                        if ((s.setAttribute("class", "attr-widget-activate-text"), s.setAttribute("id", `disable-msg-${i}`), (s.textContent = "Disabled"), n.hasClass("widget-disabled")))
                            r.hasClass("attr-btn") && (n.hasClass("pro-disabled") || (r[0].setAttribute("aria-expanded", !1), r[0].appendChild(s)), o(r[0], !0));
                        else if (r.hasClass("attr-btn")) {
                            "mail-chimp" === i && r[0].setAttribute("aria-expanded", !0);
                            var a = document.getElementById(`disable-msg-${i}`);
                            if (a) a.parentNode.removeChild(a);
                            o(r[0], !1);
                        }
                    }  
                        document.querySelectorAll(".ekit-admin-control-input").forEach((t) => {
                            r(t);
                        }),
                        t(".ekit-all-control-input").each((t, e) => {
                            n(e);
                        }),
                        t(".ekit-admin-fields-container-fieldset .ekit-admin-control-input").on("change", (t) => {
                            n(t.target), r(t.target);
                        }),
                        t(".ekit-all-control-input").on("change", (e) => {
                            var i = t(e.target).closest(".attr-tab-pane").find(".ekit-admin-fields-container")[0];
                            t(i)
                                .find(".ekit-admin-control-input:not(:disabled)")
                                .each((i, n) => {
                                    t(n).prop("checked", e.target.checked), r(n);
                                });
                        });
                });
            },
            674: () => {
                if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");
                !(function (t) {
                    "use strict";
                    var e = t.fn.jquery.split(" ")[0].split(".");
                    if ((e[0] < 2 && e[1] < 9) || (1 == e[0] && 9 == e[1] && e[2] < 1) || e[0] > 3) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4");
                })(jQuery),
                    (function (t) {
                        "use strict";
                        (t.fn.emulateTransitionEnd = function (e) {
                            var i = !1,
                                n = this;
                            t(this).one("bsTransitionEnd", function () {
                                i = !0;
                            });
                            return (
                                setTimeout(function () {
                                    i || t(n).trigger(t.support.transition.end);
                                }, e),
                                this
                            );
                        }),
                            t(function () {
                                (t.support.transition = (function () {
                                    var t = document.createElement("bootstrap"),
                                        e = { WebkitTransition: "webkitTransitionEnd", MozTransition: "transitionend", OTransition: "oTransitionEnd otransitionend", transition: "transitionend" };
                                    for (var i in e) if (t.style[i] !== undefined) return { end: e[i] };
                                    return !1;
                                })()),
                                    t.support.transition &&
                                        (t.event.special.bsTransitionEnd = {
                                            bindType: t.support.transition.end,
                                            delegateType: t.support.transition.end,
                                            handle: function (e) {
                                                if (t(e.target).is(this)) return e.handleObj.handler.apply(this, arguments);
                                            },
                                        });
                            });
                    })(jQuery),
                    (function (t) {
                        "use strict";
                        var e = '[data-dismiss="alert"]',
                            i = function (i) {
                                t(i).on("click", e, this.close);
                            };
                        (i.VERSION = "3.3.7"),
                            (i.TRANSITION_DURATION = 150),
                            (i.prototype.close = function (e) {
                                var n = t(this),
                                    o = n.attr("data-target");
                                o || (o = (o = n.attr("href")) && o.replace(/.*(?=#[^\s]*$)/, ""));
                                var r = t("#" === o ? [] : o);
                                function s() {
                                    r.detach().trigger("closed.bs.attr-alert").remove();
                                }
                                e && e.preventDefault(),
                                    r.length || (r = n.closest(".attr-alert")),
                                    r.trigger((e = t.Event("close.bs.attr-alert"))),
                                    e.isDefaultPrevented() || (r.removeClass("attr-in"), t.support.transition && r.hasClass("attr-fade") ? r.one("bsTransitionEnd", s).emulateTransitionEnd(i.TRANSITION_DURATION) : s());
                            });
                        var n = t.fn.alert;
                        (t.fn.alert = function (e) {
                            return this.each(function () {
                                var n = t(this),
                                    o = n.data("bs.attr-alert");
                                o || n.data("bs.alert", (o = new i(this))), "string" == typeof e && o[e].call(n);
                            });
                        }),
                            (t.fn.alert.Constructor = i),
                            (t.fn.alert.noConflict = function () {
                                return (t.fn.alert = n), this;
                            }),
                            t(document).on("click.bs.alert.data-api", e, i.prototype.close);
                    })(jQuery),
                    (function (t) {
                        "use strict";
                        var e = function (i, n) {
                            (this.$element = t(i)), (this.options = t.extend({}, e.DEFAULTS, n)), (this.isLoading = !1);
                        };
                        function i(i) {
                            return this.each(function () {
                                var n = t(this),
                                    o = n.data("bs.button"),
                                    r = "object" == typeof i && i;
                                o || n.data("bs.button", (o = new e(this, r))), "toggle" == i ? o.toggle() : i && o.setState(i);
                            });
                        }
                        (e.VERSION = "3.3.7"),
                            (e.DEFAULTS = { loadingText: "loading..." }),
                            (e.prototype.setState = function (e) {
                                var i = "disabled",
                                    n = this.$element,
                                    o = n.is("input") ? "val" : "html",
                                    r = n.data();
                                (e += "Text"),
                                    null == r.resetText && n.data("resetText", n[o]()),
                                    setTimeout(
                                        t.proxy(function () {
                                            n[o](null == r[e] ? this.options[e] : r[e]),
                                                "loadingText" == e
                                                    ? ((this.isLoading = !0),
                                                      n
                                                          .addClass("attr-" + i)
                                                          .attr(i, i)
                                                          .prop(i, !0))
                                                    : this.isLoading &&
                                                      ((this.isLoading = !1),
                                                      n
                                                          .removeClass("attr-" + i)
                                                          .removeAttr(i)
                                                          .prop(i, !1));
                                        }, this),
                                        0
                                    );
                            }),
                            (e.prototype.toggle = function () {
                                var t = !0,
                                    e = this.$element.closest('[data-attr-toggle="buttons"]');
                                if (e.length) {
                                    var i = this.$element.find("input");
                                    "radio" == i.prop("type")
                                        ? (i.prop("checked") && (t = !1), e.find(".attr-active").removeClass("attr-active"), this.$element.addClass("attr-active"))
                                        : "checkbox" == i.prop("type") && (i.prop("checked") !== this.$element.hasClass("attr-active") && (t = !1), this.$element.toggleClass("attr-active")),
                                        i.prop("checked", this.$element.hasClass("attr-active")),
                                        t && i.trigger("change");
                                } else this.$element.attr("aria-pressed", !this.$element.hasClass("attr-active")), this.$element.toggleClass("attr-active");
                            });
                        var n = t.fn.button;
                        (t.fn.button = i),
                            (t.fn.button.Constructor = e),
                            (t.fn.button.noConflict = function () {
                                return (t.fn.button = n), this;
                            }),
                            t(document)
                                .on("click.bs.button.data-api", '[data-attr-toggle^="button"]', function (e) {
                                    var n = t(e.target).closest(".attr-btn");
                                    i.call(n, "toggle"),
                                        t(e.target).is('input[type="radio"], input[type="checkbox"]') || (e.preventDefault(), n.is("input,button") ? n.trigger("focus") : n.find("input:visible,button:visible").first().trigger("focus"));
                                })
                                .on("focus.bs.button.data-api blur.bs.button.data-api", '[data-attr-toggle^="button"]', function (e) {
                                    t(e.target)
                                        .closest(".attr-btn")
                                        .toggleClass("attr-focus", /^focus(in)?$/.test(e.type));
                                });
                    })(jQuery),
                    (function (t) {
                        "use strict";
                        var e = function (e, i) {
                            (this.$element = t(e)),
                                (this.$indicators = this.$element.find(".attr-carousel-indicators")),
                                (this.options = i),
                                (this.paused = null),
                                (this.sliding = null),
                                (this.interval = null),
                                (this.$active = null),
                                (this.$items = null),
                                this.options.keyboard && this.$element.on("keydown.bs.carousel", t.proxy(this.keydown, this)),
                                "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", t.proxy(this.pause, this)).on("mouseleave.bs.carousel", t.proxy(this.cycle, this));
                        };
                        function i(i) {
                            return this.each(function () {
                                var n = t(this),
                                    o = n.data("bs.attr-carousel"),
                                    r = t.extend({}, e.DEFAULTS, n.data(), "object" == typeof i && i),
                                    s = "string" == typeof i ? i : r.slide;
                                o || n.data("bs.carousel", (o = new e(this, r))), "number" == typeof i ? o.to(i) : s ? o[s]() : r.interval && o.pause().cycle();
                            });
                        }
                        (e.VERSION = "3.3.7"),
                            (e.TRANSITION_DURATION = 600),
                            (e.DEFAULTS = { interval: 5e3, pause: "hover", wrap: !0, keyboard: !0 }),
                            (e.prototype.keydown = function (t) {
                                if (!/input|textarea/i.test(t.target.tagName)) {
                                    switch (t.which) {
                                        case 37:
                                            this.prev();
                                            break;
                                        case 39:
                                            this.next();
                                            break;
                                        default:
                                            return;
                                    }
                                    t.preventDefault();
                                }
                            }),
                            (e.prototype.cycle = function (e) {
                                return e || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(t.proxy(this.next, this), this.options.interval)), this;
                            }),
                            (e.prototype.getItemIndex = function (t) {
                                return (this.$items = t.parent().children(".attr-item")), this.$items.index(t || this.$active);
                            }),
                            (e.prototype.getItemForDirection = function (t, e) {
                                var i = this.getItemIndex(e);
                                if ((("prev" == t && 0 === i) || ("next" == t && i == this.$items.length - 1)) && !this.options.wrap) return e;
                                var n = (i + ("prev" == t ? -1 : 1)) % this.$items.length;
                                return this.$items.eq(n);
                            }),
                            (e.prototype.to = function (t) {
                                var e = this,
                                    i = this.getItemIndex((this.$active = this.$element.find(".attr-item.attr-active")));
                                if (!(t > this.$items.length - 1 || t < 0))
                                    return this.sliding
                                        ? this.$element.one("slid.bs.carousel", function () {
                                              e.to(t);
                                          })
                                        : i == t
                                        ? this.pause().cycle()
                                        : this.slide(t > i ? "next" : "prev", this.$items.eq(t));
                            }),
                            (e.prototype.pause = function (e) {
                                return (
                                    e || (this.paused = !0),
                                    this.$element.find(".attr-next, .attr-prev").length && t.support.transition && (this.$element.trigger(t.support.transition.end), this.cycle(!0)),
                                    (this.interval = clearInterval(this.interval)),
                                    this
                                );
                            }),
                            (e.prototype.next = function () {
                                if (!this.sliding) return this.slide("next");
                            }),
                            (e.prototype.prev = function () {
                                if (!this.sliding) return this.slide("prev");
                            }),
                            (e.prototype.slide = function (i, n) {
                                var o = this.$element.find(".attr-item.attr-active"),
                                    r = n || this.getItemForDirection(i, o),
                                    s = this.interval,
                                    a = "next" == i ? "left" : "right",
                                    l = this;
                                if (r.hasClass("attr-active")) return (this.sliding = !1);
                                var d = r[0],
                                    c = t.Event("slide.bs.carousel", { relatedTarget: d, direction: a });
                                if ((this.$element.trigger(c), !c.isDefaultPrevented())) {
                                    if (((this.sliding = !0), s && this.pause(), this.$indicators.length)) {
                                        this.$indicators.find(".attr-active").removeClass("attr-active");
                                        var p = t(this.$indicators.children()[this.getItemIndex(r)]);
                                        p && p.addClass("attr-active");
                                    }
                                    var h = t.Event("slid.bs.carousel", { relatedTarget: d, direction: a });
                                    return (
                                        t.support.transition && this.$element.hasClass("slide")
                                            ? (r.addClass("attr-" + i),
                                              r[0].offsetWidth,
                                              o.addClass("attr-" + a),
                                              r.addClass("attr-" + a),
                                              o
                                                  .one("bsTransitionEnd", function () {
                                                      r.removeClass(["attr-" + i, "attr-" + a].join(" ")).addClass("attr-active"),
                                                          o.removeClass(["attr-active", "attr-" + a].join(" ")),
                                                          (l.sliding = !1),
                                                          setTimeout(function () {
                                                              l.$element.trigger(h);
                                                          }, 0);
                                                  })
                                                  .emulateTransitionEnd(e.TRANSITION_DURATION))
                                            : (o.removeClass("attr-active"), r.addClass("attr-active"), (this.sliding = !1), this.$element.trigger(h)),
                                        s && this.cycle(),
                                        this
                                    );
                                }
                            });
                        var n = t.fn.carousel;
                        (t.fn.carousel = i),
                            (t.fn.carousel.Constructor = e),
                            (t.fn.carousel.noConflict = function () {
                                return (t.fn.carousel = n), this;
                            });
                        var o = function (e) {
                            var n,
                                o = t(this),
                                r = t(o.attr("data-target") || ((n = o.attr("href")) && n.replace(/.*(?=#[^\s]+$)/, "")));
                            if (r.hasClass("attr-carousel")) {
                                var s = t.extend({}, r.data(), o.data()),
                                    a = o.attr("data-slide-to");
                                a && (s.interval = !1), i.call(r, s), a && r.data("bs.attr-carousel").to(a), e.preventDefault();
                            }
                        };
                        t(document).on("click.bs.carousel.data-api", "[data-slide]", o).on("click.bs.carousel.data-api", "[data-slide-to]", o),
                            t(window).on("load", function () {
                                t('[data-ride="carousel"]').each(function () {
                                    var e = t(this);
                                    i.call(e, e.data());
                                });
                            });
                    })(jQuery),
                    (function (t) {
                        "use strict";
                        var e = function (i, n) {
                            (this.$element = t(i)),
                                (this.options = t.extend({}, e.DEFAULTS, n)),
                                (this.$trigger = t('[data-attr-toggle="collapse"][href="#' + i.id + '"],[data-attr-toggle="collapse"][data-target="#' + i.id + '"]')),
                                (this.transitioning = null),
                                this.options.parent ? (this.$parent = this.getParent()) : this.addAriaAndCollapsedClass(this.$element, this.$trigger),
                                this.options.toggle && this.toggle();
                        };
                        function i(e) {
                            var i,
                                n = e.attr("data-target") || ((i = e.attr("href")) && i.replace(/.*(?=#[^\s]+$)/, ""));
                            return t(n);
                        }
                        function n(i) {
                            return this.each(function () {
                                var n = t(this),
                                    o = n.data("bs.attr-collapse"),
                                    r = t.extend({}, e.DEFAULTS, n.data(), "object" == typeof i && i);
                                !o && r.toggle && /show|hide/.test(i) && (r.toggle = !1), o || n.data("bs.collapse", (o = new e(this, r))), "string" == typeof i && o[i]();
                            });
                        }
                        (e.VERSION = "3.3.7"),
                            (e.TRANSITION_DURATION = 350),
                            (e.DEFAULTS = { toggle: !0 }),
                            (e.prototype.dimension = function () {
                                return this.$element.hasClass("width") ? "width" : "height";
                            }),
                            (e.prototype.show = function () {
                                if (!this.transitioning && !this.$element.hasClass("attr-in")) {
                                    var i,
                                        o = this.$parent && this.$parent.children(".attr-panel").children(".attr-in, .attr-collapsing");
                                    if (!(o && o.length && (i = o.data("bs.attr-collapse")) && i.transitioning)) {
                                        var r = t.Event("show.bs.attr-collapse");
                                        if ((this.$element.trigger(r), !r.isDefaultPrevented())) {
                                            o && o.length && (n.call(o, "hide"), i || o.data("bs.collapse", null));
                                            var s = this.dimension();
                                            this.$element.removeClass("attr-collapse").addClass("attr-collapsing")[s](0).attr("aria-expanded", !0),
                                                this.$trigger.removeClass("attr-collapsed").attr("aria-expanded", !0),
                                                (this.transitioning = 1);
                                            var a = function () {
                                                this.$element.removeClass("attr-collapsing").addClass("attr-collapse attr-in")[s](""), (this.transitioning = 0), this.$element.trigger("shown.bs.attr-collapse");
                                            };
                                            if (!t.support.transition) return a.call(this);
                                            var l = t.camelCase(["scroll", s].join("-"));
                                            this.$element.one("bsTransitionEnd", t.proxy(a, this)).emulateTransitionEnd(e.TRANSITION_DURATION)[s](this.$element[0][l]);
                                        }
                                    }
                                }
                            }),
                            (e.prototype.hide = function () {
                                if (!this.transitioning && this.$element.hasClass("attr-in")) {
                                    var i = t.Event("hide.bs.attr-collapse");
                                    if ((this.$element.trigger(i), !i.isDefaultPrevented())) {
                                        var n = this.dimension();
                                        this.$element[n](this.$element[n]())[0].offsetHeight,
                                            this.$element.addClass("attr-collapsing").removeClass("attr-collapse attr-in").attr("aria-expanded", !1),
                                            this.$trigger.addClass("attr-collapsed").attr("aria-expanded", !1),
                                            (this.transitioning = 1);
                                        var o = function () {
                                            (this.transitioning = 0), this.$element.removeClass("attr-collapsing").addClass("attr-collapse").trigger("hidden.bs.attr-collapse");
                                        };
                                        if (!t.support.transition) return o.call(this);
                                        this.$element[n](0).one("bsTransitionEnd", t.proxy(o, this)).emulateTransitionEnd(e.TRANSITION_DURATION);
                                    }
                                }
                            }),
                            (e.prototype.toggle = function () {
                                this[this.$element.hasClass("attr-in") ? "hide" : "show"]();
                            }),
                            (e.prototype.getParent = function () {
                                return t(this.options.parent)
                                    .find('[data-attr-toggle="collapse"][data-parent="' + this.options.parent + '"]')
                                    .each(
                                        t.proxy(function (e, n) {
                                            var o = t(n);
                                            this.addAriaAndCollapsedClass(i(o), o);
                                        }, this)
                                    )
                                    .end();
                            }),
                            (e.prototype.addAriaAndCollapsedClass = function (t, e) {
                                var i = t.hasClass("attr-in");
                                t.attr("aria-expanded", i), e.toggleClass("attr-collapsed", !i).attr("aria-expanded", i);
                            });
                        var o = t.fn.collapse;
                        (t.fn.collapse = n),
                            (t.fn.collapse.Constructor = e),
                            (t.fn.collapse.noConflict = function () {
                                return (t.fn.collapse = o), this;
                            }),
                            t(document).on("click.bs.collapse.data-api", '[data-attr-toggle="collapse"]', function (e) {
                                var o = t(this);
                                o.attr("data-target") || e.preventDefault();
                                var r = i(o),
                                    s = r.data("bs.attr-collapse") ? "toggle" : o.data();
                                n.call(r, s);
                            });
                    })(jQuery),
                    (function (t) {
                        "use strict";
                        var e = ".dropdown-backdrop",
                            i = '[data-attr-toggle="dropdown"]',
                            n = function (e) {
                                t(e).on("click.bs.dropdown", this.toggle);
                            };
                        function o(e) {
                            var i = e.attr("data-target");
                            i || (i = (i = e.attr("href")) && /#[A-Za-z]/.test(i) && i.replace(/.*(?=#[^\s]*$)/, ""));
                            var n = i && t(i);
                            return n && n.length ? n : e.parent();
                        }
                        function r(n) {
                            (n && 3 === n.which) ||
                                (t(e).remove(),
                                t(i).each(function () {
                                    var e = t(this),
                                        i = o(e),
                                        r = { relatedTarget: this };
                                    i.hasClass("attr-open") &&
                                        ((n && "click" == n.type && /input|textarea/i.test(n.target.tagName) && t.contains(i[0], n.target)) ||
                                            (i.trigger((n = t.Event("hide.bs.dropdown", r))), n.isDefaultPrevented() || (e.attr("aria-expanded", "false"), i.removeClass("attr-open").trigger(t.Event("hidden.bs.dropdown", r)))));
                                }));
                        }
                        (n.VERSION = "3.3.7"),
                            (n.prototype.toggle = function (e) {
                                var i = t(this);
                                if (!i.is(".attr-disabled, :disabled")) {
                                    var n = o(i),
                                        s = n.hasClass("attr-open");
                                    if ((r(), !s)) {
                                        "ontouchstart" in document.documentElement && !n.closest(".attr-navbar-nav").length && t(document.createElement("div")).addClass("attr-dropdown-backdrop").insertAfter(t(this)).on("click", r);
                                        var a = { relatedTarget: this };
                                        if ((n.trigger((e = t.Event("show.bs.dropdown", a))), e.isDefaultPrevented())) return;
                                        i.trigger("focus").attr("aria-expanded", "true"), n.toggleClass("attr-open").trigger(t.Event("shown.bs.dropdown", a));
                                    }
                                    return !1;
                                }
                            }),
                            (n.prototype.keydown = function (e) {
                                if (/(38|40|27|32)/.test(e.which) && !/input|textarea/i.test(e.target.tagName)) {
                                    var n = t(this);
                                    if ((e.preventDefault(), e.stopPropagation(), !n.is(".attr-disabled, :disabled"))) {
                                        var r = o(n),
                                            s = r.hasClass("attr-open");
                                        if ((!s && 27 != e.which) || (s && 27 == e.which)) return 27 == e.which && r.find(i).trigger("focus"), n.trigger("click");
                                        var a = r.find(".dropdown-menu li:not(.attr-disabled):visible a");
                                        if (a.length) {
                                            var l = a.index(e.target);
                                            38 == e.which && l > 0 && l--, 40 == e.which && l < a.length - 1 && l++, ~l || (l = 0), a.eq(l).trigger("focus");
                                        }
                                    }
                                }
                            });
                        var s = t.fn.dropdown;
                        (t.fn.dropdown = function (e) {
                            return this.each(function () {
                                var i = t(this),
                                    o = i.data("bs.attr-dropdown");
                                o || i.data("bs.dropdown", (o = new n(this))), "string" == typeof e && o[e].call(i);
                            });
                        }),
                            (t.fn.dropdown.Constructor = n),
                            (t.fn.dropdown.noConflict = function () {
                                return (t.fn.dropdown = s), this;
                            }),
                            t(document)
                                .on("click.bs.dropdown.data-api", r)
                                .on("click.bs.dropdown.data-api", ".dropdown form", function (t) {
                                    t.stopPropagation();
                                })
                                .on("click.bs.dropdown.data-api", i, n.prototype.toggle)
                                .on("keydown.bs.dropdown.data-api", i, n.prototype.keydown)
                                .on("keydown.bs.dropdown.data-api", ".dropdown-menu", n.prototype.keydown);
                    })(jQuery),
                    (function (t) {
                        "use strict";
                        var e = function (e, i) {
                            (this.options = i),
                                (this.$body = t(document.body)),
                                (this.$element = t(e)),
                                (this.$dialog = this.$element.find(".attr-modal-dialog")),
                                (this.$backdrop = null),
                                (this.isShown = null),
                                (this.originalBodyPad = null),
                                (this.scrollbarWidth = 0),
                                (this.ignoreBackdropClick = !1),
                                this.options.remote &&
                                    this.$element.find(".attr-modal-content").load(
                                        this.options.remote,
                                        t.proxy(function () {
                                            this.$element.trigger("loaded.bs.attr-modal");
                                        }, this)
                                    );
                        };
                        function i(i, n) {
                            return this.each(function () {
                                var o = t(this),
                                    r = o.data("bs.attr-modal"),
                                    s = t.extend({}, e.DEFAULTS, o.data(), "object" == typeof i && i);
                                r || o.data("bs.modal", (r = new e(this, s))), "string" == typeof i ? r[i](n) : s.show && r.show(n);
                            });
                        }
                        (e.VERSION = "3.3.7"),
                            (e.TRANSITION_DURATION = 300),
                            (e.BACKDROP_TRANSITION_DURATION = 150),
                            (e.DEFAULTS = { backdrop: !0, keyboard: !0, show: !0 }),
                            (e.prototype.toggle = function (t) {
                                return this.isShown ? this.hide() : this.show(t);
                            }),
                            (e.prototype.show = function (i) {
                                var n = this,
                                    o = t.Event("show.bs.modal", { relatedTarget: i });
                                this.$element.trigger(o),
                                    this.isShown ||
                                        o.isDefaultPrevented() ||
                                        ((this.isShown = !0),
                                        this.checkScrollbar(),
                                        this.setScrollbar(),
                                        this.$body.addClass("attr-modal-open"),
                                        this.escape(),
                                        this.resize(),
                                        this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', t.proxy(this.hide, this)),
                                        this.$dialog.on("mousedown.dismiss.bs.modal", function () {
                                            n.$element.one("mouseup.dismiss.bs.modal", function (e) {
                                                t(e.target).is(n.$element) && (n.ignoreBackdropClick = !0);
                                            });
                                        }),
                                        this.backdrop(function () {
                                            var o = t.support.transition && n.$element.hasClass("attr-fade");
                                            n.$element.parent().length || n.$element.appendTo(n.$body), n.$element.show().scrollTop(0), n.adjustDialog(), o && n.$element[0].offsetWidth, n.$element.addClass("attr-in"), n.enforceFocus();
                                            var r = t.Event("shown.bs.modal", { relatedTarget: i });
                                            o
                                                ? n.$dialog
                                                      .one("bsTransitionEnd", function () {
                                                          n.$element.trigger("focus").trigger(r);
                                                      })
                                                      .emulateTransitionEnd(e.TRANSITION_DURATION)
                                                : n.$element.trigger("focus").trigger(r);
                                        }));
                            }),
                            (e.prototype.hide = function (i) {
                                i && i.preventDefault(),
                                    (i = t.Event("hide.bs.attr-modal")),
                                    this.$element.trigger(i),
                                    this.isShown &&
                                        !i.isDefaultPrevented() &&
                                        ((this.isShown = !1),
                                        this.escape(),
                                        this.resize(),
                                        t(document).off("focusin.bs.modal"),
                                        this.$element.removeClass("attr-in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"),
                                        this.$dialog.off("mousedown.dismiss.bs.modal"),
                                        t.support.transition && this.$element.hasClass("attr-fade") ? this.$element.one("bsTransitionEnd", t.proxy(this.hideModal, this)).emulateTransitionEnd(e.TRANSITION_DURATION) : this.hideModal());
                            }),
                            (e.prototype.enforceFocus = function () {
                                t(document)
                                    .off("focusin.bs.modal")
                                    .on(
                                        "focusin.bs.modal",
                                        t.proxy(function (t) {
                                            document === t.target || this.$element[0] === t.target || this.$element.has(t.target).length || this.$element.trigger("focus");
                                        }, this)
                                    );
                            }),
                            (e.prototype.escape = function () {
                                this.isShown && this.options.keyboard
                                    ? this.$element.on(
                                          "keydown.dismiss.bs.modal",
                                          t.proxy(function (t) {
                                              27 == t.which && this.hide();
                                          }, this)
                                      )
                                    : this.isShown || this.$element.off("keydown.dismiss.bs.modal");
                            }),
                            (e.prototype.resize = function () {
                                this.isShown ? t(window).on("resize.bs.modal", t.proxy(this.handleUpdate, this)) : t(window).off("resize.bs.modal");
                            }),
                            (e.prototype.hideModal = function () {
                                var t = this;
                                this.$element.hide(),
                                    this.backdrop(function () {
                                        t.$body.removeClass("attr-modal-open"), t.resetAdjustments(), t.resetScrollbar(), t.$element.trigger("hidden.bs.attr-modal");
                                    });
                            }),
                            (e.prototype.removeBackdrop = function () {
                                this.$backdrop && this.$backdrop.remove(), (this.$backdrop = null);
                            }),
                            (e.prototype.backdrop = function (i) {
                                var n = this,
                                    o = this.$element.hasClass("attr-fade") ? "attr-fade" : "";
                                if (this.isShown && this.options.backdrop) {
                                    var r = t.support.transition && o;
                                    if (
                                        ((this.$backdrop = t(document.createElement("div"))
                                            .addClass("modal-backdrop " + o)
                                            .appendTo(this.$body)),
                                        this.$element.on(
                                            "click.dismiss.bs.modal",
                                            t.proxy(function (t) {
                                                this.ignoreBackdropClick ? (this.ignoreBackdropClick = !1) : t.target === t.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus() : this.hide());
                                            }, this)
                                        ),
                                        r && this.$backdrop[0].offsetWidth,
                                        this.$backdrop.addClass("attr-in"),
                                        !i)
                                    )
                                        return;
                                    r ? this.$backdrop.one("bsTransitionEnd", i).emulateTransitionEnd(e.BACKDROP_TRANSITION_DURATION) : i();
                                } else if (!this.isShown && this.$backdrop) {
                                    this.$backdrop.removeClass("attr-in");
                                    var s = function () {
                                        n.removeBackdrop(), i && i();
                                    };
                                    t.support.transition && this.$element.hasClass("attr-fade") ? this.$backdrop.one("bsTransitionEnd", s).emulateTransitionEnd(e.BACKDROP_TRANSITION_DURATION) : s();
                                } else i && i();
                            }),
                            (e.prototype.handleUpdate = function () {
                                this.adjustDialog();
                            }),
                            (e.prototype.adjustDialog = function () {
                                var t = this.$element[0].scrollHeight > document.documentElement.clientHeight;
                                this.$element.css({ paddingLeft: !this.bodyIsOverflowing && t ? this.scrollbarWidth : "", paddingRight: this.bodyIsOverflowing && !t ? this.scrollbarWidth : "" });
                            }),
                            (e.prototype.resetAdjustments = function () {
                                this.$element.css({ paddingLeft: "", paddingRight: "" });
                            }),
                            (e.prototype.checkScrollbar = function () {
                                var t = window.innerWidth;
                                if (!t) {
                                    var e = document.documentElement.getBoundingClientRect();
                                    t = e.right - Math.abs(e.left);
                                }
                                (this.bodyIsOverflowing = document.body.clientWidth < t), (this.scrollbarWidth = this.measureScrollbar());
                            }),
                            (e.prototype.setScrollbar = function () {
                                var t = parseInt(this.$body.css("padding-right") || 0, 10);
                                (this.originalBodyPad = document.body.style.paddingRight || ""), this.bodyIsOverflowing && this.$body.css("padding-right", t + this.scrollbarWidth);
                            }),
                            (e.prototype.resetScrollbar = function () {
                                this.$body.css("padding-right", this.originalBodyPad);
                            }),
                            (e.prototype.measureScrollbar = function () {
                                var t = document.createElement("div");
                                (t.className = "modal-scrollbar-measure"), this.$body.append(t);
                                var e = t.offsetWidth - t.clientWidth;
                                return this.$body[0].removeChild(t), e;
                            });
                        var n = t.fn.modal;
                        (t.fn.modal = i),
                            (t.fn.modal.Constructor = e),
                            (t.fn.modal.noConflict = function () {
                                return (t.fn.modal = n), this;
                            }),
                            t(document).on("click.bs.modal.data-api", '[data-attr-toggle="modal"]', function (e) {
                                var n = t(this),
                                    o = n.attr("href"),
                                    r = t(n.attr("data-target") || (o && o.replace(/.*(?=#[^\s]+$)/, ""))),
                                    s = r.data("bs.attr-modal") ? "toggle" : t.extend({ remote: !/#/.test(o) && o }, r.data(), n.data());
                                n.is("a") && e.preventDefault(),
                                    r.one("show.bs.modal", function (t) {
                                        t.isDefaultPrevented() ||
                                            r.one("hidden.bs.modal", function () {
                                                n.is(":visible") && n.trigger("focus");
                                            });
                                    }),
                                    i.call(r, s, this);
                            });
                    })(jQuery),
                    (function (t) {
                        "use strict";
                        var e = function (t, e) {
                            (this.type = null), (this.options = null), (this.enabled = null), (this.timeout = null), (this.hoverState = null), (this.$element = null), (this.inState = null), this.init("tooltip", t, e);
                        };
                        (e.VERSION = "3.3.7"),
                            (e.TRANSITION_DURATION = 150),
                            (e.DEFAULTS = {
                                animation: !0,
                                placement: "top",
                                selector: !1,
                                template: '<div class="attr-tooltip" role="tooltip"><div class="attr-tooltip-arrow"></div><div class="attr-tooltip-inner"></div></div>',
                                trigger: "hover focus",
                                title: "",
                                delay: 0,
                                html: !1,
                                container: !1,
                                viewport: { selector: "body", padding: 0 },
                            }),
                            (e.prototype.init = function (e, i, n) {
                                if (
                                    ((this.enabled = !0),
                                    (this.type = e),
                                    (this.$element = t(i)),
                                    (this.options = this.getOptions(n)),
                                    (this.$viewport = this.options.viewport && t(t.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport)),
                                    (this.inState = { click: !1, hover: !1, focus: !1 }),
                                    this.$element[0] instanceof document.constructor && !this.options.selector)
                                )
                                    throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
                                for (var o = this.options.trigger.split(" "), r = o.length; r--; ) {
                                    var s = o[r];
                                    if ("click" == s) this.$element.on("click." + this.type, this.options.selector, t.proxy(this.toggle, this));
                                    else if ("manual" != s) {
                                        var a = "hover" == s ? "mouseenter" : "focusin",
                                            l = "hover" == s ? "mouseleave" : "focusout";
                                        this.$element.on(a + "." + this.type, this.options.selector, t.proxy(this.enter, this)), this.$element.on(l + "." + this.type, this.options.selector, t.proxy(this.leave, this));
                                    }
                                }
                                this.options.selector ? (this._options = t.extend({}, this.options, { trigger: "manual", selector: "" })) : this.fixTitle();
                            }),
                            (e.prototype.getDefaults = function () {
                                return e.DEFAULTS;
                            }),
                            (e.prototype.getOptions = function (e) {
                                return (e = t.extend({}, this.getDefaults(), this.$element.data(), e)).delay && "number" == typeof e.delay && (e.delay = { show: e.delay, hide: e.delay }), e;
                            }),
                            (e.prototype.getDelegateOptions = function () {
                                var e = {},
                                    i = this.getDefaults();
                                return (
                                    this._options &&
                                        t.each(this._options, function (t, n) {
                                            i[t] != n && (e[t] = n);
                                        }),
                                    e
                                );
                            }),
                            (e.prototype.enter = function (e) {
                                var i = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
                                if (
                                    (i || ((i = new this.constructor(e.currentTarget, this.getDelegateOptions())), t(e.currentTarget).data("bs." + this.type, i)),
                                    e instanceof t.Event && (i.inState["focusin" == e.type ? "focus" : "hover"] = !0),
                                    i.tip().hasClass("attr-in") || "in" == i.hoverState)
                                )
                                    i.hoverState = "in";
                                else {
                                    if ((clearTimeout(i.timeout), (i.hoverState = "in"), !i.options.delay || !i.options.delay.show)) return i.show();
                                    i.timeout = setTimeout(function () {
                                        "in" == i.hoverState && i.show();
                                    }, i.options.delay.show);
                                }
                            }),
                            (e.prototype.isInStateTrue = function () {
                                for (var t in this.inState) if (this.inState[t]) return !0;
                                return !1;
                            }),
                            (e.prototype.leave = function (e) {
                                var i = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
                                if (
                                    (i || ((i = new this.constructor(e.currentTarget, this.getDelegateOptions())), t(e.currentTarget).data("bs." + this.type, i)),
                                    e instanceof t.Event && (i.inState["focusout" == e.type ? "focus" : "hover"] = !1),
                                    !i.isInStateTrue())
                                ) {
                                    if ((clearTimeout(i.timeout), (i.hoverState = "out"), !i.options.delay || !i.options.delay.hide)) return i.hide();
                                    i.timeout = setTimeout(function () {
                                        "out" == i.hoverState && i.hide();
                                    }, i.options.delay.hide);
                                }
                            }),
                            (e.prototype.show = function () {
                                var i = t.Event("show.bs." + this.type);
                                if (this.hasContent() && this.enabled) {
                                    this.$element.trigger(i);
                                    var n = t.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
                                    if (i.isDefaultPrevented() || !n) return;
                                    var o = this,
                                        r = this.tip(),
                                        s = this.getUID(this.type);
                                    this.setContent(), r.attr("id", s), this.$element.attr("aria-describedby", s), this.options.animation && r.addClass("attr-fade");
                                    var a = "function" == typeof this.options.placement ? this.options.placement.call(this, r[0], this.$element[0]) : this.options.placement,
                                        l = /\s?auto?\s?/i,
                                        d = l.test(a);
                                    d && (a = a.replace(l, "") || "top"),
                                        r
                                            .detach()
                                            .css({ top: 0, left: 0, display: "block" })
                                            .addClass("attr-" + a)
                                            .data("bs." + this.type, this),
                                        this.options.container ? r.appendTo(this.options.container) : r.insertAfter(this.$element),
                                        this.$element.trigger("inserted.bs." + this.type);
                                    var c = this.getPosition(),
                                        p = r[0].offsetWidth,
                                        h = r[0].offsetHeight;
                                    if (d) {
                                        var f = a,
                                            u = this.getPosition(this.$viewport);
                                        (a = "bottom" == a && c.bottom + h > u.bottom ? "top" : "top" == a && c.top - h < u.top ? "bottom" : "right" == a && c.right + p > u.width ? "left" : "left" == a && c.left - p < u.left ? "right" : a),
                                            r.removeClass("attr-" + f).addClass("attr-" + a);
                                    }
                                    var m = this.getCalculatedOffset(a, c, p, h);
                                    this.applyPlacement(m, a);
                                    var g = function () {
                                        var t = o.hoverState;
                                        o.$element.trigger("shown.bs." + o.type), (o.hoverState = null), "out" == t && o.leave(o);
                                    };
                                    t.support.transition && this.$tip.hasClass("attr-fade") ? r.one("bsTransitionEnd", g).emulateTransitionEnd(e.TRANSITION_DURATION) : g();
                                }
                            }),
                            (e.prototype.applyPlacement = function (e, i) {
                                var n = this.tip(),
                                    o = n[0].offsetWidth,
                                    r = n[0].offsetHeight,
                                    s = parseInt(n.css("margin-top"), 10),
                                    a = parseInt(n.css("margin-left"), 10);
                                isNaN(s) && (s = 0),
                                    isNaN(a) && (a = 0),
                                    (e.top += s),
                                    (e.left += a),
                                    t.offset.setOffset(
                                        n[0],
                                        t.extend(
                                            {
                                                using: function (t) {
                                                    n.css({ top: Math.round(t.top), left: Math.round(t.left) });
                                                },
                                            },
                                            e
                                        ),
                                        0
                                    ),
                                    n.addClass("attr-in");
                                var l = n[0].offsetWidth,
                                    d = n[0].offsetHeight;
                                "top" == i && d != r && (e.top = e.top + r - d);
                                var c = this.getViewportAdjustedDelta(i, e, l, d);
                                c.left ? (e.left += c.left) : (e.top += c.top);
                                var p = /top|bottom/.test(i),
                                    h = p ? 2 * c.left - o + l : 2 * c.top - r + d,
                                    f = p ? "offsetWidth" : "offsetHeight";
                                n.offset(e), this.replaceArrow(h, n[0][f], p);
                            }),
                            (e.prototype.replaceArrow = function (t, e, i) {
                                this.arrow()
                                    .css(i ? "left" : "top", 50 * (1 - t / e) + "%")
                                    .css(i ? "top" : "left", "");
                            }),
                            (e.prototype.setContent = function () {
                                var t = this.tip(),
                                    e = this.getTitle();
                                t.find(".attr-tooltip-inner")[this.options.html ? "html" : "text"](e), t.removeClass("attr-fade attr-in attr-top attr-bottom attr-left attr-right");
                            }),
                            (e.prototype.hide = function (i) {
                                var n = this,
                                    o = t(this.$tip),
                                    r = t.Event("hide.bs." + this.type);
                                function s() {
                                    "in" != n.hoverState && o.detach(), n.$element && n.$element.removeAttr("aria-describedby").trigger("hidden.bs." + n.type), i && i();
                                }
                                if ((this.$element.trigger(r), !r.isDefaultPrevented()))
                                    return o.removeClass("attr-in"), t.support.transition && o.hasClass("attr-fade") ? o.one("bsTransitionEnd", s).emulateTransitionEnd(e.TRANSITION_DURATION) : s(), (this.hoverState = null), this;
                            }),
                            (e.prototype.fixTitle = function () {
                                var t = this.$element;
                                (t.attr("title") || "string" != typeof t.attr("data-original-title")) && t.attr("data-original-title", t.attr("title") || "").attr("title", "");
                            }),
                            (e.prototype.hasContent = function () {
                                return this.getTitle();
                            }),
                            (e.prototype.getPosition = function (e) {
                                var i = (e = e || this.$element)[0],
                                    n = "BODY" == i.tagName,
                                    o = i.getBoundingClientRect();
                                null == o.width && (o = t.extend({}, o, { width: o.right - o.left, height: o.bottom - o.top }));
                                var r = window.SVGElement && i instanceof window.SVGElement,
                                    s = n ? { top: 0, left: 0 } : r ? null : e.offset(),
                                    a = { scroll: n ? document.documentElement.scrollTop || document.body.scrollTop : e.scrollTop() },
                                    l = n ? { width: t(window).width(), height: t(window).height() } : null;
                                return t.extend({}, o, a, l, s);
                            }),
                            (e.prototype.getCalculatedOffset = function (t, e, i, n) {
                                return "bottom" == t
                                    ? { top: e.top + e.height, left: e.left + e.width / 2 - i / 2 }
                                    : "top" == t
                                    ? { top: e.top - n, left: e.left + e.width / 2 - i / 2 }
                                    : "left" == t
                                    ? { top: e.top + e.height / 2 - n / 2, left: e.left - i }
                                    : { top: e.top + e.height / 2 - n / 2, left: e.left + e.width };
                            }),
                            (e.prototype.getViewportAdjustedDelta = function (t, e, i, n) {
                                var o = { top: 0, left: 0 };
                                if (!this.$viewport) return o;
                                var r = (this.options.viewport && this.options.viewport.padding) || 0,
                                    s = this.getPosition(this.$viewport);
                                if (/right|left/.test(t)) {
                                    var a = e.top - r - s.scroll,
                                        l = e.top + r - s.scroll + n;
                                    a < s.top ? (o.top = s.top - a) : l > s.top + s.height && (o.top = s.top + s.height - l);
                                } else {
                                    var d = e.left - r,
                                        c = e.left + r + i;
                                    d < s.left ? (o.left = s.left - d) : c > s.right && (o.left = s.left + s.width - c);
                                }
                                return o;
                            }),
                            (e.prototype.getTitle = function () {
                                var t = this.$element,
                                    e = this.options;
                                return t.attr("data-original-title") || ("function" == typeof e.title ? e.title.call(t[0]) : e.title);
                            }),
                            (e.prototype.getUID = function (t) {
                                do {
                                    t += ~~(1e6 * Math.random());
                                } while (document.getElementById(t));
                                return t;
                            }),
                            (e.prototype.tip = function () {
                                if (!this.$tip && ((this.$tip = t(this.options.template)), 1 != this.$tip.length)) throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!");
                                return this.$tip;
                            }),
                            (e.prototype.arrow = function () {
                                return (this.$arrow = this.$arrow || this.tip().find(".attr-tooltip-arrow"));
                            }),
                            (e.prototype.enable = function () {
                                this.enabled = !0;
                            }),
                            (e.prototype.disable = function () {
                                this.enabled = !1;
                            }),
                            (e.prototype.toggleEnabled = function () {
                                this.enabled = !this.enabled;
                            }),
                            (e.prototype.toggle = function (e) {
                                var i = this;
                                e && ((i = t(e.currentTarget).data("bs." + this.type)) || ((i = new this.constructor(e.currentTarget, this.getDelegateOptions())), t(e.currentTarget).data("bs." + this.type, i))),
                                    e ? ((i.inState.click = !i.inState.click), i.isInStateTrue() ? i.enter(i) : i.leave(i)) : i.tip().hasClass("attr-in") ? i.leave(i) : i.enter(i);
                            }),
                            (e.prototype.destroy = function () {
                                var t = this;
                                clearTimeout(this.timeout),
                                    this.hide(function () {
                                        t.$element.off("." + t.type).removeData("bs." + t.type), t.$tip && t.$tip.detach(), (t.$tip = null), (t.$arrow = null), (t.$viewport = null), (t.$element = null);
                                    });
                            });
                        var i = t.fn.tooltip;
                        (t.fn.tooltip = function (i) {
                            return this.each(function () {
                                var n = t(this),
                                    o = n.data("bs.attr-tooltip"),
                                    r = "object" == typeof i && i;
                                (!o && /destroy|hide/.test(i)) || (o || n.data("bs.tooltip", (o = new e(this, r))), "string" == typeof i && o[i]());
                            });
                        }),
                            (t.fn.tooltip.Constructor = e),
                            (t.fn.tooltip.noConflict = function () {
                                return (t.fn.tooltip = i), this;
                            });
                    })(jQuery),
                    (function (t) {
                        "use strict";
                        var e = function (t, e) {
                            this.init("popover", t, e);
                        };
                        if (!t.fn.tooltip) throw new Error("Popover requires tooltip.js");
                        (e.VERSION = "3.3.7"),
                            (e.DEFAULTS = t.extend({}, t.fn.tooltip.Constructor.DEFAULTS, {
                                placement: "right",
                                trigger: "click",
                                content: "",
                                template: '<div class="attr-popover" role="tooltip"><div class="attr-arrow"></div><h3 class="attr-popover-title"></h3><div class="attr-popover-content"></div></div>',
                            })),
                            (e.prototype = t.extend({}, t.fn.tooltip.Constructor.prototype)),
                            (e.prototype.constructor = e),
                            (e.prototype.getDefaults = function () {
                                return e.DEFAULTS;
                            }),
                            (e.prototype.setContent = function () {
                                var t = this.tip(),
                                    e = this.getTitle(),
                                    i = this.getContent();
                                t.find(".attr-popover-title")[this.options.html ? "html" : "text"](e),
                                    t.find(".attr-popover-content").children().detach().end()[this.options.html ? ("string" == typeof i ? "html" : "append") : "text"](i),
                                    t.removeClass("attr-fade attr-top attr-bottom attr-left attr-right attr-in"),
                                    t.find(".attr-popover-title").html() || t.find(".attr-popover-title").hide();
                            }),
                            (e.prototype.hasContent = function () {
                                return this.getTitle() || this.getContent();
                            }),
                            (e.prototype.getContent = function () {
                                var t = this.$element,
                                    e = this.options;
                                return t.attr("data-content") || ("function" == typeof e.content ? e.content.call(t[0]) : e.content);
                            }),
                            (e.prototype.arrow = function () {
                                return (this.$arrow = this.$arrow || this.tip().find(".attr-arrow"));
                            });
                        var i = t.fn.popover;
                        (t.fn.popover = function (i) {
                            return this.each(function () {
                                var n = t(this),
                                    o = n.data("bs.attr-popover"),
                                    r = "object" == typeof i && i;
                                (!o && /destroy|hide/.test(i)) || (o || n.data("bs.popover", (o = new e(this, r))), "string" == typeof i && o[i]());
                            });
                        }),
                            (t.fn.popover.Constructor = e),
                            (t.fn.popover.noConflict = function () {
                                return (t.fn.popover = i), this;
                            });
                    })(jQuery),
                    (function (t) {
                        "use strict";
                        function e(i, n) {
                            (this.$body = t(document.body)),
                                (this.$scrollElement = t(i).is(document.body) ? t(window) : t(i)),
                                (this.options = t.extend({}, e.DEFAULTS, n)),
                                (this.selector = (this.options.target || "") + " .nav li > a"),
                                (this.offsets = []),
                                (this.targets = []),
                                (this.activeTarget = null),
                                (this.scrollHeight = 0),
                                this.$scrollElement.on("scroll.bs.scrollspy", t.proxy(this.process, this)),
                                this.refresh(),
                                this.process();
                        }
                        function i(i) {
                            return this.each(function () {
                                var n = t(this),
                                    o = n.data("bs.scrollspy"),
                                    r = "object" == typeof i && i;
                                o || n.data("bs.scrollspy", (o = new e(this, r))), "string" == typeof i && o[i]();
                            });
                        }
                        (e.VERSION = "3.3.7"),
                            (e.DEFAULTS = { offset: 10 }),
                            (e.prototype.getScrollHeight = function () {
                                return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight);
                            }),
                            (e.prototype.refresh = function () {
                                var e = this,
                                    i = "offset",
                                    n = 0;
                                (this.offsets = []),
                                    (this.targets = []),
                                    (this.scrollHeight = this.getScrollHeight()),
                                    t.isWindow(this.$scrollElement[0]) || ((i = "position"), (n = this.$scrollElement.scrollTop())),
                                    this.$body
                                        .find(this.selector)
                                        .map(function () {
                                            var e = t(this),
                                                o = e.data("target") || e.attr("href"),
                                                r = /^#./.test(o) && t(o);
                                            return (r && r.length && r.is(":visible") && [[r[i]().top + n, o]]) || null;
                                        })
                                        .sort(function (t, e) {
                                            return t[0] - e[0];
                                        })
                                        .each(function () {
                                            e.offsets.push(this[0]), e.targets.push(this[1]);
                                        });
                            }),
                            (e.prototype.process = function () {
                                var t,
                                    e = this.$scrollElement.scrollTop() + this.options.offset,
                                    i = this.getScrollHeight(),
                                    n = this.options.offset + i - this.$scrollElement.height(),
                                    o = this.offsets,
                                    r = this.targets,
                                    s = this.activeTarget;
                                if ((this.scrollHeight != i && this.refresh(), e >= n)) return s != (t = r[r.length - 1]) && this.activate(t);
                                if (s && e < o[0]) return (this.activeTarget = null), this.clear();
                                for (t = o.length; t--; ) s != r[t] && e >= o[t] && (o[t + 1] === undefined || e < o[t + 1]) && this.activate(r[t]);
                            }),
                            (e.prototype.activate = function (e) {
                                (this.activeTarget = e), this.clear();
                                var i = this.selector + '[data-target="' + e + '"],' + this.selector + '[href="' + e + '"]',
                                    n = t(i).parents("li").addClass("attr-active");
                                n.parent(".attr-dropdown-menu").length && (n = n.closest("li.attr-dropdown").addClass("attr-active")), n.trigger("activate.bs.scrollspy");
                            }),
                            (e.prototype.clear = function () {
                                t(this.selector).parentsUntil(this.options.target, ".active").removeClass("attr-active");
                            });
                        var n = t.fn.scrollspy;
                        (t.fn.scrollspy = i),
                            (t.fn.scrollspy.Constructor = e),
                            (t.fn.scrollspy.noConflict = function () {
                                return (t.fn.scrollspy = n), this;
                            }),
                            t(window).on("load.bs.scrollspy.data-api", function () {
                                t('[data-spy="scroll"]').each(function () {
                                    var e = t(this);
                                    i.call(e, e.data());
                                });
                            });
                    })(jQuery),
                    (function (t) {
                        "use strict";
                        var e = function (e) {
                            this.element = t(e);
                        };
                        function i(i) {
                            return this.each(function () {
                                var n = t(this),
                                    o = n.data("bs.tab");
                                o || n.data("bs.tab", (o = new e(this))), "string" == typeof i && o[i]();
                            });
                        }
                        (e.VERSION = "3.3.7"),
                            (e.TRANSITION_DURATION = 150),
                            (e.prototype.show = function () {
                                var e = this.element,
                                    i = e.closest("ul:not(.attr-dropdown-menu)"),
                                    n = e.data("target");
                                if ((n || (n = (n = e.attr("href")) && n.replace(/.*(?=#[^\s]*$)/, "")), !e.parent("li").hasClass("attr-active"))) {
                                    var o = i.find(".attr-active:last a"),
                                        r = t.Event("hide.bs.tab", { relatedTarget: e[0] }),
                                        s = t.Event("show.bs.tab", { relatedTarget: o[0] });
                                    if ((o.trigger(r), e.trigger(s), !s.isDefaultPrevented() && !r.isDefaultPrevented())) {
                                        var a = t(n);
                                        this.activate(e.closest("li"), i),
                                            this.activate(a, a.parent(), function () {
                                                o.trigger({ type: "hidden.bs.tab", relatedTarget: e[0] }), e.trigger({ type: "shown.bs.tab", relatedTarget: o[0] });
                                            });
                                    }
                                }
                            }),
                            (e.prototype.activate = function (i, n, o) {
                                var r = n.find("> .attr-active"),
                                    s = o && t.support.transition && ((r.length && r.hasClass("attr-fade")) || !!n.find("> .attr-fade").length);
                                function a() {
                                    r.removeClass("attr-active").find("> .attr-dropdown-menu > .attr-active").removeClass("attr-active").end().find('[data-attr-toggle="tab"]').attr("aria-expanded", !1),
                                        i.addClass("attr-active").find('[data-attr-toggle="tab"]').attr("aria-expanded", !0),
                                        s ? (i[0].offsetWidth, i.addClass("attr-in")) : i.removeClass("attr-fade"),
                                        i.parent(".attr-dropdown-menu").length && i.closest("li.attr-dropdown").addClass("attr-active").end().find('[data-attr-toggle="tab"]').attr("aria-expanded", !0),
                                        o && o();
                                }
                                r.length && s ? r.one("bsTransitionEnd", a).emulateTransitionEnd(e.TRANSITION_DURATION) : a(), r.removeClass("attr-in");
                            });
                        var n = t.fn.tab;
                        (t.fn.tab = i),
                            (t.fn.tab.Constructor = e),
                            (t.fn.tab.noConflict = function () {
                                return (t.fn.tab = n), this;
                            });
                        var o = function (e) {
                            e.preventDefault(), i.call(t(this), "show");
                        };
                        t(document).on("click.bs.tab.data-api", '[data-attr-toggle="tab"]', o).on("click.bs.tab.data-api", '[data-attr-toggle="pill"]', o);
                    })(jQuery),
                    (function (t) {
                        "use strict";
                        var e = function (i, n) {
                            (this.options = t.extend({}, e.DEFAULTS, n)),
                                (this.$target = t(this.options.target).on("scroll.bs.affix.data-api", t.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", t.proxy(this.checkPositionWithEventLoop, this))),
                                (this.$element = t(i)),
                                (this.affixed = null),
                                (this.unpin = null),
                                (this.pinnedOffset = null),
                                this.checkPosition();
                        };
                        function i(i) {
                            return this.each(function () {
                                var n = t(this),
                                    o = n.data("bs.attr-affix"),
                                    r = "object" == typeof i && i;
                                o || n.data("bs.affix", (o = new e(this, r))), "string" == typeof i && o[i]();
                            });
                        }
                        (e.VERSION = "3.3.7"),
                            (e.RESET = "affix affix-top affix-bottom"),
                            (e.DEFAULTS = { offset: 0, target: window }),
                            (e.prototype.getState = function (t, e, i, n) {
                                var o = this.$target.scrollTop(),
                                    r = this.$element.offset(),
                                    s = this.$target.height();
                                if (null != i && "top" == this.affixed) return o < i && "top";
                                if ("bottom" == this.affixed) return null != i ? !(o + this.unpin <= r.top) && "bottom" : !(o + s <= t - n) && "bottom";
                                var a = null == this.affixed,
                                    l = a ? o : r.top;
                                return null != i && o <= i ? "top" : null != n && l + (a ? s : e) >= t - n && "bottom";
                            }),
                            (e.prototype.getPinnedOffset = function () {
                                if (this.pinnedOffset) return this.pinnedOffset;
                                this.$element.removeClass(e.RESET).addClass("attr-affix");
                                var t = this.$target.scrollTop(),
                                    i = this.$element.offset();
                                return (this.pinnedOffset = i.top - t);
                            }),
                            (e.prototype.checkPositionWithEventLoop = function () {
                                setTimeout(t.proxy(this.checkPosition, this), 1);
                            }),
                            (e.prototype.checkPosition = function () {
                                if (this.$element.is(":visible")) {
                                    var i = this.$element.height(),
                                        n = this.options.offset,
                                        o = n.top,
                                        r = n.bottom,
                                        s = Math.max(t(document).height(), t(document.body).height());
                                    "object" != typeof n && (r = o = n), "function" == typeof o && (o = n.top(this.$element)), "function" == typeof r && (r = n.bottom(this.$element));
                                    var a = this.getState(s, i, o, r);
                                    if (this.affixed != a) {
                                        null != this.unpin && this.$element.css("top", "");
                                        var l = "affix" + (a ? "-" + a : ""),
                                            d = t.Event(l + ".bs.affix");
                                        if ((this.$element.trigger(d), d.isDefaultPrevented())) return;
                                        (this.affixed = a),
                                            (this.unpin = "bottom" == a ? this.getPinnedOffset() : null),
                                            this.$element
                                                .removeClass(e.RESET)
                                                .addClass("attr-" + l)
                                                .trigger(l.replace("affix", "affixed") + ".bs.affix");
                                    }
                                    "bottom" == a && this.$element.offset({ top: s - i - r });
                                }
                            });
                        var n = t.fn.affix;
                        (t.fn.affix = i),
                            (t.fn.affix.Constructor = e),
                            (t.fn.affix.noConflict = function () {
                                return (t.fn.affix = n), this;
                            }),
                            t(window).on("load", function () {
                                t('[data-spy="affix"]').each(function () {
                                    var e = t(this),
                                        n = e.data();
                                    (n.offset = n.offset || {}), null != n.offsetBottom && (n.offset.bottom = n.offsetBottom), null != n.offsetTop && (n.offset.top = n.offsetTop), i.call(e, n);
                                });
                            });
                    })(jQuery);
            },
            276: function (t, e, i) {
                t.exports = (function () {
                    "use strict";
                    function t(t) {
                        return t && "[object Function]" === {}.toString.call(t);
                    }
                    function e(t, e) {
                        if (1 !== t.nodeType) return [];
                        var i = window.getComputedStyle(t, null);
                        return e ? i[e] : i;
                    }
                    function n(t) {
                        return "HTML" === t.nodeName ? t : t.parentNode || t.host;
                    }
                    function o(t) {
                        if (!t || -1 !== ["HTML", "BODY", "#document"].indexOf(t.nodeName)) return window.document.body;
                        var i = e(t),
                            r = i.overflow,
                            s = i.overflowX,
                            a = i.overflowY;
                        return /(auto|scroll)/.test(r + a + s) ? t : o(n(t));
                    }
                    function r(t) {
                        var i = t && t.offsetParent,
                            n = i && i.nodeName;
                        return n && "BODY" !== n && "HTML" !== n ? (-1 !== ["TD", "TABLE"].indexOf(i.nodeName) && "static" === e(i, "position") ? r(i) : i) : window.document.documentElement;
                    }
                    function s(t) {
                        return null === t.parentNode ? t : s(t.parentNode);
                    }
                    function a(t, e) {
                        if (!(t && t.nodeType && e && e.nodeType)) return window.document.documentElement;
                        var i = t.compareDocumentPosition(e) & Node.DOCUMENT_POSITION_FOLLOWING,
                            n = i ? t : e,
                            o = i ? e : t,
                            l = document.createRange();
                        l.setStart(n, 0), l.setEnd(o, 0);
                        var d = l.commonAncestorContainer;
                        if ((t !== d && e !== d) || n.contains(o))
                            return (function (t) {
                                var e = t.nodeName;
                                return "BODY" !== e && ("HTML" === e || r(t.firstElementChild) === t);
                            })(d)
                                ? d
                                : r(d);
                        var c = s(t);
                        return c.host ? a(c.host, e) : a(t, s(e).host);
                    }
                    function l(t) {
                        var e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "top",
                            i = "top" === e ? "scrollTop" : "scrollLeft",
                            n = t.nodeName;
                        if ("BODY" === n || "HTML" === n) {
                            var o = window.document.documentElement,
                                r = window.document.scrollingElement || o;
                            return r[i];
                        }
                        return t[i];
                    }
                    function d(t, e) {
                        var i = 2 < arguments.length && void 0 !== arguments[2] && arguments[2],
                            n = l(e, "top"),
                            o = l(e, "left"),
                            r = i ? -1 : 1;
                        return (t.top += n * r), (t.bottom += n * r), (t.left += o * r), (t.right += o * r), t;
                    }
                    function c(t, e) {
                        var i = "x" === e ? "Left" : "Top",
                            n = "Left" == i ? "Right" : "Bottom";
                        return +t["border" + i + "Width"].split("px")[0] + +t["border" + n + "Width"].split("px")[0];
                    }
                    function p(t, e, i, n) {
                        return P(
                            e["offset" + t],
                            e["scroll" + t],
                            i["client" + t],
                            i["offset" + t],
                            i["scroll" + t],
                            V() ? i["offset" + t] + n["margin" + ("Height" === t ? "Top" : "Left")] + n["margin" + ("Height" === t ? "Bottom" : "Right")] : 0
                        );
                    }
                    function h() {
                        var t = window.document.body,
                            e = window.document.documentElement,
                            i = V() && window.getComputedStyle(e);
                        return { height: p("Height", t, e, i), width: p("Width", t, e, i) };
                    }
                    function f(t) {
                        return K({}, t, { right: t.left + t.width, bottom: t.top + t.height });
                    }
                    function u(t) {
                        var i = {};
                        if (V())
                            try {
                                i = t.getBoundingClientRect();
                                var n = l(t, "top"),
                                    o = l(t, "left");
                                (i.top += n), (i.left += o), (i.bottom += n), (i.right += o);
                            } catch (t) {}
                        else i = t.getBoundingClientRect();
                        var r = { left: i.left, top: i.top, width: i.right - i.left, height: i.bottom - i.top },
                            s = "HTML" === t.nodeName ? h() : {},
                            a = s.width || t.clientWidth || r.right - r.left,
                            d = s.height || t.clientHeight || r.bottom - r.top,
                            p = t.offsetWidth - a,
                            u = t.offsetHeight - d;
                        if (p || u) {
                            var m = e(t);
                            (p -= c(m, "x")), (u -= c(m, "y")), (r.width -= p), (r.height -= u);
                        }
                        return f(r);
                    }
                    function m(t, i) {
                        var n = V(),
                            r = "HTML" === i.nodeName,
                            s = u(t),
                            a = u(i),
                            l = o(t),
                            c = e(i),
                            p = +c.borderTopWidth.split("px")[0],
                            h = +c.borderLeftWidth.split("px")[0],
                            m = f({ top: s.top - a.top - p, left: s.left - a.left - h, width: s.width, height: s.height });
                        if (((m.marginTop = 0), (m.marginLeft = 0), !n && r)) {
                            var g = +c.marginTop.split("px")[0],
                                v = +c.marginLeft.split("px")[0];
                            (m.top -= p - g), (m.bottom -= p - g), (m.left -= h - v), (m.right -= h - v), (m.marginTop = g), (m.marginLeft = v);
                        }
                        return (n ? i.contains(l) : i === l && "BODY" !== l.nodeName) && (m = d(m, i)), m;
                    }
                    function g(t) {
                        var e = window.document.documentElement,
                            i = m(t, e),
                            n = P(e.clientWidth, window.innerWidth || 0),
                            o = P(e.clientHeight, window.innerHeight || 0),
                            r = l(e),
                            s = l(e, "left"),
                            a = { top: r - i.top + i.marginTop, left: s - i.left + i.marginLeft, width: n, height: o };
                        return f(a);
                    }
                    function v(t) {
                        var i = t.nodeName;
                        return "BODY" !== i && "HTML" !== i && ("fixed" === e(t, "position") || v(n(t)));
                    }
                    function b(t, e, i, r) {
                        var s = { top: 0, left: 0 },
                            l = a(t, e);
                        if ("viewport" === r) s = g(l);
                        else {
                            var d;
                            "scrollParent" === r ? "BODY" === (d = o(n(t))).nodeName && (d = window.document.documentElement) : (d = "window" === r ? window.document.documentElement : r);
                            var c = m(d, l);
                            if ("HTML" !== d.nodeName || v(l)) s = c;
                            else {
                                var p = h(),
                                    f = p.height,
                                    u = p.width;
                                (s.top += c.top - c.marginTop), (s.bottom = f + c.top), (s.left += c.left - c.marginLeft), (s.right = u + c.left);
                            }
                        }
                        return (s.left += i), (s.top += i), (s.right -= i), (s.bottom -= i), s;
                    }
                    function y(t, e, i, n, o) {
                        var r = 5 < arguments.length && void 0 !== arguments[5] ? arguments[5] : 0;
                        if (-1 === t.indexOf("auto")) return t;
                        var s = b(i, n, r, o),
                            a = {
                                top: { width: s.width, height: e.top - s.top },
                                right: { width: s.right - e.right, height: s.height },
                                bottom: { width: s.width, height: s.bottom - e.bottom },
                                left: { width: e.left - s.left, height: s.height },
                            },
                            l = Object.keys(a)
                                .map(function (t) {
                                    return K({ key: t }, a[t], {
                                        area: (function (t) {
                                            var e = t.width,
                                                i = t.height;
                                            return e * i;
                                        })(a[t]),
                                    });
                                })
                                .sort(function (t, e) {
                                    return e.area - t.area;
                                }),
                            d = l.filter(function (t) {
                                var e = t.width,
                                    n = t.height;
                                return e >= i.clientWidth && n >= i.clientHeight;
                            }),
                            c = 0 < d.length ? d[0].key : l[0].key,
                            p = t.split("-")[1];
                        return c + (p ? "-" + p : "");
                    }
                    function w(t, e, i) {
                        var n = a(e, i);
                        return m(i, n);
                    }
                    function T(t) {
                        var e = window.getComputedStyle(t),
                            i = parseFloat(e.marginTop) + parseFloat(e.marginBottom),
                            n = parseFloat(e.marginLeft) + parseFloat(e.marginRight),
                            o = { width: t.offsetWidth + n, height: t.offsetHeight + i };
                        return o;
                    }
                    function $(t) {
                        var e = { left: "right", right: "left", bottom: "top", top: "bottom" };
                        return t.replace(/left|right|bottom|top/g, function (t) {
                            return e[t];
                        });
                    }
                    function C(t, e, i) {
                        i = i.split("-")[0];
                        var n = T(t),
                            o = { width: n.width, height: n.height },
                            r = -1 !== ["right", "left"].indexOf(i),
                            s = r ? "top" : "left",
                            a = r ? "left" : "top",
                            l = r ? "height" : "width",
                            d = r ? "width" : "height";
                        return (o[s] = e[s] + e[l] / 2 - n[l] / 2), (o[a] = i === a ? e[a] - n[d] : e[$(a)]), o;
                    }
                    function k(t, e) {
                        return Array.prototype.find ? t.find(e) : t.filter(e)[0];
                    }
                    function x(e, i, n) {
                        var o =
                            void 0 === n
                                ? e
                                : e.slice(
                                      0,
                                      (function (t, e, i) {
                                          if (Array.prototype.findIndex)
                                              return t.findIndex(function (t) {
                                                  return t[e] === i;
                                              });
                                          var n = k(t, function (t) {
                                              return t[e] === i;
                                          });
                                          return t.indexOf(n);
                                      })(e, "name", n)
                                  );
                        return (
                            o.forEach(function (e) {
                                e["function"] && console.warn("`modifier.function` is deprecated, use `modifier.fn`!");
                                var n = e["function"] || e.fn;
                                e.enabled && t(n) && ((i.offsets.popper = f(i.offsets.popper)), (i.offsets.reference = f(i.offsets.reference)), (i = n(i, e)));
                            }),
                            i
                        );
                    }
                    function E(t, e) {
                        return t.some(function (t) {
                            var i = t.name,
                                n = t.enabled;
                            return n && i === e;
                        });
                    }
                    function O(t) {
                        for (var e = [!1, "ms", "Webkit", "Moz", "O"], i = t.charAt(0).toUpperCase() + t.slice(1), n = 0; n < e.length - 1; n++) {
                            var o = e[n],
                                r = o ? "" + o + i : t;
                            if ("undefined" != typeof window.document.body.style[r]) return r;
                        }
                        return null;
                    }
                    function S(t, e, i, n) {
                        (i.updateBound = n), window.addEventListener("resize", i.updateBound, { passive: !0 });
                        var r = o(t);
                        return (
                            (function s(t, e, i, n) {
                                var r = "BODY" === t.nodeName,
                                    a = r ? window : t;
                                a.addEventListener(e, i, { passive: !0 }), r || s(o(a.parentNode), e, i, n), n.push(a);
                            })(r, "scroll", i.updateBound, i.scrollParents),
                            (i.scrollElement = r),
                            (i.eventsEnabled = !0),
                            i
                        );
                    }
                    function _() {
                        var t;
                        this.state.eventsEnabled &&
                            (window.cancelAnimationFrame(this.scheduleUpdate),
                            (this.state =
                                (this.reference,
                                (t = this.state),
                                window.removeEventListener("resize", t.updateBound),
                                t.scrollParents.forEach(function (e) {
                                    e.removeEventListener("scroll", t.updateBound);
                                }),
                                (t.updateBound = null),
                                (t.scrollParents = []),
                                (t.scrollElement = null),
                                (t.eventsEnabled = !1),
                                t)));
                    }
                    function I(t) {
                        return "" !== t && !isNaN(parseFloat(t)) && isFinite(t);
                    }
                    function D(t, e) {
                        Object.keys(e).forEach(function (i) {
                            var n = "";
                            -1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(i) && I(e[i]) && (n = "px"), (t.style[i] = e[i] + n);
                        });
                    }
                    function N(t, e, i) {
                        var n = k(t, function (t) {
                                var i = t.name;
                                return i === e;
                            }),
                            o =
                                !!n &&
                                t.some(function (t) {
                                    return t.name === i && t.enabled && t.order < n.order;
                                });
                        if (!o) {
                            var r = "`" + e + "`";
                            console.warn("`" + i + "` modifier is required by " + r + " modifier in order to work, be sure to include it before " + r + "!");
                        }
                        return o;
                    }
                    function A(t) {
                        var e = 1 < arguments.length && void 0 !== arguments[1] && arguments[1],
                            i = J.indexOf(t),
                            n = J.slice(i + 1).concat(J.slice(0, i));
                        return e ? n.reverse() : n;
                    }
                    function R(t, e, i, n) {
                        var o = [0, 0],
                            r = -1 !== ["right", "left"].indexOf(n),
                            s = t.split(/(\+|\-)/).map(function (t) {
                                return t.trim();
                            }),
                            a = s.indexOf(
                                k(s, function (t) {
                                    return -1 !== t.search(/,|\s/);
                                })
                            );
                        s[a] && -1 === s[a].indexOf(",") && console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");
                        var l = /\s*,\s*|\s+/,
                            d = -1 === a ? [s] : [s.slice(0, a).concat([s[a].split(l)[0]]), [s[a].split(l)[1]].concat(s.slice(a + 1))];
                        return (
                            (d = d.map(function (t, n) {
                                var o = (1 === n ? !r : r) ? "height" : "width",
                                    s = !1;
                                return t
                                    .reduce(function (t, e) {
                                        return "" === t[t.length - 1] && -1 !== ["+", "-"].indexOf(e) ? ((t[t.length - 1] = e), (s = !0), t) : s ? ((t[t.length - 1] += e), (s = !1), t) : t.concat(e);
                                    }, [])
                                    .map(function (t) {
                                        return (function (t, e, i, n) {
                                            var o = t.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                                                r = +o[1],
                                                s = o[2];
                                            if (!r) return t;
                                            if (0 === s.indexOf("%")) {
                                                var a;
                                                switch (s) {
                                                    case "%p":
                                                        a = i;
                                                        break;
                                                    case "%":
                                                    case "%r":
                                                    default:
                                                        a = n;
                                                }
                                                var l = f(a);
                                                return (l[e] / 100) * r;
                                            }
                                            return "vh" === s || "vw" === s
                                                ? (("vh" === s ? P(document.documentElement.clientHeight, window.innerHeight || 0) : P(document.documentElement.clientWidth, window.innerWidth || 0)) / 100) * r
                                                : r;
                                        })(t, o, e, i);
                                    });
                            })).forEach(function (t, e) {
                                t.forEach(function (i, n) {
                                    I(i) && (o[e] += i * ("-" === t[n - 1] ? -1 : 1));
                                });
                            }),
                            o
                        );
                    }
                    for (var j = Math.min, L = Math.floor, P = Math.max, U = ["native code", "[object MutationObserverConstructor]"], W = "undefined" != typeof window, B = ["Edge", "Trident", "Firefox"], F = 0, H = 0; H < B.length; H += 1)
                        if (W && 0 <= navigator.userAgent.indexOf(B[H])) {
                            F = 1;
                            break;
                        }
                    var M,
                        Q =
                            W &&
                            (function (t) {
                                return U.some(function (e) {
                                    return -1 < (t || "").toString().indexOf(e);
                                });
                            })(window.MutationObserver)
                                ? function (t) {
                                      var e = !1,
                                          i = 0,
                                          n = document.createElement("span"),
                                          o = new MutationObserver(function () {
                                              t(), (e = !1);
                                          });
                                      return (
                                          o.observe(n, { attributes: !0 }),
                                          function () {
                                              e || ((e = !0), n.setAttribute("x-index", i), ++i);
                                          }
                                      );
                                  }
                                : function (t) {
                                      var e = !1;
                                      return function () {
                                          e ||
                                              ((e = !0),
                                              setTimeout(function () {
                                                  (e = !1), t();
                                              }, F));
                                      };
                                  },
                        V = function () {
                            return void 0 == M && (M = -1 !== navigator.appVersion.indexOf("MSIE 10")), M;
                        },
                        z = function (t, e) {
                            if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
                        },
                        q = (function () {
                            function t(t, e) {
                                for (var i, n = 0; n < e.length; n++) ((i = e[n]).enumerable = i.enumerable || !1), (i.configurable = !0), "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i);
                            }
                            return function (e, i, n) {
                                return i && t(e.prototype, i), n && t(e, n), e;
                            };
                        })(),
                        Y = function (t, e, i) {
                            return e in t ? Object.defineProperty(t, e, { value: i, enumerable: !0, configurable: !0, writable: !0 }) : (t[e] = i), t;
                        },
                        K =
                            Object.assign ||
                            function (t) {
                                for (var e, i = 1; i < arguments.length; i++) for (var n in (e = arguments[i])) Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
                                return t;
                            },
                        G = ["auto-start", "auto", "auto-end", "top-start", "top", "top-end", "right-start", "right", "right-end", "bottom-end", "bottom", "bottom-start", "left-end", "left", "left-start"],
                        J = G.slice(3),
                        X = { FLIP: "flip", CLOCKWISE: "clockwise", COUNTERCLOCKWISE: "counterclockwise" },
                        Z = (function () {
                            function e(i, n) {
                                var o = this,
                                    r = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : {};
                                z(this, e),
                                    (this.scheduleUpdate = function () {
                                        return requestAnimationFrame(o.update);
                                    }),
                                    (this.update = Q(this.update.bind(this))),
                                    (this.options = K({}, e.Defaults, r)),
                                    (this.state = { isDestroyed: !1, isCreated: !1, scrollParents: [] }),
                                    (this.reference = i.jquery ? i[0] : i),
                                    (this.popper = n.jquery ? n[0] : n),
                                    (this.options.modifiers = {}),
                                    Object.keys(K({}, e.Defaults.modifiers, r.modifiers)).forEach(function (t) {
                                        o.options.modifiers[t] = K({}, e.Defaults.modifiers[t] || {}, r.modifiers ? r.modifiers[t] : {});
                                    }),
                                    (this.modifiers = Object.keys(this.options.modifiers)
                                        .map(function (t) {
                                            return K({ name: t }, o.options.modifiers[t]);
                                        })
                                        .sort(function (t, e) {
                                            return t.order - e.order;
                                        })),
                                    this.modifiers.forEach(function (e) {
                                        e.enabled && t(e.onLoad) && e.onLoad(o.reference, o.popper, o.options, e, o.state);
                                    }),
                                    this.update();
                                var s = this.options.eventsEnabled;
                                s && this.enableEventListeners(), (this.state.eventsEnabled = s);
                            }
                            return (
                                q(e, [
                                    {
                                        key: "update",
                                        value: function () {
                                            return function () {
                                                if (!this.state.isDestroyed) {
                                                    var t = { instance: this, styles: {}, arrowStyles: {}, attributes: {}, flipped: !1, offsets: {} };
                                                    (t.offsets.reference = w(this.state, this.popper, this.reference)),
                                                        (t.placement = y(this.options.placement, t.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding)),
                                                        (t.originalPlacement = t.placement),
                                                        (t.offsets.popper = C(this.popper, t.offsets.reference, t.placement)),
                                                        (t.offsets.popper.position = "absolute"),
                                                        (t = x(this.modifiers, t)),
                                                        this.state.isCreated ? this.options.onUpdate(t) : ((this.state.isCreated = !0), this.options.onCreate(t));
                                                }
                                            }.call(this);
                                        },
                                    },
                                    {
                                        key: "destroy",
                                        value: function () {
                                            return function () {
                                                return (
                                                    (this.state.isDestroyed = !0),
                                                    E(this.modifiers, "applyStyle") &&
                                                        (this.popper.removeAttribute("x-placement"), (this.popper.style.left = ""), (this.popper.style.position = ""), (this.popper.style.top = ""), (this.popper.style[O("transform")] = "")),
                                                    this.disableEventListeners(),
                                                    this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper),
                                                    this
                                                );
                                            }.call(this);
                                        },
                                    },
                                    {
                                        key: "enableEventListeners",
                                        value: function () {
                                            return function () {
                                                this.state.eventsEnabled || (this.state = S(this.reference, this.options, this.state, this.scheduleUpdate));
                                            }.call(this);
                                        },
                                    },
                                    {
                                        key: "disableEventListeners",
                                        value: function () {
                                            return _.call(this);
                                        },
                                    },
                                ]),
                                e
                            );
                        })();
                    return (
                        (Z.Utils = ("undefined" == typeof window ? i.g : window).PopperUtils),
                        (Z.placements = G),
                        (Z.Defaults = {
                            placement: "bottom",
                            eventsEnabled: !0,
                            removeOnDestroy: !1,
                            onCreate: function () {},
                            onUpdate: function () {},
                            modifiers: {
                                shift: {
                                    order: 100,
                                    enabled: !0,
                                    fn: function (t) {
                                        var e = t.placement,
                                            i = e.split("-")[0],
                                            n = e.split("-")[1];
                                        if (n) {
                                            var o = t.offsets,
                                                r = o.reference,
                                                s = o.popper,
                                                a = -1 !== ["bottom", "top"].indexOf(i),
                                                l = a ? "left" : "top",
                                                d = a ? "width" : "height",
                                                c = { start: Y({}, l, r[l]), end: Y({}, l, r[l] + r[d] - s[d]) };
                                            t.offsets.popper = K({}, s, c[n]);
                                        }
                                        return t;
                                    },
                                },
                                offset: {
                                    order: 200,
                                    enabled: !0,
                                    fn: function (t, e) {
                                        var i,
                                            n = e.offset,
                                            o = t.placement,
                                            r = t.offsets,
                                            s = r.popper,
                                            a = r.reference,
                                            l = o.split("-")[0];
                                        return (
                                            (i = I(+n) ? [+n, 0] : R(n, s, a, l)),
                                            "left" === l
                                                ? ((s.top += i[0]), (s.left -= i[1]))
                                                : "right" === l
                                                ? ((s.top += i[0]), (s.left += i[1]))
                                                : "top" === l
                                                ? ((s.left += i[0]), (s.top -= i[1]))
                                                : "bottom" === l && ((s.left += i[0]), (s.top += i[1])),
                                            (t.popper = s),
                                            t
                                        );
                                    },
                                    offset: 0,
                                },
                                preventOverflow: {
                                    order: 300,
                                    enabled: !0,
                                    fn: function (t, e) {
                                        var i = e.boundariesElement || r(t.instance.popper);
                                        t.instance.reference === i && (i = r(i));
                                        var n = b(t.instance.popper, t.instance.reference, e.padding, i);
                                        e.boundaries = n;
                                        var o = e.priority,
                                            s = t.offsets.popper,
                                            a = {
                                                primary: function (t) {
                                                    var i = s[t];
                                                    return s[t] < n[t] && !e.escapeWithReference && (i = P(s[t], n[t])), Y({}, t, i);
                                                },
                                                secondary: function (t) {
                                                    var i = "right" === t ? "left" : "top",
                                                        o = s[i];
                                                    return s[t] > n[t] && !e.escapeWithReference && (o = j(s[i], n[t] - ("right" === t ? s.width : s.height))), Y({}, i, o);
                                                },
                                            };
                                        return (
                                            o.forEach(function (t) {
                                                var e = -1 === ["left", "top"].indexOf(t) ? "secondary" : "primary";
                                                s = K({}, s, a[e](t));
                                            }),
                                            (t.offsets.popper = s),
                                            t
                                        );
                                    },
                                    priority: ["left", "right", "top", "bottom"],
                                    padding: 5,
                                    boundariesElement: "scrollParent",
                                },
                                keepTogether: {
                                    order: 400,
                                    enabled: !0,
                                    fn: function (t) {
                                        var e = t.offsets,
                                            i = e.popper,
                                            n = e.reference,
                                            o = t.placement.split("-")[0],
                                            r = L,
                                            s = -1 !== ["top", "bottom"].indexOf(o),
                                            a = s ? "right" : "bottom",
                                            l = s ? "left" : "top",
                                            d = s ? "width" : "height";
                                        return i[a] < r(n[l]) && (t.offsets.popper[l] = r(n[l]) - i[d]), i[l] > r(n[a]) && (t.offsets.popper[l] = r(n[a])), t;
                                    },
                                },
                                arrow: {
                                    order: 500,
                                    enabled: !0,
                                    fn: function (t, i) {
                                        if (!N(t.instance.modifiers, "arrow", "keepTogether")) return t;
                                        var n = i.element;
                                        if ("string" == typeof n) {
                                            if (!(n = t.instance.popper.querySelector(n))) return t;
                                        } else if (!t.instance.popper.contains(n)) return console.warn("WARNING: `arrow.element` must be child of its popper element!"), t;
                                        var o = t.placement.split("-")[0],
                                            r = t.offsets,
                                            s = r.popper,
                                            a = r.reference,
                                            l = -1 !== ["left", "right"].indexOf(o),
                                            d = l ? "height" : "width",
                                            c = l ? "Top" : "Left",
                                            p = c.toLowerCase(),
                                            h = l ? "left" : "top",
                                            u = l ? "bottom" : "right",
                                            m = T(n)[d];
                                        a[u] - m < s[p] && (t.offsets.popper[p] -= s[p] - (a[u] - m)), a[p] + m > s[u] && (t.offsets.popper[p] += a[p] + m - s[u]);
                                        var g = a[p] + a[d] / 2 - m / 2,
                                            v = e(t.instance.popper, "margin" + c).replace("px", ""),
                                            b = g - f(t.offsets.popper)[p] - v;
                                        return (b = P(j(s[d] - m, b), 0)), (t.arrowElement = n), (t.offsets.arrow = {}), (t.offsets.arrow[p] = Math.round(b)), (t.offsets.arrow[h] = ""), t;
                                    },
                                    element: "[x-arrow]",
                                },
                                flip: {
                                    order: 600,
                                    enabled: !0,
                                    fn: function (t, e) {
                                        if (E(t.instance.modifiers, "inner")) return t;
                                        if (t.flipped && t.placement === t.originalPlacement) return t;
                                        var i = b(t.instance.popper, t.instance.reference, e.padding, e.boundariesElement),
                                            n = t.placement.split("-")[0],
                                            o = $(n),
                                            r = t.placement.split("-")[1] || "",
                                            s = [];
                                        switch (e.behavior) {
                                            case X.FLIP:
                                                s = [n, o];
                                                break;
                                            case X.CLOCKWISE:
                                                s = A(n);
                                                break;
                                            case X.COUNTERCLOCKWISE:
                                                s = A(n, !0);
                                                break;
                                            default:
                                                s = e.behavior;
                                        }
                                        return (
                                            s.forEach(function (a, l) {
                                                if (n !== a || s.length === l + 1) return t;
                                                (n = t.placement.split("-")[0]), (o = $(n));
                                                var d = t.offsets.popper,
                                                    c = t.offsets.reference,
                                                    p = L,
                                                    h = ("left" === n && p(d.right) > p(c.left)) || ("right" === n && p(d.left) < p(c.right)) || ("top" === n && p(d.bottom) > p(c.top)) || ("bottom" === n && p(d.top) < p(c.bottom)),
                                                    f = p(d.left) < p(i.left),
                                                    u = p(d.right) > p(i.right),
                                                    m = p(d.top) < p(i.top),
                                                    g = p(d.bottom) > p(i.bottom),
                                                    v = ("left" === n && f) || ("right" === n && u) || ("top" === n && m) || ("bottom" === n && g),
                                                    b = -1 !== ["top", "bottom"].indexOf(n),
                                                    y = !!e.flipVariations && ((b && "start" === r && f) || (b && "end" === r && u) || (!b && "start" === r && m) || (!b && "end" === r && g));
                                                (h || v || y) &&
                                                    ((t.flipped = !0),
                                                    (h || v) && (n = s[l + 1]),
                                                    y &&
                                                        (r = (function (t) {
                                                            return "end" === t ? "start" : "start" === t ? "end" : t;
                                                        })(r)),
                                                    (t.placement = n + (r ? "-" + r : "")),
                                                    (t.offsets.popper = K({}, t.offsets.popper, C(t.instance.popper, t.offsets.reference, t.placement))),
                                                    (t = x(t.instance.modifiers, t, "flip")));
                                            }),
                                            t
                                        );
                                    },
                                    behavior: "flip",
                                    padding: 5,
                                    boundariesElement: "viewport",
                                },
                                inner: {
                                    order: 700,
                                    enabled: !1,
                                    fn: function (t) {
                                        var e = t.placement,
                                            i = e.split("-")[0],
                                            n = t.offsets,
                                            o = n.popper,
                                            r = n.reference,
                                            s = -1 !== ["left", "right"].indexOf(i),
                                            a = -1 === ["top", "left"].indexOf(i);
                                        return (o[s ? "left" : "top"] = r[i] - (a ? o[s ? "width" : "height"] : 0)), (t.placement = $(e)), (t.offsets.popper = f(o)), t;
                                    },
                                },
                                hide: {
                                    order: 800,
                                    enabled: !0,
                                    fn: function (t) {
                                        if (!N(t.instance.modifiers, "hide", "preventOverflow")) return t;
                                        var e = t.offsets.reference,
                                            i = k(t.instance.modifiers, function (t) {
                                                return "preventOverflow" === t.name;
                                            }).boundaries;
                                        if (e.bottom < i.top || e.left > i.right || e.top > i.bottom || e.right < i.left) {
                                            if (!0 === t.hide) return t;
                                            (t.hide = !0), (t.attributes["x-out-of-boundaries"] = "");
                                        } else {
                                            if (!1 === t.hide) return t;
                                            (t.hide = !1), (t.attributes["x-out-of-boundaries"] = !1);
                                        }
                                        return t;
                                    },
                                },
                                computeStyle: {
                                    order: 850,
                                    enabled: !0,
                                    fn: function (t, e) {
                                        var i = e.x,
                                            n = e.y,
                                            o = t.offsets.popper,
                                            s = k(t.instance.modifiers, function (t) {
                                                return "applyStyle" === t.name;
                                            }).gpuAcceleration;
                                        void 0 !== s && console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");
                                        var a,
                                            l,
                                            d = void 0 === s ? e.gpuAcceleration : s,
                                            c = r(t.instance.popper),
                                            p = u(c),
                                            h = { position: o.position },
                                            f = { left: L(o.left), top: L(o.top), bottom: L(o.bottom), right: L(o.right) },
                                            m = "bottom" === i ? "top" : "bottom",
                                            g = "right" === n ? "left" : "right",
                                            v = O("transform");
                                        if (((l = "bottom" == m ? -p.height + f.bottom : f.top), (a = "right" == g ? -p.width + f.right : f.left), d && v))
                                            (h[v] = "translate3d(" + a + "px, " + l + "px, 0)"), (h[m] = 0), (h[g] = 0), (h.willChange = "transform");
                                        else {
                                            var b = "bottom" == m ? -1 : 1,
                                                y = "right" == g ? -1 : 1;
                                            (h[m] = l * b), (h[g] = a * y), (h.willChange = m + ", " + g);
                                        }
                                        var w = { "x-placement": t.placement };
                                        return (t.attributes = K({}, w, t.attributes)), (t.styles = K({}, h, t.styles)), (t.arrowStyles = K({}, t.offsets.arrow, t.arrowStyles)), t;
                                    },
                                    gpuAcceleration: !0,
                                    x: "bottom",
                                    y: "right",
                                },
                                applyStyle: {
                                    order: 900,
                                    enabled: !0,
                                    fn: function (t) {
                                        return (
                                            D(t.instance.popper, t.styles),
                                            (function (t, e) {
                                                Object.keys(e).forEach(function (i) {
                                                    var n = e[i];
                                                    !1 === n ? t.removeAttribute(i) : t.setAttribute(i, e[i]);
                                                });
                                            })(t.instance.popper, t.attributes),
                                            t.arrowElement && Object.keys(t.arrowStyles).length && D(t.arrowElement, t.arrowStyles),
                                            t
                                        );
                                    },
                                    onLoad: function (t, e, i, n, o) {
                                        var r = w(0, e, t),
                                            s = y(i.placement, r, e, t, i.modifiers.flip.boundariesElement, i.modifiers.flip.padding);
                                        return e.setAttribute("x-placement", s), D(e, { position: "absolute" }), i;
                                    },
                                    gpuAcceleration: void 0,
                                },
                            },
                        }),
                        Z
                    );
                })();
            },
        },
        e = {};
    function i(n) {
        if (e[n]) return e[n].exports;
        var o = (e[n] = { exports: {} });
        return t[n].call(o.exports, o, o.exports, i), o.exports;
    }
    (i.n = (t) => {
        var e = t && t.__esModule ? () => t["default"] : () => t;
        return i.d(e, { a: e }), e;
    }),
        (i.d = (t, e) => {
            for (var n in e) i.o(e, n) && !i.o(t, n) && Object.defineProperty(t, n, { enumerable: !0, get: e[n] });
        }),
        (i.g = (function () {
            if ("object" == typeof globalThis) return globalThis;
            try {
                return this || new Function("return this")();
            } catch (t) {
                if ("object" == typeof window) return window;
            }
        })()),
        (i.o = (t, e) => Object.prototype.hasOwnProperty.call(t, e)),
        (() => {
            "use strict";
            i(674), i(276), i(631);
        })();
})();
