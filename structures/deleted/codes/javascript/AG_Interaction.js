function AGpozitionare_scroll()
{
	/*var content = document.getElementById("AGFix");
	if (content)
	{
		var width_continut = content.scrollWidth;
		var width_scroll_right = 20;
		if(CLIENT_BROWSER == 'Firefox' || CLIENT_BROWSER == 'Safari')
			var width = getComputedStyle(content, '').getPropertyValue('width');
		else
			var width = content.currentStyle.width;
		width = parseInt(width);
		var diff = (width_continut + width_scroll_right) - width;
		var pos = Math.floor(diff/2);
		if(diff > 0) content.scrollLeft = pos;
	}*/
}

function AGstrlen (string)
{
    // Get string length  
    // 
    // version: 1107.2516
    // discuss at: http://phpjs.org/functions/strlen
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Sakimori
    // +      input by: Kirk Strobeck
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Onno Marsman
    // +    revised by: Brett Zamir (http://brett-zamir.me)
    // %        note 1: May look like overkill, but in order to be truly faithful to handling all Unicode
    // %        note 1: characters and to this function in PHP which does not count the number of bytes
    // %        note 1: but counts the number of characters, something like this is really necessary.
    // *     example 1: strlen('Kevin van Zonneveld');
    // *     returns 1: 19
    // *     example 2: strlen('A\ud87e\udc04Z');
    // *     returns 2: 3
    var str = string + '';
    var i = 0,
        chr = '',
        lgth = 0;
 
    if (!this.php_js || !this.php_js.ini || !this.php_js.ini['unicode.semantics'] || this.php_js.ini['unicode.semantics'].local_value.toLowerCase() !== 'on') {
        return string.length;
    }
 
    var getWholeChar = function (str, i) {
        var code = str.charCodeAt(i);
        var next = '',
            prev = '';
        if (0xD800 <= code && code <= 0xDBFF) { // High surrogate (could change last hex to 0xDB7F to treat high private surrogates as single characters)
            if (str.length <= (i + 1)) {
                throw 'High surrogate without following low surrogate';
            }
            next = str.charCodeAt(i + 1);
            if (0xDC00 > next || next > 0xDFFF) {
                throw 'High surrogate without following low surrogate';
            }
            return str.charAt(i) + str.charAt(i + 1);
        } else if (0xDC00 <= code && code <= 0xDFFF) { // Low surrogate
            if (i === 0) {
                throw 'Low surrogate without preceding high surrogate';
            }
            prev = str.charCodeAt(i - 1);
            if (0xD800 > prev || prev > 0xDBFF) { //(could change last hex to 0xDB7F to treat high private surrogates as single characters)
                throw 'Low surrogate without preceding high surrogate';
            }
            return false; // We can pass over low surrogates now as the second component in a pair which we have already processed
        }
        return str.charAt(i);
    };
 
    for (i = 0, lgth = 0; i < str.length; i++) {
        if ((chr = getWholeChar(str, i)) === false) {
            continue;
        } // Adapt this line at the top of any loop, passing in the whole string and the current iteration and returning a variable to represent the individual character; purpose is to treat the first part of a surrogate pair as the whole character and then ignore the second part
        lgth++;
    }
    return lgth;
}

function AGexpandPlan(action, value, direction)
{
	var doc_plane = document.getElementById('AGDynamic');
	if(CLIENT_BROWSER == 'Firefox' || CLIENT_BROWSER == 'Safari')
		var plane_marginTop = getComputedStyle(doc_plane, '').getPropertyValue('margin-top');
	else
		var plane_marginTop = doc_plane.currentStyle.marginTop;
	
	plane_marginTop = parseInt(plane_marginTop);
	value = parseInt(value);
	
	if(action == 'expand')
		plane_marginTop += value;
	else
		plane_marginTop -= value;
	
	//$('#AGDynamic').animate({ marginTop: plane_marginTop+'px' }, 'slow', function() {});
	//doc_plane.style.marginTop = plane_marginTop+'px';// muta in jos sau in sus planul in cazul in care se extinde familii
}

function AGUBID_(target_identif, action)
{
	var str = target_identif;
	var strlen = AGstrlen(str);
	var last = str.charAt(str.length-1);
	var parent_identif = str.substr(0, strlen-1);
	var desc_user_align = 0;
	if(last == '0')
		desc_user_align = 1;
	else
		desc_user_align = 2;
	
	// schimbam starea iconului desc
	var target_id_user = AGFamilyMembers[parent_identif][desc_user_align];
	var doc_target_icon = document.getElementById('AGUBID_'+target_id_user);
	var new_class = (action == 'on') ? 'ag_userbox_icon_descOn' : 'ag_userbox_icon_desc';
	if(doc_target_icon) doc_target_icon.className = new_class;
}

function AGUBEX_(target_nr, target_align)
{
	var target_identif = 'EX'+target_align+target_nr;
	var doc_box = document.getElementById('FamilyBox_'+target_identif);
	if(doc_box)
	{
		// inchidem toate ex familiile
		for(i=1; i<=5; i++)
		{
			if((target_nr != i) && (document.getElementById('FamilyBox_EX'+target_align+i)))
				document.getElementById('FamilyBox_EX'+target_align+i).style.display = 'none';
		}
		
		if(CLIENT_BROWSER == 'Firefox' || CLIENT_BROWSER == 'Safari')
			box_display = getComputedStyle(doc_box, '').getPropertyValue('display');
		else
			box_display = doc_box.currentStyle.display;
		
		if(box_display == 'none')
			doc_box.style.display = 'block';
		else
			doc_box.style.display = 'none';
	}
}

function AGchangeTree(next_tree_id, next_user_id, direction)
{
	if(AGmyPreview)
		window.location = ROOT+'preview/tree-'+next_tree_id+'/'+next_user_id+'/'+direction;
	else
		window.location = ROOT+'tree-'+next_tree_id+'/'+next_user_id+'/'+direction;
}

