jQuery(function ($) {

    "use strict";

    //hafezkids Button Style
    function hafezkids_button_rect(svg) {
        if (svg) {
            var width = svg.outerWidth();
            var height = svg.outerHeight();
            var svgRect = svg.find('rect');
            var x_pos_rect = svgRect.attr('x');
            var y_pos_rect = svgRect.attr('y');

            if (x_pos_rect) width = width - (parseInt(x_pos_rect) * 2);
            if (y_pos_rect) height = height - (parseInt(y_pos_rect) * 2);

            if (width > 0 && height > 0) {
                svgRect.attr('width', width);
                svgRect.attr('height', height);
            }
        }
    }
    if ($('.hafezkids_dashed').length) {
        $('.hafezkids_dashed').each(function () {
            var svg = $(this);
            hafezkids_button_rect(svg);
        });
        $(window).resize(function () {
            $('.hafezkids_dashed').each(function () {
                var svg = $(this);
                hafezkids_button_rect(svg);
            });
        });
        $(window).load(function () {
            $('.hafezkids_dashed').each(function () {
                var svg = $(this);
                hafezkids_button_rect(svg);
            });
        });
    }

    //Preloader
    if ($('.hafezkids_preloader_content').length) {
        $(document).ready(function () {
            $('.hafezkids_preloader_content').fadeOut('1000', function () { $(this).remove(); });
        });
    }

    //Mobile Nav
    $('.open_mobile_nav').on('click', function () {
        $('.mobile_navigation').show(0);

        $('.close_mobile_nav').on('click', function () {
            $('.mobile_navigation').hide(0);
        });
        $(document).on('keyup', function (e) {
            if (e.keyCode == 27) {
                $('.mobile_navigation').hide(0);
            }
        });
    });

    if ($('.hafezkids_menu_mobile').length) {

        $('.hafezkids_menu_mobile li.menu-item-has-children > .open_current_dropdown').on('click', function (e) {
            e.preventDefault();
            $(this).parent('li').children('ul').toggle(0, function () { display: "toggle" }).parent('li').toggleClass("hafezkids_openned");
        });
    }

    //Move rocket on Screen top
    if ($('.hafezkids_top_screen').length) {
        $('.hafezkids_top_screen').on('mousemove', function (e) {
            var lFollowX = 0,
                lFollowY = 0;

            var min = 0;
            var max = 10;

            var lMouseX = Math.max(-100, Math.min(100, $(window).width() / 2 - e.clientX)),
                lMouseY = Math.max(-100, Math.min(100, $(window).height() / 2 - e.clientY));

            lFollowX = (15 * lMouseX) / 100;
            lFollowY = (12 * lMouseY) / 100;

            var translate = 'translateX(' + lFollowX + 'px) translateY(' + lFollowY + 'px)';

            $(this).find('.hafezkids_roket').css({
                '-webit-transform': translate,
                '-moz-transform': translate,
                'transform': translate
            });
        });
    }

    //hafezkids title animation
    if ($('.hafezkids_title').length) {
        $('.hafezkids_title').appear(function () {

            $(this).find('h2').each(function () {
                $(this).addClass('animated');
            });
        }, { accX: 0, accY: -200 });

    }


    //Display specific animation after preloaded end.
    $.event.special.destroyed = {
        remove: function (o) {
            if (o.handler) {
                o.handler()
            }
        }
    }
    $('.hafezkids_preloader_content').bind('destroyed', function () {

        $('.inner_header h1').each(function () {
            $(this).addClass('animated');
        });

        setTimeout(function () {
            $('.hafezkids_top_screen .left_content .subtitle').each(function () {
                $(this).addClass('animated');
            });
        }, 500);

        setTimeout(function () {
            $('.hafezkids_top_screen .left_content .top_screen_title').each(function () {
                $(this).addClass('animated');
            });
        }, 1000);

        setTimeout(function () {
            $('.hafezkids_top_screen .left_content .top_screen_description').each(function () {
                $(this).addClass('animated');
            });
        }, 1500);

        setTimeout(function () {
            $('.hafezkids_top_screen .left_content .hafezkids_button').each(function () {
                $(this).addClass('animated');
            });
        }, 2000);

        setTimeout(function () {
            $('.hafezkids_top_screen .hafezkids_roket').each(function () {
                $(this).addClass('animated');
            });
        }, 3000);
        setTimeout(function () {
            $('.hafezkids_top_screen .hafezkids_roket').each(function () {
                $(this).addClass('end_animation').removeClass('animated');
            });
        }, 4000);

    });

    if ($('.hafezkids_preloader_content').length == 0) {

        $('.inner_header h1').each(function () {
            $(this).addClass('animated');
        });

        setTimeout(function () {
            $('.hafezkids_top_screen .left_content .subtitle').each(function () {
                $(this).addClass('animated');
            });
        }, 500);

        setTimeout(function () {
            $('.hafezkids_top_screen .left_content .top_screen_title').each(function () {
                $(this).addClass('animated');
            });
        }, 1000);

        setTimeout(function () {
            $('.hafezkids_top_screen .left_content .top_screen_description').each(function () {
                $(this).addClass('animated');
            });
        }, 1500);

        setTimeout(function () {
            $('.hafezkids_top_screen .left_content .hafezkids_button').each(function () {
                $(this).addClass('animated');
            });
        }, 2000);

        setTimeout(function () {
            $('.hafezkids_top_screen .hafezkids_roket').each(function () {
                $(this).addClass('animated');
            });
        }, 3000);
        setTimeout(function () {
            $('.hafezkids_top_screen .hafezkids_roket').each(function () {
                $(this).addClass('end_animation').removeClass('animated');
            });
        }, 4000);

    }


    //Open Search Modal
    $('.search_openner').on('click', function (e) {
        e.preventDefault();

        $('.hafezkids_search_modal').show(500);

        $(document).on('keyup', function (e) {
            if (e.keyCode == 27) {
                $('.hafezkids_search_modal').hide(500);
            }
        });
    })

    //Scroll Top 
    if ($('.hafezkids_scroll_top').length) {
        var scroll_top_duration = 1300;
        $('.hafezkids_scroll_top').on('click', function (event) {
            event.preventDefault();
            $('body,html').animate({
                scrollTop: 0,
            }, scroll_top_duration
            );
        })
    }



    //Open video with venobox
    if ($('.venobox').length) {
        $('.venobox').venobox({
            framewidth: '958px',
            frameheight: '390px',
        });
    }

    //Init Slick Slider
    if ($('.hafezkids_post_gallery').length) {
        $('.hafezkids_post_gallery').slick({
            infinite: true,
            autoplay: false,
            arrows: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            fade: true,
            prevArrow: '<button type="button" class="slick-prev"></button>',
            nextArrow: '<button type="button" class="slick-next"></button>',
        });
    }

    //Single Gallery Sldier
    if ($('.hafezkids_gallery_slider').length) {
        $('.hafezkids_gallery_slider').slick({
            infinite: true,
            autoplay: false,
            arrows: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            fade: true,
            prevArrow: '<button type="button" class="slick-prev"></button>',
            nextArrow: '<button type="button" class="slick-next"></button>',
        });
    }

    //Testimonial Slider
    if ($('.hafezkids_testimonial_slider').length) {
        $('.hafezkids_testimonial_slider').slick({
            infinite: true,
            autoplay: false,
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            responsive: [
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });
    }

    //Timeline Swipe Slider
    if ($('.hafezkids_timeline').length) {
        $('.hafezkids_timeline').slick({
            infinite: true,
            autoplay: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: false,
            swipe: true,
            responsive: [
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });
    }

    //Team Slider
    if ($('.hafezkids_team_slider').length) {
        $('.hafezkids_team_slider').slick({
            infinite: true,
            autoplay: false,
            arrows: false,
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: true,
            responsive: [
                {
                    breakpoint: 1000,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });
    }


    if ($('.hafez_plus').length) {
        $('form').on('click', '.hafez_plus, .hafez_minus', function () {


            // Get current quantity values
            var qty = $(this).closest('.quantity').find('.qty');
            var val = parseFloat(qty.val());
            var max = parseFloat(qty.attr('max'));
            var min = parseFloat(qty.attr('min'));
            var step = parseFloat(qty.attr('step'));

            // Change the value if plus or minus
            if ($(this).is('.hafez_plus')) {
                if (max && (max <= val)) {
                    qty.val(max);
                } else {
                    qty.val(val + step);
                }
            } else {
                if (min && (min >= val)) {
                    qty.val(min);
                } else if (val >= 1) {
                    qty.val(val - step);
                }
            }
            qty.change();
        });
        $(document.body).on('updated_cart_totals', function () {
            $('form').on('click', '.hafez_plus, .hafez_minus', function () {

                // Get current quantity values
                var qty = $(this).closest('.quantity').find('.qty');
                var val = parseFloat(qty.val());
                var max = parseFloat(qty.attr('max'));
                var min = parseFloat(qty.attr('min'));
                var step = parseFloat(qty.attr('step'));

                // Change the value if plus or minus
                if ($(this).is('.hafez_plus')) {
                    if (max && (max <= val)) {
                        qty.val(max);
                    } else {
                        qty.val(val + step);
                    }
                } else {
                    if (min && (min >= val)) {
                        qty.val(min);
                    } else if (val > 1) {
                        qty.val(val - step);
                    }
                }
                qty.change();
            });
        });
    }


    //Submit search form on click
    if ($('.hafezkids_submit_search').length) {
        $('.hafezkids_submit_search').on('click', function (e) {
            e.preventDefault();

            $('#searchform').submit();
        });
    }

    //Products slider
    if ($('.hafezkids_product_slider').length) {
        var columns = $('.hafezkids_product_slider .products').data('columns');

        $('.hafezkids_product_slider .products').slick({
            infinite: true,
            autoplay: false,
            arrows: true,
            slidesToShow: columns,
            slidesToScroll: 1,
            dots: false,
            prevArrow: '<button type="button" class="slick-prev"></button>',
            nextArrow: '<button type="button" class="slick-next"></button>',
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });
    }


    //Masonry Blog
    /*if($('.posts_grid').length){
        var $grid = $('.posts_grid').masonry({
            // options
            itemSelector: '.hafezkids_blog_preview',
            columnWidth: '.grid-sizer',
            percentPosition: true
        });
        // layout Masonry after each image loads
        $grid.imagesLoaded().progress( function() {
            $grid.masonry('layout');
        });
    }*/


});
