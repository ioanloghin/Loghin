<div id="Content" style="padding-top:20px;">

    
<div class="width clear">
    <div id="search" class="clear">
        <div class="left"><?php include('views/search/search_options.php');?></div>
        <div class="right"><?php include('views/search/advance_search.php');?></div>
        <div class="middle">
            <h2 class="head"><span>Search Results</span></h2>
            <div class="cnt">
                <div class="head">
        <div class="navigation clear">
            <h3 class="left">Results 1 - 25 of 2,500 Items</h3>
            <ul class="control right clear">
                <li><a class="back button" href="#back"><span>Back</span></a></li>
                <li><a class="prev button" href="#prev"><span>Preview</span></a></li>
                <li class="last"><a class="next button" href="#next"><span>Next</span></a></li>
            </ul>
        </div><!-- #search .navigation -->
    
        <div class="tabs clear">
            <ul class="clear left">
                <li class="selected"><a href="<?php echo ROOT;?>search/">Loghin</a></li>
                <li><a href="<?php echo ROOT;?>search/images/">Web</a></li>
            </ul><!-- #search .tabs .left -->
    
            <select class="inputCombo right">
                <option>Select Category</option>
            </select><!-- #search .tabs .right -->
            <ul class="clear right">
                <li class="has">
                    <a href="#">Other <span class="icon"></span></a>
                    <ul>
                        <li><a href="<?php echo ROOT;?>search/images/">Images</a></li>
                        <li><a href="<?php echo ROOT;?>search/videos/">Videos</a></li>
                        <li><a href="<?php echo ROOT;?>search/text/">Text</a></li>
                    </ul>
                </li>
            </ul><!-- #search .tabs .right -->
        </div>
    </div><!-- #search .head -->
    
    <div id="search-results" class="blocks">
        <ol class="result clear">
        	<?php
            $car = array('1281.jpg', '11645-18414-72093.jpg', 'bugatti-veyron-automotive-car-2.jpg', 'Volvo_the_Game_S60_concept.jpg');
			foreach(range(1, 20) as $block): ?>
    		<li><span><img src="<?php echo ROOT.'content/images/'.$car[rand(0,3)]; ?>" width="180" height="112" alt=""/><strong>Fast Cars 2.jpg</strong><br/><a href="#">speedacar-com.blogspot.com</a><br/><span>800 × 600</span><br/><span class="tags"><a href="#">Similar</a> |  <a href="#">More sizes</a></span><a class="icon" href="#">»</a></span></li>
            <?php endforeach; ?>
        </ol>
    </div><!-- #search-result -->
            </div>
        </div>
    </div>
</div>


</div>