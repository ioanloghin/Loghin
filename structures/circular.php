<?php
function DrawTextArc($str, $aStart, $aEnd, $iRadius, $bCCW) 
{
	 $nFont = 5; 
	  
	 // create image to store each character 
	 $xFont = imagefontwidth($nFont); 
	 $yFont = imagefontheight($nFont); 
	 $imgChar = imagecreatetruecolor($xFont, $yFont); 
	 // create overall image 
	 $iCentre = $iRadius + max($xFont, $yFont); 
	 $img = imagecreatetruecolor(2 * $iCentre, 2 * $iCentre); 
	 // sort out colours 
	 $colBG = imagecolorallocate($img, 255, 255, 255); 
	 $colBGchar = imagecolorallocate($imgChar, 255, 255, 255); 
	 $colFGchar = imagecolorallocate($imgChar, 0, 0, 0); 
	 imagefilledrectangle($img, 0, 0, 2 * $iCentre, 2 * $iCentre, $colBG); 
	  
	 // arrange angles depending on direction of rotation 
	 if ($bCCW) 
	 { 
			 while ($aEnd < $aStart) 
			 { 
					 $aEnd += 360; 
			 } 
	 } 
	 else 
	 { 
			 while ($aEnd > $aStart) 
			 { 
					 $aEnd -= 360; 
			 } 
	 } 
	  
	 $len = strlen($str); 

	// draw each character individually 
	 for ($i = 0; $i < $len; $i++) 
	 { 
			 // calculate angle along arc 
			 $a = ($aStart * ($len - 1 - $i) + $aEnd * $i) / ($len - 1); 
	  
			 // draw individual character 
			 imagefilledrectangle($imgChar, 0, 0, $xFont, $yFont, $colBGchar); 
			 imagestring($imgChar, $nFont, 0, 0, $str[$i], $colFGchar); 
	  
			 // rotate character 
			 $imgTemp = imagerotate($imgChar, (int)$a + 90 * ($bCCW ? 1 : -1), $colBGchar); 
			 $xTemp = imagesx($imgTemp); 
			 $yTemp = imagesy($imgTemp); 
	  
			 // copy to main image 
			 imagecopy($img, $imgTemp, 
				$iCentre + $iRadius * cos(deg2rad($a)) - ($xTemp / 2), 
				$iCentre - $iRadius * sin(deg2rad($a)) - ($yTemp / 2), 
				0, 0, $xTemp, $yTemp); 
	 } 
	  
	 return $img;
} 

$string = (isset($_GET['up'])) ? $_GET['up'] : 'Please insert text up';
$s = strlen($string)*4;// lungime string
$r = 200;// raza
$q = 2 * asin( $s/(2*$r) );// masura unghi (in grade)
$arc = (int)($q * $r);// lungimea arcului de cerc (in grade)

$start = (int)(90 + $arc/2);
$end   = (int)(90 - $arc/2);

$img = DrawTextArc($string, $start, $end, $r, false);

// output the image 
 header("Content-type: image/jpeg"); 
 imagejpeg($img);
/*

$text = "Global Search System Tehnology";
$image = imagecreatetruecolor(400,400);
$white = imagecolorallocate($image,255,255,255);
imagefill($image,0,0,$white);
$red = imagecolorallocate($image,255,0,0);

$degrees = ceil(120/strlen($text));// lungime
for($i=0;$i<strlen($text);$i++)
{
	$a = ($degrees*$i)+120;// start
	$cos = cos(deg2rad($a));
	$sin = sin(deg2rad($a));
	$x = 0;
	$y = 180;// raza
	$xt = round($cos*($x) - $sin*($y));
	$yt = round($sin*($x) + $cos*($y));
	imagettftext($image,16,180-($a),200+$xt,200+$yt,$red,"/arial.ttf",$text[$i]);
}

header("Content-type: image/jpeg");
imagejpeg($image,"",100);
imagedestroy($image);*/

?>