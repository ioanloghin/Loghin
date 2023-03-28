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
{
	$HTMLcode .= '<div id="quickEditUserImport" class="quickEditUser qEUBlue">';
		$HTMLcode .= '<div id="boxLink1" class="boxLink"></div>';
		$HTMLcode .= '<div class="topMiniBox1"><a class="topMiniBox_BT2_" style="margin-left:2px;" onclick="return UserAdmin_duplicateBox(\'close\', \'import\');"><span class="icon">&nbsp;</span>Import&#259;</a></div>';
		$HTMLcode .= '<div class="topMiniBox2"><span>&nbsp;</span></div>';
		$HTMLcode .= '<div class="topMiniBox3">&nbsp;</div>';
		$HTMLcode .= '<div class="cleft"></div>';
		$HTMLcode .= '<div id="quickEditUserImport_Fix" class="topMiniBox4">';
}

switch($operation)
{
	default:
        $HTMLcode .= '<form method="post" action="" onsubmit="return UserAdmin_operation(\'IMPORT_S\');">';
        $HTMLcode .= '<fieldset>';
		$HTMLcode .= '<input id="QEI_radioH" type="hidden" name="qs_gender" value="3" />';
		
		$HTMLcode .= '<div class="qcb-input-box" style="margin-left:15px; margin-top:0px;">';
        $HTMLcode .= '<label>Nume:</label>';
        $HTMLcode .= '<span class="qcb-input-left">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-center"><input id="CREATE_firstname" type="text" name="qs_firstname" style="width:160px;" maxlength="30" value="" /></span>';
        $HTMLcode .= '<span class="qcb-input-right">&nbsp;</span>';
        $HTMLcode .= '</div>';
		
		$HTMLcode .= '<div class="qcb-input-box" style="margin-left:15px; margin-top:0px;">';
        $HTMLcode .= '<label>Prenume:</label>';
        $HTMLcode .= '<span class="qcb-input-left">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-center"><input id="CREATE_lastname" type="text" name="qs_lastname" style="width:185px;" maxlength="30" value="" /></span>';
        $HTMLcode .= '<span class="qcb-input-right">&nbsp;</span>';
        $HTMLcode .= '</div>';
		
		$HTMLcode .= '<div class="qcb-input-box" style="margin-left:15px; height:35px; margin-top:0px; width:170px; padding-top:4px;">';
        $HTMLcode .= '<label style="padding-bottom:8px; display:block;">Sex:</label>';
        $HTMLcode .= '<span id="QEI_radio1" class="ag-inputRadio1'.(($_SESSION[SESSION]['quickCreate']['copil']['gender'] == 1) ? '-active' : '').'" onclick="changeFancyRadio(3, \'QEI_radio\', 1, \'QEI_radioH\');">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(3, \'QEI_radio\', 1, \'QEI_radioH\');">M</span>';
        $HTMLcode .= '<span id="QEI_radio2" class="ag-inputRadio1'.(($_SESSION[SESSION]['quickCreate']['copil']['gender'] == 2) ? '-active' : '').'" onclick="changeFancyRadio(3, \'QEI_radio\', 2, \'QEI_radioH\');" style="margin-left:15px;">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(3, \'QEI_radio\', 2, \'QEI_radioH\');">F</span>';
		$HTMLcode .= '<span id="QEI_radio3" class="ag-inputRadio1'.(($_SESSION[SESSION]['quickCreate']['copil']['gender'] == 3) ? '-active' : '').'" onclick="changeFancyRadio(3, \'QEI_radio\', 3, \'QEI_radioH\');" style="margin-left:15px;">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(3, \'QEI_radio\', 3, \'QEI_radioH\');">?</span>';
        $HTMLcode .= '</div>';
		
		$HTMLcode .= '<div class="qcb-input-box" style="margin-left:15px; margin-top:5px;">';
        $HTMLcode .= '<label>Varsta:</label>';
        $HTMLcode .= '<span class="qcb-input-left">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-center"><input type="text" name="qs_age" style="width:40px;" maxlength="3" value="" /></span>';
        $HTMLcode .= '<span class="qcb-input-right">&nbsp;</span>';
        $HTMLcode .= '</div>';
		
		$HTMLcode .= '<div class="qcb-input-box" style="margin-left:15px; margin-top:5px;">';
        $HTMLcode .= '<label>Decedat:</label>';
        $HTMLcode .= '<input type="checkbox" name="qs_age" value="1" />';
        $HTMLcode .= '</div>';
		
        $HTMLcode .= '</fieldset>';
        $HTMLcode .= '</form>';
		break;
	case 'IMPORT_S':
		$HTMLcode .= '<form method="post" action="" onsubmit="return UserAdmin_operation(\'IMPORT_T\');">';
        $HTMLcode .= '<fieldset>';
        $HTMLcode .= '<input id="CREATE_firstname" type="hidden" name="'.DBT_USER_INFO_C2.'" value="'.$CREATE[DBT_USER_INFO_C2].'" />';
		$HTMLcode .= '<input id="CREATE_lastname" type="hidden" name="'.DBT_USER_INFO_C3.'" value="'.$CREATE[DBT_USER_INFO_C3].'" />';
		$HTMLcode .= '<input id="CREATE_gender" type="hidden" name="'.DBT_USER_INFO_C4.'" value="'.$CREATE[DBT_USER_INFO_C4].'" />';
		$HTMLcode .= '<input id="CREATE_image" type="hidden" name="'.DBT_USER_INFO_C5.'" value="'.$CREATE[DBT_USER_INFO_C5].'" />';
		$HTMLcode .= '<input id="CREATE_born" type="hidden" name="'.DBT_USER_INFO_C6.'" value="'.$CREATE[DBT_USER_INFO_C6].'" />';
		$HTMLcode .= '<input id="CREATE_deces" type="hidden" name="'.DBT_USER_INFO_C7.'" value="'.$CREATE[DBT_USER_INFO_C7].'" />';
        $HTMLcode .= '</fieldset>';
        $HTMLcode .= '</form>';
		break;
	case 'IMPORT_T':
        $HTMLcode .= '<form method="post" action="" onsubmit="return false;">';
        $HTMLcode .= '<fieldset>';
        $HTMLcode .= '<input id="CREATE_firstname" type="text" name="'.DBT_USER_INFO_C2.'" value="" />';
		$HTMLcode .= '<input id="CREATE_lastname" type="text" name="'.DBT_USER_INFO_C3.'" value="" />';
        $HTMLcode .= '<button type="submit">Creaza</button>';
        $HTMLcode .= '</fieldset>';
        $HTMLcode .= '</form>';
		break;
}
if(!$check_ajax)
{
		$HTMLcode .= '</div>';
		$HTMLcode .= '<div class="cleft"></div>';
	
	$HTMLcode .= '<div class="topMiniBox5"><a href="#">Porne&#351;te cautarea</a></div>';
	$HTMLcode .= '<div class="topMiniBoxSep"></div>';
	$HTMLcode .= '<div class="topMiniBox6"><span>Transfer&#259; utilizatorul</span></div>';
	
	$HTMLcode .= '</div>';
	unset($local_INFO);
}

if($check_ajax)
	echo $HTMLcode;
	
unset($check_ajax);
?>