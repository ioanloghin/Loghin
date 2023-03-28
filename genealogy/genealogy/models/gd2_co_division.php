<?php
define('ANTIHACK', TRUE);// initiem constanta altihack
include_once('../system/libraries/Safe_get.php');

$GET = new safe_get();
$GET->set_var('w', 0, 'intvar');// (integer) width
$GET->set_var('h', 0, 'intvar');// (integer) height
$GET->set_var('a', 0, 'intvar');// (enum(1-ierarhie,2-asistent,3-agatare la dreapta)) aspect
$GET->set_var('end_sup', NULL, 'intvar');// (int,int,int,) dimensiunile joburilor din divizia superioara
$GET->set_var('this', NULL, 'intvar');// (int,int,int,) dimensiunile joburilor din divizia curenta
$GET->set_var('sub', 0, 'intvar');// (enum(0, 1)) daca are divizii sau sectiuni subordonate

$arr_end_sup = explode(',', $GET->get_var('end_sup'));
$arr_this = explode(',', $GET->get_var('this'));/* ordinea in care vin datele este importanta, a nu se reordona */

define('sub',    (bool)$GET->get_var('sub', TRUE));
define('aspect', $GET->get_var('a', TRUE));
define('width',  $GET->get_var('w', TRUE));
define('center', $GET->get_var('w', TRUE)/2);
switch(aspect)
{
	case 1:
		define('height', $GET->get_var('h', TRUE) + 20 /* padding top */);
		break;
	case 2:
	case 3:
		define('height', $GET->get_var('h', TRUE) + 20 /* padding top */
				- ((!sub) ? (int)(end($arr_this)/2)-1 /* scadem jumatate din ultimul job ca sa nu apara prelungirea liniei */ : 0)
		);
		break;
}
define('j_sup',  count($arr_end_sup));
define('j_this', count($arr_this));

if(function_exists('imagecreatetruecolor'))
	define('image', imagecreatetruecolor(width, height));
else
	define('image', imagecreate(width, height));

define('color_while', imagecolorallocate(image, 255, 255, 255));
define('color_red', imagecolorallocate(image, 191, 54, 27));
define('color_black', imagecolorallocate(image, 0, 0, 0));
define('color_green', imagecolorallocate(image, 0, 86, 0));
define('color_grey', imagecolorallocate(image, 175, 175, 175));

imagefilltoborder(image, 0, 0, color_red, color_red); 
imagecolortransparent(image, color_red);

// TOP SIDE -----------------------------------
switch(aspect)
{
	case 1:
	case 2:
	case 3:
		$level = array(0, 8, 12, 20);
		imagesetthickness(image, 2);// grosimea liniei
		$between = 10; // spatiul dintre joburi
		
		// top side -----------------------------------
		// calculam dimensiunea totala a joburilor din divizia superioara
		$width_all = 0;
		foreach($arr_end_sup as $width)
			$width_all += intval($width);
		$width_all += (j_sup-1) * $between;// adaugam spatiul dintre joburi
		
		// jobul anterior primului job
		$arr_end_sup[-1] = 0;
		$x = array(-1 => /* margin left */((width - $width_all) / 2));
		
		for($i=0; $i<j_sup; $i++)
		{
			$x[$i] = /* cel precedent */ $x[$i-1] + /* jumatate din cel anterior */ ($arr_end_sup[$i-1] / 2) + /* jumatate din cel curent */ ($arr_end_sup[$i] / 2);
			if($i) $x[$i] += $between;// adaugam spatiu dintre joburi
			
			// printam linia
			imageline(image, $x[$i], $level[0], $x[$i], $level[1], color_green);
			
			// stocam first si last pentru linia orizontala
			if($i == (0)) $first = $x[$i];
			if($i == (j_sup-1)) $last = $x[$i];
		}
		// linie orizontala
		imageline(image, $first, $level[1], $last, $level[1], color_green);
		// ---------------------------------------------
		//
		// continuare in jos
		imageline(image, center, $level[1], center, $level[2], color_green);
		break;
}
// BOTTOM SIDE -----------------------------------
switch(aspect)
{
	case 1:
		// calculam dimensiunea totala a joburilor din divizia curenta
		$width_all = 0;
		foreach($arr_this as $width)
			$width_all += intval($width);
		$width_all += (j_this-1) * $between;// adaugam spatiul dintre joburi
		
		// jobul anterior primului job
		$arr_this[-1] = 0;
		$x = array(-1 => /* margin left */((width - $width_all) / 2));
		
		for($i=0; $i<j_this; $i++)
		{
			$x[$i] = /* cel precedent */ $x[$i-1] + /* jumatate din cel anterior */ ($arr_this[$i-1] / 2) + /* jumatate din cel curent */ ($arr_this[$i] / 2);
			if($i) $x[$i] += $between;// adaugam spatiu dintre joburi
			
			// printam linia
			imageline(image, $x[$i], $level[2], $x[$i], $level[3], color_green);
			
			// stocam first si last pentru linia orizontala
			if($i == (0)) $first = $x[$i];
			if($i == (j_this-1)) $last = $x[$i];
		}
		// linie orizontala
		imageline(image, $first, $level[2], $last, $level[2], color_green);
		// ---------------------------------------------
		break;
	case 2:
		// o linie verticala pe centrul diviziei
		imageline(image, center, $level[2], center, height, color_green);
		// ---------------------------------------------
		$prev = 20 /* padding top */ - 10 /* margin top al primului box */;
		foreach($arr_this as $nr => $height)
		{
			$current = $prev + $height /* spatiul dintre joburi */ + 10;
			$prev = $current;
			$current -= (int)$height/2;// scadem jumatate din inaltime ca sa fie pe middle
			imageline(image, center, $current, center-20, $current, color_green);
		}
		// ---------------------------------------------
		break;
	case 3:
		// o linie verticala pe centrul diviziei
		imageline(image, center, $level[2], center, height, color_green);
		// ---------------------------------------------
		$prev = 20 /* padding top */ - 10 /* margin top al primului box */;
		foreach($arr_this as $nr => $height)
		{
			$current = $prev + $height /* spatiul dintre joburi */ + 10;
			$prev = $current;
			$current -= (int)$height/2;// scadem jumatate din inaltime ca sa fie pe middle
			imageline(image, center, $current, center+20, $current, color_green);
		}
		// ---------------------------------------------
		break;
}
header("Content-type:image/png");
imagepng(image);
imagedestroy(image);
?>