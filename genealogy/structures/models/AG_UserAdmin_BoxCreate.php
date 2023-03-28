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
	
	$GLOBAL = array();
	$GLOBAL['id_tree'] = (isset($_GET['GLOBAL_id_tree']) && is_numeric($_GET['GLOBAL_id_tree'])) ? intval($_GET['GLOBAL_id_tree']) : 0;
	$GLOBAL['id_family'] = (isset($_GET['GLOBAL_id_family']) && is_numeric($_GET['GLOBAL_id_family'])) ? intval($_GET['GLOBAL_id_family']) : 0;
	$GLOBAL['id_user'] = (isset($_GET['GLOBAL_id_user']) && is_numeric($_GET['GLOBAL_id_user'])) ? intval($_GET['GLOBAL_id_user']) : 0;
	$GLOBAL['internal_relation'] = (isset($_GET['GLOBAL_internal_relation']) && is_numeric($_GET['GLOBAL_internal_relation'])) ? intval($_GET['GLOBAL_internal_relation']) : 0;
	
	$ADD = array();
	$ADD['id_family'] = (isset($_GET['ADD_id_family']) && is_numeric($_GET['ADD_id_family'])) ? intval($_GET['ADD_id_family']) : 0;
	$ADD['id_user'] = (isset($_GET['ADD_id_user']) && is_numeric($_GET['ADD_id_user'])) ? intval($_GET['ADD_id_user']) : 0;
	$ADD['internal_relation'] = (isset($_GET['ADD_internal_relation']) && is_numeric($_GET['ADD_internal_relation'])) ? intval($_GET['ADD_internal_relation']) : 0;
	$ADD['linked_id_user'] = (isset($_GET['ADD_linked_id_user']) && is_numeric($_GET['ADD_linked_id_user'])) ? intval($_GET['ADD_linked_id_user']) : 0;
	$ADD['linked_direction'] = (isset($_GET['ADD_linked_direction'])) ? $_GET['ADD_linked_direction'] : NULL;
	
	$local_INFO = array();
	$local_INFO[DBT_USER_INFO_C2] = (isset($_GET['CREATE_firstname'])) ? AntiHack::filtru($_GET['CREATE_firstname']) : NULL;
	$local_INFO[DBT_USER_INFO_C3] = (isset($_GET['CREATE_lastname'])) ? AntiHack::filtru($_GET['CREATE_lastname']) : NULL;
	$local_INFO[DBT_USER_INFO_C4] = (isset($_GET['CREATE_gender']) && is_numeric($_GET['CREATE_gender'])) ? intval($_GET['CREATE_gender']) : 0;
	$local_INFO[DBT_USER_INFO_C5] = (isset($_GET['CREATE_image'])) ? AntiHack::filtru($_GET['CREATE_image'], 2) : NULL;
	$local_INFO[DBT_USER_INFO_C6] = (isset($_GET['CREATE_born'])) ? AntiHack::filtru($_GET['CREATE_born'], 2) : NULL;
	$local_INFO[DBT_USER_INFO_C7] = (isset($_GET['CREATE_deces'])) ? AntiHack::filtru($_GET['CREATE_deces'], 2) : NULL;
	$local_INFO['id'] = (isset($_GET['CREATE_deces'])) ? AntiHack::filtru($_GET['CREATE_deces'], 2) : NULL;
	
	// SE CREAZA OBIECTUL -------------------------------------------------------------------- //
	$user_action = new AG_UserAdmin($GLOBAL['id_tree'], $GLOBAL['id_family'], $GLOBAL['id_user'], $GLOBAL['internal_relation']);
	// memoram id-ul administratorului
	$user_action->set_admin($_SESSION[SESSION]['user']['id']);
	// memoram datele utilizatorului de legatura
	if($ADD['linked_id_user'])
		$user_action->set_linked($ADD['linked_id_user'], $ADD['linked_direction']);
	// --------------------------------------------------------------------------------------- //
	
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
	$HTMLcode .= '<div id="quickEditUserCreate" class="quickEditUser qEURed">';
		$HTMLcode .= '<div id="boxLink2" class="boxLink"></div>';
		$HTMLcode .= '<div class="topMiniBox1">&nbsp;</div>';
		$HTMLcode .= '<div class="topMiniBox2"><span>&nbsp;</span></div>';
		$HTMLcode .= '<div class="topMiniBox3"><a class="topMiniBox_BT1_" style="margin-left:15px;" onclick="return UserAdmin_duplicateBox(\'close\', \'create\');"><span class="icon">&nbsp;</span>User nou</a>';
		//$HTMLcode .= '<br /><a id="topMiniBox_BTransfer1" class="topMiniBox_BT1_d" style="margin-left:15px; margin-top:-5px;" onclick="return UserAdmin_duplicateBox(\'close\', \'create\');"><span class="icon">&nbsp;</span>Transfer&#259;</a>';
		$HTMLcode .= '</div>';
		$HTMLcode .= '<div class="cleft"></div>';
		$HTMLcode .= '<div id="quickEditUserCreate_Fix" class="topMiniBox4">';
}

