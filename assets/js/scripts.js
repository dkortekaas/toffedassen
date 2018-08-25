(function ($) {
    'use strict';

    var supro = supro || {};
    supro.init = function () {
        supro.$body = $(document.body),
            supro.$window = $(window),
            supro.$header = $('#masthead'),
            supro.ajaxXHR = null;


        // Scroll
        this.scrollTop();
        this.preload();

        // Parallax
        this.parallax();
        this.suproToggleClass();
        this.photoSwipe();

        // Header
        this.canvasPanel();
        this.menuSideBar();
        this.instanceSearch();
        this.toggleModal();
        this.stickyHeader();
        this.menuHover();

        // Blog
        this.blogLayout();

        // Shop
        this.shopView();
        this.shopLoadingAjax();
        this.viewPort();
        this.showFilterContent();
        this.filterAjax();
        this.productQuantity();
        this.addWishlist();
        this.showAddedToCartNotice();
        this.tooltip();
        this.productQuickView();
        this.productAttribute();

        // Single Product
        this.resizeProductGallery();
        this.productThumbnail();
        this.productGalleryCarousel();
        this.productvariation();
        this.singleProductCarousel();
        this.productImagesLightbox();
        this.stickyProductSummary();
        this.loginTab();
        this.addToCartAjax();

        // Portfolio
        this.portfolioMasonry();
        this.portfolioLoadingAjax();
        this.portfolioCarousel();
    };

    supro.suproToggleClass = function () {
        supro.$window.on('resize', function () {
            var wWidth = $('#content').width(),
                space = 0;

            if (supro.$window.width() <= 1600) {
                $('.menu-extra li.menu-item-search').removeAttr('id');
            }

            if (wWidth > 1170) {
                space = (wWidth - 1170) / 2;
            }

            $('.supro-right-offset').css({
                'margin-right': space * -1
            });

            $('.portfolio-carousel .swiper-container').css({
                'margin-right': space * -1,
                'margin-left': space * -1,
                'padding-right': space,
                'padding-left': space
            });

            $('.portfolio-carousel .swiper-button-prev').css({
                'left': space - 62
            });

            $('.portfolio-carousel .swiper-button-next').css({
                'right': space - 62
            });

        }).trigger('resize');
    };

    supro.resizeProductGallery = function () {

        if (!supro.$body.hasClass('single-product-layout-6')) {
            return;
        }

        if (supro.$window.width() <= 991) {
            return;
        }

        supro.$window.on('resize', function () {
            var wWidth = $('#content').width(),
                wRight = 0;

            if (wWidth > 1170) {
                wRight = (wWidth - 1170) / 2;
            }

            $('.supro-single-product-detail').find('.woocommerce-product-gallery').css({
                'margin-right': wRight * -1
            });


        }).trigger('resize');
    };

    // Scroll Top
    supro.scrollTop = function () {
        var $scrollTop = $('#scroll-top');
        supro.$window.scroll(function () {
            if (supro.$window.scrollTop() > supro.$window.height()) {
                $scrollTop.addClass('show-scroll');
            } else {
                $scrollTop.removeClass('show-scroll');
            }
        });

        // Scroll effect button top
        $scrollTop.on('click', function (event) {
            event.preventDefault();
            $('html, body').stop().animate({
                    scrollTop: 0
                },
                800
            );
        });
    };

    /**
     * Add page preloader
     */
    supro.preload = function () {
        var $preloader = $('#preloader'),
            without_link = false;

        if (!$preloader.length) {
            return;
        }

        supro.$body.on('click', 'a', function () {
            without_link = false;
            if ($(this).hasClass('sp-without-preloader')) {
                without_link = true;
            }
        });

        supro.$window.on('beforeunload', function (e) {
            if (without_link) {
                return;
            }
            $preloader.removeClass('out').fadeIn(500, function () {
                $preloader.addClass('loading');
            });
        });

        supro.$window.on('pageshow', function () {
            $preloader.fadeOut(100, function () {
                $preloader.addClass('out loading');
            });
        });

        supro.$window.on('beforeunload', function () {
            $preloader.fadeIn('slow');
        });

        NProgress.start();
        supro.$window.on('load', function () {
            NProgress.done();
            $preloader.fadeOut(800);
        });
    };

    // Parallax
    supro.parallax = function () {
        if (supro.$window.width() < 1200) {
            return;
        }

        $('.page-header.parallax .feature-image').parallax('50%', 0.6);
        $('.supro-sale-product.parallax').parallax('50%', 0.6);
    };

    // photoSwipe
    supro.photoSwipe = function () {
        var $images = $('.supro-photo-swipe');

        if (!$images.length) {
            return;
        }

        var $links = $images.find('a.photoswipe'),
            items = [];

        $links.each(function () {
            var $this = $(this),
                $w = $this.attr('data-width'),
                $h = $this.attr('data-height');

            items.push({
                src: $this.attr('href'),
                w: $w,
                h: $h
            });

        });

        $images.on('click', 'a.photoswipe', function (e) {
            e.preventDefault();

            var index = $links.index($(this)),
                options = {
                    index: index,
                    bgOpacity: 0.85,
                    showHideOpacity: true,
                    mainClass: 'pswp--minimal-dark',
                    barsSize: {top: 0, bottom: 0},
                    captionEl: false,
                    fullscreenEl: false,
                    shareEl: false,
                    tapToClose: true,
                    tapToToggleControls: false
                };

            var lightBox = new PhotoSwipe(document.getElementById('pswp'), window.PhotoSwipeUI_Default, items, options);
            lightBox.init();
        });
    };

    // Off Canvas Panel
    supro.canvasPanel = function () {
        /**
         * Off canvas cart toggle
         */
        supro.$header.on('click', '.cart-contents', function (e) {
            e.preventDefault();
            supro.openCanvasPanel($('#cart-panel'));
        });

        if (toffedassenData.open_cart_mini == '1') {
            $(document.body).on('added_to_cart', function () {
                supro.openCanvasPanel($('#cart-panel'));
            });
        }

        supro.$header.on('click', '#icon-menu-sidebar', function (e) {
            e.preventDefault();
            supro.openCanvasPanel($('#menu-sidebar-panel'));
        });

        supro.$header.on('click', '#icon-menu-mobile', function (e) {
            e.preventDefault();
            supro.openCanvasPanel($('#menu-sidebar-panel'));
        });

        supro.$body.on('click', '#off-canvas-layer, .close-canvas-panel', function (e) {
            e.preventDefault();
            supro.closeCanvasPanel();
        });

    };

    supro.openCanvasPanel = function ($panel) {
        supro.$body.addClass('open-canvas-panel');
        $panel.addClass('open');
    };

    supro.closeCanvasPanel = function () {
        supro.$body.removeClass('open-canvas-panel');
        $('.supro-off-canvas-panel, #primary-mobile-nav, .catalog-sidebar, .woocommerce-products-header').removeClass('open');
    };

    // Toggle Menu Sidebar
    supro.menuSideBar = function () {
        $('#menu-sidebar-panel').find('.menu .menu-item-has-children > a').prepend('<span class="toggle-menu-children"><i class="icon-plus"></i> </span>');
        $('#menu-sidebar-panel').find('li.menu-item-has-children > a').on('click', function (e) {
            e.preventDefault();

            $(this).closest('li').siblings().find('ul.sub-menu, ul.dropdown-submenu').slideUp();
            $(this).closest('li').siblings().removeClass('active');

            $(this).closest('li').children('ul.sub-menu, ul.dropdown-submenu').slideToggle();
            $(this).closest('li').toggleClass('active');

        });
    };

    /**
     * Product instance search
     */
    supro.instanceSearch = function () {

        if (toffedassenData.ajax_search === '0') {
            return;
        }

        var xhr = null,
            searchCache = {},
            $modal = $('.search-modal'),
            $form = $modal.find('form'),
            $search = $form.find('input.search-field'),
            $results = $modal.find('.search-results');

        $modal.on('keyup', '.search-field', function (e) {
            var valid = false;

            if (typeof e.which == 'undefined') {
                valid = true;
            } else if (typeof e.which == 'number' && e.which > 0) {
                valid = !e.ctrlKey && !e.metaKey && !e.altKey;
            }

            if (!valid) {
                return;
            }

            if (xhr) {
                xhr.abort();
            }

            search();
        }).on('change', '.product-cats input', function () {
            if (xhr) {
                xhr.abort();
            }

            search();
        }).on('focusout', '.search-field', function () {
            if ($search.val().length < 2) {
                $modal.removeClass('searching searched actived found-products found-no-product invalid-length');
            }
        });

        outSearch();

        /**
         * Private function for search
         */
        function search() {
            var keyword = $search.val(),
                cat = '';

            if ($modal.find('.product-cats').length > 0) {
                cat = $modal.find('.product-cats input:checked').val();
            }

            if (keyword.length < 2) {
                $modal.removeClass('searching searched actived found-products found-no-product').addClass('invalid-length');
                return;
            }

            $modal.removeClass('found-products found-no-product').addClass('searching');

            var keycat = keyword + cat;

            if (keycat in searchCache) {
                var result = searchCache[keycat];

                $modal.removeClass('searching');

                $modal.addClass('found-products');

                $results.find('.woocommerce').html(result.products);

                $(document.body).trigger('supro_ajax_search_request_success', [$results]);

                $results.find('.woocommerce, .buttons').slideDown(function () {
                    $modal.removeClass('invalid-length');
                });

                $modal.addClass('searched actived');
            } else {
                xhr = $.ajax({
                    url: toffedassenData.ajax_url,
                    dataType: 'json',
                    method: 'post',
                    data: {
                        action: 'supro_search_products',
                        nonce: toffedassenData.nonce,
                        term: keyword,
                        cat: cat,
                        search_type: toffedassenData.search_content_type
                    },
                    success: function (response) {
                        var $products = response.data;

                        $modal.removeClass('searching');

                        $modal.addClass('found-products');

                        $results.find('.woocommerce').html($products);

                        $results.find('.woocommerce, .buttons').slideDown(function () {
                            $modal.removeClass('invalid-length');
                        });

                        $(document.body).trigger('supro_ajax_search_request_success', [$results]);

                        // Cache
                        searchCache[keycat] = {
                            found: true,
                            products: $products
                        };

                        $modal.addClass('searched actived');
                    }
                });
            }

        }

        /**
         * Private function for click out search
         */
        function outSearch() {

            if (supro.$body.hasClass('header-layout-3') || supro.$body.hasClass('header-layout-5')) {
                return;
            }

            var $modal = $('.search-modal'),
                $search = $modal.find('input.search-field');
            if ($modal.length <= 0) {
                return;
            }

            supro.$window.on('scroll', function () {
                if (supro.$window.scrollTop() > 10) {
                    $modal.removeClass('show found-products searched');
                }
            });

            $(document).on('click', function (e) {
                var target = e.target;
                if (!$(target).closest('.extra-menu-item').hasClass('menu-item-search')) {
                    $modal.removeClass('searching searched found-products found-no-product invalid-length');
                }
            });

            $modal.on('click', '.t-icon', function (e) {
                if ($modal.hasClass('actived')) {
                    e.preventDefault();
                    $search.val('');
                    $modal.removeClass('searching searched actived found-products found-no-product invalid-length');
                }

            });
        }
    };

    /**
     *  Toggle modal
     */
    supro.toggleModal = function () {
        supro.$body.on('click', '.menu-extra-search', function (e) {
            e.preventDefault();
            supro.openModal($('.search-modal'));
            $(this).addClass('show');

        });

        supro.$body.on('click', '#supro-newsletter-icon', function (e) {
            e.preventDefault();
            supro.openModal($('#footer-newsletter-modal'));
            $(this).addClass('hide');
        });

        supro.$body.on('click', '#menu-extra-login', function (e) {
            e.preventDefault();

            supro.openModal($('#login-modal'));
            $(this).addClass('show');
        });

        supro.$body.on('click', '.close-modal', function (e) {
            e.preventDefault();
            supro.closeModal();
        });
    };

    /**
     * Main navigation sub-menu hover
     */
    supro.menuHover = function () {

        var animations = {
            none: ['show', 'hide'],
            fade: ['fadeIn', 'fadeOut'],
            slide: ['slideDown', 'slideUp']
        };

        var animation = toffedassenData.menu_animation ? animations[toffedassenData.menu_animation] : 'fade';

        $('.primary-nav li, .menu-extra li.menu-item-account').on('mouseenter', function () {
            $(this).addClass('active').children('.dropdown-submenu').stop(true, true)[animation[0]]();
        }).on('mouseleave', function () {
            $(this).removeClass('active').children('.dropdown-submenu').stop(true, true)[animation[1]]();
        });
    };

    // Sticky Header
    supro.stickyHeader = function () {

        if (!supro.$body.hasClass('header-sticky')) {
            return;
        }

        if (supro.$body.hasClass('header-left-sidebar')) {
            return;
        }

        if (supro.$body.hasClass('page-template-template-coming-soon-page')) {
            return;
        }

        supro.$window.on('scroll', function () {
            var scrollTop = 20;

            if (supro.$window.scrollTop() > scrollTop) {
                supro.$header.addClass('minimized');
            } else {
                supro.$header.removeClass('minimized');
            }
        });
        supro.$window.on('resize', function () {
            var hHeader = supro.$header.outerHeight(true),
                $h = $('#su-header-minimized');

            if (!supro.$body.hasClass('header-transparent')) {
                $h.height(hHeader);
            }
        }).trigger('resize');
    };

    /**
     * Open modal
     *
     * @param $modal
     * @param tab
     */
    supro.openModal = function ($modal) {
        supro.$body.addClass('modal-open');
        $modal.fadeIn();
        $modal.addClass('open');
    };

    /**
     * Close modal
     */
    supro.closeModal = function () {
        supro.$body.removeClass('modal-open');
        $('.supro-modal').fadeOut(function () {
            supro.$body.find('.menu-extra-search, #menu-extra-login').removeClass('show');
            $('#supro-newsletter-icon').removeClass('hide');
            $(this).removeClass('open');
        });
    };

    // Blog isotope
    supro.blogLayout = function () {

        if (!supro.$body.hasClass('blog-masonry')) {
            return;
        }

        var $blogList = supro.$body.find('.supro-post-list');

        $blogList.imagesLoaded(function () {
            $blogList.isotope({
                itemSelector: '.blog-wrapper',
                percentPosition: true,
                masonry: {
                    columnWidth: '.blog-masonry-sizer',
                    gutter: '.blog-gutter-sizer'
                }
            });

        });
    };

    /**
     * Shop
     */
    // Show Filter widget
    supro.showFilterContent = function () {
        var $shopTopbar = $('#un-shop-topbar');

        supro.$window.on('resize', function () {
            $shopTopbar.find('.widget-title').next().removeAttr('style');
        }).trigger('resize');

        if (supro.$body.hasClass('filter-mobile-enable') && supro.$window.width() < 1200) {
            supro.$body.find('.shop-toolbar #supro-catalog-filter-mobile').on('click', 'a', function (e) {
                e.preventDefault();
                $(this).toggleClass('active');
                supro.$body.toggleClass('show-filters-content-mobile open-canvas-panel');

                if (supro.$body.hasClass('full-content')) {
                    $('.woocommerce-products-header').addClass('open');
                } else {
                    $('.catalog-sidebar').addClass('open');
                }
            });

        } else {
            supro.$body.find('.shop-toolbar #supro-catalog-filter').on('click', 'a', function (e) {
                e.preventDefault();
                $(this).toggleClass('active');
                $shopTopbar.slideToggle();
                $shopTopbar.toggleClass('active');
                supro.$body.toggleClass('show-filters-content');
            });
        }
    };

    // Filter Ajax
    supro.filterAjax = function () {

        if (!supro.$body.hasClass('catalog-ajax-filter')) {
            return;
        }

        supro.$body.on('price_slider_change', function (event, ui) {
            var form = $('.price_slider').closest('form').get(0),
                $form = $(form),
                url = $form.attr('action') + '?' + $form.serialize();

            $(document.body).trigger('supro_catelog_filter_ajax', url, $(this));
        });


        supro.$body.on('click', '#remove-filter-actived', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $(document.body).trigger('supro_catelog_filter_ajax', url, $(this));
        });

        supro.$body.find('#supro-shop-toolbar').find('.woocommerce-ordering').on('click', 'a', function (e) {
            e.preventDefault();
            $(this).addClass('active');
            var url = $(this).attr('href');
            $(document.body).trigger('supro_catelog_filter_ajax', url, $(this));
        });

        supro.$body.find('#un-shop-topbar, .catalog-sidebar').on('click', 'a', function (e) {
            var $widget = $(this).closest('.widget');
            if ($widget.hasClass('widget_product_tag_cloud') ||
                $widget.hasClass('widget_product_categories') ||
                $widget.hasClass('widget_layered_nav_filters') ||
                $widget.hasClass('widget_layered_nav') ||
                $widget.hasClass('product-sort-by') ||
                $widget.hasClass('supro-price-filter-list')) {
                e.preventDefault();
                $(this).closest('li').addClass('chosen');
                var url = $(this).attr('href');
                $(document.body).trigger('supro_catelog_filter_ajax', url, $(this));
            }

            if ($widget.hasClass('widget_product_tag_cloud')) {
                $(this).addClass('selected');
            }

            if ($widget.hasClass('product-sort-by')) {
                $(this).addClass('active');
            }
        });

        supro.$body.on('supro_catelog_filter_ajax', function (e, url, element) {

            var $container = $('#supro-shop-content'),
                $container_nav = $('#primary-sidebar'),
                $shopTopbar = $('#un-shop-topbar'),
                $shopToolbar = $('#supro-shop-toolbar'),
                $ordering = $('.shop-toolbar .woocommerce-ordering'),
                $found = $('.shop-toolbar .product-found'),
                $pageHeader = $('.page-header-catalog');

            if ($shopToolbar.length > 0) {
                var position = $shopToolbar.offset().top - 200;
                $('html, body').stop().animate({
                        scrollTop: position
                    },
                    1200
                );
            }

            $('.supro-catalog-loading').addClass('show');

            if ('?' == url.slice(-1)) {
                url = url.slice(0, -1);
            }

            url = url.replace(/%2C/g, ',');

            history.pushState(null, null, url);

            $(document.body).trigger('supro_ajax_filter_before_send_request', [url, element]);

            if (supro.ajaxXHR) {
                supro.ajaxXHR.abort();
            }

            supro.ajaxXHR = $.get(url, function (res) {

                var $sContent = $(res).find('#supro-shop-content').length > 0 ? $(res).find('#supro-shop-content').html() : '';
                $container.html($sContent);
                $container_nav.html($(res).find('#primary-sidebar').html());
                $shopTopbar.html($(res).find('#un-shop-topbar').html());

                if ($(res).find('.shop-toolbar .woocommerce-ordering').length > 0) {
                    $ordering.html($(res).find('.shop-toolbar .woocommerce-ordering').html());
                }

                $found.html($(res).find('.shop-toolbar .product-found').html());
                $pageHeader.html($(res).find('#page-header-catalog').html());

                supro.priceSlider();
                $('.supro-catalog-loading').removeClass('show');

                $(document.body).trigger('supro_ajax_filter_request_success', [res, url]);

            }, 'html');

            //$(document.body).on('supro_ajax_filter_before_send_request', function () {
            //    if ($('#un-shop-toolbar').hasClass('on-mobile') || $('#un-shop-topbar').hasClass('on-mobile')) {
            //        $('#un-categories-filter').slideUp();
            //        $('#un-shop-topbar').slideUp();
            //
            //        $('#un-toggle-cats-filter').removeClass('active');
            //        $('.un-filter').removeClass('active');
            //    }
            //});
        });
    };

    // Change product quantity

    supro.productQuantity = function () {
        supro.$body.on('click', '.quantity .increase, .quantity .decrease', function (e) {
            e.preventDefault();

            var $this = $(this),
                $qty = $this.siblings('.qty'),
                step = parseInt($qty.attr('step'), 10),
                current = parseInt($qty.val(), 10),
                min = parseInt($qty.attr('min'), 10),
                max = parseInt($qty.attr('max'), 10);

            min = min ? min : 1;
            max = max ? max : current + 1;

            if ($this.hasClass('decrease') && current > min) {
                $qty.val(current - step);
                $qty.trigger('change');
            }
            if ($this.hasClass('increase') && current < max) {
                $qty.val(current + step);
                $qty.trigger('change');
            }
        });
    };

    // Shop View

    supro.shopView = function () {
        $('#supro-shop-view').on('click', 'a', function (e) {
            e.preventDefault();
            var $el = $(this),
                view = $el.data('view');

            if ($el.hasClass('current')) {
                return;
            }

            $el.addClass('current').siblings().removeClass('current');
            supro.$body.removeClass('shop-view-grid shop-view-list').addClass('shop-view-' + view);

            document.cookie = 'shop_view=' + view + ';domain=' + window.location.host + ';path=/';
        });
    };

    // Loading Ajax
    supro.shopLoadingAjax = function () {

        // Shop Page
        supro.$body.on('click', '#supro-shop-infinite-loading a.next', function (e) {
            e.preventDefault();

            if ($(this).data('requestRunning')) {
                return;
            }

            $(this).data('requestRunning', true);

            var $products = $(this).closest('.woocommerce-pagination').prev('.products'),
                $pagination = $(this).closest('.woocommerce-pagination'),
                $parent = $(this).parents('#supro-shop-infinite-loading');

            $parent.addClass('loading');

            $.get(
                $(this).attr('href'),
                function (response) {
                    var content = $(response).find('ul.products').children('li.product'),
                        $pagination_html = $(response).find('.woocommerce-pagination').html();

                    $pagination.html($pagination_html);

                    for (var index = 0; index < content.length; index++) {
                        $(content[index]).css('animation-delay', index * 100 + 100 + 'ms');
                    }

                    content.addClass('suproFadeInUp suproAnimation');

                    $products.append(content);
                    $pagination.find('.page-numbers.next').data('requestRunning', false);
                    $parent.removeClass('loading');
                    supro.$body.trigger('supro_shop_ajax_loading_success');

                    if (!$pagination.find('li .page-numbers').hasClass('next')) {
                        $pagination.addClass('loaded');
                    }

                    supro.tooltip();
                }
            );
        });
    };

    supro.viewPort = function () {
        if ('infinite' !== toffedassenData.shop_nav_type) {
            return;
        }

        supro.$window.on('scroll', function () {
            if (supro.$body.find('#supro-shop-infinite-loading').is(':in-viewport')) {
                supro.$body.find('#supro-shop-infinite-loading a.next').click();
            }
        }).trigger('scroll');
    };

    /**
     * Show photoSwipe lightbox for product images
     */
    supro.productImagesLightbox = function () {
        var $images = $('.woocommerce-product-gallery');

        if (!$images.length) {
            return;
        }

        if ('no' == toffedassenData.product.lightbox) {
            $images.on('click', 'a.gallery-item-icon, a.video-item-icon', function () {
                return false;
            });
            return;
        }

        var $links = $images.find('.woocommerce-product-gallery__image');

        $images.on('click', 'a.gallery-item-icon', function (e) {
            e.preventDefault();

            var items = [];

            $links.each(function () {
                var $a = $(this).find('a');
                items.push({
                    src: $a.attr('href'),
                    w: $a.find('img').attr('data-large_image_width'),
                    h: $a.find('img').attr('data-large_image_height')
                });
            });

            var index = $images.find('.flex-active-slide').index();
            lightBox(index, items);
        });

        $images.on('click', 'a.video-item-icon', function (e) {
            e.preventDefault();

            var items = [],
                $el = $(this);

            items.push({
                html: $el.data('href')
            });

            var index = 0;
            lightBox(index, items);
        });

        $images.find('.woocommerce-product-gallery__image').on('click', 'a', function (e) {
            e.preventDefault();

            if (supro.$body.hasClass('single-product-layout-1') ||
                supro.$body.hasClass('single-product-layout-2')
            ) {
                return false;
            }

            var items = [];

            $links.each(function () {
                var $a = $(this).find('a');
                items.push({
                    src: $a.attr('href'),
                    w: $a.find('img').attr('data-large_image_width'),
                    h: $a.find('img').attr('data-large_image_height')
                });
            });

            var index = $links.index($(this).closest('.woocommerce-product-gallery__image'));
            lightBox(index, items);
        });


        function lightBox(index, items) {

            var options = {
                index: index,
                bgOpacity: 0.85,
                showHideOpacity: true,
                mainClass: 'pswp--minimal-dark',
                barsSize: {top: 0, bottom: 0},
                captionEl: false,
                fullscreenEl: false,
                shareEl: false,
                tapToClose: true,
                tapToToggleControls: false
            };

            var lightBox = new PhotoSwipe(document.getElementById('pswp'), window.PhotoSwipeUI_Default, items, options);
            lightBox.init();

            lightBox.listen('close', function () {
                $('#pswp .video-wrapper').find('iframe').each(function () {
                    $(this).attr('src', $(this).attr('src'));
                });

                $('#pswp .video-wrapper').find('video').each(function () {
                    $(this)[0].pause();
                });
            });
        }
    };

    /**
     * Make product summary be sticky when use product layout 1
     */
    supro.stickyProductSummary = function () {
        if ($.fn.stick_in_parent && supro.$window.width() > 767) {
            var $el = $('div.product .sticky-summary');

            $el.stick_in_parent({
                parent: '.supro-single-product-detail',
                offset_top: 30
            });
        }
    };

    /**
     * Change product quantity
     */
    supro.productThumbnail = function () {

        if (toffedassenData.product.thumb_slider != '1') {
            return;
        }

        var $gallery = $('.woocommerce-product-gallery');
        var $thumbnail = $gallery.find('.flex-control-thumbs');
        $gallery.imagesLoaded(function () {
            setTimeout(function () {
                if ($thumbnail.length < 1) {
                    return;
                }
                var columns = $gallery.data('columns');
                var count = $thumbnail.find('li').length;
                if (count > columns) {
                    if (toffedassenData.product.thumb_vertical == '1') {
                        var vertical = true;

                        if (supro.$window.width() <= 480) {
                            vertical = false
                        }

                        $thumbnail.not('.slick-initialized').slick({
                            slidesToShow: columns,
                            focusOnSelect: true,
                            slidesToScroll: 1,
                            vertical: vertical,
                            infinite: false,
                            prevArrow: '<span class="icon-chevron-up slick-prev-arrow"></span>',
                            nextArrow: '<span class="icon-chevron-down slick-next-arrow"></span>',
                            responsive: [
                                {
                                    breakpoint: 768,
                                    settings: {
                                        slidesToShow: 4
                                    }
                                },
                                {
                                    breakpoint: 480,
                                    settings: {
                                        slidesToShow: 3
                                    }
                                }
                            ]
                        });

                        $thumbnail.find('li.slick-current').trigger('click');
                    } else {
                        $thumbnail.not('.slick-initialized').slick({
                            slidesToShow: columns,
                            focusOnSelect: true,
                            slidesToScroll: 1,
                            infinite: false,
                            prevArrow: '<span class="icon-chevron-left slick-prev-arrow"></span>',
                            nextArrow: '<span class="icon-chevron-right slick-next-arrow"></span>'
                        });
                    }
                } else {
                    $thumbnail.addClass('no-slick');
                }

            }, 100);

        });

    };

    supro.productGalleryCarousel = function () {

        if (toffedassenData.product.gallery_carousel != '1') {
            return;
        }

        var $product = $('.woocommerce div.product'),
            $gallery = $('div.images', $product),
            $sliders = $('.woocommerce-product-gallery__wrapper', $gallery);

        // Show it

        $gallery.imagesLoaded(function () {

            var slidersOptions = {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                arrows: true,
                prevArrow: '<span class="icon-arrow-left slick-prev-arrow"></span>',
                nextArrow: '<span class="icon-arrow-right slick-next-arrow"></span>'
            };


            if ($product.hasClass('supro-product-layout-5')) {
                var start = $sliders.children().length > 2 ? 1 : 0;
                slidersOptions.centerMode = true;
                slidersOptions.initialSlide = start;
                slidersOptions.centerPadding = '26.8%';
                slidersOptions.appendArrows = $('.slick-arrow-wrapper');
                slidersOptions.responsive = [
                    {
                        breakpoint: 601,
                        settings: {
                            centerPadding: '0'
                        }
                    }
                ];
            }

            if ($product.hasClass('supro-product-layout-6')) {
                slidersOptions.prevArrow = '<span class="arrow_carrot-left slick-prev-arrow"></span>';
                slidersOptions.nextArrow = '<span class="arrow_carrot-right slick-next-arrow"></span>';
                slidersOptions.variableWidth = true;
                slidersOptions.slidesToShow = 2;
                slidersOptions.responsive = [
                    {
                        breakpoint: 1200,
                        settings: {
                            variableWidth: false
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ];
            }

            $sliders.not('.slick-initialized').slick(slidersOptions);

        });

    };

    supro.productvariation = function () {

        supro.$body.on('tawcvs_initialized', function () {
            $('.variations_form').unbind('tawcvs_no_matching_variations');
            $('.variations_form').on('tawcvs_no_matching_variations', function (event, $el) {
                event.preventDefault();

                $('.variations_form').find('.woocommerce-variation.single_variation').show();
                if (typeof wc_add_to_cart_variation_params !== 'undefined') {
                    $('.variations_form').find('.single_variation').slideDown(200).html('<p>' + wc_add_to_cart_variation_params.i18n_no_matching_variations_text + '</p>');
                }
            });

        });

        $('.variations_form td.value').on('change', 'select', function () {
            var value = $(this).find('option:selected').text();
            $(this).closest('tr').find('td.label .supro-attr-value').html(value);
        });

        $('.variations_form').find('td.value').each(function () {
            if (!$(this).find('.variation-selector').hasClass('hidden')) {
                $(this).addClass('show-select');
            } else {
                $(this).prev().addClass('show-label');
            }
        });
    };

    // Get price js slider
    supro.priceSlider = function () {
        // woocommerce_price_slider_params is required to continue, ensure the object exists
        if (typeof woocommerce_price_slider_params === 'undefined') {
            return false;
        }

        if ($('.catalog-sidebar').find('.widget_price_filter').length <= 0 && $('#un-shop-topbar').find('.widget_price_filter').length <= 0) {
            return false;
        }

        // Get markup ready for slider
        $('input#min_price, input#max_price').hide();
        $('.price_slider, .price_label').show();

        // Price slider uses jquery ui
        var min_price = $('.price_slider_amount #min_price').data('min'),
            max_price = $('.price_slider_amount #max_price').data('max'),
            current_min_price = parseInt(min_price, 10),
            current_max_price = parseInt(max_price, 10);

        if ($('.price_slider_amount #min_price').val() != '') {
            current_min_price = parseInt($('.price_slider_amount #min_price').val(), 10);
        }
        if ($('.price_slider_amount #max_price').val() != '') {
            current_max_price = parseInt($('.price_slider_amount #max_price').val(), 10);
        }

        $(document.body).bind('price_slider_create price_slider_slide', function (event, min, max) {
            if (woocommerce_price_slider_params.currency_pos === 'left') {

                $('.price_slider_amount span.from').html(woocommerce_price_slider_params.currency_symbol + min);
                $('.price_slider_amount span.to').html(woocommerce_price_slider_params.currency_symbol + max);

            } else if (woocommerce_price_slider_params.currency_pos === 'left_space') {

                $('.price_slider_amount span.from').html(woocommerce_price_slider_params.currency_symbol + ' ' + min);
                $('.price_slider_amount span.to').html(woocommerce_price_slider_params.currency_symbol + ' ' + max);

            } else if (woocommerce_price_slider_params.currency_pos === 'right') {

                $('.price_slider_amount span.from').html(min + woocommerce_price_slider_params.currency_symbol);
                $('.price_slider_amount span.to').html(max + woocommerce_price_slider_params.currency_symbol);

            } else if (woocommerce_price_slider_params.currency_pos === 'right_space') {

                $('.price_slider_amount span.from').html(min + ' ' + woocommerce_price_slider_params.currency_symbol);
                $('.price_slider_amount span.to').html(max + ' ' + woocommerce_price_slider_params.currency_symbol);

            }

            $(document.body).trigger('price_slider_updated', [min, max]);
        });
        if (typeof $.fn.slider !== 'undefined') {
            $('.price_slider').slider({
                range: true,
                animate: true,
                min: min_price,
                max: max_price,
                values: [current_min_price, current_max_price],
                create: function () {

                    $('.price_slider_amount #min_price').val(current_min_price);
                    $('.price_slider_amount #max_price').val(current_max_price);

                    $(document.body).trigger('price_slider_create', [current_min_price, current_max_price]);
                },
                slide: function (event, ui) {

                    $('input#min_price').val(ui.values[0]);
                    $('input#max_price').val(ui.values[1]);

                    $(document.body).trigger('price_slider_slide', [ui.values[0], ui.values[1]]);
                },
                change: function (event, ui) {

                    $(document.body).trigger('price_slider_change', [ui.values[0], ui.values[1]]);
                }
            });
        }
    };

    //related & upsell slider
    supro.singleProductCarousel = function () {

        if (!supro.$body.hasClass('single-product')) {
            return;
        }
        var $upsells = supro.$body.find('.up-sells'),
            $upsellsProduct = $upsells.find('ul.products'),
            upsellsProductColumns = $upsells.data('columns'),
            $related = supro.$body.find('.related.products'),
            $relatedProduct = $related.find('ul.products'),
            relatedProductColumns = $related.data('columns');

        // Product thumnails and featured image slider
        $upsellsProduct.not('.slick-initialized').slick({
            infinite: false,
            slidesToShow: upsellsProductColumns,
            slidesToScroll: 1,
            lazyLoad: 'ondemand',
            arrows: false,
            dots: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: parseInt(upsellsProductColumns) > 3 ? 3 : parseInt(upsellsProductColumns),
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: parseInt(upsellsProductColumns) > 2 ? 2 : parseInt(upsellsProductColumns),
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $relatedProduct.not('.slick-initialized').slick({
            infinite: false,
            slidesToShow: relatedProductColumns,
            slidesToScroll: 1,
            arrows: false,
            lazyLoad: 'ondemand',
            dots: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: parseInt(relatedProductColumns) > 3 ? 3 : parseInt(relatedProductColumns),
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: parseInt(relatedProductColumns) > 2 ? 2 : parseInt(relatedProductColumns),
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

    };

    supro.loginTab = function () {
        var $tabs = $('.supro-tabs'),
            $el = $tabs.find('.tabs-nav a'),
            $panels = $tabs.find('.tabs-panel');
        $el.on('click', function (e) {
            e.preventDefault();

            var $tab = $(this),
                index = $tab.parent().index();

            if ($tab.hasClass('active')) {
                return;
            }

            $tabs.find('.tabs-nav a').removeClass('active');
            $tab.addClass('active');
            $panels.removeClass('active');
            $panels.filter(':eq(' + index + ')').addClass('active');
        });
    };

    /**
     * Toggle product quick view
     */
    supro.productQuickView = function () {

        supro.$body.on('click', '.supro-product-quick-view', function (e) {
            e.preventDefault();
            var $a = $(this);

            var url = $a.attr('href'),
                $modal = $('#quick-view-modal'),
                $product = $modal.find('.product'),
                $product_sumary = $modal.find('.product-summary'),
                $product_images = $modal.find('.product-images-wrapper'),
                $button = $modal.find('.modal-header .close-modal').first().clone();

            $product.removeClass().addClass('invisible');
            $product_sumary.html('');
            $product_images.html('');
            $modal.addClass('loading');
            supro.openModal($modal);

            $.get(url, function (response) {
                var $html = $(response),
                    $response_summary = $html.find('#content').find('.entry-summary'),
                    $response_images = $html.find('#content').find('.product-images-wrapper'),
                    $product_thumbnails = $response_images.find('#product-thumbnails'),
                    $variations = $response_summary.find('.variations_form'),
                    productClasses = $html.find('.product').attr('class');

                // Remove unused elements
                $product_thumbnails.remove();
                $product.addClass(productClasses);
                $product_sumary.html($response_summary);
                $response_images.find('.woocommerce-product-gallery').removeAttr('style');
                $product_images.html($response_images);

                if ($product.find('.close-modal').length < 1) {
                    $product.show().prepend($button);
                }

                var $carousel = $product_images.find('.woocommerce-product-gallery__wrapper');

                $modal.removeClass('loading');
                $product.removeClass('invisible');

                $carousel.not('.slick-initialized').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: false,
                    prevArrow: '<span class="icon-chevron-left slick-prev-arrow"></span>',
                    nextArrow: '<span class="icon-chevron-right slick-next-arrow"></span>'
                });

                $carousel.imagesLoaded(function () {
                    //Force height for images
                    $carousel.addClass('loaded');
                });

                $carousel.find('.woocommerce-product-gallery__image').on('click', 'a', function (e) {
                    e.preventDefault();
                });

                if (typeof wc_add_to_cart_variation_params !== 'undefined') {
                    $variations.wc_variation_form();
                    $variations.find('.variations select').change();
                }

                if (typeof $.fn.tawcvs_variation_swatches_form !== 'undefined') {
                    $variations.tawcvs_variation_swatches_form();
                }

                supro.$body.on('tawcvs_initialized', function () {
                    $('.variations_form').unbind('tawcvs_no_matching_variations');
                    $('.variations_form').on('tawcvs_no_matching_variations', function (event, $el) {
                        event.preventDefault();
                        $el.addClass('selected');

                        $('.variations_form').find('.woocommerce-variation.single_variation').show();
                        if (typeof wc_add_to_cart_variation_params !== 'undefined') {
                            $('.variations_form').find('.single_variation').slideDown(200).html('<p>' + wc_add_to_cart_variation_params.i18n_no_matching_variations_text + '</p>');
                        }
                    });

                });

                supro.productvariation();

            }, 'html');

        });

        $('#quick-view-modal').on('click', function (e) {
            var target = e.target;
            if ($(target).closest('div.product').length <= 0) {
                supro.closeModal();
            }
        });
    };

    // add wishlist
    supro.addWishlist = function () {
        $('.yith-wcwl-add-to-wishlist .yith-wcwl-add-button').on('click', 'a', function () {
            $(this).addClass('loading');
        });

        supro.$body.on('added_to_wishlist', function () {
            $('.yith-wcwl-add-to-wishlist .yith-wcwl-add-button a').removeClass('loading');
        });
    };


    supro.showAddedToCartNotice = function () {

        $(document.body).on('added_to_cart', function (event, fragments, cart_hash, $thisbutton) {
            var product_title = $thisbutton.attr('data-title') + ' ' + toffedassenData.l10n.notice_text,
                $message = '';

            supro.addedToCartNotice($message, product_title, false, 'success');

        });
    };

    supro.addedToCartNotice = function ($message, $content, single, className) {
        if (toffedassenData.l10n.added_to_cart_notice != '1' || !$.fn.notify) {
            return;
        }

        $message += '<a href="' + toffedassenData.l10n.cart_link + '" class="btn-button">' + toffedassenData.l10n.cart_text + '</a>';

        if (single) {
            $message = '<div class="message-box">' + $message + '</div>';
        }

        $.notify.addStyle('supro', {
            html: '<div><i class="icon-checkmark-circle message-icon"></i><span data-notify-text/>' + $message + '<span class="close icon-cross2"></span> </div>'
        });
        $.notify($content, {
            autoHideDelay: toffedassenData.l10n.cart_notice_auto_hide,
            className: className,
            style: 'supro',
            showAnimation: 'fadeIn',
            hideAnimation: 'fadeOut'
        });
    };


    // Add to cart ajax
    supro.addToCartAjax = function () {

        if (toffedassenData.add_to_cart_ajax == '0') {
            return;
        }

        var found = false;
        supro.$body.on('click', '.single_add_to_cart_button', function (e) {
            var $el = $(this),
                $cartForm = $el.closest('form.cart'),
                $productWrapper = $el.closest('div.product');

            if ($productWrapper.hasClass('product-type-external')) {
                return;
            }

            if ($cartForm.length > 0) {
                e.preventDefault();
            } else {
                return;
            }

            if ($el.hasClass('disabled')) {
                return;
            }

            $el.addClass('loading');
            if (found) {
                return;
            }
            found = true;

            var formdata = $cartForm.serializeArray(),
                currentURL = window.location.href;

            if ($el.val() != '') {
                formdata.push({name: $el.attr('name'), value: $el.val()});
            }
            $.ajax({
                url: window.location.href,
                method: 'post',
                data: formdata,
                error: function () {
                    window.location = currentURL;
                },
                success: function (response) {
                    if (!response) {
                        window.location = currentURL;
                    }


                    if (typeof wc_add_to_cart_params !== 'undefined') {
                        if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
                            window.location = wc_add_to_cart_params.cart_url;
                            return;
                        }
                    }

                    $(document.body).trigger('updated_wc_div');

                    var $message = '',
                        className = 'success';
                    if ($(response).find('.woocommerce-message').length > 0) {
                        $message = $(response).find('.woocommerce-message').html();
                    }

                    if ($(response).find('.woocommerce-error').length > 0) {
                        $message = $(response).find('.woocommerce-error').html();
                        className = 'error';
                    }

                    if ($(response).find('.woocommerce-info').length > 0) {
                        $message = $(response).find('.woocommerce-info').html();
                    }

                    $el.removeClass('loading');

                    if ($message) {
                        supro.addedToCartNotice($message, ' ', true, className);
                    }

                    found = false;

                }
            });

        });

    };

    // Product Attribute
    supro.productAttribute = function () {
        supro.$body.on('click', '.un-swatch-variation-image', function (e) {
            e.preventDefault();
            $(this).siblings('.un-swatch-variation-image').removeClass('selected');
            $(this).addClass('selected');
            var imgSrc = $(this).data('src'),
                imgSrcSet = $(this).data('src-set'),
                $mainImages = $(this).parents('li.product').find('.un-product-thumbnail > a'),
                $image = $mainImages.find('img').first(),
                imgWidth = $image.first().width(),
                imgHeight = $image.first().height();

            $mainImages.addClass('image-loading');
            $mainImages.css({
                width: imgWidth,
                height: imgHeight,
                display: 'block'
            });

            $image.attr('src', imgSrc);

            if (imgSrcSet) {
                $image.attr('srcset', imgSrcSet);
            }

            $image.load(function () {
                $mainImages.removeClass('image-loading');
                $mainImages.removeAttr('style');
            });
        });
    };

    /**
     * Portfolio Masonry
     */
    supro.portfolioMasonry = function () {
        if (!supro.$body.hasClass('portfolio-masonry')) {
            return;
        }

        supro.$body.imagesLoaded(function () {
            supro.$body.find('.list-portfolio').isotope({
                itemSelector: '.portfolio-wrapper',
                layoutMode: 'masonry'
            });

        });
    };

    /**
     * Portfolio Ajax
     */
    supro.portfolioLoadingAjax = function () {

        if (!supro.$body.hasClass('supro-portfolio-page')) {
            return;
        }

        if (supro.$body.hasClass('portfolio-carousel')) {
            return;
        }

        $('.supro-portfolio-page').find('.numeric-navigation').on('click', '.page-numbers.next', function (e) {
            e.preventDefault();

            if ($(this).data('requestRunning')) {
                return;
            }

            $(this).data('requestRunning', true);

            $(this).addClass('loading');

            var $project = $(this).parents('.numeric-navigation').prev('.list-portfolio'),
                $pagination = $(this).parents('.numeric-navigation');

            $.get(
                $(this).attr('href'),
                function (response) {
                    var content = $(response).find('.list-portfolio').html(),
                        $pagination_html = $(response).find('.numeric-navigation').html();
                    var $content = $(content);

                    for (var index = 0; index < $content.length; index++) {
                        $($content[index]).css('animation-delay', index * 100 + 100 + 'ms');
                    }

                    $content.addClass('suproFadeIn suproAnimation');

                    $pagination.html($pagination_html);

                    if (supro.$body.hasClass('portfolio-masonry')) {
                        $content.imagesLoaded(function () {
                            $project.append($content).isotope('insert', $content);

                            $pagination.find('.page-numbers.next').removeClass('loading');
                            $pagination.find('.page-numbers.next').data('requestRunning', false);
                        });

                    } else {
                        $project.append($content);

                        $pagination.find('.page-numbers.next').removeClass('loading');
                        $pagination.find('.page-numbers.next').data('requestRunning', false);
                    }

                    if (!$pagination.find('.page-numbers').hasClass('next')) {
                        $pagination.addClass('loaded');
                    }
                }
            );
        });
    };

    /**
     * Portfolio Carousel
     */
    supro.portfolioCarousel = function () {
        if (!supro.$body.hasClass('supro-portfolio-page')) {
            return;
        }

        if (!supro.$body.hasClass('portfolio-carousel')) {
            return;
        }

        var $container = $('.swiper-container');

        if (!$container.length) {
            return;
        }

        var num = $('.list-portfolio .swiper-slide').length;

        var options = {
            loop: false,
            speed: 500,
            initialSlide: num > 0 ? 1 : 0,
            centeredSlides: true,
            spaceBetween: 100,
            scrollbar: {
                el: '.swiper-scrollbar',
                hide: false,
                draggable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            on: {
                init: function () {
                    $container.css('opacity', 1);
                }
            },
            breakpoints: {
                // when window width is <= 480px
                767: {
                    spaceBetween: 30
                },
                // when window width is <= 1199
                1199: {
                    spaceBetween: 60
                }
            }
        };

        var carousel = new Swiper($container, options);

        var xhr;

        carousel.on('reachEnd', function () {
            var $nav = $('.portfolio-carousel .paging-navigation');

            if (!$nav.length) {
                return;
            }

            if (xhr) {
                return;
            }

            var loadingHolder = document.createElement('div');

            $(loadingHolder)
                .addClass('swiper-slide loading-placeholder')
                .css({height: carousel.height - 121})
                .append('<span class="spinner icon_loading supro-spin su-icon"></span>');

            carousel.appendSlide(loadingHolder);
            carousel.update();

            xhr = $.get($nav.find('a').attr('href'), function (response) {
                var $content = $('.list-portfolio', response),
                    $portfolio = $content.children(),
                    $newNav = $('.portfolio-carousel .paging-navigation', $content);

                if ($newNav.length) {
                    $nav.find('a').replaceWith($('a', $newNav));
                } else {
                    $nav.fadeOut(function () {
                        $nav.remove();
                    });
                }

                $(loadingHolder).remove();
                $portfolio.css({opacity: 0});

                carousel.appendSlide($portfolio.addClass('swiper-slide').get());
                carousel.update();

                $portfolio.animate({opacity: 1});
                xhr = false;

                $(document.body).trigger('supro_portfolio_loaded', [$portfolio, true]);
            });
        });
    };

    /**
     * Init tooltip
     */
    supro.tooltip = function () {
        $('[data-rel=tooltip]').tooltip({offsetTop: -15});
    };

    /**
     * Document ready
     */
    $(function () {
        supro.init();
    });

    
})(jQuery);
