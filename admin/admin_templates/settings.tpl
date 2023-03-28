{include file='header.tpl'}
    {if $hideContent != 1}
	<form action="" method="post">
	<table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#row_settigns').toggle();">{$group_name}</a>
                  	</div>
                    <div class="right">
                    	{if !$empty}<select class="inputCombo" id="toggle_language">
                        	{html_options options=$languages selected=$sys_lang}
                        </select>{/if}
                    </div>
              	</div>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="row_settigns">
	{foreach $fields AS $item}
		<tr>
			<td class="gridLabels" width="300" nowrap>
				{$item.name}
			</td>
			<td class="gridValue">
				{if $item.type == "text_ln"}
					{foreach $item.value AS $lang => $value}
						<input class="inputText __lang__{$lang}__{if $lang != $sys_lang} hide{/if}" type="text" name="{$item.label}[{$lang}]" value="{$value}" size="50" />
					{/foreach}
				{elseif $item.type == "textarea_ln"}
					{foreach $item.value AS $lang => $value}
						<textarea class="inputTextarea __lang__{$lang}__{if $lang != $sys_lang} hide{/if}" name="{$item.label}[{$lang}]" cols="50" rows="4">{$value}</textarea>
					{/foreach}
				{elseif $item.type == "text"}
					<input type="text" class="inputText" name="{$item.label}" value="{$item.value}" size="50" />
				{elseif $item.type == "textarea"}
					<textarea name="{$item.label}" cols="40" rows="4" class="inputTextarea">{$item.value}</textarea>
				{elseif $item.type == "email"}
					<input type="text" class="inputText" name="{$item.label}" value="{$item.value}" size="50" />
				{elseif $item.type == "number"}
					<input type="text" class="inputText" name="{$item.label}" value="{$item.value}" size="10" />
				{elseif $item.type == "boolean"}
					<select class="inputCombo" name="{$item.label}">
						{html_options options=$yesnobox selected=$item.value}
					</select>
				{/if}
			</td>
		</tr>
	{/foreach}
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
				<input type="hidden" name="issettings" value="1" />
			</td>
		</tr>
	</table>
	</form>
	{/if}
{include file='footer.tpl'}