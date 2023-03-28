<?php /* Smarty version Smarty-3.1.11, created on 2012-10-11 09:43:21
         compiled from "A:\loghin\www\admin\templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28076507538a152b8c3-28968758%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da9e00d911ffe3aad277fe3c86ec350771ace005' => 
    array (
      0 => 'A:\\loghin\\www\\admin\\templates\\header.tpl',
      1 => 1349936508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28076507538a152b8c3-28968758',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_507538a163f044_86434647',
  'variables' => 
  array (
    'appPage' => 0,
    'app_title' => 0,
    'vir_cp_path' => 0,
    'sys_lang' => 0,
    'session' => 0,
    'vir_path' => 0,
    'activeModule' => 0,
    'vir_tpl_path' => 0,
    'optlinks' => 0,
    'item' => 0,
    'navlinks' => 0,
    'msgType' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_507538a163f044_86434647')) {function content_507538a163f044_86434647($_smarty_tpl) {?><?php if (!is_callable('smarty_function_stylesheets')) include 'A:/loghin/CORE/plugins/function.stylesheets.php';
if (!is_callable('smarty_function_scripts')) include 'A:/loghin/CORE/plugins/function.scripts.php';
if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins/modifier.lang.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php if (isset($_smarty_tpl->tpl_vars['appPage']->value)){?><?php echo $_smarty_tpl->tpl_vars['appPage']->value;?>
 | <?php }?><?php echo $_smarty_tpl->tpl_vars['app_title']->value;?>
</title>
<?php echo smarty_function_stylesheets(array(),$_smarty_tpl);?>
<?php echo smarty_function_scripts(array(),$_smarty_tpl);?>
	<script type="text/javascript">
	<!--//
	$.conf = { 'path': '<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
', 'lang': '<?php echo $_smarty_tpl->tpl_vars['sys_lang']->value;?>
' };
	//-->
	</script>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" class="headerMenuTable">
	<tr>
		<td class="headerMenuRow1">
			<h1><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['app_title']->value;?>
</a></h1>
		</td>
		<td class="headerMenuRow2" valign="bottom" align="right">
			<?php echo smarty_modifier_lang('logged_in');?>
: <?php echo $_smarty_tpl->tpl_vars['session']->value['username'];?>
 |
			<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
"><?php echo smarty_modifier_lang('dashboard');?>
</a> |
			<a href="<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
"><?php echo smarty_modifier_lang('website');?>
</a> |
			<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=logout"><?php echo smarty_modifier_lang('logout');?>
</a>
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" class="menuTable">
	<tr>
		<td class="menuRow1 members<?php if ($_smarty_tpl->tpl_vars['activeModule']->value!='members'){?> general<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=members"><?php echo smarty_modifier_lang('manage_members');?>
</a></td>
        <td class="menuRow1 modules<?php if ($_smarty_tpl->tpl_vars['activeModule']->value!='modules'){?> general<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=sites"><?php echo smarty_modifier_lang('manage_modules');?>
</a></td>
		<td class="menuRow1 settings<?php if ($_smarty_tpl->tpl_vars['activeModule']->value!='settings'){?> general<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=settings"><?php echo smarty_modifier_lang('manage_settings');?>
</a></td>
		<td class="menuRow1 general" width="100%"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/empty.gif" alt="" /></td>
	</tr>
	<tr><td colspan="5" class="menuRow2 <?php echo $_smarty_tpl->tpl_vars['activeModule']->value;?>
" width="100%"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/empty.gif" alt="" border="0" /></td></tr>

	<tr>
		<td colspan="5" class="menuRow3 members<?php if ($_smarty_tpl->tpl_vars['activeModule']->value!='members'){?> hide<?php }?>">
			<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=members"><?php echo smarty_modifier_lang('manage_members');?>
</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td colspan="5" class="menuRow3 modules<?php if ($_smarty_tpl->tpl_vars['activeModule']->value!='modules'){?> hide<?php }?>">
			<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=sites"><?php echo smarty_modifier_lang('manage_sites');?>
</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=layouts"><?php echo smarty_modifier_lang('manage_layouts');?>
</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="#"><?php echo smarty_modifier_lang('manage_sugestions');?>
</a>
		</td>
	</tr>
	<tr>
		<td colspan="5" class="menuRow3 settings<?php if ($_smarty_tpl->tpl_vars['activeModule']->value!='settings'){?> hide<?php }?>">
			<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=settings"><?php echo smarty_modifier_lang('manage_settings');?>
</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=emailtemplates"><?php echo smarty_modifier_lang('manage_email_templates');?>
</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups"><?php echo smarty_modifier_lang('manage_membergroups');?>
</a>
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" class="contentTable">
	<tr>
		<td rowspan="2" width="160" valign="top" style="padding: 8px;" class="contentSide <?php echo $_smarty_tpl->tpl_vars['activeModule']->value;?>
">
            <table width="100%" cellpadding="0" cellspacing="0" class="sideTable">
                <tr>
                    <td class="sideHeader">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/header.gif" alt="" border="" align="absmiddle" />&nbsp;Quick jump
                    </td>
                </tr>
            	<?php if ($_smarty_tpl->tpl_vars['activeModule']->value=='members'){?>
                <tr><td class="sideRow"><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=members"><?php echo smarty_modifier_lang('manage_members');?>
</a></td></tr>
                <?php }elseif($_smarty_tpl->tpl_vars['activeModule']->value=='modules'){?>
				<tr><td class="sideRow"><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=sites"><?php echo smarty_modifier_lang('manage_sites');?>
</a></td></tr>
				<tr><td class="sideRow"><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=layouts"><?php echo smarty_modifier_lang('manage_layouts');?>
</a></td></tr>
				<tr><td class="sideRow"><a href="#"><?php echo smarty_modifier_lang('manage_sugestions');?>
</a></td></tr>
                <?php }elseif($_smarty_tpl->tpl_vars['activeModule']->value=='settings'){?>
                <tr><td class="sideRow"><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=settings"><?php echo smarty_modifier_lang('manage_settings');?>
</a></td></tr>
				<tr><td class="sideRow"><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=emailtemplates"><?php echo smarty_modifier_lang('manage_email_templates');?>
</a></td></tr>
                <tr><td class="sideRow"><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups"><?php echo smarty_modifier_lang('manage_membergroups');?>
</a></td></tr>
                <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['optlinks']->value)&&$_smarty_tpl->tpl_vars['optlinks']->value){?>
          	</table>
            <table width="100%" cellpadding="0" cellspacing="0" class="sideTable">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['optlinks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
?>
                    <?php if (isset($_smarty_tpl->tpl_vars['item']->value['header'])){?>
                    <tr>
                        <td class="sideHeader">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
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
                <?php } ?>
			<?php }?>
            </table>
		</td>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0" class="contentTable">
				<tr>
					<td width="100%" style="padding:8px 8px 0 8px" valign="top">
                    	<?php if (isset($_smarty_tpl->tpl_vars['navlinks']->value)){?>
							<table cellpadding="0" cellspacing="0" width="100%" class="navTable">
								<tr>
                                	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['navlinks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
?>
									<td class="navRow1" nowrap>
										<?php if (!$_smarty_tpl->tpl_vars['item']->first){?>&nbsp;&#187;&nbsp;<?php }?><?php echo $_smarty_tpl->tpl_vars['item']->value['navlink'];?>

									</td>
                                    <?php } ?>
									<td width="100%" class="navRow2">&nbsp;</td>
								</tr>
							</table>
						<?php }?>
					</td>
				</tr>
				<tr>
					<td style="padding:0 8px" valign="top">
					<?php if ($_smarty_tpl->tpl_vars['msgType']->value!=''){?><?php echo $_smarty_tpl->getSubTemplate ('alerts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?><?php }} ?>