function AGchangeProfile(direction, my_id_tree, my_id_family, my_id_user, my_id_rel)
{
	var htmlid_old_sufix = (AGmyIDRel == 3) ? 'c' : 'p';
	var htmlid_new_sufix = (my_id_rel == 3) ? 'c' : 'p';
	var doc_old = document.getElementById('AGuserBox_'+AGmyIDUser+htmlid_old_sufix);
	var doc_new = document.getElementById('AGuserBox_'+my_id_user+htmlid_new_sufix);

	if(doc_old && doc_new)
	{
		if(direction == 'asc')
		{
			var doc_icon_old = document.getElementById('AGUBIPA_'+AGmyIDUser+htmlid_old_sufix);
			var doc_icon_new = document.getElementById('AGUBIPA_'+my_id_user+htmlid_new_sufix);
			
			if(doc_icon_old) doc_icon_old.className = 'ag_userbox_icon_profile_asc';
			if(doc_icon_new) doc_icon_new.className = 'ag_userbox_icon_profile_ascOn';
		}
		else
		if(direction == 'desc')
		{
			var doc_icon_old = document.getElementById('AGUBIPD_'+AGmyIDUser+htmlid_old_sufix);
			var doc_icon_new = document.getElementById('AGUBIPD_'+my_id_user+htmlid_new_sufix);
			
			if(doc_icon_old) doc_icon_old.className = 'ag_userbox_icon_profile_desc';
			if(doc_icon_new) doc_icon_new.className = 'ag_userbox_icon_profile_descOn';
		}
		
		if(AGmyIDUser > 0)
			doc_old.className = 'ag_userbox';
		else
		if(AGmyIDUser < 0)
			doc_old.className = 'ag_userbox_sablon';
		else
			doc_old.className = 'ag_userbox_nohover';
		
		doc_new.className += ' ag_userbox_blue';
		AGmyIDUser = my_id_user;
		AGmyIDRel = my_id_rel;
		// schimba datele din coloana din stanga
		var doc_ColoanaStanga = document.getElementById('AG_PageLeftBox');
		if(doc_ColoanaStanga)
		{
			// initiem ajaxul
			if(window.XMLHttpRequest) ajax = new XMLHttpRequest();
			else if(window.ActiveXObject) ajax = new ActiveXObject("Microsoft.XMLHTTP");
			var sURL = ROOT+'modules/b_tree_leftmenu.php?AGajax';
			sURL += '&my_id_tree='+my_id_tree;
			sURL += '&my_id_family='+my_id_family;
			sURL += '&my_id_user='+my_id_user;
			sURL += '&my_id_rel='+my_id_rel;
			
			if(AGmyAdmin)
				sURL += '&AGmyAdmin';
			ajax.onreadystatechange=function()
			{
				if(ajax.status == 200)
				{
					var AGHTMLcode_ColoanaStanga = ajax.responseText;
					doc_ColoanaStanga.innerHTML = AGHTMLcode_ColoanaStanga;
				}
				//else alert("Error executing XMLHttpRequest call!");
			}
			ajax.open("GET", sURL, true);
			ajax.setRequestHeader("User-Agent", navigator.userAgent);
			ajax.send();
		}
	}
}

function AGchangeAddProfile(id_family, next_user_id, id_rel, linked_id_user, linked_direction)/* nu mai este nevoie */
{
	//alert(id_family+' / '+next_user_id+' / '+id_rel+' / '+linked_id_user);
	doc_old = document.getElementById('AGuserBox_'+AGmyIDUser);
	doc_new = document.getElementById('AGuserBox_'+next_user_id);
	if(doc_old && doc_new)
	{
		/*if(direction == 'asc')
		{
			doc_icon_old = document.getElementById('AGUBIPA_'+AGmyIDUser);
			doc_icon_old.className = 'ag_userbox_icon_profile_asc';
		}
		else
		if(direction == 'desc')
		{
			doc_icon_old = document.getElementById('AGUBIPD_'+AGmyIDUser);
			doc_icon_old.className = 'ag_userbox_icon_profile_desc';
		}*/
		if(AGmyIDUser > 0)
			doc_old.className = 'ag_userbox';
		else
		if(AGmyIDUser < 0)
			doc_old.className = 'ag_userbox_sablon';
		else
			doc_old.className = 'ag_userbox_nohover';
		
		doc_new.className += ' ag_userbox_blue';
		AGmyIDUser = next_user_id;
		// schimba datele din coloana din stanga
		var doc_ColoanaStanga = document.getElementById('AG_PageLeftBox');
		if(doc_ColoanaStanga)
		{
			// initiem ajaxul
			if(window.XMLHttpRequest) ajax = new XMLHttpRequest();
			else if(window.ActiveXObject) ajax = new ActiveXObject("Microsoft.XMLHTTP");
			var sURL = ROOT+'modules/b_tree_leftmenu.php?AGmyIDUser=0';
			sURL += '&ADD_id_family='+id_family;
			sURL += '&ADD_id_user='+next_user_id;
			sURL += '&ADD_id_rel='+id_rel;
			sURL += '&ADD_linked_id_user='+linked_id_user;
			sURL += '&ADD_linked_direction='+linked_direction;
			sURL += '&AGajax';
			if(AGmyAdmin)
				sURL += '&AGmyAdmin';
			ajax.onreadystatechange=function()
			{
				if(ajax.status == 200)
				{
					var AGHTMLcode_ColoanaStanga = ajax.responseText;
					doc_ColoanaStanga.innerHTML = AGHTMLcode_ColoanaStanga;
				}
				//else alert("Error executing XMLHttpRequest call!");
			}
			ajax.open("GET", sURL, true);
			ajax.setRequestHeader("User-Agent", navigator.userAgent);
			ajax.send();
		}
	}
}

