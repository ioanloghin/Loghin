<?php /* Smarty version Smarty-3.1.7, created on 2014-10-02 10:26:54
         compiled from "/home/loghin/public_html/admin/templates/layoutsGroupEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:68527332450c21c2ea412e6-30910457%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '967826923f2bae4b2c53826a45ff3d6ae7114e93' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/layoutsGroupEdit.tpl',
      1 => 1355232194,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68527332450c21c2ea412e6-30910457',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_50c21c2ec0ac7',
  'variables' => 
  array (
    'hideContent' => 0,
    'name' => 0,
    'info' => 0,
    'url' => 0,
    'text_top' => 0,
    'text_bottom' => 0,
    'extensions' => 0,
    'extension_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50c21c2ec0ac7')) {function content_50c21c2ec0ac7($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
if (!is_callable('smarty_function_html_options')) include '/home/loghin/sources/newSmarty/plugins/function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
	<form action="" method="post">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs">
				<a href="javascript:void(0);" onclick="$('#rowLayoutsGroup').toggle();"><?php echo smarty_modifier_lang('edit_layout_group');?>
</a>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowLayoutsGroup">
    	<tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('name');?>
 <span class="required">*</span>
            </td>
            <td class="gridValue">
            	<input class="inputText" style="width:300px" type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" />
            </td>
        </tr>
		<tr>
			<td class="gridLabels">
				<?php echo smarty_modifier_lang('info');?>

			</td>
			<td class="gridValue"> 
				<input class="inputText" style="width:300px" type="text" name="info" maxlength="64" value="<?php echo $_smarty_tpl->tpl_vars['info']->value;?>
" />
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
				<?php echo smarty_modifier_lang('link');?>

			</td>
			<td class="gridValue">
				<input class="inputText" style="width:300px" type="text" name="url" maxlength="64" value="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" />
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
				<?php echo smarty_modifier_lang('text_top');?>

           	</td>
			<td class="gridValue">
				<input class="inputText" style="width:300px" type="text" name="text_top" maxlength="33" value="<?php echo $_smarty_tpl->tpl_vars['text_top']->value;?>
" />
			</td>
		</tr>
        <tr>
            <td class="gridLabels">
                <?php echo smarty_modifier_lang('text_bottom');?>

            </td>
            <td class="gridValue">
                <input class="inputText" style="width:300px" type="text" name="text_bottom" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['text_bottom']->value;?>
" />
            </td>
        </tr>
        <tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('extension');?>

            </td>
            <td class="gridValue">
            	<select class="inputCombo" name="extension">
                	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['extensions']->value,'selected'=>$_smarty_tpl->tpl_vars['extension_id']->value),$_smarty_tpl);?>

                </select>
            </td>
        </tr>
   	</table>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
				<input type="hidden" name="isLayoutGroup" value="1" />
			</td>
		</tr>
	</table>
    </form>
	<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>