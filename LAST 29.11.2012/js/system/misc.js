$(function() {
    /* Open Close left menu */
    $('.menu span.has, .menu a.target, .nav span.icon, #body .branches a.icon').on('click', function() {
        if ($(this).is('a') && $(this).parent().find('ul').length <= 0) {
            return false;
        }

        /* Toggle class */
        $(this).closest('li').toggleClass('opened');

        /* Call Change size */
        $(window).trigger('changed/height');
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

    /* Set scroll */
    $('#body .block-branches .branches').customScroll({onResize: 'changed/height'});

    /* Set blocks height */
    (function($, undefined) {
        $(window).on('changed/height', function() {
            /* Reset height */
            $('#body').children('.middle, .right').find('> .block > div').height('auto');

            /* Set default max height */
            var maxHeight = 0;

            /* Get max height */
            $('#body > div').each(function() {
                if (maxHeight < $(this).height()) {
                    maxHeight = $(this).innerHeight();
                }
            });

            /* Set max height */
            $('#body').children('.middle, .right').children('.block, .closed').each(function() {
                var obj = $(this),
                    height = maxHeight - obj.height(),
                    block = obj.hasClass('closed') ? obj.height(obj.height() - 2) : obj.children('div');

                block.height(block.height() + height);
            });
        }).trigger('changed/height');
    })(jQuery);

    /* Open close advaced search */
    (function($, undefined) {
        /* Show hide right col */
        $('#body > .right h2 > a.icon, #body > .right > .closed').on('click', function(e) {
            var $this = $(e.target).is('.icon:not(.center)') ? $(e.target) : $(this);
            var classes = $this.closest('.right').find('h2 > a.icon').attr('name').split(' ');

            if ($('#body').hasClass(classes[0])) {
                $('#body').removeClass(classes[0] +' '+ classes[1]);
            }
            else {
                $('#body').addClass(classes[0]);
                if ($this.hasClass('closed')) {
                    setTimeout(function() {
                        $(document).bind('click.closed', function(event) {
                            if ($(event.target).closest($this.closest('.right')).length) {
                                return false;
                            }
                            $('#body').removeClass(classes[0] +' '+ classes[1]);
                            $(document).unbind('click.closed');
                        });
                    }, 100);
                }
                else {
                    $('#body').addClass(classes[1]);
                }
            }

            /* Call Change size */
            $(window).trigger('changed/height');
        });
    }(jQuery));
});