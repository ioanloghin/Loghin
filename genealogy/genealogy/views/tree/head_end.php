<?php
echo style(template, 'pages/tree.css')."\n";
echo style(template, 'jquery_ui/jquery.ui.all.css')."\n";
?>
<script type="text/javascript">
//<![CDATA[
var AGmyIDTree = <?php echo $AGmyIDTree;?>;
var AGmyIDFamily = <?php echo $AGmyIDFamily;?>;
var AGmyIDUser = <?php echo $AGmyIDUser;?>;
var AGmyIDRel = <?php echo $AGmyIDRel;?>;
var AGmyAdmin = <?php echo ($AGmyAdmin) ? 'true' : 'false';?>;
var AGmyPreview = <?php echo ($AGmyPreview) ? 'true' : 'false';?>;
//
// 	TIPUL 5: Familie de ascendenti
var AGFORMAT_T5_UBW = <?php echo AGFORMAT_T1_UBW;?>// user box width
var AGFORMAT_T5_UBW_ = <?php echo AGFORMAT_T1_UBW_;?>// user box width (la hover)
var AGFORMAT_T5_UBH = <?php echo AGFORMAT_T1_UBH;?>// user box height
var AGFORMAT_T5_P1_X = <?php echo AGFORMAT_T5_P1_X;?>// parinte 1, coordonata X
var AGFORMAT_T5_P2_X = <?php echo AGFORMAT_T5_P2_X;?>// parinte 2, coordonata X
var AGFORMAT_T5_P_Y = <?php echo AGFORMAT_T5_P_Y;?>// parinte afisat, coordonata Y
var AGFORMAT_T5_P_MB = <?php echo AGFORMAT_T5_P_MB;?>// parinte afisat, margin bottom
var AGFORMAT_T5_C_DIST = <?php echo AGFORMAT_T5_C_DIST;?>// distanta intre copii (recomand un nr. par)
var AGFORMAT_T5_C_Y = <?php echo AGFORMAT_T5_C_Y;?>// coordonata Y pentru copii
var AGFORMAT_T5_ET_W = <?php echo AGFORMAT_T1_ET_W;?>// eticheta, width
var AGFORMAT_T5_ET_H = <?php echo AGFORMAT_T1_ET_H;?>// eticheta, height
var AGFORMAT_T5_ET_X = <?php echo AGFORMAT_T5_ET_X;?>// eticheta, coordonata X
var AGFORMAT_T5_ET_Y = <?php echo AGFORMAT_T5_ET_Y;?>// eticheta, coordonata Y
var AGFORMAT_T5_H = <?php echo AGFORMAT_T5_H;?>;// inaltime family 5
//
//
var AGFamilyMembers = new Array();
<?php 
foreach($arrayFamilyObj as $id_family => $family_obj)
{
	if($family_obj->identifier['this'] || $family_obj->identifier['this'] == '0')
	{
		echo 'AGFamilyMembers[\''.$family_obj->identifier['this'].'\'] = new Array();'."\n";
		
		echo 'AGFamilyMembers[\''.$family_obj->identifier['this'].'\'][1] = ';
		if($family_obj->members_ref[1])
			echo $family_obj->members_ref[1]->member_id();
		else
			echo 0;
		echo ";\n";
		
		echo 'AGFamilyMembers[\''.$family_obj->identifier['this'].'\'][2] = ';
		if($family_obj->members_ref[2])
			echo $family_obj->members_ref[2]->member_id();
		else
			echo 0;
		echo ";\n";
		
		foreach($family_obj->members_ref[3] as $key => $userbox)
		{
			echo 'AGFamilyMembers[\''.$family_obj->identifier['this'].'\'][3] = ';
			if($userbox)
				echo $userbox->member_id();
			else
				echo 0;
			echo ";\n";
		}
		
		echo 'AGFamilyMembers[\''.$family_obj->identifier['this'].'\'][\'c\'] = '.$family_obj->count_children.";\n";
		echo 'AGFamilyMembers[\''.$family_obj->identifier['this'].'\'][\'asc\'] = "'.$family_obj->identifier['asc'].'";'."\n";
		echo 'AGFamilyMembers[\''.$family_obj->identifier['this'].'\'][\'desc\'] = new Array();'."\n";
		echo 'AGFamilyMembers[\''.$family_obj->identifier['this'].'\'][\'desc\'][1] = "'.$family_obj->identifier['desc'][1].'";'."\n";
		echo 'AGFamilyMembers[\''.$family_obj->identifier['this'].'\'][\'desc\'][2] = "'.$family_obj->identifier['desc'][2].'";'."\n";
	}
}
?>
//
//
var AGMembers = new Array();
<?php
function members_js_info(&$member_obj)
{
	// Atentie! lucreaza cu membrul original pentru a fi mai rapida
	// dar nu-i aplica modificari lui $member_obj
	//
	$return = NULL;
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'] = new Array();'."\n";
		
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'internalRelation\'] = new Array();'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'internalRelation\'][\'id\'] = '.$member_obj->internalRelation['id'].';'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'internalRelation\'][\'index\'] = '.$member_obj->internalRelation['index'].';'."\n";
	
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'thisFamily\'] = new Array();'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'thisFamily\'][\'id\'] = '.$member_obj->family_obj['ids']['this'].';'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'thisFamily\'][\'type\'] = '.$member_obj->family_obj['recognition']['type'].';'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'thisFamily\'][\'align\'] = "'.$member_obj->family_obj['recognition']['align'].'";'."\n";
	
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'ascFamily\'] = new Array();'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'ascFamily\'][\'id\'] = '.$member_obj->ascFamily['id'].';'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'ascFamily\'][\'identifier\'] = "'.$member_obj->ascFamily['identifier'].'";'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'ascFamily\'][\'checked\'] = "'.$member_obj->ascFamily['checked'].'";'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'ascFamily\'][\'readonly\'] = "'.$member_obj->ascFamily['readonly'].'";'."\n";
	
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'descFamily\'] = new Array();'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'descFamily\'][\'id\'] = '.$member_obj->descFamily['id'].';'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'descFamily\'][\'identifier\'] = "'.$member_obj->descFamily['identifier'].'";'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'descFamily\'][\'checked\'] = "'.$member_obj->descFamily['checked'].'";'."\n";
	$return .= 'AGMembers[\''.$member_obj->member_id().'\'][\'descFamily\'][\'readonly\'] = "'.$member_obj->descFamily['readonly'].'";'."\n";
	
	return $return;
}

foreach($arrayFamilyObj as $id_family => $family_obj)
{
	if($family_obj->members_ref[1])
		echo members_js_info($family_obj->members_ref[1]);
	
	if($family_obj->members_ref[2])
		echo members_js_info($family_obj->members_ref[2]);
	
	foreach($family_obj->members_ref[3] as $key => $userbox)
		echo members_js_info($userbox);
}
?>
//]]>
</script>
<?php
echo script('harmony', 'AG_Interaction.js')."\n";
echo script('harmony', 'jquery_ui/jquery.ui.core.js')."\n";
echo script('harmony', 'jquery_ui/jquery.ui.widget.js')."\n";
echo script('harmony', 'jquery_ui/jquery.ui.mouse.js')."\n";
echo script('harmony', 'jquery_ui/jquery.ui.draggable.js')."\n";
?>
<script>
$(function() {
    //$( "#draggable" ).draggable({ handle: "p" });
    $( "#AGDynamic" ).draggable({ cancel: "div.ag_userbox, div.ag_tagbox" });
    //$( "div, p" ).disableSelection();
});
</script>
<?php echo $pageStyle;?>
</head>

<body>
<div id="AG_PageMask" onClick="quickEditUser('close', 0)"></div>