<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>{if isset($appPage)}{$appPage} | {/if}{$app_title}</title>
{stylesheets}{scripts}	<script type="text/javascript">
	<!--//
	$.conf = { 'path': '{$vir_cp_path}', 'lang': '{$sys_lang}' };
	//-->
	</script>
</head>
<body>
   
    
<table width="100%" cellpadding="0" cellspacing="0" class="headerMenuTable">
	<tr>
		<td class="headerMenuRow1">
			<h1><a href="{$vir_cp_path}">{$app_title}</a></h1>
		
		</td>
		 
		<td class="headerMenuRow2" valign="bottom" align="right">
		    
			{'logged_in'|lang}: {$session.username} |
			<a href="{$vir_cp_path}">{'dashboard'|lang}</a> |
			<a href="{$vir_path}">{'website'|lang}</a> |
			<a href="{$vir_cp_path}index.php?m=logout">{'logout'|lang}</a><br>
		
		    
			<div class="" style="padding:10px;">
			   
			   
              
                <div style="background-color:#FDF3CE;display: inline-block;font-weight: 600;padding: 4px;">
                     {foreach $language AS $item}
                    <span style="padding: 4px;"><a href="{$vir_cp_path}index.php?m=langContent&p=addxvsfsf&id={$item@key}">{$item.language_code}</a></span>|
                     {/foreach}
                </div>
			</div>
		
            
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" class="menuTable">
	<tr>
		<td class="menuRow1 members{if $activeModule != 'members'} general{/if}"><a href="{$vir_cp_path}index.php?m=members">{'manage_members'|lang}</a></td>
        <td class="menuRow1 modules{if $activeModule != 'modules'} general{/if}"><a href="{$vir_cp_path}index.php?m=suggestions">{'manage_modules'|lang}</a></td>
        <td class="menuRow1 layouts{if $activeModule != 'layouts'} general{/if}"><a href="{$vir_cp_path}index.php?m=layouts">{'manage_layouts'|lang}</a></td>
       
		<td class="menuRow1 settings{if $activeModule != 'settings'} general{/if}"><a href="{$vir_cp_path}index.php?m=settings">{'manage_settings'|lang}</a></td>
	

       
		<td class="menuRow1 general" width="100%"><img src="{$vir_tpl_path}media/empty.gif" alt="" /></td>
	</tr>
	<tr><td colspan="5" class="menuRow2 {$activeModule}" width="100%"><img src="{$vir_tpl_path}media/empty.gif" alt="" border="0" /></td></tr>

	<tr>
		<td colspan="5" class="menuRow3 layouts{if $activeModule != 'layouts'} hide{/if}" width="100%">
	<a href="{$vir_cp_path}index.php?m=layoutsmenus">{'manage_layouts_menus'|lang}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="{$vir_cp_path}index.php?m=layoutsgroups">{'manage_layouts_groups'|lang}</a> &nbsp; | &nbsp;
		
			<a href="{$vir_cp_path}index.php?m=extensions">{'manage_extensions'|lang}</a> &nbsp; | &nbsp;
			
			
				<a href="{$vir_cp_path}index.php?m=sugestions">{'New Sugestions'|lang}</a>
		</td>
	</tr>
	

	
	<tr>
		<td colspan="5" class="menuRow3 settings{if $activeModule != 'settings'} hide{/if}">
			<a href="{$vir_cp_path}index.php?m=settings">{'manage_settings'|lang}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="{$vir_cp_path}index.php?m=emailtemplates">{'manage_email_templates'|lang}</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="{$vir_cp_path}index.php?m=membergroups">{'manage_membergroups'|lang}</a>
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" class="contentTable">
	<tr>
		<td rowspan="2" width="160" valign="top" style="padding: 8px;" class="contentSide {$activeModule}">
            <table width="100%" cellpadding="0" cellspacing="0" class="sideTable">
                <tr>
                    <td class="sideHeader">
                        <img src="{$vir_tpl_path}media/header.gif" alt="" border="" align="absmiddle" />&nbsp;Quick jump
                    </td>
                </tr>
            	{if $activeModule == 'members'}
                <tr><td class="sideRow"><a href="{$vir_cp_path}index.php?m=members">{'manage_members'|lang}</a></td></tr>
                {elseif $activeModule == 'modules'}
				<tr><td class="sideRow"><a href="">{'manage_sugestions'|lang}</a></td></tr>
                {elseif $activeModule == 'layouts'}
				<tr><td class="sideRow"><a href="{$vir_cp_path}index.php?m=layouts">{'manage_layouts'|lang}</a></td></tr>
				<tr><td class="sideRow"><a href="{$vir_cp_path}index.php?m=layoutsmenus">{'manage_layouts_menus'|lang}</a></td></tr>
				<tr><td class="sideRow"><a href="{$vir_cp_path}index.php?m=layoutsgroups">{'manage_layouts_groups'|lang}</a></td></tr>
				<tr><td class="sideRow"><a href="{$vir_cp_path}index.php?m=layoutsCountry">{'manage_layouts_Country'|lang}</a></td></tr>
				<tr><td class="sideRow"><a href="{$vir_cp_path}index.php?m=layoutsLanguage">{'manage_layouts_language'|lang}</a></td></tr>
				<tr><td class="sideRow"><a href="{$vir_cp_path}index.php?m=langContent">Pages</a></td></tr>
			    <tr><td class="sideRow"><a href="{$vir_cp_path}index.php?m=siteApplication">{'manage_site&application'|lang}</a></td></tr>
		
			 
               <tr >
                   <td class="sideHeader"> 
                   <img src="{$vir_tpl_path}media/header.gif" alt="" border="" align="absmiddle" /> Add
                   </td>
                  
            </tr>
            <tr><td class="sideRow">

	  <a href="{$vir_cp_path}index.php?m=editSugestions">{'sugestions'|lang}</a>
                        </td>
                    </tr>
           
				
                {elseif $activeModule == 'settings'}
                <tr><td class="sideRow"><a href="{$vir_cp_path}index.php?m=settings">{'manage_settings'|lang}</a></td></tr>
				<tr><td class="sideRow"><a href="{$vir_cp_path}index.php?m=emailtemplates">{'manage_email_templates'|lang}</a></td></tr>
                <tr><td class="sideRow"><a href="{$vir_cp_path}index.php?m=membergroups">{'manage_membergroups'|lang}</a></td></tr>
                {/if}
            {if isset($optlinks) && $optlinks}
          	</table>
            <table width="100%" cellpadding="0" cellspacing="0" class="sideTable">
                {foreach $optlinks AS $item}
                    {if isset($item.header)}
                    <tr>
                        <td class="sideHeader">
                            <img src="{$vir_tpl_path}media/header.gif" alt="" border="" align="absmiddle" />&nbsp;{$item.header}
                        </td>
                    </tr>
                    {elseif isset($item.optlink) && $item.optlink == ''}
                        </table>
                        <table width="100%" cellpadding="0" cellspacing="0" class="sideTable">
                    {else}
                    <tr>
                        <td class="sideRow">
                            <a href="{$item.optlink}">{$item.optname}</a>
                        </td>
                    </tr>
                    {/if}
                {/foreach}
			{/if}
			
		
            </table>
           
           

		</td>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0" class="contentTable">
				<tr>
					<td width="100%" style="padding:8px" valign="top">
                    	{if isset($navlinks)}
							<table cellpadding="0" cellspacing="0" width="100%" class="navTable">
								<tr>
                                	{foreach $navlinks AS $item}
									<td class="navRow1" nowrap>
										{if !$item@first}&nbsp;&#187;&nbsp;{/if}{$item.navlink}
									</td>
                                    {/foreach}
									<td width="100%" class="navRow2">&nbsp;</td>
								</tr>
							</table>
						{/if}
					</td>
				</tr>
				<tr>
					<td style="padding:0 8px" valign="top">
					{if $msgType != ''}{include file='alerts.tpl'}{/if}