<?php /* Smarty version Smarty-3.1.7, created on 2023-03-24 10:48:28
         compiled from "/home/loghin/public_html/admin/templates/member_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12929740915865261d66c617-46945558%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6790a6add16d04f8e7286c8ae4cd2b502043c9e' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/member_edit.tpl',
      1 => 1679476323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12929740915865261d66c617-46945558',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5865261d8602a',
  'variables' => 
  array (
    'hideContent' => 0,
    'id' => 0,
    'username' => 0,
    'email' => 0,
    'joindate' => 0,
    'lastvisit' => 0,
    'groups' => 0,
    'group_id' => 0,
    'status' => 0,
    'forum_active' => 0,
    'active' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5865261d8602a')) {function content_5865261d8602a($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
if (!is_callable('smarty_function_html_options')) include '/home/loghin/sources/newSmarty/plugins/function.html_options.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
	<form action="" method="post">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs">
				<a href="javascript:void(0);" onclick="$('#row_account').toggle();"><?php if ($_smarty_tpl->tpl_vars['id']->value){?><?php echo smarty_modifier_lang('edit_member');?>
<?php }else{ ?><?php echo smarty_modifier_lang('add_member');?>
<?php }?></a>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="row_account">
    	<tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('username');?>
 <span class="required">*</span>
            </td>
            <td class="gridValue">
            	<input class="inputText" style="width:300px" type="text" name="username" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" />
            </td>
        </tr>
		<tr>
			<td class="gridLabels">
				<?php echo smarty_modifier_lang('email');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue"> 
				<input class="inputText" style="width:300px" type="text" name="email" maxlength="64" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" />
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
				<?php echo smarty_modifier_lang('password');?>

           	</td>
			<td class="gridValue">
				<input class="inputText" style="width:300px" type="password" name="password" maxlength="32" value="" autocomplete="off" />
			</td>
		</tr>
        <tr>
            <td class="gridLabels">
                <?php echo smarty_modifier_lang('confirm_password');?>

            </td>
            <td class="gridValue">
                <input class="inputText" style="width:300px" type="password" name="password2" maxlength="32" value="" autocomplete="off" />
            </td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['id']->value){?><tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('joindate');?>

            </td>
            <td class="gridValue">
            	<?php echo $_smarty_tpl->tpl_vars['joindate']->value;?>

            </td>
        </tr>
        <tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('lastvisit');?>

            </td>
            <td class="gridValue">
            	<?php echo $_smarty_tpl->tpl_vars['lastvisit']->value;?>

            </td>
        </tr><?php }?>
        <tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('group');?>

            </td>
            <td class="gridValue">
            	<select class="inputCombo" name="group">
                	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['groups']->value,'selected'=>$_smarty_tpl->tpl_vars['group_id']->value),$_smarty_tpl);?>

                </select>
            </td>
        </tr>
		<tr>
			<td class="gridLabels">
				<?php echo smarty_modifier_lang('forum_status');?>

			</td>
			<td class="gridValue">
				<select class="inputCombo" name="forum_active">
					<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['status']->value,'selected'=>$_smarty_tpl->tpl_vars['forum_active']->value),$_smarty_tpl);?>

				</select>
			</td>
		</tr>
        <tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('status');?>

            </td>
            <td class="gridValue">
            	<select class="inputCombo" name="active">
                	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['status']->value,'selected'=>$_smarty_tpl->tpl_vars['active']->value),$_smarty_tpl);?>

                </select>
            </td>
        </tr>
   	</table>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
				<input type="hidden" name="ismember" value="1" />
			</td>
		</tr>
	</table>
    </form>
	<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>