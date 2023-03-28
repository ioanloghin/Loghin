<?php /* Smarty version Smarty-3.0.8, created on 2011-07-14 12:48:21
         compiled from "A:/loghin/www/admin/templates/emailtemplates.tpl" */ ?>
<?php /*%%SmartyHeaderCode:326124e1ebb659f77d6-13467863%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '443d4304d89afb25418c0b32884309d55d3fd731' => 
    array (
      0 => 'A:/loghin/www/admin/templates/emailtemplates.tpl',
      1 => 1306936816,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '326124e1ebb659f77d6-13467863',
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
                    	<a href="javascript:void(0);" onclick="$('#rowEmailTemplates').toggle();"><?php echo $_smarty_tpl->getVariable('name')->value;?>
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
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowEmailTemplates">
		<tr>
			<td class="gridLabels" width="130" nowrap>
				<?php echo smarty_modifier_lang('subject');?>

			</td>
			<td class="gridValue">
				<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('subject')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['lang']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
					<input class="inputText lang__<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
<?php if ($_smarty_tpl->tpl_vars['lang']->value!=$_smarty_tpl->getVariable('sys_lang')->value){?> hide<?php }?>" style="width:500px" type="text" name="subject[<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
]" maxlength="255" value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" />
                <?php }} ?>
			</td>
		</tr>
		<tr>
			<td class="gridLabels" width="130" nowrap>
				<?php echo smarty_modifier_lang('body');?>

			</td>
			<td class="gridValue">
				<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('body')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
 $_smarty_tpl->tpl_vars['lang']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
				<div class="lang__<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
<?php if ($_smarty_tpl->tpl_vars['lang']->value!=$_smarty_tpl->getVariable('sys_lang')->value){?> hide<?php }?>">
					<textarea class="inputTextarea ckeditor" name="body[<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
]" cols="50" rows="8" style="width:605px;height:200px"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</textarea>
				</div>
				<?php }} ?>
			</td>
		</tr>
		<tr>
			<td class="gridHeader" colspan="2" style="text-align:left">
				<a href="javascript:void(0);" onclick="$('._row_keywords_').toggle();">Allowed keywords</a>
			</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{website}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_website');?>

           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{email}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_email');?>

           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{name}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_name');?>

           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{firstname}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_firstname');?>

           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{lastname}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_lastname');?>

           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{subject}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_subject');?>

           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{street}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_street');?>

           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{zip}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_zip');?>

           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{city}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_city');?>

           	</td>
		</tr>		
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{phone}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_phone');?>

           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{message}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_message');?>

           	</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{property}
			</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_property');?>

			</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{contact}
			</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_contact');?>

			</td>
		</tr>
		<tr class="_row_keywords_" style="display:none">
			<td class="gridLabels">
				{action_link}
           	</td>
			<td class="gridValue">
				<?php echo smarty_modifier_lang('i_action_link');?>

           	</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
				<input type="hidden" name="isemailtemplates" value="1" />
			</td>
		</tr>
	</table>
    </form>
	<?php }?>
<?php $_template = new Smarty_Internal_Template('footer.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>