<?php /* Smarty version Smarty-3.1.7, created on 2017-08-31 09:39:36
         compiled from "/home/loghin/public_html/admin/templates/memberGroupsActionEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150610234059a7d95855c683-60926916%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9767d729e33420dd92f92ac286ad23f327531e3f' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/memberGroupsActionEdit.tpl',
      1 => 1351531928,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150610234059a7d95855c683-60926916',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hideContent' => 0,
    'appPage' => 0,
    'languages' => 0,
    'sys_lang' => 0,
    'parents' => 0,
    'parent' => 0,
    'label' => 0,
    'name' => 0,
    'lang' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_59a7d9588f92c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59a7d9588f92c')) {function content_59a7d9588f92c($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/loghin/sources/newSmarty/plugins/function.html_options.php';
if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
	<form action="" method="post">
	<table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#rowGroupsAction').toggle();"><?php echo $_smarty_tpl->tpl_vars['appPage']->value;?>
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
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowGroupsAction">
		<tr>
			<td class="gridLabels nowrap" width="130">
				<?php echo smarty_modifier_lang('parent');?>

			</td>
			<td class="gridValue">
				<select class="inputCombo" name="parent">
					<option value=""><?php echo smarty_modifier_lang('select_option');?>
</option>
					<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['parents']->value,'selected'=>$_smarty_tpl->tpl_vars['parent']->value),$_smarty_tpl);?>

				</select>
			</td>
		</tr>
		<tr>
			<td class="gridLabels" width="130" nowrap>
				<?php echo smarty_modifier_lang('label');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue">
				<input class="inputText" type="text" name="label" value="<?php echo $_smarty_tpl->tpl_vars['label']->value;?>
" maxlength="100" />
			</td>
		</tr>
		<tr>
			<td class="gridLabels" width="130">
				<?php echo smarty_modifier_lang('action_name');?>

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
<?php if ($_smarty_tpl->tpl_vars['lang']->value!=$_smarty_tpl->tpl_vars['sys_lang']->value){?> hide<?php }?>" style="width:500px" type="text" name="name[<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
]" maxlength="255" value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" />
                <?php } ?>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
				<input type="hidden" name="isGroupAction" value="1" />
			</td>
		</tr>
	</table>
    </form>
	<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>