<?php /* Smarty version Smarty-3.1.7, created on 2012-12-07 10:25:31
         compiled from "/home/loghin/public_html/admin/templates/extensions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152650848550c2187ba10676-66695360%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f867f891480283f2ab16c772b03024851569fd1f' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/extensions.tpl',
      1 => 1354894606,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152650848550c2187ba10676-66695360',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'hideContent' => 0,
    'items' => 0,
    'item' => 0,
    'vir_tpl_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_50c2187bbabd8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50c2187bbabd8')) {function content_50c2187bbabd8($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
	<form action="" method="post" enctype="multipart/form-data">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs">
	           	<a href="javascript:void(0);" onclick="$('#rowExtensions').toggle();"><?php echo smarty_modifier_lang('manage_extensions');?>
</a>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowExtensions">
		<tr>
			<td class="gridValue">
				<ul class="field_items">
                	<?php if (false===empty($_smarty_tpl->tpl_vars['items']->value)){?>
                    	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <li>
                            <input class="inputText" style="width:350px" type="text" name="items[][<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
" />
                            <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_down.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_up.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="addItem(this);">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/add.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="removeItem(this);">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/delete.gif" align="absmiddle" /></a>
                    	<?php } ?>
                    <?php }?>
                    <li>
                        <input class="inputText" style="width:350px" type="text" name="items[][0]" value="" />
                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_down.gif" align="absmiddle" /></a>
                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_up.gif" align="absmiddle" /></a>
                        <a href="javascript:void(0);" onclick="addItem(this);">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/add.gif" align="absmiddle" /></a>
                        <a href="javascript:void(0);" onclick="removeItem(this);">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/delete.gif" align="absmiddle" /></a>
                    </li>
                </ul>
			</td>
		</tr>
   	</table>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
				<input type="hidden" name="isExtensions" value="1" />
			</td>
		</tr>
	</table>
    </form>
	<script type="text/javascript">
	<!--//
	function addItem(obj) {
		var $this = $(obj).closest('li');
		$this.after($this.closest('ul').children('li:last').clone().find('.inputText').val('').closest('li'));
	}

	function removeItem(obj) {
		if (confirm('Are you sure?')) {
			$(obj).parent().remove();
		}
	}

	function moveItem(obj, move) {
		var el = $(obj).parent();

		if (move == 'up' && $(el).prev().is('li') == true) {
			$(el).insertBefore($(el).prev());
		}
		else if (move == 'down' && $(el).next().is('li') == true) {
			$(el).insertAfter($(el).next());
		}
	}
	//-->
	</script>
	<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>