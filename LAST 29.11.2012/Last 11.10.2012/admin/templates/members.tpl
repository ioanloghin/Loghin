{include file='header.tpl'}
	{if $hideContent != 1}
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable"> 
		<tr> 
			<td class="gridHeader" style="text-align:left">{'email'|lang}</td>
            <td class="gridHeader nowrap" width="100">{'group'|lang}</td>
			<td class="gridHeader nowrap" width="90">{'joindate'|lang}</td> 
			<td class="gridHeader nowrap" colspan="3">{'actions'|lang}</td> 
		</tr>
        {foreach $fields AS $item}
        <tr class="gridTr"> 
			<td class="gridRow{if $item@index % 2 ==0}1{else}2{/if}"><a class="grid toolpiclink" href="{$vir_cp_path}index.php?m=members&p=edit&id={$item@key}">{$item.email}</a></td>
            <td class="gridOptions nowrap">{$item.group}</td>
			<td class="gridOptions nowrap" style="text-align:center">{$item.joindate}</td> 
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="{$vir_cp_path}index.php?m=members&p={$item.active|ifelse:1:'active':'inactive'}&id={$item@key}&page={$page}" title="{$item.active|ifelse:1:{'active'|lang}:{'inactive'|lang}}"> 
					<img src="{$vir_tpl_path}media/options/active_{$item.active|ifelse:1:'on':'off'}.gif" alt="Profile {$item.active|ifelse:1:'online':'offlie'}" border="0" />
                </a> 
			</td> 
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="{$vir_cp_path}index.php?m=members&p=edit&id={$item@key}" title="{'edit'|lang}"> 
					<img src="{$vir_tpl_path}media/actions/edit.gif" alt="{'edit'|lang}" border="0" />
                </a>
			</td> 
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="{$vir_cp_path}index.php?m=members&p=delete&id={$item@key}&page={$page}" onclick="return confirm('{'delete?'|lang}');" title="{'delete'|lang}">
					<img src="{$vir_tpl_path}media/actions/delete.gif" alt="{'edit'|lang}" border="0" />
                </a>
			</td> 
		</tr>
        {/foreach}
        <tr>
			<td class="gridFooter" colspan="6" style="padding:0px"> 
				<p>{$pages}</p>
			</td>
		</tr>
    </table>
    {/if}
{include file='footer.tpl'}