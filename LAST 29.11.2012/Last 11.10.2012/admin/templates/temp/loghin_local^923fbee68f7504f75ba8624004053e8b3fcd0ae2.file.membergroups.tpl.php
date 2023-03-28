<?php /* Smarty version Smarty-3.0.8, created on 2011-07-14 12:05:50
         compiled from "A:/loghin/www/admin/templates/membergroups.tpl" */ ?>
<?php /*%%SmartyHeaderCode:154914e1eb16e3382b4-04225893%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '923fbee68f7504f75ba8624004053e8b3fcd0ae2' => 
    array (
      0 => 'A:/loghin/www/admin/templates/membergroups.tpl',
      1 => 1310634349,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154914e1eb16e3382b4-04225893',
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
			<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fields')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
?>
			<th class="gridHeader gridActions nowrap">
				<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['field']->value['members'];?>
)
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
"><?php echo smarty_modifier_lang('edit');?>
</a></li>
					<li><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups&p=delete&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete?');?>
')"><?php echo smarty_modifier_lang('delete');?>
</a></li>
				</ul>
			</th>
			<?php }} ?>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('actions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
?>
		<tr class="gridTr">
			<td class="gridOptions" width="46" style="text-align:center">
				<?php echo $_smarty_tpl->tpl_vars['field']->key;?>

			</td>
			<td class="gridHeader" colspan="<?php echo count($_smarty_tpl->getVariable('fields')->value)+1;?>
" style="text-align:left">
				<a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
"><strong><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</strong></a>
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
				<td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>" style="padding-left:20px">
					<a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
				</td>
				<?php  $_smarty_tpl->tpl_vars['_field'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fields')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['_field']->key => $_smarty_tpl->tpl_vars['_field']->value){
?>
				<td class="gridOptions"><a class="changeOption" href="javascript:void(0);" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
|<?php echo $_smarty_tpl->tpl_vars['_field']->key;?>
"><img src="<?php echo $_smarty_tpl->getVariable('vir_tpl_path')->value;?>
media/<?php if (isset($_smarty_tpl->tpl_vars['_field']->value['permiss'][$_smarty_tpl->tpl_vars['item']->value['label']])&&$_smarty_tpl->tpl_vars['_field']->value['permiss'][$_smarty_tpl->tpl_vars['item']->value['label']]){?>tick<?php }else{ ?>cross<?php }?>.png" alt="" /></a></td>
				<?php }} ?>
			</tr>
			<?php }} ?>
		<?php }} ?>
	</table>
	<script type="text/javascript">$(function(){$('.changeOption').bind('click', function(){var obj = $(this);var enable = $('img', obj).attr('src').indexOf('tick') != '-1' ? false : true;$('img', obj).attr('src', '<?php echo $_smarty_tpl->getVariable('vir_tpl_path')->value;?>
media/loading.gif');$.post($.conf.vir_path +'index.php?m=membergroups', { 'id': $(obj).attr('rel'), 'e': enable }, function(data){if (data.error == true) {alert(data.errorDescription);}else if (data.success == true) {$('img', obj).attr('src', data.img);}}, 'json');});});</script>
	<?php }?>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>