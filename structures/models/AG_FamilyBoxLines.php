<?php
//------------------------------------------------------------------------------------------------------------------------ //
define('ANTIHACK', TRUE);
include_once('../system/helpers/includes.php');
include_once('../system/helpers/url.php');
script_include('[vital]', '../');
//------------------------------------------------------------------------------------------------------------------------ //
//
//
//------------------------------------------------------------------------------------------------------------------------ //
$familyType = (isset($_GET['familyType']) && is_numeric($_GET['familyType'])) ? $_GET['familyType'] : 0;
$familyAlign = (isset($_GET['familyAlign']) && is_numeric($_GET['familyAlign'])) ? $_GET['familyAlign'] : 0;
$familyGrade = (isset($_GET['familyGrade']) && is_numeric($_GET['familyGrade'])) ? $_GET['familyGrade'] : 0;
$familyChildren = (isset($_GET['familyChildren']) && is_numeric($_GET['familyChildren'])) ? intval($_GET['familyChildren']) : 0;
$familyWidth = (isset($_GET['familyWidth']) && is_numeric($_GET['familyWidth'])) ? $_GET['familyWidth'] : 0;
$familyHeight = (isset($_GET['familyHeight']) && is_numeric($_GET['familyHeight'])) ? $_GET['familyHeight'] : 0;
$colorLine = (isset($_GET['colorLine'])) ? $_GET['colorLine'] : '999';
$exRelatii = (isset($_GET['exRelatii']) && is_numeric($_GET['exRelatii'])) ? $_GET['exRelatii'] : 0;
$exRelatieActiva = (isset($_GET['exRelatieActiva']) && is_numeric($_GET['exRelatieActiva'])) ? $_GET['exRelatieActiva'] : 0;
$option = (isset($_GET['option']) && is_numeric($_GET['option'])) ? $_GET['option'] : 0;
$box_type = (isset($_GET['box_type']) && is_numeric($_GET['box_type'])) ? $_GET['box_type'] : 1;
$marginLeft = ceil($familyWidth/2);
//------------------------------------------------------------------------------------------------------------------------ //
//
// ------------------------------------------------------------------------------------------------------------------------ //
function AGhtml2rgb($color)
{
    if ($color[0] == '#')
        $color = substr($color, 1);

    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0].$color[1],
                                 $color[2].$color[3],
                                 $color[4].$color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
    else
        return false;

    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

    return array($r, $g, $b);
}
// ------------------------------------------------------------------------------------------------------------------------ //
function AGrgb2html($r, $g=-1, $b=-1)
{
    if (is_array($r) && sizeof($r) == 3)
        list($r, $g, $b) = $r;

    $r = intval($r); $g = intval($g);
    $b = intval($b);

    $r = dechex($r<0?0:($r>255?255:$r));
    $g = dechex($g<0?0:($g>255?255:$g));
    $b = dechex($b<0?0:($b>255?255:$b));

    $color = (strlen($r) < 2?'0':'').$r;
    $color .= (strlen($g) < 2?'0':'').$g;
    $color .= (strlen($b) < 2?'0':'').$b;
    return '#'.$color;
}
// ------------------------------------------------------------------------------------------------------------------------ //
// Input:
//   - $nr_linie (numarul liniei)
//   - $imagerefer (referinta imagini)
//   - $color (culoarea liniei)
//   - $pts (coordonatele punctelor)
//   - $lines (ce puncte trebuiesc unite)
//
function AG_DrawTheLine($pts, $imagerefer, $color)
{
	global $marginLeft;
	$point1 = $pts[0];
	$point2 = $pts[1];
	$x1 = $point1[0]+$marginLeft;
	$y1 = $point1[1];
	$x2 = $point2[0]+$marginLeft;
	$y2 = $point2[1];
	imageline($imagerefer, $x1, $y1, $x2, $y2, $color);
}
//
// Output:
//   Nu returneaza nimic, doar deseneaza linia
// ------------------------------------------------------------------------------------------------------------------------ //
//
//
// ------------------------------------------------------------------------------------------------------------------------ //
// Input:
//   - $array_linii (contine un array cu id-ul linilor ce trebuiesc afisate)
//   - $width (latimea imagini)
//   - $height (inaltimea imagini)
//
function AG_DrawStructure($width = 0, $height = 0, $PrintLines = array())
{
	global $colorLine, $box_type;
	
	$new_image = imagecreate($width, $height);
	$white = imagecolorallocate($new_image, 255, 255, 255);
	
	switch($box_type)
	{
		case 1: $colorRGB = AGhtml2rgb($colorLine); break;
		case 2: $colorRGB = AGhtml2rgb($colorLine); break;
		case 3: $colorRGB = AGhtml2rgb('DDD'); break;
	}
	$color_line = imagecolorallocate($new_image, $colorRGB[0], $colorRGB[1], $colorRGB[2]);
	
	imagecolortransparent($new_image, $white);
	
	imagesetthickness($new_image, 1);// grosimea liniei
	
	foreach($PrintLines as $pts)
	{
		AG_DrawTheLine($pts, $new_image, $color_line);
	}
	
	ob_start();
	header("Content-type: image/gif");
	imagegif($new_image);
	imagecolordeallocate($white);
	imagecolordeallocate($color_line1);
	imagedestroy($new_image);
	ob_end_flush();
}
//
// Output:
//   Nu returneaza nimic, doar creaza imaginea
// ------------------------------------------------------------------------------------------------------------------------ //
//
// ------------------------------------------------------------------------------------------------------------------------ //

// ------------------------------------------------------------------------------------------------------------------------ //
//
//
// ------------------------------------------------------------------------------------------------------------------------ //
$PrintLines = AG_Operation::FamilyLines(array($familyType, $familyAlign, $familyGrade, $familyChildren, array($familyWidth, $familyHeight), array($exRelatii, $exRelatieActiva), $option));
//print '<pre>'; var_export($PrintLines); exit;
AG_DrawStructure($familyWidth, $familyHeight, $PrintLines);
// ------------------------------------------------------------------------------------------------------------------------ //
?>