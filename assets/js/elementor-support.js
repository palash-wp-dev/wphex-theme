(function($) {
    "use strict";

    $(document).ready(function() {

        function WPHex_Slick_Slider($scope, $) {
            var globalSlickInit = $scope.find('.global-slick-init');
            if (globalSlickInit.length > 0) {
                //todo have to check slider item
                $.each(globalSlickInit, function (index, value) {
                    if ($(this).children('div').length > 1) {
                        //todo configure slider settings object
                        var sliderSettings = {};
                        var allData = $(this).data();
                        var infinite = typeof allData.infinite == 'undefined' ? false : allData.infinite;
                        var arrows = typeof allData.arrows == 'undefined' ? false : allData.arrows;
                        var autoplay = typeof allData.autoplay == 'undefined' ? false : allData.autoplay;
                        var focusOnSelect = typeof allData.focusonselect == 'undefined' ? false : allData.focusonselect;
                        var swipeToSlide = typeof allData.swipetoslide == 'undefined' ? false : allData.swipetoslide;
                        var slidesToShow = typeof allData.slidestoshow == 'undefined' ? 1 : allData.slidestoshow;
                        var slidesToScroll = typeof allData.slidestoscroll == 'undefined' ? 1 : allData.slidestoscroll;
                        var speed = typeof allData.speed == 'undefined' ? '500' : allData.speed;
                        var dots = typeof allData.dots == 'undefined' ? false : allData.dots;
                        var cssEase = typeof allData.cssease == 'undefined' ? 'linear' : allData.cssease;
                        var prevArrow = typeof allData.prevarrow == 'undefined' ? '' : allData.prevarrow;
                        var nextArrow = typeof allData.nextarrow == 'undefined' ? '' : allData.nextarrow;
                        var centerMode = typeof allData.centermode == 'undefined' ? false : allData.centermode;
                        var centerPadding = typeof allData.centerpadding == 'undefined' ? false : allData.centerpadding;
                        var rows = typeof allData.rows == 'undefined' ? 1 : parseInt(allData.rows);
                        var autoplay = typeof allData.autoplay == 'undefined' ? false : allData.autoplay;
                        var autoplaySpeed = typeof allData.autoplayspeed == 'undefined' ? 2000 : parseInt(allData.autoplayspeed);
                        var lazyLoad = typeof allData.lazyload == 'undefined' ? false : allData.lazyload; // have to remove it from settings object if it undefined
                        var appendDots = typeof allData.appenddots == 'undefined' ? false : allData.appenddots;
                        var appendArrows = typeof allData.appendarrows == 'undefined' ? false : allData.appendarrows;
                        var asNavFor = typeof allData.asnavfor == 'undefined' ? false : allData.asnavfor;
                        var verticalSwiping = typeof allData.verticalswiping == 'undefined' ? false : allData.verticalswiping;
                        var vertical = typeof allData.vertical == 'undefined' ? false : allData.vertical;
                        var fade = typeof allData.fade == 'undefined' ? false : allData.fade;
                        var rtl = typeof allData.rtl == 'undefined' ? false : allData.rtl;
                        var responsive = typeof $(this).data('responsive') == 'undefined' ? false : $(this).data('responsive');
                        //slider settings object setup
                        sliderSettings.infinite = infinite;
                        sliderSettings.arrows = arrows;
                        sliderSettings.autoplay = autoplay;
                        sliderSettings.focusOnSelect = focusOnSelect;
                        sliderSettings.swipeToSlide = swipeToSlide;
                        sliderSettings.slidesToShow = slidesToShow;
                        sliderSettings.slidesToScroll = slidesToScroll;
                        sliderSettings.speed = speed;
                        sliderSettings.dots = dots;
                        sliderSettings.cssEase = cssEase;
                        sliderSettings.prevArrow = prevArrow;
                        sliderSettings.nextArrow = nextArrow;
                        sliderSettings.rows = rows;
                        sliderSettings.autoplaySpeed = autoplaySpeed;
                        sliderSettings.autoplay = autoplay;
                        sliderSettings.verticalSwiping = verticalSwiping;
                        sliderSettings.vertical = vertical;
                        sliderSettings.rtl = rtl;
                        if (centerMode != false) {
                            sliderSettings.centerMode = centerMode;
                        }
                        if (centerPadding != false) {
                            sliderSettings.centerPadding = centerPadding;
                        }
                        if (lazyLoad != false) {
                            sliderSettings.lazyLoad = lazyLoad;
                        }
                        if (appendDots != false) {
                            sliderSettings.appendDots = appendDots;
                        }
                        if (appendArrows != false) {
                            sliderSettings.appendArrows = appendArrows;
                        }
                        if (asNavFor != false) {
                            sliderSettings.asNavFor = asNavFor;
                        }
                        if (fade != false) {
                            sliderSettings.fade = fade;
                        }
                        if (responsive != false) {
                            sliderSettings.responsive = responsive;
                        }
                        $(this).slick(sliderSettings);
                    }
                });
            }
        }

        /*
        ========================================
            counter Odometer
        ========================================
        */
        function WPHex_CounterUp($scope, $) {
            $scope.find(".single_counter__count").each(function () {
                $(this).isInViewport(function (status) {
                    if (status === "entered") {
                        for (var i = 0; i < document.querySelectorAll(".odometer").length; i++) {
                            var el = document.querySelectorAll('.odometer')[i];
                            el.innerHTML = el.getAttribute("data-odometer-final");
                        }
                    }
                });
            });
        }

        let elementJSCallback = {
            'wphex-counterup-two-widget.default': WPHex_CounterUp,
            'wphex-latest-product-one-widget.default': WPHex_CounterUp,
        }
        $(window).on('elementor/frontend/init', function () {
            let $EF = elementorFrontend;
            $.each(elementJSCallback, function (widgetName, fuHandler) {
                $EF.hooks.addAction('frontend/element_ready/' + widgetName, fuHandler);
            })
        });
    });

})(jQuery);