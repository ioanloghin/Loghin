<?php /* Smarty version Smarty-3.1.7, created on 2012-10-16 08:41:10
         compiled from "/home/loghin/public_html/templates/plugins/system.tpl" */ ?>
<?php /*%%SmartyHeaderCode:206466140350771021456f75-43952413%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b2a98e60cdc584d1b533324017d6284eb7fb4af' => 
    array (
      0 => '/home/loghin/public_html/templates/plugins/system.tpl',
      1 => 1350394869,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206466140350771021456f75-43952413',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5077102148a3a',
  'variables' => 
  array (
    'memberTypes' => 0,
    'type' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5077102148a3a')) {function content_5077102148a3a($_smarty_tpl) {?><div id="system" class="hide">
	<ul class="clear">
		<li class="left">
			<span>Loghin System</span>
			<ul>
				<li>
					<a href="#">System Menu A</a>
					<ul>
						<li><a href="#">System Menu A 1</a></li>
						<li><a href="#">System Menu A 2</a></li>
						<li><a href="#">System Menu A 3</a></li>
						<li><a href="#">System Menu A 4</a></li>
					</ul>
				</li>
				<li>
					<a href="#">System Menu B</a>
					<ul>
						<li><a href="#">System Menu B 1</a></li>
						<li><a href="#">System Menu B 2</a></li>
						<li><a href="#">System Menu B 3</a></li>
						<li><a href="#">System Menu B 4</a></li>
					</ul>
				</li>
				<li>
					<a href="#">System Menu C</a>
					<ul>
						<li><a href="#">System Menu C 1</a></li>
						<li><a href="#">System Menu C 2</a></li>
						<li><a href="#">System Menu C 3</a></li>
						<li><a href="#">System Menu C 4</a></li>
					</ul>
				</li>
				<li>
					<a href="#">System Menu D</a>
					<ul>
						<li><a href="#">System Menu D 1</a></li>
						<li><a href="#">System Menu D 2</a></li>
						<li><a href="#">System Menu D 3</a></li>
						<li><a href="#">System Menu D 4</a></li>
					</ul>
				</li>
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
		</div>
	</div>
	<a class="icon bottom disabled" href="javascript:void(0);">&nbsp;</a>
</div><!-- #sites --><?php }} ?>