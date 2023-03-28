<?php /* Smarty version Smarty-3.1.11, created on 2012-10-23 13:48:18
         compiled from "A:\loghin\www\admin\templates\layoutEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70645082793cecccf9-63421731%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f57c7584addde588869a7933b034ca6d1b29566' => 
    array (
      0 => 'A:\\loghin\\www\\admin\\templates\\layoutEdit.tpl',
      1 => 1350989297,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70645082793cecccf9-63421731',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5082793d07bd40_49146308',
  'variables' => 
  array (
    'hideContent' => 0,
    'appPage' => 0,
    'languages' => 0,
    'sys_lang' => 0,
    'types' => 0,
    'type' => 0,
    'groups' => 0,
    'layout' => 0,
    '_layout' => 0,
    '_group' => 0,
    'group' => 0,
    '__group' => 0,
    'name' => 0,
    'lang' => 0,
    'value' => 0,
    'details' => 0,
    'url' => 0,
    'lastImage' => 0,
    'vir_pic_path' => 0,
    'showParent' => 0,
    'parents' => 0,
    '_type' => 0,
    '_parents' => 0,
    'parent' => 0,
    'statuse' => 0,
    'status' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5082793d07bd40_49146308')) {function content_5082793d07bd40_49146308($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'A:/!Services/Smarty/plugins\\function.html_options.php';
if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
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
			<td class="gridLabels" style="width:100px">
				<?php echo smarty_modifier_lang('type');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue">
				<select class="inputCombo" name="type">
					<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['types']->value,'selected'=>$_smarty_tpl->tpl_vars['type']->value),$_smarty_tpl);?>

				</select>
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
				<?php echo smarty_modifier_lang('group');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue">
				<select class="inputCombo" name="group">
					<option value=""><?php echo smarty_modifier_lang('select_group');?>
</option>
					<?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value){
$_smarty_tpl->tpl_vars['layout']->_loop = true;
?>
						<optgroup label="<?php echo $_smarty_tpl->tpl_vars['layout']->value['name'];?>
">
						<?php  $_smarty_tpl->tpl_vars['_layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layout']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_layout']->key => $_smarty_tpl->tpl_vars['_layout']->value){
$_smarty_tpl->tpl_vars['_layout']->_loop = true;
?>
							<optgroup label=" &nbsp; &nbsp;<?php echo $_smarty_tpl->tpl_vars['_layout']->value['name'];?>
">
							<?php if ($_smarty_tpl->tpl_vars['_layout']->value['items']){?><?php  $_smarty_tpl->tpl_vars['_group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['_layout']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_group']->key => $_smarty_tpl->tpl_vars['_group']->value){
$_smarty_tpl->tpl_vars['_group']->_loop = true;
?>
								<optgroup label=" &nbsp; &nbsp; &nbsp; &nbsp;<?php echo $_smarty_tpl->tpl_vars['_group']->value['name'];?>
">
								<?php if ($_smarty_tpl->tpl_vars['_group']->value['items']){?><?php  $_smarty_tpl->tpl_vars['__group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['__group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['_group']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['__group']->key => $_smarty_tpl->tpl_vars['__group']->value){
$_smarty_tpl->tpl_vars['__group']->_loop = true;
?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['__group']->key;?>
"<?php if ($_smarty_tpl->tpl_vars['__group']->key==$_smarty_tpl->tpl_vars['group']->value){?> selected="selected"<?php }?>> &nbsp; &nbsp; &nbsp; &nbsp;<?php echo $_smarty_tpl->tpl_vars['__group']->value;?>
</option>
								<?php } ?><?php }?>
								</optgroup>
							<?php } ?><?php }?>
							</optgroup>
						<?php } ?>
						</optgroup>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
            	<?php echo smarty_modifier_lang('name');?>
 <span class="required">*</span>
            </td>
			<td class="gridValue">
			<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['name']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['lang']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
				<input class="inputText lang__<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
<?php if ($_smarty_tpl->tpl_vars['sys_lang']->value!=$_smarty_tpl->tpl_vars['lang']->value){?> hide<?php }?>" type="text" name="name[<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" />
			<?php } ?>
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
				<?php echo smarty_modifier_lang('details');?>

			</td>
			<td class="gridValue">
			<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['details']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['lang']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
				<input class="inputText lang__<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
<?php if ($_smarty_tpl->tpl_vars['sys_lang']->value!=$_smarty_tpl->tpl_vars['lang']->value){?> hide<?php }?>" style="width:700px" type="text" name="details[<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" maxlength="255" />
			<?php } ?>
			</td>
		</tr>
		<tr>
			<td class="gridLabels"><?php echo smarty_modifier_lang('url');?>
</td>
			<td class="gridValue">
				<input class="inputText" type="text" name="url" value="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" />
			</td>
		</tr>
        <?php if ($_smarty_tpl->tpl_vars['lastImage']->value){?><tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('last_image');?>

            </td>
            <td class="gridValue">
            	<img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/layouts/<?php echo $_smarty_tpl->tpl_vars['lastImage']->value;?>
" alt="" />
            </td>
        </tr><?php }?>
        <tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('image');?>

            </td>
            <td class="gridValue">
            	<input class="inputFile" type="file" name="image" value="" />
            </td>
        </tr>
		<tr>
        	<td class="gridTabs" colspan="2"><strong><?php echo smarty_modifier_lang('actions');?>
</strong></td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['showParent']->value){?><tr>
        	<td class="gridLabels">
        		<?php echo smarty_modifier_lang('parent');?>

        	</td>
        	<td class="gridValue">
        	<?php  $_smarty_tpl->tpl_vars['_parents'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_parents']->_loop = false;
 $_smarty_tpl->tpl_vars['_type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['parents']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_parents']->key => $_smarty_tpl->tpl_vars['_parents']->value){
$_smarty_tpl->tpl_vars['_parents']->_loop = true;
 $_smarty_tpl->tpl_vars['_type']->value = $_smarty_tpl->tpl_vars['_parents']->key;
?>
        		<div<?php if ($_smarty_tpl->tpl_vars['_type']->value!=$_smarty_tpl->tpl_vars['type']->value){?> class="hide"<?php }?> id="parent_<?php echo $_smarty_tpl->tpl_vars['_type']->value;?>
">
	        		<select class="inputCombo" name="parent[<?php echo $_smarty_tpl->tpl_vars['_type']->value;?>
]">
	        			<option value=""><?php echo smarty_modifier_lang('select_option');?>
</option>
	        			<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['_parents']->value,'selected'=>$_smarty_tpl->tpl_vars['parent']->value),$_smarty_tpl);?>

	        		</select>
        		</div>
        	<?php } ?>
        	</td>
        </tr><?php }?>
        <tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('status');?>

            </td>
            <td class="gridValue">
            	<select class="inputCombo" name="status">
                	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['statuse']->value,'selected'=>$_smarty_tpl->tpl_vars['status']->value),$_smarty_tpl);?>

                </select>
            </td>
        </tr>
   	</table>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
				<input type="hidden" name="isLayout" value="1" />
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
	<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>