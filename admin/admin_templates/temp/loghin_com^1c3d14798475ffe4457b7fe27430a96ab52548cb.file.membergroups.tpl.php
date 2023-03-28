<?php /* Smarty version Smarty-3.1.7, created on 2012-12-07 10:15:55
         compiled from "/home/loghin/public_html/admin/templates/membergroups.tpl" */ ?>
<?php /*%%SmartyHeaderCode:119675321850c2163ba0e002-61448102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c3d14798475ffe4457b7fe27430a96ab52548cb' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/membergroups.tpl',
      1 => 1351531956,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '119675321850c2163ba0e002-61448102',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hideContent' => 0,
    'fields' => 0,
    'field' => 0,
    'vir_cp_path' => 0,
    'actions' => 0,
    'item' => 0,
    'vir_tpl_path' => 0,
    '_field' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_50c2163c1f589',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50c2163c1f589')) {function content_50c2163c1f589($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<th class="gridHeader" width="50"><?php echo smarty_modifier_lang('id');?>
</th>
			<th class="gridHeader nowrap" style="text-align:left"><?php echo smarty_modifier_lang('name');?>
</th>
			<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
			<th class="gridHeader gridActions nowrap">
				<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['field']->value['members'];?>
)
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
"><?php echo smarty_modifier_lang('edit');?>
</a></li>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups&p=delete&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete?');?>
')"><?php echo smarty_modifier_lang('delete');?>
</a></li>
				</ul>
			</th>
			<?php } ?>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['actions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
		<tr class="gridTr">
			<td class="gridOptions" width="46" style="text-align:center">
				<?php echo $_smarty_tpl->tpl_vars['field']->key;?>

			</td>
			<td class="gridHeader" colspan="<?php echo count($_smarty_tpl->tpl_vars['fields']->value)+1;?>
" style="text-align:left">
				<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['field']->key;?>
"><strong><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</strong></a>
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
				<td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>" style="padding-left:20px">
					<a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=membergroups&p=editAction&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
				</td>
				<?php  $_smarty_tpl->tpl_vars['_field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_field']->key => $_smarty_tpl->tpl_vars['_field']->value){
$_smarty_tpl->tpl_vars['_field']->_loop = true;
?>
				<td class="gridOptions"><a class="changeOption" href="javascript:void(0);" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
|<?php echo $_smarty_tpl->tpl_vars['_field']->key;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/<?php if (isset($_smarty_tpl->tpl_vars['_field']->value['permiss'][$_smarty_tpl->tpl_vars['item']->value['label']])&&$_smarty_tpl->tpl_vars['_field']->value['permiss'][$_smarty_tpl->tpl_vars['item']->value['label']]){?>tick<?php }else{ ?>cross<?php }?>.png" alt="" /></a></td>
				<?php } ?>
			</tr>
			<?php } ?>
		<?php } ?>
	</table>
	<script type="text/javascript">$(function() {$('.changeOption').bind('click', function() {var obj = $(this);var enable = $('img', obj).attr('src').indexOf('tick') != '-1' ? false : true;$('img', obj).attr('src', '<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/loading.gif');$.post($.conf.path +'index.php?m=membergroups', { 'id': $(obj).attr('rel'), 'e': enable }, function(data){if (data.error == true) {alert(data.errorDescription);}else if (data.success == true) {$('img', obj).attr('src', data.img);}}, 'json');});});</script>
	<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>