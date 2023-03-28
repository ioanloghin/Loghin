$(function() {
    /* Open Close left menu */
    $('.menu span.has, .nav span.icon').on('click', function() {
        var $this = $(this).closest('li');
        if ($this.hasClass('closed')) {
            $this.removeClass('closed').addClass('opened');
        }
        else {
            $this.removeClass('opened').addClass('closed');
        }

        /* Call Change size */
        $(document).trigger('changed/height');
    });

    (function($, window, undefined){
        var flexibleBlock = $('.address-bar > ul'),
        flexibleWidth = flexibleBlock.width(),
        firstWidth = $('header .menu.first').width(),
        secondWidth = $('header .menu.second').width();

        $(window).on('resize', function() {
            var space = $('#container').width() - parseInt($('#container').css('min-width'));

            if (flexibleWidth !== null ? ((space - 400 + flexibleWidth) > secondWidth - firstWidth) : (space > secondWidth - firstWidth)) {
                $('header .menu.first').addClass('full');
                space -= (secondWidth - firstWidth);
            }
            else {
                $('header .menu.first').removeClass('full');
            }

            /* Set width for url */
            flexibleBlock.width(flexibleWidth + space);
        }).trigger('resize');
    })(jQuery, window);


    /* Set blocks height */
    (function($, undefined) {
        $(document).on('changed/height', function() {
            /* Reset height */
            $('#body').children('.middle, .right').find('> .block > div').height('auto');

            /* Set default max height */
            var maxHeight = 0;

            /* Get max height */
            $('#body > div').each(function() {
                if (maxHeight < $(this).height()) {
                    maxHeight = $(this).height();
                }
            });

            /* Set max height */
            $('#body').children('.middle, .right').children('.block').each(function() {
                var height = maxHeight - $(this).height() - 5,
                    block = $(this).children('div');

                block.height(block.height() + height);
            });
        }).trigger('changed/height');
    })(jQuery);
});