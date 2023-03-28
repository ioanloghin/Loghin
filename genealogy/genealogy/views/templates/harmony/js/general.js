function whichBrs()
{
	var agt=navigator.userAgent.toLowerCase();
	if (agt.indexOf("opera") != -1) return 'Opera';
	if (agt.indexOf("staroffice") != -1) return 'Star Office';
	if (agt.indexOf("webtv") != -1) return 'WebTV';
	if (agt.indexOf("beonex") != -1) return 'Beonex';
	if (agt.indexOf("chimera") != -1) return 'Chimera';
	if (agt.indexOf("netpositive") != -1) return 'NetPositive';
	if (agt.indexOf("phoenix") != -1) return 'Phoenix';
	if (agt.indexOf("firefox") != -1) return 'Firefox';
	if (agt.indexOf("safari") != -1) return 'Safari';
	if (agt.indexOf("skipstone") != -1) return 'SkipStone';
	if (agt.indexOf("msie") != -1) return 'Internet Explorer';
	if (agt.indexOf("netscape") != -1) return 'Netscape';
	if (agt.indexOf("mozilla/5.0") != -1) return 'Mozilla';
	if (agt.indexOf('\/') != -1) {
	if (agt.substr(0,agt.indexOf('\/')) != 'mozilla') {
	return navigator.userAgent.substr(0,agt.indexOf('\/'));}
	else return 'Netscape';} else if (agt.indexOf(' ') != -1)
	return navigator.userAgent.substr(0,agt.indexOf(' '));
	else return navigator.userAgent;
}

function setOpacity(object, value)
{
	object.style.opacity = value/10;
	object.style.filter = 'alpha(opacity=' + value*10 + ')';
}

function ManagementBox(action, id)
{
	doc_AGcontent = document.getElementById('AGcontent');
	doc_ManagementBox = document.getElementById('ManagementBox');
	doc_switchBut_1 = document.getElementById('switchBut_1');
	doc_switchBut_2 = document.getElementById('switchBut_2');
	doc_switchBut_1_strong = document.getElementById('switchBut_1_strong');
	doc_switchBut_2_strong = document.getElementById('switchBut_2_strong');
	var doc_AGmyIDuser = document.getElementById('hiddenAGmyIDuser');
	if(doc_AGmyIDuser) AGmyIDuser = doc_AGmyIDuser.value;
	else AGmyIDuser = 0;
	
	if(doc_AGcontent && doc_ManagementBox)
	{
		if(action == 'open')
		{
			doc_switchBut_1.className = 'AG_but1_selected';
			doc_switchBut_2.className = 'AG_but1';
			doc_switchBut_1_strong.className = 'cursor-default';
			doc_switchBut_1_strong.onclick = '';
			
			$('#AGcontent').animate({
				width: "toggle"
			  }, 1000, function() {
				  // finis action
				  doc_AGcontent.style.display = 'none';
				  doc_ManagementBox.style.width = '1px';
				  doc_ManagementBox.style.display = 'block';
				  $('#ManagementBox').animate({
					width: "725px"
				  }, 1000, function() {
					  // finis action
					  doc_switchBut_2_strong.onclick = 'ManagementBox(\'close\', 0);';
					  doc_switchBut_2_strong.className = 'cursor-pointer';
				  });
			  });
		}
		else
		if(action == 'close')
		{
			doc_switchBut_1.className = 'AG_but1';
			doc_switchBut_2.className = 'AG_but1_selected';
			doc_switchBut_2_strong.className = 'cursor-default';
			doc_switchBut_2_strong.onclick = '';
			
			$('#ManagementBox').animate({
				width: "toggle"
			  }, 1000, function() {
				  // finis action
				  doc_ManagementBox.style.display = 'none';
				  doc_AGcontent.style.width = '1px';
				  doc_AGcontent.style.display = 'block';
				  $('#AGcontent').animate({
					width: "725px"
				  }, 1000, function() {
					  // finis action
					  $("#AGcontent").css("overflow-x","scroll");
					  $("#AGcontent").css("overflow-y","hidden");
					  AGpozitionare_scroll();
					  AGloadHTMLcode(AGmyIDuser, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0);
					  doc_switchBut_1_strong.onclick = 'ManagementBox(\'open\', 1);';
					  doc_switchBut_1_strong.className = 'cursor-pointer';
				  });
			  });
		}
	}
	
	return false;
}

