<div id="search" class="head">
	<div class="navigation clear">
		<h3 class="left">Results 1 - 25 of 2,500 Items</h3>
		<ul class="control right clear">
			<li><a class="back button" href="#back"><strong>Back</strong><i></i></a></li>
			<li><a class="prev button" href="#prev"><span>Preview</span></a></li>
			<li class="last"><a class="next button" href="#next"><span>Next</span></a></li>
		</ul>
	</div><!-- #search .navigation -->

	<div class="tabs clear">
		<ul class="clear left">
			<li{if $activeAction == 'loghin'} class="selected"{/if}><a href="{$vir_path}search/">Loghin</a></li>
			<li{if $activeAction != 'loghin'} class="selected"{/if}><a href="{$vir_path}search/images/">Web</a></li>
		</ul><!-- #search .tabs .left -->

		<select class="inputCombo right">
			<option>Select Category</option>
		</select><!-- #search .tabs .right -->
		<ul class="clear right">
			<li class="has">
				<a href="#">Other <span class="icon"></span></a>
				<ul>
					<li{if $activeAction == 'images'} class="selected"{/if}><a href="{$vir_path}search/images/">Images</a></li>
					<li{if $activeAction == 'videos'} class="selected"{/if}><a href="{$vir_path}search/videos/">Videos</a></li>
					<li{if $activeAction == 'text'} class="selected"{/if}><a href="{$vir_path}search/text/">Text</a></li>
				</ul>
			</li>
		</ul><!-- #search .tabs .right -->
	</div>
</div><!-- #search .head -->