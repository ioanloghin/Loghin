{include file='header.tpl'}
	{if $hideContent != 1}
	<form action="" method="post">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs">
				<a href="javascript:void(0);" onclick="$('#rowLayoutsGroup').toggle();">{'edit_layout_group'|lang}</a>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowLayoutsGroup">
    	<tr>
        	<td class="gridLabels">
            	{'name'|lang} <span class="required">*</span>
            </td>
            <td class="gridValue">
            	<input class="inputText" style="width:300px" type="text" name="name" value="{$name}" />
            </td>
        </tr>
		<tr>
			<td class="gridLabels">
				{'info'|lang}
			</td>
			<td class="gridValue"> 
				<input class="inputText" style="width:300px" type="text" name="info" maxlength="64" value="{$info}" />
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
				{'link'|lang}
			</td>
			<td class="gridValue">
				<input class="inputText" style="width:300px" type="text" name="url" maxlength="64" value="{$url}" />
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
				{'text_top'|lang}
           	</td>
			<td class="gridValue">
				<input class="inputText" style="width:300px" type="text" name="text_top" maxlength="33" value="{$text_top}" />
			</td>
		</tr>
        <tr>
            <td class="gridLabels">
                {'text_bottom'|lang}
            </td>
            <td class="gridValue">
                <input class="inputText" style="width:300px" type="text" name="text_bottom" maxlength="20" value="{$text_bottom}" />
            </td>
        </tr>
        <tr>
        	<td class="gridLabels">
            	{'extension'|lang}
            </td>
            <td class="gridValue">
            	<select class="inputCombo" name="extension">
                	{html_options options=$extensions selected=$extension_id}
                </select>
            </td>
        </tr>
   	</table>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
				<input type="hidden" name="isLayoutGroup" value="1" />
			</td>
		</tr>
	</table>
    </form>
	{/if}
{include file='footer.tpl'}