$(function() {
	$.i18n = {
		getLocalization: function()
		{
			$.post($.conf.path, {'m': 'i18n'}, function(data)
			{
				/* Check if exist error */
				if (data.error) {
					alert(data.errorDescription);
				}
				/* Set language items */
				else {
					$.i18n = $.extend($.i18n, data);
				}
			}, 'json');
		}
	};
	$.i18n.getLocalization();

    /* Header System Window */
    (function() {
        var obj = $('#system'), overflow = obj.children('.overflow'), top = $('.icon.top', obj), bottom = $('.icon.bottom', obj), interval = null;
        /* Show hide System */
        $('#header .width ._button_').on('click', function(e) {
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
        obj.on('mouseover', '.icon:not(.disabled)', function(e) {
            if (interval != null) {
                return false;
            }
            interval = setInterval(function() {
                if ($(e.target).hasClass('disabled')) {
                    clearInterval(interval);
                    interval = null;
                    return;
                }
                overflow.animate({scrollTop : (overflow.scrollTop() + parseInt($(e.target).hasClass('top') ? '-'+ 1 : 1) * 4)}, 10, setArrows);
            }, 15);
        }).on('mouseout', '.icon', function(e) {
            if (interval != null) {
                clearInterval(interval);
                interval = null;
            }
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
        obj.on('click', '.right.control', function() {
            var $this = $(this), next;
            if ((next = $this.parents('a').next()).is('div')) {
                if (next.hasClass('hide')) {
                    next.removeClass('hide');
                    $this.html('-');
                }
                else {
                    next.addClass('hide');
                    $this.html('+');
                }
            }
            setArrows();
        });
    })();

    var layout = $('#layouts'),
        setLayout = function(title, items, id, name, order) {
            var block =  $('#custBlock'),
                button = $('#customize');

            /* Set data */
            button.children('strong').html(title).attr('title', title);
            block.find('input[name="items[]"]').attr({ checked: false, disabled: false });
            if (typeof items == 'object') {
                $.each(items, function() {
                    block.find('input[name="items[]"][value="'+ this +'"]').attr({ checked: true });
                });
            }
            block.find('[name="id"]').val(id);
            block.find('[name="name"]').val(name);
            block.find('.info > div > span').html(order);
            block.find('input[name="items[]"]:checked:first').trigger('check');

            /* Change name on layouts */
            if (id) {
                layout.find('input[value="'+ id +'"]').parents('dl').children('dd').html(name)
            }

            return button;
        };

    $('#header > .width > .middle > .arrow').on('click', function() {
        var $this = $(this);
        if (layout.hasClass('hide')) {
            layout.removeClass('hide').css('z-index', '999');
            $this.css('z-index', '998');
            /* Hide Block */
            setTimeout(function() {
                $('body').on('click.layouts', function(e) {
                    if ($(e.target).closest(layout).length == 0) {
                        layout.addClass('hide');
                        $this.css('z-index', '');
                        $('body').off('click.layouts');
                    }
                });
            }, 10);
        }
    });
    /* Check Layouts */
    layout.find('[name="layout[]"]').on('click', function() {
        var items = layout.find('[name="layout[]"]:checked').length;
        if (items == 1) {
            layout.find('#edit-layout').removeClass('hide');
        }
        else {
            layout.find('#edit-layout').addClass('hide');
        }
        if (items >= 1) {
            layout.find('#delete-layout').removeClass('hide');
        }
        else {
            layout.find('#delete-layout').addClass('hide');
        }
    });
    /* Change Layout */
    layout.find('dt > span').on('click', function() {
        var $this = $(this),
            id = $this.parents('dl').find('[name="layout[]"]').val();

        /* Manipulate CSS */
        layout.find('span.bold').removeClass('bold');
        $this.addClass('bold');

        $.post($.conf.path, { 'm': 'getLayout', 'set': 1, 'id': id }, function(data) {
            if (typeof data == 'object' && $.isNumeric(data.id)) {
                setLayout(data.name, data.items, data.id, data.name, data.order);
                setEyes(data);
            }
        }, 'json');
    }).on('dblclick', function() {
        $('body').trigger('click');
    });
    /* New Layout */
    $('#new-layout').on('click', function() {
        setLayout($.i18n.new_layout, '', 0, '').trigger('click');
    });
    /* Edit Layout */
    $('#edit-layout').on('click', function() {
        if ((item = layout.find('[name="layout[]"]:checked')).length == 1) {
            $.post($.conf.path, { 'm': 'getLayout', 'id': item.val() }, function(data) {
                if (typeof data == 'object' && $.isNumeric(data.id)) {
                    setLayout(data.name, data.items, data.id, data.name, data.order).trigger('click');
                }
            }, 'json');
        }
    });
    $('#delete-layout').on('click', function() {
        if ((item = layout.find('[name="layout[]"]:checked')).length >= 1) {
            $.post($.conf.path, { 'm': 'getLayout', 'id': item.serialize() }, function(data) {
                window.location.reload(true);
            }, 'json');
        }
    });


    var setEyes = function(items) {
        /* Check if exists favorites */
        if (typeof items.fav != 'undefined' && !$.isEmptyObject(items.fav)) {
            /* Parse each item */
            $.each(items.fav, function($type, $data) {
                /* Set null block */
                var obj = $('#body ul.'+ $type +'s').html('');
                var i = 0;

                /* Parse each item */
                $.each($data, function(undefined, index) {
                    /* Set id var */
                    var id = index.id;
                    /* Set item */
                    if (!$.isEmptyObject(items.sites[$type][id])) {
                        var siteData = items.sites[$type][id];
                        obj.append('<li'+ (i == 0 || i == 5 ? ' class="first"' : (i == 1 || i == 4 ? ' class="second"' : '')) +'><div class="icon"><a href="javascript:void(0);"><img src="'+ $.conf.pic_path +'sites/'+ (siteData.image ? siteData.image : 'default.png') +'" alt="'+ siteData.name +'" /></a></div><h2><a href="'+ siteData.url +'">'+ siteData.name +'</a><input type="hidden" name="searchIn[]" value="'+ id +'" /></h2></li>');
                    }

                    /* Increase index */
                    i++;
                });

                /* Check if need to put error */
                if ($data.length != 6 && $('#custBlock .error').length < 1) {
                    $('<div class="error arial">'+ $.i18n.custError +'</div>').insertBefore('#custBlock .info');

                    if ($('#custBlock').is(':hidden')) {
                        $('#customize').trigger('click');
                    }
                }
            });
        }
    };

	$('#customize').bind('click', function() {
		if ($('#custBlock:visible').length == 0) {
			/* Show block */
			var loading = $('body').ajaxLoading('show', false),
			    $this = this,
                block = $('#custBlock');

            block.find('input[name="items[]"]:checked:first').trigger('check');
			$('#custBlock').removeClass('hide').css('z-index', '999');
			$($this).addClass('selected').css('z-index', '998');

            /* Set scrollable */
            if ($('#custBlock').find('.jspScrollable').length <= 0) {
                $('#custBlock .custItems').jScrollPane();
            }

			setTimeout(function() {
				$(document).on('click.customize', function() {
					var options = {
						'm': 'customize',
						'opt': $('#custBlock').find('input').serialize()
					};
					var ajaxLoading = $('#custBlock').ajaxLoading('show');
					$.post($.conf.path, options, function(data) {
						if (data.error == true) {
							alert(data.errorDescription);
						}
						else if (data.success == true) {
                            /* Set Eyes items */
                            setEyes(data);

							if (typeof data.fav != 'undefined' && !$.isEmptyObject(data.fav)) {
								/* Remove error */
								if ($('#custBlock input[type="checkbox"][name="items[]"]:checked').length == 12) {
									/* Check if exist error and change it */
									if ($('#custBlock .error').length >= 1) {
										$('#custBlock .error').remove();
									}

									/* Hide loading and box */
									loading.ajaxLoading('hide');
									$('#custBlock').addClass('hide');
									$($this).removeClass('selected').css('z-index', '');
									$(document).unbind('click.customize');
								}
							}

                            /* Set last data */
                            if (typeof data.items == 'object' && typeof data.id == 'string') {
                                /* Check if this layout exist in list if no add it */
                                if (block.find('[name="id"]').val() == 0) {
                                    window.location.reload(true);
                                }

                                /* Set layout */
                                setLayout(data.name, data.items, data.id, data.name, data.order);
                            }


						}

						ajaxLoading.ajaxLoading('hide');
					}, 'json');


					/*if ($.customizeError === false) {
						loading.ajaxLoading('hide');
						$('#custBlock').addClass('hide');
						$($this).removeClass('selected');
						$(document).unbind('click.customize');
					}
					else if (!$('#custBlock .info').hasClass('error')) {
						$('#custBlock .info').addClass('error').html($.i18n.custError);
					}*/
				});
			}, 300);
		}
	});
    $('#custBlock').find('> .info > ._button').on('click', function() {
       $(document).trigger('click');
    });
	if ($('#custBlock .error').length > 0) {
		setTimeout(function() {$('#customize').trigger('click');}, 100);
	}
	$('#custBlock').bind('click', function(e) {
		e.stopPropagation();
	});
	$('#custBlock input[name="items[]"]').bind('click check', function() {
        var block = $('#custBlock');
		$.each(['.left', '.right'], function(i, type) {
            var length = block.find('.cnt > '+ type +' input[name="items[]"]:checked').length;
			if (length == 6) {
				block.find('.cnt > '+ type +' input[name="items[]"]:not(:checked)').attr('disabled', true);
			}
			else {
				block.find('.cnt > '+ type +' input[name="items[]"]:disabled').attr('disabled', false);
			}

            block.find('.cnt > '+ type +' h2 > sup > span').html(length);

            /* Remove errors */
            if (block.find('.error').length && block.find('input[name="items[]"]:checked').length == 12) {
                block.find('.error').remove();
            }
		});
	});

	$("#body li .icon > a").live('click', function()
	{
		var $id = $(this).parents('li').attr('id').replace('site', '');
		$.fancybox({
			'href': $.conf.path,
			'padding': 0,
			'hideOnOverlayClick': false,
			'scrolling': false,
			'overlayShow': true,
			'overlayOpacity': '0.4',
			'overlayColor': '#000000',
			'onComplete' : function() {
				$('#fancybox-outer, #fancybox-content').css('border-radius', '6px');
				$("#fancybox-wrap").css({ 'top': '80px', 'bottom': 'auto' });
			},
			ajax: {
				'type': "POST",
				'data': 'm=subsites&t=html&id='+ $id
			}
		});
		return false;
	});
	$('#subcats .items > a').live('mouseover', function() {
		$('#subcats .info').html($('img', this).attr('alt'));
	}).live('mouseout', function() {
		$('#subcats .info').html('');
	});

	$('#body ul li.customize').live('click dblclick', function(e) {
		$('#customize').triggerHandler('click');
		e.stopPropagation();
	});

	$('#body h2 > a').live('dblclick', function() {
		if ($(this).attr('href') != '') {
			window.open($(this).attr('href'), '_blank');
		}
	}).live('click', function() {
		/* Set default vars */
		var obj = $(this);

		/* Set or remove class */
		obj.hasClass('selected') ? obj.removeClass('selected').parent().find('input').removeClass('checked') : obj.addClass('selected').parent().find('input').addClass('checked');

		$.post($.conf.path, 'm=subsites&'+ $('#body input.checked[name="searchIn[]"]').serialize(), function(data) {
			if (data.error == true) {
				$('#content .resultsCats').html('');
				$('#results').addClass('hide');
			}
			else if (data.success == true) {
				/* Reset html */
				var parent = $('#content .resultsCats').html('');

				/* Parse Sub-sites */
				$.each(data.orders, function(index, id) {
					$(parent).append('<li'+ (index == 0 ? ' class="first"' : '') +'><a href="#"><i class="_left"></i><strong>'+ data.sites[id].name +'</strong><i class="_right"></i></a></li>');
				});

				/* Show results block */
				$('#results').removeClass('hide');
			}

		}, 'json');
		return false;
	});

	/* Results options */
	$('#content .resultsCats a').live('click', function()
	{
		if ($(this).hasClass('selected')) {
			return false;
		}

		$(this).parents('ul').find('a.selected').removeClass('selected');
		$(this).addClass('selected');

		return false;
	});
	

	$(window).bind('scroll', function()
	{
		var obj = $('.scrollArrow');
		var top = (obj.offset().top - 1);
		if (obj.hasClass('bottom') && top <= $(document).scrollTop()) {
			obj.removeClass('bottom').addClass('top');
		}
		else if (obj.hasClass('top') && top > $(document).scrollTop()) {
			obj.removeClass('top').addClass('bottom');
		}
	});
	$('.scrollArrow').bind('click', function()
	{
		var obj = $(this);
		var top = obj.offset().top;
		if (obj.hasClass('top')) {
			$('body').scrollTo({ 'top': 0, 'left': 0 }, 500);
		}
		else {
			$('body').scrollTo({ 'top': top +'px', 'left': 0 }, 500);
		}
	});


    $('a[rel="OpenClose"]').bind('click', function(e)
    {
        var obj = $('#suggest .body .cnt');
        var thisObj = $(this);
        if (thisObj.hasClass('open')) {
            obj.removeClass('hide');
            thisObj.removeClass('open').text('Close');
        }
        else {
            obj.addClass('hide');
            thisObj.addClass('open').text('Open');
        }
    });

    $('#results > div > a').bind('click', function()
    {
        var obj =  $('#results .space');
        var width = $(obj).width();
        var itemWidth = $(obj).find('ul').width() - 1;
        var scrollLeft =  $(this).attr('rel') == '-' ? ($(obj).scrollLeft() - width) : ($(obj).scrollLeft() + width);
        if ((scrollLeft + width) > itemWidth) {
            scrollLeft = itemWidth - width;
        }
        $(obj).scrollTo({ 'left': scrollLeft +'px', 'top': 0}, 500);
    });

    $('#suggest .head > div > a').bind('click', function()
    {
        if ($(this).hasClass('disabled')) {
            return false;
        }

        var parent = $(this);
        var obj =  $(this).parents('.head').find('.nav > div');
        var _left = $('#suggest .head > div._left > a');
        var _right = $('#suggest .head > div._right > a');
        var width = $(obj).width();
        var itemWidth = $('ul', obj).width();
        var scrollLeft = $(this).attr('rel') == '-' ? ($(obj).scrollLeft() - (width / 2)) : ($(obj).scrollLeft() + (width / 2));
        if ((scrollLeft + width) > itemWidth) {
            scrollLeft = itemWidth - width;
        }
        $(obj).scrollTo({ 'left': scrollLeft +'px', 'top': 0}, 500, function()
        {
            if ($(obj).scrollLeft() + width >= itemWidth) {
                _right.addClass('disabled');
            }
            else if (_right.hasClass('disabled') && ($(obj).scrollLeft() + width) < itemWidth) {
                _right.removeClass('disabled');
            }
            if ($(obj).scrollLeft() == 0) {
                _left.addClass('disabled');
            }
            else if (_left.hasClass('disabled')) {
                _left.removeClass('disabled');
            }
        });
    });
    if ($('#suggest .head .nav > div').scrollLeft() == 0) {
        $('#suggest .head > div._left > a').addClass('disabled');
    }

    $('.itemsOverflow .overflow').jScrollPane();
});

(function($){
	$.fn.ajaxLoading = function(type, image)
	{
		var $this = this;

		return this.each(function()
		{
			var obj = this;
			image = (image == false ? false : true);
			switch(type)
			{
				case 'show':
					$this.loadingHTML = $('<div />').addClass('loader').css({'width': $(obj).innerWidth(true), 'height': $(obj).outerHeight(true), opacity: 0.7});
					if (image) 
					{
						var height = $(window).height() < $(obj).outerHeight(true) ? $(window).height() : $(obj).outerHeight(true);
						var scrollTop = $(obj).is('body') ? $(document).scrollTop() : $(obj).scrollTop;
						$($this.loadingHTML).css({'background-position': 'center '+ ((height / 2) - 50 + scrollTop) +'px'});
					}
					else {
						$($this.loadingHTML).css({'background-image': 'none'});
					}
					$.each(['border-top-left-radius', 'border-top-right-radius', 'border-bottom-right-radius', 'border-bottom-left-radius'], function(index, value) {
						$($this.loadingHTML).css(value, $(obj).css(value));
					});
					$(obj).append($($this.loadingHTML).fadeIn(300));
					/*$($this.loadingHTML).bind('click', function(e) {
						e.stopPropagation();
					});*/
				break;

				default:
					if (typeof $this.loadingHTML != 'undefined') {
						$($this.loadingHTML).fadeOut(300, function() {
							$(this).remove();
						});
					}
				break;
			}

			return $this;
		});
	};
})(jQuery);