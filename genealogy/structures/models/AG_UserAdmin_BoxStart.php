<?php
$check_ajax = (isset($_GET['ajax'])) ? TRUE : FALSE;
if($check_ajax)
{
	define('ANTIHACK', TRUE);
	include_once('../system/helpers/includes.php');
	include_once('../system/helpers/url.php');
	script_include('[vital]', '../');
	// ----------------------------------------------------
	
	$operation = (isset($_GET['operation'])) ? AntiHack::filtru($_GET['operation']) : NULL;
	
	$local_INFO = array();
	$local_INFO[DBT_USER_INFO_C2] = (isset($_GET['CREATE_firstname'])) ? AntiHack::filtru($_GET['CREATE_firstname']) : NULL;
	$local_INFO[DBT_USER_INFO_C3] = (isset($_GET['CREATE_lastname'])) ? AntiHack::filtru($_GET['CREATE_lastname']) : NULL;
	$local_INFO[DBT_USER_INFO_C4] = (isset($_GET['CREATE_gender']) && is_numeric($_GET['CREATE_gender'])) ? intval($_GET['CREATE_gender']) : 0;
	$local_INFO[DBT_USER_INFO_C5] = (isset($_GET['CREATE_image'])) ? AntiHack::filtru($_GET['CREATE_image'], 2) : NULL;
	$local_INFO[DBT_USER_INFO_C6] = (isset($_GET['CREATE_born'])) ? AntiHack::filtru($_GET['CREATE_born'], 2) : NULL;
	$local_INFO[DBT_USER_INFO_C7] = (isset($_GET['CREATE_deces'])) ? AntiHack::filtru($_GET['CREATE_deces'], 2) : NULL;
	$local_INFO['id'] = (isset($_GET['CREATE_deces'])) ? AntiHack::filtru($_GET['CREATE_deces'], 2) : NULL;
	
	$HTMLcode = NULL;
}
else
{
	$operation = NULL;
	$local_INFO = array();
	$local_INFO = $this->my['info'];
	$local_INFO['id'] = $this->my['id_user'];
}
// ------------------------------------------------------------------------------------------------------------------------ //
//
if(!$check_ajax)
	$HTMLcode .= '<div id="quickEditUserStart" class="quickEditUser">';

switch($operation)
{
	default:
		$print_name = (isset($local_INFO[DBT_USER_INFO_C2])) ? $local_INFO[DBT_USER_INFO_C2].' '.$local_INFO[DBT_USER_INFO_C3] : NULL;
		$print_image = (isset($local_INFO[DBT_USER_INFO_C5])) ? str_replace('thumbs/', 'medium/', $local_INFO[DBT_USER_INFO_C5]) : 'design/imagini/no_image.jpg';
		
		$HTMLcode .= '<div class="topMiniBox1"><a id="quickEditUserBTcreate" class="topMiniBox_BT1" onclick="return UserAdmin_duplicateBox(\'open\', \'create\');"><span class="icon">&nbsp;</span>User nou</a></div>';
		$HTMLcode .= '<div class="topMiniBox2"><span>'.$print_name.'</span></div>';
		$HTMLcode .= '<div class="topMiniBox3"><a id="quickEditUserBTimport" class="topMiniBox_BT2" onclick="return UserAdmin_duplicateBox(\'open\', \'import\');"><span class="icon">&nbsp;</span>Import&#259;</a></div>';
		$HTMLcode .= '<div class="cleft"></div>';
		$HTMLcode .= '<div class="topMiniBox4">';
		$HTMLcode .= '<div class="topMiniBox4_img"><img src="'.ROOT.$print_image.'" width="115" height="115" alt="" /><a href="#">( Vezi profilul )</a></div>';
		$HTMLcode .= '<div class="topMiniBox4_details">';
		$HTMLcode .= '<div class="topMiniBox4_details_c1">Nascut: <strong>24 martie 1973</strong><br />Varsta: <strong>38 ani</strong><br /></div>';
		$HTMLcode .= '<div class="topMiniBox4_details_c2">Tara: <strong>Romania</strong><br />Oras: <strong>Timisoara</strong><br /></div>';
		$HTMLcode .= '<div class="cleft"></div>';
		$HTMLcode .= '<div class="topMiniBox4_details_c3">Dr. Sheldon Cooper este un personaj fictiv din serialul Teoria Big Bang, jucat de actorul Jim Parsons. El este cel mai bun prieten, si colegul de camera, al lui Leonard Hofstadter.</div>';
		$HTMLcode .= '</div>';
		$HTMLcode .= '</div>';
		if($local_INFO['id'] > 0)
		{
			$HTMLcode .= '<div class="topMiniBox5"><a href="#">Modific&#259; datele</a></div>';
			$HTMLcode .= '<div class="topMiniBoxSep"></div>';
			$HTMLcode .= '<div class="topMiniBox6"><a href="#">&#350;terge utilizatorul</a></div>';
		}
		else
		{
			$HTMLcode .= '<div class="topMiniBox5"><span>Modific&#259; datele</span></div>';
			$HTMLcode .= '<div class="topMiniBoxSep"></div>';
			$HTMLcode .= '<div class="topMiniBox6"><span>&#350;terge utilizatorul</span></div>';
		}
		$HTMLcode .= '<div class="cleft"></div>';
		break;
}
if(!$check_ajax)
{
	$HTMLcode .= '</div>';
	unset($local_INFO);
}

if($check_ajax)
	echo $HTMLcode;
	
unset($check_ajax);
?>