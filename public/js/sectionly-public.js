(function ($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */



    if (jQuery('.gallery-thumbs').length > 0) {

        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 10,
            slidesPerView: 20,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,

            preloadImages: false,
            lazy: true,
            lazy: {
                loadPrevNext: true,
            },
        });

        var swiper = new Swiper('.swiper-container-main', {
            autoHeight: true,
            observer: true,
            observeParents: true,
            observeChildren: true,
            parallax: true,
            spaceBetween: 0,

            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            loop: true,
            preloadImages: false,
            speed: 2000,
            autoplay: {
                delay: 3000,

            },

            loop: true,
            thumbs: {
                swiper: galleryThumbs
            }

        });

    }


    if (jQuery('.progressbars').length > 0) {

        jQuery(".progressbars").jprogress();
        jQuery(".progressbarsone").jprogress({
            background: "#FF2D55"
        });

    }



})(jQuery);
