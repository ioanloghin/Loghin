<div id="Content">
	<div id="AG_Page" class="tree_create">
    	<div class="leftColumn clear rad5-top" style="background-color:#E7DCCA;">
        	<div class="left">
            	<!-- Left Column -->
                <div class="rad5-top-left" style="background-color:#F8F5F3;">
                    <div class="h10"></div>
                    <div class="info_fix">
                        <span class="title"><?php echo $infoUser['fullname'];?></span>
                        <span class="other"><?php echo $infoUser['age'].''.$infoUser['city'].' '.$infoUser['country'];?>&nbsp;</span>
                    </div>
                    <!-- Profile image -->
                    <?php $img_src = ($infoUser['image']) ? $infoUser['image'] : base_image('harmony', 'default_image.png');?>
                    <div class="image_mask rad5"><div class="bwhite rad5"><img src="<?php echo $img_src;?>" width="146" alt="" /></div></div>
                    <!-- Button: change profile -->
                    <div class="change_profile rad5-bottom"><?php echo ($MyUser->logged()) ? '<a href="#">Change Profile</a>' : '<a href="#">Login</a>';?></div>
                    <div class="miniDNA" style="margin-top:20px; margin-bottom:0px;"></div>
                </div>
                <ul class="column_list">
                    <li class="item first clear">
                        <a class="title" href="<?php echo anchor('tree', 'create', 'info');?>">Create Tree</a>
                    </li>
                    
                    <li class="miniDNA">&nbsp;</li>
                    
                    <li class="item node">
                        <span class="title">Members</span><span class="icon">&nbsp;</span>
                        <div class="cleft"></div>
                        <ul class="more">
                            <!--<li class="miniDNA">&nbsp;</li>-->
                            <li><a href="#"><span class="icon">&nbsp;</span>Adauga ascendent</a></li>
                            <li><a href="#"><span class="icon">&nbsp;</span>Adauga descendent</a></li>
                        </ul>
                    </li>
                    
                    <li class="miniDNA">&nbsp;</li>
                    
                    <li class="item">
                        <a class="title" href="#" style="width:180px;">Import</a>
                        <div class="cleft"></div>
                    </li>
                    <li class="miniDNA">&nbsp;</li>
                </ul>
                <!-- end Left Column -->
            </div>
            <div class="right rad5-top-right">
                <h1>Genealogy / Delete member</h1>
                <?php
				if($POST->get_successful())
					echo '<div style="margin:87px 10px 70px 0; text-align:center;"><strong style="color:black;">Membrul a fost eliminat cu succes!!!<br /><br /><a style="color:blue;" href="'.anchor('tree', 'graph', $params['tree_id'], $params['member_id']).'">Inapoi la arborele genealogic</a></strong></div>';
				else
				{
					?>
                    <form method="post" action="" class="clean_form clear">
                        <?php $readonly = ($MyUser->logged());?>
                        <fieldset>
                            <?php
                            if($POST->errors())
                            {
                                echo '<div class="errors" style="color:red;">';
                                foreach($POST->errors() as $error)
                                    echo $error.'<br />';
                                echo '</div>';
                            }
                            
                            ?>
                            <legend>Account principal <!--<label for="myself" class="right myself">myself</label><input<?php echo ($POST->get_var('myself', 'post|sess')) ? ' checked="checked"' : NULL;?> id="myself" type="checkbox" class="right myself" name="myself" value="1" />--></legend>
                            <div class="cleft" style="height:15px;"></div>
                            <label>Account principal:</label>
                            <div class="field_box " style="line-height:26px;"> <strong style="color:#039;"><?php echo $MyUser->get_loghin_id(); ?></strong></div>
                            <div class="error_box"><p class="info">&nbsp;</p></div>
                            <div class="cleft" style="height:5px;"></div>
                            <label>Familie:</label>
                            <div class="field_box " style="line-height:26px;"> <strong style="color:#039;"><?php $family = $gen->get_family($params['family_id']); echo $family['name']; ?></strong></div>
                            <div class="error_box"><p class="info">&nbsp;</p></div>
                            <div class="cleft" style="height:5px;"></div>
                            <label>User eliminat:</label>
                            <div class="field_box " style="line-height:26px;"> <strong style="color:#039;"><?php $user = $acc_api->get_account($gen->member2account($params['member_id'])); echo $user['loghin_id']; ?></strong></div>
                            <div class="error_box"><p class="info">&nbsp;</p></div>
                            <div class="cleft" style="height:5px;"></div>
                        </fieldset>
                        <div id="LoaderIcon" style="margin-left:183px; width:260px; margin-top:5px; visibility:hidden;"><img src="<?php echo base_image('harmony', 'layout2/ajax-loader.gif');?>" style="display:block; margin:0 auto;" width="16" height="11" alt="loading ..." /></div>
                        
                        <fieldset style="margin-left:183px; width:260px;" class="clear">
                            <input type="hidden" name="antirefresh" value="<?php echo $POST->antirefresh();?>" />
                            <div class="submit_box1 rad3" style="width:100px; margin:10px auto 0 auto;"><button class="gradBlueButton rad3" name="del">delete</button></div>
                        </fieldset>
                        
                        
                    </form>
                    <?php
				}
				?>
                <br /><br /><br /><br />
            </div>
        </div>
    </div>
</div>