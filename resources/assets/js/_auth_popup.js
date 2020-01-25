(function ($) {
    $('.login-popup-link').click(function () {
        $('.login-popup').addClass('show')
    })
    $('.close-popup').click(function () {
        $('.login-popup').removeClass('show')
    })
    $('.show_hide_pass').click(function () {
        var $this = $(this)
        var $pass = $this.parent().next()
        if ($pass.attr('type') === 'password') {
            $this.attr('class', 'fa fa-eye-slash show_hide_pass')
            $pass.attr('type', 'text')
        } else {
            $this.attr('class', 'fa fa-eye show_hide_pass')
            $pass.attr('type', 'password')
        }
    })
})(jQuery)