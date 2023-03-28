$(document).ready(function()
{
	$.currLang = conf.lang;
	$('#toggleLanguage').change(function()
	{
		if ($('[class*="lang__"]').length) {
			$('[class*="lang__"]').hide();
			$('[class*="lang__'+ $(this).val() +'"]').show();
		}
		else {
			if (confirm(conf.changeLang)) {
				$('.inputSubmit').trigger('click');
			}
			else {
				if ((position = (window.location +'').indexOf('_lang=')) != '-1') {
					window.location.replace((window.location +'').replace(/_lang=([a-z]+)/i, '_lang='+ $(this).val()));
				}
				else {
					window.location.replace(window.location +'&_lang='+ $(this).val());
				}
			}
		}
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