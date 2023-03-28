<?php /* Smarty version Smarty-3.0.8, created on 2011-07-13 13:13:41
         compiled from "A:/loghin/www/admin/templates/memberGroupsActionEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:320784e1d6fd521e103-34778827%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a5ccedb2a8a054d66bb37b60fe0e4ab1481c4f3' => 
    array (
      0 => 'A:/loghin/www/admin/templates/memberGroupsActionEdit.tpl',
      1 => 1310552018,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320784e1d6fd521e103-34778827',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_html_options')) include 'A:/AppServices/Smarty/plugins\function.html_options.php';
if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins\modifier.lang.php';
?><?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php if ($_smarty_tpl->getVariable('hideContent')->value!=1){?>
	<form action="" method="post">
	<table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#rowGroupsAction').toggle();"><?php echo $_smarty_tpl->getVariable('appPage')->value;?>
</a>
                  	</div>
                    <div class="right">
                    	<select class="inputCombo" id="toggleLanguage">
                        	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->getVariable('languages')->value,'selected'=>$_smarty_tpl->getVariable('sys_lang')->value),$_smarty_tpl);?>

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
					<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->getVariable('parents')->value,'selected'=>$_smarty_tpl->getVariable('parent')->value),$_smarty_tpl);?>

				</select>
			</td>
		</tr>
		<tr>
			<td class="gridLabels" width="130" nowrap>
				<?php echo smarty_modifier_lang('label');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue">
				<input class="inputText" type="text" name="label" value="<?php echo $_smarty_tpl->getVariable('label')->value;?>
" maxlength="100" />
			</td>
		</tr>
		<tr>
			<td class="gridLabels" width="130">
				<?php echo smarty_modifier_lang('action_name');?>

			</td>
			<td class="gridValue">
				<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('name')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['lang']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
					<input class="inputText lang__<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
<?php if ($_smarty_tpl->tpl_vars['lang']->value!=$_smarty_tpl->getVariable('sys_lang')->value){?> hide<?php }?>" style="width:500px" type="text" name="name[<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
]" maxlength="255" value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" />
                <?php }} ?>
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
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>