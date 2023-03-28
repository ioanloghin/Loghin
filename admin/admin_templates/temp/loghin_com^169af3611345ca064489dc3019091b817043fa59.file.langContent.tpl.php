<?php /* Smarty version Smarty-3.1.7, created on 2023-02-07 13:28:15
         compiled from "/home/loghin/public_html/admin/templates/langContent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1736441991638f3e94ad84e9-22965514%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '169af3611345ca064489dc3019091b817043fa59' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/langContent.tpl',
      1 => 1675776492,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1736441991638f3e94ad84e9-22965514',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_638f3e94b073e',
  'variables' => 
  array (
    'hideContent' => 0,
    'language_code' => 0,
    'vir_cp_path' => 0,
    'item' => 0,
    'item_data' => 0,
    'content' => 0,
    'pages' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_638f3e94b073e')) {function content_638f3e94b073e($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

 <?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>   
    
    
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
          <span>Add Page In Languages</span>
          <div class="dropdown-content">
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['language_code']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
		
			<td class="gridHeader">Parent</td>
		    <td class="gridHeader">Title</td>
		    <td class="gridHeader nowrap">Short Title</td>
			<td class="gridHeader nowrap">Page Title</td>
			<td class="gridHeader nowrap">Content</td>
			<td class="gridHeader nowrap">Language</td>
			<td class="gridHeader nowrap">Action</td>
		
		</tr>
		 
	<?php  $_smarty_tpl->tpl_vars['content'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['content']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['content']->key => $_smarty_tpl->tpl_vars['content']->value){
$_smarty_tpl->tpl_vars['content']->_loop = true;
?>
        <tr class="gridTr"> 
        
        <td class="gridRow<?php if ($_smarty_tpl->tpl_vars['item']->index%2==0){?>1<?php }else{ ?>2<?php }?>">
            	<a class="grid" href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=layoutsLanguage&p=edit&id=" title="<?php echo smarty_modifier_lang('edit');?>
"><?php echo $_smarty_tpl->tpl_vars['content']->value['item1'];?>
</a>
         </td>
          <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['content']->value['item2'];?>
</td>
          
          <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['content']->value['item3'];?>
</td>
          
	    <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['content']->value['item4'];?>
</td>
	    
		  <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['content']->value['item5'];?>
</td>
		  
		    <td class="gridOptions nowrap"><?php echo $_smarty_tpl->tpl_vars['content']->value['language_id'];?>
</td>
		  
		  	<td class="gridActions" width="24" style="text-align:center">
				<a class="action" href="javascript:void(0);">&nbsp;</a>
				<ul class="opmenu">
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=layoutsLanguage&p=edit&id=">Edit</a></li>
			                                                                                    
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=layoutsLanguage&p=delete&id=" onclick="return confirm('<?php echo smarty_modifier_lang('delete?');?>
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