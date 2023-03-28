{strip}{if $hideContent == 1}
<div class="msg error">{$msgBody}</div>
{else}
<div id="subcats"> 
	<div class="cnt">
		<h2>{$siteName} {'sub-sites'|lang}</h2>
		<div class="items clear">
		{foreach $sites AS $_id => $_data}
			<a href="{$_data.url}" target="_blank"><img src="{$vir_pic_path}www/sites/{if $_data.image}{$_data.image}{else}default.png{/if}" alt="{$_data.details}" /><br />{$_data.name}</a>
		{/foreach}
		</div>
	</div>
	<div class="info arial"></div>
</div>
{/if}{/strip}