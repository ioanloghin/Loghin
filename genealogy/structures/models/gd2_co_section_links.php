<?php
define('ANTIHACK', TRUE);// initiem constanta altihack
include_once('../system/libraries/Safe_get.php');

$GET = new safe_get();
$GET->set_var('w', 0, 'intvar');// (integer) width
$GET->set_var('h', 0, 'intvar');// (integer) height
$GET->set_var('up', NULL, '');// (array(int, int, ...)) linile dinspre sectiunile parinte (valoarea pe axa OX)
$GET->set_var('down', NULL, '');// (array(int, int, ...)) linile inspre sectiunile subordonate (valoarea pe axa OX)

$arr_up	= explode(',', $GET->get_var('up'));
$arr_down	= explode(',', $GET->get_var('down'));
asort($arr_up);
asort($arr_down);
$up_min = current($arr_up);
$up_max = end($arr_up);
$down_min = current($arr_down);
$down_max = end($arr_down);

define('width',  $GET->get_var('w', TRUE));
define('center', $GET->get_var('w', TRUE)/2);
define('height', $GET->get_var('h', TRUE));

if(function_exists('imagecreatetruecolor'))
	define('image', imagecreatetruecolor(width, height));
else
	define('image', imagecreate(width, height));

define('color_while', imagecolorallocate(image, 255, 255, 255));
define('color_red', imagecolorallocate(image, 191, 54, 27));
define('color_black', imagecolorallocate(image, 0, 0, 0));
define('color_green', imagecolorallocate(image, 0, 0, 255));
define('color_grey', imagecolorallocate(image, 175, 175, 175));

imagefilltoborder(image, 0, 0, color_red, color_red); 
imagecolortransparent(image, color_red);

$level = array(0, 10, 10, 20);
imagesetthickness(image, 2);// grosimea liniei
$between = 10; // spatiul dintre joburi

// top side -----------------------------------
if($arr_up)
{
	if($up_min == $up_max)
	{
		// inseamna ca array-ul are o singura valoare
		imageline(image, $up_min, $level[0], $up_min, $level[1], color_green);
	}
	else
	{
		// are mai multe
		foreach($arr_up as $x)
			imageline(image, $x, $level[0], $x, $level[1], color_green);
	}
}

// ---------------------------------------------
//
// middle --------------------------------------
$x1 = ($up_min < $down_min) ? $up_min : $down_min;
$x2 = ($up_max > $down_max) ? $up_max : $down_max;
imageline(image, $x1, $level[1], $x2, $level[2], color_green);
//
// bottom --------------------------------------
if($arr_down)
{
	if($down_min == $down_max)
	{
		// inseamna ca array-ul are o singura valoare
		imageline(image, $down_min, $level[2], $down_min, $level[3], color_green);
	}
	else
	{
		// are mai multe
		foreach($arr_down as $x)
			imageline(image, $x, $level[2], $x, $level[3], color_green);
	}
}

// ---------------------------------------------
header("Content-type:image/png");
imagepng(image);
imagedestroy(image);
?>