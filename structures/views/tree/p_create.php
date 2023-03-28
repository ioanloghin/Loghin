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
                <h1>Genealogy / Create Tree</h1>
                <form method="post" action="" class="clean_form clear">
                    <?php $readonly = ($MyUser->logged());?>
                    <fieldset class="<?php echo ($readonly) ? ' opacity40' : NULL;?>">
                        <legend>Account principal <!--<label for="myself" class="right myself">myself</label><input<?php echo ($POST->get_var('myself', 'post|sess')) ? ' checked="checked"' : NULL;?> id="myself" type="checkbox" class="right myself" name="myself" value="1" />--></legend>
                        <div class="cleft" style="height:15px;"></div>
                        <label>Username:</label>
                        <div class="field_box rad3"><input<?php echo ($readonly) ? ' readonly="readonly"' : NULL;?> class="field size rad3" name="firstname0" type="text" value="<?php echo $POST->get_var('firstname0', 'post|sess');?>" /></div>
                        <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                        <div class="cleft" style="height:5px;"></div>
                        
                        <label>Password:</label>
                        <div class="field_box rad3"><input<?php echo ($readonly) ? ' readonly="readonly"' : NULL;?> class="field size rad3" name="lastname0" type="text" value="<?php echo $POST->get_var('lastname0', 'post|sess');?>" /></div>
                        <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                        <div class="cfix"></div>
                        <div class="cleft" style="height:5px;"></div>
                        <label>Repeat password:</label>
                        <div class="field_box rad3"><input<?php echo ($readonly) ? ' readonly="readonly"' : NULL;?> class="field size rad3" name="lastname0" type="text" value="<?php echo $POST->get_var('lastname0', 'post|sess');?>" /></div>
                        <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                        <div class="cfix"></div>
                        <div class="cleft" style="height:5px;"></div>
                        
                        <label>Email:</label>
                        <div class="field_box rad3"><input<?php echo ($readonly) ? ' readonly="readonly"' : NULL;?> class="field size rad3" name="lastname0" type="text" value="<?php echo $POST->get_var('lastname0', 'post|sess');?>" /></div>
                        <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                        <div class="cfix"></div>
                        <div class="cleft" style="height:5px;"></div>
                    </fieldset>
                    
                    <fieldset>
                        <legend>Family Name</legend>
                        <div class="cleft" style="height:15px;"></div>
                        <label>Crest Name:</label>
                        <div class="field_box rad3"><input<?php echo ($readonly) ? ' readonly="readonly"' : NULL;?> class="field size rad3" name="firstname0" type="text" value="<?php echo $POST->get_var('firstname0', 'post|sess');?>" /></div>
                        <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                        <div class="cleft" style="height:5px;"></div>
                        
                        <label>Profile Type:</label>
                        <div class="radio_box rad3"><input id="ptype_1" type="radio" name="ptype" value="1" /><label for="ptype_1">Public</label><input id="ptype_2" type="radio" name="ptype" value="2" /><label for="ptype_2">Private</label></div>
                        <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                        <div class="cfix"></div>
                        <div class="cleft" style="height:5px;"></div>
                        
                        <label>Add Photo:</label>
                        <div class="field_box rad3"><input<?php echo ($readonly) ? ' readonly="readonly"' : NULL;?> size="13" class="size" name="lastname0" type="file" /></div>
                        <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                        <div class="cfix"></div>
                        <div class="cleft" style="height:5px;"></div>
                        
                        <label class="h100">Add Description:</label>
                        <div class="field_box rad3"><textarea class="field size rad3 h100" rows="5" cols="20" name="lastname0"><?php echo $POST->get_var('lastname0', 'post|sess');?></textarea></div>
                        <div class="error_box h100"><p class="info">First and/or middle or middle initial</p></div>
                        <div class="cfix"></div>
                        <div class="cleft" style="height:5px;"></div>
                    </fieldset>
                    
                    <div id="FamilyMembers">
                        <fieldset>
                            <legend>Family Members</legend>
                            <div class="cleft" style="height:15px;"></div>
                            <label>Loghin User Name:</label>
                            <div class="field_box rad3"><input<?php echo ($readonly) ? ' readonly="readonly"' : NULL;?> class="field size rad3" name="firstname0" type="text" value="<?php echo $POST->get_var('firstname0', 'post|sess');?>" /></div>
                            <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                            <div class="cleft" style="height:5px;"></div>
                            
                            <div style="margin-left:183px; width:260px; margin-bottom:5px; text-align:center;">sau</div>
                            
                            <label>User Name (provizoriu):</label>
                            <div class="field_box rad3"><input<?php echo ($readonly) ? ' readonly="readonly"' : NULL;?> class="field size rad3" name="firstname0" type="text" value="<?php echo $POST->get_var('firstname0', 'post|sess');?>" /></div>
                            <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                            <div class="cleft" style="height:5px;"></div>
                            
                            <label>First Name:</label>
                            <div class="field_box rad3"><input<?php echo ($readonly) ? ' readonly="readonly"' : NULL;?> class="field size rad3" name="firstname0" type="text" value="<?php echo $POST->get_var('firstname0', 'post|sess');?>" /></div>
                            <div class="error_box"><p class="info">&nbsp;</p></div>
                            <div class="cleft" style="height:5px;"></div>
                            
                            <label>Last Name:</label>
                            <div class="field_box rad3"><input<?php echo ($readonly) ? ' readonly="readonly"' : NULL;?> class="field size rad3" name="lastname0" type="text" value="<?php echo $POST->get_var('lastname0', 'post|sess');?>" /></div>
                            <div class="error_box"><p class="info">&nbsp;</p></div>
                            <div class="cfix"></div>
                            <div class="cleft" style="height:5px;"></div>
                            
                            <label>Gender:</label>
                            <div class="radio_box rad3"><input id="gender1_1" type="radio" name="gender1" value="1" /><label for="gender1_1">Male</label><input id="gender1_2" type="radio" name="gender1" value="2" /><label for="gender1_2">Female</label></div>
                            <div class="error_box"><p class="info">&nbsp;</p></div>
                            <div class="cfix"></div>
                            <div class="cleft" style="height:5px;"></div>
                            
                            <label>Parental Grade:</label>
                            <div class="field_box rad3"><select class="size" name="lastname0"><option>select </option></select></div>
                            <div class="error_box"><p class="info">First and/or middle or middle initial</p></div>
                            <div class="cfix"></div>
                            <div class="cleft" style="height:5px;"></div>
                            
                            <label>&nbsp;</label>
                            <div class="radio_box rad3"><input id="life1_1" type="radio" name="life1" value="1" /><label for="life1_1">Life</label><input id="life1_2" type="radio" name="life1" value="2" /><label for="life1_2">Died</label></div>
                            <div class="error_box"><p class="info">&nbsp;</p></div>
                            <div class="cfix"></div>
                            <div class="cleft" style="height:5px;"></div>
                            
                            <label>Birthday:</label>
                            <div class="field_box left rad3"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
                            <div class="field_box left rad3" style="margin-left:10px;"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
                            <div class="field_box left rad3" style="margin-left:10px;"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
                            <div class="error_box"><p class="info">&nbsp;</p></div>
                            <div class="cfix"></div>
                            <div class="cleft" style="height:5px;"></div>
                            
                            <label>Death Date:</label>
                            <div class="field_box left rad3"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
                            <div class="field_box left rad3" style="margin-left:10px;"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
                            <div class="field_box left rad3" style="margin-left:10px;"><select style="width:80px;" class="size" name="lastname0"><option>select </option></select></div>
                            <div class="error_box"><p class="info">Apare la selectare decedat</p></div>
                            <div class="cfix"></div>
                            <div class="cleft" style="height:5px;"></div>
                            
                            <label>Add Photo:</label>
                            <div class="field_box rad3"><input<?php echo ($readonly) ? ' readonly="readonly"' : NULL;?> size="13" class="size" name="lastname0" type="file" value="<?php echo $POST->get_var('lastname0', 'post|sess');?>" /></div>
                            <div class="error_box"><p class="info">&nbsp;</p></div>
                            <div class="cfix"></div>
                            <div class="cleft" style="height:5px;"></div>
                            
                        </fieldset>
                    </div>
                    <div id="LoaderIcon" style="margin-left:183px; width:260px; margin-top:5px; visibility:hidden;"><img src="<?php echo base_image('harmony', 'layout2/ajax-loader.gif');?>" style="display:block; margin:0 auto;" width="16" height="11" alt="loading ..." /></div>
                    
                    <fieldset style="margin-left:183px; width:260px;" class="clear">
                        <div class="submit_box1 rad3" style="width:100px; margin:10px auto 0 auto;"><button class="gradBlueButton rad3" name="next1">save</button></div>
                        <div id="AddAsc" class="submit_box2 left rad3" style="width:125px; margin:10px auto 0 auto;"><button class="gradWhiteGloss rad3" name="next1" onclick="return false;">add asc</button></div>
                        <div id="AddDesc" class="submit_box2 right rad3" style="width:125px; margin:10px auto 0 auto;"><button class="gradWhiteGloss rad3" name="next1" onclick="return false;">add desc</button></div>
                    </fieldset>
                    
                    
                </form>
                <br /><br /><br /><br />
            </div>
        </div>
    </div>
</div>