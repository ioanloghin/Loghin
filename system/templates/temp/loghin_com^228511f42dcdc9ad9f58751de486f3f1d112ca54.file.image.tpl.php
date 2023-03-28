<?php /* Smarty version Smarty-3.1.7, created on 2012-05-26 05:08:00
         compiled from "/home/loghin/public_html/system/templates/center/image.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8331343104fbdfd660b5301-12891355%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '228511f42dcdc9ad9f58751de486f3f1d112ca54' => 
    array (
      0 => '/home/loghin/public_html/system/templates/center/image.tpl',
      1 => 1338025929,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8331343104fbdfd660b5301-12891355',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fbdfd6615be5',
  'variables' => 
  array (
    'vir_pic_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fbdfd6615be5')) {function content_4fbdfd6615be5($_smarty_tpl) {?><div class="image clear" id="album">
	<div class="navigation clear">
		<div class="add-to left">
			<a href="#">+</a>
			<ul>
				<li><a href="#">Add to favorite</a></li>
				<li><a href="#">Save image</a></li>
			</ul>
		</div>
		<ul class="control right clear">
			<li><a class="back button" href="#back"><strong>Back</strong><i></i></a></li>
			<li><a class="prev button" href="#prev"><span>Preview</span></a></li>
			<li class="last"><a class="next button" href="#next"><span>Next</span></a></li>
		</ul>
	</div><!-- #album.image .right .navigation -->
	<div class="cfix"></div>

	<div class="details clear">
		<div class="left">
			<img style="width:583px;height:466px" src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
large_image.png" alt="" />
			<div class="imageInfo clear">
				<p class="left">Designs & Interfaces / Advertising</p>
				<p class="right">©2012 - MyNamenLow</p>
			</div><!-- #album.image.two .imageInfo -->
		</div><!-- #album.image .left -->

		<div class="right clear">
			<dl>
				<dt>Info</dt>
				<dd class="clear">
					<p>The Basic concepts part contains information about the notions that underlie the PhpStorm functionality. Product Usage GuidelinesThe PhpStorm Usage Guidelines part provides descriptions of the actions required to...<a class="more" href="#">Read more</a></p>
				</dd>
			</dl>

			<dl class="second">
				<dt>
					Details
					<span class="details right clear">
						<span class="down right"></span><a class="right" href="javascript:void(0);">Image size view</a>
						<span class="list">
							<a href="#">3750×1000</a>
							<a href="#">3750×1000</a>
						</span>
					</span>
				</dt>
				<dd>
					<dl class="clear">
						<dt>Submitted:</dt>
						<dd>6h 16m ago</dd>

						<dt>Image Size:</dt>
						<dd>4.1 MB</dd>

						<dt>Resolution:</dt>
						<dd>3750×3000</dd>
					</dl>
					<div class="form">
						<div class="formLabel"><label for="image-link">Link</label></div>
						<div class="formField clear">
							<a class="right" href="#">Copy</a>
							<div class="input">
								<input class="inputText" id="image-link" type="text" name="" value="http://www.link.activ/img_name.png" />
							</div>
						</div>

						<div class="formLabel"><label for="image-thumb">Thumbs</label></div>
						<div class="formField clear">
							<a class="right" href="#">Copy</a>
							<div class="input">
								<input class="inputText" id="image-thumb" type="text" name="" value="::thumbs-img-234::" />
							</div>
						</div>
					</div>
				</dd>
			</dl>

			<dl>
				<dt>Statistics</dt>
				<dd>
					<dl class="clear">
						<dt>Comments:</dt>
						<dd>90</dd>

						<dt>Favourites:</dt>
						<dd>1,472 [who?]</dd>

						<dt>Views:</dt>
						<dd>12,279 (12,279 today)</dd>

						<dt>Downloads:</dt>
						<dd>297 (297 today)</dd>
					</dl>
				</dd>
			</dl>

			<dl class="second">
				<dt>Device data</dt>
				<dd>
					<dl class="clear">
						<dt>Make:</dt>
						<dd>Canon</dd>

						<dt>Model:</dt>
						<dd>Canon EOS 60D</dd>

						<dt>Shutter:</dt>
						<dd>Speed:1/395 second</dd>

						<dt>Aperture:</dt>
						<dd>F/5.6</dd>

						<dt>Focal Length:</dt>
						<dd>18 mm</dd>

						<dt>ISO Speed:</dt>
						<dd>100</dd>

						<dt>Date Taken:</dt>
						<dd>Jan 2, 2012, 6:45:22 PM</dd>

						<dt>Lens:</dt>
						<dd>EF-S18-135mm f/3.5-5.6 IS</dd>

						<dt>Sensor Size:</dt>
						<dd>22mm</dd>
					</dl>
				</dd>
			</dl>
		</div><!-- #album.image.two .right -->
	</div>
</div><!-- #album.image.two --><?php }} ?>