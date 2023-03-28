<?php /* Smarty version Smarty-3.1.7, created on 2019-11-14 08:01:05
         compiled from "/home/loghin/public_html/templates/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210164315558e141371ab9-86950326%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15ef077c4012d693744263993babd35b9bb264a5' => 
    array (
      0 => '/home/loghin/public_html/templates/home.tpl',
      1 => 1470683536,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210164315558e141371ab9-86950326',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5558e14168d21',
  'variables' => 
  array (
    'app_page' => 0,
    'app_title' => 0,
    'loggedin' => 0,
    'session' => 0,
    'sites' => 0,
    'vir_pic_path' => 0,
    'siteData' => 0,
    'site_id' => 0,
    'favorites' => 0,
    'data' => 0,
    'info' => 0,
    'record' => 0,
    'i' => 0,
    'r_account' => 0,
    'r_user' => 0,
    'r_nickname' => 0,
    'r_profile' => 0,
    '_accountId' => 0,
    '_userId' => 0,
    '_nicknameId' => 0,
    '_profileId' => 0,
    '_accountLabel' => 0,
    '_userLabel' => 0,
    '_nicknameLabel' => 0,
    '_profileLabel' => 0,
    'td_account' => 0,
    'td_user' => 0,
    'td_nickname' => 0,
    'td_profile' => 0,
    'ArchTop' => 0,
    'ArchBottom' => 0,
    'vir_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5558e14168d21')) {function content_5558e14168d21($_smarty_tpl) {?><?php if (!is_callable('smarty_function_stylesheets')) include '/home/loghin/sources/!core/plugins/function.stylesheets.php';
if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
if (!is_callable('smarty_function_scripts')) include '/home/loghin/sources/!core/plugins/function.scripts.php';
?><!DOCTYPE HTML><html><head><meta charset="utf-8"><title><?php if (!empty($_smarty_tpl->tpl_vars['app_page']->value)){?><?php echo $_smarty_tpl->tpl_vars['app_page']->value;?>
 - <?php }?><?php echo $_smarty_tpl->tpl_vars['app_title']->value;?>
</title><?php echo smarty_function_stylesheets(array(),$_smarty_tpl);?>

		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    </head>
    
    <body>
		
    	<div id="header">
        	<div class="width clear">
            	<div class="left">
                	<a href="#"><?php if ($_smarty_tpl->tpl_vars['loggedin']->value){?><?php echo $_smarty_tpl->tpl_vars['session']->value['username'];?>
<?php }else{ ?>Login In<?php }?></a> |&nbsp;
		            
				</div>

		        
		        <a class="_button_" href="javascript:void(0);">System Window<i></i></a>
		        <?php echo $_smarty_tpl->getSubTemplate ("plugins/system.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		        

				<div class="right">
					<select class="inputCombo" name="country">
						<option value="">Country</option>
					</select>
					&nbsp;|&nbsp;
					<select class="inputCombo" name="language">
						<option value="">Language</option>
					</select>
				</div>
                <div class="middle clear"><a id="customize" href="javascript:void(0);" title="<?php echo smarty_modifier_lang('customize_page');?>
"><strong><?php echo smarty_modifier_lang('customize_page');?>
</strong></a><div id="custBlock" class="hide"><div class="cnt clear"><div class="left"><h2>Sites &nbsp;<sup><span>0</span> / 6</sup></h2><div class="custItems"><ul class="clear-li"><?php if (!empty($_smarty_tpl->tpl_vars['sites']->value['site'])){?><?php  $_smarty_tpl->tpl_vars['siteData'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['siteData']->_loop = false;
 $_smarty_tpl->tpl_vars['site_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sites']->value['site']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['siteData']->key => $_smarty_tpl->tpl_vars['siteData']->value){
$_smarty_tpl->tpl_vars['siteData']->_loop = true;
 $_smarty_tpl->tpl_vars['site_id']->value = $_smarty_tpl->tpl_vars['siteData']->key;
?><li><div class="left"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/layouts/<?php if ($_smarty_tpl->tpl_vars['siteData']->value['image']){?><?php echo $_smarty_tpl->tpl_vars['siteData']->value['image'];?>
<?php }else{ ?>default.png<?php }?>" alt="" /></div><div class="right clear"><h3><?php echo $_smarty_tpl->tpl_vars['siteData']->value['name'];?>
</h3><input class="inputCheckbox" type="checkbox" name="items[]" value="<?php echo $_smarty_tpl->tpl_vars['site_id']->value;?>
"<?php if (array_key_exists($_smarty_tpl->tpl_vars['site_id']->value,$_smarty_tpl->tpl_vars['favorites']->value['site'])){?> checked="checked"<?php }?> /><div class="cfix"></div><p class="arial"><?php echo $_smarty_tpl->tpl_vars['siteData']->value['details'];?>
</p></div></li><?php } ?><?php }?></ul></div></div><div class="right"><h2>Applications &nbsp;<sup><span>0</span> / 6</sup></h2><div class="custItems"><ul class="clear-li"><?php if (!empty($_smarty_tpl->tpl_vars['sites']->value['application'])){?><?php  $_smarty_tpl->tpl_vars['siteData'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['siteData']->_loop = false;
 $_smarty_tpl->tpl_vars['site_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sites']->value['application']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['siteData']->key => $_smarty_tpl->tpl_vars['siteData']->value){
$_smarty_tpl->tpl_vars['siteData']->_loop = true;
 $_smarty_tpl->tpl_vars['site_id']->value = $_smarty_tpl->tpl_vars['siteData']->key;
?><li><div class="left"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/layouts/<?php if ($_smarty_tpl->tpl_vars['siteData']->value['image']){?><?php echo $_smarty_tpl->tpl_vars['siteData']->value['image'];?>
<?php }else{ ?>default.png<?php }?>" alt="" /></div><div class="right clear"><h3><?php echo $_smarty_tpl->tpl_vars['siteData']->value['name'];?>
</h3><input class="inputCheckbox" type="checkbox" name="items[]" value="<?php echo $_smarty_tpl->tpl_vars['site_id']->value;?>
"<?php if (array_key_exists($_smarty_tpl->tpl_vars['site_id']->value,$_smarty_tpl->tpl_vars['favorites']->value['application'])){?> checked="checked"<?php }?> /><div class="cfix"></div><p class="arial"><?php echo $_smarty_tpl->tpl_vars['siteData']->value['details'];?>
</p></div></li><?php } ?><?php }?></ul></div></div></div><div class="info clear"><div>Layout: <span> 1</span></div><input class="inputText left" type="text" name="name" value="" /><a class="_button gray right" href="javascript:void(0);"><strong><?php echo smarty_modifier_lang('save');?>
</strong><i></i></a></div><input type="hidden" name="id" value="0" /></div><a class="arrow right" href="javascript:void(0);">&darr;</a><div id="layouts" class="hide"><div class="buttons clear"><a id="delete-layout" class="button red right hide" href="javascript:void(0);" onclick="return confirm('Are you sure you want to delete these layouts?');"><span>Delete</span></a><a id="edit-layout" class="button green right hide" href="javascript:void(0);"><span>Modify</span></a><a id="new-layout" class="button blue right" href="javascript:void(0);"><span>New Layout</span></a></div></div></div>
				
           </div>
        </div>
		

		
		<div class="nav100 clear">
			<div class="gradient">
				<div class="center">
                	<div class="right">
                        <ul class="rightNav">
                            <li><a href="http://register.loghin.com/teenagers/"><strong>Teenagers</strong></a></li>
                            <li><a href="http://register.loghin.com/adults/"><strong>Adults</strong></a></li>
                            <li><a href="http://register.loghin.com/business/"><strong>Business</strong></a></li>
                            <li><a href="http://register.loghin.com/institutions/"><strong>Institutions</strong></a></li>
                        </ul>
                    </div>
					<!-- changer -->
					<ul class="changer profile-switch">
						<li class="left"><span class="icon">&nbsp;</span></li>
						<li class="right"><span class="icon">&nbsp;</span></li>
						<div id="profile-switch">
							<div class="connector left"></div>
							<div class="cfix"></div>
							<div class="block">
								<div class="gray-block bg">
									<a href="#">Personal</a>
									<a class="blue" href="#">Group</a>
									<a class="black" href="#">Business</a>
									<a href="#">Private</a>
								</div>
								<div class="image">
									<img src="http://files.loghin.com/quick-view-image.png" alt="" />
								</div>
								<ul class="items toggle">
									<li class="opened">
										<a href="#">Gestiune Profil</a>
										<ul>
											<li><a href="#">Meniu 1</a></li>
											<li><a href="#">Meniu 2</a></li>
											<li><a href="#">Meniu 3</a></li>
										</ul>
										<span class="icon target"> </span>
									</li>
									<li>
										<a href="#">Gestiune Aplicatii</a>
										<ul>
											<li><a href="#">Meniu 1</a></li>
											<li><a href="#">Meniu 2</a></li>
											<li><a href="#">Meniu 3</a></li>
										</ul>
										<span class="icon target"> </span>
									</li>
								</ul>
								<div class="bottom">
									<a class="fancy bg" href="#">Quick Profile View</a>
								</div>
							</div>
						</div>
					</ul>

					<!-- drop_down -->
					<div class="user-bar-menu clear left">
						<a class="left" href="javascript:void(0);"><span class="online icon"></span></a>
						<div class="right"><a href="#refresh">Refresh</a></div>
						<ul class="clear">
							<li class="down">
								<a href="#"><?php echo $_smarty_tpl->tpl_vars['data']->value['currentAccount'];?>
</a>
                                <ul>
								<?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['accountsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value){
$_smarty_tpl->tpl_vars['info']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['info']->key;
?>
                                    <li>
                                        <a href=""><?php echo $_smarty_tpl->tpl_vars['info']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['info']->value['lastname'];?>
&nbsp;</a>
                                    </li>
                                <?php } ?>
                                </ul>
							</li>
							<li><a href="#"><?php echo $_smarty_tpl->tpl_vars['data']->value['currentUser'];?>
&nbsp;</a></li>
							<li class="down">
								<a href="#"><?php echo $_smarty_tpl->tpl_vars['data']->value['currentNickname'];?>
&nbsp;</a>
								<ul>
                                	<?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['nicknamesList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value){
$_smarty_tpl->tpl_vars['info']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['info']->key;
?>
									<li><a href="#"><?php echo $_smarty_tpl->tpl_vars['info']->value['nickname'];?>
&nbsp;</a></li>
									<?php } ?>
								</ul>
							</li>
							<li><a href="#">Profil</a></li>
						</ul>

						<div class="options">
							<div class="overflow">
                            	<?php  $_smarty_tpl->tpl_vars['record'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['record']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['records']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['record']->key => $_smarty_tpl->tpl_vars['record']->value){
$_smarty_tpl->tpl_vars['record']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['record']->key;
?>
								<div class="row clear">
									<div class="left"><a href="javascript:void(0);">+</a></div>
                                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['record']->value->maxRows()+1 - (0) : 0-($_smarty_tpl->tpl_vars['record']->value->maxRows())+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                                        <?php $_smarty_tpl->tpl_vars['r_account'] = new Smarty_variable($_smarty_tpl->tpl_vars['record']->value->getAccount($_smarty_tpl->tpl_vars['i']->value), null, 0);?>
                                        <?php $_smarty_tpl->tpl_vars['r_user'] = new Smarty_variable($_smarty_tpl->tpl_vars['record']->value->getUser($_smarty_tpl->tpl_vars['i']->value), null, 0);?>
                                        <?php $_smarty_tpl->tpl_vars['r_nickname'] = new Smarty_variable($_smarty_tpl->tpl_vars['record']->value->getNickname($_smarty_tpl->tpl_vars['i']->value), null, 0);?>
                                        <?php $_smarty_tpl->tpl_vars['r_profile'] = new Smarty_variable($_smarty_tpl->tpl_vars['record']->value->getProfile($_smarty_tpl->tpl_vars['i']->value), null, 0);?>
                                        
                                        
                                        <?php if ($_smarty_tpl->tpl_vars['r_account']->value[0]){?>
                                        	<?php $_smarty_tpl->tpl_vars['_accountId'] = new Smarty_variable($_smarty_tpl->tpl_vars['r_account']->value[0], null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars['_accountLabel'] = new Smarty_variable($_smarty_tpl->tpl_vars['r_account']->value[1], null, 0);?>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['r_user']->value[0]){?>
                                            <?php $_smarty_tpl->tpl_vars['_userId'] = new Smarty_variable($_smarty_tpl->tpl_vars['r_user']->value[0], null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars['_userLabel'] = new Smarty_variable($_smarty_tpl->tpl_vars['r_user']->value[1], null, 0);?>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['r_nickname']->value[0]){?>
                                            <?php $_smarty_tpl->tpl_vars['_nicknameId'] = new Smarty_variable($_smarty_tpl->tpl_vars['r_nickname']->value[0], null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars['_nicknameLabel'] = new Smarty_variable($_smarty_tpl->tpl_vars['r_nickname']->value[1], null, 0);?>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['r_profile']->value[0]){?>
                                            <?php $_smarty_tpl->tpl_vars['_profileId'] = new Smarty_variable($_smarty_tpl->tpl_vars['r_profile']->value[0], null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars['_profileLabel'] = new Smarty_variable($_smarty_tpl->tpl_vars['r_profile']->value[1], null, 0);?>
                                        <?php }?>
                                        
                                        <?php if ($_smarty_tpl->tpl_vars['r_account']->value[0]>0){?>
                                            <?php $_smarty_tpl->tpl_vars['td_account'] = new Smarty_variable("<a href='main/change/".($_smarty_tpl->tpl_vars['_accountId']->value)."/".($_smarty_tpl->tpl_vars['_userId']->value)."/".($_smarty_tpl->tpl_vars['_nicknameId']->value)."/".($_smarty_tpl->tpl_vars['_profileId']->value)."/".($_smarty_tpl->tpl_vars['record']->value->getType())."' title='".($_smarty_tpl->tpl_vars['_accountLabel']->value)."'>".($_smarty_tpl->tpl_vars['_accountLabel']->value)."</a>", null, 0);?>
                                        <?php }else{ ?>
                                            <?php $_smarty_tpl->tpl_vars['td_account'] = new Smarty_variable('<span>&nbsp;</span>', null, 0);?>
                                        <?php }?>
                                        
                                        <?php if ($_smarty_tpl->tpl_vars['r_user']->value[0]>0){?>
                                            <?php $_smarty_tpl->tpl_vars['td_user'] = new Smarty_variable("<a href='main/change/".($_smarty_tpl->tpl_vars['_accountId']->value)."/".($_smarty_tpl->tpl_vars['_userId']->value)."/".($_smarty_tpl->tpl_vars['_nicknameId']->value)."/".($_smarty_tpl->tpl_vars['_profileId']->value)."/".($_smarty_tpl->tpl_vars['record']->value->getType())."' title='".($_smarty_tpl->tpl_vars['_userLabel']->value)."'>".($_smarty_tpl->tpl_vars['_userLabel']->value)."</a>", null, 0);?>
                                        <?php }else{ ?>
                                            <?php $_smarty_tpl->tpl_vars['td_user'] = new Smarty_variable('<span>&nbsp;</span>', null, 0);?>
                                        <?php }?>
                                        
                                        <?php if ($_smarty_tpl->tpl_vars['r_nickname']->value[0]>0){?>
                                            <?php $_smarty_tpl->tpl_vars['td_nickname'] = new Smarty_variable("<a href='main/change/".($_smarty_tpl->tpl_vars['_accountId']->value)."/".($_smarty_tpl->tpl_vars['_userId']->value)."/".($_smarty_tpl->tpl_vars['_nicknameId']->value)."/".($_smarty_tpl->tpl_vars['_profileId']->value)."/".($_smarty_tpl->tpl_vars['record']->value->getType())."' title='".($_smarty_tpl->tpl_vars['_userLabel']->value)."'>".($_smarty_tpl->tpl_vars['_nicknameLabel']->value)."</a>", null, 0);?>
                                        <?php }else{ ?>
                                            <?php $_smarty_tpl->tpl_vars['td_nickname'] = new Smarty_variable('<span>&nbsp;</span>', null, 0);?>
                                        <?php }?>
                                        
                                        <?php if ($_smarty_tpl->tpl_vars['r_profile']->value[0]>0){?>
                                            <?php $_smarty_tpl->tpl_vars['td_profile'] = new Smarty_variable("<a href='main/change/".($_smarty_tpl->tpl_vars['_accountId']->value)."/".($_smarty_tpl->tpl_vars['_userId']->value)."/".($_smarty_tpl->tpl_vars['_nicknameId']->value)."/".($_smarty_tpl->tpl_vars['_profileId']->value)."/".($_smarty_tpl->tpl_vars['record']->value->getType())."' title='".($_smarty_tpl->tpl_vars['_userLabel']->value)."'>".($_smarty_tpl->tpl_vars['_profileLabel']->value)."</a>", null, 0);?>
                                        <?php }else{ ?>
                                            <?php $_smarty_tpl->tpl_vars['td_profile'] = new Smarty_variable('<span>&nbsp;</span>', null, 0);?>
                                        <?php }?>
                                        
                                        <ul class="clear">
                                            <li><?php echo $_smarty_tpl->tpl_vars['td_account']->value;?>
</li>
                                            <li><?php echo $_smarty_tpl->tpl_vars['td_user']->value;?>
</li>
                                            <li><?php echo $_smarty_tpl->tpl_vars['td_nickname']->value;?>
</li>
                                            <li><?php echo $_smarty_tpl->tpl_vars['td_profile']->value;?>
</li>
                                        </ul>
                                    <?php }} ?>
								</div>
                                <?php } ?>
							</div>
							<div class="bottom bg clear">
								<div class="left"><span class="icon">&nbsp;</span></div>
								<div class="right refresh"><a class="icon reload" href="#">&nbsp;</a></div>
								<ul class="btn">
									<li><a href="#">Button 1</a></li>
									<li><a href="#">Button 2</a></li>
									<li><a href="#">Button 3</a></li>
									<li><a href="#">Button 4</a></li>
								</ul>
							</div>
						</div>
                        <script>
						/* User Accounts */
						var userBarMenuTh = ['Account','User','Nick Name','Profile'];
						var userBarMenuTh_active = ['currentAccount','currentUser','currentNickname','currentProfile'];
						
						// Action
						$('.user-bar-menu > a.left').on('click', function() {
							var $userbar = $(this).parent();
							var $this    = $userbar.find('.options');
					
							if ($this.is(':visible')) {
								return false;
							}
					
							$this.slideDown(function() {
								/* Check if scroll has been setted */
								if ($this.find('.scrollWrap').length <= 0) {
									/* Set scroll */
									$('.user-bar-menu .options .overflow').customScroll({ width: '12px', distance: '4px', paddingRight: '21px' });
									$userbar.find('.th > li').each(function(index, element) {
										$(element).children('.label').html(userBarMenuTh[index]);
									});
								}
					
								/* Set event for close block */
								$('body').on('click.options', function(e) {
									if ($(e.target).closest($this).length <= 0) {
										$this.slideUp(function () {
											// Put current user
											$userbar.find('.th > li').each(function(index, element) {
												$(element).children('.label').html(userBarMenuTh_active[index]);
											});
										});
										$('body').off('click.options');
									}
								});
							});
						});
						</script>
					</div>
					<!-- options -->
					<ul class="buttons">
						<li><a><span class="icon home left">&nbsp;</span><span class="rline">&nbsp;</span><span class="icon down">&nbsp;</span></a></li>
						<li><a><span class="icon home">&nbsp;</span></a></li>
						<li><a><span class="icon print">&nbsp;</span></a></li>
						<li><a><span class="icon star">&nbsp;</span></a></li>
					</ul>
					<!-- search box -->
					<!--<form method="get" class="search_box clear" action="">
						<fieldset class="gradient">
							<button class="icon" type="submit">&nbsp;</button>
							<input id="struct_search" class="field" type="search" autocomplete="off" placeholder="Cod Ateco sau Denumirea" />
						</fieldset>
						<div id="AGH_searchRecom"><div id="AGH_searchRecom_fix"></div></div>
					</form>-->
				</div>
			</div>
		</div>
		

		
		<div class="eyes" id="body">
			<div class="width clear">
				<ul class="left sites clear-li">
					
				</ul>
				<ul class="right applications clear-li">
					
				</ul>
				<div class="info"><a href="#"><span>all</span><br />System</a></div>
				<div class="logo">
					<?php echo $_smarty_tpl->tpl_vars['ArchTop']->value->getStyle();?>

					<?php echo $_smarty_tpl->tpl_vars['ArchBottom']->value->getStyle();?>

					<?php echo $_smarty_tpl->tpl_vars['ArchTop']->value->getLetters();?>

					<?php echo $_smarty_tpl->tpl_vars['ArchBottom']->value->getLetters();?>

				</div>
				<span class="extension">.com</span>
				<div class="else"><a href="http://loghout.com/"><span>VS</span><br />Loghout</a></div>
			</div>
		</div>
		

		
		<div id="content">
			
			<a class="scrollArrow top" href="javascript:void(0);"></a>
			
			<div class="width">
				
				<div class="searchBox">
				<form action="" method="post">
					<div class="searchInput left">
						<div class="_left"></div>
						<input class="inputText" type="text" name="search" value="" />
						<div class="_right"></div>
					</div>
					<a class="inputSearch left" href="javascript:void(0);" rel="submit"><strong>Search<i></i></strong></a>
					<div class="cfix"></div>
				</form>
				</div>
				

				
				<ul class="resultsCats width clear"></ul>
				<div class="width hide" id="results">
					<div class="_left"><a href="javascript:void(0);" rel="-">&laquo;</a></div>
					<div class="content width">
						<div class="space">
							<div class="clear">
								<ul class="clear">
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 1</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 2</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 3</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 4</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 5</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 6</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 7</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 8</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 9</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="_right"><a href="javascript:void(0);" rel="+">&raquo;</a></div>
				</div>
				

				
				<div id="suggest" class="hide">
					<div class="head clear">
						<div class="_left"><a href="javascript:void(0);" rel="-">&laquo;</a></div>
						<div class="nav">
							<div>
								<div>
									<ul>
										<li class="first"><a href="#">Arhitectura</a></li>
										<li><a href="#">Constructii</a></li>
										<li><a href="#">Industrie</a></li>
										<li class="last"><a href="#">Navala</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="_right"><a href="javascript:void(0);" rel="+">&raquo;</a></div>
					</div>
					<div class="body">
						<div class="bodySilver"></div>
						<div class="cnt clear">
							
							<div class="left">
								<ul class="top clear">
									<li>
										<label><input type="checkbox" name="" value="" /></label>
										<a class="button green left" href="javascript:void(0);"><span>Add</span></a>
										<p>
											<a href="#">data</a> |
											<a href="#">type</a>|
											<a href="#">title</a>
										</p>
										<h3>Sugestions</h3>
									</li>
								</ul>
								
								<div class="clear itemsOverflow">
									<div class="overflow">
										<ul>
											<li class="clear">
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
										</ul>
									</div>
								</div>
								
								<div class="bottomSpace"></div>
							</div>
							

							
							<div class="right">
								<div class="overlay"></div>
								<div class="optionsB">
									<div class="headB line clear">
										<label class="left">Setting:</label>
										<a class="button red right bold" href="javascript:void(0);"><span>X</span></a>
										<h3>Preferences</h3>
									</div>
									<div class="formFields line">
										<p>Seleziona le schede delle notizie da visualizzare:</p>
										<div class="clear">
											<div class="formLabel">
												<label for="visualTime">Visual Time:</label>
											</div>
											<div class="formField">
												<select class="inputCombo" id="visualTime" name="">
													<option value="">Days</option>
												</select>
											</div>
										</div>

										<div class="clear">
											<div class="formLabel">
												<label for="totalHits">Total Hits:</label>
											</div>
											<div class="formField">
												<select class="inputCombo" id="totalHits" name="">
													<option value="">Number</option>
												</select>
											</div>
										</div>

										<div class="clear">
											<div class="formLabel">
												<label for="visual">Visual:</label>
											</div>
											<div class="formField">
												<select class="inputCombo" id="visual" name="">
													<option value="">Type:</option>
												</select>
											</div>
										</div>
									</div>

									<div class="formFields line">
										<p>Processing System:</p>
										<div class="clear">
											<div class="formLabel">
												<label for="modul1Activation">Modul 1 Activation</label>
											</div>
											<div class="formField">
												<input class="inputCheckbox" id="modul1Activation" type="checkbox" name="" value="1" />
											</div>
										</div>

										<div class="clear">
											<div class="formLabel">
												<label for="modul2Activation">Modul 2 Activation</label>
											</div>
											<div class="formField">
												<input class="inputCheckbox" id="modul2Activation" type="checkbox" name="" value="1" />
											</div>
										</div>

										<div class="clear">
											<div class="formLabel">
												<label for="archive">Arhive:</label>
											</div>
											<div class="formField">
												<select class="inputCombo" id="archive" name="">
													<option value="">Select</option>
												</select>
											</div>
										</div>

										<div class="clear">
											<div class="formLabel">
												<label for="newsletter">Newsletter</label>
											</div>
											<div class="formField">
												<input class="inputCheckbox" id="newsletter" type="checkbox" name="" value="1" />
											</div>
										</div>
									</div>

									<div class="formFields line">
										<p>Form options:</p>
										<div class="clear">
											<div class="formOptions">
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
											</div>
										</div>
									</div>

									<div class="formFields">
										<div class="clear">
											<div class="formButton"><a class="button green bold" href="javascript:void(0);" rel="submit"><span>Save</span></a></div>
										</div>
									</div>
								</div>

								<ul class="top clear">
									<li>
										<label><input type="checkbox" name="" value="" /></label>
										<a class="button red left" href="javascript:void(0);"><span>Delete</span></a>
										<p>
											<a href="#">data</a> |
											<a href="#">type</a>|
											<a href="#">title</a>
										</p>
										<h3>Preferences</h3>
									</li>
								</ul>
								
								<div class="clear itemsOverflow">
									<div class="overflow">
										<ul>
											<li class="clear">
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
										</ul>
									</div>
								</div>
								
								<div class="bottomSpace"></div>
							</div>
							
							<div class="bottomOptions clear left">
								<a class="options" href="#">Select suggestion option</a>
								<a class="more" href="#">more...</a>
							</div>
							<div class="bottomOptions clear right">
								<a class="options" href="#">Select suggestion option</a>
								<a class="more" href="#">more...</a>
							</div>
							<div class="line"><div></div></div>
						</div>
					</div>

					
					<div class="footer clear">
						<p>
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a>
						</p>
						<a href="javascript:void(0);" rel="OpenClose">Close</a>
					</div>
					
				</div>
				
			</div>
		</div>
		

		
		<div id="footer">
			<div class="width">
				<p class="left">
					<a href="#">Marketing / Advertise</a> &bull;
					<a href="#">Terms of service</a> &bull;
					<a href="#">Privacy</a> &bull;
					<a href="#">You opinion</a> &bull;
					<a href="#">Work with us</a>
				</p>
        		<p class="right">Copyright &copy; 2009 - 2011 Loghin. All rights reserved.</div> 
			</div>
		</div>
		

		<?php echo smarty_function_scripts(array(),$_smarty_tpl);?>

		<script type="text/javascript">
			$.conf = { 'path': "<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
", 'pic_path': "<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/" };
		</script>
		<script>
		// compact/extends accounts
		function userBar_compactAll(ref) {
			if(ref == null) {
				var rows = $('.options > .overflow > .row');
				rows.each(function(index, element) {
					$(element).children('ul').each(function(index, element) {
						if(index > 0) {
							$(element).hide();
						}
					}); 
				}); 
				
			}
			else {
				ref.children('.left').children('a').html('+');
				
				ref.children('ul').each(function(index, element) {
					if(index > 0) {
						$(element).hide();
					}
				}); 
			}
		}
		userBar_compactAll(null);
		$('.options > .overflow > .row > .left').on('click', 'a', function(){
			var compacted = ($(this).html() == '+');
		
			// reset all
			userBar_compactAll($(this).parent().parent());
			
			if(compacted)
			{
				$(this).html('-');
				$(this).parent().parent().find('ul').show();
				$(this).parent().parent().css('border-bottom-width', '1px');
			}
		});
		</script>
    </body>
</html><?php }} ?>