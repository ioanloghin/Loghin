<style>
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
		{assign "lastType" ""}
		<li class="left">
			<span>Loghin System</span>
			<ul>
			{foreach $systemMenus AS $menu}
			{if $menu.type != 'left' && $lastType != 'right'}
				{assign "lastType" "right"}
				</ul>
			</li>
			<li class="right">
				<span>Loghin Users</span>
				<ul>
			{/if}
			<li>
				<a href="javascript:void(0);">{$menu.name}</a>
				{if $menu.items}
				<ul>
					{foreach $menu.items AS $_menu}
						<li><a data-id="{$_menu@key}" href="#">{$_menu}</a></li>
					{/foreach}
				</ul>
				{/if}
			</li>
			{/foreach}
			</ul>
		</li>
	</ul>
	<a class="icon top disabled" href="javascript:void(0);">&nbsp;</a>
        <div class="overflow">
            <div class="list">
		    </div>
        </div>
	<a class="icon bottom disabled" href="javascript:void(0);">&nbsp;</a>
</div><!-- #sites -->