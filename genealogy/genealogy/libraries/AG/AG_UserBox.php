<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
//
//
//
class AG_UserBox
{
	private $acc_api;	// Accounts_API reference
	private $gen;		// Genealogy Model reference
	
	private $member_id;
	private $account_id;
	
	private $box_type = 2; // 1 - normal | 2 - no hover | 3 - sablon | 4 - mambru fara account_id
	private $width; // latimea containerului
	private $height; // inaltimea containerului
	private $posX = 0; // coordonata X in raport cu box-ul familiei
	private $posY = 0; // coordonata Y in raport cu box-ul familiei
	private $marginLeft = 0; // distanta pe axa 0X
	private $marginTop = 0; // distanta pe axa 0Y
	private $info = array(); // lista cu informatii despre utilizator
	public $internalRelation = array('id' => 0, 'index' => 0); // ID-ul relatiei interne, din interiorul familiei, si INDEX-ul care rep. numerotarea copiilor, unchiilor etc.
	public $externalRelation = array('id' => 0, 'index' => 0); // ID-ul relatiei externe din perspectiva userului selectat
	public $ascFamily = array('id' => 0, 'identifier' => NULL, 'checked' => FALSE, 'readonly' => FALSE);
	public $descFamily = array('id' => 0, 'identifier' => NULL, 'checked' => FALSE, 'readonly' => FALSE);
	public $countFamilyChildren = 0;
	public $family_obj = NULL; // rferinta catre obiectl familiei
	//
	// ========================================================================
	public function __construct($member_id = 0, $box_type = 2)
	{
		global $acc_api, $gen;
		
		// Accounts_API initialize
		$this->acc_api = &$acc_api;
		
		// Genealogy Model initialize
		$this->gen = &$gen;
		
		if(DIRECT_MODE)
		{
			// save member id
			$this->member_id = $member_id;
			
			// get account_id
			$this->account_id = $member_id;
		}
		else
		{
			// save member id
			$this->member_id = $member_id;
			
			// get account_id
			$this->account_id = $this->gen->member2account($this->member_id);
		}
		
		$this->width  = AGFORMAT_T1_UBW;
		$this->height = AGFORMAT_T1_UBH;
		
		// setam id-ul utilizatorului
		$this->info['member_id'] = $this->member_id;
		
		// cerem adaugarea tuturor datelor din db despre utilizator
		$this->set_obj_info();
		
		// setam tipul chenarului
		if(in_array($box_type, array(1, 2, 3, 4)))// array-ul reprezinta valorile posibile pentru $box_type
			$this->box_type = $box_type;
		else// incercam o autodetectare
		{
			if($this->member_id > 0)
				$this->box_type = 1;
		}
		// verificam daca membrul are account_id
		if($this->box_type == 1 && $this->account_id == 0)
			$this->box_type = 4;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function __get($key)
	{
		if(isset($this->$key))
			return $this->$key;
		else
			return FALSE;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function set_obj_info()
	{
		if($this->member_id > 0)
		{
			$info = $this->get_db_info($this->account_id);
			$info['member_id']  = $this->member_id;
			$info['account_id'] = $this->account_id;
			
			$this->info = $info;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function get_db_info($account_id)
	{
		return $this->acc_api->get_account($account_id);
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function member_id()
	{
		return $this->member_id;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function account_id()
	{
		return $this->account_id;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function setInternalRelation($id_relation, $index = 0)
	{
		$relation = array('id' => 0, 'index' => 0);
		if(is_int($id_relation))
			$relation['id'] = $id_relation;
		if(is_int($index))
			$relation['index'] = $index;
		$this->internalRelation = $relation;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function HTMLcode($special = NULL)
	{
		$AGmyIDTree		= (defined('arg1')) ? arg1 : 0;
		$AGmyIDUser		= (defined('arg2')) ? arg2 : 0;
		$AGmyIDFamily	= 0;
		$AGmyIDRel		= 0;
		
		global $AGmyAdmin;
		$html_code = NULL;
		$AGchangeProfileDirection = NULL;
		$my_id_tree		= AG_Operation::myTree($this->family_obj['ids']['this']);
		$my_family_id	= $this->family_obj['ids']['this'];
		$my_id_user		= $this->info['member_id'];
		$my_id_rel		= $this->internalRelation['id'];
		
		if($this->box_type == 1 || $this->box_type == 4)
		{
			$htmid_sufix = ($this->internalRelation['id'] == 3) ? 'c' : 'p';
			$icons = array();
			// START desc icon ------------------------------------------------------
			$icons['desc'] = array();
			$icons['desc']['id'] = 'AGUBID_'.$this->info['member_id'].$htmid_sufix;// AGUBIA_ (Arbore Genealogic User Box Icon Desc)
			$icons['desc']['class'] = 'ag_userbox_icon_desc';
			$icons['desc']['class_sufix'] = NULL;// On, Null, ReadOnly, Plus
			$icons['desc']['onclick'] = 'AGexpandFamily(\''.$this->descFamily['identifier'].'\', \''.$this->info['member_id'].'\', \'Desc\', '.$this->countFamilyChildren.');';
			$icons['descP'] = array();
			$icons['descP']['id'] = 'AGUBIPD_'.$this->info['member_id'].$htmid_sufix;// AGUBIA_ (Arbore Genealogic User Box Icon Perspective Desc)
			$icons['descP']['class'] = 'ag_userbox_icon_profile_desc';
			$icons['descP']['class_sufix'] = NULL;// On, Null, ReadOnly, Plus
			$icons['descP']['onclick'] = 'ag_member_change(\'desc\', \''.$my_id_tree.'\', \''.$my_family_id.'\', \''.$my_id_user.'\', \''.$my_id_rel.'\');';
			if($this->internalRelation['id'] == 3)
				$icons['desc']['onclick'] = NULL;
			
			if($this->descFamily['id'])
			{
				if($this->descFamily['readonly'])
				{
					$icons['desc']['class_sufix'] = 'ReadOnly';
					$icons['desc']['onclick'] = NULL;
					$icons['descP']['class_sufix'] = 'ReadOnly';
					$icons['descP']['onclick'] = NULL;
				}
				elseif($this->descFamily['checked'])
					$icons['desc']['class_sufix'] = 'On';
				
				if(!$this->descFamily['readonly'])
					$icons['descP']['onclick'] = 'AGchangeTree('.$my_id_tree.', '.$my_id_user.', \'desc\');';
			}
			else
			{
				if($AGmyAdmin)
				{
					$icons['desc']['class_sufix'] = 'Plus';
					//$icons['desc']['onclick'] = NULL;
				}
				else
				{
					$icons['desc']['class_sufix'] = 'Null';
					$icons['desc']['onclick'] = NULL;
				}
				$icons['descP']['class_sufix'] = 'Null';
				$icons['descP']['onclick'] = NULL;
			}
			
			$bool_1 = ($this->family_obj['recognition']['type'] == 5 && in_array($this->internalRelation['id'], array(1, 2)) && $this->family_obj['recognition']['align'] != $this->internalRelation['id']);
			$bool_2 = ($this->family_obj['recognition']['type'] == 4);
			$bool_3 = ($this->family_obj['recognition']['type'] == 2 && $this->internalRelation['id'] == 3);
			
			if(($bool_1 || $bool_2 || $bool_3) && $icons['desc']['class_sufix'] != 'Null')
			{
				$icons['desc']['class_sufix'] = 'ReadOnly';
				$icons['desc']['onclick'] = NULL;
			}
			// ----------------------------------------------------------------------
			//
			//
			// START asc icon -------------------------------------------------------
			$icons['asc'] = array();
			$icons['asc']['id'] = 'AGUBIA_'.$this->info['member_id'].$htmid_sufix;// AGUBIA_ (Arbore Genealogic User Box Icon Asc)
			$icons['asc']['class'] = 'ag_userbox_icon_asc';
			$icons['asc']['class_sufix'] = NULL;// On, Null, ReadOnly, Plus
			$icons['asc']['onclick'] = 'AGexpandFamily(\''.$this->ascFamily['identifier'].'\', \''.$this->info['member_id'].'\', \'Asc\', '.$this->countFamilyChildren.');';
			$icons['ascP'] = array();
			$icons['ascP']['id'] = 'AGUBIPA_'.$this->info['member_id'].$htmid_sufix;// AGUBIA_ (Arbore Genealogic User Box Icon Perspective Asc)
			$icons['ascP']['class'] = 'ag_userbox_icon_profile_asc';
			$icons['ascP']['class_sufix'] = NULL;// On, Null, ReadOnly, Plus
			$icons['ascP']['onclick'] = 'ag_member_change(\'asc\', \''.$my_id_tree.'\', \''.$my_family_id.'\', \''.$my_id_user.'\', \''.$my_id_rel.'\');';
			if($this->internalRelation['id'] < 3)
				$icons['asc']['onclick'] = NULL;
			
			if($this->ascFamily['id'])
			{
				if($this->ascFamily['readonly'])
				{
					$icons['asc']['class_sufix'] = 'ReadOnly';
					$icons['asc']['onclick'] = 'Null';
					$icons['ascP']['class_sufix'] = 'ReadOnly';
					$icons['ascP']['onclick'] = NULL;
				}
				elseif($this->ascFamily['checked'])
					$icons['asc']['class_sufix'] = 'On';
				
				if(!$this->ascFamily['readonly'])
					$icons['ascP']['onclick'] = 'AGchangeTree(\''.$my_id_tree.'\', \''.$my_id_user.'\', \'asc\');';
			}
			else
			{
				if($AGmyAdmin)
				{
					$icons['asc']['class_sufix'] = 'Plus';
					//$icons['asc']['onclick'] = NULL;
				}
				else
				{
					$icons['asc']['class_sufix'] = 'Null';
					$icons['asc']['onclick'] = NULL;
				}
				$icons['ascP']['class_sufix'] = 'Null';
				$icons['ascP']['onclick'] = NULL;
			}
			
			$bool_1 = ($this->family_obj['recognition']['type'] == 2 && $this->internalRelation['id'] == 3);
			$bool_2 = ($this->family_obj['recognition']['type'] == 4);
			if(($bool_1 || $bool_2) && $icons['asc']['class_sufix'] != 'Null')
			{
				$icons['asc']['class_sufix'] = 'ReadOnly';
				$icons['asc']['onclick'] = NULL;
			}
			//
			// se creaza codul html pentru butoane
			$html_icons = array();
			$html_icons['asc'] = '<span id="'.$icons['asc']['id'].'" class="'.$icons['asc']['class'].$icons['asc']['class_sufix'].'" onclick="'.$icons['asc']['onclick'].'">&nbsp;</span>';
			$html_icons['ascP'] = '<a href="'.anchor('tree', 'graph', $my_id_tree, $my_id_user, 'asc').'" id="'.$icons['ascP']['id'].'" class="'.$icons['ascP']['class'].$icons['ascP']['class_sufix'].'">&nbsp;</a>';
			$html_icons['desc'] = '<span id="'.$icons['desc']['id'].'" class="'.$icons['desc']['class'].$icons['desc']['class_sufix'].'" onclick="'.$icons['desc']['onclick'].'">&nbsp;</span>';
			$html_icons['descP'] = '<a href="'.anchor('tree', 'graph', $my_id_tree, $my_id_user, 'desc').'" id="'.$icons['descP']['id'].'" class="'.$icons['descP']['class'].$icons['descP']['class_sufix'].'">&nbsp;</a>';
		}
		// ----------------------------------------------------------------------
		//
		switch($this->box_type)
		{
			case 1:
				$userbox_class = 'ag_userbox';
				$userbox_onclick = NULL;
				$htmlid_user = 'AGuserBox_'.$this->info['member_id'].$htmid_sufix;
				break;
			case 2:
				$userbox_class = 'ag_userbox_nohover';
				$userbox_onclick = NULL;
				$htmlid_user = NULL;
				break;
			case 3:
				$userbox_class = 'ag_userbox_sablon';
				// ---------------------------------------------
				$linked_data = array(
					'this' => array(
						'id' => 0,
						'identifier' => $this->family_obj['identifier']['this']
					),
					'asc' => array(
						'id' => $this->family_obj['ids']['asc'],
						'identifier' => $this->ascFamily['identifier']
					),
					'desc' => array(
						'id' => $this->descFamily['id'],
						'identifier' => $this->descFamily['identifier']
					)
				);
				$linked = AG_PoP2::get_linked($linked_data);
				$linked_id_user = (isset($linked['id_user'])) ? $linked['id_user'] : 0;
				$linked_direction = (isset($linked['direction'])) ? $linked['direction'] : NULL;
				// ---------------------------------------------
				$userbox_onclick = 'return goto(\''.anchor('tree', 'insert', $AGmyIDTree, $my_family_id, 0, $this->internalRelation['id'], $linked_id_user, $linked_direction).'\');';
				$htmlid_user = NULL;
				break;
			case 4:
				$userbox_class = 'ag_userbox_empty';
				$userbox_onclick = NULL;
				$htmlid_user = 'AGuserBox_'.$this->info['member_id'].$htmid_sufix;
				break;
		}
		if($this->info['member_id'] == $AGmyIDUser)
			$userbox_class .= ' ag_userbox_blue';
		//
		//
		$att_id = ($htmlid_user) ? ' id="'.$htmlid_user.'"' : NULL;
        $html_code .= '<div'.$att_id.' class="'.$userbox_class.'" style="width:'.$this->width.'px; height:'.$this->height.'px; margin-left:'.$this->marginLeft.'px; margin-top:'.$this->marginTop.'px;" onclick="'.$userbox_onclick.'">';
		
		if(in_array($this->box_type, array(1, 2, 4)))
		{
			$img_src = (isset($this->info[DBT_USER_INFO_C5]) && $this->info[DBT_USER_INFO_C5] && file_exists($this->info[DBT_USER_INFO_C5])) ? base_url($this->info[DBT_USER_INFO_C5]) : base_image('harmony', 'no_image_thumb.jpg');
			$firstname = (isset($this->info[DBT_USER_INFO_C2])) ? $this->info[DBT_USER_INFO_C2] : NULL;
			$lastname = (isset($this->info[DBT_USER_INFO_C3])) ? $this->info[DBT_USER_INFO_C3] : NULL;
			
			if($this->box_type == 1 || $this->box_type == 4)
				$html_code .= '<div class="agub_bar_desc">'.$html_icons['descP'].$html_icons['desc'].'<div class="agub_bar_line"></div></div>';
			$html_code .= '<div class="agub_image"><img onclick="ag_member_change(\''.$AGchangeProfileDirection.'\', '.$AGmyIDTree.', '.$my_family_id.', '.$this->info['member_id'].', '.$this->internalRelation['id'].');" style="float:left; background-color:#666;" src="'.$img_src.'" width="50" height="50" alt="" /></div>';
			if($this->box_type == 1 || $this->box_type == 4)
				$html_code .= '<div class="agub_bar_asc">'.$html_icons['asc'].$html_icons['ascP'].'<div class="agub_bar_line"></div></div>';
			$html_code .= '<div class="cleft"></div>';
			
			if($this->box_type == 4)
				$html_code .= '<div class="agub_name">Empty<br />- no account -</div>';
			else
				$html_code .= '<div class="agub_name">'.$firstname.'<br />'.$lastname.'</div>';
			
			$t_born = (isset($this->info['birthday'])) ? $this->info['birthday'] : NULL;
			$t_deces = (isset($this->info['deces'])) ? $this->info['deces'] : NULL;
			$age = AG_View::span_age($t_born, $t_deces);
			//$age = $this->info['member_id'];
			$html_code .= '<div class="agub_age">'.$age.'</div>';
		}
		if($this->box_type == 3)
		{
			$html_code .= '<div class="agub_image"><img onclick="" src="'.base_image('harmony', 'icons/add-user.png').'" width="48" height="48" alt="add person" title="" /></div>';
		}
        $html_code .= '</div>';
		return $html_code;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function setCoord($family_recog, $count_children)
	{
		// $count_children = 4; // numar copii in familie
		if(isset($family_recog['type']))
		{
			switch($family_recog['type'])
			{
				case 1:
					switch($this->internalRelation['id'])
					{
						case 1:
							$this->posX = AGFORMAT_T1_P1_X;
							$this->posY = AGFORMAT_T1_P1_Y;
							$this->setFixed();
							break;
						case 2:
							$this->posX = AGFORMAT_T1_P2_X;
							$this->posY = AGFORMAT_T1_P2_Y;
							$this->setFixed();
							break;
						case 3:
							/*if($this->family_obj['info']['family_id'] == 1)
							{
								print '<pre>'.$this->internalRelation['index'].' -> '; var_export($count_children).' ';
							}*/
							$local_distance = AGFORMAT_T1_C_DIST;
							if(!$count_children%2) // nr. impar
							{
								$local_start = $count_children / 2 - 0.5;
								$local_half = $count_children / 2;
								if($this->internalRelation['index'] <= $local_half)
								{
									$this->posX = ceil(($local_start - $this->internalRelation['index']) * $local_distance);
									if($this->posX)
										$this->posX *= -1;
								}
								else
									$this->posX = ceil((($this->internalRelation['index'] - (floor($local_half) + 1)) + $local_start) * $local_distance);
							}
							else// nr. par
							{
								$local_start = ($count_children - 1) / 2;
								$local_half = $count_children / 2;
								if($this->internalRelation['index'] <= $local_half)
								{
									$this->posX = ceil(($local_start - $this->internalRelation['index']) * $local_distance);
									if($this->posX)
										$this->posX *= -1;
									/*if($this->family_obj['info']['family_id'] == 1)
									print "ceil(($local_start - ".$this->internalRelation['index'].") * $local_distance) = ".$this->posX."";*/
								}
								else
								{
									$this->posX = ceil(($this->internalRelation['index'] - $local_start) * $local_distance);
									/*if($this->family_obj['info']['family_id'] == 1)
									   print "ceil((".$this->internalRelation['index']." - $local_start) * $local_distance) = ".$this->posX."";*/
								}
							}
							$this->posY = AGFORMAT_T1_C_Y;
							$this->setFixed();
							/*if($this->family_obj['info']['family_id'] == 1)
							print '<br />';*/
							break;
					}
					break;
				case 2:
				case -2:
					switch($this->internalRelation['id'])
					{
						case 1:
							$this->posX = AGFORMAT_T2_P1_X;
							$this->posY = AGFORMAT_T2_P1_Y;
							$this->setFixed();
							break;
						case 2:
							$this->posX = AGFORMAT_T2_P2_X;
							$this->posY = AGFORMAT_T2_P2_Y;
							$this->setFixed();
							break;
						case 3:
							$local_distance = AGFORMAT_T2_C_DIST;
							if($count_children%2)
								$count_children++;
							
							$local_start = $count_children / 2 - 0.5;
							$local_half = $count_children / 2;
							if($this->internalRelation['index'] <= $local_half)
							{
								$this->posX = ceil(($local_start - $this->internalRelation['index']) * $local_distance);
								if($this->internalRelation['index'] < $local_half)
									$this->posX += ceil(AGFORMAT_T2_C_SPACE/2);
								if($this->posX)
									$this->posX *= -1;
								if($this->internalRelation['index'] == $local_half)
									$this->posX += ceil(AGFORMAT_T2_C_SPACE/2);
							}
							else
							{
								$this->posX = ceil(($this->internalRelation['index'] - $local_start) * $local_distance);
								$this->posX += ceil(AGFORMAT_T2_C_SPACE/2);
							}
							
							$this->posY = AGFORMAT_T2_C_Y;
							$this->setFixed();
							break;
					}
					break;
				case 3:
				case -3:
					switch($this->internalRelation['id'])
					{
						case 1:
							$this->posX = AGFORMAT_T3_P1_X;
							$this->posY = AGFORMAT_T3_P1_Y;
							$this->setFixed();
							break;
						case 2:
							$this->posX = AGFORMAT_T3_P2_X;
							$this->posY = AGFORMAT_T3_P2_Y;
							$this->setFixed();
							break;
							$this->setFixed();
							break;
					}
					break;
				case 4:
				case -4:
					switch($this->internalRelation['id'])
					{
						case 1:
							if($family_recog['align'] == 2)
							{
								$this->posX = AGFORMAT_T4_P_X;
								$this->posY = AGFORMAT_T4_P_Y;
								$this->setFixed('right');
							}
							break;
						case 2:
							if($family_recog['align'] == 1)
							{
								$this->posX = AGFORMAT_T4_P_X * -1;
								$this->posY = AGFORMAT_T4_P_Y;
								$this->setFixed('left');
							}
							break;
						case 3:
							$local_distance = AGFORMAT_T4_C_DIST;
							
							if($this->internalRelation['index'] == 0)
							{
								$this->posX = AGFORMAT_T4_C_DIST1;
								if($family_recog['align'] == 1)
									$this->posX *= -1;
							}
							else
							{
								$this->posX = (AGFORMAT_T4_C_DIST * $this->internalRelation['index']) + AGFORMAT_T4_C_DIST1;
								if($family_recog['align'] == 1)
									$this->posX *= -1;
							}
							
							$this->posY = AGFORMAT_T4_C_Y;
							if($family_recog['align'] == 1)
								$this->setFixed('left');
							elseif($family_recog['align'] == 2)
								$this->setFixed('right');
							break;
					}
					break;
				case 5:
				case -5:
					switch($this->internalRelation['id'])
					{
						case 1:
							$this->posX = AGFORMAT_T5_P1_X;
							$this->posY = AGFORMAT_T5_P_Y;
							if($family_recog['align'] == 1)
								$this->posY += AGFORMAT_T5_P_MB;
							$this->setFixed();
							break;
						case 2:
							$this->posX = AGFORMAT_T5_P2_X;
							$this->posY = AGFORMAT_T5_P_Y;
							if($family_recog['align'] == 2)
								$this->posY += AGFORMAT_T5_P_MB;
							$this->setFixed();
							break;
						case 3:
							$local_distance = AGFORMAT_T5_C_DIST;
							if($count_children%2)
								$local_start = ($count_children - 1) / 2;
							else
								$local_start = $count_children / 2 - 0.5;
							$local_half = $count_children / 2;
							if($this->internalRelation['index'] <= $local_half)
							{
								$this->posX = ceil(($local_start - $this->internalRelation['index']) * $local_distance);
								if($this->posX)
									$this->posX *= -1;
							}
							else
								$this->posX = ceil(($this->internalRelation['index'] - $local_start) * $local_distance);
							
							$this->posY = AGFORMAT_T5_C_Y;
							$this->setFixed();
							break;
					}
					break;
			}
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	private function setFixed($align = 'center', $valign = 'top')
	{
		switch($align)
		{
			case 'left':
				$this->marginLeft = ceil($this->posX - $this->width);
				break;
			case 'center':
				$this->marginLeft = ceil($this->posX - ceil($this->width / 2));
				break;
			case 'right':
				$this->marginLeft = ceil($this->posX);
				break;
		}
		switch($valign)
		{
			case 'top':
				$this->marginTop = ceil($this->posY);
				break;
			case 'middle':
				$this->marginTop = ceil($this->posY - ceil($this->height / 2));
				break;
			case 'bottom':
				$this->marginTop = ceil($this->posY - $this->height);
				break;
		}
	}
	// ========================================================================
}
//
//
// pentru informatii suplimentare despre aceasta clasa, consulta documentatia
// pe adresa /documentatie/AG_UserBox.html
?>