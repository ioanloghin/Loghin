<?php /* Smarty version Smarty-3.0.8, created on 2011-08-16 12:18:14
         compiled from "A:/loghin/www/admin/templates/sites.tpl" */ ?>
<?php /*%%SmartyHeaderCode:276364e4a35d6652e02-50518296%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '093126efd3fcf191403fceed185597871484ccac' => 
    array (
      0 => 'A:/loghin/www/admin/templates/sites.tpl',
      1 => 1313397414,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '276364e4a35d6652e02-50518296',
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
			<td class="gridHeader" style="text-align:left"><?php echo smarty_modifier_lang('name');?>
</td>
			<td class="gridHeader"><?php echo smarty_modifier_lang('type');?>
</td>
			<td class="gridHeader nowrap" width="60"><?php echo smarty_modifier_lang('languages');?>
</td>
			<td class="gridHeader nowrap" width="60"><?php echo smarty_modifier_lang('status');?>
</td>
			<td class="gridHeader nowrap"><?php echo smarty_modifier_lang('actions');?>
</td> 
		</tr>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->index++;
?>
        <tr class="gridTr"> 
			<td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>">
            	<a class="grid" href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=sites&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" title="<?php echo smarty_modifier_lang('edit');?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
           	</td>
           	<td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
</td>
			<td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['languages'];?>
</td>
            <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
</td>
			<td class="gridActions" width="24" style="text-align:center">
				<a class="action" href="javascript:void(0);">&nbsp;</a> 
				<ul class="opmenu">
					<li><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=sites&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo smarty_modifier_lang('edit');?>
</a></li>
					<?php if (!$_smarty_tpl->getVariable('id')->value){?><li><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=sites&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo smarty_modifier_lang('manage_subsites');?>
</a></li><?php }?>
					<li><a href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=sites&p=delete&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete?');?>
')"><?php echo smarty_modifier_lang('delete');?>
</a></li>
				</ul>
			</td> 
		</tr>
        <?php }} ?>
	</table>
	<?php if ($_smarty_tpl->getVariable('pages')->value){?><table cellpadding="0" cellspacing="1" width="100%" class="gridTable"> 
        <tr>
			<td class="gridFooter" style="padding:0px"> 
				<p><?php echo $_smarty_tpl->getVariable('pages')->value;?>
</p>
			</td>
		</tr>
    </table><?php }?>
    <?php }?>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>