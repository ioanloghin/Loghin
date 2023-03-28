{include file='header.tpl'}


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
          <span>Add Dictionary</span>
          <div class="dropdown-content">
      {foreach $language AS $item}
          <p><a  style="font-size:13px;" href="{$vir_cp_path}index.php?m=langContent&p=add&id={$item@key}">{$item.language}</a></p>
           {/foreach}
          </div>
        </div> 



  <table cellpadding="0" cellspacing="1" width="100%" class="gridTable" style="margin-top:5px;">
		<tr>
		
			<td class="gridHeader">Language</td>
		    <td class="gridHeader">Languge_code</td>
		    <td class="gridHeader nowrap">Status</td>
			<td class="gridHeader nowrap">Actions</td>
		
		</tr>
		
	  {foreach $language AS $item}
        <tr class="gridTr"> 
        
        <td class="gridRow{if $item@index % 2 == 0}1{else}2{/if}">
            	<a class="grid" href="{$vir_cp_path}index.php?m=layoutsLanguage&p=edit&id={$item@key}" title="{'edit'|lang}">{$item.language}</a>
         </td>
          <td class="gridOptions nowrap">{$item.language_code}</td>
	
		  <td class="gridOptions nowrap">{$item.status}</td>
		  	<td class="gridActions" width="24" style="text-align:center">
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="{$vir_cp_path}index.php?m=layoutsLanguage&p=edit&id={$item@key}">Edit</a></li>
			                                                                                    
					<li><a href="{$vir_cp_path}index.php?m=layoutsLanguage&p=delete&id={$item@key}" onclick="return confirm('{'delete?'|lang}')" >Delete</a></li>
				</ul>
			</td>
		
		</tr>
        {/foreach}
      
     
       
</table>


{include file='footer.tpl'}