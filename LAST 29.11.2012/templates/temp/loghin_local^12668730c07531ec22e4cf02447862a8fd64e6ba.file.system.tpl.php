<?php /* Smarty version Smarty-3.1.11, created on 2012-10-11 10:25:27
         compiled from "A:\loghin\www\templates\plugins\system.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28877506a83a06cb8a8-70835479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12668730c07531ec22e4cf02447862a8fd64e6ba' => 
    array (
      0 => 'A:\\loghin\\www\\templates\\plugins\\system.tpl',
      1 => 1349940313,
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
    'memberTypes' => 0,
    'type' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_506a83a06cf110_06581106')) {function content_506a83a06cf110_06581106($_smarty_tpl) {?><div id="system" class="hide">
	<ul class="clear">
		<li class="left">
			<span>Loghin System</span>
			<ul>
				<li><a href="#">Item Number one</a></li>
				<li><a href="#">Item Number two</a></li>
				<li><a href="#">Item Number three</a></li>
			</ul>
		</li>
		<li class="right">
			<span>Loghin Users</span>
			<ul class="member-types">
			<?php  $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['type']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['memberTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['type']->key => $_smarty_tpl->tpl_vars['type']->value){
$_smarty_tpl->tpl_vars['type']->_loop = true;
?>
				<li><a data-id="<?php echo $_smarty_tpl->tpl_vars['type']->key;?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['type']->value;?>
</a></li>
			<?php } ?>
			</ul>
		</li>
	</ul>
	<a class="icon top disabled" href="javascript:void(0);">&nbsp;</a>
	<div class="overflow">
		<div class="list">
			<a class="item clear" href="#">
				<span class="icon left"></span>
				<span class="left">National</span>
				<span class="right control">-</span>
			</a>
			<div>
				<a class="item bg clear" href="#">
					<span class="left">.co.uk</span>
					<span class="right">Scottish referendum</span>
				</a>
				<a class="item bg clear" href="#">
					<span class="left">.it</span>
					<span class="right">Scottish referendum</span>
				</a>
				<a class="item bg clear" href="#">
					<span class="left">.ro</span>
					<span class="right">Scottish referendum</span>
				</a>
				<a class="item bg clear" href="#">
					<span class="left">.ro</span>
					<span class="right">Scottish referendum</span>
				</a>
				<a class="item bg clear" href="#">
					<span class="left">.ro</span>
					<span class="right">Scottish referendum</span>
				</a>
				<a class="item bg clear" href="#">
					<span class="left">.md</span>
					<span class="right">Scottish referendum</span>
				</a>
				<a class="item bg clear" href="#">
					<span class="left">.ru</span>
					<span class="right">Scottish referendum</span>
				</a>
				<a class="item bg clear" href="#">
					<span class="left">.ua</span>
					<span class="right">Scottish referendum</span>
				</a>
				<a class="item bg clear" href="#">
					<span class="left">.pt</span>
					<span class="right">Scottish referendum</span>
				</a>
				<a class="item bg clear" href="#">
					<span class="left">.fr</span>
					<span class="right">Scottish referendum</span>
				</a>
				<a class="item bg clear" href="#">
					<span class="left">.uk</span>
					<span class="right">Scottish referendum</span>
				</a>
			</div>
			<a class="item clear" href="#">
				<span class="icon left"></span>
				<span class="left">General</span>
				<span class="right control">+</span>
			</a>
			<div class="hide">
				<a class="item bg clear" href="#">
					<span class="left">.my</span>
					<span class="right">Scottish referendum</span>
				</a>
			</div>
		</div>
	</div>
	<a class="icon bottom disabled" href="javascript:void(0);">&nbsp;</a>
</div><!-- #sites --><?php }} ?>