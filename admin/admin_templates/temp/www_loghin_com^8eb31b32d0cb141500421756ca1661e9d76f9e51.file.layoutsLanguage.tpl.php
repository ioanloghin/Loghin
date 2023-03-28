<?php /* Smarty version Smarty-3.1.7, created on 2023-02-09 13:15:23
         compiled from "/home/loghin/public_html/admin/templates/layoutsLanguage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15950012196346b568930f77-50401649%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8eb31b32d0cb141500421756ca1661e9d76f9e51' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/layoutsLanguage.tpl',
      1 => 1675777480,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15950012196346b568930f77-50401649',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_6346b56899f61',
  'variables' => 
  array (
    'language' => 0,
    'vir_cp_path' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6346b56899f61')) {function content_6346b56899f61($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



<style>
.dropdown {
  position: relative;
  display: inline-block;
  margin-bottom:20px;
  color: #fff;
    background-color: #286090;
    border-color: #204d74;
    padding: 10px;
    border-radius: 4px;
    margin-top:20px;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
      font-size: 16px
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>    
    
    
    

        <div class="dropdown">
          <span>Add Dictionary</span>
          <div class="dropdown-content">
      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['language']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['item']->index++;
?>
          <p><a  style="font-size:13px;" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=langContent&p=add&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['language'];?>
</a></p>
           <?php } ?>
          </div>
        </div> 



  <table cellpadding="0" cellspacing="1" width="100%" class="gridTable" style="margin-top:5px;">
		<tr>
		
			<td class="gridHeader">Language</td>
		    <td class="gridHeader">Languge_code</td>
		    <td class="gridHeader nowrap">Status</td>
			<td class="gridHeader nowrap">Actions</td>
		
		</tr>
		
	  <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['language']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['item']->index++;
?>
        <tr class="gridTr"> 
        
        <td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>">
            	<a class="grid" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=layoutsLanguage&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" title="<?php echo smarty_modifier_lang('edit');?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['language'];?>
</a>
         </td>
          <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['language_code'];?>
</td>
	
		  <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
</td>
		  	<td class="gridActions" width="24" style="text-align:center">
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=layoutsLanguage&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
">Edit</a></li>
			                                                                                    
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=layoutsLanguage&p=delete&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete?');?>
')" >Delete</a></li>
				</ul>
			</td>
		
		</tr>
        <?php } ?>
      
     
       
</table>


<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>