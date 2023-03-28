function detectIe6()
{
	var isIE6 = navigator.userAgent.toLowerCase().indexOf('msie 6') != -1;
	var isIE55 = navigator.userAgent.toLowerCase().indexOf('msie 5.5') != -1;
	
	var images_root = 'design/imagini/';
	var layout = 'layout2/';
	
	var fix_elements = new Array();
	fix_elements[1] = 'ul';
	fix_elements[2] = 'li';
	fix_elements[3] = 'div';
	fix_elements[4] = 'a';
	fix_elements[5] = 'span';
	
	var vector = new Array();
	var this_key = '';
	var this_url = '';
	var this_extension = '';
	for(n=1; n<=fix_elements.length; n++)
	{
		this_key = fix_elements[n];
		vector[this_key] = document.getElementsByTagName(this_key);
		//
		// verificam daca are backgroundImage de tip PNG
		for(i=0; i<vector[this_key].length; i++)
		{
			if(vector[this_key][i].currentStyle.backgroundImage != '')
			{
				this_url = vector[this_key][i].currentStyle.backgroundImage;
				this_url = this_url.replace('url(', '');
				
				this_url = this_url.replace(')', '');
				this_url = this_url.replace(';', '');
				this_url = this_url.replace(/"/g, '');
				this_url = this_url.replace(/'/g, '');
				
				this_extension = this_url.substring(this_url.length-4, this_url.length);
				if(this_extension == '.png' || this_extension == '.PNG')
				{
					if(isIE6 || isIE55)
					{
						vector[this_key][i].style.backgroundImage = "none";
						vector[this_key][i].style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+this_url+"',sizingMethod='scale');";
						
					}
					else
					{
						//vector[this_key][i].style.backgroundImage = "none";
						//alert(vector[this_key][i].style.backgroundImage);break;
					}
					
				}
				this_url = '';
				this_extension = '';
			}
		}
	}
	
	

	
}

window.onload = detectIe6;