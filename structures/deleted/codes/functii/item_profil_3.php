<?php
function item_profil_3($id_user, $last = FALSE)
{
	global $AGmyIDTree;
	$return = NULL;
	$temp2 = SQL_DB::sql_select(DBT_USER_INFO, "`".DBT_USER_INFO_C1."` = '$id_user'", NULL, 0, 1);
	if(count($temp2) > 0)
	{
		$temp2_row = $temp2[1];
		
		$age = (isset($temp2_row[DBT_USER_INFO_C6]) and $temp2_row[DBT_USER_INFO_C6] != NULL and $temp2_row[DBT_USER_INFO_C6] != '0000-00-00') ? DataTime::age($temp2_row[DBT_USER_INFO_C6]) : 0;
		$gender = array();
		$gender[3] = '';
		$gender[1] = ($age > 18) ? 'B&#259;rbat, ' : 'B&#259;iat, ';
		$gender[2] = ($age > 18) ? 'Femeie, ' : 'Fat&#259;, ';
		
		$echo_gender = (isset($gender[$temp2_row[DBT_USER_INFO_C4]])) ? $gender[$temp2_row[DBT_USER_INFO_C4]] : NULL;
		
		$fullname = fullname($temp2_row[DBT_USER_INFO_C2], $temp2_row[DBT_USER_INFO_C3], 15);
		
		$image = $temp2_row[DBT_USER_INFO_C5];
		if($image == NULL)
		{
			if($echo_gender == 2)
				$image = 'design/imagini/import/AGprofil_default_img_pink.jpg';
			else
				$image = 'design/imagini/import/AGprofil_default_img_blue.jpg';
		}
		
		$return .= '<li class="itemProfil '.(($last) ? 'last' : '').' baiat">';
		$return .= '<img class="avatar" src="'.ROOT.$image.'" width="50" height="50" alt="" />';
		$return .= '<div>';
		$return .= '<strong class="bigTitle"><a href="'.ROOT.'tree-'.$AGmyIDTree.'/'.$id_user.'/overview.html">'.$fullname.'</a></strong>';
		$return .= '<span class="subTitle">'.$echo_gender.$age.' ani</span>';
		$return .= '<span class="subTitle">Bucuresti, RO</span>';
		$return .= '</div>';
		$return .= '</li>';
	}
	unset($temp2);
	return $return;
}
?>