function AGmyView_session(action, direction, identif_family)
{
	if(window.XMLHttpRequest) ajax = new XMLHttpRequest();
	else if(window.ActiveXObject) ajax = new ActiveXObject("Microsoft.XMLHTTP");
	var sURL = ROOT+'modules/ajax/AGmyView.php?AGmyIDTree='+AGmyIDTree+'&action='+action+'&direction='+direction+'&identif_family='+identif_family;
	ajax.open("GET", sURL, true);
	ajax.setRequestHeader("User-Agent", navigator.userAgent);
	ajax.send();
	//alert(action+' '+direction+' '+identif_family);
	if(ajax.status == 200) return true;
	else return false;
}

function AGexpandFamily(identifBox, userID, direction, count_children)
{
	var doc_box = document.getElementById('FamilyBox_'+identifBox);
	
	if(doc_box)
	{
		if(CLIENT_BROWSER == 'Firefox' || CLIENT_BROWSER == 'Safari')
			box_display = getComputedStyle(doc_box, '').getPropertyValue('display');
		else
			box_display = doc_box.currentStyle.display;
		
		// START ASC ========================================================================
		if(direction == 'Asc')
		{
			if(box_display == 'none')
			{
				AGexpandPlan('expand', AGFORMAT_T5_H, 'up');
				
				// il inchidem pe cel care se interpune
				var str = identifBox;
				var strlen = AGstrlen(str);
				var last = str.substr(-1);
				var newstr = str.substr(0, strlen-1);
				for(nr=1; nr<=count_children; nr++)
				{
					if(last != nr)
					{
						var tempIdentif = newstr+nr;
						var temp_docbox = document.getElementById('FamilyBox_'+tempIdentif);
						if(temp_docbox)
						{
							if(CLIENT_BROWSER == 'Firefox' || CLIENT_BROWSER == 'Safari')
								var temp_display = getComputedStyle(temp_docbox, '').getPropertyValue('display');
							else
								var temp_display = temp_docbox.currentStyle.display;
							
							if(temp_display == 'block')
							{
								temp_docbox.style.display = 'none';
								// inregistram schimbarea in sesiune
								AGmyView_session('out', 'asc', tempIdentif);
								//
								AGexpandPlan('contract', AGFORMAT_T5_H, 'up');
								var temp_docboxC = document.getElementById('FamilyBox_'+tempIdentif+'c');
								if(temp_docboxC)
								{
									var temp_children = temp_docboxC.innerHTML;
									temp_children = parseInt(temp_children);
									// inchidem toate subbox-urile acestuia
									// extragem numarul copiilor box-ului pe care l-am inchis
									if(temp_children)
									{
										var nextIdentif = tempIdentif;
										var backs = new Array();
										var maximum = temp_children;
										for(i=1; i<=maximum; i++)
										{
											//alert('#'+nextIdentif+' + '+i+' = #'+nextIdentif+i);
											if(!nextIdentif && i> temp_children && !backs.length)
											{
												//alert('break1');
												break;
											}
											else
											if(backs.length)
											{
												nextIdentif = backs[backs.length-1];
												nextIdentif.pop();
												//alert('back1 ->'+nextIdentif+'; continue;');
												continue;
											}
											
											temp_docbox = document.getElementById('FamilyBox_'+nextIdentif+i);
											if(temp_docbox)
											{
												if(CLIENT_BROWSER == 'Firefox' || CLIENT_BROWSER == 'Safari')
													var temp_display = getComputedStyle(temp_docbox, '').getPropertyValue('display');
												else
													var temp_display = temp_docbox.currentStyle.display;
												
												if(temp_display == 'block')
												{
													//alert('temp_display == block');
													AGexpandPlan('contract', AGFORMAT_T5_H, 'up');
													temp_docbox.style.display = 'none';
													// inregistram schimbarea in sesiune
													AGmyView_session('out', 'asc', nextIdentif+i);
													// 
													var temp_docboxC = document.getElementById('FamilyBox_'+nextIdentif+'c');
													var temp_children = temp_docboxC.innerHTML;
													temp_children = parseInt(temp_children);
													
													if(temp_children)
													{
														//alert(temp_children);
														if(nextIdentif+i == nextIdentif+i)
															nextIdentif = nextIdentif+i;
														else
															backs[backs.length+1] = nextIdentif+i;
														i=0;
														maximum = temp_children;
														continue;
													}
													else
													{
														//alert('temp_children == 0');
														if(backs.length)
														{
															//alert('back2 ->'+nextIdentif+'; continue;');
															nextIdentif = backs[backs.length-1];
															nextIdentif.pop();
															continue;
														}
														else
															break;
													}
												}
												else
												{
													//alert('temp_display == none');
													if(backs.length)
													{
														//alert('back1 ->'+nextIdentif+'; continue;');
														nextIdentif = backs[backs.length-1];
														nextIdentif.pop();
														continue;
													}
													else
														break;
												}
											}
											else
											{
												/*alert('!temp_docbox');
												if(backs.length)
												{
													alert('back4 ->'+nextIdentif+'; continue;');
													nextIdentif = backs[backs.length-1];
													nextIdentif.pop();
													continue;
												}
												else
													break;*/
											}
										}
										
									}
									continue;
								}
							}
						}
					}
				}
				
				//doc_icon.className = 'ag_userbox_icon_ascOn';
				
				doc_box.style.display = 'block';
				// inregistram schimbarea in sesiune
				AGmyView_session('in', 'asc', identifBox);
			}
			else
			{
				AGexpandPlan('contract', AGFORMAT_T5_H, 'up');
				//temp_docbox.style.display = 'none';
				
				// il inchidem pe cel care se interpune
				var str = identifBox;
				var tempIdentif = str;
				var temp_docbox = document.getElementById('FamilyBox_'+tempIdentif);
				
				if(temp_docbox)
				{
					if(CLIENT_BROWSER == 'Firefox')
						var temp_display = getComputedStyle(temp_docbox, '').getPropertyValue('display');
					else
						var temp_display = temp_docbox.currentStyle.display;
					
					if(temp_display == 'block')
					{
						//temp_docbox.style.display = 'none';
						//AGexpandPlan('contract', AGFORMAT_T5_H, 'up');
						var temp_docboxC = document.getElementById('FamilyBox_'+tempIdentif+'c');
						if(temp_docboxC)
						{
							var temp_children = temp_docboxC.innerHTML;
							temp_children = parseInt(temp_children);
							// inchidem toate subbox-urile acestuia
							// extragem numarul copiilor box-ului pe care l-am inchis
							if(temp_children)
							{
								var nextIdentif = tempIdentif;
								var backs = new Array();
								var maximum = temp_children;
								for(i=1; i<=maximum; i++)
								{
									//alert('#'+nextIdentif+' + '+i+' = #'+nextIdentif+i);
									if(!nextIdentif && i> temp_children && !backs.length)
									{
										//alert('break1');
										break;
									}
									else
									if(backs.length)
									{
										nextIdentif = backs[backs.length-1];
										nextIdentif.pop();
										//alert('back1 ->'+nextIdentif+'; continue;');
										continue;
									}
									
									temp_docbox = document.getElementById('FamilyBox_'+nextIdentif+i);
									if(temp_docbox)
									{
										if(CLIENT_BROWSER == 'Firefox')
											var temp_display = getComputedStyle(temp_docbox, '').getPropertyValue('display');
										else
											var temp_display = temp_docbox.currentStyle.display;
										
										if(temp_display == 'block')
										{
											//alert('temp_display == block');
											AGexpandPlan('contract', AGFORMAT_T5_H, 'up');
											temp_docbox.style.display = 'none';
											// inregistram schimbarea in sesiune
											AGmyView_session('out', 'asc', nextIdentif+i);
											//
											var temp_docboxC = document.getElementById('FamilyBox_'+nextIdentif+'c');
											var temp_children = temp_docboxC.innerHTML;
											temp_children = parseInt(temp_children);
											
											if(temp_children)
											{
												//alert(temp_children);
												if(nextIdentif+i == nextIdentif+i)
													nextIdentif = nextIdentif+i;
												else
													backs[backs.length+1] = nextIdentif+i;
												i=0;
												maximum = temp_children;
												continue;
											}
											else
											{
												//alert('temp_children == 0');
												if(backs.length)
												{
													//alert('back2 ->'+nextIdentif+'; continue;');
													nextIdentif = backs[backs.length-1];
													nextIdentif.pop();
													continue;
												}
												else
													break;
											}
										}
										else
										{
											//alert('temp_display == none');
											if(backs.length)
											{
												//alert('back1 ->'+nextIdentif+'; continue;');
												nextIdentif = backs[backs.length-1];
												nextIdentif.pop();
												continue;
											}
											else
												break;
										}
									}
									else
									{
										/*alert('!temp_docbox');
										if(backs.length)
										{
											alert('back4 ->'+nextIdentif+'; continue;');
											nextIdentif = backs[backs.length-1];
											nextIdentif.pop();
											continue;
										}
										else
											break;*/
									}
								}
								
							}
						}
					}
				}
			
				
				//doc_icon.className = 'ag_userbox_icon_asc';
				
				doc_box.style.display = 'none';
				// inregistram schimbarea in sesiune
				AGmyView_session('out', 'asc', identifBox);
			}
		}
		// END   ASC ========================================================================
		//
		//
		// START DESC =======================================================================
		else
		if(direction == 'Desc')
		{
			if(box_display == 'none')
			{
				var str = identifBox;
				var strlen = AGstrlen(str);
				var last = str.charAt(str.length-1);
				var newstr = str.substr(0, strlen-1);
				if(last == '0')
					newstr += '1';
				else
					newstr += '0';
				// deschidem boxul tinta
				doc_box.style.display = 'block';
				// inregistram schimbarea in sesiune
				AGmyView_session('in', 'desc', identifBox);
				// schimbam starea iconului desc
				AGUBID_(identifBox, 'on');
			}
			else
			{
				var newstr = identifBox;
				// inchidem boxul tinta
				doc_box.style.display = 'none';
				// inregistram schimbarea in sesiune
				AGmyView_session('out', 'desc', identifBox);
				// schimbam starea iconului desc
				AGUBID_(identifBox, 'off');
			}
			
			var new_docbox = document.getElementById('FamilyBox_'+newstr);
			if(new_docbox)
			{
				new_docbox.style.display = 'none';
				// inregistram schimbarea in sesiune
				AGmyView_session('out', 'desc', newstr);
				// inchidem toate subboxurile acestuia
				var curent_identf = newstr;
				var n = 1;
				var continue1 = false;
				var continue2 = false;
				do
				{
					//alert('do with: '+curent_identf);
					if(!curent_identf)
					{
						//alert('break: curent_identf is empty');
						break;
					}
					else
					{
						var this_htmlid = 'FamilyBox_'+curent_identf;
						var this_docbox = document.getElementById(this_htmlid);
						this_docbox.style.display = 'none';
						// inregistram schimbarea in sesiune
						AGmyView_session('out', 'desc', curent_identf);
						// schimbam starea iconului desc
						AGUBID_(curent_identf, 'off');
					}
					
					
					if(AGFamilyMembers[curent_identf]['desc'][1])
					{
						var this1_identif = AGFamilyMembers[curent_identf]['desc'][1];
						var this1_htmlid = 'FamilyBox_'+this1_identif;
						var this1_docbox = document.getElementById(this1_htmlid);
						if(this1_docbox)
						{
							if(CLIENT_BROWSER == 'Firefox' || CLIENT_BROWSER == 'Safari')
								var this1_display = getComputedStyle(this1_docbox, '').getPropertyValue('display');
							else
								var this1_display = this1_docbox.currentStyle.display;
							if(this1_display == 'block')
							{
								//alert('#1 '+this1_identif+' is block');
								// il inchidem
								this1_docbox.style.display = 'none';
								// inregistram schimbarea in sesiune
								AGmyView_session('out', 'desc', this1_identif);
								// schimbam starea iconului desc
								AGUBID_(this1_identif, 'off');
								// ii resetam iconul pentru descendenti
								
								// continuam bucla
								//curent_identf = AGFamilyMembers[this1_identif]['desc'][1];
								curent_identf = this1_identif;
								continue1 = true;
							}
							else
							{
								//alert('#1 '+AGFamilyMembers[curent_identf]['desc'][1]+' is none');
								continue1 = false;
							}
						}
						else
						{
							//alert('#1 '+AGFamilyMembers[curent_identf]['desc'][1]+' is not exist family box');
							continue1 = false;
						}
					}
					else
					{
						//alert('#1/ '+curent_identf+'[1] array is NULL');
						continue1 = false;
					}
					
					if(!continue1)
					{
						if(AGFamilyMembers[curent_identf]['desc'][2])
						{
							var this2_identif = AGFamilyMembers[curent_identf]['desc'][2];
							var this2_htmlid = 'FamilyBox_'+this2_identif;
							var this2_docbox = document.getElementById(this2_htmlid);
							if(this2_docbox)
							{
								if(CLIENT_BROWSER == 'Firefox' || CLIENT_BROWSER == 'Safari')
									var this2_display = getComputedStyle(this2_docbox, '').getPropertyValue('display');
								else
									var this2_display = this2_docbox.currentStyle.display;
								if(this2_display == 'block')
								{
									//alert('#2 '+this2_identif+' is block');
									// il inchidem
									this2_docbox.style.display = 'none';
									// inregistram schimbarea in sesiune
									AGmyView_session('out', 'desc', this2_identif);
									// schimbam starea iconului desc
									AGUBID_(this2_identif, 'off');
									// ii resetam iconul pentru descendenti
									
									// continuam bucla
									//curent_identf = AGFamilyMembers[this2_identif]['desc'][2];
									curent_identf = this2_identif;
									continue2 = true;
									
								}
								else
								{
									//alert('#2 '+AGFamilyMembers[curent_identf]['desc'][2]+' is none');
									continue2 = false;
								}
							}
							else
							{
								//alert('#2 '+AGFamilyMembers[curent_identf]['desc'][2]+' is not exist family box');
								continue1 = false;
							}
						}
						else
						{
							//alert('#2/ '+curent_identf+'[2] array is NULL');
							continue2 = false;
						}
					}
					else
						continue2 = false;
					
					if(continue1 || continue2)
					{
						//alert('continue with: '+curent_identf);
						continue;
					}
					else
					{
						//alert('break');
						break;
					}
					
					n++;
				}
				while(n <= 10);
			}
		}
		// END   DESC =======================================================================
	}
}

