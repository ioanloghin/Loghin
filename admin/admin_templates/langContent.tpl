{include file='header.tpl'}
 {if $hideContent != 1}   
    
    
<style>
.dropdown {
  position: relative;
  display: inline-block;
  margin-bottom:20px;
  color: #fff;
    background-color: #286090;
    border-color: #204d74;
    padding: 10px;
    border-radius: 4px;
    margin-top:20px;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
      font-size: 16px
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>    
    
    
    

        <div class="dropdown">
          <span>Add Page In Languages</span>
          <div class="dropdown-content">
        {foreach $language_code AS $item} 
          <p><a  style="font-size:13px;" href="{$vir_cp_path}index.php?m=langContent&p=add&id={$item@key}">{$item.language}</a></p>
          {/foreach}
          </div>
        </div>    
    
      
    
    

<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" style="margin-top:5px;">
		<tr>
		
			<td class="gridHeader">Parent</td>
		    <td class="gridHeader">Title</td>
		    <td class="gridHeader nowrap">Short Title</td>
			<td class="gridHeader nowrap">Page Title</td>
			<td class="gridHeader nowrap">Content</td>
			<td class="gridHeader nowrap">Language</td>
			<td class="gridHeader nowrap">Action</td>
		
		</tr>
		 
	{foreach $item_data AS $content}
        <tr class="gridTr"> 
        
        <td class="gridRow{if $item@index % 2 == 0}1{else}2{/if}">
            	<a class="grid" href="{$vir_cp_path}index.php?m=layoutsLanguage&p=edit&id=" title="{'edit'|lang}">{$content.item1}</a>
         </td>
          <td class="gridOptions nowrap">{$content.item2}</td>
          
          <td class="gridOptions nowrap">{$content.item3}</td>
          
	    <td class="gridOptions nowrap">{$content.item4}</td>
	    
		  <td class="gridOptions nowrap">{$content.item5}</td>
		  
		    <td class="gridOptions nowrap">{$content.language_id}</td>
		  
		  	<td class="gridActions" width="24" style="text-align:center">
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="{$vir_cp_path}index.php?m=layoutsLanguage&p=edit&id=">Edit</a></li>
			                                                                                    
					<li><a href="{$vir_cp_path}index.php?m=layoutsLanguage&p=delete&id=" onclick="return confirm('{'delete?'|lang}')" >Delete</a></li>
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