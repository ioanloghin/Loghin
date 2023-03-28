<?php /* Smarty version Smarty-3.1.11, created on 2012-10-11 09:50:37
         compiled from "A:\loghin\www\admin\templates\layoutEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3194350755b5d1a7bc6-18141660%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f57c7584addde588869a7933b034ca6d1b29566' => 
    array (
      0 => 'A:\\loghin\\www\\admin\\templates\\layoutEdit.tpl',
      1 => 1349938235,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3194350755b5d1a7bc6-18141660',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50755b5d283044_03865943',
  'variables' => 
  array (
    'hideContent' => 0,
    'appPage' => 0,
    'languages' => 0,
    'sys_lang' => 0,
    'memberTypes' => 0,
    'member_type' => 0,
    'name' => 0,
    'lang' => 0,
    'value' => 0,
    '_items' => 0,
    'items' => 0,
    'item' => 0,
    'statuse' => 0,
    'status' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50755b5d283044_03865943')) {function content_50755b5d283044_03865943($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'A:/!Services/Smarty/plugins\\function.html_options.php';
if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
	<form action="" method="post" enctype="multipart/form-data">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0;border-bottom:0">
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
			<td class="gridLabels">
				<?php echo smarty_modifier_lang('member_type');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue" colspan="2">
				<select class="inputCombo" name="member_type">
					<option value=""><?php echo smarty_modifier_lang('select_member_type');?>
</option>
					<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['memberTypes']->value,'selected'=>$_smarty_tpl->tpl_vars['member_type']->value),$_smarty_tpl);?>

				</select>
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
            	<?php echo smarty_modifier_lang('name');?>
 <span class="required">*</span>
            </td>
			<td class="gridValue" colspan="2">
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
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
	    <tr>
	        <td class="gridHeader" width="50%"><?php echo smarty_modifier_lang('sites');?>
</td>
	        <td class="gridHeader" width="50%"><?php echo smarty_modifier_lang('applications');?>
</td>
	    </tr>
		<tr id="items">
			<td class="gridValue">
				<ul class="field_items site">
				<?php if ($_smarty_tpl->tpl_vars['_items']->value['site']){?>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['_items']->value['site']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
					<li><label><input type="checkbox" name="items[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"<?php if (in_array($_smarty_tpl->tpl_vars['item']->key,$_smarty_tpl->tpl_vars['items']->value)){?> checked="checked"<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</label></li>
					<?php } ?>
				<?php }?>
				</ul>
			</td>
			<td class="gridValue">
				<ul class="field_items application">
				<?php if ($_smarty_tpl->tpl_vars['_items']->value['application']){?>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['_items']->value['application']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
					<li><label><input type="checkbox" name="items[]" value="<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"<?php if (in_array($_smarty_tpl->tpl_vars['item']->key,$_smarty_tpl->tpl_vars['items']->value)){?> checked="checked"<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</label></li>
					<?php } ?>
				<?php }?>
				</ul>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
        	<td class="gridTabs" colspan="3"><strong><?php echo smarty_modifier_lang('actions');?>
</strong></td>
        </tr>
        <tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('status');?>

            </td>
            <td class="gridValue" colspan="2">
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
    	$('select[name="member_type"]').bind('change', function() {
    		var $this = $(this);
		    $.post($.conf.path +'index.php?m=layouts&p=items', { 'id': $this.val() }, function(data) {
			    if (typeof data.site == 'object' && typeof data.application == 'object') {
				    $.each(data, function(key, items) {
					    /* Set tag */
					    var tag = $('#items').find('.'+ key).html('');
					    $.each(items, function(id, name) {
						    tag.append('<li><label><input type="checkbox" name="items[]" value="'+ id +'" /> '+ name +'</label></li>');
					    });
				    });
                }
		    }, 'json');
    	});
		$('#items').on('click check', 'input', function() {
			var $this = $(this).parents('ul');
			if ($this.find(':checked').length >= 6) {
				$this.find(':not(:checked)').attr('disabled', true);
            }
			else {
				$this.find(':disabled').attr('disabled', false);
            }
		}).find('input').trigger('check');
    });
    </script>
	<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>