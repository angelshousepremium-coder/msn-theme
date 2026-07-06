jQuery(function(a) {
        window.AJAX_URL = window.AJAX_URL || window.ajaxurl || '/wp-admin/admin-ajax.php';
        a(function() {
            function b(c) {
                c.preventDefault(), c.stopPropagation();
                var d = a(this).data("id");
                a(".product[data-id=" + d + "] .add-to-order").parent().find("div").hide(), a.ajax({
                    url: AJAX_URL,
                    type: "POST",
                    data: "action=remove_from_cart&product_id=" + d,
                    beforeSend: function() {},
                    afterSend: function() {},
                    success: function(c) {
                        a("#mini-cart-container").html(c), a(".product[data-id=" + d + "] .add-to-order").show(), 0 == a("#mini-cart .product-list p").length && a("#mini-cart .to-cart").hide(), a("#mini-cart").on("click", ".delete-item", b)
                    }
                })
            }

            a(".sub-tabs-pr a").click(function() {
                a(".sub-tab-pane").hide(), a("#prods-" + this.href.split("#")[1]).fadeIn("fast")
            }), a(".product .add-to-order").click(function(c) {
                c.preventDefault(), c.stopPropagation();
                var d = a(this).parent().parent().data("id");
                a(this).hide();
                var e = this;
                a.ajax({
                    url: AJAX_URL,
                    type: "POST",
                    data: "action=add_to_cart&product_id=" + d,
                    beforeSend: function() {},
                    afterSend: function() {},
                    success: function(c) {
                        a("#mini-cart-container").html(c), a(e).parent().find("div").show(), a("#mini-cart .to-cart").show(), a("#mini-cart").on("click", ".delete-item", b)
                    }
                })
            }), a("#mini-cart").on("click", ".delete-item", b), 0 < a("#mini-cart .product-list p").length && a("#mini-cart .to-cart").show(), a("#order-table a").click(function(b) {
                b.stopPropagation(), b.preventDefault();
                var c = a(this).data("id"),
                    d = this;
                a.ajax({
                    url: AJAX_URL,
                    type: "POST",
                    data: "action=remove_from_cart&product_id=" + c,
                    beforeSend: function() {},
                    afterSend: function() {},
                    success: function() {
                        a(d).parent().parent().fadeOut("fast", function() {
                            a(d).remove()
                        })
                    }
                })
            }), a("#mini-order-form").submit(function(b) {
                b.preventDefault(), b.stopPropagation();
                for (var c = encodeURIComponent(a("input[name=name]", this).val().trim()), d = encodeURIComponent(a("input[name=phone]", this).val().trim()), e = encodeURIComponent(a("input[name=email]", this).val().trim()), f = [], g = jQuery("#order-table td"), h = 2; h < g.length; h += 4) f.push({
                    product: g[h].textContent.trim(),
                    quantity: 1 * jQuery("input", g[h + 1]).val()
                });
                var i = encodeURIComponent(JSON.stringify(f));
                a.ajax({
                    url: AJAX_URL,
                    type: "POST",
                    data: "action=mini_order_send&name=" + c + "&phone=" + d + "&email=" + e + "&data=" + i,
                    beforeSend: function() {},
                    afterSend: function() {},
                    success: function() {
                        a("#mini-order-success").slideDown("slow"), a("#mini-order-form").fadeOut("fast")
                    }
                })
            })
        }), a("input[type='tel']").mask("+7 (999) 999-9999"), a(function() {
            a(".i-tab li:first").addClass("active"), a(".tab-content li:first").css("display", "block"), a(".i-tab").on("click", "li:not(.active)", function() {
                a(this).addClass("active").siblings().removeClass("active").parents(".tabs-mb").find("ul.tab-content li").hide().eq(a(this).index()).fadeIn("slow").find("a:first").click()
            })
        }), a(function() {
            a(".sub-tabs-pr li:first").addClass("active"), a(".tab-content li:first").css("display", "block"), a(".sub-tabs-pr").on("click", "li:not(.active)", function() {
                a(this).addClass("active").siblings().removeClass("active")
            })
        }), a(function() {
            a(".tabs-pr:first").addClass("active"), a(".tab-content .tab-pane:first").css("display", "block"), a(".tabs-pr").on("click", "li:not(.active)", function() {
                a(this).addClass("active").siblings().removeClass("active").parents(".revision-tabs").find(".tab-content .tab-pane").hide().eq(a(this).index()).fadeIn("slow"), a(".sub-tab-pane").hide();
                try {
                    a(this).parents(".revision-tabs").find(".tab-content .tab-pane").eq(a(this).index()).find("a").get(0).click()
                } catch (b) {
                    a(".sub-tab-pane").hide(), a("#prods-" + a(this).find("a").attr("href").split("#")[1]).fadeIn("fast")
                }
            }), a(".products-row").find("ul:first").find("li:first").click()
        }), a(function() {
            function msnScopedProductTabs(selector) {
                a(document).off("click.msnScopedTabs", selector).on("click.msnScopedTabs", selector, function() {
                    var b = a(this).attr("data-tab"),
                        c = a(this).closest(".tabspr"),
                        d = a(this).closest("ul").children("li[data-tab]");
                    if (!b || !c.length) return;
                    d.removeClass("current"), a(this).addClass("current");
                    d.each(function() {
                        var e = a(this).attr("data-tab");
                        if (e) { a("#" + e).removeClass("current").hide(); }
                    });
                    a("#" + b).addClass("current").show();
                });
            }
            msnScopedProductTabs("ul.i-tab1 > li[data-tab]");
            msnScopedProductTabs("ul.i-tab2 > li[data-tab]");
        }), (new WOW).init(), a(".noloop").owlCarousel({
            center: !0,
            items: 1,
            loop: !0,
            margin: 10,
            autoplay: 5000,
            autoplayTimeout: 5000,
            lazyLoad: true,
            autoplayHoverPause: !0
        }), a(".loop").owlCarousel({
            center: !0,
            items: 5,
            loop: !0,
            margin: 10,
            autoplay: 7000,
            autoplayTimeout: 7000,
            smartSpeed: 5000,
            autoplayHoverPause: !true,
            responsive: {
                600: {
                    items: 5
                }
            }
        }), a(".info_slider").owlCarousel({
            items: 1,
            nav: !0,
            navText: ["<", ">"],
            loop: !0,
            margin: 10,
            autoplay: !0,
            autoplayTimeout: 3e3,
            autoplayHoverPause: !0
        });
        var b, c = document.getElementsByClassName("accordion");
        for (b = 0; b < c.length; b++) c[b].addEventListener("click", function() {
            this.classList.toggle("active");
            var a = this.nextElementSibling;
            a.style.maxHeight = a.style.maxHeight ? null : a.scrollHeight + "px"
        });
        a(".zoom-gallery").magnificPopup({
            delegate: "a",
            type: "image",
            closeOnContentClick: !1,
            closeBtnInside: !1,
            mainClass: "mfp-with-zoom mfp-img-mobile",
            image: {
                verticalFit: !0
            },
            gallery: {
                enabled: !0
            },
            zoom: {
                enabled: !0,
                duration: 300,
                opener: function(a) {
                    return a.find("img")
                }
            }
        }), a(".zoom-gallery1").magnificPopup({
            delegate: "a",
            type: "image",
            closeOnContentClick: !1,
            closeBtnInside: !1,
            mainClass: "mfp-with-zoom mfp-img-mobile",
            image: {
                verticalFit: !0
            },
            gallery: {
                enabled: !0
            },
            zoom: {
                enabled: !0,
                duration: 300,
                opener: function(a) {
                    return a.find("img")
                }
            }
        }), a(".popup-with-form").magnificPopup({
            type: "inline",
            preloader: !1,
            focus: "#name",
            callbacks: {
                beforeOpen: function() {
                    this.st.focus = a(window).width() < 700 ? !1 : "#name"
                }
            }
        }), a(function() {
            a(".image-popup-no-margins").magnificPopup({
                type: "image",
                closeOnContentClick: !0,
                closeBtnInside: !1,
                fixedContentPos: !0,
                mainClass: "mfp-no-margins mfp-with-zoom",
                image: {
                    verticalFit: !0
                },
                zoom: {
                    enabled: !0,
                    duration: 300
                }
            })
        }), a(function() {
            a(function() {
                a("#back-top a").click(function() {
                    return a("body,html").animate({
                        scrollTop: 0
                    }, 800), !1
                }), a("ul.tabs-pr").click(function() {
                    return !1
                }), a(".wc-tabs > li").click(function() {
                    // FIX: .block-questions не существует на страницах товара — добавлена проверка
                    var $bq = a(".block-questions");
                    if ($bq.length) {
                        768 <= a(window).width() ? a("html, body").animate({
                            scrollTop: $bq.offset().top + $bq.height() + 60
                        }, 1) : a("html, body").animate({
                            scrollTop: $bq.offset().top + $bq.height() + 20
                        }, 1);
                    }
                })
            })
        }), a(window).scroll(function() {
            600 < a(window).scrollTop() ? (a("#back-top").show(), a("#back-top").addClass("fadeIn"), a("#back-top").removeClass("fadeOut")) : (a("#back-top").hide(), a("#back-top").addClass("fadeOut"), a("#back-top").removeClass("fadeIn")), 200 <= a(window).scrollTop() ? (a(".top-header").addClass("fixed"), a(".bottom-header").addClass("fixed"), a(".navmenu-mobile").addClass("fixed")) : (a(".top-header").removeClass("fixed"), a(".bottom-header").removeClass("fixed"), a(".navmenu-mobile").removeClass("fixed")), 768 <= a(window).width() ? 1265 <= a(window).scrollTop() ? (a("ul.tabs.wc-tabs").addClass("fixed"), a(".woocommerce-tabs.wc-tabs-wrapper").addClass("mt")) : (a("ul.tabs.wc-tabs").removeClass("fixed"), a(".woocommerce-tabs.wc-tabs-wrapper").removeClass("mt")) : 1902 <= a(window).scrollTop() ? (a("ul.tabs.wc-tabs").addClass("fixed"), a(".woocommerce-tabs.wc-tabs-wrapper").addClass("mt")) : (a("ul.tabs.wc-tabs").removeClass("fixed"), a(".woocommerce-tabs.wc-tabs-wrapper").removeClass("mt"))
        }), a(function() {
            a(".burger").click(function() {
                a(this).toggleClass("active"), a(".navmenu-mobile-list-item").toggleClass("active")
            })
        }), a(function() {
            var b = window.location.href;
            a(".submtwo li").each(function() {
                var c = a(this).find("a").attr("href");
                b == c && a(this).addClass("current-cat")
            })
        }), a("select.list_cat:empty").hide()
    }),
    function() {
        function a(a, b) {
            return function() {
                return a.apply(b, arguments)
            }
        }

        function h(b) {
            null == b && (b = {}), this.scrollCallback = a(this.scrollCallback, this), this.scrollHandler = a(this.scrollHandler, this), this.resetAnimation = a(this.resetAnimation, this), this.start = a(this.start, this), this.scrolled = !0, this.config = this.util().extend(b, this.defaults), null != b.scrollContainer && (this.config.scrollContainer = document.querySelector(b.scrollContainer)), this.animationNameCache = new d, this.wowEvent = this.util().createEvent(this.config.boxClass)
        }

        function i() {
            "undefined" != typeof console && null !== console && console.warn("MutationObserver is not supported by your browser."), "undefined" != typeof console && null !== console && console.warn("WOW.js cannot detect dom mutations, please call .sync() after loading new content.")
        }

        function j() {
            this.keys = [], this.values = []
        }

        function k() {}
        var b, c, d, e, f, g = [].indexOf || function(a) {
            for (var b = 0, c = this.length; b < c; b++)
                if (b in this && this[b] === a) return b;
            return -1
        };
        k.prototype.extend = function(a, b) {
            var c, d;
            for (c in b) d = b[c], null == a[c] && (a[c] = d);
            return a
        }, k.prototype.isMobile = function(a) {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(a)
        }, k.prototype.createEvent = function(a, b, c, d) {
            var e;
            return null == b && (b = !1), null == c && (c = !1), null == d && (d = null), null != document.createEvent ? (e = document.createEvent("CustomEvent")).initCustomEvent(a, b, c, d) : null != document.createEventObject ? (e = document.createEventObject()).eventType = a : e.eventName = a, e
        }, k.prototype.emitEvent = function(a, b) {
            return null != a.dispatchEvent ? a.dispatchEvent(b) : b in (null != a) ? a[b]() : "on" + b in (null != a) ? a["on" + b]() : void 0
        }, k.prototype.addEvent = function(a, b, c) {
            return null != a.addEventListener ? a.addEventListener(b, c, !1) : null != a.attachEvent ? a.attachEvent("on" + b, c) : a[b] = c
        }, k.prototype.removeEvent = function(a, b, c) {
            return null != a.removeEventListener ? a.removeEventListener(b, c, !1) : null != a.detachEvent ? a.detachEvent("on" + b, c) : delete a[b]
        }, k.prototype.innerHeight = function() {
            return "innerHeight" in window ? window.innerHeight : document.documentElement.clientHeight
        }, c = k, d = this.WeakMap || this.MozWeakMap || (j.prototype.get = function(a) {
            var b, c, d, e;
            for (b = c = 0, d = (e = this.keys).length; c < d; b = ++c)
                if (e[b] === a) return this.values[b]
        }, j.prototype.set = function(a, b) {
            var c, d, e, f;
            for (c = d = 0, e = (f = this.keys).length; d < e; c = ++d)
                if (f[c] === a) return void(this.values[c] = b);
            return this.keys.push(a), this.values.push(b)
        }, j), b = this.MutationObserver || this.WebkitMutationObserver || this.MozMutationObserver || (i.notSupported = !0, i.prototype.observe = function() {}, i), e = this.getComputedStyle || function(a) {
            return this.getPropertyValue = function(b) {
                var c;
                return "float" === b && (b = "styleFloat"), f.test(b) && b.replace(f, function(a, b) {
                    return b.toUpperCase()
                }), (null != (c = a.currentStyle) ? c[b] : void 0) || null
            }, this
        }, f = /(\-([a-z]){1})/g, this.WOW = (h.prototype.defaults = {
            boxClass: "wow",
            animateClass: "animated",
            offset: 0,
            mobile: !0,
            live: !0,
            callback: null,
            scrollContainer: null
        }, h.prototype.init = function() {
            var a;
            return this.element = window.document.documentElement, "interactive" === (a = document.readyState) || "complete" === a ? this.start() : this.util().addEvent(document, "DOMContentLoaded", this.start), this.finished = []
        }, h.prototype.start = function() {
            var a, c, d, e, f;
            if (this.stopped = !1, this.boxes = function() {
                    var b, c, d, e;
                    for (e = [], b = 0, c = (d = this.element.querySelectorAll("." + this.config.boxClass)).length; b < c; b++) a = d[b], e.push(a);
                    return e
                }.call(this), this.all = function() {
                    var b, c, d, e;
                    for (e = [], b = 0, c = (d = this.boxes).length; b < c; b++) a = d[b], e.push(a);
                    return e
                }.call(this), this.boxes.length)
                if (this.disabled()) this.resetStyle();
                else
                    for (c = 0, d = (e = this.boxes).length; c < d; c++) a = e[c], this.applyStyle(a, !0);
            return this.disabled() || (this.util().addEvent(this.config.scrollContainer || window, "scroll", this.scrollHandler), this.util().addEvent(window, "resize", this.scrollHandler), this.interval = setInterval(this.scrollCallback, 50)), this.config.live ? new b((f = this, function(a) {
                var b, c, d, e, g;
                for (g = [], b = 0, c = a.length; b < c; b++) e = a[b], g.push(function() {
                    var a, b, c, f;
                    for (f = [], a = 0, b = (c = e.addedNodes || []).length; a < b; a++) d = c[a], f.push(this.doSync(d));
                    return f
                }.call(f));
                return g
            })).observe(document.body, {
                childList: !0,
                subtree: !0
            }) : void 0
        }, h.prototype.stop = function() {
            return this.stopped = !0, this.util().removeEvent(this.config.scrollContainer || window, "scroll", this.scrollHandler), this.util().removeEvent(window, "resize", this.scrollHandler), null != this.interval ? clearInterval(this.interval) : void 0
        }, h.prototype.sync = function() {
            return b.notSupported ? this.doSync(this.element) : void 0
        }, h.prototype.doSync = function(a) {
            var b, c, d, e, f;
            if (null == a && (a = this.element), 1 === a.nodeType) {
                for (f = [], c = 0, d = (e = (a = a.parentNode || a).querySelectorAll("." + this.config.boxClass)).length; c < d; c++) b = e[c], g.call(this.all, b) < 0 ? (this.boxes.push(b), this.all.push(b), this.stopped || this.disabled() ? this.resetStyle() : this.applyStyle(b, !0), f.push(this.scrolled = !0)) : f.push(void 0);
                return f
            }
        }, h.prototype.show = function(a) {
            return this.applyStyle(a), a.className = a.className + " " + this.config.animateClass, null != this.config.callback && this.config.callback(a), this.util().emitEvent(a, this.wowEvent), this.util().addEvent(a, "animationend", this.resetAnimation), this.util().addEvent(a, "oanimationend", this.resetAnimation), this.util().addEvent(a, "webkitAnimationEnd", this.resetAnimation), this.util().addEvent(a, "MSAnimationEnd", this.resetAnimation), a
        }, h.prototype.applyStyle = function(a, b) {
            var c, d, e, f;
            return d = a.getAttribute("data-wow-duration"), c = a.getAttribute("data-wow-delay"), e = a.getAttribute("data-wow-iteration"), this.animate((f = this, function() {
                return f.customStyle(a, b, d, c, e)
            }))
        }, h.prototype.animate = "requestAnimationFrame" in window ? function(a) {
            return window.requestAnimationFrame(a)
        } : function(a) {
            return a()
        }, h.prototype.resetStyle = function() {
            var a, b, c, d, e;
            for (e = [], b = 0, c = (d = this.boxes).length; b < c; b++) a = d[b], e.push(a.style.visibility = "visible");
            return e
        }, h.prototype.resetAnimation = function(a) {
            var b;
            return 0 <= a.type.toLowerCase().indexOf("animationend") ? (b = a.target || a.srcElement).className = b.className.replace(this.config.animateClass, "").trim() : void 0
        }, h.prototype.customStyle = function(a, b, c, d, e) {
            return b && this.cacheAnimationName(a), a.style.visibility = b ? "hidden" : "visible", c && this.vendorSet(a.style, {
                animationDuration: c
            }), d && this.vendorSet(a.style, {
                animationDelay: d
            }), e && this.vendorSet(a.style, {
                animationIterationCount: e
            }), this.vendorSet(a.style, {
                animationName: b ? "none" : this.cachedAnimationName(a)
            }), a
        }, h.prototype.vendors = ["moz", "webkit"], h.prototype.vendorSet = function(a, b) {
            var c, d, e, f;
            for (c in d = [], b) e = b[c], a["" + c] = e, d.push(function() {
                var b, d, g, h;
                for (h = [], b = 0, d = (g = this.vendors).length; b < d; b++) f = g[b], h.push(a["" + f + c.charAt(0).toUpperCase() + c.substr(1)] = e);
                return h
            }.call(this));
            return d
        }, h.prototype.vendorCSS = function(a, b) {
            var c, d, f, g, h, i;
            for (g = (h = e(a)).getPropertyCSSValue(b), c = 0, d = (f = this.vendors).length; c < d; c++) i = f[c], g = g || h.getPropertyCSSValue("-" + i + "-" + b);
            return g
        }, h.prototype.animationName = function(a) {
            var b;
            try {
                b = this.vendorCSS(a, "animation-name").cssText
            } catch (c) {
                b = e(a).getPropertyValue("animation-name")
            }
            return "none" === b ? "" : b
        }, h.prototype.cacheAnimationName = function(a) {
            return this.animationNameCache.set(a, this.animationName(a))
        }, h.prototype.cachedAnimationName = function(a) {
            return this.animationNameCache.get(a)
        }, h.prototype.scrollHandler = function() {
            return this.scrolled = !0
        }, h.prototype.scrollCallback = function() {
            var a;
            return !this.scrolled || (this.scrolled = !1, this.boxes = function() {
                var b, c, d, e;
                for (e = [], b = 0, c = (d = this.boxes).length; b < c; b++)(a = d[b]) && (this.isVisible(a) ? this.show(a) : e.push(a));
                return e
            }.call(this), this.boxes.length || this.config.live) ? void 0 : this.stop()
        }, h.prototype.offsetTop = function(a) {
            for (var b; void 0 === a.offsetTop;) a = a.parentNode;
            for (b = a.offsetTop; a = a.offsetParent;) b += a.offsetTop;
            return b
        }, h.prototype.isVisible = function(a) {
            var b, c, d, e, f;
            return c = a.getAttribute("data-wow-offset") || this.config.offset, e = (f = this.config.scrollContainer && this.config.scrollContainer.scrollTop || window.pageYOffset) + Math.min(this.element.clientHeight, this.util().innerHeight()) - c, b = (d = this.offsetTop(a)) + a.clientHeight, d <= e && f <= b
        }, h.prototype.util = function() {
            return null != this._util ? this._util : this._util = new c
        }, h.prototype.disabled = function() {
            return !this.config.mobile && this.util().isMobile(navigator.userAgent)
        }, h)
    }.call(this),
    function(a, b, c, d) {
        function e(b, c) {
            this.settings = null, this.options = a.extend({}, e.Defaults, c), this.$element = a(b), this._handlers = {}, this._plugins = {}, this._supress = {}, this._current = null, this._speed = null, this._coordinates = [], this._breakpoint = null, this._width = null, this._items = [], this._clones = [], this._mergers = [], this._widths = [], this._invalidated = {}, this._pipe = [], this._drag = {
                time: null,
                target: null,
                pointer: null,
                stage: {
                    start: null,
                    current: null
                },
                direction: null
            }, this._states = {
                current: {},
                tags: {
                    initializing: ["busy"],
                    animating: ["busy"],
                    dragging: ["interacting"]
                }
            }, a.each(["onResize", "onThrottledResize"], a.proxy(function(b, c) {
                this._handlers[c] = a.proxy(this[c], this)
            }, this)), a.each(e.Plugins, a.proxy(function(a, b) {
                this._plugins[a.charAt(0).toLowerCase() + a.slice(1)] = new b(this)
            }, this)), a.each(e.Workers, a.proxy(function(b, c) {
                this._pipe.push({
                    filter: c.filter,
                    run: a.proxy(c.run, this)
                })
            }, this)), this.setup(), this.initialize()
        }
        e.Defaults = {
            items: 3,
            loop: !1,
            center: !1,
            rewind: !1,
            checkVisibility: !0,
            mouseDrag: !0,
            touchDrag: !0,
            pullDrag: !0,
            freeDrag: !1,
            margin: 0,
            stagePadding: 0,
            merge: !1,
            mergeFit: !0,
            autoWidth: !1,
            startPosition: 0,
            rtl: !1,
            smartSpeed: 2450,
            fluidSpeed: !1,
            dragEndSpeed: !1,
            responsive: {},
            responsiveRefreshRate: 200,
            responsiveBaseElement: b,
            fallbackEasing: "swing",
            slideTransition: "",
            info: !1,
            nestedItemSelector: !1,
            itemElement: "div",
            stageElement: "div",
            refreshClass: "owl-refresh",
            loadedClass: "owl-loaded",
            loadingClass: "owl-loading",
            rtlClass: "owl-rtl",
            responsiveClass: "owl-responsive",
            dragClass: "owl-drag",
            itemClass: "owl-item",
            stageClass: "owl-stage",
            stageOuterClass: "owl-stage-outer",
            grabClass: "owl-grab"
        }, e.Width = {
            Default: "default",
            Inner: "inner",
            Outer: "outer"
        }, e.Type = {
            Event: "event",
            State: "state"
        }, e.Plugins = {}, e.Workers = [{
            filter: ["width", "settings"],
            run: function() {
                this._width = this.$element.width()
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(a) {
                a.current = this._items && this._items[this.relative(this._current)]
            }
        }, {
            filter: ["items", "settings"],
            run: function() {
                this.$stage.children(".cloned").remove()
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(a) {
                var b = this.settings.margin || "",
                    c = !this.settings.autoWidth,
                    d = this.settings.rtl,
                    e = {
                        width: "auto",
                        "margin-left": d ? b : "",
                        "margin-right": d ? "" : b
                    };
                c || this.$stage.children().css(e), a.css = e
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(a) {
                var b = (this.width() / this.settings.items).toFixed(3) - this.settings.margin,
                    c = null,
                    d = this._items.length,
                    e = !this.settings.autoWidth,
                    f = [];
                for (a.items = {
                        merge: !1,
                        width: b
                    }; d--;) c = this._mergers[d], c = this.settings.mergeFit && Math.min(c, this.settings.items) || c, a.items.merge = 1 < c || a.items.merge, f[d] = e ? b * c : this._items[d].width();
                this._widths = f
            }
        }, {
            filter: ["items", "settings"],
            run: function() {
                var b = [],
                    c = this._items,
                    d = this.settings,
                    e = Math.max(2 * d.items, 4),
                    f = 2 * Math.ceil(c.length / 2),
                    g = d.loop && c.length ? d.rewind ? e : Math.max(e, f) : 0,
                    h = "",
                    i = "";
                for (g /= 2; 0 < g;) b.push(this.normalize(b.length / 2, !0)), h += c[b[b.length - 1]][0].outerHTML, b.push(this.normalize(c.length - 1 - (b.length - 1) / 2, !0)), i = c[b[b.length - 1]][0].outerHTML + i, --g;
                this._clones = b, a(h).addClass("cloned").appendTo(this.$stage), a(i).addClass("cloned").prependTo(this.$stage)
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function() {
                for (var a = this.settings.rtl ? 1 : -1, b = this._clones.length + this._items.length, c = -1, d = 0, e = 0, f = []; ++c < b;) d = f[c - 1] || 0, e = this._widths[this.relative(c)] + this.settings.margin, f.push(d + e * a);
                this._coordinates = f
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function() {
                var a = this.settings.stagePadding,
                    b = this._coordinates,
                    c = {
                        width: Math.ceil(Math.abs(b[b.length - 1])) + 2 * a,
                        "padding-left": a || "",
                        "padding-right": a || ""
                    };
                this.$stage.css(c)
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(a) {
                var b = this._coordinates.length,
                    c = !this.settings.autoWidth,
                    d = this.$stage.children();
                if (c && a.items.merge)
                    for (; b--;) a.css.width = this._widths[this.relative(b)], d.eq(b).css(a.css);
                else c && (a.css.width = a.items.width, d.css(a.css))
            }
        }, {
            filter: ["items"],
            run: function() {
                this._coordinates.length < 1 && this.$stage.removeAttr("style")
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(a) {
                a.current = a.current ? this.$stage.children().index(a.current) : 0, a.current = Math.max(this.minimum(), Math.min(this.maximum(), a.current)), this.reset(a.current)
            }
        }, {
            filter: ["position"],
            run: function() {
                this.animate(this.coordinates(this._current))
            }
        }, {
            filter: ["width", "position", "items", "settings"],
            run: function() {
                var a, b, c, d, e = this.settings.rtl ? 1 : -1,
                    f = 2 * this.settings.stagePadding,
                    g = this.coordinates(this.current()) + f,
                    h = g + this.width() * e,
                    i = [];
                for (c = 0, d = this._coordinates.length; c < d; c++) a = this._coordinates[c - 1] || 0, b = Math.abs(this._coordinates[c]) + f * e, (this.op(a, "<=", g) && this.op(a, ">", h) || this.op(b, "<", g) && this.op(b, ">", h)) && i.push(c);
                this.$stage.children(".active").removeClass("active"), this.$stage.children(":eq(" + i.join("), :eq(") + ")").addClass("active"), this.$stage.children(".center").removeClass("center"), this.settings.center && this.$stage.children().eq(this.current()).addClass("center")
            }
        }], e.prototype.initializeStage = function() {
            this.$stage = this.$element.find("." + this.settings.stageClass), this.$stage.length || (this.$element.addClass(this.options.loadingClass), this.$stage = a("<" + this.settings.stageElement + ">", {
                "class": this.settings.stageClass
            }).wrap(a("<div/>", {
                "class": this.settings.stageOuterClass
            })), this.$element.append(this.$stage.parent()))
        }, e.prototype.initializeItems = function() {
            var b = this.$element.find(".owl-item");
            return b.length ? (this._items = b.get().map(function(b) {
                return a(b)
            }), this._mergers = this._items.map(function() {
                return 1
            }), void this.refresh()) : (this.replace(this.$element.children().not(this.$stage.parent())), this.isVisible() ? this.refresh() : this.invalidate("width"), this.$element.removeClass(this.options.loadingClass).addClass(this.options.loadedClass), void 0)
        }, e.prototype.initialize = function() {
            var a, b, c;
            this.enter("initializing"), this.trigger("initialize"), this.$element.toggleClass(this.settings.rtlClass, this.settings.rtl), this.settings.autoWidth && !this.is("pre-loading") && (a = this.$element.find("img"), b = this.settings.nestedItemSelector ? "." + this.settings.nestedItemSelector : d, c = this.$element.children(b).width(), a.length && c <= 0 && this.preloadAutoWidthImages(a)), this.initializeStage(), this.initializeItems(), this.registerEventHandlers(), this.leave("initializing"), this.trigger("initialized")
        }, e.prototype.isVisible = function() {
            return !this.settings.checkVisibility || this.$element.is(":visible")
        }, e.prototype.setup = function() {
            var b = this.viewport(),
                c = this.options.responsive,
                d = -1,
                e = null;
            c ? (a.each(c, function(a) {
                a <= b && d < a && (d = Number(a))
            }), "function" == typeof(e = a.extend({}, this.options, c[d])).stagePadding && (e.stagePadding = e.stagePadding()), delete e.responsive, e.responsiveClass && this.$element.attr("class", this.$element.attr("class").replace(new RegExp("(" + this.options.responsiveClass + "-)\\S+\\s", "g"), "$1" + d))) : e = a.extend({}, this.options), this.trigger("change", {
                property: {
                    name: "settings",
                    value: e
                }
            }), this._breakpoint = d, this.settings = e, this.invalidate("settings"), this.trigger("changed", {
                property: {
                    name: "settings",
                    value: this.settings
                }
            })
        }, e.prototype.optionsLogic = function() {
            this.settings.autoWidth && (this.settings.stagePadding = !1, this.settings.merge = !1)
        }, e.prototype.prepare = function(b) {
            var c = this.trigger("prepare", {
                content: b
            });
            return c.data || (c.data = a("<" + this.settings.itemElement + "/>").addClass(this.options.itemClass).append(b)), this.trigger("prepared", {
                content: c.data
            }), c.data
        }, e.prototype.update = function() {
            for (var b = 0, c = this._pipe.length, d = a.proxy(function(a) {
                    return this[a]
                }, this._invalidated), e = {}; b < c;)(this._invalidated.all || 0 < a.grep(this._pipe[b].filter, d).length) && this._pipe[b].run(e), b++;
            this._invalidated = {}, this.is("valid") || this.enter("valid")
        }, e.prototype.width = function(a) {
            switch (a = a || e.Width.Default) {
                case e.Width.Inner:
                case e.Width.Outer:
                    return this._width;
                default:
                    return this._width - 2 * this.settings.stagePadding + this.settings.margin
            }
        }, e.prototype.refresh = function() {
            this.enter("refreshing"), this.trigger("refresh"), this.setup(), this.optionsLogic(), this.$element.addClass(this.options.refreshClass), this.update(), this.$element.removeClass(this.options.refreshClass), this.leave("refreshing"), this.trigger("refreshed")
        }, e.prototype.onThrottledResize = function() {
            b.clearTimeout(this.resizeTimer), this.resizeTimer = b.setTimeout(this._handlers.onResize, this.settings.responsiveRefreshRate)
        }, e.prototype.onResize = function() {
            return !!this._items.length && this._width !== this.$element.width() && !!this.isVisible() && (this.enter("resizing"), this.trigger("resize").isDefaultPrevented() ? (this.leave("resizing"), !1) : (this.invalidate("width"), this.refresh(), this.leave("resizing"), void this.trigger("resized")))
        }, e.prototype.registerEventHandlers = function() {
            a.support.transition && this.$stage.on(a.support.transition.end + ".owl.core", a.proxy(this.onTransitionEnd, this)), !1 !== this.settings.responsive && this.on(b, "resize", this._handlers.onThrottledResize), this.settings.mouseDrag && (this.$element.addClass(this.options.dragClass), this.$stage.on("mousedown.owl.core", a.proxy(this.onDragStart, this)), this.$stage.on("dragstart.owl.core selectstart.owl.core", function() {
                return !1
            })), this.settings.touchDrag && (this.$stage.on("touchstart.owl.core", a.proxy(this.onDragStart, this)), this.$stage.on("touchcancel.owl.core", a.proxy(this.onDragEnd, this)))
        }, e.prototype.onDragStart = function(b) {
            var d = null;
            3 !== b.which && (d = a.support.transform ? {
                x: (d = this.$stage.css("transform").replace(/.*\(|\)| /g, "").split(","))[16 === d.length ? 12 : 4],
                y: d[16 === d.length ? 13 : 5]
            } : (d = this.$stage.position(), {
                x: this.settings.rtl ? d.left + this.$stage.width() - this.width() + this.settings.margin : d.left,
                y: d.top
            }), this.is("animating") && (a.support.transform ? this.animate(d.x) : this.$stage.stop(), this.invalidate("position")), this.$element.toggleClass(this.options.grabClass, "mousedown" === b.type), this.speed(0), this._drag.time = (new Date).getTime(), this._drag.target = a(b.target), this._drag.stage.start = d, this._drag.stage.current = d, this._drag.pointer = this.pointer(b), a(c).on("mouseup.owl.core touchend.owl.core", a.proxy(this.onDragEnd, this)), a(c).one("mousemove.owl.core touchmove.owl.core", a.proxy(function(b) {
                var d = this.difference(this._drag.pointer, this.pointer(b));
                a(c).on("mousemove.owl.core touchmove.owl.core", a.proxy(this.onDragMove, this)), Math.abs(d.x) < Math.abs(d.y) && this.is("valid") || (b.preventDefault(), this.enter("dragging"), this.trigger("drag"))
            }, this)))
        }, e.prototype.onDragMove = function(a) {
            var b = null,
                c = null,
                d = null,
                e = this.difference(this._drag.pointer, this.pointer(a)),
                f = this.difference(this._drag.stage.start, e);
            this.is("dragging") && (a.preventDefault(), this.settings.loop ? (b = this.coordinates(this.minimum()), c = this.coordinates(this.maximum() + 1) - b, f.x = ((f.x - b) % c + c) % c + b) : (b = this.coordinates(this.settings.rtl ? this.maximum() : this.minimum()), c = this.coordinates(this.settings.rtl ? this.minimum() : this.maximum()), d = this.settings.pullDrag ? -1 * e.x / 5 : 0, f.x = Math.max(Math.min(f.x, b + d), c + d)), this._drag.stage.current = f, this.animate(f.x))
        }, e.prototype.onDragEnd = function(b) {
            var d = this.difference(this._drag.pointer, this.pointer(b)),
                e = this._drag.stage.current,
                f = 0 < d.x ^ this.settings.rtl ? "left" : "right";
            a(c).off(".owl.core"), this.$element.removeClass(this.options.grabClass), (0 !== d.x && this.is("dragging") || !this.is("valid")) && (this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed), this.current(this.closest(e.x, 0 !== d.x ? f : this._drag.direction)), this.invalidate("position"), this.update(), this._drag.direction = f, (3 < Math.abs(d.x) || 300 < (new Date).getTime() - this._drag.time) && this._drag.target.one("click.owl.core", function() {
                return !1
            })), this.is("dragging") && (this.leave("dragging"), this.trigger("dragged"))
        }, e.prototype.closest = function(b, c) {
            var e = -1,
                f = this.width(),
                g = this.coordinates();
            return this.settings.freeDrag || a.each(g, a.proxy(function(a, h) {
                return "left" === c && h - 30 < b && b < h + 30 ? e = a : "right" === c && h - f - 30 < b && b < h - f + 30 ? e = a + 1 : this.op(b, "<", h) && this.op(b, ">", g[a + 1] !== d ? g[a + 1] : h - f) && (e = "left" === c ? a + 1 : a), -1 === e
            }, this)), this.settings.loop || (this.op(b, ">", g[this.minimum()]) ? e = b = this.minimum() : this.op(b, "<", g[this.maximum()]) && (e = b = this.maximum())), e
        }, e.prototype.animate = function(b) {
            var c = 0 < this.speed();
            this.is("animating") && this.onTransitionEnd(), c && (this.enter("animating"), this.trigger("translate")), a.support.transform3d && a.support.transition ? this.$stage.css({
                transform: "translate3d(" + b + "px,0px,0px)",
                transition: this.speed() / 1e3 + "s" + (this.settings.slideTransition ? " " + this.settings.slideTransition : "")
            }) : c ? this.$stage.animate({
                left: b + "px"
            }, this.speed(), this.settings.fallbackEasing, a.proxy(this.onTransitionEnd, this)) : this.$stage.css({
                left: b + "px"
            })
        }, e.prototype.is = function(a) {
            return this._states.current[a] && 0 < this._states.current[a]
        }, e.prototype.current = function(a) {
            if (a === d) return this._current;
            if (0 === this._items.length) return d;
            if (a = this.normalize(a), this._current !== a) {
                var b = this.trigger("change", {
                    property: {
                        name: "position",
                        value: a
                    }
                });
                b.data !== d && (a = this.normalize(b.data)), this._current = a, this.invalidate("position"), this.trigger("changed", {
                    property: {
                        name: "position",
                        value: this._current
                    }
                })
            }
            return this._current
        }, e.prototype.invalidate = function(b) {
            return "string" === a.type(b) && (this._invalidated[b] = !0, this.is("valid") && this.leave("valid")), a.map(this._invalidated, function(a, b) {
                return b
            })
        }, e.prototype.reset = function(a) {
            (a = this.normalize(a)) !== d && (this._speed = 0, this._current = a, this.suppress(["translate", "translated"]), this.animate(this.coordinates(a)), this.release(["translate", "translated"]))
        }, e.prototype.normalize = function(a, b) {
            var c = this._items.length,
                e = b ? 0 : this._clones.length;
            return !this.isNumeric(a) || c < 1 ? a = d : (a < 0 || c + e <= a) && (a = ((a - e / 2) % c + c) % c + e / 2), a
        }, e.prototype.relative = function(a) {
            return a -= this._clones.length / 2, this.normalize(a, !0)
        }, e.prototype.maximum = function(a) {
            var b, c, d, e = this.settings,
                f = this._coordinates.length;
            if (e.loop) f = this._clones.length / 2 + this._items.length - 1;
            else if (e.autoWidth || e.merge) {
                if (b = this._items.length)
                    for (c = this._items[--b].width(), d = this.$element.width(); b-- && !((c += this._items[b].width() + this.settings.margin) > d););
                f = b + 1
            } else f = e.center ? this._items.length - 1 : this._items.length - e.items;
            return a && (f -= this._clones.length / 2), Math.max(f, 0)
        }, e.prototype.minimum = function(a) {
            return a ? 0 : this._clones.length / 2
        }, e.prototype.items = function(a) {
            return a === d ? this._items.slice() : (a = this.normalize(a, !0), this._items[a])
        }, e.prototype.mergers = function(a) {
            return a === d ? this._mergers.slice() : (a = this.normalize(a, !0), this._mergers[a])
        }, e.prototype.clones = function(b) {
            function c(a) {
                return a % 2 == 0 ? f + a / 2 : e - (a + 1) / 2
            }
            var e = this._clones.length / 2,
                f = e + this._items.length;
            return b === d ? a.map(this._clones, function(a, b) {
                return c(b)
            }) : a.map(this._clones, function(a, d) {
                return a === b ? c(d) : null
            })
        }, e.prototype.speed = function(a) {
            return a !== d && (this._speed = a), this._speed
        }, e.prototype.coordinates = function(b) {
            var c, e = 1,
                f = b - 1;
            return b === d ? a.map(this._coordinates, a.proxy(function(a, b) {
                return this.coordinates(b)
            }, this)) : (this.settings.center ? (this.settings.rtl && (e = -1, f = b + 1), c = this._coordinates[b], c += (this.width() - c + (this._coordinates[f] || 0)) / 2 * e) : c = this._coordinates[f] || 0, c = Math.ceil(c))
        }, e.prototype.duration = function(a, b, c) {
            return 0 === c ? 0 : Math.min(Math.max(Math.abs(b - a), 1), 6) * Math.abs(c || this.settings.smartSpeed)
        }, e.prototype.to = function(a, b) {
            var c = this.current(),
                d = null,
                e = a - this.relative(c),
                f = (0 < e) - (e < 0),
                g = this._items.length,
                h = this.minimum(),
                i = this.maximum();
            this.settings.loop ? (!this.settings.rewind && Math.abs(e) > g / 2 && (e += -1 * f * g), (d = (((a = c + e) - h) % g + g) % g + h) !== a && d - e <= i && 0 < d - e && (c = d - e, a = d, this.reset(c))) : a = this.settings.rewind ? (a % (i += 1) + i) % i : Math.max(h, Math.min(i, a)), this.speed(this.duration(c, a, b)), this.current(a), this.isVisible() && this.update()
        }, e.prototype.next = function(a) {
            a = a || !1, this.to(this.relative(this.current()) + 1, a)
        }, e.prototype.prev = function(a) {
            a = a || !1, this.to(this.relative(this.current()) - 1, a)
        }, e.prototype.onTransitionEnd = function(a) {
            return a !== d && (a.stopPropagation(), (a.target || a.srcElement || a.originalTarget) !== this.$stage.get(0)) ? !1 : (this.leave("animating"), void this.trigger("translated"))
        }, e.prototype.viewport = function() {
            var d;
            return this.options.responsiveBaseElement !== b ? d = a(this.options.responsiveBaseElement).width() : b.innerWidth ? d = b.innerWidth : c.documentElement && c.documentElement.clientWidth ? d = c.documentElement.clientWidth : console.warn("Can not detect viewport width."), d
        }, e.prototype.replace = function(b) {
            this.$stage.empty(), this._items = [], b = b && (b instanceof jQuery ? b : a(b)), this.settings.nestedItemSelector && (b = b.find("." + this.settings.nestedItemSelector)), b.filter(function() {
                return 1 === this.nodeType
            }).each(a.proxy(function(a, b) {
                b = this.prepare(b), this.$stage.append(b), this._items.push(b), this._mergers.push(1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)
            }, this)), this.reset(this.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0), this.invalidate("items")
        }, e.prototype.add = function(b, c) {
            var e = this.relative(this._current);
            c = c === d ? this._items.length : this.normalize(c, !0), b = b instanceof jQuery ? b : a(b), this.trigger("add", {
                content: b,
                position: c
            }), b = this.prepare(b), 0 === this._items.length || c === this._items.length ? (0 === this._items.length && this.$stage.append(b), 0 !== this._items.length && this._items[c - 1].after(b), this._items.push(b), this._mergers.push(1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)) : (this._items[c].before(b), this._items.splice(c, 0, b), this._mergers.splice(c, 0, 1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)), this._items[e] && this.reset(this._items[e].index()), this.invalidate("items"), this.trigger("added", {
                content: b,
                position: c
            })
        }, e.prototype.remove = function(a) {
            (a = this.normalize(a, !0)) !== d && (this.trigger("remove", {
                content: this._items[a],
                position: a
            }), this._items[a].remove(), this._items.splice(a, 1), this._mergers.splice(a, 1), this.invalidate("items"), this.trigger("removed", {
                content: null,
                position: a
            }))
        }, e.prototype.preloadAutoWidthImages = function(b) {
            b.each(a.proxy(function(b, c) {
                this.enter("pre-loading"), c = a(c), a(new Image).one("load", a.proxy(function(a) {
                    c.attr("src", a.target.src), c.css("opacity", 1), this.leave("pre-loading"), this.is("pre-loading") || this.is("initializing") || this.refresh()
                }, this)).attr("src", c.attr("src") || c.attr("data-src") || c.attr("data-src-retina"))
            }, this))
        }, e.prototype.destroy = function() {
            for (var d in this.$element.off(".owl.core"), this.$stage.off(".owl.core"), a(c).off(".owl.core"), !1 !== this.settings.responsive && (b.clearTimeout(this.resizeTimer), this.off(b, "resize", this._handlers.onThrottledResize)), this._plugins) this._plugins[d].destroy();
            this.$stage.children(".cloned").remove(), this.$stage.unwrap(), this.$stage.children().contents().unwrap(), this.$stage.children().unwrap(), this.$stage.remove(), this.$element.removeClass(this.options.refreshClass).removeClass(this.options.loadingClass).removeClass(this.options.loadedClass).removeClass(this.options.rtlClass).removeClass(this.options.dragClass).removeClass(this.options.grabClass).attr("class", this.$element.attr("class").replace(new RegExp(this.options.responsiveClass + "-\\S+\\s", "g"), "")).removeData("owl.carousel")
        }, e.prototype.op = function(a, b, c) {
            var d = this.settings.rtl;
            switch (b) {
                case "<":
                    return d ? c < a : a < c;
                case ">":
                    return d ? a < c : c < a;
                case ">=":
                    return d ? a <= c : c <= a;
                case "<=":
                    return d ? c <= a : a <= c
            }
        }, e.prototype.on = function(a, b, c, d) {
            a.addEventListener ? a.addEventListener(b, c, d) : a.attachEvent && a.attachEvent("on" + b, c)
        }, e.prototype.off = function(a, b, c, d) {
            a.removeEventListener ? a.removeEventListener(b, c, d) : a.detachEvent && a.detachEvent("on" + b, c)
        }, e.prototype.trigger = function(b, c, d) {
            var h = {
                    item: {
                        count: this._items.length,
                        index: this.current()
                    }
                },
                i = a.camelCase(a.grep(["on", b, d], function(a) {
                    return a
                }).join("-").toLowerCase()),
                j = a.Event([b, "owl", d || "carousel"].join(".").toLowerCase(), a.extend({
                    relatedTarget: this
                }, h, c));
            return this._supress[b] || (a.each(this._plugins, function(a, b) {
                b.onTrigger && b.onTrigger(j)
            }), this.register({
                type: e.Type.Event,
                name: b
            }), this.$element.trigger(j), this.settings && "function" == typeof this.settings[i] && this.settings[i].call(this, j)), j
        }, e.prototype.enter = function(b) {
            a.each([b].concat(this._states.tags[b] || []), a.proxy(function(a, b) {
                this._states.current[b] === d && (this._states.current[b] = 0), this._states.current[b]++
            }, this))
        }, e.prototype.leave = function(b) {
            a.each([b].concat(this._states.tags[b] || []), a.proxy(function(a, b) {
                this._states.current[b]--
            }, this))
        }, e.prototype.register = function(b) {
            if (b.type === e.Type.Event) {
                if (a.event.special[b.name] || (a.event.special[b.name] = {}), !a.event.special[b.name].owl) {
                    var c = a.event.special[b.name]._default;
                    a.event.special[b.name]._default = function(a) {
                        return !c || !c.apply || a.namespace && -1 !== a.namespace.indexOf("owl") ? a.namespace && -1 < a.namespace.indexOf("owl") : c.apply(this, arguments)
                    }, a.event.special[b.name].owl = !0
                }
            } else b.type === e.Type.State && (this._states.tags[b.name] = this._states.tags[b.name] ? this._states.tags[b.name].concat(b.tags) : b.tags, this._states.tags[b.name] = a.grep(this._states.tags[b.name], a.proxy(function(c, d) {
                return a.inArray(c, this._states.tags[b.name]) === d
            }, this)))
        }, e.prototype.suppress = function(b) {
            a.each(b, a.proxy(function(a, b) {
                this._supress[b] = !0
            }, this))
        }, e.prototype.release = function(b) {
            a.each(b, a.proxy(function(a, b) {
                delete this._supress[b]
            }, this))
        }, e.prototype.pointer = function(a) {
            var c = {
                x: null,
                y: null
            };
            return (a = (a = a.originalEvent || a || b.event).touches && a.touches.length ? a.touches[0] : a.changedTouches && a.changedTouches.length ? a.changedTouches[0] : a).pageX ? (c.x = a.pageX, c.y = a.pageY) : (c.x = a.clientX, c.y = a.clientY), c
        }, e.prototype.isNumeric = function(a) {
            return !isNaN(parseFloat(a))
        }, e.prototype.difference = function(a, b) {
            return {
                x: a.x - b.x,
                y: a.y - b.y
            }
        }, a.fn.owlCarousel = function(b) {
            var c = Array.prototype.slice.call(arguments, 1);
            return this.each(function() {
                var d = a(this),
                    f = d.data("owl.carousel");
                f || (f = new e(this, "object" == typeof b && b), d.data("owl.carousel", f), a.each(["next", "prev", "to", "destroy", "refresh", "replace", "add", "remove"], function(b, c) {
                    f.register({
                        type: e.Type.Event,
                        name: c
                    }), f.$element.on(c + ".owl.carousel.core", a.proxy(function(a) {
                        a.namespace && a.relatedTarget !== this && (this.suppress([c]), f[c].apply(this, [].slice.call(arguments, 1)), this.release([c]))
                    }, f))
                })), "string" == typeof b && "_" !== b.charAt(0) && f[b].apply(f, c)
            })
        }, a.fn.owlCarousel.Constructor = e
    }(window.Zepto || window.jQuery, window, document),
    function(a, b) {
        var c = function(b) {
            this._core = b, this._interval = null, this._visible = null, this._handlers = {
                "initialized.owl.carousel": a.proxy(function(a) {
                    a.namespace && this._core.settings.autoRefresh && this.watch()
                }, this)
            }, this._core.options = a.extend({}, c.Defaults, this._core.options), this._core.$element.on(this._handlers)
        };
        c.Defaults = {
            autoRefresh: !0,
            autoRefreshInterval: 500
        }, c.prototype.watch = function() {
            this._interval || (this._visible = this._core.isVisible(), this._interval = b.setInterval(a.proxy(this.refresh, this), this._core.settings.autoRefreshInterval))
        }, c.prototype.refresh = function() {
            this._core.isVisible() !== this._visible && (this._visible = !this._visible, this._core.$element.toggleClass("owl-hidden", !this._visible), this._visible && this._core.invalidate("width") && this._core.refresh())
        }, c.prototype.destroy = function() {
            var a, c;
            for (a in b.clearInterval(this._interval), this._handlers) this._core.$element.off(a, this._handlers[a]);
            for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] && (this[c] = null)
        }, a.fn.owlCarousel.Constructor.Plugins.AutoRefresh = c
    }(window.Zepto || window.jQuery, window, document),
    function(a, b) {
        var c = function(b) {
            this._core = b, this._loaded = [], this._handlers = {
                "initialized.owl.carousel change.owl.carousel resized.owl.carousel": a.proxy(function(b) {
                    if (b.namespace && this._core.settings && this._core.settings.lazyLoad && (b.property && "position" == b.property.name || "initialized" == b.type)) {
                        var c = this._core.settings,
                            d = c.center && Math.ceil(c.items / 2) || c.items,
                            e = c.center && -1 * d || 0,
                            f = (b.property && void 0 !== b.property.value ? b.property.value : this._core.current()) + e,
                            g = this._core.clones().length,
                            h = a.proxy(function(a, b) {
                                this.load(b)
                            }, this);
                        for (0 < c.lazyLoadEager && (d += c.lazyLoadEager, c.loop && (f -= c.lazyLoadEager, d++)); e++ < d;) this.load(g / 2 + this._core.relative(f)), g && a.each(this._core.clones(this._core.relative(f)), h), f++
                    }
                }, this)
            }, this._core.options = a.extend({}, c.Defaults, this._core.options), this._core.$element.on(this._handlers)
        };
        c.Defaults = {
            lazyLoad: !1,
            lazyLoadEager: 0
        }, c.prototype.load = function(c) {
            var d = this._core.$stage.children().eq(c),
                e = d && d.find(".owl-lazy");
            !e || -1 < a.inArray(d.get(0), this._loaded) || (e.each(a.proxy(function(c, d) {
                var e, f = a(d),
                    g = 1 < b.devicePixelRatio && f.attr("data-src-retina") || f.attr("data-src") || f.attr("data-srcset");
                this._core.trigger("load", {
                    element: f,
                    url: g
                }, "lazy"), f.is("img") ? f.one("load.owl.lazy", a.proxy(function() {
                    f.css("opacity", 1), this._core.trigger("loaded", {
                        element: f,
                        url: g
                    }, "lazy")
                }, this)).attr("src", g) : f.is("source") ? f.one("load.owl.lazy", a.proxy(function() {
                    this._core.trigger("loaded", {
                        element: f,
                        url: g
                    }, "lazy")
                }, this)).attr("srcset", g) : ((e = new Image).onload = a.proxy(function() {
                    f.css({
                        "background-image": 'url("' + g + '")',
                        opacity: "1"
                    }), this._core.trigger("loaded", {
                        element: f,
                        url: g
                    }, "lazy")
                }, this), e.src = g)
            }, this)), this._loaded.push(d.get(0)))
        }, c.prototype.destroy = function() {
            var a, b;
            for (a in this.handlers) this._core.$element.off(a, this.handlers[a]);
            for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
        }, a.fn.owlCarousel.Constructor.Plugins.Lazy = c
    }(window.Zepto || window.jQuery, window, document),
    function(a, b) {
        var c = function(d) {
            this._core = d, this._previousHeight = null, this._handlers = {
                "initialized.owl.carousel refreshed.owl.carousel": a.proxy(function(a) {
                    a.namespace && this._core.settings.autoHeight && this.update()
                }, this),
                "changed.owl.carousel": a.proxy(function(a) {
                    a.namespace && this._core.settings.autoHeight && "position" === a.property.name && this.update()
                }, this),
                "loaded.owl.lazy": a.proxy(function(a) {
                    a.namespace && this._core.settings.autoHeight && a.element.closest("." + this._core.settings.itemClass).index() === this._core.current() && this.update()
                }, this)
            }, this._core.options = a.extend({}, c.Defaults, this._core.options), this._core.$element.on(this._handlers), this._intervalId = null;
            var e = this;
            a(b).on("load", function() {
                e._core.settings.autoHeight && e.update()
            }), a(b).resize(function() {
                e._core.settings.autoHeight && (null != e._intervalId && clearTimeout(e._intervalId), e._intervalId = setTimeout(function() {
                    e.update()
                }, 250))
            })
        };
        c.Defaults = {
            autoHeight: !1,
            autoHeightClass: "owl-height"
        }, c.prototype.update = function() {
            var b = this._core._current,
                c = b + this._core.settings.items,
                d = this._core.settings.lazyLoad,
                e = this._core.$stage.children().toArray().slice(b, c),
                f = [],
                g = 0;
            a.each(e, function(b, c) {
                f.push(a(c).height())
            }), (g = Math.max.apply(null, f)) <= 1 && d && this._previousHeight && (g = this._previousHeight), this._previousHeight = g, this._core.$stage.parent().height(g).addClass(this._core.settings.autoHeightClass)
        }, c.prototype.destroy = function() {
            var a, b;
            for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
            for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
        }, a.fn.owlCarousel.Constructor.Plugins.AutoHeight = c
    }(window.Zepto || window.jQuery, window, document),
    function(a, b) {
        var c = function(b) {
            this._core = b, this._videos = {}, this._playing = null, this._handlers = {
                "initialized.owl.carousel": a.proxy(function(a) {
                    a.namespace && this._core.register({
                        type: "state",
                        name: "playing",
                        tags: ["interacting"]
                    })
                }, this),
                "resize.owl.carousel": a.proxy(function(a) {
                    a.namespace && this._core.settings.video && this.isInFullScreen() && a.preventDefault()
                }, this),
                "refreshed.owl.carousel": a.proxy(function(a) {
                    a.namespace && this._core.is("resizing") && this._core.$stage.find(".cloned .owl-video-frame").remove()
                }, this),
                "changed.owl.carousel": a.proxy(function(a) {
                    a.namespace && "position" === a.property.name && this._playing && this.stop()
                }, this),
                "prepared.owl.carousel": a.proxy(function(b) {
                    if (b.namespace) {
                        var c = a(b.content).find(".owl-video");
                        c.length && (c.css("display", "none"), this.fetch(c, a(b.content)))
                    }
                }, this)
            }, this._core.options = a.extend({}, c.Defaults, this._core.options), this._core.$element.on(this._handlers), this._core.$element.on("click.owl.video", ".owl-video-play-icon", a.proxy(function(a) {
                this.play(a)
            }, this))
        };
        c.Defaults = {
            video: !1,
            videoHeight: !1,
            videoWidth: !1
        }, c.prototype.fetch = function(a, b) {
            var c = a.attr("data-vimeo-id") ? "vimeo" : a.attr("data-vzaar-id") ? "vzaar" : "youtube",
                d = a.attr("data-vimeo-id") || a.attr("data-youtube-id") || a.attr("data-vzaar-id"),
                e = a.attr("data-width") || this._core.settings.videoWidth,
                f = a.attr("data-height") || this._core.settings.videoHeight,
                g = a.attr("href");
            if (!g) throw new Error("Missing video URL.");
            if (-1 < (d = g.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com|be\-nocookie\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/))[3].indexOf("youtu")) c = "youtube";
            else if (-1 < d[3].indexOf("vimeo")) c = "vimeo";
            else {
                if (!(-1 < d[3].indexOf("vzaar"))) throw new Error("Video URL not supported.");
                c = "vzaar"
            }
            d = d[6], this._videos[g] = {
                type: c,
                id: d,
                width: e,
                height: f
            }, b.attr("data-video", g), this.thumbnail(a, this._videos[g])
        }, c.prototype.thumbnail = function(b, c) {
            function d(c) {
                e = k.lazyLoad ? a("<div/>", {
                    "class": "owl-video-tn " + j,
                    srcType: c
                }) : a("<div/>", {
                    "class": "owl-video-tn",
                    style: "opacity:1;background-image:url(" + c + ")"
                }), b.after(e), b.after('<div class="owl-video-play-icon"></div>')
            }
            var e, f, g = c.width && c.height ? "width:" + c.width + "px;height:" + c.height + "px;" : "",
                h = b.find("img"),
                i = "src",
                j = "",
                k = this._core.settings;
            return b.wrap(a("<div/>", {
                "class": "owl-video-wrapper",
                style: g
            })), this._core.settings.lazyLoad && (i = "data-src", j = "owl-lazy"), h.length ? (d(h.attr(i)), h.remove(), !1) : void("youtube" === c.type ? (f = "//img.youtube.com/vi/" + c.id + "/hqdefault.jpg", d(f)) : "vimeo" === c.type ? a.ajax({
                type: "GET",
                url: "//vimeo.com/api/v2/video/" + c.id + ".json",
                jsonp: "callback",
                dataType: "jsonp",
                success: function(a) {
                    f = a[0].thumbnail_large, d(f)
                }
            }) : "vzaar" === c.type && a.ajax({
                type: "GET",
                url: "//vzaar.com/api/videos/" + c.id + ".json",
                jsonp: "callback",
                dataType: "jsonp",
                success: function(a) {
                    f = a.framegrab_url, d(f)
                }
            }))
        }, c.prototype.stop = function() {
            this._core.trigger("stop", null, "video"), this._playing.find(".owl-video-frame").remove(), this._playing.removeClass("owl-video-playing"), this._playing = null, this._core.leave("playing"), this._core.trigger("stopped", null, "video")
        }, c.prototype.play = function(b) {
            var c, d = a(b.target).closest("." + this._core.settings.itemClass),
                e = this._videos[d.attr("data-video")],
                f = e.width || "100%",
                g = e.height || this._core.$stage.height();
            this._playing || (this._core.enter("playing"), this._core.trigger("play", null, "video"), d = this._core.items(this._core.relative(d.index())), this._core.reset(d.index()), (c = a('<iframe frameborder="0" allowfullscreen mozallowfullscreen webkitAllowFullScreen ></iframe>')).attr("height", g), c.attr("width", f), "youtube" === e.type ? c.attr("src", "//www.youtube.com/embed/" + e.id + "?autoplay=1&rel=0&v=" + e.id) : "vimeo" === e.type ? c.attr("src", "//player.vimeo.com/video/" + e.id + "?autoplay=1") : "vzaar" === e.type && c.attr("src", "//view.vzaar.com/" + e.id + "/player?autoplay=true"), a(c).wrap('<div class="owl-video-frame" />').insertAfter(d.find(".owl-video")), this._playing = d.addClass("owl-video-playing"))
        }, c.prototype.isInFullScreen = function() {
            var c = b.fullscreenElement || b.mozFullScreenElement || b.webkitFullscreenElement;
            return c && a(c).parent().hasClass("owl-video-frame")
        }, c.prototype.destroy = function() {
            var a, b;
            for (a in this._core.$element.off("click.owl.video"), this._handlers) this._core.$element.off(a, this._handlers[a]);
            for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
        }, a.fn.owlCarousel.Constructor.Plugins.Video = c
    }(window.Zepto || window.jQuery, document),
    function(a) {
        var b = function(c) {
            this.core = c, this.core.options = a.extend({}, b.Defaults, this.core.options), this.swapping = !0, this.previous = void 0, this.next = void 0, this.handlers = {
                "change.owl.carousel": a.proxy(function(a) {
                    a.namespace && "position" == a.property.name && (this.previous = this.core.current(), this.next = a.property.value)
                }, this),
                "drag.owl.carousel dragged.owl.carousel translated.owl.carousel": a.proxy(function(a) {
                    a.namespace && (this.swapping = "translated" == a.type)
                }, this),
                "translate.owl.carousel": a.proxy(function(a) {
                    a.namespace && this.swapping && (this.core.options.animateOut || this.core.options.animateIn) && this.swap()
                }, this)
            }, this.core.$element.on(this.handlers)
        };
        b.Defaults = {
            animateOut: !1,
            animateIn: !1
        }, b.prototype.swap = function() {
            if (1 === this.core.settings.items && a.support.animation && a.support.transition) {
                this.core.speed(0);
                var b, c = a.proxy(this.clear, this),
                    d = this.core.$stage.children().eq(this.previous),
                    e = this.core.$stage.children().eq(this.next),
                    f = this.core.settings.animateIn,
                    g = this.core.settings.animateOut;
                this.core.current() !== this.previous && (g && (b = this.core.coordinates(this.previous) - this.core.coordinates(this.next), d.one(a.support.animation.end, c).css({
                    left: b + "px"
                }).addClass("animated owl-animated-out").addClass(g)), f && e.one(a.support.animation.end, c).addClass("animated owl-animated-in").addClass(f))
            }
        }, b.prototype.clear = function(b) {
            a(b.target).css({
                left: ""
            }).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut), this.core.onTransitionEnd()
        }, b.prototype.destroy = function() {
            var a, b;
            for (a in this.handlers) this.core.$element.off(a, this.handlers[a]);
            for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
        }, a.fn.owlCarousel.Constructor.Plugins.Animate = b
    }(window.Zepto || window.jQuery, document),
    function(a, b, c) {
        var d = function(b) {
            this._core = b, this._call = null, this._time = 0, this._timeout = 0, this._paused = !0, this._handlers = {
                "changed.owl.carousel": a.proxy(function(a) {
                    a.namespace && "settings" === a.property.name ? this._core.settings.autoplay ? this.play() : this.stop() : a.namespace && "position" === a.property.name && this._paused && (this._time = 0)
                }, this),
                "initialized.owl.carousel": a.proxy(function(a) {
                    a.namespace && this._core.settings.autoplay && this.play()
                }, this),
                "play.owl.autoplay": a.proxy(function(a, b, c) {
                    a.namespace && this.play(b, c)
                }, this),
                "stop.owl.autoplay": a.proxy(function(a) {
                    a.namespace && this.stop()
                }, this),
                "mouseover.owl.autoplay": a.proxy(function() {
                    this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause()
                }, this),
                "mouseleave.owl.autoplay": a.proxy(function() {
                    this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.play()
                }, this),
                "touchstart.owl.core": a.proxy(function() {
                    this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause()
                }, this),
                "touchend.owl.core": a.proxy(function() {
                    this._core.settings.autoplayHoverPause && this.play()
                }, this)
            }, this._core.$element.on(this._handlers), this._core.options = a.extend({}, d.Defaults, this._core.options)
        };
        d.Defaults = {
            autoplay: !1,
            autoplayTimeout: 5e3,
            autoplayHoverPause: !1,
            autoplaySpeed: !1
        }, d.prototype._next = function(d) {
            this._call = b.setTimeout(a.proxy(this._next, this, d), this._timeout * (Math.round(this.read() / this._timeout) + 1) - this.read()), this._core.is("interacting") || c.hidden || this._core.next(d || this._core.settings.autoplaySpeed)
        }, d.prototype.read = function() {
            return (new Date).getTime() - this._time
        }, d.prototype.play = function(c, d) {
            var e;
            this._core.is("rotating") || this._core.enter("rotating"), c = c || this._core.settings.autoplayTimeout, e = Math.min(this._time % (this._timeout || c), c), this._paused ? (this._time = this.read(), this._paused = !1) : b.clearTimeout(this._call), this._time += this.read() % c - e, this._timeout = c, this._call = b.setTimeout(a.proxy(this._next, this, d), c - e)
        }, d.prototype.stop = function() {
            this._core.is("rotating") && (this._time = 0, this._paused = !0, b.clearTimeout(this._call), this._core.leave("rotating"))
        }, d.prototype.pause = function() {
            this._core.is("rotating") && !this._paused && (this._time = this.read(), this._paused = !0, b.clearTimeout(this._call))
        }, d.prototype.destroy = function() {
            var a, b;
            for (a in this.stop(), this._handlers) this._core.$element.off(a, this._handlers[a]);
            for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
        }, a.fn.owlCarousel.Constructor.Plugins.autoplay = d
    }(window.Zepto || window.jQuery, window, document),
    function(a) {
        "use strict";
        var b = function(c) {
            this._core = c, this._initialized = !1, this._pages = [], this._controls = {}, this._templates = [], this.$element = this._core.$element, this._overrides = {
                next: this._core.next,
                prev: this._core.prev,
                to: this._core.to
            }, this._handlers = {
                "prepared.owl.carousel": a.proxy(function(b) {
                    b.namespace && this._core.settings.dotsData && this._templates.push('<div class="' + this._core.settings.dotClass + '">' + a(b.content).find("[data-dot]").addBack("[data-dot]").attr("data-dot") + "</div>")
                }, this),
                "added.owl.carousel": a.proxy(function(a) {
                    a.namespace && this._core.settings.dotsData && this._templates.splice(a.position, 0, this._templates.pop())
                }, this),
                "remove.owl.carousel": a.proxy(function(a) {
                    a.namespace && this._core.settings.dotsData && this._templates.splice(a.position, 1)
                }, this),
                "changed.owl.carousel": a.proxy(function(a) {
                    a.namespace && "position" == a.property.name && this.draw()
                }, this),
                "initialized.owl.carousel": a.proxy(function(a) {
                    a.namespace && !this._initialized && (this._core.trigger("initialize", null, "navigation"), this.initialize(), this.update(), this.draw(), this._initialized = !0, this._core.trigger("initialized", null, "navigation"))
                }, this),
                "refreshed.owl.carousel": a.proxy(function(a) {
                    a.namespace && this._initialized && (this._core.trigger("refresh", null, "navigation"), this.update(), this.draw(), this._core.trigger("refreshed", null, "navigation"))
                }, this)
            }, this._core.options = a.extend({}, b.Defaults, this._core.options), this.$element.on(this._handlers)
        };
        b.Defaults = {
            nav: !1,
            navText: ['<span aria-label="Previous">&#x2039;</span>', '<span aria-label="Next">&#x203a;</span>'],
            navSpeed: !1,
            navElement: 'button type="button" role="presentation"',
            navContainer: !1,
            navContainerClass: "owl-nav",
            navClass: ["owl-prev", "owl-next"],
            slideBy: 1,
            dotClass: "owl-dot",
            dotsClass: "owl-dots",
            dots: !0,
            dotsEach: !1,
            dotsData: !1,
            dotsSpeed: !1,
            dotsContainer: !1
        }, b.prototype.initialize = function() {
            var b, c = this._core.settings;
            for (b in this._controls.$relative = (c.navContainer ? a(c.navContainer) : a("<div>").addClass(c.navContainerClass).appendTo(this.$element)).addClass("disabled"), this._controls.$previous = a("<" + c.navElement + ">").addClass(c.navClass[0]).html(c.navText[0]).prependTo(this._controls.$relative).on("click", a.proxy(function() {
                    this.prev(c.navSpeed)
                }, this)), this._controls.$next = a("<" + c.navElement + ">").addClass(c.navClass[1]).html(c.navText[1]).appendTo(this._controls.$relative).on("click", a.proxy(function() {
                    this.next(c.navSpeed)
                }, this)), c.dotsData || (this._templates = [a('<button role="button">').addClass(c.dotClass).append(a("<span>")).prop("outerHTML")]), this._controls.$absolute = (c.dotsContainer ? a(c.dotsContainer) : a("<div>").addClass(c.dotsClass).appendTo(this.$element)).addClass("disabled"), this._controls.$absolute.on("click", "button", a.proxy(function(b) {
                    var d = a(b.target).parent().is(this._controls.$absolute) ? a(b.target).index() : a(b.target).parent().index();
                    b.preventDefault(), this.to(d, c.dotsSpeed)
                }, this)), this._overrides) this._core[b] = a.proxy(this[b], this)
        }, b.prototype.destroy = function() {
            var a, b, c, d, e;
            for (a in e = this._core.settings, this._handlers) this.$element.off(a, this._handlers[a]);
            for (b in this._controls) "$relative" === b && e.navContainer ? this._controls[b].html("") : this._controls[b].remove();
            for (d in this.overides) this._core[d] = this._overrides[d];
            for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] && (this[c] = null)
        }, b.prototype.update = function() {
            var a, b, c = this._core.clones().length / 2,
                d = c + this._core.items().length,
                e = this._core.maximum(!0),
                f = this._core.settings,
                g = f.center || f.autoWidth || f.dotsData ? 1 : f.dotsEach || f.items;
            if ("page" !== f.slideBy && (f.slideBy = Math.min(f.slideBy, f.items)), f.dots || "page" == f.slideBy)
                for (this._pages = [], a = c, b = 0; a < d; a++) {
                    if (g <= b || 0 === b) {
                        if (this._pages.push({
                                start: Math.min(e, a - c),
                                end: a - c + g - 1
                            }), Math.min(e, a - c) === e) break;
                        b = 0, 0
                    }
                    b += this._core.mergers(this._core.relative(a))
                }
        }, b.prototype.draw = function() {
            var b, c = this._core.settings,
                d = this._core.items().length <= c.items,
                e = this._core.relative(this._core.current()),
                f = c.loop || c.rewind;
            this._controls.$relative.toggleClass("disabled", !c.nav || d), c.nav && (this._controls.$previous.toggleClass("disabled", !f && e <= this._core.minimum(!0)), this._controls.$next.toggleClass("disabled", !f && e >= this._core.maximum(!0))), this._controls.$absolute.toggleClass("disabled", !c.dots || d), c.dots && (b = this._pages.length - this._controls.$absolute.children().length, c.dotsData && 0 != b ? this._controls.$absolute.html(this._templates.join("")) : 0 < b ? this._controls.$absolute.append(new Array(1 + b).join(this._templates[0])) : b < 0 && this._controls.$absolute.children().slice(b).remove(), this._controls.$absolute.find(".active").removeClass("active"), this._controls.$absolute.children().eq(a.inArray(this.current(), this._pages)).addClass("active"))
        }, b.prototype.onTrigger = function(b) {
            var c = this._core.settings;
            b.page = {
                index: a.inArray(this.current(), this._pages),
                count: this._pages.length,
                size: c && (c.center || c.autoWidth || c.dotsData ? 1 : c.dotsEach || c.items)
            }
        }, b.prototype.current = function() {
            var b = this._core.relative(this._core.current());
            return a.grep(this._pages, a.proxy(function(a) {
                return a.start <= b && a.end >= b
            }, this)).pop()
        }, b.prototype.getPosition = function(b) {
            var c, d, e = this._core.settings;
            return "page" == e.slideBy ? (c = a.inArray(this.current(), this._pages), d = this._pages.length, b ? ++c : --c, c = this._pages[(c % d + d) % d].start) : (c = this._core.relative(this._core.current()), d = this._core.items().length, b ? c += e.slideBy : c -= e.slideBy), c
        }, b.prototype.next = function(b) {
            a.proxy(this._overrides.to, this._core)(this.getPosition(!0), b)
        }, b.prototype.prev = function(b) {
            a.proxy(this._overrides.to, this._core)(this.getPosition(!1), b)
        }, b.prototype.to = function(b, c, d) {
            var e;
            !d && this._pages.length ? (e = this._pages.length, a.proxy(this._overrides.to, this._core)(this._pages[(b % e + e) % e].start, c)) : a.proxy(this._overrides.to, this._core)(b, c)
        }, a.fn.owlCarousel.Constructor.Plugins.Navigation = b
    }(window.Zepto || window.jQuery, document),
    function(a, b) {
        "use strict";
        var c = function(d) {
            this._core = d, this._hashes = {}, this.$element = this._core.$element, this._handlers = {
                "initialized.owl.carousel": a.proxy(function(c) {
                    c.namespace && "URLHash" === this._core.settings.startPosition && a(b).trigger("hashchange.owl.navigation")
                }, this),
                "prepared.owl.carousel": a.proxy(function(b) {
                    if (b.namespace) {
                        var c = a(b.content).find("[data-hash]").addBack("[data-hash]").attr("data-hash");
                        if (!c) return;
                        this._hashes[c] = b.content
                    }
                }, this),
                "changed.owl.carousel": a.proxy(function(c) {
                    if (c.namespace && "position" === c.property.name) {
                        var d = this._core.items(this._core.relative(this._core.current())),
                            e = a.map(this._hashes, function(a, b) {
                                return a === d ? b : null
                            }).join();
                        if (!e || b.location.hash.slice(1) === e) return;
                        b.location.hash = e
                    }
                }, this)
            }, this._core.options = a.extend({}, c.Defaults, this._core.options), this.$element.on(this._handlers), a(b).on("hashchange.owl.navigation", a.proxy(function() {
                var c = b.location.hash.substring(1),
                    d = this._core.$stage.children(),
                    e = this._hashes[c] && d.index(this._hashes[c]);
                void 0 !== e && e !== this._core.current() && this._core.to(this._core.relative(e), !1, !0)
            }, this))
        };
        c.Defaults = {
            URLhashListener: !1
        }, c.prototype.destroy = function() {
            var c, d;
            for (c in a(b).off("hashchange.owl.navigation"), this._handlers) this._core.$element.off(c, this._handlers[c]);
            for (d in Object.getOwnPropertyNames(this)) "function" != typeof this[d] && (this[d] = null)
        }, a.fn.owlCarousel.Constructor.Plugins.Hash = c
    }(window.Zepto || window.jQuery, window, document),
    function(a, b) {
        function c(c, d) {
            var g = !1,
                h = c.charAt(0).toUpperCase() + c.slice(1);
            return a.each((c + " " + f.join(h + " ") + h).split(" "), function(a, c) {
                return e[c] !== b ? (g = !d || c, !1) : void 0
            }), g
        }

        function d(a) {
            return c(a, !0)
        }
        var e = a("<support>").get(0).style,
            f = "Webkit Moz O ms".split(" "),
            g = {
                transition: {
                    end: {
                        WebkitTransition: "webkitTransitionEnd",
                        MozTransition: "transitionend",
                        OTransition: "oTransitionEnd",
                        transition: "transitionend"
                    }
                },
                animation: {
                    end: {
                        WebkitAnimation: "webkitAnimationEnd",
                        MozAnimation: "animationend",
                        OAnimation: "oAnimationEnd",
                        animation: "animationend"
                    }
                }
            },
            h = function() {
                return !!c("transform")
            },
            i = function() {
                return !!c("perspective")
            },
            j = function() {
                return !!c("animation")
            };
        ! function() {
            return !!c("transition")
        }() || (a.support.transition = new String(d("transition")), a.support.transition.end = g.transition.end[a.support.transition]), j() && (a.support.animation = new String(d("animation")), a.support.animation.end = g.animation.end[a.support.animation]), h() && (a.support.transform = new String(d("transform")), a.support.transform3d = i())
    }(window.Zepto || window.jQuery, void document),
    function(a) {
        "function" == typeof define && define.amd ? define(["jquery"], a) : a("object" == typeof exports ? require("jquery") : window.jQuery || window.Zepto)
    }(function(a) {
        function b() {}

        function c(a, b) {
            h.ev.on("mfp" + a + r, b)
        }

        function d(b, c, d, e) {
            var f = document.createElement("div");
            return f.className = "mfp-" + b, d && (f.innerHTML = d), e ? c && c.appendChild(f) : (f = a(f), c && f.appendTo(c)), f
        }

        function e(b, c) {
            h.ev.triggerHandler("mfp" + b, c), h.st.callbacks && (b = b.charAt(0).toLowerCase() + b.slice(1), h.st.callbacks[b] && h.st.callbacks[b].apply(h, a.isArray(c) ? c : [c]))
        }

        function f(b) {
            return b === m && h.currTemplate.closeBtn || (h.currTemplate.closeBtn = a(h.st.closeMarkup.replace("%title%", h.st.tClose)), m = b), h.currTemplate.closeBtn
        }

        function g() {
            a.magnificPopup.instance || ((h = new b).init(), a.magnificPopup.instance = h)
        }

        function x() {
            A && (z.after(A.addClass(y)).detach(), A = null)
        }

        function C() {
            E && a(document.body).removeClass(E)
        }

        function D() {
            C(), h.req && h.req.abort()
        }

        function I(a) {
            if (h.currTemplate[J]) {
                var b = h.currTemplate[J].find("iframe");
                b.length && (a || (b[0].src = "//about:blank"), h.isIE8 && b.css("display", a ? "block" : "none"))
            }
        }

        function K(a) {
            var b = h.items.length;
            return b - 1 < a ? a - b : a < 0 ? b + a : a
        }

        function L(a, b, c) {
            return a.replace(/%curr%/gi, b + 1).replace(/%total%/gi, c)
        }
        var h, i, j, k, l, m, n = "Close",
            o = "BeforeClose",
            p = "MarkupParse",
            q = "Open",
            r = ".mfp",
            s = "mfp-ready",
            t = "mfp-removing",
            u = "mfp-prevent-close",
            v = !!window.jQuery,
            w = a(window);
        b.prototype = {
            constructor: b,
            init: function() {
                var b = navigator.appVersion;
                h.isLowIE = h.isIE8 = document.all && !document.addEventListener, h.isAndroid = /android/gi.test(b), h.isIOS = /iphone|ipad|ipod/gi.test(b), h.supportsTransition = function() {
                    var a = document.createElement("p").style,
                        b = ["ms", "O", "Moz", "Webkit"];
                    if (void 0 !== a.transition) return !0;
                    for (; b.length;)
                        if (b.pop() + "Transition" in a) return !0;
                    return !1
                }(), h.probablyMobile = h.isAndroid || h.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent), j = a(document), h.popupsCache = {}
            },
            open: function(b) {
                var g;
                if (!1 === b.isObj) {
                    h.items = b.items.toArray(), h.index = 0;
                    var i, k = b.items;
                    for (g = 0; g < k.length; g++)
                        if ((i = k[g]).parsed && (i = i.el[0]), i === b.el[0]) {
                            h.index = g;
                            break
                        }
                } else h.items = a.isArray(b.items) ? b.items : [b.items], h.index = b.index || 0;
                if (!h.isOpen) {
                    h.types = [], l = "", h.ev = b.mainEl && b.mainEl.length ? b.mainEl.eq(0) : j, b.key ? (h.popupsCache[b.key] || (h.popupsCache[b.key] = {}), h.currTemplate = h.popupsCache[b.key]) : h.currTemplate = {}, h.st = a.extend(!0, {}, a.magnificPopup.defaults, b), h.fixedContentPos = "auto" === h.st.fixedContentPos ? !h.probablyMobile : h.st.fixedContentPos, h.st.modal && (h.st.closeOnContentClick = !1, h.st.closeOnBgClick = !1, h.st.showCloseBtn = !1, h.st.enableEscapeKey = !1), h.bgOverlay || (h.bgOverlay = d("bg").on("click" + r, function() {
                        h.close()
                    }), h.wrap = d("wrap").attr("tabindex", -1).on("click" + r, function(a) {
                        h._checkIfClose(a.target) && h.close()
                    }), h.container = d("container", h.wrap)), h.contentContainer = d("content"), h.st.preloader && (h.preloader = d("preloader", h.container, h.st.tLoading));
                    var m = a.magnificPopup.modules;
                    for (g = 0; g < m.length; g++) {
                        var n = m[g];
                        n = n.charAt(0).toUpperCase() + n.slice(1), h["init" + n].call(h)
                    }
                    e("BeforeOpen"), h.st.showCloseBtn && (h.st.closeBtnInside ? (c(p, function(a, b, c, d) {
                        c.close_replaceWith = f(d.type)
                    }), l += " mfp-close-btn-in") : h.wrap.append(f())), h.st.alignTop && (l += " mfp-align-top"), h.wrap.css(h.fixedContentPos ? {
                        overflow: h.st.overflowY,
                        overflowX: "hidden",
                        overflowY: h.st.overflowY
                    } : {
                        top: w.scrollTop(),
                        position: "absolute"
                    }), !1 !== h.st.fixedBgPos && ("auto" !== h.st.fixedBgPos || h.fixedContentPos) || h.bgOverlay.css({
                        height: j.height(),
                        position: "absolute"
                    }), h.st.enableEscapeKey && j.on("keyup" + r, function(a) {
                        27 === a.keyCode && h.close()
                    }), w.on("resize" + r, function() {
                        h.updateSize()
                    }), h.st.closeOnContentClick || (l += " mfp-auto-cursor"), l && h.wrap.addClass(l);
                    var o = h.wH = w.height(),
                        t = {};
                    if (h.fixedContentPos && h._hasScrollBar(o)) {
                        var u = h._getScrollbarSize();
                        u && (t.marginRight = u)
                    }
                    h.fixedContentPos && (h.isIE7 ? a("body, html").css("overflow", "hidden") : t.overflow = "hidden");
                    var v = h.st.mainClass;
                    return h.isIE7 && (v += " mfp-ie7"), v && h._addClassToMFP(v), h.updateItemHTML(), e("BuildControls"), a("html").css(t), h.bgOverlay.add(h.wrap).prependTo(h.st.prependTo || a(document.body)), h._lastFocusedEl = document.activeElement, setTimeout(function() {
                        h.content ? (h._addClassToMFP(s), h._setFocus()) : h.bgOverlay.addClass(s), j.on("focusin" + r, h._onFocusIn)
                    }, 16), h.isOpen = !0, h.updateSize(o), e(q), b
                }
                h.updateItemHTML()
            },
            close: function() {
                h.isOpen && (e(o), h.isOpen = !1, h.st.removalDelay && !h.isLowIE && h.supportsTransition ? (h._addClassToMFP(t), setTimeout(function() {
                    h._close()
                }, h.st.removalDelay)) : h._close())
            },
            _close: function() {
                e(n);
                var b = t + " " + s + " ";
                if (h.bgOverlay.detach(), h.wrap.detach(), h.container.empty(), h.st.mainClass && (b += h.st.mainClass + " "), h._removeClassFromMFP(b), h.fixedContentPos) {
                    var c = {
                        marginRight: ""
                    };
                    h.isIE7 ? a("body, html").css("overflow", "") : c.overflow = "", a("html").css(c)
                }
                j.off("keyup.mfp focusin" + r), h.ev.off(r), h.wrap.attr("class", "mfp-wrap").removeAttr("style"), h.bgOverlay.attr("class", "mfp-bg"), h.container.attr("class", "mfp-container"), !h.st.showCloseBtn || h.st.closeBtnInside && !0 !== h.currTemplate[h.currItem.type] || h.currTemplate.closeBtn && h.currTemplate.closeBtn.detach(), h.st.autoFocusLast && h._lastFocusedEl && a(h._lastFocusedEl).focus(), h.currItem = null, h.content = null, h.currTemplate = null, h.prevHeight = 0, e("AfterClose")
            },
            updateSize: function(a) {
                if (h.isIOS) {
                    var b = document.documentElement.clientWidth / window.innerWidth,
                        c = window.innerHeight * b;
                    h.wrap.css("height", c), h.wH = c
                } else h.wH = a || w.height();
                h.fixedContentPos || h.wrap.css("height", h.wH), e("Resize")
            },
            updateItemHTML: function() {
                var b = h.items[h.index];
                h.contentContainer.detach(), h.content && h.content.detach(), b.parsed || (b = h.parseEl(h.index));
                var c = b.type;
                if (e("BeforeChange", [h.currItem ? h.currItem.type : "", c]), h.currItem = b, !h.currTemplate[c]) {
                    var d = !!h.st[c] && h.st[c].markup;
                    e("FirstMarkupParse", d), h.currTemplate[c] = !d || a(d)
                }
                k && k !== b.type && h.container.removeClass("mfp-" + k + "-holder");
                var f = h["get" + c.charAt(0).toUpperCase() + c.slice(1)](b, h.currTemplate[c]);
                h.appendContent(f, c), b.preloaded = !0, e("Change", b), k = b.type, h.container.prepend(h.contentContainer), e("AfterChange")
            },
            appendContent: function(a, b) {
                (h.content = a) ? h.st.showCloseBtn && h.st.closeBtnInside && !0 === h.currTemplate[b] ? h.content.find(".mfp-close").length || h.content.append(f()) : h.content = a: h.content = "", e("BeforeAppend"), h.container.addClass("mfp-" + b + "-holder"), h.contentContainer.append(h.content)
            },
            parseEl: function(b) {
                var c, d = h.items[b];
                if ((d = d.tagName ? {
                        el: a(d)
                    } : (c = d.type, {
                        data: d,
                        src: d.src
                    })).el) {
                    for (var f = h.types, g = 0; g < f.length; g++)
                        if (d.el.hasClass("mfp-" + f[g])) {
                            c = f[g];
                            break
                        } d.src = d.el.attr("data-mfp-src"), d.src || (d.src = d.el.attr("href"))
                }
                return d.type = c || h.st.type || "inline", d.index = b, d.parsed = !0, h.items[b] = d, e("ElementParse", d), h.items[b]
            },
            addGroup: function(a, b) {
                function c(c) {
                    c.mfpEl = this, h._openClick(c, a, b)
                }
                var d = "click.magnificPopup";
                (b = b || {}).mainEl = a, b.items ? (b.isObj = !0, a.off(d).on(d, c)) : (b.isObj = !1, b.delegate ? a.off(d).on(d, b.delegate, c) : (b.items = a).off(d).on(d, c))
            },
            _openClick: function(b, c, d) {
                if ((void 0 !== d.midClick ? d.midClick : a.magnificPopup.defaults.midClick) || !(2 === b.which || b.ctrlKey || b.metaKey || b.altKey || b.shiftKey)) {
                    var e = void 0 !== d.disableOn ? d.disableOn : a.magnificPopup.defaults.disableOn;
                    if (e)
                        if (typeof e === "function") {
                            if (!e.call(h)) return !0
                        } else if (w.width() < e) return !0;
                    b.type && (b.preventDefault(), h.isOpen && b.stopPropagation()), d.el = a(b.mfpEl), d.delegate && (d.items = c.find(d.delegate)), h.open(d)
                }
            },
            updateStatus: function(a, b) {
                if (h.preloader) {
                    i !== a && h.container.removeClass("mfp-s-" + i), b || "loading" !== a || (b = h.st.tLoading);
                    var c = {
                        status: a,
                        text: b
                    };
                    e("UpdateStatus", c), a = c.status, b = c.text, h.preloader.html(b), h.preloader.find("a").on("click", function(a) {
                        a.stopImmediatePropagation()
                    }), h.container.addClass("mfp-s-" + a), i = a
                }
            },
            _checkIfClose: function(b) {
                if (!a(b).hasClass(u)) {
                    var c = h.st.closeOnContentClick,
                        d = h.st.closeOnBgClick;
                    if (c && d) return !0;
                    if (!h.content || a(b).hasClass("mfp-close") || h.preloader && b === h.preloader[0]) return !0;
                    if (b === h.content[0] || a.contains(h.content[0], b)) {
                        if (c) return !0
                    } else if (d && a.contains(document, b)) return !0;
                    return !1
                }
            },
            _addClassToMFP: function(a) {
                h.bgOverlay.addClass(a), h.wrap.addClass(a)
            },
            _removeClassFromMFP: function(a) {
                this.bgOverlay.removeClass(a), h.wrap.removeClass(a)
            },
            _hasScrollBar: function(a) {
                return (h.isIE7 ? j.height() : document.body.scrollHeight) > (a || w.height())
            },
            _setFocus: function() {
                (h.st.focus ? h.content.find(h.st.focus).eq(0) : h.wrap).focus()
            },
            _onFocusIn: function(b) {
                return b.target === h.wrap[0] || a.contains(h.wrap[0], b.target) ? void 0 : (h._setFocus(), !1)
            },
            _parseMarkup: function(b, c, d) {
                var f;
                d.data && (c = a.extend(d.data, c)), e(p, [b, c, d]), a.each(c, function(c, d) {
                    if (void 0 === d || !1 === d) return !0;
                    if (1 < (f = c.split("_")).length) {
                        var e = b.find(r + "-" + f[0]);
                        if (0 < e.length) {
                            var g = f[1];
                            "replaceWith" === g ? e[0] !== d[0] && e.replaceWith(d) : "img" === g ? e.is("img") ? e.attr("src", d) : e.replaceWith(a("<img>").attr("src", d).attr("class", e.attr("class"))) : e.attr(f[1], d)
                        }
                    } else b.find(r + "-" + c).html(d)
                })
            },
            _getScrollbarSize: function() {
                if (void 0 === h.scrollbarSize) {
                    var a = document.createElement("div");
                    a.style.cssText = "width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;", document.body.appendChild(a), h.scrollbarSize = a.offsetWidth - a.clientWidth, document.body.removeChild(a)
                }
                return h.scrollbarSize
            }
        }, a.magnificPopup = {
            instance: null,
            proto: b.prototype,
            modules: [],
            open: function(b, c) {
                return g(), (b = b ? a.extend(!0, {}, b) : {}).isObj = !0, b.index = c || 0, this.instance.open(b)
            },
            close: function() {
                return a.magnificPopup.instance && a.magnificPopup.instance.close()
            },
            registerModule: function(b, c) {
                c.options && (a.magnificPopup.defaults[b] = c.options), a.extend(this.proto, c.proto), this.modules.push(b)
            },
            defaults: {
                disableOn: 0,
                key: null,
                midClick: !1,
                mainClass: "",
                preloader: !0,
                focus: "",
                closeOnContentClick: !1,
                closeOnBgClick: !0,
                closeBtnInside: !0,
                showCloseBtn: !0,
                enableEscapeKey: !0,
                modal: !1,
                alignTop: !1,
                removalDelay: 0,
                prependTo: null,
                fixedContentPos: "auto",
                fixedBgPos: "auto",
                overflowY: "auto",
                closeMarkup: '<button title="%title%" type="button" class="mfp-close">&#215;</button>',
                tClose: "Close (Esc)",
                tLoading: "Loading...",
                autoFocusLast: !0
            }
        }, a.fn.magnificPopup = function(b) {
            g();
            var c = a(this);
            if ("string" == typeof b)
                if ("open" === b) {
                    var d, e = v ? c.data("magnificPopup") : c[0].magnificPopup,
                        f = parseInt(arguments[1], 10) || 0;
                    d = e.items ? e.items[f] : (d = c, e.delegate && (d = d.find(e.delegate)), d.eq(f)), h._openClick({
                        mfpEl: d
                    }, c, e)
                } else h.isOpen && h[b].apply(h, Array.prototype.slice.call(arguments, 1));
            else b = a.extend(!0, {}, b), v ? c.data("magnificPopup", b) : c[0].magnificPopup = b, h.addGroup(c, b);
            return c
        };
        var y, z, A, B = "inline";
        a.magnificPopup.registerModule(B, {
            options: {
                hiddenClass: "hide",
                markup: "",
                tNotFound: "Content not found"
            },
            proto: {
                initInline: function() {
                    h.types.push(B), c(n + "." + B, function() {
                        x()
                    })
                },
                getInline: function(b, c) {
                    if (x(), b.src) {
                        var e = h.st.inline,
                            f = a(b.src);
                        if (f.length) {
                            var g = f[0].parentNode;
                            g && g.tagName && (z || (y = e.hiddenClass, z = d(y), y = "mfp-" + y), A = f.after(z).detach().removeClass(y)), h.updateStatus("ready")
                        } else h.updateStatus("error", e.tNotFound), f = a("<div>");
                        return b.inlineElement = f
                    }
                    return h.updateStatus("ready"), h._parseMarkup(c, {}, b), c
                }
            }
        });
        var E, F = "ajax";
        a.magnificPopup.registerModule(F, {
            options: {
                settings: null,
                cursor: "mfp-ajax-cur",
                tError: '<a href="%url%">The content</a> could not be loaded.'
            },
            proto: {
                initAjax: function() {
                    h.types.push(F), E = h.st.ajax.cursor, c(n + "." + F, D), c("BeforeChange." + F, D)
                },
                getAjax: function(b) {
                    E && a(document.body).addClass(E), h.updateStatus("loading");
                    var c = a.extend({
                        url: b.src,
                        success: function(c, d, f) {
                            var g = {
                                data: c,
                                xhr: f
                            };
                            e("ParseAjax", g), h.appendContent(a(g.data), F), b.finished = !0, C(), h._setFocus(), setTimeout(function() {
                                h.wrap.addClass(s)
                            }, 16), h.updateStatus("ready"), e("AjaxContentAdded")
                        },
                        error: function() {
                            C(), b.finished = b.loadError = !0, h.updateStatus("error", h.st.ajax.tError.replace("%url%", b.src))
                        }
                    }, h.st.ajax.settings);
                    return h.req = a.ajax(c), ""
                }
            }
        });
        var G;
        a.magnificPopup.registerModule("image", {
            options: {
                markup: '<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',
                cursor: "mfp-zoom-out-cur",
                titleSrc: "title",
                verticalFit: !0,
                tError: '<a href="%url%">The image</a> could not be loaded.'
            },
            proto: {
                initImage: function() {
                    var b = h.st.image,
                        d = ".image";
                    h.types.push("image"), c(q + d, function() {
                        "image" === h.currItem.type && b.cursor && a(document.body).addClass(b.cursor)
                    }), c(n + d, function() {
                        b.cursor && a(document.body).removeClass(b.cursor), w.off("resize" + r)
                    }), c("Resize" + d, h.resizeImage), h.isLowIE && c("AfterChange", h.resizeImage)
                },
                resizeImage: function() {
                    var a = h.currItem;
                    if (a && a.img && h.st.image.verticalFit) {
                        var b = 0;
                        h.isLowIE && (b = parseInt(a.img.css("padding-top"), 10) + parseInt(a.img.css("padding-bottom"), 10)), a.img.css("max-height", h.wH - b)
                    }
                },
                _onImageHasSize: function(a) {
                    a.img && (a.hasSize = !0, G && clearInterval(G), a.isCheckingImgSize = !1, e("ImageHasSize", a), a.imgHidden && (h.content && h.content.removeClass("mfp-loading"), a.imgHidden = !1))
                },
                findImageSize: function(a) {
                    var b = 0,
                        c = a.img[0],
                        d = function(e) {
                            G && clearInterval(G), G = setInterval(function() {
                                return 0 < c.naturalWidth ? void h._onImageHasSize(a) : (200 < b && clearInterval(G), void(3 === ++b ? d(10) : 40 === b ? d(50) : 100 === b && d(500)))
                            }, e)
                        };
                    d(1)
                },
                getImage: function(b, c) {
                    var d = 0,
                        f = function() {
                            b && (b.img[0].complete ? (b.img.off(".mfploader"), b === h.currItem && (h._onImageHasSize(b), h.updateStatus("ready")), b.hasSize = !0, b.loaded = !0, e("ImageLoadComplete")) : ++d < 200 ? setTimeout(f, 100) : g())
                        },
                        g = function() {
                            b && (b.img.off(".mfploader"), b === h.currItem && (h._onImageHasSize(b), h.updateStatus("error", i.tError.replace("%url%", b.src))), b.hasSize = !0, b.loaded = !0, b.loadError = !0)
                        },
                        i = h.st.image,
                        j = c.find(".mfp-img");
                    if (j.length) {
                        var k = document.createElement("img");
                        k.className = "mfp-img", b.el && b.el.find("img").length && (k.alt = b.el.find("img").attr("alt")), b.img = a(k).on("load.mfploader", f).on("error.mfploader", g), k.src = b.src, j.is("img") && (b.img = b.img.clone()), 0 < (k = b.img[0]).naturalWidth ? b.hasSize = !0 : k.width || (b.hasSize = !1)
                    }
                    return h._parseMarkup(c, {
                        title: function(b) {
                            if (b.data && void 0 !== b.data.title) return b.data.title;
                            var c = h.st.image.titleSrc;
                            if (c) {
                                if (typeof c === "function") return c.call(h, b);
                                if (b.el) return b.el.attr(c) || ""
                            }
                            return ""
                        }(b),
                        img_replaceWith: b.img
                    }, b), h.resizeImage(), b.hasSize ? (G && clearInterval(G), b.loadError ? (c.addClass("mfp-loading"), h.updateStatus("error", i.tError.replace("%url%", b.src))) : (c.removeClass("mfp-loading"), h.updateStatus("ready"))) : (h.updateStatus("loading"), b.loading = !0, b.hasSize || (b.imgHidden = !0, c.addClass("mfp-loading"), h.findImageSize(b))), c
                }
            }
        });
        var H;
        a.magnificPopup.registerModule("zoom", {
            options: {
                enabled: !1,
                easing: "ease-in-out",
                duration: 300,
                opener: function(a) {
                    return a.is("img") ? a : a.find("img")
                }
            },
            proto: {
                initZoom: function() {
                    function f(a) {
                        var c = a.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),
                            d = "all " + b.duration / 1e3 + "s " + b.easing,
                            e = {
                                position: "fixed",
                                zIndex: 9999,
                                left: 0,
                                top: 0,
                                "-webkit-backface-visibility": "hidden"
                            },
                            f = "transition";
                        return e["-webkit-" + f] = e["-moz-" + f] = e["-o-" + f] = e[f] = d, c.css(e), c
                    }

                    function g() {
                        h.content.css("visibility", "visible")
                    }
                    var a, b = h.st.zoom,
                        d = ".zoom";
                    if (b.enabled && h.supportsTransition) {
                        var i, j, k = b.duration;
                        c("BuildControls" + d, function() {
                            if (h._allowZoom()) {
                                if (clearTimeout(i), h.content.css("visibility", "hidden"), !(a = h._getItemToZoom())) return void g();
                                (j = f(a)).css(h._getOffset()), h.wrap.append(j), i = setTimeout(function() {
                                    j.css(h._getOffset(!0)), i = setTimeout(function() {
                                        g(), setTimeout(function() {
                                            j.remove(), a = j = null, e("ZoomAnimationEnded")
                                        }, 16)
                                    }, k)
                                }, 16)
                            }
                        }), c(o + d, function() {
                            if (h._allowZoom()) {
                                if (clearTimeout(i), h.st.removalDelay = k, !a) {
                                    if (!(a = h._getItemToZoom())) return;
                                    j = f(a)
                                }
                                j.css(h._getOffset(!0)), h.wrap.append(j), h.content.css("visibility", "hidden"), setTimeout(function() {
                                    j.css(h._getOffset())
                                }, 16)
                            }
                        }), c(n + d, function() {
                            h._allowZoom() && (g(), j && j.remove(), a = null)
                        })
                    }
                },
                _allowZoom: function() {
                    return "image" === h.currItem.type
                },
                _getItemToZoom: function() {
                    return !!h.currItem.hasSize && h.currItem.img
                },
                _getOffset: function(b) {
                    var c, d = (c = b ? h.currItem.img : h.st.zoom.opener(h.currItem.el || h.currItem)).offset(),
                        e = parseInt(c.css("padding-top"), 10),
                        f = parseInt(c.css("padding-bottom"), 10);
                    d.top -= a(window).scrollTop() - e;
                    var g = {
                        width: c.width(),
                        height: (v ? c.innerHeight() : c[0].offsetHeight) - f - e
                    };
                    return void 0 === H && (H = void 0 !== document.createElement("p").style.MozTransform), H ? g["-moz-transform"] = g.transform = "translate(" + d.left + "px," + d.top + "px)" : (g.left = d.left, g.top = d.top), g
                }
            }
        });
        var J = "iframe";
        a.magnificPopup.registerModule(J, {
            options: {
                markup: '<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',
                srcAction: "iframe_src",
                patterns: {
                    youtube: {
                        index: "youtube.com",
                        id: "v=",
                        src: "//www.youtube.com/embed/%id%?autoplay=1"
                    },
                    vimeo: {
                        index: "vimeo.com/",
                        id: "/",
                        src: "//player.vimeo.com/video/%id%?autoplay=1"
                    },
                    gmaps: {
                        index: "//maps.google.",
                        src: "%id%&output=embed"
                    }
                }
            },
            proto: {
                initIframe: function() {
                    h.types.push(J), c("BeforeChange", function(a, b, c) {
                        b !== c && (b === J ? I() : c === J && I(!0))
                    }), c(n + "." + J, function() {
                        I()
                    })
                },
                getIframe: function(b, c) {
                    var d = b.src,
                        e = h.st.iframe;
                    a.each(e.patterns, function() {
                        return -1 < d.indexOf(this.index) ? (this.id && (d = "string" == typeof this.id ? d.substr(d.lastIndexOf(this.id) + this.id.length, d.length) : this.id.call(this, d)), d = this.src.replace("%id%", d), !1) : void 0
                    });
                    var f = {};
                    return e.srcAction && (f[e.srcAction] = d), h._parseMarkup(c, f, b), h.updateStatus("ready"), c
                }
            }
        }), a.magnificPopup.registerModule("gallery", {
            options: {
                enabled: !1,
                arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
                preload: [0, 2],
                navigateByImgClick: !0,
                arrows: !0,
                tPrev: "Previous (Left arrow key)",
                tNext: "Next (Right arrow key)",
                tCounter: "%curr% of %total%"
            },
            proto: {
                initGallery: function() {
                    var b = h.st.gallery,
                        d = ".mfp-gallery";
                    return h.direction = !0, !(!b || !b.enabled) && (l += " mfp-gallery", c(q + d, function() {
                        b.navigateByImgClick && h.wrap.on("click" + d, ".mfp-img", function() {
                            return 1 < h.items.length ? (h.next(), !1) : void 0
                        }), j.on("keydown" + d, function(a) {
                            37 === a.keyCode ? h.prev() : 39 === a.keyCode && h.next()
                        })
                    }), c("UpdateStatus" + d, function(a, b) {
                        b.text && (b.text = L(b.text, h.currItem.index, h.items.length))
                    }), c(p + d, function(a, c, d, e) {
                        var f = h.items.length;
                        d.counter = 1 < f ? L(b.tCounter, e.index, f) : ""
                    }), c("BuildControls" + d, function() {
                        if (1 < h.items.length && b.arrows && !h.arrowLeft) {
                            var c = b.arrowMarkup,
                                d = h.arrowLeft = a(c.replace(/%title%/gi, b.tPrev).replace(/%dir%/gi, "left")).addClass(u),
                                e = h.arrowRight = a(c.replace(/%title%/gi, b.tNext).replace(/%dir%/gi, "right")).addClass(u);
                            d.click(function() {
                                h.prev()
                            }), e.click(function() {
                                h.next()
                            }), h.container.append(d.add(e))
                        }
                    }), c("Change" + d, function() {
                        h._preloadTimeout && clearTimeout(h._preloadTimeout), h._preloadTimeout = setTimeout(function() {
                            h.preloadNearbyImages(), h._preloadTimeout = null
                        }, 16)
                    }), void c(n + d, function() {
                        j.off(d), h.wrap.off("click" + d), h.arrowRight = h.arrowLeft = null
                    }))
                },
                next: function() {
                    h.direction = !0, h.index = K(h.index + 1), h.updateItemHTML()
                },
                prev: function() {
                    h.direction = !1, h.index = K(h.index - 1), h.updateItemHTML()
                },
                goTo: function(a) {
                    h.direction = a >= h.index, h.index = a, h.updateItemHTML()
                },
                preloadNearbyImages: function() {
                    var a, b = h.st.gallery.preload,
                        c = Math.min(b[0], h.items.length),
                        d = Math.min(b[1], h.items.length);
                    for (a = 1; a <= (h.direction ? d : c); a++) h._preloadItem(h.index + a);
                    for (a = 1; a <= (h.direction ? c : d); a++) h._preloadItem(h.index - a)
                },
                _preloadItem: function(b) {
                    if (b = K(b), !h.items[b].preloaded) {
                        var c = h.items[b];
                        c.parsed || (c = h.parseEl(b)), e("LazyLoad", c), "image" === c.type && (c.img = a('<img class="mfp-img" />').on("load.mfploader", function() {
                            c.hasSize = !0
                        }).on("error.mfploader", function() {
                            c.hasSize = !0, c.loadError = !0, e("LazyLoadError", c)
                        }).attr("src", c.src)), c.preloaded = !0
                    }
                }
            }
        });
        var M = "retina";
        a.magnificPopup.registerModule(M, {
            options: {
                replaceSrc: function(a) {
                    return a.src.replace(/\.\w+$/, function(a) {
                        return "@2x" + a
                    })
                },
                ratio: 1
            },
            proto: {
                initRetina: function() {
                    if (1 < window.devicePixelRatio) {
                        var a = h.st.retina,
                            b = a.ratio;
                        1 < (b = isNaN(b) ? b() : b) && (c("ImageHasSize." + M, function(a, c) {
                            c.img.css({
                                "max-width": c.img[0].naturalWidth / b,
                                width: "100%"
                            })
                        }), c("ElementParse." + M, function(c, d) {
                            d.src = a.replaceSrc(d, b)
                        }))
                    }
                }
            }
        }), g()
    }),
    function(a) {
        "function" == typeof define && define.amd ? define(["jquery"], a) : a("object" == typeof exports ? require("jquery") : jQuery)
    }(function(a) {
        var b, c = navigator.userAgent,
            d = /iphone/i.test(c),
            e = /chrome/i.test(c),
            f = /android/i.test(c);
        a.mask = {
            definitions: {
                9: "[0-9]",
                a: "[A-Za-z]",
                "*": "[A-Za-z0-9]"
            },
            autoclear: !0,
            dataName: "rawMaskFn",
            placeholder: "_"
        }, a.fn.extend({
            caret: function(a, b) {
                var c;
                return 0 === this.length || this.is(":hidden") ? void 0 : "number" == typeof a ? (b = "number" == typeof b ? b : a, this.each(function() {
                    this.setSelectionRange ? this.setSelectionRange(a, b) : this.createTextRange && ((c = this.createTextRange()).collapse(!0), c.moveEnd("character", b), c.moveStart("character", a), c.select())
                })) : (this[0].setSelectionRange ? (a = this[0].selectionStart, b = this[0].selectionEnd) : document.selection && document.selection.createRange && (c = document.selection.createRange(), a = 0 - c.duplicate().moveStart("character", -1e5), b = a + c.text.length), {
                    begin: a,
                    end: b
                })
            },
            unmask: function() {
                return this.trigger("unmask")
            },
            mask: function(c, g) {
                var h, i, j, k, l, m, n;
                if (!c && 0 < this.length) {
                    var o = a(this[0]).data(a.mask.dataName);
                    return o ? o() : void 0
                }
                return g = a.extend({
                    autoclear: a.mask.autoclear,
                    placeholder: a.mask.placeholder,
                    completed: null
                }, g), h = a.mask.definitions, i = [], j = m = c.length, k = null, a.each(c.split(""), function(a, b) {
                    "?" == b ? (m--, j = a) : h[b] ? (i.push(new RegExp(h[b])), null === k && (k = i.length - 1), a < j && (l = i.length - 1)) : i.push(null)
                }), this.trigger("unmask").each(function() {
                    function o() {
                        if (g.completed) {
                            for (var a = k; a <= l; a++)
                                if (i[a] && x[a] === p(a)) return;
                            g.completed.call(w)
                        }
                    }

                    function p(a) {
                        return g.placeholder.charAt(a < g.placeholder.length ? a : 0)
                    }

                    function q(a) {
                        for (; ++a < m && !i[a];);
                        return a
                    }

                    function r(a, b) {
                        var c, d;
                        if (!(a < 0)) {
                            for (c = a, d = q(b); c < m; c++)
                                if (i[c]) {
                                    if (!(d < m && i[c].test(x[d]))) break;
                                    x[c] = x[d], x[d] = p(d), d = q(d)
                                } u(), w.caret(Math.max(k, a))
                        }
                    }

                    function s() {
                        v(), w.val() != z && w.change()
                    }

                    function t(a, b) {
                        var c;
                        for (c = a; c < b && c < m; c++) i[c] && (x[c] = p(c))
                    }

                    function u() {
                        w.val(x.join(""))
                    }

                    function v(a) {
                        var b, c, d, e = w.val(),
                            f = -1;
                        for (d = b = 0; b < m; b++)
                            if (i[b]) {
                                for (x[b] = p(b); d++ < e.length;)
                                    if (c = e.charAt(d - 1), i[b].test(c)) {
                                        x[b] = c, f = b;
                                        break
                                    } if (d > e.length) {
                                    t(b + 1, m);
                                    break
                                }
                            } else x[b] === e.charAt(d) && d++, b < j && (f = b);
                        return a ? u() : f + 1 < j ? g.autoclear || x.join("") === y ? (w.val() && w.val(""), t(0, m)) : u() : (u(), w.val(w.val().substring(0, f + 1))), j ? b : k
                    }
                    var w = a(this),
                        x = a.map(c.split(""), function(a, b) {
                            return "?" != a ? h[a] ? p(b) : a : void 0
                        }),
                        y = x.join(""),
                        z = w.val();
                    w.data(a.mask.dataName, function() {
                        return a.map(x, function(a, b) {
                            return i[b] && a != p(b) ? a : null
                        }).join("")
                    }), w.one("unmask", function() {
                        w.off(".mask").removeData(a.mask.dataName)
                    }).on("focus.mask", function() {
                        var a;
                        w.prop("readonly") || (clearTimeout(b), z = w.val(), a = v(), b = setTimeout(function() {
                            w.get(0) === document.activeElement && (u(), a == c.replace("?", "").length ? w.caret(0, a) : w.caret(a))
                        }, 10))
                    }).on("blur.mask", s).on("keydown.mask", function(a) {
                        if (!w.prop("readonly")) {
                            var b, c, e, f = a.which || a.keyCode;
                            n = w.val(), 8 === f || 46 === f || d && 127 === f ? (c = (b = w.caret()).begin, (e = b.end) - c == 0 && (c = 46 !== f ? function(a) {
                                for (; 0 <= --a && !i[a];);
                                return a
                            }(c) : e = q(c - 1), e = 46 === f ? q(e) : e), t(c, e), r(c, e - 1), a.preventDefault()) : 13 === f ? s.call(this, a) : 27 === f && (w.val(z), w.caret(0, v()), a.preventDefault())
                        }
                    }).on("keypress.mask", function(b) {
                        if (!w.prop("readonly")) {
                            var c, d, e, g = b.which || b.keyCode,
                                h = w.caret();
                            b.ctrlKey || b.altKey || b.metaKey || g < 32 || !g || 13 === g || (h.end - h.begin != 0 && (t(h.begin, h.end), r(h.begin, h.end - 1)), (c = q(h.begin - 1)) < m && (d = String.fromCharCode(g), i[c].test(d)) && (! function(a) {
                                var b, c, d, e;
                                for (c = p(b = a); b < m; b++)
                                    if (i[b]) {
                                        if (d = q(b), e = x[b], x[b] = c, !(d < m && i[d].test(e))) break;
                                        c = e
                                    }
                            }(c), x[c] = d, u(), e = q(c), f ? setTimeout(function() {
                                a.proxy(a.fn.caret, w, e)()
                            }, 0) : w.caret(e), h.begin <= l && o()), b.preventDefault())
                        }
                    }).on("input.mask paste.mask", function() {
                        w.prop("readonly") || setTimeout(function() {
                            var a = v(!0);
                            w.caret(a), o()
                        }, 0)
                    }), e && f && w.off("input.mask").on("input.mask", function() {
                        var a = w.val(),
                            b = w.caret();
                        if (n && n.length && n.length > a.length) {
                            for (v(!0); 0 < b.begin && !i[b.begin - 1];) b.begin--;
                            if (0 === b.begin)
                                for (; b.begin < k && !i[b.begin];) b.begin++;
                            w.caret(b.begin, b.begin)
                        } else {
                            for (v(!0); b.begin < m && !i[b.begin];) b.begin++;
                            w.caret(b.begin, b.begin)
                        }
                        o()
                    }), v()
                })
            }
        })
    }),
    function(a) {
        var b = !0;
        a.flexslider = function(c, d) {
            var e = a(c);
            void 0 === d.rtl && "rtl" == a("html").attr("dir") && (d.rtl = !0), e.vars = a.extend({}, a.flexslider.defaults, d);
            var f, g = e.vars.namespace,
                h = window.navigator && window.navigator.msPointerEnabled && window.MSGesture,
                i = ("ontouchstart" in window || h || window.DocumentTouch && document instanceof DocumentTouch) && e.vars.touch,
                j = "click touchend MSPointerUp keyup",
                k = "",
                l = "vertical" === e.vars.direction,
                m = e.vars.reverse,
                n = 0 < e.vars.itemWidth,
                o = "fade" === e.vars.animation,
                p = "" !== e.vars.asNavFor,
                q = {};
            a.data(c, "flexslider", e), q = {
                init: function() {
                    e.animating = !1, e.currentSlide = parseInt(e.vars.startAt ? e.vars.startAt : 0, 10), isNaN(e.currentSlide) && (e.currentSlide = 0), e.animatingTo = e.currentSlide, e.atEnd = 0 === e.currentSlide || e.currentSlide === e.last, e.containerSelector = e.vars.selector.substr(0, e.vars.selector.search(" ")), e.slides = a(e.vars.selector, e), e.container = a(e.containerSelector, e), e.count = e.slides.length, e.syncExists = 0 < a(e.vars.sync).length, "slide" === e.vars.animation && (e.vars.animation = "swing"), e.prop = l ? "top" : e.vars.rtl ? "marginRight" : "marginLeft", e.args = {}, e.manualPause = !1, e.stopped = !1, e.started = !1, e.startTimeout = null, e.transitions = !e.vars.video && !o && e.vars.useCSS && function() {
                        var a = document.createElement("div"),
                            b = ["perspectiveProperty", "WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
                        for (var c in b)
                            if (void 0 !== a.style[b[c]]) return e.pfx = b[c].replace("Perspective", "").toLowerCase(), e.prop = "-" + e.pfx + "-transform", !0;
                        return !1
                    }(), e.isFirefox = -1 < navigator.userAgent.toLowerCase().indexOf("firefox"), (e.ensureAnimationEnd = "") !== e.vars.controlsContainer && (e.controlsContainer = 0 < a(e.vars.controlsContainer).length && a(e.vars.controlsContainer)), "" !== e.vars.manualControls && (e.manualControls = 0 < a(e.vars.manualControls).length && a(e.vars.manualControls)), "" !== e.vars.customDirectionNav && (e.customDirectionNav = 2 === a(e.vars.customDirectionNav).length && a(e.vars.customDirectionNav)), e.vars.randomize && (e.slides.sort(function() {
                        return Math.round(Math.random()) - .5
                    }), e.container.empty().append(e.slides)), e.doMath(), e.setup("init"), e.vars.controlNav && q.controlNav.setup(), e.vars.directionNav && q.directionNav.setup(), e.vars.keyboard && (1 === a(e.containerSelector).length || e.vars.multipleKeyboard) && a(document).on("keyup", function(a) {
                        var b = a.keyCode;
                        if (!e.animating && (39 === b || 37 === b)) {
                            var c = e.vars.rtl ? 37 === b ? e.getTarget("next") : 39 === b && e.getTarget("prev") : 39 === b ? e.getTarget("next") : 37 === b && e.getTarget("prev");
                            e.flexAnimate(c, e.vars.pauseOnAction)
                        }
                    }), e.vars.mousewheel && e.on("mousewheel", function(a, b) {
                        a.preventDefault();
                        var f = e.getTarget(b < 0 ? "next" : "prev");
                        e.flexAnimate(f, e.vars.pauseOnAction)
                    }), e.vars.pausePlay && q.pausePlay.setup(), e.vars.slideshow && e.vars.pauseInvisible && q.pauseInvisible.init(), e.vars.slideshow && (e.vars.pauseOnHover && e.hover(function() {
                        e.manualPlay || e.manualPause || e.pause()
                    }, function() {
                        e.manualPause || e.manualPlay || e.stopped || e.play()
                    }), e.vars.pauseInvisible && q.pauseInvisible.isHidden() || (0 < e.vars.initDelay ? e.startTimeout = setTimeout(e.play, e.vars.initDelay) : e.play())), p && q.asNav.setup(), i && e.vars.touch && q.touch(), (!o || o && e.vars.smoothHeight) && a(window).on("resize orientationchange focus", q.resize), e.find("img").attr("draggable", "false"), setTimeout(function() {
                        e.vars.start(e)
                    }, 200)
                },
                asNav: {
                    setup: function() {
                        e.asNav = !0, e.animatingTo = Math.floor(e.currentSlide / e.move), e.currentItem = e.currentSlide, e.slides.removeClass(g + "active-slide").eq(e.currentItem).addClass(g + "active-slide"), h ? (c._slider = e).slides.each(function() {
                            this._gesture = new MSGesture, (this._gesture.target = this).addEventListener("MSPointerDown", function(a) {
                                a.preventDefault(), a.currentTarget._gesture && a.currentTarget._gesture.addPointer(a.pointerId)
                            }, !1), this.addEventListener("MSGestureTap", function(b) {
                                b.preventDefault();
                                var c = a(this),
                                    d = c.index();
                                a(e.vars.asNavFor).data("flexslider").animating || c.hasClass("active") || (e.direction = e.currentItem < d ? "next" : "prev", e.flexAnimate(d, e.vars.pauseOnAction, !1, !0, !0))
                            })
                        }) : e.slides.on(j, function(b) {
                            b.preventDefault();
                            var c = a(this),
                                d = c.index();
                            (e.vars.rtl ? -1 * (c.offset().right - a(e).scrollLeft()) : c.offset().left - a(e).scrollLeft()) <= 0 && c.hasClass(g + "active-slide") ? e.flexAnimate(e.getTarget("prev"), !0) : a(e.vars.asNavFor).data("flexslider").animating || c.hasClass(g + "active-slide") || (e.direction = e.currentItem < d ? "next" : "prev", e.flexAnimate(d, e.vars.pauseOnAction, !1, !0, !0))
                        })
                    }
                },
                controlNav: {
                    setup: function() {
                        e.manualControls ? q.controlNav.setupManual() : q.controlNav.setupPaging()
                    },
                    setupPaging: function() {
                        var b, c, d = "thumbnails" === e.vars.controlNav ? "control-thumbs" : "control-paging",
                            f = 1;
                        if (e.controlNavScaffold = a('<ol class="' + g + "control-nav " + g + d + '"></ol>'), 1 < e.pagingCount)
                            for (var h = 0; h < e.pagingCount; h++) {
                                if (void 0 === (c = e.slides.eq(h)).attr("data-thumb-alt") && c.attr("data-thumb-alt", ""), b = a("<a></a>").attr("href", "#").text(f), "thumbnails" === e.vars.controlNav && (b = a("<img/>").attr("src", c.attr("data-thumb"))), "" !== c.attr("data-thumb-alt") && b.attr("alt", c.attr("data-thumb-alt")), "thumbnails" === e.vars.controlNav && !0 === e.vars.thumbCaptions) {
                                    var i = c.attr("data-thumbcaption");
                                    if ("" !== i && void 0 !== i) {
                                        var l = a("<span></span>").addClass(g + "caption").text(i);
                                        b.append(l)
                                    }
                                }
                                var m = a("<li>");
                                b.appendTo(m), m.append("</li>"), e.controlNavScaffold.append(m), f++
                            }
                        e.controlsContainer ? a(e.controlsContainer).append(e.controlNavScaffold) : e.append(e.controlNavScaffold), q.controlNav.set(), q.controlNav.active(), e.controlNavScaffold.on(j, "a, img", function(b) {
                            if (b.preventDefault(), "" === k || k === b.type) {
                                var c = a(this),
                                    d = e.controlNav.index(c);
                                c.hasClass(g + "active") || (e.direction = d > e.currentSlide ? "next" : "prev", e.flexAnimate(d, e.vars.pauseOnAction))
                            }
                            "" === k && (k = b.type), q.setToClearWatchedEvent()
                        })
                    },
                    setupManual: function() {
                        e.controlNav = e.manualControls, q.controlNav.active(), e.controlNav.on(j, function(b) {
                            if (b.preventDefault(), "" === k || k === b.type) {
                                var c = a(this),
                                    d = e.controlNav.index(c);
                                c.hasClass(g + "active") || (e.direction = d > e.currentSlide ? "next" : "prev", e.flexAnimate(d, e.vars.pauseOnAction))
                            }
                            "" === k && (k = b.type), q.setToClearWatchedEvent()
                        })
                    },
                    set: function() {
                        var b = "thumbnails" === e.vars.controlNav ? "img" : "a";
                        e.controlNav = a("." + g + "control-nav li " + b, e.controlsContainer ? e.controlsContainer : e)
                    },
                    active: function() {
                        e.controlNav.removeClass(g + "active").eq(e.animatingTo).addClass(g + "active")
                    },
                    update: function(b, c) {
                        1 < e.pagingCount && "add" === b ? e.controlNavScaffold.append(a('<li><a href="#">' + e.count + "</a></li>")) : 1 === e.pagingCount ? e.controlNavScaffold.find("li").remove() : e.controlNav.eq(c).closest("li").remove(), q.controlNav.set(), 1 < e.pagingCount && e.pagingCount !== e.controlNav.length ? e.update(c, b) : q.controlNav.active()
                    }
                },
                directionNav: {
                    setup: function() {
                        var b = a('<ul class="' + g + 'direction-nav"><li class="' + g + 'nav-prev"><a class="' + g + 'prev" href="#">' + e.vars.prevText + '</a></li><li class="' + g + 'nav-next"><a class="' + g + 'next" href="#">' + e.vars.nextText + "</a></li></ul>");
                        e.customDirectionNav ? e.directionNav = e.customDirectionNav : e.controlsContainer ? (a(e.controlsContainer).append(b), e.directionNav = a("." + g + "direction-nav li a", e.controlsContainer)) : (e.append(b), e.directionNav = a("." + g + "direction-nav li a", e)), q.directionNav.update(), e.directionNav.on(j, function(b) {
                            var c;
                            b.preventDefault(), "" !== k && k !== b.type || (c = e.getTarget(a(this).hasClass(g + "next") ? "next" : "prev"), e.flexAnimate(c, e.vars.pauseOnAction)), "" === k && (k = b.type), q.setToClearWatchedEvent()
                        })
                    },
                    update: function() {
                        var a = g + "disabled";
                        1 === e.pagingCount ? e.directionNav.addClass(a).attr("tabindex", "-1") : e.vars.animationLoop ? e.directionNav.removeClass(a).removeAttr("tabindex") : 0 === e.animatingTo ? e.directionNav.removeClass(a).filter("." + g + "prev").addClass(a).attr("tabindex", "-1") : e.animatingTo === e.last ? e.directionNav.removeClass(a).filter("." + g + "next").addClass(a).attr("tabindex", "-1") : e.directionNav.removeClass(a).removeAttr("tabindex")
                    }
                },
                pausePlay: {
                    setup: function() {
                        var b = a('<div class="' + g + 'pauseplay"><a href="#"></a></div>');
                        e.controlsContainer ? (e.controlsContainer.append(b), e.pausePlay = a("." + g + "pauseplay a", e.controlsContainer)) : (e.append(b), e.pausePlay = a("." + g + "pauseplay a", e)), q.pausePlay.update(e.vars.slideshow ? g + "pause" : g + "play"), e.pausePlay.on(j, function(b) {
                            b.preventDefault(), "" !== k && k !== b.type || (a(this).hasClass(g + "pause") ? (e.manualPause = !0, e.manualPlay = !1, e.pause()) : (e.manualPause = !1, e.manualPlay = !0, e.play())), "" === k && (k = b.type), q.setToClearWatchedEvent()
                        })
                    },
                    update: function(a) {
                        "play" === a ? e.pausePlay.removeClass(g + "pause").addClass(g + "play").html(e.vars.playText) : e.pausePlay.removeClass(g + "play").addClass(g + "pause").html(e.vars.pauseText)
                    }
                },
                touch: function() {
                    var a, b, d, f, g, i, j, k, p, q = !1,
                        r = 0,
                        s = 0,
                        t = 0;
                    h ? (c.style.msTouchAction = "none", c._gesture = new MSGesture, (c._gesture.target = c).addEventListener("MSPointerDown", function(a) {
                        a.stopPropagation(), e.animating ? a.preventDefault() : (e.pause(), c._gesture.addPointer(a.pointerId), t = 0, f = l ? e.h : e.w, i = Number(new Date), d = n && m && e.animatingTo === e.last ? 0 : n && m ? e.limit - (e.itemW + e.vars.itemMargin) * e.move * e.animatingTo : n && e.currentSlide === e.last ? e.limit : n ? (e.itemW + e.vars.itemMargin) * e.move * e.currentSlide : m ? (e.last - e.currentSlide + e.cloneOffset) * f : (e.currentSlide + e.cloneOffset) * f)
                    }, !1), c._slider = e, c.addEventListener("MSGestureChange", function(a) {
                        a.stopPropagation();
                        var b = a.target._slider;
                        if (b) {
                            var e = -a.translationX,
                                h = -a.translationY;
                            t += l ? h : e, g = (b.vars.rtl ? -1 : 1) * t, q = l ? Math.abs(t) < Math.abs(-e) : Math.abs(t) < Math.abs(-h), a.detail !== a.MSGESTURE_FLAG_INERTIA ? (!q || 500 < Number(new Date) - i) && (a.preventDefault(), !o && b.transitions && (b.vars.animationLoop || (g = t / (0 === b.currentSlide && t < 0 || b.currentSlide === b.last && 0 < t ? Math.abs(t) / f + 2 : 1)), b.setProps(d + g, "setTouch"))) : setImmediate(function() {
                                c._gesture.stop()
                            })
                        }
                    }, !1), c.addEventListener("MSGestureEnd", function(c) {
                        c.stopPropagation();
                        var e = c.target._slider;
                        if (e) {
                            if (e.animatingTo === e.currentSlide && !q && null !== g) {
                                var h = m ? -g : g,
                                    j = e.getTarget(0 < h ? "next" : "prev");
                                e.canAdvance(j) && (Number(new Date) - i < 550 && 50 < Math.abs(h) || Math.abs(h) > f / 2) ? e.flexAnimate(j, e.vars.pauseOnAction) : o || e.flexAnimate(e.currentSlide, e.vars.pauseOnAction, !0)
                            }
                            d = g = b = a = null, t = 0
                        }
                    }, !1)) : (j = function(g) {
                        e.animating ? g.preventDefault() : !window.navigator.msPointerEnabled && 1 !== g.touches.length || (e.pause(), f = l ? e.h : e.w, i = Number(new Date), r = g.touches[0].pageX, s = g.touches[0].pageY, d = n && m && e.animatingTo === e.last ? 0 : n && m ? e.limit - (e.itemW + e.vars.itemMargin) * e.move * e.animatingTo : n && e.currentSlide === e.last ? e.limit : n ? (e.itemW + e.vars.itemMargin) * e.move * e.currentSlide : m ? (e.last - e.currentSlide + e.cloneOffset) * f : (e.currentSlide + e.cloneOffset) * f, a = l ? s : r, b = l ? r : s, c.addEventListener("touchmove", k, !1), c.addEventListener("touchend", p, !1))
                    }, k = function(c) {
                        r = c.touches[0].pageX, s = c.touches[0].pageY, g = l ? a - s : (e.vars.rtl ? -1 : 1) * (a - r), (!(q = l ? Math.abs(g) < Math.abs(r - b) : Math.abs(g) < Math.abs(s - b)) || 500 < Number(new Date) - i) && (c.preventDefault(), !o && e.transitions && (e.vars.animationLoop || (g /= 0 === e.currentSlide && g < 0 || e.currentSlide === e.last && 0 < g ? Math.abs(g) / f + 2 : 1), e.setProps(d + g, "setTouch")))
                    }, p = function() {
                        if (c.removeEventListener("touchmove", k, !1), e.animatingTo === e.currentSlide && !q && null !== g) {
                            var j = m ? -g : g,
                                l = e.getTarget(0 < j ? "next" : "prev");
                            e.canAdvance(l) && (Number(new Date) - i < 550 && 50 < Math.abs(j) || Math.abs(j) > f / 2) ? e.flexAnimate(l, e.vars.pauseOnAction) : o || e.flexAnimate(e.currentSlide, e.vars.pauseOnAction, !0)
                        }
                        c.removeEventListener("touchend", p, !1), d = g = b = a = null
                    }, c.addEventListener("touchstart", j, !1))
                },
                resize: function() {
                    !e.animating && e.is(":visible") && (n || e.doMath(), o ? q.smoothHeight() : n ? (e.slides.width(e.computedW), e.update(e.pagingCount), e.setProps()) : l ? (e.viewport.height(e.h), e.setProps(e.h, "setTotal")) : (e.vars.smoothHeight && q.smoothHeight(), e.newSlides.width(e.computedW), e.setProps(e.computedW, "setTotal")))
                },
                smoothHeight: function(a) {
                    if (!l || o) {
                        var b = o ? e : e.viewport;
                        a ? b.animate({
                            height: e.slides.eq(e.animatingTo).innerHeight()
                        }, a) : b.innerHeight(e.slides.eq(e.animatingTo).innerHeight())
                    }
                },
                sync: function(b) {
                    var c = a(e.vars.sync).data("flexslider"),
                        d = e.animatingTo;
                    switch (b) {
                        case "animate":
                            c.flexAnimate(d, e.vars.pauseOnAction, !1, !0);
                            break;
                        case "play":
                            c.playing || c.asNav || c.play();
                            break;
                        case "pause":
                            c.pause()
                    }
                },
                uniqueID: function(b) {
                    return b.filter("[id]").add(b.find("[id]")).each(function() {
                        var b = a(this);
                        b.attr("id", b.attr("id") + "_clone")
                    }), b
                },
                pauseInvisible: {
                    visProp: null,
                    init: function() {
                        var a = q.pauseInvisible.getHiddenProp();
                        if (a) {
                            var b = a.replace(/[H|h]idden/, "") + "visibilitychange";
                            document.addEventListener(b, function() {
                                q.pauseInvisible.isHidden() ? e.startTimeout ? clearTimeout(e.startTimeout) : e.pause() : e.started ? e.play() : 0 < e.vars.initDelay ? setTimeout(e.play, e.vars.initDelay) : e.play()
                            })
                        }
                    },
                    isHidden: function() {
                        var a = q.pauseInvisible.getHiddenProp();
                        return !!a && document[a]
                    },
                    getHiddenProp: function() {
                        var a = ["webkit", "moz", "ms", "o"];
                        if ("hidden" in document) return "hidden";
                        for (var b = 0; b < a.length; b++)
                            if (a[b] + "Hidden" in document) return a[b] + "Hidden";
                        return null
                    }
                },
                setToClearWatchedEvent: function() {
                    clearTimeout(f), f = setTimeout(function() {
                        k = ""
                    }, 3e3)
                }
            }, e.flexAnimate = function(b, c, d, f, h) {
                if (e.vars.animationLoop || b === e.currentSlide || (e.direction = b > e.currentSlide ? "next" : "prev"), p && 1 === e.pagingCount && (e.direction = e.currentItem < b ? "next" : "prev"), !e.animating && (e.canAdvance(b, h) || d) && e.is(":visible")) {
                    if (p && f) {
                        var j = a(e.vars.asNavFor).data("flexslider");
                        if (e.atEnd = 0 === b || b === e.count - 1, j.flexAnimate(b, !0, !1, !0, h), e.direction = e.currentItem < b ? "next" : "prev", j.direction = e.direction, Math.ceil((b + 1) / e.visible) - 1 === e.currentSlide || 0 === b) return e.currentItem = b, e.slides.removeClass(g + "active-slide").eq(b).addClass(g + "active-slide"), !1;
                        e.currentItem = b, e.slides.removeClass(g + "active-slide").eq(b).addClass(g + "active-slide"), b = Math.floor(b / e.visible)
                    }
                    if (e.animating = !0, e.animatingTo = b, c && e.pause(), e.vars.before(e), e.syncExists && !h && q.sync("animate"), e.vars.controlNav && q.controlNav.active(), n || e.slides.removeClass(g + "active-slide").eq(b).addClass(g + "active-slide"), e.atEnd = 0 === b || b === e.last, e.vars.directionNav && q.directionNav.update(), b === e.last && (e.vars.end(e), e.vars.animationLoop || e.pause()), o) i ? (e.slides.eq(e.currentSlide).css({
                        opacity: 0,
                        zIndex: 1
                    }), e.slides.eq(b).css({
                        opacity: 1,
                        zIndex: 2
                    }), e.wrapup(t)) : (e.slides.eq(e.currentSlide).css({
                        zIndex: 1
                    }).animate({
                        opacity: 0
                    }, e.vars.animationSpeed, e.vars.easing), e.slides.eq(b).css({
                        zIndex: 2
                    }).animate({
                        opacity: 1
                    }, e.vars.animationSpeed, e.vars.easing, e.wrapup));
                    else {
                        var k, r, s, t = l ? e.slides.filter(":first").height() : e.computedW;
                        r = n ? (k = e.vars.itemMargin, (s = (e.itemW + k) * e.move * e.animatingTo) > e.limit && 1 !== e.visible ? e.limit : s) : 0 === e.currentSlide && b === e.count - 1 && e.vars.animationLoop && "next" !== e.direction ? m ? (e.count + e.cloneOffset) * t : 0 : e.currentSlide === e.last && 0 === b && e.vars.animationLoop && "prev" !== e.direction ? m ? 0 : (e.count + 1) * t : m ? (e.count - 1 - b + e.cloneOffset) * t : (b + e.cloneOffset) * t, e.setProps(r, "", e.vars.animationSpeed), e.transitions ? (e.vars.animationLoop && e.atEnd || (e.animating = !1, e.currentSlide = e.animatingTo), e.container.off("webkitTransitionEnd transitionend"), e.container.on("webkitTransitionEnd transitionend", function() {
                            clearTimeout(e.ensureAnimationEnd), e.wrapup(t)
                        }), clearTimeout(e.ensureAnimationEnd), e.ensureAnimationEnd = setTimeout(function() {
                            e.wrapup(t)
                        }, e.vars.animationSpeed + 100)) : e.container.animate(e.args, e.vars.animationSpeed, e.vars.easing, function() {
                            e.wrapup(t)
                        })
                    }
                    e.vars.smoothHeight && q.smoothHeight(e.vars.animationSpeed)
                }
            }, e.wrapup = function(a) {
                o || n || (0 === e.currentSlide && e.animatingTo === e.last && e.vars.animationLoop ? e.setProps(a, "jumpEnd") : e.currentSlide === e.last && 0 === e.animatingTo && e.vars.animationLoop && e.setProps(a, "jumpStart")), e.animating = !1, e.currentSlide = e.animatingTo, e.vars.after(e)
            }, e.animateSlides = function() {
                !e.animating && b && e.flexAnimate(e.getTarget("next"))
            }, e.pause = function() {
                clearInterval(e.animatedSlides), e.animatedSlides = null, e.playing = !1, e.vars.pausePlay && q.pausePlay.update("play"), e.syncExists && q.sync("pause")
            }, e.play = function() {
                e.playing && clearInterval(e.animatedSlides), e.animatedSlides = e.animatedSlides || setInterval(e.animateSlides, e.vars.slideshowSpeed), e.started = e.playing = !0, e.vars.pausePlay && q.pausePlay.update("pause"), e.syncExists && q.sync("play")
            }, e.stop = function() {
                e.pause(), e.stopped = !0
            }, e.canAdvance = function(a, b) {
                var c = p ? e.pagingCount - 1 : e.last;
                return !(!b && (!p || e.currentItem !== e.count - 1 || 0 !== a || "prev" !== e.direction) && (p && 0 === e.currentItem && a === e.pagingCount - 1 && "next" !== e.direction || a === e.currentSlide && !p || !e.vars.animationLoop && (e.atEnd && 0 === e.currentSlide && a === c && "next" !== e.direction || e.atEnd && e.currentSlide === c && 0 === a && "next" === e.direction)))
            }, e.getTarget = function(a) {
                return "next" === (e.direction = a) ? e.currentSlide === e.last ? 0 : e.currentSlide + 1 : 0 === e.currentSlide ? e.last : e.currentSlide - 1
            }, e.setProps = function(a, b, c) {
                var d, f = (d = a || (e.itemW + e.vars.itemMargin) * e.move * e.animatingTo, function() {
                    if (n) return "setTouch" === b ? a : m && e.animatingTo === e.last ? 0 : m ? e.limit - (e.itemW + e.vars.itemMargin) * e.move * e.animatingTo : e.animatingTo === e.last ? e.limit : d;
                    switch (b) {
                        case "setTotal":
                            return m ? (e.count - 1 - e.currentSlide + e.cloneOffset) * a : (e.currentSlide + e.cloneOffset) * a;
                        case "setTouch":
                            return a;
                        case "jumpEnd":
                            return m ? a : e.count * a;
                        case "jumpStart":
                            return m ? e.count * a : a;
                        default:
                            return a
                    }
                }() * (e.vars.rtl ? 1 : -1) + "px");
                e.transitions && (f = e.isFirefox ? l ? "translate3d(0," + f + ",0)" : "translate3d(" + parseInt(f) + "px,0,0)" : l ? "translate3d(0," + f + ",0)" : "translate3d(" + (e.vars.rtl ? -1 : 1) * parseInt(f) + "px,0,0)", c = void 0 !== c ? c / 1e3 + "s" : "0s", e.container.css("-" + e.pfx + "-transition-duration", c), e.container.css("transition-duration", c)), e.args[e.prop] = f, !e.transitions && void 0 !== c || e.container.css(e.args), e.container.css("transform", f)
            }, e.setup = function(b) {
                var c, d;
                o ? (e.slides.css(e.vars.rtl ? {
                    width: "100%",
                    "float": "right",
                    marginLeft: "-100%",
                    position: "relative"
                } : {
                    width: "100%",
                    "float": "left",
                    marginRight: "-100%",
                    position: "relative"
                }), "init" === b && (i ? e.slides.css({
                    opacity: 0,
                    display: "block",
                    webkitTransition: "opacity " + e.vars.animationSpeed / 1e3 + "s ease",
                    zIndex: 1
                }).eq(e.currentSlide).css({
                    opacity: 1,
                    zIndex: 2
                }) : 0 == e.vars.fadeFirstSlide ? e.slides.css({
                    opacity: 0,
                    display: "block",
                    zIndex: 1
                }).eq(e.currentSlide).css({
                    zIndex: 2
                }).css({
                    opacity: 1
                }) : e.slides.css({
                    opacity: 0,
                    display: "block",
                    zIndex: 1
                }).eq(e.currentSlide).css({
                    zIndex: 2
                }).animate({
                    opacity: 1
                }, e.vars.animationSpeed, e.vars.easing)), e.vars.smoothHeight && q.smoothHeight()) : ("init" === b && (e.viewport = a('<div class="' + g + 'viewport"></div>').css({
                    overflow: "hidden",
                    position: "relative"
                }).appendTo(e).append(e.container), e.cloneCount = 0, e.cloneOffset = 0, m && (d = a.makeArray(e.slides).reverse(), e.slides = a(d), e.container.empty().append(e.slides))), e.vars.animationLoop && !n && (e.cloneCount = 2, e.cloneOffset = 1, "init" !== b && e.container.find(".clone").remove(), e.container.append(q.uniqueID(e.slides.first().clone().addClass("clone")).attr("aria-hidden", "true")).prepend(q.uniqueID(e.slides.last().clone().addClass("clone")).attr("aria-hidden", "true"))), e.newSlides = a(e.vars.selector, e), c = m ? e.count - 1 - e.currentSlide + e.cloneOffset : e.currentSlide + e.cloneOffset, l && !n ? (e.container.height(200 * (e.count + e.cloneCount) + "%").css("position", "absolute").width("100%"), setTimeout(function() {
                    e.newSlides.css({
                        display: "block"
                    }), e.doMath(), e.viewport.height(e.h), e.setProps(c * e.h, "init")
                }, "init" === b ? 100 : 0)) : (e.container.width(200 * (e.count + e.cloneCount) + "%"), e.setProps(c * e.computedW, "init"), setTimeout(function() {
                    e.doMath(), e.newSlides.css(e.vars.rtl && e.isFirefox ? {
                        width: e.computedW,
                        marginRight: e.computedM,
                        "float": "right",
                        display: "block"
                    } : {
                        width: e.computedW,
                        marginRight: e.computedM,
                        "float": "left",
                        display: "block"
                    }), e.vars.smoothHeight && q.smoothHeight()
                }, "init" === b ? 100 : 0))), n || e.slides.removeClass(g + "active-slide").eq(e.currentSlide).addClass(g + "active-slide"), e.vars.init(e)
            }, e.doMath = function() {
                var a = e.slides.first(),
                    b = e.vars.itemMargin,
                    c = e.vars.minItems,
                    d = e.vars.maxItems;
                e.w = void 0 === e.viewport ? e.width() : e.viewport.width(), e.isFirefox && (e.w = e.width()), e.h = a.height(), e.boxPadding = a.outerWidth() - a.width(), n ? (e.itemT = e.vars.itemWidth + b, e.itemM = b, e.minW = c ? c * e.itemT : e.w, e.maxW = d ? d * e.itemT - b : e.w, e.itemW = e.minW > e.w ? (e.w - b * (c - 1)) / c : e.maxW < e.w ? (e.w - b * (d - 1)) / d : e.vars.itemWidth > e.w ? e.w : e.vars.itemWidth, e.visible = Math.floor(e.w / e.itemW), e.move = 0 < e.vars.move && e.vars.move < e.visible ? e.vars.move : e.visible, e.pagingCount = Math.ceil((e.count - e.visible) / e.move + 1), e.last = e.pagingCount - 1, e.limit = 1 === e.pagingCount ? 0 : e.vars.itemWidth > e.w ? e.itemW * (e.count - 1) + b * (e.count - 1) : (e.itemW + b) * e.count - e.w - b) : (e.itemW = e.w, e.itemM = b, e.pagingCount = e.count, e.last = e.count - 1), e.computedW = e.itemW - e.boxPadding, e.computedM = e.itemM
            }, e.update = function(a, b) {
                e.doMath(), n || (a < e.currentSlide ? e.currentSlide += 1 : a <= e.currentSlide && 0 !== a && --e.currentSlide, e.animatingTo = e.currentSlide), e.vars.controlNav && !e.manualControls && ("add" === b && !n || e.pagingCount > e.controlNav.length ? q.controlNav.update("add") : ("remove" === b && !n || e.pagingCount < e.controlNav.length) && (n && e.currentSlide > e.last && (--e.currentSlide, --e.animatingTo), q.controlNav.update("remove", e.last))), e.vars.directionNav && q.directionNav.update()
            }, e.addSlide = function(b, c) {
                var d = a(b);
                e.count += 1, e.last = e.count - 1, l && m ? void 0 !== c ? e.slides.eq(e.count - c).after(d) : e.container.prepend(d) : void 0 !== c ? e.slides.eq(c).before(d) : e.container.append(d), e.update(c, "add"), e.slides = a(e.vars.selector + ":not(.clone)", e), e.setup(), e.vars.added(e)
            }, e.removeSlide = function(b) {
                var c = isNaN(b) ? e.slides.index(a(b)) : b;
                --e.count, e.last = e.count - 1, isNaN(b) ? a(b, e.slides).remove() : l && m ? e.slides.eq(e.last).remove() : e.slides.eq(b).remove(), e.doMath(), e.update(c, "remove"), e.slides = a(e.vars.selector + ":not(.clone)", e), e.setup(), e.vars.removed(e)
            }, q.init()
        }, a(window).blur(function() {
            b = !1
        }).focus(function() {
            b = !0
        }), a.flexslider.defaults = {
            namespace: "flex-",
            selector: ".slides > li",
            animation: "fade",
            easing: "swing",
            direction: "horizontal",
            reverse: !1,
            animationLoop: !0,
            smoothHeight: !1,
            startAt: 0,
            slideshow: !0,
            slideshowSpeed: 7e3,
            animationSpeed: 600,
            initDelay: 0,
            randomize: !1,
            fadeFirstSlide: !0,
            thumbCaptions: !1,
            pauseOnAction: !0,
            pauseOnHover: !1,
            pauseInvisible: !0,
            useCSS: !0,
            touch: !0,
            video: !1,
            controlNav: !0,
            directionNav: !0,
            prevText: "Previous",
            nextText: "Next",
            keyboard: !0,
            multipleKeyboard: !1,
            mousewheel: !1,
            pausePlay: !1,
            pauseText: "Pause",
            playText: "Play",
            controlsContainer: "",
            manualControls: "",
            customDirectionNav: "",
            sync: "",
            asNavFor: "",
            itemWidth: 0,
            itemMargin: 0,
            minItems: 1,
            maxItems: 0,
            move: 0,
            allowOneSlide: !0,
            isFirefox: !1,
            start: function() {},
            before: function() {},
            after: function() {},
            end: function() {},
            added: function() {},
            removed: function() {},
            init: function() {},
            rtl: !1
        }, a.fn.flexslider = function(b) {
            if (void 0 === b && (b = {}), "object" == typeof b) return this.each(function() {
                var c = a(this),
                    d = b.selector ? b.selector : ".slides > li",
                    e = c.find(d);
                1 === e.length && !1 === b.allowOneSlide || 0 === e.length ? (e.fadeIn(400), b.start && b.start(c)) : void 0 === c.data("flexslider") && new a.flexslider(this, b)
            });
            var c = a(this).data("flexslider");
            switch (b) {
                case "play":
                    c.play();
                    break;
                case "pause":
                    c.pause();
                    break;
                case "stop":
                    c.stop();
                    break;
                case "next":
                    c.flexAnimate(c.getTarget("next"), !0);
                    break;
                case "prev":
                case "previous":
                    c.flexAnimate(c.getTarget("prev"), !0);
                    break;
                default:
                    "number" == typeof b && c.flexAnimate(b, !0)
            }
        }
    }(jQuery);