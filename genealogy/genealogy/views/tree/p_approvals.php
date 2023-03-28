<div id="Content">
    <div id="AG_Page" class="tree_create">
        <div class="leftColumn clear rad5-top clear" style="background-color:#E7DCCA;">
            <div class="left clear" id="AG_PageLeftBox"><?php include('views/tree/left_column_approvals.php');?></div>
            <div id="AG_PageRightBox" class="right rad5-top-right clear" style="overflow:hidden;">
            <br />
            <div id="AGcontent" style="width:760px; padding-bottom:20px; margin-left:6px;">
                <?php if($approval_id > 0){
				$approval = new Approval($approval_id);
				$family   = $approval->family();
				$approval_db = $approval->getdb();
				?>
                <div style="float:left; width:440px; min-height:500px;">
                    <div class="fp-desc-box" style="margin-top:10px;">
                        <div class="fp-desc-box-top"><span>Comentarii</span></div>
                        <div class="cleft"></div>
                        <div class="fp-desc-box-content" style="text-align:center">
                            <?php
                            echo '<p style="font-style:italic; padding-left:10px; padding-top:5px; text-align:center;">Nu sunt comentarii adaugate.</p><hr />';
                            ?>
                            <a class="ancBtn" href="<?php echo anchor('tree', 'approvals', $approval_id, 'accept');?>" style="margin-left:10px;">Accepta avizul</a>
                            <div class="cboth"></div>
                        </div>
                    </div>
                </div>
                
                <div style="float:right; width:310px;">
                    <div class="fp-desc-box" style="margin-top:10px;">
                        <div class="fp-desc-box-top"><span>Membri familie</span></div>
                        <div class="cleft"></div>
                        <div class="fp-desc-box-content">
                            <strong class="h4">P&#259;rin&#355;i / Fra&#355;i &#351;i surori</strong>
                            <ul class="itemProfilGrup">
                                <?php
                                echo AG_Operation::item_profil_3($family[0], false, $approval_db['account_id']);
                                echo AG_Operation::item_profil_3($family[1], true, $approval_db['account_id']);
                            	?>
                            </ul>
                            <ul class="itemProfilSubGrup">
                            <?php
                                // copii
                                if($family[2])
                                {
                                    $cnt = count($family[2]);
                                    $n=0;
                                    foreach($family[2] as $child_id)
                                    {
                                        echo AG_Operation::item_profil_3($child_id, (($cnt == ++$n) ? true : false), $approval_db['account_id']);
                                    }
                                }
                                else
                                    echo '<li><span style="color:#999; display:block; padding:5px 0 5px 20px;">Nu are frati sau surori inregistrate.</span></li>';
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="fp-desc-box" style="margin-top:10px;">
                        <div class="fp-desc-box-top"><span>Source Information</span></div>
                        <div class="cleft"></div>
                        <div class="fp-desc-box-content">
                            No source citations have been added yet.<hr /><a class="ancBtn" href="#" style="margin-left:10px;">Cautare</a><div class="cleft"></div>
                            <div class="itemSpace"></div>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                <p style="text-align:center">Selectati un aviz.</p>
                <?php } ?>
                <div class="cboth"></div>
            </div>
            </div>
        </div>
    </div>
</div>