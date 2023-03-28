<div id="Content">
    <div id="AG_Page" class="tree_create">
        <div class="leftColumn clear rad5-top clear" style="background-color:#E7DCCA;">
            <div class="left clear" id="AG_PageLeftBox"><?php include('views/tree/left_column.php');?></div>
            <div id="AG_PageRightBox" class="right rad5-top-right clear" style="overflow:hidden;">
            <div id="AGTollbar">
                <?php
                if($AGmyAdmin)
                    echo '<a href="'.ROOT.'preview/tree-'.$AGmyIDTree.'/'.(($AGmyIDUser) ? $AGmyIDUser.'/' : '').'" class="agbut-2 preview" target="_blank"><span class="agbut-2-left">&nbsp;</span><span class="agbut-2-center cursor-pointer">Preview</span><span class="agbut-2-right">&nbsp;</span></a>';
                ?>
            </div>
            <div id="AGFix" style="width:774px; min-height:1000px; border:none; background:#FFF; overflow:auto; position:relative; overflow:hidden;">
            <div id="AGDynamic" style="width:<?php echo $AGPlanW;?>px; height:<?php echo $AGPlanH;?>px; margin-top:<?php echo ($topMinus*-1);?>px; margin-left:<?php echo floor((774-$AGPlanW)/2);?>px; overflow:hidden; border:none;">
            <?php echo $pageContent; ?>
            </div>
            </div>
            <?php
            /*$time = explode(' ', microtime());
            $finish = $time[1] + $time[0];
            $total_time = round(($finish - $start), 4);
            print "<br />DURATA &Icirc;NC&#258;RC&#258;RII: <strong style=\"color:#03C\">$total_time</strong> secunde<br />";*/
            ?>
            </div>
        </div>
    </div>
</div>