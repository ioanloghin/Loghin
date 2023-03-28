<?php /* Smarty version Smarty-3.0.8, created on 2011-07-13 15:29:41
         compiled from "A:/loghin/www/admin/templates/membergroupsEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:277454e1d8fb5a6eff2-72344922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0051bd077b69107c057642299c2a4203936d7671' => 
    array (
      0 => 'A:/loghin/www/admin/templates/membergroupsEdit.tpl',
      1 => 1310560159,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '277454e1d8fb5a6eff2-72344922',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins\modifier.lang.php';
if (!is_callable('smarty_function_html_options')) include 'A:/AppServices/Smarty/plugins\function.html_options.php';
?><?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php if ($_smarty_tpl->getVariable('hideContent')->value!=1){?>
	<div style="position:relative;padding-top:31px">
		<table id="fixed" cellpadding="0" cellspacing="1" width="100%" class="gridTable" style="position:absolute;width:100%;top:0">
			<tr>
				<td class="gridHeader nowrap" colspan="2" style="text-align:left">
					<?php echo smarty_modifier_lang('edit_group');?>

				</td>
			</tr>
		</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
    <form method="post" action="">
		<tr>
			<td class="gridLabels nowrap" width="240">
				<?php echo smarty_modifier_lang('name');?>

				<span class="required">*</span>
			</td>
			<td class="gridValue">
				<input class="inputText" type="text" name="name" value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
" maxlength="64" />
			</td>
		</tr>
		<?php if ($_smarty_tpl->getVariable('id')->value==0){?>
		<tr>
			<td class="gridLabels nowrap" width="240" style="text-align:left">
				<?php echo smarty_modifier_lang('duplicate');?>

			</td>
			<td class="gridValue">
				<select class="inputCombo" name="duplicate">
					<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->getVariable('groups')->value,'selected'=>$_smarty_tpl->getVariable('duplicate')->value),$_smarty_tpl);?>

				</select>
			</td>
		</tr>
		<?php }?>
		<tr>
			<td class="gridFooter" colspan="2">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
			</td>
		</tr>
		<input type="hidden" name="isGroup" value="1" />
    </form>
	</table>
	</div>
	<?php }?>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>