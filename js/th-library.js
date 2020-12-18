!(function (e, t) {
    window.thmv = window.thmv || {};

    thmv.translate = function (e, t) {
        return elementorCommon.translate(e, null, t, ThBlockEditor.i18n);
    }

    var i = {
        LibraryViews: {},
        LibraryModels: {},
        LibraryCollections: {},
        LibraryBehaviors: {},
        LibraryLayout: null,
        LibraryManager: null
    };
    (i.LibraryModels.Template = Backbone.Model.extend({
        defaults: {
            template_id: 0,
            title: "",
            type: "",
            thumbnail: "",
            url: "",
            category: []
        }
    })),
    (i.LibraryCollections.Template = Backbone.Collection.extend({
        model: i.LibraryModels.Template
    })),
    (i.LibraryBehaviors.InsertTemplate = Marionette.Behavior.extend({
        ui: {
            insertButton: ".thmv-templateLibrary-insert-button"
        },
        events: {
            "click @ui.insertButton": "onInsertButtonClick"
        },
        onInsertButtonClick: function () {
            thmv.library.insertTemplate({
                model: this.view.model
            });
        },
    })),
    (i.LibraryViews.Loading = Marionette.ItemView.extend({
        template: "#template-thmv-templateLibrary-loading",
        id: "thmv-templateLibrary-loading"
    })),
    (i.LibraryViews.Logo = Marionette.ItemView.extend({
        template: "#template-thmv-templateLibrary-header-logo",
        className: "thmv-templateLibrary-header-logo",
        templateHelpers: function () {
            return {
                title: this.getOption("title")
            };
        },
    })),
    (i.LibraryViews.BackButton = Marionette.ItemView.extend({
        template: "#template-thmv-templateLibrary-header-back",
        id: "elementor-template-library-header-preview-back",
        className: "thmv-templateLibrary-header-back",
        events: function () {
            return {
                click: "onClick"
            };
        },
        onClick: function () {
            thmv.library.showTemplatesView();
        },
    })),
    (i.LibraryViews.Menu = Marionette.ItemView.extend({
        template: "#template-thmv-TemplateLibrary_header-menu",
        id: "elementor-template-library-header-menu",
        className: "thmv-TemplateLibrary_header-menu",
        templateHelpers: function () {
            return thmv.library.getTabs();
        },
        ui: { menuItem: ".elementor-template-library-menu-item" },
        events: { "click @ui.menuItem": "onMenuItemClick" },
        onMenuItemClick: function (e) {
            thmv.library.setFilter("category", ""), 
            thmv.library.setFilter("text", ""), 
            thmv.library.setFilter("type", e.currentTarget.dataset.tab, !0), 
            thmv.library.showTemplatesView();
        },
    })),
    (i.LibraryViews.EmptyTemplateCollection = Marionette.ItemView.extend({
        id: "elementor-template-library-templates-empty",
        template: "#template-thmv-templateLibrary-empty",
        ui: {
            title: ".elementor-template-library-blank-title",
            message: ".elementor-template-library-blank-message"
        },
        modesStrings: {
            empty: {
                title: thmv.translate("templatesEmptyTitle"),
                message: thmv.translate("templatesEmptyMessage")
            },
            noResults: {
                title: thmv.translate("templatesNoResultsTitle"),
                message: thmv.translate("templatesNoResultsMessage")
            },
        },
        getCurrentMode: function () {
            return thmv.library.getFilter("text") ? "noResults" : "empty";
        },
        onRender: function () {
            var e = this.modesStrings[this.getCurrentMode()];
            this.ui.title.html(e.title), this.ui.message.html(e.message);
        },
    })),
    (i.LibraryViews.Actions = Marionette.ItemView.extend({
        template: "#template-thmv-templateLibrary-header-actions",
        id: "elementor-template-library-header-actions",
        ui: {
            sync: "#thmv-templateLibrary-header-sync i"
        },
        events: {
            "click @ui.sync": "onSyncClick"
        },
        onSyncClick: function () {
            var e = this;
            e.ui.sync.addClass("eicon-animation-spin"),
                thmv.library.requestLibraryData({
                    onUpdate: function () {
                        e.ui.sync.removeClass("eicon-animation-spin"), thmv.library.updateBlocksView();
                    },
                    forceUpdate: !0,
                    forceSync: !0,
                });
        },
    })),
    (i.LibraryViews.InsertWrapper = Marionette.ItemView.extend({
        template: "#template-thmv-templateLibrary-header-insert",
        id: "elementor-template-library-header-preview",
        behaviors: {
            insertTemplate: {
                behaviorClass: i.LibraryBehaviors.InsertTemplate
            }
        },
    })),
    (i.LibraryViews.Preview = Marionette.ItemView.extend({
        template: "#template-thmv-templateLibrary-preview",
        className: "thmv-templateLibrary-preview",
        ui: function () {
            return {
                iframe: "> iframe"
            };
        },
        onRender: function () {
            this.ui.iframe.attr("src", this.getOption("url")).hide();
            var e = this,
                t = new i.LibraryViews.Loading().render();
            this.$el.append(t.el),
                this.ui.iframe.on("load", function () {
                    e.$el.find("#thmv-templateLibrary-loading").remove(), e.ui.iframe.show();
                });
        },
    })),
    (i.LibraryViews.TemplateCollection = Marionette.CompositeView.extend({
        template: "#template-thmv-templateLibrary-templates",
        id: "thmv-templateLibrary-templates",
        className: function () {
            return "thmv-templateLibrary-templates thmv-templateLibrary-templates--" + thmv.library.getFilter("type");
        },
        childViewContainer: "#thmv-templateLibrary-templates-list",
        emptyView: function () {
            return new i.LibraryViews.EmptyTemplateCollection();
        },
        ui: {
            templatesWindow: ".thmv-templateLibrary-templates-window",
            textFilter: "#thmv-templateLibrary-search",
            categoryFilter: ".thmv-templateLibrary-category-filter-item",
            filterBar: "#thmv-templateLibrary-toolbar-filter"
        },
        events: {
            "input @ui.textFilter": "onTextFilterInput",
            "click @ui.categoryFilter": "onCategoryFilterClick"
        },
        getChildView: function (e) {
            return i.LibraryViews.Template;
        },
        initialize: function () {
            this.listenTo(thmv.library.channels.templates, "filter:change", this._renderChildren);
        },
        filter: function (e) {
            var t = thmv.library.getFilterTerms(),
                i = !0;
            return (
                _.each(t, function (t, a) {
                    var n = thmv.library.getFilter(a);
                    if (n && t.callback) {
                        var r = t.callback.call(e, n);
                        return r || (i = !1), r;
                    }
                }),
                i
            );
        },
        setMasonrySkin: function () {
            if ("block" === thmv.library.getFilter("type")) {
                var e = new elementorModules.utils.Masonry({
                    container: this.$childViewContainer,
                    items: this.$childViewContainer.children()
                });
                this.$childViewContainer.imagesLoaded(e.run.bind(e));
            }
        },
        onRenderCollection: function () {
            this.setMasonrySkin(), this.updatePerfectScrollbar();
        },
        onTextFilterInput: function () {
            var e = this;
            _.defer(function () {
                thmv.library.setFilter("text", e.ui.textFilter.val());
            });
        },
        onCategoryFilterClick: function (t) {
            var tar = e(t.currentTarget);
            var i = t.currentTarget.getAttribute('value');
            tar.addClass("active").siblings().removeClass("active");
            thmv.library.setFilter("category", i);
        },
        updatePerfectScrollbar: function () {
            this.perfectScrollbar || (this.perfectScrollbar = new PerfectScrollbar(this.ui.templatesWindow[0], {
                suppressScrollX: !0
            })), (this.perfectScrollbar.isRtl = !1), this.perfectScrollbar.update();
        },
        onRender: function () {
            this.updatePerfectScrollbar();
        },
    })),
    (i.LibraryViews.Template = Marionette.ItemView.extend({
        template: "#template-thmv-templateLibrary-template",
        className: "thmv-templateLibrary-template",
        ui: {
            previewButton: ".thmv-templateLibrary-preview-button, .thmv-templateLibrary-template-preview"
        },
        events: {
            "click @ui.previewButton": "onPreviewButtonClick"
        },
        behaviors: {
            insertTemplate: {
                behaviorClass: i.LibraryBehaviors.InsertTemplate
            }
        },
        onPreviewButtonClick: function () {
            thmv.library.showPreviewView(this.model);
        },
    })),
    (i.Modal = elementorModules.common.views.modal.Layout.extend({
        getModalOptions: function () {
            return {
                id: "thmvTemplateLibraryModal",
                hide: {
                    onOutsideClick: !1,
                    onEscKeyPress: !0,
                    onBackgroundClick: !1
                }
            };
        },
        getTemplateActionButton: function (e) {
            var t = "insert-button";
            return (viewId = "#template-thmv-templateLibrary-" + t), (template = Marionette.TemplateCache.get(viewId)), Marionette.Renderer.render(template);
        },
        showLogo: function (e) {
            this.getHeaderView().logoArea.show(new i.LibraryViews.Logo(e));
        },
        showDefaultHeader: function () {
            this.showLogo({
                title: "Block Library"
            });
            var e = this.getHeaderView();
            e.tools.show(new i.LibraryViews.Actions()), e.menuArea.show(new i.LibraryViews.Menu());
        },
        showPreviewView: function (e) {
            var t = this.getHeaderView();
            t.logoArea.show(new i.LibraryViews.BackButton()), t.tools.show(new i.LibraryViews.InsertWrapper({
                model: e
            })), 
            this.modalContent.show(new i.LibraryViews.Preview({
                url: e.get("url")
            }));
        },
        showBlocksView: function (e) {
            this.modalContent.show(new i.LibraryViews.TemplateCollection({
                collection: e
            }));
        },
        showTemplatesView: function (e) {
            this.showDefaultHeader(), this.modalContent.show(new i.LibraryViews.TemplateCollection({ collection: e }));
        },
    })),
    (i.LibraryManager = function () {
        function a() {
            var t = e(this).closest(".elementor-top-section"),
                i = t.data("model-cid"),
                a = window.elementor.sections;
            a.currentView.collection.length &&
                _.each(a.currentView.collection.models, function (e, t) {
                    i === e.cid && (m.atIndex = t);
                }),
                t.prev(".elementor-add-section").find(FIND_SELECTOR).before($thmvLibraryButton);
        }

        function n(e) {
            var t = e.find(FIND_SELECTOR);
            t.length && t.before($thmvLibraryButton), e.on("click.onAddElement", ".elementor-editor-section-settings .elementor-editor-element-add", a);
        }
        function r(t, i) {
            i.addClass("elementor-active").siblings().removeClass("elementor-active");
        }
        function o() {
            var e = window.elementor.$previewContents,
                t = setInterval(function () {
                    n(e), e.find(".elementor-add-new-section").length > 0 && clearInterval(t);
                }, 100);
            e.on("click.onAddTemplateButton", ".elementor-add-thmv-button", m.showModal.bind(m)), this.channels.tabs.on("change:device", r);
        }
        var l,
            s,
            d,
            src,
            c,
            m = this;
        (FIND_SELECTOR = ".elementor-add-new-section .elementor-add-section-drag-title"),
        ($thmvLibraryButton = '<div class="elementor-add-section-area-button elementor-add-thmv-button"><i class="eicon-file-download"></i></div>'),
        (this.atIndex = -1),
        (this.channels = { tabs: Backbone.Radio.channel("tabs"), templates: Backbone.Radio.channel("templates") }),
        (this.updateBlocksView = function () {
            m.setFilter("category", "", !0), m.setFilter("text", "", !0), m.getModal().showTemplatesView(d);
        }),
        (this.setFilter = function (e, t, i) {
            m.channels.templates.reply("filter:" + e, t), i || m.channels.templates.trigger("filter:change");
        }),
        (this.getFilter = function (e) {
            return m.channels.templates.request("filter:" + e);
        }),
        (this.getFilterTerms = function () {
            return {
                category: {
                    callback: function (e) {
                        return _.any(this.get("category"), function (t) {
                            return t.indexOf(e) >= 0;
                        });
                    },
                },
                text: {
                    callback: function (e) {
                        return (
                            (e = e.toLowerCase()),
                            this.get("title").toLowerCase().indexOf(e) >= 0 ||
                            _.any(this.get("category"), function (t) {
                                return t.indexOf(e) >= 0;
                            })
                        );
                    },
                },
                type: {
                    callback: function (e) {
                        return this.get("type") === e;
                    },
                },
            };
        }),
        (this.showModal = function () {
            m.getModal().showModal(), m.showTemplatesView();
        }),
        (this.closeModal = function () {
            this.getModal().hideModal();
        }),
        (this.getModal = function () {
            return l || (l = new i.Modal()), l;
        }),
        (this.init = function () {
            m.setFilter("type", "page", !0), t.on("preview:loaded", o.bind(this));
        }),
        (this.getTabs = function () {
            var e = this.getFilter("type");
            return (
                (tabs = { page: { title: "Pages" }, block: { title: "Blocks" } }),
                _.each(tabs, function (t, i) {
                    e === i && (tabs[e].active = !0);
                }),
                { tabs: tabs }
            );
        }),
        (this.getCategory = function () {
            return s;
        }),
        (this.getTypeCategory = function () {
            var e = m.getFilter("type");
            return src[e];
        }),
        (this.showTemplatesView = function () {
            m.setFilter("category", "", !0),
                m.setFilter("text", "", !0),
                d
                    ? m.getModal().showTemplatesView(d)
                    : m.loadTemplates(function () {
                          m.getModal().showTemplatesView(d);
                      });
        }),
        (this.showPreviewView = function (e) {
            m.getModal().showPreviewView(e);
        }),
        (this.loadTemplates = function (e) {
            m.requestLibraryData({
                onBeforeUpdate: m.getModal().showLoadingView.bind(m.getModal()),
                onUpdate: function () {
                    m.getModal().hideLoadingView(), e && e();
                },
            });
        }),
        (this.requestLibraryData = function (e) {
            if (d && !e.forceUpdate) return void(e.onUpdate && e.onUpdate());
            e.onBeforeUpdate && e.onBeforeUpdate();
            var t = {
                data: {},
                success: function (t) {
                    (d = new i.LibraryCollections.Template(t.templates)), 
                    t.category && (s = t.category), 
                    t.type_category && (src = t.type_category), 
                    e.onUpdate && e.onUpdate();
                },
            };
            e.forceSync && (t.data.sync = !0), elementorCommon.ajax.addRequest("thmv_get_template_library_data", t);
        }),
        (this.requestTemplateData = function (e, t) {
            var i = {
                unique_id: e,
                data: {
                    edit_mode: !0,
                    display: !0,
                    template_id: e
                }
            };
            t && jQuery.extend(!0, i, t), elementorCommon.ajax.addRequest("thmv_get_template_item_data", i);
        }),
        (this.insertTemplate = function (e) {
            var t = e.model,
                i = this;
            i.getModal().showLoadingView(),
                i.requestTemplateData(t.get("template_id"), {
                    success: function (e) {
                        i.getModal().hideLoadingView(), i.getModal().hideModal();
                        var a = {}; -
                        1 !== i.atIndex && (a.at = i.atIndex), $e.run("document/elements/import", {
                            model: t,
                            data: e,
                            options: a
                        }), (i.atIndex = -1);
                    },
                    error: function (e) {
                        i.showErrorDialog(e);
                    },
                    complete: function (e) {
                        i.getModal().hideLoadingView();
                    },
                });
        }),
        (this.showErrorDialog = function (e) {
            if ("object" == typeof e) {
                var t = "";
                _.each(e, function (e) {
                        t += "<div>" + e.message + ".</div>";
                    }),
                    (e = t);
            } else e ? (e += ".") : (e = "<i>&#60;The error message is empty&#62;</i>");
            m.getErrorDialog()
                .setMessage('The following error(s) occurred while processing the request:<div id="elementor-template-library-error-info">' + e + "</div>")
                .show();
        }),
        (this.getErrorDialog = function () {
            return c || (c = elementorCommon.dialogsLibraryManager.createWidget("alert", {
                id: "elementor-template-library-error-dialog",
                headerMessage: "An error occurred"
            })), c;
        });
    }),
    (window.thmv.library = new i.LibraryManager()),
    window.thmv.library.init();
})(jQuery, window.elementor);