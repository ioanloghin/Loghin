{include file='header.tpl'}

	{if $hideContent != 1}
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable"> 
		<tr> 
			<td class="gridHeader" style="text-align:left">Manage Sugestions</td>
            <td class="gridHeader nowrap" width="100">{'Image'|lang}</td>
			<td class="gridHeader nowrap" width="90">{'Createdate'|lang}</td> 
			<td class="gridHeader nowrap" colspan="3">{'actions'|lang}</td> 
		</tr>
        {foreach $fields AS $item}
        <tr class="gridTr"> 
			<td class="gridRow{if $item@index % 2 ==0}1{else}2{/if}">
			   <span style="font-weight:bold;font-size:13px">{$item.heading}</span> 
			<br>{$item.discription}</td>
            <td class="gridOptions nowrap">	<img src="uploads/{$item.image}" alt="" style="height:50px;width:65px" border="0" /></td>
			<td class="gridOptions nowrap" style="text-align:center">{$item.ctime}</td> 
			 
			
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="{$vir_cp_path}index.php?m=editdataSuggestion&p=edit&id={$item@key}" title="{'edit'|lang}"> 
					<img src="{$vir_tpl_path}media/actions/edit.gif" alt="{'edit'|lang}" border="0" />
                </a>
			</td> 
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="{$vir_cp_path}index.php?m=editSugestions&p=delete&id={$item@key}&page={$page}" onclick="return confirm('{'delete?'|lang}');" title="{'delete'|lang}">
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