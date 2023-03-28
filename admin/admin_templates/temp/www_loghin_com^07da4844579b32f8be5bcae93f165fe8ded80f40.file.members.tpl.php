<?php /* Smarty version Smarty-3.1.7, created on 2022-10-05 10:41:47
         compiled from "/home/loghin/public_html/admin/templates/members.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5068483058652607177570-14384782%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '07da4844579b32f8be5bcae93f165fe8ded80f40' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/members.tpl',
      1 => 1664956022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5068483058652607177570-14384782',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_586526073984d',
  'variables' => 
  array (
    'hideContent' => 0,
    'fields' => 0,
    'vir_cp_path' => 0,
    'item' => 0,
    'page' => 0,
    'vir_tpl_path' => 0,
    'pages' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_586526073984d')) {function content_586526073984d($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
if (!is_callable('smarty_modifier_ifelse')) include '/home/loghin/sources/!core/plugins/modifier.ifelse.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	<?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable"> 
		<tr> 
			<td class="gridHeader" style="text-align:left"><?php echo smarty_modifier_lang('email');?>
</td>
            <td class="gridHeader nowrap" width="100"><?php echo smarty_modifier_lang('group');?>
</td>
			<td class="gridHeader nowrap" width="90"><?php echo smarty_modifier_lang('joindate');?>
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
			<td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>"><a class="grid toolpiclink" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=members&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['email'];?>
</a></td>
            <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['group'];?>
</td>
			<td class="gridOptions nowrap" style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['joindate'];?>
</td> 
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=members&p=<?php echo smarty_modifier_ifelse($_smarty_tpl->tpl_vars['item']->value['active'],1,'active','inactive');?>
&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" title="<?php ob_start();?><?php echo smarty_modifier_lang('active');?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo smarty_modifier_lang('inactive');?>
<?php $_tmp2=ob_get_clean();?><?php echo smarty_modifier_ifelse($_smarty_tpl->tpl_vars['item']->value['active'],1,$_tmp1,$_tmp2);?>
"> 
					<img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/active_<?php echo smarty_modifier_ifelse($_smarty_tpl->tpl_vars['item']->value['active'],1,'on','off');?>
.gif" alt="Profile <?php echo smarty_modifier_ifelse($_smarty_tpl->tpl_vars['item']->value['active'],1,'online','offlie');?>
" border="0" />
                </a> 
			</td> 
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=members&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" title="<?php echo smarty_modifier_lang('edit');?>
"> 
					<img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/actions/edit.gif" alt="<?php echo smarty_modifier_lang('edit');?>
" border="0" />
                </a>
			</td> 
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=members&p=delete&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
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