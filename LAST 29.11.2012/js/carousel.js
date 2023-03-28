$.fn.carousel = function ()
{
	return this.each(function()
	{
		var $wrapper = $('> div', this).css('overflow', 'hidden'),
		$slider = $wrapper.find('> ul'),
		$items = $slider.find('> li'),
		$single = $items.filter(':first'),
		singleWidth = $single.outerWidth(), 
		visible = Math.ceil($wrapper.innerWidth() / singleWidth),
		currentPage = 1,
		pages = Math.ceil($items.length / visible),
		backPage = $('a.pageBackDeact', $(this).parent()),
		nextPage = $('a.pageNextDeact', $(this).parent());

		// 4. paging function
		function gotoPage(page)
		{
			var dir = page < currentPage ? -1 : 1,
			n = Math.abs(currentPage - page),
			left = (page < pages ? (singleWidth * visible * (page - 1)) : (($items.length - visible) * singleWidth));

			$wrapper.filter(':not(:animated)').animate({scrollLeft: left}, 500, function()
			{
				if (page == 0)
				{
					$wrapper.scrollLeft(singleWidth * visible * pages);
					page = pages;
				} 
				else if (page > pages)
				{
					$wrapper.scrollLeft(singleWidth * visible);
					page = 1;
				}

				/* Check if page is first */
				if (page == 1) {
					/* Deactive back button */
					$(backPage).removeClass('pageBack').addClass('pageBackDeact');

					/* Check if pages is large then page */
					if (page < pages) {
						$(nextPage).removeClass('pageNextDeact').addClass('pageNext');
					}
				}
				else if (page >= pages) {
					/* Deative next button */
					$(nextPage).removeClass('pageNext').addClass('pageNextDeact');

					/* Check if page is not one */
					if (page > 1) {
						$(backPage).removeClass('pageBackDeact').addClass('pageBack');
					}
				}

				currentPage = page;
				$('.cntTopNumPages', $(this).parent().parent()).html(page == pages ? (($items.length + 1) - visible) +' - '+ $items.length : ((((page - 1) * visible) + 1) +' - '+ (((page - 1) * visible) + visible)));
			});

			return false;
		}

		/* Check if pages is large then page */
		if (currentPage < pages) {
			$(nextPage).removeClass('pageNextDeact').addClass('pageNext');
		}

		// 5. Bind to the forward and back buttons
		$(backPage).click(function() 
		{
			if (currentPage - 1 > 0) {
				return gotoPage(parseInt(currentPage) - 1);
			}
		});

		$(nextPage).click(function() 
		{
			if (currentPage < pages) {
				return gotoPage(parseInt(currentPage) + 1);
			}
		});

		// create a public interface to move to a specific page
		$(this).bind('goto', function (event, page) {
			gotoPage(page);
		});
	});  
};