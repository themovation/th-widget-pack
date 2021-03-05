(function (t) {
    "use strict";
    t(function () {
        var e;
        function i(e, i, n) {
            t(document).on(e, i, n);
        }
        (e = t(".elementskit-menu-container")),
            t(e).each(function () {
                var e = t(this);
                "yes" != e.attr("ekit-dom-added") && (0 === e.parents(".elementor-widget-ekit-nav-menu").length && e.parents(".ekit-wid-con").addClass("ekit_menu_responsive_tablet"), e.attr("ekit-dom-added", "yes"));
            }),
            i("click", ".elementskit-dropdown-has > a", function (e) {
                if (!t(this).parents(".elementskit-navbar-nav, .ekit-vertical-navbar-nav").hasClass("submenu-click-on-icon") || t(e.target).hasClass("elementskit-submenu-indicator")) {
                    e.preventDefault();
                    var i = t(this).parent().find(">.elementskit-dropdown, >.elementskit-megamenu-panel");
                    i.find(".elementskit-dropdown-open").removeClass("elementskit-dropdown-open"),
                        i.hasClass("elementskit-dropdown-open") ? i.removeClass("elementskit-dropdown-open") : i.addClass("elementskit-dropdown-open");
                }
            }),
            i("click", ".elementskit-menu-toggler", function (e) {
                e.preventDefault();
                var i = t(this).parents(".elementskit-menu-container").parent();
                i.length < 1 && (i = t(this).parent());
                var n = i.find(".elementskit-menu-offcanvas-elements");
                n.hasClass("active") ? n.removeClass("active") : n.addClass("active");
            }),
            i("click", ".elementskit-navbar-nav li a", function (e) {
                if (t(this).attr("href") && "elementskit-submenu-indicator" !== e.target.className) {
                    var i = t(this),
                        n = i.get(0),
                        o = n.href,
                        r = o.indexOf("#"),
                        s = i.parents(".elementskit-menu-container").hasClass("ekit-nav-menu-one-page-yes");
                    -1 !== r && o.length > 1 && s && n.pathname == window.location.pathname && (e.preventDefault(), i.parents(".ekit-wid-con").find(".elementskit-menu-close").trigger("click"));
                }
            });
    });
})(jQuery);