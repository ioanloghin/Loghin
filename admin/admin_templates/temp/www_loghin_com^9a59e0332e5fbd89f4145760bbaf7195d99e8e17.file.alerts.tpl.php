<?php /* Smarty version Smarty-3.1.7, created on 2016-12-29 15:06:44
         compiled from "/home/loghin/public_html/admin/templates/alerts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:554417668586526843c3d83-12691087%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9a59e0332e5fbd89f4145760bbaf7195d99e8e17' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/alerts.tpl',
      1 => 1351531916,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '554417668586526843c3d83-12691087',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msgBody' => 0,
    'message' => 0,
    'msgType' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_586526844f7b0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_586526844f7b0')) {function content_586526844f7b0($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php if (is_array($_smarty_tpl->tpl_vars['msgBody']->value)&&count($_smarty_tpl->tpl_vars['msgBody']->value)>1){?>
<div class="error_messages">
	<h2><?php echo smarty_modifier_lang('errors_title');?>
</h2>
	<ul>
	<?php  $_smarty_tpl->tpl_vars['message'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['message']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['msgBody']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['message']->key => $_smarty_tpl->tpl_vars['message']->value){
$_smarty_tpl->tpl_vars['message']->_loop = true;
?>
		<li><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</li>
	<?php } ?>
	</ul>
</div>
<?php }else{ ?>
<table cellpadding='0' cellspacing='12' width='100%' class='<?php if ($_smarty_tpl->tpl_vars['msgType']->value=='info'){?>infomsg<?php }else{ ?>errormsg<?php }?>'>
	<tr>
		<td><?php if (is_array($_smarty_tpl->tpl_vars['msgBody']->value)){?><?php echo current($_smarty_tpl->tpl_vars['msgBody']->value);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['msgBody']->value;?>
<?php }?></td>
	</tr>
</table>
<?php }?><?php }} ?>