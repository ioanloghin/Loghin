<div id="Content">
	<div id="AG_Page" class="tree_create">
        <div class="leftColumn clear rad5-top clear" style="background-color:#E7DCCA;">
            <div class="left clear" id="AG_PageLeftBox"><?php include('views/corporate/left_column.php');?></div>
            <div id="AG_PageRightBox" class="right rad5-top-right clear" style="overflow:hidden;">
                <div id="AGFix" style="width:795px; min-height:1000px; border:none; margin:3px 0 0 0;background:#CCC; position:relative;">
                    <div id="AGDynamic" style="width:4600px;height:2100px;border:none;left:-50%; margin-left:-200px;background:#FFF;"><?php echo $plan->HTMLcode(); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>