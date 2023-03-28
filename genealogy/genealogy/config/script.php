<?php
// ANTIHACK verificare access din exterior ------------------------------------------------------------------------------- //
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include("../module/e_403.php"));
}
// --- Default ----------------------------------------------------------------------------------------------------------- //
	define("DEFAULT_PAGE",      "index");
	define("DEFAULT_LANGUAGE",  "italian");
	define("DEFAULT_LANG",      "ro");
	define("DEFAULT_PROFILE_IMG", "design/imagini/no_image.jpg");
	define("LANG_IN_URL", FALSE);
//------------------------------------------------------------------------------------------------------------------------ //
//
// --- AGenealogi Format ------------------------------------------------------------------------------------------------- //
// 	TIPUL 1: Familia principala
	define("AGFORMAT_T1_UBW", 90);// user box width
	define("AGFORMAT_T1_UBW_", 110);// user box width (la hover)
	define("AGFORMAT_T1_UBH", 105);// user box height
	define("AGFORMAT_T1_UBBORDER", 2);// user box border width
	define("AGFORMAT_T1_P1_X", -60);// parinte 1, coordonata X
	define("AGFORMAT_T1_P1_Y", 230);// parinte 1, coordonata Y
	define("AGFORMAT_T1_P2_X", 60);// parinte 2, coordonata X
	define("AGFORMAT_T1_P2_Y", 230);// parinte 2, coordonata Y
	define("AGFORMAT_T1_C_DIST", 120);// distanta intre copii (recomand un nr. par)
	define("AGFORMAT_T1_C_Y", 0);// coordonata Y pentru copii
	define("AGFORMAT_T1_ET_W", 150);// eticheta, width
	define("AGFORMAT_T1_ET_H", 20);// eticheta, height
	define("AGFORMAT_T1_ET_X", 0);// eticheta, coordonata X
	define("AGFORMAT_T1_ET_Y", 170);// eticheta, coordonata Y
	define("AGFORMAT_T1_EX_W", 30);// div-ul cu butoane pentru ex relatii, width
	define("AGFORMAT_T1_EX_H", 105);// div-ul cu butoane pentru ex relatii, height
// 	TIPUL 2: Familia unui parinte din familia aflata in prim plan
	define("AGFORMAT_T2_UBW", AGFORMAT_T1_UBW);// user box width
	define("AGFORMAT_T2_UBW_", AGFORMAT_T1_UBW_);// user box width (la hover)
	define("AGFORMAT_T2_UBH", AGFORMAT_T1_UBH);// user box height
	define("AGFORMAT_T2_UBBORDER", AGFORMAT_T1_UBBORDER);// user box border width
	define("AGFORMAT_T2_P1_X", -60);// parinte 1, coordonata X
	define("AGFORMAT_T2_P1_Y", 120);// parinte 1, coordonata Y
	define("AGFORMAT_T2_P2_X", 60);// parinte 2, coordonata X
	define("AGFORMAT_T2_P2_Y", 120);// parinte 2, coordonata Y
	define("AGFORMAT_T2_C_DIST", 120);// distanta intre copii (recomand un nr. par)
	define("AGFORMAT_T2_C_Y", 70);// coordonata Y pentru copii
	define("AGFORMAT_T2_C_SPACE", 220);// spatiul din care desparte lista copiilor
	define("AGFORMAT_T2_ET_W", AGFORMAT_T1_ET_W);// eticheta, width
	define("AGFORMAT_T2_ET_H", AGFORMAT_T1_ET_H);// eticheta, height
	define("AGFORMAT_T2_ET_X", 0);// eticheta, coordonata X
	define("AGFORMAT_T2_ET_Y", 50);// eticheta, coordonata Y
