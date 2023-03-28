<?php /* Smarty version Smarty-3.1.11, created on 2012-10-20 15:24:31
         compiled from "A:\loghin\www\admin\templates\layoutsGroups.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4773508282ebbf1704-92049643%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba883ec9f28abb4a6217d21568520a0c94152c94' => 
    array (
      0 => 'A:\\loghin\\www\\admin\\templates\\layoutsGroups.tpl',
      1 => 1350735870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4773508282ebbf1704-92049643',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_508282ebcaa876_86142303',
  'variables' => 
  array (
    'hideContent' => 0,
    'layoutsMenus' => 0,
    'menu' => 0,
    'id' => 0,
    '_menu' => 0,
    'fields' => 0,
    'group_id' => 0,
    'group' => 0,
    'vir_tpl_path' => 0,
    'item' => 0,
    'vir_cp_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_508282ebcaa876_86142303')) {function content_508282ebcaa876_86142303($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
	<form action="" method="post" enctype="multipart/form-data">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#rowLayoutsGroups').toggle();"><?php echo smarty_modifier_lang('manage_layouts_groups');?>
</a>
                  	</div>
                    <div class="right">
                    	<select class="inputCombo" id="toggleMenus">
                        	<?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layoutsMenus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>
		                        <optgroup label="<?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
">
			                        <?php  $_smarty_tpl->tpl_vars['_menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_menu']->key => $_smarty_tpl->tpl_vars['_menu']->value){
$_smarty_tpl->tpl_vars['_menu']->_loop = true;
?>
			                        <option value="<?php echo $_smarty_tpl->tpl_vars['_menu']->key;?>
"<?php if ($_smarty_tpl->tpl_vars['_menu']->key==$_smarty_tpl->tpl_vars['id']->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['_menu']->value;?>
</option>
			                        <?php } ?>
		                        </optgroup>
							<?php } ?>
                        </select>
                    </div>
              	</div>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowLayoutsGroups">
		<tr>
			<td class="gridValue">
				<ul id="itemsList" class="field_items">
                	<?php if (count($_smarty_tpl->tpl_vars['fields']->value)){?>
                    	<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_smarty_tpl->tpl_vars['group_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
 $_smarty_tpl->tpl_vars['group_id']->value = $_smarty_tpl->tpl_vars['group']->key;
?>
                        <li>
                            <input class="inputText" style="width:350px" type="text" name="items[][<?php echo $_smarty_tpl->tpl_vars['group_id']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
" />
	                        <input class="inputText" style="width:350px" type="text" name="url[][<?php echo $_smarty_tpl->tpl_vars['group_id']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['group']->value['url'];?>
" />
                            <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_down.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_up.gif" align="absmiddle" border="0" /></a>
                            <a href="javascript:void(0);" onclick="addItem(this);">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/add.gif" align="absmiddle" border="0" /></a>
                            <a href="javascript:void(0);" onclick="removeItem(this);">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/delete.gif" align="absmiddle" border="0" /></a>
	                        <ul>
		                        <?php if (false===empty($_smarty_tpl->tpl_vars['group']->value['items'])){?><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['group']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
		                        <li>
			                        <input class="inputText" style="width:350px" type="text" name="_items[<?php echo $_smarty_tpl->tpl_vars['group_id']->value;?>
][][<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" />
				                    <input class="inputText" style="width:350px" type="text" name="_url[<?php echo $_smarty_tpl->tpl_vars['group_id']->value;?>
][][<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
" />
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
			                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_down.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
			                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_up.gif" align="absmiddle" border="0" /></a>
			                        <a href="javascript:void(0);" onclick="addItem(this);">
			                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/add.gif" align="absmiddle" border="0" /></a>
			                        <a href="javascript:void(0);" onclick="removeItem(this);">
			                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/delete.gif" align="absmiddle" border="0" /></a>
			                    </li>
		                        <?php } ?><?php }?>
		                        <li>
			                        <input class="inputText" style="width:350px" type="text" name="_items[<?php echo $_smarty_tpl->tpl_vars['group_id']->value;?>
][][0]" value="" />
				                    <input class="inputText" style="width:350px" type="text" name="_url[<?php echo $_smarty_tpl->tpl_vars['group_id']->value;?>
][][0]" value="" />
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
			                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_down.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
			                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_up.gif" align="absmiddle" border="0" /></a>
			                        <a href="javascript:void(0);" onclick="addItem(this);">
			                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/add.gif" align="absmiddle" border="0" /></a>
			                        <a href="javascript:void(0);" onclick="removeItem(this);">
			                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/delete.gif" align="absmiddle" border="0" /></a>
			                    </li>
	                        </ul>
                        </li>
                    	<?php } ?>
                    <?php }?>
                    <li>
                        <input class="inputText" style="width:350px" type="text" name="items[][0]" value="" />
	                    <input class="inputText" style="width:350px" type="text" name="url[][0]" value="" />
                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_down.gif" align="absmiddle" /></a>
                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/move_up.gif" align="absmiddle" border="0" /></a>
                        <a href="javascript:void(0);" onclick="addItem(this);">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/add.gif" align="absmiddle" border="0" /></a>
                        <a href="javascript:void(0);" onclick="removeItem(this);">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['vir_tpl_path']->value;?>
media/options/delete.gif" align="absmiddle" border="0" /></a>
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
				<input type="hidden" name="isLayoutsGroups" value="1" />
			</td>
		</tr>
	</table>
    </form>
	</script>
	<script type="text/javascript">
	<!--//
	$(function() {
		$('#toggleMenus').on('change', function() {
			window.location.href = "<?php echo $_smarty_tpl->tpl_vars['vir_cp_path']->value;?>
index.php?m=layoutsgroups&id="+ $(this).val();
		});
    });
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