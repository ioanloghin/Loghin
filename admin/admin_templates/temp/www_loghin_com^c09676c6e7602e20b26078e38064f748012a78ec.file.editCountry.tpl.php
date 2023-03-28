<?php /* Smarty version Smarty-3.1.7, created on 2023-03-04 12:55:40
         compiled from "/home/loghin/public_html/admin/templates/editCountry.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150953175263455d7b4d9433-92947008%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c09676c6e7602e20b26078e38064f748012a78ec' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/editCountry.tpl',
      1 => 1677841867,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150953175263455d7b4d9433-92947008',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_63455d7b53b63',
  'variables' => 
  array (
    'appPage' => 0,
    'languages' => 0,
    'sys_lang' => 0,
    'name' => 0,
    'multiple_lang' => 0,
    'IP_lang' => 0,
    'status' => 0,
    'statuse' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_63455d7b53b63')) {function content_63455d7b53b63($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/loghin/sources/newSmarty/plugins/function.html_options.php';
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
			<?php echo smarty_modifier_lang('multiple language');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue">
		     
				<input class="" type="text" name="multiple_lang" value="<?php echo $_smarty_tpl->tpl_vars['multiple_lang']->value;?>
" maxlength="255"/>
		    
			</td>
		
		</tr>
		
			<tr>
			<td class="gridLabels" style="width:140px">
			<?php echo smarty_modifier_lang('IP language');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue">
		     
				<input class="" type="text" name="IP_lang" value="<?php echo $_smarty_tpl->tpl_vars['IP_lang']->value;?>
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
            </td>
        </tr>
		    
		 </table>
		   <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
				<input type="hidden" name="iscountry" value="1" />
			</td>
		</tr>
	</table>
	</form>
 <script type="text/javascript">
    $(function() {
	    var group = $('select[name="group"]').closest('tr');
    	$('select[name="type"]').bind('change', function() {
    		if ($('#parent_'+ $(this).val()).length) {
    			$('div[id*="parent_"]').addClass('hide');
    			$('#parent_'+ $(this).val()).removeClass('hide');
    		}
    	});
	    $('select[name^="parent"]').on('change', function() {
		    if ($(this).val() != 0) {
			    group.hide();
            }
		    else {
			    group.show();
            }
	    }).parent(':not(.hide)').find('select').trigger('change');
    });
    </script>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>