(function ($) {
    var owlCarouselEl = $('.owl-carousel')

    if (owlCarouselEl.length) {
        owlCarouselEl.owlCarousel({
            loop: true,
            items: 1,
            nav: false,
            autoplay: true,
            smartSpeed: 500,
            dots: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
            }
        })
    }
})(jQuery)