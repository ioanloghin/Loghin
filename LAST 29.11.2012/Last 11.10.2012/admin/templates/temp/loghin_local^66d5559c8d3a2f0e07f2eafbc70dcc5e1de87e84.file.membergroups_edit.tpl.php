<?php /* Smarty version Smarty-3.0.8, created on 2011-07-13 15:19:24
         compiled from "A:/loghin/www/admin/templates/membergroups_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:216914e1d8d4c874d02-37375489%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66d5559c8d3a2f0e07f2eafbc70dcc5e1de87e84' => 
    array (
      0 => 'A:/loghin/www/admin/templates/membergroups_edit.tpl',
      1 => 1310559563,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '216914e1d8d4c874d02-37375489',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins\modifier.lang.php';
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
				<input class="inputText" type="text" name="name" style="width:300px" size="40" maxlength="64" value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
" />
			</td>
		</tr>
		<?php if ($_smarty_tpl->getVariable('group_id')->value==0){?>
		<tr>
			<td class="gridLabels nowrap" width="240" style="text-align:left">
				<?php echo smarty_modifier_lang('duplicate');?>

			</td>
			<td class="gridValue">
				<select class="inputCombo" name="duplicate_id">
					<option value=""><?php echo smarty_modifier_lang('none');?>
</option>
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('duplicate_groups')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"<?php if ($_smarty_tpl->getVariable('duplicate_id')->value==$_smarty_tpl->tpl_vars['key']->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                    <?php }} ?>
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