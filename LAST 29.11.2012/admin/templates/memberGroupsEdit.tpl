{include file='header.tpl'}
    {if $hideContent != 1}
	<div style="position:relative;padding-top:31px">
		<table id="fixed" cellpadding="0" cellspacing="1" width="100%" class="gridTable" style="position:absolute;width:100%;top:0">
			<tr>
				<td class="gridHeader nowrap" colspan="2" style="text-align:left">
					{'edit_group'|lang}
				</td>
			</tr>
		</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
    <form method="post" action="">
		<tr>
			<td class="gridLabels nowrap" width="240">
				{'name'|lang}
				<span class="required">*</span>
			</td>
			<td class="gridValue">
				<input class="inputText" type="text" name="name" value="{$name}" maxlength="64" />
			</td>
		</tr>
		{if $id == 0}
		<tr>
			<td class="gridLabels nowrap" width="240" style="text-align:left">
				{'duplicate'|lang}
			</td>
			<td class="gridValue">
				<select class="inputCombo" name="duplicate">
					{html_options options=$groups selected=$duplicate}
				</select>
			</td>
		</tr>
		{/if}
		<tr>
			<td class="gridFooter" colspan="2">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
			</td>
		</tr>
		<input type="hidden" name="isGroup" value="1" />
    </form>
	</table>
	</div>
	{/if}
{include file='footer.tpl'}