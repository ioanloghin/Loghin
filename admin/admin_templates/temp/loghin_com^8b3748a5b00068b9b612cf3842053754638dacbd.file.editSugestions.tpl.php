<?php /* Smarty version Smarty-3.1.7, created on 2023-03-22 13:12:32
         compiled from "/home/loghin/public_html/admin/templates/editSugestions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178619401641a9d27b5ff39-53419497%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b3748a5b00068b9b612cf3842053754638dacbd' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/editSugestions.tpl',
      1 => 1679490750,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178619401641a9d27b5ff39-53419497',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_641a9d27bb09c',
  'variables' => 
  array (
    'hideContent' => 0,
    'fields' => 0,
    'item' => 0,
    'vir_cp_path' => 0,
    'vir_tpl_path' => 0,
    'page' => 0,
    'pages' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_641a9d27bb09c')) {function content_641a9d27bb09c($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	<?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable"> 
		<tr> 
			<td class="gridHeader" style="text-align:left">Manage Sugestions</td>
            <td class="gridHeader nowrap" width="100"><?php echo smarty_modifier_lang('Image');?>
</td>
			<td class="gridHeader nowrap" width="90"><?php echo smarty_modifier_lang('Createdate');?>
</td> 
			<td class="gridHeader nowrap" colspan="3"><?php echo smarty_modifier_lang('actions');?>
</td> 
		</tr>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['item']->index++;
?>
        <tr class="gridTr"> 
			<td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>">
			   <span style="font-weight:bold;font-size:13px"><?php echo $_smarty_tpl->tpl_vars['item']->value['heading'];?>
</span> 
			<br><?php echo $_smarty_tpl->tpl_vars['item']->value['discription'];?>
</td>
            <td class="gridOptions nowrap">	<img src="uploads/<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
" alt="" style="height:50px;width:65px" border="0" /></td>
			<td class="gridOptions nowrap" style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['ctime'];?>
</td> 
			 
			
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=editdataSuggestion&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" title="<?php echo smarty_modifier_lang('edit');?>
"> 
					<img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/actions/edit.gif" alt="<?php echo smarty_modifier_lang('edit');?>
" border="0" />
                </a>
			</td> 
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=editSugestions&p=delete&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete?');?>
');" title="<?php echo smarty_modifier_lang('delete');?>
">
					<img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/actions/delete.gif" alt="<?php echo smarty_modifier_lang('edit');?>
" border="0" />
                </a>
			</td> 
		</tr>
        <?php } ?>
        <tr>
			<td class="gridFooter" colspan="6" style="padding:0px"> 
				<p><?php echo $_smarty_tpl->tpl_vars['pages']->value;?>
</p>
			</td>
		</tr>
    </table>
    <?php }?>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>