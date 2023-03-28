<div id="Content">
	<div id="AG_Page" class="tree_create">
        <div class="leftColumn clear rad5-top clear" style="background-color:#E7DCCA;">
            <div class="left clear" id="AG_PageLeftBox"><?php include('views/corporate/left_column.php');?></div>
            <div id="AG_PageRightBox" class="right rad5-top-right clear" style="overflow:hidden;">
                <div id="AGFix" style="width:795px; min-height:1000px; border:none; margin:3px 0 0 0;background:#CCC; position:relative;">
                    <div style="width:795px;height:1100px;border:none;background:#FFF;">
						<ul class="control right clear">
                            <li class="button back"><a href="<?php echo anchor('organigrame','graph',1);?>">Back</a></li>
                            <li class="button prev"><a href="#">Preview</a></li>
							<li class="button next"><a href="#">Next</a></li>
                        </ul>
						<?php echo $timeline->HTMLcode(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>