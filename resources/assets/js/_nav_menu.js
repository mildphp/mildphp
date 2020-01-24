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

var _bodyPage = jQuery('body').data('page')

// Set active menu
jQuery('.nav-item').toArray().forEach(function (el) {
    var _navItem = jQuery(el)

    if (_navItem.data('active') === _bodyPage) {
        _navItem.addClass('active')
    }
})