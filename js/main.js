// FIX 2026-07-06:
// WordPress loads jQuery in noConflict mode.
// Owl Carousel is enqueued in functions.php as a dependency.
// This file only initializes the main slider when Owl is already available.
(function($) {
    if (!$) {
        return;
    }

    function initOwlSlider() {
        var $slider = $('.main-slider');

        if (!$slider.length) {
            return;
        }

        if (typeof $.fn.owlCarousel !== 'function') {
            if (window.console && console.warn) {
                console.warn('[STC main.js] Owl Carousel is not loaded');
            }
            return;
        }

        if ($slider.hasClass('owl-loaded')) {
            return;
        }

        try {
            $slider.owlCarousel({
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                items: 1,
                animateOut: 'fadeOut',
                margin: 0,
                loop: true,
                navRewind: true,
                nav: false,
                navText: [],
                dots: true
            });
        } catch (error) {
            if (window.console && console.error) {
                console.error('[STC main.js] Owl Carousel init error:', error);
            }
        }
    }

    // Основной код
    $(function() {
        initOwlSlider();

        $('#mob').on('click', function() {
            var el = $('.webazex-container');
            if (el.is(':visible')) {
                el.removeClass('show fadeInLeft');
                el.addClass('hide fadeInRight');
            } else {
                el.removeClass('hide fadeInRight');
                el.addClass('show fadeInLeft');
            }
        });

        if (window.screen && screen.width <= 768) {
            var $searchTrigger = $('.searchwp-modal-form-trigger-el.search');
            if ($searchTrigger.length) {
                var s = $searchTrigger.html();
                $searchTrigger.html('<span class="pc">' + s + '</span>');
            }
        }

        $('.litoul_div').on('click', function(e) {
            e.preventDefault();

            var $this = $(this);

            if ($this.next().hasClass('menu_pod2_active')) {
                $this.next().removeClass('menu_pod2_active');
                $this.next().slideUp(550);
            } else {
                $this.parent().parent().find('li .menu_pod2').removeClass('menu_pod2_active');
                $this.parent().parent().find('li .menu_pod2').slideUp(350);
                $this.next().toggleClass('menu_pod2_active');
                $this.next().slideToggle(550);
            }

            if ($('.menu_pod2').hasClass('menu_pod2_active')) {
                $('.cb_cat_1').addClass('cb_cat_1_act');
                $('.cb_cat_0').addClass('cb_cat_0_act');
                $('.left-ul2').addClass('left_menu');
                $('.menu-container').addClass('menu_container_act');
            }
        });

        $('.cb_cat_1').on('click', function(event) {
            event.preventDefault();
            $('.cb_cat_1').removeClass('cb_cat_1_act');
            $('.cb_cat_0').removeClass('cb_cat_0_act');
            $('.left-ul2').removeClass('left_menu');
            $('.menu-container').removeClass('menu_container_act');
            $('.litoul_div').parent().parent().find('li .menu_pod2').removeClass('menu_pod2_active');
        });

        $('.category_menu_btn').on('click', function(event) {
            event.preventDefault();
            $('.navmenu-mobile-list-item').toggleClass('active');
        });

        $('.category_menu_btn, .mobmenugo .burger.icon-bars, .burger').on('click', function(e) {
            e.preventDefault();
            $('body').toggleClass('active_body');
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var videoPlayButton = document.querySelector('.rutube-video-play-button');
        var rutubePlayer = document.getElementById('rutube-video-content');
        var rutubePlayerOverlay = document.querySelector('.rutube-video-overlay');
        var videoPlayButtonWrapper = document.querySelector('.rutube-video-play-button-wrapper');

        if (!videoPlayButton || !rutubePlayer || !rutubePlayer.contentWindow) {
            return;
        }

        videoPlayButton.onclick = function() {
            if (rutubePlayerOverlay) {
                rutubePlayerOverlay.style.display = 'none';
            }

            if (videoPlayButtonWrapper) {
                videoPlayButtonWrapper.style.display = 'none';
            }

            rutubePlayer.contentWindow.postMessage(JSON.stringify({
                type: 'player:play',
                data: {}
            }), '*');

            rutubePlayer.contentWindow.postMessage(JSON.stringify({
                type: 'player:unMute'
            }), '*');
        };
    });

})(window.jQuery);