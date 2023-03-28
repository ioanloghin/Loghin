(function($) {
    $.fn.customScroll = function(options) {
        var opt = $.extend({
            width: '7px',
            position: 'right',
            distance: '1px',
            background: '#000',
            opacity: .8,
            onResize: false
        }, options);

        return this.each(function() {
            /* Add blocks */
            var $this = $(this).css({paddingRight: '10px', overflow: 'hidden'});
            var wrap = $this.wrap('<div />').parent().css({position: 'relative'});
            var space = $('<div />').css($.extend({width: opt.width, height: '100%', position: 'absolute', top: 0, zIndex: 90}, ((opt.position == 'right') ? { right: opt.distance } : { left: opt.distance }))).appendTo(wrap);
            var target = $('<div />').css({backgroundColor: opt.background, display: 'none', width: opt.width, opacity: opt.opacity, position: 'absolute', top: 0, left: 0, 'border-radius': '3px', zIndex: 99}).appendTo(space);
            var fadeOutTimeout = false;

            /* Show hidden scroll /
            $this.on('mouseenter', function() {
                target.fadeIn('fast', fadeOut);
            });*/
            /* Show hidden scroll then cursor is on target space */
            wrap.on({
                mouseenter: function() {
                    /* Clear existing timeout */
                    if (fadeOutTimeout) {
                        clearTimeout(fadeOutTimeout);
                    }
                    /* Show Scroll */
                    target.fadeIn();
                },
                mouseleave: fadeOut
            });

            /* Move scroll */
            target.draggable({axis: 'y', containment: 'parent', drag: function(e) {
                    scrollContent($(this).position().top);
                }
            });

            /* Check if need to change target size on window resize */
            if (opt.onResize) {
                /* Change height */
                $(window).bind('resize.customScroll', function() {
                    setTimeout(function() {
                        /* Set target height */
                        setTarget();
                         /* Set target position */
                        scrollContent($this.scrollTop(), true);
                    }, 10);
                });
            }
            /* Set target height */
            else {
                setTarget();
            }

            /* Check if mousewheel */
		    $this.mousewheel(function(event, delta) {
                scrollContent(delta < 1 ? 1 : -1, true, event);
			});

            /* Scroll Content */
            function scrollContent(top, whell, event) {
                if (whell) {
                    /* move bar with mouse wheel */
                    top = parseInt(target.css('top')) + top * 20 / 100 * target.outerHeight();

                    /* move bar, make sure it doesn't go out */
                    var maxTop = $this.outerHeight() - target.outerHeight();
                    top = Math.min(Math.max(top, 0), maxTop);

                    /* Check if event is not undefined */
                    if (typeof event != 'undefined') {
                        var _top = parseInt(target.css('top'));
                        if ((maxTop != _top || maxTop != top) && (_top != 0 || top != 0)) {
                            event.preventDefault();
                        }
                    }

                    /* scroll the scrollbar */
                    target.css({top: top + 'px' });
                }

                /* calculate actual scroll amount */
                top = (parseInt(target.css('top')) / ($this.outerHeight() - target.outerHeight())) * ($this[0].scrollHeight - $this.outerHeight());

                /* scroll content */
                $this.scrollTop(top);
            }

            /* Hide Scroll bar */
            function fadeOut() {
                /* Clear existing timeout */
                if (fadeOutTimeout) {
                    clearTimeout(fadeOutTimeout);
                }
                /* Set new timeout */
                fadeOutTimeout = setTimeout(function() {
                    target.fadeOut();
                }, 1000);
            }

            /* Set target height */
            function setTarget() {
                target.css({ height: Math.max(($this.outerHeight() / $this[0].scrollHeight) * $this.outerHeight(), 30) });
            }
        });
    }
})(jQuery);