switch($operation)
{
	default:
	case 'CREATE_T':
        $HTMLcode .= '<form method="post" action="" onsubmit="return UserAdmin_operation(\'CREATE\');">';
        $HTMLcode .= '<fieldset>';
		$HTMLcode .= '<input id="QEC_radioH" type="hidden" name="qs_gender" value="3" />';
		
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
        $HTMLcode .= '<span id="QEC_radio1" class="ag-inputRadio1'.(($_SESSION[SESSION]['quickCreate']['copil']['gender'] == 1) ? '-active' : '').'" onclick="changeFancyRadio(3, \'QEC_radio\', 1, \'QEC_radioH\');">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(3, \'QEC_radio\', 1, \'QEC_radioH\');">M</span>';
        $HTMLcode .= '<span id="QEC_radio2" class="ag-inputRadio1'.(($_SESSION[SESSION]['quickCreate']['copil']['gender'] == 2) ? '-active' : '').'" onclick="changeFancyRadio(3, \'QEC_radio\', 2, \'QEC_radioH\');" style="margin-left:15px;">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(3, \'QEC_radio\', 2, \'QEC_radioH\');">F</span>';
		$HTMLcode .= '<span id="QEC_radio3" class="ag-inputRadio1'.(($_SESSION[SESSION]['quickCreate']['copil']['gender'] == 3) ? '-active' : '').'" onclick="changeFancyRadio(3, \'QEC_radio\', 3, \'QEC_radioH\');" style="margin-left:15px;">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(3, \'QEC_radio\', 3, \'QEC_radioH\');">?</span>';
        $HTMLcode .= '</div>';
		
		$HTMLcode .= '<div class="qcb-input-box" style="margin-left:15px; margin-top:5px;">';
        $HTMLcode .= '<label>Data na&#351;terii (ziua/luna/anul):</label>';
        $HTMLcode .= '<span class="qcb-input-left">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-center"><input type="text" name="mama_born_dd" style="width:45px;" maxlength="2" value="" /></span>';
        $HTMLcode .= '<span class="qcb-input-right">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-left" style="margin-left:5px;">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-center"><input type="text" name="mama_born_mm" style="width:45px;" maxlength="2" value="" /></span>';
        $HTMLcode .= '<span class="qcb-input-right">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-left" style="margin-left:5px;">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-center"><input type="text" name="mama_born_yy" style="width:65px;" maxlength="4" value="" /></span>';
        $HTMLcode .= '<span class="qcb-input-right">&nbsp;</span>';
        $HTMLcode .= '</div>';
		
		$HTMLcode .= '<div class="qcb-input-box" style="margin-left:15px; margin-top:5px;">';
        $HTMLcode .= '<label>Imagine:</label>';
        $HTMLcode .= '<span class="qcb-input-left">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-center"><input id="CREATE_firstname" type="file" name="qs_firstname" style="width:160px;" maxlength="30" value="" /></span>';
        $HTMLcode .= '<span class="qcb-input-right">&nbsp;</span>';
        $HTMLcode .= '</div>';
		
		$HTMLcode .= '<div class="qcb-input-box" style="margin-left:15px; margin-top:5px;">';
        $HTMLcode .= '<label>Decedat (ziua/luna/anul):</label>';
        $HTMLcode .= '<span class="qcb-input-left">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-center"><input type="text" name="mama_born_dd" style="width:45px;" maxlength="2" value="" /></span>';
        $HTMLcode .= '<span class="qcb-input-right">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-left" style="margin-left:5px;">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-center"><input type="text" name="mama_born_mm" style="width:45px;" maxlength="2" value="" /></span>';
        $HTMLcode .= '<span class="qcb-input-right">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-left" style="margin-left:5px;">&nbsp;</span>';
        $HTMLcode .= '<span class="qcb-input-center"><input type="text" name="mama_born_yy" style="width:65px;" maxlength="4" value="" /></span>';
        $HTMLcode .= '<span class="qcb-input-right">&nbsp;</span>';
        $HTMLcode .= '</div>';
		
		
		$HTMLcode .= '<div class="cleft"></div>';
		
        $HTMLcode .= '</fieldset>';
        $HTMLcode .= '</form>';
		break;
	case 'CREATE':
		$HTMLcode .= '<form method="post" action="" onsubmit="return false;">';
        $HTMLcode .= '<fieldset>';
        $HTMLcode .= '<input id="CREATE_firstname" type="hidden" name="'.DBT_USER_INFO_C2.'" value="'.$local_INFO[DBT_USER_INFO_C2].'" />';
		$HTMLcode .= '<input id="CREATE_lastname" type="hidden" name="'.DBT_USER_INFO_C3.'" value="'.$local_INFO[DBT_USER_INFO_C3].'" />';
		$HTMLcode .= '<input id="CREATE_gender" type="hidden" name="'.DBT_USER_INFO_C4.'" value="'.$local_INFO[DBT_USER_INFO_C4].'" />';
		$HTMLcode .= '<input id="CREATE_image" type="hidden" name="'.DBT_USER_INFO_C5.'" value="'.$local_INFO[DBT_USER_INFO_C5].'" />';
		$HTMLcode .= '<input id="CREATE_born" type="hidden" name="'.DBT_USER_INFO_C6.'" value="'.$local_INFO[DBT_USER_INFO_C6].'" />';
		$HTMLcode .= '<input id="CREATE_deces" type="hidden" name="'.DBT_USER_INFO_C7.'" value="'.$local_INFO[DBT_USER_INFO_C7].'" />';
        $HTMLcode .= '</fieldset>';
        $HTMLcode .= '</form>';
		break;
}
if(!$check_ajax)
{
		$HTMLcode .= '</div>';
		$HTMLcode .= '<div class="cleft"></div>';
	
	$HTMLcode .= '<div class="topMiniBox5" id="BUT_QE_A1"><a id="BUT_QE_A1-C" href="#" onclick="return UserAdmin_operation(\'CREATE\');">Creaz&#259; utilizatorul</a></div>';
	$HTMLcode .= '<div class="topMiniBoxSep"></div>';
	$HTMLcode .= '<div class="topMiniBox6" id="BUT_QE_A2"><span id="BUT_QE_A2-C">Transfer&#259; utilizatorul</span></div>';
	
	$HTMLcode .= '</div>';
	unset($local_INFO);
}

if($check_ajax)
	echo $HTMLcode;

unset($check_ajax);
?>