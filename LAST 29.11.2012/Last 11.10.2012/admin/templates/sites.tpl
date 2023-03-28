{include file='header.tpl'}
	{if $hideContent != 1}
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable"> 
		<tr> 
			<td class="gridHeader" style="text-align:left">{'name'|lang}</td>
			<td class="gridHeader">{'type'|lang}</td>
			<td class="gridHeader nowrap" width="60">{'languages'|lang}</td>
			<td class="gridHeader nowrap" width="60">{'status'|lang}</td>
			<td class="gridHeader nowrap">{'actions'|lang}</td> 
		</tr>
        {foreach $items AS $item}
        <tr class="gridTr"> 
			<td class="gridRow{if $item@index % 2 == 0}1{else}2{/if}">
            	<a class="grid" href="{$vir_cp_path}index.php?m=sites&p=edit&id={$item@key}" title="{'edit'|lang}">{$item.name}</a>
           	</td>
           	<td class="gridOptions nowrap">{$item.type}</td>
			<td class="gridOptions nowrap">{$item.languages}</td>
            <td class="gridOptions nowrap">{$item.status}</td>
			<td class="gridActions" width="24" style="text-align:center">
				<a class="action" href="javascript:void(0);">&nbsp;</a> 
				<ul class="opmenu">
					<li><a href="{$vir_cp_path}index.php?m=sites&p=edit&id={$item@key}">{'edit'|lang}</a></li>
					{if !$id}<li><a href="{$vir_cp_path}index.php?m=sites&id={$item@key}">{'manage_subsites'|lang}</a></li>{/if}
					<li><a href="{$vir_cp_path}index.php?m=sites&p=delete&id={$item@key}&page={$page}" onclick="return confirm('{'delete?'|lang}')">{'delete'|lang}</a></li>
				</ul>
			</td> 
		</tr>
        {/foreach}
	</table>
	{if $pages}<table cellpadding="0" cellspacing="1" width="100%" class="gridTable"> 
        <tr>
			<td class="gridFooter" style="padding:0px"> 
				<p>{$pages}</p>
			</td>
		</tr>
    </table>{/if}
    {/if}
{include file='footer.tpl'}