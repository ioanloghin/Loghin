<div id="Content">
    <div id="AG_Page" class="tree_create">
        <div class="leftColumn clear rad5-top clear" style="background-color:#E7DCCA;">
            <div class="left clear" id="AG_PageLeftBox"><?php include('views/tree/left_column.php');?></div>
            <div id="AG_PageRightBox" class="right rad5-top-right clear" style="overflow:hidden;">
            <br />
            <div id="AGcontent" style="width:760px; padding-bottom:20px; margin-left:6px;">
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
                        echo '<li class="first'.(($GET->get_var('section', TRUE) == NULL) ? ' current' : NULL).'"><a href="'.anchor('tree', 'media', $AGmyIDTree, $AGmyIDUser).'">Toate materialele</a></li>';
                        echo '<li'.(($GET->get_var('section', TRUE) == 'photo') ? ' class="current"' : NULL).'><a href="'.anchor('tree', 'media', $AGmyIDTree, $AGmyIDUser, 'photos').'">Imagini</a></li>';
                        echo '<li'.(($GET->get_var('section', TRUE) == 'story') ? ' class="current"' : NULL).'><a href="'.anchor('tree', 'media', $AGmyIDTree, $AGmyIDUser, 'stories').'">Povestiri</a></li>';
                        echo '<li'.(($GET->get_var('section', TRUE) == 'audio') ? ' class="current"' : NULL).'><a href="'.anchor('tree', 'media', $AGmyIDTree, $AGmyIDUser, 'audios').'">Audio</a></li>';
                        echo '<li class="last'.(($GET->get_var('section', TRUE) == 'video') ? ' current' : NULL).'"><a href="'.anchor('tree', 'media', $AGmyIDTree, $AGmyIDUser, 'videos').'">Video</a></li>';
                        ?>
                    </ul>
                    <?php
                    if($GET->get_var('section', TRUE))
                    {
                        switch($GET->get_var('section', TRUE))
                        {
                            default: $buttonTitle = NULL; $buttonIcon = NULL; break;
                            case'photo': $buttonTitle = 'Adaug&#259; imagine'; $buttonIcon = 'plus'; break;
                            case'story': $buttonTitle = 'Adaug&#259; povestire'; $buttonIcon = 'plus'; break;
                            case'audio': $buttonTitle = '&Icirc;nregistreaz&#259; audio'; $buttonIcon = 'rec'; break;
                            case'video': $buttonTitle = '&Icirc;nregistreaz&#259; video'; $buttonIcon = 'rec'; break;
                        }
                        echo '<a class="ancBtn2" href="'.ROOT.get_link('tree_media_'.$GET->get_var('section', TRUE).'_add', $AGmyIDTree, $AGmyIDUser).'" style="margin:4px 8px 0 0; float:right;"><span class="'.$buttonIcon.'">&nbsp;</span>'.$buttonTitle.'</a>';
                    }
                    ?>
                </div>
                <?php
                $redMesagge = 'Sec&#355;iune neterminat&#259;!<img style="position:absolute; margin-top:-8px;" src="http://th242.photobucket.com/albums/ff258/truckthis/emoticons/th_JackHammerSmilie.gif" width="41" height="37" alt="" />';
                
                if($GET->get_var('add', TRUE))
                {
                    $redMesagge = 'Sec&#355;iune neterminat&#259;!<img style="position:absolute; margin-top:-8px;" src="http://th242.photobucket.com/albums/ff258/truckthis/emoticons/th_JackHammerSmilie.gif" width="41" height="37" alt="" />';
                }
                if($GET->get_var('article_id', TRUE))
                {
                    $redMesagge = 'Sec&#355;iune neterminat&#259;!<img style="position:absolute; margin-top:-8px;" src="http://th242.photobucket.com/albums/ff258/truckthis/emoticons/th_JackHammerSmilie.gif" width="41" height="37" alt="" />';
                }
                
                if($redMesagge) echo '<h2 class="redMesagge">'.$redMesagge.'</h2>';
                if($greenMesagge) echo '<h2 class="greenMesagge">'.$greenMesagge.'</h2>';
                
                if($GET->get_var('add', TRUE))
                {
                    ?>
                    <div class="fp-box2" style="width:505px; margin-top:10px; float:left;">
                        <h4>1. Selecta&#355;i fi&#351;ierele pe care dori&#355;i s&#259; le &icirc;nc&#259;rca&#355;i</h4>
                        <div class="content">
                        <form method="post" action="">
                        
                        </form>
                        <em>To select multiple files, hold down the CTRL key (Command key on the Mac).</em>
                        </div>
                        <hr />
                        <p class="content"><strong>Supported media file types and sizes</strong><br />
                        <br />
                        Photos - .jpg .jpeg .png .gif .tiff .bmp. Individual photo file size can not exceed 15 MB.<br />
                        Switch to the basic uploader</p>
                    </div>
                    <div class="fp-box2" style="width:240px; margin-top:10px; float:right;">
                        <h4>Privacy:</h4>
                        <p class="content">Your privacy setting is currently set to: Public.<br />The privacy of your photos and stories is always protected. Only people authorized to view your family tree will be able to see attached photos and stories. 
                        <h4>Reminder:</h4>
                        <p class="content">All content submissions are subject to the Content Submission Agreement, which you have previously accepted.</p>
                    </div>
                    <?php
                }
                
                if($GET->get_var('article_id', TRUE))
                {
                    // start Article details --------------------------------------------------------- //
                    switch($GET->get_var('section', TRUE))
                    {
                        default:
                        case'photo':
                            $article = SQL_DB::sql_select(DBT_MED_PHO, "`".DBT_MED_PHO_C1."` = '".$GET->get_var('article_id')."'", NULL, 0, 1);
                            $article_titleIcon = 'photo';
                            $article_content = '<img src="'.ROOT.'content/media/photos/thumbs/'.$article[1][DBT_MED_PHO_C5].'" width="100%" alt="" />';
                            $article_contentStyle = NULL;
                            break;
                        case'story':
                            $article = SQL_DB::sql_select(DBT_MED_STO, "`".DBT_MED_STO_C1."` = '".$GET->get_var('article_id')."'", NULL, 0, 1);
                            $article_titleIcon = 'story';
                            $article_content = nl2br($article[1][DBT_MED_STO_C5]);
                            $article_contentStyle = ' style="padding:20px 10px;"';
                            break;
                        case'audio':
                            $article = SQL_DB::sql_select(DBT_MED_AUD, "`".DBT_MED_AUD_C1."` = '".$GET->get_var('article_id')."'", NULL, 0, 1);
                            $article_titleIcon = 'audio';
                            $article_content = '<embed type="application/x-shockwave-flash" src="http://c.mfcreative.com//swf/audio/player.en.swf?ver=1" width="375" height="125" id="player_obj" name="player_obj" bgcolor="#FFFFFF" quality="high" menu="false" wmode="transparent" allowscriptaccess="always" flashvars="videoid=77a13176-4425-4602-abd4-4d6be93b0b66.FLV&site=local&siteroot="/>';
                            $article_contentStyle = NULL;
                            break;
                        case'video':
                            $article = SQL_DB::sql_select(DBT_MED_VID, "`".DBT_MED_VID_C1."` = '".$GET->get_var('article_id')."'", NULL, 0, 1);
                            $article_titleIcon = 'video';
                            $article_content = '<embed type="application/x-shockwave-flash" src="http://c.mfcreative.com//swf/audio/player.en.swf?ver=1" width="375" height="125" id="player_obj" name="player_obj" bgcolor="#FFFFFF" quality="high" menu="false" wmode="transparent" allowscriptaccess="always" flashvars="videoid=77a13176-4425-4602-abd4-4d6be93b0b66.FLV&site=local&siteroot="/>';
                            $article_contentStyle = NULL;
                            break;
                    }
                    
                    if(isset($article[1]))
                    {
                        ?>
                        <div id="mediaLarge">
                            <div class="medTitle"><span class="media_icon <?php echo $article_titleIcon;?>_green">&nbsp;</span><h1><?php echo $article[1][DBT_MED_PHO_C6];?></h1></div>
                            <div class="leftSide">
                                <div class="medImg"<?php echo $article_contentStyle;?>><?php echo $article_content;?></div>
                            </div>
                            <div class="rightSide">
                                <div class="fp-desc-box" style="margin-top:10px;">
                                    <div class="fp-desc-box-top"><span>Alte imagini</span></div>
                                    <div class="cleft"></div>
                                    <div class="fp-desc-box-content">
                                        ...
                                        <div class="itemSpace"></div>
                                    </div>
                                </div>
                                
                                <div class="fp-desc-box" style="margin-top:10px;">
                                    <div class="fp-desc-box-top"><span>Unelte</span></div>
                                    <div class="cleft"></div>
                                    <div class="fp-desc-box-content">
                                        ...<hr />
                                        <div class="itemSpace"></div>
                                    </div>
                                </div>
                                
                                <div class="fp-desc-box" style="margin-top:10px;">
                                    <div class="fp-desc-box-top"><span>Persoane atasate acestei imagini</span></div>
                                    <div class="cleft"></div>
                                    <div class="fp-desc-box-content">
                                        ...<hr /><a class="ancBtn" href="#" style="margin-left:10px;"><span class="plus">&nbsp;</span>Adaug&#259; persoan&#259;</a><div class="cleft"></div>
                                        <div class="itemSpace"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    // end Article details ----------------------------------------------------------- //
                }
                else
                if(!$GET->get_var('add', TRUE))
                {
                    // start Article list ----------------------------------------------------------- //
                    if($GET->get_var('section', TRUE))
                    {
                        switch($GET->get_var('section', TRUE))
                        {
                            default:
                            case'photo':
                                $table			= DBT_MED_PHO;
                                $table_where	= "`".DBT_MED_PHO_C2."` = $AGmyIDUser";
                                $table_order	= "ORDER BY `".DBT_MED_PHO_C11."` DESC";
                                $table_columns	= array(DBT_MED_PHO_C1, DBT_MED_PHO_C5, DBT_MED_PHO_C6, DBT_MED_PHO_C11);
                                break;
                            case'story':
                                $table			= DBT_MED_STO;
                                $table_where	= "`".DBT_MED_STO_C2."` = $AGmyIDUser";
                                $table_order	= "ORDER BY `".DBT_MED_STO_C9."` DESC";
                                $table_columns	= array(DBT_MED_STO_C1, DBT_MED_STO_C4, DBT_MED_STO_C9);
                                break;
                            case'audio':
                                $table			= DBT_MED_AUD;
                                $table_where	= "`".DBT_MED_AUD_C2."` = $AGmyIDUser";
                                $table_order	= "ORDER BY `".DBT_MED_AUD_C5."` DESC";
                                $table_columns	= array(DBT_MED_AUD_C1, DBT_MED_AUD_C4, DBT_MED_AUD_C5, DBT_MED_AUD_C6);
                                break;
                            case'video':
                                $table			= DBT_MED_VID;
                                $table_where	= "`".DBT_MED_VID_C2."` = $AGmyIDUser";
                                $table_order	= "ORDER BY `".DBT_MED_VID_C4."` DESC";
                                $table_columns	= array(DBT_MED_VID_C1, DBT_MED_VID_C3, DBT_MED_VID_C4);
                                break;
                        }
                        $media_list = SQL_DB::sql_select($table, $table_where, $table_order, 0, $medias_limit, $table_columns);
                        $medias  = count($media_list);
                    }
                    else
                    {
                        $db_photos = SQL_DB::sql_select(DBT_MED_PHO, "`".DBT_MED_PHO_C2."` = $AGmyIDUser", "ORDER BY `".DBT_MED_PHO_C11."` DESC", 0, 0,
                                                     array(DBT_MED_PHO_C1, DBT_MED_PHO_C5, DBT_MED_PHO_C6, DBT_MED_PHO_C11));
                        $db_stories = SQL_DB::sql_select(DBT_MED_STO, "`".DBT_MED_STO_C2."` = $AGmyIDUser", "ORDER BY `".DBT_MED_STO_C9."` DESC", 0, 0,
                                                     array(DBT_MED_STO_C1, DBT_MED_STO_C4, DBT_MED_STO_C9));
                        $db_audios = SQL_DB::sql_select(DBT_MED_AUD, "`".DBT_MED_AUD_C2."` = $AGmyIDUser", "ORDER BY `".DBT_MED_AUD_C5."` DESC", 0, 0,
                                                     array(DBT_MED_AUD_C1, DBT_MED_AUD_C4, DBT_MED_AUD_C5, DBT_MED_AUD_C6));
                        $db_videos = SQL_DB::sql_select(DBT_MED_VID, "`".DBT_MED_VID_C2."` = $AGmyIDUser", "ORDER BY `".DBT_MED_VID_C4."` DESC", 0, 0,
                                                     array(DBT_MED_VID_C1, DBT_MED_VID_C3, DBT_MED_VID_C4));
                        $photos  = count($db_photos);
                        $stories = count($db_stories);
                        $audios  = count($db_audios);
                        $videos  = count($db_videos);
                        $medias = $photos + $stories + $audios + $videos;
                        
                        $db_list     = array();
                        $datainserts = array();
                        foreach($db_photos as $key => $value)
                        {
                            $db_list['photo_'.$key] = $value;
                            $datainserts['photo_'.$key] = strtotime($value[DBT_MED_PHO_C11]);
                            if($key==$medias_limit) break;// oprim executia daca s-a introdus deja numarul maxim de inregistrari in array
                        }
                        foreach($db_stories as $key => $value)
                        {
                            $db_list['story_'.$key] = $value;
                            $datainserts['story_'.$key] = strtotime($value[DBT_MED_STO_C9]);
                            if($key==$medias_limit) break;// oprim executia daca s-a introdus deja numarul maxim de inregistrari in array
                        }
                        foreach($db_audios as $key => $value)
                        {
                            $db_list['audio_'.$key] = $value;
                            $datainserts['audio_'.$key] = strtotime($value[DBT_MED_AUD_C5]);
                            if($key==$medias_limit) break;// oprim executia daca s-a introdus deja numarul maxim de inregistrari in array
                        }
                        foreach($db_videos as $key => $value)
                        {
                            $db_list['video_'.$key] = $value;
                            $datainserts['video_'.$key] = strtotime($value[DBT_MED_VID_C4]);
                            if($key==$medias_limit) break;// oprim executia daca s-a introdus deja numarul maxim de inregistrari in array
                        }
                        unset($db_photos, $db_stories, $db_audios, $db_videos);
                        asort($datainserts, SORT_NUMERIC);
                        $n=1;
                        $media_list = array();
                        foreach($datainserts as $key => $value)
                        {
                            $exp = explode('_', $key);
                            $db_list[$key]['link_section'] = $exp[0];
                            $media_list[] = $db_list[$key];
                            $n++;
                            if($n==$medias_limit) break;
                        }
                        unset($datainserts);
                    }
                    
                    if($medias)
                    {
                        echo '<div class="pagination"></div>';
                        echo '<ul class="mediaItemList">';
                        foreach($media_list as $row)
                        {
                            if($GET->get_var('section', TRUE))
                                $row['link_section'] = $GET->get_var('section', TRUE);
                            
                            switch($row['link_section'])
                            {
                                default:
                                    $thisID = 0;
                                    $thisTitle = NULL;
                                    $imgStyle = NULL;
                                    $imgPatch  = NULL;
                                    $imgWidth  = 0;
                                    $imgHeight = 0;
                                    break;
                                case'photo':
                                    $thisID    = $row[DBT_MED_PHO_C1];
                                    $thisTitle = $row[DBT_MED_PHO_C6];
                                    $imgStyle  = ' style="margin-top:10px;"';
                                    $imgPatch  = ROOT.'content/media/photos/thumbs/'.$row[DBT_MED_PHO_C5];
                                    $imgWidth  = 80;
                                    $imgHeight = 80;
                                    break;
                                case'story':
                                    $thisID    = $row[DBT_MED_STO_C1];
                                    $thisTitle = $row[DBT_MED_STO_C4];
                                    $imgStyle = ' class="iconFix"';
                                    $imgPatch = ROOT.'design/imagini/layout2/gallery-story.gif';
                                    $imgWidth  = 27;
                                    $imgHeight = 32;
                                    break;
                                case'audio':
                                    $thisID    = $row[DBT_MED_AUD_C1];
                                    $thisTitle = $row[DBT_MED_AUD_C6];
                                    $imgStyle = ' class="iconFix"';
                                    $imgPatch  = ROOT.'design/imagini/layout2/gallery-audio.gif';
                                    $imgWidth  = 17;
                                    $imgHeight = 32;
                                    break;
                                case'video':
                                    $thisID    = $row[DBT_MED_VID_C1];
                                    $thisTitle = $row[DBT_MED_VID_C6];
                                    $imgStyle = ' class="iconFix"';
                                    $imgPatch  = ROOT.'design/imagini/layout2/gallery-video.gif';
                                    $imgWidth  = 31;
                                    $imgHeight = 32;
                                    break;
                            }
                            
                            echo '<li class="mediaCell">';
                            echo '<div class="mediaCellImg"><a style="display:block;" href="'.ROOT.get_link('tree_media_'.$row['link_section'], $AGmyIDTree, $AGmyIDUser, $thisID).'"><img'.$imgStyle.' src="'.$imgPatch.'" width="'.$imgWidth.'" height="'.$imgHeight.'" alt="" /></a></div>';
                            echo '<div class="mediaCellTitle">'.substr($thisTitle, 0, 10).((strlen($thisTitle) > 10) ? '&hellip;' : '').'</div>';
                            echo '</li>';
                        }
                        
                        echo '</ul>';
                        echo '<div class="pagination"></div>';
                    }
                    // end Article list ------------------------------------------------------------- //
                }
                ?>
            </div>
            </div>
        </div>
    </div>
</div>