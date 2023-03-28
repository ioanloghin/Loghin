<?php /* Smarty version Smarty-3.1.7, created on 2023-03-22 12:15:04
         compiled from "/home/loghin/public_html/admin/templates/editdataSuggestion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1246009501641ad9385d5c60-78672913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a73c0eeb7ba4153eefd02cb118380f5a1d94eff8' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/editdataSuggestion.tpl',
      1 => 1679487301,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1246009501641ad9385d5c60-78672913',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_641ad93860c75',
  'variables' => 
  array (
    'hideContent' => 0,
    'heading' => 0,
    'discription' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_641ad93860c75')) {function content_641ad93860c75($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <?php if ($_smarty_tpl->tpl_vars['hideContent']->value!=1){?>
	<form action="" method="post" enctype='multipart/form-data'>
	<table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#row_settigns').toggle();">Add Sugestions</a>
                  	</div>
                    <div class="right">
                    	
                    </div>
              	</div>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="row_settigns">
		<tr>
			<td class="gridLabels" width="300"  nowrap>

            heading 
			</td>
			<td class="gridValue">
		   <input class="inputText" type="text" id="cheading" name="cheading" value="<?php echo $_smarty_tpl->tpl_vars['heading']->value;?>
" style="height:22px">

			</td>
		</tr>
		
		<tr>
			<td class="gridLabels" width="300" nowrap>

            Discription
			</td>
			<td class="gridValue">
		  
		   <input class="inputText" name="discription"   value="<?php echo $_smarty_tpl->tpl_vars['discription']->value;?>
"
		  style="height:70px">
			</td>
		</tr>
	
			<tr>
			<td class="gridLabels" width="300" nowrap>

            Image
			</td>
			<td class="gridValue">
		  <input type="file" name="image" >

			</td>
		</tr>   
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" />
				<input type="hidden" name="issuggest" value="1" />
			</td>
		</tr>
	</table>
	</form>
	<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>