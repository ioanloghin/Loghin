<?php
// includem configurarile ------------------------------------------------------------------------------------------------ //
if(isset($_GET['AGajax']))
{
	// ---------------------------------------------------------------
	// AJAX VITAL INCLUDES -------------------------------------------
	define('ANTIHACK', TRUE);
	require_once('../../config/_autoload.php');
	include_once('../../../structures/system/helpers/includes.php');
	include_once('../../../structures/system/helpers/url.php');
	script_include('[libraries]', '../../../structures/');
	script_include('[AG]', '../../');
	include_once('../../../structures/system/libraries/Accounts_API.php');
	include_once('../../models/Genealogy_model.php');
	$acc_api = new Accounts_API();
	$gen = new Genealogy_model();
	// ---------------------------------------------------------------
	$lang = (isset($_GET['lang'])) ? trim($_GET['lang']) : NULL;
	define('lang', $lang);
	define('page', '');
	$tree_id	= (isset($_GET['my_id_tree']) && is_numeric($_GET['my_id_tree'])) ? intval($_GET['my_id_tree']) : 0;
	$member_id	= (isset($_GET['my_id_user']) && is_numeric($_GET['my_id_user'])) ? intval($_GET['my_id_user']) : 0;
	$family_id	= (isset($_GET['my_id_family']) && is_numeric($_GET['my_id_family'])) ? intval($_GET['my_id_family']) : 0;
	$rel_id	= (isset($_GET['my_id_rel']) && is_numeric($_GET['my_id_rel'])) ? intval($_GET['my_id_rel']) : 0;
	$AGmyAdmin	= (isset($_GET['AGmyAdmin'])) ? TRUE : FALSE;
	if(isset($_SESSION[SESSION]['AGmyView'][$tree_id.$family_id]))
	{
		$_SESSION[SESSION]['AGmyView'][$tree_id.$family_id] = array(
			'view_asc' => 1,
			'view_desc' => 1
		);
	}
}
else
{
	global $acc_api, $gen;
	
	$tree_id	= $AGmyIDTree;
	$family_id	= $AGmyIDFamily;
	$member_id	= $AGmyIDUser;
	$rel_id		= $AGmyIDRel;
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
if($member_id || $ADD['id_user'])
{
	if(DIRECT_MODE)
		$account_id = $member_id;
	else
		$account_id = $gen->member2account($member_id);
	
	$infoUser = array();
	if($account_id > 0)
	{
		$temp[1] = $acc_api->get_account($account_id);
		$infoUser['fullname'] = (isset($temp[1]['firstname']) && isset($temp[1]['lastname'])) ? AG_Operation::fullname($temp[1]['firstname'], $temp[1]['lastname'], 15) : NULL;
		$infoUser['image']    = (isset($temp[1]['photo']) && $temp[1]['photo'] && file_exists(((isset($_GET['AGajax'])) ? '../../' : '').$temp[1]['photo'])) ? base_url(str_replace('thumbs/', 'medium/', $temp[1]['photo'])) : NULL;
		$infoUser['age']      = (isset($temp[1]['birthday']) and $temp[1]['birthday'] != NULL and $temp[1]['birthday'] != '0000-00-00') ? DataTime::age($temp[1]['birthday']).' ani, ' : NULL;
		$infoUser['city']     = (isset($temp[1]['location'])) ? $temp[1]['location'] : NULL;
		$infoUser['country']  = (isset($temp[1]['country'])) ? $temp[1]['country'] : NULL;
		$infoUser['gender']   = (isset($temp[1]['gender'])) ? $temp[1]['gender'] : NULL;
		$infoUser['info']     = (isset($temp[1]['info'])) ? $temp[1]['info'] : NULL;
		unset($temp);
	}
	else
	{
		$infoUser['fullname'] = 'Emply member';
		$infoUser['image'] = NULL;
		$infoUser['age'] = NULL;
		$infoUser['city'] = NULL;
		$infoUser['country'] = NULL;
		$infoUser['gender'] = 'male';
		$infoUser['info'] = NULL;
	}
	
	// SE CREAZA OBIECTUL -------------------------------------------------------------------- //
	$user_action = new AG_PoP2($tree_id, $family_id, $member_id, $rel_id);
	// memoram id-ul administratorului
	$user_action->set_admin(/*$MyUser->account_id()*/0);
	// memoram datele utilizatorului de legatura
	if($ADD['linked_id_user'])
		$user_action->set_linked($ADD['linked_id_user'], $ADD['linked_direction']);
	// SE FACE AFISAREA ---------------------------------------------------------------------- //
	?>
    <!--<div id="pop2operation">
    	<iframe id="pop2iframe" src="<?php echo ROOT;?>module/i_pop2.php?operation=create" width="670" height="390" frameborder="0" scrolling="no"></iframe>
    	<input id="pop2_hidden_getUrl" type="hidden" name="pop2_hidden_my" value="&my_id_tree=<?php echo $tree_id;?>&my_id_family=<?php echo $family_id;?>&my_id_user=<?php echo $member_id;?>&my_id_rel=<?php echo $rel_id;?>" />
	</div>-->
	<div id="quickEditUser" class="quickEditUser">
		<div class="topMiniBox1"><a id="quickEditUserBTcreate" class="topMiniBox_BT1" href="<?php echo anchor('tree', 'overview', $tree_id, $member_id);?>"><span class="icon">&nbsp;</span>Profile</a></div>
		<div class="topMiniBox2"><span><?php echo $infoUser['fullname'];?></span></div>
		<div class="topMiniBox3"><a id="quickEditUserBTimport" class="topMiniBox_BT2"><span class="icon">&nbsp;</span>-</a></div>
		<div class="cleft"></div>
		<div class="topMiniBox4">
            <div class="topMiniBox4_img"><img src="<?php echo $infoUser['image'];?>" width="115" height="115" alt="" /><a href="#">( View his family tree )</a></div>
            <div class="topMiniBox4_details">
            	<div class="topMiniBox4_details_c1">Nascut: <strong>24 martie 1973</strong><br />Varsta: <strong>38 ani</strong><br /></div>
            	<div class="topMiniBox4_details_c2">Tara: <strong>Romania</strong><br />Oras: <strong>Timisoara</strong><br /></div>
            	<div class="cleft"></div>
            	<div class="topMiniBox4_details_c3">Dr. Sheldon Cooper este un personaj fictiv din serialul Teoria Big Bang, jucat de actorul Jim Parsons. El este cel mai bun prieten, si colegul de camera, al lui Leonard Hofstadter.</div>
			</div>
		</div>
		<?php
        if($member_id > 0)
        {
            echo '<div class="topMiniBox5"><a href="#">Photo Gallery</a></div>';
            echo '<div class="topMiniBoxSep"></div>';
            echo '<div class="topMiniBox6"><a href="#">Search Records</a></div>';
        }
        else
        {
            echo '<div class="topMiniBox5"><span>Modific&#259; datele</span></div>';
            echo '<div class="topMiniBoxSep"></div>';
            echo '<div class="topMiniBox6"><span>&#350;terge utilizatorul</span></div>';
        }
        ?>
        <div class="cleft"></div>
	</div>
	<?php
	// SE DISTRUGE OBIECTUL ------------------------------------------------------------------ //
	unset($user_action);
	//
	//
	// start afisare profil ------------------------------------------------------------------ //
	if($member_id > 0)
	{
		?>
        <div class="rad5-top-left" style="background-color:#F8F5F3;">
            <input type="hidden" id="hiddenmember_id" name="hiddenmember_id" value="<?php echo $member_id;?>" />
            <div class="h10"></div>
            <div class="info_fix">
                <span class="title"><?php echo $infoUser['fullname'];?></span>
                <span class="other"><?php echo $infoUser['age'].''.$infoUser['city'].' '.$infoUser['country'];?>&nbsp;</span>
            </div>
            <!-- Profile image -->
            <?php $img_src = ($infoUser['image']) ? $infoUser['image'] : base_image(template, 'default_image_'.$infoUser['gender'].'.png');?>
            <div class="image_mask rad5"><div class="bwhite rad5"><img src="<?php echo $img_src;?>" width="146" alt="" /></div></div>
            <!-- Button: change profile -->
            <?php if($account_id) { ?>
            	<div class="change_profile rad5-bottom"><a href="<?php echo anchor('tree', 'delete', $tree_id, $family_id, $member_id);?>">Delete Profile</a></div>
            <?php } else { ?>
            	<div class="change_profile rad5-bottom"><a href="<?php echo anchor('tree', 'insert', $tree_id, $family_id, $member_id, $rel_id);?>">Add Profile</a></div>
            <?php } ?>
            
			<?php
            if(true)
            {
                $edit_but = NULL;
                if($member_id)
                    $edit_but = 'Quick Profile View';
                else
                if($ADD['id_user'])
                    $edit_but = 'Add Profile';
                ?>
                <div class="miniDNA" style="margin-top:15px; margin-bottom:10px; clear:left"></div>
                <div class="agbut-2" style="float:none; display:block; margin-left:15px;"><span class="agbut-2-left">&nbsp;</span><span style="width:146px; text-align:center;" class="agbut-2-center cursor-pointer" onclick="<?php echo ($member_id) ? ' return quickEditUser(\'open\', '.$member_id.');' : ' return pop2operation(\'open\', \'import_search\');';?>"><?php echo $edit_but;?></span><span class="agbut-2-right">&nbsp;</span></div>
                <div class="miniDNA" style="margin-top:10px; margin-bottom:0px;"></div>
                <?php
            }
            else
                echo '<div class="miniDNA" style="margin-top:20px; margin-bottom:0px;"></div>';
            ?>
        </div>
	<?php
	}
	
	if($member_id)
	{
		?>
        <ul class="column_list">
            <li class="item first">
                <a class="title" href="<?php echo anchor('tree', 'graph', $tree_id, $member_id);?>" style="width:180px;">Tree</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item<?php echo (page == 'tree_overview') ? ' active' : '';?>">
                <a class="title" href="<?php echo anchor('tree', 'overview', $tree_id, $member_id);?>" style="width:180px;">Overview</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item<?php echo (page == 'tree_facts') ? ' active' : '';?>">
                <a class="title" href="<?php echo anchor('tree', 'facts', $tree_id, $member_id);?>" style="width:180px;">Facts and Sources</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item<?php echo (page == 'tree_media') ? ' active' : '';?>">
                <a class="title" href="<?php echo anchor('tree', 'media', $tree_id, $member_id);?>" style="width:180px;">Media Gallery</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item<?php echo (page == 'tree_comments') ? ' active' : '';?>">
                <a class="title" href="<?php echo anchor('tree', 'comments', $tree_id, $member_id);?>" style="width:180px;">Comments</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item<?php echo (page == 'tree_hints') ? ' active' : '';?>">
                <a class="title" href="<?php echo anchor('tree', 'hints', $tree_id, $member_id);?>" style="width:180px;">Hits</a>
                <div class="cleft"></div>
            </li>
            <li class="miniDNA">&nbsp;</li>
            <li class="item">
                <a class="title" href="<?php echo anchor('tree', 'member_connect', $tree_id, $member_id);?>" style="width:180px;">Member Conect</a>
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