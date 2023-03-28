$(document).ready(function()
{
	$.currLang = $.conf.lang;
	$('#toggleLanguage').change(function()
	{
		$('[class*="lang__"]').hide();
		$('[class*="lang__'+ $(this).val() +'"]').show();
		$.currLang = $(this).val();
	});
	$('.menuRow1 > a').bind('mouseover', function()
	{
		var obj = $(this).parent();
		var className = obj.attr('class').split(' ')[1];
		$('.menuRow1:not(.general)').addClass('general');
		$(obj).removeClass('general');
		$('.menuRow2').attr('class', 'menuRow2 '+ className);
		$('.menuRow3:visible').addClass('hide');
		$('.menuRow3.'+ className).removeClass('hide');
	});
	if ($('#fixed').length >= 1)
	{
		var offset = $("#fixed").offset();
		$(window).scroll(function()
		{
			if ($(window).scrollTop() > offset.top) {
				$('#fixed').css({'top': $(window).scrollTop() - offset.top - 1});
			}
			else {
				$('#fixed').css({'top': 0});
			}
		});
	}
	$('.action').live('click', function() {
        var a = $(this).offset();
        $(this).addClass('active').next().css({
            top: a.top + 13,
            left: a.left - 115
        }).show().find('li:last a').css('border-bottom', 0);
        return false
    });
    $('body').click(function() {
        $.each($('.action.active'), function() {
            $(this).removeClass('active').next().hide();
        });
    });
});