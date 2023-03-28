{include file='header.tpl'}
	{if $hideContent != 1}
	<form action="" method="post">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs">
				<a href="javascript:void(0);" onclick="$('#row_account').toggle();">{if $id}{'edit_member'|lang}{else}{'add_member'|lang}{/if}</a>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="row_account">
    	<tr>
        	<td class="gridLabels">
            	{'username'|lang} <span class="required">*</span>
            </td>
            <td class="gridValue">
            	<input class="inputText" style="width:300px" type="text" name="username" value="{$username}" />
            </td>
        </tr>
		<tr>
			<td class="gridLabels">
				{'email'|lang} <span class="required">*</span>
			</td>
			<td class="gridValue"> 
				<input class="inputText" style="width:300px" type="text" name="email" maxlength="64" value="{$email}" />
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
				{'password'|lang}
           	</td>
			<td class="gridValue">
				<input class="inputText" style="width:300px" type="password" name="password" maxlength="32" value="" autocomplete="off" />
			</td>
		</tr>
        <tr>
            <td class="gridLabels">
                {'confirm_password'|lang}
            </td>
            <td class="gridValue">
                <input class="inputText" style="width:300px" type="password" name="password2" maxlength="32" value="" autocomplete="off" />
            </td>
        </tr>
        {if $id}<tr>
        	<td class="gridLabels">
            	{'joindate'|lang}
            </td>
            <td class="gridValue">
            	{$joindate}
            </td>
        </tr>
        <tr>
        	<td class="gridLabels">
            	{'lastvisit'|lang}
            </td>
            <td class="gridValue">
            	{$lastvisit}
            </td>
        </tr>{/if}
        <tr>
        	<td class="gridLabels">
            	{'group'|lang}
            </td>
            <td class="gridValue">
            	<select class="inputCombo" name="group">
                	{html_options options=$groups selected=$group_id}
                </select>
            </td>
        </tr>
		<tr>
			<td class="gridLabels">
				{'forum_status'|lang}
			</td>
			<td class="gridValue">
				<select class="inputCombo" name="forum_active">
					{html_options options=$status selected=$forum_active}
				</select>
			</td>
		</tr>
        <tr>
        	<td class="gridLabels">
            	{'status'|lang}
            </td>
            <td class="gridValue">
            	<select class="inputCombo" name="active">
                	{html_options options=$status selected=$active}
                </select>
            </td>
        </tr>
   	</table>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
				<input type="hidden" name="ismember" value="1" />
			</td>
		</tr>
	</table>
    </form>
	{/if}
{include file='footer.tpl'}