function quickAddUser(action, id_tree, id_family, id_user, id_rel, this_family_identif, asc_family_identif, desc_family_identif, asc_family_id, desc_family_id)/* nu mai este necesar */
{
	// string action = open|close
	// int id_tree = (id-ul arborelui - este obligatoriu)
	// int id_family = (camp optional, daca este 0 se va crea o familie noua)
	// int id_rel = 1 - father | 2 - mother | 3 - children
	// int asc_id_user = (daca este > 0 inseamna ca familia ce urmeaza a fi introdusa descede din userul mentionat (adica userul respecit se va regasi in copii familiei nou create))
	// int desc_id_user = (daca este > 0 inseamna ca familia ce urmeaza a fi introdusa descede din userul mentionat (adica userul respecit se va regasi in copii familiei nou create))
	// int desc_id_rel = 1 - father | 2 - mother (pentru a putea stabili locul userului de legatura cu noua familie
	//alert('action = '+action+"\n"+'id_tree = '+id_tree+"\n"+'id_family = '+id_family+"\n"+'id_rel = '+id_rel+"\n"+'this_family_identif = '+this_family_identif+"\n"+'asc_family_identif = '+asc_family_identif+"\n"+'desc_family_identif = '+desc_family_identif+"\n"+'asc_family_id = '+asc_family_id+"\n"+'desc_family_id = '+desc_family_id+"\n");
	if(action == 'open')
	{
		var doc_box = document.getElementById('AG_quickAddUser');
		var doc_mask = document.getElementById('AG_PageMask');
	}
	else
	{
		var doc_box = parent.document.getElementById('AG_quickAddUser');
		var doc_mask = parent.document.getElementById('AG_PageMask');
	}
	
	if(doc_box)
	{
		if(action == 'open')
		{
			setOpacity(doc_mask, 0);
			setOpacity(doc_box, 0);
			
			if(doc_mask) doc_mask.style.display = 'block';
			doc_box.style.display = 'block';
			
			var local_url;
			local_url = ROOT+'modules/i_addUserBox.php?id_tree='+id_tree;
			local_url += '&amp;id_family='+id_family;
			local_url += '&amp;id_user='+id_user;
			local_url += '&amp;id_rel='+id_rel;
			local_url += '&amp;this_family_identif='+this_family_identif;
			local_url += '&amp;asc_family_identif='+asc_family_identif;
			local_url += '&amp;desc_family_identif='+desc_family_identif;
			local_url += '&amp;asc_family_id='+asc_family_id;
			local_url += '&amp;desc_family_id='+desc_family_id;
			local_url += '&amp;step=1';
			
			doc_box.innerHTML = '<iframe src="'+local_url+'" width="605" height="390" frameborder="0" scrolling="no" style="margin:5px;"></iframe>';
			//document.body.style.overflowY = 'hidden';
			if(doc_mask)
			{
				$('#AG_PageMask').animate({ opacity: "0.9"}, 1100, function() {});
			}
			$('#AG_quickAddUser').animate({ opacity: "1"}, 900, function() {});
		}
		else
		if(action == 'close')
		{
			$('#AG_quickAddUser', window.parent.document).animate({ opacity: "0"}, 900, function() {doc_box.style.display = 'none'; doc_box.innerHTML = ''; doc_mask.style.display = 'none'; });
			$('#AG_PageMask', window.parent.document).animate({ opacity: "0"}, 1100, function() {  });
		}
		else
		if(action == 'close_refresh')
		{
			if(AGmyIDUser > 0)
				window.parent.location = ROOT+'tree-'+AGmyIDTree+'/'+AGmyIDUser+'/';
			else
				window.parent.location = ROOT+'tree-'+AGmyIDTree+'/';
		}
	}
	
	return false;
}

