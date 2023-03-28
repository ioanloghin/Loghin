{include file='header.tpl'}
{if $hideContent != 1}

  <table cellpadding="0" cellspacing="1" width="100%" class="gridTable" style="margin-top:5px;">
		<tr>
		
			<td class="gridHeader">Country</td>
		    <td class="gridHeader">Multiple Lang code</td>
		    <td class="gridHeader">IP Language</td>
		    <td class="gridHeader nowrap">Status</td>
			<td class="gridHeader nowrap">Actions</td>
		
		</tr>
		
		  {foreach $fields AS $item}
        <tr class="gridTr"> 
        
        <td class="gridRow{if $item@index % 2 == 0}1{else}2{/if}">
            	<a class="grid" href="{$vir_cp_path}index.php?m=layoutsCountry&p=edit&id={$item@key}" title="{'edit'|lang}">{$item.name}</a>
         </td>
        
          
	    <td class="gridRow{if $item@index % 2 == 0}1{else}2{/if}">
            	<a class="grid" href="{$vir_cp_path}index.php?m=layoutsCountry&p=edit&id={$item@key}" title="{'edit'|lang}">{$item.multiple_lang}</a>
         </td>
         
         <td class="gridRow{if $item@index % 2 == 0}1{else}2{/if}">
            	<a class="grid" href="{$vir_cp_path}index.php?m=layoutsCountry&p=edit&id={$item@key}" title="{'edit'|lang}">{$item.IP_lang}</a>
         </td>
         
		  <td class="gridOptions nowrap">{$item.status}</td>
		  	<td class="gridActions" width="24" style="text-align:center">
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="{$vir_cp_path}index.php?m=layoutsCountry&p=edit&id={$item@key}">Edit</a></li>
			
					<li><a href="{$vir_cp_path}index.php?m=layoutsCountry&p=delete&id={$item@key}" onclick="return confirm('{'delete?'|lang}')" >Delete</a></li>
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