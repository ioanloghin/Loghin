<div id="Content">
    <div id="AG_Page" class="tree_create">
        <div class="leftColumn clear rad5-top clear" style="background-color:#E7DCCA;">
            <div class="left clear" id="AG_PageLeftBox"><?php include('views/tree/left_column.php');?></div>
            <div id="AG_PageRightBox" class="right rad5-top-right clear" style="overflow:hidden;">
            <br />
            <div id="AGcontent" style="width:725px; height:1010px; overflow-y:hidden; margin-left:6px;">
            <?php
			$GET = new safe_get();
            $GET->set_var('section', NULL, 'strip_tags|trim|htmlentities');
            $GET->set_var('add', 0, 'intval');
            $GET->set_var('article_id', 0, 'intval');
            $medias_limit = 20;
            $redMesagge = NULL;
            $greenMesagge = NULL;
            ?>
                <div class="SubNavBarDiv">
                    <ul class="nav">
                        <?php
                        echo '<li class="first'.(($GET->get_var('section', TRUE) == NULL) ? ' current' : NULL).'"><a href="'.ROOT.get_link('tree_facts', $AGmyIDTree, $AGmyIDUser).'">Fapte &#351;i evenimente</a></li>';
                        echo '<li'.(($GET->get_var('section', TRUE) == 'sources') ? ' class="current"' : NULL).'><a href="'.ROOT.get_link('tree_sources', $AGmyIDTree, $AGmyIDUser).'">Surs&#259; de citare</a></li>';
                        ?>
                    </ul>
                    <?php
                    switch($GET->get_var('section', TRUE))
                    {
                        default:
                        case'facts': $buttonTitle = 'Adaug&#259; fapt'; $buttonIcon = 'plus'; break;
                        case'sources': $buttonTitle = 'Adaug&#259; surs&#259; de citare'; $buttonIcon = 'plus'; break;
                    }
                    echo '<a class="ancBtn2" href="'.ROOT.get_link('tree_media_'.$GET->get_var('section', TRUE).'_add', $AGmyIDTree, $AGmyIDUser).'" style="margin:4px 8px 0 0; float:right;"><span class="'.$buttonIcon.'">&nbsp;</span>'.$buttonTitle.'</a>';
                    ?>
                </div>
                <h2 class="redMesagge">Sec&#355;iune neterminat&#259;!<img style="position:absolute; margin-top:-8px;" src="http://th242.photobucket.com/albums/ff258/truckthis/emoticons/th_JackHammerSmilie.gif" width="41" height="37" alt="" /></h2>
                <div class="fact-box">
                    <div class="header"><span>Nume</span></div>
                    <div class="content">.1</div>
                </div>
                <div class="fact-box">
                    <div class="header"><span>Gender</span></div>
                    <div class="content">.2</div>
                </div>
                <div class="fact-box">
                    <div class="header"><span>Birth</span></div>
                    <div class="content">.2</div>
                </div>
                <div class="fact-box">
                    <div class="header"><span>Will</span></div>
                    <div class="content">.2</div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>