function quickDeleteUser(action, id_tree, id_user, id_rel)/* nu mai este necesar */
{
	if(action == 'open')
	{
		var doc_box = document.getElementById('AG_quickDeleteUser');
		var doc_mask = document.getElementById('AG_PageMask');
	}
	else
	{
		var doc_box = parent.document.getElementById('AG_quickDeleteUser');
		var doc_mask = parent.document.getElementById('AG_PageMask');
	}
	
	if(doc_box)
	{
		if(action == 'open')
		{
			setOpacity(doc_mask, 0);
			setOpacity(doc_box, 0);
		  
			if(doc_mask) doc_mask.style.display = 'block';
			doc_box.style.display = 'block';
			doc_box.innerHTML = '<iframe src="'+ROOT+'modules/i_deleteUserBox.php?id_tree='+id_tree+'&amp;id_rel='+id_rel+'&amp;id_user='+id_user+'" width="605" height="390" frameborder="0" scrolling="no" style="margin:5px;"></iframe>';
			//document.body.style.overflowY = 'hidden';
			if(doc_mask)
			{
				$('#AG_PageMask').animate({ opacity: "0.9"}, 1100, function() {});
			}
			$('#AG_quickDeleteUser').animate({ opacity: "1"}, 900, function() {});
		}
		else
		if(action == 'close')
		{
			$('#AG_quickDeleteUser', window.parent.document).animate({ opacity: "0"}, 900, function() {doc_box.style.display = 'none'; doc_box.innerHTML = ''; doc_mask.style.display = 'none'; });
			$('#AG_PageMask', window.parent.document).animate({ opacity: "0"}, 1100, function() {  });
		}
		else
		if(action == 'close_refresh')
			window.parent.location = ROOT+'tree-'+AGmyIDTree+'/';
	}
}

