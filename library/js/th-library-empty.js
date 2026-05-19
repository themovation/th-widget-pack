!(function (e, t) {
    window.thmv = window.thmv || {};


    var i = {
        LibraryViews: {},
        LibraryModels: {},
        LibraryCollections: {},
        LibraryBehaviors: {},
        LibraryLayout: null,
        LibraryManager: null
    };
    
   
    (i.LibraryViews.Logo = Marionette.ItemView.extend({
        template: "#template-thmv-templateLibrary-header-logo",
        className: "thmv-templateLibrary-header-logo",
        templateHelpers: function () {
            return {
                title: this.getOption("title")
            };
        },
    })),
   
    (i.LibraryViews.TemplateCollection = Marionette.CompositeView.extend({
        id: "elementor-template-library-templates-empty",
        template: "#template-thmv-templateLibrary-empty",
     
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
        
        showLogo: function (e) {
            this.getHeaderView().logoArea.show(new i.LibraryViews.Logo(e));
        },
        showDefaultHeader: function () {
            this.showLogo({
                title: "Block Library"
            });
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
            t.on("preview:loaded", o.bind(this));
        }),
        
        (this.showTemplatesView = function () {
            m.getModal().showTemplatesView(d);
        });
       
        
    }),
    (window.thmv.library = new i.LibraryManager()),
    window.thmv.library.init();
})(jQuery, window.elementor);