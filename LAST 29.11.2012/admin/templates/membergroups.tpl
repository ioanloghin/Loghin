{include file='header.tpl'}
    {if $hideContent != 1}
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<th class="gridHeader" width="50">{'id'|lang}</th>
			<th class="gridHeader nowrap" style="text-align:left">{'name'|lang}</th>
			{foreach $fields AS $field}
			<th class="gridHeader gridActions nowrap">
				{$field.name} ({$field.members})
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="{$vir_cp_path}index.php?m=membergroups&p=edit&id={$field@key}">{'edit'|lang}</a></li>
					<li><a href="{$vir_cp_path}index.php?m=membergroups&p=delete&id={$field@key}" onclick="return confirm('{'delete?'|lang}')">{'delete'|lang}</a></li>
				</ul>
			</th>
			{/foreach}
		</tr>
		{foreach $actions AS $field}
		<tr class="gridTr">
			<td class="gridOptions" width="46" style="text-align:center">
				{$field@key}
			</td>
			<td class="gridHeader" colspan="{count($fields) + 1}" style="text-align:left">
				<a href="{$vir_cp_path}index.php?m=membergroups&p=editAction&id={$field@key}"><strong>{$field.name}</strong></a>
			</td>
		</tr>
			{foreach $field.items AS $item}
			<tr class="gridTr">
				<td class="gridOptions" style="text-align:center">
					{$item@key}
				</td>
				<td class="gridRow{if $item@index % 2 ==0}1{else}2{/if}" style="padding-left:20px">
					<a href="{$vir_cp_path}index.php?m=membergroups&p=editAction&id={$item@key}">{$item.name}</a>
				</td>
				{foreach $fields AS $_field}
				<td class="gridOptions"><a class="changeOption" href="javascript:void(0);" rel="{$item.label}|{$_field@key}"><img src="{$vir_tpl_path}media/{if isset($_field.permiss[$item.label]) && $_field.permiss[$item.label]}tick{else}cross{/if}.png" alt="" /></a></td>
				{/foreach}
			</tr>
			{/foreach}
		{/foreach}
	</table>
	<script type="text/javascript">{strip}
	$(function()
	{
		$('.changeOption').bind('click', function()
		{
			var obj = $(this);
			var enable = $('img', obj).attr('src').indexOf('tick') != '-1' ? false : true;
			$('img', obj).attr('src', '{$vir_tpl_path}media/loading.gif');
			$.post($.conf.vir_path +'index.php?m=membergroups', { 'id': $(obj).attr('rel'), 'e': enable }, function(data)
			{
				if (data.error == true) {
					alert(data.errorDescription);
				}
				else if (data.success == true) {
					$('img', obj).attr('src', data.img);
				}
			}, 'json');
		});
	});
	{/strip}</script>
	{/if}
{include file='footer.tpl'}