<?php /* Smarty version Smarty-3.1.11, created on 2012-10-24 11:59:50
         compiled from "A:\loghin\www\admin\templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203815087ae06eb8be2-08728851%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '760cca1853ff00364f91cd12af509ea2ddb02595' => 
    array (
      0 => 'A:\\loghin\\www\\admin\\templates\\login.tpl',
      1 => 1310455970,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203815087ae06eb8be2-08728851',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app_page' => 0,
    'app_title' => 0,
    'msgType' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5087ae06f1a4f1_27061003',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5087ae06f1a4f1_27061003')) {function content_5087ae06f1a4f1_27061003($_smarty_tpl) {?><?php if (!is_callable('smarty_function_stylesheets')) include 'A:/loghin/CORE/plugins/function.stylesheets.php';
if (!is_callable('smarty_function_scripts')) include 'A:/loghin/CORE/plugins/function.scripts.php';
if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins/modifier.lang.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php if ($_smarty_tpl->tpl_vars['app_page']->value){?><?php echo $_smarty_tpl->tpl_vars['app_page']->value;?>
 | <?php }?><?php echo $_smarty_tpl->tpl_vars['app_title']->value;?>
</title>
<?php echo smarty_function_stylesheets(array(),$_smarty_tpl);?>
<?php echo smarty_function_scripts(array(),$_smarty_tpl);?>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body leftmargin="0" topmargin="0">
<table width="100%" cellpadding="0" cellspacing="0" class="headerMenuTable">
	<tr>
		<td class="headerMenuRow1" width="100%">
			<h1><?php echo $_smarty_tpl->tpl_vars['app_title']->value;?>
</h1>
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="100%" valign="top" style="padding-top: 128px">
			<?php if ($_smarty_tpl->tpl_vars['msgType']->value=='error'){?>
				<table width="400" cellpadding="0" cellspacing="0" style="margin:0px auto"><tr><td>
					<?php echo $_smarty_tpl->getSubTemplate ('error.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				</td></tr></table>
			<?php }?>
			<table cellpadding="0" cellspacing="1" width="400" class="gridTable" style="margin:0px auto">
				<form method="post" action="" name="loginform">
				<tr>
					<td class="gridHeader" colspan="2" nowrap>
						<?php echo smarty_modifier_lang('login');?>

					</td>
				</tr>
				<tr>
					<td class="gridRow1" nowrap>
						<?php echo smarty_modifier_lang('username');?>

					</td>
					<td width="100%" class="gridRow1">
						<input maxlength="32" size="30" type="text" name="username" value="" class="inputText" />
					</td>
				</tr>
				<tr>
					<td class="gridRow1" nowrap>
						<?php echo smarty_modifier_lang('password');?>

					</td>
					<td width="100%" class="gridRow1">
						<input maxlength="32" size="30" type="password" name="password" value="" class="inputText" />
					</td>
				</tr>
				<tr>
					<td class="gridRow1" colspan="2" nowrap>
						<label for="nonxpcookie"><input type="checkbox" name="nonxpcookie" id="nonxpcookie" class="inputCheck" /> <?php echo smarty_modifier_lang('remember_me');?>
</label>
					</td>
				</tr>
				<tr>
					<td class="gridFooter" colspan="2">
						<input type="submit" name="login" value="<?php echo smarty_modifier_lang('submit');?>
" class="inputSubmit" />
						<input type="hidden" name="islogin" value="1" />
					</td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
</table>
</body>
</html><?php }} ?>