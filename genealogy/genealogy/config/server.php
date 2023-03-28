<?php
// ANTIHACK verificare access din exterior ------------------------------------------------------------------------------- //
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include("../module/e_403.php"));
}
//------------------------------------------------------------------------------------------------------------------------ //
//
//------------------------------------------------------------------------------------------------------------------------ //
	define("PROIECT",	"LoghinGenealogy");
	define("DOMAIN",	"genealogy.com");
//------------------------------------------------------------------------------------------------------------------------ //
//
//------------------------------------------------------------------------------------------------------------------------ //
if($_SERVER['HTTP_HOST'] == 'localhost')
{
	define("SITE_ROOT",		"http://localhost/clienti/genealogy/");
	define("ADMIN_ROOT",	SITE_ROOT."administrator/");
	define("ROOT",			"http://localhost/clienti/genealogy/");
}
else
if($_SERVER['HTTP_HOST'] == 'www.loghin.com' || $_SERVER['HTTP_HOST'] == 'loghin.com')
{
	define("SITE_ROOT",		"http://loghin.com/genealogy/");
	define("ADMIN_ROOT",	SITE_ROOT."administrator/");
	define("ROOT",			"http://loghin.com/genealogy/");
}
else
if($_SERVER['HTTP_HOST'] == 'www.genealogy.loghin.com' || $_SERVER['HTTP_HOST'] == 'genealogy.loghin.com')
{
	define("SITE_ROOT",		"http://genealogy.loghin.com/");
	define("ADMIN_ROOT",	SITE_ROOT."administrator/");
	define("ROOT",			"/");
}
//------------------------------------------------------------------------------------------------------------------------ //
// functie ce genereaza link-uri pentru pagini
function get_link($identif)
{
	// $identificatorul, $param1, $param2, ...
	$return = NULL;
	$numargs = func_num_args();
	$arg_list = func_get_args();
	switch($identif)
	{
		case'tree0':
			if($numargs == 2) $return = 'tree-'.$arg_list[1].'/'; break;
		case'tree1':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/'; break;
		case'tree_overview':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/overview.html'; break;
		case'tree_media':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/'; break;
		case'tree_media_audios':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/audio/'; break;
		case'tree_media_audio_add':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/audio/add'; break;
		case'tree_media_audio':
			if($numargs == 4) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/audio/'.$arg_list[3]; break;
		case'tree_media_photos':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/photo/'; break;
		case'tree_media_photo_add':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/photo/add'; break;
		case'tree_media_photo':
			if($numargs == 4) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/photo/'.$arg_list[3]; break;
		case'tree_media_stories':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/story/'; break;
		case'tree_media_story_add':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/story/add'; break;
		case'tree_media_story':
			if($numargs == 4) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/story/'.$arg_list[3]; break;
		case'tree_media_videos':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/video/'; break;
		case'tree_media_video_add':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/video/add'; break;
		case'tree_media_video':
			if($numargs == 4) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/media/video/'.$arg_list[3]; break;
		case'tree_facts':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/facts/'; break;
		case'tree_facts_add':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/facts/add'; break;
		case'tree_sources':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/sources/'; break;
		case'tree_sources_add':
			if($numargs == 3) $return = 'tree-'.$arg_list[1].'/'.$arg_list[2].'/sources/add'; break;
	}
	return $return;
}
?>