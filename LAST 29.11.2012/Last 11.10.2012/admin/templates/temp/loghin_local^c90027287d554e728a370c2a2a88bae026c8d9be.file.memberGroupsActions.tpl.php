<?php /* Smarty version Smarty-3.0.8, created on 2011-07-13 23:42:43
         compiled from "A:/loghin/www/admin/templates/memberGroupsActions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:249904e1e03431b1c54-31082192%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c90027287d554e728a370c2a2a88bae026c8d9be' => 
    array (
      0 => 'A:/loghin/www/admin/templates/memberGroupsActions.tpl',
      1 => 1310589760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '249904e1e03431b1c54-31082192',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins\modifier.lang.php';
?><?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php if ($_smarty_tpl->getVariable('hideContent')->value!=1){?>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<th class="gridHeader" width="50"><?php echo smarty_modifier_lang('id');?>
</th>
			<th class="gridHeader nowrap" style="text-align:left"><?php echo smarty_modifier_lang('name');?>
</th>
			<th class="gridHeader nowrap" width="70"><?php echo smarty_modifier_lang('label');?>
</th>
			<th class="gridHeader nowrap" width="30"><?php echo smarty_modifier_lang('actions');?>
</th>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fields')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
?>
		<tr class="gridTr">
			<td class="gridOptions" style="text-align:center">
				<?php echo $_smarty_tpl->tpl_vars['field']->key;?>

			</td>
			<td class="gridHeader" colspan="2" style="text-align:left">
				<a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
"><strong><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</strong></a>
			</td>
			<td class="gridActions">
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
"><?php echo smarty_modifier_lang('edit_action');?>
</a></li>
					<li><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups&p=deleteAction&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete_action?');?>
')"><?php echo smarty_modifier_lang('delete_action');?>
</a></li>
				</ul>
			</td>
		</tr>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['field']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->index++;
?>
			<tr class="gridTr">
				<td class="gridOptions" style="text-align:center">
					<?php echo $_smarty_tpl->tpl_vars['item']->key;?>

				</td>
				<td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>" style="padding-left:40px">
					<a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
				</td>
				<td class="gridOptions" style="text-align:left"><?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
</td>
				<td class="gridActions">
					<a class="action" href="javascript:void(0);">&nbsp;</a>
					<ul class="opmenu">
						<li><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo smarty_modifier_lang('edit_action');?>
</a></li>
						<li><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups&p=deleteAction&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete_action?');?>
')"><?php echo smarty_modifier_lang('delete_action');?>
</a></li>
					</ul>
				</td>
			</tr>
			<?php }} ?>
		<?php }} ?>
	</table>
	<?php }?>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>