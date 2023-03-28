{strip}<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>{if !empty($app_page)}{$app_page} - {/if}{$app_title}</title>
{strip}{stylesheets}{/strip}
		<script src="https://code.jquery.com/jquery-latest.min.js"></script>
	
	
    </head>
    
    <body style="min-width: 100vw !important;">
		{* Header *}
		
    	<div id="header">
        	<div class="width clear">
            	<div class="left">
                	<a href="#">{if $loggedin}{$session.username}{else}Login In{/if}</a> |&nbsp;
		            {*<select class="inputCombo" name="websites">
			            <option value="">Loghin WebSites</option>
			            <option value="">Generale:</option>
			            <option value=""> &nbsp; &nbsp; .com</option>
			            <option value=""> &nbsp; &nbsp; .biz</option>
			            <option value=""> &nbsp; &nbsp; etc.</option>
			            <option value="">Nationale:</option>
			            <option value=""> &nbsp; &nbsp; .ro</option>
			            <option value=""> &nbsp; &nbsp; .it</option>
			            <option value=""> &nbsp; &nbsp; .md</option>
			            <option value=""> &nbsp; &nbsp; etc.</option>
			            <option value="">etc.</option>
		            </select> |&nbsp;
					<select class="inputCombo" name="memberType">
						<option value="">All Users</option>
						{foreach $memberTypes AS $item}
						<option value="{$item@key}">{$item.name}</option>
							{foreach $item.items AS $_item}
							<option value="{$_item@key}"> &nbsp; &nbsp; {$_item}</option>
							{/foreach}
						{/foreach}
					</select>*}
				</div>

		        {* System *}
		        <a class="_button_" href="javascript:void(0);">System Window<i></i></a>
		        {include "plugins/system.tpl"}
		        {** System **}

                    
				<div class="right" style="margin-right: -140px;">
				  
						<select class="inputCombo" id="country"  name="country" style=" margin-left: 70px;">
					    <option  value="{$itemss.name}">{$Country_Name}</option>
					       {foreach $item1 AS $itemss}
					        
					    	 <option  value="{$itemss.name}">{$itemss.name}</option>
					    
							{/foreach}
					</select>
					
				&nbsp;|&nbsp;
				
					<select class="inputCombo" name="language">
					    {foreach  $ip_lang AS $lPs}
					       {foreach explode(',', $lPs.IP_lang) as $v}
					  
					     	<option value="{if {$v|trim}|array_key_exists:$country_languages}{$country_languages[{$v|trim}]}{/if}" {if $country_languages[{$v|trim}] == $browser_lang}selected="selected"{/if} class="lang">{$v}</option>
					  
			                       {/foreach}
					    {/foreach}
					
						
					</select>
			
				
				
				</div>
				
                {* Customize block *}{strip}
	            <div class="middle clear">
					<a id="customize" href="javascript:void(0);" title="{'customize_page'|lang}"><strong>{'customize_page'|lang}</strong></a>
                    <div id="custBlock" class="hide">
						<div class="cnt clear">
							<div class="left">
								<h2>Sites &nbsp;<sup><span>0</span> / 6</sup></h2>
								<div class="custItems">
									<ul class="clear-li">
									{if !empty($sites.site)}{foreach $sites.site AS $site_id => $siteData}
										<li>
											<div class="left"><img src="{$vir_pic_path}www/layouts/{if $siteData.image}{$siteData.image}{else}default.png{/if}" alt="" /></div>
											<div class="right clear">
												<h3>{$siteData.name}</h3>
												<input class="inputCheckbox" type="checkbox" name="items[]" value="{$site_id}"{if array_key_exists($site_id, $favorites.site)} checked="checked"{/if} />
												<div class="cfix"></div>
												<p class="arial">{$siteData.details}</p>
											</div>
										</li>
									{/foreach}{/if}
									</ul>
								</div>
							</div>
							<div class="right">
								<h2>Applications &nbsp;<sup><span>0</span> / 6</sup></h2>
								<div class="custItems">
									<ul class="clear-li">
									{if !empty($sites.application)}{foreach $sites.application AS $site_id => $siteData}
										<li>
											<div class="left"><img src="{$vir_pic_path}www/layouts/{if $siteData.image}{$siteData.image}{else}default.png{/if}" alt="" /></div>
											<div class="right clear">
												<h3>{$siteData.name}</h3>
												<input class="inputCheckbox" type="checkbox" name="items[]" value="{$site_id}"{if array_key_exists($site_id, $favorites.application)} checked="checked"{/if} />
												<div class="cfix"></div>
												<p class="arial">{$siteData.details}</p>
											</div>
										</li>
									{/foreach}{/if}
									</ul>
								</div>
							</div>
						</div>
						{*if $id && (count($favorites.site) < 6 || count($favorites.application) < 6)}<div class="error arial">{'customize_error'|lang}</div>{/if*}
						<div class="info clear">
							<div>Layout: <span> 1</span></div>
							<input class="inputText left" type="text" name="name" value="" />
							<a class="_button gray right" href="javascript:void(0);"><strong>{'save'|lang}</strong><i></i></a>
							{*{'customize_info'|lang}*}
						</div>
	                    <input type="hidden" name="id" value="0" />
					</div>

		            <a class="arrow right" href="javascript:void(0);">&darr;</a>
		            <div id="layouts" class="hide">
			            {*if $layouts}
			            {foreach $layouts AS $layout}
			            
					            <label><input type="checkbox" name="layout[]" value="{$layout.id}" /></label>
					            <span{if $layout@key == $id} class="bold"{/if}>Layout {$layout.order}</span>
				            
				            <dd>{$layout.name}</dd>
			            
			            {/foreach}
			            {/if*}
			            <div class="buttons clear">
				            <a id="delete-layout" class="button red right hide" href="javascript:void(0);" onclick="return confirm('Are you sure you want to delete these layouts?');"><span>Delete</span></a>
				            <a id="edit-layout" class="button green right hide" href="javascript:void(0);"><span>Modify</span></a>
				            <a id="new-layout" class="button blue right" href="javascript:void(0);"><span>New Layout</span></a>
				        </div>
			        </div>
	            </div>{/strip}
				{* End customize block *}
           </div>
        </div>
		{* End header *}
        
		{* Bara Useri *}
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
									<img src="https://files.loghin.com/quick-view-image.png" alt="" />
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
								<a href="#">{$data.currentAccount}</a>
                                <ul>
								{foreach $data.accountsList AS $key => $info}
                                    <li>
                                        <a href="">{$info.firstname} {$info.lastname}&nbsp;</a>
                                    </li>
                                {/foreach}
                                </ul>
							</li>
							<li><a href="#">{$data.currentUser}&nbsp;</a></li>
							<li class="down">
								<a href="#">{$data.currentNickname}&nbsp;</a>
								<ul>
                                	{foreach $data.nicknamesList AS $key => $info}
									<li><a href="#">{$info.nickname}&nbsp;</a></li>
									{/foreach}
								</ul>
							</li>
							<li><a href="#">Profil</a></li>
						</ul>

						<div class="options">
							<div class="overflow">
                            	{foreach $data.records AS $key => $record}
								<div class="row clear">
									<div class="left"><a href="javascript:void(0);">+</a></div>
                                    {for $i=0 to $record->maxRows()}
                                        {$r_account = $record->getAccount($i)}
                                        {$r_user = $record->getUser($i)}
                                        {$r_nickname = $record->getNickname($i)}
                                        {$r_profile = $record->getProfile($i)}
                                        
                                        {* Preserve parent *}
                                        {if $r_account.0}
                                        	{$_accountId=$r_account.0}
                                            {$_accountLabel=$r_account.1}
                                        {/if}
                                        {if $r_user.0}
                                            {$_userId=$r_user.0}
                                            {$_userLabel=$r_user.1}
                                        {/if}
                                        {if $r_nickname.0}
                                            {$_nicknameId=$r_nickname.0}
                                            {$_nicknameLabel=$r_nickname.1}
                                        {/if}
                                        {if $r_profile.0}
                                            {$_profileId=$r_profile.0}
                                            {$_profileLabel=$r_profile.1}
                                        {/if}
                                        
                                        {if $r_account.0>0}
                                            {$td_account = "<a href='main/change/`$_accountId`/`$_userId`/`$_nicknameId`/`$_profileId`/`$record->getType()`' title='`$_accountLabel`'>`$_accountLabel`</a>"}
                                        {else}
                                            {$td_account = '<span>&nbsp;</span>'}
                                        {/if}
                                        
                                        {if $r_user.0>0}
                                            {$td_user = "<a href='main/change/`$_accountId`/`$_userId`/`$_nicknameId`/`$_profileId`/`$record->getType()`' title='`$_userLabel`'>`$_userLabel`</a>"}
                                        {else}
                                            {$td_user = '<span>&nbsp;</span>'}
                                        {/if}
                                        
                                        {if $r_nickname.0>0}
                                            {$td_nickname = "<a href='main/change/`$_accountId`/`$_userId`/`$_nicknameId`/`$_profileId`/`$record->getType()`' title='`$_userLabel`'>`$_nicknameLabel`</a>"}
                                        {else}
                                            {$td_nickname = '<span>&nbsp;</span>'}
                                        {/if}
                                        
                                        {if $r_profile.0>0}
                                            {$td_profile = "<a href='main/change/`$_accountId`/`$_userId`/`$_nicknameId`/`$_profileId`/`$record->getType()`' title='`$_userLabel`'>`$_profileLabel`</a>"}
                                        {else}
                                            {$td_profile = '<span>&nbsp;</span>'}
                                        {/if}
                                        
                                        <ul class="clear">
                                            <li>{$td_account}</li>
                                            <li>{$td_user}</li>
                                            <li>{$td_nickname}</li>
                                            <li>{$td_profile}</li>
                                        </ul>
                                    {/for}
								</div>
                                {/foreach}
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
		{* End bara useri *}

		{* Body content, categories *}
		<div class="eyes" id="body">
			<div class="width clear">
				<ul class="left sites clear-li">
					{*foreach $favorites.site AS $_id => $_var}
					<li{if $_var@first || $_var@index == 5} class="first"{elseif $_var@index == 1 || $_var@index == 4} class="second"{/if} id="site{$_id}">
						<div class="icon"><a href="javascript:void(0);"><img src="{$vir_pic_path}www/layouts/{$sites.site[$_id].image}" alt="{$sites.site[$_id].name}" /></a></div>
						<h2>
							<a href="{$sites.site[$_id].url}">{$sites.site[$_id].name}</a>
							<input type="hidden" name="searchIn[]" value="{$_id}" />
						</h2>
					</li>
					{/foreach}
					{if !$id}<li class="first">
						<div class="icon"><a href="javascript:void(0);"><img src="{$vir_pic_path}www/layouts/default.png" alt="" /></a></div>
						<h2><a href="javascript:void(0);">{'select_more'|lang}</a></h2>
					</li>{/if*}
				</ul>
				<ul class="right applications clear-li">
					{*foreach $favorites.application AS $_id => $_var}
					<li{if $_var@first || $_var@index == 5} class="first"{elseif $_var@index == 1 || $_var@index == 4} class="second"{/if} id="site{$_id}">
						<div class="icon"><a href="javascript:void(0);"><img src="{$vir_pic_path}www/layouts/{$sites.application[$_id].image}" alt="{$sites.application[$_id].name}" /></a></div>
						<h2>
							<a href="{$sites.application[$_id].url}">{$sites.application[$_id].name}</a>
							<input type="hidden" name="searchIn[]" value="{$_id}" />
						</h2>
					</li>
					{/foreach}
					{if !$id}<li class="first">
						<div class="icon"><a href="javascript:void(0);"><img src="{$vir_pic_path}www/layouts/default.png" alt="" /></a></div>
						<h2><a href="javascript:void(0);">{'select_more'|lang}</a></h2>
					</li>{/if*}
				</ul>
				<div class="info"><a href="https://loghin.com/allsystem"><span>all</span><br />System</a></div>
				<div class="logo">
					{$ArchTop->getStyle()}
					{$ArchBottom->getStyle()}
					{$ArchTop->getLetters()}
					{$ArchBottom->getLetters()}
				</div>
				<span class="extension">.com</span>
				<div class="else"><a href="http://loghout.com/"><span>VS</span><br />Loghout</a></div>
			</div>
		</div>{/strip}
		{* End body content categories *}

		{* Content block *}
		<div id="content">
			{* Scroll Arrow *}
			<a class="scrollArrow top" href="javascript:void(0);"></a>
			{* End scroll Arrow *}
			<div class="width">
				{* Search block *}
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
				{* End search block *}

				{* Results block *}
				<!-- <ul class="resultsCats width clear"></ul> -->
				
				<ul class="resultsCats width clear">
					<li class="first"><a class="selected" href="#"><i class="_left"></i><strong>Cars long name here</strong><i class="_right"></i></a></li>
					<li><a href="#"><i class="_left"></i><strong>Cars</strong><i class="_right"></i></a></li>
					<li><a href="#"><i class="_left"></i><strong>Cars</strong><i class="_right"></i></a></li>
					<li><a href="#"><i class="_left"></i><strong>Cars</strong><i class="_right"></i></a></li>
					<li><a class="selected" href="#"><i class="_left"></i><strong>Cars</strong><i class="_right"></i></a></li>
					<li><a href="#"><i class="_left"></i><strong>Cars</strong><i class="_right"></i></a></li>
					<li><a href="#"><i class="_left"></i><strong>Cars</strong><i class="_right"></i></a></li>
				</ul>
				
				<div class="width" id="results">
					<div class="_left"><a href="javascript:void(0);" rel="-">&laquo;</a></div>
					<div class="content width">
						<div class="space">
							<div class="clear">
								<ul class="clear">
									<li>
										<div class="image"><img src="{$vir_pic_path}www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 1</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
							 		<li>
										<div class="image"><img src="{$vir_pic_path}www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 2</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="{$vir_pic_path}www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 3</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="{$vir_pic_path}www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 4</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="{$vir_pic_path}www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 5</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="{$vir_pic_path}www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 6</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="{$vir_pic_path}www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 7</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="{$vir_pic_path}www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 8</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="{$vir_pic_path}www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 9</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="_right"><a href="javascript:void(0);" rel="+">&raquo;</a></div>
				</div>
				{* End results block *}

				{* Suggestion block *}
				<div id="suggest">
					<div class="head clear">
						<div class="_left"><a href="javascript:void(0);" rel="-">&laquo;</a></div>
						<div class="nav">
							<div>
								<div>
									<ul>
										<li class="first"><a href="#">Arhitectura</a></li>
										<li><a href="#">Constructii</a></li>
										<li><a href="#">Industrie</a></li>
										<li><a href="#">Constructii</a></li>
										<li><a href="#">Industrie</a></li>
										<li><a href="#">Constructii</a></li>
										<li><a href="#">Industrie</a></li>
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
							{* Left col *}
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
										<h3>Suggestion</h3>
									</li>
								</ul>
								{* Suggestion items *}
								
								<div class="clear itemsOverflow">
									<div class="overflow">
									    {foreach $item2 AS $itemsss}
										<ul>
											<li class="clear">
												<label><input type="checkbox" value="{$itemsss.id}" name="suggest" id="" /></label>
												<div class="logo"><img src="uploads/{$itemsss.image}" alt="" width="94" height="74"/></div>
												<div class="details">
													<div class="clear">
												 
														<h3 id="cheading">                       {$itemsss.heading}
														</h3>
															
														<span>{$itemsss.ctime}                 </span>
													</div>
												<p id="discription">{$itemsss.discription}</p>
												</div>
											</li>
																														</ul>
										{/foreach}
									</div>										
								</div>
								 
								{* End suggestion items *}
								<div class="bottomSpace"></div>
							</div>
							{* End left col *}

							{* Right col *}
							<div class="right">
								<div class="overlay" style="display: none;"></div>
								<div class="optionsB" style="display: none;">
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
								{* Suggestion items *}
								<div class="clear itemsOverflow">
									<div class="overflow">
									    {foreach $item3 AS $check}
										<ul>
											<li class="clear">
												<label><input type="checkbox" name="" value="" /></label>
										<form method="POST">
												<input id="myInputHidden" name="myInputName" type="hidden" value="" />
											</form>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3 id="maincheck">Assasins Creed {($item3[3]['id'])} </h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
												
											</li>
										</ul>
										{/foreach}
									</div>
								</div>
								{* End suggestion items *}
								<div class="bottomSpace"></div>
							</div>
							{* End right col *}
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

					{* Button open & close *}
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
					{* End button open & close *}
				</div>
				{* End Suggestion block *}
			</div>
		</div>
		{* End content block *}

		{* Footer *}
		<div id="footer">
			<div class="width">
				<p class="left">
					<a href="#">Marketing / Advertise</a> &bull;
					<a href="#">Terms of service</a> &bull;
					<a href="#">Privacy</a> &bull;
					<a href="#">You opinion</a> &bull;
					<a href="#">Work with us</a>
				</p>
        		<p class="right">Copyright &copy; 2020 Loghin. All rights reserved..</div> 
			</div>
		</div>
		{* End footer *}




<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  <script>
 

     
      $('#country').on("change",function(){
          var selectedCountry = $("#country option:selected").val();
          
          $.ajax({
              type: "POST",
              url: "states",
              data: { country : selectedCountry },
              success: function(dataResult){
              var dataResult = JSON.parse(dataResult);
              
               if(dataResult.statusCode==200){
                    var content = dataResult.value;
                    var lang = dataResult.value1;
                    var code = dataResult.value2;
                 
                    
                    $("#states").html(content);
                    $("#lang").html(lang);
                   
                    $("#code").html(code);
               }
               
          }
        
        }); 
         console.log(selectedCountry);
        
         
      });
     


  </script>

		{scripts}
<script type="text/javascript">
		$.conf = { 'path': "{$vir_path}", 'pic_path': "{$vir_pic_path}www/" };
			
   

$(document).ready(function() {
        $("#addsug").click(function(){
            var test = new Array();
        
            $("input[name='suggest']:checked").each(function() {
                test.push($(this).val());
            });
 
           $("#myInputHidden").val(test);
        });
        
    });



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
</html>
