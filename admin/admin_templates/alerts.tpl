{if is_array($msgBody) && count($msgBody) > 1}
<div class="error_messages">
	<h2>{'errors_title'|lang}</h2>
	<ul>
	{foreach $msgBody AS $message}
		<li>{$message}</li>
	{/foreach}
	</ul>
</div>
{else}
<table cellpadding='0' cellspacing='12' width='100%' class='{if $msgType == 'info'}infomsg{else}errormsg{/if}'>
	<tr>
		<td>{if is_array($msgBody)}{current($msgBody)}{else}{$msgBody}{/if}</td>
	</tr>
</table>
{/if}