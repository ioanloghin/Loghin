$(function() {
	(function($) {
        var obj = $('#system'), overflow = obj.children('.overflow'), itemHeight = $('.list > a:first', obj).outerHeight(), top = $('.icon.top', obj), bottom = $('.icon.bottom', obj);
        /* Show hide System */
        $('#header .head .arrow-down > a').on('click', function(e) {
            if (obj.hasClass('hide')) {
                obj.removeClass('hide');
                setTimeout(function(){
                    $(document).bind('click.system', function(e){
                        if ($(e.target).closest(obj).length) {
                            return false;
                        }
                        obj.addClass('hide');
                        $(document).unbind('click.system');
                    });
                    setArrows();
                }, 9);
            }
        });
        obj.on('click', '.icon:not(.disabled)', function() {
            overflow.animate({scrollTop : (overflow.scrollTop() + parseInt($(this).hasClass('top') ? '-'+ itemHeight : itemHeight) * 4)}, 200, setArrows);
        });
        var setArrows = function() {
            /* Set top icon */
            if (overflow.scrollTop() > 0) {
                top.removeClass('disabled');
            }
            else if (!obj.children('.icon.top').hasClass('disabled')) {
                top.addClass('disabled');
            }
            /* Set bottom icon */
            if ($('.list', obj).height() > overflow.scrollTop() + overflow.height()) {
                bottom.removeClass('disabled');
            }
            else if (!$('.icon.bottom', obj).hasClass('disabled')) {
                bottom.addClass('disabled');
            }
        };
    })(jQuery);
	
	/* User Accounts */
    $('.nav100 .user-menu > a.left').on('click', function() {
        var $this = $(this).parent().find('.nav-options');

        if ($this.is(':visible')) {
            return false;
        }

        $this.slideDown(function() {
            /* Check if scroll has been setted */
            if ($this.find('.scrollWrap').length <= 0) {
                /* Set scroll */
                $('.nav100 .user-menu .nav-options .overflow').customScroll({ width: '12px', distance: '4px', paddingRight: '21px' });
            }

            /* Set event for close block */
            $('body').on('click.nav-options', function(e) {
                if ($(e.target).closest($this).length <= 0) {
                    $this.slideUp();
                    $('body').off('click.nav-options');
                }
            });
        });
    });
	
	/* Toggle navigation with buttons Plus and Minus */
    $('.toggle li > span.icon, .toggle li > .target').on('click', function(e) {
        var $this = $(this);
        if ($this.is('a') && $this.parent().find('ul').length <= 0) {
            return false;
        }

        e.preventDefault();
        $this.parent().toggleClass('opened');
    });
	
    $('#header .pres-toggle').on('click', function() {
        $(this).toggleClass('close');
        $('#header .round, #homeHead').toggleClass('hide');
    });

	$('#header .round .image a.icon').bind('click', function(e, t) {
		var obj = $('#header .items > a.selected');
		if ($(this).hasClass('back')) {
			SlideShow.changeCategory(obj.prev().length ? obj.prev().attr('name') : $('#header .items > a:last').attr('name'), t);
		} else {
			SlideShow.changeCategory(obj.next().length ? obj.next().attr('name') : $('#header .items > a:first').attr('name'), t);
		}
	});
	$('#header .items > a').bind('click', function() {
		SlideShow.changeCategory($(this).attr('name'));
	});
	$('#header .options a').bind('click', function() {
		var obj = $('#header .overflow li a.selected').parent();
		if ($(this).parent().hasClass('left')) {
			SlideShow.changeItem(obj.prev().length ? obj.prev().find('a').attr('name') : $('#header .overflow li:last a').attr('name'));
		} else {
			SlideShow.changeItem(obj.next().length ? obj.next().find('a').attr('name') : $('#header .overflow li:first a').attr('name'));
		}
	});
	$('#header .overflow li > a').live({
		'click': function(e, t) {
			SlideShow.changeItem($(this).attr('name'), t);
			return false;
		},
		'dblclick': function() {
			if ($(this).attr('href') != '') {
				window.open($(this).attr('href'), $(this).attr('target') == '_blank' ? '_blank' : '_parent');
			}
		}
	});
	$('#header .items > a.selected, #header .overflow li a.selected').trigger('click');
	$('#header .content .top.icon, #header .content .bottom.icon').bind('mouseover', function() {
		var obj = $(this);
		$.scrollInterval = setInterval(function() {
			var scrollSize = obj.hasClass('top') ? $('#header .overflow').scrollTop() - 1 : $('#header .overflow').scrollTop() + 1;
			$('#header .overflow').scrollTop(scrollSize);
		}, 10);
	}).bind('mouseout', function() {
		clearInterval($.scrollInterval);
	});
	
	
	/* Set Carousel interval */
	$.carouselInterval = setInterval(function() {
		var obj = $('#header .overflow li a.selected').parent();
		if (typeof obj == 'object' && obj.next().is('li')) {
			$('a', obj.next()).trigger('click', ['Interval']);
		}
		else {
			$('#header .round .image a.next').trigger('click', ['Interval']);
		}
	}, $.conf.intervalTime * 1000);
	$('.submit').live('click', function() {
		$(this).parents('form').submit();
	});
	$('a[rel*="sldData_"]').bind('click', function() {
		$.fancybox({
			href: $.conf.path +'getSlideData/',
            type: 'ajax',
            ajax: {
                type: 'POST',
                data: 'id='+ $(this).attr('rel').split('_')[1]
            }
		});
	});
    $(".news-latter > a[href='#newsletter']").fancybox({padding: 0, closeBtn: false});
    $('.tight ul').on('click', 'span.has', function() {
        var $this = $(this).parent();
        if ($this.hasClass('closed')) {
            $(this).text('-')
            $this.removeClass('closed').addClass('opened');
        }
        else {
            $(this).text('+')
            $this.removeClass('opened').addClass('closed');
        }
    });
    $('#settings .list').on('click', 'a.icon', function() {
        $(this).closest('li').toggleClass('opened');
    });

	/* Toggle navigation with buttons Plus and Minus */
    /*$('.toggle li > span.icon, .toggle li > .target').on('click', function(e) {
        var $this = $(this);
        if ($this.is('a') && $this.parent().find('ul').length <= 0) {
            return false;
        }

        e.preventDefault();
        $this.parent().toggleClass('opened');
    });*/

    /* Set scroll */
    $('#settings .overflow').customScroll({background: '#2f302f'});

    /* Calendar function */
    (function($) {
        if ($('#calendar').length) {
            $('#calendar').on('click', '.arrows .icon', function() {
                var change = ($(this).parent().hasClass('left') ? 'month' : 'year'),
                    dir = ($(this).hasClass('top') ? 'next' : 'back');
                    timestamp = $(this).closest('.head').data('time');

                /* Set request */
                $.post($.conf.path +'getCalendar/', {'change': change, 'dir': dir, 'time': timestamp}, function(data) {
                    if ($(data).attr('id') == 'calendar') {
                        $('#calendar').html($(data).html());
                    }
                });
            });
        }
    })(jQuery);


    /* Search page */
    $('#search h3 > span.icon').on('click', function() {
        $(this).closest('li').toggleClass('closed');
    });

    /* Add custom scroll */
    $('#search-results').customScroll();

    /* Show hide right col */
    $('#search > .right > .closed').on('click', function() {
        var $this = $(this).closest('.right');
        $this.addClass('opened');
        setTimeout(function() {
            $('body').on('click.searchRight', function(e) {
                if ($(e.target).closest('#search > .right').length == 0) {
                    $this.removeClass('opened');
                    $('body').off('click.searchRight');
                }
            });
        }, 100);
    });

    /* Branches */
    $('.branches').on('click', 'a.icon', function() {
        $(this).closest('li').toggleClass('opened');
    });
});

