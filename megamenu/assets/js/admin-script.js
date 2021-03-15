jQuery(document).ready(function (e) {
    "use strict";
    e(".thwidgetpack-menu-wpcolor-picker").wpColorPicker();
    var t = e(".thwidgetpack-menu-icon-picker").fontIconPicker(),
        n = window.thwidgetpack_megamenu_nonce;
    e(".thwidgetpack-menu-item-save").on("click", function () {
        var t = e(this).parent().find(".spinner"),
            i = {
                settings: {
                    menu_id: e("#thwidgetpack-menu-modal-menu-id").val(),
                    menu_has_child: e("#thwidgetpack-menu-modal-menu-has-child").val(),
                    menu_enable: e("#thwidgetpack-menu-item-enable:checked").val(),
                    menu_icon: e("#thwidgetpack-menu-icon-field").val(),
                    menu_icon_color: e("#thwidgetpack-menu-icon-color-field").val(),
                    menu_badge_text: e("#thwidgetpack-menu-badge-text-field").val(),
                    menu_badge_color: e("#thwidgetpack-menu-badge-color-field").val(),
                    menu_badge_background: e("#thwidgetpack-menu-badge-background-field").val(),
                    vertical_menu_width: e("#thwidgetpack-menu-vertical-menu-width-field").val(),
                    mobile_submenu_content_type: e("#mobile_submenu_content_type input[name=content_type]:checked").val(),
                    vertical_megamenu_position_type: e("#vertical_megamenu_position_type input[name=position_type]:checked").val(),
                    megamenu_width_type: e("#xs_megamenu_width_type input[name=width_type]:checked").val(),
                },
                nocache: Math.floor(Date.now() / 1e3),
            };
        t.addClass("loading"),
            e.ajax({
                url: window.thwidgetpack.resturl+"megamenu/save_menuitem_settings",
                type: "get",
                data: i,
                headers: { "X-WP-Nonce": n },
                dataType: "json",
                success: function (n) {
                    t.removeClass("loading"), e("#thwidgetpack-menu-item-settings-modal").modal("hide");
                },
            });
    }),
        e("#thwidgetpack-menu-builder-trigger").on("click", function () {
            var t = e("#thwidgetpack-menu-modal-menu-id").val(),
                n = window.thwidgetpack.resturl+"dynamic-content/content_editor/megamenu/menuitem" + t;
            e("#thwidgetpack-menu-builder-iframe").attr("src", n);
        }),
        e("body").on("DOMSubtreeModified", "#menu-to-edit", function () {
            setTimeout(function () {
                e("#menu-to-edit li.menu-item").each(function () {
                    var t = e(this);
                    t.find(".thwidgetpack_menu_trigger").length < 1 && e(".item-title", t).append("<a data-attr-toggle='modal' data-target='#attr_menu_control_panel_modal' href='#' class='thwidgetpack_menu_trigger'>Mega Menu</a> ");
                });
            }, 200);
        }),
        e("#menu-to-edit").trigger("DOMSubtreeModified"),
        e("#menu-to-edit").on("click", ".thwidgetpack_menu_trigger", function (i) {
            i.preventDefault();
            var a = e("#attr_menu_control_panel_modal"),
                m = e(this).parents("li.menu-item"),
                l = parseInt(m.attr("id").match(/[0-9]+/)[0], 10);
            m.find(".menu-item-title").text(), m.attr("class").match(/\menu-item-depth-(\d+)\b/)[1];
            if ((e(".ekit_menu_control_nav > li").removeClass("attr-active"), e(".attr-tab-pane").removeClass("attr-active"), e(this).parents(".menu-item").hasClass("menu-item-depth-0"))) {
                var o = 0;
                a.removeClass("thwidgetpack-menu-has-child"), e("#attr_content_nav").addClass("attr-active"), e("#attr_content_tab").addClass("attr-active");
            } else {
                o = 1;
                a.addClass("thwidgetpack-menu-has-child"), e("#attr_icon_nav").addClass("attr-active"), e("#attr_icon_tab").addClass("attr-active");
            }
            e("#thwidgetpack-menu-modal-menu-id").val(l), e("#thwidgetpack-menu-modal-menu-has-child").val(o);
            var u = { menu_id: l, nocache: Math.floor(Date.now() / 1e3) };
            e.ajax({
                url: window.thwidgetpack.resturl+"megamenu/get_menuitem_settings",
                type: "get",
                data: u,
                headers: { "X-WP-Nonce": n },
                dataType: "json",
                success: function (n) {
                    e("#thwidgetpack-menu-item-enable").prop("checked", !1),
                        e("#thwidgetpack-menu-icon-color-field").wpColorPicker("color", n.menu_icon_color),
                        e("#thwidgetpack-menu-icon-field").val(n.menu_icon),
                        e("#thwidgetpack-menu-badge-text-field").val(n.menu_badge_text),
                        e("#thwidgetpack-menu-badge-color-field").wpColorPicker("color", n.menu_badge_color),
                        e("#thwidgetpack-menu-badge-background-field").wpColorPicker("color", n.menu_badge_background),
                        e("#thwidgetpack-menu-vertical-menu-width-field").val(n.vertical_menu_width),
                        "undefined" != typeof n.menu_enable && 1 == n.menu_enable ? e("#thwidgetpack-menu-item-enable").prop("checked", !0) : e("#thwidgetpack-menu-item-enable").prop("checked", !1),
                        e("#mobile_submenu_content_type input").prop("checked", !1),
                        "undefined" == typeof n.mobile_submenu_content_type || "builder_content" == n.mobile_submenu_content_type
                            ? e("#mobile_submenu_content_type input[value=builder_content]").prop("checked", !0)
                            : e("#mobile_submenu_content_type input[value=submenu_list]").prop("checked", !0),
                        e("#vertical_megamenu_position_type input").prop("checked", !1),
                        "undefined" == typeof n.vertical_megamenu_position_type || "relative_position" == n.vertical_megamenu_position_type
                            ? e("#vertical_megamenu_position_type input[value=relative_position]").prop("checked", !0)
                            : e("#vertical_megamenu_position_type input[value=top_position]").prop("checked", !0),
                        e("#xs_megamenu_width_type input").removeAttr("checked"),
                        "undefined" == typeof n.megamenu_width_type || "default_width" == n.megamenu_width_type
                            ? (e("#xs_megamenu_width_type input[value=default_width]").attr("checked", "checked"), e("#xs_megamenu_width_type input[value=default_width]").prop("checked", !0))
                            : "undefined" == typeof n.megamenu_width_type || "full_width" == n.megamenu_width_type
                            ? (e("#xs_megamenu_width_type input[value=full_width]").prop("checked", !0), e("#xs_megamenu_width_type input[value=full_width]").attr("checked", "checked"))
                            : (e("#xs_megamenu_width_type input[value=custom_width]").prop("checked", !0), e("#xs_megamenu_width_type input[value=custom_width]").attr("checked", "checked")),
                        e("#attr_vertical_menu_setting_tab")
                            .on("change", 'input[type="radio"]', function () {
                                e("#width_type_custom").is(":checked") ? e(".menu-width-container").addClass("is_enabled") : e(".menu-width-container").removeClass("is_enabled");
                            })
                            .trigger("change"),
                        e("#width_type_custom").is(":checked") ? e(".menu-width-container").addClass("is_enabled") : e(".menu-width-container").removeClass("is_enabled"),
                        e("#thwidgetpack-menu-item-enable").trigger("change"),
                        t.refreshPicker(),
                        setTimeout(function () {
                            a.removeClass("thwidgetpack-menu-modal-loading");
                        }, 500);
                },
            });
        }),
        e("#thwidgetpack-menu-item-enable").on("change", function () {
            e(this).is(":checked")
                ? (e("#thwidgetpack-menu-builder-trigger").prop("disabled", !1), e("#thwidgetpack-menu-builder-warper").addClass("is_enabled"))
                : (e("#thwidgetpack-menu-item-enable").prop("checked", !1), e("#thwidgetpack-menu-builder-warper").removeClass("is_enabled"), e("#thwidgetpack-menu-builder-trigger").prop("disabled", !0));
        }),
        e("#post-body-content").on("change.ekit", "#thwidgetpack-menu-metabox-input-is-enabled", function () {
            e(this).is(":checked") ? e("body").addClass("is_mega_enabled").removeClass("is_mega_disabled") : e("body").removeClass("is_mega_enabled").addClass("is_mega_disabled");
        }),
        e("#post-body-content").prepend(window.thwidgetpack_options_megamenu_markup).find("#thwidgetpack-menu-metabox-input-is-enabled").trigger("change.ekit");
    var i = e("#thwidgetpack-menu-builder-modal"),
        a = document.getElementById("thwidgetpack-menu-builder-iframe"),
        m = a.contentWindow || a.contentDocument;
    i.on("hide.bs.attr-modal", function (e) {
        m.jQuery("#elementor-panel-saver-button-publish").hasClass("elementor-disabled") || confirm("Changes you made may not be saved.") || e.preventDefault(), m.jQuery(m).off("beforeunload");
    });
});
