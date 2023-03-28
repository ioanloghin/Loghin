<?php
// ANTIHACK verificare access din exterior ------------------------------------------------------------------------------- //
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include("../module/e_403.php"));
}
//------------------------------------------------------------------------------------------------------------------------ //
//
//------------------------------------------------------------------------------------------------------------------------ //
	define("MYSQL", "on"); // on|off
//
if($_SERVER['HTTP_HOST'] == 'localhost')
{
	define("MYSQL_SERVER",	"localhost");
	define("MYSQL_USER",	"root");
	define("MYSQL_PAROLA",	"");
	define("BAZA_DATE",		"loghin");
	define("MYSQL_PRE",		"gen_");
	define("ADMINDB_PRE",	"adryroadmin_");
}
else
if($_SERVER['HTTP_HOST'] == 'www.loghin.com' || $_SERVER['HTTP_HOST'] == 'loghin.com')
{
	define("MYSQL_SERVER",	"localhost");
	define("MYSQL_USER",	"loghin_genealogy");
	define("MYSQL_PAROLA",	"ertyum");
	define("BAZA_DATE",		"loghin_genealogy");
	define("MYSQL_PRE",		"gen_");
	define("ADMINDB_PRE",	"adryroadmin_");
}
else
if($_SERVER['HTTP_HOST'] == 'www.genealogy.loghin.com' || $_SERVER['HTTP_HOST'] == 'genealogy.loghin.com')
{
	define("MYSQL_SERVER",	"localhost");
	define("MYSQL_USER",	"loghin_genealogy");
	define("MYSQL_PAROLA",	"ertyum");
	define("BAZA_DATE",		"loghin_genealogy");
	define("MYSQL_PRE",		"gen_");
	define("ADMINDB_PRE",	"adryroadmin_");
}
//------------------------------------------------------------------------------------------------------------------------ //
//
//
// --- AGenealogi DB ----------------------------------------------------------------------------------------------------- //
	define("DBT_FAM_INFO", MYSQL_PRE."families");// tabelul cu detalii despre familie
		define("DBT_FAM_INFO_C1", "family_id");// id-ul familiei
		define("DBT_FAM_INFO_C2", "Name");// numele de familie (ex. familia Popescu)
		define("DBT_FAM_INFO_C3", "Married");// statutul parintilor
			define("DBT_FAM_INFO_C3_V1", "yes");// casatriti
			define("DBT_FAM_INFO_C3_V2", "no");// necasatoriti
	define("DBT_FAM", MYSQL_PRE."families_members");// tabelul famililor
		define("DBT_FAM_C1", "family_id");// id unic de inregistrare
		define("DBT_FAM_C2", "tree_id");// id arbore
		//define("DBT_FAM_C3", "name");// numele familiei
		//define("DBT_FAM_C4", "status"); // status (relatie curenta sau fosta relatie)
			//define("DBT_FAM_C4_V1", "current");// valoarea pentru relatie curenta
			//define("DBT_FAM_C4_V2", "ex");// valoarea pentru fosta relatie
		//define("DBT_FAM_C5", "type");// tip (casatoriti sau concubinaj)
		define("DBT_FAM_C6", "Parent1");// id parinte 1 (tata)
		define("DBT_FAM_C7", "Parent2");// id parinte 2 (mama)
		define("DBT_FAM_C8", "Children");// string cu id-urile copiilor ex: -1-,-13-,-15-
	define("DBT_TREE", MYSQL_PRE."trees");// tabelul arborilor
		define("DBT_TREE_C1", "tree_id");// id unic de intregistrare
		define("DBT_TREE_C2", "admin_id");// id admin
		define("DBT_TREE_C3", "label");// numele arborelui
		define("DBT_TREE_C4", "default_member_id");// idul membrului care v-a avea perspectiva in mod implicit (daca nu s-a specificat altul)
		define("DBT_TREE_C5", "primary");// tipul arborelui
			define("DBT_TREE_C5_V1", "0");// daca este arbore secundar (de ex relatie)
			define("DBT_TREE_C5_V2", "1");// daca este arbore de baza
	define("DBT_USER_INFO", MYSQL_PRE."users_details");// tabelul utilizatorilor
		define("DBT_USER_INFO_C1", "UserID");// id unic de inregistrare
		define("DBT_USER_INFO_C2", "firstname");// primul nume
		define("DBT_USER_INFO_C3", "lastname");// al doilea nume
		define("DBT_USER_INFO_C4", "gender");// genul (masculin, feminin sau nespecificat)
		define("DBT_USER_INFO_C5", "image");// adresa catre imaginea de profil 
		define("DBT_USER_INFO_C6", "born");// data nasterii YYYY-MM-DD
		define("DBT_USER_INFO_C7", "deces");// data decesului YYYY-MM-DD
		define("DBT_USER_INFO_C8", "city");// orasul
		define("DBT_USER_INFO_C9", "country");// tara
		define("DBT_USER_INFO_C10", "description");// descrierea
	define("DBT_TREE_LINK", MYSQL_PRE."trees_links");// tabelul legaturilor cu ex relatiile
		define("DBT_TREE_LINK_C1", "link_id");// id unic de inregistrare
		define("DBT_TREE_LINK_C2", "a_tree_id");// id arbore primar
		define("DBT_TREE_LINK_C3", "a_family_id");// id familie din arborele primar
		define("DBT_TREE_LINK_C4", "a_member_id");// id user din arborele primar
		define("DBT_TREE_LINK_C5", "b_tree_id");// id arbore secundar
		define("DBT_TREE_LINK_C6", "b_family_id");// id familie din arborele secundar
		define("DBT_TREE_LINK_C7", "b_member_id");// id user din arborele secundar
	define("DBT_USER", MYSQL_PRE."users");// tabelul datelor de autentificare
		define("DBT_USER_C1", "UserID");// id unic de inregistrare
		define("DBT_USER_C2", "Username");// username
		define("DBT_USER_C3", "Password");// password
	define("DBT_COMM", MYSQL_PRE."comments");// tabelul pentru comentarii
		define("DBT_COMM_C1", "CommentID");// id unic de inregistrare
		define("DBT_COMM_C2", "FromUserID");// id utilizator (autorul comentului)
		define("DBT_COMM_C3", "ToUserID");// id utilizator (userul vizat)
		define("DBT_COMM_C4", "Title");// subiectul comentariului
		define("DBT_COMM_C5", "Content");// continut
		define("DBT_COMM_C6", "DataInsert");// data inserarii
	define("DBT_MED_PHO", MYSQL_PRE."media_photos");// tabelul pentru imagini media
		define("DBT_MED_PHO_C1", "PhotoID");// id unic de inregistrare
		define("DBT_MED_PHO_C2", "UserID");// id utilizator (userul vizat)
		define("DBT_MED_PHO_C3", "FromUserID");// id utilizator (cel care a trimis imaginea)
		define("DBT_MED_PHO_C4", "Primary");// 
		define("DBT_MED_PHO_C5", "Patch");// 
		define("DBT_MED_PHO_C6", "Title");// 
		define("DBT_MED_PHO_C7", "CategoryID");// 
		define("DBT_MED_PHO_C8", "Date");// 
		define("DBT_MED_PHO_C9", "Location");// 
		define("DBT_MED_PHO_C10", "Description");// 
		define("DBT_MED_PHO_C11", "DataInsert");// 
	define("DBT_MED_PHO_P", MYSQL_PRE."media_stories_persons");// tabelul pentru persoane atasate la imagine
		define("DBT_MED_PHO_P_C1", "PhotoID");// id imagine media
		define("DBT_MED_PHO_P_C2", "UserID");// id utilizator
	define("DBT_MED_STO", MYSQL_PRE."media_stories");// tabelul pentru povestiri
		define("DBT_MED_STO_C1", "StoryID");// id unic de inregistrare
		define("DBT_MED_STO_C2", "UserID");// id utilizator (userul vizat)
		define("DBT_MED_STO_C3", "FromUserID");// id utilizator (cel care a trimis povestirea)
		define("DBT_MED_STO_C4", "Title");// 
		define("DBT_MED_STO_C5", "Content");// 
		define("DBT_MED_STO_C6", "Description");// 
		define("DBT_MED_STO_C7", "Location");// 
		define("DBT_MED_STO_C8", "Date");// 
		define("DBT_MED_STO_C9", "DataInsert");// 
	define("DBT_MED_STO_P", MYSQL_PRE."media_stories_persons");// tabelul pentru persoane atasate la povestire
		define("DBT_MED_STO_P_C1", "StoryID");// id povestirii
		define("DBT_MED_STO_P_C2", "UserID");// id utilizator
	define("DBT_MED_AUD", MYSQL_PRE."media_audios");// tabelul pentru comentarii
		define("DBT_MED_AUD_C1", "AudioID");// id unic de inregistrare
		define("DBT_MED_AUD_C2", "UserID");// id utilizator (userul vizat)
		define("DBT_MED_AUD_C3", "FromUserID");// id utilizator (autorul comentului)
		define("DBT_MED_AUD_C4", "Patch");// 
		define("DBT_MED_AUD_C5", "DataInsert");// 
		define("DBT_MED_AUD_C6", "Title");// 
	define("DBT_MED_VID", MYSQL_PRE."media_videos");// tabelul pentru comentarii
		define("DBT_MED_VID_C1", "VideoID");// id unic de inregistrare
		define("DBT_MED_VID_C2", "UserID");// id utilizator (userul vizat)
		define("DBT_MED_VID_C3", "FromUserID");// id utilizator (autorul comentului)
		define("DBT_MED_VID_C4", "DataInsert");// 
//------------------------------------------------------------------------------------------------------------------------ //
?>