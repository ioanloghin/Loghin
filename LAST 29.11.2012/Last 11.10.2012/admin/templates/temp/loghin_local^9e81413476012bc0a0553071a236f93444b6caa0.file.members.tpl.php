<?php /* Smarty version Smarty-3.0.8, created on 2011-07-12 11:32:46
         compiled from "A:/loghin/www/admin/templates/members.tpl" */ ?>
<?php /*%%SmartyHeaderCode:39894e1c06ae12b155-90001151%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e81413476012bc0a0553071a236f93444b6caa0' => 
    array (
      0 => 'A:/loghin/www/admin/templates/members.tpl',
      1 => 1310459557,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39894e1c06ae12b155-90001151',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins\modifier.lang.php';
if (!is_callable('smarty_modifier_ifelse')) include 'A:/loghin/CORE/plugins\modifier.ifelse.php';
?><?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ($_smarty_tpl->getVariable('hideContent')->value!=1){?>
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
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fields')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->index++;
?>
        <tr class="gridTr"> 
			<td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>"><a class="grid toolpiclink" href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=members&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['email'];?>
</a></td>
            <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['group'];?>
</td>
			<td class="gridOptions nowrap" style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['joindate'];?>
</td> 
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=members&p=<?php echo smarty_modifier_ifelse($_smarty_tpl->tpl_vars['item']->value['active'],1,'active','inactive');?>
&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
" title="<?php ob_start();?><?php echo smarty_modifier_lang('active');?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo smarty_modifier_lang('inactive');?>
<?php $_tmp2=ob_get_clean();?><?php echo smarty_modifier_ifelse($_smarty_tpl->tpl_vars['item']->value['active'],1,$_tmp1,$_tmp2);?>
"> 
					<img src="<?php echo $_smarty_tpl->getVariable('vir_tpl_path')->value;?>
media/options/active_<?php echo smarty_modifier_ifelse($_smarty_tpl->tpl_vars['item']->value['active'],1,'on','off');?>
.gif" alt="Profile <?php echo smarty_modifier_ifelse($_smarty_tpl->tpl_vars['item']->value['active'],1,'online','offlie');?>
" border="0" />
                </a> 
			</td> 
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=members&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" title="<?php echo smarty_modifier_lang('edit');?>
"> 
					<img src="<?php echo $_smarty_tpl->getVariable('vir_tpl_path')->value;?>
media/actions/edit.gif" alt="<?php echo smarty_modifier_lang('edit');?>
" border="0" />
                </a>
			</td> 
			<td class="gridActions" width="24" style="text-align:center"> 
				<a class="grid" href="<?php echo $_smarty_tpl->getVariable('vir_cp_path')->value;?>
index.php?m=members&p=delete&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
&page=<?php echo $_smarty_tpl->getVariable('page')->value;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete?');?>
');" title="<?php echo smarty_modifier_lang('delete');?>
">
					<img src="<?php echo $_smarty_tpl->getVariable('vir_tpl_path')->value;?>
media/actions/delete.gif" alt="<?php echo smarty_modifier_lang('edit');?>
" border="0" />
                </a>
			</td> 
		</tr>
        <?php }} ?>
        <tr>
			<td class="gridFooter" colspan="6" style="padding:0px"> 
				<p><?php echo $_smarty_tpl->getVariable('pages')->value;?>
</p>
			</td>
		</tr>
    </table>
    <?php }?>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>