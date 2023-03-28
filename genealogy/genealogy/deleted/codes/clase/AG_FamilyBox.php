<?php
// ANTIHACK verificare access din exterior
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include("../../module/e_403.php"));
}
//
//
//
class AG_FamilyBox
{
	public $box_type = 1; // 1 - normal | 2 - no hover | 3 - sablon
	public $identifier = array('this' => NULL, 'asc' => NULL, 'desc' => array(1 => NULL, 2 => NULL)); // codul unic de identificare al familiilor
	public $ids = array('this' => 0, 'asc' => 0, 'desc' => array(1 => 0, 2 => 0)); // ID-ul unic de inregistrare al familiilor
	public $recognition = array('type' => 1, 'align' => NULL, 'grade' => 0); // 1-familia principala|2-fam. descendenta extinsa|3-fam. descendenta compacta|4-fam. relatie
	public $width = 0; // latimea containerului
	public $height = 0; // inaltimea containerului
	public $posX = 0; // coordonata X in raport cu box-ul familiei
	public $posY = 0; // coordonata Y in raport cu box-ul familiei
	public $marginLeft = 0; // distanta pe axa 0X
	public $marginTop = 0; // distanta pe axa 0Y
	public $info = array(); // lista cu informatii despre familie (id, nume etc.)
	public $members_ref = array(1 => 0, 2 => 0, 3 => array()); // contine o lista cu referinte catre obiectele utilizatorilor
	public $count_children = 0; // numar copii
	public $conectTo = array('id_family' => 0, 'id_user' => 0);
	public $conectToCoord = array(0, 0); // coordonatele unde se conecteaza
	public $exRelatii = 0; // numarul de relatii
	public $exRelatieActiva = 0; // relatia selectata
	public $exRelatiiButtons = array(1 => array(), 2 => array()); // array cu id-urile ex relatiilor pentru ambi parinti din familia principala
	//
	// ========================================================================
	public function __construct()
	{
		
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function familyReferences()
	{
		$family_references = array(
			'box_type'			=> &$this->box_type,
			'identifier'		=> &$this->identifier,
			'ids'				=> &$this->ids,
			'recognition'		=> &$this->recognition,
			'width'				=> &$this->width,
			'height'			=> &$this->height,
			'posX'				=> &$this->posX,
			'posY'				=> &$this->posY,
			'marginLeft'		=> &$this->marginLeft,
			'marginTop'			=> &$this->marginTop,
			'info'				=> &$this->info,
			'count_children'	=> &$this->count_children,
			'conectTo'			=> &$this->conectTo,
			'conectToCoord'		=> &$this->conectToCoord,
			'exRelatii'			=> &$this->exRelatii,
			'exRelatieActiva'	=> &$this->exRelatieActiva
		);
		
		return $family_references;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function setInfo($info = array())
	{
		if(is_array($info))
			$this->info = $info;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function setConectTo($contectTo, $conectToCoord)
	{
		if(is_array($contectTo))
			$this->conectTo = $contectTo;
		if(is_array($conectToCoord))
			$this->conectToCoord = $conectToCoord;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function setMembers($members_ref = array())
	{
		if(is_array($members_ref))
		{
			//$this->members_ref = $members_ref;
			if($members_ref[1])
			{
				$this->members_ref[1] = $members_ref[1];
				$this->members_ref[1]->family_obj = $this->familyReferences();
			}
			if($members_ref[2])
			{
				$this->members_ref[2] = $members_ref[2];
				$this->members_ref[2]->family_obj = $this->familyReferences();
			}
			foreach($members_ref[3] as $key => $userbox)
			{
				if(!in_array($userbox, $this->members_ref[3]))
				{
					$userbox->family_obj = $this->familyReferences();
					$this->members_ref[3][] = $userbox;
				}
			}
			$this->count_children = count($members_ref[3]);
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function setPosition($identifier, $ids, $recognition)
	{
		if(is_array($identifier))
			$this->identifier = $identifier;
		if(is_array($ids))
			$this->ids = $ids;
		if(is_array($recognition))
			$this->recognition = $recognition;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function deleteMembersInFamilyObj($id_family, &$arrayFamilyObj)
	{
		if(isset($arrayFamilyObj[$id_family]))
		{
			$arrayFamilyObj[$id_family]->members_ref[1] = NULL;
			$arrayFamilyObj[$id_family]->members_ref[2] = NULL;
			$arrayFamilyObj[$id_family]->members_ref[3] = array();
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function calculateFamilyCoord(&$arrayFamilyObj)
	{
		switch($this->recognition['type'])
		{
			case 1:
			case -1:
				break;
			case 2:
			case -2:
				$famConectML = $arrayFamilyObj[$this->conectTo['id_family']]->marginLeft;
				$famConectMT = $arrayFamilyObj[$this->conectTo['id_family']]->marginTop;
				$famConectW = $arrayFamilyObj[$this->conectTo['id_family']]->width;
				$famConectH = $arrayFamilyObj[$this->conectTo['id_family']]->height;
				$this->marginLeft = ($famConectML + ceil($famConectW/2) + $this->conectToCoord[0]) - ceil($this->width/2);
				$this->marginTop = $famConectMT + $famConectH;
				break;
			case 3:
			case -3:
				if($this->conectTo['id_family'])
				{
					$famConectML = $arrayFamilyObj[$this->conectTo['id_family']]->marginLeft;
					$famConectMT = $arrayFamilyObj[$this->conectTo['id_family']]->marginTop;
					$famConectW = $arrayFamilyObj[$this->conectTo['id_family']]->width;
					$famConectH = $arrayFamilyObj[$this->conectTo['id_family']]->height;
					$this->marginLeft = ($famConectML + ceil($famConectW/2) + $this->conectToCoord[0]) - ceil($this->width/2);
					$this->marginTop = $famConectMT + $famConectH;
				}
				break;
			case 4:
			case -4:
				if($this->conectTo['id_family'])
				{
					$famConectML = $arrayFamilyObj[$this->conectTo['id_family']]->marginLeft;
					$famConectMT = $arrayFamilyObj[$this->conectTo['id_family']]->marginTop;
					$famConectW = $arrayFamilyObj[$this->conectTo['id_family']]->width;
					$famConectH = $arrayFamilyObj[$this->conectTo['id_family']]->height;
					$this->marginTop = $famConectMT + ($famConectH - $this->height) - AGFORMAT_T4_DOWN;
					if($this->recognition['align'] == 1)
					{
						$this->marginLeft = ($famConectML - $this->width) + (ceil($famConectW/2) - (abs($this->conectToCoord[0]) + ceil(AGFORMAT_T4_UBW/2)));
					}
					elseif($this->recognition['align'] == 2)
						$this->marginLeft = ($famConectML + ceil($famConectW/2) + $this->conectToCoord[0]) + ceil(AGFORMAT_T4_UBW/2) + AGFORMAT_T1_UBBORDER*2;
				}
				break;
			case 5:
			case -5:
				$famConectML = $arrayFamilyObj[$this->conectTo['id_family']]->marginLeft;
				$famConectMT = $arrayFamilyObj[$this->conectTo['id_family']]->marginTop;
				$famConectW = $arrayFamilyObj[$this->conectTo['id_family']]->width;
				$famConectH = $arrayFamilyObj[$this->conectTo['id_family']]->height;
				$this->marginLeft = ($famConectML + ceil($famConectW/2) + $this->conectToCoord[0]) - ceil($this->width/2);
				if($this->recognition['align'] == 1)
					$this->marginLeft -= AGFORMAT_T5_P1_X;
				else
					$this->marginLeft -= AGFORMAT_T5_P2_X;
				$this->marginTop = $famConectMT - $this->height;
				break;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function setAscDescMembers($familyArrayChildren, $familyArrayParents, $familyArrayIdentif, &$arrayFamilyObj)
	{
		global $AGmyIDFamily, $AGmyAdmin;
		
		if($this->members_ref[1])
		{
			$this->members_ref[1]->countFamilyChildren = $this->count_children;
			
			if(($this->recognition['type'] == 5 && $this->recognition['align'] == 1) || ($this->recognition['type'] == 4 && $this->recognition['align'] == 1))
				$this->members_ref[1] = NULL;
			else
			{
				if(isset($this->ids['desc'][1]) && isset($this->identifier['desc'][1]))
				{
					$descFamily = array('id' => $this->ids['desc'][1], 'identifier' => $this->identifier['desc'][1], 'checked' => FALSE, 'readonly' => FALSE);
					$this->members_ref[1]->descFamily = $descFamily;
				}
				
				if(isset($this->ids['this']) && isset($this->identifier['this']))
				{
					$checked = TRUE;
					$readonly = ($this->recognition['type'] == 1) ? TRUE : FALSE;
					$ascFamily = array('id' => $this->ids['this'], 'identifier' => $this->identifier['this'], 'checked' => $checked, 'readonly' => $readonly);
					$this->members_ref[1]->ascFamily = $ascFamily;
				}
			}
			if($AGmyAdmin && $this->members_ref[1])
			{
				if(!$this->members_ref[1]->descFamily['identifier'])
				{
					$this->members_ref[1]->descFamily['identifier'] = $this->identifier['this'].'0';
					$this->identifier['desc'][1] = $this->identifier['this'].'0';
				}
			}
		}
		if($this->members_ref[2])
		{
			$this->members_ref[2]->countFamilyChildren = $this->count_children;
			
			if(($this->recognition['type'] == 5 && $this->recognition['align'] == 2) || ($this->recognition['type'] == 4 && $this->recognition['align'] == 2))
				$this->members_ref[2] = NULL;
			else
			{
				if(isset($this->ids['desc'][2]) && isset($this->identifier['desc'][2]))
				{
					$descFamily = array('id' => $this->ids['desc'][2], 'identifier' => $this->identifier['desc'][2], 'checked' => FALSE, 'readonly' => FALSE);
					$this->members_ref[2]->descFamily = $descFamily;
				}
				
				if(isset($this->ids['this']) && isset($this->identifier['this']))
				{
					$checked = TRUE;
					$readonly = ($this->recognition['type'] == 1) ? TRUE : FALSE;
					$ascFamily = array('id' => $this->ids['this'], 'identifier' => $this->identifier['this'], 'checked' => $checked, 'readonly' => $readonly);
					$this->members_ref[2]->ascFamily = $ascFamily;
				}
			}
			if($AGmyAdmin && $this->members_ref[2])
			{
				if(!$this->members_ref[2]->descFamily['identifier'])
				{
					$this->members_ref[2]->descFamily['identifier'] = $this->identifier['this'].'1';
					$this->identifier['desc'][2] = $this->identifier['this'].'1';
				}
			}
		}
		foreach($this->members_ref[3] as $key => $userbox)
		{
			$userbox->countFamilyChildren = $this->count_children;
			
			$checked = (in_array($this->recognition['type'], array(1, 5))) ? TRUE : FALSE;
			$readonly = ($this->recognition['type'] == 1) ? TRUE : FALSE;
			$descFamily = array('id' => $this->ids['this'], 'identifier' => $this->identifier['this'], 'checked' => $checked, 'readonly' => $readonly);
			$userbox->descFamily = $descFamily;
			
			if(!$userbox->ascFamily['id'])
			{
				$searchInParents = AG_Operation::searchInParents($userbox->info[DBT_USER_INFO_C1], $familyArrayParents);
				$id_family = $searchInParents['id_family'];
				if($id_family)
				{
					$parent = $searchInParents['parent'];
					$ascFamily = array('id' => $id_family, 'identifier' => $familyArrayIdentif[$id_family], 'checked' => FALSE, 'readonly' => FALSE);
					//print '<pre>';var_export($familyArrayIdentif);exit;
					if($id_family)
						$userbox->ascFamily = $ascFamily;
				}
			}
			if($this->recognition['type'] == 2)
			{
				// fiind copil in familia de tip 2 ii stergem familia in care este parinte
				//print '<pre>'.$userbox->info['id'].' -> '; var_export($id_family);
				//if($id_family && $id_family != $AGmyIDFamily) // TODO: nu stiu la ce ajuta asta
					//$this->deleteMembersInFamilyObj($id_family, $arrayFamilyObj);
				//
				if($userbox->ascFamily['id'] == $this->ids['asc'])
				{
					unset($this->members_ref[3][$key]);
					$reset_array_keys = array();
					$n = 0;
					foreach($this->members_ref[3] as $temp_obj)
					{
						$temp_obj->internalRelation['index'] = $n;
						$reset_array_keys[] = $temp_obj;
						$n++;
					}
					unset($this->members_ref[3]);
					$this->members_ref[3] = $reset_array_keys;
					unset($reset_array_keys);
					$this->count_children--;
				}
			}
			
			/*if($this->info['id_family'] == 2)
			{
				print '<pre>'.$key.' -> '; var_export($id_family);
			}*/
			
			if($AGmyAdmin && isset($this->members_ref[3][$key]))
			{
				
				if(!$this->members_ref[3][$key]->ascFamily['identifier'])
				{
					$new_identif = ($this->identifier['this'] === '0') ? '1' : $this->identifier['this'];
					$new_identif .= $key+1;
					$this->members_ref[3][$key]->ascFamily['identifier'] = $new_identif;
					$this->identifier['asc'] = $new_identif;
				}
			}
			
			
		}
		
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function calculateMembersCoord()
	{
		/*if($this->info['id_family'] == 1)
		{
			print '<pre>'; var_export($this->members_ref[3]); exit;
		}*/
		
		if($this->members_ref[1])
			$this->members_ref[1]->setCoord($this->recognition, $this->count_children);
		if($this->members_ref[2])
			$this->members_ref[2]->setCoord($this->recognition, $this->count_children);
		foreach($this->members_ref[3] as $key => $userbox)
			$userbox->setCoord($this->recognition, $this->count_children);
		
		$this->setDimension();
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function HTMLcode($display = 'block')
	{
		global $AGmyIDTree, $AGmyAdmin;
		
		/*if($this->info['id_family'] == 2)
		{
			print '<pre>'; var_export($this->members_ref); exit;
		}*/
		
		$html_code = NULL;
		
		$width = 0;
		$paddingLeft = 0;
		if($this->recognition['type'] == 4 && $this->recognition['align'] == 1)
			$paddingLeft = $this->width;
		elseif($this->recognition['type'] == 4 && $this->recognition['align'] == 2)
			$width = $this->width;
		else
		{
			$width = ceil($this->width/2);
			$paddingLeft = ceil($this->width/2);
		}
		
		$background_image = base_url().'codes/AG_FamilyBoxLines.php';
		$background_image .= '?familyType='.$this->recognition['type'];
		$background_image .= '&amp;familyAlign='.$this->recognition['align'];
		$background_image .= '&amp;familyGrade='.$this->recognition['grade'];
		$background_image .= '&amp;familyChildren='.$this->count_children;
		$background_image .= '&amp;familyWidth='.$this->width;
		$background_image .= '&amp;familyHeight='.$this->height;
		$background_image .= '&amp;exRelatii='.$this->exRelatii;
		$background_image .= '&amp;exRelatieActiva='.$this->exRelatieActiva;
		$background_image .= '&amp;box_type='.$this->box_type;
		
		$display = 'none';
		if($this->recognition['type'] == 1)
			$display = 'block';
		else
		if(in_array($this->recognition['type'], array(2, 3)) && in_array($this->identifier['this'], $_SESSION[SESSION]['AGmyView'][$AGmyIDTree]['desc']))
		{
			foreach($_SESSION[SESSION]['AGmyView'][$AGmyIDTree]['desc'] as $local_identif)
				if($this->identifier['this'] === $local_identif)
					$display = 'block';
		}
		else
		if(($this->recognition['type'] == 5) && in_array($this->identifier['this'], $_SESSION[SESSION]['AGmyView'][$AGmyIDTree]['asc']))
		{
			foreach($_SESSION[SESSION]['AGmyView'][$AGmyIDTree]['asc'] as $local_identif)
				if($this->identifier['this'] === $local_identif)
					$display = 'block';
		}
		
		$html_code .= '<div id="FamilyBox_'.$this->identifier['this'].'" class="ag_familybox" style="background-image:url('.$background_image.'); padding-left:'.$paddingLeft.'px; width:'.$width.'px; height:'.$this->height.'px; margin-left:'.$this->marginLeft.'px; margin-top:'.$this->marginTop.'px; display:'.$display.';">';
		$html_code .= '<span id="FamilyBox_'.$this->identifier['this'].'c" style="display:none;">'.$this->count_children.'</span>';
		
		// butoane pentru ex Relatii -----------------------
		if($this->recognition['type'] == 1)
		{
			// parinte 1
			if($this->members_ref[1]->info[DBT_USER_INFO_C1] > 0)
			{
				$c1 = count($this->exRelatiiButtons[1]);
				$html_code .= '<div class="agFamilyBoxExRelButtons" style="width:'.AGFORMAT_T1_EX_W.'px; height:'.AGFORMAT_T1_EX_H.'px; margin-left:'.($this->members_ref[1]->marginLeft-AGFORMAT_T1_EX_W).'px; margin-top:'.$this->members_ref[1]->marginTop.'px; background-image:url('.base_url().'codes/AG_FamilyBoxLines.php?familyType=1&amp;familyAlign=1&amp;familyWidth='.AGFORMAT_T1_EX_W.'&amp;familyHeight='.AGFORMAT_T1_EX_H.'&amp;exRelatii='.$c1.'&amp;option=2);">';
				for($n=5; $n>=1; $n--)
				{
					$marginT = ($n == 5) ? 'margin-top:7px;' : '';
					if($AGmyAdmin && $n == $c1 && $c1 < 5)
					{
						$visibility = 'visibility:visible;';
						$html_code .= '<span onclick="AGUBEX_('.$n.', 1)" class="ag_userbox_icon_exrelPlus" style="'.$marginT.$visibility.'">&nbsp;</span>';
					}
					else
					{
						$visibility = (isset($this->exRelatiiButtons[1][$n-1])) ? 'visibility:visible;' : 'visibility:hidden;';
						$html_code .= '<span onclick="AGUBEX_('.$n.', 1)" class="ag_userbox_icon_exrel" style="'.$marginT.$visibility.'">&nbsp;</span>';
					}
				}
				$html_code .= '</div>';
			}
			// parinte 2
			if($this->members_ref[2]->info[DBT_USER_INFO_C1] > 0)
			{
				$c2 = count($this->exRelatiiButtons[2]);
				$html_code .= '<div class="agFamilyBoxExRelButtons" style="width:'.AGFORMAT_T1_EX_W.'px; height:'.AGFORMAT_T1_EX_H.'px; margin-left:'.($this->members_ref[2]->marginLeft+AGFORMAT_T1_UBW).'px; margin-top:'.$this->members_ref[2]->marginTop.'px; background-image:url('.base_url().'codes/AG_FamilyBoxLines.php?familyType=1&amp;familyAlign=2&amp;familyWidth='.AGFORMAT_T1_EX_W.'&amp;familyHeight='.AGFORMAT_T1_EX_H.'&amp;exRelatii='.$c2.'&amp;option=2);">';
				for($n=5; $n>=1; $n--)
				{
					$marginT = ($n == 5) ? 'margin-top:7px;' : '';
					if($AGmyAdmin && $n == $c2 && $c2 <= 5)
					{
						$visibility = 'visibility:visible;';
						$html_code .= '<span onclick="AGUBEX_('.$n.', 2)" class="ag_userbox_icon_exrelPlus" style="margin-left:13px; '.$marginT.$visibility.'">&nbsp;</span>';
					}
					else
					{
						$visibility = (isset($this->exRelatiiButtons[2][$n-1])) ? 'visibility:visible;' : 'visibility:hidden;';
						$html_code .= '<span onclick="AGUBEX_('.$n.', 2)" class="ag_userbox_icon_exrel" style="margin-left:13px; '.$marginT.$visibility.'">&nbsp;</span>';
					}
				}
				$html_code .= '</div>';
			}
		}
		// -------------------------------------------------
		
		if($this->members_ref[1])
			$html_code .= $this->members_ref[1]->HTMLcode();
		
		if($this->members_ref[2])
			$html_code .= $this->members_ref[2]->HTMLcode();
		
		if($this->recognition['type'] != 3)
		foreach($this->members_ref[3] as $key => $userbox)
			$html_code .= $userbox->HTMLcode();
		
		$html_code .= $this->getTagg();
		
		$html_code .= '</div>';
		
		return $html_code;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function setDimension()
	{
		switch($this->recognition['type'])
		{
			case 1:
			case -1:
				if($this->count_children > 2)
					$this->width = ($this->count_children * AGFORMAT_T1_UBW) + (($this->count_children-1) * (AGFORMAT_T1_C_DIST - AGFORMAT_T1_UBW));
				else
					$this->width = (2 * AGFORMAT_T1_UBW) + ((abs(AGFORMAT_T1_P1_X) + abs(AGFORMAT_T1_P2_X)) - AGFORMAT_T1_UBW);
				$this->height = AGFORMAT_T1_UBH + (((AGFORMAT_T1_P1_Y >= AGFORMAT_T1_P2_Y) ? AGFORMAT_T1_P1_Y : AGFORMAT_T1_P2_Y) + AGFORMAT_T1_C_Y);
				break;
			case 2:
			case -2:
				$temp_count_children = ($this->count_children%2) ? $this->count_children+1 : $this->count_children;
				if($this->count_children >= 1)
					$this->width = (($temp_count_children * AGFORMAT_T2_UBW) + AGFORMAT_T2_C_SPACE) + (($temp_count_children-1) * (AGFORMAT_T2_C_DIST - AGFORMAT_T2_UBW));
				else
					$this->width = (2 * AGFORMAT_T2_UBW) + ((abs(AGFORMAT_T2_P1_X) + abs(AGFORMAT_T2_P2_X)) - AGFORMAT_T2_UBW);
				$this->height = AGFORMAT_T2_UBH + ((AGFORMAT_T2_P1_Y >= AGFORMAT_T2_P2_Y) ? AGFORMAT_T2_P1_Y : AGFORMAT_T2_P2_Y);
				break;
			case 3:
			case -3:
				$this->width = (2 * AGFORMAT_T3_UBW) + ((abs(AGFORMAT_T3_P1_X) + abs(AGFORMAT_T3_P2_X)) - AGFORMAT_T3_UBW);
				$this->height = AGFORMAT_T3_UBH + ((AGFORMAT_T3_P1_Y >= AGFORMAT_T3_P2_Y) ? AGFORMAT_T3_P1_Y : AGFORMAT_T3_P2_Y);
				break;
			case 4:
			case -4:
				if($this->count_children > 2)
					$this->width = AGFORMAT_T4_C_DIST1 + ($this->count_children * AGFORMAT_T4_UBW) + (($this->count_children-1) * (AGFORMAT_T4_C_DIST - AGFORMAT_T4_UBW));
				elseif($this->recognition['align'] == 1)
					$this->width = AGFORMAT_T4_UBW + abs(AGFORMAT_T4_P_X);
				elseif($this->recognition['align'] == 2)
					$this->width = AGFORMAT_T4_UBW + abs(AGFORMAT_T4_P_X);
				
				$this->height = AGFORMAT_T4_UBH + (AGFORMAT_T4_P_Y + AGFORMAT_T4_C_Y);
				break;
			case 5:
			case -5:
				if($this->count_children > 2)
					$this->width = ($this->count_children * AGFORMAT_T5_UBW) + (($this->count_children-1) * (AGFORMAT_T5_C_DIST - AGFORMAT_T5_UBW));
				else
					$this->width = (2 * AGFORMAT_T5_UBW) + ((abs(AGFORMAT_T5_P1_X) + abs(AGFORMAT_T5_P2_X)) - AGFORMAT_T5_UBW);
				
				$this->height = AGFORMAT_T5_UBH + AGFORMAT_T5_P_Y + AGFORMAT_T5_P_MB;
				break;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function getTagg()
	{
		// eticheta familiei
		$etichetaPosX = 0;
		$etichetaPosY = 0;
		switch($this->recognition['type'])
		{
			case 1:
			case -1:
				$etichetaPosX = AGFORMAT_T1_ET_X;
				$etichetaPosY = AGFORMAT_T1_ET_Y;
				$etichetaW = AGFORMAT_T1_ET_W;
				$etichetaH = AGFORMAT_T1_ET_H;
				
				$marginLeft = $etichetaPosX - ceil($etichetaW / 2);
				$marginTop = $etichetaPosY;
				break;
			case 2:
			case -2:
				$etichetaPosX = AGFORMAT_T2_ET_X;
				$etichetaPosY = AGFORMAT_T2_ET_Y;
				$etichetaW = AGFORMAT_T2_ET_W;
				$etichetaH = AGFORMAT_T2_ET_H;
				
				$marginLeft = $etichetaPosX - ceil($etichetaW / 2);
				$marginTop = $etichetaPosY;
				break;
			case 3:
			case -3:
				$etichetaPosX = AGFORMAT_T3_ET_X;
				$etichetaPosY = AGFORMAT_T3_ET_Y;
				$etichetaW = AGFORMAT_T3_ET_W;
				$etichetaH = AGFORMAT_T3_ET_H;
				
				$marginLeft = $etichetaPosX - ceil($etichetaW / 2);
				$marginTop = $etichetaPosY;
				break;
			case 4:
			case -4:
				$etichetaPosX = AGFORMAT_T4_ET_X;
				$etichetaPosY = AGFORMAT_T4_ET_Y;
				$etichetaW = AGFORMAT_T4_ET_W;
				$etichetaH = AGFORMAT_T4_ET_H;
				
				$marginTop = $etichetaPosY;
				if($this->recognition['align'] == 1)
					$marginLeft = ($etichetaW + AGFORMAT_T4_ET_X) * -1;
				elseif($this->recognition['align'] == 2)
					$marginLeft = AGFORMAT_T4_ET_X;
				break;
			case 5:
			case -5:
				$etichetaPosX = AGFORMAT_T5_ET_X;
				$etichetaPosY = AGFORMAT_T5_ET_Y;
				$etichetaW = AGFORMAT_T5_ET_W;
				$etichetaH = AGFORMAT_T5_ET_H;
				
				$marginLeft = $etichetaPosX - ceil($etichetaW / 2);
				$marginTop = $etichetaPosY;
				break;
		}
		
		$tagbox_class = NULL;
		switch($this->box_type)
		{
			case 1: $tagbox_class = 'ag_tagbox'; break;
			case 2: $tagbox_class = 'ag_tagbox'; break;
			case 3: $tagbox_class = 'ag_tagbox_sablon'; break;
		}
		$tagbox_value = (isset($this->info['name'])) ? $this->info['name'] : NULL;
		//$tagbox_value = 'FamilyBox_'.$this->identifier['this'];
		//$tagbox_value .= '<br />id_family: '.$this->info['id_family'];
		//$tagbox_value .= '<br />conectTo: id_family ['.$this->conectTo['id_family'].'],  id_user ['.$this->conectTo['id_user'].']';
		//$tagbox_value .= '<br />conectToCoord: ('.$this->conectToCoord[0].'], '.$this->conectToCoord[1].')';
		//$tagbox_value .= '<br />marginLeft: '.$this->marginLeft;
		//$tagbox_value .= '<br />marginTop: '.$this->marginTop;
		//$tagbox_value = $this->identifier['this'].'<br />'.$this->recognition['type'];
		return '<div id="FamilyTagBox_'.$this->identifier['this'].'" class="'.$tagbox_class.'" style="width:'.$etichetaW.'px; height:'.$etichetaH.'px; margin-left:'.$marginLeft.'px; margin-top:'.$marginTop.'px;">'.$tagbox_value.'</div>';
	}
	// ========================================================================
}
//
//
// pentru informatii suplimentare despre aceasta clasa, consulta documentatia
// pe adresa /documentatie/AG_FamilyBox.html
?>