var SlideShow = {
	changeCategory: function(id, t) {
		$.slideCategoryId = id;
		if (typeof id == 'undefined' || $('#header .items > a[name="'+ id +'"]').is('.selected') || $.isEmptyObject($.slideShow[id])) {
			return false;
		}

		/* Reset html data */
		$('#header .overflow h2').html($('<a />').attr('href', $.slideShow[id].url).text($.slideShow[id].name));
		var obj = $('#header .overflow ul').html('');
		var first = false;
		$.each($.slideShow[id].orderid, function(k, v) {
			var key = v;
			var value = $.slideShow[id].items[key];
			first = first ? first : key;
			obj.append('<li><a href="'+ value.url +'" name="'+ key +'"'+ (value.new_tab == '1' ? ' target="_blank"' : '') +'>'+ value.name +'</a></li>');
		});
		SlideShow.changeItem(first, t);

		/* Reset selected item */
		SlideShow.resetSelected($('#header .items'), id);
	},

	changeItem: function(id, t) {
		/* Check if exist interval */
		if (typeof $.carouselInterval == 'number' && (typeof t == 'undefined' || t != 'Interval')) {
			clearInterval($.carouselInterval);
		}

		/* Set default data */
		var obj = $('#header .overflow');
		$.slideShowId = id;
		if (typeof id == 'undefined' || $('li a[name="'+ id +'"]', obj).is('.selected') || $.isEmptyObject($.slideShow[$.slideCategoryId].items[id])) {
			return false;
		}

		/* Set data var */
		var data = $.slideShow[$.slideCategoryId].items[id];

		/* Set html data */
		$('#header .image').fadeOut(500, function() {
			$('#header .image img').attr('src', $.conf.pic_path + (data.image ? data.image : 'image.png'));
			$('#header .image .below_image .desc').html(data.desc ? data.desc : '--');
			$('#header .image .below_image a').attr({'href': data.url});
			$('#header .image .info h3').html(data.name ? data.name : '--');
			$('#header .image .info p').html(data.desc ? data.desc : '--');
			$('#header .image .info a').attr({'href': data.url});
			$('#header .image a[rel*="sldData_"]').attr({'href': 'javascript:void(0);', 'rel': 'sldData_'+ id});
			$('#header .fancy_image').attr('href', $.conf.pic_path + (data.image ? ''+ data.image : 'image.png'));
			$('#header .button.small.right').attr({'href': data.url, 'target': (data.new_tab == '1' ? '_blank' : '')});
			$('#header .image').fadeIn(500);
		});

		/* Reset selected item */
		SlideShow.resetSelected($('li', obj), id);

		/* Set vars for autoscroll */
		var top = obj.scrollTop();
		var height = obj.height();
		var position = $('li a.selected', obj).offset().top - $('h2', obj).offset().top + 40;
		if ((height + top) < position) {
			$(obj).scrollTop(position - height);
		}
		else if (top > position - 40) {
			$(obj).scrollTop(position - 40);
		}
	},

	resetSelected: function(obj, id) {
		obj.find('.selected').removeClass('selected');
		obj.find('a[name="'+ id +'"]').addClass('selected');
	}
};
