{include file='header.tpl'}

	<form action="" method="post" enctype="multipart/form-data">
	    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#rowNew').toggle();">{$appPage}</a>
                  	</div>
                    <div class="right">
                    	<select class="inputCombo" id="toggleLanguage">
                        	{html_options options=$languages selected=$sys_lang}
                        </select>
                    </div>
              	</div>
			</td>
		</tr>
	</table>
		<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowNew">
		    <tr>
			<td class="gridLabels" style="width:140px">
				{'name'|lang} <span class="required">*</span>
			</td>
			<td class="gridValue">
		
				<input class="" type="text" name="name" value="{$name}"  maxlength="255"/>
		    
			</td>
		
		</tr>
		
		<tr>
			<td class="gridLabels" style="width:140px">
			{'multiple language'|lang} <span class="required">*</span>
			</td>
			<td class="gridValue">
		     
				<input class="" type="text" name="multiple_lang" value="{$multiple_lang}" maxlength="255"/>
		    
			</td>
		
		</tr>
		
			<tr>
			<td class="gridLabels" style="width:140px">
			{'IP language'|lang} <span class="required">*</span>
			</td>
			<td class="gridValue">
		     
				<input class="" type="text" name="IP_lang" value="{$IP_lang}" maxlength="255"/>
		    
			</td>
		
		</tr>
		
		 
		<tr>
        	<td class="gridLabels">
            	{'status'|lang}
            </td>
            <td class="gridValue">
            	<select class="inputCombo" name="status">
                	{html_options options=$status selected=$statuse}
                </select>
            </td>
            </td>
        </tr>
		    
		 </table>
		   <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
				<input type="hidden" name="iscountry" value="1" />
			</td>
		</tr>
	</table>
	</form>
 <script type="text/javascript">
    $(function() {
	    var group = $('select[name="group"]').closest('tr');
    	$('select[name="type"]').bind('change', function() {
    		if ($('#parent_'+ $(this).val()).length) {
    			$('div[id*="parent_"]').addClass('hide');
    			$('#parent_'+ $(this).val()).removeClass('hide');
    		}
    	});
	    $('select[name^="parent"]').on('change', function() {
		    if ($(this).val() != 0) {
			    group.hide();
            }
		    else {
			    group.show();
            }
	    }).parent(':not(.hide)').find('select').trigger('change');
    });
    </script>
{include file='footer.tpl'}