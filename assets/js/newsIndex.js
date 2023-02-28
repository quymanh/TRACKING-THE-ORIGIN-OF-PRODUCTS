; (function ($) {
    "use strict";

    $(document).ready(function () {


        /* -----------------------------------------------------
            Variables
        ----------------------------------------------------- */
        var leftArrow = '<i class="la la-angle-left"></i>';
        var rightArrow = '<i class="la la-angle-right"></i>';


        /*------------------------------------------------
            post-slider
        ------------------------------------------------*/
        $('.post-slider').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dots: false,
            smartSpeed:1500,
            navText: [ leftArrow, rightArrow],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1
                },
                992: {
                    items: 1
                },
            }
        });

        /*---------------------------------------------
            cs-partner-slider-11
        ----------------------------------------------*/
        $('.most-view-slider').owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            smartSpeed:1500,
            center: true,
            items: 3,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1
                },
                768: {
                    items: 3
                },
            }
        });


        /*-------------------------------------------------
            wow js init
        --------------------------------------------------*/
        new WOW().init();

    });


    $(window).on('load', function () {

        /*-----------------
            preloader
        ------------------*/
        var preLoder = $("#preloader");
        preLoder.fadeOut(0);

        /*-----------------
            back to top
        ------------------*/
        var backtoTop = $('.back-to-top')
        backtoTop.fadeOut();

        /*---------------------
            Cancel Preloader
        ----------------------*/
        $(document).on('click', '.cancel-preloader a', function (e) {
            e.preventDefault();
            $("#preloader").fadeOut(2000);
        });

    });



})(jQuery);