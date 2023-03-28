{include file='header.tpl'}
    {if $hideContent != 1}
	<form action="" method="post">
	<table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#rowEmailTemplates').toggle();">{$name}</a>
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
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowEmailTemplates">
		<tr>
			<td class="gridLabels" width="130" nowrap>
				{'subject'|lang}
			</td>
			<td class="gridValue">
				{foreach $subject AS $lang => $value}
					<input class="inputText lang__{$lang}{if $lang != $sys_lang} hide{/if}" style="width:500px" type="text" name="subject[{$lang}]" maxlength="255" value="{$value}" />
                {/foreach}
			</td>
		</tr>
		<tr>
			<td class="gridLabels" width="130" nowrap>
				{'body'|lang}
			</td>
			<td class="gridValue">
				{foreach $body AS $lang => $value}
				<div class="lang__{$lang}{if $lang != $sys_lang} hide{/if}">
					<textarea class="inputTextarea ckeditor" name="body[{$lang}]" cols="50" rows="8" style="width:605px;height:200px">{$value}</textarea>
				</div>
				{/foreach}
			</td>
		</tr>
		<tr>
			<td class="gridHeader" colspan="2" style="text-align:left">
				<a href="javascript:void(0);" onclick="$('._row_keywords_').toggle();">Allowed keywords</a>
			</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{website}{/literal}
           	</td>
			<td class="gridValue">
				{'i_website'|lang}
           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{email}{/literal}
           	</td>
			<td class="gridValue">
				{'i_email'|lang}
           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{name}{/literal}
           	</td>
			<td class="gridValue">
				{'i_name'|lang}
           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{firstname}{/literal}
           	</td>
			<td class="gridValue">
				{'i_firstname'|lang}
           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{lastname}{/literal}
           	</td>
			<td class="gridValue">
				{'i_lastname'|lang}
           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{subject}{/literal}
           	</td>
			<td class="gridValue">
				{'i_subject'|lang}
           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{street}{/literal}
           	</td>
			<td class="gridValue">
				{'i_street'|lang}
           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{zip}{/literal}
           	</td>
			<td class="gridValue">
				{'i_zip'|lang}
           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{city}{/literal}
           	</td>
			<td class="gridValue">
				{'i_city'|lang}
           	</td>
		</tr>		
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{phone}{/literal}
           	</td>
			<td class="gridValue">
				{'i_phone'|lang}
           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{message}{/literal}
           	</td>
			<td class="gridValue">
				{'i_message'|lang}
           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{ldelim}property{rdelim}
			</td>
			<td class="gridValue">
				{'i_property'|lang}
			</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{ldelim}contact{rdelim}
			</td>
			<td class="gridValue">
				{'i_contact'|lang}
			</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{literal}{action_link}{/literal}
           	</td>
			<td class="gridValue">
				{'i_action_link'|lang}
           	</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
				<input type="hidden" name="isemailtemplates" value="1" />
			</td>
		</tr>
	</table>
    </form>
	{/if}
{include file='footer.tpl'}