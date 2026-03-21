/*============================
Theme Name: Edification
Author: Jsoft

Customizer : Xanders Samoth | https://www.linkedin.com/in/xanders-samoth-b2770737/
==============================

/*============================
   js index
==============================

==========================================*/

/**
 * Dynamically load JS files
 */
function loadJS() {
    $.getScript('/assets/js/vendor/jquery-2.2.4.min.js');
    $.getScript('/assets/js/bootstrap.min.js');
    $.getScript('/assets/js/owl.carousel.min.js');
    $.getScript('/assets/js/jquery.magnific-popup.min.js');
    $.getScript('/assets/js/jquery.slicknav.min.js');
    $.getScript('/assets/js/plugins.js');
    $.getScript('/assets/js/scripts.js');
}

$('[href="#"]').click(function () {
    return false;
});

(function($) {
    "use strict";
 

    /*================================
    Preloader
    ==================================*/
    var preloader = $('#preloader');
    $(window).on('load', function() {
        preloader.fadeOut('slow', function() { $(this).remove(); });
    });


    /*================================
    stickey Header
    ==================================*/
    $(window).on('scroll', function() {
        var scroll = $(window).scrollTop(),
            mainHeader = $('.header-bottom');

        if (scroll > 50) {
            mainHeader.addClass('sticky-header').addClass('z-depth-1');

        } else {
            mainHeader.removeClass('sticky-header').removeClass('z-depth-1');
        }
    });


    /*================================
    offste search
    ==================================*/
    var offsetSearch = $('.offset-search');
    var bodyOverlay = $('.body_overlay');
    $('.search_btn').on('click', function() {
        $(offsetSearch).addClass('show_hide');
        $(bodyOverlay).addClass('show_hide');
    });
    bodyOverlay.on('click', function() {
        $(offsetSearch).removeClass('show_hide');
        $(bodyOverlay).removeClass('show_hide');
    });


    /*================================
    Owl Carousel
    ==================================*/
    // slider_area carousel active
    function slider_area() {
        $('.slider-area').owlCarousel({
            margin: 0,
            loop: true,
            autoplay: true,
            autoplayTimeout: 4000,
            nav: true,
            items: 1,
            smartSpeed: 800,
            navText: ['<i><img src="assets/img/angle-left.png" alt="icon"/></i><span>prev</span>', '<span>next</span><i><img src="assets/img/angle-right.png" alt="icon"/></i>']
        });
    };
    slider_area();


    // course_carousel carousel active
    function course_carousel() {
        $('.course-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            dots: false,
            autoplayTimeout: 4000,
            nav: true,
            smartSpeed: 800,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                    margin: 5
                },
                480: {
                    items: 1,
                    margin: 30
                },
                768: {
                    items: 2,
                    margin: 30
                },
                1024: {
                    items: 3,
                    margin: 30
                }
            }
        });
    };
    course_carousel();


    // commn_carousel carousel active
    function commn_carousel() {
        $('.commn-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            dots: true,
            margin: 0,
            autoplayTimeout: 4000,
            nav: false,
            dotsEach: true,
            smartSpeed: 800,
            responsive: {
                0: {
                    items: 1, 
                },
                480: {
                    items: 1, 
                },
                768: {
                    items: 2, 
                },
                1024: {
                    items: 3,
                }
            }
        });
    };
    commn_carousel();


    // teacher_carousel carousel active
    function teacher_carousel() {
        $('.teacher-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            dots: false,
            margin: 0,
            autoplayTimeout: 4000,
            nav: true,
            smartSpeed: 800,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1 
                },
                480: {
                    items: 1 
                },
                768: {
                    items: 2 
                },
                1024: {
                    items: 3 
                }
            }
        });
    };
    teacher_carousel();


    // blog_carousel carousel active
    function blog_carousel() {
        $('.blog-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 0,
            dots: false,
            autoplayTimeout: 4000,
            nav: true,
            smartSpeed: 800,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1 
                },
                480: {
                    items: 1
                },
                768: {
                    items: 2 
                },
                1024: {
                    items: 3 
                }
            }
        });
    };
    blog_carousel();


    // tst_carousel carousel active
    function tst_carousel() {
        $('.tst-carousel').owlCarousel({
            loop: true,
            autoplay: true,
            dots: true,
            items: 1,
            autoplayTimeout: 4000,
            nav: false,
            smartSpeed: 800,
            mouseDrag: false
        });
    };
    tst_carousel();

    $('.expand-video').magnificPopup({
        type: 'iframe',
        gallery: {
            enabled: true
        }
    });


    /*================================
    slicknav
    ==================================*/
    $('ul#m_menu_active').slicknav({
        prependTo: "#mobile_menu"
    });

    /*================================
    Modal with asynchronous data
    ==================================*/
    // $('.team-member').each(function (params) {
    //     var _this = $(this).get(0);

    //     $(_this).on('click', function (e) {
    //         $('#modalAsyncData').modal({show:true}).attr('data-href', $(_this).attr('href'));
    //         e.stopPropagation();
    //         e.stopImmediatePropagation();

    //         return false;
    //     });

    //     $('#modalAsyncData').on('shown.bs.modal', function () {
    //         $('#modalAsyncData .modal-body').load($(this).attr('data-href'), function () {
    //             loadJS();
    //         });

    //     }).on('hidden.bs.modal', function () {
    //         $(this).removeData('bs.modal');
    //         $(this).find('.modal-body').html('<div class="container"><div class="row"><div class="col-lg-4 col-sm-6 col-8 mx-auto"><img src="assets/img/ajax-loader.gif" class="img-fluid"></div></div></div>');
    //     });
    // });

    /*================================
    Values block
    ==================================*/
    $('#ourValues .value-item .card').css('height', $('#ourValues .value-item').width());

    // On window resize, rerun some functions
    $(window).on('resize', function () {
        $('#ourValues .value-item .card').css('height', $('#ourValues .value-item').width());
    });
})(jQuery);



// google map activation
// function initMap() {
//     // Styles a map in night mode.
//     var map = new google.maps.Map(document.getElementById('google_map'), {
//         center: { lat: 40.674, lng: -73.945 },
//         scrollwheel: false,
//         zoom: 12,
//         styles: [{
//                 "elementType": "geometry",
//                 "stylers": [{
//                     "color": "#f5f5f5"
//                 }]
//             },
//             {
//                 "featureType": "poi",
//                 "elementType": "labels.text",
//                 "stylers": [{
//                     "visibility": "off"
//                 }]
//             },
//             {
//                 "featureType": "poi",
//                 "elementType": "labels.text.fill",
//                 "stylers": [{
//                     "color": "#757575"
//                 }]
//             },
//             {
//                 "featureType": "poi.business",
//                 "stylers": [{
//                     "visibility": "off"
//                 }]
//             },
//             {
//                 "featureType": "poi.park",
//                 "elementType": "geometry",
//                 "stylers": [{
//                     "color": "#e5e5e5"
//                 }]
//             },
//             {
//                 "featureType": "transit.station",
//                 "elementType": "geometry",
//                 "stylers": [{
//                     "color": "#eeeeee"
//                 }]
//             }
//         ]
//     });
//     var marker = new google.maps.Marker({
//         position: map.getCenter(),
//         map: map
//     });
// }