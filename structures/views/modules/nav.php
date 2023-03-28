<table class="fix" width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td>
        	<div id="TopMenu">
                <ul>
                    <li><a class="agbut-home" href="<?php echo ROOT;?>">&nbsp;</a></li>
                    <li class="nod people"><a href="<?php echo anchor('index', 'people');?>">People<span class="icon">&nbsp;</span></a>
                    	<ul>
                        	<li><a href="http://genealogy.loghin.com">Genealogy &gt;</a>
                            	<ul>
                                	<li><a href="http://genealogy.loghin.com">Loream Ipsum</a></li>
                                    <li><a href="http://genealogy.loghin.com">Loream Ipsum</a></li>
                                </ul>
                            </li>
                            <li><a href="">-</a></li>
                        </ul>
                    </li>
                    <li class="nod business"><a href="<?php echo anchor('index', 'business');?>">Business<span class="icon">&nbsp;</span></a>
                    	<ul>
                        	<li><a href="<?php echo anchor('organigrame', 'graph', 1);?>">Organigrame</a></li>
                            <li><a href="">-</a></li>
                        </ul>
                    </li>
                    <li class="nod institutions"><a href="<?php echo anchor('index', 'institutions');?>">Institutions<span class="icon">&nbsp;</span></a>
                    	<ul>
                        	<li><a href="<?php echo anchor('institutions', 'graph', 1);?>">Universitate</a></li>
                            <li><a href="">-</a></li>
                        </ul>
                    </li>
                    <li class="nod structures"><a href="<?php echo anchor('index', '');?>">Statal<span class="icon">&nbsp;</span></a>
                    	<ul>
                        	<li><a href="<?php echo anchor('struct', 'graph', 1, 0, 2, 2);?>">Ateco (CAEN)</a></li>
                           <!-- <li><a href="">-</a></li> -->
                           
                           <li><a href="<?php echo anchor('struct', 'graph', 2, 0, 2, 2);?>">ISTAT</a></li>
                        </ul>
                    </li>
                    <li><a>Produse</a></li>
                </ul>
			</div>
        </td>
		<td style="width:336px;">
        	<form method="get" id="SearchBox" action="">
				<fieldset>
                    <button type="submit">&nbsp;</button>
                    <span class="sep">&nbsp;</span>
                    <input class="field" id="AGH_searchInput" onkeyup="SearchRecom('AGH_searchInput', 'AGH_searchRecom');" type="text" />
				</fieldset>
				<div id="AGH_searchRecom"><div id="AGH_searchRecom_fix"></div></div>
			</form>
            <!--<form method="get" class="AGH_searchBox" action="">
    <fieldset>
        <button type="submit">&nbsp;</button>
        <span class="sep">&nbsp;</span>
        <input id="AGH_searchInput" onkeyup="SearchRecom('AGH_searchInput', 'AGH_searchRecom');" type="text" />
    </fieldset>
    <div id="AGH_searchRecom"><div id="AGH_searchRecom_fix"></div></div>
    </form>-->
    	</td>
	</tr>
</table>