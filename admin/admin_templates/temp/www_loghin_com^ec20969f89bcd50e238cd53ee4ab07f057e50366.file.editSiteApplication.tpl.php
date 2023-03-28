<?php /* Smarty version Smarty-3.1.7, created on 2023-03-13 19:05:39
         compiled from "/home/loghin/public_html/admin/templates/editSiteApplication.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1439782457640f74039189e5-14854536%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec20969f89bcd50e238cd53ee4ab07f057e50366' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/editSiteApplication.tpl',
      1 => 1678096689,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1439782457640f74039189e5-14854536',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'appPage' => 0,
    'languages' => 0,
    'sys_lang' => 0,
    'name' => 0,
    'details' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_640f740396e71',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_640f740396e71')) {function content_640f740396e71($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/loghin/sources/newSmarty/plugins/function.html_options.php';
if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


	<form action="" method="post" enctype="multipart/form-data">
	    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#rowNew').toggle();"><?php echo $_smarty_tpl->tpl_vars['appPage']->value;?>
</a>
                  	</div>
                    <div class="right">
                    	<select class="inputCombo" id="toggleLanguage">
                        	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['languages']->value,'selected'=>$_smarty_tpl->tpl_vars['sys_lang']->value),$_smarty_tpl);?>

                        </select>
                    </div>
              	</div>
			</td>
		</tr>
	</table>
		<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowNew">
		    <tr>
			<td class="gridLabels" style="width:140px">
				<?php echo smarty_modifier_lang('name');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue">
		
				<input class="" type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"  maxlength="255"/>
		    
			</td>
		
		</tr>
		
		<tr>
			<td class="gridLabels" style="width:140px">
			<?php echo smarty_modifier_lang('details');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue">
		     
				<input class="" type="text" name="details" value="<?php echo $_smarty_tpl->tpl_vars['details']->value;?>
" maxlength="255"/>
		    
			</td>
		
		</tr>
		
		
		
	
		    
		 </table>
		   <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
				<input type="hidden" name="islayout_data" value="1" />
			</td>
		</tr>
	</table>
	</form>

<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>