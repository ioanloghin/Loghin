<?php
//------------------------------------------------------------------------------------------------------------------------ //
	define('ANTIHACK', TRUE);
	require_once('../config/ini_set.php');
	require_once('../config/server.php');
	require_once('../config/crypt.php');
	require_once('../config/database.php');
	require_once('../config/email.php');
	require_once('../config/foreign_chars.php');
	require_once('../config/script.php');
//------------------------------------------------------------------------------------------------------------------------ //
	include_once('../system/models/SQL_DB.php'); // clasa sql
	//include_once('../system/libraries/Safe_post.php');
	include_once('../system/libraries/Safe_get.php');
	//include_once('../system/libraries/Datatime.php');
	//include_once('../system/libraries/Files.php');
	include_once('../system/helpers/url.php');
	//include_once('../system/helpers/includes.php');
//------------------------------------------------------------------------------------------------------------------------ //
//
// extragere din baza de date --------------------------------------
$GET = new safe_get();
$GET->set_var('id', NULL, 'strip_tags|trim|htmlentities');// html id este de forma StructBlock-CodAteco

// extrage doar codul Ateco
$code = str_replace('StructBlock-', '', $GET->get_var('id'));
// codul poate contine doar 1 litera mare la inceput iar in rest cifre, '.' si '-' 
// TODO: de realizat filtru

// extrage informatii din baza de date
$temp = SQL_DB::sql_select("struct_blocks", "`code` = '$code'", NULL, 0, 1);
if(isset($temp[1]))
	$info = $temp[1];
else
	$info = array('label' => '-');
?>
<div id="quick-block">
	<h2><?php echo $code;?></h2>
	<div class="head clear">
		<a class="profile left" href="#" title="Profile"><span class="icon"> </span> Profile</a>
		<a class="members right" href="#" title="Aplicatii"><span class="icon"> </span> Aplicatii</a>
	</div>
	<div class="cnt clear">
		<div class="image left">
			<img src="<?php echo base_url('content/struct/medium/A.jpg');?>" width="120" height="120" alt="" />
		</div>
		<div class="right" style="padding-top:0;">
        	<p>Detalii pentru <strong><?php echo $GET->get_var('id');?></strong><br />
            <br />
            <em><?php echo $info['label']?></em>
			</p>
		</div>
	</div>
	<div class="footer bg">
		<a href="#">Quick Edit</a>
		<a href="#">Gallery</a>
		<a class="last" href="#">Search Records</a>
	</div>
</div>
