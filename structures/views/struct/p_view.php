		<!-- page content -->
        <div class="leftColumn clear clear" style="background-color:#F8F5F3;">
        	<?php include('views/struct/m_view_left.php');?>
            <div class="middle" style=" background-color:#F00">
                <div id="AG_PageRightBox" class="right clear" style="overflow:hidden;padding-top:6px;position:relative;">
                	<?php include('views/search/advance_search.php');?>
                    <div id="AGFix" style="width:755px;min-height:1000px;border:none;margin:3px 0 0 0;margin-right:40px;background:#FFF;overflow-x:scroll;position:relative;">
                        <div id="AGDynamic" style="padding-left:10px;">
                            <ul class="control right clear">
                                <li class="button back"><a href="<?php echo anchor('struct','graph',1,2,2,2);?>">Back</a></li>
                                <li class="button prev"><a href="#">Preview</a></li>
                                <li class="button next"><a href="#">Next</a></li>
                            </ul>
                            <br />Pagina cu detalii despre codul <strong><?php echo $code; ?></strong><br/><br/><br/>
                            
                            <div style="font-size: 15px;border: 1px solid silver;padding: 5px;font-style: italic;border-radius: 10px;"><?php echo $info['description']; ?></div>
                        </div>
                    </div>
                </div>
            </div><!-- end right coumn-->
        </div><!-- end page content -->
    </div><!-- end centrare pagina -->
</div><!-- end pagina -->