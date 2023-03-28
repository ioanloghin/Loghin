<div id="Content">
	<div id="AG_Page" class="tree_create">
        <div class="leftColumn clear rad5-top clear" style="background-color:#E7DCCA;">
            <div class="left clear" id="AG_PageLeftBox"><?php include('views/corporate/left_column.php');?></div>
            <div id="AG_PageRightBox" class="right rad5-top-right clear" style="overflow:hidden;">
                <div id="AGFix" style="background:#FFF;min-height:1000px;">
                	<?php
					if(isset($_POST['save']))
						echo '<h2 class="redMesagge" style="margin:10px 20px;">Salvarea datelor nu este permisa. Doar departamentul tehnic poate efectua modificari asupra website-ului.<img style="position:absolute; margin-top:-0px;" src="http://www.freesmileys.org/smileys/smiley-forum/stop.gif" width="36" height="23" alt="" /></h2>';
					?>
                	<form method="post" action="<?php echo anchor('struct', 'operations', 1);?>" class="clean_form clear" style="margin:20px 20px 0 20px; background-color:#CCC; padding-bottom:10px;">
                    	<fieldset class="left">
                        	<label style="width:120px; color:#000; text-shadow:none; text-align:left; height:50px; line-height:50px; padding-left:10px;">Ateco de referin&#355;&#259;</label>
                         </fieldset>
                         <fieldset class="field_box left">
                            <select class="field" name="ref" style="border:1px solid #999; height:30px; width:60px; margin-left:5px; margin-top:10px;">
                            	<option<?php echo ($ref == 'it') ? ' selected="selected"' : '';?> value="it">IT</option>
                                <option<?php echo ($ref == 'en') ? ' selected="selected"' : '';?> value="en">EN</option>
                            </select>
                         </fieldset>
                         <fieldset class="submit_box2 left" style="margin-left:10px;"><button>Reevalueaz&#259;!</button></fieldset>
                         <fieldset class="submit_box2 right" style="margin-right:10px;"><button name="save">Salveaz&#259; in baza de date</button></fieldset>
                    </form>
                    <?php echo $operations->display(); ?>
                </div>
            </div>
        </div>
    </div>
</div>