(function ($) {
    var topEl = $('.back-to-top')
    var offsetEl = $('.back-to-top-offset')

    if (offsetEl.length) {
        $(window).scroll(function () {
            if (this.scrollY >= offsetEl.offset().top) {
                topEl.removeClass('d-none')
            } else {
                if (!topEl.hasClass('d-none')) {
                    topEl.addClass('d-none')
                }
            }
        })
        topEl.find('a').click(function () {
            $('html, body').stop().animate({scrollTop: 0}, 500, 'swing')
        })
    }
})(jQuery)