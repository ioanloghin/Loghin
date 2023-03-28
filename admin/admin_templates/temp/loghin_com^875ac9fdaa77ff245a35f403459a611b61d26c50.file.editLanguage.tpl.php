<?php /* Smarty version Smarty-3.1.7, created on 2022-12-05 13:52:35
         compiled from "/home/loghin/public_html/admin/templates/editLanguage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:180921153636e4a5b569954-62686485%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '875ac9fdaa77ff245a35f403459a611b61d26c50' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/editLanguage.tpl',
      1 => 1670248352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180921153636e4a5b569954-62686485',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_636e4a5b56a90',
  'variables' => 
  array (
    'appPage' => 0,
    'languages' => 0,
    'sys_lang' => 0,
    'language' => 0,
    'language_code' => 0,
    'status' => 0,
    'statuse' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_636e4a5b56a90')) {function content_636e4a5b56a90($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/loghin/sources/newSmarty/plugins/function.html_options.php';
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
		
				<input class="" type="text" name="language" value="<?php echo $_smarty_tpl->tpl_vars['language']->value;?>
"  maxlength="255"/>
		    
			</td>
		
		</tr>
		
		 <tr>
			<td class="gridLabels" style="width:140px">
			<?php echo smarty_modifier_lang('code');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue">
		     
				<input class="" type="text" name="language_code" value="<?php echo $_smarty_tpl->tpl_vars['language_code']->value;?>
" maxlength="255"/>
		    
			</td>
		
		</tr>
		
				<tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('status');?>

            </td>
            <td class="gridValue">
            	<select class="inputCombo" name="status">
                	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['status']->value,'selected'=>$_smarty_tpl->tpl_vars['statuse']->value),$_smarty_tpl);?>

                </select>
            </td>
        </tr>
		    
		 </table>
		   <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
				<input type="hidden" name="islanguage" value="1" />
			</td>
		</tr>
	</table>
	</form>



















<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>