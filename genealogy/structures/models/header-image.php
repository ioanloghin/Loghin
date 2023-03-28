<?php
$image_width = 340;
$image_height = 200;

define('ANTIHACK', TRUE);
include_once('../system/helpers/GDGradientFill.php');

// Create the image
//$img = imagecreatetruecolor($image_width, $image_height);

$gradient = new gd_gradient_fill($image_width, $image_height, 'vertical', '#392E28', '#796153');
$img = $gradient->img();

// Create some colors
$black			  = imagecolorallocate($img,   0,   0,   0);
$text_color       = imagecolorallocate($img, 233,  14,  91);
$white			  = imagecolorallocate($img, 255, 255, 255);
$grey			  = imagecolorallocate($img, 60, 60, 60);
$transparent      = imagecolorallocatealpha($img, 233, 14, 91, 0);

imagecolortransparent($img, $grey);

//imagestring($img, 5, 5, 5,  'A Simple Text String', $text_color);

// The text to draw
$text = "LOGHIN";
// Replace path by your own font path
$font = '../design/fonts/space age.ttf';

imagettftext($img, 46, 0, 26, 80, $grey, $font, $text);

header("Content-Type: image/png");
imagepng($img);

imagedestroy($img);
?>