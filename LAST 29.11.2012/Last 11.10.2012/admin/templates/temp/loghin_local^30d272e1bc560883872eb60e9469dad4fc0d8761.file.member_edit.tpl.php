<?php /* Smarty version Smarty-3.0.8, created on 2011-07-12 11:26:21
         compiled from "A:/loghin/www/admin/templates/member_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:243434e1c052d4f95c2-50649285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30d272e1bc560883872eb60e9469dad4fc0d8761' => 
    array (
      0 => 'A:/loghin/www/admin/templates/member_edit.tpl',
      1 => 1310459178,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '243434e1c052d4f95c2-50649285',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins\modifier.lang.php';
if (!is_callable('smarty_function_html_options')) include 'A:/AppServices/Smarty/plugins\function.html_options.php';
?><?php $_template = new Smarty_Internal_Template('header.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	<?php if ($_smarty_tpl->getVariable('hideContent')->value!=1){?>
	<form action="" method="post">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs">
				<a href="javascript:void(0);" onclick="$('#row_account').toggle();"><?php if ($_smarty_tpl->getVariable('id')->value){?><?php echo smarty_modifier_lang('edit_member');?>
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
            	<input class="inputText" style="width:300px" type="text" name="username" value="<?php echo $_smarty_tpl->getVariable('username')->value;?>
" />
            </td>
        </tr>
		<tr>
			<td class="gridLabels">
				<?php echo smarty_modifier_lang('email');?>
 <span class="required">*</span>
			</td>
			<td class="gridValue"> 
				<input class="inputText" style="width:300px" type="text" name="email" maxlength="64" value="<?php echo $_smarty_tpl->getVariable('email')->value;?>
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
        <?php if ($_smarty_tpl->getVariable('id')->value){?><tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('joindate');?>

            </td>
            <td class="gridValue">
            	<?php echo $_smarty_tpl->getVariable('joindate')->value;?>

            </td>
        </tr>
        <tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('lastvisit');?>

            </td>
            <td class="gridValue">
            	<?php echo $_smarty_tpl->getVariable('lastvisit')->value;?>

            </td>
        </tr><?php }?>
        <tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('group');?>

            </td>
            <td class="gridValue">
            	<select class="inputCombo" name="group">
                	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->getVariable('groups')->value,'selected'=>$_smarty_tpl->getVariable('group_id')->value),$_smarty_tpl);?>

                </select>
            </td>
        </tr>
		<tr>
			<td class="gridLabels">
				<?php echo smarty_modifier_lang('forum_status');?>

			</td>
			<td class="gridValue">
				<select class="inputCombo" name="forum_active">
					<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->getVariable('status')->value,'selected'=>$_smarty_tpl->getVariable('forum_active')->value),$_smarty_tpl);?>

				</select>
			</td>
		</tr>
        <tr>
        	<td class="gridLabels">
            	<?php echo smarty_modifier_lang('status');?>

            </td>
            <td class="gridValue">
            	<select class="inputCombo" name="active">
                	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->getVariable('status')->value,'selected'=>$_smarty_tpl->getVariable('active')->value),$_smarty_tpl);?>

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
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>