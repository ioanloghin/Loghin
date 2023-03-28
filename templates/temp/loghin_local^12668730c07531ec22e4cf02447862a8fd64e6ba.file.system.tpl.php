<?php /* Smarty version Smarty-3.1.11, created on 2012-10-24 11:07:05
         compiled from "A:\loghin\www\templates\plugins\system.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28877506a83a06cb8a8-70835479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12668730c07531ec22e4cf02447862a8fd64e6ba' => 
    array (
      0 => 'A:\\loghin\\www\\templates\\plugins\\system.tpl',
      1 => 1351066024,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28877506a83a06cb8a8-70835479',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_506a83a06cf110_06581106',
  'variables' => 
  array (
    'systemMenus' => 0,
    'menu' => 0,
    'lastType' => 0,
    '_menu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_506a83a06cf110_06581106')) {function content_506a83a06cf110_06581106($_smarty_tpl) {?><div id="system" class="hide">
	<ul class="clear">
		<?php $_smarty_tpl->tpl_vars["lastType"] = new Smarty_variable('', null, 0);?>
		<li class="left">
			<span>Loghin System</span>
			<ul>
			<?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['systemMenus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>
			<?php if ($_smarty_tpl->tpl_vars['menu']->value['type']!='left'&&$_smarty_tpl->tpl_vars['lastType']->value!='right'){?>
				<?php $_smarty_tpl->tpl_vars["lastType"] = new Smarty_variable("right", null, 0);?>
				</ul>
			</li>
			<li class="right">
				<span>Loghin Users</span>
				<ul>
			<?php }?>
			<li>
				<a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
</a>
				<?php if ($_smarty_tpl->tpl_vars['menu']->value['items']){?>
				<ul>
					<?php  $_smarty_tpl->tpl_vars['_menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_menu']->key => $_smarty_tpl->tpl_vars['_menu']->value){
$_smarty_tpl->tpl_vars['_menu']->_loop = true;
?>
						<li><a data-id="<?php echo $_smarty_tpl->tpl_vars['_menu']->key;?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['_menu']->value;?>
</a></li>
					<?php } ?>
				</ul>
				<?php }?>
			</li>
			<?php } ?>
			</ul>
		</li>
	</ul>
	<a class="icon top disabled" href="javascript:void(0);">&nbsp;</a>
	<div class="overflow">
		<div class="list">
		</div>
	</div>
	<a class="icon bottom disabled" href="javascript:void(0);">&nbsp;</a>
</div><!-- #sites --><?php }} ?>