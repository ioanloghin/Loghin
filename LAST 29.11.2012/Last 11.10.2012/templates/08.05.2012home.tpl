{strip}<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>{if !empty($app_page)}{$app_page} - {/if}{$app_title}</title>
{stylesheets}
    </head>
    
    <body>
		{* Header *}
    	<div id="header">
        	<div class="width clear">
            	<div class="left">
                	<a href="#">Login In</a> &nbsp;|&nbsp;
                    <a href="#">Loghin WebSites</a> &nbsp;|&nbsp;
					<select class="inputCombo" name="memberType">
						<option value="">All Users</option>
						{foreach $memberTypes AS $item}
						<option value="{$item@key}">{$item.name}</option>
							{foreach $item.items AS $_item}
							<option value="{$_item@key}"> &nbsp; &nbsp; {$_item}</option>
							{/foreach}
						{/foreach}
					</select>
				</div>
				<div class="right">
					<select class="inputCombo" name="country">
						<option value="">Country</option>
					</select>
					&nbsp;|&nbsp;
					<select class="inputCombo" name="language">
						<option value="">Language</option>
					</select>
				</div>
           </div>
        </div>
		{* End header *}

		{* Body content, categories *}
		<div class="eyes" id="body">
			<div class="width clear">
				<ul class="left sites clear-li">
					{foreach $favorites.site AS $_id => $_var}
					<li{if $_var@first || $_var@index == 5} class="first"{elseif $_var@index == 1 || $_var@index == 4} class="second"{/if} id="site{$_id}">
						<div class="icon"><a href="javascript:void(0);"><img src="{$vir_pic_path}www/sites/{$sites.site[$_id].image}" alt="{$sites.site[$_id].name}" /></a></div>
						<h2>
							<a href="{$sites.site[$_id].url}">{$sites.site[$_id].name}</a>
							<input type="hidden" name="searchIn[]" value="{$_id}" />
						</h2>
					</li>
					{/foreach}
					{if !$_fav}<li class="first">
						<div class="icon"><a href="javascript:void(0);"><img src="{$vir_pic_path}www/sites/default.png" alt="" /></a></div>
						<h2><a href="javascript:void(0);">{'select_more'|lang}</a></h2>
					</li>{/if}
				</ul>
				<ul class="right applications clear-li">
					{foreach $favorites.application AS $_id => $_var}
					<li{if $_var@first || $_var@index == 5} class="first"{elseif $_var@index == 1 || $_var@index == 4} class="second"{/if} id="site{$_id}">
						<div class="icon"><a href="javascript:void(0);"><img src="{$vir_pic_path}www/sites/{$sites.application[$_id].image}" alt="{$sites.application[$_id].name}" /></a></div>
						<h2>
							<a href="{$sites.application[$_id].url}">{$sites.application[$_id].name}</a>
							<input type="hidden" name="searchIn[]" value="{$_id}" />
						</h2>
					</li>
					{/foreach}
					{if !$_fav}<li class="first">
						<div class="icon"><a href="javascript:void(0);"><img src="{$vir_pic_path}www/sites/default.png" alt="" /></a></div>
						<h2><a href="javascript:void(0);">{'select_more'|lang}</a></h2>
					</li>{/if}
				</ul>
				<h1 class="logo">Loghin.com</h1>
				<div class="else"><a href="http://loghout.com/"><span>VS</span><br />Loghout</a></div>
			</div>
		</div>{/strip}
		{* End body content categories *}

		{* Content block *}
		<div id="content">
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
				<ul class="resultsCats width clear"></ul>
				<div class="width hide" id="results">
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
										<h3>Sugestions</h3>
									</li>
								</ul>
								{* Suggestion items *}
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
								{* End suggestion items *}
								<div class="bottomSpace"></div>
							</div>
							{* End left col *}

							{* Right col *}
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
								{* Suggestion items *}
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

		{* Scroll Arrow *}
		<a class="scrollArrow top" href="javascript:void(0);"></a>
		{* End scroll Arrow *}

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
        		<p class="right">Copyright &copy; 2009 - 2011 Loghin. All rights reserved.</div> 
			</div>
		</div>
		{* End footer *}
		{* Customize block *}{strip}
		<a id="customize" href="javascript:void(0);"><strong>Customize Page</strong></a>
		<div id="custBlock">
			<div class="cnt clear">
				<div class="left">
					<h2>Sites</h2>
					<div class="custItems">
						<ul class="clear-li">
						{if !empty($sites.site)}{foreach $sites.site AS $site_id => $siteData}
							<li>
								<div class="left"><img src="{$vir_pic_path}www/sites/{if $siteData.image}{$siteData.image}{else}default.png{/if}" alt="" /></div>
								<div class="right clear">
									<h3>{$siteData.name}</h3>
									<input class="inputCheckbox" type="checkbox" name="items[]" value="{$site_id}"{if array_key_exists($site_id, $favorites.site)} checked="checked"{elseif count($favorites.site) == 6} disabled="disabled"{/if} />
									<div class="cfix"></div>
									<p class="arial">{$siteData.details}</p>
								</div>
							</li>
						{/foreach}{/if}
						</ul>
					</div>
				</div>
				<div class="right">
					<h2>Applications</h2>
					<div class="custItems">
						<ul class="clear-li">
						{if !empty($sites.application)}{foreach $sites.application AS $site_id => $siteData}
							<li>
								<div class="left"><img src="{$vir_pic_path}www/sites/{if $siteData.image}{$siteData.image}{else}default.png{/if}" alt="" /></div>
								<div class="right clear">
									<h3>{$siteData.name}</h3>
									<input class="inputCheckbox" type="checkbox" name="items[]" value="{$site_id}"{if array_key_exists($site_id, $favorites.application)} checked="checked"{elseif count($favorites.application) == 6} disabled="disabled"{/if} />
									<div class="cfix"></div>
									<p class="arial">{$siteData.details}</p>
								</div>
							</li>
						{/foreach}{/if}
						</ul>
					</div>
				</div>
			</div>
			<div class="info arial{if $_fav && (count($favorites.site) < 6 || count($favorites.application) < 6)} error">{'customize_error'|lang}{else}">{'customize_info'|lang}{/if}</div>
		</div>
		{* End customize block *}

		{scripts}
		<script type="text/javascript">
			$.conf = { 'path': "{$vir_path}", 'pic_path': "{$vir_pic_path}www/" };
		</script>
    </body>
</html>{/strip}