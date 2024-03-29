<div class="anim_delay1p2 animated bounceIn nav100 clear">
	<div class="gradient">
    	<div class="center">
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
                            <a class="fancy bg" href="<?php //echo base_url('models/quick-block.html');?>">Quick Profile View</a>
                        </div>
                    </div>
                </div>
            </ul>
            
        	<!-- drop_down -->
            <div class="user-menu clear left">
                <a class="left" href="javascript:void(0);"><span class="online icon"></span></a>
                <div class="right"><a href="#refresh">Refresh</a></div>
                <ul class="clear">
                    <li class="down">
                        <a href="#">Account</a>
                        <ul>
                        	@foreach($accounts_types as $type_id => $type_name)
                            <li><a href="#">{{ $type_name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="#">User</a></li>
                    <li class="down">
                        <a href="#">Nick Name</a>
                        <ul>
                        	@foreach($accounts_assoc as $key => $row)
                            <li><a href="#">{{ $row[2][1] }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="#">Profil</a></li>
                </ul>

                <div class="options">
                    <div class="overflow">
                    	@foreach($accounts_types as $type_id => $type_name)
                        <div class="row clear">
                            <div class="left"><a href="javascript:void(0);">+</a></div>
                            @foreach($accounts_assoc as $key => $row)
                            <ul class="clear">
                                <li><a href="#">{{ $row[0][1] }}</a></li>
                                <li><a href="#">{{ $row[1][1] }}</a></li>
                                <li><a href="#">{{ $row[2][1] }}</a></li>
                                <li><a href="#">{{ $row[3][1] }}</a></li>
                            </ul>
                            @endforeach
                        </div>
                        @endforeach
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
<script>
// compact/extends accounts
function userBar_compactAll(ref)
{
	var root = (ref == null) ? $('.options > .overflow > .row') : ref;
	
	root.children('.left').children('a').html('+');
	
	root.children('ul').each(function(index, element) {
		if(index > 0)
			$(element).hide();
	}); 
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
