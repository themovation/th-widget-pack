(function (t) {
    "use strict";
    t(function () {
        var e;
        function i(e, i, n) {
            t(document).on(e, i, n);
        }
        (e = t(".thwidgetpack-menu-container")),
            t(e).each(function () {
                var e = t(this);
                "yes" != e.attr("ekit-dom-added") && (0 === e.parents(".elementor-widget-ekit-nav-menu").length && e.parents(".ekit-wid-con").addClass("ekit_menu_responsive_tablet"), e.attr("ekit-dom-added", "yes"));
            }),
            i("click", ".thwidgetpack-dropdown-has > a", function (e) {
                if (!t(this).parents(".thwidgetpack-navbar-nav, .ekit-vertical-navbar-nav").hasClass("submenu-click-on-icon") || t(e.target).hasClass("thwidgetpack-submenu-indicator")) {
                    e.preventDefault();
                    var i = t(this).parent().find(">.thwidgetpack-dropdown, >.thwidgetpack-megamenu-panel");
                    i.find(".thwidgetpack-dropdown-open").removeClass("thwidgetpack-dropdown-open"),
                        i.hasClass("thwidgetpack-dropdown-open") ? i.removeClass("thwidgetpack-dropdown-open") : i.addClass("thwidgetpack-dropdown-open");
                }
            }),
            i("click", ".thwidgetpack-menu-toggler", function (e) {
                e.preventDefault();
                var i = t(this).parents(".thwidgetpack-menu-container").parent();
                i.length < 1 && (i = t(this).parent());
                var n = i.find(".thwidgetpack-menu-offcanvas-elements");
                n.hasClass("active") ? n.removeClass("active") : n.addClass("active");
            }),
            i("click", ".thwidgetpack-navbar-nav li a", function (e) {
                if (t(this).attr("href") && "thwidgetpack-submenu-indicator" !== e.target.className) {
                    var i = t(this),
                        n = i.get(0),
                        o = n.href,
                        r = o.indexOf("#"),
                        s = i.parents(".thwidgetpack-menu-container").hasClass("ekit-nav-menu-one-page-yes");
                    -1 !== r && o.length > 1 && s && n.pathname == window.location.pathname && (e.preventDefault(), i.parents(".ekit-wid-con").find(".thwidgetpack-menu-close").trigger("click"));
                }
            });
    });
})(jQuery);