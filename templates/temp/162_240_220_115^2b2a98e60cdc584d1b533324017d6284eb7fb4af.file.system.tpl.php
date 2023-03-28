<?php /* Smarty version Smarty-3.1.7, created on 2022-10-04 14:22:40
         compiled from "/home/loghin/public_html/templates/plugins/system.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1251195889633c41b045dda1-02547432%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b2a98e60cdc584d1b533324017d6284eb7fb4af' => 
    array (
      0 => '/home/loghin/public_html/templates/plugins/system.tpl',
      1 => 1351531934,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1251195889633c41b045dda1-02547432',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'systemMenus' => 0,
    'menu' => 0,
    'lastType' => 0,
    '_menu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_633c41b047b51',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_633c41b047b51')) {function content_633c41b047b51($_smarty_tpl) {?><div id="system" class="hide">
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