<object type="application/x-shockwave-flash" data="<?php echo base_url('content/flash/player_mp3_multi.swf');?>" width="1" height="1">
	<param name="movie" value="<?php echo base_url('content/flash/player_mp3_multi.swf');?>" />
	<param name="bgcolor" value="#000000" />
	<?php
	$playlist = array(
		array('Bobby McFerrin - Don\'t Worry Be Happy',	base_url('content/audio/BobbyMcFerrin_DontWorryBeHappy.mp3'))
	);
	
	$count = count($playlist);
	$get_playlist_src = NULL;
	$get_playlist_title = NULL;
	foreach($playlist as $n => $item)
	{
		if($n > 0)
		{
			$get_playlist_src .= '|';
			$get_playlist_title .= '|';
		}
		$get_playlist_src .= $item[1];
		$get_playlist_title .= $item[0];
	}
	// shuffle=2&amp;
	?>
	<param name="FlashVars" value="mp3=<?php echo $get_playlist_src;?>&amp;title=<?php echo $get_playlist_title;?>&amp;width=1&amp;autoplay=1&amp;showslider=0&amp;currentmp3color=ffffff&amp;showplaylistnumbers=0&amp;showvolume=1&amp;volume=50&amp;shuffle=2&amp;showlist=0" />
</object>