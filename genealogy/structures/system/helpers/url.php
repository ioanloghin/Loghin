<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------
//
// adauga parametrului specificat adresa de baza, ROOT-ul
function base_url($page)
{
	return ROOT.((substr($page, 0, 1) == '/') ? substr($page, 1) : $page);
}

// genereaza calea (url) catre pagina respectiva
function anchor()
{
	$numargs	= func_num_args();
	$arg_list	= func_get_args();
	
	$controller = (isset($arg_list[0])) ? $arg_list[0] : 'index';
	$page		= (isset($arg_list[1])) ? $arg_list[1] : 'index';
	
	$url = NULL;
	if(LANG_IN_URL) $url .= lang.'/';
	$url .= $controller.'/'.$page;
	
	for($n=2; $n<$numargs; $n++)
		$url .= '/'.$arg_list[$n];
	
	return ROOT.$url;
}

// genereaza tagul pentru a include un fisier extern javascript
function script($template, $filename)
{
	return '<script type="text/javascript" src="'.ROOT.'views/templates/'.$template.'/js/'.$filename.'"></script>';
}

// genereaza tagul pentru a include un fisier extern css
function style($template, $filename)
{
	return '<link type="text/css" rel="stylesheet" href="'.ROOT.'views/templates/'.$template.'/css/'.$filename.'" />';
}

// genereaza calea catre imagea
function base_image($template, $filename)
{
	return ROOT.'views/templates/'.$template.'/images/'.$filename;
}

// redirectioneaza
function redirect($location)
{
	if(!headers_sent())
	{
		header('location: ' . urldecode($location));
		exit;
	}

     exit('<meta http-equiv="refresh" content="0; url=' . urldecode($location) . '"/>');
	 /*exit('<script>document.location.href=' . urldecode($Str_Location) . ';</script>');*/
     return;
}
// END url helper

/* End of file url.php */
/* Location: ./system/helpers/url.php */?>