<ul class="v-nav">
	<li><div class="border"><a href="#">Category</a><span class="icon">&nbsp;</span></div>
        <ul>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
            	<ul>
                	<li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
            	<ul>
                	<li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
            	<ul>
                	<li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
        </ul>
    </li>
    <li><div class="border"><a href="#">Category</a><span class="icon">&nbsp;</span></div>
        <ul>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
            	<ul>
                	<li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
            	<ul>
                	<li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
        </ul>
    </li>
    <li><div class="border"><a href="#">Category</a><span class="icon">&nbsp;</span></div>
        <ul>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
            	<ul>
                	<li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
            	<ul>
                	<li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
            	<ul>
                	<li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="line">&nbsp;</li>
    <li class="grey"><div class="border"><a href="#">Category</a><span class="icon">&nbsp;</span></div>
        <ul>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
            	<ul>
                	<li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Category</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
            <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
        </ul>
    </li>
</ul>
<div class="v-box" style="margin-top:30px;">
	<h2 class="header rad5-top"><a class="tcenter" href="#more-services">More Services</a></h2>
    <div class="content">
    	Dublu click pe "More Services" pentru a accesa continutul.
    </div>
    <div class="more-services hide">
    	<a class="close icon" href="#close"> </a>
        More service content 
    </div>
</div>
<div class="v-box">
	<h2 class="header rad5-top"><a class="tcenter" href="#more-services">Flash-Info</a></h2>
    <div class="content">
    	Info Flash Romania
    </div>
    <div class="more-services hide">
    	<a class="close icon" href="#close"> </a>
        More service content 
    </div>
</div>

<br />
<div class="deep_menu" style="margin-bottom:6px;">CATEGORII:<a<?php echo ($blockID) ? ' class="selected"' : NULL;?> href="<?php echo anchor('struct', 'graph', 1, 2, $deep, $direction);?>">UNA</a> | 
<a<?php echo (!$blockID) ? ' class="selected"' : NULL;?> href="<?php echo anchor('struct', 'graph', 1, 0, $deep, $direction);?>">TOATE</a></div>
<div class="deep_menu">AD&Acirc;NCIME:
<a<?php echo ($deep == 1) ? ' class="selected"' : NULL;?> href="<?php echo anchor('struct', 'graph', 1, $blockID, 1, $direction);?>">1</a> | 
<a<?php echo ($deep == 2) ? ' class="selected"' : NULL;?> href="<?php echo anchor('struct', 'graph', 1, $blockID, 2, $direction);?>">2</a> | 
<a<?php echo ($deep == 3) ? ' class="selected"' : NULL;?> href="<?php echo anchor('struct', 'graph', 1, $blockID, 3, $direction);?>">3</a> | 
<a<?php echo ($deep == 4) ? ' class="selected"' : NULL;?> href="<?php echo anchor('struct', 'graph', 1, $blockID, 4, $direction);?>">4</a> | 
<a<?php echo ($deep == 5) ? ' class="selected"' : NULL;?> href="<?php echo anchor('struct', 'graph', 1, $blockID, 5, $direction);?>">5</a></div>
<br /><br />
<div class="deep_menu" style="margin-bottom:6px;">ORIENTARE:<br />
<a<?php echo ($direction == 1) ? ' class="selected"' : NULL;?> href="<?php echo anchor('struct', 'graph', 1, $blockID, $deep, 1);?>">TIP 1 (Verticala)</a><br /> 
<a<?php echo ($direction == 2) ? ' class="selected"' : NULL;?> href="<?php echo anchor('struct', 'graph', 1, $blockID, $deep, 2);?>">TIP 2 (orizontala)</a></div>
<br />