function quickEditFamily(action, this_htmlid)
{
	var doc_box = document.getElementById(this_htmlid);
	if(doc_box)
	{
		if(action == 'open')
		{
			if(CLIENT_BROWSER == 'Firefox' || CLIENT_BROWSER == 'Safari')
				marginTop = getComputedStyle(doc_box, '').getPropertyValue('margin-top');
			else
				marginTop = doc_box.currentStyle.marginTop;
			marginTop = parseInt(marginTop);
			doc_box.style.height = '50px';
			doc_box.style.marginTop = (marginTop-15)+'px';
			
			//doc_box.onclick = function() { };
		}
		else
		if(action == 'close')
		{
			if(CLIENT_BROWSER == 'Firefox' || CLIENT_BROWSER == 'Safari')
				marginTop = getComputedStyle(doc_box, '').getPropertyValue('margin-top');
			else
				marginTop = doc_box.currentStyle.marginTop;
			marginTop = parseInt(marginTop);
			doc_box.style.height = '20px';
			doc_box.style.marginTop = (marginTop+15)+'px';
			
			//doc_box.onclick = function() { quickEditFamily('open', this_htmlid); };
		}
	}
}

function quickEditUser(action, id_user)
{
	if(action == 'open')
	{
		var doc_box = document.getElementById('quickEditUser');
		var doc_mask = document.getElementById('AG_PageMask');
		doc_mask.onclick = function() { return quickEditUser('close', ''); };
	}
	else
	{
		var doc_box = parent.document.getElementById('quickEditUser');
		var doc_mask = parent.document.getElementById('AG_PageMask');
	}
	
	if(doc_box)
	{
		if(action == 'open')
		{
			setOpacity(doc_mask, 0);
			setOpacity(doc_box, 0);
			
			if(doc_mask) doc_mask.style.display = 'block';
			doc_box.style.display = 'block';
			if(doc_mask)
			{
				$('#AG_PageMask').animate({ opacity: "0.9"}, 1100, function() {});
			}
			$('#quickEditUser').animate({ opacity: "1"}, 900, function() {});
		}
		else
		{
			$('#quickEditUser', window.parent.document).animate({ opacity: "0"}, 900, function() {doc_box.style.display = 'none'; doc_mask.style.display = 'none'; });
			$('#AG_PageMask', window.parent.document).animate({ opacity: "0"}, 1100, function() {  });
			
			//document.body.style.overflowY = 'scroll';
		}
	}
	
	return false;
}

