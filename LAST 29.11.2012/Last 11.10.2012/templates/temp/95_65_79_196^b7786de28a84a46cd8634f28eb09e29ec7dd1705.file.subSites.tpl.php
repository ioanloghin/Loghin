<?php /* Smarty version Smarty-3.0.8, created on 2011-09-13 13:20:43
         compiled from "A:/loghin/www/templates/subSites.tpl" */ ?>
<?php /*%%SmartyHeaderCode:57624e6f2e7bc48fe0-57626915%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7786de28a84a46cd8634f28eb09e29ec7dd1705' => 
    array (
      0 => 'A:/loghin/www/templates/subSites.tpl',
      1 => 1314006009,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57624e6f2e7bc48fe0-57626915',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins\modifier.lang.php';
?><?php if ($_smarty_tpl->getVariable('hideContent')->value==1){?><div class="msg error"><?php echo $_smarty_tpl->getVariable('msgBody')->value;?>
</div><?php }else{ ?><div id="subcats"><div class="cnt"><h2><?php echo $_smarty_tpl->getVariable('siteName')->value;?>
 <?php echo smarty_modifier_lang('sub-sites');?>
</h2><div class="items clear"><?php  $_smarty_tpl->tpl_vars['_data'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sites')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['_data']->key => $_smarty_tpl->tpl_vars['_data']->value){
 $_smarty_tpl->tpl_vars['_id']->value = $_smarty_tpl->tpl_vars['_data']->key;
?><a href="<?php echo $_smarty_tpl->tpl_vars['_data']->value['url'];?>
"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/sites/<?php if ($_smarty_tpl->tpl_vars['_data']->value['image']){?><?php echo $_smarty_tpl->tpl_vars['_data']->value['image'];?>
<?php }else{ ?>default.png<?php }?>" alt="<?php echo $_smarty_tpl->tpl_vars['_data']->value['details'];?>
" /><br /><?php echo $_smarty_tpl->tpl_vars['_data']->value['name'];?>
</a><?php }} ?></div></div><div class="info arial"></div></div><?php }?>