		<!-- page content -->
        <div class="leftColumn clear clear" style="background-color:#F8F5F3;">
        	<!-- left coumn-->
            <div class="left clear" id="AG_PageLeftBox"><?php include('views/struct/left_column.php');?></div><!-- end left coumn-->
            
            <!-- right coumn-->
            <div id="AG_PageRightBox" class="right clear" style="overflow:hidden;padding-top:10px;">
                <div id="AGFix" style="width:795px; min-height:1000px; border:none; margin:3px 0 0 0; background:#FFF; overflow-x:scroll; position:relative;">
                    <div id="AGDynamic" style="width:auto; border:none;">
					<a href="">Deschide toate</a>
					<?php echo $project->display(); ?></div>
                </div>
            </div><!-- end right coumn-->
            
        </div><!-- end page content -->
    </div><!-- end centrare pagina -->
</div><!-- end pagina -->