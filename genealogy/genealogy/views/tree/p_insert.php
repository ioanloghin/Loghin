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
                <h1>Genealogy / Insert member</h1>
                <?php
				if($POST->get_successful())
					echo '<div style="margin:87px 10px 70px 0; text-align:center;"><strong style="color:black;">Profilul a fost adaugat cu succes!!!<br /><br /><a style="color:blue;" href="'.anchor('tree', 'graph', $params['tree_id'], $params['member_id']).'">Inapoi la arborele genealogic</a></strong></div>';
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
                                <div class="field_box " style="line-height:26px;"> <strong style="color:#039;"><?php
								if($params['family_id'])
									$family = $gen->get_family($params['family_id']);
								else
									$family = array('name' => '<em style="color:red">Familie Nou&#259;</em>');
								
								echo $family['name'];
								?></strong></div>
                                <div class="error_box"><p class="info">&nbsp;</p></div>
                                <div class="cleft" style="height:5px;"></div>
                                <label>Rela&#355;ie:</label>
                                <div class="field_box " style="line-height:26px;"> <strong style="color:#039;"><?php $rels = array(1=>'p&#259;rinte (tat&#259;)', 2=>'parinte (mam&#259;)', 3=>'copil'); echo $rels[$params['rel_id']]; ?></strong> &icirc;n Fam.<strong style="color:#039;"><?php echo $family['name']; ?></strong></div>
                                <div class="error_box"><p class="info">&nbsp;</p></div>
                                <div class="cleft" style="height:5px;"></div>
                        </fieldset>
                        
                        <div id="FamilyMembers">
                            <fieldset>
                                <legend>New Member</legend>
                                <div class="cleft" style="height:15px;"></div>
                                <label>Loghin User Name:</label>
                                <div class="field_box rad3"><input class="field size rad3" name="loghin_id" type="text" value="<?php echo $POST->get_var('loghin_id', 'post|sess');?>" /></div>
                                <div class="error_box"><p class="info">Numele de utilizator</p></div>
                                <div class="cleft" style="height:5px;"></div>
                                
                                <div style="margin-left:183px; width:260px; margin-bottom:5px; text-align:center;">sau</div>
                                
                                <label>User Name (provizoriu):</label>
                                <div class="field_box rad3"><input class="field size rad3" name="username" type="text" value="<?php echo $POST->get_var('username', 'post|sess');?>" /></div>
                                <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                                <div class="cleft" style="height:5px;"></div>
                                
                                <label>First Name:</label>
                                <div class="field_box rad3"><input class="field size rad3" name="firstname" type="text" value="<?php echo $POST->get_var('firstname', 'post|sess');?>" /></div>
                                <div class="error_box"><p class="info">&nbsp;</p></div>
                                <div class="cleft" style="height:5px;"></div>
                                
                                <label>Last Name:</label>
                                <div class="field_box rad3"><input class="field size rad3" name="lastname" type="text" value="<?php echo $POST->get_var('lastname', 'post|sess');?>" /></div>
                                <div class="error_box"><p class="info">&nbsp;</p></div>
                                <div class="cfix"></div>
                                <div class="cleft" style="height:5px;"></div>
                                
                                <label>Gender:</label>
                                <div class="radio_box rad3"><input id="gender1_1" type="radio" name="gender" value="1" /><label for="gender1_1">Male</label><input id="gender1_2" type="radio" name="gender" value="2" /><label for="gender1_2">Female</label></div>
                                <div class="error_box"><p class="info">&nbsp;</p></div>
                                <div class="cfix"></div>
                                <div class="cleft" style="height:5px;"></div>
                                
                                <!--<label>Parental Grade:</label>
                                <div class="field_box rad3"><select class="size" name="lastname0"><option>select </option></select></div>
                                <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                                <div class="cfix"></div>
                                <div class="cleft" style="height:5px;"></div>-->
                                
                                <label>&nbsp;</label>
                                <div class="radio_box rad3"><input id="life1_1" type="radio" name="life1" value="1" /><label for="life1_1">Life</label><input id="life1_2" type="radio" name="life1" value="2" /><label for="life1_2">Died</label></div>
                                <div class="error_box"><p class="info">&nbsp;</p></div>
                                <div class="cfix"></div>
                                <div class="cleft" style="height:5px;"></div>
                                
                                <label>Birthday:</label>
                                <div class="field_box left rad3"><select style="width:80px;" class="size" name="born_d"><option>select </option>
                                <?php
                                for($i=1; $i<=31; $i++)
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                ?></select></div>
                                <div class="field_box left rad3" style="margin-left:10px;"><select style="width:80px;" class="size" name="born_m"><option>select </option>
                                <?php
                                for($i=1; $i<=12; $i++)
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                ?></select></div>
                                <div class="field_box left rad3" style="margin-left:10px;"><input type="text" style="width:74px; height:20px;" class="size" name="born_y" placeholder="ex. 1989" /></div>
                                <div class="error_box"><p class="info">&nbsp;</p></div>
                                <div class="cfix"></div>
                                <div class="cleft" style="height:5px;"></div>
                                
                                <label>Death Date:</label>
                                <div class="field_box left rad3"><select style="width:80px;" class="size" name="dead_d"><option>select </option>
                                <?php
                                for($i=1; $i<=31; $i++)
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                ?></select></div>
                                <div class="field_box left rad3" style="margin-left:10px;"><select style="width:80px;" class="size" name="dead_m"><option>select </option>
                                <?php
                                for($i=1; $i<=12; $i++)
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                ?></select></div>
                                <div class="field_box left rad3" style="margin-left:10px;"><input type="text" style="width:74px; height:20px;" class="size" name="dead_y" placeholder="ex. 1989" /></div>
                                <div class="error_box"><p class="info">Apare la selectare decedat</p></div>
                                <div class="cfix"></div>
                                <div class="cleft" style="height:5px;"></div>
                                
                                <label>Add Photo:</label>
                                <div class="field_box rad3"><input size="13" class="size" name="lastname0" type="file" value="<?php echo $POST->get_var('lastname0', 'post|sess');?>" /></div>
                                <div class="error_box"><p class="info">&nbsp;</p></div>
                                <div class="cfix"></div>
                                <div class="cleft" style="height:5px;"></div>
                                
                            </fieldset>
                        </div>
                        <div id="LoaderIcon" style="margin-left:183px; width:260px; margin-top:5px; visibility:hidden;"><img src="<?php echo base_image('harmony', 'layout2/ajax-loader.gif');?>" style="display:block; margin:0 auto;" width="16" height="11" alt="loading ..." /></div>
                        
                        <fieldset style="margin-left:183px; width:260px;" class="clear">
                            <input type="hidden" name="antirefresh" value="<?php echo $POST->antirefresh();?>" />
                            <div class="submit_box1 rad3" style="width:100px; margin:10px auto 0 auto;"><button class="gradBlueButton rad3" name="add">save</button></div>
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