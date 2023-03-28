<?php /* Smarty version Smarty-3.1.7, created on 2023-03-06 07:52:22
         compiled from "/home/loghin/public_html/admin/templates/siteApplication.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3094506346402fbb1940339-72501843%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ba685ad91e9aa56daf5f6187b62f1d9a264a722' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/siteApplication.tpl',
      1 => 1678089137,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3094506346402fbb1940339-72501843',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_6402fbb196bdc',
  'variables' => 
  array (
    'hideContent' => 0,
    'fields' => 0,
    'vir_cp_path' => 0,
    'item' => 0,
    'pages' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6402fbb196bdc')) {function content_6402fbb196bdc($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

 <?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
 <h2>All Sites and Application</h2>
 
 
 

  <table cellpadding="0" cellspacing="1" width="100%" class="gridTable" style="margin-top:5px;">
		<tr>
		
			<td class="gridHeader">Name</td>
		    <td class="gridHeader">Details</td>
		    <td class="gridHeader">Action</td>
		
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
            	<a class="grid" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=siteApplication&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" title="<?php echo smarty_modifier_lang('edit');?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
         </td>
        
          
	    <td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>">
            	<a class="grid" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=siteApplication&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" title="<?php echo smarty_modifier_lang('edit');?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['details'];?>
</a>
         </td>
         
        
         
	
		  	<td class="gridActions" width="24" style="text-align:center">
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=siteApplication&p=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
">Edit</a></li>
			
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=siteApplication&p=delete&id=<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
" onclick="return confirm('<?php echo smarty_modifier_lang('delete?');?>
')" >Delete</a></li>
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