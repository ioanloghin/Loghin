<?php
global $acc_api, $gen;
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


	<ul class="column_list">
	<?php
	// start afisare profil ------------------------------------------------------------------ //
	foreach($acc_api->getAllApprovals($MyUser->account_id()) as $k => $row):
		?>
        <li class="item <?php echo ($k == 0) ? 'first' : '';?>">
            <a class="title" href="<?php echo anchor('tree', 'approvals', $row['approval_id']);?>" style="width:180px;">Aviz <?php echo $row['approval_id'];?></a>
            <div class="cleft"></div>
        </li>
        <li class="miniDNA">&nbsp;</li>
		<?php
	endforeach;
	?>
    </ul>