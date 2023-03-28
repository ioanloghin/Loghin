<?php /* Smarty version Smarty-3.1.7, created on 2012-05-26 04:52:23
         compiled from "/home/loghin/public_html/system/templates/right/default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:725507824fbdfce66f4b99-58995123%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9c0cc1e3c71ceaabe3ea72c6de5e21b01506d3a' => 
    array (
      0 => '/home/loghin/public_html/system/templates/right/default.tpl',
      1 => 1338025930,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '725507824fbdfce66f4b99-58995123',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fbdfce670be3',
  'variables' => 
  array (
    'showRightInfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fbdfce670be3')) {function content_4fbdfce670be3($_smarty_tpl) {?><div class="block-nav">
	<a class="selected" href="#">Source</a> &nbsp;|&nbsp;
	<a href="#">Structure</a> &nbsp;|&nbsp;
	<a href="#">Information</a>
</div>

<?php if (false===empty($_smarty_tpl->tpl_vars['showRightInfo']->value)){?><dl class="info">
	<dt>Model</dt>
	<dd>
		<div class="clear">
			<span class="left">Name:</span>
			<span class="right">Lorem Ipsum</span>
		</div>
	</dd>

	<dt>Author</dt>
	<dd>
		<div class="clear">
			<span class="left">Name:</span>
			<span class="right">Lorem Ipsum</span>
		</div>
	</dd>

	<dt>Albums</dt>
	<dd>
		<div class="clear">
			<span class="left">Lorem Ipsum:</span>
			<span class="right">02/05/2012</span>
		</div>
		<div class="clear">
			<span class="left">Gallery:</span>
			<span class="right">5.260 Items</span>
		</div>
	</dd>

	<dt>Details</dt>
	<dd>
		<div class="clear">
			<span class="left">Submitted:</span>
			<span class="right">02/05/2012</span>
		</div>
		<div class="clear">
			<span class="left">Image Size:</span>
			<span class="right">4.1 MB</span>
		</div>
		<div class="clear">
			<span class="left">Resolution:</span>
			<span class="right">3750x3000</span>
		</div>
	</dd>

	<dt>Device data</dt>
	<dd>
		<div class="clear">
			<span class="left">Make:</span>
			<span class="right">Canon</span>
		</div>
		<div class="clear">
			<span class="left">Model:</span>
			<span class="right">Canon EOS 60 D</span>
		</div>
	</dd>
</dl><?php }?>

<div class="block-nav">
	<a class="selected" href="#">Preference</a> &nbsp;|&nbsp;
	<a href="#">Statistics</a> &nbsp;|&nbsp;
	<a href="#">In / Out</a>
</div>
<div class="pref">
	<div class="head clear">
		<h3 class="left">Preference</h3>
		<a class="close icon right" href="#">x</a>
	</div>
	<div class="line">
		<p>Seleziona le schede delle notizie da visualizzare:</p>
		<div class="clear">
			<div class="formLabel">
				<label>Visual Time:</label>
			</div>
			<div class="formField">
				<select class="inputCombo" name="">
					<option value="">Days</option>
				</select>
			</div>
		</div>
		<div class="clear">
			<div class="formLabel">
				<label>Total Hits:</label>
			</div>
			<div class="formField">
				<select class="inputCombo" name="">
					<option value="">Number</option>
				</select>
			</div>
		</div>
		<div class="clear">
			<div class="formLabel">
				<label>Visual:</label>
			</div>
			<div class="formField">
				<select class="inputCombo" name="">
					<option value="">Type</option>
				</select>
			</div>
		</div>
	</div>
	<div class="line">
		<p>Processing System:</p>
		<div class="clear">
			<div class="formLabel">
				<label>Modul 1 Activation:</label>
			</div>
			<div class="formField">
				<input class="inputCheckbox" type="checkbox" name="" value="" />
			</div>
		</div>
		<div class="clear">
			<div class="formLabel">
				<label>Modul 2 Activation:</label>
			</div>
			<div class="formField">
				<input class="inputCheckbox" type="checkbox" name="" value="" />
			</div>
		</div>
		<div class="clear">
			<div class="formLabel">
				<label>Arhive:</label>
			</div>
			<div class="formField">
				<select class="inputCombo" name="">
					<option value="">Select</option>
				</select>
			</div>
		</div>
		<div class="clear">
			<div class="formLabel">
				<label>Newsletter:</label>
			</div>
			<div class="formField">
				<input class="inputCheckbox" type="checkbox" name="" value="" />
			</div>
		</div>
		<div class="formButton">
			<a href="#submit">Save<i></i></a>
		</div>
	</div>
</div><?php }} ?>