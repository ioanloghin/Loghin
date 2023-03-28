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

        /* Scroll Down / Up */
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
        obj.on('click', '.list > .item', function() {
            var $this = $(this), next;
            if ((next = $this.next()).is('div')) {
                if (next.hasClass('hide')) {
                    next.removeClass('hide');
                    $this.find('.right.control').html('-');
                }
                else {
                    next.addClass('hide');
                    $this.find('.right.control').html('+');
                }
            }
            setArrows();
        });
        /* User Accounts */
        $('.nav100 .user-menu > a.left').on('click', function() {
            var $this = $(this).parent().find('.options');
            if ($this.is(':visible')) {
                return false;
            }
            $this.slideDown(function() {
                /* Check if scroll has been setted */
                if ($this.find('.scrollWrap').length <= 0) {
                    /* Set scroll */
                    $('.nav100 .user-menu .options .overflow').customScroll({ width: '12px', distance: '4px', paddingRight: '21px' });
                }
                /* Set event for close block */
                $('body').on('click.options', function(e) {
                    if ($(e.target).closest($this).length <= 0) {
                        $this.slideUp();
                        $('body').off('click.options');
                    }
                });
            });
        });
        /* Profile Switch */
        $('.changer > li').on('click', function(event) {
            event.preventDefault();
            var $this;
            if (($this = $(this).parent()).hasClass('profile-switch')) {
                $this.removeClass('profile-switch');
                setTimeout(function() {
                    $('body').on('click.profile-switch', function(e) {
                        if (!$(e.target).closest($this).length && !$(e.target).closest($('.fancybox-overlay')).length) {
                            $this.addClass('profile-switch');
                            $('body').off('click.profile-switch');
                        }
                    });
                }, 100);
            }
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
    })();


    /**
     * System Window
     *
     */
    var SYSTEM = new function() {
        this.block = $('#system');
        this.list = this.block.find('.list');
        var self = this;

        /* Check menu */
        this.checkMenu = function(id) {
            self.block.find('> ul .selected').removeClass('selected');
            self.block.find('> ul [data-id="'+ id +'"]').addClass('selected').closest('ul').closest('li').children('a').addClass('selected');
        };

        /* Check layout */
        this.checkLayout = function(id) {
            self.block.find('[id^="item-"]').removeClass('selected');
            self.block.find('#item-'+ id).addClass('selected').closest('div').removeClass('hide');
        };

        /* Get System Groups and Layouts */
        this.getLayouts = function() {
            /* Sed post data */
            $.post($.conf.path, { m: 'systemLayouts', id: ($(this).data('id') || 0) }, BODY.setLayout, 'json');
        };

        /* Set Layouts items on system window */
        this.setItems = function(data) {
            /* Reset items */
            self.list.html('');
            /* Check if this menu has items */
            if (!$.isEmptyObject(data)) {
                $.each(data, function(key, data) {
                    self.list.append('<a id="group-'+ data.id +'" class="item clear" href="'+ data.url +'">'+
                        '<span class="icon left"></span>'+
                        '<span class="left">'+ data.name +'</span>'+
                        '<span class="right control">+</span>'+
                    '</a>'+
                    '<div class="hide"></div>');

                    /* Check if exists items */
                    if (!$.isEmptyObject(data.items)) {
                        $.each(data.items, function(order, layout) {
                            self.list.find('#group-'+ data.id).next('div').append('<a id="item-'+ layout.id +'" class="item bg clear'+ (layout.has ? ' has' : '') +'" href="'+ layout.url +'">'+
                                '<span class="left">'+ layout.name +'</span>'+
                                '<span class="right">'+ layout.info +'</span>'+
                            '</a>');
                        });
                    }
                });
            }
        };

        /* Activate layout on page */
        this.setLayout = function() {
            var $this = $(this);
            if ($this.attr('href') != '#') {
                window.location.href = $this.attr('href');
                return;
            }
            /* Set id */
            var id = $(this).attr('id').split('-')[1];
            /* Get Layout */
            CUSTOMIZE.getLayoutGroup(id);
        };


        /* Register Events */
        this.block.find('> ul [data-id]').on('click', self.getLayouts);
        this.list.on('click', '[id^="item-"]', self.setLayout);
    };


    /**
     * Customize Block
     *
     */
    var CUSTOMIZE = new function() {
        this.button = $('#customize');
        this.block = $('#custBlock');
        this.site = this.block.find('.cnt > .left ul.clear-li');
        this.application = this.block.find('.cnt > .right ul.clear-li');
        this.items = '';
        var self = this;

        /* Set Customize items */
        this.setItems = function(items) {
            /* Reset html */
            self.site.html('');
            self.application.html('');
            /* Check if exists layouts and layoutsOrder */
            if (!$.isEmptyObject(items.layouts) && !$.isEmptyObject(items.layoutsOrder)) {
                $.each(items.layoutsOrder, function(index, order) {
                    var block = self[index].html('');
                    /* Set new items */
                    $.each(order, function(key, id) {
                        var data = items.layouts[index][id];
                        block.append('<li>'+
                            '<div class="left"><img src="'+ $.conf.pic_path +'layouts/'+ data.image +'" alt="" /></div>'+
                            '<div class="right clear">'+
                                '<h3>'+ data.name +'</h3>'+
                                '<input class="inputCheckbox" type="checkbox" name="items[]" value="'+ id +'" />'+
                                '<div class="cfix"></div>'+
                                '<p class="arial">'+ (data.details || '') +'</p>'+
                            '</div>'+
                        '</li>');
                    });
                });
                /* Reset Scroll */
                self.block.find('.custItems').jScrollPane();
            }
        };

        /* Get layout group */
        this.getLayoutGroup = function(id) {
            /* Send post data */
            $.post($.conf.path, { m: 'layoutGroup', id: id }, BODY.setLayout, 'json');
        };

        /* Get / Set backend Layout */
        this.getLayout = function(id, set, callback) {
            /* Send post data */
            $.post($.conf.path, { 'm': 'customize', 'set': set, 'id': id }, /*function(data) {
                if (typeof data == 'object' && $.isNumeric(data.id)) {
                    /* Check if member type was changed /
                    if (typeof data._sites == 'object') {
                        self.setItems(data._sites, data.sites);
                    }
                    /* Check if exists user layouts and set Layouts /
                    if (typeof data.layouts == 'object') {
                        LAYOUTS.setLayouts(data.layouts);
                    }

                    /* Set layout /
                    self.setLayout(data.name, data.items, data.id, data.name, data.order);

                    /* Execute callback /
                    if (typeof callback == 'function') {
                        callback(data);
                    }
                }
            }*/BODY.setLayout, 'json');

            return self.button;
        };
        /* Set Current Layout */
        this.setLayout = function(title, items, id, name, order) {
            /* Set data */
            self.button.children('strong').html(title).attr('title', title);
            self.block.find('input[name="items[]"]').attr({ checked: false, disabled: false });
            if (typeof items == 'object') {
                $.each(items, function() {
                    self.block.find('input[name="items[]"][value="'+ this +'"]').attr({ checked: true });
                });
            }
            self.block.find('[name="id"]').val(id);
            self.block.find('[name="name"]').val(name);
            self.block.find('.info > div > span').html(order);
            self.block.find('input[name="items[]"]:checked:first').trigger('check');

            /* Change name on layouts */
            if (id) {
                LAYOUTS.block.find('input[value="'+ id +'"]').parents('dl').children('dd').html(name);
            }

            return self.button;
        };

        /* Manage items 6+6 */
        this.manageItems = function() {
            if (self.block.is(':hidden')) {
                /* Loading */
                var loading = $('body').ajaxLoading('show', false);
                /* Manipulate CSS */
                self.block.find('input[name="items[]"]:checked:first').trigger('check');
                self.block.removeClass('hide').css('z-index', '999');
                self.button.addClass('selected').css('z-index', '998');
                /* Set scrollable */
                if (self.block.find('.jspScrollable').length <= 0) {
                    self.block.find('.custItems').jScrollPane();
                }

                /* Set function to close block */
                setTimeout(function() {
                    $(document).on('click.customize', function() {
                        /* Set Ajax */
                        var ajaxLoading = self.block.ajaxLoading('show');
                        /* Send data */
                        $.post($.conf.path, { 'm': 'customize', 'opt': self.block.find('input').serialize() }, function(data) {
                            /* Set Layout */
                            BODY.setLayout(data);

                            /* Remove error */
                            if (self.block.find('input[name="items[]"]:checked').length == 12) {
                                self.block.addClass('hide');
                                self.button.removeClass('selected').css('z-index', '');
                                loading.ajaxLoading('hide');
                                $(document).unbind('click.customize');
                            }

                            /* Hide Ajax */
                            ajaxLoading.ajaxLoading('hide');
                        }, 'json');
                    });
                }, 300);
            }
        };

        /* Set items limit */
        this.setItemsLimit = function() {
            $.each(['.left', '.right'], function(i, type) {
                var length = self.block.find('.cnt > '+ type +' input[name="items[]"]:checked').length;
                if (length == 6) {
                    self.block.find('.cnt > '+ type +' input[name="items[]"]:not(:checked)').attr('disabled', true);
                }
                else {
                    self.block.find('.cnt > '+ type +' input[name="items[]"]:disabled').attr('disabled', false);
                }

                self.block.find('.cnt > '+ type +' h2 > sup > span').html(length);

                /* Remove errors */
                if (self.block.find('.error').length && self.block.find('input[name="items[]"]:checked').length == 12) {
                    self.block.find('.error').remove();
                }
            });
        };

        /* Set events */
        this.button.bind('click', this.manageItems);
        this.block.bind('click check', 'input[name="items[]"]', this.setItemsLimit);

    };

    /**
     * Layouts Block
     *
     */
    var LAYOUTS = new function() {
        this.block = $('#layouts');
        this.button = this.block.prev('.arrow');
        this.editButton = this.block.find('#edit-layout');
        this.deleteButton = this.block.find('#delete-layout');
        var self = this;

        /* Get checked items */
        this.getChecked = function() {
            return self.block.find('[name="layout[]"]:checked').length;
        };
        /* Open / Close Block */
        this.toggleBlock = function() {
            if (self.block.hasClass('hide')) {
                self.block.removeClass('hide').css('z-index', '999');
                /* Hide Block */
                setTimeout(function() {
                    $(document).on('click.layouts', function(e) {
                        if ($(e.target).closest(self.block).length == 0) {
                            self.block.addClass('hide');
                            $(document).off('click.layouts');
                        }
                    });
                }, 10);
            }
        };
        /* Set layouts */
        this.setLayouts = function(items, id) {
            self.block.children('dl').remove();
            buttons = self.block.children('.buttons');
            if (!$.isEmptyObject(items)) {
                $.each(items, function(key, data) {
                    buttons.before('<dl class="clear">'+
                        '<dt>'+
                            '<label><input type="checkbox" name="layout[]" value="'+ key +'" /></label>'+
                            '<span'+ (id == key ? " class=\"bold\"" : '') +'>Layout '+ data.order +'</span>'+
                        '</dt>'+
                        '<dd>'+ data.name +'</dd>'+
                    '</dl>');
                });
            }
        };
        /* Change Layout */
        this.changeLayout = function(e) {
            /* Close Window */
            if (e.type == 'dblclick') {
                $(document).trigger('click');
            }
            /* Get Layout */
            CUSTOMIZE.getLayout($(this).parents('dl').find('[name="layout[]"]').val(), 1);
        };
        /* Set Edit / Delete buttons */
        this.setActionButtons = function() {
            /* Edit Button */
            (self.getChecked() == 1) ? self.editButton.removeClass('hide') : self.editButton.addClass('hide');
            /* Delete Button */
            (self.getChecked() >= 1) ? self.deleteButton.removeClass('hide') : self.deleteButton.addClass('hide');
        };
        /* Edit Layout */
        this.editLayout = function() {
            if ((item = self.block.find('[name="layout[]"]:checked')).length == 1) {
                /* Get Layout */
                CUSTOMIZE.getLayout(item.val(), 0).trigger('click');
            }
        };
        /* Delete Layout */
        this.deleteLayout = function() {
            if ((item = self.block.find('[name="layout[]"]:checked')).length >= 1) {
                $.post($.conf.path, { 'm': 'customize', 'id': item.serialize() }, BODY.setLayout, 'json');
            }
        };

        /* Register Events */
        this.button.on('click', this.toggleBlock);
        this.block.on('click dblclick', 'dt > span', this.changeLayout);
        this.block.on('click', '[name="layout[]"]', this.setActionButtons);
        this.editButton.on('click', this.editLayout);
        this.deleteButton.on('click', this.deleteLayout);

        /* New Layout */
        $('#new-layout').on('click', function() {
            CUSTOMIZE.setLayout($.i18n.new_layout, '', 0, '').trigger('click');
        });
    };

    /* Body */
    var BODY = new function() {
        this.block = $('#body');
        this.extension = this.block.find('.extension');
        this.textes = this.block.find('.logo');
        var self = this;

        /* Set layout data */
        this.setLayout = function(data) {
            /* Check if data isn't empty */
            if (!$.isEmptyObject(data)) {
                /* Check if exits menu groups */
                if ($.type(data.groups) == 'object') {
                    SYSTEM.setItems(data.groups);
                }
                /* Check if exists layouts */
                if ($.type(data.layouts) == 'object') {
                    /* Set customize items */
                    CUSTOMIZE.items = data.layouts;
                    /* Set layout */
                    CUSTOMIZE.setItems(data.layouts);
                }
                /* Check if exists favorites */
                if ($.type(data.favorites) == 'object') {
                    /* Set member Layouts */
                    LAYOUTS.setLayouts(data.favorites.items, data.favorites.id);
                    /* Set Eyes */
                    self.setEyes(data);
                }
                /* Check if exists defaults */
                if ($.type(data.defaults) == 'object') {
                    if ($.type(data.defaults.menu) == 'string') {
                        SYSTEM.checkMenu(data.defaults.menu);
                    }
                    if ($.type(data.defaults.layout) == 'string') {
                        SYSTEM.checkLayout(data.defaults.layout);
                    }
                }
                /* Check if exists globe */
                if ($.type(data.globe) == 'object' && !$.isEmptyObject(data.globe)) {
                    /* Check if exists globe textes */
                    if ($.type(data.globe.textes) && !$.isEmptyObject(data.globe.textes)) {
                        BODY.setTextes(data.globe.textes);
                    }
                    /* Check if exists globe extension */
                    if ($.type(data.globe.extension) && !$.isEmptyObject(data.globe.extension)) {
                        BODY.setExtension(data.globe.extension);
                    }
                }
            }
        };

        /* Set Textes */
        this.setTextes = function(textes) {
            self.textes.html(textes.top + textes.bottom);
        };

        /* Set extension */
        this.setExtension = function(extension) {
            self.extension.html(extension);
        };

        /* Set Body Eyes */
        this.setEyes = function(items) {
            /* Empty Body */
            $('#body').find('ul.sites, ul.applications').html('');
            /* Check if exists favorites */
            if (!$.isEmptyObject(CUSTOMIZE.items.layouts) && !$.isEmptyObject(items.favorites)) {
                /* Parse each item */
                $.each(CUSTOMIZE.items.layouts, function($type, data) {
                    /* Set null block */
                    var obj = $('#body ul.'+ $type +'s');
                    var i = 0;

                    /* Parse each item */
                    $.each(data, function(key, item) {
                        if ($.inArray(parseInt(key), items.favorites.layouts) != '-1') {
                            obj.append('<li'+ (i == 0 || i == 5 ? ' class="first"' : (i == 1 || i == 4 ? ' class="second"' : '')) +' id="site'+ key +'"><div class="icon"><a href="javascript:void(0);"><img src="'+ 'layouts/'+ (item.image ? item.image : 'default.png') +'" alt="'+ item.name +'" /></a></div><h2><a href="'+ item.url +'">'+ item.name +'</a><input type="hidden" name="searchIn[]" value="'+ key +'" /></h2></li>');

                            /* Increase index */
                            i++;
                        }
                    });

                    /* Check if need to put error */
                    if (items.favorites.layouts.length != 12) {
                        if (CUSTOMIZE.block.find('.error').length < 1) {
                            $('<div class="error arial">'+ $.i18n.custError +'</div>').insertBefore(CUSTOMIZE.block.find('.info'));
                        }

                        if (CUSTOMIZE.block.is(':hidden')) {
                            CUSTOMIZE.button.trigger('click');
                        }
                    }
                    else if(CUSTOMIZE.block.find('.error').length >= 1) {
                        CUSTOMIZE.block.find('.error').remove();
                    }
                });

                /* Set Customize Block */
                if ($.type(items.favorites.id) == 'string' && $.type(items.favorites.items[items.favorites.id]) == 'object') {
                    var favorite = items.favorites.items[items.favorites.id];
                    CUSTOMIZE.setLayout(favorite.name, items.favorites.layouts, items.favorites.id, favorite.name, favorite.order);
                }
                else {
                    CUSTOMIZE.setLayout($.i18n.customize, items.favorites.layouts, 0, '', 1);
                }
            }
        };
    };


    $('#custBlock').find('> .info > ._button').on('click', function() {
       $(document).trigger('click');
    });
	if ($('#custBlock .error').length > 0) {
		setTimeout(function() {$('#customize').trigger('click');}, 100);
	}
	$('#custBlock').bind('click', function(e) {
		e.stopPropagation();
	});



    /* Get default layout */
    $.post($.conf.path, { 'm': 'layout' }, BODY.setLayout, 'json');



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
				// $.each(data.orders, function(index, id) {
				// 	$(parent).append('<li'+ (index == 0 ? ' class="first"' : '') +'><a href="#"><i class="_left"></i><strong>'+ data.sites[id].name +'</strong><i class="_right"></i></a></li>');
				// });

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