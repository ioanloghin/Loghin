<?php
// includem configurarile ------------------------------------------------------------------------------------------------ //
if(isset($_GET['AGajax']))
{
	define('ANTIHACK', TRUE);
	require('../codes/functii/script_include.php');
	script_include('[vital]', '../');
	// ----------------------------------------------------
	$AGmyIDTree = (isset($_GET['my_id_tree']) && is_numeric($_GET['my_id_tree'])) ? intval($_GET['my_id_tree']) : 0;
	$AGmyIDUser = (isset($_GET['my_id_user']) && is_numeric($_GET['my_id_user'])) ? intval($_GET['my_id_user']) : 0;
	$AGmyIDFamily = (isset($_GET['my_id_family']) && is_numeric($_GET['my_id_family'])) ? intval($_GET['my_id_family']) : 0;
	$AGmyIDRel = (isset($_GET['my_id_rel']) && is_numeric($_GET['my_id_rel'])) ? intval($_GET['my_id_rel']) : 0;
	$AGmyAdmin = (isset($_GET['AGmyAdmin'])) ? TRUE : FALSE;
	if(isset($_SESSION[SESSION]['AGmyView'][$AGmyIDTree.$AGmyIDFamily]))
	{
		$_SESSION[SESSION]['AGmyView'][$AGmyIDTree.$AGmyIDFamily] = array(
			'view_asc' => 1,
			'view_desc' => 1
		);
	}
}
$ADD = array();
$ADD['id_family'] = (isset($_GET['ADD_id_family']) && is_numeric($_GET['ADD_id_family'])) ? intval($_GET['ADD_id_family']) : 0;
$ADD['id_user'] = (isset($_GET['ADD_id_user']) && is_numeric($_GET['ADD_id_user'])) ? intval($_GET['ADD_id_user']) : 0;
$ADD['internal_relation'] = (isset($_GET['ADD_internal_relation']) && is_numeric($_GET['ADD_internal_relation'])) ? intval($_GET['ADD_internal_relation']) : 0;
$ADD['linked_id_user'] = (isset($_GET['ADD_linked_id_user']) && is_numeric($_GET['ADD_linked_id_user'])) ? intval($_GET['ADD_linked_id_user']) : 0;
$ADD['linked_direction'] = (isset($_GET['ADD_linked_direction'])) ? $_GET['ADD_linked_direction'] : NULL;

