<?php
define('width', 20);
define('height', 160);

$str = (isset($_GET['str'])) ? $_GET['str'] : NULL;

if(function_exists('imagecreatetruecolor'))
	define('image', imagecreatetruecolor(width, height));
else
	define('image', imagecreate(width, height));

define('color_while', imagecolorallocate(image, 255, 255, 255));
define('color_red', imagecolorallocate(image, 191, 54, 27));
define('color_black', imagecolorallocate(image, 0, 0, 0));
define('color_grey', imagecolorallocate(image, 175, 175, 175));

imagefilltoborder(image, 0, 0, color_red, color_red); 
imagecolortransparent(image, color_red);

$px = 7.5 * strlen($str);
imagestringup(image, 3, 4, $px, $str, color_grey);

header("Content-type:image/png");
imagepng(image);
imagedestroy(image);
?>