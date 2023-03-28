<?php global $gen;?>
<table class="fix" width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td>
        	<div id="TopMenu">
                <ul>
                    <li><a class="agbut-home" href="<?php echo base_url();?>">&nbsp;</a></li>
                    <li class="agtm-line1"><span>&nbsp;</span></li>
                    <!--<li class="agtm-nod" onmouseover="showSubMenu('open', 'AGTM_sb1');" onmouseout="showSubMenu('close', 'AGTM_sb1');"><strong><span class="agtm-nod-title">Arbori</span><span class="agtm-nod-icon">&nbsp;</span></strong>
                        <ul id="AGTM_sb1" class="submenu">
                            <li class="agsFirst"><a href="<?php echo anchor('tree', 'create');?>"><span class="agtm_sb-left"><img src="<?php echo base_image('harmony', 'layout2/AG_TopMenu/submenu-but-icon.png');?>" width="15" height="5" alt="submenu-icon" title="" /></span>Creeaza arbore</a></li>
                            <?php
							if(DIRECT_MODE)
							{
								$arr = $gen->compatibility_get_member_tree($MyUser->account_id());
								$count = count($arr);
								foreach($arr as $n => $row)
									echo '<li class="'.(($n < $count-1) ? 'agsMiddle' : 'agsLast').'"><a href="'.anchor('tree', 'graph', 0, $MyUser->account_id(), 0, $row['family_id']).'"><span class="agtm_sb-left"><img src="'.base_image('harmony', 'layout2/AG_TopMenu/submenu-but-icon.png').'" width="15" height="5" alt="submenu-icon" title="" /></span>Family '.$row['family_id'].'</a></li>';
							}
							else
							{
								$arr = $gen->get_member_tree($MyUser->account_id());
								$count = count($arr);
								foreach($arr as $n => $row)
									echo '<li class="'.(($n < $count-1) ? 'agsMiddle' : 'agsLast').'"><a href="'.anchor('tree', 'graph', $row['tree_id'], $row['member_id']).'"><span class="agtm_sb-left"><img src="'.base_image('harmony', 'layout2/AG_TopMenu/submenu-but-icon.png').'" width="15" height="5" alt="submenu-icon" title="" /></span>'.$row[DBT_TREE_C3].'</a></li>';
							}
                            ?>
                        </ul>
                    </li>-->
                    <li><a href="<?php echo anchor('tree', 'graph');?>">Arbori</a></li>
                    <li class="agtm-line2"><span>&nbsp;</span></li>
                    <li><a href="<?php echo anchor('search');?>">Cautare</a></li>
                    <li class="agtm-line2"><span>&nbsp;</span></li>
                    <li><a href="<?php echo anchor('privat');?>">Privat</a></li>
                    <li class="agtm-line2"><span>&nbsp;</span></li>
                    <li><a href="http://structures.loghin.com">Structuri</a></li>
                    <li class="agtm-line2"><span>&nbsp;</span></li>
                    <li><strong>Administration</strong></li>
                </ul>
			</div>
        </td>
		<td style="width:336px;">
        	<form method="get" id="SearchBox" action="">
				<fieldset>
                    <button type="submit">&nbsp;</button>
                    <span class="sep">&nbsp;</span>
                    <input class="field" id="AGH_searchInput" onkeyup="SearchRecom('AGH_searchInput', 'AGH_searchRecom');" type="text" />
				</fieldset>
				<div id="AGH_searchRecom"><div id="AGH_searchRecom_fix"></div></div>
			</form>
    	</td>
	</tr>
</table>