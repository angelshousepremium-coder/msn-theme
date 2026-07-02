// FIX 2026-06-27: WordPress loads jQuery in noConflict mode.
// The theme used a manually injected jQuery in header.php before; after removing it,
// global `$` may be undefined and Owl Carousel init fails, leaving .owl-carousel hidden.
// Keep all old logic, but pass WordPress jQuery as `$` safely.
(function($) {
    if (!$) {
        return;
    }

    // Функция для принудительной загрузки и инициализации Owl Carousel
    function loadAndInitOwlCarousel() {
        const $slider = $(".main-slider");

        // Если слайдера нет на странице - выходим
        if ($slider.length === 0) {
            return;
        }

        // Если Owl Carousel уже загружен - инициализируем сразу
        if (typeof $.fn.owlCarousel === 'function') {
            initOwlSlider($slider);
            return;
        }

        // Если не загружен - загружаем принудительно
        // Удаляем старые скрипты Owl Carousel
        $('script[src*="owl.carousel"]').remove();

        // Загружаем CSS если еще не загружен
        if (!$('link[href*="owl.carousel"]').length) {
            $('head').append('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">');
            $('head').append('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">');
        }

        // Создаем и загружаем скрипт
        var owlScript = document.createElement('script');
        owlScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js';
        owlScript.integrity = 'sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==';
        owlScript.crossOrigin = 'anonymous';

        owlScript.onload = function() {
            setTimeout(function() {
                initOwlSlider($slider);
            }, 100);
        };

        document.head.appendChild(owlScript);
    }

    // Функция инициализации слайдера
    function initOwlSlider($slider) {
        if (typeof $.fn.owlCarousel !== 'function') {
            return;
        }

        try {
            $slider.owlCarousel({
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                items: 1,
                animateOut: "fadeOut",
                margin: 0,
                loop: true,
                navRewind: true,
                nav: false,
                navText: [],
                dots: true,
            });
        } catch (error) {
            console.error('Ошибка при инициализации Owl Carousel:', error);
        }
    }

    // Основной код
    jQuery(function($) {
        // Запускаем загрузку и инициализацию Owl Carousel
        setTimeout(loadAndInitOwlCarousel, 100);

        $('#mob').on('click', function() {
            let el = $('.webazex-container');
            if (el.is(':visible')) {
                el.removeClass('show fadeInLeft');
                el.addClass('hide fadeInRight');
            } else {
                el.removeClass('hide fadeInRight');
                el.addClass('show fadeInLeft');
            }
        });

        if (screen.width <= 768) {
            let s = $('.searchwp-modal-form-trigger-el.search').html();
            $('.searchwp-modal-form-trigger-el.search').html('<span class="pc">' + s + '</span>');
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

    document.addEventListener("DOMContentLoaded", () => {
        const videoPlayButton = document.querySelector('.rutube-video-play-button'),
              rutubePlayer = document.getElementById('rutube-video-content'),
              rutubePlayerOverlay = document.querySelector('.rutube-video-overlay'), 
              videoPlayButtonWrapper = document.querySelector('.rutube-video-play-button-wrapper');

        if (videoPlayButton) videoPlayButton.onclick = function() {
            rutubePlayerOverlay.style.display = 'none'; 
            videoPlayButtonWrapper.style.display = 'none';

            rutubePlayer.contentWindow.postMessage(JSON.stringify(
                {
                    type: 'player:play',
                    data: {}
                }
            ), '*');	

            rutubePlayer.contentWindow.postMessage(JSON.stringify(
                {
                    type: 'player:unMute'
                }
            ), '*');
        };
    });

})(window.jQuery);
