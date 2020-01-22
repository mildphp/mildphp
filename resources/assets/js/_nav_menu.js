jQuery('.navbar-toggler').click(function () {
    var $this = jQuery(this)
    if ($this.attr('aria-expanded') == 'false') {
        setTimeout(function () {
            $this.addClass('navbar-toggler-fixed')
        }, 200)
    } else {
        $this.removeClass('navbar-toggler-fixed')
    }
})