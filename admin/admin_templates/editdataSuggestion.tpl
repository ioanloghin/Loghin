{include file='header.tpl'}
    {if $hideContent != 1}
	<form action="" method="post" enctype='multipart/form-data'>
	<table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#row_settigns').toggle();">Add Sugestions</a>
                  	</div>
                    <div class="right">
                    	
                    </div>
              	</div>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="row_settigns">
		<tr>
			<td class="gridLabels" width="300"  nowrap>

            heading 
			</td>
			<td class="gridValue">
		   <input class="inputText" type="text" id="cheading" name="cheading" value="{$heading}" style="height:22px">

			</td>
		</tr>
		
		<tr>
			<td class="gridLabels" width="300" nowrap>

            Discription
			</td>
			<td class="gridValue">
		  
		   <input class="inputText" name="discription"   value="{$discription}"
		  style="height:70px">
			</td>
		</tr>
	
			<tr>
			<td class="gridLabels" width="300" nowrap>

            Image
			</td>
			<td class="gridValue">
		  <input type="file" name="image" >

			</td>
		</tr>   
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
				<input type="hidden" name="issuggest" value="1" />
			</td>
		</tr>
	</table>
	</form>
	{/if}
{include file='footer.tpl'}