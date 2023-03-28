<?php
// includem configurarile ------------------------------------------------------------------------------------------------ //
if(isset($_GET['AGajax']))
{
	define('ANTIHACK', TRUE);
	include_once('../../system/helpers/includes.php');
	include_once('../../system/helpers/url.php');
	script_include('[vital]', '../../');
	// ----------------------------------------------------
	$lang = (isset($_GET['lang'])) ? trim($_GET['lang']) : NULL;
	define('lang', $lang);
	define('page', '');
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

if($AGmyAdmin)
{
	if(!isset($_SESSION[SESSION]['admin_config'])) $_SESSION[SESSION]['admin_config'] = array();
	
	$_SESSION[SESSION]['admin_config']['my'] = array();
	$_SESSION[SESSION]['admin_config']['my'] = array();
	
}
//print '<pre>'; var_export($_SESSION[SESSION]['admin_config']['my']); print '</pre>';
// ------------------------------------------------------------------------------------------------------------------------ //
if($AGmyIDUser || $ADD['id_user'])
{
	$infoUser = array();
	if($AGmyIDUser > 0)
	{
		$temp = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C1."` = '$AGmyIDUser'", NULL, 0, 1);
		$infoUser['fullname'] = (isset($temp[1][DBT_USER_INFO_C2]) && isset($temp[1][DBT_USER_INFO_C3])) ? AG_Operation::fullname($temp[1][DBT_USER_INFO_C2], $temp[1][DBT_USER_INFO_C3], 15) : NULL;
		$infoUser['image'] = (isset($temp[1][DBT_USER_INFO_C5]) && $temp[1][DBT_USER_INFO_C5] && file_exists(((isset($_GET['AGajax'])) ? '../../' : '').$temp[1][DBT_USER_INFO_C5])) ? base_url(str_replace('thumbs/', 'medium/', $temp[1][DBT_USER_INFO_C5])) : base_image('harmony', 'default_image.png');
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
	?>
    <!--<div id="pop2operation">
    	<iframe id="pop2iframe" src="<?php echo ROOT;?>module/i_pop2.php?operation=create" width="670" height="390" frameborder="0" scrolling="no"></iframe>
    	<input id="pop2_hidden_getUrl" type="hidden" name="pop2_hidden_my" value="&my_id_tree=<?php echo $AGmyIDTree;?>&my_id_family=<?php echo $AGmyIDFamily;?>&my_id_user=<?php echo $AGmyIDUser;?>&my_id_rel=<?php echo $AGmyIDRel;?>" />
	</div>-->
    <?php
	$HTMLcode = NULL;
	$HTMLcode .= '<div id="quickEditUser" class="quickEditUser">';
	
	$HTMLcode .= '<div class="topMiniBox1"><a id="quickEditUserBTcreate" class="topMiniBox_BT1" href="'.anchor('tree', 'overview', $AGmyIDTree, $AGmyIDUser).'"><span class="icon">&nbsp;</span>Profile</a></div>';
	$HTMLcode .= '<div class="topMiniBox2"><span>'.$infoUser['fullname'].'</span></div>';
	$HTMLcode .= '<div class="topMiniBox3"><a id="quickEditUserBTimport" class="topMiniBox_BT2"><span class="icon">&nbsp;</span>-</a></div>';
	$HTMLcode .= '<div class="cleft"></div>';
	$HTMLcode .= '<div class="topMiniBox4">';
	$HTMLcode .= '<div class="topMiniBox4_img"><img src="'.$infoUser['image'].'" width="115" height="115" alt="" /><a href="#">( View his family tree )</a></div>';
	$HTMLcode .= '<div class="topMiniBox4_details">';
	$HTMLcode .= '<div class="topMiniBox4_details_c1">Nascut: <strong>24 martie 1973</strong><br />Varsta: <strong>38 ani</strong><br /></div>';
	$HTMLcode .= '<div class="topMiniBox4_details_c2">Tara: <strong>Romania</strong><br />Oras: <strong>Timisoara</strong><br /></div>';
	$HTMLcode .= '<div class="cleft"></div>';
	$HTMLcode .= '<div class="topMiniBox4_details_c3">Dr. Sheldon Cooper este un personaj fictiv din serialul Teoria Big Bang, jucat de actorul Jim Parsons. El este cel mai bun prieten, si colegul de camera, al lui Leonard Hofstadter.</div>';
	$HTMLcode .= '</div>';
	$HTMLcode .= '</div>';
	if($AGmyIDUser > 0)
	{
		$HTMLcode .= '<div class="topMiniBox5"><a href="#">Photo Gallery</a></div>';
		$HTMLcode .= '<div class="topMiniBoxSep"></div>';
		$HTMLcode .= '<div class="topMiniBox6"><a href="#">Search Records</a></div>';
	}
	else
	{
		$HTMLcode .= '<div class="topMiniBox5"><span>Modific&#259; datele</span></div>';
		$HTMLcode .= '<div class="topMiniBoxSep"></div>';
		$HTMLcode .= '<div class="topMiniBox6"><span>&#350;terge utilizatorul</span></div>';
	}
	$HTMLcode .= '<div class="cleft"></div>';
	$HTMLcode .= '</div>';
	echo $HTMLcode;
	// SE DISTRUGE OBIECTUL ------------------------------------------------------------------ //
	unset($user_action);
	//
	//
	// start afisare profil ------------------------------------------------------------------ //
    	echo '';
		echo '';
		?>
        <div class="rad5-top-left" style="background-color:#F8F5F3;">
            <input type="hidden" id="hiddenAGmyIDUser" name="hiddenAGmyIDUser" value="<?php echo $AGmyIDUser;?>" />
            <div class="h10"></div>
            <div class="info_fix">
                <span class="title"><?php echo $infoUser['fullname'];?></span>
                <span class="other"><?php echo $infoUser['age'].''.$infoUser['city'].' '.$infoUser['country'];?>&nbsp;</span>
            </div>
            <!-- Profile image -->
            <?php $img_src = ($infoUser['image']) ? $infoUser['image'] : base_image('harmony', 'default_image.png');?>
            <div class="image_mask rad5"><div class="bwhite rad5"><img src="<?php echo $img_src;?>" width="146" alt="" /></div></div>
            <!-- Button: change profile -->
            <div class="change_profile rad5-bottom"><a href="#">Change Profile</a></div>
			<?php
            if(true)
            {
                $edit_but = NULL;
                if($AGmyIDUser)
                    $edit_but = 'Quick Profile View';
                else
                if($ADD['id_user'])
                    $edit_but = 'Add Profile';
                ?>
                <div class="miniDNA" style="margin-top:15px; margin-bottom:10px;"></div>
                <div class="agbut-2" style="float:none; display:block; margin-left:15px;"><span class="agbut-2-left">&nbsp;</span><span style="width:146px; text-align:center;" class="agbut-2-center cursor-pointer" onclick="<?php echo ($AGmyIDUser) ? ' return quickEditUser(\'open\', '.$AGmyIDUser.');' : ' return pop2operation(\'open\', \'import_search\');';?>"><?php echo $edit_but;?></span><span class="agbut-2-right">&nbsp;</span></div>
                <div class="miniDNA" style="margin-top:10px; margin-bottom:0px;"></div>
                <?php
            }
            else
                echo '<div class="miniDNA" style="margin-top:20px; margin-bottom:0px;"></div>';
            ?>
        </div>
	<?php

	if($AGmyIDUser)
	{
		?>
        <ul class="column_list">
            <li class="item first">
                <a class="title" href="<?php echo anchor('tree', 'graph', $AGmyIDTree, $AGmyIDUser);?>" style="width:180px;">Tree</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item<?php echo (page == 'tree_overview') ? ' active' : '';?>">
                <a class="title" href="<?php echo anchor('tree', 'overview', $AGmyIDTree, $AGmyIDUser);?>" style="width:180px;">Overview</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item<?php echo (page == 'tree_facts') ? ' active' : '';?>">
                <a class="title" href="<?php echo anchor('tree', 'facts', $AGmyIDTree, $AGmyIDUser);?>" style="width:180px;">Facts and Sources</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item<?php echo (page == 'tree_media') ? ' active' : '';?>">
                <a class="title" href="<?php echo anchor('tree', 'media', $AGmyIDTree, $AGmyIDUser);?>" style="width:180px;">Media Gallery</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item<?php echo (page == 'tree_comments') ? ' active' : '';?>">
                <a class="title" href="<?php echo anchor('tree', 'comments', $AGmyIDTree, $AGmyIDUser);?>" style="width:180px;">Comments</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item<?php echo (page == 'tree_hints') ? ' active' : '';?>">
                <a class="title" href="<?php echo anchor('tree', 'hints', $AGmyIDTree, $AGmyIDUser);?>" style="width:180px;">Hits</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item">
                <a class="title" href="<?php echo anchor('tree', 'member_connect', $AGmyIDTree, $AGmyIDUser);?>" style="width:180px;">Member Conect</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item">
                <span class="title" style="width:180px;">Member Albums</span>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
        </ul>
		<?php
	}

	// end   afisare profil ---------------------------------------------------------------- //
}  
// ------------------------------------------------------------------------------------------------------------------------ //
?>