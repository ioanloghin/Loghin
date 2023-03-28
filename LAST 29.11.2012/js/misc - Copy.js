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

	$('#customize').css({'left': (($(document).width() / 2) - ($('#customize').innerWidth(true) / 2)) +'px'});
	setTimeout(function() { $('#custBlock').addClass('hide'); }, 200);
	$('#customize').bind('click', function() {
		if ($('#custBlock:visible').length == 0) {
			/* Show block */
			var loading = $('body').ajaxLoading('show', false);
			var $this = this;
			$('#custBlock').removeClass('hide').css('z-index', '999');
			$($this).addClass('selected').css('z-index', '998');

			setTimeout(function() {
				$(document).bind('click.customize', function() {
					var options = {
						'm': 'customize',
						'opt': $('#custBlock input[name="items[]"]').serialize()
					};
					var ajaxLoading = $('#custBlock').ajaxLoading('show');
					$.post($.conf.path, options, function(data)
					{
						if (data.error == true) {
							alert(data.errorDescription);
						}
						else if (data.success == true)
						{
							if (typeof data.sites != 'undefined') {
								$.sitesList = data.sites;
							}
			
							if (typeof data.fav != 'undefined' && !$.isEmptyObject(data.fav))
							{
								/* Parse each category */
								$.each(data.fav, function($type, $data)
								{
									/* Set null block */
									var obj = $('#body ul.'+ $type +'s').html('');
									var i = 0;
			
									/* Parse each item */
									$.each($data, function(undefined, index)
									{
										/* Set id var */
										var id = index.id;
										/* Set item */
										if (!$.isEmptyObject($.sitesList[$type][id]))
										{
											var siteData = $.sitesList[$type][id];
											obj.append('<li'+ (i == 0 || i == 5 ? ' class="first"' : (i == 1 || i == 4 ? ' class="second"' : '')) +' id="'+ id +'"><div class="icon"><a href="javascript:void(0);"><img src="'+ $.conf.pic_path +'sites/'+ (siteData.image ? siteData.image : 'default.png') +'" alt="'+ siteData.name +'" /></a></div><h2><a href="'+ siteData.url +'">'+ siteData.name +'</a></h2></li>');
										}
			
										/* Increase index */
										i++;
									});
								});
			
								/* Check if need to put error */
								if ($('#custBlock input[type="checkbox"][name="items[]"]:checked').length < 12) {
									$('#custBlock .info').addClass('error').html($.i18n.custError);
								}
								/* Remove error */
								else if ($('#custBlock input[type="checkbox"][name="items[]"]:checked').length == 12) {
									/* Check if exist error and change it */
									if ($('#custBlock .info').hasClass('error')) {
										$('#custBlock .info').removeClass('error').html($.i18n.custInfo);
									}

									/* Hide loading and box */
									loading.ajaxLoading('hide');
									$('#custBlock').addClass('hide');
									$($this).removeClass('selected');
									$(document).unbind('click.customize');
								}
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
	if ($('#custBlock > .info').hasClass('error')) {
		setTimeout(function() {$('#customize').trigger('click');}, 500);
	}
	$('#custBlock').bind('click', function(e) {
		e.stopPropagation();
	});
	$('#custBlock input[name="items[]"]').bind('click', function() {
		$.each(['.left', '.right'], function(i, type) {
			if ($('#custBlock > .cnt > '+ type +' input[name="items[]"]:checked').length == 6) {
				$('#custBlock > .cnt > '+ type +' input[name="items[]"]:not(:checked)').attr('disabled', true);
			}
			else {
				$('#custBlock > .cnt > '+ type +' input[name="items[]"]:disabled').attr('disabled', false);
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

	$('#body ul li:not([id]) *').live('click dblclick', function() {
		$('#customize').triggerHandler('click');
		e.stopPropagation();
	});

	$('#body h2 > a').live('dblclick', function() {
		if ($(this).attr('href') != '') {
			window.open($(this).attr('href'), '_blank');
		}
	}).live('click', function()
	{
		if ($(this).hasClass('selected')) {
			return false;
		}

		var obj = this;
		var loading = $('body').ajaxLoading('show');
		var $id = $(this).parents('li').attr('id').replace('site', '');
		$.post($.conf.path, {'m': 'subsites', 'id': $id}, function(data)
		{
			if (data.error == true) {
				alert(data.errorDescription);
			}
			else if (data.success == true)
			{
				/* Set selected item */
				$('#body h2 > a.selected').removeClass('selected');
				$(obj).addClass('selected');

				/* Reset html */
				var parent = $('#content .resultsCats').html('');

				/* Parse Sub-sites */
				$.each(data.orders, function(index, id) {
					$(parent).append('<li'+ (index == 0 ? ' class="first"' : '') +'><a href="#"><i class="_left"></i><strong>'+ data.sites[id].name +'</strong><i class="_right"></i></a></li>');
				});

				/* Show results block */
				$('#results').removeClass('hide');
			}

			loading.ajaxLoading('hide'); 
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
			$('#custBlock .custItems').jScrollPane();
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