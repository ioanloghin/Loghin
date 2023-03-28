{include file='header.tpl'}
    {if $hideContent != 1}
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<th class="gridHeader" width="50">{'id'|lang}</th>
			<th class="gridHeader nowrap" style="text-align:left">{'name'|lang}</th>
			<th class="gridHeader nowrap" width="70">{'label'|lang}</th>
			<th class="gridHeader nowrap" width="30">{'actions'|lang}</th>
		</tr>
		{foreach $fields AS $field}
		<tr class="gridTr">
			<td class="gridOptions" style="text-align:center">
				{$field@key}
			</td>
			<td class="gridHeader" colspan="2" style="text-align:left">
				<a href="{$vir_cp_path}index.php?m=membergroups&p=editAction&id={$field@key}"><strong>{$field.name}</strong></a>
			</td>
			<td class="gridActions">
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="{$vir_cp_path}index.php?m=membergroups&p=editAction&id={$field@key}">{'edit_action'|lang}</a></li>
					<li><a href="{$vir_cp_path}index.php?m=membergroups&p=deleteAction&id={$field@key}" onclick="return confirm('{'delete_action?'|lang}')">{'delete_action'|lang}</a></li>
				</ul>
			</td>
		</tr>
			{foreach $field.items AS $item}
			<tr class="gridTr">
				<td class="gridOptions" style="text-align:center">
					{$item@key}
				</td>
				<td class="gridRow{if $item@index % 2 ==0}1{else}2{/if}" style="padding-left:40px">
					<a href="{$vir_cp_path}index.php?m=membergroups&p=editAction&id={$item@key}">{$item.name}</a>
				</td>
				<td class="gridOptions" style="text-align:left">{$item.label}</td>
				<td class="gridActions">
					<a class="action" href="javascript:void(0);">&nbsp;</a>
					<ul class="opmenu">
						<li><a href="{$vir_cp_path}index.php?m=membergroups&p=editAction&id={$item@key}">{'edit_action'|lang}</a></li>
						<li><a href="{$vir_cp_path}index.php?m=membergroups&p=deleteAction&id={$item@key}" onclick="return confirm('{'delete_action?'|lang}')">{'delete_action'|lang}</a></li>
					</ul>
				</td>
			</tr>
			{/foreach}
		{/foreach}
	</table>
	{/if}
{include file='footer.tpl'}