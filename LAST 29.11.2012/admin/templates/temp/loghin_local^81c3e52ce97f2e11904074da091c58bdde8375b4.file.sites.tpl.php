<?php /* Smarty version Smarty-3.1.11, created on 2012-10-10 13:18:06
         compiled from "A:\loghin\www\admin\templates\sites.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2570507538a4362ca3-88197324%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81c3e52ce97f2e11904074da091c58bdde8375b4' => 
    array (
      0 => 'A:\\loghin\\www\\admin\\templates\\sites.tpl',
      1 => 1349864284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2570507538a4362ca3-88197324',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_507538a4421275_02241408',
  'variables' => 
  array (
    'hideContent' => 0,
    'items' => 0,
    'vir_cp_path' => 0,
    'item' => 0,
    'id' => 0,
    'page' => 0,
    'pages' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_507538a4421275_02241408')) {function content_507538a4421275_02241408($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable"> 
		<tr> 
			<td class="gridHeader" style="text-align:left"><?php echo smarty_modifier_lang('name');?>
</td>
			<td class="gridHeader"><?php echo smarty_modifier_lang('type');?>
</td>
			<td class="gridHeader"><?php echo smarty_modifier_lang('member_type');?>
</td>
			<td class="gridHeader nowrap" width="60"><?php echo smarty_modifier_lang('languages');?>
</td>
			<td class="gridHeader nowrap" width="60"><?php echo smarty_modifier_lang('status');?>
</td>
			<td class="gridHeader nowrap"><?php echo smarty_modifier_lang('actions');?>
</td> 
		</tr>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['item']->index++;
?>
        <tr class="gridTr"> 
			<td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>">
            	<a class="grid" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=sites&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" title="<?php echo smarty_modifier_lang('edit');?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
           	</td>
           	<td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
</td>
	        <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['member_type'];?>
</td>
			<td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['languages'];?>
</td>
            <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
</td>
			<td class="gridActions" width="24" style="text-align:center">
				<a class="action" href="javascript:void(0);">&nbsp;</a> 
				<ul class="opmenu">
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=sites&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo smarty_modifier_lang('edit');?>
</a></li>
					<?php if (!$_smarty_tpl->tpl_vars['id']->value){?><li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=sites&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo smarty_modifier_lang('manage_subsites');?>
</a></li><?php }?>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=sites&p=delete&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete?');?>
')"><?php echo smarty_modifier_lang('delete');?>
</a></li>
				</ul>
			</td> 
		</tr>
        <?php } ?>
	</table>
	<?php if ($_smarty_tpl->tpl_vars['pages']->value){?><table cellpadding="0" cellspacing="1" width="100%" class="gridTable"> 
        <tr>
			<td class="gridFooter" style="padding:0px"> 
				<p><?php echo $_smarty_tpl->tpl_vars['pages']->value;?>
</p>
			</td>
		</tr>
    </table><?php }?>
    <?php }?>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>