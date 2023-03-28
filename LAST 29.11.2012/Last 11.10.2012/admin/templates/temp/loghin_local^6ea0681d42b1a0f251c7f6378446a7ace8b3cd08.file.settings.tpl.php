<?php /* Smarty version Smarty-3.0.8, created on 2011-07-12 11:34:02
         compiled from "A:/loghin/www/admin/templates/settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:282834e1c06faa6e8d4-00779685%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ea0681d42b1a0f251c7f6378446a7ace8b3cd08' => 
    array (
      0 => 'A:/loghin/www/admin/templates/settings.tpl',
      1 => 1310459627,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '282834e1c06faa6e8d4-00779685',
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
                    	<a href="javascript:void(0);" onclick="$('#row_settigns').toggle();"><?php echo $_smarty_tpl->getVariable('group_name')->value;?>
</a>
                  	</div>
                    <div class="right">
                    	<?php if (!$_smarty_tpl->getVariable('empty')->value){?><select class="inputCombo" id="toggle_language">
                        	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->getVariable('languages')->value,'selected'=>$_smarty_tpl->getVariable('sys_lang')->value),$_smarty_tpl);?>

                        </select><?php }?>
                    </div>
              	</div>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="row_settigns">
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('fields')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		<tr>
			<td class="gridLabels" width="300" nowrap>
				<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>

			</td>
			<td class="gridValue">
				<?php if ($_smarty_tpl->tpl_vars['item']->value['type']=="text_ln"){?>
					<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['item']->value['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['lang']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
						<input class="inputText __lang__<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
__<?php if ($_smarty_tpl->tpl_vars['lang']->value!=$_smarty_tpl->getVariable('sys_lang')->value){?> hide<?php }?>" type="text" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
[<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" size="50" />
					<?php }} ?>
				<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=="textarea_ln"){?>
					<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['item']->value['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['lang']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
						<textarea class="inputTextarea __lang__<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
__<?php if ($_smarty_tpl->tpl_vars['lang']->value!=$_smarty_tpl->getVariable('sys_lang')->value){?> hide<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
[<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
]" cols="50" rows="4"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</textarea>
					<?php }} ?>
				<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=="text"){?>
					<input type="text" class="inputText" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
" size="50" />
				<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=="textarea"){?>
					<textarea name="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
" cols="40" rows="4" class="inputTextarea"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</textarea>
				<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=="email"){?>
					<input type="text" class="inputText" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
" size="50" />
				<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=="number"){?>
					<input type="text" class="inputText" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
" size="10" />
				<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=="boolean"){?>
					<select class="inputCombo" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
">
						<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->getVariable('yesnobox')->value,'selected'=>$_smarty_tpl->tpl_vars['item']->value['value']),$_smarty_tpl);?>

					</select>
				<?php }?>
			</td>
		</tr>
	<?php }} ?>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
				<input type="hidden" name="issettings" value="1" />
			</td>
		</tr>
	</table>
	</form>
	<?php }?>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>