function SearchRecom(search_input_id, box_display_id)
{
	var doc_search_input = document.getElementById(search_input_id);
	var doc_display = document.getElementById(box_display_id);
	var doc_fix = document.getElementById(box_display_id+'_fix');
	
	if(doc_search_input && doc_display)
	{
		var search_word = doc_search_input.value;
		if(search_word.length > 2)
		{
			
			// initiem ajaxul
			if(window.XMLHttpRequest) ajax = new XMLHttpRequest();
			else if(window.ActiveXObject) ajax = new ActiveXObject("Microsoft.XMLHTTP");
			
			var sURL = ROOT+'modules/ajax/searchRecom.php?word='+search_word;
			
			ajax.open("GET", sURL, false);
			ajax.setRequestHeader("User-Agent", navigator.userAgent);
			ajax.send();
			if(ajax.status == 200)
			{
				doc_fix.innerHTML = ajax.responseText;
				if(doc_display.style.display == 'none' || doc_display.style.display == '')
				{
					doc_display.style.height = '0px';
					doc_display.style.display = 'block';
					$('#'+box_display_id).animate({ height: "220px"}, 500, function() {});
				}
			}
			else alert("Error executing XMLHttpRequest call!");
		}
		else
		if(doc_display.style.display == 'block')
		{
			$('#'+box_display_id).animate({ height: "0px"}, 500, function() {doc_fix.innerHTML = '';doc_display.style.display = 'none';});
		}
	}
}


function LoginPopBox(action)
{
	var doc_box = document.getElementById('AG_LoginBox');
	var doc_mask = document.getElementById('AG_PageMask');
	
	if(doc_box)
	{
		if(action == 'open')
		{
			setOpacity(doc_mask, 0);
			setOpacity(doc_box, 0);
			
			if(doc_mask) doc_mask.style.display = 'block';
			doc_box.style.display = 'block';
			//document.body.style.overflowY = 'hidden';
			if(doc_mask)
			{
				$('#AG_PageMask').animate({ opacity: "0.9"}, 1100, function() {});
			}
			$('#AG_LoginBox').animate({ opacity: "1"}, 900, function() {});
		}
		else
		{
			$('#AG_LoginBox').animate({ opacity: "0"}, 900, function() {doc_box.style.display = 'none';});
			if(doc_mask)
			{
				$('#AG_PageMask').animate({ opacity: "0"}, 1100, function() {doc_mask.style.display = 'none';});
			}
			
			//document.body.style.overflowY = 'scroll';
		}
	}
}

function showSubMenu(action, htmlid_target)
{
	var doc_box = document.getElementById(htmlid_target);
	
	if(action == 'open')
	{
		// calculam dimensiunea pentru submeniu
		doc_box.style.display = 'block';
		/*var current_width = doc_box.offsetWidth;
		var for_li = current_width - 110;
		$('#'+htmlid_target+' .agsCenter')[0].style.width = for_li+'px';
		$('#'+htmlid_target+' .agsCenter')[1].style.width = for_li+'px';
		$('#'+htmlid_target+' .agsCenter')[2].style.width = for_li+'px';*/
	}
	else
		doc_box.style.display = 'none';
}



/*jQuery(document).ready(function() {
  jQuery(".content").hide();
  //toggle the componenet with class msg_body
  jQuery(".heading").click(function()
  {
    jQuery(this).next(".content").slideToggle(500);
  });
});*/

// creaza arbore ***********************************
function quickCreateLive(htmlid_source, htmlid_destination, htmlclass_dest)
{
	var doc_src = document.getElementById(htmlid_source);
	var doc_dest = document.getElementById(htmlid_destination);
	
	
	if(doc_src && doc_dest)
	{
		var src_val = doc_src.value;
		
		if(htmlclass_dest != '')
		{
			doc_dest.getElementsByClassName(htmlclass_dest)[0].innerHTML = src_val;
		}
		else
			doc_dest.innerHTML = src_val;
	}
}
// *************************************************

function changeFancyRadio(nr_inputs, htmlid, nr_select, htmlid_hidden)
{
	// onclick="changeFancyRadio(2, 'AGMP_id_', 1, 'AG_Hidden');"
	// onclick="changeFancyRadio(2, 'AGMP_id_', 2, 'AG_Hidden');"
	//
	var doc_new = document.getElementById(htmlid+nr_select);
	var doc_hidden = document.getElementById(htmlid_hidden);
	
	if(doc_new && doc_hidden)
	{
		// resetam toate inputurile radio
		var current = 0;
		for(n=1; n<=nr_inputs; n++)
		{
			if(document.getElementById(htmlid+n))
				document.getElementById(htmlid+n).className = 'ag-inputRadio1';
		}
		doc_new.setAttribute('class', 'ag-inputRadio1-active');
		doc_hidden.setAttribute('value', nr_select);
	}
}