// 	TIPUL 3: Familie compacta de descendenti (de la gradul 3 in sus)
	define("AGFORMAT_T3_UBW", AGFORMAT_T1_UBW);// user box width
	define("AGFORMAT_T3_UBW_", AGFORMAT_T1_UBW_);// user box width (la hover)
	define("AGFORMAT_T3_UBH", AGFORMAT_T1_UBH);// user box height
	define("AGFORMAT_T3_UBBORDER", AGFORMAT_T1_UBBORDER);// user box border width
	define("AGFORMAT_T3_P1_X", -60);// parinte 1, coordonata X
	define("AGFORMAT_T3_P1_Y", 120);// parinte 1, coordonata Y
	define("AGFORMAT_T3_P2_X", 60);// parinte 2, coordonata X
	define("AGFORMAT_T3_P2_Y", 120);// parinte 2, coordonata Y
	define("AGFORMAT_T3_ET_W", AGFORMAT_T1_ET_W);// eticheta, width
	define("AGFORMAT_T3_ET_H", AGFORMAT_T1_ET_H);// eticheta, height
	define("AGFORMAT_T3_ET_X", 0);// eticheta, coordonata X
	define("AGFORMAT_T3_ET_Y", 60);// eticheta, coordonata Y
// 	TIPUL 4: Familie de tip - fosta relatie (este pentru familia din stanga, fam. din dreapta va fi afisata in 'oglinda')
	define("AGFORMAT_T4_UBW", AGFORMAT_T1_UBW);// user box width
	define("AGFORMAT_T4_UBW_", AGFORMAT_T1_UBW_);// user box width (la hover)
	define("AGFORMAT_T4_UBH", AGFORMAT_T1_UBH);// user box height
	define("AGFORMAT_T4_UBBORDER", AGFORMAT_T1_UBBORDER);// user box border width
	define("AGFORMAT_T4_DOWN", -40);// diferenta de nivel fara de familia parinte
	define("AGFORMAT_T4_P_X", 240);// parintele afisat, coordonata X
	define("AGFORMAT_T4_P_Y", 130);// parintele afisat, coordonata Y
	define("AGFORMAT_T4_C_DIST1", 56);// distanta pentru primul copil
	define("AGFORMAT_T4_C_DIST", 120);// distanta intre copii (recomand un nr. par)
	define("AGFORMAT_T4_C_Y", 0);// coordonata Y pentru copii
	define("AGFORMAT_T4_ET_W", AGFORMAT_T1_ET_W);// eticheta, width
	define("AGFORMAT_T4_ET_H", AGFORMAT_T1_ET_H);// eticheta, height
	define("AGFORMAT_T4_ET_X", 60);// eticheta, coordonata X
	define("AGFORMAT_T4_ET_Y", 180);// eticheta, coordonata Y
// 	TIPUL 5: Familie de ascendenti
	define("AGFORMAT_T5_UBW", AGFORMAT_T1_UBW);// user box width
	define("AGFORMAT_T5_UBW_", AGFORMAT_T1_UBW_);// user box width (la hover)
	define("AGFORMAT_T5_UBH", AGFORMAT_T1_UBH);// user box height
	define("AGFORMAT_T5_UBBORDER", AGFORMAT_T1_UBBORDER);// user box border width
	define("AGFORMAT_T5_P1_X", -60);// parinte 1, coordonata X
	define("AGFORMAT_T5_P2_X", 60);// parinte 2, coordonata X
	define("AGFORMAT_T5_P_Y", 200);// parinte afisat, coordonata Y
	define("AGFORMAT_T5_P_MB", 20);// parinte afisat, margin bottom
	define("AGFORMAT_T5_C_DIST", 120);// distanta intre copii (recomand un nr. par)
	define("AGFORMAT_T5_C_Y", 0);// coordonata Y pentru copii
	define("AGFORMAT_T5_ET_W", AGFORMAT_T1_ET_W);// eticheta, width
	define("AGFORMAT_T5_ET_H", AGFORMAT_T1_ET_H);// eticheta, height
	define("AGFORMAT_T5_ET_X", 0);// eticheta, coordonata X
	define("AGFORMAT_T5_ET_Y", 140);// eticheta, coordonata Y
	define("AGFORMAT_T5_H", AGFORMAT_T5_UBH + AGFORMAT_T5_P_Y + AGFORMAT_T5_P_MB);// calculare automata a inaltimi
//------------------------------------------------------------------------------------------------------------------------ //
?>