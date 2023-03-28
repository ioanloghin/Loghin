<?php /* Smarty version Smarty-3.1.7, created on 2022-10-03 14:11:40
         compiled from "/home/loghin/public_html/admin/templates/memberGroupsActions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1006548657633aed9c591595-83501336%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a487a6e72099a8551fd2bfe2dbc5fabeb706a848' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/memberGroupsActions.tpl',
      1 => 1351531978,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1006548657633aed9c591595-83501336',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hideContent' => 0,
    'fields' => 0,
    'vir_cp_path' => 0,
    'field' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_633aed9c636b2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_633aed9c636b2')) {function content_633aed9c636b2($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
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
		<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
		<tr class="gridTr">
			<td class="gridOptions" style="text-align:center">
				<?php echo $_smarty_tpl->tpl_vars['field']->key;?>

			</td>
			<td class="gridHeader" colspan="2" style="text-align:left">
				<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
"><strong><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</strong></a>
			</td>
			<td class="gridActions">
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
"><?php echo smarty_modifier_lang('edit_action');?>
</a></li>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups&p=deleteAction&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete_action?');?>
')"><?php echo smarty_modifier_lang('delete_action');?>
</a></li>
				</ul>
			</td>
		</tr>
			<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['field']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['item']->index++;
?>
			<tr class="gridTr">
				<td class="gridOptions" style="text-align:center">
					<?php echo $_smarty_tpl->tpl_vars['item']->key;?>

				</td>
				<td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>" style="padding-left:40px">
					<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
				</td>
				<td class="gridOptions" style="text-align:left"><?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
</td>
				<td class="gridActions">
					<a class="action" href="javascript:void(0);">&nbsp;</a>
					<ul class="opmenu">
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo smarty_modifier_lang('edit_action');?>
</a></li>
						<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups&p=deleteAction&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete_action?');?>
')"><?php echo smarty_modifier_lang('delete_action');?>
</a></li>
					</ul>
				</td>
			</tr>
			<?php } ?>
		<?php } ?>
	</table>
	<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>