function aglm_list_expand(htmlid)
{
	htmlclass = 'aglm_details';
	var doc_target_div = document.getElementById(htmlid);
	//var doc_target_list = $('#'+htmlid+' .'+htmlclass)[0];
	var doc_target_list = document.getElementById(htmlid+'-expand');
	//var doc_target_list = $('#'+htmlid).children('.'+htmlclass)[0];
	
	if(doc_target_list.style.display == 'none' || doc_target_list.style.display == '')
	{
		// modificam culoarea de fundal
		/*if(doc_target_div.className == 'AGLM_item') doc_target_div.className += ' agexpand';
		else
		if(doc_target_div.className == 'AGLM_item_first' || doc_target_div.className == 'AGLM_item_last')
		{
			doc_target_div.className += ' agexpand';
			//doc_target_div.style.backgroundPosition = '0 -100px';
		}*/
		
		// afisam lista
		//doc_target_list.style.height = '1px';
		doc_target_list.style.display = 'block';
		
		
		// modificam iconul
		var doc_target_icon = $('#'+htmlid+' .aglm_iconPlus')[0];
		doc_target_icon.className = 'aglm_iconMinus';
	}
	else
	{
		// modificam iconul
		var doc_target_icon = $('#'+htmlid+' .aglm_iconMinus')[0];
		doc_target_icon.className = 'aglm_iconPlus';
		
		// modificam culoarea de fundal
		/*if(doc_target_div.className == 'AGLM_item agexpand') doc_target_div.className = 'AGLM_item';
		else
		if(doc_target_div.className == 'AGLM_item_first agexpand')
		{
			doc_target_div.className = 'AGLM_item_first';
			//doc_target_div.style.backgroundPosition = '0 0';
		}
		else
		if(doc_target_div.className == 'AGLM_item_last agexpand')
		{
			doc_target_div.className = 'AGLM_item_last';
			//doc_target_div.style.backgroundPosition = '0 0';
		}*/
		
		// afisam lista
		doc_target_list.style.display = 'none';
	}
	
}

function deces_active(htmlid_checkbox, htmlid_zz, htmlid_mm, htmlid_yy)
{
	doc_checkbox = document.getElementById(htmlid_checkbox);
	doc_zz = document.getElementById(htmlid_zz);
	doc_mm = document.getElementById(htmlid_mm);
	doc_yy = document.getElementById(htmlid_yy);
	
	if(doc_checkbox)
	{
		if(doc_checkbox.checked)
		{
			if(doc_zz) doc_zz.disabled = false;
			if(doc_mm) doc_mm.disabled = false;
			if(doc_yy) doc_yy.disabled = false;
		}
		else
		{
			if(doc_zz) doc_zz.disabled = true;
			if(doc_mm) doc_mm.disabled = true;
			if(doc_yy) doc_yy.disabled = true;
		}
	}
}


function goto(url)
{
	window.location = url;
}


var bodyHeight = 0, urlWidth = 0, firstWidth = 0, secondWidth = 0;
$(document).ready(function() {
    /* Show hide logos */
    $('#Header .logo').parent().find('.arrow-down').bind('click', function(e){
        if ($('#sites').hasClass('hide')) {
            $('#sites').show(2, function(){
                $(document).bind('click.outSites', function(event){
                    if ($(event.target).closest($('#sites')).length) {
                        return false;
                    }
                    $('#sites').addClass('hide').hide();
                    $(document).unbind('click.outSites');
                });
                setArrows();
            }).removeClass('hide');
        }
        e.preventDefault();
    });
    $('#sites > .icon').bind('click', function() {
        if ($(this).hasClass('disabled')) {
            return false;
        }
        var itemHeight = $('#sites .list > a:first').outerHeight();
        $('#sites > .overflow').animate({scrollTop : ($('#sites > .overflow').scrollTop() + parseInt($(this).hasClass('top') ? '-'+ itemHeight : itemHeight) * 4)}, 200, setArrows);
    });
	$('#sites .list > .item.node').click(function() {
		if($(this).next('.subitem').is(':visible'))
			$(this).next('.subitem').hide();
		else
			$(this).next('.subitem').show();
		setArrows();
	});
    var setArrows = function() {
        if ($('#sites > .overflow').scrollTop() > 0) {
            $('#sites .icon.top.disabled').removeClass('disabled');
        }
        else if (!$('#sites .icon.top').hasClass('disabled')) {
            $('#sites .icon.top').addClass('disabled');
        }
		
        if ($('#sites .list').height() > ($('#sites > .overflow').scrollTop() + $('#sites > .overflow').height() + 2)) {
            $('#sites .icon.bottom.disabled').removeClass('disabled');
        }
        else if (!$('#sites .icon.bottom').hasClass('disabled')) {
            $('#sites .icon.bottom').addClass('disabled');
        }
    };/* End sites */
	
	/* v-nav plus/minus buttons */
	$('ul.v-nav > li > .border > .icon, ul.v-nav > li > ul > li > .icon').on('click', function(e) {
        var $this = $(this);
        if ($this.is('a') && $this.parent().find('ul').length <= 0) {
            return false;
        }

        e.preventDefault();
		if($this.parent().is("li"))
        	$this.parent().toggleClass('opened');
		else
			$this.parent().parent().toggleClass('opened');
    });
	
	/* More Services */
    if ($('a[href="#more-services"]').length) {
        $('a[href="#more-services"]').on('dblclick', function(e) {
            /* Prevent default */
            e.preventDefault();

            /* Set vars */
            var self = $(this).closest('div');

            /* Show content */
            $('.more-services', self).removeClass('hide').css({opacity: 0}).animate({opacity: 1}, 500, function() {
                $('.close', this).on('click.close', function() {
                    $(this).parent().animate({opacity: 0}, 300, $.proxy(function() {
                            $(this).off('click.close');
                        }, this)
                    );
                });
            });
        }).on('click', function(e) {
            e.preventDefault();
        });
    }
});