function UserAdmin_duplicateBox(action, mod)/* nu mai este necesar */
{
	if(mod == 'import')
	{
		var htmlid_1 = 'quickEditUserStart';
		var htmlid_2 = 'quickEditUserImport';
		var doc_but_1 = document.getElementById('quickEditUserBTimport');
		var doc_but_2 = document.getElementById('quickEditUserBTcreate');
		var bt_nr1 = 'BT2';
		var bt_nr2 = 'BT1';
		var boxLink = 'boxLink1';
	}
	else
	if(mod == 'create')
	{
		var htmlid_1 = 'quickEditUserCreate';
		var htmlid_2 = 'quickEditUserStart';
		var doc_but_1 = document.getElementById('quickEditUserBTcreate');
		var doc_but_2 = document.getElementById('quickEditUserBTimport');
		var bt_nr1 = 'BT1';
		var bt_nr2 = 'BT2';
		var boxLink = 'boxLink2';
	}
	
	var doc_1 = document.getElementById(htmlid_1);
	var doc_2 = document.getElementById(htmlid_2);
	
	if(doc_1 && doc_2)
	{
		if(action == 'open')
		{
			if(doc_but_1)
			{
				doc_but_1.className = 'topMiniBox_'+bt_nr1+'_';
				doc_but_1.onclick = function() { return UserAdmin_duplicateBox('close', ''+mod+''); };
			}
			if(doc_but_2)
			{
				doc_but_2.className = 'topMiniBox_'+bt_nr2+'_d';
				doc_but_2.onclick = function() { };
			}
			
			if(mod == 'import')
				doc_2.style.display = 'block';
			else
				doc_1.style.display = 'block';
			
			$('#'+boxLink).animate({ opacity: "1"}, 1100, function() {});
			
			$('#'+htmlid_1).animate({
				marginLeft: "-490px"
			}, 1100, function() {});
			$('#'+htmlid_2).animate({
				marginLeft: "40px"
			}, 1100, function() {});
		}
		else
		{
			$('#'+boxLink).animate({ opacity: "0"}, 800, function() {});
			
			$('#'+htmlid_1).animate({
				marginLeft: "-225px"
			}, 1100, function() {
				if(doc_but_1)
				{
					doc_but_1.className = 'topMiniBox_'+bt_nr1;
					doc_but_1.onclick = function() { return UserAdmin_duplicateBox('open', ''+mod+''); };
				}
				if(doc_but_2)
				{
					doc_but_2.className = 'topMiniBox_'+bt_nr2;
					if(mod == 'import')
						doc_but_2.onclick = function() { return UserAdmin_duplicateBox('open', 'create'); };
					else
						doc_but_2.onclick = function() { return UserAdmin_duplicateBox('open', 'import'); };
				}
			});
			$('#'+htmlid_2).animate({
				marginLeft: "-225px"
			}, 1100, function() {
				if(mod == 'import')
					doc_2.style.display = 'none';
				else
					doc_1.style.display = 'none';
			});
		}
	}
	
	return false;
}

function UserAdmin_operation(operation)
{
	if(window.XMLHttpRequest) ajax = new XMLHttpRequest();
	else if(window.ActiveXObject) ajax = new ActiveXObject("Microsoft.XMLHTTP");
	var sURL = ROOT+'modules/ajax/';
	
	switch(operation)
	{
		case 'CREATE': // Create
		case 'CREATE_T': // Create Transfer
			var doc_box_primary = document.getElementById('quickEditUserStart');
			var doc_box_secundary = document.getElementById('quickEditUserCreate_Fix');	
			var doc_but_create = document.getElementById('BUT_QE_A1');
			var doc_but_create_C = document.getElementById('BUT_QE_A1-C');
			var doc_but_transfer = document.getElementById('BUT_QE_A2');
			var doc_but_transfer_C = document.getElementById('BUT_QE_A2-C');
			var doc_field_1 = document.getElementById('CREATE_firstname');
			var doc_field_2 = document.getElementById('CREATE_lastname');
			var doc_field_3 = document.getElementById('CREATE_gender');
			var doc_field_4 = document.getElementById('CREATE_image');
			var doc_field_5 = document.getElementById('CREATE_born');
			var doc_field_6 = document.getElementById('CREATE_deces');
			
			if(doc_field_1) var value_field_1 = doc_field_1.value; else var value_field_1 = '';
			if(doc_field_2) var value_field_2 = doc_field_2.value; else var value_field_2 = '';
			if(doc_field_3) var value_field_3 = doc_field_3.value; else var value_field_3 = '';
			if(doc_field_4) var value_field_4 = doc_field_4.value; else var value_field_4 = '';
			if(doc_field_5) var value_field_5 = doc_field_5.value; else var value_field_5 = '';
			if(doc_field_6) var value_field_6 = doc_field_6.value; else var value_field_6 = '';
			
			sURL += 'AG_UserAdmin_BoxCreate.php?ajax';
			sURL += '&operation='+operation;
			sURL += '&CREATE_firstname='+value_field_1;
			sURL += '&CREATE_lastname='+value_field_2;
			sURL += '&CREATE_gender='+value_field_3;
			sURL += '&CREATE_image='+value_field_4;
			sURL += '&CREATE_born='+value_field_5;
			sURL += '&CREATE_deces='+value_field_6;
			
			ajax.open("GET", sURL, false);
			ajax.setRequestHeader("User-Agent", navigator.userAgent);
			ajax.send();
			
			//alert(action+' '+direction+' '+identif_family);
			if(ajax.status == 200)
			{
				if(operation == 'CREATE')
				{
					doc_box_secundary.innerHTML = ajax.responseText;
					if(doc_but_create && doc_but_create_C)
					{
						var but_content = doc_but_create_C.innerHTML;
						doc_but_create.innerHTML = '<span id="BUT_QE_A1-C">'+but_content+'</span>';
					}
					if(doc_but_transfer && doc_but_transfer_C)
					{
						var but_content = doc_but_transfer_C.innerHTML;
						doc_but_transfer.innerHTML = '<a id="BUT_QE_A2-C" href="#" onclick="return UserAdmin_operation(\'CREATE_T\');">'+but_content+'</a>';
					}
				}
				else
				{
					// inchidem boxul
					UserAdmin_duplicateBox('close', 'create');
					// resetam boxul
					doc_box_secundary.innerHTML = ajax.responseText;
					if(doc_but_transfer && doc_but_transfer_C)
					{
						var but_content = doc_but_transfer_C.innerHTML;
						doc_but_transfer.innerHTML = '<span id="BUT_QE_A2-C">'+but_content+'</span>';
					}
					if(doc_but_create && doc_but_create_C)
					{
						var but_content = doc_but_create_C.innerHTML;
						doc_but_create.innerHTML = '<a id="BUT_QE_A1-C" href="#" onclick="return UserAdmin_operation(\'CREATE\');">'+but_content+'</a>';
					}
				}
			}
			else
				alert('Problema la trimiterea datelor (AJAX)');
			/* ////////////////////////////////////////////////////////////////////////////////////////////////////// */
			break;
		case 'CREATE_R': // Create Reset
			var doc_box = document.getElementById('quickEditUserCreate');
			/* ////////////////////////////////////////////////////////////////////////////////////////////////////// */
			break;
		case 'IMPORT_S': // Import Search
		case 'IMPORT_C': // Import Config
		case 'IMPORT_T': // Import Transfer
			var doc_box = document.getElementById('quickEditUserImport');
			/* ////////////////////////////////////////////////////////////////////////////////////////////////////// */
			break;
		case 'IMPORT_R': // Import Reset
			var doc_box = document.getElementById('quickEditUserImport');
			/* ////////////////////////////////////////////////////////////////////////////////////////////////////// */
			break;
		case 'EDIT': // Edit
			/* ////////////////////////////////////////////////////////////////////////////////////////////////////// */
			break;
		case 'DELETE': // Delete
			/* ////////////////////////////////////////////////////////////////////////////////////////////////////// */
			break;
	}
	
	return false;
}