//print '<pre>'; var_export($_SESSION[SESSION]['admin_config']['my']); print '</pre>';
// ------------------------------------------------------------------------------------------------------------------------ //
if($MyUser->logged() || $ADD['id_user'])
{
	$infoUser = array();
	if($AGmyIDUser > 0)
	{
		$temp = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C1."` = '$AGmyIDUser'", NULL, 0, 1);
		$infoUser['fullname'] = (isset($temp[1][DBT_USER_INFO_C2]) && isset($temp[1][DBT_USER_INFO_C3])) ? fullname($temp[1][DBT_USER_INFO_C2], $temp[1][DBT_USER_INFO_C3], 15) : NULL;
		$infoUser['image'] = (isset($temp[1][DBT_USER_INFO_C5]) && $temp[1][DBT_USER_INFO_C5]) ? str_replace('thumbs/', 'medium/', $temp[1][DBT_USER_INFO_C5]) : DEFAULT_PROFILE_IMG;
		$infoUser['age'] = (isset($temp[1][DBT_USER_INFO_C6]) and $temp[1][DBT_USER_INFO_C6] != NULL and $temp[1][DBT_USER_INFO_C6] != '0000-00-00') ? DataTime::age($temp[1][DBT_USER_INFO_C6]).' ani, ' : NULL;
		$infoUser['city'] = (isset($temp[1][DBT_USER_INFO_C8])) ? $temp[1][DBT_USER_INFO_C8] : NULL;
		$infoUser['country'] = (isset($temp[1][DBT_USER_INFO_C9])) ? $temp[1][DBT_USER_INFO_C9] : NULL;
		unset($temp);
	}
	else
	{
		$infoUser['fullname'] = 'Undefined profile';
		$infoUser['image'] = NULL;
		$infoUser['age'] = NULL;
		$infoUser['city'] = NULL;
		$infoUser['country'] = NULL;
	}
	
	// SE CREAZA OBIECTUL -------------------------------------------------------------------- //
	$user_action = new AG_PoP2($AGmyIDTree, $AGmyIDFamily, $AGmyIDUser, $AGmyIDRel);
	// memoram id-ul administratorului
	$user_action->set_admin($_SESSION[SESSION]['user']['id']);
	// memoram datele utilizatorului de legatura
	if($ADD['linked_id_user'])
		$user_action->set_linked($ADD['linked_id_user'], $ADD['linked_direction']);
	// SE FACE AFISAREA ---------------------------------------------------------------------- //
	
	// SE DISTRUGE OBIECTUL ------------------------------------------------------------------ //
	unset($user_action);
	//
	//
	// start afisare profil ------------------------------------------------------------------ //
	echo '<div class="tipicalBox">';
    	echo '<input type="hidden" id="hiddenAGmyIDUser" name="hiddenAGmyIDUser" value="'.$AGmyIDUser.'" />';
		echo '<div class="h10"></div>';
		
		echo '<span class="aglb-bigTitle">'.$infoUser['fullname'].'</span>';
		echo '<span class="subTitle">'.$infoUser['age'].''.$infoUser['city'].' '.$infoUser['country'].'&nbsp;</span>';
		echo '<div class="h10"></div>';
		$img_src = ($infoUser['image']) ? $infoUser['image'] : 'design/imagini/no_image.jpg';
		echo '<div class="agimgmask" style="width:150px;"><img src="'.ROOT.$img_src.'" width="146" alt="" /></div>';
		
		if($AGmyAdmin)
		{
			$edit_but = NULL;
			if($AGmyIDUser)
				$edit_but = 'Quick Profile View';
			else
			if($ADD['id_user'])
				$edit_but = 'Add Profile';
			?>
			<div class="miniDNA" style="margin-top:15px; margin-bottom:10px;"></div>
			<div class="agbut-2" style="float:none; display:block;"><span class="agbut-2-left">&nbsp;</span><span style="width:146px; text-align:center;" class="agbut-2-center cursor-pointer" onclick="<?php echo ($AGmyIDUser) ? ' return quickEditUser(\'open\', '.$AGmyIDUser.');' : ' return pop2operation(\'open\', \'import_search\');';?>"><?php echo $edit_but;?></span><span class="agbut-2-right">&nbsp;</span></div>
			<div class="miniDNA" style="margin-top:10px; margin-bottom:0px;"></div>
			<?php
		}
		else
			echo '<div class="miniDNA" style="margin-top:20px; margin-bottom:0px;"></div>';
		
		if($AGmyIDUser)
		{
			?>
        <div class="AGLM_list">
        	<?php
			if($AGmyAdmin)
			{
				?>
                <div id="AGLM_item_1" class="AGLM_item_first" onclick="aglm_list_expand('AGLM_item_1');">
                    <span class="aglm_title">Manage Profile</span><span class="aglm_iconPlus">&nbsp;</span>
                    <div class="cleft"></div>
                </div>
                <div id="AGLM_item_1-expand" class="agexpand">
                	<div class="miniDNA" style="margin:0; margin-top:-2px; position:absolute;"></div>
                    <ul class="aglm_details">
                        <!--<li><a href="#" onclick="return pop2operation('open', 'create');"><span class="aglm_icon">&nbsp;</span>Utilizator nou</a><span style="display:block; font-style:italic; margin-top:-8px; margin-bottom:8px; margin-left:40px;">Va inlocui utilizatorul curent</span></li>
                        <li><a href="#" onclick="return pop2operation('open', 'import_search');"><span class="aglm_icon">&nbsp;</span>Importa utilizator</a><span style="display:block; font-style:italic; margin-top:-8px; margin-bottom:8px; margin-left:40px;">Va inlocui utilizatorul curent</span></li>-->
                        <li><a href="#" onclick="return pop2operation('open', 'edit');"><span class="aglm_icon">&nbsp;</span>Modific&#259; datele</a></li>
                        <li><a href="#" onclick="return pop2operation('open', 'delete');"><span class="aglm_icon">&nbsp;</span>Elimin&#259; membrul</a></li>
                    </ul>
                </div>
                <div class="miniDNA" style="margin:0; margin-top:-2px; position:absolute;"></div>
            	<?php
			}
			?>
            <div class="<?php echo (!$AGmyAdmin) ? 'AGLM_item_first' : 'AGLM_item';?><?php echo ($_SESSION[SESSION]['page'] == 'tree') ? ' active' : '';?>" onclick="aglm_list_expand('AGLM_item_2');">
                <a class="aglm_title" href="<?php echo ROOT.'tree-'.$AGmyIDTree.'/'.$AGmyIDUser.'/';?>" style="width:180px;">Tree</a>
                <div class="cleft"></div>
            </div>
            <div class="miniDNA" style="margin-left:0; margin-top:-2px; position:absolute;"></div>
            <div class="AGLM_item<?php echo ($_SESSION[SESSION]['page'] == 'tree_overview') ? ' active' : '';?>">
                <a class="aglm_title" href="<?php echo ROOT.'tree-'.$AGmyIDTree.'/'.$AGmyIDUser.'/overview.html';?>" style="width:180px;">Overview</a>
                <div class="cleft"></div>
            </div>
            <div class="miniDNA" style="margin-left:0; margin-top:-2px; position:absolute;"></div>
            <div class="AGLM_item<?php echo ($_SESSION[SESSION]['page'] == 'tree_facts') ? ' active' : '';?>">
                <a class="aglm_title" href="<?php echo ROOT.'tree-'.$AGmyIDTree.'/'.$AGmyIDUser.'/facts.html';?>" style="width:180px;">Facts and Sources</a>
                <div class="cleft"></div>
            </div>
            <div class="miniDNA" style="margin-left:0; margin-top:-2px; position:absolute;"></div>
            <div class="AGLM_item<?php echo ($_SESSION[SESSION]['page'] == 'tree_media') ? ' active' : '';?>">
                <a class="aglm_title" href="<?php echo ROOT.'tree-'.$AGmyIDTree.'/'.$AGmyIDUser.'/media.html';?>" style="width:180px;">Media Gallery</a>
                <div class="cleft"></div>
            </div>
            <div class="miniDNA" style="margin-left:0; margin-top:-2px; position:absolute;"></div>
            <div class="AGLM_item<?php echo ($_SESSION[SESSION]['page'] == 'tree_comments') ? ' active' : '';?>">
                <a class="aglm_title" href="<?php echo ROOT.'tree-'.$AGmyIDTree.'/'.$AGmyIDUser.'/comments.html';?>" style="width:180px;">Comments</a>
                <div class="cleft"></div>
            </div>
            <div class="miniDNA" style="margin-left:0; margin-top:-2px; position:absolute;"></div>
            <div class="AGLM_item<?php echo ($_SESSION[SESSION]['page'] == 'tree_hints') ? ' active' : '';?>">
                <a class="aglm_title" href="<?php echo ROOT.'tree-'.$AGmyIDTree.'/'.$AGmyIDUser.'/hints.html';?>" style="width:180px;">Hits</a>
                <div class="cleft"></div>
            </div>
            <div class="miniDNA" style="margin-left:0; margin-top:-2px; position:absolute;"></div>
            <div class="AGLM_item">
                <a class="aglm_title" href="<?php echo ROOT.'tree-'.$AGmyIDTree.'/'.$AGmyIDUser.'/member_connect.html';?>" style="width:180px;">Member Conect</a>
                <div class="cleft"></div>
            </div>
            <div class="miniDNA" style="margin-left:0; margin-top:-2px; position:absolute;"></div>
            <div class="AGLM_item">
                <span class="aglm_title" style="width:180px;">Member Albums</span>
                <div class="cleft"></div>
            </div>
            <div class="miniDNA" style="margin-left:0; margin-top:-2px;"></div>
        </div>
			<?php
		}
		/*echo '<p class="biografie">N&#259;scut &#351;i crescut &icirc;n <strong>Houston</strong>, <strong>Texas</strong>, Parsons a &icirc;nceput s&#259; joace &icirc;nc&#259; din clasa &icirc;nt&acirc;i. El a frecventat liceul <strong>Klein Oak High School</strong> din Spring, Texas.
&Icirc;n 1996 el a ob&#355;inut o diplom&#259; de licen&#355;&#259; &icirc;n teatru de la &#350;coala de teatru &#351;i dans a Universit&#259;&#355;ii Houston, unde a fost membru al fr&#259;&#355;iei <strong>Pi Kappa Alpha</strong>. Ulterior el a ob&#355;inut gradul de master la universitatea <strong>University of San Diego</strong><br /><br />&Icirc;n prezent el locuie&#351;te &icirc;n <strong>Brooklyn</strong>, <strong>New York</strong>. Are <strong>1,87 m</strong>. Printre hobbyurile sale se num&#259;r&#259; c&acirc;ntatul la pian &#351;i uitatul la sport la tv, &icirc;n special tenis, baschet &#351;i baseball</p>';
		echo '<div class="h10"></div>';*/
	echo '</div>';
	// end   afisare profil ---------------------------------------------------------------- //
}  
// ------------------------------------------------------------------------------------------------------------------------ //
?>