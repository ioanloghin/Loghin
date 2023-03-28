<?php
//------------------------------------------------------------------------------------------------------------------------ //
	define('ANTIHACK', TRUE);
	require_once('../config/_autoload.php');
//------------------------------------------------------------------------------------------------------------------------ //
	include_once('../system/core/_autoload.php');
	include_once('../system/libraries/_autoload.php');
	include_once('../system/helpers/_autoload.php');
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
$_lang = 'it';
$select_query = "SELECT b.*, b_lang.".$_lang." AS `label` FROM `".MYSQL_PRE."blocks` AS b
				LEFT JOIN `".MYSQL_PRE."blocks_lang` AS b_lang ON b.id = b_lang.block_id
				WHERE b.`code` = '$code';";
$results = SQL_DB::sql_querry($select_query);
while($row=mysql_fetch_assoc($results))
	$info = $row;
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
