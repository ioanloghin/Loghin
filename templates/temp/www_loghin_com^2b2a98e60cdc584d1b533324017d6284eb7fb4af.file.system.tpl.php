<?php /* Smarty version Smarty-3.1.7, created on 2023-01-12 14:59:34
         compiled from "/home/loghin/public_html/templates/plugins/system.tpl" */ ?>
<?php /*%%SmartyHeaderCode:763323452508ec04431bd08-54147694%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b2a98e60cdc584d1b533324017d6284eb7fb4af' => 
    array (
      0 => '/home/loghin/public_html/templates/plugins/system.tpl',
      1 => 1673528288,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '763323452508ec04431bd08-54147694',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_508ec0443ac02',
  'variables' => 
  array (
    'systemMenus' => 0,
    'menu' => 0,
    'lastType' => 0,
    '_menu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_508ec0443ac02')) {function content_508ec0443ac02($_smarty_tpl) {?><style>
    #system .overflow .list > div a.item,
	#system .overflow .list > div a.item.has {
        background: #e1e1e1 !important;
    }
    
    #system .overflow .list > div a.item:hover, 
    #system .overflow .list > div a.item.has:hover {
        /*background-position: 0 -80px !important;*/
        background: url(https://loghin.com/templates/images/application/bg.png) repeat-x transparent !important;
        /*background: url(https://loghin.com/templates/media/bg.png) repeat-x transparent !important;*/
    }
    #system .overflow{
        overflow: scroll !important;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    #system .overflow::-webkit-scrollbar {
        display: none;
    }
    #system .overflow .list > div a.item.selected {
        background-position: 0 0px !important;
        background: url(https://loghin.com/templates/media/bg.png) repeat-x transparent !important;
    }
    #system > a.icon.bottom {
        background-position: -34px -18px !important;
    }
    #system > a.icon.top {
        background-position: -23px -18px !important;
    }
    #system .overflow .list > div a.item.selected > * {
        color: #ffffff;
    }
    #system .overflow .list{
        background-color: #197cc914;
    }
    #system a.item > .left.icon{
        background-position: -1px -1px;
        border: 1px solid #3697DB;
        width: 16px;
        height: 16px;
    }
</style>
<div id="system" class="hide">
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