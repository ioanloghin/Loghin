<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Loghin users bar</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/common.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/user_bar.css');?>" />
	<script type="text/javascript" src="http://structures.loghin.com/views/templates/harmony/js/jquery_ui/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/mouseWheel.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/scroll.js');?>"></script>
    <script type="text/javascript" src="http://structures.loghin.com/views/templates/harmony/js/fancybox/fancybox.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/misc.js');?>"></script>
    <script type="text/javascript">$.conf = { 'path': "http://structures.loghin.com/bara_useri/" };</script>
    <style>
    .boxs{background:#EEE;text-align:center;color:#999;font-size:3em;font-style:italic;z-index:-1;position:relative;}
    </style>
</head>
<body>

<header>
	<div class="top-bar">
    	<div class="wide">
            <div class="AGH_menu">
            	<div class="left">
					<?php
                    echo 'Welcome,  ';
                    if($logged)
                        echo '<strong>'.$firstname.' '.$lastname.'</strong>';
                    else
                        echo 'Guest | <a href="#">&Icirc;nregistrare</a>';
                    
                    echo ' | <a href="#">Limba rom&acirc;n&#259;</a>';
                    
                    if($logged) {
                        echo ' | <a href="'.base_url('login/out').'">Log out</a>';
                    }
                    ?>
                </div>
                <div class="right">
				<?php
					if(!$logged) {
						?>
						<form method="post" action="<?php echo base_url('login/in');?>" class="top_login">
							<fieldset>
								<?php
								if(isset($POST) && $POST->errors())
								{
									echo '<div class="errors">';
									foreach($POST->errors() as $error)
										echo $error.'<br />';
									echo '</div>';
								}
								?>
								<input type="hidden" name="antirefresh" value="<?php echo isset($POST) ? $POST->antirefresh('return') : 1;?>" />
								<input type="text" class="input3" name="usr" value="<?php echo isset($POST) ? $POST->get_var('usr', 'post|db', TRUE) : NULL;?>" placeholder="Username" />
								<input type="password" class="input3" name="psw" placeholder="Password" />
								<input type="submit" class="button3" name="auth" value="Sign In" />
							</fieldset>
                            <?php if($auth_err):?>
                            <div class="errors"><?php echo $auth_err;?></div>
                            <?php endif; ?>
						</form>
						<?php
					}
					?>
                </div>
            </div>
        </div>
    </div>
</header>
<img src="<?php echo base_url('assets/img/harmony/header.PNG')?>" width="100%" />


<div class="nav100 clear">
	<div class="gradient">
    	<div class="center">
        	<!-- changer -->
        	<div class="changer profile-switch">
                <a href="<?php echo base_url($url_prev_profile);?>" class="btn left"><span class="icon">&nbsp;</span></a>
                <a href="<?php echo base_url($url_next_profile);?>" class="btn right"><span class="icon">&nbsp;</span></a>
                <div id="profile-switch">
                    <div class="connector left"></div>
                    <div class="cfix"></div>
                    <div class="block">
                        <div class="gray-block bg">
                        	<?php if(!isset($currentMe['entity'])) $currentMe['entity']=NULL; ?><a class="<?php echo $currentMe['entity']=='personal'?'black':'blue';?>" href="<?php echo base_url('main/changeentity/personal');?>">Personal</a><a class="<?php echo $currentMe['entity']=='group'?'black':'blue';?>" href="<?php echo base_url('main/changeentity/group');?>">Group</a><a class="<?php echo $currentMe['entity']=='business'?'black':'blue';?>" href="<?php echo base_url('main/changeentity/business');?>">Business</a><a class="<?php echo $currentMe['entity']=='private'?'black':'blue';?>" href="<?php echo base_url('main/changeentity/private');?>">Private</a>
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
                            <a class="fancy bg" href="<?php //echo base_url('models/quick-block.html');?>">Quick Profile View</a>
                        </div>
                    </div>
                </div>
            </div>
            
        	<!-- drop_down -->
            <div class="user-bar-menu clear left">
                <a class="left" href="javascript:void(0);"><span class="<?php echo $chatStatus ? $chatStatus : 'inactive';?> icon"></span></a>
                <div class="right"><a href="#refresh">Refresh</a></div>
                <ul class="th clear">
                    <li class="account down">
                        <a class="label" href="#"><?php echo $currentAccount;?></a>
                        <ul>
                        <?php
						foreach($accountsList as $info) {
							$url = 'main/change_oac/'.$info['account_id'].'/1/'.$root_id;
							$name = $info['firstname'].' '.$info['lastname'];
							if(!trim($name)) {
								$name = '&nbsp;';
							}
							echo '<li class="'.(($currentAccountId==$info['account_id'])?'selected':'').'"><a href="'.base_url($url).'">'.$name.'</a></li>';
						}
						?>
                        </ul>
                    </li>
                    <li class="user">
                    	<a class="label" href="#"><?php echo ($currentUser)?$currentUser:' ';?></a>
                    </li>
                    <li class="nickname down">
                        <a class="label" href="#"><?php echo ($currentNickname)?$currentNickname:' ';?></a>
                        <ul>
                        <?php
						foreach($nicknamesList as $info) {
							$url = 'main/change_oni/'.$info['nickname_id'].'/'.$root_id;
							$name = $info['nickname'];
							if(!trim($name)) {
								$name = '&nbsp;';
							}
							echo '<li class="'.(($currentNicknameId==$info['nickname_id'])?'selected':'').'"><a href="'.base_url($url).'">'.$name.'</a></li>';
						}
						?>
                        </ul>
                    </li>
                    <li class="profil">
                    	<a class="label" href="#"><?php echo ($currentProfile)?$currentProfile:' ';?></a>
                    </li>
                </ul>
				<?php
				// Background colors
				function TODOsetBgColor($type) {
					switch($type) {
						case UserBarRecord::ADULT: return "rgb(255,198,198);
background: -moz-linear-gradient(top,  rgba(255,198,198,1) 0%, rgba(255,255,255,1) 20%, rgba(255,255,255,1) 80%, rgba(255,198,198,1) 100%);
background: -webkit-linear-gradient(top,  rgba(255,198,198,1) 0%,rgba(255,255,255,1) 20%,rgba(255,255,255,1) 80%,rgba(255,198,198,1) 100%);
background: linear-gradient(to bottom,  rgba(255,198,198,1) 0%,rgba(255,255,255,1) 20%,rgba(255,255,255,1) 80%,rgba(255,198,198,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffc6c6', endColorstr='#ffc6c6',GradientType=0 );";	
						case UserBarRecord::TEENAGER: return "rgb(247,255,135);
background: -moz-linear-gradient(top,  rgba(247,255,135,1) 0%, rgba(255,255,255,1) 20%, rgba(255,255,255,1) 80%, rgba(247,255,135,1) 100%);
background: -webkit-linear-gradient(top,  rgba(247,255,135,1) 0%,rgba(255,255,255,1) 20%,rgba(255,255,255,1) 80%,rgba(247,255,135,1) 100%);
background: linear-gradient(to bottom,  rgba(247,255,135,1) 0%,rgba(255,255,255,1) 20%,rgba(255,255,255,1) 80%,rgba(247,255,135,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f7ff87', endColorstr='#f7ff87',GradientType=0 );";	
						case UserBarRecord::INSTITUTION: return "rgb(191,235,255);
background: -moz-linear-gradient(top,  rgba(191,235,255,1) 0%, rgba(255,255,255,1) 20%, rgba(255,255,255,1) 80%, rgba(191,235,255,1) 100%);
background: -webkit-linear-gradient(top,  rgba(191,235,255,1) 0%,rgba(255,255,255,1) 20%,rgba(255,255,255,1) 80%,rgba(191,235,255,1) 100%);
background: linear-gradient(to bottom,  rgba(191,235,255,1) 0%,rgba(255,255,255,1) 20%,rgba(255,255,255,1) 80%,rgba(191,235,255,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bfebff', endColorstr='#bfebff',GradientType=0 );
";
						case UserBarRecord::BUSINESS: return "rgb(210,191,255);
background: -moz-linear-gradient(top,  rgba(210,191,255,1) 0%, rgba(255,255,255,1) 20%, rgba(255,255,255,1) 80%, rgba(210,191,255,1) 100%);
background: -webkit-linear-gradient(top,  rgba(210,191,255,1) 0%,rgba(255,255,255,1) 20%,rgba(255,255,255,1) 80%,rgba(210,191,255,1) 100%);
background: linear-gradient(to bottom,  rgba(210,191,255,1) 0%,rgba(255,255,255,1) 20%,rgba(255,255,255,1) 80%,rgba(210,191,255,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d2bfff', endColorstr='#d2bfff',GradientType=0 );";
						
						default: return '#FFF';
					}
				}
				?>
                <div class="options">
                    <div class="overflow">
                    	<?php foreach($records as $record):?>
                        <div class="row clear" style="background:<?php echo TODOsetBgColor($record->getType());?>">
                            <div class="left"><a href="javascript:void(0);">+</a></div>
                            <?php
							$_accountId=0;
							$_accountLabel='-';
							$_userId=0;
							$_userLabel='-';
							$_nicknameId=0;
							$_nicknameLabel='-';
							$_profileId=0;
							$_profileLabel='-';
							for($i=0; $i<$record->maxRows(); ++$i) {
								$r_account 	= $record->getAccount($i);
								$r_user 	= $record->getUser($i);
								$r_nickname = $record->getNickname($i);
								$r_profile 	= $record->getProfile($i);
								
								// Preserve parent
								if($r_account[0]) {
									$_accountId=$r_account[0];
									$_accountLabel=$r_account[1];
								}
								if($r_user[0]) {
									$_userId=$r_user[0];
									$_userLabel=$r_user[1];
								}
								if($r_nickname[0]) {
									$_nicknameId=$r_nickname[0];
									$_nicknameLabel=$r_nickname[1];
								}
								if($r_profile[0]) {
									$_profileId=$r_profile[0];
									$_profileLabel=$r_profile[1];
								}
								
								
								if($r_account[0]) {
									$url = 'main/change/'.$_accountId.'/'.$_userId.'/'.$_nicknameId.'/'.$_profileId.'/'.$record->getType().'';
									$td_account = '<a href="'.base_url($url).'" title="'.$_accountLabel.'">'.$_accountLabel.'</a>';
								}
								else {
									$td_account = '<span>&nbsp;</span>';
								}
								
								if($r_user[0]) {
									$url = 'main/change/'.$_accountId.'/'.$_userId.'/'.$_nicknameId.'/'.$_profileId.'/'.$record->getType().'';
									$td_user = '<a href="'.base_url($url).'" title="'.$_userLabel.'">'.$_userLabel.'</a>';
								}
								else {
									$td_user = '<span>&nbsp;</span>';
								}
								
								if($r_nickname[0]) {
									if($_accountId == $currentAccountId && $record->getType()==$currentType) {
										$url = 'main/change/'.$_accountId.'/'.$_userId.'/'.$_nicknameId.'/'.$currentProfileId.'/'.$record->getType().'';
									}
									else {
										$url = 'main/change/'.$_accountId.'/'.$_userId.'/'.$_nicknameId.'/'.$_profileId.'/'.$record->getType().'';
									}
									$td_nickname = '<a href="'.base_url($url).'" title="'.$_nicknameLabel.'">'.$_nicknameLabel.'</a>';
								}
								else {
									$td_nickname = '<span>&nbsp;</span>';
								}
								
								if($r_profile[0]) {
									if($_accountId == $currentAccountId && $record->getType()==$currentType) {
										$url = 'main/change/'.$_accountId.'/'.$_userId.'/'.$currentNicknameId.'/'.$_profileId.'/'.$record->getType().'';
									}
									else {
										$url = 'main/change/'.$_accountId.'/'.$_userId.'/'.$_nicknameId.'/'.$_profileId.'/'.$record->getType().'';
									}
									$td_profile = '<a href="'.base_url($url).'" title="'.$_profileLabel.'">'.$_profileLabel.'</a>';
								}
								else {
									$td_profile = '<span>&nbsp;</span>';
								}
								?>
                                <ul class="clear">
                                    <li class="<?php echo ($_accountId==$currentAccountId && $record->getType()==$currentType)?' selected':'';?>"><?php echo $td_account;?></li>
                                    <li class="<?php echo ($_accountId==$currentAccountId && $record->getType()==$currentType)?' selected':'';?>"><?php echo $td_user;?></li>
                                    <li class="<?php echo ($_accountId==$currentAccountId && $_nicknameId == $currentNicknameId && $record->getType()==$currentType)?' selected':'';?>"><?php echo $td_nickname;?></li>
                                    <li class="<?php echo ($_accountId==$currentAccountId && $_profileId == $currentProfileId && $record->getType()==$currentType)?' selected':'';?>"><?php echo $td_profile;?></li>
                                </ul>
                                <?php
							}
							?>
                        </div>
                        <?php endforeach; ?>
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
				var userBarMenuTh_active = ['<?php echo $currentAccount;?>','<?php echo $currentUser;?>','<?php echo $currentNickname;?>','<?php echo $currentProfile;?>'];
				
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
            
            <!--<div class="drop_down">
            	<a href="#"><span class="icon down">&nbsp;</span></a>
                <div class="submenu">
                	<ul>
                        <li class="clear">
                            <span class="cell_1 tcenter">-</span>
                            <span class="cell_2">Option1a</span>
                            <span class="cell_3">Option1b</span>
                            <span class="cell_4">Option1c</span>
                            <span class="cell_5">Option1d</span>
                        </li>
                        <li class="clear">
                            <span class="cell_1 tcenter">&nbsp;</span>
                            <span class="cell_2">&nbsp;</span>
                            <span class="cell_3">Option2b</span>
                            <span class="cell_4">Option2c</span>
                            <span class="cell_5">Option2d</span>
                        </li>
                        <li class="clear">
                            <span class="cell_1 tcenter">&nbsp;</span>
                            <span class="cell_2">&nbsp;</span>
                            <span class="cell_3">&nbsp;</span>
                            <span class="cell_4">Option3c</span>
                            <span class="cell_5">Option3d</span>
                        </li>
                        <li class="clear">
                            <span class="cell_1 tcenter">&nbsp;</span>
                            <span class="cell_2">&nbsp;</span>
                            <span class="cell_3">&nbsp;</span>
                            <span class="cell_4">Option4c</span>
                            <span class="cell_5">Option4d</span>
                        </li>
                        <li class="clear">
                            <span class="cell_1 tcenter">+</span>
                            <span class="cell_2">Option5a</span>
                            <span class="cell_3">Option5b</span>
                            <span class="cell_4">Option5c</span>
                            <span class="cell_5">Option5d</span>
                        </li>
                        <li class="clear">
                            <span class="cell_1 tcenter">+</span>
                            <span class="cell_2">Option6a</span>
                            <span class="cell_3">Option6b</span>
                            <span class="cell_4">Option6c</span>
                            <span class="cell_5">Option6d</span>
                        </li>
                        <li>
                            <span class="cell_1 tcenter">&nbsp;</span>
                            <span class="cell_2">&nbsp;</span>
                            <span class="cell_3">Option7b</span>
                            <span class="cell_4">Option7c</span>
                            <span class="cell_5">Option7d</span>
                        </li>
                    </ul>
                </div>
            </div>-->
            
            <!-- menu -->
        	<!--<ul class="menu">
                <li>Account<span class="icon down">&nbsp;</span></li>
                <li>User<span class="icon down">&nbsp;</span></li>
                <li>Nick Name<span class="icon down">&nbsp;</span></li>
                <li class="last">Profil<span class="icon reload">&nbsp;</span><span class="icon down">&nbsp;</span></li>
            </ul>-->
            
            <!-- options -->
            <ul class="buttons">
                <li><a><span class="icon home left">&nbsp;</span><span class="rline">&nbsp;</span><span class="icon down">&nbsp;</span></a></li>
                <li><a><span class="icon home">&nbsp;</span></a></li>
                <li><a><span class="icon print">&nbsp;</span></a></li>
                <li><a><span class="icon star">&nbsp;</span></a></li>
            </ul>
            <!-- search box -->
            <form method="get" class="search_box clear" action="">
                <fieldset class="gradient">
                    <button class="icon" type="submit">&nbsp;</button>
                    <input id="struct_search" class="field" type="search" autocomplete="off" placeholder="Cod Ateco sau Denumirea" />
                </fieldset>
                <div id="AGH_searchRecom"><div id="AGH_searchRecom_fix"></div></div>
            </form>
        </div>
    </div>
</div>
<style>
a.simple.blue {color:#0064FF;font-weight:normal;margin-right:10px;text-decoration:underline;opacity:0.8;}
a.simple:hover {opacity:1;}
a.simple.blue.selected {color:#646E7C;font-weight:bold;text-decoration:none;opacity:1;}
</style>
<div style="padding:10px; text-align:center; font-family:verdana; font-size:11px;">
<?php if(!$logged):?>
<p style="color:red;">Login for more options with user bar.</p>
<?php endif;?>
</div>
<div style="padding:10px; text-align:center; font-family:verdana; font-size:11px;">
Colors legend:
<ul style="display:inline-block;margin-left:10px;line-height:22px;">
	<li style="display:inline-block;margin-left:10px;"><div style="float:left;width:16px;height:16px;border:1px solid #999; background:<?php //echo TODOsetBgColor(UserBarRecord::ADULT);?>;vertical-align:middle;margin-right:5px;"></div> Adult Account</li>
    <li style="display:inline-block;margin-left:10px;"><div style="float:left;width:16px;height:16px;border:1px solid #999; background:<?php echo TODOsetBgColor(UserBarRecord::TEENAGER);?>;vertical-align:middle;margin-right:5px;"></div> Teenager Account</li>
    <li style="display:inline-block;margin-left:10px;"><div style="float:left;width:16px;height:16px;border:1px solid #999; background:<?php echo TODOsetBgColor(UserBarRecord::BUSINESS);?>;vertical-align:middle;margin-right:5px;"></div> Business</li>
    <li style="display:inline-block;margin-left:10px;"><div style="float:left;width:16px;height:16px;border:1px solid #999; background:<?php echo TODOsetBgColor(UserBarRecord::INSTITUTION);?>;vertical-align:middle;margin-right:5px;"></div> Institution</li>
    
</ul><br/>
<em style="color:#999;">*color is only temporarily to help development</em>
</div>

<?php
function accountTypeImage($type) {
	switch($type) {
		default:
		case UserBarRecord::ADULT:
			return base_url('assets/img/adults.png');
			break;
		case UserBarRecord::TEENAGER:
			return base_url('assets/img/teenagers.png');
			break;
		case UserBarRecord::BUSINESS:
			return base_url('assets/img/business.png');
			break;
		case UserBarRecord::INSTITUTION:
			return base_url('assets/img/institutions.png');
			break;
	}
}
function accountTypeTitle($type) {
	switch($type) {
		default:
		case UserBarRecord::ADULT:
			return 'ADULT CONTENT';
			break;
		case UserBarRecord::TEENAGER:
			return 'TEENAGER CONTENT';
			break;
		case UserBarRecord::BUSINESS:
			return 'BUSINESS CONTENT';
			break;
		case UserBarRecord::INSTITUTION:
			return 'INSTITUTION CONTENT';
			break;
	}
}

?>
<div class="animated fadeInUp boxs" style="height:400px;line-height:400px;margin:5px 0; background-size:contain; background-position:center; background-repeat:no-repeat; background-image:url(<?php echo accountTypeImage($currentType);?>)">
	<?php echo accountTypeTitle($currentType);?>
</div>

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
</html>