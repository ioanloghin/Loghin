<?php /* Smarty version Smarty-3.1.7, created on 2016-12-29 15:02:46
         compiled from "/home/loghin/public_html/admin/templates/settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:76890728458652596622d53-92115752%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7690cd2d681770ad9d6fb6a14bdd1be9e351f332' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/settings.tpl',
      1 => 1351531940,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '76890728458652596622d53-92115752',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hideContent' => 0,
    'group_name' => 0,
    'empty' => 0,
    'languages' => 0,
    'sys_lang' => 0,
    'fields' => 0,
    'item' => 0,
    'lang' => 0,
    'value' => 0,
    'yesnobox' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5865259698531',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5865259698531')) {function content_5865259698531($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/loghin/sources/newSmarty/plugins/function.html_options.php';
if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
	<form action="" method="post">
	<table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#row_settigns').toggle();"><?php echo $_smarty_tpl->tpl_vars['group_name']->value;?>
</a>
                  	</div>
                    <div class="right">
                    	<?php if (!$_smarty_tpl->tpl_vars['empty']->value){?><select class="inputCombo" id="toggle_language">
                        	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['languages']->value,'selected'=>$_smarty_tpl->tpl_vars['sys_lang']->value),$_smarty_tpl);?>

                        </select><?php }?>
                    </div>
              	</div>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="row_settigns">
	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
		<tr>
			<td class="gridLabels" width="300" nowrap>
				<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>

			</td>
			<td class="gridValue">
				<?php if ($_smarty_tpl->tpl_vars['item']->value['type']=="text_ln"){?>
					<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['item']->value['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['lang']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
						<input class="inputText __lang__<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
__<?php if ($_smarty_tpl->tpl_vars['lang']->value!=$_smarty_tpl->tpl_vars['sys_lang']->value){?> hide<?php }?>" type="text" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
[<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" size="50" />
					<?php } ?>
				<?php }elseif($_smarty_tpl->tpl_vars['item']->value['type']=="textarea_ln"){?>
					<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['item']->value['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['lang']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
						<textarea class="inputTextarea __lang__<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
__<?php if ($_smarty_tpl->tpl_vars['lang']->value!=$_smarty_tpl->tpl_vars['sys_lang']->value){?> hide<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>
[<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
]" cols="50" rows="4"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</textarea>
					<?php } ?>
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
						<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['yesnobox']->value,'selected'=>$_smarty_tpl->tpl_vars['item']->value['value']),$_smarty_tpl);?>

					</select>
				<?php }?>
			</td>
		</tr>
	<?php } ?>
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
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>