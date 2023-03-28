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
		
				<input class="" type="text" name="language" value="{$language}"  maxlength="255"/>
		    
			</td>
		
		</tr>
		
		 <tr>
			<td class="gridLabels" style="width:140px">
			{'code'|lang} <span class="required">*</span>
			</td>
			<td class="gridValue">
		     
				<input class="" type="text" name="language_code" value="{$language_code}" maxlength="255"/>
		    
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
        </tr>
		    
		 </table>
		   <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
				<input type="hidden" name="islanguage" value="1" />
			</td>
		</tr>
	</table>
	</form>



















{include file='footer.tpl'}