<?php /* Smarty version Smarty-3.0.8, created on 2011-07-12 11:23:34
         compiled from "A:/loghin/www/admin/templates/alerts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:158554e1c0486926620-16018520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2cb4bcdb6e1f567bde9e36577ee039909797549' => 
    array (
      0 => 'A:/loghin/www/admin/templates/alerts.tpl',
      1 => 1310457811,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158554e1c0486926620-16018520',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins\modifier.lang.php';
?><?php if (is_array($_smarty_tpl->getVariable('msgBody')->value)&&count($_smarty_tpl->getVariable('msgBody')->value)>1){?>
<div class="error_messages">
	<h2><?php echo smarty_modifier_lang('errors_title');?>
</h2>
	<ul>
	<?php  $_smarty_tpl->tpl_vars['message'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('msgBody')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['message']->key => $_smarty_tpl->tpl_vars['message']->value){
?>
		<li><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</li>
	<?php }} ?>
	</ul>
</div>
<?php }else{ ?>
<table cellpadding='0' cellspacing='12' width='100%' class='<?php if ($_smarty_tpl->getVariable('msgType')->value=='info'){?>infomsg<?php }else{ ?>errormsg<?php }?>'>
	<tr>
		<td><?php if (is_array($_smarty_tpl->getVariable('msgBody')->value)){?><?php echo current($_smarty_tpl->getVariable('msgBody')->value);?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('msgBody')->value;?>
<?php }?></td>
	</tr>
</table>
<?php }?>