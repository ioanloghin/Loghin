<?php /* Smarty version Smarty-3.0.8, created on 2011-08-16 12:18:12
         compiled from "A:/loghin/www/admin/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142064e4a35d46c90b3-12790111%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ded73dd6d7d90a51be8efd468f379f72a1c47a73' => 
    array (
      0 => 'A:/loghin/www/admin/templates/header.tpl',
      1 => 1313392381,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142064e4a35d46c90b3-12790111',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_stylesheets')) include 'A:/loghin/CORE/plugins\function.stylesheets.php';
if (!is_callable('smarty_function_scripts')) include 'A:/loghin/CORE/plugins\function.scripts.php';
if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins\modifier.lang.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php if (isset($_smarty_tpl->getVariable('appPage',null,true,false)->value)){?><?php echo $_smarty_tpl->getVariable('appPage')->value;?>
 | <?php }?><?php echo $_smarty_tpl->getVariable('app_title')->value;?>
</title>
<?php echo smarty_function_stylesheets(array(),$_smarty_tpl);?>
<?php echo smarty_function_scripts(array(),$_smarty_tpl);?>
	<script type="text/javascript">
	<!--//
	$.conf = { 'vir_path': '<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
', 'lang': '<?php echo $_smarty_tpl->getVariable('sys_lang')->value;?>
' };
	//-->
	</script>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" class="headerMenuTable">
	<tr>
		<td class="headerMenuRow1">
			<h1><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
"><?php echo $_smarty_tpl->getVariable('app_title')->value;?>
</a></h1>
		</td>
		<td class="headerMenuRow2" valign="bottom" align="right">
			<?php echo smarty_modifier_lang('logged_in');?>
: <?php echo $_smarty_tpl->getVariable('session')->value['username'];?>
 |
			<a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
"><?php echo smarty_modifier_lang('dashboard');?>
</a> |
			<a href="<?php echo $_smarty_tpl->getVariable('vir_path')->value;?>
"><?php echo smarty_modifier_lang('website');?>
</a> |
			<a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=logout"><?php echo smarty_modifier_lang('logout');?>
</a>
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" class="menuTable">
	<tr>
		<td class="menuRow1 members<?php if ($_smarty_tpl->getVariable('activeModule')->value!='members'){?> general<?php }?>"><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=members"><?php echo smarty_modifier_lang('manage_members');?>
</a></td>
        <td class="menuRow1 modules<?php if ($_smarty_tpl->getVariable('activeModule')->value!='modules'){?> general<?php }?>"><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=sites"><?php echo smarty_modifier_lang('manage_modules');?>
</a></td>
		<td class="menuRow1 settings<?php if ($_smarty_tpl->getVariable('activeModule')->value!='settings'){?> general<?php }?>"><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=settings"><?php echo smarty_modifier_lang('manage_settings');?>
</a></td>
		<td class="menuRow1 general" width="100%"><img src="<?php echo $_smarty_tpl->getVariable('vir_tpl_path')->value;?>
media/empty.gif" alt="" /></td>
	</tr>
	<tr><td colspan="5" class="menuRow2 <?php echo $_smarty_tpl->getVariable('activeModule')->value;?>
" width="100%"><img src="<?php echo $_smarty_tpl->getVariable('vir_tpl_path')->value;?>
media/empty.gif" alt="" border="0" /></td></tr>

	<tr>
		<td colspan="5" class="menuRow3 members<?php if ($_smarty_tpl->getVariable('activeModule')->value!='members'){?> hide<?php }?>">
			<a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=members"><?php echo smarty_modifier_lang('manage_members');?>
</a>
		</td>
	</tr>
	<tr>
		<td colspan="5" class="menuRow3 modules<?php if ($_smarty_tpl->getVariable('activeModule')->value!='modules'){?> hide<?php }?>">
			<a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=sites"><?php echo smarty_modifier_lang('manage_sites');?>
</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="#"><?php echo smarty_modifier_lang('manage_sugestions');?>
</a>
		</td>
	</tr>
	<tr>
		<td colspan="5" class="menuRow3 settings<?php if ($_smarty_tpl->getVariable('activeModule')->value!='settings'){?> hide<?php }?>">
			<a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=settings"><?php echo smarty_modifier_lang('manage_settings');?>
</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=emailtemplates"><?php echo smarty_modifier_lang('manage_email_templates');?>
</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups"><?php echo smarty_modifier_lang('manage_membergroups');?>
</a>
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" class="contentTable">
	<tr>
		<td rowspan="2" width="160" valign="top" style="padding: 8px;" class="contentSide <?php echo $_smarty_tpl->getVariable('activeModule')->value;?>
">
            <table width="100%" cellpadding="0" cellspacing="0" class="sideTable">
                <tr>
                    <td class="sideHeader">
                        <img src="<?php echo $_smarty_tpl->getVariable('vir_tpl_path')->value;?>
media/header.gif" alt="" border="" align="absmiddle" />&nbsp;Quick jump
                    </td>
                </tr>
            	<?php if ($_smarty_tpl->getVariable('activeModule')->value=='members'){?>
                <tr><td class="sideRow"><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=members"><?php echo smarty_modifier_lang('manage_members');?>
</a></td></tr>
                <?php }elseif($_smarty_tpl->getVariable('activeModule')->value=='modules'){?>
				<tr><td class="sideRow"><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=sites"><?php echo smarty_modifier_lang('manage_sites');?>
</a></td></tr>
				<tr><td class="sideRow"><a href="#"><?php echo smarty_modifier_lang('manage_sugestions');?>
</a></td></tr>
                <?php }elseif($_smarty_tpl->getVariable('activeModule')->value=='settings'){?>
                <tr><td class="sideRow"><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=settings"><?php echo smarty_modifier_lang('manage_settings');?>
</a></td></tr>
				<tr><td class="sideRow"><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=emailtemplates"><?php echo smarty_modifier_lang('manage_email_templates');?>
</a></td></tr>
                <tr><td class="sideRow"><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups"><?php echo smarty_modifier_lang('manage_membergroups');?>
</a></td></tr>
                <?php }?>
            <?php if (isset($_smarty_tpl->getVariable('optlinks',null,true,false)->value)&&$_smarty_tpl->getVariable('optlinks')->value){?>
          	</table>
            <table width="100%" cellpadding="0" cellspacing="0" class="sideTable">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('optlinks')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
?>
                    <?php if (isset($_smarty_tpl->tpl_vars['item']->value['header'])){?>
                    <tr>
                        <td class="sideHeader">
                            <img src="<?php echo $_smarty_tpl->getVariable('vir_tpl_path')->value;?>
media/header.gif" alt="" border="" align="absmiddle" />&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['header'];?>

                        </td>
                    </tr>
                    <?php }elseif(isset($_smarty_tpl->tpl_vars['item']->value['optlink'])&&$_smarty_tpl->tpl_vars['item']->value['optlink']==''){?>
                        </table>
                        <table width="100%" cellpadding="0" cellspacing="0" class="sideTable">
                    <?php }else{ ?>
                    <tr>
                        <td class="sideRow">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['optlink'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['optname'];?>
</a>
                        </td>
                    </tr>
                    <?php }?>
                <?php }} ?>
			<?php }?>
            </table>
		</td>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0" class="contentTable">
				<tr>
					<td width="100%" style="padding:8px 8px 0 8px" valign="top">
                    	<?php if (isset($_smarty_tpl->getVariable('navlinks',null,true,false)->value)){?>
							<table cellpadding="0" cellspacing="0" width="100%" class="navTable">
								<tr>
                                	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('navlinks')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
?>
									<td class="navRow1" nowrap>
										<?php if (!$_smarty_tpl->tpl_vars['item']->first){?>&nbsp;&#187;&nbsp;<?php }?><?php echo $_smarty_tpl->tpl_vars['item']->value['navlink'];?>

									</td>
                                    <?php }} ?>
									<td width="100%" class="navRow2">&nbsp;</td>
								</tr>
							</table>
						<?php }?>
					</td>
				</tr>
				<tr>
					<td style="padding:0 8px" valign="top">
					<?php if ($_smarty_tpl->getVariable('msgType')->value!=''){?><?php $_template = new Smarty_Internal_Template('alerts.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?><?php }?>