function pop2operation(action, operation)
{
	if(action == 'open')
	{
		var doc_box = document.getElementById('pop2operation');
		var doc_mask = document.getElementById('AG_PageMask');
		doc_mask.onclick = function() { return pop2operation('close', ''); };
	}
	else
	{
		var doc_box = parent.document.getElementById('pop2operation');
		var doc_mask = parent.document.getElementById('AG_PageMask');
	}
	
	if(doc_box)
	{
		if(action == 'open')
		{
			var doc_hidden_getUrl = document.getElementById('pop2_hidden_getUrl');
			var doc_iframe = document.getElementById('pop2iframe');
			if(doc_iframe && doc_hidden_getUrl)
				doc_iframe.src = ROOT+'modules/i_pop2.php?operation='+operation+(doc_hidden_getUrl.value);
			
			setOpacity(doc_mask, 0);
			setOpacity(doc_box, 0);
			
			if(doc_mask) doc_mask.style.display = 'block';
			doc_box.style.display = 'block';
			if(doc_mask)
			{
				$('#AG_PageMask').animate({ opacity: "0.9"}, 1100, function() {});
			}
			$('#pop2operation').animate({ opacity: "1"}, 900, function() {});
		}
		else
		{
			$('#pop2operation', window.parent.document).animate({ opacity: "0"}, 900, function() {doc_box.style.display = 'none'; doc_mask.style.display = 'none'; });
			$('#AG_PageMask', window.parent.document).animate({ opacity: "0"}, 1100, function() {  });
			
			//document.body.style.overflowY = 'scroll';
		}
	}
	
	return false;
}

function pop2add(action, my_id_tree, my_id_family, my_id_user, my_id_rel, linked_id_user, linked_direction)
{
	var operation = 'import_search';
	if(action == 'open')
	{
		var doc_box = document.getElementById('pop2operation');
		var doc_mask = document.getElementById('AG_PageMask');
		doc_mask.onclick = function() { return pop2operation('close', ''); };
	}
	else
	{
		var doc_box = parent.document.getElementById('pop2operation');
		var doc_mask = parent.document.getElementById('AG_PageMask');
	}
	
	if(doc_box)
	{
		if(action == 'open')
		{
			var doc_iframe = document.getElementById('pop2iframe');
			if(doc_iframe)
			{
				var sURL = ROOT+'modules/i_pop2.php?operation='+operation;
				sURL += '&my_id_tree='+my_id_tree;
				sURL += '&my_id_family='+my_id_family;
				sURL += '&my_id_user='+my_id_user;
				sURL += '&my_id_rel='+my_id_rel;
				sURL += '&linked_id_user='+linked_id_user;
				sURL += '&linked_direction='+linked_direction;
				doc_iframe.src = sURL;
			}
			
			setOpacity(doc_mask, 0);
			setOpacity(doc_box, 0);
			
			if(doc_mask) doc_mask.style.display = 'block';
			doc_box.style.display = 'block';
			if(doc_mask)
			{
				$('#AG_PageMask').animate({ opacity: "0.9"}, 1100, function() {});
			}
			$('#pop2operation').animate({ opacity: "1"}, 900, function() {});
		}
		else
		{
			$('#pop2operation', window.parent.document).animate({ opacity: "0"}, 900, function() {doc_box.style.display = 'none'; doc_mask.style.display = 'none'; });
			$('#AG_PageMask', window.parent.document).animate({ opacity: "0"}, 1100, function() {  });
			
			//document.body.style.overflowY = 'scroll';
		}
	}
	
	return false;
}

function moveLR(direction, size)
{
	var doc_plan = document.getElementById('AGDynamic');
	size = parseInt(size);
	
	switch(direction)
	{
		case 'left':  $('#AGDynamic').animate({ marginLeft: '-='+size+'px' }, 800, function() {}); /*alert(marginLeft+' - '+size+' = '+(marginLeft-size));*/ break;
		case 'right': $('#AGDynamic').animate({ marginLeft: '+='+size+'px' }, 800, function() {}); break;
	}
}

window.onload = AGpozitionare_scroll;