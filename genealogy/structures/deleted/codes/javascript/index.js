function agi_lvl3_nav(action)
{
	var doc_list = document.getElementById('AGI_Level_3_List');
	var doc_but_up = document.getElementById('AGB_LVL3_up');
	var doc_but_down = document.getElementById('AGB_LVL3_down');
	//var items = doc_list.getElementsByClassName('agi-level_3-item').length;
	//var items = 9;
	var items = $("#AGI_Level_3_List .agi-level_3-item").length;
	var rows = Math.ceil(items/3);
	
	if(doc_list && doc_but_up && doc_but_down)
	{
		var MarginTop = doc_list.style.marginTop;
		if(MarginTop == '') MarginTop = 0;
		var MarginTopNumeric = parseFloat(MarginTop);
		var sizeMove = 154;
		if(MarginTopNumeric == 0)
			var curentRow = 1;
		else
			var curentRow = Math.abs(MarginTopNumeric)/sizeMove+1;
		
		// pentru a evita deplasarea suplimentara la dubluclick
		doc_but_up.onclick = Function();
		doc_but_down.onclick = Function();
		
		if(action == 'up')
		{
			var NewMarginTop = MarginTopNumeric + sizeMove;
			var newRow = curentRow-1;
		}
		else
		if(action == 'down')
		{
			var NewMarginTop = MarginTopNumeric - sizeMove;
			var newRow = curentRow+1;
		}
		
		$('#AGI_Level_3_List').animate({
			marginTop: NewMarginTop+'px'
		}, 800, function() {
			// end animation
			if(newRow > 1)
			{
				doc_but_up.className = "agBut-up-active";
				doc_but_up.onclick = Function("agi_lvl3_nav('up')");
			}
			else
			{
				doc_but_up.className = "agBut-up";
				doc_but_up.onclick = Function();
			}
			
			if(newRow < rows)
			{
				doc_but_down.className = "agBut-down-active";
				doc_but_down.onclick = Function("agi_lvl3_nav('down')");
			}
			else
			{
				doc_but_down.className = "agBut-down";
				doc_but_down.onclick = Function();
			}
		});
	}
}

function agi_page_close()
{
	var doc_target = document.getElementById('AGI_Level_3');
	var doc_but = document.getElementById('AGI_Close_But');
	
	if(doc_target && doc_but)
	{
		if(doc_target.style.display == 'block' || doc_target.style.display == '')
		{
			$('#AGI_Level_3').animate({
				height: '0px'
			}, 1000, function() {
				doc_target.style.display = 'none';
				doc_but.innerHTML = 'Open It';
			});
		}
		else
		{
			doc_target.style.height = '0px';
			doc_target.style.display = 'block';
			
			$('#AGI_Level_3').animate({
				height: '190px'
			}, 1000, function() {
				//doc_target.style.display = 'none';
				doc_but.innerHTML = 'Close It';
			});
		}
	}
}

// intervalul de rulare pentru ag Sliders de pe index
var int=self.setInterval("agSliders(-1)", 3000);
// functia pentru ag Sliders
function agSliders(pos)// TODO: la select pe buton, sau la accesarea continutului (formularul) trebuie sa se opreasca rularea automata
{
	var doc_ul = document.getElementById('AGS-nav');
	var total_elements = doc_ul.getElementsByTagName('li').length;
	var curent_element = 0;
	// stabilim elementul curent
	for(n=0; n<total_elements; n++)
	{
		if(document.getElementById('AGS-nav-'+n).className == 'selected')
			curent_element = n;
	}
	
	if(pos == -2)// auto
	{
		if(curent_element < (total_elements-1))
			pos = curent_element+1;
		else// s-a ajuns la sfarsit
			pos = 0;
	}
	// facem mutarea
	if(pos > -1 && curent_element != pos)
	{
		// inchidem slide-ul curent
		if(document.getElementById('AGS_'+curent_element))
		{
			// stergem onclick-ul ca sa nu dispere butoanele
			for(n=0; n<total_elements; n++)
			{
				document.getElementById('AGS-nav-'+n).onclick = Function();
			}
			
			$('#AGS_'+curent_element).fadeOut(500,
				function() {
				// deschidem slide-ul nou
				if(document.getElementById('AGS_'+pos))
				{
					//setOpacity(document.getElementById('AGS_'+pos), 0);
					//document.getElementById('AGS_'+pos).style.display = 'block';
					document.getElementById('AGS_'+curent_element).style.display = 'none';
					document.getElementById('AGS-nav-'+curent_element).className = '';// deselectam pozitia curenta
					// selectam pozitia noua
					document.getElementById('AGS-nav-'+pos).className = 'selected';
					
					$('#AGS_'+pos).fadeIn(500,
						function() {
						
						// repunem onclick-ul pentru butoanele normale
						for(n=0; n<total_elements; n++)
						{
							if(document.getElementById('AGS-nav-'+n).className != 'selected')
								//document.getElementById('AGS-nav-'+n).setAttribute("onclick", "agSliders("+n+");");
								document.getElementById('AGS-nav-'+n).onclick = Function("agSliders("+n+")");
						}
					});
				}
			});
		}
	}
}

function changeMiniSlide(new_slide)
{
	var obj_miniSlide1 = document.getElementById('AGS_0_minislide1');
	var obj_miniSlide2 = document.getElementById('AGS_0_minislide2');
	var obj_miniSlide3 = document.getElementById('AGS_0_minislide3');
	var obj_but = new Array();
	obj_but[1] = document.getElementById('QCB_1_but1');
	obj_but[2] = document.getElementById('QCB_1_but2');
	obj_but[3] = document.getElementById('QCB_1_but3');
	
	var curent_slide = 1;
	if(obj_miniSlide1 && obj_miniSlide2 && obj_miniSlide3 && obj_but[1] && obj_but[2] && obj_but[3])
	{
		if(obj_miniSlide1.style.display == 'block') curent_slide = 1;
		if(obj_miniSlide2.style.display == 'block') curent_slide = 2;
		if(obj_miniSlide3.style.display == 'block') curent_slide = 3;
		if(new_slide != curent_slide)
		{
			$('#AGS_0_minislide'+curent_slide).fadeOut(500, function() {
				document.getElementById('AGS_0_minislide'+curent_slide).style.display = 'none';
				obj_but[curent_slide].setAttribute('class', 'ag-inputRadio1');
				obj_but[new_slide].setAttribute('class', 'ag-inputRadio1-active');
				$('#AGS_0_minislide'+new_slide).fadeIn(500, function() {
					//
					document.getElementById('AGS_0_minislide'+new_slide).style.display = 'block';
				});
			});
		}
	}
}