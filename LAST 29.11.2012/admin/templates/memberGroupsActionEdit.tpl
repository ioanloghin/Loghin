{include file='header.tpl'}
    {if $hideContent != 1}
	<form action="" method="post">
	<table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#rowGroupsAction').toggle();">{$appPage}</a>
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
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowGroupsAction">
		<tr>
			<td class="gridLabels nowrap" width="130">
				{'parent'|lang}
			</td>
			<td class="gridValue">
				<select class="inputCombo" name="parent">
					<option value="">{'select_option'|lang}</option>
					{html_options options=$parents selected=$parent}
				</select>
			</td>
		</tr>
		<tr>
			<td class="gridLabels" width="130" nowrap>
				{'label'|lang} <span class="required">*</span>
			</td>
			<td class="gridValue">
				<input class="inputText" type="text" name="label" value="{$label}" maxlength="100" />
			</td>
		</tr>
		<tr>
			<td class="gridLabels" width="130">
				{'action_name'|lang}
			</td>
			<td class="gridValue">
				{foreach $name AS $lang => $value}
					<input class="inputText lang__{$lang}{if $lang != $sys_lang} hide{/if}" style="width:500px" type="text" name="name[{$lang}]" maxlength="255" value="{$value}" />
                {/foreach}
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
				<input type="hidden" name="isGroupAction" value="1" />
			</td>
		</tr>
	</table>
    </form>
	{/if}
{include file='footer.tpl'}