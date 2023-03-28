<?php
global $gen;
$infoUser = $acc_api->get_account($MyUser->account_id());
?>
<div id="Content">
    <div id="AG_Page" class="tree_create">
        <div class="leftColumn clear rad5-top clear" style="background-color:#E7DCCA;">
            <div class="left clear" id="AG_PageLeftBox">
				<?php if($MyUser->account_id()): ?>
                    <div class="rad5-top-left" style="background-color:#F8F5F3;">
                        <input type="hidden" id="hiddenmember_id" name="hiddenmember_id" value="<?php echo $MyUser->account_id();?>" />
                        <div class="h10"></div>
                        <div class="info_fix">
                            <span class="title"><?php echo $infoUser['firstname'];?> <?php echo $infoUser['lastname'];?></span>
                            <span class="other"><?php echo Datatime::age($infoUser['birthday']).'ani '.$infoUser['city'].' '.$infoUser['country'];?>&nbsp;</span>
                        </div>
                        <!-- Profile image -->
                        <?php $img_src = ($infoUser['photo']) ? 'http://register.loghin.com/uploads/profiles/Fr9VPnAIySVtC2ROYdXhcvxOdtXvRDKn.png' : base_image('harmony', 'default_image.png');?>
                        <div class="image_mask rad5"><div class="bwhite rad5"><img src="<?php echo $img_src;?>" width="146" alt="" /></div></div>
                        <!-- Button: change profile -->
                        <div class="change_profile rad5-bottom"><a href="http://register.loghin.com/settings/profile/profiles/">View Profile</a></div>
                        
                        <div class="miniDNA" style="margin-top:15px; margin-bottom:10px; clear:left"></div>
                        <div class="agbut-2" style="float:none; display:block; margin-left:15px;"><span class="agbut-2-left">&nbsp;</span><span style="width:146px; text-align:center;" class="agbut-2-center cursor-pointer" onclick="return quickEditUser('open', <?php echo $MyUser->account_id();?>);">Quick Profile View</span><span class="agbut-2-right">&nbsp;</span></div>
                        <div class="miniDNA" style="margin-top:10px; margin-bottom:0px;"></div>
                    </div>
                    <ul class="column_list">
                        <?php
                        
                        $arr = $gen->compatibility_get_member_tree($MyUser->account_id());
                        $count = count($arr);
                        
                        foreach($arr as $n => $row):
                            ?>
                            <li class="item <?php echo ($n == 0) ? ' first' : ' ';?>">
                                <a class="title" href="<?php echo anchor('tree', 'graph', 0, $MyUser->account_id(), 0, $row['family_id']);?>" style="width:180px;">Familia <?php echo $row['family_id'];?></a>
                                <div class="cleft"></div>
                            </li>
                            <li class="miniDNA">&nbsp;</li>
                            <?php
                        endforeach;
                        ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div id="AG_PageRightBox" class="right rad5-top-right clear" style="overflow:hidden;">
                <div id="AGTollbar">
                    <?php
                    if(false)
                        echo '<a href="'.ROOT.'preview/tree-'.$AGmyIDTree.'/'.(($AGmyIDUser) ? $AGmyIDUser.'/' : '').'" class="agbut-2 preview" target="_blank"><span class="agbut-2-left">&nbsp;</span><span class="agbut-2-center cursor-pointer">Preview</span><span class="agbut-2-right">&nbsp;</span></a>';
                    ?>
                </div>
                <div id="AGFix" style="width:774px; min-height:1000px; border:none; background:#FFF; overflow:auto; position:relative; overflow:hidden;"></div>
            </div>
        </div>
    </div>
</div>